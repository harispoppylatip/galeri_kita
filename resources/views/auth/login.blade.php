@extends('layouts.app')

@section('title', 'Login Admin — Haris & Balqis Gallery')

@section('content')
    <section class="min-h-[80vh] flex items-center justify-center py-12 px-4">
        <div class="w-full max-w-md">

            {{-- Header --}}
            <div class="text-center mb-8">
                <span class="text-brown-primary text-3xl">♡</span>
                <h1 class="font-script text-4xl text-brown-primary mt-2">Haris & Balqis</h1>
                <p class="font-heading text-sm text-brown-medium tracking-wider mt-1 uppercase">Admin Panel</p>
            </div>

            {{-- Error --}}
            @if ($errors->any())
                <div
                    class="mb-5 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700 flex items-center gap-2">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ $errors->first() }}
                </div>
            @endif

            {{-- Login Card --}}
            <div class="rounded-2xl border border-brown-light/30 bg-white/90 p-6 sm:p-8 shadow-sm">
                <form action="{{ route('login') }}" method="POST" class="space-y-5">
                    @csrf

                    {{-- Username --}}
                    <div>
                        <label for="username" class="mb-2 block text-sm font-semibold text-brown-dark">Username</label>
                        <div class="relative">
                            <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-brown-medium/50">
                                <i class="fas fa-user text-sm"></i>
                            </span>
                            <input type="text" name="username" id="username" value="{{ old('username') }}" required
                                autofocus placeholder="Username"
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
                            <input type="password" name="password" id="password" required placeholder="••••••••"
                                class="w-full rounded-xl border border-brown-light/40 bg-cream-light pl-10 pr-4 py-2.5 text-sm text-brown-dark placeholder:text-brown-medium/60 focus:border-brown-primary focus:outline-none focus:ring-2 focus:ring-brown-primary/30" />
                        </div>
                    </div>

                    {{-- Remember --}}
                    <div class="flex items-center justify-between">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="remember"
                                class="rounded border-brown-light/50 text-brown-primary focus:ring-brown-primary/30" />
                            <span class="text-sm text-brown-medium">Ingat saya</span>
                        </label>
                    </div>

                    {{-- Submit --}}
                    <button type="submit"
                        class="w-full inline-flex items-center justify-center gap-2 rounded-xl bg-brown-primary px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-brown-dark">
                        <i class="fas fa-sign-in-alt text-xs"></i>
                        Masuk
                    </button>
                </form>
            </div>

            <p class="mt-6 text-center text-xs text-brown-medium/60">
                &copy; {{ date('Y') }} Haris & Balqis Gallery
            </p>
        </div>
    </section>
@endsection
