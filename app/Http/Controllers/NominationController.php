<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nomination;
use App\Models\Nominee;
use Illuminate\Support\Carbon;

class NominationController extends Controller
{
    /**
     * Show the nomination form with nominees
     */
    public function create()
    {
        // Get nominees with nomination counts to show on the nomination page
        $nominees = Nominee::withCount('nominations')->get()->sortByDesc('nominations_count');

        return view('events.nomination', compact('nominees'));
    }

    /**
     * Show all nominees (index page)
     */
    public function index()
    {
        $nominees = Nominee::withCount('nominations')->get()->sortByDesc('nominations_count');

        return view('nominations.index', compact('nominees'));
    }

    /**
     * Store a new nomination
     */
    public function store(Request $request)
    {
        $request->validate([
            'nominee_type' => 'required',
            'name' => 'required',
            'category' => 'required',
            'reason' => 'required',
        ]);

        $now = Carbon::now();

        // Step 1: Create or fetch the nominee record
        $nomineeRecord = Nominee::firstOrCreate(
            [
                'name' => $request->name,
                'category' => $request->category,
            ],
            [
                'nominee_type' => $request->nominee_type,
                'image' => $request->hasFile('image') 
                    ? $request->file('image')->store('nominations', 'public') 
                    : null,
            ]
        );

        // Step 2: Check if a nomination already exists
        $existing = Nomination::where('name', $request->name)
            ->where('category', $request->category)
            ->first();

        if ($existing) {
            $lastFree = $existing->last_free_nomination;

            if (!$lastFree || $now->diffInHours($lastFree) >= 24) {
                // First free nomination today
                $existing->increment('nomination_count');
                $existing->update(['last_free_nomination' => $now]);

                return redirect()->route('nomination.create')
                    ->with('success', 'Nomination submitted successfully! (Free for today)');
            } else {
                // Extra nomination → redirect to payment
                return redirect()->route('nomination.pay', [
                    'nominee_id' => $existing->id
                ])->with('info', 'First nomination is free today. Extra nominations cost KSh 10.');
            }
        } else {
            // First nomination ever → create in nominations table
            Nomination::create([
                'nominee_id' => $nomineeRecord->id, // Link to nominee
                'nominee_type' => $request->nominee_type,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'category' => $request->category,
                'reason' => $request->reason,
                'image' => $nomineeRecord->image,
                'nomination_count' => 1,
                'last_free_nomination' => $now,
            ]);

            return redirect()->route('nomination.create')
                ->with('success', 'Nomination submitted successfully! (Free)');
        }
    }

    /**
     * Show payment page for extra nominations
     */
    public function pay(Request $request, $nominee_id)
    {
        $nominee = Nomination::findOrFail($nominee_id);
        return view('events.pay_nomination', compact('nominee'));
    }

    /**
     * Process M-Pesa payment for extra nominations
     */
    public function processPayment(Request $request, $nominee_id)
    {
        $request->validate([
            'phone' => 'required|regex:/^\+2547\d{8}$/',
        ]);

        $nominee = Nomination::findOrFail($nominee_id);
        $phone = $request->phone;
        $amount = 10; // KSh 10 per extra nomination

        // TODO: Integrate Safaricom M-Pesa STK Push API
        // Example pseudo-code:
        // $response = Mpesa::stkPush([
        //     'phone' => $phone,
        //     'amount' => $amount,
        //     'account_reference' => 'Nomination',
        //     'transaction_desc' => "Extra nomination for {$nominee->name}",
        //     'callback_url' => route('mpesa.callback'),
        // ]);

        // Increment nomination count after initiating payment
        $nominee->increment('nomination_count');

        return redirect()->route('nomination.create')
            ->with('success', "Payment of KSh $amount initiated! Complete the M-Pesa prompt on your phone.");
    }
}