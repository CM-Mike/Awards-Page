<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Panel</title>
<script src="https://cdn.tailwindcss.com"></script>

<style>
body {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    background-color: #f3f4f6;
}

/* Sidebar */
.sidebar {
    position: fixed; /* fixed sidebar */
    top: 0;
    left: 0;
    width: 250px;
    height: 100vh;
    padding: 1.5rem;
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    border-radius: 0 20px 20px 0;
    border: 1px solid rgba(255,255,255,0.2);
    color: white;
    z-index: 50;
    transition: 0.3s;
}

/* Sidebar links */
.sidebar a {
    display: block;
    margin-bottom: 1rem;
    transition: color 0.3s;
}

.sidebar a:hover {
    color: #60a5fa; /* Tailwind blue-400 */
}

/* Main content */
.main-content {
    margin-left: 250px; /* sidebar width */
    padding: 2rem;
}

/* Glass card */
.glass {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    border: 1px solid rgba(255,255,255,0.2);
    padding: 1rem;
    color: #000;
}

/* Responsive sidebar for mobile */
@media(max-width:768px){
    .sidebar {
        left: -250px;
    }
    .sidebar.active {
        left: 0;
    }
    .main-content {
        margin-left: 0;
    }
}

/* Hamburger button */
#sidebarToggle {
    display: none;
}
@media(max-width:768px){
    #sidebarToggle {
        display: block;
        position: fixed;
        top: 1rem;
        left: 1rem;
        z-index: 60;
        background: rgba(255,255,255,0.2);
        backdrop-filter: blur(5px);
        border-radius: 0.5rem;
        padding: 0.5rem;
        cursor: pointer;
    }
}
</style>
</head>
<body>

<!-- Mobile Sidebar Toggle -->
<div id="sidebarToggle">
    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M4 6h16M4 12h16M4 18h16" />
    </svg>
</div>

<!-- Sidebar -->
<div class="sidebar glass">
    <h2 class="text-2xl font-bold mb-8">Admin</h2>
    <ul class="space-y-4">
        <li><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
        <li><a href="{{route('admin.events')}}">Events</a></li>
        <li><a href="{{route('admin.categories')}}">Categories</a></li>
        <li><a href="{{route('admin.nominees')}}">Nominees</a></li>
    </ul>
</div>

<!-- Main Content -->
<div class="main-content">
    @yield('content')
</div>

<!-- Scripts -->
<script>
const sidebar = document.querySelector('.sidebar');
const toggleBtn = document.getElementById('sidebarToggle');

toggleBtn.addEventListener('click', () => {
    sidebar.classList.toggle('active');
});
</script>

</body>
</html>