<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Award Platform | Luminous Edition</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,900;1,900&family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        :root {
            --bg-light: #FDFCF7;       /* Soft Cream/Champagne background */
            --accent-gold: #C5A059;    /* Refined Muted Gold */
            --text-main: #1A1A1A;      /* Deep Charcoal for readability */
        }

        body {
            background-color: var(--bg-light);
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--text-main);
            overflow-x: hidden;
        }

        /* LIGHT GLASSMORPHISM */
        .glass-nav {
            backdrop-filter: blur(12px);
            background: rgba(253, 252, 247, 0.8);
            border-bottom: 1px solid rgba(197, 160, 89, 0.1);
        }

        .logo-text {
            font-family: 'Playfair Display', serif;
            background: linear-gradient(to right, #1a1a1a, var(--accent-gold));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 900;
        }

        .nav-link {
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            color: #717171;
            transition: all 0.3s ease;
        }

        .nav-link:hover, .nav-link.active {
            color: var(--accent-gold);
        }

        .btn-gold {
            background-color: var(--accent-gold);
            color: white;
            box-shadow: 0 10px 20px rgba(197, 160, 89, 0.2);
            transition: all 0.4s ease;
        }

        .btn-gold:hover {
            background-color: #b38e4a;
            transform: translateY(-2px);
            box-shadow: 0 15px 30px rgba(197, 160, 89, 0.3);
        }

        @keyframes marquee { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }
        .animate-marquee { animation: marquee 80s linear infinite; }
    </style>
</head>
<body>

<nav class="glass-nav fixed w-full z-[100] top-0">
    <div class="container mx-auto flex justify-between items-center px-6 py-5">
        <a href="/home" class="text-2xl logo-text italic">Award Platform</a>
        
        <div class="hidden md:flex space-x-10">
            <a href="/home" class="nav-link {{ Request::is('home') ? 'active' : '' }}">Home</a>
            <a href="/nominations" class="nav-link">Nominees</a>
            <a href="/categories" class="nav-link">Categories</a>
            <a href="/contact" class="nav-link">Contact</a>
        </div>

        <a href="/nomination" class="hidden md:block px-8 py-3 btn-gold text-[10px] font-black uppercase tracking-widest rounded-full">
            Nominate Now
        </a>
    </div>
</nav>

<main>
    @yield('content')
</main>

<footer class="pt-24 pb-12 px-6 border-t border-black/5 bg-white">
    <div class="container mx-auto grid md:grid-cols-12 gap-16 mb-20">
        <div class="md:col-span-5 text-left">
            <h2 class="text-3xl font-black logo-text italic mb-6">Award Platform</h2>
            <p class="text-slate-500 text-lg leading-relaxed mb-10 max-w-sm">Honoring the grace, talent, and visionaries shaping our future.</p>
            <div class="flex space-x-4">
                @foreach(['facebook-f', 'tiktok', 'instagram', 'twitter'] as $icon)
                <a href="#" class="w-12 h-12 rounded-full border border-black/5 flex items-center justify-center text-slate-400 hover:text-gold hover:border-gold transition-all">
                    <i class="fab fa-{{ $icon }}"></i>
                </a>
                @endforeach
            </div>
        </div>
        <div class="md:col-span-7 grid grid-cols-2 gap-10">
            <div>
                <h4 class="text-black text-[10px] font-black uppercase tracking-widest mb-8">Navigation</h4>
                <ul class="space-y-4 text-slate-400 text-sm font-semibold">
                    <li><a href="#" class="hover:text-gold">Home</a></li>
                    <li><a href="#" class="hover:text-gold">Categories</a></li>
                    <li><a href="#" class="hover:text-gold">About</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-black text-[10px] font-black uppercase tracking-widest mb-8">Contact</h4>
                <p class="text-slate-400 text-sm font-semibold leading-loose">Nairobi, Kenya<br></p>
            </div>
        </div>
    </div>
</footer>

</body>
</html>