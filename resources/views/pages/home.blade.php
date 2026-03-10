@extends('layouts.app')

@section('content')
    <section class="max-w-6xl mx-auto px-4 py-6">

        {{-- Masonry Gallery --}}
        <div class="columns-2 md:columns-3 lg:columns-4 gap-4">
            @foreach ($data as $item)
                <article class="mb-4 break-inside-avoid overflow-hidden rounded-xl shadow">
                    <img src="{{ 'storage/' . $item->nama }}"
                        class="w-full h-auto object-cover hover:scale-105 transition duration-300" loading="lazy">
                </article>
            @endforeach

        </div>

    </section>
@endsection
