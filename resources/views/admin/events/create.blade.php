@extends('admin.layout.app')

@section('content')
<h1 class="text-3xl font-bold mb-6">{{ isset($event) ? 'Edit Event' : 'Add Event' }}</h1>

<form action="{{ isset($event) ? route('admin.events.update', $event->id) : route('admin.events.store') }}" 
      method="POST" 
      enctype="multipart/form-data" 
      class="space-y-4">
    @csrf
    @if(isset($event))
        @method('PUT')
    @endif

    <!-- Title -->
    <div>
        <label class="block mb-1">Title</label>
        <input type="text" name="title" value="{{ old('title', $event->title ?? '') }}" 
               class="w-full border px-4 py-2 rounded" required>
    </div>

    <!-- Description -->
    <div>
        <label class="block mb-1">Description</label>
        <textarea name="description" class="w-full border px-4 py-2 rounded">{{ old('description', $event->description ?? '') }}</textarea>
    </div>

    <!-- Location -->
    <div>
        <label class="block mb-1">Location</label>
        <input type="text" name="location" value="{{ old('location', $event->location ?? '') }}" 
               class="w-full border px-4 py-2 rounded">
    </div>

    <!-- Date -->
    <div>
        <label class="block mb-1">Date</label>
        <input type="date" name="event_date" value="{{ old('event_date', $event->event_date ?? '') }}" 
               class="w-full border px-4 py-2 rounded" required>
    </div>

    <!-- Image -->
    <div>
        <label class="block mb-1">Event Image</label>
        <input type="file" name="image" class="w-full border px-4 py-2 rounded">
        @if(isset($event) && $event->image)
            <p class="mt-2">Current Image:</p>
            <img src="{{ asset('storage/events/' . $event->image) }}" alt="Event Image" class="w-32 h-32 object-cover rounded mt-1">
        @endif
    </div>

    <!-- Submit Button -->
    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
        {{ isset($event) ? 'Update' : 'Save' }}
    </button>
</form>
@endsection