<x-layouts-admin>
    <x-slot:title>Customer Management | CozyHotel</x-slot>

    <x-slot:header>
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Customer Management</h1>
                <p class="text-sm text-slate-500 font-medium">Manage your guest database and their stay history.</p>
            </div>
            <x-ui.button variant="primary" x-on:click="$dispatch('open-modal', 'add-customer')">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
                Add New Customer
            </x-ui.button>
        </div>
    </x-slot:header>

    <!-- Filters & Search -->
    <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-sm mb-6 flex flex-col md:flex-row gap-4 items-center justify-between">
        <div class="flex flex-wrap items-center gap-3 w-full md:w-auto">
            <div class="relative w-full md:w-80">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </span>
                <input type="text" class="block w-full pl-10 pr-3 py-2 border border-slate-200 rounded-xl text-sm focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 outline-none" placeholder="Search by name, email or phone...">
            </div>
            <x-ui.select 
                name="status_filter" 
                :options="['all' => 'All Status', 'active' => 'Active', 'inactive' => 'Inactive']" 
                placeholder="Status"
                class="!py-1.5"
            />
        </div>
        <div class="text-sm text-slate-500 font-medium">
            Total Customers: <span class="text-slate-900 font-bold">1,240</span>
        </div>
    </div>

    <!-- Customers Table -->
    <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-slate-500 text-xs uppercase tracking-wider font-semibold bg-slate-50/50">
                        <th class="px-6 py-4">Customer</th>
                        <th class="px-6 py-4">Contact Info</th>
                        <th class="px-6 py-4">Total Bookings</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Joined Date</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @php
                        $customers = [
                            ['name' => 'John Doe', 'email' => 'john@example.com', 'phone' => '+1 234 567 890', 'bookings' => 5, 'status' => 'active', 'joined' => 'Oct 12, 2023'],
                            ['name' => 'Alice Smith', 'email' => 'alice@example.com', 'phone' => '+1 345 678 901', 'bookings' => 2, 'status' => 'active', 'joined' => 'Nov 05, 2023'],
                            ['name' => 'Robert Johnson', 'email' => 'robert@example.com', 'phone' => '+1 456 789 012', 'bookings' => 12, 'status' => 'inactive', 'joined' => 'Jan 20, 2023'],
                            ['name' => 'Sarah Williams', 'email' => 'sarah@example.com', 'phone' => '+1 567 890 123', 'bookings' => 0, 'status' => 'active', 'joined' => 'Dec 15, 2023'],
                            ['name' => 'Michael Brown', 'email' => 'michael@example.com', 'phone' => '+1 678 901 234', 'bookings' => 8, 'status' => 'active', 'joined' => 'May 14, 2023'],
                        ];
                    @endphp

                    @foreach($customers as $customer)
                    <tr class="hover:bg-slate-50/50 transition-colors group">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="h-10 w-10 rounded-full bg-indigo-50 flex items-center justify-center text-indigo-600 font-bold border border-indigo-100 shadow-sm">
                                    {{ collect(explode(' ', $customer['name']))->map(fn($n) => substr($n, 0, 1))->join('') }}
                                </div>
                                <div class="ml-3">
                                    <div class="text-sm font-bold text-slate-900">{{ $customer['name'] }}</div>
                                    <div class="text-xs text-slate-500 font-medium">ID: #CUS-{{ 1000 + $loop->index }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-slate-600 font-medium">{{ $customer['email'] }}</div>
                            <div class="text-xs text-slate-400 mt-0.5">{{ $customer['phone'] }}</div>
                        </td>
                        <td class="px-6 py-4 text-center md:text-left">
                            <span class="inline-flex items-center px-2 py-0.5 rounded-lg text-xs font-bold bg-slate-100 text-slate-700">
                                {{ $customer['bookings'] }} Bookings
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            @if($customer['status'] === 'active')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-100">
                                    Active
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-slate-50 text-slate-500 border border-slate-200">
                                    Inactive
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm text-slate-500 font-medium">{{ $customer['joined'] }}</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <x-ui.button variant="ghost" size="xs" title="View History">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </x-ui.button>
                                <x-ui.button variant="ghost" size="xs" title="Edit Customer">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
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
            <p class="text-xs text-slate-500 font-medium">Showing 1 to 5 of 1,240 customers</p>
            <div class="flex gap-2">
                <x-ui.button variant="secondary" size="xs" disabled>Previous</x-ui.button>
                <x-ui.button variant="secondary" size="xs">Next</x-ui.button>
            </div>
        </div>
    </div>

    <!-- Modal for Add Customer -->
    <x-ui.modal name="add-customer" title="Add New Customer">
        <form action="#" method="POST" class="space-y-5">
            @csrf
            <div class="space-y-4">
                <h4 class="text-sm font-bold text-slate-900 uppercase tracking-wider">Personal Information</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <x-ui.input label="Full Name" name="name" placeholder="John Doe" required />
                    <x-ui.input label="Email Address" name="email" type="email" placeholder="john@example.com" required />
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <x-ui.input label="Phone Number" name="phone" placeholder="+1 (555) 000-0000" required />
                    <x-ui.select 
                        label="Gender" 
                        name="gender" 
                        :options="['male' => 'Male', 'female' => 'Female', 'other' => 'Other']" 
                        required 
                    />
                </div>
            </div>

            <div class="space-y-4 pt-4 border-t border-slate-100">
                <h4 class="text-sm font-bold text-slate-900 uppercase tracking-wider">Address & Details</h4>
                <x-ui.input label="Home Address" name="address" placeholder="123 Street Name, City" />
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <x-ui.input label="ID Number (Passport/Driving License)" name="id_number" placeholder="Enter ID number" />
                    <x-ui.select 
                        label="Status" 
                        name="status" 
                        :options="['active' => 'Active', 'inactive' => 'Inactive']" 
                        selected="active"
                        required 
                    />
                </div>
            </div>

            <x-slot:footer>
                <x-ui.button variant="secondary" x-on:click="show = false">Cancel</x-ui.button>
                <x-ui.button variant="primary">Register Customer</x-ui.button>
            </x-slot:footer>
        </form>
    </x-ui.modal>
</x-layouts-admin>
