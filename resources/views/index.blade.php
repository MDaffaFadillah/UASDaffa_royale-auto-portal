@extends('layouts.app')

@section('title', 'Welcome to Elegance')

@section('content')
    <section class="h-[85vh] flex items-center justify-center relative overflow-hidden bg-black">
        <video autoplay muted loop playsinline class="absolute inset-0 w-full h-full object-cover opacity-40">
            <source src="{{ asset('assets/videos/SPECTRE(VIDEO2).mp4') }}" type="video/mp4">
        </video>
        <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black"></div>
        
        <div class="z-10 text-center px-4">
            <h2 class="text-5xl md:text-7xl font-serif text-white mb-4 tracking-wide" id="hero-title">
                Beyond Luxury
            </h2>
            <p class="text-xs md:text-sm tracking-[0.3em] text-amber-500 uppercase font-light">
                Discover the Automotive Masterpieces
            </p>
        </div>
    </section>

    <section class="py-16 bg-black">
        <div class="max-w-7xl mx-auto px-6">
            
            <div class="mb-12 text-center md:text-left">
                <h2 class="text-2xl font-serif text-white mb-2 tracking-wide">The Fleet</h2>
                <p class="text-zinc-500 text-xs tracking-wider uppercase">Curated selection for the extraordinary</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($cars as $car)
                    <a href="{{ route('car.detail', $car->id) }}" class="block group bg-zinc-900/40 border border-zinc-800 p-5 rounded-lg hover:border-amber-500/40 transition duration-500">
                        
                        <div class="h-64 overflow-hidden mb-5 relative bg-zinc-950 rounded border border-zinc-800">
                            @if(!empty($car->gallery_images) && isset($car->gallery_images[0]))
                                <img src="{{ asset('assets/images/' . $car->gallery_images[0]) }}" 
                                     alt="{{ $car->model_name }}" 
                                     class="w-full h-full object-cover transition duration-700 group-hover:scale-105 opacity-80 group-hover:opacity-100">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-zinc-600 text-xs uppercase tracking-widest">
                                    No Image Available
                                </div>
                            @endif
                        </div>

                        <div class="px-1">
                            <h3 class="text-lg font-serif text-white mb-1 group-hover:text-amber-500 transition duration-300">
                                {{ $car->model_name }}
                            </h3>
                            <p class="text-zinc-400 text-xs italic mb-2 font-light">{{ $car->tag_line }}</p>
                            <p class="text-amber-500/90 text-sm font-semibold mt-2 font-mono mb-5">
                                Rp {{ number_format($car->indicative_price, 0, ',', '.') }}
                            </p>
                            
                            <div class="flex justify-between items-center pt-4 border-t border-zinc-800">
                                <span class="text-[10px] tracking-widest text-zinc-500 uppercase font-bold">Status</span>
                                <span class="text-[10px] px-2 py-0.5 bg-amber-500/10 text-amber-400 border border-amber-500/20 rounded uppercase tracking-wider font-semibold">
                                    {{ str_replace('_', ' ', $car->availability_status) }}
                                </span>
                            </div>
                        </div>

                    </a>
                @endforeach
            </div>

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

    // Efek Animasi Judul Hero GSAP
    gsap.from('#hero-title', { 
        opacity: 0, 
        y: 30, 
        duration: 1.2, 
        ease: 'power3.out', 
        delay: 0.2 
    });
</script>
@endpush