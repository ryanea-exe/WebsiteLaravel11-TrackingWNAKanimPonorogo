@extends('layouts.app')

@section('title', 'Edit Data')

@section('content')
<div class="space-y-6">
    <!-- HEADER -->
    <div class="space-y-2">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900 drop-shadow-sm">
                    Edit Data WNA
                </h1>
                <p class="text-gray-600 text-base max-w-xl leading-relaxed">
                    Formulir Pengisian Data Warga Negara Asing
                </p>
            </div>
        </div>
    </div>

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
                    <h3 class="font-bold text-lg text-gray-900 mb-1">Berhasil diupdate!</h3>
                    <p class="text-gray-600 font-medium">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    @if ($errors->any())
        <div class="glass rounded-2xl p-6 shadow-xl border border-rose-200/50 bg-gradient-to-r from-rose-50/80 to-rose-100/80 backdrop-blur-xl transition-all duration-300 hover:shadow-2xl">
            <div class="absolute inset-0 bg-gradient-to-br from-rose-500/10 to-pink-600/20 rounded-2xl opacity-50"></div>
            <div class="relative z-10 flex items-start gap-3">
                <div class="p-2 rounded-2xl bg-rose-500/10 border border-rose-500/30 flex-shrink-0">
                    <svg class="w-5 h-5 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <h3 class="font-bold text-lg text-gray-900 mb-2">Periksa input:</h3>
                    <ul class="space-y-1 text-sm">
                        @foreach ($errors->all() as $error)
                            <li class="flex items-center gap-2 text-rose-700 font-medium">
                                <svg class="w-3 h-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                </svg>
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <form action="{{ route('wna.update', $wna->nomor_paspor) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- DATA IDENTITAS SECTION -->
        <div class="glass rounded-2xl p-8 shadow-xl border border-gray-200 transition-all duration-300 hover:shadow-2xl overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-emerald-500/5 via-teal-500/5 to-blue-500/10 rounded-2xl opacity-0 hover:opacity-100 transition-all duration-500 pointer-events-none"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-200/50">
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 mb-1">Data Identitas</h3>
                        <p class="text-gray-600 text-sm font-semibold tracking-wide">Informasi pribadi WNA</p>
                    </div>
                    <div class="w-5 h-5 rounded-full bg-gradient-to-r from-emerald-500 to-teal-500 animate-pulse shrink-0"></div>
                </div>

                <div class="grid lg:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide">Nomor Paspor <span class="text-rose-500">*</span></label>
                        <input type="text" name="nomor_paspor" value="{{ $wna->nomor_paspor }}" readonly
                            class="w-full h-12 px-4 py-3 rounded-2xl border-2 border-gray-200/70 bg-gray-100/70 backdrop-blur-sm text-gray-900 cursor-not-allowed font-medium text-base">
                    </div>

                    <div class="space-y-2">
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide">Nama Lengkap <span class="text-rose-500">*</span></label>
                        <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $wna->nama_lengkap) }}" required placeholder="Masukkan nama lengkap"
                            class="w-full h-12 px-4 py-3 rounded-2xl border-2 border-gray-200/70 bg-white/70 backdrop-blur-sm text-gray-900 placeholder-gray-500 focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100/50 focus:outline-none transition-all duration-200 shadow-lg hover:shadow-xl hover:border-gray-300/80 font-medium text-base">
                    </div>

                    <div class="space-y-2">
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide">Jenis Kelamin <span class="text-rose-500">*</span></label>
                        <select name="jenis_kelamin" required class="w-full h-12 px-4 py-3 rounded-2xl border-2 border-gray-200/70 bg-white/70 backdrop-blur-sm text-gray-900 focus:border-blue-400 focus:ring-2 focus:ring-blue-100/50 focus:outline-none transition-all duration-200 shadow-lg hover:shadow-xl hover:border-gray-300/80 font-medium text-base appearance-none bg-no-repeat bg-right">
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="Laki-laki" 
                                {{ strtolower(trim(old('jenis_kelamin', $wna->jenis_kelamin))) == 'laki-laki' ? 'selected' : '' }}>
                                Laki-laki
                            </option>
                            <option value="Perempuan" 
                                {{ strtolower(trim(old('jenis_kelamin', $wna->jenis_kelamin))) == 'perempuan' ? 'selected' : '' }}>
                                Perempuan
                            </option>
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide">Kewarganegaraan <span class="text-rose-500">*</span></label>
                        <input type="text" name="kewarganegaraan" value="{{ old('kewarganegaraan', $wna->kewarganegaraan) }}" required placeholder="Amerika Serikat"
                            class="w-full h-12 px-4 py-3 rounded-2xl border-2 border-gray-200/70 bg-white/70 backdrop-blur-sm text-gray-900 placeholder-gray-500 focus:border-purple-400 focus:ring-2 focus:ring-purple-100/50 focus:outline-none transition-all duration-200 shadow-lg hover:shadow-xl hover:border-gray-300/80 font-medium text-base">
                    </div>

                    <div class="space-y-2">
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $wna->tempat_lahir) }}" placeholder="New York"
                            class="w-full h-12 px-4 py-3 rounded-2xl border-2 border-gray-200/70 bg-white/70 backdrop-blur-sm text-gray-900 placeholder-gray-500 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100/50 focus:outline-none transition-all duration-200 shadow-lg hover:shadow-xl hover:border-gray-300/80 font-medium text-base">
                    </div>

                    <div class="space-y-2">
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $wna->tanggal_lahir) }}"
                            class="w-full h-12 px-4 py-3 rounded-2xl border-2 border-gray-200/70 bg-white/70 backdrop-blur-sm text-gray-900 focus:border-teal-400 focus:ring-2 focus:ring-teal-100/50 focus:outline-none transition-all duration-200 shadow-lg hover:shadow-xl hover:border-gray-300/80 font-medium text-base">
                    </div>
                </div>
            </div>
        </div>

        <!-- IZIN TINGGAL & TUJUAN SECTION -->
        <div class="glass rounded-2xl p-8 shadow-xl border border-gray-200 transition-all duration-300 hover:shadow-2xl overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-400/5 via-indigo-500/5 to-purple-500/10 rounded-2xl opacity-0 hover:opacity-100 transition-all duration-500 pointer-events-none"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-200/50">
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 mb-1">Izin Tinggal & Tujuan</h3>
                        <p class="text-gray-600 text-sm font-semibold tracking-wide">Informasi jenis izin dan tujuan</p>
                    </div>
                    <div class="w-5 h-5 rounded-full bg-gradient-to-r from-blue-500 to-purple-500 animate-pulse shrink-0"></div>
                </div>

                <div class="grid lg:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide">Jenis Izin <span class="text-rose-500">*</span></label>
                        <select name="jenis_izin" required class="w-full h-12 px-4 py-3 rounded-2xl border-2 border-gray-200/70 bg-white/70 backdrop-blur-sm text-gray-900 focus:border-pink-400 focus:ring-2 focus:ring-pink-100/50 focus:outline-none transition-all duration-200 shadow-lg hover:shadow-xl hover:border-gray-300/80 font-medium text-base appearance-none bg-no-repeat bg-right">
                            <option value="">Pilih Jenis Izin</option>
                            <option value="AFFIDAVIT" {{ old('jenis_izin', $wna->jenis_izin) == 'AFFIDAVIT' ? 'selected' : '' }}>AFFIDAVIT</option>
                            <option value="VOA" {{ old('jenis_izin', $wna->jenis_izin) == 'VOA' ? 'selected' : '' }}>VOA - Visa on Arrival</option>
                            <option value="ITAS" {{ old('jenis_izin', $wna->jenis_izin) == 'ITAS' ? 'selected' : '' }}>ITAS - Izin Tinggal Sementara</option>
                            <option value="ITAP" {{ old('jenis_izin', $wna->jenis_izin) == 'ITAP' ? 'selected' : '' }}>ITAP - Izin Tinggal Tetap</option>
                            <option value="ITK" {{ old('jenis_izin', $wna->jenis_izin) == 'ITK' ? 'selected' : '' }}>ITK - Izin Tinggal Kunjungan</option>
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide">Masa Berlaku</label>
                        <input type="date" name="masa_berlaku" value="{{ old('masa_berlaku', $wna->masa_berlaku) }}"
                            class="w-full h-12 px-4 py-3 rounded-2xl border-2 border-gray-200/70 bg-white/70 backdrop-blur-sm text-gray-900 focus:border-orange-400 focus:ring-2 focus:ring-orange-100/50 focus:outline-none transition-all duration-200 shadow-lg hover:shadow-xl hover:border-gray-300/80 font-medium text-base">
                    </div>

                    <div class="lg:col-span-2 space-y-2">
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide">Tujuan</label>
                        <input type="text" name="tujuan" value="{{ old('tujuan', $wna->tujuan) }}" placeholder="Penyatuan Keluarga/Pelajar/Tenaga Kerja/dsb"
                            class="w-full h-12 px-4 py-3 rounded-2xl border-2 border-gray-200/70 bg-white/70 backdrop-blur-sm text-gray-900 placeholder-gray-500 focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100/50 focus:outline-none transition-all duration-200 shadow-lg hover:shadow-xl hover:border-gray-300/80 font-medium text-base">
                    </div>

                     <div class="space-y-2">
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide">
                            Status Pengurusan
                        </label>

                        <select name="status_pengurusan"
                            class="w-full h-12 px-4 py-3 rounded-2xl border-2 border-gray-200/70 bg-white/70 backdrop-blur-sm text-gray-900 focus:border-pink-400 focus:ring-2 focus:ring-pink-100/50 focus:outline-none transition-all duration-200 shadow-lg hover:shadow-xl hover:border-gray-300/80 font-medium text-base appearance-none bg-no-repeat bg-right">

                            <option value="">Pilih Status Pengurusan Izin Tinggal</option>
                            
                            <option value="perpanjangan" 
                                {{ old('status_pengurusan', $wna->status_pengurusan ?? '') == 'perpanjangan' ? 'selected' : '' }}>
                                Perpanjangan
                            </option>

                            <option value="belum_perpanjangan" 
                                {{ old('status_pengurusan', $wna->status_pengurusan ?? '') == 'belum_perpanjangan' ? 'selected' : '' }}>
                                Belum Perpanjangan
                            </option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- ALAMAT & PENJAMIN SECTION -->
        <div class="glass rounded-2xl p-8 shadow-xl border border-gray-200 transition-all duration-300 hover:shadow-2xl overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-purple-400/5 via-pink-500/5 to-rose-500/10 rounded-2xl opacity-0 hover:opacity-100 transition-all duration-500 pointer-events-none"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-200/50">
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 mb-1">Alamat & Penjamin</h3>
                        <p class="text-gray-600 text-sm font-semibold tracking-wide">Informasi alamat dan penjamin</p>
                    </div>
                    <div class="w-5 h-5 rounded-full bg-gradient-to-r from-purple-500 to-rose-500 animate-pulse shrink-0"></div>
                </div>

                <div class="grid lg:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide">Kabupaten</label>
                        <select name="kabupaten" class="w-full h-12 px-4 py-3 rounded-2xl border-2 border-gray-200/70 bg-white/70 backdrop-blur-sm text-gray-900 focus:border-blue-400 focus:ring-2 focus:ring-blue-100/50 focus:outline-none transition-all duration-200 shadow-lg hover:shadow-xl hover:border-gray-300/80 font-medium text-base appearance-none bg-no-repeat bg-right">
                            <option value="">Pilih Kabupaten</option>
                            <option value="Ponorogo" 
                                {{ str_contains(strtolower(old('kabupaten', $wna->kabupaten)), 'ponorogo') ? 'selected' : '' }}>
                                Ponorogo
                            </option>

                            <option value="Pacitan" 
                                {{ str_contains(strtolower(old('kabupaten', $wna->kabupaten)), 'pacitan') ? 'selected' : '' }}>
                                Pacitan
                            </option>

                            <option value="Trenggalek" 
                                {{ str_contains(strtolower(old('kabupaten', $wna->kabupaten)), 'trenggalek') ? 'selected' : '' }}>
                                Trenggalek
                            </option>
                        </select>
                    </div>

                    <div class="lg:col-span-2 space-y-2">
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide">Alamat Lengkap</label>
                        <textarea name="alamat" rows="3" placeholder="Masukkan Alamat" 
                            class="w-full px-4 py-3 rounded-2xl border-2 border-gray-200/70 bg-white/70 backdrop-blur-sm text-gray-900 placeholder-gray-500 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100/50 focus:outline-none transition-all duration-200 shadow-lg hover:shadow-xl hover:border-gray-300/80 font-medium text-base resize-vertical">{{ old('alamat', $wna->alamat) }}</textarea>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide">Nama Penjamin</label>
                        <input type="text" name="nama_penjamin" value="{{ old('nama_penjamin', $wna->nama_penjamin) }}" placeholder="Nama lengkap penjamin"
                            class="w-full h-12 px-4 py-3 rounded-2xl border-2 border-gray-200/70 bg-white/70 backdrop-blur-sm text-gray-900 placeholder-gray-500 focus:border-orange-400 focus:ring-2 focus:ring-orange-100/50 focus:outline-none transition-all duration-200 shadow-lg hover:shadow-xl hover:border-gray-300/80 font-medium text-base">
                    </div>

                    <div class="lg:col-span-2 space-y-2">
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide">Alamat Penjamin</label>
                        <textarea name="alamat_penjamin" rows="2" placeholder="Masukkan alamat penjamin" 
                            class="w-full px-4 py-3 rounded-2xl border-2 border-gray-200/70 bg-white/70 backdrop-blur-sm text-gray-900 placeholder-gray-500 focus:border-teal-400 focus:ring-2 focus:ring-teal-100/50 focus:outline-none transition-all duration-200 shadow-lg hover:shadow-xl hover:border-gray-300/80 font-medium text-base resize-vertical">{{ old('alamat_penjamin', $wna->alamat_penjamin) }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- ACTION BUTTONS -->
        <div class="pt-6 border-t border-gray-200/50 flex flex-col sm:flex-row sm:justify-end gap-4">
            <a href="{{ route('wna.index') }}"
               class="group relative inline-flex h-12 px-8 items-center justify-center rounded-2xl font-semibold text-sm shadow-lg hover:shadow-xl focus:outline-none transition-all duration-300 min-w-[140px] overflow-hidden bg-white/80 backdrop-blur-md border-2 border-gray-200 hover:border-gray-300 hover:bg-white/95 hover:scale-105 active:scale-95">
                <div class="absolute inset-0 bg-gradient-to-r from-gray-100/50 to-gray-200/30 opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
                <div class="relative flex items-center gap-2 text-gray-700 group-hover:text-gray-900 font-semibold">
                    <svg class="w-4 h-4 flex-shrink-0 group-hover:-translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Kembali
                </div>
            </a>

            <button type="submit" 
                    class="group relative inline-flex h-12 px-10 items-center justify-center rounded-2xl font-semibold text-sm shadow-lg hover:shadow-xl focus:outline-none transition-all duration-300 min-w-[160px] overflow-hidden bg-gradient-to-r from-emerald-500/90 to-teal-600/90 backdrop-blur-md border-2 border-emerald-400/50 hover:border-emerald-500/70 hover:scale-105 hover:from-emerald-600/95 hover:to-teal-700/95 active:scale-95">
                <div class="absolute inset-0 bg-gradient-to-r from-emerald-400/30 to-teal-500/40 opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
                <div class="absolute inset-0 bg-gradient-to-r from-white/20 to-transparent opacity-75 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative flex items-center gap-2 text-white font-bold">
                    <svg class="w-4 h-4 flex-shrink-0 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Update Data
                </div>
            </button>
        </div>
    </form>
</div>

<style>
    select {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 1rem center;
        background-repeat: no-repeat;
        background-size: 1.25em 1.25em;
        padding-right: 2.5rem;
        cursor: pointer;
    }

    input[type="date"]::-webkit-calendar-picker-indicator {
        filter: invert(0.5) sepia(1) saturate(3) hue-rotate(175deg);
        cursor: pointer;
        padding: 0.5rem;
        opacity: 0.8;
        border-radius: 9999px;
        background: rgba(255,255,255,0.3);
        border: 1px solid rgba(255,255,255,0.2);
    }

    textarea {
        font-family: inherit;
    }

    input[readonly] {
        background-color: rgba(156, 163, 175, 0.1) !important;
        color: rgba(55, 65, 81, 0.8) !important;
        cursor: not-allowed !important;
    }

    .glass {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }
</style>
@endsection