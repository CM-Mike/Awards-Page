<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Award Platform</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script src="https://cdn.tailwindcss.com"></script>

   <style>
/* BODY */
body {
    background: #ffffff; /* pure white background */
    font-family: 'Poppins', sans-serif;
    color: #0b1c2d; /* dark midnight blue text for readability */
}

/* GLASS EFFECT TILES AND BANNERS */
.glass, .glass-card, .glass-tile, .banner-card {
    backdrop-filter: blur(16px);
    background: rgba(11, 28, 45, 0.85); /* semi-transparent midnight blue */
    border: 1px solid rgba(255, 215, 0, 0.25); /* subtle gold border accent */
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2); /* soft shadow */
    border-radius: 1rem;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.glass-card:hover, .glass-tile:hover, .banner-card:hover {
    transform: scale(1.05);
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.25);
}

/* GOLD TEXT */
.gold-text {
    color: #FFD700;
}

/* NAV LINKS */
.nav-link {
    position: relative;
    transition: 0.3s ease;
    color: #ffffff; /* navbar links visible on midnight blue */
}

.nav-link::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: -5px;
    width: 0%;
    height: 2px;
    background: #FFD700;
    transition: 0.3s ease;
}

.nav-link:hover::after {
    width: 100%;
}

.nav-link:hover {
    color: #FFD700;
}

/* MOBILE MENU ANIMATION */
.mobile-menu {
    transition: all 0.3s ease-in-out;
}

/* HERO FLOATING IMAGE ANIMATION */
@keyframes float {
    0% { transform: translateY(0px); }
    50% { transform: translateY(-15px); }
    100% { transform: translateY(0px); }
}

.animate-float {
    animation: float 4s ease-in-out infinite;
}

/* FOOTER AND NAVBAR (glass dark) */
nav, footer {
    background: rgba(11, 28, 45, 0.95); /* almost solid midnight blue */
    backdrop-filter: blur(16px);
    border-bottom: 1px solid rgba(255, 215, 0, 0.25);
    border-top: 1px solid rgba(255, 215, 0, 0.25);
    color: #ffffff;
}

/* TEXT INSIDE TILES/BANNERS */
.glass-card h2, .glass-card h3, .glass-tile h3, .banner-card h2, .banner-card h3 {
    color: #FFD700; /* golden headings inside tiles */
}

.glass-card p, .glass-tile p, .banner-card p {
    color: #000000; /* light gray text for readability */
}
</style>
    @stack('styles')
    
</head>

<body class="text-white">

<!-- NAVBAR -->
<nav class="glass fixed w-full z-50 top-0">
    <div class="container mx-auto flex justify-between items-center px-6 py-4">

        <!-- Logo -->
        <div class="text-2xl font-bold gold-text animate-pulse">
            🏆 Award Platform
        </div>

        <!-- Desktop Menu -->
        <div class="hidden md:flex space-x-8">
            <a href="/home" class="nav-link">Home</a>
            <a href="/about" class="nav-link">About</a>
            <a href="/nomination" class="nav-link">Nominations</a>
            <a href="/events" class="nav-link">Events</a>
            <a href="/contact" class="nav-link">Contact</a>
        </div>

        <!-- Hamburger -->
        <div class="md:hidden">
            <button id="menuBtn" class="focus:outline-none">
                <svg class="w-8 h-8 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobileMenu" class="mobile-menu hidden md:hidden glass px-6 pb-6">
        <a href="/" class="block py-2 nav-link">Home</a>
        <a href="/about" class="block py-2 nav-link">About</a>
        <a href="/nominations" class="block py-2 nav-link">Nominations</a>
        <a href="/events" class="block py-2 nav-link">Events</a>
        <a href="/contact" class="block py-2 nav-link">Contact</a>
    </div>
</nav>

<!-- PAGE CONTENT -->
<main class="pt-28 min-h-screen container mx-auto px-6">
    @yield('content')
</main>

<!-- FOOTER -->
<footer class="glass mt-20 py-10 px-6">
    <div class="container mx-auto grid md:grid-cols-3 gap-10 text-center md:text-left">

        <!-- Logo + Description -->
        <div>
            <h2 class="text-2xl font-bold gold-text">🏆 Award Platform</h2>
            <p class="mt-4 text-gray-200">
                Celebrating excellence, recognizing talent, and honoring outstanding achievements 
                across industries and communities.
            </p>
        </div>

        <!-- Quick Links -->
        <div>
            <h3 class="gold-text text-xl font-semibold mb-4">Quick Links</h3>
            <div class="space-y-2">
                <a href="/home" class="block nav-link">Home</a>
                <a href="/about" class="block nav-link">About</a>
                <a href="/events" class="block nav-link">Events</a>
                <a href="/contact" class="block nav-link">Contact</a>
            </div>
        </div>

        <!-- Social -->
        <div>
    <h3 class="gold-text text-xl font-semibold mb-4">Follow Us</h3>
    <div class="flex justify-center md:justify-start space-x-5 text-2xl">
        <!-- Facebook -->
        <a href="https://facebook.com/yourpage" target="_blank" class="hover:text-yellow-400 transition">
            <i class="fab fa-facebook-f"></i>
        </a>

        <!-- TikTok -->
        <a href="https://tiktok.com/@yourhandle" target="_blank" class="hover:text-yellow-400 transition">
            <i class="fab fa-tiktok"></i>
        </a>

        <!-- Instagram -->
        <a href="https://instagram.com/yourhandle" target="_blank" class="hover:text-yellow-400 transition">
            <i class="fab fa-instagram"></i>
        </a>

        <!-- Twitter -->
        <a href="https://twitter.com/yourhandle" target="_blank" class="hover:text-yellow-400 transition">
            <i class="fab fa-twitter"></i>
        </a>
    </div>
</div>
    <div class="text-center mt-8 border-t border-yellow-400 pt-4 text-gray-300">
        © {{ date('Y') }} Award Platform. All Rights Reserved.
    </div>
</footer>

<!-- SCRIPT -->
<script>
    const menuBtn = document.getElementById('menuBtn');
    const mobileMenu = document.getElementById('mobileMenu');

    menuBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });
</script>

</body>
</html>