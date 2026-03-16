@extends('admin.layout.app')

@section('content')
<div class="max-w-[1400px] mx-auto px-8 py-10">
    
    <div class="mb-16 flex justify-between items-end border-b border-[#C5A059]/10 pb-10">
        <div>
            <h1 class="text-5xl font-extralight tracking-tight text-slate-800 mb-2">Portfolio Overview</h1>
            <div class="flex items-center gap-4">
                <span class="h-[1px] w-12 bg-[#C5A059]"></span>
                <p class="text-[10px] text-[#C5A059] uppercase tracking-[0.5em] font-bold">Luminous Edition • Prestige Management</p>
            </div>
        </div>
        <div class="text-right pb-2">
            <span class="text-[10px] uppercase tracking-widest text-slate-400 font-bold italic">System Active</span>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-20">
        @foreach([
            ['label' => 'Total Votes', 'value' => $votes, 'icon' => '✨'],
            ['label' => 'Nominees', 'value' => $nominees, 'icon' => '👥'],
            ['label' => 'Categories', 'value' => $categories, 'icon' => '📁'],
            ['label' => 'Live Events', 'value' => $events, 'icon' => '🏆']
        ] as $stat)
        <div class="group cursor-default">
            <p class="text-[9px] font-bold text-slate-400 uppercase tracking-[0.2em] mb-4 group-hover:text-[#C5A059] transition-colors">{{ $stat['label'] }}</p>
            <div class="flex items-baseline gap-3">
                <h2 class="text-5xl font-light text-slate-800 tracking-tighter">{{ number_format($stat['value']) }}</h2>
                <span class="text-lg opacity-20 group-hover:opacity-100 transition-opacity duration-700">{{ $stat['icon'] }}</span>
            </div>
        </div>
        @endforeach
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-16">
        
        <div class="lg:col-span-8 bg-white/40 backdrop-blur-md p-12 rounded-[4rem] border border-[#C5A059]/10 shadow-2xl shadow-[#C5A059]/5">
            <div class="flex justify-between items-center mb-12">
                <h3 class="text-xs font-medium text-slate-400 uppercase tracking-widest">Engagement Trends</h3>
                <span class="text-[9px] text-[#C5A059] font-bold tracking-widest px-3 py-1 bg-[#C5A059]/10 rounded-full">REAL-TIME</span>
            </div>
            <div class="h-[380px]">
                <canvas id="luminousChart"></canvas>
            </div>
        </div>

        <div class="lg:col-span-4 flex flex-col justify-between">
            <div>
                <h3 class="text-xs font-bold text-[#C5A059] uppercase tracking-[0.3em] mb-12">Recent Spotlight</h3>
                <div class="space-y-10">
                    @foreach($latestNominees as $ln)
                    <div class="flex items-center justify-between group cursor-pointer">
                        <div class="flex items-center gap-6">
                            <div class="w-12 h-12 rounded-full border border-[#C5A059]/20 flex items-center justify-center group-hover:bg-[#C5A059] transition-all duration-500">
                                <span class="text-[10px] font-light text-slate-400 group-hover:text-white">{{ substr($ln->name, 0, 1) }}</span>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-slate-800">{{ $ln->name }}</p>
                                <p class="text-[9px] text-slate-300 uppercase tracking-tighter">{{ $ln->category->name ?? 'Category' }}</p>
                            </div>
                        </div>
                        <span class="text-[10px] font-light text-[#C5A059] tracking-widest">{{ $ln->votes_count }} v.</span>
                    </div>
                    @endforeach
                </div>
            </div>
            
            <a href="{{ route('admin.nominees') }}" class="mt-12 text-[10px] font-bold uppercase tracking-[0.4em] text-slate-400 hover:text-[#C5A059] transition-all">
                Access Full Roster →
            </a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('luminousChart').getContext('2d');
    const goldGradient = ctx.createLinearGradient(0, 0, 0, 400);
    goldGradient.addColorStop(0, 'rgba(197, 160, 89, 0.4)');
    goldGradient.addColorStop(1, 'rgba(197, 160, 89, 0)');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($categoriesNames) !!},
            datasets: [{
                data: {!! json_encode($votesPerCategory) !!},
                borderColor: '#C5A059',
                borderWidth: 2,
                fill: true,
                backgroundColor: goldGradient,
                tension: 0.5,
                pointRadius: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { display: false },
                x: { 
                    grid: { display: false },
                    ticks: { font: { size: 8 }, color: '#94a3b8' }
                }
            }
        }
    });
</script>
@endsection