@extends('layouts.main')

@section('content')
<div class="py-16 bg-white min-h-[50vh]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-10">
            <h1 class="text-3xl font-extrabold text-gray-900">Berita & Informasi Terkini</h1>
            <p class="mt-2 text-gray-600">Publikasi terbaru dari Inspektorat Daerah Kabupaten Alor.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
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
                
                <div class="p-8 flex flex-col flex-grow">
                    <time class="text-sm font-medium text-slate-400 mb-4 block">
                        {{ $post->published_at ? \Carbon\Carbon::parse($post->published_at)->translatedFormat('d F Y') : $post->created_at->translatedFormat('d F Y') }}
                    </time>
                    <a href="/berita/{{ $post->slug }}" class="block mt-2 flex-grow">
                        <h3 class="text-2xl font-bold text-slate-900 group-hover:text-blue-600 transition-colors duration-300 leading-snug">{{ $post->title }}</h3>
                        <p class="mt-4 text-slate-500 line-clamp-3 leading-relaxed">
                            {{ strip_tags($post->content) }}
                        </p>
                    </a>
                    <div class="mt-6 pt-6 border-t border-slate-100">
                        <a href="/berita/{{ $post->slug }}" class="text-blue-600 font-bold inline-flex items-center group/btn">
                            Baca Selengkapnya
                            <svg class="ml-2 w-4 h-4 group-hover/btn:translate-x-2 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    </div>
                </div>
            </article>
            @empty
            <div class="col-span-full text-center py-24 bg-slate-50 rounded-3xl border border-slate-100">
                <div class="mx-auto w-24 h-24 bg-slate-200 rounded-full flex items-center justify-center mb-6">
                    <svg class="w-12 h-12 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-2">Belum Ada Berita</h3>
                <p class="text-base text-slate-500 max-w-sm mx-auto">Kami sedang menyiapkan informasi dan berita terbaru untuk Anda. Silakan kunjungi kembali nanti.</p>
            </div>
            @endforelse
        </div>

        <div class="mt-12">
            {{ $posts->links() }}
        </div>
    </div>
</div>
@endsection
