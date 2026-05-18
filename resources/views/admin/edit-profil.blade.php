@extends('layouts.app')

@section('title', 'Edit Profil')

@section('content')
<div class="space-y-6">
    <!-- HEADER -->
    <div class="space-y-2">
        <h1 class="text-2xl md:text-3xl font-bold text-gray-900 drop-shadow-sm">
            Edit Profil
        </h1>
        <p class="text-gray-600 text-base max-w-xl leading-relaxed">
            Perbarui informasi profil pengguna Anda
        </p>
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
                    <h3 class="font-bold text-lg text-gray-900 mb-1">Berhasil diperbarui!</h3>
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
                    <h3 class="font-bold text-lg text-gray-900 mb-2">Gagal Memperbarui Data Profil</h3>
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

    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- AVATAR & USERNAME SECTION -->
        <div class="glass rounded-2xl p-8 shadow-xl border border-gray-200 transition-all duration-300 hover:shadow-2xl overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-emerald-500/5 via-teal-500/5 to-blue-500/10 rounded-2xl opacity-0 hover:opacity-100 transition-all duration-500 pointer-events-none"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-200/50">
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 mb-1">Foto Profil & Username</h3>
                        <p class="text-gray-600 text-sm font-semibold tracking-wide">Informasi identitas pengguna</p>
                    </div>
                    <div class="w-5 h-5 rounded-full bg-gradient-to-r from-emerald-500 to-teal-500 animate-pulse shrink-0"></div>
                </div>

                <div class="grid lg:grid-cols-2 gap-6 items-start">
                    <!-- AVATAR -->
                    <div class="space-y-4 text-center lg:text-left">
                        <div class="inline-block relative mx-auto lg:mx-0">
                            @if(auth()->user()->avatar)
                                <img src="{{ asset('storage/' . auth()->user()->avatar) }}" 
                                     alt="Avatar" 
                                     class="w-28 h-28 lg:w-32 lg:h-32 rounded-2xl object-cover shadow-xl border-2 border-gray-200/70 ring-2 ring-gray-100/50 mx-auto lg:mx-0 transition-all duration-300 hover:shadow-2xl hover:scale-105">
                            @else
                                <div class="w-28 h-28 lg:w-32 lg:h-32 rounded-2xl bg-white/80 border-2 border-gray-200/70 ring-2 ring-gray-100/50 flex items-center justify-center mx-auto lg:mx-0 shadow-xl backdrop-blur-sm transition-all duration-300 hover:shadow-2xl hover:scale-105">
                                    <svg class="w-12 h-12 lg:w-14 lg:h-14 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                            @endif
                            <label for="avatar" class="block w-full mt-4">
                                <div class="relative inline-flex h-12 px-6 items-center justify-center rounded-2xl font-semibold text-sm shadow-lg hover:shadow-xl focus:outline-none transition-all duration-300 bg-gradient-to-r from-emerald-500/90 to-teal-600/90 border-2 border-emerald-400/50 hover:border-emerald-500/70 hover:scale-105 active:scale-95 cursor-pointer overflow-hidden">
                                    <div class="absolute inset-0 bg-gradient-to-r from-emerald-400/30 to-teal-500/40 opacity-0 hover:opacity-100 transition-all duration-300"></div>
                                    <div class="relative flex items-center gap-2 text-white font-bold">
                                        <svg class="w-4 h-4 flex-shrink-0 hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        Ganti Foto
                                    </div>
                                </div>
                                <input type="file" 
                                       id="avatar"
                                       name="avatar" 
                                       accept="image/*" 
                                       class="hidden">
                            </label>
                        </div>
                    </div>

                    <!-- USERNAME -->
                    <div class="space-y-4">
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide">Username <span class="text-rose-500">*</span></label>
                        <input type="text" 
                               name="username"
                               value="{{ old('username', auth()->user()->username) }}"
                               required
                               placeholder="Masukkan username baru"
                               class="w-full h-12 px-4 py-3 rounded-2xl border-2 border-gray-200/70 bg-white/70 backdrop-blur-sm text-gray-900 placeholder-gray-500 focus:border-blue-400 focus:ring-2 focus:ring-blue-100/50 focus:outline-none transition-all duration-200 shadow-lg hover:shadow-xl hover:border-gray-300/80 font-medium text-base">
                    </div>
                </div>
            </div>
        </div>

        <!-- PASSWORD SECTION -->
        <div class="glass rounded-2xl p-8 shadow-xl border border-gray-200 transition-all duration-300 hover:shadow-2xl overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-400/5 via-indigo-500/5 to-purple-500/10 rounded-2xl opacity-0 hover:opacity-100 transition-all duration-500 pointer-events-none"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-200/50">
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 mb-1">Ubah Password</h3>
                        <p class="text-gray-600 text-sm font-semibold tracking-wide">Kosongkan jika tidak ingin mengubah</p>
                    </div>
                    <div class="w-5 h-5 rounded-full bg-gradient-to-r from-blue-500 to-purple-500 animate-pulse shrink-0"></div>
                </div>

                <div class="grid lg:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide">Password Baru</label>
                        <input type="password" 
                               name="password"
                               placeholder="Kosongkan jika tidak ingin mengubah"
                               class="w-full h-12 px-4 py-3 rounded-2xl border-2 border-gray-200/70 bg-white/70 backdrop-blur-sm text-gray-900 placeholder-gray-500 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100/50 focus:outline-none transition-all duration-200 shadow-lg hover:shadow-xl hover:border-gray-300/80 font-medium text-base">
                    </div>

                    <div class="space-y-2">
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide">Konfirmasi Password</label>
                        <input type="password" 
                               name="password_confirmation"
                               placeholder="Konfirmasi password baru"
                               class="w-full h-12 px-4 py-3 rounded-2xl border-2 border-gray-200/70 bg-white/70 backdrop-blur-sm text-gray-900 placeholder-gray-500 focus:border-purple-400 focus:ring-2 focus:ring-purple-100/50 focus:outline-none transition-all duration-200 shadow-lg hover:shadow-xl hover:border-gray-300/80 font-medium text-base">
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
                    Batal
                </div>
            </a>

            <button type="submit" 
                    class="group relative inline-flex h-12 px-10 items-center justify-center rounded-2xl font-semibold text-sm shadow-lg hover:shadow-xl focus:outline-none transition-all duration-300 min-w-[160px] overflow-hidden bg-gradient-to-r from-emerald-500/90 to-teal-600/90 backdrop-blur-md border-2 border-emerald-400/50 hover:border-emerald-500/70 hover:scale-105 hover:from-emerald-600/95 hover:to-teal-700/95 active:scale-95">
                <div class="absolute inset-0 bg-gradient-to-r from-emerald-400/30 to-teal-500/40 opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
                <div class="absolute inset-0 bg-gradient-to-r from-white/20 to-transparent opacity-75 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative flex items-center gap-2 text-white font-bold">
                    <svg class="w-4 h-4 flex-shrink-0 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Update Profil
                </div>
            </button>
        </div>
    </form>
</div>
@endsection