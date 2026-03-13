<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Nominee;
use Illuminate\Http\Request;

class AdminNomineeController extends Controller
{
    // Show all nominees
    public function index()
    {
        $nominees = Nominee::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.nominees.index', compact('nominees'));
    }

    // Store new nominee
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'category' => 'required|string|max:255',
        ]);

        Nominee::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'category' => $request->category,
        ]);

        return redirect()->back()->with('success', 'Nominee added successfully!');
    }

    // Delete nominee
    public function destroy($id)
    { $nominations = Nominee::orderBy('created_at', 'desc')->paginate(10);
    return view('admin.nominees.index', compact('nominations'));
    }
}