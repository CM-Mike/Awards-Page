@extends('layouts.app')

@section('content')

<style>
    body {
        background: linear-gradient(135deg, #0b1c2d, #0f3057);
        font-family: 'Poppins', sans-serif;
    }

    .glass {
        backdrop-filter: blur(18px);
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 215, 0, 0.3);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4);
        border-radius: 20px;
    }

    .gold-text {
        color: #FFD700;
    }

    .gold-btn {
        background: linear-gradient(45deg, #FFD700, #e6c200);
        color: #0b1c2d;
        font-weight: bold;
        transition: 0.3s ease;
    }

    .gold-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(255, 215, 0, 0.6);
    }

    .social-tile {
        transition: 0.3s ease;
    }

    .social-tile:hover {
        transform: translateY(-5px);
        background: rgba(255, 215, 0, 0.15);
    }
</style>

<div class="container mx-auto px-4 py-16">

    <h1 class="text-4xl md:text-5xl font-bold text-center gold-text mb-12 animate-pulse">
        Contact Us
    </h1>

    <div class="grid md:grid-cols-2 gap-10">

        <!-- SOCIAL INFO -->
        <div class="space-y-6">

            <div class="glass p-6 social-tile">
                <h3 class="gold-text text-xl font-semibold">📍 Location</h3>
                <p class="text-white mt-2">Nairobi, Kenya</p>
            </div>

            <div class="glass p-6 social-tile">
                <h3 class="gold-text text-xl font-semibold">📞 Phone</h3>
                <p class="text-white mt-2">+254 700 000 000</p>
            </div>

            <div class="glass p-6 social-tile">
                <h3 class="gold-text text-xl font-semibold">✉ Email</h3>
                <p class="text-white mt-2">info@awardplatform.com</p>
            </div>

            <div class="glass p-6 social-tile">
                <h3 class="gold-text text-xl font-semibold mb-3">🌐 Follow Us</h3>
                 <div class="flex justify-center md:justify-start space-x-5 text-2xl">
        <!-- Facebook -->
        <a href="https://facebook.com/yourpage" target="_blank" class="hover:text-yellow-400 transition">
            <i class="fab fa-facebook-f"></i>
        </a>

        <!-- TikTok -->
        <a href="https://tiktok.com/@yourhandle" target="_blank" class="hover:text-yellow-400 transition">
            <i class="fab fa-tiktok"></i>
        </a>

        <!-- Instagram -->
        <a href="https://instagram.com/yourhandle" target="_blank" class="hover:text-yellow-400 transition">
            <i class="fab fa-instagram"></i>
        </a>

        <!-- Twitter -->
        <a href="https://twitter.com/yourhandle" target="_blank" class="hover:text-yellow-400 transition">
            <i class="fab fa-twitter"></i>
        </a>
    </div>
            </div>

        </div>

        <!-- CONTACT FORM -->
        <div class="glass p-8">

            <form method="POST" action="#">
                @csrf

                <div class="mb-5">
                    <label class="block text-white mb-2">Full Name</label>
                    <input type="text" name="name"
                        class="w-full px-4 py-3 rounded-lg bg-white/10 text-white border border-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-400"
                        required>
                </div>

                <div class="mb-5">
                    <label class="block text-white mb-2">Email Address</label>
                    <input type="email" name="email"
                        class="w-full px-4 py-3 rounded-lg bg-white/10 text-white border border-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-400"
                        required>
                </div>

                <div class="mb-5">
                    <label class="block text-white mb-2">Subject</label>
                    <input type="text" name="subject"
                        class="w-full px-4 py-3 rounded-lg bg-white/10 text-white border border-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                </div>

                <div class="mb-6">
                    <label class="block text-white mb-2">Message</label>
                    <textarea name="message" rows="5"
                        class="w-full px-4 py-3 rounded-lg bg-white/10 text-white border border-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-400"
                        required></textarea>
                </div>

                <button type="submit" class="gold-btn w-full py-3 rounded-lg">
                    Send Message
                </button>

            </form>

        </div>

    </div>

</div>


@endsection