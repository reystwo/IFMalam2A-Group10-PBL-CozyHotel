@props(['room'])

<div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 overflow-hidden border border-slate-100 group hover:shadow-2xl hover:shadow-indigo-100 transition-all duration-500 flex flex-col h-full">
    <!-- Room Image -->
    <div class="relative h-64 overflow-hidden">
        <img src="{{ $room['image'] }}" alt="{{ $room['name'] }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
        
        <!-- Status Badge -->
        <div class="absolute top-4 right-4">
            <span class="inline-flex items-center px-3 py-1 bg-white/90 backdrop-blur-md rounded-full shadow-sm text-xs font-bold {{ $room['available'] ? 'text-emerald-600' : 'text-rose-600' }}">
                <span class="w-1.5 h-1.5 rounded-full {{ $room['available'] ? 'bg-emerald-600' : 'bg-rose-600' }} mr-2 animate-pulse"></span>
                {{ $room['available'] ? 'Available' : 'Sold Out' }}
            </span>
        </div>

        <!-- Hover Overlay -->
        <div class="absolute inset-0 bg-indigo-900/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
    </div>

    <!-- Room Details -->
    <div class="p-6 flex flex-col flex-grow">
        <div class="flex justify-between items-start mb-3">
            <h3 class="text-xl font-bold text-slate-900 group-hover:text-indigo-600 transition-colors">{{ $room['name'] }}</h3>
        </div>
        
        <p class="text-slate-500 text-sm leading-relaxed mb-6 flex-grow line-clamp-2">
            {{ $room['description'] }}
        </p>

        <!-- Amenities Icons -->
        <div class="flex items-center gap-5 mb-8 py-4 border-y border-slate-50">
            @foreach($room['amenities'] as $amenity)
                <div class="flex flex-col items-center gap-1.5 group/icon" title="{{ $amenity['label'] }}">
                    <div class="text-slate-400 group-hover/icon:text-indigo-600 transition-colors">
                        {!! $amenity['icon'] !!}
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Footer: Price and Button -->
        <div class="flex items-center justify-between mt-auto">
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-0.5">Price starting at</p>
                <div class="flex items-baseline gap-1">
                    <span class="text-2xl font-black text-indigo-600">${{ $room['price'] }}</span>
                    <span class="text-slate-400 text-sm font-medium">/night</span>
                </div>
            </div>

            <a href="{{ route('rooms.show', $room['id']) }}" class="inline-flex items-center justify-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-2xl transition-all shadow-lg shadow-indigo-100 hover:shadow-indigo-200 active:scale-95">
                Book Now
            </a>
        </div>
    </div>
</div>
