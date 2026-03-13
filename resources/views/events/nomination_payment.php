<div class="min-h-screen flex items-center justify-center bg-gradient-to-b from-blue-50 to-blue-200 px-4 py-10">

    <!-- Centered Glassmorphic Card -->
    <div class="max-w-md w-full bg-white/20 backdrop-blur-md border border-white/30 rounded-3xl shadow-xl p-8 flex flex-col gap-6 animate-fade-in">

        <!-- Header -->
        <h2 class="text-2xl font-bold text-gray-900 text-center">
            Additional Nominations Require Payment
        </h2>

        <!-- Info -->
        <p class="text-gray-800 text-center">
            Your first nomination is free.<br>
            Extra nominations cost <strong>KSh 10</strong>.
        </p>

        <!-- Payment Form -->
        <form method="POST" action="{{ route('nomination.pay.process', $nominee->id ?? 0) }}" class="flex flex-col gap-4">

            @csrf

            <!-- M-Pesa Phone Field -->
            <div class="flex flex-col gap-2">
                <label for="phone" class="text-gray-900 font-semibold uppercase tracking-wide text-sm">
                    Enter M-Pesa Phone
                </label>
                <input 
                    type="text" 
                    id="phone" 
                    name="phone" 
                    placeholder="+2547xxxxxxx"
                    class="w-full p-3 rounded-xl bg-white/30 placeholder-gray-600 text-gray-900 border border-white/40 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:bg-white transition duration-300"
                    required
                >
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="w-full bg-green-500 text-white font-semibold p-3 rounded-xl hover:bg-green-600 transition transform hover:scale-105 shadow-md">
                Pay KSh 10 via M-Pesa
            </button>
        </form>

        <!-- Footer Info -->
        <p class="text-xs text-gray-700 text-center mt-2">
            Secure payment via M-Pesa. Ensure your phone number is correct.
        </p>
    </div>
</div>

<style>
/* Fade-in animation */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-15px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-fade-in {
    animation: fadeIn 0.6s ease-out forwards;
}

/* Input focus effect */
input:focus {
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .max-w-md {
        padding: 2rem !important;
    }
}
</style>