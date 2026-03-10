@extends('layouts.app')

@section('title', 'Galeri Foto — Haris & Balqis Gallery')

@section('content')

    {{-- ===== HEADER GALERI ===== --}}
    <section class="relative bg-cream-light py-12 sm:py-16 overflow-hidden">
        {{-- Decorative corners --}}
        <div class="absolute top-0 left-0 w-40 h-40 opacity-15 pointer-events-none">
            <svg viewBox="0 0 200 200" fill="none">
                <circle cx="15" cy="15" r="8" fill="#DCC8AD" opacity="0.6" />
                <circle cx="45" cy="5" r="5" fill="#C4A882" opacity="0.4" />
                <ellipse cx="30" cy="30" rx="20" ry="12" fill="#C4A882" opacity="0.15"
                    transform="rotate(-30 30 30)" />
            </svg>
        </div>
        <div class="absolute bottom-0 right-0 w-40 h-40 opacity-10 pointer-events-none">
            <svg viewBox="0 0 200 200" fill="none">
                <circle cx="170" cy="170" r="10" fill="#DCC8AD" opacity="0.5" />
                <circle cx="185" cy="150" r="6" fill="#C4A882" opacity="0.4" />
                <ellipse cx="175" cy="160" rx="20" ry="12" fill="#DCC8AD" opacity="0.12"
                    transform="rotate(-20 175 160)" />
            </svg>
        </div>

        <div class="site-container text-center">
            <h1 class="font-script text-4xl sm:text-5xl lg:text-6xl text-brown-primary mb-3">Galeri Foto</h1>
            <p class="font-heading text-base sm:text-lg text-brown-medium tracking-wide max-w-xl mx-auto">
                Kumpulan momen indah yang kami abadikan bersama
            </p>

            {{-- Stats --}}
            <div class="flex items-center justify-center gap-6 sm:gap-10 mt-6">
                <div class="text-center">
                    <p class="text-2xl font-bold text-brown-dark">{{ $photos->total() }}</p>
                    <p class="text-xs text-brown-medium">Total Foto</p>
                </div>
                <div class="w-px h-8 bg-brown-light/30"></div>
                <div class="text-center">
                    <p class="text-2xl font-bold text-brown-dark">{{ $monthCount }}</p>
                    <p class="text-xs text-brown-medium">Bulan Ini</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== FILTER & SEARCH ===== --}}
    <section class="sticky top-16 z-20 bg-cream/95 backdrop-blur-sm border-b border-brown-light/15">
        <div class="site-container">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-3 py-3">

                {{-- Filter Tabs --}}
                <div class="flex items-center gap-1 bg-cream-dark/60 rounded-lg p-1">
                    <a href="{{ route('galeri') }}"
                        class="filter-tab {{ !request('sort') || request('sort') === 'terbaru' ? 'active' : '' }}">
                        Terbaru
                    </a>
                    <a href="{{ route('galeri', ['sort' => 'terlama']) }}"
                        class="filter-tab {{ request('sort') === 'terlama' ? 'active' : '' }}">
                        Terlama
                    </a>
                </div>

                {{-- Search --}}
                <form action="{{ route('galeri') }}" method="GET" class="flex items-center gap-2">
                    @if (request('sort'))
                        <input type="hidden" name="sort" value="{{ request('sort') }}" />
                    @endif
                    <div class="relative">
                        <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-brown-medium/50" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari foto..."
                            class="pl-9 pr-4 py-2 rounded-xl border border-brown-light/40 bg-cream-light text-sm text-brown-dark placeholder:text-brown-medium/60 focus:border-brown-primary focus:outline-none focus:ring-2 focus:ring-brown-primary/30 w-52 sm:w-64" />
                    </div>
                    <button type="submit"
                        class="px-4 py-2 rounded-xl bg-brown-primary text-white text-sm font-medium hover:bg-brown-dark transition-colors">
                        Cari
                    </button>
                    @if (request('search'))
                        <a href="{{ route('galeri') }}"
                            class="p-2 text-brown-medium hover:text-brown-primary transition-colors" title="Reset">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </a>
                    @endif
                </form>
            </div>
        </div>
    </section>

    {{-- ===== KONTEN GALERI ===== --}}
    <section class="py-8 sm:py-10 bg-cream">
        <div class="site-container">

            {{-- Search Result Info --}}
            @if (request('search'))
                <div class="mb-6 flex items-center gap-2 text-sm text-brown-medium">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    Hasil pencarian untuk "<span class="font-medium text-brown-dark">{{ request('search') }}</span>"
                    — {{ $photos->total() }} foto ditemukan
                </div>
            @endif

            {{-- Photo Grid --}}
            @if ($photos->count() > 0)
                <div class="photos-grid">
                    @foreach ($photos as $photo)
                        <div class="photo-tile group cursor-pointer"
                            onclick="openLightbox({{ $photo->id }}, '{{ asset('storage/' . $photo->nama) }}', '{{ addslashes($photo->judul) }}', '{{ addslashes($photo->description ?? '') }}', '{{ $photo->created_at->format('d M Y') }}')">
                            <img src="{{ asset('storage/' . $photo->nama) }}" alt="{{ $photo->judul }}"
                                loading="lazy" />

                            {{-- Hover Overlay --}}
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-3">
                                <h3 class="text-white font-medium text-sm truncate">{{ $photo->judul }}</h3>
                                <p class="text-white/70 text-xs">{{ $photo->created_at->format('d M Y') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                @if ($photos->hasPages())
                    <div class="mt-8 flex justify-center">
                        {{ $photos->links() }}
                    </div>
                @endif
            @else
                {{-- Empty State --}}
                <div class="py-20 text-center">
                    <div class="w-20 h-20 rounded-full bg-cream-dark flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-brown-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <p class="font-heading text-lg text-brown-dark mb-1">Belum ada foto</p>
                    <p class="text-sm text-brown-medium">
                        @if (request('search'))
                            Tidak ada foto yang cocok dengan pencarian.
                        @else
                            Foto yang diupload akan muncul di sini.
                        @endif
                    </p>
                </div>
            @endif

        </div>
    </section>

    {{-- ===== LIGHTBOX MODAL ===== --}}
    <div id="lightbox" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/90 backdrop-blur-sm">

        {{-- Close Button --}}
        <button onclick="closeLightbox()"
            class="absolute top-4 right-4 z-10 w-10 h-10 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        {{-- Image Container --}}
        <div class="flex flex-col items-center max-w-5xl w-full px-4 max-h-[90vh]">
            <img id="lightbox-img" src="" alt=""
                class="max-h-[70vh] w-auto max-w-full object-contain rounded-lg shadow-2xl" />

            {{-- Info --}}
            <div class="mt-4 text-center w-full max-w-lg">
                <h3 id="lightbox-title" class="font-heading text-lg sm:text-xl text-white"></h3>
                <p id="lightbox-desc" class="text-white/60 text-sm mt-1"></p>
                <p id="lightbox-date" class="text-white/40 text-xs mt-2"></p>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        const lightbox = document.getElementById('lightbox');
        const lightboxImg = document.getElementById('lightbox-img');
        const lightboxTitle = document.getElementById('lightbox-title');
        const lightboxDesc = document.getElementById('lightbox-desc');
        const lightboxDate = document.getElementById('lightbox-date');

        function openLightbox(id, src, title, desc, date) {
            lightboxImg.src = src;
            lightboxImg.alt = title;
            lightboxTitle.textContent = title;
            lightboxDesc.textContent = desc || '';
            lightboxDate.textContent = date;
            lightbox.classList.remove('hidden');
            lightbox.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closeLightbox() {
            lightbox.classList.add('hidden');
            lightbox.classList.remove('flex');
            document.body.style.overflow = '';
            lightboxImg.src = '';
        }

        // Close on backdrop click
        lightbox.addEventListener('click', function(e) {
            if (e.target === lightbox) closeLightbox();
        });

        // Close on Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeLightbox();
        });
    </script>
@endpush
