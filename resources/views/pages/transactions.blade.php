<x-layouts-admin>
    <x-slot:title>Transactions | CozyHotel</x-slot>

    <x-slot:header>
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Financial Transactions</h1>
                <p class="text-sm text-slate-500 font-medium">Track payments, balances, and transaction history.</p>
            </div>
            <x-ui.button variant="primary" x-on:click="$dispatch('open-modal', 'add-payment')">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Record Payment
            </x-ui.button>
        </div>
    </x-slot:header>

    <!-- Transaction Table -->
    <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-slate-500 text-xs uppercase tracking-wider font-semibold bg-slate-50/50">
                        <th class="px-6 py-4">Transaction ID</th>
                        <th class="px-6 py-4">Guest & Booking</th>
                        <th class="px-6 py-4">Total Amount</th>
                        <th class="px-6 py-4">Paid</th>
                        <th class="px-6 py-4">Balance</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @php
                        $transactions = [
                            [
                                'id' => 'TRX-2023-001',
                                'customer' => 'John Doe',
                                'booking' => 'BK-20231024-452',
                                'total' => 450.00,
                                'paid' => 450.00,
                                'status' => 'fully_paid',
                                'history' => [
                                    ['date' => 'Oct 24, 2023', 'amount' => 67.50, 'method' => 'Credit Card', 'note' => 'Down Payment (15%)'],
                                    ['date' => 'Oct 26, 2023', 'amount' => 382.50, 'method' => 'Cash', 'note' => 'Final Payment']
                                ]
                            ],
                            [
                                'id' => 'TRX-2023-002',
                                'customer' => 'Alice Smith',
                                'booking' => 'BK-20231025-108',
                                'total' => 120.00,
                                'paid' => 18.00,
                                'status' => 'dp_paid',
                                'history' => [
                                    ['date' => 'Oct 25, 2023', 'amount' => 18.00, 'method' => 'Bank Transfer', 'note' => 'Down Payment (15%)']
                                ]
                            ],
                            [
                                'id' => 'TRX-2023-003',
                                'customer' => 'Robert Johnson',
                                'booking' => 'BK-20231026-991',
                                'total' => 1200.00,
                                'paid' => 180.00,
                                'status' => 'dp_paid',
                                'history' => [
                                    ['date' => 'Oct 26, 2023', 'amount' => 180.00, 'method' => 'Credit Card', 'note' => 'Down Payment (15%)']
                                ]
                            ]
                        ];
                    @endphp

                    @foreach($transactions as $trx)
                    <tr class="hover:bg-slate-50/50 transition-colors" x-data="{ expanded: false }">
                        <td class="px-6 py-4">
                            <span class="text-sm font-bold text-slate-900">{{ $trx['id'] }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-bold text-slate-900">{{ $trx['customer'] }}</div>
                            <div class="text-xs text-slate-500 font-medium">{{ $trx['booking'] }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm font-bold text-slate-900">${{ number_format($trx['total'], 2) }}</span>
                        </td>
                        <td class="px-6 py-4 text-emerald-600">
                            <span class="text-sm font-bold">${{ number_format($trx['paid'], 2) }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm font-bold {{ $trx['total'] - $trx['paid'] > 0 ? 'text-rose-600' : 'text-slate-400' }}">
                                ${{ number_format($trx['total'] - $trx['paid'], 2) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            @if($trx['status'] === 'fully_paid')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-100">
                                    Fully Paid
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-100">
                                    DP Paid
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <x-ui.button variant="ghost" size="xs" title="View Invoice" onclick="window.location.href='{{ route('invoices.show', $trx['id']) }}'">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </x-ui.button>
                                <x-ui.button variant="ghost" size="xs" @click="expanded = !expanded" title="View History">
                                    <svg class="w-4 h-4 transition-transform" :class="expanded ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </x-ui.button>
                                <x-ui.button variant="ghost" size="xs" class="text-indigo-600" title="Add Payment" x-on:click="$dispatch('open-modal', 'add-payment')">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                </x-ui.button>
                            </div>
                        </td>

                        <!-- Expanded History -->
                        <template x-if="expanded">
                            <tr class="bg-slate-50/50">
                                <td colspan="7" class="px-12 py-4">
                                    <div class="border-l-2 border-slate-200 pl-6 space-y-4">
                                        <h4 class="text-xs font-bold text-slate-500 uppercase tracking-wider">Payment History</h4>
                                        <div class="space-y-3">
                                            @foreach($trx['history'] as $payment)
                                            <div class="flex items-center justify-between bg-white p-3 rounded-xl border border-slate-100 shadow-sm">
                                                <div class="flex items-center">
                                                    <div class="w-8 h-8 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center mr-3">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                                    </div>
                                                    <div>
                                                        <div class="text-sm font-bold text-slate-900">${{ number_format($payment['amount'], 2) }}</div>
                                                        <div class="text-xs text-slate-500 font-medium">{{ $payment['date'] }} via {{ $payment['method'] }}</div>
                                                    </div>
                                                </div>
                                                <div class="text-xs text-slate-400 italic">{{ $payment['note'] }}</div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </template>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal for Add Payment -->
    <x-ui.modal name="add-payment" title="Record New Payment">
        <form action="#" method="POST" class="space-y-4">
            @csrf
            <x-ui.select 
                label="Transaction / Booking" 
                name="transaction_id" 
                :options="[
                    'TRX-2023-002' => 'Alice Smith (BK-20231025-108) - Bal: $102.00',
                    'TRX-2023-003' => 'Robert Johnson (BK-20231026-991) - Bal: $1020.00'
                ]" 
                required 
            />

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <x-ui.input label="Amount to Pay" name="amount" type="number" step="0.01" placeholder="0.00" required />
                <x-ui.select 
                    label="Payment Method" 
                    name="method" 
                    :options="[
                        'cash' => 'Cash',
                        'card' => 'Credit / Debit Card',
                        'transfer' => 'Bank Transfer',
                        'digital' => 'Digital Wallet'
                    ]" 
                    required 
                />
            </div>

            <x-ui.input label="Payment Date" name="payment_date" type="date" value="{{ date('Y-m-d') }}" required />
            <x-ui.input label="Notes" name="notes" placeholder="e.g. Final payment for room #302" />

            <x-slot:footer>
                <x-ui.button variant="secondary" x-on:click="show = false">Cancel</x-ui.button>
                <x-ui.button variant="primary">Record Payment</x-ui.button>
            </x-slot:footer>
        </form>
    </x-ui.modal>
</x-layouts-admin>
