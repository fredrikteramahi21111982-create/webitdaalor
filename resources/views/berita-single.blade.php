@extends('layouts.main')

@section('content')
<div class="py-16 bg-white min-h-[50vh]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            @if($post->category)
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 mb-4">
                {{ $post->category->name }}
            </span>
            @endif
            <h1 class="text-4xl font-extrabold text-gray-900 leading-tight mb-4">{{ $post->title }}</h1>
            <div class="flex items-center text-gray-500 text-sm">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                <span>{{ $post->published_at ? \Carbon\Carbon::parse($post->published_at)->format('d F Y') : $post->created_at->format('d F Y') }}</span>
            </div>
        </div>

        @if($post->image)
            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-full h-auto rounded-xl shadow-sm mb-10">
        @endif

        <div class="prose prose-blue prose-lg max-w-none text-gray-700">
            {!! $post->content !!}
        </div>

        <div class="mt-12 pt-8 border-t border-gray-100">
            <a href="/berita" class="text-blue-600 hover:text-blue-800 font-medium inline-flex items-center transition">
                <svg class="mr-2 w-4 h-4 transform rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                Kembali ke Indeks Berita
            </a>
        </div>
    </div>
</div>
@endsection
