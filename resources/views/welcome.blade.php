@extends('layouts.main')

@section('content')
<!-- Hero Section -->
<div class="relative min-h-[90vh] flex items-center bg-slate-900 border-b-8 border-yellow-500">
    <div class="absolute inset-0">
        <img class="w-full h-full object-cover opacity-40" src="https://images.unsplash.com/photo-1582213782179-e0d53f98f2ca?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80" alt="Alor Landscape">
        <div class="absolute inset-0 bg-gradient-to-r from-slate-900/95 via-slate-900/80 to-transparent"></div>
    </div>

    <div class="relative max-w-7xl mx-auto py-24 px-4 sm:py-32 sm:px-6 lg:px-8 z-10 w-full">
        <div class="max-w-3xl">
            <span class="inline-block py-1.5 px-4 rounded-sm bg-yellow-500 text-slate-900 text-sm font-bold tracking-widest uppercase mb-6 shadow-sm">
                Portal Resmi
            </span>
            <h1 class="text-4xl sm:text-5xl lg:text-7xl font-extrabold text-white tracking-tight mb-4 drop-shadow-lg leading-tight">
                Inspektorat Daerah<br/>
                <span class="text-yellow-400">Kabupaten Alor</span>
            </h1>
            <p class="mt-6 text-lg sm:text-xl text-slate-200 leading-relaxed font-light border-l-4 border-yellow-500 pl-4 max-w-2xl">
                Bersinergi mengawal akuntabilitas dan mewujudkan tata kelola Pemerintahan Daerah yang transparan, profesional, dan berintegritas tinggi.
            </p>
            <div class="mt-12 flex flex-col sm:flex-row gap-4">
                <a href="#layanan" class="inline-flex justify-center items-center px-8 py-3.5 border border-transparent text-base font-bold rounded-md shadow-sm text-slate-900 bg-yellow-500 hover:bg-yellow-400 transition-colors duration-300">
                    Pusat Layanan
                    <svg class="ml-2 -mr-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                </a>
                <a href="#berita" class="inline-flex justify-center items-center px-8 py-3.5 border border-slate-300 text-base font-bold rounded-md text-white bg-slate-800/50 hover:bg-slate-700/80 backdrop-blur-sm transition-colors duration-300">
                    Berita Terkini
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Sekapur Sirih (Foreword) -->
<div class="bg-white py-24 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-slate-50 border border-slate-200 rounded-2xl shadow-sm overflow-hidden flex flex-col md:flex-row">
            
            <!-- Image Side -->
            <div class="md:w-5/12 relative bg-slate-200">
                <img src="{{ asset('images/inspektur.jpg') }}" alt="Romelus Djobo, SE" class="w-full h-full object-cover object-top min-h-[450px]">
                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-slate-900 to-transparent pt-32 pb-6 px-8">
                    <p class="font-bold text-2xl text-white">Romelus Djobo, SE</p>
                    <p class="text-sm font-semibold text-yellow-400 mt-1 uppercase tracking-widest">Inspektur Daerah Kab. Alor</p>
                </div>
            </div>
            
            <!-- Text Side -->
            <div class="md:w-7/12 p-8 md:p-16 flex flex-col justify-center relative">
                <div class="absolute top-8 right-12 text-slate-100">
                    <svg class="h-32 w-32" fill="currentColor" viewBox="0 0 32 32" aria-hidden="true">
                        <path d="M9.352 4C4.456 7.456 1 13.12 1 19.36c0 5.088 3.072 8.064 6.624 8.064 3.36 0 5.856-2.688 5.856-5.856 0-3.168-2.208-5.472-5.088-5.472-.576 0-1.344.096-1.536.192.48-3.264 3.552-7.104 6.624-9.024L9.352 4zm16.512 0c-4.896 3.456-8.352 9.12-8.352 15.36 0 5.088 3.072 8.064 6.624 8.064 3.264 0 5.856-2.688 5.856-5.856 0-3.168-2.304-5.472-5.184-5.472-.576 0-1.248.096-1.44.192.48-3.264 3.552-7.104 6.624-9.024L25.864 4z" />
                    </svg>
                </div>
                
                <div class="relative z-10">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="h-1 w-12 bg-yellow-500"></div>
                        <h2 class="text-xl font-bold text-slate-800 tracking-widest uppercase">Sekapur Sirih</h2>
                    </div>
                    
                    <div class="text-lg text-slate-600 leading-relaxed space-y-6">
                        <p>
                            Puji syukur kami panjatkan ke hadirat Tuhan Yang Maha Esa, karena atas rahmat-Nya website resmi Inspektorat Daerah Kabupaten Alor dapat hadir sebagai wujud transparansi dan akuntabilitas publik.
                        </p>
                        <p>
                            Kami berkomitmen untuk terus mengawal jalannya roda pemerintahan yang bersih, melayani, dan bebas dari praktik KKN. Melalui platform ini, kami berharap masyarakat dapat lebih mudah mengakses informasi serta turut serta mengawasi tata kelola pemerintahan.
                        </p>
                        <p class="font-semibold text-slate-900 mt-6 text-xl border-l-4 border-yellow-500 pl-4">
                            "Mari bersama mewujudkan tata kelola pemerintahan yang efektif, transparan dan akuntabel."
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Partner Logos -->
@if($logos->count() > 0)
<div class="bg-white py-12 border-t border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <p class="text-center text-sm font-bold text-slate-400 uppercase tracking-widest mb-8">Didukung Oleh</p>
        <div class="flex flex-wrap justify-center items-center gap-12 md:gap-20 opacity-60 hover:opacity-100 transition-opacity duration-300">
            @foreach($logos as $logo)
            <img class="h-14 md:h-16 object-contain filter grayscale hover:grayscale-0 transition-all duration-300" src="{{ asset('storage/' . $logo->image) }}" alt="{{ $logo->title }}">
            @endforeach
        </div>
    </div>
</div>
@endif

<!-- External Links / Subdomains (Layanan) -->
<div id="layanan" class="py-24 bg-slate-900 text-white relative">
    <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-[0.05]"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-yellow-500 font-bold tracking-widest uppercase text-sm mb-3 block">Pusat Layanan</span>
            <h2 class="text-3xl md:text-4xl font-extrabold text-white tracking-tight">
                Aplikasi & Portal Publik
            </h2>
            <div class="h-1 w-24 bg-yellow-500 mx-auto mt-6"></div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($links as $link)
            <a href="{{ $link->url }}" target="_blank" class="group block h-full">
                <div class="bg-slate-800 rounded-xl p-8 h-full shadow-md border border-slate-700 hover:border-yellow-500 transition-all duration-300 flex items-start gap-6">
                    <div class="w-16 h-16 shrink-0 bg-slate-700 group-hover:bg-yellow-500 rounded-lg flex items-center justify-center transition-colors duration-300">
                        @if($link->icon)
                            <img class="h-8 w-8 object-contain" src="{{ asset('storage/' . $link->icon) }}" alt="{{ $link->title }}">
                        @else
                            <svg class="h-8 w-8 text-slate-300 group-hover:text-slate-900 transition-colors duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                            </svg>
                        @endif
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-slate-100 group-hover:text-yellow-400 transition-colors duration-300">{{ $link->title }}</h3>
                        <p class="mt-2 text-slate-400 text-sm">Akses portal resmi layanan publik terintegrasi</p>
                    </div>
                </div>
            </a>
            @empty
            @endforelse
        </div>
    </div>
</div>

<!-- Latest News -->
<div id="berita" class="py-24 bg-slate-50 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
            <div>
                <span class="text-blue-700 font-bold tracking-widest uppercase text-sm mb-3 block">Publikasi</span>
                <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight">
                    Berita Terkini
                </h2>
                <div class="h-1 w-24 bg-blue-700 mt-6"></div>
            </div>
            <a href="/berita" class="group flex items-center gap-2 px-6 py-2.5 border border-slate-300 bg-white hover:bg-slate-100 text-slate-700 font-bold rounded-md transition-colors duration-300 shadow-sm">
                Lihat Semua
                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($posts as $post)
            <article class="group bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-lg border border-slate-200 transition-all duration-300 flex flex-col h-full">
                <div class="aspect-w-16 aspect-h-10 overflow-hidden relative">
                    <div class="absolute inset-0 bg-slate-900/10 group-hover:bg-transparent transition-colors duration-300 z-10"></div>
                    @if($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="object-cover w-full h-56 group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="w-full h-56 bg-slate-100 flex items-center justify-center border-b border-slate-200">
                            <svg class="h-12 w-12 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                        </div>
                    @endif
                    @if($post->category)
                    <div class="absolute top-4 left-4 z-20">
                        <span class="px-3 py-1 bg-yellow-500 text-slate-900 rounded-sm text-xs font-bold uppercase tracking-wider shadow-sm">
                            {{ $post->category->name }}
                        </span>
                    </div>
                    @endif
                </div>
                
                <div class="p-6 flex flex-col flex-grow">
                    <time class="text-xs font-bold text-slate-400 mb-3 block uppercase tracking-wider">
                        {{ $post->published_at ? \Carbon\Carbon::parse($post->published_at)->translatedFormat('d F Y') : $post->created_at->translatedFormat('d F Y') }}
                    </time>
                    <a href="/berita/{{ $post->slug }}" class="block flex-grow">
                        <h3 class="text-xl font-bold text-slate-900 group-hover:text-blue-700 transition-colors duration-300 leading-snug">{{ $post->title }}</h3>
                        <p class="mt-3 text-slate-600 text-sm line-clamp-3 leading-relaxed">
                            {{ strip_tags($post->content) }}
                        </p>
                    </a>
                    <div class="mt-6 pt-4 border-t border-slate-100">
                        <a href="/berita/{{ $post->slug }}" class="text-blue-700 font-bold text-sm inline-flex items-center group/btn">
                            Baca Selengkapnya
                            <svg class="ml-1 w-4 h-4 group-hover/btn:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    </div>
                </div>
            </article>
            @empty
            <div class="col-span-full text-center py-16 bg-white rounded-xl border border-slate-200">
                <p class="text-slate-500 font-medium">Belum ada berita yang dipublikasikan.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
