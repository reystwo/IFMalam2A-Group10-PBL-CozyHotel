<div class="relative z-10 flex-shrink-0 flex h-16 bg-white border-b border-slate-200">
    <button type="button" 
            class="px-4 border-r border-slate-200 text-slate-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500 md:hidden"
            @click="sidebarOpen = true">
        <span class="sr-only">Open sidebar</span>
        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>
    <div class="flex-1 px-4 flex justify-between">
        <div class="flex-1 flex items-center">
            <!-- Search bar could go here -->
            <div class="max-w-lg w-full lg:max-w-xs">
                <label for="search" class="sr-only">Search</label>
                <div class="relative text-slate-400 focus-within:text-slate-600">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input id="search" class="block w-full pl-10 pr-3 py-2 border border-slate-200 rounded-xl leading-5 bg-slate-50 placeholder-slate-500 focus:outline-none focus:bg-white focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all" placeholder="Search rooms, guests..." type="search" name="search">
                </div>
            </div>
        </div>
        <div class="ml-4 flex items-center md:ml-6 space-x-4">
            <!-- Notifications -->
            <div class="relative" x-data="{ open: false }">
                <button type="button" 
                        class="bg-white p-1 rounded-full text-slate-400 hover:text-slate-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 relative"
                        @click="open = !open"
                        @click.away="open = false">
                    <span class="sr-only">View notifications</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    <span class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-rose-500 ring-2 ring-white"></span>
                </button>

                <!-- Notification Dropdown -->
                <div x-show="open" 
                     x-transition:enter="transition ease-out duration-100" 
                     x-transition:enter-start="transform opacity-0 scale-95" 
                     x-transition:enter-end="transform opacity-100 scale-100" 
                     x-transition:leave="transition ease-in duration-75" 
                     x-transition:leave-start="transform opacity-100 scale-100" 
                     x-transition:leave-end="transform opacity-0 scale-95" 
                     class="origin-top-right absolute right-0 mt-2 w-80 rounded-2xl shadow-xl bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50 border border-slate-100 overflow-hidden" 
                     style="display: none;">
                    <div class="px-4 py-3 border-b border-slate-100 bg-slate-50/50 flex items-center justify-between">
                        <h3 class="text-xs font-bold text-slate-900 uppercase tracking-widest">Notifications</h3>
                        <span class="text-[10px] font-bold bg-indigo-100 text-indigo-600 px-1.5 py-0.5 rounded-full">3 New</span>
                    </div>
                    <div class="max-h-96 overflow-y-auto">
                        <a href="#" class="block px-4 py-3 hover:bg-slate-50 transition-colors border-b border-slate-50">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 pt-1">
                                    <div class="h-8 w-8 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-bold text-slate-900">New Booking Confirmed</p>
                                    <p class="text-xs text-slate-500 mt-0.5">John Doe just booked Deluxe Suite #302.</p>
                                    <p class="text-[10px] text-slate-400 mt-1 font-medium uppercase">2 minutes ago</p>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="block px-4 py-3 hover:bg-slate-50 transition-colors border-b border-slate-50">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 pt-1">
                                    <div class="h-8 w-8 rounded-full bg-amber-100 flex items-center justify-center text-amber-600">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-bold text-slate-900">Late Check-out Alert</p>
                                    <p class="text-xs text-slate-500 mt-0.5">Guest in Room #105 hasn't checked out yet.</p>
                                    <p class="text-[10px] text-slate-400 mt-1 font-medium uppercase">45 minutes ago</p>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="block px-4 py-3 hover:bg-slate-50 transition-colors">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 pt-1">
                                    <div class="h-8 w-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" /></svg>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-bold text-slate-900">Payment Received</p>
                                    <p class="text-xs text-slate-500 mt-0.5">Payment of $550.00 processed for BK-452.</p>
                                    <p class="text-[10px] text-slate-400 mt-1 font-medium uppercase">2 hours ago</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <a href="#" class="block py-2 text-center text-xs font-bold text-indigo-600 bg-slate-50 hover:bg-slate-100 transition-colors uppercase tracking-widest">
                        View All Notifications
                    </a>
                </div>
            </div>

            <!-- Profile dropdown -->
            <div class="ml-3 relative" x-data="{ open: false }">
                <div>
                    <button type="button" 
                            class="max-w-xs bg-white flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" 
                            @click="open = !open"
                            @click.away="open = false">
                        <span class="sr-only">Open user menu</span>
                        <img class="h-8 w-8 rounded-full border border-slate-200" src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'Admin') }}&color=7F9CF5&background=EBF4FF" alt="">
                    </button>
                </div>
                <div x-show="open" 
                     x-transition:enter="transition ease-out duration-100" 
                     x-transition:enter-start="transform opacity-0 scale-95" 
                     x-transition:enter-end="transform opacity-100 scale-100" 
                     x-transition:leave="transition ease-in duration-75" 
                     x-transition:leave-start="transform opacity-100 scale-100" 
                     x-transition:leave-end="transform opacity-0 scale-95" 
                     class="origin-top-right absolute right-0 mt-2 w-48 rounded-2xl shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50 border border-slate-100" 
                     role="menu">
                    <a href="#" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 font-medium" role="menuitem">Your Profile</a>
                    <a href="#" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 font-medium" role="menuitem">Settings</a>
                    <form method="POST" action="#">
                        @csrf
                        <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-rose-600 hover:bg-rose-50 font-medium" role="menuitem">Sign out</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
