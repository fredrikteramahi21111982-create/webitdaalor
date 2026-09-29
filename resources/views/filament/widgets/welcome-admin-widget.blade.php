<x-filament-widgets::widget>
    <x-filament::section class="bg-gradient-to-r from-blue-700 to-cyan-600 text-white relative overflow-hidden border-0 shadow-lg">
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10 mix-blend-overlay"></div>
        <div class="absolute -right-20 -top-20 w-64 h-64 bg-white opacity-10 rounded-full blur-3xl"></div>
        
        <div class="relative z-10 p-4 sm:p-6 flex flex-col sm:flex-row items-center sm:items-start gap-6">
            <div class="hidden sm:block flex-shrink-0 bg-white p-2 rounded-2xl shadow-xl">
                <img src="{{ asset('images/logo_alor.png') }}" alt="Logo Alor" class="h-20 w-20 object-contain">
            </div>
            
            <div class="flex-grow text-center sm:text-left">
                <h2 class="text-2xl sm:text-3xl font-bold tracking-tight mb-2">
                    Selamat Datang di Portal Admin!
                </h2>
                <p class="text-blue-100 text-sm sm:text-base font-medium max-w-2xl leading-relaxed">
                    Sistem Pengelolaan Konten (CMS) Inspektorat Daerah Kabupaten Alor. Gunakan panel ini untuk mengelola Berita, Profil, Dokumen Publik, dan Tautan Layanan dengan mudah.
                </p>
                <div class="mt-6 flex flex-wrap gap-3 justify-center sm:justify-start">
                    <a href="{{ url('/') }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-white/20 hover:bg-white/30 backdrop-blur text-white text-sm font-semibold rounded-lg transition-colors border border-white/20">
                        <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                        Lihat Website Publik
                    </a>
                </div>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
