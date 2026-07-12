<x-layouts.customer>
    <x-slot:title>Welcome back!</x-slot>

    <section class="relative pt-32 pb-20 overflow-hidden bg-white">
        <div class="absolute inset-0 z-0">
            <div class="absolute top-0 right-0 w-1/3 h-full bg-indigo-50/40 rounded-l-[100px] transform translate-x-20"></div>
            <div class="absolute -bottom-24 left-10 w-96 h-96 bg-blue-100/30 rounded-full blur-[120px]"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="max-w-3xl mb-16">
                <span class="inline-flex items-center px-4 py-2 bg-indigo-50 text-indigo-700 text-[10px] font-black uppercase tracking-[0.2em] rounded-2xl mb-6 border border-indigo-100/50">
                    Your Personalized Portal
                </span>
                <h1 class="text-5xl lg:text-7xl font-black text-slate-900 leading-[1.1] mb-6 tracking-tight">
                    Welcome back, <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-blue-500">{{ auth()->user()->name ?? 'Guest' }}!</span>
                </h1>
                <p class="text-lg text-slate-500 leading-relaxed font-medium">
                    Ready for your next getaway? Explore our latest collection of premium rooms and suites, all designed with your ultimate comfort in mind.
                </p>
            </div>

            <div class="bg-white p-3 rounded-[3rem] shadow-2xl shadow-slate-200/80 border border-slate-100">
                <form action="{{ route('home') }}" method="GET" class="grid lg:grid-cols-12 gap-3">
                    <div class="lg:col-span-3">
                        <div class="p-5 rounded-[2rem] hover:bg-slate-50 transition-colors border border-transparent hover:border-slate-100">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Check In</label>
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-indigo-500 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <input type="date" name="check_in" class="w-full bg-transparent border-none p-0 focus:ring-0 text-sm font-black text-slate-900" value="{{ request('check_in', date('Y-m-d')) }}">
                            </div>
                        </div>
                    </div>
                    <div class="lg:col-span-3">
                        <div class="p-5 rounded-[2rem] hover:bg-slate-50 transition-colors border border-transparent hover:border-slate-100">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Check Out</label>
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-indigo-500 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <input type="date" name="check_out" class="w-full bg-transparent border-none p-0 focus:ring-0 text-sm font-black text-slate-900" value="{{ request('check_out', date('Y-m-d', strtotime('+1 day'))) }}">
                            </div>
                        </div>
                    </div>
                    <div class="lg:col-span-2">
                        <div class="p-5 rounded-[2rem] hover:bg-slate-50 transition-colors border border-transparent hover:border-slate-100">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Guests</label>
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-indigo-500 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                <select name="guests" class="w-full bg-transparent border-none p-0 focus:ring-0 text-sm font-black text-slate-900 appearance-none">
                                    <option value="2">2 Adults</option>
                                    <option value="1">1 Adult</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="lg:col-span-2">
                        <div class="p-5 rounded-[2rem] hover:bg-slate-50 transition-colors border border-transparent hover:border-slate-100">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Room Type</label>
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-indigo-500 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                                <select name="room_type_id" class="w-full bg-transparent border-none p-0 focus:ring-0 text-sm font-black text-slate-900 appearance-none">
                                    <option value="all" {{ request('room_type_id') == 'all' ? 'selected' : '' }}>All Types</option>
                                    <option value="1" {{ request('room_type_id') == '1' ? 'selected' : '' }}>Standard</option>
                                    <option value="2" {{ request('room_type_id') == '2' ? 'selected' : '' }}>Deluxe</option>
                                    <option value="3" {{ request('room_type_id') == '3' ? 'selected' : '' }}>Suite</option>
                                    <option value="4" {{ request('room_type_id') == '4' ? 'selected' : '' }}>Family</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="lg:col-span-2 p-1.5">
                        <button type="submit" class="w-full h-full bg-slate-900 hover:bg-indigo-600 text-white font-black rounded-[2.2rem] shadow-xl shadow-slate-200 transition-all flex items-center justify-center gap-3 py-5">
                            Search
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <section class="py-20 bg-slate-50 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-end justify-between mb-12">
                <div>
                    <span class="text-indigo-600 font-black text-[10px] uppercase tracking-[0.3em] mb-3 block">Curated For You</span>
                    <h2 class="text-3xl lg:text-4xl font-black text-slate-900 tracking-tight">Recommended Stays</h2>
                </div>
            </div>

            <div class="flex gap-8 overflow-x-auto pb-12 snap-x no-scrollbar -mx-4 px-4 sm:mx-0 sm:px-0">
                @forelse($recommendedRooms as $room)
                    <div class="min-w-[400px] sm:min-w-[480px] snap-center">
                        <x-guest-room-card :room="$room" />
                    </div>
                @empty
                    <div class="w-full text-center py-10 text-slate-400 font-medium">No recommendations available at the moment.</div>
                @endforelse
            </div>
        </div>
    </section>

    <section class="py-32 bg-white" id="rooms">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-20 gap-8">
                <div class="max-w-2xl">
                    <span class="text-indigo-600 font-black text-[10px] uppercase tracking-[0.3em] mb-4 block">Browse Catalog</span>
                    <h2 class="text-4xl lg:text-5xl font-black text-slate-900 tracking-tight mb-6">Available Rooms</h2>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                @forelse($availableRooms as $room)
                    <x-guest-room-card :room="$room" />
                @empty
                    <div class="col-span-full text-center py-20 text-slate-400 font-medium">
                        ⚠️ No rooms match your selection or are available.
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <style>
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</x-layouts.customer>
