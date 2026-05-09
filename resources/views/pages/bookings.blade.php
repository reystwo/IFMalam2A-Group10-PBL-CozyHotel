<x-layouts-admin>
    <x-slot:title>New Booking | CozyHotel</x-slot>

    <x-slot:header>
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Create Reservation</h1>
                <p class="text-sm text-slate-500 font-medium">Follow the steps to complete a new guest booking.</p>
            </div>
            <div class="flex items-center text-sm font-medium text-slate-400">
                <span class="flex items-center justify-center w-6 h-6 rounded-full border border-slate-200 mr-2">?</span>
                Booking Reference: <span class="text-slate-900 ml-1 font-bold">#BK-{{ date('Ymd') }}-{{ rand(100, 999) }}</span>
            </div>
        </div>
    </x-slot:header>

    <div x-data="{ 
        step: 1, 
        selectedCustomer: null, 
        checkIn: '', 
        checkOut: '', 
        selectedRoom: null,
        pricePerNight: 0,
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
        get downPayment() {
            return (this.totalPrice * 0.15).toFixed(2);
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
                            <span x-text="i" class="font-bold"></span>
                            <!-- Completed Icon -->
                            <template x-if="step > i">
                                <svg class="w-6 h-6 absolute" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                </svg>
                            </template>
                        </div>
                        <span 
                            class="mt-2 text-xs font-bold uppercase tracking-wider transition-colors duration-300"
                            :class="step >= i ? 'text-indigo-600' : 'text-slate-400'"
                            x-text="['Customer', 'Room & Dates', 'Payment'][i-1]"
                        ></span>
                    </div>
                </template>
            </div>
        </div>

        <!-- Step 1: Select Customer -->
        <div x-show="step === 1" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-8" x-transition:enter-end="opacity-100 translate-x-0">
            <div class="bg-white border border-slate-200 rounded-2xl p-8 shadow-sm">
                <h2 class="text-xl font-bold text-slate-900 mb-6">Who is the guest?</h2>
                
                <div class="space-y-6">
                    <x-ui.select 
                        label="Existing Customer" 
                        name="customer_id" 
                        :options="[
                            '1' => 'John Doe (john@example.com)',
                            '2' => 'Alice Smith (alice@example.com)',
                            '3' => 'Robert Johnson (robert@example.com)'
                        ]"
                        placeholder="Search existing customers..."
                        x-on:change="selectedCustomer = $event.target.value"
                    />

                    <div class="relative py-4">
                        <div class="absolute inset-0 flex items-center" aria-hidden="true">
                            <div class="w-full border-t border-slate-100"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-white text-slate-400 font-medium italic">or register a new one</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <x-ui.input label="Full Name" name="new_name" placeholder="Guest name" />
                        <x-ui.input label="Email" name="new_email" placeholder="Email address" />
                    </div>
                </div>

                <div class="mt-8 flex justify-end">
                    <x-ui.button variant="primary" x-on:click="step = 2" :disabled="!selectedCustomer && false">
                        Next: Select Room
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
                    <x-ui.input label="Check-in Date" name="check_in" type="date" x-model="checkIn" required />
                    <x-ui.input label="Check-out Date" name="check_out" type="date" x-model="checkOut" required />
                </div>

                <div x-show="checkIn && checkOut" class="space-y-4">
                    <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider">Available Rooms for these dates:</h3>
                    
                    <div class="grid grid-cols-1 gap-3">
                        <template x-for="room in [
                            {id: 1, no: '101', type: 'Standard', price: 120},
                            {id: 2, no: '202', type: 'Deluxe Suite', price: 250},
                            {id: 3, no: '301', type: 'Presidential Suite', price: 600}
                        ]" :key="room.id">
                            <div 
                                @click="selectedRoom = room.id; pricePerNight = room.price"
                                class="flex items-center justify-between p-4 rounded-xl border-2 cursor-pointer transition-all"
                                :class="selectedRoom === room.id ? 'border-indigo-600 bg-indigo-50/50' : 'border-slate-100 hover:border-slate-200'"
                            >
                                <div class="flex items-center">
                                    <div class="w-12 h-12 bg-white rounded-lg border border-slate-200 flex items-center justify-center mr-4 text-indigo-600">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                                    </div>
                                    <div>
                                        <div class="font-bold text-slate-900" x-text="'Room #' + room.no"></div>
                                        <div class="text-xs text-slate-500 font-medium" x-text="room.type"></div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="font-bold text-slate-900" x-text="'$' + room.price"></div>
                                    <div class="text-xs text-slate-400">per night</div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

                <div class="mt-8 flex justify-between">
                    <x-ui.button variant="secondary" x-on:click="step = 1">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        Back
                    </x-ui.button>
                    <x-ui.button variant="primary" x-on:click="step = 3" :disabled="!selectedRoom">
                        Next: Finalize Payment
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </x-ui.button>
                </div>
            </div>
        </div>

        <!-- Step 3: Summary & Payment -->
        <div x-show="step === 3" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-8" x-transition:enter-end="opacity-100 translate-x-0" style="display: none;">
            <div class="bg-white border border-slate-200 rounded-2xl p-8 shadow-sm">
                <h2 class="text-xl font-bold text-slate-900 mb-6">Booking Summary</h2>
                
                <div class="bg-slate-50 rounded-2xl p-6 mb-8 border border-slate-100">
                    <div class="grid grid-cols-2 gap-y-4 text-sm">
                        <div class="text-slate-500 font-medium">Guest:</div>
                        <div class="text-slate-900 font-bold text-right">John Doe</div>
                        
                        <div class="text-slate-500 font-medium">Stay:</div>
                        <div class="text-slate-900 font-bold text-right" x-text="nights + ' Nights (' + checkIn + ' to ' + checkOut + ')'"></div>
                        
                        <div class="text-slate-500 font-medium">Room:</div>
                        <div class="text-slate-900 font-bold text-right">#202 - Deluxe Suite</div>
                        
                        <div class="col-span-2 border-t border-slate-200 my-2"></div>
                        
                        <div class="text-slate-500 font-medium">Subtotal:</div>
                        <div class="text-slate-900 font-bold text-right" x-text="'$' + totalPrice.toFixed(2)"></div>
                        
                        <div class="text-slate-500 font-medium text-lg pt-2">Total Amount:</div>
                        <div class="text-indigo-600 font-extrabold text-right text-xl pt-2" x-text="'$' + totalPrice.toFixed(2)"></div>
                    </div>
                </div>

                <div class="p-4 bg-amber-50 rounded-xl border border-amber-100 mb-8">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zm-1 9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-bold text-amber-800">Down Payment Required</h3>
                            <p class="text-sm text-amber-700 mt-1">A 15% deposit is required to confirm this reservation.</p>
                            <div class="mt-2 text-lg font-extrabold text-amber-900" x-text="'Minimum Deposit: $' + downPayment"></div>
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex justify-between">
                    <x-ui.button variant="secondary" x-on:click="step = 2">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        Back
                    </x-ui.button>
                    <x-ui.button variant="primary" x-on:click="alert('Booking confirmed!')">
                        Confirm & Process Payment
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </x-ui.button>
                </div>
            </div>
        </div>
    </div>
</x-layouts-admin>
