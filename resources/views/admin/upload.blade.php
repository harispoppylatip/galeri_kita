@extends('layouts.admin')

@section('title', 'Upload Foto — Admin')
@section('page-title', 'Upload Foto')

@section('content')
    <section class="site-container py-4 sm:py-8">
        <div class="max-w-3xl mx-auto">
            <div class="mb-6 sm:mb-8 text-center sm:text-left">
                <h1 class="font-heading text-3xl sm:text-4xl text-brown-dark">Upload Foto</h1>
                <p class="mt-2 text-sm sm:text-base text-brown-medium">
                    Tambahkan foto baru beserta judul dan deskripsi untuk galeri.
                </p>
            </div>

            @if (session('success'))
                <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            <div class="rounded-2xl border border-brown-light/30 bg-white/90 p-4 shadow-sm sm:p-6 md:p-8">
                <form action="{{ route('admin.upload.store') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-5">
                    @csrf

                    <div>
                        <label for="gambar" class="mb-2 block text-sm font-semibold text-brown-dark">Gambar</label>
                        <input type="file" name="gambar" id="gambar" accept="image/*"
                            class="block w-full rounded-xl border border-brown-light/40 bg-cream-light px-3 py-2 text-sm text-brown-dark file:mr-3 file:rounded-lg file:border-0 file:bg-brown-primary file:px-3 file:py-2 file:text-xs file:font-semibold file:text-white hover:file:bg-brown-dark focus:outline-none focus:ring-2 focus:ring-brown-primary/30" />
                        @error('gambar')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="judul" class="mb-2 block text-sm font-semibold text-brown-dark">Judul</label>
                        <input type="text" name="judul" id="judul" value="{{ old('judul') }}"
                            placeholder="Contoh: Sunset di Pantai"
                            class="w-full rounded-xl border border-brown-light/40 bg-cream-light px-4 py-2.5 text-sm text-brown-dark placeholder:text-brown-medium/80 focus:border-brown-primary focus:outline-none focus:ring-2 focus:ring-brown-primary/30" />
                        @error('judul')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="description" class="mb-2 block text-sm font-semibold text-brown-dark">Deskripsi</label>
                        <textarea name="description" id="description" rows="5" placeholder="Tulis deskripsi foto..."
                            class="w-full rounded-xl border border-brown-light/40 bg-cream-light px-4 py-3 text-sm text-brown-dark placeholder:text-brown-medium/80 focus:border-brown-primary focus:outline-none focus:ring-2 focus:ring-brown-primary/30">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
                        <a href="{{ route('home') }}"
                            class="inline-flex items-center justify-center rounded-xl border border-brown-light/50 px-5 py-2.5 text-sm font-medium text-brown-dark hover:bg-cream-light">
                            Batal
                        </a>
                        <button type="submit"
                            class="inline-flex items-center justify-center rounded-xl bg-brown-primary px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-brown-dark">
                            Simpan Foto
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
