<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="icon" href="{{ asset('logo imi.png') }}" type="image/png">

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body { font-family: 'Inter', sans-serif; }

        .gradient-bg {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #334155 100%);
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.15);
        }

        .floating-animation {
            animation: float 6s ease-in-out infinite;
        }

        .glow {
            box-shadow: 0 0 80px rgba(99, 102, 241, 0.15);
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
    </style>
</head>

<body class="min-h-screen gradient-bg flex items-center justify-center relative overflow-hidden px-4">

<!-- BACKGROUND -->
<div class="absolute inset-0">

    <div class="absolute inset-0 bg-gradient-to-br from-blue-500/10 via-indigo-500/5 to-purple-500/10"></div>

    <!-- center glow -->
    <div class="absolute inset-0 flex items-center justify-center">
        <div class="w-[500px] h-[500px] bg-indigo-500/10 rounded-full blur-3xl"></div>
    </div>

    <!-- floating blobs -->
    <div class="absolute top-20 left-20 w-72 h-72 bg-blue-500/10 rounded-full blur-3xl floating-animation"></div>
    <div class="absolute top-1/2 right-20 w-96 h-96 bg-indigo-500/10 rounded-full blur-3xl" style="animation-delay: -2s;"></div>
    <div class="absolute bottom-20 left-1/2 w-80 h-80 bg-purple-500/10 rounded-full blur-3xl transform -translate-x-1/2" style="animation-delay: -4s;"></div>
</div>

<!-- CONTENT -->
<div class="relative z-10 w-full max-w-5xl mx-auto grid grid-cols-1 xl:grid-cols-2 items-center gap-16 py-12">

    <!-- LEFT -->
    <div class="hidden xl:flex flex-col justify-center text-white max-w-md">

        <div class="inline-flex items-center px-4 py-2 bg-white/10 rounded-full border border-white/20 mb-6">
            <i class="fas fa-globe-asia text-blue-400 mr-2"></i>
            <span class="text-sm uppercase tracking-wider">Sistem Monitoring WNA</span>
        </div>

        <h1 class="text-5xl font-bold leading-tight mb-6">
            Tracking <br>
            <span class="bg-gradient-to-r from-blue-400 via-indigo-400 to-purple-400 bg-clip-text text-transparent">
                WNA
            </span>
        </h1>

        <p class="text-gray-300 leading-relaxed">
            Platform terintegrasi untuk monitoring dan manajemen data Warga Negara Asing.
        </p>

        <!-- divider -->
        <div class="mt-6 w-16 h-1 bg-gradient-to-r from-blue-400 to-purple-500 rounded-full"></div>

    </div>

    <!-- LOGIN -->
    <div class="w-full max-w-sm mx-auto">
        <div class="glass-effect glow rounded-3xl p-8 shadow-2xl">

            <!-- HEADER -->
            <div class="text-center mb-8">

                <img src="{{ asset('images/logo-imi.png') }}" 
                    alt="Logo Imigrasi"
                    class="w-20 h-20 mx-auto mb-4 object-contain logo-animate drop-shadow-xl">

                <h2 class="text-2xl font-bold text-white mb-1">Selamat Datang</h2>
                <p class="text-gray-400 text-sm">Masuk ke sistem monitoring WNA</p>

            </div>

            @if(session('error'))
            <div class="bg-red-500/10 border border-red-500/30 text-red-200 p-3 rounded-xl mb-4">
                <i class="fas fa-exclamation-triangle mr-2"></i>
                {{ session('error') }}
            </div>
            @endif

            <form method="POST" action="/login" class="space-y-5">
                @csrf

                <!-- USERNAME -->
                <div>
                    <label class="block text-sm text-gray-200 mb-2">
                        <i class="fas fa-user text-blue-400 mr-1"></i>
                        Username
                    </label>

                    <input type="text" name="username" required
                        class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/20 text-white placeholder-gray-400 focus:border-blue-400 focus:ring-2 focus:ring-blue-400/30 transition"
                        placeholder="Masukkan username">
                </div>

                <!-- PASSWORD -->
                <div>
                    <label class="block text-sm text-gray-200 mb-2">
                        <i class="fas fa-lock text-blue-400 mr-1"></i>
                        Password
                    </label>

                    <input type="password" name="password" required
                        class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/20 text-white placeholder-gray-400 focus:border-blue-400 focus:ring-2 focus:ring-blue-400/30 transition"
                        placeholder="Masukkan password">
                </div>

                <!-- BUTTON -->
                <button type="submit"
                    class="w-full bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500 hover:opacity-90 text-white font-semibold py-3 rounded-xl transition transform hover:scale-[1.03] shadow-xl">
                    <i class="fas fa-sign-in-alt mr-2"></i>
                    LOGIN
                </button>
            </form>

            <!-- FOOTER -->
            <p class="text-center text-xs text-gray-500 mt-6">
                © {{ date('Y') }} Kantor Imigrasi Kelas II Non-TPI Ponorogo
            </p>

        </div>
    </div>

</div>

<!-- LOADING -->
<div id="loading" class="fixed inset-0 hidden items-center justify-center bg-black/60 z-50">
    <div class="text-center text-white">
        <div class="w-12 h-12 border-4 border-blue-400/30 border-t-blue-400 rounded-full animate-spin mx-auto mb-3"></div>
        <p class="text-sm">Memverifikasi...</p>
    </div>
</div>

<script>
    document.querySelector('form').addEventListener('submit', function() {
        document.getElementById('loading').classList.remove('hidden');
        document.getElementById('loading').classList.add('flex');
    });
</script>

</body>
</html>