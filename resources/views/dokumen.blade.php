@extends('layouts.main')

@section('content')
<div class="py-16 bg-gray-50 min-h-[50vh]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-10">
            <h1 class="text-3xl font-extrabold text-gray-900">Dokumen Publik</h1>
            <p class="mt-2 text-gray-600">Daftar dokumen peraturan, perencanaan, SOP, dan laporan yang dapat diunduh oleh publik.</p>
        </div>

        <div class="flex flex-col md:flex-row gap-8">
            <!-- Filter Sidebar -->
            <div class="w-full md:w-1/4">
                <form action="/dokumen" method="GET" class="bg-white p-6 rounded-3xl shadow-[0_5px_20px_rgba(0,0,0,0.02)] border border-slate-100 sticky top-28">
                    <h3 class="font-bold text-slate-800 mb-6 border-b border-slate-100 pb-3 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                        Filter Dokumen
                    </h3>
                    
                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Cari Judul</label>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Ketik kata kunci..." class="w-full rounded-xl border-slate-200 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm py-2.5 px-4 border transition-colors outline-none hover:border-blue-300 bg-slate-50 focus:bg-white">
                    </div>
                    
                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Kategori</label>
                        <select name="kategori" class="w-full rounded-xl border-slate-200 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm py-2.5 px-4 border transition-colors outline-none hover:border-blue-300 bg-slate-50 focus:bg-white">
                            <option value="">Semua Kategori</option>
                            @if(isset($globalDocCategories))
                                @foreach($globalDocCategories as $dc)
                                    <option value="{{ $dc->slug }}" {{ request('kategori') == $dc->slug ? 'selected' : '' }}>
                                        {{ $dc->name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="mb-8">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Tahun</label>
                        <select name="tahun" class="w-full rounded-xl border-slate-200 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm py-2.5 px-4 border transition-colors outline-none hover:border-blue-300 bg-slate-50 focus:bg-white">
                            <option value="">Semua Tahun</option>
                            @if(isset($years))
                                @foreach($years as $year)
                                    <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <button type="submit" class="w-full bg-blue-600 text-white font-semibold py-3 px-4 rounded-xl hover:bg-blue-700 transition duration-300 shadow-sm hover:shadow-md flex items-center justify-center gap-2">
                        Terapkan Filter
                    </button>
                    @if(request()->has('kategori') || request()->has('tahun') || request()->has('search'))
                    <a href="/dokumen" class="block text-center mt-4 text-sm font-medium text-slate-500 hover:text-blue-600 transition">Reset Filter</a>
                    @endif
                </form>
            </div>

            <!-- Table -->
            <div class="w-full md:w-3/4 bg-white rounded-3xl shadow-[0_5px_20px_rgba(0,0,0,0.02)] border border-slate-100 overflow-hidden self-start">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-100">
                        <thead class="bg-slate-50 border-b border-slate-100">
                            <tr>
                                <th scope="col" class="px-8 py-5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Judul Dokumen</th>
                                <th scope="col" class="px-8 py-5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Kategori</th>
                                <th scope="col" class="px-8 py-5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Tahun</th>
                                <th scope="col" class="px-8 py-5 text-right text-xs font-bold text-slate-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-50">
                            @forelse($documents as $doc)
                            <tr class="hover:bg-blue-50/50 transition-colors duration-200 group">
                                <td class="px-8 py-5 whitespace-normal">
                                    <div class="flex items-start gap-3">
                                        <svg class="w-6 h-6 text-slate-300 group-hover:text-blue-500 shrink-0 mt-0.5 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                        <span class="text-sm font-semibold text-slate-800 leading-snug group-hover:text-blue-700 transition-colors">{{ $doc->title }}</span>
                                    </div>
                                </td>
                                <td class="px-8 py-5 whitespace-nowrap text-sm text-slate-500">
                                    <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-bold bg-slate-100 text-slate-600 group-hover:bg-blue-100 group-hover:text-blue-700 transition-colors">
                                        {{ $doc->category ? $doc->category->name : 'Lainnya' }}
                                    </span>
                                </td>
                                <td class="px-8 py-5 whitespace-nowrap text-sm text-slate-600 font-medium">{{ $doc->year ?? '-' }}</td>
                                <td class="px-8 py-5 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank" class="text-blue-600 bg-blue-50 hover:bg-blue-600 hover:text-white px-5 py-2.5 rounded-xl text-xs font-bold transition-all duration-300 inline-flex items-center gap-2 group/btn">
                                        <svg class="w-4 h-4 group-hover/btn:-translate-y-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                        Unduh
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-8 py-16 text-center">
                                    <div class="mx-auto w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mb-4">
                                        <svg class="w-10 h-10 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    </div>
                                    <p class="text-base font-medium text-slate-900 mb-1">Tidak Ada Dokumen</p>
                                    <p class="text-sm text-slate-500">Belum ada dokumen yang dipublikasikan atau sesuai filter Anda.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
