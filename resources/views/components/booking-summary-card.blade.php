@props(['room', 'nights' => 1])

@php
    $pricePerNight = $room['price'] ?? 0;
    $totalPrice = $pricePerNight * $nights;
@endphp

<div class="bg-white rounded-[2.5rem] shadow-2xl shadow-slate-200/60 border border-slate-100 overflow-hidden sticky top-32">
    <div class="p-8">
        <h3 class="text-xl font-black text-slate-900 mb-6 tracking-tight">Booking Summary</h3>

        <div class="space-y-4 mb-8">
            <div class="flex justify-between items-center text-sm">
                <span class="font-bold text-slate-500">Rp {{ number_format($pricePerNight, 0, ',', '.') }} x {{ $nights }} {{ $nights > 1 ? 'nights' : 'night' }}</span>
                <span class="font-black text-slate-900">Rp {{ number_format($totalPrice, 0, ',', '.') }}</span>
            </div>
        </div>

        <div class="pt-6 border-t border-slate-100 mb-8">
            <div class="flex justify-between items-center mb-2">
                <span class="text-lg font-black text-slate-900">Total Price</span>
                <span class="text-2xl font-black text-indigo-600 tracking-tighter">Rp {{ number_format($totalPrice, 0, ',', '.') }}</span>
            </div>
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest leading-relaxed">
                No hidden fees. Price includes all local taxes.
            </p>
        </div>

        <div class="space-y-3">
            <div class="flex items-center gap-3 text-[10px] font-black text-slate-500 uppercase tracking-wider">
                <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                Instant Confirmation
            </div>
            <div class="flex items-center gap-3 text-[10px] font-black text-slate-500 uppercase tracking-wider">
                <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                Secure Payment SSL
            </div>
            <div class="flex items-center gap-3 text-[10px] font-black text-slate-500 uppercase tracking-wider">
                <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                No Hidden Fees
            </div>
        </div>
    </div>
</div>
