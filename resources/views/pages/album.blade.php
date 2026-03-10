@extends('layouts.app')

@section('title', 'Album — Haris & Balqis Gallery')

@section('content')

    {{-- ===== HEADER ===== --}}
    <section class="relative bg-cream-light py-12 sm:py-16 overflow-hidden">
        <div class="absolute top-0 left-0 w-40 h-40 opacity-15 pointer-events-none">
            <svg viewBox="0 0 200 200" fill="none">
                <circle cx="15" cy="15" r="8" fill="#DCC8AD" opacity="0.6" />
                <circle cx="45" cy="5" r="5" fill="#C4A882" opacity="0.4" />
            </svg>
        </div>
        <div class="absolute bottom-0 right-0 w-40 h-40 opacity-10 pointer-events-none">
            <svg viewBox="0 0 200 200" fill="none">
                <circle cx="170" cy="170" r="10" fill="#DCC8AD" opacity="0.5" />
                <circle cx="185" cy="150" r="6" fill="#C4A882" opacity="0.4" />
            </svg>
        </div>

        <div class="site-container text-center">
            <h1 class="font-script text-4xl sm:text-5xl lg:text-6xl text-brown-primary mb-3">Album Kami</h1>
            <p class="font-heading text-base sm:text-lg text-brown-medium tracking-wide max-w-xl mx-auto">
                Koleksi momen berharga yang kami kelompokkan dengan penuh cinta
            </p>

            <div class="flex items-center justify-center gap-6 sm:gap-10 mt-6">
                <div class="text-center">
                    <p class="text-2xl font-bold text-brown-dark">{{ $albums->total() }}</p>
                    <p class="text-xs text-brown-medium">Total Album</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== ALBUM GRID ===== --}}
    <section class="py-8 sm:py-12 bg-cream">
        <div class="site-container">

            @if ($albums->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($albums as $album)
                        <a href="{{ route('album.show', $album->id) }}" class="album-card group block">
                            {{-- Cover --}}
                            <div class="relative aspect-[4/3] overflow-hidden rounded-2xl bg-cream-dark">
                                @if ($album->getCoverUrl())
                                    <img src="{{ $album->getCoverUrl() }}" alt="{{ $album->nama }}"
                                        class="w-full h-full object-cover" loading="lazy" />
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <i class="fas fa-images text-4xl text-brown-light/40"></i>
                                    </div>
                                @endif

                                {{-- Overlay --}}
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/5 to-transparent opacity-70 group-hover:opacity-90 transition-opacity duration-300">
                                </div>

                                {{-- Photo count --}}
                                <div
                                    class="absolute top-3 right-3 bg-white/20 backdrop-blur-sm text-white text-xs font-medium px-2.5 py-1 rounded-full">
                                    <i class="fas fa-image mr-1"></i>{{ $album->photos_count }}
                                </div>

                                {{-- Album info overlay --}}
                                <div class="absolute bottom-0 left-0 right-0 p-4 sm:p-5">
                                    <h3 class="font-heading text-lg sm:text-xl font-bold text-white mb-1">
                                        {{ $album->nama }}</h3>
                                    @if ($album->deskripsi)
                                        <p class="text-white/70 text-xs sm:text-sm line-clamp-2">{{ $album->deskripsi }}</p>
                                    @endif
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

                @if ($albums->hasPages())
                    <div class="mt-10 flex justify-center">
                        {{ $albums->links() }}
                    </div>
                @endif
            @else
                <div class="py-20 text-center">
                    <div class="w-20 h-20 rounded-full bg-cream-dark flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-book-open text-3xl text-brown-light"></i>
                    </div>
                    <p class="font-heading text-lg text-brown-dark mb-1">Belum ada album</p>
                    <p class="text-sm text-brown-medium">Album foto akan muncul di sini.</p>
                </div>
            @endif

        </div>
    </section>

@endsection
