<?php

namespace App\Http\Controllers\Admin; // This must match the folder path exactly

use App\Http\Controllers\Controller;
use App\Models\{Event, Category, Nominee, Vote};

class DashboardController extends Controller
{
    public function index()
    {
        $events = Event::count();
        $categories = Category::count();
        $nominees = Nominee::count();
        $votes = Vote::count();

        // Getting the latest activity with counts
        $latestNominees = Nominee::with('category')->withCount('votes')->latest()->take(5)->get();

        // Data for the Gold Line Chart
        $categoriesNames = Category::pluck('name')->toArray();
        $votesPerCategory = Category::withCount('votes')->pluck('votes_count')->toArray();

        return view('admin.dashboard', compact(
            'events', 'categories', 'nominees', 'votes', 
            'latestNominees', 'categoriesNames', 'votesPerCategory'
        ));
    }
}