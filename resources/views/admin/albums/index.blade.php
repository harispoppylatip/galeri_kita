@extends('layouts.admin')

@section('title', 'Kelola Album — Admin')
@section('page-title', 'Kelola Album')

@section('content')

    {{-- Flash Messages --}}
    @if (session('success'))
        <div
            class="mb-6 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700 flex items-center gap-2">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <p class="text-sm text-brown-medium">Kelola album foto untuk mengelompokkan kenangan.</p>
        </div>
        <a href="{{ route('admin.albums.create') }}"
            class="inline-flex items-center justify-center gap-2 rounded-xl bg-brown-primary px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-brown-dark shrink-0">
            <i class="fas fa-plus text-xs"></i>
            Buat Album Baru
        </a>
    </div>

    {{-- Album Grid --}}
    @if ($albums->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach ($albums as $album)
                <div class="rounded-2xl border border-brown-light/30 bg-white/90 shadow-sm overflow-hidden group">
                    {{-- Cover --}}
                    <a href="{{ route('admin.albums.show', $album->id) }}"
                        class="block relative aspect-[16/10] overflow-hidden bg-cream-dark">
                        @if ($album->getCoverUrl())
                            <img src="{{ $album->getCoverUrl() }}" alt="{{ $album->nama }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <i class="fas fa-images text-3xl text-brown-light/50"></i>
                            </div>
                        @endif

                        {{-- Photo count badge --}}
                        <div
                            class="absolute top-3 right-3 bg-black/50 backdrop-blur-sm text-white text-xs font-medium px-2.5 py-1 rounded-full">
                            <i class="fas fa-image mr-1"></i>{{ $album->photos_count }} foto
                        </div>
                    </a>

                    {{-- Info --}}
                    <div class="p-4">
                        <a href="{{ route('admin.albums.show', $album->id) }}" class="block">
                            <h3
                                class="font-heading text-base font-semibold text-brown-dark truncate hover:text-brown-primary transition-colors">
                                {{ $album->nama }}
                            </h3>
                        </a>
                        @if ($album->deskripsi)
                            <p class="text-xs text-brown-medium mt-1 line-clamp-2">{{ $album->deskripsi }}</p>
                        @endif
                        <p class="text-[10px] text-brown-medium/60 mt-2">
                            Dibuat {{ $album->created_at->format('d M Y') }}
                        </p>

                        {{-- Actions --}}
                        <div class="flex items-center gap-2 mt-3 pt-3 border-t border-brown-light/15">
                            <a href="{{ route('admin.albums.show', $album->id) }}"
                                class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-medium bg-brown-primary/10 text-brown-primary hover:bg-brown-primary hover:text-white transition-colors">
                                <i class="fas fa-eye text-[10px]"></i>
                                Lihat
                            </a>
                            <a href="{{ route('admin.albums.edit', $album->id) }}"
                                class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-medium bg-brown-primary/10 text-brown-primary hover:bg-brown-primary hover:text-white transition-colors">
                                <i class="fas fa-edit text-[10px]"></i>
                                Edit
                            </a>
                            <form action="{{ route('admin.albums.destroy', $album->id) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus album ini? Foto di dalamnya tidak akan terhapus.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-medium bg-red-50 text-red-600 hover:bg-red-600 hover:text-white transition-colors">
                                    <i class="fas fa-trash-alt text-[10px]"></i>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if ($albums->hasPages())
            <div class="mt-8 flex justify-center">
                {{ $albums->links() }}
            </div>
        @endif
    @else
        <div class="py-16 text-center rounded-2xl border border-brown-light/30 bg-white/90">
            <div class="w-16 h-16 rounded-full bg-cream-dark flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-book-open text-2xl text-brown-light"></i>
            </div>
            <p class="font-heading text-lg text-brown-dark mb-1">Belum ada album</p>
            <p class="text-sm text-brown-medium mb-4">Buat album pertama untuk mengelompokkan foto.</p>
            <a href="{{ route('admin.albums.create') }}"
                class="inline-flex items-center gap-2 rounded-xl bg-brown-primary px-5 py-2.5 text-sm font-semibold text-white hover:bg-brown-dark transition-colors">
                <i class="fas fa-plus text-xs"></i>
                Buat Album
            </a>
        </div>
    @endif

@endsection
