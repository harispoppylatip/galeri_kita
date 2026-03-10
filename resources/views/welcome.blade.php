@extends('layouts.app')

@section('title', 'Haris & Balqis Gallery - Kenangan Indah Kami')

@section('content')

{{-- ===== HERO SECTION ===== --}}
<section class="relative overflow-hidden bg-cream-light">
    {{-- Floral decorative corners --}}
    <div class="absolute top-0 left-0 w-48 h-48 opacity-20 pointer-events-none">
        <svg viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="15" cy="15" r="8" fill="#DCC8AD" opacity="0.6"/>
            <circle cx="45" cy="5" r="5" fill="#C4A882" opacity="0.4"/>
            <circle cx="5" cy="45" r="6" fill="#DCC8AD" opacity="0.5"/>
            <ellipse cx="30" cy="30" rx="20" ry="12" fill="#C4A882" opacity="0.15" transform="rotate(-30 30 30)"/>
            <ellipse cx="12" cy="25" rx="8" ry="14" fill="#DCC8AD" opacity="0.12" transform="rotate(15 12 25)"/>
            <ellipse cx="25" cy="12" rx="10" ry="6" fill="#B0845C" opacity="0.1" transform="rotate(-45 25 12)"/>
        </svg>
    </div>
    <div class="absolute top-0 right-0 w-72 h-72 opacity-15 pointer-events-none">
        <svg viewBox="0 0 300 300" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="250" cy="30" r="12" fill="#DCC8AD" opacity="0.5"/>
            <circle cx="280" cy="60" r="8" fill="#C4A882" opacity="0.4"/>
            <circle cx="270" cy="15" r="6" fill="#B0845C" opacity="0.3"/>
            <ellipse cx="260" cy="45" rx="25" ry="15" fill="#DCC8AD" opacity="0.12" transform="rotate(20 260 45)"/>
            <ellipse cx="240" cy="20" rx="18" ry="10" fill="#C4A882" opacity="0.1" transform="rotate(-15 240 20)"/>
            <path d="M230 10C240 30 260 40 290 35C270 50 250 45 235 30" stroke="#C4A882" stroke-width="1" opacity="0.3"/>
            <path d="M260 5C265 20 275 30 295 28" stroke="#DCC8AD" stroke-width="0.8" opacity="0.25"/>
        </svg>
    </div>
    <div class="absolute bottom-0 left-0 w-56 h-56 opacity-15 pointer-events-none">
        <svg viewBox="0 0 230 230" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="30" cy="200" r="10" fill="#DCC8AD" opacity="0.5"/>
            <circle cx="10" cy="180" r="7" fill="#C4A882" opacity="0.4"/>
            <ellipse cx="20" cy="190" rx="15" ry="20" fill="#DCC8AD" opacity="0.1" transform="rotate(30 20 190)"/>
        </svg>
    </div>
    <div class="absolute bottom-0 right-0 w-48 h-48 opacity-10 pointer-events-none">
        <svg viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="170" cy="170" r="10" fill="#DCC8AD" opacity="0.5"/>
            <circle cx="185" cy="150" r="6" fill="#C4A882" opacity="0.4"/>
            <ellipse cx="175" cy="160" rx="20" ry="12" fill="#DCC8AD" opacity="0.12" transform="rotate(-20 175 160)"/>
        </svg>
    </div>

    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-2 min-h-[500px] lg:min-h-[550px]">
            {{-- Left: Hero Image --}}
            <div class="relative h-[350px] sm:h-[400px] lg:h-auto">
                <img
                    src="https://images.unsplash.com/photo-1621184455862-c163dfb30e0f?w=800&h=600&fit=crop&crop=faces"
                    alt="Haris & Balqis"
                    class="w-full h-full object-cover"
                >
                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-transparent to-cream-light/80 hidden lg:block"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-cream-light/60 to-transparent lg:hidden"></div>
            </div>

            {{-- Right: Hero Content --}}
            <div class="flex flex-col items-center lg:items-start justify-center px-6 py-10 lg:py-0 lg:px-12 relative">
                <h1 class="font-script text-5xl sm:text-6xl lg:text-7xl text-brown-primary mb-3 text-center lg:text-left leading-tight">
                    Haris & Balqis
                </h1>
                <p class="font-heading text-lg sm:text-xl text-brown-medium mb-8 tracking-wide text-center lg:text-left">
                    Kenangan Indah Kami
                </p>
                <a href="#galeri" class="inline-flex items-center px-8 py-3 border-2 border-brown-primary text-brown-primary rounded-md font-medium text-sm hover:bg-brown-primary hover:text-white transition-all duration-300 tracking-wider">
                    Lihat Galeri
                </a>
            </div>
        </div>
    </div>
</section>

{{-- ===== FOTO TERBARU MINGGU INI ===== --}}
<section class="py-10 bg-cream">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Section Header --}}
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center gap-2">
                <h2 class="section-title text-lg">Foto Terbaru Minggu Ini</h2>
                <button class="text-brown-medium hover:text-brown-primary transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
            </div>
            <a href="#" class="text-sm text-brown-primary hover:text-brown-dark font-medium transition-colors hidden sm:flex items-center gap-1">
                Lihat Semua Foto Terbaru
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        {{-- Photo Cards Grid --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            {{-- Card 1 --}}
            <div class="photo-card">
                <div class="aspect-[4/3] overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1621184455862-c163dfb30e0f?w=400&h=300&fit=crop" alt="Foto terbaru">
                </div>
                <div class="p-3 flex items-center justify-between">
                    <span class="text-xs text-brown-medium">24 April, 2026</span>
                    <button class="text-brown-light hover:text-brown-primary transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Card 2 --}}
            <div class="photo-card">
                <div class="aspect-[4/3] overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1519741497674-611481863552?w=400&h=300&fit=crop" alt="Foto terbaru">
                </div>
                <div class="p-3 flex items-center justify-between">
                    <span class="text-xs text-brown-medium">24 April, 2026</span>
                    <button class="text-brown-light hover:text-brown-primary transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Card 3 --}}
            <div class="photo-card">
                <div class="aspect-[4/3] overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=400&h=300&fit=crop&crop=faces" alt="Foto terbaru">
                </div>
                <div class="p-3 flex items-center justify-between">
                    <span class="text-xs text-brown-medium">23 April, 2026</span>
                    <button class="text-brown-light hover:text-brown-primary transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Card 4 --}}
            <div class="photo-card">
                <div class="aspect-[4/3] overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1522673607200-164d1b6ce486?w=400&h=300&fit=crop" alt="Foto terbaru">
                </div>
                <div class="p-3 flex items-center justify-between">
                    <span class="text-xs text-brown-medium">24 April, 2026</span>
                    <button class="text-brown-light hover:text-brown-primary transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ===== FOTO FAVORIT ===== --}}
<section class="py-10 bg-cream-dark/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Section Header --}}
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center gap-2">
                <h2 class="section-title text-lg">Foto Favorit</h2>
                <button class="text-brown-medium hover:text-brown-primary transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
            </div>
            <a href="#" class="text-sm text-brown-primary hover:text-brown-dark font-medium transition-colors hidden sm:flex items-center gap-1">
                Lihat Semua Foto Favorit
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        {{-- Album Cards Grid --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            {{-- Album 1 --}}
            <div class="album-card group">
                <div class="aspect-[3/4] relative overflow-hidden rounded-xl">
                    <img src="https://images.unsplash.com/photo-1621184455862-c163dfb30e0f?w=400&h=500&fit=crop" alt="Potret Romantis">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent"></div>
                </div>
                <p class="mt-2 text-sm font-medium text-brown-dark text-center">Potret Romantis</p>
            </div>

            {{-- Album 2 --}}
            <div class="album-card group">
                <div class="aspect-[3/4] relative overflow-hidden rounded-xl">
                    <img src="https://images.unsplash.com/photo-1501785888041-af3ef285b470?w=400&h=500&fit=crop" alt="Jelajah Alam">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent"></div>
                </div>
                <p class="mt-2 text-sm font-medium text-brown-dark text-center">Jelajah Alam</p>
            </div>

            {{-- Album 3 --}}
            <div class="album-card group">
                <div class="aspect-[3/4] relative overflow-hidden rounded-xl">
                    <img src="https://images.unsplash.com/photo-1530789253388-582c481c54b0?w=400&h=500&fit=crop" alt="Petualangan Bersama">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent"></div>
                </div>
                <p class="mt-2 text-sm font-medium text-brown-dark text-center">Petualangan Bersama</p>
            </div>

            {{-- Album 4 - See All --}}
            <div class="album-card group cursor-pointer">
                <div class="aspect-[3/4] relative overflow-hidden rounded-xl">
                    <img src="https://images.unsplash.com/photo-1522673607200-164d1b6ce486?w=400&h=500&fit=crop" alt="Lihat Semua Album">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent"></div>
                </div>
                <a href="#" class="mt-2 text-sm font-medium text-brown-primary text-center flex items-center justify-center gap-1 hover:text-brown-dark transition-colors">
                    Lihat Semua Album
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>

{{-- ===== GALERI FOTO ===== --}}
<section id="galeri" class="py-10 bg-cream">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Section Header --}}
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-2 gap-4">
            <h2 class="font-heading text-3xl font-bold text-brown-dark">Galeri Foto</h2>

            {{-- Filter Tabs --}}
            <div class="flex items-center gap-1 bg-cream-dark/60 rounded-lg p-1">
                <button class="p-2 text-brown-medium hover:text-brown-primary transition-colors rounded" title="Grid view">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M3 3h7v7H3V3zm11 0h7v7h-7V3zM3 14h7v7H3v-7zm11 0h7v7h-7v-7z"/>
                    </svg>
                </button>
                <button class="filter-tab active">Semua Foto</button>
                <button class="filter-tab">Favorit</button>
                <div class="relative">
                    <button class="filter-tab flex items-center gap-1">
                        Album
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <p class="text-brown-medium text-sm mb-8">Kenangan manis kami selama ini</p>

        {{-- Month Group: April 2026 --}}
        <div class="mb-8">
            <div class="flex items-center gap-2 mb-4">
                <h3 class="font-heading text-lg font-semibold text-brown-dark">April 2026</h3>
                <button class="text-brown-medium hover:text-brown-primary transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
            </div>

            {{-- Gallery Grid Row 1 (3 columns) --}}
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-6">
                <div class="gallery-item">
                    <img src="https://images.unsplash.com/photo-1621184455862-c163dfb30e0f?w=500&h=375&fit=crop" alt="Gallery photo">
                </div>
                <div class="gallery-item">
                    <img src="https://images.unsplash.com/photo-1519741497674-611481863552?w=500&h=375&fit=crop" alt="Gallery photo">
                </div>
                <div class="gallery-item">
                    <img src="https://images.unsplash.com/photo-1522673607200-164d1b6ce486?w=500&h=375&fit=crop" alt="Gallery photo">
                </div>
            </div>

            {{-- Date Subgroup 1 --}}
            <div class="flex items-center gap-2 mb-3">
                <span class="text-sm font-medium text-brown-dark">24 April, 2026</span>
                <button class="text-brown-medium hover:text-brown-primary transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
            </div>

            {{-- Gallery Grid Row 2 (4 columns) --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                <div class="gallery-item">
                    <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=400&h=300&fit=crop&crop=faces" alt="Gallery photo">
                </div>
                <div class="gallery-item">
                    <img src="https://images.unsplash.com/photo-1501785888041-af3ef285b470?w=400&h=300&fit=crop" alt="Gallery photo">
                </div>
                <div class="gallery-item">
                    <img src="https://images.unsplash.com/photo-1530789253388-582c481c54b0?w=400&h=300&fit=crop" alt="Gallery photo">
                </div>
                <div class="gallery-item">
                    <img src="https://images.unsplash.com/photo-1516589178581-6cd7833ae3b2?w=400&h=300&fit=crop" alt="Gallery photo">
                </div>
            </div>

            {{-- Date Subgroup 2 --}}
            <div class="flex items-center gap-2 mb-3">
                <span class="text-sm font-medium text-brown-dark">21 April, 2026</span>
                <button class="text-brown-medium hover:text-brown-primary transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</section>

@endsection
