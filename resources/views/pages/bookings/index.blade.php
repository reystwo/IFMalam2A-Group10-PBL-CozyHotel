<x-layouts-admin>
    <x-slot:title>Booking Management | CozyHotel</x-slot:title>

    <x-slot:header>
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Booking Management</h1>
                <p class="text-sm text-slate-500 font-medium">Kelola reservasi tamu dan status booking hotel.</p>
            </div>
            <a href="{{ route('bookings.create') }}">
                <x-ui.button type="button" variant="primary">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    New Booking
                </x-ui.button>
            </a>
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

    {{-- Status Summary Cards --}}
    <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-6">
        <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-amber-50 rounded-lg">
                    <svg class="w-5 h-5 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <div class="text-lg font-bold text-slate-900">{{ $statusCounts['pending'] }}</div>
                    <div class="text-xs text-slate-500 font-medium">Pending</div>
                </div>
            </div>
        </div>
        <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-indigo-50 rounded-lg">
                    <svg class="w-5 h-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <div class="text-lg font-bold text-slate-900">{{ $statusCounts['confirmed'] }}</div>
                    <div class="text-xs text-slate-500 font-medium">Confirmed</div>
                </div>
            </div>
        </div>
        <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-emerald-50 rounded-lg">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <div>
                    <div class="text-lg font-bold text-slate-900">{{ $statusCounts['checked_in'] }}</div>
                    <div class="text-xs text-slate-500 font-medium">Checked In</div>
                </div>
            </div>
        </div>
        <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-sky-50 rounded-lg">
                    <svg class="w-5 h-5 text-sky-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                </div>
                <div>
                    <div class="text-lg font-bold text-slate-900">{{ $statusCounts['checked_out'] }}</div>
                    <div class="text-xs text-slate-500 font-medium">Checked Out</div>
                </div>
            </div>
        </div>
        <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-rose-50 rounded-lg">
                    <svg class="w-5 h-5 text-rose-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
                <div>
                    <div class="text-lg font-bold text-slate-900">{{ $statusCounts['cancelled'] }}</div>
                    <div class="text-xs text-slate-500 font-medium">Cancelled</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Filters & Search --}}
    <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-sm mb-6">
        <form method="GET" action="{{ route('bookings.index') }}" class="flex flex-col md:flex-row gap-4 items-center justify-between">
            <div class="flex flex-wrap items-center gap-3 w-full md:w-auto">
                {{-- Search Input --}}
                <div class="relative w-full md:w-64">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </span>
                    <input type="text" name="search" value="{{ request('search') }}" class="block w-full pl-10 pr-3 py-2 border border-slate-200 rounded-xl text-sm focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 outline-none" placeholder="Cari nama tamu, email...">
                </div>

                {{-- Filter by Status --}}
                <select name="status" class="appearance-none block px-4 py-2 bg-white border border-slate-200 focus:ring-indigo-500 focus:border-indigo-500 rounded-xl text-slate-900 text-sm transition-all focus:ring-1 outline-none">
                    <option value="all">Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="checked_in" {{ request('status') == 'checked_in' ? 'selected' : '' }}>Checked In</option>
                    <option value="checked_out" {{ request('status') == 'checked_out' ? 'selected' : '' }}>Checked Out</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>

                {{-- Filter by Room Type --}}
                <select name="room_type_id" class="appearance-none block px-4 py-2 bg-white border border-slate-200 focus:ring-indigo-500 focus:border-indigo-500 rounded-xl text-slate-900 text-sm transition-all focus:ring-1 outline-none">
                    <option value="all">Semua Tipe</option>
                    @foreach($roomTypes as $type)
                        <option value="{{ $type->id }}" {{ request('room_type_id') == $type->id ? 'selected' : '' }}>
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>

                {{-- Filter Button --}}
                <x-ui.button type="submit" variant="secondary" size="sm">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                    Filter
                </x-ui.button>

                @if(request()->hasAny(['search', 'status', 'room_type_id']))
                    <a href="{{ route('bookings.index') }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-slate-700 transition-colors">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Reset
                    </a>
                @endif
            </div>

            <div class="text-sm text-slate-500 font-medium whitespace-nowrap">
                Menampilkan <span class="text-slate-900 font-bold">{{ $bookings->count() }}</span> dari <span class="text-slate-900 font-bold">{{ $totalBookings }}</span> booking
            </div>
        </form>
    </div>

    {{-- Bookings Table --}}
    <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-slate-500 text-xs uppercase tracking-wider font-semibold bg-slate-50/50">
                        <th class="px-6 py-4">ID</th>
                        <th class="px-6 py-4">Tamu</th>
                        <th class="px-6 py-4">Kamar</th>
                        <th class="px-6 py-4">Check-in / Check-out</th>
                        <th class="px-6 py-4">Total</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($bookings as $booking)
                    <tr class="hover:bg-slate-50/50 transition-colors group">
                        <td class="px-6 py-4">
                            <span class="text-sm font-bold text-indigo-600">#{{ $booking->id }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="h-9 w-9 rounded-full bg-indigo-50 flex items-center justify-center text-indigo-600 font-bold text-xs border border-indigo-100">
                                    {{ collect(explode(' ', $booking->guest_name))->map(fn($n) => substr($n, 0, 1))->join('') }}
                                </div>
                                <div class="ml-3">
                                    <div class="text-sm font-bold text-slate-900">{{ $booking->guest_name }}</div>
                                    <div class="text-xs text-slate-500">{{ $booking->guest_email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-bold text-slate-900">#{{ $booking->room ? $booking->room->room_number : '-' }}</div>
                            <div class="text-xs text-slate-500">{{ $booking->roomType->name ?? '-' }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-slate-900 font-medium">{{ $booking->check_in->format('d M Y') }}</div>
                            <div class="text-xs text-slate-500">s/d {{ $booking->check_out->format('d M Y') }} · {{ $booking->nights }} malam</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm font-bold text-slate-900">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $statusStyles = [
                                    'pending' => 'bg-amber-50 text-amber-700 border-amber-100',
                                    'confirmed' => 'bg-indigo-50 text-indigo-700 border-indigo-100',
                                    'checked_in' => 'bg-emerald-50 text-emerald-700 border-emerald-100',
                                    'checked_out' => 'bg-sky-50 text-sky-700 border-sky-100',
                                    'cancelled' => 'bg-rose-50 text-rose-700 border-rose-100',
                                ];
                                $statusLabels = [
                                    'pending' => 'Pending',
                                    'confirmed' => 'Confirmed',
                                    'checked_in' => 'Checked In',
                                    'checked_out' => 'Checked Out',
                                    'cancelled' => 'Cancelled',
                                ];
                                $statusDots = [
                                    'pending' => 'bg-amber-500',
                                    'confirmed' => 'bg-indigo-500',
                                    'checked_in' => 'bg-emerald-500',
                                    'checked_out' => 'bg-sky-500',
                                    'cancelled' => 'bg-rose-500',
                                ];
                            @endphp
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold border {{ $statusStyles[$booking->status] ?? '' }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ $statusDots[$booking->status] ?? '' }}"></span>
                                {{ $statusLabels[$booking->status] ?? $booking->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-1.5 opacity-0 group-hover:opacity-100 transition-opacity">
                                {{-- Edit Status Button --}}
                                <button
                                    type="button"
                                    x-on:click="$dispatch('open-modal', 'edit-booking-{{ $booking->id }}')"
                                    class="inline-flex items-center justify-center p-2 rounded-lg text-slate-500 hover:text-indigo-600 hover:bg-indigo-50 transition-all"
                                    title="Edit Booking"
                                >
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </button>

                                {{-- Delete Button --}}
                                <button
                                    type="button"
                                    x-on:click="$dispatch('open-modal', 'delete-booking-{{ $booking->id }}')"
                                    class="inline-flex items-center justify-center p-2 rounded-lg text-slate-500 hover:text-rose-600 hover:bg-rose-50 transition-all"
                                    title="Hapus Booking"
                                >
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>

                            {{-- Modal Edit Booking --}}
                            <x-ui.modal name="edit-booking-{{ $booking->id }}" title="Edit Booking #{{ $booking->id }}">
                                <form action="{{ route('bookings.update', $booking->id) }}" method="POST" class="space-y-4">
                                    @csrf
                                    @method('PUT')

                                    <x-ui.input label="Nama Tamu" name="guest_name" value="{{ $booking->guest_name }}" required />
                                    <x-ui.input label="Email Tamu" name="guest_email" value="{{ $booking->guest_email }}" type="email" required />

                                    <div class="grid grid-cols-2 gap-4">
                                        <x-ui.input label="Check-in" name="check_in" type="date" value="{{ $booking->check_in->format('Y-m-d') }}" required />
                                        <x-ui.input label="Check-out" name="check_out" type="date" value="{{ $booking->check_out->format('Y-m-d') }}" required />
                                    </div>

                                    <div class="space-y-1.5">
                                        <label class="block text-sm font-semibold text-slate-700">Status <span class="text-rose-500">*</span></label>
                                        <select name="status" class="appearance-none block w-full px-4 py-2.5 bg-white border border-slate-200 focus:ring-indigo-500 focus:border-indigo-500 rounded-xl text-slate-900 text-sm transition-all focus:ring-1 outline-none" required>
                                            <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>⏳ Pending</option>
                                            <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>✅ Confirmed</option>
                                            <option value="checked_in" {{ $booking->status == 'checked_in' ? 'selected' : '' }}>🟢 Checked In</option>
                                            <option value="checked_out" {{ $booking->status == 'checked_out' ? 'selected' : '' }}>🔵 Checked Out</option>
                                            <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>❌ Cancelled</option>
                                        </select>
                                    </div>

                                    <x-slot:footer>
                                        <x-ui.button type="button" variant="secondary" x-on:click="show = false">Batal</x-ui.button>
                                        <x-ui.button type="submit" variant="primary">
                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                            Perbarui Booking
                                        </x-ui.button>
                                    </x-slot:footer>
                                </form>
                            </x-ui.modal>

                            {{-- Modal Delete Confirmation --}}
                            <x-ui.modal name="delete-booking-{{ $booking->id }}" title="Hapus Booking #{{ $booking->id }}" maxWidth="md">
                                <div class="text-center py-4">
                                    <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-rose-100 mb-4">
                                        <svg class="h-8 w-8 text-rose-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-bold text-slate-900 mb-2">Konfirmasi Hapus</h3>
                                    <p class="text-sm text-slate-500">
                                        Apakah Anda yakin ingin menghapus <strong class="text-slate-700">Booking #{{ $booking->id }}</strong> ({{ $booking->guest_name }})?
                                        <br>Tindakan ini tidak dapat dibatalkan.
                                    </p>
                                </div>

                                <x-slot:footer>
                                    <x-ui.button type="button" variant="secondary" x-on:click="show = false">Batal</x-ui.button>
                                    <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" class="inline">
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
                        <td colspan="7" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-16 h-16 rounded-2xl bg-slate-100 flex items-center justify-center mb-4">
                                    <svg class="w-8 h-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <h3 class="text-sm font-bold text-slate-700 mb-1">Belum ada booking</h3>
                                <p class="text-sm text-slate-500 mb-4">Klik "New Booking" untuk membuat reservasi baru.</p>
                                <a href="{{ route('bookings.create') }}">
                                    <x-ui.button type="button" variant="primary" size="sm">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                        </svg>
                                        Buat Booking Pertama
                                    </x-ui.button>
                                </a>
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
                Total: <span class="font-bold text-slate-700">{{ $totalBookings }}</span> booking
                &bull; Halaman <span class="font-bold text-slate-700">{{ $bookings->currentPage() }}</span> dari <span class="font-bold text-slate-700">{{ $bookings->lastPage() }}</span>
            </p>
            <div>
                {{ $bookings->links() }}
            </div>
        </div>
    </div>
</x-layouts-admin>
