@extends('admin.layout.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-8">
    
    <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-12 gap-6">
        <div>
            <h1 class="text-4xl font-light tracking-tight text-slate-800">Event Management</h1>
            <div class="flex items-center gap-4 mt-2">
                <span class="h-[1px] w-12 bg-[#C5A059]"></span>
                <p class="text-[10px] text-[#C5A059] uppercase tracking-[0.4em] font-bold">Awards Calendar</p>
            </div>
        </div>
        <a href="{{ route('admin.events.create') }}" class="bg-[#C5A059] text-white px-10 py-4 rounded-full text-[10px] font-bold uppercase tracking-widest shadow-xl shadow-[#C5A059]/20 hover:scale-105 transition-all">
            + Schedule Event
        </a>
    </div>

    @if(session('success'))
        <div class="bg-emerald-50 text-emerald-600 text-[10px] font-bold uppercase tracking-widest p-4 rounded-2xl border border-emerald-100 mb-8 animate-fade-in">
            ✨ {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($events as $event)
        <div class="bg-white/40 backdrop-blur-xl rounded-[3rem] border border-[#C5A059]/10 p-8 shadow-2xl shadow-[#C5A059]/5 hover:border-[#C5A059]/40 transition-all duration-500 group">
            <div class="flex justify-between items-start mb-8">
                <div class="w-14 h-14 rounded-2xl bg-[#FDFCF7] border border-[#C5A059]/10 flex flex-col items-center justify-center text-[#C5A059]">
                    <span class="text-[8px] uppercase font-bold tracking-tighter">{{ \Carbon\Carbon::parse($event->date)->format('M') }}</span>
                    <span class="text-xl font-light">{{ \Carbon\Carbon::parse($event->date)->format('d') }}</span>
                </div>
                <div class="text-right">
                    <span class="text-[8px] font-bold uppercase tracking-widest text-[#C5A059] bg-[#C5A059]/10 px-3 py-1 rounded-full">
                        {{ \Carbon\Carbon::parse($event->date)->format('Y') }}
                    </span>
                </div>
            </div>

            <div class="mb-10">
                <h3 class="text-xl font-light text-slate-800 tracking-tight group-hover:text-[#C5A059] transition-colors line-clamp-1">{{ $event->title }}</h3>
                <p class="text-[9px] text-slate-400 uppercase tracking-[0.2em] mt-2 italic">Official Ceremony</p>
            </div>

            <div class="flex items-center justify-between pt-6 border-t border-[#C5A059]/5">
                <div class="flex gap-4">
                    <a href="{{ route('admin.events.edit', $event) }}" class="text-[9px] font-bold uppercase tracking-widest text-slate-400 hover:text-[#C5A059] transition">Edit Details</a>
                </div>
                
                <form action="{{ route('admin.events.destroy', $event) }}" method="POST" onsubmit="return confirm('Archive this event?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="text-[9px] font-bold uppercase tracking-widest text-red-300 hover:text-red-500 transition">Remove</button>
                </form>
            </div>
        </div>
        @empty
        <div class="col-span-full py-20 text-center">
            <div class="text-4xl mb-4 opacity-20">📅</div>
            <p class="text-[10px] text-slate-300 uppercase tracking-[0.4em] italic">No events currently on the calendar</p>
        </div>
        @endforelse
    </div>
</div>
@endsection