@extends('layouts.app')

@section('content')
<div class="min-h-screen pt-20">
    
    <section class="relative min-h-[90vh] flex items-center justify-center px-6 overflow-hidden">
        <div class="absolute top-0 left-[-10%] w-[60%] h-[60%] bg-orange-100/40 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-0 right-[-10%] w-[50%] h-[50%] bg-blue-50/40 rounded-full blur-[150px]"></div>

        <div class="relative z-10 max-w-7xl mx-auto text-center">
            <h1 class="text-6xl md:text-[8rem] font-black tracking-tighter leading-[0.9] text-slate-900 uppercase mb-8">
                Honoring the<br>
                <span class="italic font-serif text-transparent bg-clip-text bg-gradient-to-r from-yellow-700 to-amber-500">EXCEPTIONAL</span>
            </h1>

            <div class="flex items-center justify-center gap-4 md:gap-8 mb-16">
                @foreach(['days' => 'Days', 'hours' => 'Hrs', 'minutes' => 'Min', 'seconds' => 'Sec'] as $id => $label)
                    <div class="flex flex-col items-center">
                        <div class="w-20 h-20 md:w-28 md:h-28 rounded-3xl bg-white border border-black/5 flex items-center justify-center shadow-sm">
                            <span id="{{ $id }}" class="text-3xl md:text-5xl font-black text-slate-900">00</span>
                        </div>
                        <span class="text-[10px] font-bold uppercase tracking-[0.3em] text-slate-400 mt-4">{{ $label }}</span>
                    </div>
                @endforeach
            </div>

            <div class="flex flex-col md:flex-row items-center justify-center gap-8">
                <a href="{{ route('nominations.index') }}" class="px-12 py-5 bg-black text-white font-black uppercase tracking-widest text-xs rounded-full hover:shadow-xl transition-all">
                    View Nominees
                </a>
                <a href="#process" class="text-slate-900 font-black uppercase tracking-widest text-xs border-b-2 border-slate-200 pb-2 hover:border-gold transition-all">
                    The Process
                </a>
            </div>
        </div>
    </section>

    <section class="py-20 bg-white border-y border-black/5">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-2 md:grid-cols-4 gap-10 text-center">
            <div>
                <h4 class="text-4xl font-black text-slate-900 italic">17</h4>
                <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400 mt-2">Categories</p>
            </div>
            <div>
                <h4 class="text-4xl font-black text-slate-900 italic">450+</h4>
                <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400 mt-2">Nominees</p>
            </div>
            <div>
                <h4 class="text-4xl font-black text-slate-900 italic">25k</h4>
                <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400 mt-2">Total Votes</p>
            </div>
            <div>
                <h4 class="text-4xl font-black text-slate-900 italic">2026</h4>
                <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400 mt-2">Excellence Year</p>
            </div>
        </div>
    </section>

    <section id="process" class="py-32 px-6">
        <div class="max-w-5xl mx-auto text-center">
            <h2 class="font-serif italic text-4xl md:text-6xl text-slate-900 mb-20">The Journey to Victory</h2>
            <div class="grid md:grid-cols-4 gap-12">
                @foreach([
                    ['title' => 'Nominations', 'desc' => 'Open until April 2026'],
                    ['title' => 'Shortlisting', 'desc' => 'Review by the Jury'],
                    ['title' => 'Voting', 'desc' => 'The Public Decides'],
                    ['title' => 'Gala Night', 'desc' => 'The Winners Crowned']
                ] as $index => $step)
                <div class="relative">
                    <div class="w-12 h-12 bg-gold/10 text-gold rounded-full flex items-center justify-center mx-auto mb-6 font-black">
                        {{ $index + 1 }}
                    </div>
                    <h5 class="font-black text-slate-900 uppercase text-xs tracking-widest mb-3">{{ $step['title'] }}</h5>
                    <p class="text-slate-400 text-sm leading-relaxed">{{ $step['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section id="categories" class="py-32 px-6 bg-[#F9F8F3]">
        <div class="max-w-7xl mx-auto">
            <div class="flex justify-between items-end mb-20 px-4">
                <h2 class="font-serif italic text-4xl md:text-6xl text-slate-900">The Arena</h2>
                <a href="{{ route('categories.index') }}" class="text-[10px] font-black uppercase tracking-widest text-gold border-b border-gold pb-1">View All 17 →</a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                @foreach($categories->take(4) as $category)
                <a href="{{ route('nominate', $category->slug) }}" class="group bg-white border border-black/5 p-12 rounded-[2rem] hover:shadow-2xl hover:-translate-y-4 transition-all duration-500">
                    <div class="text-4xl mb-8 group-hover:scale-110 transition-transform">{{ $category->icon ?? '🏆' }}</div>
                    <h4 class="text-xl font-black text-slate-900 mb-2 uppercase tracking-tight">{{ $category->name }}</h4>
                    <p class="text-slate-400 text-[10px] font-bold uppercase tracking-widest mt-4">Nominate Now →</p>
                </a>
                @endforeach
            </div>
        </div>
    </section>

</div>

<script>
    const countdownDate = new Date();
    countdownDate.setDate(countdownDate.getDate() + 30);
    setInterval(function() {
        const now = new Date().getTime();
        const distance = countdownDate - now;
        document.getElementById("days").innerHTML = Math.floor(distance / (1000 * 60 * 60 * 24));
        document.getElementById("hours").innerHTML = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)).toString().padStart(2, '0');
        document.getElementById("minutes").innerHTML = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60)).toString().padStart(2, '0');
        document.getElementById("seconds").innerHTML = Math.floor((distance % (1000 * 60)) / 1000).toString().padStart(2, '0');
    }, 1000);
</script>
@endsection