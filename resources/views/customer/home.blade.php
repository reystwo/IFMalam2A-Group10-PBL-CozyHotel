<x-layouts.customer>
    <x-slot:title>Welcome back!</x-slot>

    <!-- Welcome Hero Section -->
    <section class="relative pt-32 pb-20 overflow-hidden bg-white">
        <!-- Decorative Background Elements -->
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

            <!-- Enhanced Search/Filter Form -->
            <div class="bg-white p-3 rounded-[3rem] shadow-2xl shadow-slate-200/80 border border-slate-100">
                <form action="{{ route('customer.home') }}" class="grid lg:grid-cols-12 gap-3">
                    <div class="lg:col-span-3 group">
                        <div class="p-5 rounded-[2rem] hover:bg-slate-50 transition-colors border border-transparent hover:border-slate-100">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Check In</label>
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-indigo-500 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <input type="date" class="w-full bg-transparent border-none p-0 focus:ring-0 text-sm font-black text-slate-900" value="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                    </div>
                    <div class="lg:col-span-3">
                        <div class="p-5 rounded-[2rem] hover:bg-slate-50 transition-colors border border-transparent hover:border-slate-100">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Check Out</label>
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-indigo-500 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <input type="date" class="w-full bg-transparent border-none p-0 focus:ring-0 text-sm font-black text-slate-900" value="{{ date('Y-m-d', strtotime('+1 day')) }}">
                            </div>
                        </div>
                    </div>
                    <div class="lg:col-span-2">
                        <div class="p-5 rounded-[2rem] hover:bg-slate-50 transition-colors border border-transparent hover:border-slate-100">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Guests</label>
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-indigo-500 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                <select class="w-full bg-transparent border-none p-0 focus:ring-0 text-sm font-black text-slate-900 appearance-none">
                                    <option>2 Adults</option>
                                    <option>1 Adult</option>
                                    <option>2 Adults, 1 Child</option>
<<<<<<< HEAD
=======
                                    <option>2 Adults, 2 Childs</option>
                                    <option>Other</option>
>>>>>>> c31c07a (implementasi crud dan finalisasi fitur admin lainnya)
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="lg:col-span-2">
                        <div class="p-5 rounded-[2rem] hover:bg-slate-50 transition-colors border border-transparent hover:border-slate-100">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Room Type</label>
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-indigo-500 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                                <select class="w-full bg-transparent border-none p-0 focus:ring-0 text-sm font-black text-slate-900 appearance-none">
                                    <option>All Types</option>
                                    <option>Standard</option>
                                    <option>Deluxe</option>
                                    <option>Suite</option>
<<<<<<< HEAD
=======
                                    <option>Family</option>
>>>>>>> c31c07a (implementasi crud dan finalisasi fitur admin lainnya)
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="lg:col-span-2 p-1.5">
                        <button type="submit" class="w-full h-full bg-slate-900 hover:bg-indigo-600 text-white font-black rounded-[2.2rem] shadow-xl shadow-slate-200 transition-all flex items-center justify-center gap-3 py-5">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            Search
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Recommended Rooms Section -->
    <section class="py-20 bg-slate-50 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-end justify-between mb-12">
                <div>
                    <span class="text-indigo-600 font-black text-[10px] uppercase tracking-[0.3em] mb-3 block">Curated For You</span>
                    <h2 class="text-3xl lg:text-4xl font-black text-slate-900 tracking-tight">Recommended Stays</h2>
                </div>
                <div class="flex gap-3">
                    <button class="w-12 h-12 rounded-2xl bg-white border border-slate-200 flex items-center justify-center text-slate-400 hover:text-indigo-600 hover:border-indigo-600 transition-all shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
                    </button>
                    <button class="w-12 h-12 rounded-2xl bg-white border border-slate-200 flex items-center justify-center text-slate-400 hover:text-indigo-600 hover:border-indigo-600 transition-all shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
                    </button>
                </div>
            </div>

            <!-- Horizontal Scroll -->
            <div class="flex gap-8 overflow-x-auto pb-12 snap-x no-scrollbar -mx-4 px-4 sm:mx-0 sm:px-0">
                @php
                    $featured = [
                        [
                            'id' => 101,
                            'name' => 'Royal Penthouse',
                            'description' => 'Unmatched panoramic city views with a private infinity pool and personalized butler service.',
                            'image' => 'https://images.unsplash.com/photo-1582719478250-c89cae4df85b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80',
                            'price' => 850,
                            'available' => true,
                            'rating' => '5.0',
                            'reviews' => 48,
                            'capacity' => '4 Adults',
                            'amenities' => [
                                ['label' => 'Pool', 'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>', 'short_label' => 'POOL'],
                                ['label' => 'WiFi', 'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071a9.5 9.5 0 0113.138 0"></path></svg>', 'short_label' => 'WIFI'],
                                ['label' => 'Bar', 'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A10.003 10.003 0 0012 3v11z"></path></svg>', 'short_label' => 'BAR'],
                            ]
                        ],
                        [
                            'id' => 102,
                            'name' => 'Executive Loft',
                            'description' => 'Modern industrial design meets ultimate comfort. Features a two-story living space and office.',
                            'image' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80',
                            'price' => 420,
                            'available' => true,
                            'rating' => '4.8',
                            'reviews' => 92,
                            'capacity' => '2 Adults',
                            'amenities' => [
                                ['label' => 'King Bed', 'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3"></path></svg>', 'short_label' => 'KING'],
                                ['label' => 'Work', 'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>', 'short_label' => 'WORK'],
                                ['label' => 'TV', 'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>', 'short_label' => 'TV'],
                            ]
                        ],
                        [
                            'id' => 103,
                            'name' => 'Garden Oasis',
                            'description' => 'A serene retreat surrounded by lush greenery and the soothing sounds of nature.',
                            'image' => 'https://images.unsplash.com/photo-1566665797739-1674de7a421a?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80',
                            'price' => 310,
                            'available' => true,
                            'rating' => '4.9',
                            'reviews' => 156,
                            'capacity' => '2 Adults',
                            'amenities' => [
                                ['label' => 'WiFi', 'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071a9.5 9.5 0 0113.138 0"></path></svg>', 'short_label' => 'WIFI'],
                                ['label' => 'AC', 'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2"></path></svg>', 'short_label' => 'AC'],
                                ['label' => 'Bed', 'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3"></path></svg>', 'short_label' => 'KING'],
                            ]
                        ],
                    ];
                @endphp

                @foreach($featured as $room)
                    <div class="min-w-[400px] sm:min-w-[480px] snap-center">
                        <x-guest-room-card :room="$room" />
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Available Rooms Grid Section -->
    <section class="py-32 bg-white" id="rooms">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-20 gap-8">
                <div class="max-w-2xl">
                    <span class="text-indigo-600 font-black text-[10px] uppercase tracking-[0.3em] mb-4 block">Browse Catalog</span>
                    <h2 class="text-4xl lg:text-5xl font-black text-slate-900 tracking-tight mb-6">Available Rooms</h2>
                    <p class="text-slate-500 text-lg font-medium leading-relaxed">
                        Find your perfect sanctuary. From cozy escapes to grand residences, our diverse catalog offers something for every traveler.
                    </p>
                </div>
                <div class="flex items-center gap-4">
                    <button class="px-6 py-3 bg-slate-50 text-slate-900 font-black rounded-xl border border-slate-100 hover:border-indigo-600 transition-all">Filter</button>
                    <button class="px-6 py-3 bg-slate-50 text-slate-900 font-black rounded-xl border border-slate-100 hover:border-indigo-600 transition-all">Sort by: Price</button>
                </div>
            </div>

            @php
                $rooms = [
                    [
                        'id' => 1,
                        'name' => 'Standard Deluxe',
                        'description' => 'A spacious and elegantly appointed room featuring modern amenities and city views.',
                        'image' => 'https://images.unsplash.com/photo-1596394516093-501ba68a0ba6?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                        'price' => 180,
                        'available' => true,
                        'rating' => '4.7',
                        'reviews' => 210,
                        'capacity' => '2 Adults',
                        'amenities' => [
                            ['label' => 'WiFi', 'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071a9.5 9.5 0 0113.138 0"></path></svg>', 'short_label' => 'WIFI'],
                            ['label' => 'AC', 'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2"></path></svg>', 'short_label' => 'AC'],
                            ['label' => 'TV', 'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18"></path></svg>', 'short_label' => 'TV'],
                        ]
                    ],
                    [
                        'id' => 2,
                        'name' => 'Family Suite',
                        'description' => 'Designed for families, this suite offers multiple rooms and child-friendly amenities.',
                        'image' => 'https://images.unsplash.com/photo-1560185007-c5ca9d2c014d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                        'price' => 350,
                        'available' => true,
                        'rating' => '4.9',
                        'reviews' => 85,
                        'capacity' => '4 Adults, 2 Children',
                        'amenities' => [
                            ['label' => 'WiFi', 'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071a9.5 9.5 0 0113.138 0"></path></svg>', 'short_label' => 'WIFI'],
                            ['label' => 'Kitchen', 'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2"></path></svg>', 'short_label' => 'KITCHEN'],
                            ['label' => 'Play', 'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>', 'short_label' => 'PLAY'],
                        ]
                    ],
                    [
                        'id' => 3,
                        'name' => 'Business Studio',
                        'description' => 'A compact and efficient studio perfect for solo business travelers on the go.',
                        'image' => 'https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                        'price' => 140,
                        'available' => false,
                        'rating' => '4.6',
                        'reviews' => 310,
                        'capacity' => '1 Adult',
                        'amenities' => [
                            ['label' => 'WiFi', 'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071a9.5 9.5 0 0113.138 0"></path></svg>', 'short_label' => 'WIFI'],
                            ['label' => 'Work', 'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>', 'short_label' => 'WORK'],
                            ['label' => 'Coffee', 'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A10.003 10.003 0 0012 3v11z"></path></svg>', 'short_label' => 'COFFEE'],
                        ]
                    ],
                ];
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                @foreach($rooms as $room)
                    <x-guest-room-card :room="$room" />
                @endforeach
            </div>

            <!-- Load More -->
            <div class="mt-20 flex justify-center">
                <button class="px-10 py-5 bg-white border border-slate-200 text-slate-900 font-black rounded-2xl hover:bg-slate-50 hover:border-indigo-600 transition-all shadow-xl shadow-slate-100">
                    View More Experiences
                </button>
            </div>
        </div>
    </section>

    <style>
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</x-layouts.customer>
