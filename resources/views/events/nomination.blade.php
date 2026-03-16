@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#FDFCF7] py-20 flex flex-col items-center relative overflow-hidden">
    {{-- Background Aura --}}
    <div class="absolute top-0 left-0 w-full h-full pointer-events-none">
        <div class="absolute top-[-10%] right-[-10%] w-96 h-96 bg-amber-100/30 rounded-full blur-[120px]"></div>
    </div>

    <div class="container max-w-4xl mx-auto px-6 relative z-10">
        <div class="text-center mb-16">
            <h1 class="text-6xl font-black text-slate-900 tracking-tighter uppercase mb-4">
                NOMINATE A <span class="italic font-serif text-transparent bg-clip-text bg-gradient-to-r from-yellow-700 to-amber-500">STAR</span>
            </h1>
            <p class="text-slate-400 font-serif italic">The definitive list of excellence for 2026.</p>
        </div>

        <div class="bg-white border border-black/5 p-10 md:p-16 rounded-[4rem] shadow-2xl">
            <form action="{{ route('nomination.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf

                <div class="grid md:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label class="luminous-label">Star Name</label>
                        <input type="text" name="name" placeholder="Name of Person/Brand" class="luminous-input" required>
                    </div>
                    <div class="space-y-2">
                        <label class="luminous-label">Social Handle</label>
                        <input type="text" name="social_handle" placeholder="@username" class="luminous-input" required>
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label class="luminous-label">Main Category</label>
                        <select name="category_id" id="main-category" class="luminous-input" required>
                            <option value="" disabled selected>Select Category</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label class="luminous-label">Sub Category</label>
                        <select name="sub_category_id" id="sub-category" class="luminous-input opacity-50" disabled required>
                            <option value="" disabled selected>Waiting...</option>
                        </select>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="luminous-label">Merit Note</label>
                    <textarea name="reason" rows="3" placeholder="Why do they deserve this honor?" class="luminous-input resize-none" required></textarea>
                </div>

                <div class="space-y-2">
                    <label class="luminous-label">Star Portrait</label>
                    <input type="file" name="image" class="luminous-input pt-4 text-xs" required>
                </div>

                <div class="flex justify-center pt-8">
                    <button type="submit" class="px-20 py-6 bg-slate-900 text-white font-black uppercase tracking-[0.4em] text-[10px] rounded-full hover:bg-[#C5A059] transition-all duration-500 shadow-2xl">
                        Submit Nomination
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const categoryData = @json($categories->keyBy('id'));
    const mainSelect = document.getElementById('main-category');
    const subSelect = document.getElementById('sub-category');

    mainSelect.addEventListener('change', function() {
        const subs = categoryData[this.value].sub_categories || [];
        subSelect.innerHTML = '<option value="" disabled selected>Choose Sub-Category</option>';
        subs.forEach(sub => {
            const opt = document.createElement('option');
            opt.value = sub.id; opt.textContent = sub.name;
            subSelect.appendChild(opt);
        });
        subSelect.disabled = false; subSelect.classList.remove('opacity-50');
    });
</script>

<style>
    .luminous-label { display: block; font-size: 9px; font-weight: 900; text-transform: uppercase; letter-spacing: 0.3em; color: #94a3b8; margin-bottom: 0.5rem; }
    .luminous-input { width: 100%; background: #FDFCF7; border: 1px solid rgba(0,0,0,0.05); border-radius: 1.5rem; padding: 1.25rem 1.5rem; font-weight: 700; outline: none; transition: 0.3s; font-size: 0.85rem; }
    .luminous-input:focus { border-color: #C5A059; background: white; }
</style>
@endsection