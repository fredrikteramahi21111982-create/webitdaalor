@extends('layouts.main')

@section('content')

    @if(isset($popup) && $popup)
    <!-- Popup Banner Modal (Alpine.js) -->
    <div x-data="{ 
            showPopup: false,
            init() {
                // Check if user has already seen the popup in this session
                const lastSeen = sessionStorage.getItem('popupLastSeen');
                const today = new Date().toDateString();
                
                // Allow forcing popup via URL parameter for testing: ?preview=1
                const urlParams = new URLSearchParams(window.location.search);
                const isPreview = urlParams.has('preview');
                
                if (lastSeen !== today || isPreview) {
                    setTimeout(() => { this.showPopup = true; }, 1000);
                }
            },
            closePopup() {
                this.showPopup = false;
                sessionStorage.setItem('popupLastSeen', new Date().toDateString());
            }
        }" 
        x-show="showPopup"
        x-transition.opacity.duration.500ms
        class="fixed inset-0 z-[100] flex items-center justify-center p-4 sm:p-6"
        style="display: none;"
    >
        <!-- Backdrop -->
        <div x-show="showPopup" 
             x-transition.opacity.duration.500ms
             class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm"
             @click="closePopup"
        ></div>

        <!-- Modal Content -->
        <div x-show="showPopup"
             x-transition:enter="transition ease-out duration-500 delay-100"
             x-transition:enter-start="opacity-0 translate-y-8 scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 scale-95"
             class="relative bg-white rounded-2xl shadow-2xl overflow-hidden max-w-2xl w-full flex flex-col"
        >
            <!-- Close Button -->
            <button @click="closePopup" class="absolute top-4 right-4 z-10 w-10 h-10 bg-black/40 hover:bg-red-600 text-white rounded-full flex items-center justify-center backdrop-blur-md transition-colors shadow-lg">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
            
            @if($popup->url)
            <a href="{{ $popup->url }}" target="_blank" @click="closePopup">
            @endif
                <img src="{{ asset('storage/' . $popup->image_path) }}" alt="{{ $popup->title ?? 'Pengumuman' }}" class="w-full h-auto object-cover max-h-[80vh]">
                
                @if($popup->title)
                <div class="bg-blue-700 p-4 text-center">
                    <h3 class="text-white font-bold text-lg">{{ $popup->title }}</h3>
                </div>
                @endif
            @if($popup->url)
            </a>
            @endif
        </div>
    </div>
    @endif
<!-- Hero Section -->
<div class="relative min-h-[90vh] flex items-center bg-slate-900 border-b-8 border-yellow-500">
    <div class="absolute inset-0 overflow-hidden" id="hero-slider-container">
        @php
            $defaultImage = 'https://images.unsplash.com/photo-1582213782179-e0d53f98f2ca?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80';
            $banners = (isset($heroBanners) && count($heroBanners) > 0) ? $heroBanners : [$defaultImage];
        @endphp
        
        @foreach($banners as $index => $img)
            <div class="absolute inset-0 transition-opacity duration-1000 ease-in-out hero-slide {{ $index === 0 ? 'opacity-40' : 'opacity-0' }}" 
                 style="background-image: url('{{ $img }}'); background-size: cover; background-position: center;">
            </div>
        @endforeach
        <div class="absolute inset-0 bg-gradient-to-r from-slate-900/95 via-slate-900/80 to-transparent z-10"></div>
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
                <img src="{{ isset($contact) && $contact->foreword_image ? asset('storage/' . $contact->foreword_image) : asset('images/inspektur.jpg') }}" alt="{{ $contact->foreword_name ?? 'Romelus Djobo, SE' }}" class="w-full h-full object-cover object-top min-h-[450px]">
                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-slate-900 to-transparent pt-32 pb-6 px-8">
                    <p class="font-bold text-2xl text-white">{{ $contact->foreword_name ?? 'Romelus Djobo, SE' }}</p>
                    <p class="text-sm font-semibold text-yellow-400 mt-1 uppercase tracking-widest">{{ $contact->foreword_position ?? 'Inspektur Daerah Kab. Alor' }}</p>
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
                        <h2 class="text-xl font-bold text-slate-800 tracking-widest uppercase">{{ $contact->foreword_title ?? 'Sekapur Sirih' }}</h2>
                    </div>
                    
                    <div class="text-lg text-slate-600 leading-relaxed space-y-6">
                        @if(isset($contact) && $contact->foreword_content)
                            {!! $contact->foreword_content !!}
                        @else
                            <p>
                                Puji syukur kami panjatkan ke hadirat Tuhan Yang Maha Esa, karena atas rahmat-Nya website resmi Inspektorat Daerah Kabupaten Alor dapat hadir sebagai wujud transparansi dan akuntabilitas publik.
                            </p>
                            <p>
                                Kami berkomitmen untuk terus mengawal jalannya roda pemerintahan yang bersih, melayani, dan bebas dari praktik KKN. Melalui platform ini, kami berharap masyarakat dapat lebih mudah mengakses informasi serta turut serta mengawasi tata kelola pemerintahan.
                            </p>
                            <p class="font-semibold text-slate-900 mt-6 text-xl border-l-4 border-yellow-500 pl-4">
                                "Mari bersama mewujudkan tata kelola pemerintahan yang efektif, transparan dan akuntabel."
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


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
                <div class="bg-slate-800 rounded-xl p-5 sm:p-8 h-full shadow-md border border-slate-700 hover:border-yellow-500 transition-all duration-300 flex items-start gap-4 sm:gap-6">
                    <div class="w-16 h-16 sm:w-20 sm:h-20 shrink-0 bg-slate-700 group-hover:bg-yellow-500 rounded-xl p-2.5 flex items-center justify-center transition-colors duration-300 overflow-hidden">
                        <img class="w-full h-full object-contain transition-transform duration-300 group-hover:scale-110 drop-shadow-md bg-white rounded-md p-1" src="https://t3.gstatic.com/faviconV2?client=SOCIAL&type=FAVICON&fallback_opts=TYPE,SIZE,URL&url={{ urlencode($link->url) }}&size=128" alt="{{ $link->title }}" onerror="this.src='data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgc3Ryb2tlPSJjdXJyZW50Q29sb3ciIHN0cm9rZS13aWR0aD0iMS41IiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiPjxwYXRoIGQ9Ik0xMy44MjggMTAuMTcyYTQgNCAwIDAwLTUuNjU2IDBsLTQgNGE0IDQgMCAxMDUuNjU2IDUuNjU2bDEuMTAyLTEuMTAxbS0uNzU4LTQuODk5YTQgNCAwIDAwNS42NTYgMGw0LTRhNCA0IDAgMDAtNS42NTYtNS42NTZsLTEuMSAxLjEiPjwvcGF0aD48L3N2Zz4='; this.classList.remove('bg-white', 'p-1', 'drop-shadow-md'); this.classList.add('text-slate-300', 'group-hover:text-slate-900');">
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="text-base sm:text-lg lg:text-xl font-bold text-slate-100 group-hover:text-yellow-400 transition-colors duration-300 leading-snug line-clamp-2 break-words">{{ $link->title }}</h3>
                        <p class="mt-1.5 text-slate-400 text-xs sm:text-sm line-clamp-2">Akses portal resmi layanan publik terintegrasi</p>
                    </div>
                </div>
            </a>
            @empty
            <div class="col-span-full text-center py-12">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-slate-800 mb-4">
                    <svg class="w-8 h-8 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                </div>
                <p class="text-slate-400 font-medium text-lg">Belum ada tautan layanan publik yang ditambahkan.</p>
                <p class="text-slate-500 text-sm mt-1">Silakan tambahkan data melalui panel admin (Menu External Links).</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Partner Logos -->
@if($logos->count() > 0)
<div class="bg-white py-16 border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10">
            <span class="text-blue-600 font-bold tracking-widest uppercase text-sm mb-2 block">Jejaring</span>
            <h2 class="text-3xl font-extrabold text-slate-900">Mitra & Dukungan</h2>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6 items-center justify-items-center">
            @foreach($logos as $logo)
            <a href="{{ $logo->url ?? '#' }}" target="_blank" class="flex flex-col items-center justify-center gap-4 group w-full p-4 rounded-xl hover:bg-slate-50 transition-colors duration-300 border border-transparent hover:border-slate-100">
                <div class="h-16 md:h-20 w-full flex items-center justify-center p-2">
                    <img class="max-h-full max-w-full object-contain filter grayscale opacity-70 group-hover:grayscale-0 group-hover:opacity-100 transition-all duration-500 transform group-hover:scale-110" src="https://t3.gstatic.com/faviconV2?client=SOCIAL&type=FAVICON&fallback_opts=TYPE,SIZE,URL&url={{ urlencode($logo->url) }}&size=256" alt="{{ $logo->title }}">
                </div>
                <h4 class="text-sm font-bold text-slate-500 group-hover:text-blue-700 text-center transition-colors line-clamp-2 leading-tight">{{ $logo->title }}</h4>
            </a>
            @endforeach
        </div>
    </div>
</div>
@endif

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

<!-- Galeri & Aktivitas (Instagram) -->
@if(isset($contact) && $contact->instagram_widget_code)
<div class="py-20 bg-slate-50 border-t border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <span class="text-blue-600 font-bold tracking-wider uppercase text-sm mb-2 block">Sosial Media</span>
            <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900">Galeri & Aktivitas</h2>
            <p class="mt-4 text-slate-600 max-w-2xl mx-auto text-lg">Ikuti kegiatan terbaru kami secara langsung melalui halaman Instagram resmi Inspektorat Daerah.</p>
        </div>
        
        <div class="bg-white rounded-3xl p-4 sm:p-8 shadow-[0_5px_20px_rgba(0,0,0,0.03)] border border-slate-100 overflow-hidden">
            {!! $contact->instagram_widget_code !!}
        </div>
        
        @if($contact->instagram)
        <div class="text-center mt-8">
            <a href="{{ $contact->instagram }}" target="_blank" class="inline-flex items-center px-6 py-3 border-2 border-slate-200 text-base font-bold rounded-full text-slate-700 bg-white hover:bg-slate-50 hover:border-slate-300 transition-colors duration-300">
                <svg class="w-5 h-5 mr-2 text-pink-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                Follow Instagram Kami
            </a>
        </div>
        @endif
    </div>
</div>
@endif
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const slides = document.querySelectorAll('.hero-slide');
        if (slides.length > 1) {
            let current = 0;
            setInterval(() => {
                slides[current].classList.remove('opacity-40');
                slides[current].classList.add('opacity-0');
                
                current = (current + 1) % slides.length;
                
                slides[current].classList.remove('opacity-0');
                slides[current].classList.add('opacity-40');
            }, 5000); // Change image every 5 seconds
        }
    });
</script>
@endpush
