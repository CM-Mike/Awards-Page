@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#FDFCF7] relative overflow-hidden pt-20">
    
    {{-- Soft Iridescent Background Glows --}}
    <div class="absolute top-[-10%] left-[-10%] w-[50%] h-[50%] bg-orange-100/30 rounded-full blur-[120px]"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-[50%] h-[50%] bg-blue-50/30 rounded-full blur-[120px]"></div>

    <section class="relative pt-24 pb-16 px-6">
        <div class="max-w-7xl mx-auto text-center">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white border border-black/5 mb-8 shadow-sm">
                <span class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-400">Awards Arena 2026</span>
            </div>
            
            <h1 class="text-6xl md:text-8xl font-black text-slate-900 tracking-tighter leading-none uppercase mb-6">
                THE <span class="italic font-serif text-transparent bg-clip-text bg-gradient-to-r from-yellow-700 to-amber-500">LINEUP</span>
            </h1>
            <p class="text-slate-500 max-w-xl mx-auto text-lg font-medium leading-relaxed font-serif italic">
                Discover the categories shaping the future of digital excellence and cultural impact.
            </p>
        </div>
    </section>

    <section class="relative z-10 pb-32 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                
                @foreach($categories as $category)
                <div class="group relative">
                    {{-- Soft Elevation Shadow --}}
                    <div class="relative bg-white border border-black/5 p-8 rounded-[2rem] shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 overflow-hidden h-full">
                        
                        {{-- Subtle Gold Accent --}}
                        <div class="absolute top-0 right-0 w-24 h-24 bg-gold/5 rounded-bl-full translate-x-12 -translate-y-12 group-hover:translate-x-8 group-hover:-translate-y-8 transition-all duration-700"></div>

                        <div class="flex items-center gap-5 mb-10">
                            <div class="w-16 h-16 bg-[#FDFCF7] border border-black/5 rounded-2xl flex items-center justify-center text-3xl shadow-sm group-hover:bg-black group-hover:text-white transition-all duration-500">
                                {{ $category->icon ?? '🏆' }}
                            </div>
                            <div>
                                <h2 class="text-2xl font-black text-slate-900 uppercase tracking-tight leading-none">
                                    {{ $category->name }}
                                </h2>
                                <p class="text-[10px] text-gold font-black uppercase tracking-widest mt-2">
                                    {{ $category->subcategories->count() }} Recognition Tiers
                                </p>
                            </div>
                        </div>

                        {{-- Award Links --}}
                        <div class="space-y-3 flex-grow">
                            @forelse($category->subcategories as $sub)
                            <a href="{{ route('nominate', $category->slug) }}" 
                               class="group/item flex items-center justify-between p-4 rounded-xl bg-[#FDFCF7] border border-black/[0.03] hover:border-gold/30 hover:bg-white transition-all">
                                <span class="text-slate-600 group-hover/item:text-black text-sm font-bold transition-colors">
                                    {{ $sub->name }}
                                </span>
                                <div class="opacity-0 group-hover/item:opacity-100 translate-x-[-10px] group-hover/item:translate-x-0 transition-all">
                                    <svg class="w-4 h-4 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                    </svg>
                                </div>
                            </a>
                            @empty
                            <div class="text-center py-6 border border-dashed border-black/10 rounded-2xl">
                                <span class="text-slate-400 text-[10px] uppercase font-black tracking-widest">Awaiting Announcement</span>
                            </div>
                            @endforelse
                        </div>

                        <div class="mt-8 pt-6 border-t border-black/5">
                            <a href="{{ route('nominate', $category->slug) }}" class="text-[10px] font-black uppercase tracking-widest text-slate-400 group-hover:text-black transition-colors">
                                Enter Nomination Form →
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </section>
</div>

<style>
    /* Clean, light scrollbar */
    ::-webkit-scrollbar { width: 6px; }
    ::-webkit-scrollbar-track { background: #FDFCF7; }
    ::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
    ::-webkit-scrollbar-thumb:hover { background: #cbd5e1; }
</style>
@endsection