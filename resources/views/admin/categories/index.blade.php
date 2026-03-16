@extends('admin.layout.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-8">
    
    <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-12 gap-6">
        <div>
            <h1 class="text-4xl font-light tracking-tight text-slate-800">Award Categories</h1>
            <div class="flex items-center gap-4 mt-2">
                <span class="h-[1px] w-12 bg-[#C5A059]"></span>
                <p class="text-[10px] text-[#C5A059] uppercase tracking-[0.4em] font-bold">Luminous Segmentation</p>
            </div>
        </div>
        <div class="flex items-center gap-4">
            <div class="relative group">
                <input type="text" id="searchCategory" placeholder="Search library..." 
                    class="bg-white/50 backdrop-blur-md border border-[#C5A059]/20 rounded-full px-6 py-3 text-[10px] uppercase tracking-widest focus:outline-none focus:border-[#C5A059] transition-all w-64 placeholder:text-slate-300">
                <span class="absolute right-5 top-3.5 opacity-30 text-xs">🔍</span>
            </div>
            <button id="addCategoryBtn" class="bg-[#C5A059] text-white px-8 py-3 rounded-full text-[10px] font-bold uppercase tracking-widest shadow-xl shadow-[#C5A059]/20 hover:scale-105 transition-all">
                + New Category
            </button>
        </div>
    </div>

    <div class="bg-white/40 backdrop-blur-xl rounded-[3rem] border border-[#C5A059]/10 shadow-2xl shadow-[#C5A059]/5 overflow-hidden">
        <table class="w-full text-left">
            <thead>
                <tr class="text-[9px] text-slate-400 uppercase tracking-[0.3em] border-b border-[#C5A059]/10 bg-white/30">
                    <th class="px-10 py-6 font-medium">Identity</th>
                    <th class="py-6 font-medium">Event Reference</th>
                    <th class="py-6 font-medium text-center">Status</th>
                    <th class="px-10 py-6 font-medium text-right">Actions</th>
                </tr>
            </thead>
            <tbody id="categoryTable" class="text-slate-700">
                @forelse($categories as $category)
                <tr class="group hover:bg-[#FDFCF7]/80 transition-all duration-500 border-b border-slate-50 last:border-0">
                    <td class="px-10 py-8">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-2xl bg-[#C5A059]/10 flex items-center justify-center text-[#C5A059] text-xs font-bold">
                                {{ substr($category->name, 0, 1) }}
                            </div>
                            <span class="text-sm font-medium tracking-tight text-slate-800">{{ $category->name }}</span>
                        </div>
                    </td>
                    <td class="py-8">
                        <span class="text-[10px] uppercase tracking-widest text-slate-400">{{ $category->event->name ?? 'Global' }}</span>
                    </td>
                    <td class="py-8 text-center">
                        <span class="inline-block w-2 h-2 rounded-full bg-emerald-400 shadow-[0_0_10px_rgba(52,211,153,0.5)]"></span>
                    </td>
                    <td class="px-10 py-8 text-right">
                        <div class="flex justify-end gap-6 opacity-0 group-hover:opacity-100 transition-all duration-300">
                            <a href="#" class="text-[10px] uppercase tracking-widest text-[#C5A059] font-bold hover:underline">Edit</a>
                            <form action="#" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button class="text-[10px] uppercase tracking-widest text-red-300 hover:text-red-500 font-bold">Remove</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="py-20 text-center">
                        <p class="text-[10px] text-slate-300 uppercase tracking-[0.4em] italic">The library is currently empty</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-10">
        {{ $categories->links() }}
    </div>
</div>

<div id="addCategoryModal" class="fixed inset-0 z-[100] hidden bg-slate-900/40 backdrop-blur-sm transition-opacity">
    <div class="flex min-h-full items-center justify-center p-4">
        <div class="relative w-full max-w-lg bg-[#FDFCF7] rounded-[3rem] p-12 border border-[#C5A059]/20 shadow-2xl">
            <span class="modal-close absolute top-8 right-8 text-slate-300 hover:text-[#C5A059] cursor-pointer text-xl">&times;</span>
            
            <div class="text-center mb-10">
                <h2 class="text-3xl font-light text-slate-800 tracking-tight">Register Category</h2>
                <p class="text-[9px] text-[#C5A059] uppercase tracking-[0.4em] mt-2 font-bold">Luminous Edition</p>
            </div>

            <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-8">
                @csrf
                <div class="group">
                    <label class="block text-[9px] font-bold text-[#C5A059] uppercase tracking-[0.3em] mb-4 ml-1">Category Title</label>
                    <input type="text" name="name" required placeholder="e.g. Humanitarian of the Year"
                        class="w-full bg-transparent border-b border-[#C5A059]/20 py-4 px-1 focus:border-[#C5A059] focus:outline-none transition-all text-xl font-light text-slate-700 placeholder:text-slate-200">
                </div>

                <div class="flex gap-4 pt-6">
                    <button type="submit" class="flex-1 py-5 bg-[#C5A059] text-white rounded-2xl text-[10px] font-bold uppercase tracking-[0.3em] shadow-lg shadow-[#C5A059]/20 hover:scale-[1.02] transition-all">
                        Confirm & Save
                    </button>
                    <button type="button" class="cancel-btn flex-1 py-5 border border-slate-200 text-slate-400 rounded-2xl text-[10px] font-bold uppercase tracking-[0.3em] hover:bg-slate-50 transition-all">
                        Dismiss
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Logic for Search and Modal
    document.addEventListener("DOMContentLoaded", function() {
        const modal = document.getElementById("addCategoryModal");
        const addBtn = document.getElementById("addCategoryBtn");
        const closeX = document.querySelector(".modal-close");
        const cancelBtn = document.querySelector(".cancel-btn");
        const searchInput = document.getElementById("searchCategory");

        // Search Filter
        searchInput.addEventListener("keyup", function() {
            let value = this.value.toLowerCase();
            document.querySelectorAll("#categoryTable tr").forEach(row => {
                row.style.display = row.innerText.toLowerCase().includes(value) ? "" : "none";
            });
        });

        // Modal Controls
        addBtn.addEventListener("click", () => modal.classList.remove('hidden'));
        [closeX, cancelBtn].forEach(btn => btn.addEventListener("click", () => modal.classList.add('hidden')));
        window.onclick = (e) => { if (e.target === modal) modal.classList.add('hidden'); };
    });
</script>
@endsection