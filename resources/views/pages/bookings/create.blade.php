<x-layouts-admin>
    <x-slot:title>New Booking | CozyHotel</x-slot:title>

    <x-slot:header>
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Create Reservation</h1>
                <p class="text-sm text-slate-500 font-medium">Follow the steps to complete a new guest booking.</p>
            </div>
            <a href="{{ route('bookings.index') }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-slate-700 transition-colors">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali ke Daftar
            </a>
        </div>
    </x-slot:header>

    {{-- Flash Messages --}}
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

    <div x-data="{
        step: 1,
        selectedCustomerId: '',
        selectedCustomerName: '',
        selectedCustomerEmail: '',
        guestName: '',
        guestEmail: '',
        checkIn: '',
        checkOut: '',
        selectedRoomId: '',
        selectedRoomNumber: '',
        selectedRoomType: '',
        pricePerNight: 0,
        useExisting: true,
        get effectiveName() {
            return this.useExisting ? this.selectedCustomerName : this.guestName;
        },
        get effectiveEmail() {
            return this.useExisting ? this.selectedCustomerEmail : this.guestEmail;
        },
        get nights() {
            if (!this.checkIn || !this.checkOut) return 0;
            const start = new Date(this.checkIn);
            const end = new Date(this.checkOut);
            const diff = Math.ceil((end - start) / (1000 * 60 * 60 * 24));
            return diff > 0 ? diff : 0;
        },
        get totalPrice() {
            return this.nights * this.pricePerNight;
        },
        get canGoStep2() {
            return (this.useExisting && this.selectedCustomerId) || (!this.useExisting && this.guestName && this.guestEmail);
        },
        get canGoStep3() {
            return this.selectedRoomId && this.checkIn && this.checkOut && this.nights > 0;
        },
        formatRupiah(val) {
            return new Intl.NumberFormat('id-ID').format(val);
        },
        selectCustomer(id, name, email) {
            this.selectedCustomerId = id;
            this.selectedCustomerName = name;
            this.selectedCustomerEmail = email;
        },
        selectRoom(id, number, type, price) {
            this.selectedRoomId = id;
            this.selectedRoomNumber = number;
            this.selectedRoomType = type;
            this.pricePerNight = price;
        }
    }" class="max-w-4xl mx-auto">

        <!-- Step Progress Indicator -->
        <div class="mb-12 relative">
            <div class="absolute inset-0 flex items-center" aria-hidden="true">
                <div class="w-full border-t border-slate-200"></div>
            </div>
            <div class="relative flex justify-between">
                <template x-for="i in [1, 2, 3]">
                    <div class="flex flex-col items-center">
                        <div
                            class="w-10 h-10 flex items-center justify-center rounded-full border-2 transition-all duration-300 relative z-10"
                            :class="step >= i ? 'bg-indigo-600 border-indigo-600 text-white shadow-lg shadow-indigo-200' : 'bg-white border-slate-200 text-slate-400'"
                        >
                            <template x-if="step > i">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                </svg>
                            </template>
                            <template x-if="step <= i">
                                <span x-text="i" class="font-bold text-sm"></span>
                            </template>
                        </div>
                        <span
                            class="mt-2 text-xs font-bold uppercase tracking-wider transition-colors duration-300"
                            :class="step >= i ? 'text-indigo-600' : 'text-slate-400'"
                            x-text="['Customer', 'Room & Dates', 'Confirmation'][i-1]"
                        ></span>
                    </div>
                </template>
            </div>
        </div>

        <!-- Step 1: Select Customer -->
        <div x-show="step === 1" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-8" x-transition:enter-end="opacity-100 translate-x-0">
            <div class="bg-white border border-slate-200 rounded-2xl p-8 shadow-sm">
                <h2 class="text-xl font-bold text-slate-900 mb-6">Who is the guest?</h2>

                {{-- Toggle: Existing or New --}}
                <div class="flex gap-3 mb-6">
                    <button type="button" @click="useExisting = true"
                        class="flex-1 px-4 py-3 rounded-xl border-2 text-sm font-bold transition-all"
                        :class="useExisting ? 'border-indigo-600 bg-indigo-50 text-indigo-700' : 'border-slate-200 text-slate-500 hover:border-slate-300'">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                        Customer Existing
                    </button>
                    <button type="button" @click="useExisting = false"
                        class="flex-1 px-4 py-3 rounded-xl border-2 text-sm font-bold transition-all"
                        :class="!useExisting ? 'border-indigo-600 bg-indigo-50 text-indigo-700' : 'border-slate-200 text-slate-500 hover:border-slate-300'">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" /></svg>
                        Tamu Baru
                    </button>
                </div>

                {{-- Existing Customer List --}}
                <div x-show="useExisting" class="space-y-3 max-h-80 overflow-y-auto pr-1">
                    @forelse($customers as $customer)
                        <div
                            @click="selectCustomer('{{ $customer->id }}', '{{ $customer->name }}', '{{ $customer->email }}')"
                            class="flex items-center justify-between p-4 rounded-xl border-2 cursor-pointer transition-all"
                            :class="selectedCustomerId == '{{ $customer->id }}' ? 'border-indigo-600 bg-indigo-50/50' : 'border-slate-100 hover:border-slate-200'"
                        >
                            <div class="flex items-center">
                                <div class="h-10 w-10 rounded-full bg-indigo-50 flex items-center justify-center text-indigo-600 font-bold text-sm border border-indigo-100">
                                    {{ collect(explode(' ', $customer->name))->map(fn($n) => substr($n, 0, 1))->join('') }}
                                </div>
                                <div class="ml-3">
                                    <div class="text-sm font-bold text-slate-900">{{ $customer->name }}</div>
                                    <div class="text-xs text-slate-500">{{ $customer->email }} · {{ $customer->phone ?? 'No phone' }}</div>
                                </div>
                            </div>
                            <div x-show="selectedCustomerId == '{{ $customer->id }}'" class="text-indigo-600">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <p class="text-sm text-slate-500">Belum ada customer terdaftar.</p>
                            <a href="{{ route('customers.index') }}" class="text-sm text-indigo-600 font-medium hover:underline mt-1 inline-block">Tambah customer dulu →</a>
                        </div>
                    @endforelse
                </div>

                {{-- New Guest Form --}}
                <div x-show="!useExisting" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="w-full">
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Tamu <span class="text-rose-500">*</span></label>
                            <input type="text" x-model="guestName" class="block w-full px-4 py-2.5 bg-white border border-slate-200 focus:ring-indigo-500 focus:border-indigo-500 rounded-xl text-slate-900 text-sm placeholder-slate-400 transition-all focus:ring-1 outline-none" placeholder="Nama lengkap tamu">
                        </div>
                        <div class="w-full">
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Email <span class="text-rose-500">*</span></label>
                            <input type="email" x-model="guestEmail" class="block w-full px-4 py-2.5 bg-white border border-slate-200 focus:ring-indigo-500 focus:border-indigo-500 rounded-xl text-slate-900 text-sm placeholder-slate-400 transition-all focus:ring-1 outline-none" placeholder="email@contoh.com">
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex justify-end">
                    <x-ui.button type="button" variant="primary" x-on:click="step = 2" x-bind:disabled="!canGoStep2">
                        Next: Pilih Kamar
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </x-ui.button>
                </div>
            </div>
        </div>

        <!-- Step 2: Select Date & Room -->
        <div x-show="step === 2" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-8" x-transition:enter-end="opacity-100 translate-x-0" style="display: none;">
            <div class="bg-white border border-slate-200 rounded-2xl p-8 shadow-sm">
                <h2 class="text-xl font-bold text-slate-900 mb-6">Stay Duration & Room Selection</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div class="w-full">
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Check-in Date <span class="text-rose-500">*</span></label>
                        <input type="date" x-model="checkIn" min="{{ date('Y-m-d') }}" class="block w-full px-4 py-2.5 bg-white border border-slate-200 focus:ring-indigo-500 focus:border-indigo-500 rounded-xl text-slate-900 text-sm transition-all focus:ring-1 outline-none">
                    </div>
                    <div class="w-full">
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Check-out Date <span class="text-rose-500">*</span></label>
                        <input type="date" x-model="checkOut" :min="checkIn" class="block w-full px-4 py-2.5 bg-white border border-slate-200 focus:ring-indigo-500 focus:border-indigo-500 rounded-xl text-slate-900 text-sm transition-all focus:ring-1 outline-none">
                    </div>
                </div>

                <div x-show="nights > 0" class="mb-4 p-3 bg-indigo-50 rounded-xl border border-indigo-100">
                    <p class="text-sm font-bold text-indigo-700">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        Durasi menginap: <span x-text="nights"></span> malam
                    </p>
                </div>

                <div x-show="checkIn && checkOut && nights > 0" class="space-y-4">
                    <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider">Pilih Kamar yang Tersedia:</h3>

                    <div class="grid grid-cols-1 gap-3 max-h-72 overflow-y-auto pr-1">
                        @forelse($availableRooms as $room)
                            <div
                                @click="selectRoom('{{ $room->id }}', '{{ $room->room_number }}', '{{ $room->roomType->name }}', {{ $room->roomType->price }})"
                                class="flex items-center justify-between p-4 rounded-xl border-2 cursor-pointer transition-all"
                                :class="selectedRoomId == '{{ $room->id }}' ? 'border-indigo-600 bg-indigo-50/50' : 'border-slate-100 hover:border-slate-200'"
                            >
                                <div class="flex items-center">
                                    <div class="w-12 h-12 bg-white rounded-lg border border-slate-200 flex items-center justify-center mr-4 text-indigo-600">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                                    </div>
                                    <div>
                                        <div class="font-bold text-slate-900 text-sm">Room #{{ $room->room_number }}</div>
                                        <div class="text-xs text-slate-500 font-medium">{{ $room->roomType->name }}</div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="font-bold text-slate-900 text-sm">Rp {{ number_format($room->roomType->price, 0, ',', '.') }}</div>
                                    <div class="text-xs text-slate-400">per malam</div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8">
                                <p class="text-sm text-slate-500">Tidak ada kamar yang tersedia saat ini.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <div class="mt-8 flex justify-between">
                    <x-ui.button type="button" variant="secondary" x-on:click="step = 1">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        Back
                    </x-ui.button>
                    <x-ui.button type="button" variant="primary" x-on:click="step = 3" x-bind:disabled="!canGoStep3">
                        Next: Konfirmasi
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </x-ui.button>
                </div>
            </div>
        </div>

        <!-- Step 3: Summary & Confirm -->
        <div x-show="step === 3" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-8" x-transition:enter-end="opacity-100 translate-x-0" style="display: none;">
            <div class="bg-white border border-slate-200 rounded-2xl p-8 shadow-sm">
                <h2 class="text-xl font-bold text-slate-900 mb-6">Booking Summary</h2>

                <div class="bg-slate-50 rounded-2xl p-6 mb-8 border border-slate-100">
                    <div class="grid grid-cols-2 gap-y-4 text-sm">
                        <div class="text-slate-500 font-medium">Tamu:</div>
                        <div class="text-slate-900 font-bold text-right" x-text="effectiveName"></div>

                        <div class="text-slate-500 font-medium">Email:</div>
                        <div class="text-slate-900 font-bold text-right" x-text="effectiveEmail"></div>

                        <div class="text-slate-500 font-medium">Kamar:</div>
                        <div class="text-slate-900 font-bold text-right">
                            <span x-text="'#' + selectedRoomNumber"></span> — <span x-text="selectedRoomType"></span>
                        </div>

                        <div class="text-slate-500 font-medium">Durasi:</div>
                        <div class="text-slate-900 font-bold text-right" x-text="nights + ' Malam (' + checkIn + ' s/d ' + checkOut + ')'"></div>

                        <div class="text-slate-500 font-medium">Harga / Malam:</div>
                        <div class="text-slate-900 font-bold text-right" x-text="'Rp ' + formatRupiah(pricePerNight)"></div>

                        <div class="col-span-2 border-t border-slate-200 my-2"></div>

                        <div class="text-slate-500 font-medium text-lg pt-2">Total:</div>
                        <div class="text-indigo-600 font-extrabold text-right text-xl pt-2" x-text="'Rp ' + formatRupiah(totalPrice)"></div>
                    </div>
                </div>

                <form method="POST" action="{{ route('bookings.store') }}">
                    @csrf
                    <input type="hidden" name="customer_id" x-bind:value="useExisting ? selectedCustomerId : ''">
                    <input type="hidden" name="guest_name" x-bind:value="effectiveName">
                    <input type="hidden" name="guest_email" x-bind:value="effectiveEmail">
                    <input type="hidden" name="room_id" x-bind:value="selectedRoomId">
                    <input type="hidden" name="check_in" x-bind:value="checkIn">
                    <input type="hidden" name="check_out" x-bind:value="checkOut">

                    <div class="flex justify-between">
                        <x-ui.button type="button" variant="secondary" x-on:click="step = 2">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                            Back
                        </x-ui.button>
                        <x-ui.button type="submit" variant="primary">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Confirm & Create Booking
                        </x-ui.button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts-admin>
