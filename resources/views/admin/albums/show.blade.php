@extends('layouts.admin')

@section('title', $album->nama . ' — Admin')
@section('page-title', $album->nama)

@section('content')

    {{-- Flash Messages --}}
    @if (session('success'))
        <div
            class="mb-6 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700 flex items-center gap-2">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-6">
        <a href="{{ route('admin.albums.index') }}"
            class="inline-flex items-center gap-1.5 text-sm text-brown-medium hover:text-brown-primary transition-colors">
            <i class="fas fa-arrow-left text-xs"></i>
            Kembali ke Daftar Album
        </a>
    </div>

    {{-- Album Info --}}
    <div class="rounded-2xl border border-brown-light/30 bg-white/90 p-4 sm:p-6 shadow-sm mb-6">
        <div class="flex flex-col sm:flex-row gap-4">
            @if ($album->getCoverUrl())
                <div class="w-full sm:w-48 h-32 rounded-xl overflow-hidden border border-brown-light/20 shrink-0">
                    <img src="{{ $album->getCoverUrl() }}" alt="{{ $album->nama }}" class="w-full h-full object-cover" />
                </div>
            @endif
            <div class="flex-1">
                <h2 class="font-heading text-xl font-bold text-brown-dark">{{ $album->nama }}</h2>
                @if ($album->deskripsi)
                    <p class="text-sm text-brown-medium mt-1">{{ $album->deskripsi }}</p>
                @endif
                <div class="flex items-center gap-4 mt-3 text-xs text-brown-medium/70">
                    <span><i class="fas fa-image mr-1"></i>{{ $album->photos->count() }} foto</span>
                    <span><i class="fas fa-calendar mr-1"></i>{{ $album->created_at->format('d M Y') }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Add Photos Section --}}
    <div class="rounded-2xl border border-brown-light/30 bg-white/90 p-4 sm:p-6 shadow-sm mb-6">
        <h3 class="font-heading text-base font-semibold text-brown-dark mb-4">
            <i class="fas fa-plus-circle text-brown-primary mr-2"></i>Tambah Foto ke Album
        </h3>

        @if ($availablePhotos->count() > 0)
            <form action="{{ route('admin.albums.addPhotos', $album->id) }}" method="POST">
                @csrf
                <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-6 gap-3 mb-4" id="photo-picker">
                    @foreach ($availablePhotos as $photo)
                        <label class="relative cursor-pointer group">
                            <input type="checkbox" name="photo_ids[]" value="{{ $photo->id }}" class="peer hidden" />
                            <div
                                class="aspect-square rounded-xl overflow-hidden border-2 border-brown-light/30 peer-checked:border-brown-primary peer-checked:ring-2 peer-checked:ring-brown-primary/30 transition-all">
                                <img src="{{ asset('storage/' . $photo->nama) }}" alt="{{ $photo->judul }}"
                                    class="w-full h-full object-cover" loading="lazy" />
                            </div>
                            {{-- Check indicator --}}
                            <div
                                class="absolute top-1.5 right-1.5 w-5 h-5 rounded-full bg-brown-primary text-white items-center justify-center text-[10px] hidden peer-checked:flex">
                                <i class="fas fa-check"></i>
                            </div>
                            <p class="text-[10px] text-brown-medium truncate mt-1 px-0.5">{{ $photo->judul }}</p>
                        </label>
                    @endforeach
                </div>

                <div class="flex items-center justify-between">
                    <p class="text-xs text-brown-medium" id="selected-count">0 foto dipilih</p>
                    <button type="submit"
                        class="inline-flex items-center gap-2 rounded-xl bg-brown-primary px-5 py-2 text-sm font-semibold text-white hover:bg-brown-dark transition-colors">
                        <i class="fas fa-plus text-xs"></i>
                        Tambahkan
                    </button>
                </div>
            </form>
        @else
            <p class="text-sm text-brown-medium/70 text-center py-6">
                <i class="fas fa-check-circle text-green-500 mr-1"></i>
                Semua foto sudah ada di album ini.
            </p>
        @endif
    </div>

    {{-- Album Photos --}}
    <div class="rounded-2xl border border-brown-light/30 bg-white/90 p-4 sm:p-6 shadow-sm">
        <h3 class="font-heading text-base font-semibold text-brown-dark mb-4">
            <i class="fas fa-images text-brown-primary mr-2"></i>Foto dalam Album ({{ $album->photos->count() }})
        </h3>

        @if ($album->photos->count() > 0)
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                @foreach ($album->photos as $photo)
                    <div class="group relative">
                        <div class="aspect-square rounded-xl overflow-hidden border border-brown-light/20">
                            <img src="{{ asset('storage/' . $photo->nama) }}" alt="{{ $photo->judul }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                loading="lazy" />
                        </div>
                        <p class="text-xs text-brown-dark font-medium truncate mt-1.5 px-0.5">{{ $photo->judul }}</p>

                        {{-- Remove button --}}
                        <form action="{{ route('admin.albums.removePhoto', [$album->id, $photo->id]) }}" method="POST"
                            class="absolute top-1.5 right-1.5" onsubmit="return confirm('Hapus foto ini dari album?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="w-6 h-6 rounded-full bg-red-500/80 hover:bg-red-600 text-white flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity"
                                title="Hapus dari album">
                                <i class="fas fa-times text-[10px]"></i>
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-10">
                <div class="w-14 h-14 rounded-full bg-cream-dark flex items-center justify-center mx-auto mb-3">
                    <i class="fas fa-image text-xl text-brown-light"></i>
                </div>
                <p class="text-sm text-brown-medium">Album ini belum memiliki foto.</p>
                <p class="text-xs text-brown-medium/60 mt-1">Pilih foto di atas untuk menambahkannya.</p>
            </div>
        @endif
    </div>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const picker = document.getElementById('photo-picker');
            const counter = document.getElementById('selected-count');
            if (!picker || !counter) return;

            picker.addEventListener('change', function() {
                const checked = picker.querySelectorAll('input[type="checkbox"]:checked').length;
                counter.textContent = checked + ' foto dipilih';
            });
        });
    </script>
@endpush
