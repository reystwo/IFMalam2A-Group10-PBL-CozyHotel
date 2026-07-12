<x-layouts.customer>
    <x-slot:title>Available Rooms</x-slot>

    <header class="relative pt-40 pb-20 overflow-hidden bg-white">
        <div class="absolute inset-0 z-0">
            <div class="absolute top-0 right-0 w-1/2 h-full bg-indigo-50/30 rounded-l-[100px] transform translate-x-32"></div>
            <div class="absolute bottom-0 left-0 w-1/4 h-full bg-blue-50/20 rounded-r-[100px] transform -translate-x-10"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="max-w-3xl">
                <nav class="flex items-center gap-3 mb-8 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">
                    <a href="{{ route('customer.home') }}" class="hover:text-indigo-600 transition-colors">Home</a>
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg>
                    <span class="text-indigo-600">Browse Rooms</span>
                </nav>
                <h1 class="text-5xl lg:text-7xl font-black text-slate-900 leading-[1.1] mb-6 tracking-tight">
                    Find Your <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-blue-500">Perfect Stay.</span>
                </h1>
                <p class="text-lg text-slate-500 leading-relaxed font-medium">
                    Explore our entire collection of spaces designed for rest, focus, and ultimate relaxation.
                </p>
            </div>
        </div>
    </header>

    <section class="py-20 bg-slate-50 relative z-10 -mt-10 rounded-[3.5rem]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($rooms as $room)
                    <x-guest-room-card :room="$room" />
                @empty
                    <div class="col-span-full text-center py-20 bg-white rounded-[2.5rem] border border-slate-100 shadow-sm">
                        <span class="text-4xl block mb-4">⚠️</span>
                        <h3 class="text-lg font-black text-slate-900 mb-1">Kamar Tidak Tersedia</h3>
                        <p class="text-slate-400 text-sm font-medium">Maaf, saat ini seluruh kamar kami sedang penuh atau dalam pemeliharaan.</p>
                    </div>
                @endforelse
            </div>

            <nav class="mt-20 flex justify-center">
                <div class="bg-white p-2 rounded-2xl border border-slate-100 shadow-soft flex items-center gap-1">
                    <button class="w-10 h-10 flex items-center justify-center rounded-xl text-slate-400 hover:bg-slate-50 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
                    </button>
                    <button class="w-10 h-10 flex items-center justify-center rounded-xl text-sm font-black bg-indigo-600 text-white shadow-md shadow-indigo-100">1</button>
                    <button class="w-10 h-10 flex items-center justify-center rounded-xl text-sm font-bold text-slate-600 hover:bg-slate-50 transition-colors">2</button>
                    <button class="w-10 h-10 flex items-center justify-center rounded-xl text-sm font-bold text-slate-600 hover:bg-slate-50 transition-colors">3</button>
                    <span class="px-2 text-slate-300 font-bold">...</span>
                    <button class="w-10 h-10 flex items-center justify-center rounded-xl text-sm font-bold text-slate-600 hover:bg-slate-50 transition-colors">8</button>
                    <button class="w-10 h-10 flex items-center justify-center rounded-xl text-slate-400 hover:bg-slate-50 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
                    </button>
                </div>
            </nav>
        </div>
    </section>

    <section class="py-20 bg-slate-900 rounded-[4rem] mx-4 mb-10 overflow-hidden relative">
        <div class="absolute inset-0 opacity-10">
            <svg class="h-full w-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                <path d="M0 100 C 20 0 50 0 100 100 Z" fill="white"></path>
            </svg>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h2 class="text-3xl lg:text-4xl font-black text-white mb-6">Need help choosing?</h2>
            <p class="text-slate-400 font-medium mb-10 max-w-xl mx-auto">Our local experts are available 24/7 to help you find the room that perfectly matches your lifestyle.</p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <button class="px-8 py-4 bg-indigo-600 text-white font-black rounded-2xl shadow-lg shadow-indigo-600/30 hover:bg-indigo-700 transition-all text-sm">
                    Contact Support
                </button>
            </div>
        </div>
    </section>
</x-layouts.customer>
