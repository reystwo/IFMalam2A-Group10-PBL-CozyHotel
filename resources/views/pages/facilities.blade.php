<x-layouts-admin>
    <x-slot:title>Facilities Management | CozyHotel</x-slot>

    <x-slot:header>
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Facilities Management</h1>
                <p class="text-sm text-slate-500 font-medium">Configure and assign amenities to different room types.</p>
            </div>
            <x-ui.button variant="primary" x-on:click="$dispatch('open-modal', 'add-facility')">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add Facility
            </x-ui.button>
        </div>
    </x-slot:header>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Facilities List -->
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm">
                <div class="px-6 py-4 border-b border-slate-200 bg-slate-50/50">
                    <h2 class="text-lg font-bold text-slate-900">Available Facilities</h2>
                </div>
                <div class="p-6">
                    <ul class="space-y-4">
                        @php
                            $facilities = [
                                ['name' => 'Free WiFi', 'icon' => 'wifi', 'desc' => 'High-speed internet access'],
                                ['name' => 'Air Conditioning', 'icon' => 'ac', 'desc' => 'Climate control system'],
                                ['name' => 'Smart TV', 'icon' => 'tv', 'desc' => '4K TV with streaming apps'],
                                ['name' => 'Mini Bar', 'icon' => 'bar', 'desc' => 'Stocked drinks and snacks'],
                                ['name' => 'Room Service', 'icon' => 'service', 'desc' => '24/7 food & laundry service'],
                            ];
                        @endphp

                        @foreach($facilities as $facility)
                        <li class="flex items-start p-3 rounded-xl hover:bg-slate-50 transition-colors group">
                            <div class="p-2 bg-indigo-50 rounded-lg text-indigo-600 mr-4">
                                @if($facility['icon'] === 'wifi')
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0" /></svg>
                                @elseif($facility['icon'] === 'ac')
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                                @elseif($facility['icon'] === 'tv')
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4V2m10 2V2M3 8a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm10 4a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                                @else
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-7.714 2.143L11 21l-2.286-6.857L1 12l7.714-2.143L11 3z" /></svg>
                                @endif
                            </div>
                            <div class="flex-1">
                                <h3 class="text-sm font-bold text-slate-900 leading-tight">{{ $facility['name'] }}</h3>
                                <p class="text-xs text-slate-500 mt-0.5">{{ $facility['desc'] }}</p>
                            </div>
                            <button class="opacity-0 group-hover:opacity-100 p-1 text-slate-400 hover:text-rose-500 transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                            </button>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <!-- Assignment Grid -->
        <div class="lg:col-span-2">
            <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm">
                <div class="px-6 py-4 border-b border-slate-200 bg-slate-50/50 flex items-center justify-between">
                    <h2 class="text-lg font-bold text-slate-900">Assign to Room Types</h2>
                    <x-ui.button variant="secondary" size="sm">Save Changes</x-ui.button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-slate-500 text-xs uppercase tracking-wider font-semibold border-b border-slate-100">
                                <th class="px-6 py-4">Facility</th>
                                <th class="px-6 py-4 text-center">Standard</th>
                                <th class="px-6 py-4 text-center">Deluxe</th>
                                <th class="px-6 py-4 text-center">Suite</th>
                                <th class="px-6 py-4 text-center">Family</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach(['WiFi', 'AC', 'Smart TV', 'Mini Bar', 'Room Service'] as $name)
                            <tr class="hover:bg-slate-50/30 transition-colors">
                                <td class="px-6 py-4">
                                    <span class="text-sm font-bold text-slate-700">{{ $name }}</span>
                                </td>
                                @foreach(['std', 'dlx', 'ste', 'fam'] as $type)
                                <td class="px-6 py-4 text-center">
                                    <input type="checkbox" class="w-5 h-5 rounded-lg border-slate-300 text-indigo-600 focus:ring-indigo-500 transition-all cursor-pointer" {{ $loop->parent->first || $name === 'WiFi' ? 'checked' : '' }}>
                                </td>
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-8">
                <x-ui.alert type="warning" message="Note: Changes to facility assignments will take effect immediately for all rooms of the selected type." />
            </div>
        </div>
    </div>

    <!-- Modal for Add Facility -->
    <x-ui.modal name="add-facility" title="Add New Facility">
        <form action="#" method="POST" class="space-y-4">
            @csrf
            <x-ui.input label="Facility Name" name="name" placeholder="e.g. Swimming Pool" required />
            <x-ui.input label="Description" name="description" placeholder="Short description of the facility" required />
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <x-ui.select 
                    label="Icon" 
                    name="icon" 
                    :options="[
                        'wifi' => 'WiFi Icon',
                        'ac' => 'AC Icon',
                        'tv' => 'TV Icon',
                        'bar' => 'Bar Icon',
                        'service' => 'Service Icon',
                        'pool' => 'Pool Icon'
                    ]" 
                    required 
                />
                <x-ui.select 
                    label="Category" 
                    name="category" 
                    :options="[
                        'general' => 'General',
                        'tech' => 'Technology',
                        'comfort' => 'Comfort',
                        'food' => 'Food & Drink'
                    ]" 
                    required 
                />
            </div>

            <x-slot:footer>
                <x-ui.button variant="secondary" x-on:click="show = false">Cancel</x-ui.button>
                <x-ui.button variant="primary">Create Facility</x-ui.button>
            </x-slot:footer>
        </form>
    </x-ui.modal>
</x-layouts-admin>
