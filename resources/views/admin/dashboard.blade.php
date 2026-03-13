@extends('admin.layout.app')

@section('content')

<!-- Top Navbar with Admin Icon -->
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl text-black font-bold mx-auto md:mx-0">Dashboard</h1>
    <div class="relative flex justify-end items-center mb-6">
        <button id="adminDropdownBtn" class="flex items-center focus:outline-none cursor-pointer">
            <div class="w-10 h-10 rounded-full bg-blue-500 text-white flex items-center justify-center font-bold">
                {{ substr(auth()->user()->name ?? 'Admin',0,1) }}
            </div>
        </button>

        <div id="adminDropdownMenu" class="absolute right-0 mt-2 w-48 backdrop-blur-lg bg-white/70 shadow-lg rounded-lg hidden z-50">
            <p class="px-4 py-2 border-b text-gray-700 font-semibold">{{ auth()->user()->name ?? 'Admin' }}</p>
            <a href="{{ route('admin.profile') }}" class="block px-4 py-2 hover:bg-blue-100 text-gray-700">Edit Profile</a>
            <a href="{{ route('admin.addUser') }}" class="block px-4 py-2 hover:bg-blue-100 text-gray-700">Add User</a>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-2 hover:bg-blue-100 text-gray-700">Logout</button>
            </form>
        </div>
    </div>
</div>

<!-- Summary Tiles -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
    <div class="glass p-6 text-black"><h3 class="text-lg">Events</h3><p class="text-3xl font-bold mt-2">{{ $events }}</p></div>
    <div class="glass p-6 text-black"><h3 class="text-lg">Categories</h3><p class="text-3xl font-bold mt-2">{{ $categories }}</p></div>
    <div class="glass p-6 text-black"><h3 class="text-lg">Nominees</h3><p class="text-3xl font-bold mt-2">{{ $nominees }}</p></div>
    <div class="glass p-6 text-black"><h3 class="text-lg">Votes</h3><p class="text-3xl font-bold mt-2">{{ $votes }}</p></div>
</div>

<!-- Latest Nominees Table -->
<div class="bg-white p-6 rounded-lg shadow-md mb-6">
    <h2 class="text-xl font-bold mb-4">Latest Nominees</h2>
    <div class="overflow-x-auto">
        <table class="w-full table-auto border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-4 py-2">ID</th>
                    <th class="border border-gray-300 px-4 py-2">Name</th>
                    <th class="border border-gray-300 px-4 py-2">Category</th>
                    <th class="border border-gray-300 px-4 py-2">Event</th>
                    <th class="border border-gray-300 px-4 py-2">Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($latestNominees as $nominee)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $nominee->id }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $nominee->name }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $nominee->category->name ?? '-' }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $nominee->event->title ?? '-' }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $nominee->created_at->format('d M Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Charts Section -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

   

    <!-- Nominees by Category -->
    <div class="glass p-6">
        <h2 class="text-xl font-bold mb-4">Nominees by Category</h2>
        <canvas id="nomineesByCategoryChart" class="w-full h-64"></canvas>
    </div>

   
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const btn = document.getElementById('adminDropdownBtn');
const menu = document.getElementById('adminDropdownMenu');
btn.addEventListener('click', () => menu.classList.toggle('hidden'));
document.addEventListener('click', e => { if(!btn.contains(e.target) && !menu.contains(e.target)) menu.classList.add('hidden'); });

const safeLabels = arr => Array.isArray(arr) && arr.length ? arr : ['No Data'];
const safeData = arr => Array.isArray(arr) && arr.length ? arr : [0];

// Votes by Category
new Chart(document.getElementById('votesChart').getContext('2d'), {
    type: 'line',
    data: {
        labels: safeLabels(@json($categoriesNames ?? [])),
        datasets: [{ label: 'Votes', data: safeData(@json($votesPerCategory ?? [])), borderColor: '#2f80ed', backgroundColor: 'rgba(47,128,237,0.2)', fill: true, tension: 0.3, pointRadius: 5, pointBackgroundColor: '#2f80ed' }]
    },
    options: { responsive:true, plugins:{legend:{display:false}}, scales:{y:{beginAtZero:true}}}
});

// Nominees by Category
new Chart(document.getElementById('nomineesByCategoryChart').getContext('2d'), {
    type: 'line',
    data: {
        labels: safeLabels(@json($categoriesNames ?? [])),
        datasets: [{ label: 'Nominees', data: safeData(@json($nomineesPerCategory ?? [])), borderColor: '#16a34a', backgroundColor: 'rgba(22,163,74,0.2)', fill: true, tension:0.3, pointRadius:5, pointBackgroundColor:'#16a34a' }]
    },
    options: { responsive:true, plugins:{legend:{display:false}}, scales:{y:{beginAtZero:true}} }
});

// Votes Trend Over Time
new Chart(document.getElementById('votesTrendChart').getContext('2d'), {
    type: 'line',
    data: {
        labels: safeLabels(@json($voteDates ?? [])),
        datasets: [{ label: 'Votes', data: safeData(@json($votesOverTime ?? [])), borderColor: '#f97316', backgroundColor:'rgba(249,115,22,0.2)', fill:true, tension:0.3, pointRadius:5, pointBackgroundColor:'#f97316' }]
    },
    options: { responsive:true, plugins:{legend:{display:false}}, scales:{y:{beginAtZero:true}} }
});

// Nominees Growth Over Time
new Chart(document.getElementById('nomineesGrowthChart').getContext('2d'), {
    type: 'line',
    data: {
        labels: safeLabels(@json($dates ?? [])),
        datasets: [{ label:'Nominees', data: safeData(@json($counts ?? [])), borderColor:'#2f80ed', backgroundColor:'rgba(47,128,237,0.2)', fill:true, tension:0.3, pointRadius:5, pointBackgroundColor:'#2f80ed' }]
    },
    options: { responsive:true, plugins:{legend:{display:true}}, scales:{y:{beginAtZero:true}, x:{ticks:{maxRotation:90, minRotation:45}}} }
});
</script>
@endsection

<style>
.glass { 
    backdrop-filter: blur(10px); 
    background-color: rgba(255,255,255,0.75); 
    border-radius: 1rem; }
</style>