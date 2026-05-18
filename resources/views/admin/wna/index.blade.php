@extends('layouts.app')

@section('title', 'Kelola Data WNA')

@section('content')
<div class="space-y-6">
    <!-- HEADER -->
    <div class="space-y-2">
        <h1 class="text-2xl md:text-3xl font-bold text-gray-900 drop-shadow-sm">
            Kelola Data WNA
        </h1>
        <p class="text-gray-600 text-base max-w-xl leading-relaxed">
            Pengelolaan Data Warga Negara Asing
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

    <!-- Search Results Info -->
    @if(request('search'))
    <div class="glass rounded-2xl p-4 shadow-xl border border-blue-200/50 bg-gradient-to-r from-blue-50/80 to-indigo-100/80 backdrop-blur-xl mb-6">
        <div class="flex items-center gap-3">
            <div class="p-2 rounded-2xl bg-blue-500/10 border border-blue-500/30 flex-shrink-0">
                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
            <div>
                <p class="font-bold text-sm text-gray-900">Hasil pencarian:</p>
                <p class="text-blue-700 font-medium">"{{ request('search') }}"</p>
            </div>
        </div>
    </div>
    @endif

    <!-- Table Container -->
    <div class="glass rounded-2xl shadow-xl border border-gray-200 transition-all duration-300 hover:shadow-2xl overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-400/5 via-indigo-500/5 to-purple-500/10 rounded-2xl opacity-0 hover:opacity-100 transition-all duration-500 pointer-events-none"></div>
        
        <div class="relative z-10">
            <!-- Table Header with Search -->
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 p-6 pb-4 border-b border-gray-200/50">
                <h2 class="text-xl font-bold text-gray-900">Daftar WNA</h2>
                
                <!-- Search Form - Right Side -->
                <form method="GET" action="{{ route('wna.index') }}" class="flex items-center gap-3 bg-white/70 backdrop-blur-sm rounded-2xl px-4 py-3 border border-gray-200/50 shadow-lg hover:shadow-xl transition-all duration-200 w-full lg:w-auto lg:flex-1 lg:max-w-md">
                    <svg class="w-5 h-5 text-gray-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}"
                        placeholder="Cari nama / paspor / negara..."
                        class="bg-transparent outline-none text-sm placeholder-gray-500 flex-1"
                    >
                    @if(request('search'))
                        <a href="{{ route('wna.index') }}" class="text-gray-400 hover:text-gray-600 transition-colors p-1 -m-1 rounded-lg hover:bg-gray-200/50">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </a>
                    @endif
                </form>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-sm border-separate border-spacing-y-2 uppercase">
                    <thead>
                        <tr class="text-xs uppercase text-gray-500">
                            <th class="px-6 py-4 text-center">No</th>
                            <th class="px-6 py-4 text-left">Nama Lengkap</th>
                            <th class="px-6 py-4 text-center">JK</th>
                            <th class="px-6 py-4 text-left">Kewarganegaraan</th>
                            <th class="px-6 py-4 text-left">Paspor</th>
                            <th class="px-6 py-4 text-left">Jenis Izin</th>
                            <th class="px-6 py-4 text-left">Masa Izin Tinggal</th>
                            <th class="px-6 py-4 text-left">Kabupaten</th>
                            <th class="px-6 py-4 text-left">Status Pengurusan</th>
                            <th class="px-6 py-4 text-left">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($data as $item)
                        <tr class="bg-white/70 backdrop-blur-md hover:bg-white transition-all rounded-xl shadow-sm hover:shadow-md">
                            <td class="px-6 py-4 text-center font-semibold text-gray-800 text-sm">
                                {{ $data->firstItem() + $loop->index }}
                            </td>

                            <!-- NAMA LENGKAP -->
                            <td class="px-6 py-4 font-semibold text-gray-900 max-w-[200px]">
                                <div class="truncate" title="{{ $item->nama_lengkap }}">
                                    {{ Str::limit($item->nama_lengkap, 25) }}
                                </div>
                            </td>

                            <!-- JENIS KELAMIN -->
                            <td class="px-6 py-4 text-center">
                                @if(strtolower($item->jenis_kelamin) == 'perempuan' || strtolower($item->jenis_kelamin) == 'p')
                                    <span class="inline-flex px-2.5 py-1 text-xs font-bold rounded-xl bg-gradient-to-r from-pink-500/10 to-rose-500/10 text-pink-700 border border-pink-400/50 hover:bg-pink-500/20 hover:border-pink-500/70 hover:scale-105 transition-all duration-200">
                                        P
                                    </span>
                                @else
                                    <span class="inline-flex px-2.5 py-1 text-xs font-bold rounded-xl bg-gradient-to-r from-blue-500/10 to-indigo-500/10 text-blue-700 border border-blue-400/50 hover:bg-blue-500/20 hover:border-blue-500/70 hover:scale-105 transition-all duration-200">
                                        L
                                    </span>
                                @endif
                            </td>

                            <!-- KEWARGANEGARAAN -->
                            <td class="px-6 py-4 text-gray-700 max-w-[120px]">
                                <div class="truncate" title="{{ $item->kewarganegaraan }}">
                                    {{ $item->kewarganegaraan }}
                                </div>
                            </td>

                            <!-- NOMOR PASPOR -->
                            <td class="px-6 py-4 text-gray-700 max-w-[120px]">
                                {{ $item->nomor_paspor }}
                            </td>

                            <!-- JENIS IZIN -->
                            <td class="px-6 py-4">
                                @php
                                    $izinLabels = [
                                        'VOA' => ['label' => 'VOA', 'color' => 'blue'],
                                        'ITAS' => ['label' => 'ITAS', 'color' => 'emerald'],
                                        'ITAP' => ['label' => 'ITAP', 'color' => 'purple'],
                                        'ITK' => ['label' => 'ITK', 'color' => 'orange']
                                    ];
                                    $izin = $izinLabels[$item->jenis_izin] ?? ['label' => $item->jenis_izin, 'color' => 'gray'];
                                @endphp
                                <span class="px-3 py-1 text-xs font-semibold rounded-lg bg-{{ $izin['color'] }}-100 text-{{ $izin['color'] }}-700 border border-{{ $izin['color'] }}-200">
                                    {{ $izin['label'] }}
                                </span>
                            </td>

                            <td class="px-6 py-4">
                                @php
                                    $tanggal = \Carbon\Carbon::parse($item->masa_berlaku);

                                    $expired = $tanggal->isPast();

                                    // Akan habis dalam 30 hari
                                    $akanHabis = !$expired && now()->diffInDays($tanggal, false) <= 30;
                                @endphp

                                <span class="px-3 py-1 text-xs font-semibold rounded-lg border transition-all duration-200
                                    {{
                                        $expired
                                            ? 'bg-rose-100 text-rose-700 border-rose-200 hover:bg-rose-200/50 hover:border-rose-300'
                                            : ($akanHabis
                                                ? 'bg-yellow-100 text-yellow-700 border-yellow-200 hover:bg-yellow-200/50 hover:border-yellow-300'
                                                : 'bg-emerald-100 text-emerald-700 border-emerald-200 hover:bg-emerald-200/50 hover:border-emerald-300')
                                    }}">
                                    
                                    {{ $tanggal->locale('id')->translatedFormat('d M Y') }}

                                </span>
                            </td>

                            <!-- KABUPATEN -->
                           <td class="px-6 py-4 text-gray-600">
                                <span class="inline-flex items-center gap-1 px-2 py-1 text-xs font-medium bg-indigo-100 text-indigo-800 rounded-lg">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" 
                                            d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" 
                                            clip-rule="evenodd">
                                        </path>
                                    </svg>

                                    {{ ucwords(str_replace('kab.', '', strtolower($item->kabupaten ?? '-'))) }}
                                </span>
                            </td>

                            <td class="text-center align-middle">
                                @if($item->status_pengurusan === 'perpanjangan')
                                    <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-lg border transition-all duration-200 
                                        bg-emerald-100 text-emerald-700 border-emerald-200 
                                        hover:bg-emerald-200/50 hover:border-emerald-300">
                                        Perpanjangan
                                    </span>
                                @else
                                    <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-lg border transition-all duration-200 
                                        bg-gray-100 text-gray-600 border-gray-200 
                                        hover:bg-gray-200/50 hover:border-gray-300">
                                        Belum Perpanjangan
                                    </span>
                                @endif
                            </td>

                            <!-- AKSI -->
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <!-- DETAIL -->
                                    <a href="{{ route('wna.show', $item->nomor_paspor) }}"
                                        class="group relative inline-flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-100 hover:bg-emerald-200 transition-all duration-200 shadow-sm hover:shadow-md hover:scale-105"
                                        title="Detail">
                                        <svg class="w-5 h-5 text-emerald-600 group-hover:text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.065 7-9.542 7s-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </a>

                                @if(auth()->user()->role === 'admin')
                                    <a href="{{ route('wna.edit', $item->nomor_paspor) }}"
                                        class="group relative inline-flex h-10 w-10 items-center justify-center rounded-xl bg-yellow-100 hover:bg-yellow-200 transition-all duration-200 shadow-sm hover:shadow-md hover:scale-105"
                                        title="Edit">
                                        <svg class="w-5 h-5 text-yellow-600 group-hover:text-yellow-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <!-- Pensil -->
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16.862 3.487a2.1 2.1 0 113.03 2.91L7 19.293 3 21l1.707-4L16.862 3.487z" />
                                            
                                            <!-- Garis bawah (area edit) -->
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 21h18" />
                                        </svg>
                                    </a>

                                    <!-- DELETE BUTTON - Trigger Modal -->
                                    <button 
                                        data-url="{{ route('wna.destroy', $item->nomor_paspor) }}"
                                        data-nama="{{ $item->nama_lengkap }}"
                                        data-paspor="{{ $item->nomor_paspor }}"
                                        onclick="confirmDelete(this)"
                                        class="group relative inline-flex h-10 w-10 items-center justify-center rounded-xl bg-red-100 hover:bg-red-200 transition-all duration-200 shadow-sm hover:shadow-md hover:scale-105"
                                        title="Hapus">

                                        <svg class="w-5 h-5 text-red-600 group-hover:text-red-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                    </button>
                                @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="p-16 text-center">
                                    <div class="flex flex-col items-center space-y-4">
                                        <div class="p-8 rounded-2xl bg-gradient-to-br from-gray-100/50 to-gray-200/50 backdrop-blur-sm border border-gray-300 shadow-xl">
                                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                            </svg>
                                        </div>
                                        <div class="space-y-2">
                                            <h3 class="text-xl font-bold text-gray-900">Belum ada data WNA</h3>
                                            <p class="text-gray-600">Data akan muncul di sini setelah ditambahkan.</p>
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
                        {{ $data->appends(request()->query())->links() }}
                    </nav>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- DELETE MODAL -->
<div id="deleteModal" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center p-4 z-50">
    <div class="relative glass rounded-2xl w-full max-w-md shadow-2xl border border-gray-200 max-h-[90vh] overflow-y-auto">
        <div class="absolute inset-0 bg-gradient-to-r from-rose-500/5 via-pink-500/5 to-red-500/10 rounded-2xl opacity-0 hover:opacity-100 transition-all duration-500 pointer-events-none"></div>
        <div class="relative z-10 p-8">
            <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-200/50">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-1">Konfirmasi Penghapusan</h2>
                    <p class="text-gray-600 text-sm font-semibold tracking-wide">Data WNA akan dihapus permanen</p>
                </div>
                <button onclick="closeModal()" class="p-2 -m-2 rounded-2xl text-gray-400 hover:text-gray-600 hover:bg-gray-200/50 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <div class="text-center mb-8 space-y-4">
                <div class="mx-auto w-20 h-20 rounded-2xl bg-gradient-to-br from-rose-500/10 to-red-500/10 border-2 border-rose-200/50 flex items-center justify-center">
                    <svg class="w-10 h-10 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                
                <div id="deleteInfo" class="space-y-2">
                    <p class="text-lg font-bold text-gray-900" id="deleteName">-</p>
                    <p class="text-sm text-gray-500" id="deletePaspor">-</p>
                </div>
                
                <p class="text-sm text-gray-700 font-semibold leading-relaxed px-4">
                    Aksi ini akan menghapus data secara permanen dari sistem.
                </p>
            </div>

            <form id="deleteForm" method="POST" class="flex flex-col sm:flex-row sm:justify-end gap-3 pt-6 border-t border-gray-200/50">
                @csrf
                @method('DELETE')
                
                <button type="button" onclick="closeModal()" 
                    class="group relative inline-flex h-12 px-8 items-center justify-center rounded-2xl font-semibold text-sm shadow-lg hover:shadow-xl focus:outline-none transition-all duration-300 min-w-[120px] overflow-hidden bg-white/80 backdrop-blur-md border-2 border-gray-200 hover:border-gray-300 hover:bg-white/95 hover:scale-105 active:scale-95 flex-1 sm:flex-none">
                    <div class="absolute inset-0 bg-gradient-to-r from-gray-100/50 to-gray-200/30 opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
                    <div class="relative flex items-center gap-2 text-gray-700 group-hover:text-gray-900 font-semibold">
                        <svg class="w-4 h-4 flex-shrink-0 group-hover:-translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        Batal
                    </div>
                </button>
                
                <button type="submit"
                    class="group relative inline-flex h-12 px-8 items-center justify-center rounded-2xl font-semibold text-sm shadow-lg hover:shadow-xl focus:outline-none transition-all duration-300 min-w-[140px] overflow-hidden bg-gradient-to-r from-rose-500/90 to-red-500/90 backdrop-blur-md border-2 border-rose-400/50 hover:border-rose-500/70 hover:scale-105 hover:from-rose-600/95 hover:to-red-600/95 active:scale-95 flex-1 sm:flex-none">
                    <div class="absolute inset-0 bg-gradient-to-r from-rose-400/30 to-red-500/40 opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
                    <div class="absolute inset-0 bg-gradient-to-r from-white/20 to-transparent opacity-75 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative flex items-center gap-2 text-white font-bold">
                        <svg class="w-4 h-4 flex-shrink-0 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Hapus Data
                    </div>
                </button>
            </form>
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

<script>
let currentDeleteUrl = '';

function confirmDelete(el) {
    const url = el.getAttribute('data-url');
    const nama = el.getAttribute('data-nama');
    const paspor = el.getAttribute('data-paspor');

    document.getElementById('deleteForm').action = url;
    document.getElementById('deleteName').textContent = nama;
    document.getElementById('deletePaspor').textContent = paspor;

    openModal();
}

function openModal() {
    const modal = document.getElementById('deleteModal');
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
    document.getElementById('deleteName').focus();
}

function closeModal() {
    const modal = document.getElementById('deleteModal');
    modal.classList.add('hidden');
    document.body.style.overflow = 'auto';
}

// Close modal on outside click
document.addEventListener('click', function(e) {
    const modal = document.getElementById('deleteModal');
    if (modal.classList.contains('hidden')) return;
    
    const content = modal.querySelector('.glass');
    if (content && !content.contains(e.target)) {
        closeModal();
    }
});

// Close modal on ESC key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeModal();
    }
});

// Prevent form submission on Enter in modal content
document.getElementById('deleteModal')?.addEventListener('keydown', function(e) {
    if (e.key === 'Enter' && !e.target.closest('button, input[type="submit"]')) {
        e.preventDefault();
    }
});
</script>
@endsection