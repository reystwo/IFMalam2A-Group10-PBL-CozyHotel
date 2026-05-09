<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'CozyHotel') }} - Guest Experience</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:300,400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-slate-900 bg-slate-50 min-h-full flex flex-col">
    <!-- Authenticated Navbar -->
    <nav x-data="{ open: false, atTop: true, userMenu: false }" 
         @scroll.window="atTop = (window.pageYOffset > 10 ? false : true)"
         :class="{ 'bg-white/90 backdrop-blur-lg shadow-soft border-b border-slate-200/60': !atTop, 'bg-white border-b border-slate-100': atTop }"
         class="fixed w-full z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <a href="{{ route('customer.home') }}" class="flex items-center gap-2.5 group">
                        <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-100 group-hover:rotate-6 transition-transform">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <span class="text-xl font-black tracking-tight text-slate-900">CozyHotel</span>
                    </a>
                </div>

                <!-- Desktop Nav -->
                <div class="hidden md:flex sm:items-center sm:gap-10">
                    <a href="{{ route('customer.home') }}" class="text-sm font-bold {{ request()->routeIs('customer.home') ? 'text-indigo-600' : 'text-slate-500 hover:text-indigo-600' }} transition-colors">Home</a>
                    <a href="{{ route('guest.rooms.index') }}" class="text-sm font-bold {{ request()->routeIs('guest.rooms.index') ? 'text-indigo-600' : 'text-slate-500 hover:text-indigo-600' }} transition-colors">Rooms</a>
                    <a href="{{ route('guest.bookings.index') }}" class="text-sm font-bold {{ request()->routeIs('guest.bookings.index') ? 'text-indigo-600' : 'text-slate-500 hover:text-indigo-600' }} transition-colors">My Bookings</a>
                    
                    <div class="flex items-center gap-6 ml-6 pl-6 border-l border-slate-200">
                        <!-- Notifications -->
                        <button class="relative p-2 text-slate-400 hover:text-indigo-600 transition-colors">
                            <span class="absolute top-2 right-2 w-2 h-2 bg-rose-500 rounded-full border-2 border-white"></span>
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                            </svg>
                        </button>

                        <!-- User Profile Dropdown -->
                        <div class="relative" x-data="{ userMenu: false }">
                            <button @click="userMenu = !userMenu" class="flex items-center gap-3 p-1 rounded-2xl hover:bg-slate-50 transition-colors focus:outline-none">
                                <div class="w-10 h-10 rounded-xl overflow-hidden border-2 border-white shadow-sm">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'Guest') }}&background=6366f1&color=fff" alt="Avatar">
                                </div>
                                <div class="text-left hidden lg:block">
                                    <p class="text-xs font-black text-slate-900 leading-none">{{ auth()->user()->name ?? 'Guest' }}</p>
                                    <p class="text-[10px] font-bold text-slate-400 mt-1 uppercase tracking-wider">Guest Member</p>
                                </div>
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>

                            <div x-show="userMenu" 
                                 @click.away="userMenu = false"
                                 x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="opacity-0 scale-95"
                                 x-transition:enter-end="opacity-100 scale-100"
                                 class="absolute right-0 mt-3 w-56 bg-white rounded-[1.5rem] shadow-2xl shadow-slate-200 border border-slate-100 py-3 z-50 overflow-hidden">
                                <a href="{{ route('profile') }}" class="flex items-center gap-3 px-5 py-3 text-sm font-bold text-slate-600 hover:bg-slate-50 hover:text-indigo-600 transition-colors">
                                    <svg class="w-5 h-5 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    My Profile
                                </a>
                                <a href="{{ route('bookings.index') }}" class="flex items-center gap-3 px-5 py-3 text-sm font-bold text-slate-600 hover:bg-slate-50 hover:text-indigo-600 transition-colors">
                                    <svg class="w-5 h-5 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                                    Bookings
                                </a>
                                <div class="my-2 border-t border-slate-100"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center gap-3 px-5 py-3 text-sm font-bold text-rose-600 hover:bg-rose-50 transition-colors">
                                        <svg class="w-5 h-5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                        Log Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mobile menu button -->
                <div class="flex items-center md:hidden">
                    <button @click="open = !open" class="p-2.5 rounded-xl text-slate-500 hover:bg-slate-100 transition-colors">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="open" x-collapse class="md:hidden bg-white border-b border-slate-100 overflow-hidden">
            <div class="px-4 pt-4 pb-8 space-y-2">
                <a href="{{ route('customer.home') }}" class="block px-4 py-3.5 text-base font-bold text-slate-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-2xl transition-all">Home</a>
                <a href="{{ route('guest.bookings.index') }}" class="block px-4 py-3.5 text-base font-bold text-slate-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-2xl transition-all">My Bookings</a>
                <a href="{{ route('profile') }}" class="block px-4 py-3.5 text-base font-bold text-slate-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-2xl transition-all">Profile</a>
                <div class="pt-6 border-t border-slate-100 mt-6">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-center gap-3 px-4 py-4 bg-rose-50 text-rose-600 font-black rounded-2xl">
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-grow">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-white py-12 border-t border-slate-200/60">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                <div class="flex items-center gap-2.5 opacity-50 grayscale hover:grayscale-0 hover:opacity-100 transition-all duration-500">
                    <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <span class="text-lg font-black tracking-tight text-slate-900">CozyHotel</span>
                </div>
                <div class="flex gap-10 text-sm font-bold text-slate-400">
                    <a href="#" class="hover:text-indigo-600 transition-colors">Privacy</a>
                    <a href="#" class="hover:text-indigo-600 transition-colors">Terms</a>
                    <a href="#" class="hover:text-indigo-600 transition-colors">Support</a>
                </div>
                <p class="text-xs font-bold text-slate-400">&copy; {{ date('Y') }} CozyHotel. All rights reserved.</p>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
