@props(['room'])

<div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/50 overflow-hidden border border-slate-100 group hover:shadow-2xl hover:shadow-indigo-100 transition-all duration-500 flex flex-col h-full relative">
    <button class="absolute top-6 right-6 z-10 p-3 bg-white/90 backdrop-blur-md rounded-2xl text-slate-400 hover:text-rose-500 hover:scale-110 transition-all shadow-sm">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
    </button>

    <div class="relative h-72 overflow-hidden">
        <img src="{{ $room['image'] ?? 'https://images.unsplash.com/photo-1618773928121-c32242e63f39' }}" alt="{{ $room['name'] ?? 'Hotel Room' }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/40 via-transparent to-transparent"></div>

        <div class="absolute bottom-6 left-6">
            <span class="inline-flex items-center px-3 py-1.5 bg-white/90 backdrop-blur-md text-slate-900 text-[10px] font-black rounded-xl uppercase tracking-wider shadow-sm">
                <span class="w-1.5 h-1.5 rounded-full {{ ($room['available'] ?? true) ? 'bg-emerald-500' : 'bg-amber-500' }} mr-2"></span>
                {{ ($room['available'] ?? true) ? 'Available Now' : 'Booked' }}
            </span>
        </div>
    </div>

    <div class="p-8 flex flex-col flex-grow">
        <div class="flex items-start justify-between gap-4 mb-3">
            <h3 class="text-xl font-black text-slate-900 tracking-tight leading-snug group-hover:text-indigo-600 transition-colors">
                {{ $room['name'] ?? 'Premium Room' }}
            </h3>
            <div class="flex items-center gap-1.5 bg-slate-50 px-2.5 py-1 rounded-xl border border-slate-100 shrink-0">
                <svg class="w-3.5 h-3.5 text-amber-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                <span class="text-xs font-black text-slate-900">{{ $room['rating'] ?? '5.0' }}</span>
                <span class="text-[10px] text-slate-400 font-medium">({{ $room['reviews'] ?? '120' }})</span>
            </div>
        </div>

        <p class="text-slate-500 text-sm leading-relaxed mb-6 font-medium line-clamp-2">
            {{ $room['description'] ?? 'No description available.' }}
        </p>

        <div class="flex flex-wrap gap-2 mb-8">
            @if(isset($room['amenities']) && is_array($room['amenities']))
                @foreach($room['amenities'] as $amenity)
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-slate-50 text-slate-600 text-xs font-semibold rounded-xl border border-slate-100" title="{{ $amenity['label'] ?? '' }}">
                        {!! $amenity['icon'] ?? '' !!}
                        <span class="text-[10px] font-black uppercase tracking-wider text-slate-500">{{ $amenity['short_label'] ?? 'ICON' }}</span>
                    </span>
                @endforeach
            @endif
            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-slate-50 text-slate-400 text-[10px] font-black rounded-xl border border-slate-100 uppercase tracking-wider">
                +4 More
            </span>
        </div>

        <div class="mt-auto">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-0.5">Per Night</p>
                    <div class="flex items-baseline gap-1.5">
                        <span class="text-2xl font-black text-indigo-600 tracking-tighter">{{ $room['price_formatted'] }}</span>
                    </div>
                </div>
                <div class="text-right">
                    <span class="inline-flex items-center px-2 py-1 bg-indigo-50 text-indigo-700 text-[10px] font-black rounded-lg uppercase tracking-wider">Best Value</span>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <a href="{{ route('guest.rooms.show', $room['id'] ?? 1) }}" class="inline-flex items-center justify-center px-4 py-4 bg-slate-50 hover:bg-slate-100 text-slate-900 font-black rounded-2xl transition-all border border-slate-200 shadow-sm active:scale-95 text-xs">
                    View Details
                </a>
                <a href="{{ route('guest.booking.create', $room['id'] ?? 1) }}" class="inline-flex items-center justify-center px-4 py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-black rounded-2xl transition-all shadow-lg shadow-indigo-100 active:scale-95 text-xs">
                    Book Room
                </a>
            </div>
        </div>
    </div>
</div>
