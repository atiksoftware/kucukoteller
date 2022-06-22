<div class="mt-8 ">
    @if ($comments->count() == 0)
        <div class="p-8 text-center">
            <h1 class="text-lg text-gray-600">{{__('dashboard.there_are_currently_no_comments')}}</h1>
        </div>
    @endif
    <div class="space-y-4">
        @foreach ($comments as $comment)
            <div class="flex gap-2 p-2 border border-blue-400 border-dashed rounded lg:flex "> 
                <div class="w-64 ">
                    <div class="text-sm font-medium">{{$comment->fullname}}</div>
                    <div class="text-xs">{{$comment->email}}</div>
                </div>
                <div class="flex-1">
                    <div class="text-sm">{{$comment->comment_content}}</div>
                    <div class="p-2 mt-2 text-xs rounded bg-amber-100">{{$comment->answer_content}}</div>
                </div>
                <div>
                    <a 
                        {{-- href="{{route('dashboard.hotel.rooms.edit_room',[
                            'hotel' => $hotel, 
                            'room' => $room
                        ])}}"  --}}
                        title="{{__('dashboard.edit')}}" 
                        class="flex items-center justify-center w-8 h-8 rounded cursor-pointer bg-slate-100 hover:bg-slate-200"
                    >
                        <x-icon name="pen-to-square" class="w-4 text-blue-500" />
                    </a>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-4">
        {{$comments->links()}}
    </div>
</div>