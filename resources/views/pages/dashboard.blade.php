<x-layouts-admin>
    <x-slot:title>Admin Dashboard | CozyHotel</x-slot>

    <x-slot:header>
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Dashboard Overview</h1>
                <p class="text-sm text-slate-500 font-medium">Welcome back, {{ auth()->user()->name ?? 'Admin' }}. Here's what's happening today.</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <x-ui.button variant="secondary">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                    Export Report
                </x-ui.button>
                <x-ui.button variant="primary" x-on:click="$dispatch('open-modal', 'new-reservation')">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    New Reservation
                </x-ui.button>
            </div>
        </div>
    </x-slot:header>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <div class="p-2 bg-indigo-50 rounded-lg text-indigo-600">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
                <span class="text-emerald-600 text-xs font-bold bg-emerald-50 px-2 py-1 rounded-full"></span>
            </div>
            <div class="text-2xl font-bold text-slate-900">15</div>
            <div class="text-sm font-medium text-slate-500">Total Rooms</div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <div class="p-2 bg-emerald-50 rounded-lg text-emerald-600">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <span class="text-emerald-600 text-xs font-bold bg-emerald-50 px-2 py-1 rounded-full"></span>
            </div>
            <div class="text-2xl font-bold text-slate-900">1</div>
            <div class="text-sm font-medium text-slate-500">Active Guests</div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <div class="p-2 bg-amber-50 rounded-lg text-amber-600">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                </div>
                <span class="text-amber-600 text-xs font-bold bg-amber-50 px-2 py-1 rounded-full"></span>
            </div>
            <div class="text-2xl font-bold text-slate-900">2</div>
            <div class="text-sm font-medium text-slate-500">Total Transactions</div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
        <!-- Chart Placeholder -->
        <div class="lg:col-span-2 bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm flex flex-col">
            <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between bg-slate-50/50">
                <h2 class="text-lg font-bold text-slate-900">Occupancy & Revenue</h2>
                <div class="flex gap-2">
                    <span class="flex items-center text-xs font-medium text-slate-500">
                        <span class="w-3 h-3 bg-indigo-500 rounded-full mr-1.5"></span> Revenue
                    </span>
                    <span class="flex items-center text-xs font-medium text-slate-500">
                        <span class="w-3 h-3 bg-slate-300 rounded-full mr-1.5"></span> Occupancy
                    </span>
                </div>
            </div>
            <div class="flex-1 p-6 flex items-center justify-center min-h-[300px]">
                <div class="w-full h-full border-2 border-dashed border-slate-200 rounded-xl flex flex-col items-center justify-center text-slate-400 text-center p-4">
                    <svg class="w-12 h-12 mb-3 opacity-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                    </svg>
                    <p class="text-sm font-medium italic">Chart visualization will be rendered here (e.g. Chart.js or ApexCharts)</p>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm flex flex-col">
            <div class="px-6 py-4 border-b border-slate-200 bg-slate-50/50">
                <h2 class="text-lg font-bold text-slate-900">Quick Actions</h2>
            </div>
            <div class="p-6 space-y-4">
                <x-ui.button variant="secondary" fullWidth class="justify-start">
                    <svg class="w-5 h-5 mr-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Check Availability
                </x-ui.button>
                <x-ui.button variant="secondary" fullWidth class="justify-start">
                    <svg class="w-5 h-5 mr-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    Manage Staff
                </x-ui.button>
                <x-ui.button variant="secondary" fullWidth class="justify-start">
                    <svg class="w-5 h-5 mr-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Settings
                </x-ui.button>
            </div>
        </div>
    </div>

    <!-- Recent Activity Table -->
<!--    <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm">
        <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between bg-slate-50/50">
            <h2 class="text-lg font-bold text-slate-900">Recent Transactions</h2>
            <x-ui.button variant="ghost" size="sm">View all</x-ui.button>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-slate-500 text-xs uppercase tracking-wider font-semibold">
                        <th class="px-6 py-4">Customer</th>
                        <th class="px-6 py-4">Room</th>
                        <th class="px-6 py-4">Check-in</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Amount</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="h-8 w-8 rounded-full bg-indigo-100 mr-3 flex items-center justify-center text-xs font-bold text-indigo-600">JD</div>
                                <div class="text-sm font-bold text-slate-900">John Doe</div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-600 font-medium">Deluxe Suite #302</td>
                        <td class="px-6 py-4 text-sm text-slate-500">Oct 24, 2023</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-100">Confirmed</span>
                        </td>
                        <td class="px-6 py-4 text-right text-sm font-bold text-slate-900">$450.00</td>
                    </tr>
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="h-8 w-8 rounded-full bg-slate-100 mr-3 flex items-center justify-center text-xs font-bold text-slate-600">AS</div>
                                <div class="text-sm font-bold text-slate-900">Alice Smith</div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-600 font-medium">Standard Room #105</td>
                        <td class="px-6 py-4 text-sm text-slate-500">Oct 25, 2023</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-100">Pending</span>
                        </td>
                        <td class="px-6 py-4 text-right text-sm font-bold text-slate-900">$120.00</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div> --!>

    <!-- Modal for New Reservation -->
    <x-ui.modal name="new-reservation" title="Create New Reservation">
        <form action="#" method="POST" class="space-y-4">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <x-ui.input label="Customer Name" name="customer_name" placeholder="e.g. John Doe" required />
                <x-ui.input label="Email Address" name="email" type="email" placeholder="john@example.com" required />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <x-ui.select
                    label="Room Type"
                    name="room_type"
                    :options="[
                        'standard' => 'Standard Room',
                        'deluxe' => 'Deluxe Suite',
                        'family' => 'Family Room',
                        'presidential' => 'Presidential Suite'
                    ]"
                    required
                />
                <x-ui.input label="Check-in Date" name="check_in" type="date" required />
            </div>

            <x-ui.input label="Special Requests" name="notes" placeholder="Any special requirements?" />

            <x-slot:footer>
                <x-ui.button variant="secondary" x-on:click="show = false">Cancel</x-ui.button>
                <x-ui.button variant="primary">Confirm Reservation</x-ui.button>
            </x-slot:footer>
        </form>
    </x-ui.modal>
</x-layouts-admin>
