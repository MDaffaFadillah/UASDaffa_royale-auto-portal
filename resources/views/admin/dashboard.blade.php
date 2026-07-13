@extends('layouts.app')

@section('title', 'Executive Control Panel | Royale Auto')

@section('content')
<section class="min-h-[85vh] py-16 px-4 bg-black relative overflow-hidden">
    {{-- Decorative subtle background --}}
    <div class="absolute inset-0 opacity-5 bg-[radial-gradient(#d97706_1px,transparent_1px)] [background-size:32px_32px]"></div>

    <div class="max-w-7xl mx-auto relative z-10 space-y-10">

        {{-- Flash message --}}
        @if (session('success'))
            <div class="p-4 bg-emerald-950/40 border border-emerald-500/30 rounded-xl text-emerald-400 text-xs tracking-wider flex items-center justify-between shadow-lg">
                <span>{{ session('success') }}</span>
                <span class="text-[10px] uppercase tracking-widest px-2 py-0.5 rounded bg-emerald-500/20 text-emerald-300">Updated</span>
            </div>
        @endif

        {{-- Executive Header --}}
        <div class="bg-zinc-950 border border-zinc-800/80 rounded-xl p-8 md:p-10 shadow-2xl relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-amber-500/10 rounded-full blur-3xl -mr-20 -mt-20 pointer-events-none"></div>

            <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                <div class="space-y-2">
                    <div class="flex items-center space-x-3">
                        <span class="px-3 py-1 bg-red-500/10 border border-red-500/30 text-red-400 text-[10px] uppercase tracking-[0.25em] font-semibold rounded-full">
                            Executive Access
                        </span>
                    </div>
                    <h1 class="text-3xl md:text-4xl font-serif text-white tracking-wide">
                        Control Panel
                    </h1>
                    <p class="text-xs text-zinc-400">Manage all VIP reservations, commissions, and client schedules.</p>
                </div>

                {{-- Stats --}}
                <div class="flex items-center space-x-6">
                    @php
                        $pending = $bookings->where('status', 'pending')->count();
                        $confirmed = $bookings->where('status', 'confirmed')->count();
                        $total = $bookings->count();
                    @endphp
                    <div class="text-center">
                        <span class="text-2xl font-serif text-white">{{ $total }}</span>
                        <span class="block text-[10px] uppercase tracking-widest text-zinc-500 mt-0.5">Total</span>
                    </div>
                    <div class="w-px h-10 bg-zinc-800"></div>
                    <div class="text-center">
                        <span class="text-2xl font-serif text-amber-400">{{ $pending }}</span>
                        <span class="block text-[10px] uppercase tracking-widest text-zinc-500 mt-0.5">Pending</span>
                    </div>
                    <div class="w-px h-10 bg-zinc-800"></div>
                    <div class="text-center">
                        <span class="text-2xl font-serif text-emerald-400">{{ $confirmed }}</span>
                        <span class="block text-[10px] uppercase tracking-widest text-zinc-500 mt-0.5">Confirmed</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Booking Queue --}}
        <div class="space-y-4">
            <div class="flex items-center justify-between border-b border-zinc-900 pb-4">
                <h2 class="text-2xl font-serif text-white tracking-wide">Reservation Queue</h2>
                <span class="text-xs text-amber-500 font-serif italic">{{ $bookings->count() }} Reservation(s)</span>
            </div>

            @if($bookings->isEmpty())
                <div class="bg-zinc-950 border border-zinc-800/60 rounded-xl p-12 text-center">
                    <p class="text-sm font-serif text-zinc-400">No reservations in the queue.</p>
                </div>
            @else
                <div class="space-y-4">
                    @foreach($bookings as $booking)
                        <div class="bg-zinc-950 border border-zinc-800/80 rounded-xl overflow-hidden hover:border-zinc-700 transition duration-300">
                            {{-- Booking Summary Row --}}
                            <div class="p-6 md:p-8 flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6">
                                {{-- Left: Booking Info --}}
                                <div class="space-y-2 flex-1 min-w-0">
                                    <div class="flex flex-wrap items-center gap-3">
                                        <h3 class="text-lg font-serif text-white truncate">
                                            {{ $booking->car->model_name ?? 'Unknown Vehicle' }}
                                        </h3>
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
                                        <p>
                                            <span class="text-zinc-500">Client:</span>
                                            <span class="text-white font-medium">{{ $booking->user->full_name ?? 'N/A' }}</span>
                                            <span class="text-zinc-600 ml-1">({{ $booking->user->email ?? '' }})</span>
                                        </p>
                                        <p>
                                            <span class="text-zinc-500">Type:</span>
                                            <span class="text-amber-500 font-serif">{{ ucwords(str_replace('_', ' ', $booking->booking_type)) }}</span>
                                        </p>
                                        <p>
                                            <span class="text-zinc-500">Scheduled:</span>
                                            <span class="text-white font-medium">{{ $booking->preferred_datetime ? $booking->preferred_datetime->format('F d, Y • H:i') : '-' }}</span>
                                        </p>
                                        @if($booking->notes)
                                            <p class="text-zinc-500 italic">"{{ $booking->notes }}"</p>
                                        @endif
                                        @if($booking->admin_notes)
                                            <p class="text-amber-500/70 text-[11px]">
                                                <span class="text-zinc-500">Admin Note:</span> {{ $booking->admin_notes }}
                                            </p>
                                        @endif
                                    </div>
                                </div>

                                {{-- Right: Admin Control Form --}}
                                <div class="w-full lg:w-auto lg:min-w-[360px] bg-zinc-900/50 border border-zinc-800 rounded-lg p-5 space-y-4">
                                    <p class="text-[10px] uppercase tracking-[0.2em] text-zinc-500 font-semibold">Executive Action</p>

                                    <form action="{{ route('admin.booking.update', $booking->id) }}" method="POST" class="space-y-3">
                                        @csrf
                                        @method('PUT')

                                        <div>
                                            <label class="block text-[10px] uppercase tracking-wider text-zinc-400 mb-1">Status</label>
                                            <select name="status"
                                                class="w-full px-3 py-2 bg-zinc-900 border border-zinc-700 rounded-lg text-white text-xs focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 transition duration-300">
                                                <option value="pending" {{ $booking->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="confirmed" {{ $booking->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                                <option value="rescheduled" {{ $booking->status === 'rescheduled' ? 'selected' : '' }}>Rescheduled</option>
                                                <option value="rejected" {{ $booking->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                                            </select>
                                        </div>

                                        <div>
                                            <label class="block text-[10px] uppercase tracking-wider text-zinc-400 mb-1">Corrected Date & Time</label>
                                            <input type="datetime-local" name="preferred_datetime"
                                                value="{{ $booking->preferred_datetime ? $booking->preferred_datetime->format('Y-m-d\TH:i') : '' }}"
                                                class="w-full px-3 py-2 bg-zinc-900 border border-zinc-700 rounded-lg text-white text-xs focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 transition duration-300 [color-scheme:dark]">
                                        </div>

                                        <div>
                                            <label class="block text-[10px] uppercase tracking-wider text-zinc-400 mb-1">Admin Notes (Optional)</label>
                                            <input type="text" name="admin_notes"
                                                value="{{ $booking->admin_notes }}"
                                                placeholder="Internal remarks..."
                                                class="w-full px-3 py-2 bg-zinc-900 border border-zinc-700 rounded-lg text-white placeholder-zinc-600 text-xs focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 transition duration-300">
                                        </div>

                                        <button type="submit"
                                            class="w-full py-2.5 bg-amber-500 hover:bg-amber-400 text-black font-bold text-[10px] uppercase tracking-[0.2em] rounded-lg transition duration-300 shadow-lg shadow-amber-500/20 hover:shadow-amber-500/40">
                                            APPLY CHANGES
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

    </div>
</section>
@endsection
