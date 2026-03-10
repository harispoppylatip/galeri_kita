@extends('layouts.admin')

@section('title', 'Edit Album — Admin')
@section('page-title', 'Edit Album')

@section('content')

    <div class="max-w-2xl mx-auto">

        <div class="mb-6">
            <a href="{{ route('admin.albums.index') }}"
                class="inline-flex items-center gap-1.5 text-sm text-brown-medium hover:text-brown-primary transition-colors">
                <i class="fas fa-arrow-left text-xs"></i>
                Kembali ke Daftar Album
            </a>
        </div>

        @if ($errors->any())
            <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                <div class="flex items-center gap-2 mb-1 font-semibold">
                    <i class="fas fa-exclamation-circle"></i>
                    Terjadi kesalahan:
                </div>
                <ul class="list-disc list-inside space-y-0.5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="rounded-2xl border border-brown-light/30 bg-white/90 p-4 shadow-sm sm:p-6 md:p-8">
            <form action="{{ route('admin.albums.update', $album->id) }}" method="POST" enctype="multipart/form-data"
                class="space-y-5">
                @csrf
                @method('PUT')

                {{-- Nama Album --}}
                <div>
                    <label for="nama" class="mb-2 block text-sm font-semibold text-brown-dark">Nama Album</label>
                    <div class="relative">
                        <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-brown-medium/50">
                            <i class="fas fa-book text-sm"></i>
                        </span>
                        <input type="text" name="nama" id="nama" value="{{ old('nama', $album->nama) }}" required
                            placeholder="Contoh: Momen Prewedding"
                            class="w-full rounded-xl border border-brown-light/40 bg-cream-light pl-10 pr-4 py-2.5 text-sm text-brown-dark placeholder:text-brown-medium/60 focus:border-brown-primary focus:outline-none focus:ring-2 focus:ring-brown-primary/30" />
                    </div>
                </div>

                {{-- Deskripsi --}}
                <div>
                    <label for="deskripsi" class="mb-2 block text-sm font-semibold text-brown-dark">Deskripsi
                        <span class="font-normal text-brown-medium">(opsional)</span>
                    </label>
                    <textarea name="deskripsi" id="deskripsi" rows="3" placeholder="Ceritakan tentang album ini..."
                        class="w-full rounded-xl border border-brown-light/40 bg-cream-light px-4 py-2.5 text-sm text-brown-dark placeholder:text-brown-medium/60 focus:border-brown-primary focus:outline-none focus:ring-2 focus:ring-brown-primary/30 resize-none">{{ old('deskripsi', $album->deskripsi) }}</textarea>
                </div>

                {{-- Current Cover --}}
                @if ($album->getCoverUrl())
                    <div>
                        <p class="mb-2 text-sm font-semibold text-brown-dark">Cover Saat Ini</p>
                        <div class="w-40 h-28 rounded-xl overflow-hidden border border-brown-light/30">
                            <img src="{{ $album->getCoverUrl() }}" alt="Cover {{ $album->nama }}"
                                class="w-full h-full object-cover" />
                        </div>
                    </div>
                @endif

                {{-- Cover --}}
                <div>
                    <label for="cover" class="mb-2 block text-sm font-semibold text-brown-dark">Ganti Cover
                        <span class="font-normal text-brown-medium">(opsional)</span>
                    </label>
                    <input type="file" name="cover" id="cover" accept="image/jpeg,image/png,image/jpg"
                        class="w-full rounded-xl border border-brown-light/40 bg-cream-light px-4 py-2 text-sm text-brown-dark file:mr-3 file:rounded-lg file:border-0 file:bg-brown-primary/10 file:px-3 file:py-1.5 file:text-xs file:font-medium file:text-brown-primary hover:file:bg-brown-primary/20 focus:outline-none" />
                </div>

                {{-- Actions --}}
                <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end pt-2">
                    <a href="{{ route('admin.albums.index') }}"
                        class="inline-flex items-center justify-center rounded-xl border border-brown-light/50 px-5 py-2.5 text-sm font-medium text-brown-dark hover:bg-cream-light transition-colors">
                        Batal
                    </a>
                    <button type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-brown-primary px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-brown-dark">
                        <i class="fas fa-save text-xs"></i>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
