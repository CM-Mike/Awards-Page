<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Event;
use App\Models\Category;
use App\Models\Nominee;
use App\Models\Vote;

class DashboardController extends Controller
{
    public function index()
    {
        $events = Event::count();
        $categories = Category::count();
        $nominees = Nominee::count();
        $votes = Vote::count();

        $latestNominees = Nominee::latest()->take(5)->get();

        // Categories for charts
        $categoriesNames = Category::pluck('name')->toArray();

        // Votes per category
        // Use try/catch in case the relation doesn't exist
        try {
            $votesPerCategory = Category::withCount('votes')->pluck('votes_count')->toArray();
        } catch (\Exception $e) {
            $votesPerCategory = array_fill(0, count($categoriesNames), 0);
        }

        // Nominees per category (if category_id exists)
        try {
            $nomineesPerCategory = Category::withCount('nominees')->pluck('nominees_count')->toArray();
        } catch (\Exception $e) {
            $nomineesPerCategory = array_fill(0, count($categoriesNames), 0);
        }

        // Votes trend over time
        $voteDates = Vote::select(DB::raw("DATE(created_at) as date"))
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('date')
            ->toArray();

        $votesOverTime = Vote::select(DB::raw("COUNT(*) as count"))
            ->groupBy(DB::raw("DATE(created_at)"))
            ->orderBy(DB::raw("DATE(created_at)"))
            ->pluck('count')
            ->toArray();

        // Top nominees by votes
        $topNominees = Nominee::withCount('votes')->orderByDesc('votes_count')->take(5)->get();
        $topNomineesNames = $topNominees->pluck('name')->toArray();
        $topNomineesVotes = $topNominees->pluck('votes_count')->toArray();

        // Nominees growth over time
        $nomineesOverTime = Nominee::select(
            DB::raw("DATE(created_at) as date"),
            DB::raw("COUNT(*) as count")
        )
        ->groupBy('date')
        ->orderBy('date')
        ->get();

        $dates = $nomineesOverTime->pluck('date')->toArray();
        $counts = $nomineesOverTime->pluck('count')->toArray();

        return view('admin.dashboard', compact(
            'events', 'categories', 'nominees', 'votes', 'latestNominees',
            'categoriesNames', 'votesPerCategory', 'nomineesPerCategory',
            'voteDates', 'votesOverTime', 'topNomineesNames', 'topNomineesVotes',
            'dates', 'counts'
        ));
    }
}