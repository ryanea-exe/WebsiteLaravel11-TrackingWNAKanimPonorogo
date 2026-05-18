@extends('layouts.app')

@section('title', 'Detail Data WNA')

@section('content')
<div class="space-y-6">
    <!-- HEADER -->
    <div class="space-y-2">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900 drop-shadow-sm">
                    Detail Data WNA
                </h1>
                <p class="text-gray-600 text-base max-w-xl leading-relaxed">
                    Informasi lengkap Warga Negara Asing
                </p>

            </div>
        </div>
    </div>

    <!-- DATA IDENTITAS SECTION -->
    <div class="glass rounded-2xl p-8 shadow-xl border border-gray-200 transition-all duration-300 hover:shadow-2xl overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-emerald-500/5 via-teal-500/5 to-blue-500/10 rounded-2xl opacity-0 hover:opacity-100 transition-all duration-500 pointer-events-none"></div>
        <div class="relative z-10">
            <div class="flex items-center justify-between mb-8 pb-4 border-b border-gray-200/50">
                <div>
                    <h3 class="text-xl font-bold text-gray-900 mb-1">Data Identitas</h3>
                    <p class="text-gray-600 text-sm font-semibold tracking-wide">Informasi pribadi WNA</p>
                </div>
                <div class="w-5 h-5 rounded-full bg-gradient-to-r from-emerald-500 to-teal-500 animate-pulse shrink-0"></div>
            </div>

            <div class="grid lg:grid-cols-2 gap-8">
                <div class="space-y-6"> 
                    <div class="space-y-2">
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide">Nomor Paspor</label>
                        <div class="w-full h-12 px-4 py-3 rounded-2xl border-2 border-gray-200/70 bg-gray-100/70 backdrop-blur-sm text-gray-900 cursor-not-allowed font-medium text-base">
                            {{ $wna->nomor_paspor }}
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide">Nama Lengkap</label>
                        <div class="w-full h-12 px-4 py-3 rounded-2xl border-2 border-gray-200/70 bg-white/70 backdrop-blur-sm text-gray-900 placeholder-gray-500 focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100/50 focus:outline-none transition-all duration-200 shadow-lg hover:shadow-xl hover:border-gray-300/80 font-medium text-base">
                            {{ $wna->nama_lengkap }}
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide">Jenis Kelamin</label>
                        <div class="w-full h-12 px-4 py-3 rounded-2xl border-2 border-gray-200/70 bg-white/70 backdrop-blur-sm text-gray-900 placeholder-gray-500 focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100/50 focus:outline-none transition-all duration-200 shadow-lg hover:shadow-xl hover:border-gray-300/80 font-medium text-base">
                            {{ $wna->jenis_kelamin }}
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="space-y-2">
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide">Kewarganegaraan</label>
                        <div class="w-full h-12 px-4 py-3 rounded-2xl border-2 border-gray-200/70 bg-white/70 backdrop-blur-sm text-gray-900 placeholder-gray-500 focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100/50 focus:outline-none transition-all duration-200 shadow-lg hover:shadow-xl hover:border-gray-300/80 font-medium text-base">
                            {{ $wna->kewarganegaraan }}
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide">Tempat Lahir</label>
                        <div class="w-full h-12 px-4 py-3 rounded-2xl border-2 border-gray-200/70 bg-white/70 backdrop-blur-sm text-gray-900 placeholder-gray-500 focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100/50 focus:outline-none transition-all duration-200 shadow-lg hover:shadow-xl hover:border-gray-300/80 font-medium text-base">
                            {{ $wna->tempat_lahir ?? '-' }}
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide">Tanggal Lahir</label>
                        <div class="w-full h-12 px-4 py-3 rounded-2xl border-2 border-gray-200/70 bg-white/70 backdrop-blur-sm text-gray-900 placeholder-gray-500 focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100/50 focus:outline-none transition-all duration-200 shadow-lg hover:shadow-xl hover:border-gray-300/80 font-medium text-base">
                            {{ $wna->tanggal_lahir ? \Carbon\Carbon::parse($wna->tanggal_lahir)->format('d M Y') : '-' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- IZIN TINGGAL & TUJUAN SECTION -->
    <div class="glass rounded-2xl p-8 shadow-xl border border-gray-200 transition-all duration-300 hover:shadow-2xl overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-400/5 via-indigo-500/5 to-purple-500/10 rounded-2xl opacity-0 hover:opacity-100 transition-all duration-500 pointer-events-none"></div>
        <div class="relative z-10">
            <div class="flex items-center justify-between mb-8 pb-4 border-b border-gray-200/50">
                <div>
                    <h3 class="text-xl font-bold text-gray-900 mb-1">Izin Tinggal & Tujuan</h3>
                    <p class="text-gray-600 text-sm font-semibold tracking-wide">Informasi jenis izin dan tujuan</p>
                </div>
                <div class="w-5 h-5 rounded-full bg-gradient-to-r from-blue-500 to-purple-500 animate-pulse shrink-0"></div>
            </div>

            <div class="grid lg:grid-cols-2 gap-8">
                <div class="space-y-6">
                    <div class="space-y-2">
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide">Jenis Izin</label>
                        <div class="w-full h-12 px-4 py-3 rounded-2xl border-2 border-gray-200/70 bg-white/70 backdrop-blur-sm text-gray-900 placeholder-gray-500 focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100/50 focus:outline-none transition-all duration-200 shadow-lg hover:shadow-xl hover:border-gray-300/80 font-medium text-base">
                            {{ $wna->jenis_izin }}
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide">Masa Berlaku</label>
                        <div class="w-full h-12 px-4 py-3 rounded-2xl border-2 border-gray-200/70 bg-white/70 backdrop-blur-sm text-gray-900 placeholder-gray-500 focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100/50 focus:outline-none transition-all duration-200 shadow-lg hover:shadow-xl hover:border-gray-300/80 font-medium text-base">
                            {{ $wna->masa_berlaku ? \Carbon\Carbon::parse($wna->masa_berlaku)->format('d M Y') : '-' }}
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-2 space-y-6">
                    <div class="space-y-2">
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide">Tujuan</label>
                        <div class="w-full h-12 px-4 py-3 rounded-2xl border-2 border-gray-200/70 bg-white/70 backdrop-blur-sm text-gray-900 placeholder-gray-500 focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100/50 focus:outline-none transition-all duration-200 shadow-lg hover:shadow-xl hover:border-gray-300/80 font-medium text-base">
                            {{ $wna->tujuan ?? '-' }}
                        </div>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide">
                        Status Pengurusan
                    </label>

                    <div class="w-full h-12 px-4 py-3 rounded-2xl border-2 border-gray-200/70 bg-white/70 backdrop-blur-sm text-gray-900 font-medium text-base shadow-lg hover:shadow-xl hover:border-gray-300/80">
                        {{ $wna->status_pengurusan === 'perpanjangan' 
                            ? 'Perpanjangan' 
                            : 'Belum Perpanjangan' }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ALAMAT & PENJAMIN SECTION -->
    <div class="glass rounded-2xl p-8 shadow-xl border border-gray-200 transition-all duration-300 hover:shadow-2xl overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-purple-400/5 via-pink-500/5 to-rose-500/10 rounded-2xl opacity-0 hover:opacity-100 transition-all duration-500 pointer-events-none"></div>
        <div class="relative z-10">
            <div class="flex items-center justify-between mb-8 pb-4 border-b border-gray-200/50">
                <div>
                    <h3 class="text-xl font-bold text-gray-900 mb-1">Alamat & Penjamin</h3>
                    <p class="text-gray-600 text-sm font-semibold tracking-wide">Informasi alamat dan penjamin</p>
                </div>
                <div class="w-5 h-5 rounded-full bg-gradient-to-r from-purple-500 to-rose-500 animate-pulse shrink-0"></div>
            </div>

            <div class="grid lg:grid-cols-2 gap-8">
                <div class="space-y-6">
                    <div class="space-y-2">
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide">Kabupaten</label>
                        <div class="w-full h-12 px-4 py-3 rounded-2xl border-2 border-gray-200/70 bg-white/70 backdrop-blur-sm text-gray-900 placeholder-gray-500 focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100/50 focus:outline-none transition-all duration-200 shadow-lg hover:shadow-xl hover:border-gray-300/80 font-medium text-base">
                            {{ $wna->kabupaten ?? '-' }}
                        </div>
                    </div>

                    <div class="lg:col-span-2 space-y-2">
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide">Alamat Lengkap</label>
                        <div class="w-full px-4 py-3 rounded-2xl border-2 border-gray-200/70 bg-white/70 backdrop-blur-sm text-gray-900 font-medium text-base shadow-lg hover:shadow-xl hover:border-gray-300/80 
                                    transition-all duration-200 leading-relaxed min-h-[48px] break-words whitespace-pre-line">
                            {{ $wna->alamat ?? '-' }}
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="space-y-2">
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide">Nama Penjamin</label>
                        <div class="w-full px-4 py-3 rounded-2xl border-2 border-gray-200/70 bg-white/70 backdrop-blur-sm text-gray-900 font-medium text-base shadow-lg hover:shadow-xl hover:border-gray-300/80 
                                    transition-all duration-200 leading-relaxed min-h-[48px] break-words whitespace-pre-line">
                            {{ $wna->alamat_penjamin ?? '-' }}
                        </div>
                    </div>

                    <div class="lg:col-span-2 space-y-2">
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide">Alamat Penjamin</label>
                        <div class="w-full px-4 py-3 rounded-2xl border-2 border-gray-200/70 bg-white/70 backdrop-blur-sm text-gray-900 font-medium text-base shadow-lg hover:shadow-xl hover:border-gray-300/80 
                                    transition-all duration-200 leading-relaxed min-h-[48px] flex items-center focus-within:border-emerald-400 focus-within:ring-2 focus-within:ring-emerald-100/50">
                            {{ $wna->alamat_penjamin ?? '-' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ACTION BUTTONS -->
    <div class="pt-6 border-t border-gray-200/50 flex flex-col sm:flex-row sm:justify-end gap-4">
        <a href="{{ url()->previous() }}"
           class="group relative inline-flex h-12 px-8 items-center justify-center rounded-2xl font-semibold text-sm shadow-lg hover:shadow-xl focus:outline-none transition-all duration-300 min-w-[140px] overflow-hidden bg-white/80 backdrop-blur-md border-2 border-gray-200 hover:border-gray-300 hover:bg-white/95 hover:scale-105 active:scale-95">
            <div class="absolute inset-0 bg-gradient-to-r from-gray-100/50 to-gray-200/30 opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
            <div class="relative flex items-center gap-2 text-gray-700 group-hover:text-gray-900 font-semibold">
                <svg class="w-4 h-4 flex-shrink-0 group-hover:-translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali
            </div>
        </a>
    </div>
</div>

<style>
    .glass {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }

    @media print {
        .glass, button, a[href] {
            box-shadow: none !important;
            border: 1px solid #e5e7eb !important;
            background: white !important;
        }
        
        button, a[href]:not([href*="{{ route('wna.edit', ['nomor_paspor' => $wna->nomor_paspor]) }}"]) {
            display: none !important;
        }
        
        body * {
            color: black !important;
        }
    }
</style>
@endsection