<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category; // Don't forget this
use Illuminate\Http\Request;

class EventController extends Controller
{
    // List upcoming events
    public function index()
    {
        $events = Event::where('event_date', '>=', now())
                       ->orderBy('event_date', 'asc')
                       ->get();

        $featuredEvent = $events->first();

        return view('events.index', compact('events', 'featuredEvent'));
    }

    // Show single event
    public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('events.show', compact('event'));
    }

    // Home page with categories
   
public function home()
{
    $categories = Category::all(); 
    return view('events.home', compact('categories')); 
}

    // Show nomination page for a specific category
    public function nominateCategory($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        return view('nomination', compact('category'));
    }
}