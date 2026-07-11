<x-layouts-admin>
    <x-slot:title>Activity Log | CozyHotel</x-slot:title>

    <x-slot:header>
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 tracking-tight">System Activity Log</h1>
                <p class="text-sm text-slate-500 font-medium">Audit trail of all administrative actions and system events.</p>
            </div>
        </div>
    </x-slot:header>

    <div class="max-w-4xl mx-auto">
        <!-- Filters -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-sm mb-8">
            <form method="GET" action="{{ route('activity-log') }}" class="flex flex-wrap gap-4 items-center">
                <select name="action" class="appearance-none block px-4 py-2 bg-white border border-slate-200 focus:ring-indigo-500 focus:border-indigo-500 rounded-xl text-slate-900 text-sm transition-all focus:ring-1 outline-none">
                    <option value="all">All Actions</option>
                    <option value="create" {{ request('action') == 'create' ? 'selected' : '' }}>Creation</option>
                    <option value="update" {{ request('action') == 'update' ? 'selected' : '' }}>Updates</option>
                    <option value="delete" {{ request('action') == 'delete' ? 'selected' : '' }}>Deletions</option>
                </select>

                <select name="target_type" class="appearance-none block px-4 py-2 bg-white border border-slate-200 focus:ring-indigo-500 focus:border-indigo-500 rounded-xl text-slate-900 text-sm transition-all focus:ring-1 outline-none">
                    <option value="all">All Types</option>
                    <option value="Booking" {{ request('target_type') == 'Booking' ? 'selected' : '' }}>Booking</option>
                    <option value="Customer" {{ request('target_type') == 'Customer' ? 'selected' : '' }}>Customer</option>
                    <option value="Transaction" {{ request('target_type') == 'Transaction' ? 'selected' : '' }}>Transaction</option>
                    <option value="Room" {{ request('target_type') == 'Room' ? 'selected' : '' }}>Room</option>
                </select>

                <x-ui.button type="submit" variant="secondary" size="sm">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                    Filter
                </x-ui.button>

                @if(request()->hasAny(['action', 'target_type']))
                    <a href="{{ route('activity-log') }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-slate-700 transition-colors">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Reset
                    </a>
                @endif

                <div class="flex-1"></div>
                <p class="text-xs text-slate-400 font-bold uppercase tracking-widest">Total: {{ $totalLogs }} activities</p>
            </form>
        </div>

        <!-- Timeline UI -->
        @if($groupedLogs->count() > 0)
        <div class="relative">
            <!-- Vertical Line -->
            <div class="absolute left-8 top-0 bottom-0 w-0.5 bg-slate-100 hidden md:block"></div>

            <div class="space-y-12">
                @foreach($groupedLogs as $date => $items)
                <div class="relative">
                    <!-- Date Label -->
                    <div class="md:ml-20 mb-6">
                        @php
                            $carbonDate = \Carbon\Carbon::parse($date);
                            $dateLabel = $carbonDate->isToday() ? 'Today, ' . $carbonDate->format('M d') :
                                        ($carbonDate->isYesterday() ? 'Yesterday, ' . $carbonDate->format('M d') :
                                        $carbonDate->format('l, M d, Y'));
                        @endphp
                        <span class="px-4 py-1 bg-slate-100 text-slate-600 text-xs font-black uppercase tracking-widest rounded-full border border-slate-200">
                            {{ $dateLabel }}
                        </span>
                    </div>

                    <div class="space-y-8">
                        @foreach($items as $item)
                        @php
                            $typeColors = [
                                'create' => ['bg' => 'bg-emerald-500', 'icon' => 'M12 4v16m8-8H4'],
                                'update' => ['bg' => 'bg-indigo-500', 'icon' => 'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z'],
                                'delete' => ['bg' => 'bg-rose-500', 'icon' => 'M6 18L18 6M6 6l12 12'],
                                'login' => ['bg' => 'bg-sky-500', 'icon' => 'M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1'],
                            ];
                            $color = $typeColors[$item->action] ?? ['bg' => 'bg-slate-500', 'icon' => 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'];
                        @endphp
                        <div class="relative flex flex-col md:flex-row gap-6 md:gap-0">
                            <!-- Time & Icon -->
                            <div class="md:w-20 flex md:flex-col items-center justify-center md:justify-start pt-1">
                                <span class="text-[10px] font-bold text-slate-400 uppercase md:mb-2 order-2 md:order-none ml-3 md:ml-0">{{ $item->created_at->format('h:i A') }}</span>
                                <div class="w-8 h-8 rounded-full border-4 border-white shadow-sm flex items-center justify-center z-10 {{ $color['bg'] }} text-white">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $color['icon'] }}" />
                                    </svg>
                                </div>
                            </div>

                            <!-- Content Card -->
                            <div class="flex-1 md:ml-6">
                                <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm hover:shadow-md transition-shadow">
                                    <div class="flex items-center justify-between mb-2">
                                        <div class="flex items-center flex-wrap gap-1">
                                            <span class="text-sm font-black text-slate-900">{{ $item->user_name }}</span>
                                            <span class="mx-1 text-slate-300">•</span>
                                            <span class="text-sm font-medium text-slate-500">{{ ucfirst($item->action) }}d</span>
                                            <span class="ml-1 px-2 py-0.5 bg-slate-50 text-slate-700 text-[10px] font-bold rounded border border-slate-100">{{ $item->target_name }}</span>
                                        </div>
                                        <span class="px-2 py-0.5 text-[10px] font-bold uppercase tracking-wider rounded-full
                                            {{ $item->target_type === 'Booking' ? 'bg-indigo-50 text-indigo-600' : '' }}
                                            {{ $item->target_type === 'Customer' ? 'bg-emerald-50 text-emerald-600' : '' }}
                                            {{ $item->target_type === 'Transaction' ? 'bg-amber-50 text-amber-600' : '' }}
                                            {{ $item->target_type === 'Room' ? 'bg-sky-50 text-sky-600' : '' }}
                                        ">{{ $item->target_type }}</span>
                                    </div>
                                    @if($item->description)
                                        <p class="text-sm text-slate-600 leading-relaxed">{{ $item->description }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Pagination --}}
        <div class="mt-8 flex justify-center">
            {{ $logs->links() }}
        </div>
        @else
        <div class="text-center py-16">
            <div class="w-16 h-16 rounded-2xl bg-slate-100 flex items-center justify-center mb-4 mx-auto">
                <svg class="w-8 h-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <h3 class="text-sm font-bold text-slate-700 mb-1">Belum ada aktivitas</h3>
            <p class="text-sm text-slate-500">Aktivitas akan tercatat saat Anda mengelola data booking, customer, atau pembayaran.</p>
        </div>
        @endif
    </div>
</x-layouts-admin>
