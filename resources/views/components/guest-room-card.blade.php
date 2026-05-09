@props(['room'])

<div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/50 overflow-hidden border border-slate-100 group hover:shadow-2xl hover:shadow-indigo-100 transition-all duration-500 flex flex-col h-full relative">
    <!-- Favorite Toggle -->
    <button class="absolute top-6 right-6 z-10 p-3 bg-white/90 backdrop-blur-md rounded-2xl text-slate-400 hover:text-rose-500 hover:scale-110 transition-all shadow-sm">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
    </button>

    <!-- Room Image -->
    <div class="relative h-72 overflow-hidden">
        <img src="{{ $room['image'] }}" alt="{{ $room['name'] }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
        
        <!-- Status Badge -->
        <div class="absolute bottom-6 left-6">
            <span class="inline-flex items-center px-4 py-2 bg-slate-900/80 backdrop-blur-md rounded-2xl shadow-sm text-[10px] font-black uppercase tracking-[0.1em] text-white">
                <span class="w-1.5 h-1.5 rounded-full {{ $room['available'] ? 'bg-emerald-400' : 'bg-rose-400' }} mr-2.5"></span>
                {{ $room['available'] ? 'Instant Booking' : 'Fully Booked' }}
            </span>
        </div>
    </div>

    <!-- Room Details -->
    <div class="p-8 flex flex-col flex-grow">
        <div class="flex justify-between items-start mb-4">
            <div>
                <h3 class="text-2xl font-black text-slate-900 group-hover:text-indigo-600 transition-colors tracking-tight">{{ $room['name'] }}</h3>
                <div class="flex items-center gap-2 mt-2">
                    <div class="flex text-amber-400">
                        @for($i=0; $i<5; $i++)
                            <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        @endfor
                    </div>
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ $room['rating'] ?? '4.9' }} ({{ $room['reviews'] ?? '120' }} Reviews)</span>
                </div>
            </div>
        </div>
        
        <p class="text-slate-500 text-sm leading-relaxed mb-8 flex-grow line-clamp-2 font-medium">
            {{ $room['description'] }}
        </p>

        <!-- Features/Amenities -->
        <div class="flex items-center justify-between py-6 border-t border-slate-50 mb-8">
            <div class="flex gap-6">
                @foreach(array_slice($room['amenities'], 0, 4) as $amenity)
                    <div class="flex flex-col items-center gap-2 text-slate-400 hover:text-indigo-600 transition-colors" title="{{ $amenity['label'] }}">
                        {!! $amenity['icon'] !!}
                        <span class="text-[10px] font-bold uppercase tracking-tighter">{{ $amenity['short_label'] ?? $amenity['label'] }}</span>
                    </div>
                @endforeach
            </div>
            <div class="text-right">
                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Specs</span>
                <div class="flex flex-col gap-0.5">
                    <span class="text-[11px] font-bold text-slate-700">{{ $room['capacity'] ?? '2 Adults' }}</span>
                    <span class="text-[11px] font-bold text-indigo-600">{{ $room['size'] ?? '32m²' }}</span>
                </div>
            </div>
        </div>

        <!-- Price and Action -->
        <div class="flex flex-col gap-4 mt-auto">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-0.5">Per Night</p>
                    <div class="flex items-baseline gap-1.5">
                        <span class="text-3xl font-black text-indigo-600 tracking-tighter">${{ $room['price'] }}</span>
                    </div>
                </div>
                <div class="text-right">
                    <span class="inline-flex items-center px-2 py-1 bg-indigo-50 text-indigo-700 text-[10px] font-black rounded-lg uppercase tracking-wider">Best Value</span>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <a href="{{ route('guest.rooms.show', $room['id']) }}" class="inline-flex items-center justify-center px-4 py-4 bg-slate-50 hover:bg-slate-100 text-slate-900 font-black rounded-2xl transition-all border border-slate-200 shadow-sm active:scale-95 text-xs">
                    View Details
                </a>
                <a href="{{ route('guest.booking.create', $room['id']) }}" class="inline-flex items-center justify-center px-4 py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-black rounded-2xl transition-all shadow-lg shadow-indigo-100 hover:shadow-indigo-200 active:scale-95 group/btn text-xs">
                    Book Now
                </a>
            </div>
        </div>
    </div>
</div>
