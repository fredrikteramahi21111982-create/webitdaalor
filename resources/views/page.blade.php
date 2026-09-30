@extends('layouts.main')

@section('content')
<div class="py-16 bg-white min-h-[50vh]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($page)
            <h1 class="text-4xl font-extrabold text-gray-900 mb-8">{{ $page->title }}</h1>
            @if($page->image)
                <img src="{{ asset('storage/' . $page->image) }}" alt="{{ $page->title }}" class="w-full h-auto rounded-xl shadow-sm mb-8">
            @endif
            <div class="prose prose-blue prose-lg max-w-none text-gray-700">
                {!! $page->content !!}

                @if($page->extra_sections && is_array($page->extra_sections))
                    @foreach($page->extra_sections as $section)
                        @if(isset($section['title']) && isset($section['content']))
                            <h2>{{ $section['title'] }}</h2>
                            {!! $section['content'] !!}
                        @endif
                    @endforeach
                @endif
            </div>
        @else
            <div class="text-center py-20 text-gray-500">
                Halaman belum dibuat. Admin dapat membuatnya di menu Pages dengan slug 'profil'.
            </div>
        @endif
    </div>
</div>
@endsection
