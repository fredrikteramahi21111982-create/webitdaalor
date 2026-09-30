@extends('layouts.main')

@section('content')
<div class="py-16 bg-white min-h-[50vh]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-10">
            <!-- Main Content -->
            <div class="lg:w-2/3 bg-white p-6 md:p-10 rounded-3xl shadow-[0_5px_20px_rgba(0,0,0,0.03)] border border-slate-100">
                <div class="mb-8">
                    @if($post->category)
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-800 mb-4 tracking-wider uppercase">
                        {{ $post->category->name }}
                    </span>
                    @endif
                    <h1 class="text-3xl md:text-5xl font-extrabold text-gray-900 leading-tight mb-6">{{ $post->title }}</h1>
                    <div class="flex items-center text-slate-500 text-sm font-medium border-b border-slate-100 pb-6">
                        <svg class="w-5 h-5 mr-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <span>{{ $post->published_at ? \Carbon\Carbon::parse($post->published_at)->translatedFormat('d F Y') : $post->created_at->translatedFormat('d F Y') }}</span>
                    </div>
                </div>

                @if($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-full h-auto rounded-2xl shadow-sm mb-10 object-cover">
                @endif

                <div class="prose prose-blue prose-lg max-w-none text-gray-700">
                    {!! $post->content !!}
                </div>

                <div class="mt-12 pt-8 border-t border-slate-100">
                    <a href="/berita" class="text-slate-500 hover:text-blue-600 font-bold inline-flex items-center transition group">
                        <svg class="mr-2 w-5 h-5 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Kembali ke Indeks Berita
                    </a>
                </div>

                <!-- Komentar Section -->
                <div class="mt-16 bg-slate-50 p-6 sm:p-8 rounded-3xl border border-slate-100">
                    <h3 class="text-2xl font-bold text-slate-900 mb-8 border-b border-slate-200 pb-4">Komentar Pembaca ({{ $post->comments->count() }})</h3>
                    
                    @if(session('success'))
                        <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-8 rounded-r-lg">
                            <p class="text-green-700 font-medium">{{ session('success') }}</p>
                        </div>
                    @endif

                    <div class="space-y-8 mb-12">
                        @forelse($post->comments as $comment)
                            <div class="flex gap-4">
                                <div class="w-12 h-12 rounded-full {{ $comment->is_admin ? 'bg-blue-600 text-white' : 'bg-slate-300 text-slate-700' }} flex items-center justify-center font-bold text-lg shrink-0">
                                    {{ substr($comment->name, 0, 1) }}
                                </div>
                                <div class="flex-1 bg-white p-5 rounded-2xl shadow-sm border border-slate-100">
                                    <div class="flex justify-between items-start mb-2">
                                        <div>
                                            <h4 class="font-bold text-slate-900 {{ $comment->is_admin ? 'text-blue-600' : '' }}">
                                                {{ $comment->name }}
                                                @if($comment->is_admin)
                                                <span class="ml-2 text-xs bg-blue-100 text-blue-700 px-2 py-0.5 rounded-full">Admin</span>
                                                @endif
                                            </h4>
                                            <time class="text-xs text-slate-500">{{ $comment->created_at->diffForHumans() }}</time>
                                        </div>
                                    </div>
                                    <p class="text-slate-700 leading-relaxed">{{ $comment->content }}</p>
                                    
                                    <!-- Replies -->
                                    @if($comment->replies->count() > 0)
                                        <div class="mt-4 pt-4 border-t border-slate-100 space-y-4">
                                            @foreach($comment->replies as $reply)
                                                <div class="flex gap-3">
                                                    <div class="w-8 h-8 rounded-full {{ $reply->is_admin ? 'bg-blue-600 text-white' : 'bg-slate-300 text-slate-700' }} flex items-center justify-center font-bold text-xs shrink-0">
                                                        {{ substr($reply->name, 0, 1) }}
                                                    </div>
                                                    <div class="flex-1 bg-slate-50 p-4 rounded-xl">
                                                        <h4 class="font-bold text-sm text-slate-900 {{ $reply->is_admin ? 'text-blue-600' : '' }}">
                                                            {{ $reply->name }}
                                                            @if($reply->is_admin)
                                                            <span class="ml-2 text-[10px] bg-blue-100 text-blue-700 px-2 py-0.5 rounded-full">Admin</span>
                                                            @endif
                                                        </h4>
                                                        <time class="text-xs text-slate-500 mb-1 block">{{ $reply->created_at->diffForHumans() }}</time>
                                                        <p class="text-sm text-slate-700">{{ $reply->content }}</p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <p class="text-slate-500 italic">Belum ada komentar. Jadilah yang pertama berkomentar!</p>
                        @endforelse
                    </div>

                    <!-- Form Komentar -->
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                        <h4 class="text-lg font-bold text-slate-900 mb-4">Tinggalkan Komentar</h4>
                        <form action="{{ route('comments.store', $post->id) }}" method="POST">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1">Nama Lengkap *</label>
                                    <input type="text" name="name" required class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1">Email (Opsional)</label>
                                    <input type="email" name="email" class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition">
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-slate-700 mb-1">Komentar *</label>
                                <textarea name="content" required rows="4" class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition"></textarea>
                            </div>
                            <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg transition shadow-sm">Kirim Komentar</button>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- Sidebar -->
            <div class="lg:w-1/3">
                <div class="sticky top-24 space-y-8">
                    <!-- Search Widget -->
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                        <h3 class="text-lg font-bold text-slate-900 mb-4 border-b border-slate-100 pb-2">Pencarian</h3>
                        <form action="/berita" method="GET" class="relative">
                            <input type="text" name="q" placeholder="Cari berita..." class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-colors">
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
@endsection
