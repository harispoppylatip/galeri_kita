@extends('layouts.admin')

@section('title', 'Kelola Foto — Admin')
@section('page-title', 'Kelola Foto')

@section('content')

    {{-- Flash Messages --}}
    @if (session('success'))
        <div
            class="mb-6 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700 flex items-center gap-2">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700 flex items-center gap-2">
            <i class="fas fa-exclamation-circle"></i>
            {{ session('error') }}
        </div>
    @endif

    {{-- Stats Cards --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="rounded-2xl border border-brown-light/30 bg-white/90 p-4 sm:p-5 shadow-sm">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-brown-primary/10 flex items-center justify-center">
                    <i class="fas fa-images text-brown-primary"></i>
                </div>
                <div>
                    <p class="text-2xl font-bold text-brown-dark">{{ $photos->total() }}</p>
                    <p class="text-xs text-brown-medium">Total Foto</p>
                </div>
            </div>
        </div>
        <div class="rounded-2xl border border-brown-light/30 bg-white/90 p-4 sm:p-5 shadow-sm">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-brown-primary/10 flex items-center justify-center">
                    <i class="fas fa-calendar-day text-brown-primary"></i>
                </div>
                <div>
                    <p class="text-2xl font-bold text-brown-dark">{{ $todayCount }}</p>
                    <p class="text-xs text-brown-medium">Hari Ini</p>
                </div>
            </div>
        </div>
        <div class="rounded-2xl border border-brown-light/30 bg-white/90 p-4 sm:p-5 shadow-sm">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-brown-primary/10 flex items-center justify-center">
                    <i class="fas fa-calendar-week text-brown-primary"></i>
                </div>
                <div>
                    <p class="text-2xl font-bold text-brown-dark">{{ $weekCount }}</p>
                    <p class="text-xs text-brown-medium">Minggu Ini</p>
                </div>
            </div>
        </div>
        <div class="rounded-2xl border border-brown-light/30 bg-white/90 p-4 sm:p-5 shadow-sm">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-brown-primary/10 flex items-center justify-center">
                    <i class="fas fa-cloud-upload-alt text-brown-primary"></i>
                </div>
                <div>
                    <a href="{{ route('admin.upload') }}"
                        class="text-sm font-semibold text-brown-primary hover:text-brown-dark transition-colors">
                        Upload Baru
                    </a>
                    <p class="text-xs text-brown-medium">Tambah Foto</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Photo Management Table --}}
    <div class="rounded-2xl border border-brown-light/30 bg-white/90 shadow-sm overflow-hidden">

        {{-- Table Header --}}
        <div
            class="px-4 sm:px-6 py-4 border-b border-brown-light/20 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <h2 class="font-heading text-lg text-brown-dark">Semua Foto</h2>

            {{-- Search --}}
            <form action="{{ route('admin.config') }}" method="GET" class="flex items-center gap-2">
                <div class="relative">
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-brown-medium/50 text-xs"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul foto..."
                        class="pl-9 pr-4 py-2 rounded-xl border border-brown-light/40 bg-cream-light text-sm text-brown-dark placeholder:text-brown-medium/60 focus:border-brown-primary focus:outline-none focus:ring-2 focus:ring-brown-primary/30 w-full sm:w-64" />
                </div>
                <button type="submit"
                    class="px-4 py-2 rounded-xl bg-brown-primary text-white text-sm font-medium hover:bg-brown-dark transition-colors">
                    Cari
                </button>
            </form>
        </div>

        {{-- Desktop Table --}}
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-cream-light/50 text-left">
                        <th class="px-6 py-3 font-semibold text-brown-dark text-xs uppercase tracking-wider">Foto</th>
                        <th class="px-6 py-3 font-semibold text-brown-dark text-xs uppercase tracking-wider">Judul</th>
                        <th class="px-6 py-3 font-semibold text-brown-dark text-xs uppercase tracking-wider">Deskripsi</th>
                        <th class="px-6 py-3 font-semibold text-brown-dark text-xs uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 font-semibold text-brown-dark text-xs uppercase tracking-wider text-right">Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-brown-light/15">
                    @forelse ($photos as $photo)
                        <tr class="hover:bg-cream-light/30 transition-colors">
                            {{-- Thumbnail --}}
                            <td class="px-6 py-4">
                                <div class="w-16 h-16 rounded-lg overflow-hidden bg-cream-dark shrink-0">
                                    <img src="{{ asset('storage/' . $photo->nama) }}" alt="{{ $photo->judul }}"
                                        class="w-full h-full object-cover" />
                                </div>
                            </td>

                            {{-- Title --}}
                            <td class="px-6 py-4">
                                <p class="font-medium text-brown-dark">{{ $photo->judul }}</p>
                            </td>

                            {{-- Description --}}
                            <td class="px-6 py-4">
                                <p class="text-brown-medium text-sm line-clamp-2">
                                    {{ $photo->description ?? '—' }}
                                </p>
                            </td>

                            {{-- Date --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                <p class="text-brown-medium text-sm">{{ $photo->created_at->format('d M Y') }}</p>
                                <p class="text-brown-medium/60 text-xs">{{ $photo->created_at->format('H:i') }}</p>
                            </td>

                            {{-- Actions --}}
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button
                                        onclick="openEditModal({{ $photo->id }}, '{{ addslashes($photo->judul) }}', '{{ addslashes($photo->description ?? '') }}')"
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-medium bg-brown-primary/10 text-brown-primary hover:bg-brown-primary hover:text-white transition-colors">
                                        <i class="fas fa-edit text-[10px]"></i>
                                        Edit
                                    </button>
                                    <form action="{{ route('admin.config.destroy', $photo->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus foto ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-medium bg-red-50 text-red-600 hover:bg-red-600 hover:text-white transition-colors">
                                            <i class="fas fa-trash-alt text-[10px]"></i>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <div class="w-16 h-16 rounded-full bg-cream-dark flex items-center justify-center">
                                        <i class="fas fa-images text-2xl text-brown-light"></i>
                                    </div>
                                    <p class="text-brown-medium">Belum ada foto yang diupload.</p>
                                    <a href="{{ route('admin.upload') }}"
                                        class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-brown-primary text-white text-sm font-medium hover:bg-brown-dark transition-colors">
                                        <i class="fas fa-plus text-xs"></i>
                                        Upload Foto Pertama
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Mobile Card View --}}
        <div class="md:hidden divide-y divide-brown-light/15">
            @forelse ($photos as $photo)
                <div class="p-4 flex gap-4">
                    {{-- Thumbnail --}}
                    <div class="w-20 h-20 rounded-lg overflow-hidden bg-cream-dark shrink-0">
                        <img src="{{ asset('storage/' . $photo->nama) }}" alt="{{ $photo->judul }}"
                            class="w-full h-full object-cover" />
                    </div>

                    {{-- Info --}}
                    <div class="flex-1 min-w-0">
                        <p class="font-medium text-brown-dark truncate">{{ $photo->judul }}</p>
                        <p class="text-xs text-brown-medium mt-0.5 line-clamp-1">
                            {{ $photo->description ?? 'Tanpa deskripsi' }}</p>
                        <p class="text-xs text-brown-medium/60 mt-1">{{ $photo->created_at->format('d M Y') }}</p>

                        <div class="flex items-center gap-2 mt-2">
                            <button
                                onclick="openEditModal({{ $photo->id }}, '{{ addslashes($photo->judul) }}', '{{ addslashes($photo->description ?? '') }}')"
                                class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-[11px] font-medium bg-brown-primary/10 text-brown-primary">
                                <i class="fas fa-edit text-[9px]"></i> Edit
                            </button>
                            <form action="{{ route('admin.config.destroy', $photo->id) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus foto ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-[11px] font-medium bg-red-50 text-red-600">
                                    <i class="fas fa-trash-alt text-[9px]"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="p-8 text-center">
                    <div class="flex flex-col items-center gap-3">
                        <div class="w-14 h-14 rounded-full bg-cream-dark flex items-center justify-center">
                            <i class="fas fa-images text-xl text-brown-light"></i>
                        </div>
                        <p class="text-sm text-brown-medium">Belum ada foto.</p>
                        <a href="{{ route('admin.upload') }}"
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-brown-primary text-white text-sm font-medium hover:bg-brown-dark transition-colors">
                            <i class="fas fa-plus text-xs"></i>
                            Upload Foto
                        </a>
                    </div>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if ($photos->hasPages())
            <div class="px-4 sm:px-6 py-4 border-t border-brown-light/20">
                {{ $photos->links() }}
            </div>
        @endif
    </div>

    {{-- ===== EDIT MODAL ===== --}}
    <div id="edit-modal" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
        {{-- Backdrop --}}
        <div id="edit-modal-backdrop" class="absolute inset-0 bg-black/50 backdrop-blur-sm"></div>

        {{-- Modal Content --}}
        <div class="relative w-full max-w-lg rounded-2xl bg-white shadow-xl border border-brown-light/20 overflow-hidden">
            {{-- Modal Header --}}
            <div class="flex items-center justify-between px-6 py-4 border-b border-brown-light/20">
                <h3 class="font-heading text-lg text-brown-dark">Edit Foto</h3>
                <button onclick="closeEditModal()" class="p-1 text-brown-medium hover:text-brown-dark transition-colors">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            {{-- Modal Body --}}
            <form id="edit-form" method="POST" class="p-6 space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label for="edit-judul" class="mb-2 block text-sm font-semibold text-brown-dark">Judul</label>
                    <input type="text" name="judul" id="edit-judul"
                        class="w-full rounded-xl border border-brown-light/40 bg-cream-light px-4 py-2.5 text-sm text-brown-dark placeholder:text-brown-medium/80 focus:border-brown-primary focus:outline-none focus:ring-2 focus:ring-brown-primary/30" />
                    @error('judul')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="edit-description"
                        class="mb-2 block text-sm font-semibold text-brown-dark">Deskripsi</label>
                    <textarea name="description" id="edit-description" rows="4"
                        class="w-full rounded-xl border border-brown-light/40 bg-cream-light px-4 py-3 text-sm text-brown-dark placeholder:text-brown-medium/80 focus:border-brown-primary focus:outline-none focus:ring-2 focus:ring-brown-primary/30"></textarea>
                </div>

                <div>
                    <label for="edit-gambar" class="mb-2 block text-sm font-semibold text-brown-dark">Ganti Foto <span
                            class="font-normal text-brown-medium">(opsional)</span></label>
                    <input type="file" name="gambar" id="edit-gambar" accept="image/*"
                        class="block w-full rounded-xl border border-brown-light/40 bg-cream-light px-3 py-2 text-sm text-brown-dark file:mr-3 file:rounded-lg file:border-0 file:bg-brown-primary file:px-3 file:py-2 file:text-xs file:font-semibold file:text-white hover:file:bg-brown-dark focus:outline-none focus:ring-2 focus:ring-brown-primary/30" />
                </div>

                {{-- Modal Actions --}}
                <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end pt-2">
                    <button type="button" onclick="closeEditModal()"
                        class="inline-flex items-center justify-center rounded-xl border border-brown-light/50 px-5 py-2.5 text-sm font-medium text-brown-dark hover:bg-cream-light transition-colors">
                        Batal
                    </button>
                    <button type="submit"
                        class="inline-flex items-center justify-center rounded-xl bg-brown-primary px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-brown-dark">
                        <i class="fas fa-save mr-2 text-xs"></i>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        const editModal = document.getElementById('edit-modal');
        const editForm = document.getElementById('edit-form');
        const editBackdrop = document.getElementById('edit-modal-backdrop');

        function openEditModal(id, judul, description) {
            editForm.action = '/admin/config/' + id;
            editForm.enctype = 'multipart/form-data';
            document.getElementById('edit-judul').value = judul;
            document.getElementById('edit-description').value = description;
            document.getElementById('edit-gambar').value = '';
            editModal.classList.remove('hidden');
            editModal.classList.add('flex');
        }

        function closeEditModal() {
            editModal.classList.add('hidden');
            editModal.classList.remove('flex');
        }

        editBackdrop?.addEventListener('click', closeEditModal);

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeEditModal();
        });
    </script>
@endpush
