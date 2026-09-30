@extends('layouts.main')

@section('content')
<div class="py-16 bg-white min-h-[60vh]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center mb-16">
            <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight">Hubungi Kami</h1>
            <p class="mt-4 max-w-2xl text-xl text-gray-500 mx-auto">Kami siap membantu dan mendengarkan Anda. Kunjungi kantor kami atau hubungi melalui saluran yang tersedia.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
            
            <!-- Info Kontak & Social Media -->
            <div class="bg-slate-50 p-10 rounded-3xl shadow-sm border border-slate-100 flex flex-col justify-center">
                <h3 class="text-2xl font-bold text-gray-900 mb-8 border-l-4 border-blue-600 pl-4">Informasi Kontak</h3>
                
                <ul class="space-y-6">
                    <li class="flex items-start">
                        <div class="flex-shrink-0 h-12 w-12 flex items-center justify-center rounded-xl bg-blue-100 text-blue-600 shadow-inner">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div class="ml-5">
                            <h4 class="text-lg font-semibold text-gray-900">Alamat Kantor</h4>
                            <p class="mt-1 text-gray-600 leading-relaxed">{{ $contact->address ?? 'Alamat belum diatur' }}</p>
                        </div>
                    </li>

                    <li class="flex items-start">
                        <div class="flex-shrink-0 h-12 w-12 flex items-center justify-center rounded-xl bg-blue-100 text-blue-600 shadow-inner">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="ml-5">
                            <h4 class="text-lg font-semibold text-gray-900">Email</h4>
                            <p class="mt-1 text-gray-600"><a href="mailto:{{ $contact->email ?? '#' }}" class="hover:text-blue-600 transition">{{ $contact->email ?? 'Email belum diatur' }}</a></p>
                        </div>
                    </li>

                    <li class="flex items-start">
                        <div class="flex-shrink-0 h-12 w-12 flex items-center justify-center rounded-xl bg-green-100 text-green-600 shadow-inner">
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 00-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-5 flex flex-col justify-center min-h-[3rem]">
                            <h4 class="text-lg font-semibold text-gray-900">WhatsApp (Call Center)</h4>
                            <p class="mt-1 text-gray-600">{{ $contact->whatsapp ?? 'Nomor belum diatur' }}</p>
                        </div>
                    </li>
                </ul>

                <hr class="my-10 border-gray-200">

                <h4 class="text-lg font-semibold text-gray-900 mb-5 border-l-4 border-blue-600 pl-4">Media Sosial</h4>
                <div class="flex gap-4">
                    <!-- Facebook -->
                    @if($contact && $contact->facebook)
                    <a href="{{ $contact->facebook }}" target="_blank" class="w-12 h-12 flex items-center justify-center rounded-full bg-slate-100 text-slate-500 hover:bg-blue-600 hover:text-white hover:scale-110 transition-all duration-300 shadow-sm hover:shadow-md" title="Facebook">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" /></svg>
                    </a>
                    @endif
                    
                    <!-- Instagram -->
                    @if($contact && $contact->instagram)
                    <a href="{{ $contact->instagram }}" target="_blank" class="group w-12 h-12 flex items-center justify-center rounded-full bg-slate-100 text-slate-500 relative overflow-hidden hover:text-white hover:scale-110 transition-all duration-300 shadow-sm hover:shadow-md" title="Instagram">
                        <div class="absolute inset-0 bg-gradient-to-tr from-yellow-400 via-pink-500 to-purple-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-0"></div>
                        <svg class="w-6 h-6 relative z-10" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" /></svg>
                    </a>
                    @endif

                    <!-- YouTube -->
                    @if($contact && $contact->youtube)
                    <a href="{{ $contact->youtube }}" target="_blank" class="w-12 h-12 flex items-center justify-center rounded-full bg-slate-100 text-slate-500 hover:bg-red-600 hover:text-white hover:scale-110 transition-all duration-300 shadow-sm hover:shadow-md" title="YouTube">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.5 12 3.5 12 3.5s-7.505 0-9.377.55a3.016 3.016 0 0 0-2.122 2.136C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.55 9.376.55 9.376.55s7.505 0 9.377-.55a3.016 3.016 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                    </a>
                    @endif

                    <!-- Tiktok -->
                    @if($contact && $contact->tiktok)
                    <a href="{{ $contact->tiktok }}" target="_blank" class="w-12 h-12 flex items-center justify-center rounded-full bg-slate-100 text-slate-500 hover:bg-black hover:text-white hover:scale-110 transition-all duration-300 shadow-sm hover:shadow-md" title="Tiktok">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 448 512"><path d="M448,209.91a210.06,210.06,0,0,1-122.77-39.25V349.38A162.55,162.55,0,1,1,185,188.31V278.2a74.62,74.62,0,1,0,52.23,71.18V0l88,0a121.18,121.18,0,0,0,1.86,22.17h0A122.18,122.18,0,0,0,381,102.39a121.43,121.43,0,0,0,67,20.14Z"/></svg>
                    </a>
                    @endif

                    <!-- LinkedIn -->
                    @if($contact && $contact->linkedin)
                    <a href="{{ $contact->linkedin }}" target="_blank" class="w-12 h-12 flex items-center justify-center rounded-full bg-slate-100 text-slate-500 hover:bg-blue-700 hover:text-white hover:scale-110 transition-all duration-300 shadow-sm hover:shadow-md" title="LinkedIn">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 448 512"><path d="M100.28 448H7.4V148.9h92.88zM53.79 108.1C24.09 108.1 0 83.5 0 53.8a53.79 53.79 0 0 1 107.58 0c0 29.7-24.1 54.3-53.79 54.3zM447.9 448h-92.68V302.4c0-34.7-.7-79.2-48.29-79.2-48.29 0-55.69 37.7-55.69 76.7V448h-92.78V148.9h89.08v40.8h1.3c12.4-23.5 42.69-48.3 87.88-48.3 94 0 111.28 61.9 111.28 142.3V448z"/></svg>
                    </a>
                    @endif
                </div>
            </div>

            <!-- Map -->
            <div class="h-full min-h-[400px] rounded-3xl overflow-hidden shadow-sm border border-slate-200">
                @if($contact && $contact->map_url)
                <iframe 
                    width="100%" 
                    height="100%" 
                    frameborder="0" 
                    scrolling="no" 
                    marginheight="0" 
                    marginwidth="0" 
                    src="{{ $contact->map_url }}"
                    title="Peta Lokasi"
                    class="w-full h-full min-h-[400px]"
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy">
                </iframe>
                @endif
            </div>

        </div>
    </div>
</div>
@endsection
