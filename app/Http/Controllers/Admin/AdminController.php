<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Category;
use App\Models\Nominee;
use App\Models\Vote;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Summary counts
        $events = Event::count();
        $categories = Category::count();
        $nominees = Nominee::count();
        $votes = Vote::count();

        // Latest nominees for table
        $latestNominees = Nominee::latest()->take(5)->get();

        // Votes per category for chart
       $categoriesData = Category::with('nominees.votes')->get();

    $categoriesNames = $categoriesData->pluck('name');
    $votesPerCategory = $categoriesData->map(function($category){
        // $category->nominees is a collection
        return $category->nominees->reduce(function($carry, $nominee){
            // $nominee->votes is a collection
            return $carry + $nominee->votes->count();
        }, 0);
    });


        return view('admin.dashboard', compact(
            'events','categories','nominees','votes',
            'latestNominees','categoriesNames','votesPerCategory'
        ));
    }
}