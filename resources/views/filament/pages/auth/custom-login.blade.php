    @push('styles')
    @vite('resources/css/app.css')
@endpush

<div class="flex min-h-screen bg-gray-50">
        <!-- Left Side: Image/Branding -->
        <div class="hidden lg:flex lg:w-1/2 bg-blue-900 bg-cover bg-center items-center justify-center relative" style="background-image: url('https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?q=80&w=1920&auto=format&fit=crop');">
            <div class="absolute inset-0 bg-blue-900/80 mix-blend-multiply"></div>
            <div class="relative z-10 p-12 text-white max-w-xl">
                <div class="mb-8 inline-block bg-white/10 p-4 rounded-2xl backdrop-blur-md border border-white/20 shadow-xl">
                    <img src="{{ asset('images/logo_alor.png') }}" alt="Logo" class="h-24 drop-shadow-md">
                </div>
                <h1 class="text-4xl font-extrabold mb-4 leading-tight">Portal Manajemen<br>Inspektorat Daerah<br>Kabupaten Alor</h1>
                <p class="text-lg text-blue-100 font-medium opacity-90">Sistem informasi terpadu untuk mengelola publikasi, berita, dokumen publik, dan profil instansi.</p>
            </div>
        </div>

        <!-- Right Side: Login Form -->
        <div class="flex flex-col justify-center items-center w-full lg:w-1/2 bg-white p-8 sm:p-12 shadow-2xl z-20">
            <div class="w-full max-w-md">
                <div class="mb-8 lg:hidden flex flex-col items-center text-center">
                    <img src="{{ asset('images/logo_alor.png') }}" alt="Logo" class="h-20 mb-4 drop-shadow-md">
                    <h1 class="text-2xl font-bold text-gray-900">Inspektorat Daerah</h1>
                    <p class="text-sm text-gray-500">Kabupaten Alor</p>
                </div>
                
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Masuk</h2>
                <p class="text-gray-500 mb-8 font-medium">Gunakan email dan kata sandi Anda</p>

                {{ $this->content }}
                
                <div class="mt-12 text-center text-sm text-gray-400">
                    &copy; {{ date('Y') }} Inspektorat Daerah Kab. Alor. All rights reserved.
                </div>
            </div>
        </div>
    </div>
