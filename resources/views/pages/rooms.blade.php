<x-layouts-admin>
    <x-slot:title>Room Management | CozyHotel</x-slot>

    <x-slot:header>
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Room Management</h1>
                <p class="text-sm text-slate-500 font-medium">Kelola kamar hotel, tipe, dan status real-time.</p>
            </div>
            <x-ui.button variant="primary" x-on:click="$dispatch('open-modal', 'add-room')">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Kamar
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

    {{-- Status Summary Cards --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
        @php
            $statusCounts = [
                'available' => $rooms->getCollection()->where('status', 'available')->count(),
                'occupied' => $rooms->getCollection()->where('status', 'occupied')->count(),
                'maintenance' => $rooms->getCollection()->where('status', 'maintenance')->count(),
                'cleaning' => $rooms->getCollection()->where('status', 'cleaning')->count(),
            ];
        @endphp
        <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-emerald-50 rounded-lg">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <div>
                    <div class="text-lg font-bold text-slate-900">{{ \App\Models\Room::where('status', 'available')->count() }}</div>
                    <div class="text-xs text-slate-500 font-medium">Available</div>
                </div>
            </div>
        </div>
        <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-rose-50 rounded-lg">
                    <svg class="w-5 h-5 text-rose-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <div>
                    <div class="text-lg font-bold text-slate-900">{{ \App\Models\Room::where('status', 'occupied')->count() }}</div>
                    <div class="text-xs text-slate-500 font-medium">Occupied</div>
                </div>
            </div>
        </div>
        <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-amber-50 rounded-lg">
                    <svg class="w-5 h-5 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                    </svg>
                </div>
                <div>
                    <div class="text-lg font-bold text-slate-900">{{ \App\Models\Room::where('status', 'maintenance')->count() }}</div>
                    <div class="text-xs text-slate-500 font-medium">Maintenance</div>
                </div>
            </div>
        </div>
        <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-sky-50 rounded-lg">
                    <svg class="w-5 h-5 text-sky-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                </div>
                <div>
                    <div class="text-lg font-bold text-slate-900">{{ \App\Models\Room::where('status', 'cleaning')->count() }}</div>
                    <div class="text-xs text-slate-500 font-medium">Cleaning</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Filters & Search --}}
    <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-sm mb-6">
        <form method="GET" action="{{ route('rooms.index') }}" class="flex flex-col md:flex-row gap-4 items-center justify-between">
            <div class="flex flex-wrap items-center gap-3 w-full md:w-auto">
                {{-- Search Input --}}
                <div class="relative w-full md:w-64">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </span>
                    <input type="text" name="search" value="{{ request('search') }}" class="block w-full pl-10 pr-3 py-2 border border-slate-200 rounded-xl text-sm focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 outline-none" placeholder="Cari nomor kamar...">
                </div>

                {{-- Filter by Room Type --}}
                <select name="room_type_id" class="appearance-none block px-4 py-2 bg-white border border-slate-200 focus:ring-indigo-500 focus:border-indigo-500 rounded-xl text-slate-900 text-sm transition-all focus:ring-1 outline-none">
                    <option value="all">Semua Tipe</option>
                    @foreach($roomTypes as $type)
                        <option value="{{ $type->id }}" {{ request('room_type_id') == $type->id ? 'selected' : '' }}>
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>

                {{-- Filter by Status --}}
                <select name="status" class="appearance-none block px-4 py-2 bg-white border border-slate-200 focus:ring-indigo-500 focus:border-indigo-500 rounded-xl text-slate-900 text-sm transition-all focus:ring-1 outline-none">
                    <option value="all">Semua Status</option>
                    <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Available</option>
                    <option value="occupied" {{ request('status') == 'occupied' ? 'selected' : '' }}>Occupied</option>
                    <option value="maintenance" {{ request('status') == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                    <option value="cleaning" {{ request('status') == 'cleaning' ? 'selected' : '' }}>Cleaning</option>
                </select>

                {{-- Filter Button --}}
                <x-ui.button type="submit" variant="secondary" size="sm">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                    Filter
                </x-ui.button>

                @if(request()->hasAny(['search', 'room_type_id', 'status']))
                    <a href="{{ route('rooms.index') }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-slate-700 transition-colors">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Reset
                    </a>
                @endif
            </div>

            <div class="text-sm text-slate-500 font-medium whitespace-nowrap">
                Menampilkan <span class="text-slate-900 font-bold">{{ $rooms->count() }}</span> dari <span class="text-slate-900 font-bold">{{ $totalRooms }}</span> kamar
            </div>
        </form>
    </div>

    {{-- Rooms Table --}}
    <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-slate-500 text-xs uppercase tracking-wider font-semibold bg-slate-50/50">
                        <th class="px-6 py-4">No. Kamar</th>
                        <th class="px-6 py-4">Tipe Kamar</th>
                        <th class="px-6 py-4">Harga / Malam</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($rooms as $room)
                    <tr class="hover:bg-slate-50/50 transition-colors group">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-indigo-50 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                </div>
                                <span class="text-sm font-bold text-slate-900">#{{ $room->room_number }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold bg-indigo-50 text-indigo-700 border border-indigo-100">
                                {{ $room->roomType->name }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm font-bold text-slate-900">Rp {{ number_format($room->roomType->price, 0, ',', '.') }}</span>
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $statusStyles = [
                                    'available' => 'bg-emerald-50 text-emerald-700 border-emerald-100',
                                    'occupied' => 'bg-rose-50 text-rose-700 border-rose-100',
                                    'maintenance' => 'bg-amber-50 text-amber-700 border-amber-100',
                                    'cleaning' => 'bg-sky-50 text-sky-700 border-sky-100',
                                ];
                                $statusLabels = [
                                    'available' => 'Available',
                                    'occupied' => 'Occupied',
                                    'maintenance' => 'Maintenance',
                                    'cleaning' => 'Cleaning',
                                ];
                                $statusDots = [
                                    'available' => 'bg-emerald-500',
                                    'occupied' => 'bg-rose-500',
                                    'maintenance' => 'bg-amber-500',
                                    'cleaning' => 'bg-sky-500',
                                ];
                            @endphp
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold border {{ $statusStyles[$room->status] ?? $statusStyles['available'] }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ $statusDots[$room->status] ?? $statusDots['available'] }}"></span>
                                {{ $statusLabels[$room->status] ?? 'Unknown' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-1.5 opacity-0 group-hover:opacity-100 transition-opacity">
                                {{-- Edit Button --}}
                                <button
                                    type="button"
                                    x-on:click="$dispatch('open-modal', 'edit-room-{{ $room->id }}')"
                                    class="inline-flex items-center justify-center p-2 rounded-lg text-slate-500 hover:text-indigo-600 hover:bg-indigo-50 transition-all"
                                    title="Edit Kamar"
                                >
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </button>

                                {{-- Delete Button --}}
                                <button
                                    type="button"
                                    x-on:click="$dispatch('open-modal', 'delete-room-{{ $room->id }}')"
                                    class="inline-flex items-center justify-center p-2 rounded-lg text-slate-500 hover:text-rose-600 hover:bg-rose-50 transition-all"
                                    title="Hapus Kamar"
                                >
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>

                            {{-- Modal Edit Room --}}
                            <x-ui.modal name="edit-room-{{ $room->id }}" title="Edit Kamar #{{ $room->room_number }}">
                                <form id="form-edit-kamar-{{ $room->id }}" action="{{ route('rooms.update', $room->id) }}" method="POST" class="space-y-4">
                                    @csrf
                                    @method('PUT')

                                    <x-ui.input label="Nomor Kamar" name="room_number" value="{{ $room->room_number }}" placeholder="Contoh: 101" required />

                                    <div class="space-y-1.5">
                                        <label class="block text-sm font-semibold text-slate-700">Tipe Kamar <span class="text-rose-500">*</span></label>
                                        <select name="room_type_id" class="appearance-none block w-full px-4 py-2.5 bg-white border border-slate-200 focus:ring-indigo-500 focus:border-indigo-500 rounded-xl text-slate-900 text-sm transition-all focus:ring-1 outline-none" required>
                                            @foreach($roomTypes as $type)
                                                <option value="{{ $type->id }}" {{ $room->room_type_id == $type->id ? 'selected' : '' }}>
                                                    {{ $type->name }} — Rp {{ number_format($type->price, 0, ',', '.') }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="space-y-1.5">
                                        <label class="block text-sm font-semibold text-slate-700">Status <span class="text-rose-500">*</span></label>
                                        <select name="status" class="appearance-none block w-full px-4 py-2.5 bg-white border border-slate-200 focus:ring-indigo-500 focus:border-indigo-500 rounded-xl text-slate-900 text-sm transition-all focus:ring-1 outline-none" required>
                                            <option value="available" {{ $room->status == 'available' ? 'selected' : '' }}>🟢 Available</option>
                                            <option value="occupied" {{ $room->status == 'occupied' ? 'selected' : '' }}>🔴 Occupied</option>
                                            <option value="maintenance" {{ $room->status == 'maintenance' ? 'selected' : '' }}>🟡 Maintenance</option>
                                            <option value="cleaning" {{ $room->status == 'cleaning' ? 'selected' : '' }}>🔵 Cleaning</option>
                                        </select>
                                    </div>

                                    <x-slot:footer>
                                        <x-ui.button type="button" variant="secondary" x-on:click="show = false">Batal</x-ui.button>
                                        <x-ui.button type="submit" variant="primary" form="form-edit-kamar-{{ $room->id }}">
                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                            Perbarui Kamar
                                        </x-ui.button>
                                    </x-slot:footer>
                                </form>
                            </x-ui.modal>

                            {{-- Modal Delete Confirmation --}}
                            <x-ui.modal name="delete-room-{{ $room->id }}" title="Hapus Kamar #{{ $room->room_number }}" maxWidth="md">
                                <div class="text-center py-4">
                                    <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-rose-100 mb-4">
                                        <svg class="h-8 w-8 text-rose-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-bold text-slate-900 mb-2">Konfirmasi Hapus</h3>
                                    <p class="text-sm text-slate-500">
                                        Apakah Anda yakin ingin menghapus <strong class="text-slate-700">Kamar #{{ $room->room_number }}</strong> ({{ $room->roomType->name }})?
                                        <br>Tindakan ini tidak dapat dibatalkan.
                                    </p>
                                </div>

                                <x-slot:footer>
                                    <x-ui.button type="button" variant="secondary" x-on:click="show = false">Batal</x-ui.button>
                                    <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" class="inline">
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
                        <td colspan="5" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-16 h-16 rounded-2xl bg-slate-100 flex items-center justify-center mb-4">
                                    <svg class="w-8 h-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                </div>
                                <h3 class="text-sm font-bold text-slate-700 mb-1">Belum ada kamar</h3>
                                <p class="text-sm text-slate-500 mb-4">Klik "Tambah Kamar" untuk menambahkan kamar baru.</p>
                                <x-ui.button variant="primary" size="sm" x-on:click="$dispatch('open-modal', 'add-room')">
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                    Tambah Kamar Pertama
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
                Total: <span class="font-bold text-slate-700">{{ $totalRooms }}</span> kamar
                &bull; Halaman <span class="font-bold text-slate-700">{{ $rooms->currentPage() }}</span> dari <span class="font-bold text-slate-700">{{ $rooms->lastPage() }}</span>
            </p>
            <div>
                {{ $rooms->links() }}
            </div>
        </div>
    </div>

    {{-- Modal Add Room --}}
    <x-ui.modal name="add-room" title="Tambah Kamar Baru">
        <form id="form-tambah-kamar" action="{{ route('rooms.store') }}" method="POST" class="space-y-4">
            @csrf

            <x-ui.input label="Nomor Kamar" name="room_number" placeholder="Contoh: 101, 202, A-301" required />

            <div class="space-y-1.5">
                <label class="block text-sm font-semibold text-slate-700">Tipe Kamar <span class="text-rose-500">*</span></label>
                <select name="room_type_id" class="appearance-none block w-full px-4 py-2.5 bg-white border border-slate-200 focus:ring-indigo-500 focus:border-indigo-500 rounded-xl text-slate-900 text-sm transition-all focus:ring-1 outline-none" required>
                    <option value="" disabled selected>Pilih tipe kamar</option>
                    @foreach($roomTypes as $type)
                        <option value="{{ $type->id }}">{{ $type->name }} — Rp {{ number_format($type->price, 0, ',', '.') }}/malam</option>
                    @endforeach
                </select>
            </div>

            <div class="space-y-1.5">
                <label class="block text-sm font-semibold text-slate-700">Status <span class="text-rose-500">*</span></label>
                <select name="status" class="appearance-none block w-full px-4 py-2.5 bg-white border border-slate-200 focus:ring-indigo-500 focus:border-indigo-500 rounded-xl text-slate-900 text-sm transition-all focus:ring-1 outline-none" required>
                    <option value="available" selected>🟢 Available</option>
                    <option value="occupied">🔴 Occupied</option>
                    <option value="maintenance">🟡 Maintenance</option>
                    <option value="cleaning">🔵 Cleaning</option>
                </select>
            </div>

            <x-slot:footer>
                <x-ui.button type="button" variant="secondary" x-on:click="show = false">Batal</x-ui.button>
                <x-ui.button type="submit" variant="primary" form="form-tambah-kamar">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Simpan Kamar
                </x-ui.button>
            </x-slot:footer>
        </form>
    </x-ui.modal>
</x-layouts-admin>
