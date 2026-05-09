<x-layouts.customer>
    <x-slot:title>Available Rooms</x-slot>

    <!-- Page Header -->
    <header class="relative pt-40 pb-20 overflow-hidden bg-white">
        <!-- Decorative Background -->
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
                <h1 class="text-5xl lg:text-6xl font-black text-slate-900 tracking-tight mb-6 leading-tight">
                    Find Your Perfect <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-blue-500">Sanctuary</span>
                </h1>
                <p class="text-lg text-slate-500 font-medium leading-relaxed max-w-2xl">
                    From sun-drenched lofts to serene garden suites, explore our collection of rooms crafted for your ultimate relaxation and luxury experience.
                </p>
            </div>
        </div>
    </header>

    <!-- Search and Filter Section -->
    <section class="sticky top-20 z-40 bg-white/80 backdrop-blur-md border-y border-slate-100 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <form action="{{ route('guest.rooms.index') }}" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4 items-end">
                <!-- Search -->
                <div class="col-span-2">
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Search Room</label>
                    <div class="relative group">
                        <input type="text" placeholder="e.g. Deluxe Suite" class="w-full pl-12 pr-4 py-4 bg-slate-50 border-slate-100 rounded-2xl text-sm font-bold text-slate-900 focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all">
                        <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400 group-focus-within:text-indigo-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                </div>

                <!-- Room Type -->
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Type</label>
                    <select class="w-full px-4 py-4 bg-slate-50 border-slate-100 rounded-2xl text-sm font-bold text-slate-900 focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all appearance-none cursor-pointer">
                        <option>All Types</option>
                        <option>Standard</option>
                        <option>Deluxe</option>
                        <option>Suite</option>
                    </select>
                </div>

                <!-- Price Range -->
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Price Range</label>
                    <select class="w-full px-4 py-4 bg-slate-50 border-slate-100 rounded-2xl text-sm font-bold text-slate-900 focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all appearance-none cursor-pointer">
                        <option>Any Price</option>
                        <option>$0 - $150</option>
                        <option>$150 - $300</option>
                        <option>$300+</option>
                    </select>
                </div>

                <!-- Capacity -->
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Capacity</label>
                    <select class="w-full px-4 py-4 bg-slate-50 border-slate-100 rounded-2xl text-sm font-bold text-slate-900 focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all appearance-none cursor-pointer">
                        <option>Any</option>
                        <option>1 Adult</option>
                        <option>2 Adults</option>
                        <option>Family</option>
                    </select>
                </div>

                <!-- Action -->
                <div>
                    <button type="submit" class="w-full py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-black rounded-2xl shadow-lg shadow-indigo-100 transition-all flex items-center justify-center gap-2 group active:scale-95">
                        <svg class="w-5 h-5 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                        Apply
                    </button>
                </div>
            </form>
        </div>
    </section>

    <!-- Room Listing Section -->
    <section class="py-20 bg-white min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Sort and Count Header -->
            <div class="flex items-center justify-between mb-12">
                <div>
                    <p class="text-sm font-bold text-slate-400">Showing <span class="text-slate-900">1-12</span> of <span class="text-slate-900">48</span> rooms available</p>
                </div>
                <div class="flex items-center gap-4">
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Sort by</span>
                    <select class="bg-transparent border-none text-sm font-black text-slate-900 focus:ring-0 cursor-pointer appearance-none">
                        <option>Price: Lowest</option>
                        <option>Price: Highest</option>
                        <option>Most Popular</option>
                    </select>
                </div>
            </div>

            @php
                $rooms = [
                    [
                        'id' => 1,
                        'name' => 'Classic Standard',
                        'description' => 'Elegantly simple, featuring a premium queen bed and floor-to-ceiling windows with city views.',
                        'image' => 'https://images.unsplash.com/photo-1566665797739-1674de7a421a?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80',
                        'price' => 125,
                        'available' => true,
                        'rating' => '4.8',
                        'reviews' => 156,
                        'capacity' => '2 Adults',
                        'size' => '28m²',
                        'amenities' => [
                            ['label' => 'WiFi', 'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071a9.5 9.5 0 0113.138 0"></path></svg>', 'short_label' => 'WIFI'],
                            ['label' => 'AC', 'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2"></path></svg>', 'short_label' => 'AC'],
                            ['label' => 'Bed', 'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3"></path></svg>', 'short_label' => 'QUEEN'],
                            ['label' => 'Bath', 'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 10V7a2 2 0 012-2h12a2 2 0 012 2v3M4 10a2 2 0 00-2 2v1h10V10H4z"></path></svg>', 'short_label' => 'SHOWER'],
                        ]
                    ],
                    [
                        'id' => 2,
                        'name' => 'Garden Deluxe',
                        'description' => 'A spacious retreat with direct access to our botanical gardens and a private outdoor terrace.',
                        'image' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80',
                        'price' => 240,
                        'available' => true,
                        'rating' => '4.9',
                        'reviews' => 84,
                        'capacity' => '2 Adults',
                        'size' => '42m²',
                        'amenities' => [
                            ['label' => 'WiFi', 'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071a9.5 9.5 0 0113.138 0"></path></svg>', 'short_label' => 'WIFI'],
                            ['label' => 'Bar', 'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A10.003 10.003 0 0012 3v11z"></path></svg>', 'short_label' => 'BAR'],
                            ['label' => 'Bed', 'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3"></path></svg>', 'short_label' => 'KING'],
                            ['label' => 'Bath', 'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 10V7a2 2 0 012-2h12a2 2 0 012 2v3M4 10a2 2 0 00-2 2v1h10V10H4z"></path></svg>', 'short_label' => 'TUB'],
                        ]
                    ],
                    [
                        'id' => 3,
                        'name' => 'Sky Executive Suite',
                        'description' => 'Perched on the highest floor, this suite offers absolute privacy and the best views in the city.',
                        'image' => 'https://images.unsplash.com/photo-1582719478250-c89cae4df85b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80',
                        'price' => 450,
                        'available' => false,
                        'rating' => '5.0',
                        'reviews' => 42,
                        'capacity' => '2 Adults',
                        'size' => '65m²',
                        'amenities' => [
                            ['label' => 'WiFi', 'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071a9.5 9.5 0 0113.138 0"></path></svg>', 'short_label' => 'WIFI'],
                            ['label' => 'Work', 'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2"></path></svg>', 'short_label' => 'OFFICE'],
                            ['label' => 'Bed', 'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3"></path></svg>', 'short_label' => 'KING'],
                            ['label' => 'Bath', 'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 10V7a2 2 0 012-2h12a2 2 0 012 2v3M4 10a2 2 0 00-2 2v1h10V10H4z"></path></svg>', 'short_label' => 'JACUZZI'],
                        ]
                    ],
                ];
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12 mb-20">
                @foreach($rooms as $room)
                    <x-guest-room-card :room="$room" />
                @endforeach
                <!-- Duplicating for example -->
                @foreach($rooms as $room)
                    @php $room['id'] = $room['id'] + 10; @endphp
                    <x-guest-room-card :room="$room" />
                @endforeach
            </div>

            <!-- Pagination Section -->
            <nav class="flex items-center justify-between border-t border-slate-100 pt-10">
                <div class="flex-1 flex justify-between sm:hidden">
                    <button class="relative inline-flex items-center px-4 py-2 border border-slate-200 text-xs font-black rounded-xl text-slate-700 bg-white hover:bg-slate-50 transition-all">Previous</button>
                    <button class="ml-3 relative inline-flex items-center px-4 py-2 border border-slate-200 text-xs font-black rounded-xl text-slate-700 bg-white hover:bg-slate-50 transition-all">Next</button>
                </div>
                <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm font-bold text-slate-400">
                            Showing <span class="text-slate-900">1</span> to <span class="text-slate-900">12</span> of <span class="text-slate-900">48</span> results
                        </p>
                    </div>
                    <div>
                        <div class="inline-flex gap-2">
                            <button class="w-12 h-12 flex items-center justify-center rounded-xl bg-slate-50 text-slate-400 cursor-not-allowed">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
                            </button>
                            <button class="w-12 h-12 flex items-center justify-center rounded-xl bg-indigo-600 text-white font-black shadow-lg shadow-indigo-100">1</button>
                            <button class="w-12 h-12 flex items-center justify-center rounded-xl bg-white border border-slate-100 text-slate-600 font-black hover:bg-slate-50 transition-all">2</button>
                            <button class="w-12 h-12 flex items-center justify-center rounded-xl bg-white border border-slate-100 text-slate-600 font-black hover:bg-slate-50 transition-all">3</button>
                            <button class="w-12 h-12 flex items-center justify-center rounded-xl bg-white border border-slate-100 text-slate-600 font-black hover:bg-slate-50 transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
                            </button>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </section>

    <!-- Support Help Section -->
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
                <button class="px-8 py-4 bg-indigo-600 text-white font-black rounded-2xl shadow-lg shadow-indigo-500/20 hover:bg-indigo-700 transition-all active:scale-95">Chat with Support</button>
                <button class="px-8 py-4 bg-slate-800 text-white font-black rounded-2xl hover:bg-slate-700 transition-all active:scale-95">Call Us Now</button>
            </div>
        </div>
    </section>
</x-layouts.customer>
