@extends('layouts.admin')

@section('title', 'Tambah Admin — Admin')
@section('page-title', 'Tambah Admin')

@section('content')

    <div class="max-w-2xl mx-auto">

        <div class="mb-6">
            <a href="{{ route('admin.users.index') }}"
                class="inline-flex items-center gap-1.5 text-sm text-brown-medium hover:text-brown-primary transition-colors">
                <i class="fas fa-arrow-left text-xs"></i>
                Kembali ke Daftar Admin
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
            <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-5">
                @csrf

                {{-- Name --}}
                <div>
                    <label for="name" class="mb-2 block text-sm font-semibold text-brown-dark">Nama</label>
                    <div class="relative">
                        <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-brown-medium/50">
                            <i class="fas fa-user text-sm"></i>
                        </span>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required
                            placeholder="Nama lengkap"
                            class="w-full rounded-xl border border-brown-light/40 bg-cream-light pl-10 pr-4 py-2.5 text-sm text-brown-dark placeholder:text-brown-medium/60 focus:border-brown-primary focus:outline-none focus:ring-2 focus:ring-brown-primary/30" />
                    </div>
                </div>

                {{-- Username --}}
                <div>
                    <label for="username" class="mb-2 block text-sm font-semibold text-brown-dark">Username</label>
                    <div class="relative">
                        <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-brown-medium/50">
                            <i class="fas fa-at text-sm"></i>
                        </span>
                        <input type="text" name="username" id="username" value="{{ old('username') }}" required
                            placeholder="username"
                            class="w-full rounded-xl border border-brown-light/40 bg-cream-light pl-10 pr-4 py-2.5 text-sm text-brown-dark placeholder:text-brown-medium/60 focus:border-brown-primary focus:outline-none focus:ring-2 focus:ring-brown-primary/30" />
                    </div>
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="mb-2 block text-sm font-semibold text-brown-dark">Email</label>
                    <div class="relative">
                        <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-brown-medium/50">
                            <i class="fas fa-envelope text-sm"></i>
                        </span>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required
                            placeholder="admin@example.com"
                            class="w-full rounded-xl border border-brown-light/40 bg-cream-light pl-10 pr-4 py-2.5 text-sm text-brown-dark placeholder:text-brown-medium/60 focus:border-brown-primary focus:outline-none focus:ring-2 focus:ring-brown-primary/30" />
                    </div>
                </div>

                {{-- Password --}}
                <div>
                    <label for="password" class="mb-2 block text-sm font-semibold text-brown-dark">Password</label>
                    <div class="relative">
                        <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-brown-medium/50">
                            <i class="fas fa-lock text-sm"></i>
                        </span>
                        <input type="password" name="password" id="password" required placeholder="Minimal 8 karakter"
                            class="w-full rounded-xl border border-brown-light/40 bg-cream-light pl-10 pr-4 py-2.5 text-sm text-brown-dark placeholder:text-brown-medium/60 focus:border-brown-primary focus:outline-none focus:ring-2 focus:ring-brown-primary/30" />
                    </div>
                </div>

                {{-- Confirm Password --}}
                <div>
                    <label for="password_confirmation" class="mb-2 block text-sm font-semibold text-brown-dark">Konfirmasi
                        Password</label>
                    <div class="relative">
                        <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-brown-medium/50">
                            <i class="fas fa-lock text-sm"></i>
                        </span>
                        <input type="password" name="password_confirmation" id="password_confirmation" required
                            placeholder="Ulangi password"
                            class="w-full rounded-xl border border-brown-light/40 bg-cream-light pl-10 pr-4 py-2.5 text-sm text-brown-dark placeholder:text-brown-medium/60 focus:border-brown-primary focus:outline-none focus:ring-2 focus:ring-brown-primary/30" />
                    </div>
                </div>

                {{-- Actions --}}
                <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end pt-2">
                    <a href="{{ route('admin.users.index') }}"
                        class="inline-flex items-center justify-center rounded-xl border border-brown-light/50 px-5 py-2.5 text-sm font-medium text-brown-dark hover:bg-cream-light transition-colors">
                        Batal
                    </a>
                    <button type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-brown-primary px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-brown-dark">
                        <i class="fas fa-user-plus text-xs"></i>
                        Tambah Admin
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
