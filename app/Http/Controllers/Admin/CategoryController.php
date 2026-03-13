<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Event;

class CategoryController extends Controller
{
    public function index()
    {
        // Fetch categories and events
        $categories = Category::latest()->paginate(10);
        $events = Event::all();

        // Pass both to the view
        return view('admin.categories.index', compact('categories', 'events'));
    }
}