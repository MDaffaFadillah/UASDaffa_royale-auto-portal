@extends('layouts.app')

@section('title', $car->model_name)

@section('content')

    {{-- ═══════════════════════════════════════════════════════════════
         HERO SECTION — Full-bleed cinematic image with overlay
    ═══════════════════════════════════════════════════════════════ --}}
    <section class="relative h-[65vh] md:h-[75vh] overflow-hidden bg-zinc-950">
        @if(!empty($car->gallery_images) && isset($car->gallery_images[0]))
            <img src="{{ asset('assets/images/' . $car->gallery_images[0]) }}"
                 alt="{{ $car->model_name }}"
                 class="absolute inset-0 w-full h-full object-cover opacity-60"
                 id="hero-img">
        @else
            <div class="absolute inset-0 bg-gradient-to-br from-zinc-900 to-black"></div>
        @endif

        {{-- Dark gradient overlay --}}
        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent"></div>

        {{-- Content --}}
        <div class="relative z-10 h-full flex flex-col justify-end pb-16 px-6 max-w-7xl mx-auto">
            <a href="{{ route('home') }}" class="absolute top-8 left-6 flex items-center gap-2 text-zinc-400 hover:text-amber-500 transition text-xs uppercase tracking-widest group">
                <svg class="w-4 h-4 transition group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Back to Fleet
            </a>

            <p class="text-[10px] md:text-xs tracking-[0.4em] text-amber-500 uppercase font-semibold mb-3" id="hero-tagline">
                {{ $car->tag_line }}
            </p>
            <h1 class="text-4xl md:text-7xl font-serif text-white tracking-wide leading-tight font-bold" id="hero-title">
                {{ $car->model_name }}
            </h1>

            {{-- Status & Price badges --}}
            <div class="flex flex-wrap items-center gap-4 mt-6">
                <span class="text-[10px] px-3 py-1 bg-amber-500/10 text-amber-400 border border-amber-500/20 rounded-full uppercase tracking-wider font-semibold">
                    {{ str_replace('_', ' ', $car->availability_status) }}
                </span>
                <span class="text-[10px] px-3 py-1 bg-white/5 text-zinc-300 border border-white/10 rounded-full uppercase tracking-wider font-medium">
                    IDR {{ number_format($car->indicative_price, 0, ',', '.') }}
                </span>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════════════════════════
         DESCRIPTION SECTION
    ═══════════════════════════════════════════════════════════════ --}}
    <section class="py-20 bg-black border-t border-white/5">
        <div class="max-w-5xl mx-auto px-6">
            <div class="grid md:grid-cols-12 gap-12 items-start">
                <div class="md:col-span-4">
                    <p class="text-[10px] tracking-[0.3em] text-amber-500 uppercase font-semibold mb-2">The Story</p>
                    <h2 class="text-2xl md:text-3xl font-serif text-white tracking-wide">Beyond Words</h2>
                </div>
                <div class="md:col-span-8">
                    <p class="text-zinc-400 leading-relaxed text-sm md:text-base font-light">
                        {{ $car->description }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════════════════════════
         ENGINE SPECS SECTION — Dynamic key-value grid from JSON
    ═══════════════════════════════════════════════════════════════ --}}
    @if(!empty($car->engine_specs))
    <section class="py-20 bg-zinc-950/50 border-t border-white/5">
        <div class="max-w-5xl mx-auto px-6">
            <div class="text-center mb-14">
                <p class="text-[10px] tracking-[0.3em] text-amber-500 uppercase font-semibold mb-2">Performance</p>
                <h2 class="text-2xl md:text-3xl font-serif text-white tracking-wide">Engine Specifications</h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($car->engine_specs as $key => $value)
                    <div class="bg-zinc-900/60 border border-zinc-800 rounded-lg p-6 hover:border-amber-500/30 transition duration-500 group">
                        <p class="text-[10px] tracking-[0.25em] text-zinc-500 uppercase font-bold mb-2 group-hover:text-amber-500/70 transition">
                            {{ ucwords(str_replace(['_', '-'], ' ', $key)) }}
                        </p>
                        <p class="text-xl md:text-2xl font-serif text-white font-semibold">
                            {{ $value }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- ═══════════════════════════════════════════════════════════════
         GALLERY SECTION — Additional images (if more than 1)
    ═══════════════════════════════════════════════════════════════ --}}
    @if(!empty($car->gallery_images) && count($car->gallery_images) > 1)
    <section class="py-20 bg-black border-t border-white/5">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-14">
                <p class="text-[10px] tracking-[0.3em] text-amber-500 uppercase font-semibold mb-2">Gallery</p>
                <h2 class="text-2xl md:text-3xl font-serif text-white tracking-wide">Every Angle, A Masterpiece</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach(array_slice($car->gallery_images, 1) as $image)
                    <div class="aspect-video overflow-hidden rounded-lg border border-zinc-800 bg-zinc-950 group">
                        <img src="{{ asset('assets/images/' . $image) }}"
                             alt="{{ $car->model_name }} gallery"
                             class="w-full h-full object-cover opacity-70 group-hover:opacity-100 group-hover:scale-105 transition duration-700">
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- ═══════════════════════════════════════════════════════════════
         CTA SECTION — Bespoke booking
    ═══════════════════════════════════════════════════════════════ --}}
    <section class="py-24 bg-gradient-to-b from-black to-zinc-950 border-t border-white/5">
        <div class="max-w-3xl mx-auto px-6 text-center">
            <p class="text-[10px] tracking-[0.3em] text-amber-500 uppercase font-semibold mb-4">Exclusive Access</p>
            <h2 class="text-3xl md:text-4xl font-serif text-white tracking-wide mb-6">
                Make It Yours
            </h2>
            <p class="text-zinc-500 text-sm font-light mb-10 max-w-xl mx-auto">
                Every {{ $car->model_name }} is a statement of individuality. Begin your bespoke journey and craft a masterpiece that reflects your vision.
            </p>
            <a href="{{ route('booking.create', $car->id) }}"
               class="inline-block bg-gradient-to-r from-amber-500 to-amber-600 text-black px-10 py-4 text-xs uppercase tracking-[0.3em] font-bold hover:from-amber-400 hover:to-amber-500 transition duration-300 shadow-lg shadow-amber-500/20 hover:shadow-amber-500/40">
                BOOK BESPOKE EXPERIENCE
            </a>
        </div>
    </section>

@endsection

@push('scripts')
<script>
    // Inisialisasi Smooth Scroll (Lenis)
    const lenis = new Lenis()
    function raf(time) {
      lenis.raf(time)
      requestAnimationFrame(raf)
    }
    requestAnimationFrame(raf)

    // GSAP Animations
    gsap.from('#hero-title', {
        opacity: 0,
        y: 40,
        duration: 1.2,
        ease: 'power3.out',
        delay: 0.3
    });

    gsap.from('#hero-tagline', {
        opacity: 0,
        y: 20,
        duration: 1,
        ease: 'power3.out',
        delay: 0.1
    });

    gsap.from('#hero-img', {
        scale: 1.1,
        duration: 2,
        ease: 'power2.out'
    });
</script>
@endpush
