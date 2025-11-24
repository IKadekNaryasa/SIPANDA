<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SI-PANDA Kesbangpol Buleleng</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="application/ld+json">
        @verbatim {
            "@context": "https://schema.org",
            "@type": "GovernmentOrganization",
            "name": "SI-PANDA Kesbangpol Buleleng",
            "description": "Sistem Informasi Pembayaran Pajak Kendaraan Dinas Operasional Kesbangpol Buleleng",
            "url": "https://sipanda-kesbangpol.iknproject.site",
            "address": {
                "@type": "PostalAddress",
                "streetAddress": "Jl. Sudirman No.60",
                "addressLocality": "Singaraja",
                "addressRegion": "Bali",
                "addressCountry": "ID"
            },
            "telephone": "(0362) 3312427",
            "email": "bkbp@bulelengkab.go.id"
        }
        @endverbatim
    </script>
</head>

<body class="bg-gray-50">


    @if (session('success'))
    <script>
        Swal.fire({
            position: "top-center",
            icon: "success",
            title: "See you...",
            showConfirmButton: false,
            timer: 1500
        });
    </script>
    @endif

    @if ($errors->any())
    <script>
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Something went wrong!",
        });
    </script>
    @endif
    <!-- Navbar -->
    <header>
        <nav class="bg-white shadow-md sticky top-0 z-50">
            <div class="container mx-auto px-4 sm:px-6 py-3 sm:py-4">
                <div class="flex items-center justify-between">
                    <!-- Logo -->
                    <div class="flex items-center space-x-2 sm:space-x-3">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 bg-linear-to-br from-blue-600 to-blue-400 rounded-lg flex items-center justify-center shrink-0">
                            <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-base sm:text-xl font-bold text-gray-800">SI-PANDA</h1>
                            <p class="text-xs text-gray-600 hidden sm:block">Kesbangpol Buleleng</p>
                        </div>
                    </div>

                    <!-- Menu Login -->
                    <div>
                        <a href="{{ route('login') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 sm:px-6 py-2 rounded-lg font-medium transition duration-300 flex items-center space-x-1 sm:space-x-2 text-sm sm:text-base">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                            </svg>
                            <span>Login</span>
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <main>
        <section class="container mx-auto px-4 sm:px-6 py-8 sm:py-12 lg:py-0">
            <div class="grid lg:grid-cols-2 gap-8 lg:gap-12 items-center">
                <!-- Content -->
                <div class="space-y-4 sm:space-y-6">
                    <div>
                        <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-800 mb-2">SI-PANDA</h2>
                        <h3 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-blue-600 mb-4 sm:mb-6">Kesbangpol Buleleng</h3>
                    </div>

                    <p class="text-gray-600 text-base sm:text-lg leading-relaxed">
                        Selamat Datang di Sistem Informasi Pembayaran Pajak Kendaraan Dinas Operasional Kesbangpol Buleleng
                    </p>

                    <div class="bg-white p-4 sm:p-6 rounded-xl shadow-lg border border-gray-100">
                        <h4 class="font-semibold text-gray-800 mb-3 flex items-center text-sm sm:text-base">
                            <svg class="w-5 h-5 text-blue-600 mr-2 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Tentang Aplikasi
                        </h4>
                        <p class="text-gray-600 leading-relaxed text-sm sm:text-base">
                            <span class="font-semibold text-blue-600">SI-PANDA Kesbangpol Buleleng</span> adalah sistem informasi yang dirancang untuk mengelola dan menyimpan data kendaraan dinas Kesbangpol Buleleng secara digital dan terstruktur.
                        </p>
                        <p class="text-gray-600 leading-relaxed mt-3 text-sm sm:text-base">
                            Dilengkapi dengan fitur <span class="font-semibold text-orange-600">Pengingat Otomatis</span> yang akan memberikan notifikasi pengingat ketika kendaraan dinas mendekati atau telah jatuh tempo pembayaran pajak (SAMSAT), sehingga memastikan seluruh kendaraan dinas selalu taat administrasi dan terhindar dari denda keterlambatan.
                        </p>
                    </div>

                </div>

                <!-- Illustration -->
                <div class="relative order-first lg:order-last">
                    <div class="relative z-10">
                        <img src="{{ asset('img/sipanda.png') }}" alt="Data Management Illustration" class="w-full h-auto drop-shadow-2xl">
                    </div>
                    <!-- Decorative Elements -->
                    <div class="absolute top-10 right-10 w-16 h-16 sm:w-20 sm:h-20 bg-blue-200 rounded-full opacity-50 animate-pulse"></div>
                    <div class="absolute bottom-10 left-10 w-12 h-12 sm:w-16 sm:h-16 bg-orange-200 rounded-full opacity-50 animate-pulse" style="animation-delay: 1s;"></div>
                </div>
            </div>
        </section>


        <!-- Features Section -->
        <section class="bg-white py-12 sm:py-16">
            <div class="container mx-auto px-4 sm:px-6">
                <h3 class="text-2xl sm:text-3xl font-bold text-center text-gray-800 mb-8 sm:mb-12">Fitur Unggulan</h3>
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                    <div class="text-center p-4 sm:p-6 rounded-xl hover:shadow-xl transition duration-300 border border-gray-100">
                        <div class="w-14 h-14 sm:w-16 sm:h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3 sm:mb-4">
                            <svg class="w-7 h-7 sm:w-8 sm:h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                        </div>
                        <h4 class="font-bold text-base sm:text-lg mb-2 text-gray-800">Database Terpusat</h4>
                        <p class="text-gray-600 text-sm sm:text-base">Semua data kendaraan dinas tersimpan dalam satu sistem</p>
                    </div>

                    <div class="text-center p-4 sm:p-6 rounded-xl hover:shadow-xl transition duration-300 border border-gray-100">
                        <div class="w-14 h-14 sm:w-16 sm:h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3 sm:mb-4">
                            <svg class="w-7 h-7 sm:w-8 sm:h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h4 class="font-bold text-base sm:text-lg mb-2 text-gray-800">Monitoring Jatuh Tempo</h4>
                        <p class="text-gray-600 text-sm sm:text-base">Pantau tanggal jatuh tempo pajak SAMSAT setiap kendaraan dengan mudah</p>
                    </div>

                    <div class="text-center p-4 sm:p-6 rounded-xl hover:shadow-xl transition duration-300 border border-gray-100 sm:col-span-2 lg:col-span-1">
                        <div class="w-14 h-14 sm:w-16 sm:h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-3 sm:mb-4">
                            <svg class="w-7 h-7 sm:w-8 sm:h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                            </svg>
                        </div>
                        <h4 class="font-bold text-base sm:text-lg mb-2 text-gray-800">Notifikasi Otomatis</h4>
                        <p class="text-gray-600 text-sm sm:text-base">Dapatkan pengingat otomatis sebelum masa berlaku pajak habis</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-[#0a2e4d] text-white py-8 sm:py-12">
        <div class="container mx-auto px-4 sm:px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-12">
                <div class="text-center md:text-left">
                    <h3 class="text-xl sm:text-2xl font-bold mb-4">SI-PANDA</h3>
                    <p class="text-gray-300 text-sm sm:text-base leading-relaxed">
                        Sistem Informasi Pembayaran Pajak Kendaraan Dinas Operasinal
                    </p>
                </div>

                <div class="text-center md:text-left">
                    <h3 class="text-xl sm:text-2xl font-bold mb-4">Kontak</h3>
                    <div class="space-y-3">
                        <div class="flex items-start justify-center md:justify-start gap-3">
                            <svg class="w-5 h-5 mt-1 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-gray-300 text-sm sm:text-base">Jl. Sudirman No.60 Singaraja</span>
                        </div>
                        <div class="flex items-center justify-center md:justify-start gap-3">
                            <svg class="w-5 h-5 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                            </svg>
                            <span class="text-gray-300 text-sm sm:text-base">(0362) 3312427</span>
                        </div>
                        <div class="flex items-center justify-center md:justify-start gap-3">
                            <svg class="w-5 h-5 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                            </svg>
                            <span class="text-gray-300 text-sm sm:text-base">bkbp@bulelengkab.go.id</span>
                        </div>
                    </div>
                </div>

                <div class="text-center md:text-left">
                    <h3 class="text-xl sm:text-2xl font-bold mb-4">Sosial Media</h3>
                    <div class="flex justify-center md:justify-start gap-3 flex-wrap">
                        <a href="#" class="w-12 h-12 rounded-full border-2 border-white flex items-center justify-center hover:bg-white hover:text-[#0a2e4d] transition-all duration-300">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                        </a>
                        <a href="#" class="w-12 h-12 rounded-full border-2 border-white flex items-center justify-center hover:bg-white hover:text-[#0a2e4d] transition-all duration-300">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                            </svg>
                        </a>
                        <a href="#" class="w-12 h-12 rounded-full border-2 border-white flex items-center justify-center hover:bg-white hover:text-[#0a2e4d] transition-all duration-300">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                            </svg>
                        </a>
                        <a href="#" class="w-12 h-12 rounded-full border-2 border-white flex items-center justify-center hover:bg-white hover:text-[#0a2e4d] transition-all duration-300">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z" />
                            </svg>
                        </a>
                        <a href="#" class="w-12 h-12 rounded-full border-2 border-white flex items-center justify-center hover:bg-white hover:text-[#0a2e4d] transition-all duration-300">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-gray-600 text-center">
                <p class="text-gray-400 text-xs sm:text-sm">&copy; 2025 - {{ date('Y') }} SI-PANDA. Prakom Kesbangpol</p>
            </div>
        </div>
    </footer>
</body>

</html>