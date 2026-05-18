<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <link rel="icon" href="{{ asset('logo-imi.png') }}" type="image/png">

    <!-- PWA -->
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <meta name="theme-color" content="#4f46e5">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="#4f46e5">

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body { 
            font-family: 'Inter', sans-serif; 
        }

        /* ========== DEFAULT WHITE THEME ========== */
        .gradient-bg {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 50%, #f1f5f9 100%);
        }

        .glass {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(0, 0, 0, 0.08);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        }

        .glass-hover:hover {
            background: rgba(99, 102, 241, 0.1);
            color: #6366f1;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.15);
        }

        /* CARD UNIVERSAL */
        .glass-card {
            background: rgba(255,255,255,0.8);
            color: #1e293b;
        }

        .text-adaptive {
            color: #475569;
        }

        .border-adaptive {
            border-color: rgba(0,0,0,0.1);
        }

        /* ========== SIDEBAR ========== */
        .sidebar {
            background: rgba(255, 255, 255, 0.95);
            border-right: 1px solid rgba(0, 0, 0, 0.08);
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.1);
        }

        .sidebar-title {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .sidebar a {
            color: #475569 !important;
        }

        .sidebar a:hover {
            background: rgba(99, 102, 241, 0.1) !important;
            color: #6366f1 !important;
        }

        /* ========== NAVBAR ========== */
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            border-bottom: 1px solid rgba(0, 0, 0, 0.08);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .navbar h2 {
            color: #0f172a !important;
        }

        /* ========== USER INFO ========== */
        .user-info p {
            color: #1e293b !important;
        }

        .user-role {
            color: #64748b !important;
        }

        .user-avatar {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        }

        /* ========== NOTIFICATION BADGE ========== */
        .notification-badge {
            background: #ef4444 !important;
            color: #ffffff !important;
            font-size: 11px !important;
            font-weight: 600;
            min-width: 20px;
            height: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 8px rgba(239, 68, 68, 0.4);
        }

        /* ========== ACTIVE SIDEBAR ========== */
        .sidebar-link-active {
            background: rgba(99, 102, 241, 0.2) !important;
            color: #6366f1 !important;
            font-weight: 600;
            box-shadow: inset 0 0 0 1px rgba(99, 102, 241, 0.3);
        }

        /* ========== DROPDOWN ========== */
        .dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            min-width: 280px;
            margin-top: 12px;
            padding: 12px;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(24px);
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 20px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px) scale(0.95);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 9999;
            max-height: 500px;
            overflow-y: auto;
            font-size: 14px;
        }

        .dropdown:hover .dropdown-menu,
        .dropdown[open] .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0) scale(1);
        }

        .dropdown-item {
            display: block;
            padding: 12px 16px;
            color: #374151;
            text-decoration: none;
            border-radius: 16px;
            margin: 4px 0;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .dropdown-item:hover {
            background: rgba(99, 102, 241, 0.1);
            color: #6366f1;
            transform: translateX(8px);
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.15);
        }

        .dropdown-item.logout {
            color: #ef4444;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
            margin-top: 12px;
            padding-top: 16px;
            font-weight: 600;
        }

        .dropdown-item.logout:hover {
            background: rgba(239, 68, 68, 0.1);
            color: #dc2626;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.2);
        }

        /* ========== NOTIFICATION ITEM ========== */
        .notification-item {
            transition: all 0.2s ease;
            border: 1px solid rgba(0, 0, 0, 0.08);
        }

        .notification-item:hover {
            transform: translateX(4px);
            border-color: rgba(99, 102, 241, 0.2);
        }

        /* ========== CUSTOM SCROLLBAR ========== */
        .dropdown-menu::-webkit-scrollbar {
            width: 6px;
        }

        .dropdown-menu::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.05);
            border-radius: 3px;
        }

        .dropdown-menu::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, 0.2);
            border-radius: 3px;
        }

        /* ========== FOOTER ========== */
        .footer {
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(12px);
            border-top: 1px solid rgba(0, 0, 0, 0.08);
            color: #64748b;
        }

        /* ========== BUTTONS ========== */
        .menu-btn {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .menu-btn:hover {
            transform: scale(1.1) rotate(90deg);
        }

        #sidebar {
            transition: transform 0.3s ease, opacity 0.3s ease;
        }

        @media (max-width: 768px) {
            #sidebar {
                position: fixed;
                top: 0;
                left: 0;
                height: 100vh;
                z-index: 9999;
            }
        }

        /* ========== NOTIFICATION COLORS ========== */
        .notif-create { background: rgba(34, 197, 94, 0.1) !important; border-color: rgba(34, 197, 94, 0.3) !important; }
        .notif-update { background: rgba(251, 191, 36, 0.1) !important; border-color: rgba(251, 191, 36, 0.3) !important; }
        .notif-delete { background: rgba(239, 68, 68, 0.1) !important; border-color: rgba(239, 68, 68, 0.3) !important; }
        .notif-unread { background: rgba(99, 102, 241, 0.05) !important; border-color: rgba(99, 102, 241, 0.2) !important; box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.15); }
    </style>
</head>

<body class="gradient-bg text-gray-900 min-h-screen">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <!-- SIDEBAR -->
    <aside id="sidebar" class="fixed top-0 left-0 h-screen w-64 glass p-6 hidden md:block transition-all duration-500 ease-in-out z-40 sidebar overflow-y-auto">
        <h1 class="text-2xl font-bold mb-10 sidebar-title">Sistem Monitoring WNA</h1>

        <nav class="space-y-2 text-sm">
            <a class="block px-4 py-3 rounded-xl sidebar-link transition-all duration-200 glass-hover
                {{ request()->routeIs('admin.dashboard') || request()->routeIs('user.dashboard') 
                    ? 'sidebar-link-active' 
                    : '' }}"
                href="{{ auth()->user()->role == 'admin' 
                    ? route('admin.dashboard') 
                    : route('user.dashboard') }}">
                <svg class="w-5 h-5 inline mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                Dashboard
            </a>

            <div class="space-y-1">
                @php
                    $wnaRoutes = [
                        'wna.wilayah',
                        'wna.byJenis',
                        'wna.byWilayah'
                    ];

                    $wnaActive = in_array(Route::currentRouteName(), $wnaRoutes);
                @endphp

                <button onclick="toggleDropdown('wnaMenu')" 
                    class="w-full text-left px-4 py-3 rounded-xl sidebar-link flex justify-between items-center transition-all duration-200 glass-hover
                    {{ $wnaActive ? 'sidebar-link-active' : '' }}">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 inline mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Kelola Data WNA
                    </div>
                    <span class="transition-transform duration-200 {{ $wnaActive ? 'rotate-180' : '' }}">▼</span>
                </button>

                <div id="wnaMenu" class="pl-8 space-y-1 {{ $wnaActive ? '' : 'hidden' }} transition-all duration-200">
                    <a href="{{ route('wna.wilayah', 'ponorogo') }}" 
                        class="block px-4 py-2 rounded-xl text-sm transition-all duration-200 glass-hover
                        {{ request()->route('wilayah') == 'ponorogo' ? 'sidebar-link-active' : '' }}">
                            Ponorogo
                    </a>

                    <a href="{{ route('wna.wilayah', 'trenggalek') }}" 
                        class="block px-4 py-2 rounded-xl text-sm transition-all duration-200 glass-hover
                        {{ request()->route('wilayah') == 'trenggalek' ? 'sidebar-link-active' : '' }}">
                            Trenggalek
                    </a>

                    <a href="{{ route('wna.wilayah', 'pacitan') }}" 
                        class="block px-4 py-2 rounded-xl text-sm transition-all duration-200 glass-hover
                        {{ request()->route('wilayah') == 'pacitan' ? 'sidebar-link-active' : '' }}">
                            Pacitan
                    </a>
                </div>
            </div>

            {{-- KHUSUS ADMIN --}}
            @if(auth()->user()->role == 'admin')
                <a href="{{ route('wna.create') }}" 
                    class="block px-4 py-3 rounded-xl sidebar-link transition-all duration-200 glass-hover
                    {{ request()->routeIs('wna.create') ? 'sidebar-link-active' : '' }}">
                    <svg class="w-5 h-5 inline mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Tambah Data WNA
                </a>
            @endif

                {{-- LAPORAN --}}
                <a href="{{ route('laporan.index') }}" 
                    class="block px-4 py-3 rounded-xl sidebar-link transition-all duration-200 glass-hover
                    {{ request()->routeIs('laporan.*') ? 'sidebar-link-active' : '' }}">
                    
                    <svg class="w-5 h-5 inline mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Laporan
                </a>


                {{-- KELOLA PENGGUNA --}}
            @if(auth()->user()->role == 'admin')
                <a href="{{ route('users.index') }}" 
                    class="block px-4 py-3 rounded-xl sidebar-link transition-all duration-200 glass-hover
                    {{ request()->routeIs('users.*') ? 'sidebar-link-active' : '' }}">
                    
                    <svg class="w-5 h-5 inline mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    Kelola Pengguna
                </a>
            @endif
        </nav>
    </aside>

    <!-- MAIN -->
    <div class="flex-1 flex flex-col md:ml-64">

        <!-- NAVBAR -->
        <header id="navbar" class="sticky top-0 md:left-64 glass flex items-center justify-between px-6 py-4 border-b border-gray-200 z-50 navbar">
            <!-- LEFT -->
            <div class="flex items-center gap-4">
                <!-- BUTTON MOBILE -->
                <button id="menuBtn" class="md:hidden text-gray-800 text-xl p-3 rounded-xl menu-btn glass-hover">
                    ☰
                </button>

                <h2 class="font-semibold text-xl">@yield('title')</h2>
            </div>

            <!-- RIGHT -->
            <div class="flex items-center gap-4">

                @php
                    $user = auth()->user();
                    $notifications = $user->recentNotifications()->get();
                    $unreadCount = $user->notifications()
                        ->wherePivot('is_read', false)
                        ->where('notifications.created_at', '>=', now()->subDay())
                        ->count();
                @endphp

                <!-- NOTIFICATION DROPDOWN -->
                <div class="relative dropdown">
                    <!-- ICON -->
                    <div class="relative cursor-pointer p-3 rounded-xl glass-hover transition-all duration-200">
                        <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>

                        @if($unreadCount > 0)
                            <span class="absolute -top-1 -right-1 notification-badge">
                                {{ $unreadCount > 99 ? '99+' : $unreadCount }}
                            </span>
                        @endif
                    </div>

                    <!-- DROPDOWN -->
                    <div class="dropdown-menu w-96">
                        <div class="text-sm font-semibold px-4 py-4 border-b border-gray-100 mb-4">
                            Notifikasi Terbaru
                        </div>

                        @forelse($notifications as $notif)
                            @php
                                $typeClass = match($notif->type) {
                                    'create' => 'notif-create',
                                    'update' => 'notif-update',
                                    'delete' => 'notif-delete',
                                    default => ''
                                };
                                $isUnread = !$notif->pivot->is_read;
                            @endphp

                            <button
                                onclick="markAsRead({{ $notif->id }}, this)"
                                class="notification-item block w-full text-left px-4 py-4 rounded-2xl text-sm mb-3 {{ $isUnread ? 'notif-unread' : $typeClass }} border transition-all duration-200">

                                <div class="flex items-start space-x-4">
                                    <div class="flex-shrink-0 pt-1">
                                        @if($notif->pivot->is_read)
                                            <div class="w-3 h-3 rounded-full bg-gray-300"></div>
                                        @else
                                            <div class="w-3 h-3 rounded-full bg-blue-500 animate-pulse ring-2 ring-blue-200/50"></div>
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="font-semibold text-gray-900 truncate">{{ $notif->title }}</p>
                                        <p class="text-sm text-gray-600 mt-1 line-clamp-2">{{ $notif->message }}</p>
                                        <p class="text-xs text-gray-500 mt-3">
                                            {{ $notif->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>
                            </button>
                        @empty
                            <div class="p-12 text-center text-sm text-gray-500">
                                <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                </svg>
                                Tidak ada notifikasi baru
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- USER DROPDOWN -->
                <div class="dropdown">
                    <div class="flex items-center gap-3 cursor-pointer group p-3 rounded-xl glass-hover transition-all duration-200">
                        <div id="userAvatar" class="w-12 h-12 rounded-2xl overflow-hidden border-2 border-gray-200 flex items-center justify-center shrink-0 shadow-lg user-avatar">
                            @if(auth()->user()->avatar)
                                <img src="{{ asset('storage/' . auth()->user()->avatar) }}" 
                                    class="w-full h-full object-cover">
                            @else
                                <span class="text-sm font-bold text-white w-full h-full flex items-center justify-center rounded-2xl shadow-lg">
                                    {{ strtoupper(substr(auth()->user()->username ?? 'A',0,1)) }}
                                </span>
                            @endif
                        </div>
                        <div class="hidden sm:block user-info min-w-0">
                            <p class="text-sm font-semibold user-name truncate">{{ auth()->user()->username ?? 'Admin' }}</p>
                            <p class="text-xs user-role">
                                @if(auth()->user()->role === 'admin')
                                    Administrator
                                @else
                                    Staff
                                @endif
                            </p>
                        </div>
                        <!-- Dropdown Arrow -->
                        <svg class="w-4 h-4 text-gray-400 group-hover:text-gray-600 transition-all duration-200 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>

                    <!-- DROPDOWN MENU -->
                    <div class="dropdown-menu">
                        <a href="/profile" class="dropdown-item">
                            <svg class="w-5 h-5 inline mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Edit Profil
                        </a>
                        <a href="/logout" class="dropdown-item logout">
                            <svg class="w-5 h-5 inline mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            Keluar
                        </a>
                    </div>
                </div>
            </div>
        </header>

        <!-- CONTENT -->
        <main class="flex-1 p-6 md:p-8 lg:p-10 overflow-visible">
            @yield('content')
        </main>

        <!-- FOOTER -->
        <footer id="footer" class="px-8 py-6 text-sm text-center border-t border-gray-200 footer">
            <p>&copy; {{ date('Y') }} Sistem Monitoring WNA. All rights reserved.</p>
        </footer>
    </div>
</div>

<!-- SCRIPT TOGGLE SIDEBAR -->
<script>
    // Sidebar toggle - Smooth animation
    const menuBtn = document.getElementById('menuBtn');
    const sidebar = document.getElementById('sidebar');

    menuBtn?.addEventListener('click', () => {
        sidebar.classList.toggle('hidden');
        if (!sidebar.classList.contains('hidden')) {
            sidebar.style.transform = 'translateX(0)';
            document.body.style.overflow = 'hidden';
        } else {
            sidebar.style.transform = 'translateX(-100%)';
            document.body.style.overflow = '';
        }
    });

    // Dropdown handling - Improved
    document.addEventListener('click', (e) => {
        const dropdowns = document.querySelectorAll('.dropdown');
        dropdowns.forEach(dropdown => {
            if (!dropdown.contains(e.target)) {
                dropdown.removeAttribute('open');
            }
        });
    });

    // Toggle user dropdown
    document.querySelectorAll('.group').forEach(group => {
        group.addEventListener('click', (e) => {
            e.stopPropagation();
            const dropdown = group.closest('.dropdown');
            if (dropdown) {
                dropdown.toggleAttribute('open');
            }
        });
    });

    // WNA Dropdown toggle
    function toggleDropdown(id) {
        const el = document.getElementById(id);
        if (!el) return;
        el.classList.toggle('hidden');
    }

    // Close sidebar on route change (for SPA-like behavior)
    window.addEventListener('popstate', () => {
        sidebar.classList.add('hidden');
        document.body.style.overflow = '';
    });

    // PWA service worker registration
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', () => {
            navigator.serviceWorker.register('/sw.js')
                .catch((err) => console.warn('SW registration failed:', err));
        });
    }

    function markAsRead(id, element)
    {
        fetch(`/notif/read/${id}`, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {

            element.disabled = true;

            // hilangkan style unread
            element.classList.remove('notif-unread');

            // ubah titik biru jadi abu
            const dot = element.querySelector('.animate-pulse');

            if (dot) {
                dot.classList.remove(
                    'bg-blue-500',
                    'animate-pulse',
                    'ring-2',
                    'ring-blue-200/50'
                );

                dot.classList.add('bg-gray-300');
            }

            // update badge
            const badge = document.querySelector('.notification-badge');

            if (badge) {

                let count = parseInt(badge.innerText);

                if (count > 1) {
                    badge.innerText = count - 1;
                } else {
                    badge.remove();
                }
            }
        })
        .catch(error => {
            console.error('Notif error:', error);
        });
    }
</script>

</body>
</html>