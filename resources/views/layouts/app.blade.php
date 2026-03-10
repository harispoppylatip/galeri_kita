<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Haris & Balqis Gallery')</title>

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

<body class="bg-cream font-body text-brown-dark min-h-screen flex flex-col">

    {{-- ===== NAVBAR ===== --}}
    <nav class="sticky top-0 z-50 bg-cream/95 backdrop-blur-sm border-b border-brown-light/20">
        <div class="site-container">
            <div class="flex items-center justify-between h-16">
                {{-- Logo --}}
                <a href="{{ url('/') }}" class="flex items-center gap-1 sm:gap-2 min-w-0">

                    <span class="text-brown-primary text-lg sm:text-xl shrink-0">♡</span>

                    <span class="font-script text-lg sm:text-2xl text-brown-primary truncate">
                        Haris & Balqis
                    </span>

                    <span class="hidden sm:inline font-heading text-sm text-brown-dark tracking-wider ml-1">
                        Gallery
                    </span>

                </a>

                {{-- Desktop Nav Links --}}
                <div class="hidden md:flex items-center gap-8">
                    <a href="{{ route('home') }}"
                        class="text-sm font-medium text-brown-dark hover:text-brown-primary transition-colors {{ request()->routeIs('home') ? 'text-brown-primary' : '' }}">
                        Beranda
                    </a>
                    <a href="{{ route('galeri') }}"
                        class="text-sm font-medium text-brown-dark hover:text-brown-primary transition-colors {{ request()->routeIs('gallery') ? 'text-brown-primary' : '' }}">
                        Galeri
                    </a>
                    <a href="{{ route('album') }}"
                        class="text-sm font-medium text-brown-dark hover:text-brown-primary transition-colors {{ request()->routeIs('album', 'album.show') ? 'text-brown-primary' : '' }}">
                        Album
                    </a>
                    <a href="#"
                        class="text-sm font-medium text-brown-dark hover:text-brown-primary transition-colors {{ request()->routeIs('about') ? 'text-brown-primary' : '' }}">
                        Tentang Kami
                    </a>
                </div>

                {{-- Right Side --}}
                <div class="flex items-center gap-4">
                    {{-- Search --}}
                    <button class="p-2 text-brown-dark hover:text-brown-primary transition-colors" aria-label="Search">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>

                    {{-- Admin Button --}}
                    @auth
                        <a href="{{ route('admin.config') }}"
                            class="flex items-center gap-1 px-4 py-1.5 bg-brown-primary text-white rounded-full text-sm font-medium hover:bg-brown-dark transition-colors">
                            <i class="fas fa-cog text-xs"></i>
                            Admin
                        </a>
                    @else
                        <a href="{{ Route::has('login') ? route('login') : '#' }}"
                            class="flex items-center gap-1 px-4 py-1.5 bg-brown-primary text-white rounded-full text-sm font-medium hover:bg-brown-dark transition-colors">
                            Admin
                            <svg class="w-3.5 h-3.5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </a>
                    @endauth

                    {{-- Mobile Menu Toggle --}}
                    <button class="md:hidden p-2 text-brown-dark" id="mobile-menu-toggle" aria-label="Toggle menu">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Mobile Menu --}}
            <div class="md:hidden hidden pb-4" id="mobile-menu">
                <div class="flex flex-col gap-3 pt-2 border-t border-brown-light/20">
                    <a href="{{ route('home') }}"
                        class="text-sm font-medium text-brown-dark hover:text-brown-primary transition-colors py-1">Beranda</a>
                    <a href="{{ route('galeri') }}"
                        class="text-sm font-medium text-brown-dark hover:text-brown-primary transition-colors py-1">Galeri</a>
                    <a href="{{ route('album') }}"
                        class="text-sm font-medium text-brown-dark hover:text-brown-primary transition-colors py-1">Album</a>
                    <a href="#"
                        class="text-sm font-medium text-brown-dark hover:text-brown-primary transition-colors py-1">Tentang
                        Kami</a>
                </div>
            </div>
        </div>
    </nav>

    {{-- ===== MAIN CONTENT ===== --}}
    <main class="flex-1 m-5">
        @yield('content')
    </main>

    {{-- ===== FOOTER ===== --}}
    <footer class="bg-cream-dark border-t border-brown-light/20">
        <div class="site-container py-6">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                <p class="text-sm text-brown-medium">
                    &copy; {{ date('Y') }} <span class="text-brown-primary">♡</span> Haris & Balqis Gallery, All
                    rights reserved.
                </p>
                <div class="flex items-center gap-4">
                    <a href="#"
                        class="w-8 h-8 flex items-center justify-center rounded-full bg-brown-primary/10 text-brown-primary hover:bg-brown-primary hover:text-white transition-all"
                        aria-label="Instagram">
                        <i class="fab fa-instagram text-sm"></i>
                    </a>
                    <a href="#"
                        class="w-8 h-8 flex items-center justify-center rounded-full bg-brown-primary/10 text-brown-primary hover:bg-brown-primary hover:text-white transition-all"
                        aria-label="Pinterest">
                        <i class="fab fa-pinterest-p text-sm"></i>
                    </a>
                    <a href="#"
                        class="w-8 h-8 flex items-center justify-center rounded-full bg-brown-primary/10 text-brown-primary hover:bg-brown-primary hover:text-white transition-all"
                        aria-label="Facebook">
                        <i class="fab fa-facebook-f text-sm"></i>
                    </a>
                    <a href="#"
                        class="w-8 h-8 flex items-center justify-center rounded-full bg-brown-primary/10 text-brown-primary hover:bg-brown-primary hover:text-white transition-all"
                        aria-label="Twitter">
                        <i class="fab fa-twitter text-sm"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    {{-- Mobile Menu Script --}}
    <script>
        document.getElementById('mobile-menu-toggle')?.addEventListener('click', function() {
            document.getElementById('mobile-menu')?.classList.toggle('hidden');
        });
    </script>

    @stack('scripts')
</body>

</html>
