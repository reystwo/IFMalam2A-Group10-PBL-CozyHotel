<x-layouts.app>
    <x-slot:title>Home</x-slot>

    <!-- Hero Section -->
    <section class="relative min-h-[90vh] flex items-center pt-20 overflow-hidden bg-white">
        <!-- Decorative Background -->
        <div class="absolute inset-0 z-0">
            <div class="absolute top-0 right-0 w-1/2 h-full bg-indigo-50/50 rounded-l-[100px] -mr-20 transform rotate-3"></div>
            <div class="absolute bottom-10 left-10 w-96 h-96 bg-blue-100/40 rounded-full blur-[100px]"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div class="max-w-xl">
                    <span class="inline-flex items-center px-4 py-2 bg-indigo-50 text-indigo-700 text-sm font-bold rounded-2xl mb-8 border border-indigo-100/50 shadow-sm">
                        <span class="relative flex h-3 w-3 mr-3">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-3 w-3 bg-indigo-600"></span>
                        </span>
                        Stay Cozy, Stay Happy
                    </span>

                    <h1 class="text-6xl lg:text-7xl font-black text-slate-900 leading-[1.1] mb-8 tracking-tight">
                        Experience the <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-blue-500">Perfect Stay</span>
                    </h1>

                    <p class="text-lg text-slate-500 mb-12 leading-relaxed font-medium">
                        Discover a world of luxury and comfort at CozyHotel. From executive suites to cozy standard rooms, we offer an unforgettable experience tailored to your needs.
                    </p>

                    <!-- Search Form UI -->
                    <div class="bg-white p-2 rounded-[2.5rem] shadow-2xl shadow-slate-200/60 border border-slate-100">
                        <form action="{{ route('rooms.index') }}" class="grid sm:grid-cols-10 gap-2">
                            <div class="sm:col-span-3 group">
                                <div class="p-4 rounded-3xl hover:bg-slate-50 transition-colors">
                                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1 ml-1">Check In</label>
                                    <input type="date" class="w-full bg-transparent border-none p-0 focus:ring-0 text-sm font-bold text-slate-900" placeholder="Add date">
                                </div>
                            </div>
                            <div class="sm:col-span-3">
                                <div class="p-4 rounded-3xl hover:bg-slate-50 transition-colors">
                                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1 ml-1">Check Out</label>
                                    <input type="date" class="w-full bg-transparent border-none p-0 focus:ring-0 text-sm font-bold text-slate-900" placeholder="Add date">
                                </div>
                            </div>
                            <div class="sm:col-span-2">
                                <div class="p-4 rounded-3xl hover:bg-slate-50 transition-colors">
                                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1 ml-1">Guests</label>
                                    <select class="w-full bg-transparent border-none p-0 focus:ring-0 text-sm font-bold text-slate-900 appearance-none">
                                        <option>2 Guests</option>
                                        <option>1 Guest</option>
                                        <option>3+ Guests</option>
                                    </select>
                                </div>
                            </div>
                            <div class="sm:col-span-2 p-1">
                                <button type="submit" class="w-full h-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-[2rem] shadow-lg shadow-indigo-100 transition-all flex items-center justify-center gap-2 py-4">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                    <span class="sm:hidden lg:inline">Search</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="hidden lg:block relative">
                    <div class="relative rounded-[3rem] overflow-hidden shadow-2xl rotate-2 hover:rotate-0 transition-all duration-700 border-8 border-white group">
                        <img src="https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" alt="Hotel Hero" class="w-full h-[650px] object-cover scale-105 group-hover:scale-100 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/40 to-transparent"></div>
                    </div>

                    <!-- Floating Stats Card -->
                    <div class="absolute -bottom-10 -left-10 bg-white/80 backdrop-blur-xl p-8 rounded-[2rem] shadow-2xl border border-white/50 max-w-[240px] animate-bounce-slow">
                        <div class="flex items-center gap-4 mb-3">
                            <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center shadow-inner">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-3xl font-black text-slate-900">4.9<span class="text-lg font-bold text-slate-400">/5</span></p>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Guest Rating</p>
                            </div>
                        </div>
                        <p class="text-xs text-slate-500 font-medium leading-relaxed">Based on 2,500+ verified stays this year.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Available Rooms Section -->
    <section class="py-32 bg-white relative overflow-hidden" id="rooms">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-20 gap-8">
                <div class="max-w-2xl">
                    <span class="text-indigo-600 font-black text-xs uppercase tracking-[0.3em] mb-4 block">Our Accommodation</span>
                    <h2 class="text-4xl lg:text-5xl font-black text-slate-900 mb-6 tracking-tight">Available Rooms</h2>
                    <p class="text-slate-500 text-lg font-medium leading-relaxed">
                        Experience the perfect harmony of luxury and comfort in our meticulously designed rooms, each offering a unique sanctuary for your stay.
                    </p>
                </div>
                <a href="{{ route('rooms.index') }}" class="group inline-flex items-center gap-4 bg-slate-50 px-8 py-4 rounded-2xl text-slate-900 font-bold hover:bg-indigo-600 hover:text-white transition-all duration-300">
                    <span>Explore All Rooms</span>
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>

            @php
                $rooms = [
                    [
                        'id' => 1,
                        'name' => 'Standard Cozy Room',
                        'description' => 'A perfect blend of simplicity and comfort, ideal for business travelers or short weekend getaways.',
                        'image' => 'https://images.unsplash.com/photo-1598928506311-c55ded91a20c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                        'price' => 120,
                        'available' => true,
                        'amenities' => [
                            ['label' => 'Queen Bed', 'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>'],
                            ['label' => 'Free WiFi', 'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071a9.5 9.5 0 0113.138 0M6.253 10.168a12.5 12.5 0 0111.494 0"></path></svg>'],
                            ['label' => 'Smart TV', 'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>'],
                        ]
                    ],
                    [
                        'id' => 2,
                        'name' => 'Deluxe Garden View',
                        'description' => 'Unwind in style with breathtaking garden views and premium amenities designed for your relaxation.',
                        'image' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                        'price' => 250,
                        'available' => true,
                        'amenities' => [
                            ['label' => 'King Bed', 'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>'],
                            ['label' => 'Free WiFi', 'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071a9.5 9.5 0 0113.138 0M6.253 10.168a12.5 12.5 0 0111.494 0"></path></svg>'],
                            ['label' => 'Air Purifier', 'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>'],
                        ]
                    ],
                    [
                        'id' => 3,
                        'name' => 'Presidential Suite',
                        'description' => 'The pinnacle of luxury. Features a private terrace, 24/7 butler service, and an exquisite master bedroom.',
                        'image' => 'https://images.unsplash.com/photo-1578683010236-d716f9759678?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                        'price' => 450,
                        'available' => true,
                        'amenities' => [
                            ['label' => 'King Bed', 'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>'],
                            ['label' => 'Mini Bar', 'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A10.003 10.003 0 0012 3v11z"></path></svg>'],
                            ['label' => 'AC', 'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>'],
                        ]
                    ],
                ];
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach($rooms as $room)
                    <x-room-card :room="$room" />
                @endforeach
            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="py-32 bg-slate-50 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-20">
                <span class="text-indigo-600 font-black text-xs uppercase tracking-[0.3em] mb-4 block">Premium Experience</span>
                <h2 class="text-4xl lg:text-5xl font-black text-slate-900 mb-6">Why CozyHotel?</h2>
                <p class="text-slate-500 text-lg font-medium leading-relaxed">
                    We go beyond providing just a room. We provide a sanctuary where luxury meets the warmth of home.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-12">
                <div class="bg-white p-10 rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 hover:-translate-y-2 transition-transform duration-300">
                    <div class="w-16 h-16 bg-indigo-50 text-indigo-600 rounded-3xl flex items-center justify-center mb-8 shadow-inner">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-4">24/7 Support</h3>
                    <p class="text-slate-500 font-medium leading-relaxed">Our dedicated concierge team is always available to ensure your stay is flawless, day or night.</p>
                </div>
                <div class="bg-white p-10 rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 hover:-translate-y-2 transition-transform duration-300">
                    <div class="w-16 h-16 bg-emerald-50 text-emerald-600 rounded-3xl flex items-center justify-center mb-8 shadow-inner">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-4">Secure Payment</h3>
                    <p class="text-slate-500 font-medium leading-relaxed">Book with confidence using our encrypted payment system, supporting all major global methods.</p>
                </div>
                <div class="bg-white p-10 rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 hover:-translate-y-2 transition-transform duration-300">
                    <div class="w-16 h-16 bg-amber-50 text-amber-600 rounded-3xl flex items-center justify-center mb-8 shadow-inner">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-4">Best Locations</h3>
                    <p class="text-slate-500 font-medium leading-relaxed">Our hotels are situated in the most vibrant and convenient locations across the globe.</p>
                </div>
            </div>
        </div>
    </section>

    <style>
        @keyframes bounce-slow {
            0%, 100% { transform: translateY(-5%); animation-timing-function: cubic-bezier(0.8,0,1,1); }
            50% { transform: none; animation-timing-function: cubic-bezier(0,0,0.2,1); }
        }
        .animate-bounce-slow {
            animation: bounce-slow 4s infinite;
        }
    </style>
</x-layouts.app>
