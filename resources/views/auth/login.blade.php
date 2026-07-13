@extends('layouts.app')

@section('title', 'VIP Lounge | Access')

@section('content')
<section class="min-h-[85vh] flex items-center justify-center py-16 px-4 bg-black relative overflow-hidden">
    {{-- Decorative subtle background elements --}}
    <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#d97706_1px,transparent_1px)] [background-size:32px_32px]"></div>
    <div class="absolute -top-24 -left-24 w-96 h-96 bg-amber-500/5 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-amber-500/5 rounded-full blur-3xl pointer-events-none"></div>

    <div class="w-full max-w-md relative z-10">
        {{-- Luxury card --}}
        <div class="bg-zinc-950 border border-zinc-800/80 p-8 md:p-10 rounded-xl shadow-2xl backdrop-blur-md">
            <div class="text-center mb-8">
                <p class="text-[10px] tracking-[0.3em] text-amber-500 uppercase font-semibold mb-2">Exclusive Access</p>
                <h2 class="text-3xl font-serif text-white tracking-wide">VIP Lounge Login</h2>
                <p class="text-xs text-zinc-400 mt-2 font-light">Enter your credentials to access bespoke services</p>
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

            <form action="{{ route('login') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="email" class="block text-xs font-medium tracking-wider text-zinc-300 uppercase mb-2">
                        Email Address
                    </label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                        placeholder="vip@royaleauto.com"
                        class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 rounded-lg text-white placeholder-zinc-600 text-sm focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 transition duration-300">
                </div>

                <div>
                    <label for="password" class="block text-xs font-medium tracking-wider text-zinc-300 uppercase mb-2">
                        Password
                    </label>
                    <input type="password" id="password" name="password" required
                        placeholder="••••••••"
                        class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 rounded-lg text-white placeholder-zinc-600 text-sm focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 transition duration-300">
                </div>

                <div class="flex items-center justify-between text-xs">
                    <label class="flex items-center space-x-2 text-zinc-400 cursor-pointer">
                        <input type="checkbox" name="remember" class="rounded bg-zinc-900 border-zinc-800 text-amber-500 focus:ring-amber-500">
                        <span>Remember Me</span>
                    </label>
                </div>

                <button type="submit"
                    class="w-full py-3.5 bg-amber-500 hover:bg-amber-400 text-black font-bold text-xs uppercase tracking-[0.25em] rounded-lg transition duration-300 shadow-lg shadow-amber-500/20 hover:shadow-amber-500/40">
                    ENTER VIP LOUNGE
                </button>
            </form>

            <div class="mt-8 pt-6 border-t border-zinc-900 text-center">
                <p class="text-xs text-zinc-400">
                    Not a VIP Member yet?
                    <a href="{{ route('register') }}" class="text-amber-500 hover:text-amber-400 transition ml-1 font-medium underline underline-offset-4">
                        Apply for Membership
                    </a>
                </p>
            </div>
        </div>
    </div>
</section>
@endsection
