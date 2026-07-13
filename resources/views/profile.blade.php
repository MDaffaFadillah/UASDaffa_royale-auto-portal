@extends('layouts.app')

@section('title', 'VIP Profile | ' . Auth::user()->full_name)

@section('content')
<section class="min-h-[85vh] py-16 px-4 bg-black relative overflow-hidden">
    {{-- Decorative subtle background --}}
    <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#d97706_1px,transparent_1px)] [background-size:32px_32px]"></div>
    <div class="absolute top-0 right-0 w-96 h-96 bg-amber-500/5 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-6xl mx-auto relative z-10 space-y-12">
        
        {{-- Flash message --}}
        @if (session('success'))
            <div class="p-4 bg-emerald-950/40 border border-emerald-500/30 rounded-xl text-emerald-400 text-xs tracking-wider flex items-center justify-between shadow-lg">
                <span>{{ session('success') }}</span>
                <span class="text-[10px] uppercase tracking-widest px-2 py-0.5 rounded bg-emerald-500/20 text-emerald-300">Success</span>
            </div>
        @endif

        {{-- VIP Member Identity Card --}}
        <div class="bg-zinc-950 border border-zinc-800/80 rounded-xl p-8 md:p-10 shadow-2xl backdrop-blur-md relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-amber-500/10 rounded-full blur-3xl -mr-20 -mt-20 pointer-events-none"></div>
            
            <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                <div class="space-y-2">
                    <div class="flex items-center space-x-3">
                        <span class="px-3 py-1 bg-amber-500/10 border border-amber-500/30 text-amber-400 text-[10px] uppercase tracking-[0.25em] font-semibold rounded-full">
                            Bespoke Circle Member
                        </span>
                    </div>
                    <h1 class="text-3xl md:text-4xl font-serif text-white tracking-wide">
                        {{ Auth::user()->full_name }}
                    </h1>
                    <div class="flex flex-wrap items-center gap-4 text-xs text-zinc-400 pt-1">
                        <span class="flex items-center space-x-1">
                            <span class="text-amber-500 font-medium">Email:</span>
                            <span>{{ Auth::user()->email }}</span>
                        </span>
                        @if(Auth::user()->phone_number)
                            <span class="text-zinc-600">•</span>
                            <span class="flex items-center space-x-1">
                                <span class="text-amber-500 font-medium">Phone:</span>
                                <span>{{ Auth::user()->phone_number }}</span>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="flex items-center space-x-4">
                    <a href="{{ route('home') }}" class="px-6 py-3 border border-amber-500/50 text-amber-500 hover:bg-amber-500 hover:text-black transition duration-300 rounded-lg text-xs uppercase tracking-widest font-bold">
                        Browse Catalogue
                    </a>
                </div>
            </div>
        </div>

        {{-- VIP Reservations Grid / Table --}}
        <div class="space-y-6">
            <div class="flex items-center justify-between border-b border-zinc-900 pb-4">
                <div>
                    <h2 class="text-2xl font-serif text-white tracking-wide">Your Exclusive Reservations</h2>
                    <p class="text-xs text-zinc-400 mt-1">Manage your upcoming Bespoke Commissions & Private Test Drives</p>
                </div>
                <span class="text-xs text-amber-500 font-serif italic">{{ $bookings->count() }} Commission(s)</span>
            </div>

            @if($bookings->isEmpty())
                <div class="bg-zinc-950 border border-zinc-800/60 rounded-xl p-12 text-center space-y-4">
                    <p class="text-sm font-serif text-zinc-400">You have no active Bespoke Commissions or Test Drive bookings.</p>
                    <a href="{{ route('home') }}" class="inline-block px-8 py-3.5 bg-amber-500 hover:bg-amber-400 text-black font-bold text-xs uppercase tracking-[0.25em] rounded-lg transition duration-300 shadow-lg shadow-amber-500/20">
                        COMMISSION A ROLLS-ROYCE
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 gap-6">
                    @foreach($bookings as $booking)
                        <div class="bg-zinc-950 border border-zinc-800/80 rounded-xl p-6 md:p-8 hover:border-zinc-700 transition duration-300 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                            <div class="space-y-3 max-w-xl">
                                <div class="flex flex-wrap items-center gap-3">
                                    <h3 class="text-xl font-serif text-white">
                                        {{ $booking->car->model_name ?? 'Bespoke Masterpiece' }}
                                    </h3>

                                    {{-- Status Badge --}}
                                    @php
                                        $badgeStyles = match($booking->status) {
                                            'confirmed' => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/30',
                                            'rescheduled' => 'bg-blue-500/10 text-blue-400 border-blue-500/30',
                                            'rejected' => 'bg-red-500/10 text-red-400 border-red-500/30',
                                            default => 'bg-amber-500/10 text-amber-400 border-amber-500/30',
                                        };
                                    @endphp
                                    <span class="px-2.5 py-0.5 text-[10px] uppercase tracking-widest font-semibold rounded border {{ $badgeStyles }}">
                                        {{ $booking->status }}
                                    </span>
                                </div>

                                <div class="text-xs text-zinc-400 space-y-1">
                                    <p class="text-amber-500 font-serif">
                                        {{ ucwords(str_replace('_', ' ', $booking->booking_type)) }}
                                    </p>
                                    <p>
                                        <span class="text-zinc-500">Scheduled for:</span> 
                                        <span class="text-white font-medium">{{ $booking->preferred_datetime ? $booking->preferred_datetime->format('F d, Y • H:i') : '-' }}</span>
                                    </p>
                                    @if($booking->notes)
                                        <p class="text-zinc-500 italic pt-1">
                                            "{{ $booking->notes }}"
                                        </p>
                                    @endif
                                </div>
                            </div>

                            <div class="flex items-center space-x-3 w-full md:w-auto justify-end border-t md:border-t-0 pt-4 md:pt-0 border-zinc-900">
                                <a href="{{ route('booking.edit', $booking->id) }}"
                                   class="px-5 py-2.5 bg-zinc-900 hover:bg-zinc-800 text-white border border-zinc-700 hover:border-amber-500/50 rounded-lg text-xs uppercase tracking-widest transition duration-300">
                                    Reschedule
                                </a>

                                <form action="{{ route('booking.destroy', $booking->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this reservation?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-5 py-2.5 bg-red-950/30 hover:bg-red-900/50 text-red-400 border border-red-500/30 hover:border-red-500 rounded-lg text-xs uppercase tracking-widest transition duration-300">
                                        Cancel Booking
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

    </div>
</section>
@endsection
