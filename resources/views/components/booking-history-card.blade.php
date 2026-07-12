@props(['booking'])

@php
    $statusColors = [
        'pending' => 'bg-amber-50 text-amber-600 border-amber-100',
        'confirmed' => 'bg-emerald-50 text-emerald-600 border-emerald-100',
        'checked_in' => 'bg-indigo-50 text-indigo-600 border-indigo-100',
        'completed' => 'bg-slate-50 text-slate-600 border-slate-200',
        'cancelled' => 'bg-rose-50 text-rose-600 border-rose-100',
    ];
    $statusColor = $statusColors[$booking['status']] ?? 'bg-slate-50 text-slate-600 border-slate-200';
@endphp

<div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden group hover:shadow-2xl hover:shadow-indigo-100 transition-all duration-500 flex flex-col md:flex-row">
    <!-- Room Image Section -->
    <div class="md:w-72 h-64 md:h-auto overflow-hidden relative">
        <img src="{{ $booking['room_image'] }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="{{ $booking['room_title'] }}">
        <div class="absolute top-6 left-6">
            <span class="inline-flex items-center px-4 py-2 rounded-2xl border text-[10px] font-black uppercase tracking-widest shadow-sm backdrop-blur-md {{ $statusColor }}">
                {{ $booking['status_label'] ?? $booking['status'] }}
            </span>
        </div>
    </div>

    <!-- Info Section -->
    <div class="flex-1 p-8 flex flex-col">
        <div class="flex flex-col md:flex-row md:items-start justify-between gap-4 mb-6">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Booking ID: #{{ $booking['id'] }}</span>
                    <span class="w-1 h-1 bg-slate-200 rounded-full"></span>
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Created on {{ $booking['created_at'] }}</span>
                </div>
                <h3 class="text-2xl font-black text-slate-900 group-hover:text-indigo-600 transition-colors tracking-tight">{{ $booking['room_title'] }}</h3>
            </div>
            <div class="text-left md:text-right">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Total Payment</p>
                <p class="text-2xl font-black text-indigo-600 tracking-tighter">{{ $booking['total_price_formatted'] }}</p>
            </div>
        </div>

        <!-- Stay Details Grid -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 py-6 border-y border-slate-50 mb-8">
            <div>
                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Check In</span>
                <span class="text-sm font-bold text-slate-700">{{ $booking['check_in'] }}</span>
            </div>
            <div>
                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Check Out</span>
                <span class="text-sm font-bold text-slate-700">{{ $booking['check_out'] }}</span>
            </div>
            <div>
                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Duration</span>
                <span class="text-sm font-bold text-slate-700">{{ $booking['nights'] }} Nights</span>
            </div>
            <div>
                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Guest</span>
                <span class="text-sm font-bold text-slate-700">{{ $booking['guest_name'] }}</span>
            </div>
        </div>

        <!-- Footer Actions -->
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mt-auto">
            <div class="flex items-center gap-3">
                <span class="inline-flex items-center px-3 py-1 bg-indigo-50 text-indigo-700 text-[10px] font-black rounded-lg uppercase tracking-wider border border-indigo-100/50">
                    {{ ucfirst(str_replace('_', ' ', $booking['status'] ?? 'pending')) }}
                </span>
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-tight">
                    {{ $booking['guest_email'] }}
                </span>
            </div>

            <div class="flex items-center gap-3 w-full sm:w-auto">
                @if($booking['status'] === 'pending' || $booking['status'] === 'confirmed')
                    <form action="{{ route('guest.bookings.cancel', $booking['id']) }}" method="POST" class="flex-1 sm:flex-none">
                        @csrf
                        <button type="submit" class="w-full px-6 py-3.5 text-xs font-black text-rose-600 bg-rose-50 hover:bg-rose-100 rounded-2xl transition-all active:scale-95" onclick="return confirm('Are you sure you want to cancel this booking?')">
                            Cancel
                        </button>
                    </form>
                @endif
                <a href="{{ route('guest.bookings.invoice', $booking['id']) }}" class="flex-1 sm:flex-none px-6 py-3.5 text-xs font-black text-slate-600 bg-slate-50 hover:bg-slate-100 rounded-2xl transition-all active:scale-95 text-center">
                    Invoice
                </a>
                <a href="{{ route('guest.bookings.show', $booking['id']) }}" class="flex-1 sm:flex-none px-6 py-3.5 text-xs font-black text-white bg-indigo-600 hover:bg-indigo-700 rounded-2xl shadow-lg shadow-indigo-100 transition-all active:scale-95 text-center">
                    Details
                </a>
            </div>
        </div>
    </div>
</div>
