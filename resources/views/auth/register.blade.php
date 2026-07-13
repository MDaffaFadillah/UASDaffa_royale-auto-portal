@extends('layouts.app')

@section('title', 'VIP Lounge | Registration')

@section('content')
<section class="min-h-[85vh] flex items-center justify-center py-16 px-4 bg-black relative overflow-hidden">
    {{-- Decorative subtle background elements --}}
    <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#d97706_1px,transparent_1px)] [background-size:32px_32px]"></div>
    <div class="absolute -top-24 -right-24 w-96 h-96 bg-amber-500/5 rounded-full blur-3xl pointer-events-none"></div>

    <div class="w-full max-w-lg relative z-10">
        {{-- Luxury card --}}
        <div class="bg-zinc-950 border border-zinc-800/80 p-8 md:p-10 rounded-xl shadow-2xl backdrop-blur-md">
            <div class="text-center mb-8">
                <p class="text-[10px] tracking-[0.3em] text-amber-500 uppercase font-semibold mb-2">Bespoke Membership</p>
                <h2 class="text-3xl font-serif text-white tracking-wide">VIP Registration</h2>
                <p class="text-xs text-zinc-400 mt-2 font-light">Join the exclusive circle of automotive connoisseurs</p>
            </div>

            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-950/40 border border-red-500/30 rounded-lg text-red-400 text-xs">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label for="full_name" class="block text-xs font-medium tracking-wider text-zinc-300 uppercase mb-2">
                        Full Name
                    </label>
                    <input type="text" id="full_name" name="full_name" value="{{ old('full_name') }}" required autofocus
                        placeholder="Sir Arthur Pendelton"
                        class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 rounded-lg text-white placeholder-zinc-600 text-sm focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 transition duration-300">
                </div>

                <div>
                    <label for="email" class="block text-xs font-medium tracking-wider text-zinc-300 uppercase mb-2">
                        Email Address
                    </label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required
                        placeholder="arthur@pendelton.com"
                        class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 rounded-lg text-white placeholder-zinc-600 text-sm focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 transition duration-300">
                </div>

                <div>
                    <label for="phone_number" class="block text-xs font-medium tracking-wider text-zinc-300 uppercase mb-2">
                        Phone Number
                    </label>
                    <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number') }}"
                        placeholder="+62 811 8888 9999"
                        class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 rounded-lg text-white placeholder-zinc-600 text-sm focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 transition duration-300">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="password" class="block text-xs font-medium tracking-wider text-zinc-300 uppercase mb-2">
                            Password
                        </label>
                        <input type="password" id="password" name="password" required
                            placeholder="••••••••"
                            class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 rounded-lg text-white placeholder-zinc-600 text-sm focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 transition duration-300">
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-xs font-medium tracking-wider text-zinc-300 uppercase mb-2">
                            Confirm Password
                        </label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required
                            placeholder="••••••••"
                            class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 rounded-lg text-white placeholder-zinc-600 text-sm focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 transition duration-300">
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit"
                        class="w-full py-3.5 bg-amber-500 hover:bg-amber-400 text-black font-bold text-xs uppercase tracking-[0.25em] rounded-lg transition duration-300 shadow-lg shadow-amber-500/20 hover:shadow-amber-500/40">
                        APPLY FOR MEMBERSHIP
                    </button>
                </div>
            </form>

            <div class="mt-8 pt-6 border-t border-zinc-900 text-center">
                <p class="text-xs text-zinc-400">
                    Already a Member?
                    <a href="{{ route('login') }}" class="text-amber-500 hover:text-amber-400 transition ml-1 font-medium underline underline-offset-4">
                        Sign In to VIP Lounge
                    </a>
                </p>
            </div>
        </div>
    </div>
</section>
@endsection
