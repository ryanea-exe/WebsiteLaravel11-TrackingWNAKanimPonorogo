@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="mb-8">
    <h1 class="text-2xl font-bold">Dashboard</h1>
    <p class="text-gray-400 text-sm">Ringkasan data WNA wilayah</p>
</div>

<!-- CARDS -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

    <!-- TRENGGALEK -->
    <div class="glass rounded-2xl p-6 shadow-lg">
        <h2 class="text-gray-300 text-sm mb-2">Trenggalek</h2>
        <p class="text-3xl font-bold text-blue-400">
            {{ $trenggalek ?? 0 }}
        </p>
        <p class="text-xs text-gray-500 mt-2">Total WNA</p>
    </div>

    <!-- PONOROGO -->
    <div class="glass rounded-2xl p-6 shadow-lg">
        <h2 class="text-gray-300 text-sm mb-2">Ponorogo</h2>
        <p class="text-3xl font-bold text-indigo-400">
            {{ $ponorogo ?? 0 }}
        </p>
        <p class="text-xs text-gray-500 mt-2">Total WNA</p>
    </div>

    <!-- PACITAN -->
    <div class="glass rounded-2xl p-6 shadow-lg">
        <h2 class="text-gray-300 text-sm mb-2">Pacitan</h2>
        <p class="text-3xl font-bold text-purple-400">
            {{ $pacitan ?? 0 }}
        </p>
        <p class="text-xs text-gray-500 mt-2">Total WNA</p>
    </div>

</div>

@endsection