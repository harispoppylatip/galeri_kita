@extends('layouts.app')

@section('title', $album->nama . ' — Haris & Balqis Gallery')

@section('content')

    {{-- ===== HEADER ===== --}}
    <section class="relative bg-cream-light py-10 sm:py-14 overflow-hidden">
        <div class="site-container">
            {{-- Breadcrumb --}}
            <div class="mb-4">
                <a href="{{ route('album') }}"
                    class="inline-flex items-center gap-1.5 text-sm text-brown-medium hover:text-brown-primary transition-colors">
                    <i class="fas fa-arrow-left text-xs"></i>
                    Kembali ke Album
                </a>
            </div>

            <div class="text-center">
                <h1 class="font-script text-3xl sm:text-4xl lg:text-5xl text-brown-primary mb-2">{{ $album->nama }}</h1>
                @if ($album->deskripsi)
                    <p class="font-heading text-sm sm:text-base text-brown-medium tracking-wide max-w-xl mx-auto">
                        {{ $album->deskripsi }}
                    </p>
                @endif

                <div class="flex items-center justify-center gap-6 mt-5">
                    <div class="text-center">
                        <p class="text-xl font-bold text-brown-dark">{{ $album->photos->count() }}</p>
                        <p class="text-xs text-brown-medium">Foto</p>
                    </div>
                    <div class="w-px h-8 bg-brown-light/30"></div>
                    <div class="text-center">
                        <p class="text-xl font-bold text-brown-dark">{{ $album->created_at->format('d M Y') }}</p>
                        <p class="text-xs text-brown-medium">Dibuat</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== PHOTOS ===== --}}
    <section class="py-8 sm:py-10 bg-cream">
        <div class="site-container">

            @if ($album->photos->count() > 0)
                <div class="photos-grid">
                    @foreach ($album->photos as $photo)
                        <div class="photo-tile group cursor-pointer"
                            onclick="openLightbox('{{ asset('storage/' . $photo->nama) }}', '{{ addslashes($photo->judul) }}', '{{ addslashes($photo->description ?? '') }}', '{{ $photo->created_at->format('d M Y') }}')">
                            <img src="{{ asset('storage/' . $photo->nama) }}" alt="{{ $photo->judul }}" loading="lazy" />

                            {{-- Hover Overlay --}}
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-3">
                                <h3 class="text-white font-medium text-sm truncate">{{ $photo->judul }}</h3>
                                <p class="text-white/70 text-xs">{{ $photo->created_at->format('d M Y') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="py-20 text-center">
                    <div class="w-20 h-20 rounded-full bg-cream-dark flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-image text-3xl text-brown-light"></i>
                    </div>
                    <p class="font-heading text-lg text-brown-dark mb-1">Album ini belum memiliki foto</p>
                    <p class="text-sm text-brown-medium">Foto yang ditambahkan ke album ini akan muncul di sini.</p>
                </div>
            @endif

        </div>
    </section>

    {{-- ===== LIGHTBOX MODAL ===== --}}
    <div id="lightbox" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/90 backdrop-blur-sm">
        <button onclick="closeLightbox()"
            class="absolute top-4 right-4 z-10 w-10 h-10 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <div class="flex flex-col items-center max-w-5xl w-full px-4 max-h-[90vh]">
            <img id="lightbox-img" src="" alt=""
                class="max-h-[70vh] w-auto max-w-full object-contain rounded-lg shadow-2xl" />
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

        function openLightbox(src, title, desc, date) {
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

        lightbox.addEventListener('click', function(e) {
            if (e.target === lightbox) closeLightbox();
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeLightbox();
        });
    </script>
@endpush
