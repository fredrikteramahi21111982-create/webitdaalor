<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inspektorat Daerah Kabupaten Alor</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- AlpineJS for Interactive Components -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Outfit', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased flex flex-col min-h-screen selection:bg-blue-600 selection:text-white">
    
    <!-- Navbar -->
    <header class="bg-white/80 backdrop-blur-xl border-b border-white/20 shadow-sm sticky top-0 z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex-shrink-0 flex items-center">
                    <a href="/" class="flex items-center gap-3">
                        <img class="h-12 w-auto" src="{{ asset('images/logo_alor.png') }}" alt="Logo Alor">
                        <div>
                            <h1 class="text-xl font-bold text-blue-900 leading-tight">INSPEKTORAT DAERAH</h1>
                            <p class="text-xs text-gray-500 font-semibold uppercase tracking-wider">Kabupaten Alor</p>
                        </div>
                    </a>
                </div>
                <!-- Desktop Menu -->
                <nav class="hidden md:flex space-x-8">
                    <a href="/" class="text-gray-700 hover:text-blue-700 font-medium transition">Beranda</a>
                    
                    <!-- Dropdown Profil -->
                    <div class="relative group">
                        <button class="text-gray-700 group-hover:text-blue-700 font-medium transition flex items-center gap-1">
                            Profil
                            <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div class="absolute left-0 mt-6 w-48 bg-white border border-gray-100 rounded-xl shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform origin-top-left scale-95 group-hover:scale-100 z-50">
                            <!-- Invisible bridge to keep hover active -->
                            <div class="absolute -top-6 left-0 right-0 h-6 bg-transparent"></div>
                            
                            <div class="py-2">
                                @if(isset($globalPages) && $globalPages->count() > 0)
                                    @foreach($globalPages as $p)
                                        <a href="/{{ $p->slug }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition">{{ $p->title }}</a>
                                    @endforeach
                                @else
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-400 italic">Belum ada halaman</a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Dropdown Dokumen -->
                    <div class="relative group">
                        <a href="/dokumen" class="text-gray-700 group-hover:text-blue-700 font-medium transition flex items-center gap-1">
                            Dokumen
                            <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </a>
                        <div class="absolute left-0 mt-6 w-56 bg-white border border-gray-100 rounded-xl shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform origin-top-left scale-95 group-hover:scale-100 z-50">
                            <!-- Invisible bridge to keep hover active -->
                            <div class="absolute -top-6 left-0 right-0 h-6 bg-transparent"></div>
                            
                            <div class="py-2">
                                <a href="/dokumen" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition font-bold border-b border-gray-50 mb-1">Semua Dokumen</a>
                                @if(isset($globalDocCategories) && $globalDocCategories->count() > 0)
                                    @foreach($globalDocCategories as $dc)
                                        <a href="/dokumen?kategori={{ $dc->slug }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition">{{ $dc->name }}</a>
                                    @endforeach
                                @else
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-400 italic">Belum ada kategori</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <a href="/berita" class="text-gray-700 hover:text-blue-700 font-medium transition">Berita</a>
                    <a href="/kontak" class="text-gray-700 hover:text-blue-700 font-medium transition">Kontak</a>
                </nav>
                <!-- Admin Login (Desktop) -->
                <div class="hidden md:flex items-center">
                    <a href="/admin" class="bg-blue-700 text-white px-5 py-2 rounded-lg hover:bg-blue-800 font-medium transition shadow-sm">Login Admin</a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="flex items-center md:hidden">
                    <button type="button" id="mobile-menu-button" class="text-gray-500 hover:text-blue-700 focus:outline-none p-2" aria-controls="mobile-menu" aria-expanded="false" aria-label="Buka menu utama">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu (Drawer) -->
        <div class="md:hidden hidden bg-white border-t border-gray-100 shadow-lg absolute w-full left-0 top-full" id="mobile-menu">
            <div class="px-4 pt-2 pb-6 space-y-1">
                <a href="/" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-blue-700 hover:bg-blue-50">Beranda</a>
                
                <div class="space-y-1">
                    <p class="px-3 py-2 text-sm font-bold text-gray-400 uppercase tracking-wider">Profil</p>
                    <div class="pl-4 space-y-1 border-l-2 border-gray-100 ml-4">
                        @if(isset($globalPages) && $globalPages->count() > 0)
                            @foreach($globalPages as $p)
                                <a href="/{{ $p->slug }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-blue-700 hover:bg-blue-50">{{ $p->title }}</a>
                            @endforeach
                        @else
                            <a href="#" class="block px-3 py-2 text-sm text-gray-400 italic">Belum ada halaman</a>
                        @endif
                    </div>
                </div>

                <div class="space-y-1 mt-4">
                    <p class="px-3 py-2 text-sm font-bold text-gray-400 uppercase tracking-wider">Dokumen</p>
                    <div class="pl-4 space-y-1 border-l-2 border-gray-100 ml-4">
                        <a href="/dokumen" class="block px-3 py-2 rounded-md text-base font-medium text-blue-600 hover:bg-blue-50">Semua Dokumen</a>
                        @if(isset($globalDocCategories) && $globalDocCategories->count() > 0)
                            @foreach($globalDocCategories as $dc)
                                <a href="/dokumen?kategori={{ $dc->slug }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-blue-700 hover:bg-blue-50">{{ $dc->name }}</a>
                            @endforeach
                        @endif
                    </div>
                </div>

                <a href="/berita" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-blue-700 hover:bg-blue-50 mt-4">Berita</a>
                <a href="/kontak" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-blue-700 hover:bg-blue-50">Kontak</a>
                
                <div class="mt-6 pt-4 border-t border-gray-100">
                    <a href="/admin" class="w-full text-center block bg-blue-700 text-white px-5 py-3 rounded-xl hover:bg-blue-800 font-medium transition shadow-sm">Login Admin</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 text-white mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div>
                    <div class="flex items-center gap-3 mb-6">
                        <img class="h-12 w-auto" src="{{ asset('images/logo_alor.png') }}" alt="Logo Alor">
                        <div>
                            <h2 class="text-lg font-bold text-white">Inspektorat Daerah</h2>
                            <p class="text-sm text-gray-400">Kabupaten Alor</p>
                        </div>
                    </div>
                    <p class="text-gray-400 text-sm leading-relaxed mb-4">
                        Menjadi lembaga pengawas internal yang profesional, independen, dan terpercaya dalam mewujudkan tata kelola pemerintahan yang baik di Kabupaten Alor.
                    </p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-6 border-b border-gray-700 pb-2">Tautan Penting</h3>
                    <ul class="space-y-3 text-sm text-gray-400">
                        @if(isset($importantLinks) && $importantLinks->count() > 0)
                            @foreach($importantLinks as $link)
                                <li><a href="{{ $link->url }}" target="_blank" class="hover:text-white transition flex items-center gap-2"><span class="text-blue-500">&rarr;</span> {{ $link->title }}</a></li>
                            @endforeach
                        @else
                            <li><a href="/profil" class="hover:text-white transition flex items-center gap-2"><span class="text-blue-500">&rarr;</span> Profil Kami</a></li>
                            <li><a href="/dokumen" class="hover:text-white transition flex items-center gap-2"><span class="text-blue-500">&rarr;</span> Dokumen Perencanaan</a></li>
                            <li><a href="/berita" class="hover:text-white transition flex items-center gap-2"><span class="text-blue-500">&rarr;</span> Berita Terkini</a></li>
                        @endif
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-6 border-b border-gray-700 pb-2">Kontak Kami</h3>
                    <ul class="space-y-4 text-sm text-gray-400">
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-blue-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <span>Jalan El Tari Nomor 12, Kelurahan Mutiara, Kecamatan Teluk Mutiara, Kabupaten Alor</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-blue-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            <span>inspektoratalor@gmail.com</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-blue-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            <span>08xxxxxxxxxx</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="mt-12 pt-8 border-t border-gray-800 text-center text-sm text-gray-500">
                &copy; {{ date('Y') }} Inspektorat Daerah Kabupaten Alor. Hak Cipta Dilindungi Undang-Undang.
            </div>
        </div>
    </footer>

    <!-- Floating Action Button (FAB) -->
    <a href="/" class="fixed bottom-6 right-6 z-50 flex items-center justify-center w-14 h-14 bg-yellow-500 text-slate-900 rounded-full shadow-[0_4px_14px_rgba(234,179,8,0.5)] hover:bg-yellow-400 hover:scale-110 hover:-translate-y-1 transition-all duration-300 group" aria-label="Kembali ke Beranda">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
        <span class="absolute right-16 bg-slate-900 text-white text-xs font-bold py-1 px-3 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap shadow-lg pointer-events-none">
            Ke Beranda Utama
        </span>
    </a>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const btn = document.getElementById('mobile-menu-button');
            const menu = document.getElementById('mobile-menu');

            if(btn && menu) {
                btn.addEventListener('click', () => {
                    menu.classList.toggle('hidden');
                });
            }
        });
    </script>
    
    @stack('scripts')
</body>
</html>
