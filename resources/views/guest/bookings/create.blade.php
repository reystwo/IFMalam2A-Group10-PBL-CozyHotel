<x-layouts.customer>
    <x-slot:title>Complete Your Reservation</x-slot>

    @php
        // Mock selected room data
        $room = [
            'id' => 1,
            'name' => 'Garden Deluxe Suite',
            'description' => 'Experience ultimate tranquility in our Garden Deluxe Suite. Featuring panoramic views of our botanical gardens and premium amenities.',
            'image' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80',
            'price' => 240,
            'available' => true,
            'size' => '42m²',
            'capacity' => '2 Adults',
            'amenities' => [
                ['label' => 'WiFi', 'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071a9.5 9.5 0 0113.138 0"></path></svg>', 'short_label' => 'WIFI'],
                ['label' => 'AC', 'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2"></path></svg>', 'short_label' => 'AC'],
                ['label' => 'TV', 'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18"></path></svg>', 'short_label' => 'TV'],
                ['label' => 'Bed', 'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3"></path></svg>', 'short_label' => 'KING'],
            ]
        ];
    @endphp

    <div class="relative pt-40 pb-32 bg-slate-50 min-h-screen">
        <!-- Background accents -->
        <div class="absolute top-0 right-0 w-1/3 h-[500px] bg-indigo-100/30 rounded-bl-[100px] -z-0"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Header -->
            <div class="mb-12">
                <nav class="flex items-center gap-3 mb-8 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">
                    <a href="{{ route('guest.rooms.index') }}" class="hover:text-indigo-600 transition-colors">Rooms</a>
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg>
                    <span class="text-indigo-600">Booking Reservation</span>
                </nav>
                <h1 class="text-4xl lg:text-5xl font-black text-slate-900 tracking-tight mb-4">Complete Your Reservation</h1>
                <p class="text-slate-500 font-medium">Please review your selected room and fill in the details below to confirm your stay.</p>
            </div>

            <div class="grid lg:grid-cols-12 gap-12 items-start">
                <!-- Left Column: Room Preview + Form -->
                <div class="lg:col-span-8 space-y-10">
                    
                    <!-- Selected Room Preview -->
                    <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden flex flex-col md:flex-row">
                        <div class="md:w-1/3 h-64 md:h-auto">
                            <img src="{{ $room['image'] }}" class="w-full h-full object-cover">
                        </div>
                        <div class="p-8 md:w-2/3">
                            <div class="flex justify-between items-start mb-4">
                                <h2 class="text-2xl font-black text-slate-900 tracking-tight">{{ $room['name'] }}</h2>
                                <span class="px-3 py-1 bg-emerald-50 text-emerald-600 text-[10px] font-black uppercase rounded-lg">Available</span>
                            </div>
                            <p class="text-slate-500 text-sm leading-relaxed mb-6 line-clamp-2">{{ $room['description'] }}</p>
                            <div class="flex flex-wrap gap-6 items-center pt-6 border-t border-slate-50">
                                <div class="flex items-center gap-2 text-slate-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                    <span class="text-xs font-bold text-slate-600">{{ $room['size'] }}</span>
                                </div>
                                <div class="flex items-center gap-2 text-slate-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                    <span class="text-xs font-bold text-slate-600">{{ $room['capacity'] }}</span>
                                </div>
                                <div class="flex gap-4">
                                    @foreach($room['amenities'] as $amenity)
                                        <div class="text-slate-300" title="{{ $amenity['label'] }}">
                                            {!! $amenity['icon'] !!}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Booking Form -->
                    <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 p-10">
                        <form action="{{ route('guest.booking.store') }}" method="POST" class="space-y-8">
                            @csrf
                            <input type="hidden" name="room_id" value="{{ $room['id'] }}">

                            <div>
                                <h3 class="text-xl font-black text-slate-900 mb-6 tracking-tight">Guest Information</h3>
                                <div class="grid md:grid-cols-2 gap-6">
                                    <div class="space-y-2">
                                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Full Name</label>
                                        <input type="text" name="name" value="{{ auth()->user()->name }}" class="w-full px-6 py-4 bg-slate-50 border-slate-100 rounded-2xl text-sm font-bold text-slate-900 focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all" placeholder="Enter your full name">
                                    </div>
                                    <div class="space-y-2">
                                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Email Address</label>
                                        <input type="email" name="email" value="{{ auth()->user()->email }}" class="w-full px-6 py-4 bg-slate-50 border-slate-100 rounded-2xl text-sm font-bold text-slate-900 focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all" placeholder="Enter your email">
                                    </div>
                                    <div class="space-y-2">
                                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Phone Number</label>
                                        <input type="tel" name="phone" class="w-full px-6 py-4 bg-slate-50 border-slate-100 rounded-2xl text-sm font-bold text-slate-900 focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all" placeholder="+62 812 3456 7890">
                                    </div>
                                    <div class="space-y-2">
                                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Selected Room</label>
                                        <input type="text" readonly value="{{ $room['name'] }}" class="w-full px-6 py-4 bg-slate-100 border-transparent rounded-2xl text-sm font-bold text-slate-500 cursor-not-allowed">
                                    </div>
                                </div>
                            </div>

                            <div class="pt-8 border-t border-slate-50">
                                <h3 class="text-xl font-black text-slate-900 mb-6 tracking-tight">Stay Details</h3>
                                <div class="grid md:grid-cols-3 gap-6">
                                    <div class="space-y-2">
                                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Check In</label>
                                        <input type="date" name="check_in" value="{{ date('Y-m-d') }}" class="w-full px-6 py-4 bg-slate-50 border-slate-100 rounded-2xl text-sm font-bold text-slate-900 focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all">
                                    </div>
                                    <div class="space-y-2">
                                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Check Out</label>
                                        <input type="date" name="check_out" value="{{ date('Y-m-d', strtotime('+1 day')) }}" class="w-full px-6 py-4 bg-slate-50 border-slate-100 rounded-2xl text-sm font-bold text-slate-900 focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all">
                                    </div>
                                    <div class="space-y-2">
                                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Total Guests</label>
                                        <select name="guests" class="w-full px-6 py-4 bg-slate-50 border-slate-100 rounded-2xl text-sm font-bold text-slate-900 focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all appearance-none cursor-pointer">
                                            <option>1 Adult</option>
                                            <option selected>2 Adults</option>
                                            <option>2 Adults, 1 Child</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="pt-8 border-t border-slate-50">
                                <h3 class="text-xl font-black text-slate-900 mb-6 tracking-tight">Payment & Extras</h3>
                                <div class="space-y-6">
                                    <div class="space-y-2">
                                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Special Requests</label>
                                        <textarea name="requests" rows="4" class="w-full px-6 py-4 bg-slate-50 border-slate-100 rounded-2xl text-sm font-bold text-slate-900 focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all resize-none" placeholder="Any specific requirements? (e.g. Late check-in, dietary needs)"></textarea>
                                    </div>
                                    <div class="grid md:grid-cols-2 gap-6">
                                        <div class="space-y-2">
                                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Payment Method</label>
                                            <select name="payment_method" class="w-full px-6 py-4 bg-slate-50 border-slate-100 rounded-2xl text-sm font-bold text-slate-900 focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all appearance-none cursor-pointer">
                                                <option value="credit_card">Credit / Debit Card</option>
                                                <option value="bank_transfer">Bank Transfer</option>
                                                <option value="e_wallet">Digital Wallet (OVO, Dana)</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Final Actions -->
                            <div class="pt-10 border-t border-slate-50">
                                <div class="flex items-center gap-4 mb-8">
                                    <input type="checkbox" id="terms" required class="w-5 h-5 rounded-lg border-slate-200 text-indigo-600 focus:ring-indigo-600">
                                    <label for="terms" class="text-sm font-medium text-slate-500">I agree to the <a href="#" class="text-indigo-600 font-bold hover:underline">Terms of Service</a> and <a href="#" class="text-indigo-600 font-bold hover:underline">Privacy Policy</a>.</label>
                                </div>
                                <div class="flex flex-col sm:flex-row gap-4">
                                    <button type="submit" class="flex-1 px-10 py-5 bg-indigo-600 hover:bg-indigo-700 text-white font-black rounded-[2rem] shadow-xl shadow-indigo-100 transition-all active:scale-95 flex items-center justify-center gap-3 group">
                                        <span>Confirm & Pay Now</span>
                                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                                    </button>
                                    <a href="{{ route('guest.rooms.index') }}" class="px-10 py-5 bg-white border border-slate-200 text-slate-600 font-black rounded-[2rem] hover:bg-slate-50 transition-all text-center">
                                        Cancel
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Right Column: Summary -->
                <div class="lg:col-span-4">
                    <x-booking-summary-card :room="$room" :nights="2" />
                </div>
            </div>
        </div>
    </div>
</x-layouts.customer>
