<x-layouts-admin>
    <x-slot:title>Room Management | CozyHotel</x-slot>

    <x-slot:header>
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Room Management</h1>
                <p class="text-sm text-slate-500 font-medium">Manage your hotel rooms, types, and real-time status.</p>
            </div>
            <x-ui.button variant="primary" x-on:click="$dispatch('open-modal', 'add-room')">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add New Room
            </x-ui.button>
        </div>
    </x-slot:header>

    <!-- Filters & Search Placeholder -->
    <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-sm mb-6 flex flex-col md:flex-row gap-4 items-center justify-between">
        <div class="flex flex-wrap items-center gap-3 w-full md:w-auto">
            <div class="relative w-full md:w-64">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </span>
                <input type="text" class="block w-full pl-10 pr-3 py-2 border border-slate-200 rounded-xl text-sm focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 outline-none" placeholder="Search rooms...">
            </div>
            <x-ui.select 
                name="filter_type" 
                :options="['all' => 'All Types', 'standard' => 'Standard', 'deluxe' => 'Deluxe', 'suite' => 'Suite']" 
                placeholder="All Types"
                class="!py-1.5"
            />
            <x-ui.select 
                name="filter_status" 
                :options="['all' => 'All Status', 'available' => 'Available', 'occupied' => 'Occupied', 'cleaning' => 'Cleaning']" 
                placeholder="All Status"
                class="!py-1.5"
            />
        </div>
        <div class="text-sm text-slate-500 font-medium">
            Showing <span class="text-slate-900 font-bold">12</span> of <span class="text-slate-900 font-bold">128</span> rooms
        </div>
    </div>

    <!-- Rooms Table -->
    <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-slate-500 text-xs uppercase tracking-wider font-semibold bg-slate-50/50">
                        <th class="px-6 py-4">Room No.</th>
                        <th class="px-6 py-4">Room Type</th>
                        <th class="px-6 py-4">Floor</th>
                        <th class="px-6 py-4">Price / Night</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @php
                        $rooms = [
                            ['no' => '101', 'type' => 'Standard', 'floor' => '1st', 'price' => '$120', 'status' => 'available'],
                            ['no' => '102', 'type' => 'Standard', 'floor' => '1st', 'price' => '$120', 'status' => 'occupied'],
                            ['no' => '201', 'type' => 'Deluxe', 'floor' => '2nd', 'price' => '$250', 'status' => 'cleaning'],
                            ['no' => '202', 'type' => 'Deluxe', 'floor' => '2nd', 'price' => '$250', 'status' => 'available'],
                            ['no' => '301', 'type' => 'Suite', 'floor' => '3rd', 'price' => '$450', 'status' => 'occupied'],
                            ['no' => '302', 'type' => 'Suite', 'floor' => '3rd', 'price' => '$450', 'status' => 'available'],
                        ];
                    @endphp

                    @foreach($rooms as $room)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-6 py-4">
                            <span class="text-sm font-bold text-slate-900">#{{ $room['no'] }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm text-slate-600 font-medium">{{ $room['type'] }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm text-slate-500">{{ $room['floor'] }} Floor</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm font-bold text-slate-900">{{ $room['price'] }}</span>
                        </td>
                        <td class="px-6 py-4">
                            @if($room['status'] === 'available')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-100">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5"></span>
                                    Available
                                </span>
                            @elseif($room['status'] === 'occupied')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-rose-50 text-rose-700 border border-rose-100">
                                    <span class="w-1.5 h-1.5 rounded-full bg-rose-500 mr-1.5"></span>
                                    Occupied
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-100">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500 mr-1.5"></span>
                                    Cleaning
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <x-ui.button variant="ghost" size="xs" title="Edit Room">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </x-ui.button>
                                <x-ui.button variant="ghost" size="xs" class="text-rose-600 hover:bg-rose-50 hover:text-rose-700" title="Delete Room">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </x-ui.button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/30 flex items-center justify-between">
            <p class="text-xs text-slate-500">Last sync: Just now</p>
            <div class="flex gap-1">
                <x-ui.button variant="secondary" size="xs" disabled>Previous</x-ui.button>
                <x-ui.button variant="secondary" size="xs">Next</x-ui.button>
            </div>
        </div>
    </div>

    <!-- Modal for Add Room -->
    <x-ui.modal name="add-room" title="Add New Room">
        <form action="#" method="POST" class="space-y-4">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <x-ui.input label="Room Number" name="room_number" placeholder="e.g. 101" required />
                <x-ui.input label="Floor" name="floor" placeholder="e.g. 1st" required />
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
                <x-ui.input label="Price per Night" name="price" type="number" placeholder="0.00" required />
            </div>

            <x-ui.select 
                label="Initial Status" 
                name="status" 
                :options="[
                    'available' => 'Available',
                    'occupied' => 'Occupied',
                    'cleaning' => 'Cleaning'
                ]" 
                selected="available"
                required 
            />

            <x-slot:footer>
                <x-ui.button variant="secondary" x-on:click="show = false">Cancel</x-ui.button>
                <x-ui.button variant="primary">Save Room</x-ui.button>
            </x-slot:footer>
        </form>
    </x-ui.modal>
</x-layouts-admin>
