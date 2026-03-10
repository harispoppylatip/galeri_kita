@extends('layouts.admin')

@section('title', 'Kelola Admin — Admin')
@section('page-title', 'Kelola Admin')

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

    <div class="max-w-4xl mx-auto">

        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
            <div>
                <p class="text-sm text-brown-medium">Kelola akun admin yang memiliki akses ke panel ini.</p>
            </div>
            <a href="{{ route('admin.users.create') }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-brown-primary px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-brown-dark shrink-0">
                <i class="fas fa-plus text-xs"></i>
                Tambah Admin
            </a>
        </div>

        {{-- Admin List --}}
        <div class="rounded-2xl border border-brown-light/30 bg-white/90 shadow-sm overflow-hidden">
            <div class="divide-y divide-brown-light/15">
                @forelse ($admins as $admin)
                    <div class="p-4 sm:p-5 flex flex-col sm:flex-row sm:items-center gap-4">
                        {{-- Avatar --}}
                        <div class="w-12 h-12 rounded-full bg-brown-primary/10 flex items-center justify-center shrink-0">
                            <span
                                class="text-lg font-bold text-brown-primary">{{ strtoupper(substr($admin->name, 0, 1)) }}</span>
                        </div>

                        {{-- Info --}}
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2">
                                <p class="font-medium text-brown-dark truncate">{{ $admin->name }}</p>
                                @if ($admin->id === auth()->id())
                                    <span
                                        class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-semibold bg-brown-primary/10 text-brown-primary">
                                        Anda
                                    </span>
                                @endif
                            </div>
                            <p class="text-sm text-brown-medium truncate">{{ $admin->username }}</p>
                            <p class="text-xs text-brown-medium/60 mt-0.5">Bergabung
                                {{ $admin->created_at->format('d M Y') }}</p>
                        </div>

                        {{-- Actions --}}
                        <div class="flex items-center gap-2 shrink-0">
                            <a href="{{ route('admin.users.edit', $admin->id) }}"
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-medium bg-brown-primary/10 text-brown-primary hover:bg-brown-primary hover:text-white transition-colors">
                                <i class="fas fa-edit text-[10px]"></i>
                                Edit
                            </a>
                            @if ($admin->id !== auth()->id())
                                <form action="{{ route('admin.users.destroy', $admin->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus admin ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-medium bg-red-50 text-red-600 hover:bg-red-600 hover:text-white transition-colors">
                                        <i class="fas fa-trash-alt text-[10px]"></i>
                                        Hapus
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="p-8 text-center">
                        <div class="w-14 h-14 rounded-full bg-cream-dark flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-users text-xl text-brown-light"></i>
                        </div>
                        <p class="text-sm text-brown-medium">Belum ada admin.</p>
                    </div>
                @endforelse
            </div>

            @if ($admins->hasPages())
                <div class="px-4 sm:px-5 py-4 border-t border-brown-light/20">
                    {{ $admins->links() }}
                </div>
            @endif
        </div>
    </div>

@endsection
