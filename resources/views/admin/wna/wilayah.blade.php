@extends('layouts.app')

@section('title', 'Data Kabupaten ' . ucfirst($wilayah))

@section('content')
<div class="space-y-6">

    <div class="space-y-2">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900 drop-shadow-sm">
                    Data WNA {{ ucfirst($wilayah) }}
                </h1>
                <p class="text-gray-600 text-base max-w-xl leading-relaxed">
                    Statistik lengkap {{ ucfirst($wilayah) }} - {{ number_format($total ?? 0) }} WNA terdaftar
                </p>
            </div>
        </div>
    </div>

    <div class="glass rounded-2xl p-6 shadow-xl border border-gray-200 transition-all duration-300 hover:shadow-2xl overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-r from-emerald-400/5 via-teal-500/5 to-blue-500/10 rounded-2xl opacity-0 hover:opacity-100 transition-all duration-500 pointer-events-none"></div>

    <div class="relative z-10">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-xl font-bold text-gray-900 mb-1">
                    Diagram Jenis Izin Tinggal
                </h2>
                <p class="text-gray-600 text-sm font-semibold tracking-wide">
                    Statistik izin tinggal WNA {{ ucfirst($wilayah) }}
                </p>
            </div>

            <div class="w-5 h-5 rounded-full bg-gradient-to-r from-emerald-500 to-teal-500 animate-pulse shrink-0"></div>
        </div>

        <div class="h-80 relative">
            <canvas id="chartIzinTinggal"></canvas>
        </div>
    </div>
</div>

    <div class="glass rounded-2xl p-6 shadow-xl border border-gray-200 transition-all duration-300 hover:shadow-2xl overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-emerald-400/5 via-teal-500/5 to-blue-500/10 rounded-2xl opacity-0 hover:opacity-100 transition-all duration-500 pointer-events-none"></div>
        <div class="relative z-10">
            <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-200/50">
                <div>
                    <h2 class="text-xl font-bold text-gray-900 mb-1">Status Izin Tinggal</h2>
                    <p class="text-gray-600 text-sm font-semibold tracking-wide">{{ ucfirst($wilayah) }}</p>
                </div>
                <div class="w-5 h-5 rounded-full bg-gradient-to-r from-emerald-500 to-teal-500 animate-pulse shrink-0"></div>
            </div>
            
            <div class="grid grid-cols-2 lg:grid-cols-5 gap-4">
            
                <a href="{{ route('wna.kabupaten', [$wilayah, 'voa']) }}" 
                   class="group relative p-4 rounded-2xl backdrop-blur-sm border-2 border-gray-200 hover:border-blue-400/70 focus:border-blue-400/70 focus:outline-none focus:ring-4 focus:ring-blue-500/20 transition-all duration-300 hover:shadow-2xl hover:scale-[1.02] hover:-translate-y-1 block">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-500/10 to-blue-600/20 rounded-2xl opacity-0 group-hover:opacity-100 transition-all duration-400"></div>
                    <div class="relative z-10 space-y-3 text-center">
                        <div class="w-4 h-4 mx-auto rounded-full bg-blue-500 ring-2 ring-blue-500/30 group-hover:ring-blue-500/50 group-hover:scale-110 transition-all duration-300"></div>
                        <span class="text-sm font-bold text-gray-700 block group-hover:text-blue-700 transition-colors">VOA</span>
                        <p class="text-2xl lg:text-3xl font-black text-blue-600 drop-shadow-lg group-hover:text-blue-700 group-hover:drop-shadow-2xl transition-all duration-300">{{ number_format($data['voa'] ?? 0) }}</p>
                        <div class="absolute -bottom-2 left-1/2 -translate-x-1/2 w-2 h-2 bg-blue-500 rounded-full opacity-0 group-hover:opacity-100 group-hover:scale-110 transition-all duration-300"></div>
                    </div>
                </a>

                <a href="{{ route('wna.kabupaten', [$wilayah, 'itas']) }}" 
                   class="group relative p-4 rounded-2xl backdrop-blur-sm border-2 border-gray-200 hover:border-emerald-400/70 focus:border-emerald-400/70 focus:outline-none focus:ring-4 focus:ring-emerald-500/20 transition-all duration-300 hover:shadow-2xl hover:scale-[1.02] hover:-translate-y-1 block">
                    <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/10 to-teal-600/20 rounded-2xl opacity-0 group-hover:opacity-100 transition-all duration-400"></div>
                    <div class="relative z-10 space-y-3 text-center">
                        <div class="w-4 h-4 mx-auto rounded-full bg-emerald-500 ring-2 ring-emerald-500/30 group-hover:ring-emerald-500/50 group-hover:scale-110 transition-all duration-300"></div>
                        <span class="text-sm font-bold text-gray-700 block group-hover:text-emerald-700 transition-colors">ITAS</span>
                        <p class="text-2xl lg:text-3xl font-black text-emerald-600 drop-shadow-lg group-hover:text-emerald-700 group-hover:drop-shadow-2xl transition-all duration-300">{{ number_format($data['itas'] ?? 0) }}</p>
                        <div class="absolute -bottom-2 left-1/2 -translate-x-1/2 w-2 h-2 bg-emerald-500 rounded-full opacity-0 group-hover:opacity-100 group-hover:scale-110 transition-all duration-300"></div>
                    </div>
                </a>

                <a href="{{ route('wna.kabupaten', [$wilayah, 'itap']) }}" 
                   class="group relative p-4 rounded-2xl backdrop-blur-sm border-2 border-gray-200 hover:border-purple-400/70 focus:border-purple-400/70 focus:outline-none focus:ring-4 focus:ring-purple-500/20 transition-all duration-300 hover:shadow-2xl hover:scale-[1.02] hover:-translate-y-1 block">
                    <div class="absolute inset-0 bg-gradient-to-br from-purple-500/10 to-purple-600/20 rounded-2xl opacity-0 group-hover:opacity-100 transition-all duration-400"></div>
                    <div class="relative z-10 space-y-3 text-center">
                        <div class="w-4 h-4 mx-auto rounded-full bg-purple-500 ring-2 ring-purple-500/30 group-hover:ring-purple-500/50 group-hover:scale-110 transition-all duration-300"></div>
                        <span class="text-sm font-bold text-gray-700 block group-hover:text-purple-700 transition-colors">ITAP</span>
                        <p class="text-2xl lg:text-3xl font-black text-purple-600 drop-shadow-lg group-hover:text-purple-700 group-hover:drop-shadow-2xl transition-all duration-300">{{ number_format($data['itap'] ?? 0) }}</p>
                        <div class="absolute -bottom-2 left-1/2 -translate-x-1/2 w-2 h-2 bg-purple-500 rounded-full opacity-0 group-hover:opacity-100 group-hover:scale-110 transition-all duration-300"></div>
                    </div>
                </a>

                <a href="{{ route('wna.kabupaten', [$wilayah, 'itk']) }}" 
                   class="group relative p-4 rounded-2xl backdrop-blur-sm border-2 border-gray-200 hover:border-pink-400/70 focus:border-pink-400/70 focus:outline-none focus:ring-4 focus:ring-pink-500/20 transition-all duration-300 hover:shadow-2xl hover:scale-[1.02] hover:-translate-y-1 block">
                    <div class="absolute inset-0 bg-gradient-to-br from-pink-500/10 to-pink-600/20 rounded-2xl opacity-0 group-hover:opacity-100 transition-all duration-400"></div>
                    <div class="relative z-10 space-y-3 text-center">
                        <div class="w-4 h-4 mx-auto rounded-full bg-pink-500 ring-2 ring-pink-500/30 group-hover:ring-pink-500/50 group-hover:scale-110 transition-all duration-300"></div>
                        <span class="text-sm font-bold text-gray-700 block group-hover:text-pink-700 transition-colors">ITK</span>
                        <p class="text-2xl lg:text-3xl font-black text-pink-600 drop-shadow-lg group-hover:text-pink-700 group-hover:drop-shadow-2xl transition-all duration-300">{{ number_format($data['itk'] ?? 0) }}</p>
                        <div class="absolute -bottom-2 left-1/2 -translate-x-1/2 w-2 h-2 bg-pink-500 rounded-full opacity-0 group-hover:opacity-100 group-hover:scale-110 transition-all duration-300"></div>
                    </div>
                </a>

                <a href="{{ route('wna.kabupaten', [$wilayah, 'affidavit']) }}" 
                   class="group relative p-4 rounded-2xl backdrop-blur-sm border-2 border-gray-200 hover:border-orange-400/70 focus:border-orange-400/70 focus:outline-none focus:ring-4 focus:ring-orange-500/20 transition-all duration-300 hover:shadow-2xl hover:scale-[1.02] hover:-translate-y-1 block lg:col-span-1">
                    <div class="absolute inset-0 bg-gradient-to-br from-orange-500/10 to-orange-600/20 rounded-2xl opacity-0 group-hover:opacity-100 transition-all duration-400"></div>
                    <div class="relative z-10 space-y-3 text-center">
                        <div class="w-4 h-4 mx-auto rounded-full bg-orange-500 ring-2 ring-orange-500/30 group-hover:ring-orange-500/50 group-hover:scale-110 transition-all duration-300"></div>
                        <span class="text-sm font-bold text-gray-700 block group-hover:text-orange-700 transition-colors">AFFIDAVIT</span>
                        <p class="text-2xl lg:text-3xl font-black text-orange-600 drop-shadow-lg group-hover:text-orange-700 group-hover:drop-shadow-2xl transition-all duration-300">{{ number_format($data['affidavit'] ?? 0) }}</p>
                        <div class="absolute -bottom-2 left-1/2 -translate-x-1/2 w-2 h-2 bg-orange-500 rounded-full opacity-0 group-hover:opacity-100 group-hover:scale-110 transition-all duration-300"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="glass rounded-2xl p-6 shadow-xl border border-gray-200 transition-all duration-300 hover:shadow-2xl overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-pink-400/5 via-rose-500/5 to-emerald-500/10 rounded-2xl opacity-0 hover:opacity-100 transition-all duration-500 pointer-events-none"></div>
        <div class="relative z-10">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-xl font-bold text-gray-900 mb-1">Distribusi Jenis Kelamin</h2>
                    <p class="text-gray-600 text-sm font-semibold tracking-wide">{{ ucfirst($wilayah) }}</p>
                </div>
                <div class="w-5 h-5 rounded-full bg-gradient-to-r from-pink-500 to-emerald-500 animate-pulse shrink-0"></div>
            </div>
            <div class="grid grid-cols-2 gap-6">
                <div class="group relative p-6 rounded-2xl text-center backdrop-blur-sm border border-gray-200 hover:border-emerald-400/50 transition-all duration-200 hover:shadow-xl">
                    <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/10 to-teal-600/20 rounded-2xl opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
                    <div class="relative z-10 space-y-4">
                        <div class="mx-auto w-16 h-16 rounded-2xl bg-emerald-500/10 border-2 border-emerald-500/30 flex items-center justify-center">
                            <svg class="w-8 h-8 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <circle cx="10" cy="14" r="4" stroke-width="2"></circle>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10l6-6M20 4h-4M20 4v4"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-3xl font-black text-emerald-600 drop-shadow-lg">{{ number_format($laki) }}</p>
                            <span class="text-sm font-semibold text-gray-700">Laki-laki</span>
                        </div>
                    </div>
                </div>
                <div class="group relative p-6 rounded-2xl text-center backdrop-blur-sm border border-gray-200 hover:border-pink-400/50 transition-all duration-200 hover:shadow-xl">
                    <div class="absolute inset-0 bg-gradient-to-br from-pink-500/10 to-rose-600/20 rounded-2xl opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
                    <div class="relative z-10 space-y-4">
                        <div class="mx-auto w-16 h-16 rounded-2xl bg-pink-500/10 border-2 border-pink-500/30 flex items-center justify-center">
                            <svg class="w-8 h-8 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <circle cx="12" cy="8" r="4" stroke-width="2"></circle>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 12v6"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 16h6"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-3xl font-black text-pink-600 drop-shadow-lg">{{ number_format($perempuan) }}</p>
                            <span class="text-sm font-semibold text-gray-700">Perempuan</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <div class="glass rounded-2xl p-6 shadow-xl border border-gray-200 transition-all duration-300 hover:shadow-2xl overflow-hidden">
        
        <div class="absolute inset-0 bg-gradient-to-r from-indigo-400/5 via-purple-500/5 to-pink-500/10 rounded-2xl opacity-0 hover:opacity-100 transition-all duration-500 pointer-events-none"></div>

        <div class="relative z-10">

            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-xl font-bold text-gray-900 mb-1">
                        Rekap Tujuan WNA
                    </h2>

                    <p class="text-gray-600 text-sm font-semibold tracking-wide uppercase">
                        {{ count($tujuan_wna ?? []) }} tujuan unik di {{ $wilayah }}
                    </p>
                </div>

                <div class="w-5 h-5 rounded-full bg-gradient-to-r from-indigo-500 to-pink-500 animate-pulse shrink-0"></div>
            </div>

            <div id="tujuanContainer"
                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-4">

                @php
                    $colors = [
                        'blue',
                        'emerald',
                        'purple',
                        'pink',
                        'orange',
                        'indigo',
                        'cyan',
                        'rose',
                        'amber',
                        'teal',
                        'violet',
                        'lime'
                    ];
                @endphp

                @forelse($tujuan_wna as $index => $tujuan)

                    @php
                        $color = $colors[$index % count($colors)];
                    @endphp

                    <div class="group relative h-[150px] flex items-center justify-center p-5 rounded-2xl backdrop-blur-sm border border-gray-200 hover:border-{{ $color }}-400/50 transition-all duration-300 hover:shadow-2xl hover:scale-[1.02]">

                        <div class="absolute inset-0 bg-gradient-to-br from-{{ $color }}-500/10 via-{{ $color }}-400/10 to-{{ $color }}-600/20 rounded-2xl opacity-0 group-hover:opacity-100 transition-all duration-500"></div>

                        <div class="relative z-10 w-full h-full flex flex-col justify-between">

                            <div class="flex items-start justify-between gap-3">

                                <span class="text-xs font-extrabold text-gray-700 uppercase tracking-wide leading-5 line-clamp-2">
                                    {{ $tujuan['nama'] }}
                                </span>

                                <span class="w-2.5 h-2.5 rounded-full bg-{{ $color }}-500 shrink-0 mt-1"></span>
                            </div>

                            <div class="text-center space-y-1">

                                <p class="text-4xl font-black text-{{ $color }}-600 leading-none drop-shadow-xl">
                                    {{ number_format($tujuan['jumlah']) }}
                                </p>

                                <div class="inline-flex items-center justify-center px-2.5 py-1 rounded-full bg-{{ $color }}-50 text-{{ $color }}-500 text-xs font-bold">
                                    {{ $tujuan['persen'] }}%
                                </div>

                            </div>
                        </div>
                    </div>

                @empty

                    <div class="col-span-full text-center py-10">
                        <p class="text-gray-500 font-semibold">
                            Tidak ada data tujuan WNA
                        </p>
                    </div>

                @endforelse
            </div>
        </div>
    </div>

    <div class="pt-8 border-t border-gray-200">
        <a href="{{ route('wna.kabupaten', [$wilayah]) }}" 
        class="group relative glass rounded-2xl p-8 shadow-xl border border-gray-200 transition-all duration-300 hover:scale-105 hover:shadow-2xl overflow-hidden block">
            <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/10 to-teal-600/20 rounded-2xl opacity-0 group-hover:opacity-100 transition-all duration-500"></div>
            <div class="relative z-10 text-center space-y-6">
                <div class="flex items-center justify-center">
                    <div class="p-6 rounded-2xl bg-emerald-500/10 border border-emerald-500/30 shadow-xl group-hover:scale-110 transition-all duration-300">
                        <svg class="w-12 h-12 text-emerald-500 group-hover:animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="space-y-3">
                    <h2 class="text-2xl md:text-3xl font-black text-gray-900 drop-shadow-xl tracking-tight">Total WNA {{ ucfirst($wilayah) }}</h2>
                    <p class="text-5xl md:text-6xl lg:text-7xl font-black bg-gradient-to-r from-emerald-500 via-green-500 to-teal-500 bg-clip-text text-transparent drop-shadow-2xl leading-none group-hover:scale-[1.05] transition-transform duration-300">
                        {{ number_format($total ?? 0) }}
                    </p>
                </div>
                <p class="text-lg md:text-xl text-gray-600 font-semibold tracking-wide uppercase flex items-center justify-center gap-3 group-hover:gap-4 transition-all duration-200">
                    Lihat Daftar Lengkap 
                    <svg class="w-5 h-5 group-hover:translate-x-2 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </p>
            </div>
        </a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {

    // =========================
    // CHART IZIN TINGGAL
    // =========================
    const canvasIzin = document.getElementById('chartIzinTinggal');

    if (canvasIzin) {

        const ctxIzin = canvasIzin.getContext('2d');

        const dataIzin = [
            {{ $data['voa'] ?? 0 }},
            {{ $data['itas'] ?? 0 }},
            {{ $data['itap'] ?? 0 }},
            {{ $data['itk'] ?? 0 }},
            {{ $data['affidavit'] ?? 0 }}
        ];

        const maxData = Math.max(...dataIzin, 1);
        const maxY = Math.ceil(maxData / 10) * 10;

        new Chart(ctxIzin, {
            type: 'bar',

            data: {
                labels: [
                    'VOA',
                    'ITAS',
                    'ITAP',
                    'ITK',
                    'AFFIDAVIT'
                ],

                datasets: [{
                    label: 'Jumlah WNA',

                    data: dataIzin,

                    backgroundColor: [
                        'rgba(59, 130, 246, 0.8)',
                        'rgba(16, 185, 129, 0.8)',
                        'rgba(168, 85, 247, 0.8)',
                        'rgba(236, 72, 153, 0.8)',
                        'rgba(249, 115, 22, 0.8)'
                    ],

                    borderColor: [
                        'rgba(59, 130, 246, 1)',
                        'rgba(16, 185, 129, 1)',
                        'rgba(168, 85, 247, 1)',
                        'rgba(236, 72, 153, 1)',
                        'rgba(249, 115, 22, 1)'
                    ],

                    borderWidth: 2,
                    borderRadius: 14,
                    borderSkipped: false,
                    barThickness: 55,
                    hoverBorderWidth: 3
                }]
            },

            options: {
                responsive: true,
                maintainAspectRatio: false,

                plugins: {
                    legend: {
                        display: false
                    },

                    tooltip: {
                        backgroundColor: '#111827',
                        titleColor: '#ffffff',
                        bodyColor: '#ffffff',
                        padding: 12,
                        cornerRadius: 12
                    }
                },

                scales: {

                    x: {
                        ticks: {
                            color: '#374151',
                            font: {
                                size: 13,
                                weight: '600'
                            }
                        },

                        grid: {
                            display: false
                        }
                    },

                    y: {
                        beginAtZero: true,
                        min: 0,
                        max: maxY,

                        ticks: {
                            stepSize: Math.ceil(maxY / 5),

                            color: '#6b7280',

                            font: {
                                size: 12,
                                weight: '500'
                            },

                            callback: function(value) {
                                return new Intl.NumberFormat('id-ID').format(value);
                            }
                        },

                        grid: {
                            color: 'rgba(148, 163, 184, 0.08)',
                            drawBorder: false
                        }
                    }
                },

                animation: {
                    duration: 1800,
                    easing: 'easeOutQuart'
                }
            }
        });
    }
});
</script>

<style>
.glass {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
}
</style>
@endsection