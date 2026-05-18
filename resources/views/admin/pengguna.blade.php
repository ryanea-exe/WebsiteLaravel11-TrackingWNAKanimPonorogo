@extends('layouts.app')

@section('title', 'Kelola Pengguna')

@section('content')
<div class="space-y-6">
    <!-- HEADER -->
    <div class="space-y-2">
        <h1 class="text-2xl md:text-3xl font-bold text-gray-900 drop-shadow-sm">
            Kelola Pengguna
        </h1>
        <p class="text-gray-600 text-base max-w-xl leading-relaxed">
            Pengelolaan Data Pengguna Sistem
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

    <!-- Table Container -->
    <div class="glass rounded-2xl shadow-xl border border-gray-200 transition-all duration-300 hover:shadow-2xl overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-400/5 via-indigo-500/5 to-purple-500/10 rounded-2xl opacity-0 hover:opacity-100 transition-all duration-500 pointer-events-none"></div>
        
        <div class="relative z-10">
            <!-- Table Header with Add Button -->
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 p-6 pb-4 border-b border-gray-200/50">
                <h2 class="text-xl font-bold text-gray-900">Daftar Pengguna</h2>
                
                <button onclick="openModal('addModal')" 
                    class="group relative inline-flex h-12 px-6 items-center justify-center rounded-2xl font-semibold text-sm shadow-lg hover:shadow-xl focus:outline-none transition-all duration-300 min-w-[140px] overflow-hidden bg-gradient-to-r from-emerald-500/90 to-teal-600/90 backdrop-blur-md border border-emerald-400/50 hover:border-emerald-500/70 hover:scale-105 hover:from-emerald-600/95 hover:to-teal-700/95 active:scale-95">
                    <div class="absolute inset-0 bg-gradient-to-r from-emerald-400/30 to-teal-500/40 opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
                    <div class="absolute inset-0 bg-gradient-to-r from-white/20 to-transparent opacity-75 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative flex items-center gap-2 text-white font-bold">
                        <svg class="w-4 h-4 flex-shrink-0 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Tambah Pengguna
                    </div>
                </button>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-sm border-separate border-spacing-y-2">
                    <thead>
                        <tr class="text-xs uppercase text-gray-500">
                            <th class="px-6 py-4 text-center">No</th>
                            <th class="px-6 py-4 text-left">Username</th>
                            <th class="px-6 py-4 text-center">Role</th>
                            <th class="px-6 py-4 text-center">Status</th>
                            <th class="px-6 py-4 text-center">Dibuat</th>
                            <th class="px-6 py-4 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $index => $u)
                        <tr class="bg-white/70 backdrop-blur-md hover:bg-white transition-all rounded-xl shadow-sm hover:shadow-md">
                            <td class="px-6 py-4 text-center font-semibold text-gray-800 text-sm">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-6 py-4 font-semibold text-gray-900 max-w-[200px]">
                                <div class="truncate" title="{{ $u->username }}">
                                    {{ Str::limit($u->username, 25) }}
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                @php
                                    $roleLabels = [
                                        'admin' => ['label' => 'Admin', 'color' => 'purple'],
                                        'staff' => ['label' => 'Staff', 'color' => 'blue']
                                    ];
                                    $role = $roleLabels[$u->role] ?? ['label' => ucfirst($u->role), 'color' => 'gray'];
                                @endphp
                                <span class="inline-flex px-2.5 py-1 text-xs font-bold rounded-xl bg-gradient-to-r 
                                    from-{{ $role['color'] }}-500/10 to-{{ $role['color'] }}-500/10 
                                    text-{{ $role['color'] }}-700 border border-{{ $role['color'] }}-400/50 
                                    hover:bg-{{ $role['color'] }}-500/20 hover:border-{{ $role['color'] }}-500/70 
                                    hover:scale-105 transition-all duration-200">
                                    {{ $role['label'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($u->status == 'aktif')
                                    <span class="inline-flex px-2.5 py-1 text-xs font-bold rounded-xl bg-gradient-to-r from-emerald-500/10 to-teal-500/10 text-emerald-700 border border-emerald-400/50 hover:bg-emerald-500/20 hover:border-emerald-500/70 hover:scale-105 transition-all duration-200">
                                        Aktif
                                    </span>
                                @else
                                    <span class="inline-flex px-2.5 py-1 text-xs font-bold rounded-xl bg-gradient-to-r from-gray-500/10 to-gray-500/10 text-gray-700 border border-gray-400/50 hover:bg-gray-500/20 hover:border-gray-500/70 hover:scale-105 transition-all duration-200">
                                        Nonaktif
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-gray-600 text-center">
                                {{ $u->created_at ? $u->created_at->locale('id')->translatedFormat('d M Y') : '-' }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2 justify-center">
                                    <!-- EDIT -->
                                    <button onclick="editUser({{ $u->id }}, '{{ $u->username }}', '{{ $u->role }}', '{{ $u->status }}')"
                                        class="group relative inline-flex h-10 w-10 items-center justify-center rounded-xl bg-yellow-100 hover:bg-yellow-200 transition-all duration-200 shadow-sm hover:shadow-md hover:scale-105"
                                        title="Edit">
                                        <svg class="w-5 h-5 text-yellow-600 group-hover:text-yellow-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.862 3.487a2.1 2.1 0 113.03 2.91L7 19.293 3 21l1.707-4L16.862 3.487z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21h18"></path>
                                        </svg>
                                    </button>

                                    <!-- DELETE BUTTON - Trigger Modal -->
                                    <button 
                                        onclick="confirmDelete({{ $u->id }}, '{{ $u->username }}')"
                                        class="group relative inline-flex h-10 w-10 items-center justify-center rounded-xl bg-red-100 hover:bg-red-200 transition-all duration-200 shadow-sm hover:shadow-md hover:scale-105"
                                        title="Hapus">
                                        <svg class="w-5 h-5 text-red-600 group-hover:text-red-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-16 text-center">
                                    <div class="flex flex-col items-center space-y-4">
                                        <div class="p-8 rounded-2xl bg-gradient-to-br from-gray-100/50 to-gray-200/50 backdrop-blur-sm border border-gray-300 shadow-xl">
                                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                            </svg>
                                        </div>
                                        <div class="space-y-2">
                                            <h3 class="text-xl font-bold text-gray-900">Belum ada pengguna</h3>
                                            <p class="text-gray-600">Data akan muncul di sini setelah ditambahkan.</p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- MODAL TAMBAH -->
<div id="addModal" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center p-4 z-50">
    <div class="relative glass rounded-2xl w-full max-w-lg shadow-2xl border border-gray-200 max-h-[90vh] overflow-y-auto">
        <div class="absolute inset-0 bg-gradient-to-r from-emerald-500/5 via-teal-500/5 to-blue-500/10 rounded-2xl opacity-0 hover:opacity-100 transition-all duration-500 pointer-events-none"></div>
        <div class="relative z-10 p-8">
            <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-200/50">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-1">Tambah Pengguna</h2>
                    <p class="text-gray-600 text-sm font-semibold tracking-wide">Buat akun pengguna baru</p>
                </div>
                <button onclick="closeModal('addModal')" class="p-2 -m-2 rounded-2xl text-gray-400 hover:text-gray-600 hover:bg-gray-200/50 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <div class="space-y-4">
                    <div class="space-y-3 text-center">
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide">
                            Foto Profil
                        </label>
                        <div class="flex justify-center">
                            <div class="relative">
                                <img id="previewAvatar"
                                    src="https://ui-avatars.com/api/?name=User&background=0D8ABC&color=fff"
                                    class="w-24 h-24 rounded-full object-cover border-4 border-white shadow-lg">
                                <label for="avatarInput"
                                    class="absolute -bottom-2 -right-2 bg-emerald-500 hover:bg-emerald-600 text-white p-2 rounded-full cursor-pointer shadow-lg border-2 border-white">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H3a2 2 0 01-2-2V9z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </label>
                            </div>
                        </div>
                        <input id="avatarInput" type="file" name="avatar" accept="image/*" class="hidden">
                        <p class="text-xs text-gray-500">Klik icon untuk upload foto</p>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide">Username <span class="text-rose-500">*</span></label>
                        <input name="username" required placeholder="Masukkan username" 
                            class="w-full h-12 px-4 py-3 rounded-2xl border-2 border-gray-200/70 bg-white/70 backdrop-blur-sm text-gray-900 placeholder-gray-500 focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100/50 focus:outline-none transition-all duration-200 shadow-lg hover:shadow-xl hover:border-gray-300/80 font-medium text-base">
                    </div>
                    <div class="space-y-2">
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide">Password <span class="text-rose-500">*</span></label>
                        <input type="password" name="password" required placeholder="Masukkan password" 
                            class="w-full h-12 px-4 py-3 rounded-2xl border-2 border-gray-200/70 bg-white/70 backdrop-blur-sm text-gray-900 placeholder-gray-500 focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100/50 focus:outline-none transition-all duration-200 shadow-lg hover:shadow-xl hover:border-gray-300/80 font-medium text-base">
                    </div>
                    <div class="space-y-2">
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide">Role <span class="text-rose-500">*</span></label>
                        <select name="role" required class="w-full h-12 px-4 py-3 rounded-2xl border-2 border-gray-200/70 bg-white/70 backdrop-blur-sm text-gray-900 focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100/50 focus:outline-none transition-all duration-200 shadow-lg hover:shadow-xl hover:border-gray-300/80 font-medium text-base appearance-none bg-no-repeat bg-right pr-10">
                            <option value="staff">Staff</option>
                            <option value="admin">Administrator</option>
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide">Status <span class="text-rose-500">*</span></label>
                        <select name="status" required class="w-full h-12 px-4 py-3 rounded-2xl border-2 border-gray-200/70 bg-white/70 backdrop-blur-sm text-gray-900 focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100/50 focus:outline-none transition-all duration-200 shadow-lg hover:shadow-xl hover:border-gray-300/80 font-medium text-base appearance-none bg-no-repeat bg-right pr-10">
                            <option value="aktif">Aktif</option>
                            <option value="nonaktif">Nonaktif</option>
                        </select>
                    </div>
                </div>

                <div class="pt-6 border-t border-gray-200/50 flex flex-col sm:flex-row sm:justify-end gap-3">
                    <button type="button" onclick="closeModal('addModal')" 
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
                        class="group relative inline-flex h-12 px-8 items-center justify-center rounded-2xl font-semibold text-sm shadow-lg hover:shadow-xl focus:outline-none transition-all duration-300 min-w-[140px] overflow-hidden bg-gradient-to-r from-emerald-500/90 to-teal-600/90 backdrop-blur-md border-2 border-emerald-400/50 hover:border-emerald-500/70 hover:scale-105 hover:from-emerald-600/95 hover:to-teal-700/95 active:scale-95 flex-1 sm:flex-none">
                        <div class="absolute inset-0 bg-gradient-to-r from-emerald-400/30 to-teal-500/40 opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
                        <div class="absolute inset-0 bg-gradient-to-r from-white/20 to-transparent opacity-75 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative flex items-center gap-2 text-white font-bold">
                            <svg class="w-4 h-4 flex-shrink-0 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Simpan
                        </div>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL EDIT -->
<div id="editModal" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center p-4 z-50">
    <div class="relative glass rounded-2xl w-full max-w-lg shadow-2xl border border-gray-200 max-h-[90vh] overflow-y-auto">
        <div class="absolute inset-0 bg-gradient-to-r from-yellow-500/5 via-orange-500/5 to-rose-500/10 rounded-2xl opacity-0 hover:opacity-100 transition-all duration-500 pointer-events-none"></div>
        <div class="relative z-10 p-8">
            <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-200/50">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-1">Edit Pengguna</h2>
                    <p class="text-gray-600 text-sm font-semibold tracking-wide">Update informasi pengguna</p>
                </div>
                <button onclick="closeModal('editModal')" class="p-2 -m-2 rounded-2xl text-gray-400 hover:text-gray-600 hover:bg-gray-200/50 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form id="editForm" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                <div class="space-y-4">
                    <div class="space-y-2">
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide">Username <span class="text-rose-500">*</span></label>
                        <input id="editUsername" name="username" required 
                            class="w-full h-12 px-4 py-3 rounded-2xl border-2 border-gray-200/70 bg-white/70 backdrop-blur-sm text-gray-900 placeholder-gray-500 focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100/50 focus:outline-none transition-all duration-200 shadow-lg hover:shadow-xl hover:border-gray-300/80 font-medium text-base">
                    </div>
                    <div class="space-y-2">
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide">Password</label>
                        <input type="password" name="password" placeholder="Kosongkan jika tidak diubah"
                            class="w-full h-12 px-4 py-3 rounded-2xl border-2 border-gray-200/70 bg-white/70 backdrop-blur-sm text-gray-900 placeholder-gray-500 focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100/50 focus:outline-none transition-all duration-200 shadow-lg hover:shadow-xl hover:border-gray-300/80 font-medium text-base">
                    </div>
                    <div class="space-y-2">
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide">Role <span class="text-rose-500">*</span></label>
                        <select id="editRole" name="role" required class="w-full h-12 px-4 py-3 rounded-2xl border-2 border-gray-200/70 bg-white/70 backdrop-blur-sm text-gray-900 focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100/50 focus:outline-none transition-all duration-200 shadow-lg hover:shadow-xl hover:border-gray-300/80 font-medium text-base appearance-none bg-no-repeat bg-right pr-10">
                            <option value="staff">Staff</option>
                            <option value="admin">Administrator</option>
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide">Status <span class="text-rose-500">*</span></label>
                        <select id="editStatus" name="status" required class="w-full h-12 px-4 py-3 rounded-2xl border-2 border-gray-200/70 bg-white/70 backdrop-blur-sm text-gray-900 focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100/50 focus:outline-none transition-all duration-200 shadow-lg hover:shadow-xl hover:border-gray-300/80 font-medium text-base appearance-none bg-no-repeat bg-right pr-10">
                            <option value="aktif">Aktif</option>
                            <option value="nonaktif">Nonaktif</option>
                        </select>
                    </div>
                </div>

                <div class="pt-6 border-t border-gray-200/50 flex flex-col sm:flex-row sm:justify-end gap-3">
                    <button type="button" onclick="closeModal('editModal')" 
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
                        class="group relative inline-flex h-12 px-8 items-center justify-center rounded-2xl font-semibold text-sm shadow-lg hover:shadow-xl focus:outline-none transition-all duration-300 min-w-[140px] overflow-hidden bg-gradient-to-r from-emerald-500/90 to-teal-600/90 backdrop-blur-md border-2 border-emerald-400/50 hover:border-emerald-500/70 hover:scale-105 hover:from-emerald-600/95 hover:to-teal-700/95 active:scale-95 flex-1 sm:flex-none">
                        <div class="absolute inset-0 bg-gradient-to-r from-emerald-400/30 to-teal-500/40 opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
                        <div class="absolute inset-0 bg-gradient-to-r from-white/20 to-transparent opacity-75 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative flex items-center gap-2 text-white font-bold">
                            <svg class="w-4 h-4 flex-shrink-0 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Update
                        </div>
                    </button>
                </div>
            </form>
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
                    <p class="text-gray-600 text-sm font-semibold tracking-wide">Data pengguna akan dihapus permanen</p>
                </div>
                <button onclick="closeModal('deleteModal')" class="p-2 -m-2 rounded-2xl text-gray-400 hover:text-gray-600 hover:bg-gray-200/50 transition-all">
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
                </div>
                
                <p class="text-sm text-gray-700 font-semibold leading-relaxed px-4">
                    Aksi ini akan menghapus data secara permanen dari sistem.
                </p>
            </div>

            <form id="deleteForm" method="POST" class="flex flex-col sm:flex-row sm:justify-end gap-3 pt-6 border-t border-gray-200/50">
                @csrf
                @method('DELETE')
                
                <button type="button" onclick="closeModal('deleteModal')" 
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

    select {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 1rem center;
        background-repeat: no-repeat;
        background-size: 1.25em 1.25em;
        cursor: pointer;
    }
</style>

<script>
let currentDeleteId = '';
let currentDeleteUrl = '';

function openModal(id) {
    const modal = document.getElementById(id);
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
    if (id === 'deleteModal') {
        document.getElementById('deleteName').focus();
    }
}

function closeModal(id) {
    const modal = document.getElementById(id);
    modal.classList.add('hidden');
    document.body.style.overflow = 'auto';
}

function editUser(id, username, role, status) {
    // set action form
    document.getElementById('editForm').action = `{{ url('users/update') }}/${id}`;

    // isi input dari database
    document.getElementById('editUsername').value = username;
    document.getElementById('editRole').value = role;
    document.getElementById('editStatus').value = status;

    // buka modal
    openModal('editModal');
}

function confirmDelete(id, username) {
    currentDeleteId = id;
    document.getElementById('deleteForm').action = `{{ url('users/delete') }}/${id}`;
    document.getElementById('deleteName').textContent = username;
    openModal('deleteModal');
}

// Close modal on outside click
document.addEventListener('click', function(e) {
    const modals = ['addModal', 'editModal', 'deleteModal'];
    modals.forEach(function(modalId) {
        const modal = document.getElementById(modalId);
        if (modal && !modal.classList.contains('hidden')) {
            const content = modal.querySelector('.glass');
            if (content && !content.contains(e.target)) {
                closeModal(modalId);
            }
        }
    });
});

// Close modal on ESC key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeModal('addModal');
        closeModal('editModal');
        closeModal('deleteModal');
    }
});

// Prevent form submission on Enter in modal content (except buttons)
document.addEventListener('keydown', function(e) {
    if (e.key === 'Enter' && !e.target.closest('button, input[type="submit"]')) {
        e.preventDefault();
    }
});

// Avatar preview
document.getElementById('avatarInput')?.addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('previewAvatar').src = e.target.result;
        }
        reader.readAsDataURL(file);
    }
});
</script>
@endsection