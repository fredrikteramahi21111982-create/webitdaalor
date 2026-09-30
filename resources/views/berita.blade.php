@extends('layouts.main')

@section('content')
<div class="py-16 bg-white min-h-[50vh]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-10">
            <!-- Main Content -->
            <div class="lg:w-2/3">
                <div class="mb-10">
                    <h1 class="text-3xl font-extrabold text-gray-900">
                        @if(request('q'))
                            Hasil Pencarian: "{{ request('q') }}"
                        @else
                            Berita & Informasi Terkini
                        @endif
                    </h1>
                    <p class="mt-2 text-gray-600">Publikasi terbaru dari Inspektorat Daerah Kabupaten Alor.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @forelse($posts as $post)
                    <article class="group bg-white rounded-3xl overflow-hidden shadow-[0_5px_20px_rgba(0,0,0,0.03)] hover:shadow-[0_20px_40px_rgba(0,0,0,0.08)] border border-slate-100 transition-all duration-500 flex flex-col h-full transform hover:-translate-y-2">
                        <div class="aspect-w-16 aspect-h-10 overflow-hidden relative">
                            <div class="absolute inset-0 bg-slate-900/10 group-hover:bg-transparent transition-colors duration-500 z-10"></div>
                            @if($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="object-cover w-full h-56 group-hover:scale-110 transition-transform duration-700">
                            @else
                                <div class="w-full h-56 bg-gradient-to-br from-slate-100 to-slate-200 flex items-center justify-center">
                                    <svg class="h-16 w-16 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                                </div>
                            @endif
                            @if($post->category)
                            <div class="absolute top-4 left-4 z-20">
                                <span class="px-3 py-1 bg-white/90 backdrop-blur-sm rounded-lg text-xs font-bold text-blue-700 uppercase tracking-wider shadow-sm">
                                    {{ $post->category->name }}
                                </span>
                            </div>
                            @endif
                        </div>
                        
                        <div class="p-6 flex flex-col flex-grow">
                            <time class="text-sm font-medium text-slate-400 mb-3 block">
                                {{ $post->published_at ? \Carbon\Carbon::parse($post->published_at)->translatedFormat('d F Y') : $post->created_at->translatedFormat('d F Y') }}
                            </time>
                            <a href="/berita/{{ $post->slug }}" class="block mt-1 flex-grow">
                                <h3 class="text-xl font-bold text-slate-900 group-hover:text-blue-600 transition-colors duration-300 leading-snug">{{ $post->title }}</h3>
                                <p class="mt-3 text-sm text-slate-500 line-clamp-3 leading-relaxed">
                                    {{ strip_tags($post->content) }}
                                </p>
                            </a>
                            <div class="mt-5 pt-5 border-t border-slate-100">
                                <a href="/berita/{{ $post->slug }}" class="text-blue-600 font-bold text-sm inline-flex items-center group/btn">
                                    Baca Selengkapnya
                                    <svg class="ml-2 w-4 h-4 group-hover/btn:translate-x-2 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                </a>
                            </div>
                        </div>
                    </article>
                    @empty
                    <div class="col-span-full text-center py-20 bg-slate-50 rounded-3xl border border-slate-100">
                        <div class="mx-auto w-20 h-20 bg-slate-200 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-10 h-10 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 mb-2">Tidak ditemukan</h3>
                        <p class="text-sm text-slate-500 max-w-sm mx-auto">Maaf, kami tidak dapat menemukan berita yang Anda cari. Silakan gunakan kata kunci lain.</p>
                        @if(request('q'))
                        <a href="/berita" class="mt-4 inline-block px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 transition">Lihat Semua Berita</a>
                        @endif
                    </div>
                    @endforelse
                </div>

                <div class="mt-12">
                    {{ $posts->links() }}
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:w-1/3">
                <div class="sticky top-24 space-y-8">
                    <!-- Search Widget -->
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                        <h3 class="text-lg font-bold text-slate-900 mb-4 border-b border-slate-100 pb-2">Pencarian</h3>
                        <form action="/berita" method="GET" class="relative">
                            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari berita..." class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-colors">
                            <svg class="w-5 h-5 text-slate-400 absolute left-3 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            <button type="submit" class="hidden">Cari</button>
                        </form>
                    </div>

                    <!-- Recent Posts Widget -->
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                        <h3 class="text-lg font-bold text-slate-900 mb-4 border-b border-slate-100 pb-2">Berita Terbaru</h3>
                        <div class="space-y-4">
                            @if(isset($recentPosts))
                                @foreach($recentPosts as $recent)
                                <a href="/berita/{{ $recent->slug }}" class="group flex gap-4 items-start">
                                    <div class="w-20 h-20 shrink-0 rounded-lg overflow-hidden bg-slate-100">
                                        @if($recent->image)
                                            <img src="{{ asset('storage/' . $recent->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-slate-300">
                                                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h4 class="text-sm font-bold text-slate-800 group-hover:text-blue-600 transition-colors line-clamp-2 leading-tight">{{ $recent->title }}</h4>
                                        <time class="text-xs text-slate-500 mt-1 block">{{ $recent->published_at ? \Carbon\Carbon::parse($recent->published_at)->translatedFormat('d M Y') : $recent->created_at->translatedFormat('d M Y') }}</time>
                                    </div>
                                </a>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
