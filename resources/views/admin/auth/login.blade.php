<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Awards Luminous</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { 
            background-color: #FDFCF7; /* Soft Cream */
            background-image: radial-gradient(circle at 20% 30%, rgba(197, 160, 89, 0.05) 0%, transparent 40%),
                              radial-gradient(circle at 80% 70%, rgba(197, 160, 89, 0.08) 0%, transparent 40%);
            font-family: 'Poppins', sans-serif; 
        }
        .iridescent-glass {
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(197, 160, 89, 0.2);
            box-shadow: 0 10px 30px -10px rgba(197, 160, 89, 0.15);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-6">

    <div class="iridescent-glass p-12 rounded-[2.5rem] w-full max-w-md border border-[#C5A059]/10">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-light tracking-widest text-[#C5A059] uppercase">
                AWARDS
            </h1>
            <div class="h-[1px] w-12 bg-[#C5A059]/30 mx-auto mt-4"></div>
            <p class="text-slate-400 text-[9px] tracking-[0.4em] uppercase mt-4">Luminous Edition</p>
        </div>

        @if(session('error'))
            <div class="bg-red-50 text-red-500 border border-red-100 px-4 py-3 rounded-xl mb-6 text-xs text-center">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-8">
            @csrf

            <div class="space-y-2">
                <label for="email" class="block text-[#C5A059] text-[10px] font-bold uppercase tracking-widest ml-1">Official Email</label>
                <input type="email" name="email" id="email" required
                    class="w-full px-5 py-4 rounded-2xl bg-white/40 border border-[#C5A059]/20 focus:border-[#C5A059] focus:ring-4 focus:ring-[#C5A059]/5 focus:outline-none transition-all placeholder-slate-300 text-slate-700"
                    placeholder="admin@awards.com">
            </div>

            <div class="space-y-2">
                <label for="password" class="block text-[#C5A059] text-[10px] font-bold uppercase tracking-widest ml-1">Security Key</label>
                <input type="password" name="password" id="password" required
                    class="w-full px-5 py-4 rounded-2xl bg-white/40 border border-[#C5A059]/20 focus:border-[#C5A059] focus:ring-4 focus:ring-[#C5A059]/5 focus:outline-none transition-all placeholder-slate-300 text-slate-700"
                    placeholder="••••••••">
            </div>

            <button type="submit"
                class="w-full bg-[#C5A059] hover:bg-[#B38F4D] text-[#FDFCF7] font-semibold py-4 rounded-2xl shadow-xl shadow-[#C5A059]/20 transition-all hover:translate-y-[-2px] active:scale-95 uppercase tracking-widest text-xs">
                Enter Portal
            </button>
        </form>

        <div class="mt-12 pt-8 border-t border-[#C5A059]/10 text-center">
            <p class="text-slate-400 text-[9px] tracking-[0.2em] uppercase">
                &copy; {{ date('Y') }} Prestige Management
            </p>
        </div>
    </div>

</body>
</html>