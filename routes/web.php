<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $posts = \App\Models\Post::with('category')->latest('published_at')->take(6)->get();
    $links = \App\Models\ExternalLink::all();
    $logos = \App\Models\PartnerLogo::all();
    $contact = \App\Models\Contact::first();
    $popup = \App\Models\PopupBanner::where('is_active', true)->latest()->first();
    return view('welcome', compact('posts', 'links', 'logos', 'contact', 'popup'));
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
    
    // Pass document categories for the filter dropdown
    $globalDocCategories = \App\Models\DocumentCategory::all();
    
    return view('dokumen', compact('documents', 'years', 'globalDocCategories'));
});

Route::get('/berita', function (\Illuminate\Http\Request $request) {
    $query = \App\Models\Post::with('category')->latest('published_at');
    
    if ($request->has('q') && !empty($request->q)) {
        $query->where('title', 'like', '%' . $request->q . '%')
              ->orWhere('content', 'like', '%' . $request->q . '%');
    }
    
    $posts = $query->paginate(12)->appends($request->query());
    
    // Sidebar data
    $recentPosts = \App\Models\Post::latest('published_at')->take(5)->get();
    
    return view('berita', compact('posts', 'recentPosts'));
});

Route::get('/berita/{slug}', function ($slug) {
    $post = \App\Models\Post::with(['category', 'comments' => function($q) {
        $q->where('is_approved', true)->whereNull('parent_id')->with('replies', function($q2) {
            $q2->where('is_approved', true);
        });
    }])->where('slug', $slug)->firstOrFail();
    
    // Sidebar data
    $recentPosts = \App\Models\Post::where('id', '!=', $post->id)->latest('published_at')->take(5)->get();
    
    return view('berita-single', compact('post', 'recentPosts'));
});

Route::post('/berita/{id}/comment', function (\Illuminate\Http\Request $request, $id) {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'nullable|email|max:255',
        'content' => 'required|string'
    ]);
    
    $post = \App\Models\Post::findOrFail($id);
    $post->comments()->create([
        'name' => $request->name,
        'email' => $request->email,
        'content' => $request->content,
        'is_approved' => false, // Require approval
        'is_admin' => false,
    ]);
    
    return redirect()->back()->with('success', 'Komentar Anda berhasil dikirim dan sedang menunggu moderasi oleh Admin.');
})->name('comments.store');

Route::get('/kontak', function () {
    $contact = \App\Models\Contact::first();
    return view('kontak', compact('contact'));
});

Route::get('/web', function () {
    $posts = \App\Models\Post::with('category')->latest('published_at')->get();
    return view('web', compact('posts'));
});

Route::get('/setup-storage', function () {
    try {
        $targetFolder = storage_path('app/public');
        $linkFolder = $_SERVER['DOCUMENT_ROOT'] . '/storage';
        
        if (file_exists($linkFolder)) {
            return 'Storage link already exists. (Tautan storage sudah ada)';
        }
        
        symlink($targetFolder, $linkFolder);
        return 'Storage link created successfully in document root! (Tautan storage berhasil dibuat di public_html/public)';
    } catch (\Exception $e) {
        // Fallback to artisan
        try {
            \Illuminate\Support\Facades\Artisan::call('storage:link');
            return 'Storage link created via Artisan!';
        } catch (\Exception $e2) {
            return 'Error creating symlink. Please ask your hosting provider to enable symlink() function. Error: ' . $e->getMessage();
        }
    }
});

// Fallback route to serve images if symlink fails (Sangat berguna untuk shared hosting)
Route::get('/storage/{path}', function ($path) {
    $filePath = storage_path('app/public/' . $path);
    
    if (!file_exists($filePath)) {
        abort(404);
    }
    
    $mimeType = \Illuminate\Support\Facades\File::mimeType($filePath);
    return response()->file($filePath, [
        'Content-Type' => $mimeType,
        'Cache-Control' => 'public, max-age=86400'
    ]);
})->where('path', '.*');

// Dynamic Page Route (Must be at the bottom as fallback)
Route::get('/{slug}', function ($slug) {
    $page = \App\Models\Page::where('slug', $slug)->first();
    if (!$page) {
        abort(404);
    }
    return view('page', compact('page'));
});
