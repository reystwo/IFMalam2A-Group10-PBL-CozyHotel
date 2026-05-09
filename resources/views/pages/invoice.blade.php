<x-layouts-admin>
    <x-slot:title>Invoice #{{ $id }} | CozyHotel</x-slot>

    @push('styles')
    <style>
        @media print {
            body { background: white; }
            header, nav, aside, footer, .no-print { display: none !important; }
            main { padding: 0 !important; margin: 0 !important; width: 100% !important; }
            .invoice-container { border: none !important; box-shadow: none !important; width: 100% !important; max-width: none !important; padding: 0 !important; }
            .max-w-7xl { max-width: none !important; }
            .px-4, .px-6, .px-8 { padding-left: 0 !important; padding-right: 0 !important; }
        }
    </style>
    @endpush

    <x-slot:header>
        <div class="flex items-center justify-between no-print">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Invoice Details</h1>
                <p class="text-sm text-slate-500 font-medium">Viewing invoice for transaction {{ $id }}</p>
            </div>
            <div class="flex gap-3">
                <x-ui.button variant="secondary" onclick="window.history.back()">
                    Back to Transactions
                </x-ui.button>
                <x-ui.button variant="primary" onclick="window.print()">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                    </svg>
                    Print Invoice
                </x-ui.button>
            </div>
        </div>
    </x-slot:header>

    <div class="max-w-4xl mx-auto invoice-container">
        <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden p-10 md:p-16">
            <!-- Invoice Header -->
            <div class="flex flex-col md:flex-row justify-between gap-8 mb-12">
                <div>
                    <div class="text-3xl font-extrabold text-indigo-600 tracking-tighter mb-4">CozyHotel</div>
                    <div class="text-sm text-slate-500 leading-relaxed">
                        123 Luxury Avenue, Suite 500<br>
                        Beverly Hills, CA 90210<br>
                        United States<br>
                        <span class="font-bold text-slate-700">+1 (555) 123-4567</span><br>
                        hello@cozyhotel.com
                    </div>
                </div>
                <div class="text-left md:text-right">
                    <h2 class="text-4xl font-black text-slate-900 uppercase tracking-tight mb-2">Invoice</h2>
                    <div class="space-y-1">
                        <p class="text-sm font-bold text-slate-500 uppercase tracking-wider">Invoice ID: <span class="text-slate-900">{{ $id }}</span></p>
                        <p class="text-sm font-bold text-slate-500 uppercase tracking-wider">Date: <span class="text-slate-900">{{ date('M d, Y') }}</span></p>
                        <p class="text-sm font-bold text-slate-500 uppercase tracking-wider">Booking ref: <span class="text-slate-900">#BK-2023-452</span></p>
                    </div>
                </div>
            </div>

            <!-- Billing Info -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 mb-12 py-8 border-y border-slate-100">
                <div>
                    <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-4">Guest Information</h3>
                    <div class="text-base font-bold text-slate-900 mb-1">John Doe</div>
                    <div class="text-sm text-slate-500 leading-relaxed">
                        john.doe@example.com<br>
                        +1 (234) 567-890<br>
                        789 Guest Street, Apt 12B<br>
                        New York, NY 10001
                    </div>
                </div>
                <div>
                    <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-4">Stay Details</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-xs text-slate-400 font-bold uppercase">Check-in</p>
                            <p class="text-sm font-bold text-slate-800">Oct 24, 2023</p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-400 font-bold uppercase">Check-out</p>
                            <p class="text-sm font-bold text-slate-800">Oct 27, 2023</p>
                        </div>
                        <div class="col-span-2">
                            <p class="text-xs text-slate-400 font-bold uppercase">Room Type</p>
                            <p class="text-sm font-bold text-slate-800">Deluxe Suite (#302)</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Itemized Table -->
            <div class="mb-12">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-xs font-bold text-slate-400 uppercase tracking-widest border-b border-slate-200">
                            <th class="py-4">Description</th>
                            <th class="py-4 text-center">Qty/Nights</th>
                            <th class="py-4 text-right">Unit Price</th>
                            <th class="py-4 text-right">Amount</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        <tr>
                            <td class="py-6">
                                <div class="font-bold text-slate-900">Accommodation</div>
                                <div class="text-xs text-slate-500 mt-1">Deluxe Suite Stay</div>
                            </td>
                            <td class="py-6 text-center text-slate-700 font-medium">3 Nights</td>
                            <td class="py-6 text-right text-slate-700 font-medium">$150.00</td>
                            <td class="py-6 text-right text-slate-900 font-bold">$450.00</td>
                        </tr>
                        <tr>
                            <td class="py-6">
                                <div class="font-bold text-slate-900">Facilities Usage</div>
                                <div class="text-xs text-slate-500 mt-1">Mini Bar & Room Service</div>
                            </td>
                            <td class="py-6 text-center text-slate-700 font-medium">1</td>
                            <td class="py-6 text-right text-slate-700 font-medium">$50.00</td>
                            <td class="py-6 text-right text-slate-900 font-bold">$50.00</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Summary Section -->
            <div class="flex flex-col md:flex-row justify-between gap-8 pt-8 border-t border-slate-200">
                <div class="max-w-sm">
                    <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-3">Notes & Payment Info</h3>
                    <p class="text-xs text-slate-500 leading-relaxed italic">
                        Please keep this invoice for your records. All prices are inclusive of local taxes. 
                        Payments made via Credit Card are subject to a 2% processing fee.
                    </p>
                </div>
                <div class="w-full md:w-64 space-y-3">
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-500 font-medium">Subtotal</span>
                        <span class="text-slate-900 font-bold">$500.00</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-500 font-medium">Tax (10%)</span>
                        <span class="text-slate-900 font-bold">$50.00</span>
                    </div>
                    <div class="flex justify-between text-lg pt-3 border-t border-slate-100">
                        <span class="text-slate-900 font-black uppercase tracking-tighter">Grand Total</span>
                        <span class="text-indigo-600 font-black">$550.00</span>
                    </div>
                    
                    <div class="mt-6 p-4 bg-slate-50 rounded-xl space-y-2">
                        <div class="flex justify-between text-xs">
                            <span class="text-emerald-600 font-bold">Total Paid</span>
                            <span class="text-emerald-600 font-black">-$550.00</span>
                        </div>
                        <div class="flex justify-between text-sm pt-2 border-t border-slate-200">
                            <span class="text-slate-900 font-bold">Balance Due</span>
                            <span class="text-slate-900 font-black">$0.00</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Invoice Footer -->
            <div class="mt-20 pt-10 border-t border-slate-100 flex flex-col md:flex-row items-center justify-between gap-6 text-center md:text-left">
                <div>
                    <p class="text-sm font-bold text-slate-900">Thank you for choosing CozyHotel!</p>
                    <p class="text-xs text-slate-400 font-medium">We hope to see you again soon.</p>
                </div>
                <div class="w-48 text-center border-t border-slate-300 pt-2">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Authorized Signature</p>
                </div>
            </div>
        </div>
        
        <div class="mt-8 text-center no-print pb-12">
            <p class="text-xs text-slate-400 font-medium">Generated automatically on {{ now()->format('Y-m-d H:i:s') }}</p>
        </div>
    </div>
</x-layouts-admin>
