@extends('layouts.app')

@section('title', 'Reschedule Experience | ' . ($booking->car->model_name ?? 'Royale Auto'))

@section('content')
<section class="min-h-[85vh] py-16 px-4 bg-black relative overflow-hidden">
    {{-- Decorative subtle background --}}
    <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#d97706_1px,transparent_1px)] [background-size:32px_32px]"></div>
    <div class="absolute top-0 right-0 w-96 h-96 bg-amber-500/5 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-3xl mx-auto relative z-10">
        <div class="mb-8 text-center">
            <p class="text-[10px] tracking-[0.3em] text-amber-500 uppercase font-semibold mb-2">Private Commission</p>
            <h1 class="text-3xl md:text-4xl font-serif text-white tracking-wide">Reschedule Reservation</h1>
        </div>

        <div class="bg-zinc-950 border border-zinc-800/80 rounded-xl shadow-2xl backdrop-blur-md overflow-hidden">
            {{-- Selected Car Header Banner --}}
            <div class="p-6 md:p-8 border-b border-zinc-900 bg-zinc-900/40 flex flex-col md:flex-row items-center justify-between gap-4">
                <div>
                    <span class="text-[10px] uppercase tracking-widest text-zinc-500">Reserved Masterpiece</span>
                    <h3 class="text-xl font-serif text-white">{{ $booking->car->model_name ?? 'Automotive Masterpiece' }}</h3>
                    <p class="text-xs text-amber-500 uppercase tracking-wider mt-1">
                        {{ str_replace('_', ' ', $booking->booking_type) }}
                    </p>
                </div>
                <div class="text-right">
                    <span class="text-[10px] uppercase tracking-widest text-zinc-500 block">Current Status</span>
                    <span class="inline-block mt-1 px-2.5 py-0.5 text-[10px] uppercase tracking-wider font-semibold rounded bg-amber-500/10 text-amber-400 border border-amber-500/30">
                        {{ $booking->status }}
                    </span>
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

                <form action="{{ route('booking.update', $booking->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="preferred_datetime" class="block text-xs font-medium tracking-wider text-zinc-300 uppercase mb-2">
                            New Preferred Date & Time
                        </label>
                        <input type="datetime-local" id="preferred_datetime" name="preferred_datetime"
                            value="{{ old('preferred_datetime', $booking->preferred_datetime ? $booking->preferred_datetime->format('Y-m-d\TH:i') : '') }}" required
                            class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 rounded-lg text-white text-sm focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 transition duration-300 [color-scheme:dark]">
                    </div>

                    <div>
                        <label for="notes" class="block text-xs font-medium tracking-wider text-zinc-300 uppercase mb-2">
                            Updated Bespoke Requests & Preferences (Optional)
                        </label>
                        <textarea id="notes" name="notes" rows="4"
                            placeholder="Specify any preferences regarding bespoke palettes, leather upholstery, or concierge refreshments..."
                            class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 rounded-lg text-white placeholder-zinc-600 text-sm focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 transition duration-300">{{ old('notes', $booking->notes) }}</textarea>
                    </div>

                    <div class="pt-4 flex flex-col md:flex-row items-center justify-end gap-4 border-t border-zinc-900">
                        <a href="{{ route('profile') }}" class="text-xs uppercase tracking-widest text-zinc-400 hover:text-white transition">
                            Back to Profile
                        </a>
                        <button type="submit"
                            class="w-full md:w-auto px-8 py-3.5 bg-amber-500 hover:bg-amber-400 text-black font-bold text-xs uppercase tracking-[0.25em] rounded-lg transition duration-300 shadow-lg shadow-amber-500/20 hover:shadow-amber-500/40">
                            UPDATE RESERVATION
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
