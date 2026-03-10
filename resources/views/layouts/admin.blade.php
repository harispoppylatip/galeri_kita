<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin — Haris & Balqis Gallery')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link
        href="https://fonts.bunny.net/css?family=playfair-display:400,400i,700,700i|great-vibes:400|poppins:300,400,500,600,700"
        rel="stylesheet" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>

<body class="bg-cream font-body text-brown-dark min-h-screen flex">

    {{-- ===== SIDEBAR ===== --}}
    <aside id="admin-sidebar"
        class="fixed inset-y-0 left-0 z-40 w-64 bg-brown-dark text-white transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out flex flex-col">

        {{-- Sidebar Header --}}
        <div class="flex items-center gap-2 px-5 h-16 border-b border-white/10 shrink-0">
            <span class="text-brown-lighter text-lg">♡</span>
            <span class="font-script text-xl text-brown-lighter truncate">H & B</span>
            <span class="font-heading text-xs text-brown-light tracking-widest ml-1 uppercase">Admin</span>
        </div>

        {{-- Sidebar Nav --}}
        <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1">
            <p class="px-3 mb-2 text-[10px] font-semibold uppercase tracking-widest text-brown-light/60">Menu</p>

            <a href="{{ route('admin.config') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors
                    {{ request()->routeIs('admin.config') ? 'bg-white/15 text-white' : 'text-brown-lighter hover:bg-white/10 hover:text-white' }}">
                <i class="fas fa-th-large w-5 text-center text-sm"></i>
                Kelola Foto
            </a>

            <a href="{{ route('admin.upload') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors
                    {{ request()->routeIs('admin.upload') ? 'bg-white/15 text-white' : 'text-brown-lighter hover:bg-white/10 hover:text-white' }}">
                <i class="fas fa-cloud-upload-alt w-5 text-center text-sm"></i>
                Upload Foto
            </a>

            <a href="{{ route('admin.bulk-upload') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors
                    {{ request()->routeIs('admin.bulk-upload') ? 'bg-white/15 text-white' : 'text-brown-lighter hover:bg-white/10 hover:text-white' }}">
                <i class="fas fa-images w-5 text-center text-sm"></i>
                Upload Banyak
            </a>

            <a href="{{ route('admin.albums.index') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors
                    {{ request()->routeIs('admin.albums.*') ? 'bg-white/15 text-white' : 'text-brown-lighter hover:bg-white/10 hover:text-white' }}">
                <i class="fas fa-book-open w-5 text-center text-sm"></i>
                Kelola Album
            </a>

            <div class="!mt-6">
                <p class="px-3 mb-2 text-[10px] font-semibold uppercase tracking-widest text-brown-light/60">Pengaturan
                </p>
            </div>

            <a href="{{ route('admin.users.index') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors
                    {{ request()->routeIs('admin.users.*') ? 'bg-white/15 text-white' : 'text-brown-lighter hover:bg-white/10 hover:text-white' }}">
                <i class="fas fa-users-cog w-5 text-center text-sm"></i>
                Kelola Admin
            </a>

            <div class="!mt-6">
                <p class="px-3 mb-2 text-[10px] font-semibold uppercase tracking-widest text-brown-light/60">Lainnya</p>
            </div>

            <a href="{{ route('home') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-brown-lighter hover:bg-white/10 hover:text-white transition-colors">
                <i class="fas fa-external-link-alt w-5 text-center text-sm"></i>
                Lihat Website
            </a>
        </nav>

        {{-- Sidebar Footer --}}
        <div class="px-3 py-4 border-t border-white/10 shrink-0 space-y-2">
            <div class="flex items-center gap-3 px-2">
                <div class="w-8 h-8 rounded-full bg-white/15 flex items-center justify-center shrink-0">
                    <span
                        class="text-xs font-bold text-white">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-medium text-white truncate">{{ auth()->user()->name }}</p>
                    <p class="text-[10px] text-brown-light/50 truncate">{{ auth()->user()->username }}</p>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="flex items-center gap-3 w-full px-3 py-2 rounded-lg text-sm font-medium text-red-300 hover:bg-red-500/15 hover:text-red-200 transition-colors">
                    <i class="fas fa-sign-out-alt w-5 text-center text-sm"></i>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    {{-- ===== MAIN WRAPPER ===== --}}
    <div class="flex-1 flex flex-col md:ml-64 min-h-screen">

        {{-- Top Bar --}}
        <header
            class="sticky top-0 z-30 bg-white/90 backdrop-blur-sm border-b border-brown-light/20 h-16 flex items-center px-4 sm:px-6 shrink-0">
            {{-- Mobile Sidebar Toggle --}}
            <button id="sidebar-toggle"
                class="md:hidden p-2 -ml-2 mr-2 text-brown-dark hover:text-brown-primary transition-colors"
                aria-label="Toggle sidebar">
                <i class="fas fa-bars text-lg"></i>
            </button>

            {{-- Page Title --}}
            <h1 class="font-heading text-lg sm:text-xl text-brown-dark truncate">
                @yield('page-title', 'Admin Panel')
            </h1>

            {{-- Right Side --}}
            <div class="ml-auto flex items-center gap-3">
                <span class="hidden sm:inline text-sm text-brown-medium">
                    Halo, <span class="font-medium text-brown-dark">{{ auth()->user()->name }}</span>
                </span>
                <form action="{{ route('logout') }}" method="POST" class="hidden sm:block">
                    @csrf
                    <button type="submit"
                        class="inline-flex items-center gap-1.5 text-sm text-brown-medium hover:text-red-600 transition-colors">
                        <i class="fas fa-sign-out-alt text-xs"></i>
                        Logout
                    </button>
                </form>
                <a href="{{ route('home') }}"
                    class="hidden sm:inline-flex items-center gap-1.5 text-sm text-brown-medium hover:text-brown-primary transition-colors">
                    <i class="fas fa-external-link-alt text-xs"></i>
                    Website
                </a>
            </div>
        </header>

        {{-- Page Content --}}
        <main class="flex-1 p-4 sm:p-6 lg:p-8">
            @yield('content')
        </main>

        {{-- Admin Footer --}}
        <footer class="border-t border-brown-light/20 px-4 sm:px-6 py-4 shrink-0">
            <p class="text-xs text-brown-medium text-center sm:text-left">
                &copy; {{ date('Y') }} <span class="text-brown-primary">♡</span> Haris & Balqis Gallery — Admin
                Panel
            </p>
        </footer>
    </div>

    {{-- Sidebar Overlay (Mobile) --}}
    <div id="sidebar-overlay" class="fixed inset-0 z-30 bg-black/40 hidden md:hidden"></div>

    {{-- Sidebar Script --}}
    <script>
        const sidebar = document.getElementById('admin-sidebar');
        const toggle = document.getElementById('sidebar-toggle');
        const overlay = document.getElementById('sidebar-overlay');

        function openSidebar() {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
        }

        function closeSidebar() {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        }

        toggle?.addEventListener('click', function() {
            if (sidebar.classList.contains('-translate-x-full')) {
                openSidebar();
            } else {
                closeSidebar();
            }
        });

        overlay?.addEventListener('click', closeSidebar);
    </script>

    @stack('scripts')
</body>

</html>
