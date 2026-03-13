@extends('layouts.app')

@section('content')

<!-- HERO BANNER -->

<section class="relative py-14 overflow-hidden bg-midnightblue rounded-2xl">
    <div class="container mx-auto px-6 md:flex md:items-center md:justify-between gap-10">

        <!-- LEFT IMAGE (Trophy with celebration) -->
        <div class="md:w-1/2 flex justify-center md:justify-start">
            <img src="{{ asset('images/trophy.png') }}" 
                 alt="Celebratory Trophy" 
                 class="w-72 md:w-80 transform -rotate-6 shadow-2xl animate-float">
        </div>

        <!-- RIGHT TEXT -->
        <div class="md:w-1/2 text-center md:text-left space-y-6 text-white">
            <h1 class="text-4xl md:text-5xl font-bold text-yellow-400 leading-tight">
                Celebrate Excellence <br>
                At Our Award Events
            </h1>
            <p class="text-gray-200 text-lg md:text-xl max-w-lg">
                Join us as we honor outstanding achievements, innovation, 
                and leadership across industries with prestigious awards.
            </p>
            <a href="#about" 
               class="inline-block bg-yellow-400 text-black px-6 py-3 rounded-full font-semibold hover:scale-105 transition duration-300 shadow-lg">
               Learn More
            </a>
        </div>

    </div>

    <!-- Background glow circle -->
    <div class="absolute -top-20 -right-20 w-72 h-72 bg-yellow-400 opacity-10 rounded-full blur-3xl"></div>
</section>
<!-- ABOUT & WHY US SECTION -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-6 md:flex md:items-start md:gap-10 flex-col md:flex-row">
        
        <!-- LEFT: Image -->
        <div class="md:w-1/2 mb-10 md:mb-0">
    <img src="{{ asset('images/about-hero.png') }}" 
         alt="About Us" 
         class="w-full h-64 md:h-80 rounded-2xl shadow-2xl object-cover">
</div>

        <!-- RIGHT: About & Why Us -->
        <div class="md:w-1/2 space-y-6">
            <h2 class="text-3xl font-bold text-yellow-400">About Us</h2>
            <p class="text-gray-800 leading-relaxed">
                Our award platform recognizes the finest achievements in diverse sectors, 
                honoring individuals, teams, and organizations that inspire progress and excellence. 
                Through annual ceremonies and events, we foster networking, innovation, and global recognition.
            </p>

            <h3 class="text-2xl font-semibold text-yellow-400 mt-6">Why Choose Us?</h3>
            <p class="text-gray-800 leading-relaxed">
                We ensure transparency, credibility, and prestige in awarding. Our judges are industry leaders, 
                our events are meticulously organized, and every winner is celebrated with dignity and grandeur.
            </p>
        </div>
    </div>
</section>

<!-- MAJOR AWARDS TILES (3x3) -->
<section class="py-16 bg-gradient-to-b from-[#f7f7f7] to-[#ffffff]">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-yellow-400">Major Awards This Season</h2>
            <p class="text-gray-800 mt-3">Recognizing the outstanding achievers of the season.</p>
        </div>

        <div class="grid sm:grid-cols-1 md:grid-cols-3 gap-8">
            @for($i = 1; $i <= 9; $i++)
            <div class="glass-tile overflow-hidden hover:scale-105 transition duration-300">
                <img src="{{ asset('images/award'.$i.'.jpg') }}" alt="Award {{ $i }}" class="w-full h-56 object-cover">
                <div class="p-6 text-center">
                    <h3 class="text-xl font-semibold text-yellow-400 mb-2">Award {{ $i }}</h3>
                    <p class="text-gray-200">Description of Award {{ $i }} goes here.</p>
                </div>
            </div>
            @endfor
        </div>
    </div>
</section>

<!-- FEATURED AWARDEES -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-yellow-400">Featured Awardees</h2>
            <p class="text-gray-800 mt-3">Highlighting some of the remarkable achievers honored by our awards.</p>
        </div>

        <div class="grid sm:grid-cols-1 md:grid-cols-3 gap-8">
            @for($i = 1; $i <= 6; $i++)
            <div class="glass-tile overflow-hidden hover:scale-105 transition duration-300">
                <img src="{{ asset('images/awardee'.$i.'.jpg') }}" alt="Awardee {{ $i }}" class="w-full h-56 object-cover">
                <div class="p-6 text-center">
                    <h3 class="text-xl font-semibold text-yellow-400 mb-2">Awardee {{ $i }}</h3>
                    <p class="text-gray-200">Outstanding contributions in their field.</p>
                </div>
            </div>
            @endfor
        </div>
    </div>
</section>

<!-- EXTRA SECTION: AWARD INSIGHTS -->
<section class="relative py-20 bg-gradient-to-b from-[#0d2c6c] to-[#0A1F44] overflow-hidden">

    <!-- Soft Glow Background -->
    <div class="absolute top-0 left-1/4 w-72 h-72 bg-yellow-400/20 rounded-full blur-[120px] animate-pulse"></div>
    <div class="absolute bottom-0 right-1/4 w-72 h-72 bg-cyan-400/20 rounded-full blur-[120px] animate-pulse delay-1000"></div>

    <div class="relative container mx-auto px-6">
        
        <div class="grid md:grid-cols-2 gap-12 items-center">

            <!-- TEXT SIDE -->
            <div class="opacity-0 translate-y-10 transition-all duration-1000 ease-out award-animate">
                
                <div class="backdrop-blur-xl bg-white/10 border border-white/20 p-10 rounded-3xl shadow-2xl">
                    
                    <h2 class="text-3xl md:text-4xl font-bold text-yellow-400 mb-6">
                        Award Insights & Trends
                    </h2>

                    <p class="text-gray-200 leading-relaxed">
                        Explore the latest trends in award recognition, emerging achievers to watch,
                        and strategies for maximizing the impact of award ceremonies. 
                        Stay inspired and connected with the world of excellence.
                    </p>

                    <a href="#events"
                       class="inline-block mt-8 bg-yellow-400 text-black px-6 py-3 rounded-full font-semibold 
                              hover:scale-105 transition duration-300 shadow-lg">
                        Learn More
                    </a>
                </div>

            </div>

            <!-- IMAGE SIDE -->
            <div class="flex justify-center opacity-0 translate-y-10 transition-all duration-1000 delay-200 ease-out award-animate">
                
                <div class="relative backdrop-blur-xl bg-white/10 border border-white/20 
                            rounded-3xl p-5 shadow-2xl max-w-md w-full">
                    
                    <img src="{{ asset('images/awards.png') }}" 
                         alt="Award Insights"
                         class="w-full h-64 md:h-72 object-cover rounded-2xl 
                                transition-transform duration-700 hover:scale-105">
                </div>

            </div>

        </div>

    </div>

</section>


<!-- Scroll Animation Script -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    const elements = document.querySelectorAll(".award-animate");

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

@endsection

@push('styles')
<style>
    .bg-midnightblue {
    background-color: #0b1c2d;
}

/* Floating animation for trophy */
@keyframes float {
    0% { transform: translateY(0px); }
    50% { transform: translateY(-15px); }
    100% { transform: translateY(0px); }
}

.animate-float {
    animation: float 4s ease-in-out infinite;
}
/* GLASS TILE EFFECT */
.glass-tile {
    backdrop-filter: blur(16px);
    background: rgba(11,28,45,0.85); /* midnight blue glass */
    border: 1px solid rgba(255,215,0,0.25);
    box-shadow: 0 8px 32px rgba(0,0,0,0.2);
    border-radius: 1rem;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.glass-tile:hover {
    transform: scale(1.05);
    box-shadow: 0 12px 40px rgba(0,0,0,0.25);
}

/* FLOATING ANIMATION (if any hero images) */
@keyframes float {
    0% { transform: translateY(0px); }
    50% { transform: translateY(-15px); }
    100% { transform: translateY(0px); }
}
.animate-float {
    animation: float 4s ease-in-out infinite;
}

/* TEXT COLORS */
.glass-tile h3 { color: #FFD700; }
.glass-tile p { color: #e0e0e0; }

/* RESPONSIVE GRIDS */
@media (max-width: 768px) {
    .grid { grid-template-columns: 1fr !important; }
    .md\\:flex { flex-direction: column !important; }
}
</style>
@endpush