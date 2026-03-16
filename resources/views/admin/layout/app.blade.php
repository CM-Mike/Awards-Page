<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Portal | Awards Luminous</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body { 
            background-color: #FDFCF7; /* Luminous Soft Cream */
            font-family: 'Poppins', sans-serif; 
            margin: 0;
            color: #334155;
        }

        /* Luminous Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 280px;
            height: 100vh;
            padding: 2.5rem 1.5rem;
            background: rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(20px);
            border-right: 1px solid rgba(197, 160, 89, 0.15); /* Champagne Gold Border */
            z-index: 50;
            transition: transform 0.3s ease;
        }

        /* Nav Links */
        .sidebar a {
            display: flex;
            align-items: center;
            padding: 0.85rem 1.25rem;
            margin-bottom: 0.5rem;
            border-radius: 1rem;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: #64748b;
            transition: all 0.3s;
        }

        /* Active/Hover State: Champagne Gold */
        .sidebar a:hover, .sidebar a.active-link {
            background-color: #C5A059;
            color: #FDFCF7;
            box-shadow: 0 10px 20px -5px rgba(197, 160, 89, 0.3);
        }

        .main-content {
            margin-left: 280px;
            padding: 3rem;
        }

        /* Responsive Mobile Behavior */
        @media(max-width:768px){
            .sidebar { transform: translateX(-100%); }
            .sidebar.active { transform: translateX(0); }
            .main-content { margin-left: 0; padding: 1.5rem; padding-top: 5rem; }
            #sidebarToggle { display: flex; }
        }

        #sidebarToggle {
            display: none;
            position: fixed;
            top: 1.25rem;
            left: 1.25rem;
            z-index: 60;
            background: #C5A059;
            color: white;
            padding: 0.6rem;
            border-radius: 0.75rem;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(197, 160, 89, 0.2);
        }
    </style>
</head>
<body>

<div id="sidebarToggle">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
    </svg>
</div>

<div class="sidebar">
    <div class="mb-12 px-4">
        <h2 class="text-2xl font-light tracking-[0.3em] text-[#C5A059] uppercase">AWARDS</h2>
        <p class="text-[8px] tracking-[0.4em] text-slate-400 uppercase mt-2 font-bold">Luminous Portal</p>
    </div>

    <ul class="space-y-2">
        <li>
            <a href="{{route('admin.dashboard')}}" class="{{ Route::is('admin.dashboard') ? 'active-link' : '' }}">
                <span class="mr-3">📊</span> Dashboard
            </a>
        </li>
        <li>
            <a href="{{route('admin.events')}}" class="{{ Route::is('admin.events') ? 'active-link' : '' }}">
                <span class="mr-3">🏆</span> Events
            </a>
        </li>
        <li>
            <a href="{{route('admin.categories')}}" class="{{ Route::is('admin.categories') ? 'active-link' : '' }}">
                <span class="mr-3">📁</span> Categories
            </a>
        </li>
        <li>
            <a href="{{route('admin.nominees')}}" class="{{ Route::is('admin.nominees') ? 'active-link' : '' }}">
                <span class="mr-3">👥</span> Nominees
            </a>
        </li>
    </ul>

    <div class="absolute bottom-8 left-0 w-full px-6">
        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button class="w-full flex items-center px-6 py-3 text-[10px] font-bold uppercase tracking-widest text-red-400 hover:bg-red-50 rounded-xl transition">
                🚪 Logout Portal
            </button>
        </form>
    </div>
</div>

<div class="main-content">
    @yield('content')
</div>

<script>
    const sidebar = document.querySelector('.sidebar');
    const toggleBtn = document.getElementById('sidebarToggle');
    toggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('active');
    });
</script>

</body>
</html>