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
            <form id="nominationForm" action="{{ route('nomination.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
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

                {{-- Star Portrait Upload - Updated with Red X --}}
                <div class="space-y-3">
                    <label class="luminous-label">STAR PORTRAIT</label>
                    
                    <!-- Dropzone -->
                    <div id="dropzone" 
                         class="border-2 border-dashed border-amber-400 hover:border-amber-500 bg-white rounded-3xl p-12 text-center cursor-pointer transition-all min-h-[240px] flex flex-col items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-14 h-14 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.502 5.502 0 00-10.78 2.22A4.5 4.5 0 003 15z" />
                        </svg>
                        <p class="text-lg font-semibold text-slate-700">Click to select files</p>
                        <p class="text-sm text-gray-500 mt-1">or drag and drop here</p>
                        <p class="text-xs text-gray-400 mt-3">JPG, PNG, GIF or PDF • Max 50MB</p>
                    </div>

                    <input type="file" id="image" name="image" accept="image/jpeg,image/png,image/gif,application/pdf" class="hidden">

                    <!-- File Preview with Red X -->
                    <div id="file-preview" class="hidden"></div>

                    <!-- Upload Button -->
                    <button type="button" id="upload-btn" 
                            class="hidden w-full py-4 rounded-3xl font-semibold text-white transition-all">
                        Upload Selected File
                    </button>
                </div>

                <div class="flex justify-center pt-8">
                    <button type="submit" id="submit-btn"
                            class="px-20 py-6 bg-slate-900 text-white font-black uppercase tracking-[0.4em] text-[10px] rounded-full hover:bg-[#C5A059] transition-all duration-500 shadow-2xl disabled:opacity-50 disabled:cursor-not-allowed">
                        Submit Nomination
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Category logic
    const categoryData = @json($categories->keyBy('id'));
    const mainSelect = document.getElementById('main-category');
    const subSelect = document.getElementById('sub-category');

    mainSelect.addEventListener('change', function() {
        const subs = categoryData[this.value]?.sub_categories || [];
        subSelect.innerHTML = '<option value="" disabled selected>Choose Sub-Category</option>';
        subs.forEach(sub => {
            const opt = document.createElement('option');
            opt.value = sub.id;
            opt.textContent = sub.name;
            subSelect.appendChild(opt);
        });
        subSelect.disabled = false;
        subSelect.classList.remove('opacity-50');
    });

    // File Upload Logic
    const dropzone = document.getElementById('dropzone');
    const fileInput = document.getElementById('image');
    const previewContainer = document.getElementById('file-preview');
    const uploadBtn = document.getElementById('upload-btn');
    const submitBtn = document.getElementById('submit-btn');
    let selectedFile = null;

    dropzone.addEventListener('click', () => fileInput.click());

    // Drag & Drop
    dropzone.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropzone.classList.add('border-amber-500', 'bg-amber-50');
    });
    dropzone.addEventListener('dragleave', () => dropzone.classList.remove('border-amber-500', 'bg-amber-50'));
    dropzone.addEventListener('drop', (e) => {
        e.preventDefault();
        dropzone.classList.remove('border-amber-500', 'bg-amber-50');
        if (e.dataTransfer.files[0]) handleFileSelection(e.dataTransfer.files[0]);
    });

    fileInput.addEventListener('change', (e) => {
        if (e.target.files[0]) handleFileSelection(e.target.files[0]);
    });

    function handleFileSelection(file) {
        if (!['image/jpeg','image/png','image/gif','application/pdf'].includes(file.type)) {
            alert('Only JPG, PNG, GIF and PDF files are allowed.');
            return;
        }
        if (file.size > 50 * 1024 * 1024) {
            alert('File must be smaller than 50MB.');
            return;
        }

        selectedFile = file;

        previewContainer.innerHTML = `
            <div class="bg-white border border-gray-200 rounded-3xl p-5 flex items-center gap-4">
                <div class="text-amber-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-9 h-9" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v14a2 2 0 002 2" />
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-slate-800 truncate">${file.name}</p>
                    <p class="text-xs text-gray-500">${(file.size / 1024 / 1024).toFixed(2)} MB • Ready to upload</p>
                    <div class="mt-3 h-2 bg-gray-100 rounded-full overflow-hidden">
                        <div id="progress-bar" class="h-full bg-gradient-to-r from-amber-500 to-yellow-600 w-0 transition-all duration-300"></div>
                    </div>
                </div>
                <!-- Red X Icon -->
                <button id="remove-btn" class="text-red-500 hover:text-red-600 text-2xl leading-none w-8 h-8 flex items-center justify-center hover:bg-red-50 rounded-xl transition-colors">
                    ✕
                </button>
            </div>
        `;

        previewContainer.classList.remove('hidden');
        uploadBtn.classList.remove('hidden');
        uploadBtn.textContent = 'Upload Selected File';
        uploadBtn.style.backgroundColor = '#0f172a';
        dropzone.classList.add('hidden');
        submitBtn.disabled = true;
    }

    // Handle remove button click
    previewContainer.addEventListener('click', function(e) {
        if (e.target.id === 'remove-btn' || e.target.closest('#remove-btn')) {
            resetUpload();
        }
    });

    function resetUpload() {
        selectedFile = null;
        previewContainer.innerHTML = '';
        previewContainer.classList.add('hidden');
        uploadBtn.classList.add('hidden');
        dropzone.classList.remove('hidden');
        fileInput.value = '';
        submitBtn.disabled = true;
    }

    // Upload button - fills progress bar and changes to "File Ready"
    uploadBtn.addEventListener('click', () => {
        if (!selectedFile) return;

        const progressBar = document.getElementById('progress-bar');
        let progress = 0;

        const interval = setInterval(() => {
            progress += 15;
            if (progress > 100) progress = 100;
            progressBar.style.width = `${progress}%`;

            if (progress >= 100) {
                clearInterval(interval);
                uploadBtn.innerHTML = '✓ File Ready for Submission';
                uploadBtn.style.backgroundColor = '#d97706'; // amber-600
                submitBtn.disabled = false;
            }
        }, 70);
    });

    // Form validation
    document.getElementById('nominationForm').addEventListener('submit', function(e) {
        if (!selectedFile) {
            e.preventDefault();
            alert('Please upload a Star Portrait before submitting.');
        }
    });
</script>

<style>
    .luminous-label { 
        display: block; 
        font-size: 9px; 
        font-weight: 900; 
        text-transform: uppercase; 
        letter-spacing: 0.3em; 
        color: #94a3b8; 
        margin-bottom: 0.5rem; 
    }
    .luminous-input { 
        width: 100%; 
        background: #FDFCF7; 
        border: 1px solid rgba(0,0,0,0.05); 
        border-radius: 1.5rem; 
        padding: 1.25rem 1.5rem; 
        font-weight: 700; 
        outline: none; 
        transition: 0.3s; 
        font-size: 0.85rem; 
    }
    .luminous-input:focus { 
        border-color: #C5A059; 
        background: white; 
    }
</style>
@endsection