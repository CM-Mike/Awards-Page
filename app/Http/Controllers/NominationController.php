<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Nomination, Nominee, Category, SubCategory};
use Illuminate\Support\Carbon;

class NominationController extends Controller
{
    public function index() { return $this->create(); }

    public function create()
    {
        $categories = Category::with('subCategories')->orderBy('name', 'asc')->get();
        // Get trending nominees for the bottom spotlight
        $nominees = Nominee::withCount('nominations')->orderByDesc('nominations_count')->take(4)->get();
        
        return view('events.nomination', compact('categories', 'nominees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'            => 'required|string|max:255',
            'category_id'     => 'required|exists:categories,id',
            'sub_category_id' => 'required|exists:sub_categories,id',
            'social_handle'   => 'required|string',
            'reason'          => 'required|string|min:10',
            'image'           => 'required|image|max:2048',
        ]);

        $now = Carbon::now();
        $imagePath = $request->file('image')->store('nominees', 'public');

        // Create or find the Star
        $nomineeRecord = Nominee::firstOrCreate(
            ['name' => $request->name, 'sub_category_id' => $request->sub_category_id],
            [
                'category_id'   => $request->category_id,
                'social_handle' => $request->social_handle,
                'reason'        => $request->reason,
                'image'         => $imagePath,
            ]
        );

        $nomination = Nomination::where('nominee_id', $nomineeRecord->id)->first();

        if ($nomination) {
            if (!$nomination->last_free_nomination || $now->diffInHours($nomination->last_free_nomination) >= 24) {
                $nomination->increment('nomination_count');
                $nomination->update(['last_free_nomination' => $now]);
                return redirect()->back()->with('success', 'Daily free nomination recorded!');
            } else {
                return redirect()->route('nomination.pay', ['nominee_id' => $nomination->id]);
            }
        } else {
            Nomination::create([
                'nominee_id' => $nomineeRecord->id,
                'category_id' => $request->category_id,
                'nomination_count' => 1,
                'last_free_nomination' => $now,
            ]);
            return redirect()->back()->with('success', 'Nomination submitted!');
        }
    }
}