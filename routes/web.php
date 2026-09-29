<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $posts = \App\Models\Post::with('category')->latest('published_at')->take(6)->get();
    $links = \App\Models\ExternalLink::all();
    $logos = \App\Models\PartnerLogo::all();
    return view('welcome', compact('posts', 'links', 'logos'));
});

Route::get('/dokumen', function (\Illuminate\Http\Request $request) {
    $query = \App\Models\Document::with('category')->orderBy('year', 'desc')->orderBy('published_at', 'desc');
    
    if ($request->has('kategori')) {
        $category = \App\Models\DocumentCategory::where('slug', $request->kategori)->first();
        if ($category) {
            $query->where('document_category_id', $category->id);
        }
    }
    
    if ($request->has('tahun') && !empty($request->tahun)) {
        $query->where('year', $request->tahun);
    }
    
    if ($request->has('search') && !empty($request->search)) {
        $query->where('title', 'like', '%' . $request->search . '%');
    }
    
    $documents = $query->get();
    
    // Pass years for the filter dropdown
    $years = \App\Models\Document::select('year')->whereNotNull('year')->distinct()->orderBy('year', 'desc')->pluck('year');
    
    return view('dokumen', compact('documents', 'years'));
});

Route::get('/berita', function () {
    $posts = \App\Models\Post::with('category')->latest('published_at')->paginate(12);
    return view('berita', compact('posts'));
});

Route::get('/berita/{slug}', function ($slug) {
    $post = \App\Models\Post::where('slug', $slug)->firstOrFail();
    return view('berita-single', compact('post'));
});

Route::get('/kontak', function () {
    return view('kontak');
});

Route::get('/web', function () {
    $posts = \App\Models\Post::with('category')->latest('published_at')->get();
    return view('web', compact('posts'));
});

Route::get('/setup-storage', function () {
    try {
        \Illuminate\Support\Facades\Artisan::call('storage:link');
        return 'Storage link created successfully!';
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});

// Dynamic Page Route (Must be at the bottom as fallback)
Route::get('/{slug}', function ($slug) {
    $page = \App\Models\Page::where('slug', $slug)->first();
    if (!$page) {
        abort(404);
    }
    return view('page', compact('page'));
});
