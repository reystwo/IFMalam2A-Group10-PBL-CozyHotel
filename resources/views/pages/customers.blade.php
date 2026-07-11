<x-layouts-admin>
    <x-slot:title>Customer Management | CozyHotel</x-slot:title>

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

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="mb-6">
            <x-ui.alert type="success" :message="session('success')" />
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6">
            <x-ui.alert type="error" :message="session('error')" />
        </div>
    @endif

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

    <!-- Filters & Search -->
    <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-sm mb-6">
        <form method="GET" action="{{ route('customers.index') }}" class="flex flex-col md:flex-row gap-4 items-center justify-between">
            <div class="flex flex-wrap items-center gap-3 w-full md:w-auto">
                <div class="relative w-full md:w-80">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </span>
                    <input type="text" name="search" value="{{ request('search') }}" class="block w-full pl-10 pr-3 py-2 border border-slate-200 rounded-xl text-sm focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 outline-none" placeholder="Search by name, email or phone...">
                </div>

                <select name="status" class="appearance-none block px-4 py-2 bg-white border border-slate-200 focus:ring-indigo-500 focus:border-indigo-500 rounded-xl text-slate-900 text-sm transition-all focus:ring-1 outline-none">
                    <option value="all">All Status</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>

                <x-ui.button type="submit" variant="secondary" size="sm">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                    Filter
                </x-ui.button>

                @if(request()->hasAny(['search', 'status']))
                    <a href="{{ route('customers.index') }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-slate-700 transition-colors">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Reset
                    </a>
                @endif
            </div>
            <div class="text-sm text-slate-500 font-medium">
                Total Customers: <span class="text-slate-900 font-bold">{{ $totalCustomers }}</span>
            </div>
        </form>
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
                    @forelse($customers as $customer)
                    <tr class="hover:bg-slate-50/50 transition-colors group">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="h-10 w-10 rounded-full bg-indigo-50 flex items-center justify-center text-indigo-600 font-bold border border-indigo-100 shadow-sm">
                                    {{ collect(explode(' ', $customer->name))->map(fn($n) => substr($n, 0, 1))->join('') }}
                                </div>
                                <div class="ml-3">
                                    <div class="text-sm font-bold text-slate-900">{{ $customer->name }}</div>
                                    <div class="text-xs text-slate-500 font-medium">ID: #CUS-{{ str_pad($customer->id, 4, '0', STR_PAD_LEFT) }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-slate-600 font-medium">{{ $customer->email }}</div>
                            <div class="text-xs text-slate-400 mt-0.5">{{ $customer->phone ?? '-' }}</div>
                        </td>
                        <td class="px-6 py-4 text-center md:text-left">
                            <span class="inline-flex items-center px-2 py-0.5 rounded-lg text-xs font-bold bg-slate-100 text-slate-700">
                                {{ $customer->bookings_count }} Bookings
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            @if($customer->status === 'active')
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-100">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    Active
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-bold bg-slate-50 text-slate-500 border border-slate-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                    Inactive
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm text-slate-500 font-medium">{{ $customer->created_at->format('M d, Y') }}</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-1.5 opacity-0 group-hover:opacity-100 transition-opacity">
                                {{-- Edit Button --}}
                                <button
                                    type="button"
                                    x-on:click="$dispatch('open-modal', 'edit-customer-{{ $customer->id }}')"
                                    class="inline-flex items-center justify-center p-2 rounded-lg text-slate-500 hover:text-indigo-600 hover:bg-indigo-50 transition-all"
                                    title="Edit Customer"
                                >
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </button>

                                {{-- Delete Button --}}
                                <button
                                    type="button"
                                    x-on:click="$dispatch('open-modal', 'delete-customer-{{ $customer->id }}')"
                                    class="inline-flex items-center justify-center p-2 rounded-lg text-slate-500 hover:text-rose-600 hover:bg-rose-50 transition-all"
                                    title="Hapus Customer"
                                >
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>

                            {{-- Modal Edit Customer --}}
                            <x-ui.modal name="edit-customer-{{ $customer->id }}" title="Edit Customer — {{ $customer->name }}">
                                <form id="form-edit-customer-{{ $customer->id }}" action="{{ route('customers.update', $customer->id) }}" method="POST" class="space-y-5">
                                    @csrf
                                    @method('PUT')

                                    <div class="space-y-4">
                                        <h4 class="text-sm font-bold text-slate-900 uppercase tracking-wider">Personal Information</h4>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <x-ui.input label="Full Name" name="name" value="{{ $customer->name }}" placeholder="John Doe" required />
                                            <x-ui.input label="Email Address" name="email" type="email" value="{{ $customer->email }}" placeholder="john@example.com" required />
                                        </div>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <x-ui.input label="Phone Number" name="phone" value="{{ $customer->phone }}" placeholder="+62 812 3456 7890" />
                                            <div class="space-y-1.5">
                                                <label class="block text-sm font-semibold text-slate-700">Gender</label>
                                                <select name="gender" class="appearance-none block w-full px-4 py-2.5 bg-white border border-slate-200 focus:ring-indigo-500 focus:border-indigo-500 rounded-xl text-slate-900 text-sm transition-all focus:ring-1 outline-none">
                                                    <option value="" {{ !$customer->gender ? 'selected' : '' }}>Select gender</option>
                                                    <option value="male" {{ $customer->gender == 'male' ? 'selected' : '' }}>Male</option>
                                                    <option value="female" {{ $customer->gender == 'female' ? 'selected' : '' }}>Female</option>
                                                    <option value="other" {{ $customer->gender == 'other' ? 'selected' : '' }}>Other</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="space-y-4 pt-4 border-t border-slate-100">
                                        <h4 class="text-sm font-bold text-slate-900 uppercase tracking-wider">Address & Details</h4>
                                        <x-ui.input label="Home Address" name="address" value="{{ $customer->address }}" placeholder="123 Street Name, City" />
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <x-ui.input label="ID Number (KTP/Passport)" name="id_number" value="{{ $customer->id_number }}" placeholder="Enter ID number" />
                                            <div class="space-y-1.5">
                                                <label class="block text-sm font-semibold text-slate-700">Status <span class="text-rose-500">*</span></label>
                                                <select name="status" class="appearance-none block w-full px-4 py-2.5 bg-white border border-slate-200 focus:ring-indigo-500 focus:border-indigo-500 rounded-xl text-slate-900 text-sm transition-all focus:ring-1 outline-none" required>
                                                    <option value="active" {{ $customer->status == 'active' ? 'selected' : '' }}>Active</option>
                                                    <option value="inactive" {{ $customer->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <x-slot:footer>
                                        <x-ui.button type="button" variant="secondary" x-on:click="show = false">Cancel</x-ui.button>
                                        <x-ui.button type="submit" variant="primary" id="form-edit-customer-{{ $customer->id }}">
                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                            Update Customer
                                        </x-ui.button>
                                    </x-slot:footer>
                                </form>
                            </x-ui.modal>

                            {{-- Modal Delete Confirmation --}}
                            <x-ui.modal name="delete-customer-{{ $customer->id }}" title="Delete Customer" maxWidth="md">
                                <div class="text-center py-4">
                                    <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-rose-100 mb-4">
                                        <svg class="h-8 w-8 text-rose-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-bold text-slate-900 mb-2">Konfirmasi Hapus</h3>
                                    <p class="text-sm text-slate-500">
                                        Apakah Anda yakin ingin menghapus <strong class="text-slate-700">{{ $customer->name }}</strong>?
                                        <br>Tindakan ini tidak dapat dibatalkan.
                                    </p>
                                </div>

                                <x-slot:footer>
                                    <x-ui.button type="button" variant="secondary" x-on:click="show = false">Batal</x-ui.button>
                                    <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <x-ui.button type="submit" variant="danger">
                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Ya, Hapus
                                        </x-ui.button>
                                    </form>
                                </x-slot:footer>
                            </x-ui.modal>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-16 h-16 rounded-2xl bg-slate-100 flex items-center justify-center mb-4">
                                    <svg class="w-8 h-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <h3 class="text-sm font-bold text-slate-700 mb-1">Belum ada customer</h3>
                                <p class="text-sm text-slate-500 mb-4">Klik "Add New Customer" untuk menambahkan customer baru.</p>
                                <x-ui.button variant="primary" size="sm" x-on:click="$dispatch('open-modal', 'add-customer')">
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                    </svg>
                                    Tambah Customer Pertama
                                </x-ui.button>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Table Footer with Pagination --}}
        <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/30 flex flex-col sm:flex-row items-center justify-between gap-3">
            <p class="text-xs text-slate-500">
                Total: <span class="font-bold text-slate-700">{{ $totalCustomers }}</span> customers
                &bull; Halaman <span class="font-bold text-slate-700">{{ $customers->currentPage() }}</span> dari <span class="font-bold text-slate-700">{{ $customers->lastPage() }}</span>
            </p>
            <div>
                {{ $customers->links() }}
            </div>
        </div>
    </div>

    <!-- Modal Add Customer -->
    <x-ui.modal name="add-customer" title="Add New Customer">
        <form id="form-tambah-customer" action="{{ route('customers.store') }}" method="POST" class="space-y-5">
            @csrf
            <div class="space-y-4">
                <h4 class="text-sm font-bold text-slate-900 uppercase tracking-wider">Personal Information</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <x-ui.input label="Full Name" name="name" placeholder="Budi" required />
                    <x-ui.input label="Email Address" name="email" type="email" placeholder="budi@gmail.com" required />
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <x-ui.input label="Phone Number" name="phone" placeholder="081234567890" />
                    <x-ui.select
                        label="Gender"
                        name="gender"
                        :options="['male' => 'Male', 'female' => 'Female', 'other' => 'Other']"
                    />
                </div>
            </div>

            <div class="space-y-4 pt-4 border-t border-slate-100">
                <h4 class="text-sm font-bold text-slate-900 uppercase tracking-wider">Address & Details</h4>
                <x-ui.input label="Home Address" name="address" placeholder="123 Street Name, City" />
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <x-ui.input label="ID Number (KTP/Passport)" name="id_number" placeholder="Enter ID number" />
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
                <x-ui.button type="button" variant="secondary" x-on:click="show = false">Cancel</x-ui.button>
                <x-ui.button type="submit" variant="primary" form="form-tambah-customer">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                    Register Customer
                </x-ui.button>
            </x-slot:footer>
        </form>
    </x-ui.modal>
</x-layouts-admin>
