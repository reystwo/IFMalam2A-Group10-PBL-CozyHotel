<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'CozyHotel') }} - Modern Hotel Booking</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:300,400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-slate-900 bg-white min-h-full flex flex-col">
    <!-- Navbar -->
    <nav x-data="{ open: false, atTop: true }" 
         @scroll.window="atTop = (window.pageYOffset > 10 ? false : true)"
         :class="{ 'bg-white/80 backdrop-blur-md shadow-sm border-b border-slate-100': !atTop, 'bg-transparent': atTop }"
         class="fixed w-full z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                        <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-200 group-hover:rotate-6 transition-transform">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <span class="text-xl font-bold tracking-tight text-slate-900">CozyHotel</span>
                    </a>
                </div>

                <!-- Desktop Nav -->
                <div class="hidden sm:flex sm:items-center sm:gap-8">
                    <a href="{{ route('home') }}" class="text-sm font-semibold text-slate-600 hover:text-indigo-600 transition-colors">Home</a>
                    <a href="{{ route('rooms.index') }}" class="text-sm font-semibold text-slate-600 hover:text-indigo-600 transition-colors">Rooms</a>
                    <div class="h-6 w-px bg-slate-200 mx-2"></div>
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('dashboard') }}" class="px-5 py-2.5 bg-indigo-600 text-white text-sm font-bold rounded-xl shadow-lg shadow-indigo-100 hover:bg-indigo-700 transition-all">Dashboard</a>
                        @else
                            <a href="{{ route('customer.home') }}" class="px-5 py-2.5 bg-indigo-600 text-white text-sm font-bold rounded-xl shadow-lg shadow-indigo-100 hover:bg-indigo-700 transition-all">My Home</a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-600 hover:text-indigo-600 transition-colors">Login</a>
                        <a href="{{ route('register') }}" class="px-5 py-2.5 bg-indigo-600 text-white text-sm font-bold rounded-xl shadow-lg shadow-indigo-100 hover:bg-indigo-700 transition-all">Register</a>
                    @endauth
                </div>

                <!-- Mobile menu button -->
                <div class="flex items-center sm:hidden">
                    <button @click="open = !open" class="p-2 rounded-lg text-slate-600 hover:bg-slate-100 transition-colors">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="open" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             @click.away="open = false"
             class="sm:hidden bg-white border-b border-slate-100 overflow-hidden shadow-xl">
            <div class="px-4 pt-2 pb-6 space-y-1">
                <a href="{{ route('home') }}" class="block px-3 py-2 text-base font-semibold text-slate-700 hover:bg-slate-50 hover:text-indigo-600 rounded-lg">Home</a>
                <a href="{{ route('rooms.index') }}" class="block px-3 py-2 text-base font-semibold text-slate-700 hover:bg-slate-50 hover:text-indigo-600 rounded-lg">Rooms</a>
                <div class="pt-4 border-t border-slate-100 mt-4 flex flex-col gap-2">
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('dashboard') }}" class="w-full text-center px-3 py-3 bg-indigo-600 text-white font-bold rounded-xl">Dashboard</a>
                        @else
                            <a href="{{ route('customer.home') }}" class="w-full text-center px-3 py-3 bg-indigo-600 text-white font-bold rounded-xl">My Home</a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="w-full text-center px-3 py-3 text-slate-700 font-semibold border border-slate-200 rounded-xl">Login</a>
                        <a href="{{ route('register') }}" class="w-full text-center px-3 py-3 bg-indigo-600 text-white font-bold rounded-xl shadow-lg shadow-indigo-100">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-grow">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 text-slate-400 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-12 mb-12">
                <div class="col-span-2">
                    <div class="flex items-center gap-2 mb-6">
                        <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <span class="text-2xl font-bold text-white tracking-tight">CozyHotel</span>
                    </div>
                    <p class="max-w-sm text-slate-400 leading-relaxed">
                        Redefining hospitality with a blend of modern luxury and cozy comfort. Your perfect stay awaits at the heart of the city.
                    </p>
                </div>
                <div>
                    <h4 class="text-white font-bold mb-6">Quick Links</h4>
                    <ul class="space-y-4 text-sm">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a></li>
                        <li><a href="{{ route('rooms.index') }}" class="hover:text-white transition-colors">Our Rooms</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">About Us</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-bold mb-6">Newsletter</h4>
                    <p class="text-sm mb-4">Subscribe to get special offers and updates.</p>
                    <form class="flex gap-2">
                        <input type="email" placeholder="Your email" class="bg-slate-800 border-none rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 w-full text-white">
                        <button type="button" class="bg-indigo-600 text-white p-2 rounded-lg hover:bg-indigo-700 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
            <div class="pt-8 border-t border-slate-800 flex flex-col md:flex-row justify-between items-center gap-4 text-sm font-medium">
                <p>&copy; {{ date('Y') }} CozyHotel Management System. All rights reserved.</p>
                <div class="flex gap-8">
                    <a href="#" class="hover:text-white transition-colors">Privacy Policy</a>
                    <a href="#" class="hover:text-white transition-colors">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
