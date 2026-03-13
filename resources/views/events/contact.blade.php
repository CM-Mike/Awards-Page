@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#FDFCF7] relative overflow-hidden pt-20">
    
    {{-- Soft Iridescent Blurs --}}
    <div class="absolute top-[-10%] left-[-10%] w-[60%] h-[60%] bg-orange-100/30 rounded-full blur-[120px]"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-[50%] h-[50%] bg-blue-50/30 rounded-full blur-[120px]"></div>

    <div class="container mx-auto px-6 py-24 relative z-10">
        
        <div class="max-w-3xl mx-auto text-center mb-20">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white border border-black/5 mb-8 shadow-sm">
                <span class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-400">Concierge Service</span>
            </div>
            <h1 class="text-6xl md:text-7xl font-black text-slate-900 tracking-tighter leading-none uppercase mb-6">
                GET IN <span class="italic font-serif text-transparent bg-clip-text bg-gradient-to-r from-yellow-700 to-amber-500">TOUCH</span>
            </h1>
            <p class="text-slate-500 text-lg font-serif italic">
                Whether you're a nominee, a partner, or a dreamer, we're here to listen.
            </p>
        </div>

        <div class="grid lg:grid-cols-12 gap-16 items-start">

            <div class="lg:col-span-5 space-y-8">
                
                @foreach([
                    ['icon' => 'fa-location-dot', 'title' => 'The Residency', 'detail' => 'Nairobi, Kenya • Thika Road'],
                    ['icon' => 'fa-phone', 'title' => 'Voice', 'detail' => '+254 712 345 678'],
                    ['icon' => 'fa-envelope', 'title' => 'Correspondence', 'detail' => 'info@awardplatform.co.ke']
                ] as $info)
                <div class="group bg-white border border-black/5 p-8 rounded-[2rem] shadow-sm hover:shadow-xl transition-all duration-500">
                    <div class="flex items-center gap-6">
                        <div class="w-14 h-14 rounded-2xl bg-[#FDFCF7] border border-black/5 flex items-center justify-center text-gold group-hover:bg-black group-hover:text-white transition-all duration-500">
                            <i class="fa-solid {{ $info['icon'] }} text-xl"></i>
                        </div>
                        <div>
                            <h4 class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-1">{{ $info['title'] }}</h4>
                            <p class="text-lg font-bold text-slate-900">{{ $info['detail'] }}</p>
                        </div>
                    </div>
                </div>
                @endforeach

                <div class="bg-white border border-black/5 p-8 rounded-[2rem] shadow-sm">
                    <h4 class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-6 text-center">Digital Presence</h4>
                    <div class="flex justify-center gap-6">
                        @foreach(['facebook-f', 'tiktok', 'instagram', 'twitter'] as $social)
                        <a href="#" class="w-12 h-12 rounded-full border border-black/5 flex items-center justify-center text-slate-400 hover:text-gold hover:border-gold hover:-translate-y-1 transition-all">
                            <i class="fab fa-{{ $social }}"></i>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="lg:col-span-7">
                <div class="bg-white border border-black/5 p-10 md:p-16 rounded-[3rem] shadow-2xl relative overflow-hidden">
                    {{-- Decorative Corner Accent --}}
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gold/5 rounded-bl-full translate-x-12 -translate-y-12"></div>

                    <form method="POST" action="#" class="space-y-8">
                        @csrf

                        <div class="grid md:grid-cols-2 gap-8">
                            <div class="space-y-2">
                                <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-2">Your Name</label>
                                <input type="text" name="name" placeholder="Goodness Gibendi"
                                    class="w-full px-6 py-4 rounded-2xl bg-[#FDFCF7] border border-black/5 focus:outline-none focus:border-gold/50 focus:ring-4 focus:ring-gold/5 transition-all font-bold text-slate-900" required>
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-2">Email Address</label>
                                <input type="email" name="email" placeholder="hello@bibakenya.com"
                                    class="w-full px-6 py-4 rounded-2xl bg-[#FDFCF7] border border-black/5 focus:outline-none focus:border-gold/50 focus:ring-4 focus:ring-gold/5 transition-all font-bold text-slate-900" required>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-2">Subject</label>
                            <input type="text" name="subject" placeholder="Partnership Inquiry"
                                class="w-full px-6 py-4 rounded-2xl bg-[#FDFCF7] border border-black/5 focus:outline-none focus:border-gold/50 focus:ring-4 focus:ring-gold/5 transition-all font-bold text-slate-900">
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-2">Message</label>
                            <textarea name="message" rows="5" placeholder="Tell us about your vision..."
                                class="w-full px-6 py-4 rounded-2xl bg-[#FDFCF7] border border-black/5 focus:outline-none focus:border-gold/50 focus:ring-4 focus:ring-gold/5 transition-all font-bold text-slate-900 resize-none" required></textarea>
                        </div>

                        <button type="submit" class="w-full py-5 bg-black text-white font-black uppercase tracking-widest text-xs rounded-full hover:bg-gold hover:shadow-2xl hover:-translate-y-1 transition-all duration-500">
                            Send Correspondence
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    /* Styling for placeholders to match the soft theme */
    ::placeholder { color: #cbd5e1; font-weight: normal; }
</style>
@endsection