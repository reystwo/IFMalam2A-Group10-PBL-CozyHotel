@props(['room', 'nights' => 1])

@php
    $pricePerNight = $room['price'];
    $subtotal = $pricePerNight * $nights;
    $serviceFee = 25.00;
    $taxRate = 0.10;
    $tax = $subtotal * $taxRate;
    $total = $subtotal + $serviceFee + $tax;
    $downPayment = $total * 0.15;
@endphp

<div class="bg-white rounded-[2.5rem] shadow-2xl shadow-slate-200/60 border border-slate-100 overflow-hidden sticky top-32">
    <div class="p-8">
        <h3 class="text-xl font-black text-slate-900 mb-6 tracking-tight">Booking Summary</h3>
        
        <div class="space-y-4 mb-8">
            <div class="flex justify-between items-center text-sm">
                <span class="font-bold text-slate-500">${{ number_format($pricePerNight, 2) }} x {{ $nights }} {{ $nights > 1 ? 'nights' : 'night' }}</span>
                <span class="font-black text-slate-900">${{ number_format($subtotal, 2) }}</span>
            </div>
            <div class="flex justify-between items-center text-sm text-slate-500">
                <span class="font-bold">Service Fee</span>
                <span class="font-black text-slate-900">${{ number_format($serviceFee, 2) }}</span>
            </div>
            <div class="flex justify-between items-center text-sm text-slate-500">
                <span class="font-bold">Tax (10%)</span>
                <span class="font-black text-slate-900">${{ number_format($tax, 2) }}</span>
            </div>
        </div>

        <div class="pt-6 border-t border-slate-100 mb-8">
            <div class="flex justify-between items-center mb-2">
                <span class="text-lg font-black text-slate-900">Total Price</span>
                <span class="text-2xl font-black text-indigo-600 tracking-tighter">${{ number_format($total, 2) }}</span>
            </div>
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest leading-relaxed">
                Includes all local taxes and fees.
            </p>
        </div>

        <!-- Down Payment Info -->
        <div class="bg-indigo-50/50 rounded-2xl p-5 mb-8 border border-indigo-100/50">
            <div class="flex justify-between items-center mb-1">
                <span class="text-xs font-black text-indigo-700 uppercase tracking-wider">Due Today (15%)</span>
                <span class="text-lg font-black text-indigo-700">${{ number_format($downPayment, 2) }}</span>
            </div>
            <p class="text-[10px] font-bold text-indigo-400 leading-relaxed uppercase tracking-tighter">
                Pay a small deposit now to secure your stay.
            </p>
        </div>

        <!-- Guarantees -->
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
