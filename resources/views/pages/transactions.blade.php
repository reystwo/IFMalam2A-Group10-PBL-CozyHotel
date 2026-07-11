<x-layouts-admin>
    <x-slot:title>Transactions | CozyHotel</x-slot:title>

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

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="mb-6">
            <x-ui.alert type="success" :message="session('success')" />
        </div>
    @endif

    @if($errors->any())
        <div class="mb-6">
            <x-ui.alert type="error">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </x-ui.alert>
        </div>
    @endif

    {{-- Revenue Summary Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
            <div class="flex items-center gap-3">
                <div class="p-2.5 bg-indigo-50 rounded-xl">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <div>
                    <div class="text-xs text-slate-500 font-medium">Total Revenue</div>
                    <div class="text-xl font-bold text-slate-900">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
            <div class="flex items-center gap-3">
                <div class="p-2.5 bg-emerald-50 rounded-xl">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <div class="text-xs text-slate-500 font-medium">Total Paid</div>
                    <div class="text-xl font-bold text-emerald-600">Rp {{ number_format($totalPaid, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
            <div class="flex items-center gap-3">
                <div class="p-2.5 bg-rose-50 rounded-xl">
                    <svg class="w-6 h-6 text-rose-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <div class="text-xs text-slate-500 font-medium">Outstanding Balance</div>
                    <div class="text-xl font-bold {{ $totalBalance > 0 ? 'text-rose-600' : 'text-slate-400' }}">Rp {{ number_format($totalBalance, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Transaction Table --}}
    <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-slate-500 text-xs uppercase tracking-wider font-semibold bg-slate-50/50">
                        <th class="px-6 py-4">Booking</th>
                        <th class="px-6 py-4">Guest</th>
                        <th class="px-6 py-4">Total</th>
                        <th class="px-6 py-4">Paid</th>
                        <th class="px-6 py-4">Balance</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($bookings as $booking)
                    @php
                        $paid = $booking->paid_amount;
                        $balance = $booking->balance;
                        $paymentStatus = $booking->payment_status;
                    @endphp
                    <tr class="hover:bg-slate-50/50 transition-colors" x-data="{ expanded: false }">
                        <td class="px-6 py-4">
                            <div>
                                <span class="text-sm font-bold text-indigo-600">#{{ $booking->id }}</span>
                                <div class="text-xs text-slate-500">{{ $booking->room ? 'Room #' . $booking->room->room_number : '-' }}</div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-bold text-slate-900">{{ $booking->guest_name }}</div>
                            <div class="text-xs text-slate-500 font-medium">{{ $booking->check_in->format('d M') }} - {{ $booking->check_out->format('d M Y') }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm font-bold text-slate-900">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                        </td>
                        <td class="px-6 py-4 text-emerald-600">
                            <span class="text-sm font-bold">Rp {{ number_format($paid, 0, ',', '.') }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm font-bold {{ $balance > 0 ? 'text-rose-600' : 'text-slate-400' }}">
                                Rp {{ number_format($balance, 0, ',', '.') }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            @if($paymentStatus === 'fully_paid')
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-100">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    Lunas
                                </span>
                            @elseif($paymentStatus === 'dp_paid')
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-100">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                    DP Dibayar
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-rose-50 text-rose-700 border border-rose-100">
                                    <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                    Belum Bayar
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <button type="button" @click="expanded = !expanded"
                                    class="inline-flex items-center justify-center p-2 rounded-lg text-slate-500 hover:text-indigo-600 hover:bg-indigo-50 transition-all"
                                    title="Riwayat Pembayaran">
                                    <svg class="w-4 h-4 transition-transform" :class="expanded ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                                @if($balance > 0)
                                    <button type="button"
                                        x-on:click="$dispatch('open-modal', 'pay-booking-{{ $booking->id }}')"
                                        class="inline-flex items-center justify-center p-2 rounded-lg text-indigo-600 hover:bg-indigo-50 transition-all"
                                        title="Bayar">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                    </button>
                                @endif
                            </div>

                            {{-- Quick Pay Modal --}}
                            @if($balance > 0)
                            <x-ui.modal name="pay-booking-{{ $booking->id }}" title="Bayar Booking #{{ $booking->id }} — {{ $booking->guest_name }}">
                                <form action="{{ route('transactions.store') }}" method="POST" class="space-y-4">
                                    @csrf
                                    <input type="hidden" name="booking_id" value="{{ $booking->id }}">

                                    <div class="bg-slate-50 rounded-xl p-4 border border-slate-100 mb-4">
                                        <div class="grid grid-cols-2 gap-2 text-sm">
                                            <div class="text-slate-500">Total:</div>
                                            <div class="text-right font-bold">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</div>
                                            <div class="text-slate-500">Sudah Dibayar:</div>
                                            <div class="text-right font-bold text-emerald-600">Rp {{ number_format($paid, 0, ',', '.') }}</div>
                                            <div class="text-slate-500 font-medium">Sisa:</div>
                                            <div class="text-right font-bold text-rose-600">Rp {{ number_format($balance, 0, ',', '.') }}</div>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <x-ui.input label="Jumlah Bayar (Rp)" name="amount" type="number" placeholder="0" required />
                                        <div class="space-y-1.5">
                                            <label class="block text-sm font-semibold text-slate-700">Metode Bayar <span class="text-rose-500">*</span></label>
                                            <select name="payment_method" class="appearance-none block w-full px-4 py-2.5 bg-white border border-slate-200 focus:ring-indigo-500 focus:border-indigo-500 rounded-xl text-slate-900 text-sm transition-all focus:ring-1 outline-none" required>
                                                <option value="cash">💵 Cash</option>
                                                <option value="card">💳 Credit / Debit Card</option>
                                                <option value="transfer">🏦 Bank Transfer</option>
                                                <option value="digital">📱 Digital Wallet</option>
                                            </select>
                                        </div>
                                    </div>

                                    <x-ui.input label="Tanggal Bayar" name="payment_date" type="date" value="{{ date('Y-m-d') }}" required />
                                    <x-ui.input label="Catatan" name="note" placeholder="Contoh: DP 50%, Pelunasan, dll." />

                                    <x-slot:footer>
                                        <x-ui.button type="button" variant="secondary" x-on:click="show = false">Batal</x-ui.button>
                                        <x-ui.button type="submit" variant="primary">
                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                            Simpan Pembayaran
                                        </x-ui.button>
                                    </x-slot:footer>
                                </form>
                            </x-ui.modal>
                            @endif
                        </td>
                    </tr>
                    {{-- Expanded Payment History --}}
                    <tr x-show="expanded" x-transition class="bg-slate-50/50">
                        <td colspan="7" class="px-12 py-4">
                            <div class="border-l-2 border-slate-200 pl-6 space-y-4">
                                <h4 class="text-xs font-bold text-slate-500 uppercase tracking-wider">Riwayat Pembayaran</h4>
                                @if($booking->transactions->count() > 0)
                                    <div class="space-y-3">
                                        @foreach($booking->transactions->sortByDesc('payment_date') as $trx)
                                        <div class="flex items-center justify-between bg-white p-3 rounded-xl border border-slate-100 shadow-sm">
                                            <div class="flex items-center">
                                                <div class="w-8 h-8 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center mr-3">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                                </div>
                                                <div>
                                                    <div class="text-sm font-bold text-slate-900">Rp {{ number_format($trx->amount, 0, ',', '.') }}</div>
                                                    <div class="text-xs text-slate-500 font-medium">{{ $trx->payment_date->format('d M Y') }} via {{ $trx->method_label }}</div>
                                                </div>
                                            </div>
                                            <div class="text-xs text-slate-400 italic">{{ $trx->note ?? '-' }}</div>
                                        </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-sm text-slate-400 italic py-2">Belum ada pembayaran.</p>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-16 h-16 rounded-2xl bg-slate-100 flex items-center justify-center mb-4">
                                    <svg class="w-8 h-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <h3 class="text-sm font-bold text-slate-700 mb-1">Belum ada transaksi</h3>
                                <p class="text-sm text-slate-500">Buat booking terlebih dahulu untuk mulai mencatat pembayaran.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/30 flex flex-col sm:flex-row items-center justify-between gap-3">
            <p class="text-xs text-slate-500">
                Halaman <span class="font-bold text-slate-700">{{ $bookings->currentPage() }}</span> dari <span class="font-bold text-slate-700">{{ $bookings->lastPage() }}</span>
            </p>
            <div>
                {{ $bookings->links() }}
            </div>
        </div>
    </div>

    {{-- Global Add Payment Modal (for header button) --}}
    <x-ui.modal name="add-payment" title="Record New Payment">
        <form id="form-konfirmasi-pembayaran" action="{{ route('transactions.store') }}" method="POST" class="space-y-4">
            @csrf
            <div class="space-y-1.5">
                <label class="block text-sm font-semibold text-slate-700">Pilih Booking <span class="text-rose-500">*</span></label>
                <select name="booking_id" class="appearance-none block w-full px-4 py-2.5 bg-white border border-slate-200 focus:ring-indigo-500 focus:border-indigo-500 rounded-xl text-slate-900 text-sm transition-all focus:ring-1 outline-none" required>
                    <option value="" disabled selected>Pilih booking...</option>
                    @foreach($bookings as $b)
                        @if($b->balance > 0)
                            <option value="{{ $b->id }}">
                                #{{ $b->id }} — {{ $b->guest_name }} (Sisa: Rp {{ number_format($b->balance, 0, ',', '.') }})
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <x-ui.input label="Jumlah Bayar (Rp)" name="amount" type="number" placeholder="0" required />
                <div class="space-y-1.5">
                    <label class="block text-sm font-semibold text-slate-700">Metode Bayar <span class="text-rose-500">*</span></label>
                    <select name="payment_method" class="appearance-none block w-full px-4 py-2.5 bg-white border border-slate-200 focus:ring-indigo-500 focus:border-indigo-500 rounded-xl text-slate-900 text-sm transition-all focus:ring-1 outline-none" required>
                        <option value="cash">💵 Cash</option>
                        <option value="card">💳 Credit / Debit Card</option>
                        <option value="transfer">🏦 Bank Transfer</option>
                        <option value="digital">📱 Digital Wallet</option>
                    </select>
                </div>
            </div>

            <x-ui.input label="Tanggal Bayar" name="payment_date" type="date" value="{{ date('Y-m-d') }}" required />
            <x-ui.input label="Catatan" name="note" placeholder="Contoh: DP 50%, Pelunasan, dll." />

            <x-slot:footer>
                <x-ui.button type="button" variant="secondary" x-on:click="show = false">Cancel</x-ui.button>
                <x-ui.button type="submit" variant="primary" form="form-konfirmasi-pembayaran">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Record Payment
                </x-ui.button>
            </x-slot:footer>
        </form>
    </x-ui.modal>
</x-layouts-admin>
