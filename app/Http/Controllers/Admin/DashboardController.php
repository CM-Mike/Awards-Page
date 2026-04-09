<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Nominee;
use App\Models\Vote;
use App\Models\Event;

class DashboardController extends Controller
{
    public function index()
    {
        // Basic Statistics
        $events     = Event::count();
        $categories = Category::count();
        $nominees   = Nominee::count();
        $votes      = Vote::count();

        // TEMPORARY BYPASS - Recent Spotlight
        // (We removed withCount to stop the error for now)
        $latestNominees = Nominee::with('category')
            ->latest()
            ->take(5)
            ->get();

        // TEMPORARY BYPASS - Chart Data
        // (Empty array so the chart doesn't break)
        $categoriesNames   = Category::pluck('name')->toArray();
        $votesPerCategory  = [];

        return view('admin.dashboard', compact(
            'events',
            'categories',
            'nominees',
            'votes',
            'latestNominees',
            'categoriesNames',
            'votesPerCategory'
        ));
    }
}