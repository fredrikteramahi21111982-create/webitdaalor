@extends('layouts.main')

@section('content')
<div class="bg-gray-50 min-h-screen py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="mb-12 text-center">
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 tracking-tight">Portal Berita & Video</h1>
            <p class="mt-4 text-xl text-gray-600 max-w-3xl mx-auto">Update informasi terkini dan liputan video dari Inspektorat Daerah Kabupaten Alor.</p>
        </div>

        @if($posts->isNotEmpty())
            <!-- Featured Post -->
            @php $featured = $posts->first(); @endphp
            <div class="bg-white rounded-3xl shadow-lg overflow-hidden mb-16 border border-gray-100 flex flex-col lg:flex-row">
                <div class="lg:w-7/12 bg-black relative flex items-center justify-center">
                    @if($featured->video_url)
                        @php 
                            // Extract YouTube ID
                            preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $featured->video_url, $match);
                            $youtube_id = $match[1] ?? null;
                        @endphp
                        @if($youtube_id)
                            <iframe src="https://www.youtube.com/embed/{{ $youtube_id }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen class="w-full h-full min-h-[400px]"></iframe>
                        @else
                            <a href="{{ $featured->video_url }}" target="_blank" class="block w-full h-full min-h-[400px] flex items-center justify-center bg-gray-900 text-white hover:text-red-500 transition">
                                <svg class="w-20 h-20" fill="currentColor" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
                            </a>
                        @endif
                    @elseif($featured->image)
                        <img src="{{ asset('storage/' . $featured->image) }}" alt="{{ $featured->title }}" class="w-full h-full object-cover min-h-[400px]">
                    @else
                        <div class="w-full h-full min-h-[400px] bg-blue-100 flex items-center justify-center">
                            <svg class="h-24 w-24 text-blue-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                        </div>
                    @endif
                </div>
                <div class="lg:w-5/12 p-8 lg:p-12 flex flex-col justify-center">
                    <div class="flex items-center gap-3 mb-4">
                        @if($featured->category)
                            <span class="px-3 py-1 bg-blue-600 text-white text-xs font-bold uppercase tracking-wider rounded-full">{{ $featured->category->name }}</span>
                        @endif
                        <span class="text-sm font-medium text-gray-500">{{ $featured->published_at ? \Carbon\Carbon::parse($featured->published_at)->format('d M Y') : $featured->created_at->format('d M Y') }}</span>
                    </div>
                    <a href="/berita/{{ $featured->slug }}" class="block group">
                        <h2 class="text-3xl font-bold text-gray-900 group-hover:text-blue-600 transition leading-tight mb-4">{{ $featured->title }}</h2>
                    </a>
                    <p class="text-gray-600 line-clamp-4 text-lg mb-8">
                        {{ strip_tags($featured->content) }}
                    </p>
                    <a href="/berita/{{ $featured->slug }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-xl text-white bg-blue-600 hover:bg-blue-700 transition w-max shadow-md">
                        Baca Berita Lengkap
                    </a>
                </div>
            </div>

            <!-- Grid Posts -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($posts->skip(1) as $post)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition duration-300 flex flex-col group">
                    <a href="/berita/{{ $post->slug }}" class="block relative bg-gray-200 aspect-w-16 aspect-h-9 overflow-hidden">
                        @if($post->video_url)
                            @php 
                                preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $post->video_url, $match);
                                $youtube_id = $match[1] ?? null;
                            @endphp
                            @if($youtube_id)
                                <img src="https://img.youtube.com/vi/{{ $youtube_id }}/maxresdefault.jpg" onerror="this.src='https://img.youtube.com/vi/{{ $youtube_id }}/hqdefault.jpg'" alt="{{ $post->title }}" class="object-cover w-full h-56 transition duration-500 group-hover:scale-105">
                                <div class="absolute inset-0 flex items-center justify-center bg-black/20 group-hover:bg-black/40 transition">
                                    <div class="w-14 h-14 bg-red-600 text-white rounded-full flex items-center justify-center shadow-lg backdrop-blur-sm">
                                        <svg class="w-6 h-6 ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M3 22v-20l18 10-18 10z"/></svg>
                                    </div>
                                </div>
                            @endif
                        @elseif($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="object-cover w-full h-56 transition duration-500 group-hover:scale-105">
                        @else
                            <div class="w-full h-56 bg-blue-50 flex items-center justify-center transition duration-500 group-hover:bg-blue-100">
                                <svg class="h-10 w-10 text-blue-200" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                            </div>
                        @endif
                        
                        @if($post->category)
                            <div class="absolute top-4 left-4 z-10">
                                <span class="px-2.5 py-1 bg-white/90 backdrop-blur-sm text-blue-800 text-xs font-bold uppercase tracking-wider rounded shadow-sm">{{ $post->category->name }}</span>
                            </div>
                        @endif
                    </a>
                    
                    <div class="p-6 flex flex-col flex-grow">
                        <div class="text-sm font-medium text-gray-400 mb-2">
                            {{ $post->published_at ? \Carbon\Carbon::parse($post->published_at)->format('d M Y') : $post->created_at->format('d M Y') }}
                        </div>
                        <a href="/berita/{{ $post->slug }}" class="block mt-1 flex-grow">
                            <h3 class="text-xl font-bold text-gray-900 group-hover:text-blue-600 transition leading-snug">{{ $post->title }}</h3>
                            <p class="mt-3 text-gray-500 line-clamp-3 text-sm">
                                {{ strip_tags($post->content) }}
                            </p>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-24 bg-white rounded-3xl shadow-sm border border-gray-100">
                <svg class="mx-auto h-16 w-16 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                <h3 class="mt-4 text-lg font-medium text-gray-900">Belum ada publikasi</h3>
                <p class="mt-2 text-gray-500">Video dan berita terbaru akan muncul di halaman ini.</p>
            </div>
        @endif
        
    </div>
</div>

<!-- Custom Footer Khusus Halaman Web -->
<footer class="bg-slate-900 text-gray-400 py-10 border-t-4 border-blue-600">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-6">
        <div class="flex items-center gap-4">
            <img class="h-10 w-auto grayscale opacity-70 hover:grayscale-0 hover:opacity-100 transition duration-300" src="{{ asset('images/logo_alor.png') }}" alt="Logo Alor">
            <div>
                <h2 class="text-white font-bold tracking-wider">PORTAL BERITA ITDA</h2>
                <p class="text-xs">Inspektorat Daerah Kab. Alor</p>
            </div>
        </div>
        <div class="text-sm text-center md:text-right">
            <p>&copy; {{ date('Y') }} Inspektorat Daerah Kabupaten Alor.</p>
            <p class="mt-1">Semua hak cipta dilindungi.</p>
        </div>
    </div>
</footer>

<!-- Sembunyikan Footer Bawaan Main Layout menggunakan CSS -->
<style>
    body > footer.bg-slate-900.mt-16 {
        display: none !important;
    }
</style>
@endsection
