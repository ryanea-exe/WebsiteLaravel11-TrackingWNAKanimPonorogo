@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <!-- HEADER -->
    <div class="space-y-2">
        <h1 class="text-2xl md:text-3xl font-bold text-gray-900 drop-shadow-sm">
            Dashboard
        </h1>
        <p class="text-gray-600 text-base max-w-xl leading-relaxed">
            Ringkasan Data WNA Ponorogo, Trenggalek, dan Pacitan
        </p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        <a href="{{ route('wna.index') }}" 
           class="group relative glass rounded-2xl p-8 shadow-xl border border-gray-200 transition-all duration-300 hover:scale-105 hover:shadow-2xl overflow-hidden flex items-center justify-center">
            <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/10 to-teal-600/20 rounded-2xl opacity-0 group-hover:opacity-100 transition-all duration-500"></div>
            <div class="relative z-10 text-center space-y-6 w-full">
                <div class="flex items-center justify-center">
                    <div class="p-4 rounded-2xl bg-emerald-500/10 border border-emerald-500/30">
                        <svg class="w-10 h-10 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="space-y-3">
                    <h2 class="text-xl md:text-2xl font-black text-gray-900 drop-shadow-lg">Total WNA</h2>
                    <p class="text-5xl md:text-6xl font-black bg-gradient-to-r from-emerald-500 via-emerald-600 to-teal-500 bg-clip-text text-transparent drop-shadow-2xl leading-none">
                        {{ number_format($total_wna ?? 0) }}
                    </p>
                </div>
                <p class="text-lg text-gray-600 font-semibold tracking-wide uppercase flex items-center justify-center gap-2 group-hover:gap-3 transition-all duration-200">
                    Lihat Semua 
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </p>
            </div>
        </a>

        <div class="glass rounded-2xl p-6 shadow-xl border border-gray-200 transition-all duration-300 hover:shadow-2xl overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-400/5 via-indigo-500/5 to-purple-500/10 rounded-2xl opacity-0 hover:opacity-100 transition-all duration-500 pointer-events-none"></div>
            <div class="relative z-10">
                <h2 class="text-lg font-bold text-gray-900 mb-6">Status Izin Tinggal</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div class="group relative p-4 rounded-2xl backdrop-blur-sm border border-gray-200 hover:border-blue-400/50 transition-all duration-200 hover:shadow-xl">
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-500/10 to-blue-600/20 rounded-2xl opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
                        <div class="relative z-10 space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-base font-bold text-gray-700">VOA</span>
                                <div class="w-3 h-3 rounded-full bg-blue-500"></div>
                            </div>
                            <p class="text-3xl font-black text-blue-600 drop-shadow-lg">{{ number_format($voa ?? 0) }}</p>
                        </div>
                    </div>
                    
                    <div class="group relative p-4 rounded-2xl backdrop-blur-sm border border-gray-200 hover:border-indigo-400/50 transition-all duration-200 hover:shadow-xl">
                        <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/10 to-indigo-600/20 rounded-2xl opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
                        <div class="relative z-10 space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-base font-bold text-gray-700">ITAS</span>
                                <div class="w-3 h-3 rounded-full bg-indigo-500"></div>
                            </div>
                            <p class="text-3xl font-black text-indigo-600 drop-shadow-lg">{{ number_format($itas ?? 0) }}</p>
                        </div>
                    </div>
                    
                    <div class="group relative p-4 rounded-2xl backdrop-blur-sm border border-gray-200 hover:border-purple-400/50 transition-all duration-200 hover:shadow-xl">
                        <div class="absolute inset-0 bg-gradient-to-br from-purple-500/10 to-purple-600/20 rounded-2xl opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
                        <div class="relative z-10 space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-base font-bold text-gray-700">ITAP</span>
                                <div class="w-3 h-3 rounded-full bg-purple-500"></div>
                            </div>
                            <p class="text-3xl font-black text-purple-600 drop-shadow-lg">{{ number_format($itap ?? 0) }}</p>
                        </div>
                    </div>
                    
                    <div class="group relative p-4 rounded-2xl backdrop-blur-sm border border-gray-200 hover:border-pink-400/50 transition-all duration-200 hover:shadow-xl">
                        <div class="absolute inset-0 bg-gradient-to-br from-pink-500/10 to-pink-600/20 rounded-2xl opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
                        <div class="relative z-10 space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-base font-bold text-gray-700">ITK</span>
                                <div class="w-3 h-3 rounded-full bg-pink-500"></div>
                            </div>
                            <p class="text-3xl font-black text-pink-600 drop-shadow-lg">{{ number_format($itk ?? 0) }}</p>
                        </div>
                    </div>

                    <div class="group relative p-4 rounded-2xl backdrop-blur-sm border border-gray-200 hover:border-orange-400/50 transition-all duration-200 hover:shadow-xl col-span-2">
                        <div class="absolute inset-0 bg-gradient-to-br from-orange-500/10 to-orange-600/20 rounded-2xl opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
                        <div class="relative z-10 space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-base font-bold text-gray-700">AFFIDAVIT</span>
                                <div class="w-3 h-3 rounded-full bg-orange-500"></div>
                            </div>
                            <p class="text-3xl font-black text-orange-600 drop-shadow-lg">{{ number_format($affidavit ?? 0) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CHARTS SECTION - Grid 2 kolom -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Chart Sebaran WNA Wilayah (setengah halaman) -->
        <div class="glass rounded-2xl p-6 shadow-xl border border-gray-200 transition-all duration-300 hover:shadow-2xl overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-400/5 via-indigo-500/5 to-purple-500/10 rounded-2xl opacity-0 hover:opacity-100 transition-all duration-500 pointer-events-none"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="text-lg font-bold text-gray-900 mb-1">Sebaran WNA per Wilayah</h2>
                        <p class="text-gray-600 text-sm font-semibold tracking-wide">Ponorogo, Trenggalek, dan Pacitan</p>
                    </div>
                    <div class="w-4 h-4 rounded-full bg-gradient-to-r from-blue-500 to-purple-500 animate-pulse shrink-0"></div>
                </div>
                <div class="h-72 relative">
                    <canvas id="chartWilayah"></canvas>
                </div>
            </div>
        </div>

       <!-- Chart Status Pengurusan Paspor (setengah halaman) -->
    <div class="glass rounded-2xl p-6 shadow-xl border border-gray-200 transition-all duration-300 hover:shadow-2xl overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-orange-400/5 via-amber-500/5 to-red-500/10 rounded-2xl opacity-0 hover:opacity-100 transition-all duration-500 pointer-events-none"></div>
        <div class="relative z-10">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-lg font-bold text-gray-900 mb-1">Status Kepengurusan Izin Tinggal</h2>
                    <p class="text-gray-600 text-sm font-semibold tracking-wide">Persentase pengurusan izin tinggal</p>
                </div>
                <div class="w-4 h-4 rounded-full bg-gradient-to-r from-orange-500 to-red-500 animate-pulse shrink-0"></div>
            </div>
            <div class="h-72 relative flex items-center justify-center">
                <canvas id="chartPaspor"></canvas>
            </div>
            <!-- Legend Tambahan -->
            <div class="mt-6 pt-6 border-t border-gray-200/50">
                <div class="flex items-center justify-center gap-8">
                    <div class="flex items-center gap-3">
                        <div class="w-4 h-4 rounded-full bg-gradient-to-r from-emerald-400 to-emerald-600 shadow-sm"></div>
                        <span class="text-sm font-semibold text-gray-700">Perpanjangan</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-4 h-4 rounded-full bg-gradient-to-r from-gray-400 to-dark-500 shadow-sm"></div>
                        <span class="text-sm font-semibold text-gray-700">Belum Perpanjangan</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        <a href="{{ route('wna.wilayah', 'trenggalek') }}" 
           class="group relative glass rounded-2xl p-6 shadow-xl border border-gray-200 transition-all duration-300 hover:scale-105 hover:shadow-2xl overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-500/10 to-cyan-600/20 rounded-2xl opacity-0 group-hover:opacity-100 transition-all duration-500"></div>
            <div class="relative z-10 space-y-4">
                <div class="flex items-center gap-3">
                    <div class="p-3 rounded-2xl bg-blue-500/10 border border-blue-500/30">
                        <svg class="w-7 h-7 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg text-gray-900">Trenggalek</h3>
                        <p class="text-gray-500 text-xs font-medium">Kabupaten</p>
                    </div>
                </div>
                <div class="text-4xl md:text-5xl font-black bg-gradient-to-r from-blue-500 via-blue-600 to-cyan-500 bg-clip-text text-transparent drop-shadow-xl">
                    {{ number_format($trenggalek ?? 0) }}
                </div>
                <p class="text-base text-gray-600 font-semibold uppercase tracking-wide flex items-center gap-2 group-hover:gap-3 transition-all duration-200">
                    Lihat Detail 
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </p>
            </div>
        </a>

        <a href="{{ route('wna.wilayah', 'ponorogo') }}" 
           class="group relative glass rounded-2xl p-6 shadow-xl border border-gray-200 transition-all duration-300 hover:scale-105 hover:shadow-2xl overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/10 to-purple-600/20 rounded-2xl opacity-0 group-hover:opacity-100 transition-all duration-500"></div>
            <div class="relative z-10 space-y-4">
                <div class="flex items-center gap-3">
                    <div class="p-3 rounded-2xl bg-indigo-500/10 border border-indigo-500/30">
                        <svg class="w-7 h-7 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg text-gray-900">Ponorogo</h3>
                        <p class="text-gray-500 text-xs font-medium">Kabupaten</p>
                    </div>
                </div>
                <div class="text-4xl md:text-5xl font-black bg-gradient-to-r from-indigo-500 via-indigo-600 to-purple-500 bg-clip-text text-transparent drop-shadow-xl">
                    {{ number_format($ponorogo ?? 0) }}
                </div>
                <p class="text-base text-gray-600 font-semibold uppercase tracking-wide flex items-center gap-2 group-hover:gap-3 transition-all duration-200">
                    Lihat Detail 
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </p>
            </div>
        </a>

        <a href="{{ route('wna.wilayah', 'pacitan') }}" 
           class="group relative glass rounded-2xl p-6 shadow-xl border border-gray-200 transition-all duration-300 hover:scale-105 hover:shadow-2xl overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-purple-500/10 to-pink-600/20 rounded-2xl opacity-0 group-hover:opacity-100 transition-all duration-500"></div>
            <div class="relative z-10 space-y-4">
                <div class="flex items-center gap-3">
                    <div class="p-3 rounded-2xl bg-purple-500/10 border border-purple-500/30">
                        <svg class="w-7 h-7 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg text-gray-900">Pacitan</h3>
                        <p class="text-gray-500 text-xs font-medium">Kabupaten</p>
                    </div>
                </div>
                <div class="text-4xl md:text-5xl font-black bg-gradient-to-r from-purple-500 via-purple-600 to-pink-500 bg-clip-text text-transparent drop-shadow-xl">
                    {{ number_format($pacitan ?? 0) }}
                </div>
                <p class="text-base text-gray-600 font-semibold uppercase tracking-wide flex items-center gap-2 group-hover:gap-3 transition-all duration-200">
                    Lihat Detail 
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </p>
            </div>
        </a>
    </div>

    <div class="glass rounded-2xl p-6 shadow-xl border border-gray-200 transition-all duration-300 hover:shadow-2xl overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-emerald-400/5 via-teal-500/5 to-blue-500/10 rounded-2xl opacity-0 hover:opacity-100 transition-all duration-500 pointer-events-none"></div>
        <div class="relative z-10">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-lg font-bold text-gray-900 mb-1">Jenis Kelamin</h2>
                    <p class="text-gray-600 text-sm font-semibold tracking-wide">Sebaran WNA berdasarkan jenis kelamin</p>
                </div>
                <div class="w-4 h-4 rounded-full bg-gradient-to-r from-emerald-500 to-teal-500 animate-pulse shrink-0"></div>
            </div>
            <div class="grid grid-cols-2 gap-6">
                <div class="group relative p-6 rounded-2xl text-center backdrop-blur-sm border border-gray-200 hover:border-emerald-400/50 transition-all duration-200 hover:shadow-xl">
                    <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/10 to-teal-600/20 rounded-2xl opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
                    <div class="relative z-10 space-y-3">
                        <div class="mx-auto w-12 h-12 rounded-2xl bg-emerald-500/10 border-2 border-emerald-500/30 flex items-center justify-center">
                            <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <circle cx="10" cy="14" r="4" stroke-width="2"></circle>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10l6-6M20 4h-5M20 4v5"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-3xl font-black text-emerald-600 drop-shadow-lg">{{ number_format($laki_laki ?? 0) }}</p>
                            <span class="text-sm font-semibold text-gray-700">Laki-laki</span>
                        </div>
                    </div>
                </div>
                <div class="group relative p-6 rounded-2xl text-center backdrop-blur-sm border border-gray-200 hover:border-pink-400/50 transition-all duration-200 hover:shadow-xl">
                    <div class="absolute inset-0 bg-gradient-to-br from-pink-500/10 to-rose-600/20 rounded-2xl opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
                    <div class="relative z-10 space-y-3">
                        <div class="mx-auto w-12 h-12 rounded-2xl bg-pink-500/10 border-2 border-pink-500/30 flex items-center justify-center">
                            <svg class="w-6 h-6 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <circle cx="12" cy="9" r="4" stroke-width="2"></circle>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 13v6"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17h6"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-3xl font-black text-pink-600 drop-shadow-lg">{{ number_format($perempuan ?? 0) }}</p>
                            <span class="text-sm font-semibold text-gray-700">Perempuan</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <div class="glass rounded-2xl p-6 shadow-xl border border-gray-200 transition-all duration-300 hover:shadow-2xl overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-rose-400/5 via-indigo-500/5 to-purple-500/10 rounded-2xl opacity-0 hover:opacity-100 transition-all duration-500 pointer-events-none"></div>
        <div class="relative z-10">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-lg font-bold text-gray-900 mb-1">Tujuan WNA</h2>
                    <p class="text-gray-600 text-sm font-semibold tracking-wide" id="tujuanCount">Sebaran WNA berdasarkan tujuan</p>
                </div>
                <button id="showAllBtn" class="text-sm font-semibold text-indigo-600 hover:text-indigo-700 flex items-center gap-1 transition-colors">
                    <span class="hidden sm:inline">Lihat Semua</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path>
                    </svg>
                </button>
            </div>
            <div id="tujuanContainer" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-4">
            
            </div>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Chart Sebaran Wilayah
    const canvasWilayah = document.getElementById('chartWilayah');
    if (canvasWilayah) {
        const ctx1 = canvasWilayah.getContext('2d');
        
        const gradient1 = ctx1.createLinearGradient(0, 0, 0, 400);
        gradient1.addColorStop(0, 'rgba(59, 130, 246, 0.8)');
        gradient1.addColorStop(0.5, 'rgba(59, 130, 246, 0.6)');
        gradient1.addColorStop(1, 'rgba(59, 130, 246, 0.3)');

        const gradient2 = ctx1.createLinearGradient(0, 0, 0, 400);
        gradient2.addColorStop(0, 'rgba(147, 51, 234, 0.8)');
        gradient2.addColorStop(0.5, 'rgba(147, 51, 234, 0.6)');
        gradient2.addColorStop(1, 'rgba(147, 51, 234, 0.3)');

        const gradient3 = ctx1.createLinearGradient(0, 0, 0, 400);
        gradient3.addColorStop(0, 'rgba(34, 197, 94, 0.8)');
        gradient3.addColorStop(0.5, 'rgba(34, 197, 94, 0.6)');
        gradient3.addColorStop(1, 'rgba(34, 197, 94, 0.3)');

        const dataWilayah = [
            {{ $trenggalek ?? 0 }},
            {{ $ponorogo ?? 0 }},
            {{ $pacitan ?? 0 }}
        ];

        const maxDataWilayah = Math.max(...dataWilayah, 1);
        const maxYWilayah = Math.ceil(maxDataWilayah / 10) * 10; 

        new Chart(ctx1, {
            type: 'bar', 
            data: {
                labels: ['Trenggalek', 'Ponorogo', 'Pacitan'],
                datasets: [{
                    label: 'Jumlah WNA',
                    data: dataWilayah,
                    backgroundColor: [gradient1, gradient2, gradient3],
                    borderColor: [
                        'rgba(59, 130, 246, 1)',
                        'rgba(147, 51, 234, 1)', 
                        'rgba(34, 197, 94, 1)'
                    ],
                    borderWidth: 2,
                    borderRadius: 12,
                    borderSkipped: false,
                    barThickness: 50,
                    maxBarThickness: 60
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        labels: {
                            color: '#64748b',
                            font: { size: 14, weight: '600' },
                            padding: 20
                        }
                    }
                },
                scales: {
                    x: {
                        ticks: { 
                            color: '#475569',
                            font: { size: 13, weight: '600' },
                            maxRotation: 0
                        },
                        grid: { display: false }
                    },
                    y: {
                        beginAtZero: true,
                        min: 0,
                        max: maxYWilayah,
                        ticks: { 
                            stepSize: Math.ceil(maxYWilayah / 5),
                            precision: 0,
                            color: '#94a3b8',
                            font: { size: 12, weight: '500' },
                            callback: function(value) {
                                return new Intl.NumberFormat('id-ID').format(Math.round(value));
                            }
                        },
                        grid: { 
                            color: 'rgba(148, 163, 184, 0.1)',
                            drawBorder: false 
                        }
                    }
                },
                interaction: { intersect: false, mode: 'index' },
                animation: {
                    duration: 2000,
                    easing: 'easeOutBounce', 
                    delay: 500
                }
            }
        });
    }

    const canvasPaspor = document.getElementById('chartPaspor');

    if (canvasPaspor) {
        const ctx2 = canvasPaspor.getContext('2d');

        const dataPaspor = [
            {{ $status_pengurusan['perpanjangan'] ?? 0 }},
            {{ $status_pengurusan['belum_perpanjangan'] ?? 0 }}
        ];

        const totalPaspor = dataPaspor.reduce((a, b) => a + b, 0);

        new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: [
                    'Perpanjangan',
                    'Belum Perpanjangan'
                ],
                datasets: [{
                    data: dataPaspor,
                    backgroundColor: [
                        '#22c55e',
                        '#9ca3af'
                    ],
                    borderWidth: 0,
                    radius: '75%'
                }]
            },

            plugins: [ChartDataLabels],

            options: {
                responsive: true,
                maintainAspectRatio: false,

                layout: {
                    padding: {
                        top: 20,
                        bottom: 40,
                        left: 40,
                        right: 40
                    }
                },

                plugins: {
                    // Matikan legend bawaan
                    legend: {
                        display: false
                    },

                    datalabels: {
                        color: '#374151',

                        // posisi label di luar chart
                        anchor: 'end',
                        align: 'end',
                        offset: 20,

                        formatter: (value, context) => {
                            const percentage = totalPaspor > 0
                                ? ((value / totalPaspor) * 100).toFixed(1)
                                : 0;

                            return percentage + '%';
                        },

                        font: {
                            weight: 'bold',
                            size: 14
                        }
                    }
                },

                animation: {
                    animateRotate: true,
                    duration: 2000
                }
            }
        });
    }

    // AUTO GENERATE TUJUAN BOX (17+ DATA)
    const tujuanData = @json($tujuan_data ?? []);
    const container = document.getElementById('tujuanContainer');
    const countEl = document.getElementById('tujuanCount');
    const showAllBtn = document.getElementById('showAllBtn');
    
    if (tujuanData.length > 0 && container) {
        countEl.textContent = `${tujuanData.length} Total jenis tujuan`;
        
        const colors = [
            'rose', 'emerald', 'blue', 'purple', 'orange',
            'indigo', 'cyan', 'pink', 'yellow', 'lime',
            'teal', 'fuchsia', 'sky', 'violet', 'amber',
            'green', 'slate'
        ];
        
        let allBoxes = [];
        let showAll = false;
        const MAX_VISIBLE = 8; // Tampilkan 8 pertama
        
        // Generate SEMUA box
        tujuanData.forEach((tujuan, index) => {
            const color = colors[index % colors.length];
            
            const box = document.createElement('div');
            box.className = `group relative h-[150px] flex items-center justify-center p-5 rounded-2xl backdrop-blur-sm border border-gray-200 hover:border-${color}-400/50 transition-all duration-300 hover:shadow-2xl hover:scale-[1.02] opacity-100`;
            box.dataset.index = index;
            
            box.innerHTML = `
                <div class="absolute inset-0 bg-gradient-to-br from-${color}-500/10 via-${color}-400/10 to-${color}-600/20 rounded-2xl opacity-0 group-hover:opacity-100 transition-all duration-500"></div>

                <div class="relative z-10 w-full h-full flex flex-col justify-between">
                    
                    <div class="flex items-start justify-between gap-3">
                        <span class="text-xs font-extrabold text-gray-700 uppercase tracking-wide leading-5 line-clamp-2">
                            ${tujuan.nama}
                        </span>

                        <span class="w-2.5 h-2.5 rounded-full bg-${color}-500 shrink-0 mt-1"></span>
                    </div>

                    <div class="text-center space-y-1">
                        <p class="text-4xl font-black text-${color}-600 leading-none drop-shadow-xl">
                            ${tujuan.jumlah.toLocaleString()}
                        </p>

                        <div class="inline-flex items-center justify-center px-2.5 py-1 rounded-full bg-${color}-50 text-${color}-500 text-xs font-bold">
                            ${tujuan.persen}%
                        </div>
                    </div>
                </div>
            `;
            
            allBoxes.push(box);
            container.appendChild(box);
        });
        
        // Sembunyikan yang lebih dari MAX_VISIBLE
        allBoxes.slice(MAX_VISIBLE).forEach((box, i) => {
            box.style.opacity = '0';
            box.style.height = '0px';
            box.style.overflow = 'hidden';
            box.style.margin = '0';
        });
        
        // Show All Button
        if (showAllBtn && tujuanData.length > MAX_VISIBLE) {
            showAllBtn.style.display = 'flex';
            showAllBtn.onclick = function() {
                showAll = !showAll;
                
                if (showAll) {
                    // Show ALL
                    allBoxes.forEach((box, i) => {
                        box.style.opacity = '1';
                        box.style.height = 'auto';
                        box.style.margin = '';
                        box.style.transform = 'scale(1)';
                    });
                    showAllBtn.innerHTML = `
                        <span class="hidden sm:inline">Kecilkan</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    `;
                    showAllBtn.classList.add('text-emerald-600', 'hover:text-emerald-700');
                } else {
                    // Show TOP 8
                    allBoxes.slice(0, MAX_VISIBLE).forEach((box, i) => {
                        box.style.opacity = '1';
                        box.style.height = 'auto';
                        box.style.margin = '';
                    });
                    allBoxes.slice(MAX_VISIBLE).forEach((box, i) => {
                        box.style.opacity = '0';
                        box.style.height = '0px';
                        box.style.overflow = 'hidden';
                        box.style.margin = '0';
                    });
                    showAllBtn.innerHTML = `
                        <span class="hidden sm:inline">Lihat Semua</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path>
                        </svg>
                    `;
                    showAllBtn.classList.remove('text-emerald-600', 'hover:text-emerald-700');
                }
            };
        }
    }
});
</script>
@endsection