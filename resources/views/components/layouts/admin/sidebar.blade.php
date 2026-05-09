<div class="md:hidden" x-show="sidebarOpen" x-cloak>
    <div class="fixed inset-0 z-40 flex">
        <!-- Backdrop -->
        <div x-show="sidebarOpen" 
             x-transition:enter="transition-opacity ease-linear duration-300" 
             x-transition:enter-start="opacity-0" 
             x-transition:enter-end="opacity-100" 
             x-transition:leave="transition-opacity ease-linear duration-300" 
             x-transition:leave-start="opacity-100" 
             x-transition:leave-end="opacity-0" 
             class="fixed inset-0 bg-slate-600 bg-opacity-75" 
             @click="sidebarOpen = false"></div>

        <!-- Mobile Sidebar -->
        <div x-show="sidebarOpen" 
             x-transition:enter="transition ease-in-out duration-300 transform" 
             x-transition:enter-start="-translate-x-full" 
             x-transition:enter-end="translate-x-0" 
             x-transition:leave="transition ease-in-out duration-300 transform" 
             x-transition:leave-start="translate-x-0" 
             x-transition:leave-end="-translate-x-full" 
             class="relative flex-1 flex flex-col max-w-xs w-full bg-white border-r border-slate-200">
            
            <div class="absolute top-0 right-0 -mr-12 pt-2">
                <button type="button" class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" @click="sidebarOpen = false">
                    <span class="sr-only">Close sidebar</span>
                    <svg class="h-6 w-6 text-white" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="flex-1 h-0 pt-5 pb-4 overflow-y-auto">
                <div class="flex-shrink-0 flex items-center px-4">
                    <span class="text-2xl font-bold text-indigo-600 tracking-tight">CozyHotel</span>
                </div>
                <nav class="mt-8 px-2 space-y-1">
                    <x-layouts.admin.sidebar-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" icon="home">Dashboard</x-layouts.admin.sidebar-link>
                    <x-layouts.admin.sidebar-link :href="route('rooms.index')" :active="request()->routeIs('rooms.index')" icon="room">Rooms</x-layouts.admin.sidebar-link>
                    <x-layouts.admin.sidebar-link :href="route('facilities.index')" :active="request()->routeIs('facilities.index')" icon="room">Facilities</x-layouts.admin.sidebar-link>
                    <x-layouts.admin.sidebar-link :href="route('customers.index')" :active="request()->routeIs('customers.index')" icon="users">Customers</x-layouts.admin.sidebar-link>
                    <x-layouts.admin.sidebar-link :href="route('bookings.index')" :active="request()->routeIs('bookings.index')" icon="transaction">Bookings</x-layouts.admin.sidebar-link>
                    <x-layouts.admin.sidebar-link :href="route('transactions.index')" :active="request()->routeIs('transactions.index')" icon="transaction">Transactions</x-layouts.admin.sidebar-link>
                    <x-layouts.admin.sidebar-link :href="route('activity-log')" :active="request()->routeIs('activity-log')" icon="home">Activity Log</x-layouts.admin.sidebar-link>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Static Sidebar for Desktop -->
<div class="hidden md:flex md:flex-shrink-0">
    <div class="flex flex-col w-64 bg-white border-r border-slate-200">
        <div class="flex-1 flex flex-col pt-5 pb-4 overflow-y-auto">
            <div class="flex items-center flex-shrink-0 px-6">
                <span class="text-2xl font-bold text-indigo-600 tracking-tight">CozyHotel</span>
            </div>
            <nav class="mt-8 flex-1 px-4 space-y-1">
                <x-layouts.admin.sidebar-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" icon="home">Dashboard</x-layouts.admin.sidebar-link>
                <x-layouts.admin.sidebar-link :href="route('rooms.index')" :active="request()->routeIs('rooms.index')" icon="room">Rooms</x-layouts.admin.sidebar-link>
                <x-layouts.admin.sidebar-link :href="route('facilities.index')" :active="request()->routeIs('facilities.index')" icon="room">Facilities</x-layouts.admin.sidebar-link>
                <x-layouts.admin.sidebar-link :href="route('customers.index')" :active="request()->routeIs('customers.index')" icon="users">Customers</x-layouts.admin.sidebar-link>
                <x-layouts.admin.sidebar-link :href="route('bookings.index')" :active="request()->routeIs('bookings.index')" icon="transaction">Bookings</x-layouts.admin.sidebar-link>
                <x-layouts.admin.sidebar-link :href="route('transactions.index')" :active="request()->routeIs('transactions.index')" icon="transaction">Transactions</x-layouts.admin.sidebar-link>
                <x-layouts.admin.sidebar-link :href="route('activity-log')" :active="request()->routeIs('activity-log')" icon="home">Activity Log</x-layouts.admin.sidebar-link>
            </nav>
        </div>
        <div class="flex-shrink-0 flex border-t border-slate-200 p-4">
            <div class="flex-shrink-0 w-full group block">
                <div class="flex items-center">
                    <div>
                        <img class="inline-block h-9 w-9 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'Admin') }}&color=7F9CF5&background=EBF4FF" alt="">
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-slate-700">{{ auth()->user()->name ?? 'Admin User' }}</p>
                        <p class="text-xs font-medium text-slate-500 group-hover:text-slate-700">View Profile</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
