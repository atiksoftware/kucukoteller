<div class="mt-8 ">
    <div class="grid grid-cols-3 gap-4" data-rooms>
        @foreach ($hotel->rooms as $room)
            <div class="flex gap-2 p-2 bg-white border border-blue-400 border-dashed rounded" data-room>
                <div class="w-24 h-24 rounded bg-slate-100">
                    <img src="" alt="">
                </div>
                <div class="flex-1">
                    <p class="text-sm font-bold">{{ $room->name }}</p>
                    <p class="text-sm">{{ $room->description }}</p>
                    <p class="text-sm text-blue-500">{{ $room->bed_type->name }}</p> 
                    <p class="text-sm text-teal-600"> 
                        <b>{{$room->price_effect}}</b> <small class="text-slate-400">{{\App\Constants\PriceEffect::getUnitOptionText($room->price_effect_unit->name)}}</small>
                    </p> 
                </div>
                <div class="flex flex-col justify-between">
                    <div sortable-handler class="flex items-center justify-center w-8 h-8 rounded cursor-move bg-slate-100 hover:bg-slate-200">
                        <x-icon name="cursor-move" class="w-4 text-slate-500" />
                    </div>
                    <a 
                        href="{{route('dashboard.hotel.rooms.edit_room',[
                            'hotel' => $hotel, 
                            'room' => $room
                        ])}}" 
                        title="{{__('dashboard.edit')}}" 
                        class="flex items-center justify-center w-8 h-8 rounded cursor-pointer bg-slate-100 hover:bg-slate-200"
                    >
                        <x-icon name="pen-to-square" class="w-4 text-blue-500" />
                    </a>
                </div>
            </div>
        @endforeach
        <div class="flex gap-2 p-2 border border-dashed rounded border-slate-300" data-static>
            <div class="flex flex-col items-center justify-center w-full h-24 gap-2">
                @if ($hotel->rooms->count() == 0)
                <div class="text-sm text-rose-500">{{__('dashboard.there_is_no_room_here')}}</div>
                @endif
                <x-button :href="route('dashboard.hotel.rooms.create_room',$hotel)" sm  > 
                    {{__('dashboard.add_new_room')}}
                </x-button>
            </div>
        </div>
    </div>
</div>