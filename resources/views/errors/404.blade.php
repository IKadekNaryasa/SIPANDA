<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        @keyframes pulse-glow {

            0%,
            100% {
                opacity: 0.5;
            }

            50% {
                opacity: 1;
            }
        }

        .float {
            animation: float 3s ease-in-out infinite;
        }

        .pulse-glow {
            animation: pulse-glow 2s ease-in-out infinite;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-purple-900 via-blue-900 to-indigo-900 min-h-screen flex items-center justify-center p-4 overflow-hidden relative">

    <!-- Background animated circles -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute top-20 left-20 w-64 h-64 bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 pulse-glow"></div>
        <div class="absolute top-40 right-20 w-96 h-96 bg-blue-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 pulse-glow" style="animation-delay: 1s;"></div>
        <div class="absolute bottom-20 left-1/3 w-80 h-80 bg-pink-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 pulse-glow" style="animation-delay: 2s;"></div>
    </div>

    <!-- Main Content -->
    <div class="relative z-10 text-center max-w-4xl mx-auto">

        <!-- 404 Number with glow effect -->
        <div class="float mb-8">
            <h1 class="text-9xl md:text-[12rem] font-black text-transparent bg-clip-text bg-gradient-to-r from-purple-400 via-pink-400 to-blue-400 drop-shadow-2xl mb-4">
                404
            </h1>
            <div class="absolute inset-0 blur-3xl opacity-30">
                <h1 class="text-9xl md:text-[12rem] font-black text-transparent bg-clip-text bg-gradient-to-r from-purple-400 via-pink-400 to-blue-400">
                    404
                </h1>
            </div>
        </div>

        <!-- Icon -->
        <div class="mb-8 float" style="animation-delay: 0.5s;">
            <svg class="w-32 h-32 mx-auto text-white opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </div>

        <!-- Text -->
        <h2 class="text-3xl md:text-5xl font-bold text-white mb-4">
            Oops! Halaman Tidak Ditemukan
        </h2>
        <p class="text-lg md:text-xl text-gray-300 mb-8 max-w-2xl mx-auto">
            Sepertinya halaman yang Anda cari sedang berlibur atau mungkin tidak pernah ada. Mari kembali ke jalur yang benar!
        </p>

        <!-- Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
            <a href="/" class="group relative px-8 py-4 bg-gradient-to-r from-purple-500 to-pink-500 text-white font-semibold rounded-full overflow-hidden transition-all duration-300 hover:scale-105 hover:shadow-2xl hover:shadow-purple-500/50">
                <span class="relative z-10">Kembali ke Beranda</span>
                <div class="absolute inset-0 bg-gradient-to-r from-pink-500 to-purple-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            </a>

            <button onclick="window.history.back()" class="px-8 py-4 bg-white/10 backdrop-blur-sm text-white font-semibold rounded-full border-2 border-white/30 hover:bg-white/20 hover:border-white/50 transition-all duration-300 hover:scale-105">
                Halaman Sebelumnya
            </button>
        </div>

        <!-- Additional Links -->
        <div class="mt-12 flex flex-wrap gap-6 justify-center text-sm">
            <a href="/" class="text-gray-300 hover:text-white transition-colors duration-300">Beranda</a>
            <span class="text-gray-600">•</span>
            <a href="/contact" class="text-gray-300 hover:text-white transition-colors duration-300">Kontak</a>
            <span class="text-gray-600">•</span>
            <a href="/help" class="text-gray-300 hover:text-white transition-colors duration-300">Bantuan</a>
        </div>
    </div>

    <!-- Particles effect -->
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-1/4 left-1/4 w-2 h-2 bg-white rounded-full opacity-60 float"></div>
        <div class="absolute top-1/3 right-1/3 w-3 h-3 bg-purple-300 rounded-full opacity-40 float" style="animation-delay: 1s;"></div>
        <div class="absolute bottom-1/4 left-1/3 w-2 h-2 bg-pink-300 rounded-full opacity-50 float" style="animation-delay: 2s;"></div>
        <div class="absolute top-2/3 right-1/4 w-3 h-3 bg-blue-300 rounded-full opacity-30 float" style="animation-delay: 1.5s;"></div>
    </div>

</body>

</html>