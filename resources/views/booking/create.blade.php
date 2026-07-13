@extends('layouts.app')

@section('title', 'Bespoke Reservation | ' . $car->model_name)

@section('content')
<section class="min-h-[85vh] py-16 px-4 bg-black relative overflow-hidden">
    {{-- Decorative subtle background --}}
    <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#d97706_1px,transparent_1px)] [background-size:32px_32px]"></div>
    <div class="absolute top-0 right-0 w-96 h-96 bg-amber-500/5 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-3xl mx-auto relative z-10">
        <div class="mb-8 text-center">
            <p class="text-[10px] tracking-[0.3em] text-amber-500 uppercase font-semibold mb-2">Private Commission</p>
            <h1 class="text-3xl md:text-4xl font-serif text-white tracking-wide">Schedule Your Experience</h1>
        </div>

        <div class="bg-zinc-950 border border-zinc-800/80 rounded-xl shadow-2xl backdrop-blur-md overflow-hidden">
            {{-- Selected Car Header Banner --}}
            <div class="p-6 md:p-8 border-b border-zinc-900 bg-zinc-900/40 flex flex-col md:flex-row items-center justify-between gap-4">
                <div>
                    <span class="text-[10px] uppercase tracking-widest text-zinc-500">Selected Masterpiece</span>
                    <h3 class="text-xl font-serif text-white">{{ $car->model_name }}</h3>
                    <p class="text-xs text-amber-500 italic font-serif mt-0.5">"{{ $car->tag_line }}"</p>
                </div>
                <div class="text-right">
                    <span class="text-[10px] uppercase tracking-widest text-zinc-500 block">Indicative Price</span>
                    <span class="text-sm font-semibold text-zinc-300">Rp {{ number_format($car->indicative_price, 0, ',', '.') }}</span>
                </div>
            </div>

            <div class="p-6 md:p-10">
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-950/40 border border-red-500/30 rounded-lg text-red-400 text-xs">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('booking.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <input type="hidden" name="car_id" value="{{ $car->id }}">

                    <div>
                        <label class="block text-xs font-medium tracking-wider text-zinc-300 uppercase mb-3">
                            Experience Type
                        </label>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <label class="relative flex items-start p-4 bg-zinc-900/60 border border-zinc-800 rounded-lg cursor-pointer hover:border-amber-500/50 transition duration-300">
                                <input type="radio" name="booking_type" value="bespoke_configuration" class="mt-1 text-amber-500 focus:ring-amber-500 bg-zinc-900 border-zinc-700" {{ old('booking_type', 'bespoke_configuration') === 'bespoke_configuration' ? 'checked' : '' }} required>
                                <div class="ml-3">
                                    <span class="block text-sm font-serif text-white">Bespoke Configuration</span>
                                    <span class="block text-xs text-zinc-400 mt-1">One-on-one consultation with our design specialist to customize finishes and materials.</span>
                                </div>
                            </label>

                            <label class="relative flex items-start p-4 bg-zinc-900/60 border border-zinc-800 rounded-lg cursor-pointer hover:border-amber-500/50 transition duration-300">
                                <input type="radio" name="booking_type" value="test_drive" class="mt-1 text-amber-500 focus:ring-amber-500 bg-zinc-900 border-zinc-700" {{ old('booking_type') === 'test_drive' ? 'checked' : '' }}>
                                <div class="ml-3">
                                    <span class="block text-sm font-serif text-white">Private Test Drive</span>
                                    <span class="block text-xs text-zinc-400 mt-1">Exclusive chauffeured or self-drive session on scenic curated routes.</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <div>
                        <label for="preferred_datetime" class="block text-xs font-medium tracking-wider text-zinc-300 uppercase mb-2">
                            Preferred Date & Time
                        </label>
                        <input type="datetime-local" id="preferred_datetime" name="preferred_datetime" value="{{ old('preferred_datetime', now()->addDays(2)->format('Y-m-d\TH:00')) }}" required
                            class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 rounded-lg text-white text-sm focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 transition duration-300 [color-scheme:dark]">
                    </div>

                    <div>
                        <label for="notes" class="block text-xs font-medium tracking-wider text-zinc-300 uppercase mb-2">
                            Bespoke Requests & Preferences (Optional)
                        </label>
                        <textarea id="notes" name="notes" rows="4"
                            placeholder="Specify any preferences regarding bespoke palettes, leather upholstery, or concierge refreshments..."
                            class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 rounded-lg text-white placeholder-zinc-600 text-sm focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 transition duration-300">{{ old('notes') }}</textarea>
                    </div>

                    <div class="pt-4 flex flex-col md:flex-row items-center justify-end gap-4 border-t border-zinc-900">
                        <a href="{{ route('car.detail', $car->id) }}" class="text-xs uppercase tracking-widest text-zinc-400 hover:text-white transition">
                            Cancel
                        </a>
                        <button type="submit"
                            class="w-full md:w-auto px-8 py-3.5 bg-amber-500 hover:bg-amber-400 text-black font-bold text-xs uppercase tracking-[0.25em] rounded-lg transition duration-300 shadow-lg shadow-amber-500/20 hover:shadow-amber-500/40">
                            CONFIRM RESERVATION
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
