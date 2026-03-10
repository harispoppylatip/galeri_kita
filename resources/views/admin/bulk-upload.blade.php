@extends('layouts.admin')

@section('title', 'Upload Banyak Foto — Admin')
@section('page-title', 'Upload Banyak Foto')

@section('content')

    {{-- Flash Messages --}}
    @if (session('success'))
        <div
            class="mb-6 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700 flex items-center gap-2">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

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

    <div class="max-w-4xl mx-auto">

        <div class="mb-6 text-center sm:text-left">
            <p class="text-sm text-brown-medium">
                Pilih atau seret beberapa foto sekaligus. Kamu bisa menambahkan judul & deskripsi per foto sebelum mengirim.
            </p>
        </div>

        <form action="{{ route('admin.bulk-upload.store') }}" method="POST" enctype="multipart/form-data"
            id="bulk-upload-form">
            @csrf

            {{-- Drop Zone --}}
            <div id="drop-zone"
                class="relative rounded-2xl border-2 border-dashed border-brown-light/50 bg-white/90 p-8 sm:p-12 text-center transition-colors hover:border-brown-primary/50 cursor-pointer">

                <input type="file" name="photos_input" id="file-input" multiple accept="image/jpeg,image/png,image/jpg"
                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" />

                <div class="flex flex-col items-center gap-3">
                    <div class="w-16 h-16 rounded-full bg-brown-primary/10 flex items-center justify-center">
                        <i class="fas fa-cloud-upload-alt text-2xl text-brown-primary"></i>
                    </div>
                    <div>
                        <p class="font-heading text-lg text-brown-dark">Seret foto ke sini</p>
                        <p class="text-sm text-brown-medium mt-1">atau <span
                                class="text-brown-primary font-medium underline">klik untuk memilih</span></p>
                    </div>
                    <p class="text-xs text-brown-medium/60">JPG, PNG, JPEG — Maks. 5MB per foto</p>
                </div>
            </div>

            {{-- Preview List --}}
            <div id="preview-container" class="mt-6 space-y-4 hidden">

                {{-- Header --}}
                <div class="flex items-center justify-between">
                    <h2 class="font-heading text-lg text-brown-dark">
                        <span id="photo-count">0</span> Foto Dipilih
                    </h2>
                    <button type="button" id="clear-all-btn"
                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-medium bg-red-50 text-red-600 hover:bg-red-600 hover:text-white transition-colors">
                        <i class="fas fa-trash-alt text-[10px]"></i>
                        Hapus Semua
                    </button>
                </div>

                {{-- Photo Cards --}}
                <div id="preview-list" class="space-y-3"></div>

                {{-- Submit --}}
                <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end pt-4 border-t border-brown-light/20">
                    <a href="{{ route('admin.config') }}"
                        class="inline-flex items-center justify-center rounded-xl border border-brown-light/50 px-5 py-2.5 text-sm font-medium text-brown-dark hover:bg-cream-light transition-colors">
                        Batal
                    </a>
                    <button type="submit" id="submit-btn"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-brown-primary px-6 py-2.5 text-sm font-semibold text-white transition hover:bg-brown-dark disabled:opacity-50 disabled:cursor-not-allowed">
                        <i class="fas fa-upload text-xs"></i>
                        Upload <span id="submit-count">0</span> Foto
                    </button>
                </div>
            </div>

        </form>
    </div>

@endsection

@push('scripts')
    <script>
        const fileInput = document.getElementById('file-input');
        const dropZone = document.getElementById('drop-zone');
        const previewContainer = document.getElementById('preview-container');
        const previewList = document.getElementById('preview-list');
        const photoCount = document.getElementById('photo-count');
        const submitCount = document.getElementById('submit-count');
        const clearAllBtn = document.getElementById('clear-all-btn');
        const submitBtn = document.getElementById('submit-btn');
        const form = document.getElementById('bulk-upload-form');

        let selectedFiles = [];

        // Drag & Drop
        ['dragenter', 'dragover'].forEach(event => {
            dropZone.addEventListener(event, (e) => {
                e.preventDefault();
                dropZone.classList.add('border-brown-primary', 'bg-brown-primary/5');
            });
        });

        ['dragleave', 'drop'].forEach(event => {
            dropZone.addEventListener(event, (e) => {
                e.preventDefault();
                dropZone.classList.remove('border-brown-primary', 'bg-brown-primary/5');
            });
        });

        dropZone.addEventListener('drop', (e) => {
            const files = Array.from(e.dataTransfer.files).filter(f => f.type.startsWith('image/'));
            addFiles(files);
        });

        fileInput.addEventListener('change', () => {
            addFiles(Array.from(fileInput.files));
            fileInput.value = '';
        });

        function addFiles(files) {
            files.forEach(file => {
                if (file.size > 5 * 1024 * 1024) {
                    alert(file.name + ' melebihi batas 5MB dan tidak ditambahkan.');
                    return;
                }
                selectedFiles.push({
                    file: file,
                    id: Date.now() + Math.random(),
                    judul: file.name.replace(/\.[^/.]+$/, '').replace(/[-_]/g, ' '),
                    description: ''
                });
            });
            renderPreviews();
        }

        function removeFile(id) {
            selectedFiles = selectedFiles.filter(f => f.id !== id);
            renderPreviews();
        }

        clearAllBtn.addEventListener('click', () => {
            selectedFiles = [];
            renderPreviews();
        });

        function renderPreviews() {
            previewList.innerHTML = '';

            if (selectedFiles.length === 0) {
                previewContainer.classList.add('hidden');
                return;
            }

            previewContainer.classList.remove('hidden');
            photoCount.textContent = selectedFiles.length;
            submitCount.textContent = selectedFiles.length;

            selectedFiles.forEach((item, index) => {
                const card = document.createElement('div');
                card.className =
                    'rounded-2xl border border-brown-light/30 bg-white/90 p-4 shadow-sm flex flex-col sm:flex-row gap-4';

                const reader = new FileReader();
                reader.onload = (e) => {
                    card.innerHTML = `
                    <div class="w-full sm:w-32 h-32 rounded-xl overflow-hidden bg-cream-dark shrink-0">
                        <img src="${e.target.result}" alt="Preview" class="w-full h-full object-cover" />
                    </div>
                    <div class="flex-1 space-y-3 min-w-0">
                        <div>
                            <label class="mb-1 block text-xs font-semibold text-brown-dark">Judul</label>
                            <input type="text" data-index="${index}" data-field="judul" value="${escapeAttr(item.judul)}"
                                placeholder="Judul foto"
                                class="bulk-field w-full rounded-lg border border-brown-light/40 bg-cream-light px-3 py-2 text-sm text-brown-dark placeholder:text-brown-medium/60 focus:border-brown-primary focus:outline-none focus:ring-2 focus:ring-brown-primary/30" />
                        </div>
                        <div>
                            <label class="mb-1 block text-xs font-semibold text-brown-dark">Deskripsi <span class="font-normal text-brown-medium">(opsional)</span></label>
                            <input type="text" data-index="${index}" data-field="description" value="${escapeAttr(item.description)}"
                                placeholder="Deskripsi singkat..."
                                class="bulk-field w-full rounded-lg border border-brown-light/40 bg-cream-light px-3 py-2 text-sm text-brown-dark placeholder:text-brown-medium/60 focus:border-brown-primary focus:outline-none focus:ring-2 focus:ring-brown-primary/30" />
                        </div>
                        <div class="flex items-center justify-between">
                            <p class="text-xs text-brown-medium/60 truncate">${escapeHtml(item.file.name)} — ${formatSize(item.file.size)}</p>
                            <button type="button" data-remove-id="${item.id}"
                                class="remove-btn inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-[11px] font-medium bg-red-50 text-red-600 hover:bg-red-600 hover:text-white transition-colors shrink-0 ml-2">
                                <i class="fas fa-times text-[9px]"></i> Hapus
                            </button>
                        </div>
                    </div>
                `;

                    card.querySelectorAll('.bulk-field').forEach(input => {
                        input.addEventListener('input', function() {
                            const idx = parseInt(this.dataset.index);
                            const field = this.dataset.field;
                            if (selectedFiles[idx]) {
                                selectedFiles[idx][field] = this.value;
                            }
                        });
                    });

                    card.querySelector('.remove-btn')?.addEventListener('click', function() {
                        removeFile(parseFloat(this.dataset.removeId));
                    });
                };
                reader.readAsDataURL(item.file);

                previewList.appendChild(card);
            });
        }

        function escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }

        function escapeAttr(text) {
            return text.replace(/&/g, '&amp;').replace(/"/g, '&quot;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
        }

        function formatSize(bytes) {
            if (bytes < 1024) return bytes + ' B';
            if (bytes < 1024 * 1024) return (bytes / 1024).toFixed(1) + ' KB';
            return (bytes / (1024 * 1024)).toFixed(1) + ' MB';
        }

        // Submit via fetch with FormData
        form.addEventListener('submit', (e) => {
            e.preventDefault();

            if (selectedFiles.length === 0) {
                alert('Pilih minimal 1 foto untuk diupload.');
                return;
            }

            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin text-xs"></i> Mengupload...';

            const formData = new FormData();
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);

            selectedFiles.forEach((item, index) => {
                formData.append('photos[]', item.file);
                formData.append('juduls[]', item.judul);
                formData.append('descriptions[]', item.description);
            });

            fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.href = '{{ route('admin.config') }}';
                    } else {
                        alert(data.message || 'Terjadi kesalahan saat upload.');
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = '<i class="fas fa-upload text-xs"></i> Upload ' + selectedFiles
                            .length + ' Foto';
                    }
                })
                .catch(() => {
                    alert('Terjadi kesalahan jaringan. Coba lagi.');
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = '<i class="fas fa-upload text-xs"></i> Upload ' + selectedFiles
                        .length + ' Foto';
                });
        });
    </script>
@endpush
