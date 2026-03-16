@extends('admin.layout.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-8">
    
    <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-12 gap-6">
        <div>
            <h1 class="text-4xl font-light tracking-tight text-slate-800">Nominees</h1>
            <div class="flex items-center gap-4 mt-2">
                <span class="h-[1px] w-12 bg-[#C5A059]"></span>
                <p class="text-[10px] text-[#C5A059] uppercase tracking-[0.4em] font-bold">Luminous Roster</p>
            </div>
        </div>
        <div class="flex items-center gap-4 w-full md:w-auto">
            <div class="relative flex-1 md:flex-none group">
                <input type="text" id="searchInput" placeholder="Search library..." 
                    class="bg-white/50 backdrop-blur-md border border-[#C5A059]/20 rounded-full px-6 py-3 text-[10px] uppercase tracking-widest focus:outline-none focus:border-[#C5A059] transition-all w-full md:w-64 placeholder:text-slate-300">
            </div>
            <button id="addNomineeBtn" class="bg-[#C5A059] text-white px-8 py-3 rounded-full text-[10px] font-bold uppercase tracking-widest shadow-xl shadow-[#C5A059]/20 hover:scale-105 transition-all">
                + Register Nominee
            </button>
        </div>
    </div>

    <div class="bg-white/40 backdrop-blur-xl rounded-[3rem] border border-[#C5A059]/10 shadow-2xl shadow-[#C5A059]/5 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="text-[9px] text-slate-400 uppercase tracking-[0.3em] border-b border-[#C5A059]/10 bg-white/30">
                    <th class="px-10 py-6 font-medium">Nominee Identity</th>
                    <th class="py-6 font-medium">Contact</th>
                    <th class="py-6 font-medium">Category Segment</th>
                    <th class="py-6 font-medium text-center">Engagement</th>
                    <th class="px-10 py-6 font-medium text-right">Actions</th>
                </tr>
            </thead>
            <tbody id="nomineeTable" class="text-slate-700">
                @forelse($nominees as $nom)
                <tr class="group hover:bg-[#FDFCF7]/80 transition-all duration-500 border-b border-slate-50 last:border-0">
                    <td class="px-10 py-8">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-2xl bg-[#C5A059]/10 flex items-center justify-center text-[#C5A059] text-xs font-bold shadow-inner">
                                {{ substr($nom->name, 0, 1) }}
                            </div>
                            <span class="text-sm font-medium tracking-tight text-slate-800">{{ $nom->name }}</span>
                        </div>
                    </td>
                    <td class="py-8">
                        <p class="text-[10px] text-slate-500 tracking-wider">{{ $nom->email ?? 'N/A' }}</p>
                        <p class="text-[8px] text-slate-300 tracking-widest uppercase mt-1">{{ $nom->phone ?? 'No Phone' }}</p>
                    </td>
                    <td class="py-8">
                        <span class="text-[10px] uppercase tracking-widest text-[#C5A059] font-bold px-3 py-1 bg-[#C5A059]/5 rounded-lg border border-[#C5A059]/10">
                            {{ $nom->category }}
                        </span>
                    </td>
                    <td class="py-8 text-center">
                        <span class="text-xs font-light text-slate-800">{{ $nom->nomination_count }}</span>
                        <p class="text-[7px] uppercase tracking-tighter text-slate-300">Nominations</p>
                    </td>
                    <td class="px-10 py-8 text-right">
                        <div class="flex justify-end gap-6 opacity-0 group-hover:opacity-100 transition-all duration-300">
                            <form action="{{ route('admin.nominees.destroy', $nom->id) }}" method="POST" onsubmit="return confirm('Archive this nominee?')">
                                @csrf @method('DELETE')
                                <button class="text-[10px] uppercase tracking-widest text-red-300 hover:text-red-500 font-bold transition-colors">Archive</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-20 text-center">
                        <p class="text-[10px] text-slate-300 uppercase tracking-[0.4em] italic">The library is currently empty</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-10 pagination-luminous">
        {{ $nominees->links() }}
    </div>
</div>

<div id="addNomineeModal" class="fixed inset-0 z-[100] hidden bg-slate-900/40 backdrop-blur-sm transition-opacity">
    <div class="flex min-h-full items-center justify-center p-4">
        <div class="relative w-full max-w-xl bg-[#FDFCF7] rounded-[3rem] p-12 border border-[#C5A059]/20 shadow-2xl">
            <span class="modal-close absolute top-8 right-8 text-slate-300 hover:text-[#C5A059] cursor-pointer text-xl transition-colors">&times;</span>
            
            <div class="text-center mb-10">
                <h2 class="text-3xl font-light text-slate-800 tracking-tight">Register Nominee</h2>
                <p class="text-[9px] text-[#C5A059] uppercase tracking-[0.4em] mt-2 font-bold">Prestige Data Entry</p>
            </div>

            <form action="{{ route('admin.nominees.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="group">
                        <label class="block text-[9px] font-bold text-[#C5A059] uppercase tracking-[0.3em] mb-2">Full Name</label>
                        <input type="text" name="name" required class="luminous-input">
                    </div>
                    <div class="group">
                        <label class="block text-[9px] font-bold text-[#C5A059] uppercase tracking-[0.3em] mb-2">Category Segment</label>
                        <input type="text" name="category" required class="luminous-input" placeholder="Select Segment">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="group">
                        <label class="block text-[9px] font-bold text-[#C5A059] uppercase tracking-[0.3em] mb-2">Email</label>
                        <input type="email" name="email" class="luminous-input">
                    </div>
                    <div class="group">
                        <label class="block text-[9px] font-bold text-[#C5A059] uppercase tracking-[0.3em] mb-2">Phone</label>
                        <input type="text" name="phone" class="luminous-input">
                    </div>
                </div>

                <div class="group">
                    <label class="block text-[9px] font-bold text-[#C5A059] uppercase tracking-[0.3em] mb-2">Nomination Reason</label>
                    <textarea name="reason" rows="3" class="luminous-input"></textarea>
                </div>

                <div class="group">
                    <label class="block text-[9px] font-bold text-[#C5A059] uppercase tracking-[0.3em] mb-2">Official Portrait</label>
                    <input type="file" name="image" accept="image/*" class="text-[9px] text-slate-400 file:bg-[#C5A059]/10 file:border-none file:px-4 file:py-2 file:rounded-full file:text-[#C5A059] file:mr-4">
                </div>

                <div class="flex gap-4 pt-6">
                    <button type="submit" class="flex-1 py-5 bg-[#C5A059] text-white rounded-2xl text-[10px] font-bold uppercase tracking-[0.3em] shadow-lg shadow-[#C5A059]/20 hover:scale-[1.02] transition-all">
                        Confirm Registration
                    </button>
                    <button type="button" class="cancel-btn flex-1 py-5 border border-slate-200 text-slate-400 rounded-2xl text-[10px] font-bold uppercase tracking-[0.3em] hover:bg-slate-50 transition-all">
                        Dismiss
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .luminous-input {
        width: 100%;
        background: transparent;
        border-bottom: 1px solid rgba(197, 160, 89, 0.2);
        padding: 0.75rem 0.25rem;
        font-size: 0.9rem;
        font-weight: 300;
        color: #334155;
        transition: all 0.3s;
        outline: none;
    }
    .luminous-input:focus { border-color: #C5A059; }
    
    /* Custom pagination styling to match theme */
    .pagination-luminous nav { background: transparent !important; border: none !important; }
    .pagination-luminous span, .pagination-luminous a { 
        border-radius: 12px !important; 
        color: #C5A059 !important; 
        border-color: rgba(197, 160, 89, 0.1) !important;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const modal = document.getElementById("addNomineeModal");
        const addBtn = document.getElementById("addNomineeBtn");
        const closeX = document.querySelector(".modal-close");
        const cancelBtn = document.querySelector(".cancel-btn");
        const searchInput = document.getElementById("searchInput");

        searchInput.addEventListener("keyup", function() {
            let value = this.value.toLowerCase();
            document.querySelectorAll("#nomineeTable tr").forEach(row => {
                row.style.display = row.innerText.toLowerCase().includes(value) ? "" : "none";
            });
        });

        addBtn.addEventListener("click", () => modal.classList.remove('hidden'));
        [closeX, cancelBtn].forEach(btn => btn.addEventListener("click", () => modal.classList.add('hidden')));
        window.onclick = (e) => { if (e.target === modal) modal.classList.add('hidden'); };
    });
</script>
@endsection