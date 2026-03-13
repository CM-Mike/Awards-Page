@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-10">
    <a href="{{ route('events.index') }}" class="text-blue-400 hover:underline mb-4 inline-block">&larr; Back to Events</a>
    
    <div class="glass-card p-8 rounded-xl shadow-lg">
        @if($event->banner_image)
            <img src="{{ asset('storage/' . $event->banner_image) }}" alt="{{ $event->title }}" class="w-full h-64 object-cover rounded-lg mb-6">
        @endif
        
        <h1 class="text-4xl font-bold mb-4 text-yellow-500">{{ $event->title }}</h1>
        <p class="text-gray-300 mb-2"><strong>Date:</strong> {{ \Carbon\Carbon::parse($event->event_date)->format('F j, Y, g:i A') }}</p>
        <p class="text-gray-300 mb-2"><strong>Location:</strong> {{ $event->location }}</p>
        <p class="text-gray-400 mt-4">{{ $event->description }}</p>
    </div>
</div>
@endsection