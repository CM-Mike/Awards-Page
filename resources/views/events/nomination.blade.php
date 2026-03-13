@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#FDFCF7] relative overflow-hidden pt-20">
    
    {{-- Soft Iridescent Backgrounds --}}
    <div class="absolute top-[-10%] left-[-10%] w-[60%] h-[60%] bg-orange-100/30 rounded-full blur-[120px]"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-[50%] h-[50%] bg-blue-50/30 rounded-full blur-[120px]"></div>

    <div class="container mx-auto px-6 py-16 relative z-10">
        
        <div class="max-w-3xl mx-auto text-center mb-16">
            <h1 class="text-5xl md:text-7xl font-black text-slate-900 tracking-tighter uppercase mb-4">
                NOMINATE A <span class="italic font-serif text-transparent bg-clip-text bg-gradient-to-r from-yellow-700 to-amber-500 text-glow">STAR</span>
            </h1>
            <p class="text-slate-500 font-serif italic text-lg">Shape the legacy of 2026. Submit your entry below.</p>
        </div>

        <div class="grid lg:grid-cols-12 gap-12 items-start">
            
            <div class="lg:col-span-4 space-y-6">
                <h3 class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-400 mb-4 px-4">Trending Now</h3>
                <div id="nominees-grid" class="space-y-4">
                    @foreach($nominees->sortByDesc('nominations_count')->take(5) as $nominee)
                    <div class="nominee-tile flex items-center gap-4 bg-white border border-black/5 p-4 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-500" data-category="{{ $nominee->category }}">
                        <div class="w-12 h-12 bg-slate-100 rounded-xl overflow-hidden flex-shrink-0">
                            @if($nominee->image)
                                <img src="{{ asset('storage/'.$nominee->image) }}" alt="{{ $nominee->name }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-xs text-slate-300 italic">N/A</div>
                            @endif
                        </div>
                        <div class="flex-1">
                            <h4 class="text-sm font-black text-slate-900 uppercase leading-none">{{ $nominee->name }}</h4>
                            <p class="text-[9px] text-gold font-bold uppercase tracking-widest mt-1">{{ $nominee->category }}</p>
                        </div>
                        <div class="bg-black text-white text-[10px] font-black w-8 h-8 rounded-full flex items-center justify-center">
                            {{ $nominee->nomination_count }}
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="lg:col-span-8">
                <div class="bg-white border border-black/5 p-8 md:p-12 rounded-[3rem] shadow-2xl relative overflow-hidden">
                    {{-- Form Header Disclaimer --}}
                    <div class="mb-10 p-4 rounded-2xl bg-orange-50 border border-orange-100">
                        <p class="text-xs text-orange-800 font-medium leading-relaxed">
                            <span class="font-black text-[10px] uppercase mr-2">Notice:</span> 
                            By submitting, you confirm nominee consent. Only one submission per person is permitted.
                        </p>
                    </div>

                    <form action="{{ route('nomination.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-2">I am nominating...</label>
                                <select name="nominee_type" class="w-full px-6 py-4 rounded-2xl bg-[#FDFCF7] border border-black/5 focus:ring-4 focus:ring-gold/5 outline-none font-bold text-slate-900" required>
                                    <option value="self">Myself</option>
                                    <option value="friend">A Peer / Friend</option>
                                    <option value="company">An Organization</option>
                                </select>
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-2">Nominee Full Name</label>
                                <input type="text" id="nomineeName" name="name" placeholder="Enter name" value="{{ request('nominee') }}"
                                    class="w-full px-6 py-4 rounded-2xl bg-[#FDFCF7] border border-black/5 focus:ring-4 focus:ring-gold/5 outline-none font-bold text-slate-900" required>
                            </div>
                        </div>

                        <div class="p-6 rounded-3xl bg-slate-900 text-white shadow-xl">
                            <p class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-500 mb-4 text-center">Share Your Campaign</p>
                            <div class="flex flex-wrap justify-center gap-3">
                                <button type="button" onclick="copyNominationLink()" class="px-5 py-2 rounded-full bg-white/10 hover:bg-white/20 text-[10px] font-black uppercase transition-all">🔗 Copy Link</button>
                                <button type="button" onclick="shareWhatsApp()" class="px-5 py-2 rounded-full bg-[#25D366]/20 text-[#25D366] text-[10px] font-black uppercase transition-all">WhatsApp</button>
                                <button type="button" onclick="shareFacebook()" class="px-5 py-2 rounded-full bg-[#1877F2]/20 text-[#1877F2] text-[10px] font-black uppercase transition-all">Facebook</button>
                                <button type="button" onclick="shareTwitter()" class="px-5 py-2 rounded-full bg-white/10 text-white text-[10px] font-black uppercase transition-all">X</button>
                            </div>
                        </div>

                        <div class="grid md:grid-cols-2 gap-6">
                            <input type="email" name="email" placeholder="Email Address (Optional)" class="w-full px-6 py-4 rounded-2xl bg-[#FDFCF7] border border-black/5 outline-none font-bold text-slate-900">
                            <input type="text" name="phone" placeholder="Phone Number (Optional)" class="w-full px-6 py-4 rounded-2xl bg-[#FDFCF7] border border-black/5 outline-none font-bold text-slate-900">
                        </div>

                        <div class="grid md:grid-cols-2 gap-6">
                            <select name="category" id="category-select" class="w-full px-6 py-4 rounded-2xl bg-[#FDFCF7] border border-black/5 outline-none font-bold text-slate-900" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat }}">{{ $cat }}</option>
                                @endforeach
                            </select>
                            <div id="age-container" style="display:none;">
                                <input type="number" name="age" placeholder="Nominee Age" class="w-full px-6 py-4 rounded-2xl bg-[#FDFCF7] border border-black/5 outline-none font-bold text-slate-900" min="1" max="30">
                            </div>
                        </div>

                        <textarea name="reason" placeholder="Why does this nominee deserve to win?" class="w-full px-6 py-4 rounded-2xl bg-[#FDFCF7] border border-black/5 outline-none font-bold text-slate-900 resize-none" rows="4" required></textarea>

                        <div class="flex flex-col md:flex-row items-center gap-6 pt-4">
                            <div class="flex-1 w-full">
                                <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 block mb-2">Upload Profile Portrait</label>
                                <input type="file" name="image" class="text-xs text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-black file:text-white hover:file:bg-gold transition-all">
                            </div>
                            <button type="submit" class="w-full md:w-auto px-12 py-5 bg-black text-white font-black uppercase tracking-widest text-xs rounded-full hover:bg-gold hover:shadow-2xl hover:-translate-y-1 transition-all duration-500">
                                Submit Nomination
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Success Toast --}}
@if(session('success'))
<div class="fixed bottom-10 right-10 z-[100] animate-bounce">
    <div class="bg-black text-white px-8 py-4 rounded-2xl shadow-2xl flex items-center gap-4">
        <div class="w-8 h-8 bg-emerald-500 rounded-full flex items-center justify-center">
            <i class="fas fa-check text-xs"></i>
        </div>
        <span class="text-[10px] font-black uppercase tracking-widest">{{ session('success') }}</span>
    </div>
</div>
@endif

<style>
    .text-glow { text-shadow: 0 0 20px rgba(197, 160, 89, 0.2); }
    #age-container { display: block; } /* Controlled by JS below */
</style>

<script>
    /* Same JS logic from your snippet, just adapted for IDs */
    const categorySelect = document.getElementById('category-select');
    const ageContainer = document.getElementById('age-container');
    
    categorySelect.addEventListener('change', function() {
        if(this.value === 'Tech Below 30') {
            ageContainer.style.display = 'block';
        } else {
            ageContainer.style.display = 'none';
        }
    });

    // Generate link helper
    function generateLink() {
        let name = document.getElementById("nomineeName").value;
        if(name === "") { alert("Enter nominee name first"); return null; }
        return window.location.origin + "/nomination?nominee=" + encodeURIComponent(name);
    }

    function copyNominationLink() {
        let link = generateLink();
        if(!link) return;
        navigator.clipboard.writeText(link);
        alert("Nomination link copied!");
    }
    
    // ... rest of share functions same as yours ...
</script>
@endsection