@extends('admin.layout.app')

@section('content')
<div class="max-w-2xl mx-auto py-20">
    <div class="text-center mb-16">
        <h1 class="text-4xl font-extralight tracking-tighter text-slate-800">Create Category</h1>
        <p class="text-[10px] text-[#C5A059] uppercase tracking-[0.5em] mt-4 font-bold">Define a new segment of excellence</p>
    </div>

    <div class="bg-white/60 backdrop-blur-2xl p-12 rounded-[3rem] border border-[#C5A059]/10 shadow-2xl shadow-[#C5A059]/5">
        <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-10">
            @csrf
            
            <div class="relative group">
                <label class="block text-[9px] font-bold text-[#C5A059] uppercase tracking-[0.3em] mb-3 ml-2">Category Identity</label>
                <input type="text" name="name" placeholder="e.g. Innovator of the Year" required
                    class="w-full bg-[#FDFCF7]/50 border-b border-[#C5A059]/20 py-4 px-2 focus:border-[#C5A059] focus:outline-none transition-all text-lg font-light text-slate-700 placeholder:text-slate-200">
            </div>

            <div class="pt-6">
                <button type="submit" class="w-full py-5 bg-gradient-to-r from-[#C5A059] to-[#B38F4D] text-[#FDFCF7] rounded-2xl text-[10px] font-bold uppercase tracking-[0.4em] shadow-xl shadow-[#C5A059]/20 hover:scale-[1.02] transition-all active:scale-95">
                    Confirm & Publish
                </button>
                <a href="{{ route('admin.categories') }}" class="block text-center mt-6 text-[9px] uppercase tracking-widest text-slate-400 hover:text-slate-600 transition">
                    Return to Library
                </a>
            </div>
        </form>
    </div>
</div>
@endsection