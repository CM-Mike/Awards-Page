@extends('layouts.app')

@section('content')

@php
$categories = collect([
    (object)['name' => 'Tech', 'slug' => 'tech', 'icon' => '💻', 'description' => 'Excellence in technology and innovation.'],
    (object)['name' => 'Music', 'slug' => 'music', 'icon' => '🎵', 'description' => 'Recognizing outstanding musical talents.'],
    (object)['name' => 'Influencer', 'slug' => 'influencer', 'icon' => '📱', 'description' => 'Honoring social media influencers.'],
    (object)['name' => 'Tech Below 30', 'slug' => 'tech-below-30', 'icon' => '🖥️', 'description' => 'Top young tech innovators under 30.'],
    (object)['name' => 'Arts', 'slug' => 'arts', 'icon' => '🎨', 'description' => 'Celebrating creative art talents.'],
    (object)['name' => 'Innovation', 'slug' => 'innovation', 'icon' => '🚀', 'description' => 'Innovative projects making impact.'],
    (object)['name' => 'Fashion', 'slug' => 'fashion', 'icon' => '👗', 'description' => 'Excellence in fashion and style.'],
    (object)['name' => 'Film', 'slug' => 'film', 'icon' => '🎬', 'description' => 'Outstanding achievements in cinema.'],
    (object)['name' => 'Literature', 'slug' => 'literature', 'icon' => '📚', 'description' => 'Honoring literary contributions.'],
    (object)['name' => 'Science', 'slug' => 'science', 'icon' => '🔬', 'description' => 'Recognizing scientific breakthroughs.'],
    (object)['name' => 'Sports', 'slug' => 'sports', 'icon' => '🏅', 'description' => 'Outstanding sports achievements.'],
    (object)['name' => 'Entrepreneurship', 'slug' => 'entrepreneurship', 'icon' => '💡', 'description' => 'Excellence in business ventures.'],
    (object)['name' => 'Gaming', 'slug' => 'gaming', 'icon' => '🎮', 'description' => 'Top gamers and gaming innovators.'],
    (object)['name' => 'Education', 'slug' => 'education', 'icon' => '🏫', 'description' => 'Outstanding contributions to education.'],
    (object)['name' => 'Photography', 'slug' => 'photography', 'icon' => '📷', 'description' => 'Excellence in photography.'],
    (object)['name' => 'Health', 'slug' => 'health', 'icon' => '🩺', 'description' => 'Recognizing health initiatives.'],
    (object)['name' => 'Environment', 'slug' => 'environment', 'icon' => '🌱', 'description' => 'Impactful environmental work.'],
    (object)['name' => 'Podcast', 'slug' => 'podcast', 'icon' => '🎙️', 'description' => 'Top podcasts and creators.'],
    (object)['name' => 'Journalism', 'slug' => 'journalism', 'icon' => '📰', 'description' => 'Outstanding journalism work.'],
    (object)['name' => 'AI & Robotics', 'slug' => 'ai-robotics', 'icon' => '🤖', 'description' => 'Excellence in AI and robotics.'],
]);
@endphp

<section class="relative bg-slate-950 pt-24 pb-32 overflow-hidden">
    <div class="absolute top-0 left-1/4 w-96 h-96 bg-orange-600/20 rounded-full blur-[120px] animate-pulse"></div>
    <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-cyan-600/10 rounded-full blur-[120px]"></div>

    <div class="relative max-w-7xl mx-auto px-4 text-center">
        <div class="inline-block px-4 py-1.5 mb-8 border border-orange-500/30 rounded-full bg-orange-500/10 backdrop-blur-md">
            <span class="text-orange-400 text-xs font-black uppercase tracking-[0.3em]">Official 2026 Excellence Awards</span>
        </div>
        
        <h1 class="text-6xl md:text-8xl font-black text-white mb-8 tracking-tighter leading-none">
            CROWN THE <br>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 via-orange-500 to-pink-500 italic">UNSTOPPABLE.</span>
        </h1>

        <p class="max-w-2xl mx-auto text-slate-400 text-lg md:text-xl mb-12 font-medium leading-relaxed">
            Celebrating the digital pioneers and creative voices of 2026. <br>
            Select a category below to explore and nominate.
        </p>

        <div class="flex justify-center">
            <a href="#categories" class="group flex items-center gap-3 text-white font-bold uppercase tracking-widest text-sm hover:text-orange-500 transition-colors">
                View Categories 
                <svg class="w-5 h-5 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
            </a>
        </div>
    </div>
</section>

<section class="relative py-28 bg-gradient-to-br from-[#f8f9fb] via-[#fdf6f0] to-[#fff8f3] overflow-hidden">

    <!-- Soft Light Atmosphere -->
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,rgba(255,200,150,0.25),transparent_40%)]"></div>
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_bottom_right,rgba(255,170,120,0.2),transparent_40%)]"></div>

    <div class="relative max-w-7xl mx-auto px-6">

        <!-- Outer Glass Frame -->
        <div class="relative backdrop-blur-xl bg-white/40 border border-white/60 rounded-[3rem] p-10 md:p-16 shadow-[0_25px_60px_rgba(0,0,0,0.08)]">

            <div class="grid md:grid-cols-2 gap-16 items-center">

                <!-- LEFT IMAGE -->
                <div class="relative opacity-0 translate-y-10 transition-all duration-1000 ease-out featured-animate">

                    <div class="relative rounded-3xl overflow-hidden shadow-2xl group">

                        <!-- Light Reflection Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-tr from-white/20 via-transparent to-transparent pointer-events-none"></div>

                        <img src="{{ asset('images/trophies.png') }}"
                             alt="Luxury Awards Trophy"
                             class="w-full h-[420px] md:h-[500px] object-cover transition-transform duration-700 group-hover:scale-105">

                    </div>

                </div>

                <!-- RIGHT CONTENT -->
                <div class="opacity-0 translate-y-10 transition-all duration-1000 delay-200 ease-out featured-animate">

                    <span class="text-sm font-semibold tracking-[0.3em] text-orange-500 uppercase">
                        Featured Spotlight
                    </span>

                    <h2 class="text-4xl md:text-6xl font-bold text-slate-900 mt-6 leading-tight">
                        Where 
                        <span class="italic font-serif text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-amber-400">
                            Vision
                        </span> 
                        Meets 
                        <span class="italic font-serif text-transparent bg-clip-text bg-gradient-to-r from-pink-500 to-orange-500">
                            Legacy
                        </span>
                    </h2>

                    <p class="text-slate-700 mt-8 text-lg leading-relaxed max-w-xl">
                        The 2026 Excellence Awards is more than recognition — it is a defining moment.
                        A stage illuminated for creators, innovators, and pioneers stepping into global impact.
                    </p>

                    <p class="text-slate-600 mt-5 leading-relaxed max-w-xl">
                        Every nomination represents brilliance under spotlight — courage, artistry,
                        and transformation shaped into history.
                    </p>

                    <div class="mt-10">
                        <a href="#categories"
                           class="inline-flex items-center gap-4 px-8 py-4 rounded-full 
                           bg-white/70 backdrop-blur-lg border border-white/80 
                           shadow-lg text-slate-900 font-semibold 
                           hover:shadow-xl hover:scale-105 transition-all duration-300">

                            Explore Categories

                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                    </div>

                </div>

            </div>
        </div>

    </div>

</section>

<section id="categories" class="bg-slate-950 py-24 border-t border-slate-900">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
            <div>
                <h2 class="text-3xl font-black text-white uppercase italic tracking-tighter">The Trophies</h2>
                <div class="h-1 w-20 bg-gradient-to-r from-orange-500 to-pink-500 mt-2"></div>
            </div>
            <div class="text-slate-500 text-sm font-mono uppercase tracking-widest">
                {{ $categories->count() }} SELECT CATEGORIES
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($categories as $category)
            <a href="{{ route('nominate', $category->slug) }}" class="group relative bg-slate-900/40 border border-slate-800 p-10 rounded-[2.5rem] transition-all duration-500 hover:bg-slate-800/60 hover:-translate-y-2 hover:border-orange-500/50 overflow-hidden">
                <div class="absolute -inset-1 bg-gradient-to-r from-orange-600 to-pink-600 rounded-[2.5rem] blur opacity-0 group-hover:opacity-10 transition duration-500"></div>
                <div class="relative z-10">
                    <div class="flex justify-between items-start mb-8">
                        <div class="w-12 h-12 rounded-2xl bg-slate-800 flex items-center justify-center text-xl group-hover:bg-orange-500 group-hover:text-black transition-all duration-300">
                            {{ $category->icon }}
                        </div>
                        <div class="text-slate-700 group-hover:text-orange-500 transition-colors">
                            <svg class="w-6 h-6 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </div>
                    </div>
                    
                    <h3 class="text-2xl font-black text-white mb-3 tracking-tight">
                        {{ $category->name }}
                    </h3>
                    
                    <p class="text-slate-500 text-sm leading-relaxed mb-8 group-hover:text-slate-300 transition-colors">
                        {{ $category->description }}
                    </p>

                    <div class="flex items-center text-[10px] font-black uppercase tracking-[0.2em] text-slate-600 group-hover:text-orange-500 transition-colors">
                        Enter Category <span class="ml-2 opacity-0 group-hover:opacity-100 transition-opacity">→</span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>

<section class="bg-slate-900 py-20 border-t border-slate-800">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <p class="text-slate-500 font-mono text-sm uppercase tracking-[0.5em] mb-4">Official Verification</p>
        <h2 class="text-white text-xl md:text-2xl font-bold opacity-80 italic">
            "Honoring the creators who define our culture through innovation and authenticity."
        </h2>
    </div>
</section>

@endsection
<script>
document.addEventListener("DOMContentLoaded", function () {
    const elements = document.querySelectorAll(".featured-animate");

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.remove("opacity-0", "translate-y-10");
                entry.target.classList.add("opacity-100", "translate-y-0");
            }
        });
    }, { threshold: 0.3 });

    elements.forEach(el => observer.observe(el));
});
</script>