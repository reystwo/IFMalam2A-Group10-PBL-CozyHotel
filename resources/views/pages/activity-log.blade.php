<x-layouts-admin>
    <x-slot:title>Activity Log | CozyHotel</x-slot>

    <x-slot:header>
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 tracking-tight">System Activity Log</h1>
                <p class="text-sm text-slate-500 font-medium">Audit trail of all administrative actions and system events.</p>
            </div>
            <div class="flex gap-3">
                <x-ui.button variant="secondary">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg>
                    Download CSV
                </x-ui.button>
            </div>
        </div>
    </x-slot:header>

    <div class="max-w-4xl mx-auto">
        <!-- Filters -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-sm mb-8 flex flex-wrap gap-4 items-center">
            <x-ui.select name="user_filter" :options="['all' => 'All Users', '1' => 'Admin User', '2' => 'Staff Member']" placeholder="Filter by User" class="!py-1.5" />
            <x-ui.select name="action_filter" :options="['all' => 'All Actions', 'create' => 'Creation', 'update' => 'Updates', 'delete' => 'Deletions']" placeholder="Action Type" class="!py-1.5" />
            <div class="flex-1"></div>
            <p class="text-xs text-slate-400 font-bold uppercase tracking-widest">Showing last 50 activities</p>
        </div>

        <!-- Timeline UI -->
        <div class="relative">
            <!-- Vertical Line -->
            <div class="absolute left-8 top-0 bottom-0 w-0.5 bg-slate-100 hidden md:block"></div>

            <div class="space-y-12">
                @php
                    $activities = [
                        [
                            'date' => 'Today, May 06',
                            'items' => [
                                ['time' => '10:45 AM', 'user' => 'Admin User', 'action' => 'Confirmed booking', 'target' => '#BK-452', 'type' => 'success', 'desc' => 'Final payment of $382.50 received from John Doe.'],
                                ['time' => '09:30 AM', 'user' => 'Staff Member', 'action' => 'Updated room status', 'target' => 'Room #105', 'type' => 'info', 'desc' => 'Status changed from Occupied to Cleaning.'],
                            ]
                        ],
                        [
                            'date' => 'Yesterday, May 05',
                            'items' => [
                                ['time' => '04:20 PM', 'user' => 'Admin User', 'action' => 'Added new facility', 'target' => 'Swimming Pool', 'type' => 'create', 'desc' => 'Assigned to Deluxe and Suite room types.'],
                                ['time' => '02:15 PM', 'user' => 'System', 'action' => 'Automated backup', 'target' => 'Database', 'type' => 'system', 'desc' => 'Daily system backup completed successfully.'],
                                ['time' => '11:00 AM', 'user' => 'Admin User', 'action' => 'Deleted customer', 'target' => 'Jane Smith', 'type' => 'danger', 'desc' => 'Customer account and history archived.'],
                            ]
                        ]
                    ];
                @endphp

                @foreach($activities as $group)
                <div class="relative">
                    <!-- Date Label -->
                    <div class="md:ml-20 mb-6">
                        <span class="px-4 py-1 bg-slate-100 text-slate-600 text-xs font-black uppercase tracking-widest rounded-full border border-slate-200">
                            {{ $group['date'] }}
                        </span>
                    </div>

                    <div class="space-y-8">
                        @foreach($group['items'] as $item)
                        <div class="relative flex flex-col md:flex-row gap-6 md:gap-0">
                            <!-- Time & Icon -->
                            <div class="md:w-20 flex md:flex-col items-center justify-center md:justify-start pt-1">
                                <span class="text-[10px] font-bold text-slate-400 uppercase md:mb-2 order-2 md:order-none ml-3 md:ml-0">{{ $item['time'] }}</span>
                                <div class="w-8 h-8 rounded-full border-4 border-white shadow-sm flex items-center justify-center z-10 
                                    {{ $item['type'] === 'success' ? 'bg-emerald-500 text-white' : '' }}
                                    {{ $item['type'] === 'info' ? 'bg-indigo-500 text-white' : '' }}
                                    {{ $item['type'] === 'create' ? 'bg-blue-500 text-white' : '' }}
                                    {{ $item['type'] === 'system' ? 'bg-slate-500 text-white' : '' }}
                                    {{ $item['type'] === 'danger' ? 'bg-rose-500 text-white' : '' }}
                                ">
                                    @if($item['type'] === 'success')
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                                    @elseif($item['type'] === 'danger')
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12" /></svg>
                                    @elseif($item['type'] === 'system')
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4" /></svg>
                                    @else
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                                    @endif
                                </div>
                            </div>

                            <!-- Content Card -->
                            <div class="flex-1 md:ml-6">
                                <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm hover:shadow-md transition-shadow">
                                    <div class="flex items-center justify-between mb-2">
                                        <div class="flex items-center">
                                            <span class="text-sm font-black text-slate-900">{{ $item['user'] }}</span>
                                            <span class="mx-2 text-slate-300">•</span>
                                            <span class="text-sm font-medium text-slate-500">{{ $item['action'] }}</span>
                                            <span class="ml-2 px-2 py-0.5 bg-slate-50 text-slate-700 text-[10px] font-bold rounded border border-slate-100">{{ $item['target'] }}</span>
                                        </div>
                                    </div>
                                    <p class="text-sm text-slate-600 leading-relaxed">{{ $item['desc'] }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="mt-12 text-center pb-12">
            <x-ui.button variant="secondary">Load More Activity</x-ui.button>
        </div>
    </div>
</x-layouts-admin>
