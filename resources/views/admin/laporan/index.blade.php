@extends('layouts.app')

@section('title', 'Laporan')

@section('content')
<div class="space-y-6">
    <!-- HEADER -->
    <div class="space-y-2">
        <h1 class="text-2xl md:text-3xl font-bold text-gray-900 drop-shadow-sm">
            Laporan Data Warga Negara Asing (WNA)
        </h1>
        <p class="text-gray-600 text-base max-w-xl leading-relaxed">
            Laporan lengkap data Warga Negara Asing (WNA)
        </p>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
        <div class="glass rounded-2xl p-6 shadow-xl border border-emerald-200/50 bg-gradient-to-r from-emerald-50/80 to-emerald-100/80 backdrop-blur-xl transition-all duration-300 hover:shadow-2xl">
            <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/10 to-teal-600/20 rounded-2xl opacity-50"></div>
            <div class="relative z-10 flex items-start gap-3">
                <div class="p-2 rounded-2xl bg-emerald-500/10 border border-emerald-500/30 flex-shrink-0">
                    <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <h3 class="font-bold text-lg text-gray-900 mb-1">Berhasil!</h3>
                    <p class="text-gray-600 font-medium">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    <!-- Filter Form -->
    <form method="GET" class="glass rounded-2xl shadow-xl border border-gray-200 transition-all duration-300 hover:shadow-2xl p-6">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-400/5 via-indigo-500/5 to-purple-500/10 rounded-2xl opacity-0 hover:opacity-100 transition-all duration-500 pointer-events-none"></div>
        
        <div class="relative z-10">
            <h2 class="text-xl font-bold text-gray-900 mb-6">Filter Laporan</h2>
            
            <div class="flex flex-col lg:flex-row lg:items-end gap-6">
                <!-- Filter Inputs (Left Side) -->
                <div class="flex flex-wrap gap-4 items-end flex-1 min-w-0">
                    <!-- FILTER WILAYAH -->
                    <div class="flex flex-col gap-1 min-w-[180px] flex-1">
                        <label class="text-sm font-semibold text-gray-700">Wilayah</label>
                        <div class="relative">
                            <select name="wilayah" class="glass w-full h-12 px-4 pr-10 rounded-2xl border border-gray-200/50 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500/50 transition-all duration-200 appearance-none bg-white/80">
                                <option value="">Semua Wilayah</option>
                                <option value="Ponorogo" {{ request('wilayah') == 'Ponorogo' ? 'selected' : '' }}>Ponorogo</option>
                                <option value="Trenggalek" {{ request('wilayah') == 'Trenggalek' ? 'selected' : '' }}>Trenggalek</option>
                                <option value="Pacitan" {{ request('wilayah') == 'Pacitan' ? 'selected' : '' }}>Pacitan</option>
                            </select>
                            <svg class="w-5 h-5 text-gray-500 absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- FILTER JENIS IZIN -->
                    <div class="flex flex-col gap-1 min-w-[220px] flex-1">
                        <label class="text-sm font-semibold text-gray-700">Jenis Izin Tinggal</label>
                        <div class="relative">
                            <select name="jenis_izin" class="glass w-full h-12 px-4 pr-10 rounded-2xl border border-gray-200/50 shadow-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500/50 transition-all duration-200 appearance-none bg-white/80">
                                <option value="">Semua Izin</option>
                                <option value="AFFIDAVIT" {{ request('jenis_izin') == 'AFFIVADIT' ? 'selected' : '' }}>AFFIDAVIT</option>
                                <option value="VOA" {{ request('jenis_izin') == 'VOA' ? 'selected' : '' }}>VOA</option>
                                <option value="ITAS" {{ request('jenis_izin') == 'ITAS' ? 'selected' : '' }}>ITAS</option>
                                <option value="ITAP" {{ request('jenis_izin') == 'ITAP' ? 'selected' : '' }}>ITAP</option>
                                <option value="ITK" {{ request('jenis_izin') == 'ITK' ? 'selected' : '' }}>ITK</option>
                            </select>
                            <svg class="w-5 h-5 text-gray-500 absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Buttons (Right Side - Horizontal) -->
                <div class="flex flex-wrap gap-3 justify-end items-end">
                    <!-- BUTTON FILTER -->
                    <button type="submit"
                        class="group relative flex items-center justify-center gap-2 h-12 px-6 rounded-2xl font-semibold text-sm shadow-lg hover:shadow-xl focus:outline-none transition-all duration-300 min-w-[100px] overflow-hidden bg-gradient-to-r from-blue-500/90 to-indigo-500/90 border border-blue-400/50 hover:border-blue-500/70 hover:scale-105 hover:from-blue-600/95 hover:to-indigo-600/95 active:scale-95">
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-400/30 to-indigo-500/40 opacity-0 group-hover:opacity-100 transition-all duration-200"></div>
                        <svg class="w-4 h-4 flex-shrink-0 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                        </svg>
                        <span class="text-white font-semibold">Filter</span>
                    </button>

                    <!-- BUTTON RESET -->
                    <a href="{{ route('laporan.index') }}" 
                       class="group relative flex items-center justify-center gap-2 h-12 px-6 rounded-2xl font-semibold text-sm shadow-lg hover:shadow-xl focus:outline-none transition-all duration-300 min-w-[100px] overflow-hidden bg-white/80 backdrop-blur-md border-2 border-gray-200 hover:border-gray-300 hover:bg-white/95 hover:scale-105 active:scale-95 flex-shrink-0">
                        <div class="absolute inset-0 bg-gradient-to-r from-gray-100/50 to-gray-200/30 opacity-0 group-hover:opacity-100 transition-all duration-200"></div>
                        <svg class="w-4 h-4 flex-shrink-0 text-gray-700 group-hover:text-gray-900 group-hover:rotate-180 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        <span class="text-gray-700 group-hover:text-gray-900 font-semibold">Reset</span>
                    </a>

                    <!-- BUTTON CETAK -->
                    <a href="{{ route('admin.laporan.pdf', request()->query()) }}" 
                       target="_blank"
                       class="group relative flex items-center justify-center gap-2 h-12 px-6 rounded-2xl font-semibold text-sm shadow-lg hover:shadow-xl focus:outline-none transition-all duration-300 min-w-[120px] overflow-hidden bg-gradient-to-r from-emerald-500/90 to-teal-500/90 border border-emerald-400/50 hover:border-emerald-500/70 hover:scale-105 hover:from-emerald-600/95 hover:to-teal-600/95 active:scale-95 flex-shrink-0">
                        <div class="absolute inset-0 bg-gradient-to-r from-emerald-400/30 to-teal-500/40 opacity-0 group-hover:opacity-100 transition-all duration-200"></div>
                        <svg class="w-4 h-4 flex-shrink-0 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                        </svg>
                        <span class="text-white font-semibold">Cetak PDF</span>
                    </a>
                </div>
            </div>
        </div>
    </form>

    <!-- Filter Results Info -->
    @if(request('wilayah') || request('jenis_izin'))
    <div class="glass rounded-2xl p-4 shadow-xl border border-blue-200/50 bg-gradient-to-r from-blue-50/80 to-indigo-100/80 backdrop-blur-xl">
        <div class="flex flex-wrap items-center gap-4 text-sm">
            @if(request('wilayah'))
            <div class="flex items-center gap-2 bg-blue-500/10 px-3 py-1.5 rounded-xl border border-blue-500/30">
                <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <span class="font-medium text-blue-800">Wilayah: {{ request('wilayah') }}</span>
            </div>
            @endif
            @if(request('jenis_izin'))
            <div class="flex items-center gap-2 bg-emerald-500/10 px-3 py-1.5 rounded-xl border border-emerald-500/30">
                <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="font-medium text-emerald-800">Izin: {{ request('jenis_izin') }}</span>
            </div>
            @endif
        </div>
    </div>
    @endif

    <!-- Table Container -->
    <div class="glass rounded-2xl shadow-xl border border-gray-200 transition-all duration-300 hover:shadow-2xl overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-emerald-400/5 via-teal-500/5 to-green-500/10 rounded-2xl opacity-0 hover:opacity-100 transition-all duration-500 pointer-events-none"></div>
        
        <div class="relative z-10">
            <!-- Table Header -->
            <div class="flex items-center justify-between p-6 pb-4 border-b border-gray-200/50">
                <div>
                    <h2 class="text-xl font-bold text-gray-900 mb-1">Daftar Laporan WNA</h2>
                    <p class="text-sm text-gray-600">
                        Total: 
                        <span class="font-semibold text-gray-900">{{ number_format($data->total()) }}</span> data
                        @if($data->hasPages())
                        | Halaman {{ $data->currentPage() }} dari {{ $data->lastPage() }}
                        @endif
                    </p>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-sm border-separate border-spacing-y-2 uppercase">
                    <thead>
                        <tr class="text-xs uppercase text-gray-500">
                            <th class="px-6 py-4 text-center">No</th>
                            <th class="px-6 py-4 text-left">Nama Lengkap</th>
                            <th class="px-6 py-4 text-left">Wilayah</th>
                            <th class="px-6 py-4 text-left">Jenis Izin Tinggal</th>
                            <th class="px-6 py-4 text-left">Kewarganegaraan</th>
                            <th class="px-6 py-4 text-left">Masa Izin Tinggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $i => $item)
                        <tr class="bg-white/70 backdrop-blur-md hover:bg-white transition-all rounded-xl shadow-sm hover:shadow-md">
                            <td class="px-6 py-4 text-center font-semibold text-gray-800 text-sm">
                                {{ ($data->firstItem() ?? 0) + $i }}
                            </td>
                            <td class="px-6 py-4 font-semibold text-gray-900">
                                {{ \Illuminate\Support\Str::limit($item->nama_lengkap, 30) }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="inline-flex items-center">
                                    <span class="inline-flex items-center gap-2 px-3 py-1.5 text-xs font-bold rounded-xl 
                                        bg-gradient-to-r from-indigo-500/10 to-purple-500/10 
                                        text-indigo-700 border border-indigo-400/50">

                                        <svg class="w-3 h-3 text-indigo-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" 
                                                d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" 
                                                clip-rule="evenodd">
                                            </path>
                                        </svg>

                                        <span>
                                            {{ ucwords(str_replace('kab.', '', strtolower($item->kabupaten ?? '-'))) }}
                                        </span>
                                    </span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex px-3 py-1.5 text-xs font-bold rounded-xl bg-gradient-to-r from-emerald-500/10 to-teal-500/10 text-emerald-700 border border-emerald-400/50">
                                    {{ $item->jenis_izin ?? '-' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-700 font-medium">
                                {{ $item->kewarganegaraan ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $tanggal = \Carbon\Carbon::parse($item->masa_berlaku);
                                    $expired = $tanggal->isPast();
                                @endphp

                                <span class="px-3 py-1 text-xs font-semibold rounded-lg border transition-all duration-200
                                    {{ $expired 
                                        ? 'bg-rose-100 text-rose-700 border-rose-200 hover:bg-rose-200/50 hover:border-rose-300' 
                                        : 'bg-emerald-100 text-emerald-700 border-emerald-200 hover:bg-emerald-200/50 hover:border-emerald-300' 
                                    }}">
                                    
                                   {{ $tanggal->locale('id')->translatedFormat('d M Y') }}
                                    
                                </span>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-12 text-center">
                                                                    <div class="flex flex-col items-center space-y-4">
                                    <div class="p-8 rounded-2xl bg-gradient-to-br from-gray-100/50 to-gray-200/50 backdrop-blur-sm border border-gray-300 shadow-xl">
                                        <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                        </svg>
                                    </div>
                                    <div class="space-y-2">
                                        <h3 class="text-xl font-bold text-gray-900">
                                            @if(request('wilayah') || request('jenis_izin'))
                                                Tidak ada data yang sesuai dengan filter
                                            @else
                                                Belum ada data laporan WNA
                                            @endif
                                        </h3>
                                        @if(request('wilayah') || request('jenis_izin'))
                                        <p class="text-gray-600">Coba ubah filter atau reset untuk melihat semua data</p>
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($data->hasPages())
            <div class="px-6 pb-6 pt-4 border-t border-gray-200/50">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <!-- Info Pagination -->
                    <div class="text-sm text-gray-700 font-medium">
                        Menampilkan 
                        <span class="font-semibold text-gray-900">{{ $data->firstItem() ?? 0 }}</span> - 
                        <span class="font-semibold text-gray-900">{{ $data->lastItem() ?? 0 }}</span> 
                        dari 
                        <span class="font-semibold text-gray-900">{{ number_format($data->total()) }}</span> data
                    </div>
                    
                    <!-- Pagination Links -->
                    <nav aria-label="Navigasi halaman">
                        <div class="flex items-center gap-1">
                            {{ $data->appends(request()->query())->links() }}
                        </div>
                    </nav>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<style>
    .glass {
        @apply bg-white/70 backdrop-blur-xl;
    }

    .pagination {
        @apply flex items-center gap-1;
    }
    
    .pagination .page-link {
        @apply inline-flex items-center justify-center px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-gray-700 hover:border-gray-400 transition-all duration-200 shadow-sm;
    }
    
    .pagination .page-item.active .page-link {
        @apply bg-gradient-to-r from-emerald-500 to-teal-600 text-white border-emerald-500 shadow-lg hover:shadow-xl hover:scale-105;
    }
    
    .pagination .page-item.disabled .page-link {
        @apply text-gray-300 bg-gray-100 cursor-not-allowed;
    }
</style>
@endsection