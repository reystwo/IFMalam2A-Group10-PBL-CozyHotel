<x-layouts.customer>
    <x-slot:title>My Bookings</x-slot>

    <div class="relative pt-40 pb-32 bg-slate-50 min-h-screen">
        <!-- Background accents -->
        <div class="absolute top-0 right-0 w-1/4 h-[400px] bg-indigo-100/30 rounded-bl-[100px] -z-0"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Header Section -->
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-8 mb-12">
                <div class="max-w-2xl">
                    <nav class="flex items-center gap-3 mb-8 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">
                        <a href="{{ route('customer.home') }}" class="hover:text-indigo-600 transition-colors">Home</a>
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg>
                        <span class="text-indigo-600">My Bookings</span>
                    </nav>
                    <h1 class="text-5xl font-black text-slate-900 tracking-tight mb-4">My Bookings</h1>
                    <p class="text-lg text-slate-500 font-medium">Track your reservations, manage check-ins, and explore your past stays at CozyHotel.</p>
                </div>
            </div>

            <!-- Statistics Section -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
                <div class="bg-white p-8 rounded-[2rem] shadow-xl shadow-slate-200/50 border border-slate-100">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4">Total Bookings</p>
                    <div class="flex items-end gap-3">
                        <span class="text-4xl font-black text-slate-900 leading-none">12</span>
                        <span class="text-xs font-bold text-emerald-500 bg-emerald-50 px-2 py-1 rounded-lg mb-1">+2 New</span>
                    </div>
                </div>
                <div class="bg-white p-8 rounded-[2rem] shadow-xl shadow-slate-200/50 border border-slate-100">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4">Active Stays</p>
                    <div class="flex items-end gap-3">
                        <span class="text-4xl font-black text-indigo-600 leading-none">1</span>
                        <span class="text-xs font-bold text-indigo-400 mb-1 tracking-tight">Checking in today</span>
                    </div>
                </div>
                <div class="bg-white p-8 rounded-[2rem] shadow-xl shadow-slate-200/50 border border-slate-100">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4">Completed</p>
                    <div class="flex items-end gap-3">
                        <span class="text-4xl font-black text-slate-900 leading-none">9</span>
                        <span class="text-xs font-bold text-slate-400 mb-1">Stays finished</span>
                    </div>
                </div>
                <div class="bg-white p-8 rounded-[2rem] shadow-xl shadow-slate-200/50 border border-slate-100">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4">Cancelled</p>
                    <div class="flex items-end gap-3">
                        <span class="text-4xl font-black text-rose-600 leading-none">2</span>
                        <span class="text-xs font-bold text-rose-400 mb-1">Reservations</span>
                    </div>
                </div>
            </div>

            <!-- Filter Section -->
            <div class="bg-white p-4 rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 mb-12">
                <form action="{{ route('guest.bookings.index') }}" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4 items-end">
                    <div class="col-span-2">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-2">Search Booking</label>
                        <input type="text" placeholder="Search ID or Room Name..." class="w-full px-6 py-4 bg-slate-50 border-slate-100 rounded-2xl text-sm font-bold text-slate-900 focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-2">Status</label>
                        <select class="w-full px-6 py-4 bg-slate-50 border-slate-100 rounded-2xl text-sm font-bold text-slate-900 focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all appearance-none cursor-pointer">
                            <option>All Status</option>
                            <option>Pending</option>
                            <option>Confirmed</option>
                            <option>Checked In</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-2">Duration</label>
                        <select class="w-full px-6 py-4 bg-slate-50 border-slate-100 rounded-2xl text-sm font-bold text-slate-900 focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all appearance-none cursor-pointer">
                            <option>Any Time</option>
                            <option>Last 30 Days</option>
                            <option>Last 6 Months</option>
                            <option>Year 2024</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-2">Sort</label>
                        <select class="w-full px-6 py-4 bg-slate-50 border-slate-100 rounded-2xl text-sm font-bold text-slate-900 focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all appearance-none cursor-pointer">
                            <option>Newest First</option>
                            <option>Oldest First</option>
                            <option>Price: High</option>
                        </select>
                    </div>
                    <div>
                        <button type="submit" class="w-full py-4 bg-slate-900 hover:bg-indigo-600 text-white font-black rounded-2xl shadow-xl shadow-slate-200 transition-all flex items-center justify-center gap-2 active:scale-95">
                            Filter
                        </button>
                    </div>
                </form>
            </div>

            <!-- Booking List -->
            @php
                $bookings = [
                    [
                        'id' => 'CZ-88291',
                        'status' => 'Confirmed',
                        'room_title' => 'Garden Deluxe Suite',
                        'room_image' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80',
                        'check_in' => 'Oct 24, 2024',
                        'check_out' => 'Oct 27, 2024',
                        'duration' => 3,
                        'guests' => 2,
                        'total_price' => 745.00,
                        'created_at' => 'Aug 12, 2024',
                    ],
                    [
                        'id' => 'CZ-88305',
                        'status' => 'Pending',
                        'room_title' => 'Classic Standard Room',
                        'room_image' => 'https://images.unsplash.com/photo-1566665797739-1674de7a421a?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80',
                        'check_in' => 'Nov 02, 2024',
                        'check_out' => 'Nov 04, 2024',
                        'duration' => 2,
                        'guests' => 1,
                        'total_price' => 280.00,
                        'created_at' => 'Aug 15, 2024',
                    ],
                    [
                        'id' => 'CZ-88122',
                        'status' => 'Completed',
                        'room_title' => 'Royal Penthouse',
                        'room_image' => 'https://images.unsplash.com/photo-1582719478250-c89cae4df85b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80',
                        'check_in' => 'Jul 10, 2024',
                        'check_out' => 'Jul 15, 2024',
                        'duration' => 5,
                        'guests' => 4,
                        'total_price' => 4250.00,
                        'created_at' => 'May 20, 2024',
                    ],
                ];
            @endphp

            @if(count($bookings) > 0)
                <div class="space-y-8 mb-20">
                    @foreach($bookings as $booking)
                        <x-booking-history-card :booking="$booking" />
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="flex items-center justify-between border-t border-slate-200 pt-10">
                    <p class="text-sm font-bold text-slate-400">Showing <span class="text-slate-900">1</span> to <span class="text-slate-900">3</span> of <span class="text-slate-900">12</span> bookings</p>
                    <div class="inline-flex gap-2">
                        <button class="w-12 h-12 flex items-center justify-center rounded-xl bg-slate-50 text-slate-400 cursor-not-allowed"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg></button>
                        <button class="w-12 h-12 flex items-center justify-center rounded-xl bg-indigo-600 text-white font-black shadow-lg">1</button>
                        <button class="w-12 h-12 flex items-center justify-center rounded-xl bg-white border border-slate-100 text-slate-600 font-black hover:bg-slate-50 transition-all">2</button>
                        <button class="w-12 h-12 flex items-center justify-center rounded-xl bg-white border border-slate-100 text-slate-600 font-black hover:bg-slate-50 transition-all"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg></button>
                    </div>
                </div>
            @else
                <!-- Empty State -->
                <div class="py-32 flex flex-col items-center justify-center text-center bg-white rounded-[4rem] border border-dashed border-slate-200">
                    <div class="w-32 h-32 bg-indigo-50 rounded-full flex items-center justify-center mb-10">
                        <svg class="w-16 h-16 text-indigo-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                    </div>
                    <h2 class="text-3xl font-black text-slate-900 mb-4 tracking-tight">No bookings found</h2>
                    <p class="text-slate-400 font-medium max-w-sm mb-12">You haven't made any reservations yet. Discover our premium rooms and start planning your next stay.</p>
                    <a href="{{ route('guest.rooms.index') }}" class="px-10 py-5 bg-indigo-600 text-white font-black rounded-2xl shadow-xl shadow-indigo-100 hover:bg-indigo-700 transition-all">
                        Browse Available Rooms
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-layouts.customer>
