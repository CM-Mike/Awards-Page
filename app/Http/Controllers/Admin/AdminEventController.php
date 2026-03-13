<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Storage;

class AdminEventController extends Controller
{
    // Show all events
    public function index()
    {
        $events = Event::latest()->get();
        return view('admin.events.index', compact('events'));
    }

    // Show form to create new event
    public function create()
    {
        return view('admin.events.create');
    }

    // Store new event
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_date' => 'required|date',
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only('title', 'description', 'event_date', 'location');

        // Handle image upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/events', $filename);
            $data['image'] = $filename;
        }

        Event::create($data);

        return redirect()->route('admin.events')->with('success', 'Event created successfully.');
    }

    // Show edit form
    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    // Update existing event
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_date' => 'required|date',
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only('title', 'description', 'event_date', 'location');

        // Replace image if new one is uploaded
        if ($request->hasFile('image')) {
            if ($event->image && Storage::exists('public/events/' . $event->image)) {
                Storage::delete('public/events/' . $event->image);
            }
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/events', $filename);
            $data['image'] = $filename;
        }

        $event->update($data);

        return redirect()->route('admin.events')->with('success', 'Event updated successfully.');
    }

    // Delete event
    public function destroy(Event $event)
    {
        if ($event->image && Storage::exists('public/events/' . $event->image)) {
            Storage::delete('public/events/' . $event->image);
        }

        $event->delete();
        return redirect()->route('admin.events')->with('success', 'Event deleted successfully.');
    }
}