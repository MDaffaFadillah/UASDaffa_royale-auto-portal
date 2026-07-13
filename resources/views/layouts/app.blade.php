<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Royale Auto Portal | @yield('title', 'Exclusive Luxury')</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script>
        // Konfigurasi Kustom Tailwind agar mendukung Dark Mode & Font Elegan
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        serif: ['Playfair Display', 'serif'],
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Plus+Jakarta+Sans:wght@200..800&display=swap" rel="stylesheet">

    <style>
        /* CSS Tambahan Khusus untuk Memastikan Background Selalu Gelap Pekat */
        body {
            background-color: #000000 !important;
            color: #e4e4e7;
        }
    </style>
</head>
<body class="bg-black text-zinc-200 antialiased font-sans">
    
    <header class="fixed top-0 left-0 w-full z-50 bg-black/60 backdrop-blur-md border-b border-white/10">
        <nav class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-xl md:text-2xl font-serif text-white tracking-widest font-bold hover:text-amber-500 transition">ROYALE AUTO</a>
            <div class="hidden md:flex space-x-8 text-xs tracking-wider uppercase font-light">
                <a href="{{ route('home') }}" class="text-white hover:text-amber-500 transition">Katalog</a>
                <a href="#" class="text-zinc-400 hover:text-amber-500 transition">Bespoke Experience</a>
                <a href="{{ route('profile') }}" class="text-zinc-400 hover:text-amber-500 transition">Profile</a>
            </div>
            <div class="flex items-center space-x-4">
                @guest
                    <a href="{{ route('login') }}" class="border border-amber-500/50 text-amber-500 px-4 py-2 text-xs uppercase tracking-widest hover:bg-amber-500 hover:text-black transition duration-300">
                        VIP Lounge
                    </a>
                @endguest

                @auth
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="border border-red-500/50 text-red-400 px-4 py-2 text-[10px] uppercase tracking-widest hover:bg-red-500 hover:text-white transition duration-300 rounded">
                            Executive Panel
                        </a>
                    @endif
                    <span class="text-xs uppercase tracking-wider text-amber-500 font-medium">
                        Welcome, {{ Auth::user()->full_name }}
                    </span>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="border border-zinc-700 text-zinc-400 px-3 py-1.5 text-[10px] uppercase tracking-widest hover:border-amber-500 hover:text-amber-500 transition duration-300 rounded">
                            Logout
                        </button>
                    </form>
                @endauth
            </div>
        </nav>
    </header>

    <main class="pt-20">
        @yield('content')
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/studio-freight/lenis@1.0.19/bundled/lenis.min.js"></script>
    
    @stack('scripts')
</body>
</html>
