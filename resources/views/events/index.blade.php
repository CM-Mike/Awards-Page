@extends('layouts.app')

@section('content')

<!-- HERO BANNER -->
<section class="relative py-20 overflow-hidden">
    <div class="container mx-auto px-6 grid md:grid-cols-2 gap-10 items-center">

        <!-- LEFT CONTENT -->
        <div class="space-y-6">
            <h1 class="text-4xl md:text-5xl font-bold text-yellow-400 leading-tight">
                Celebrate Excellence <br>
                At Our Award Events
            </h1>
            <p class="text-gray-300 text-lg">
                Join us as we honor outstanding achievements, innovation,
                and leadership across industries.
            </p>
            <a href="#events"
               class="inline-block bg-yellow-400 text-black px-6 py-3 rounded-full font-semibold hover:scale-105 transition duration-300 shadow-lg">
               Explore Events
            </a>
        </div>

        <!-- RIGHT FLOATING IMAGE -->
<div class="relative flex justify-center">
    <img src="{{ asset('images/about-hero.png') }}"
         alt="Award Event"
         class="w-80 md:w-96 h-60 md:h-72 animate-float drop-shadow-2xl object-contain">
</div>
    </div>

    <!-- Background Glow -->
    <div class="absolute -top-20 -right-20 w-96 h-96 bg-yellow-400 opacity-10 rounded-full blur-3xl"></div>
</section>

<!-- FEATURE TILES 2x2 -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-6">

        <!-- Section Title -->
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-yellow-400">
                Why Attend Our Events
            </h2>
            <p class="text-gray-700 mt-3">
                Experience excellence, networking, and recognition like never before.
            </p>
        </div>

        <!-- Tiles Container (white) -->
        <div class="p-4 md:p-8">
            <div class="grid sm:grid-cols-1 md:grid-cols-2 gap-10">

                <!-- Tile 1 -->
                <div class="glass-tile rounded-2xl overflow-hidden hover:scale-105 transition duration-300 bg-white">
                    <img src="{{ asset('images/network.png') }}" class="w-full h-56 object-cover rounded-t-2xl">
                    <div class="p-6 text-center">
                        <h3 class="text-xl font-semibold text-black mb-3">Elite Networking</h3>
                        <p class="text-gray-700">Connect with industry leaders, innovators, and professionals.</p>
                    </div>
                </div>

                <!-- Tile 2 -->
                <div class="glass-tile rounded-2xl overflow-hidden hover:scale-105 transition duration-300 bg-white">
                    <img src="{{ asset('images/recognize.png') }}" class="w-full h-56 object-cover rounded-t-2xl">
                    <div class="p-6 text-center">
                        <h3 class="text-xl font-semibold text-black mb-3">Global Recognition</h3>
                        <p class="text-gray-700">Celebrate achievements and showcase excellence worldwide.</p>
                    </div>
                </div>

                <!-- Tile 3 -->
                <div class="glass-tile rounded-2xl overflow-hidden hover:scale-105 transition duration-300 bg-white">
                    <img src="{{ asset('images/innovation.png') }}" class="w-full h-56 object-cover rounded-t-2xl">
                    <div class="p-6 text-center">
                        <h3 class="text-xl font-semibold text-black mb-3">Innovation Showcase</h3>
                        <p class="text-gray-700">Discover groundbreaking ideas shaping the future.</p>
                    </div>
                </div>

                <!-- Tile 4 -->
                <div class="glass-tile rounded-2xl overflow-hidden hover:scale-105 transition duration-300 bg-white">
                    <img src="{{ asset('images/grand.png') }}" class="w-full h-56 object-cover rounded-t-2xl">
                    <div class="p-6 text-center">
                        <h3 class="text-xl font-semibold text-black mb-3">Grand Celebration</h3>
                        <p class="text-gray-700">Enjoy unforgettable award nights filled with prestige.</p>
                    </div>
                </div>

            </div>
        </div>

    </div>
</section>

<!-- UPCOMING EVENTS GRID -->
<div id="events" class="min-h-screen bg-gradient-to-br from-[#0A1F44] via-[#0d2c6c] to-[#000814] py-16">
    <div class="container mx-auto px-4">

        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-yellow-400 mb-3">Upcoming Events</h2>
            <p class="text-gray-300">Discover our upcoming award ceremonies and special events.</p>
        </div>

        <div class="grid gap-8 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3">

            @forelse($events as $event)
                <a href="{{ route('events.show', $event->id) }}" class="group transition duration-300">
                    <div class="glass-card rounded-2xl overflow-hidden hover:scale-105 transition duration-300">
                        @if($event->banner_image)
                            <img src="{{ asset('storage/' . $event->banner_image) }}" 
                                 alt="{{ $event->title }}" 
                                 class="w-full h-56 object-cover">
                        @endif
                        <div class="p-6">
                            <h3 class="text-2xl font-semibold text-white mb-3 group-hover:text-yellow-400 transition">
                                {{ $event->title }}
                            </h3>
                            <p class="text-gray-300 mb-2">
                                📅 {{ \Carbon\Carbon::parse($event->event_date)->format('F j, Y, g:i A') }}
                            </p>
                            @if($event->location)
                                <p class="text-gray-400 mb-4">📍 {{ $event->location }}</p>
                            @endif
                            <span class="inline-block bg-yellow-400 text-black px-4 py-2 rounded-full text-sm font-semibold">
                                View Details →
                            </span>
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-full text-center">
                    <div class="glass-card p-10 rounded-2xl">
                        <h3 class="text-2xl text-white mb-4">Nominations Starts Now!</h3>
                        <p class="text-gray-300">“Shine the spotlight! Nominate yourself, your friends, or your company for our awards and be recognized for excellence.</p>
                    </div>
                </div>
            @endforelse

        </div>
    </div>
</div>

<!-- FEATURED EVENT BANNER -->
@if(isset($featuredEvent))
<section class="relative py-20 my-12 bg-gradient-to-r from-[#0d2c6c] to-[#0A1F44] rounded-3xl overflow-hidden shadow-2xl">
    <div class="container mx-auto px-6 md:flex items-center gap-10">

        <!-- LEFT CONTENT -->
        <div class="md:w-1/2 text-white space-y-6">
            <h2 class="text-4xl font-bold text-yellow-400">{{ $featuredEvent->title }}</h2>
            <p class="text-gray-300 text-lg">{{ $featuredEvent->description }}</p>
            <p class="text-gray-300">
                📅 {{ \Carbon\Carbon::parse($featuredEvent->event_date)->format('F j, Y, g:i A') }}
            </p>
            @if($featuredEvent->location)
            <p class="text-gray-300">📍 {{ $featuredEvent->location }}</p>
            @endif
            <a href="{{ route('events.show', $featuredEvent->id) }}"
               class="inline-block bg-yellow-400 text-black px-6 py-3 rounded-full font-semibold hover:scale-105 transition duration-300 shadow-lg">
               View Event Details
            </a>
        </div>

        <!-- RIGHT IMAGE -->
        <div class="md:w-1/2 relative">
            @if($featuredEvent->banner_image)
            <img src="{{ asset('storage/' . $featuredEvent->banner_image) }}" 
                 alt="{{ $featuredEvent->title }}" 
                 class="w-full h-96 object-cover rounded-2xl drop-shadow-2xl">
            @endif
        </div>

    </div>
    <div class="absolute -top-20 -right-20 w-72 h-72 bg-yellow-400 opacity-10 rounded-full blur-3xl"></div>
</section>
@endif

@endsection

@push('styles')
<style>
/* GLASS EFFECT */
.glass-card, .glass-tile {
    backdrop-filter: blur(12px);
    background: rgba(11,28,45,0.85); /* midnight blue glass */
    border: 1px solid rgba(255,215,0,0.25);
    box-shadow: 0 8px 32px rgba(0,0,0,0.2);
    border-radius: 1rem;
}

/* HOVER EFFECT */
.glass-card:hover, .glass-tile:hover {
    transform: scale(1.05);
    box-shadow: 0 12px 40px rgba(0,0,0,0.25);
}

/* FLOATING HERO IMAGE */
@keyframes float {
    0% { transform: translateY(0px); }
    50% { transform: translateY(-15px); }
    100% { transform: translateY(0px); }
}

.animate-float {
    animation: float 4s ease-in-out infinite;
}

/* TEXT COLORS */
.glass-card h3, .glass-tile h3 { color: #FFD700; }
.glass-card p, .glass-tile p { color: #e0e0e0; }

/* RESPONSIVE GRID TILES */
@media (max-width: 768px) {
    .grid { grid-template-columns: 1fr !important; }
}

</style>
@endpush