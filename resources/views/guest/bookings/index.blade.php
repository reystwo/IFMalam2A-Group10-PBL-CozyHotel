<x-layouts.customer>
    <x-slot:title>My Bookings</x-slot:title>

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
                <a href="{{ route('guest.rooms.index') }}" class="px-8 py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-black rounded-2xl shadow-xl shadow-indigo-100 transition-all active:scale-95 text-center whitespace-nowrap">
                    + Book New Room
                </a>
            </div>

            <!-- Statistics Section -->
            @php
                $totalBookings = $bookings->count();
                $activeBookings = $bookings->whereIn('status', ['pending', 'confirmed', 'checked_in'])->count();
                $completedBookings = $bookings->where('status', 'completed')->count();
                $cancelledBookings = $bookings->where('status', 'cancelled')->count();
            @endphp

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
                <div class="bg-white p-8 rounded-[2rem] shadow-xl shadow-slate-200/50 border border-slate-100">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4">Total Bookings</p>
                    <div class="flex items-end gap-3">
                        <span class="text-4xl font-black text-slate-900 leading-none">{{ $totalBookings }}</span>
                        @if($activeBookings > 0)
                            <span class="text-xs font-bold text-emerald-500 bg-emerald-50 px-2 py-1 rounded-lg mb-1">+{{ $activeBookings }} Active</span>
                        @endif
                    </div>
                </div>
                <div class="bg-white p-8 rounded-[2rem] shadow-xl shadow-slate-200/50 border border-slate-100">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4">Active Stays</p>
                    <div class="flex items-end gap-3">
                        <span class="text-4xl font-black text-indigo-600 leading-none">{{ $activeBookings }}</span>
                        @if($activeBookings > 0)
                            <span class="text-xs font-bold text-indigo-400 mb-1 tracking-tight">Ongoing</span>
                        @endif
                    </div>
                </div>
                <div class="bg-white p-8 rounded-[2rem] shadow-xl shadow-slate-200/50 border border-slate-100">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4">Completed</p>
                    <div class="flex items-end gap-3">
                        <span class="text-4xl font-black text-slate-900 leading-none">{{ $completedBookings }}</span>
                        <span class="text-xs font-bold text-slate-400 mb-1">Stays finished</span>
                    </div>
                </div>
                <div class="bg-white p-8 rounded-[2rem] shadow-xl shadow-slate-200/50 border border-slate-100">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4">Cancelled</p>
                    <div class="flex items-end gap-3">
                        <span class="text-4xl font-black text-rose-600 leading-none">{{ $cancelledBookings }}</span>
                        <span class="text-xs font-bold text-rose-400 mb-1">Reservations</span>
                    </div>
                </div>
            </div>

            <!-- Booking List -->
            @if($bookings->count() > 0)
                <div class="space-y-8 mb-20">
                    @foreach($bookings as $booking)
                        <x-booking-history-card :booking="$booking" />
                    @endforeach
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
