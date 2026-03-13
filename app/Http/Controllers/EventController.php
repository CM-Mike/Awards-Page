<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Home Page 
     * Fetches categories to populate the "Explore Categories" grid.
     */
    public function home()
    {
        // Fetch categories with subcategories to show the "Available Awards" count
        $categories = Category::with('subcategories')->get();

        return view('events.home', compact('categories')); 
    }

    /**
     * Dedicated Categories Page
     * Shows the full list of all 17 categories and their specific awards.
     */
    public function categoriesPage()
    {
        $categories = Category::with('subcategories')->get();

        return view('events.categories', compact('categories'));
    }

    /**
     * List all upcoming events.
     */
    public function index()
    {
        $events = Event::where('event_date', '>=', now())
                       ->orderBy('event_date', 'asc')
                       ->get();

        $featuredEvent = $events->first();

        return view('events.index', compact('events', 'featuredEvent'));
    }

    /**
     * Show a single event detail.
     */
    public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('events.show', compact('event'));
    }

    /**
     * Show nomination page for a specific category (slug-based).
     */
    public function nominateCategory($slug)
    {
        $category = Category::where('slug', $slug)->with('subcategories')->firstOrFail();
        return view('nomination', compact('category'));
    }
}