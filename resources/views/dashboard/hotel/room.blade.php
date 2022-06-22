@extends('dashboard.layout.layout')
   
@section('title',$title)

@section('content')

<form action="{{$action}}" method="POST">
    @csrf
    
    <x-dashboard-header>
        <x-slot name="title">{{$title}}</x-slot>
        <x-slot name="actions" > 
            <x-button submit sm >{{$action_name}}</x-button>
        </x-slot>
        <x-slot name="description">{!!$description!!}</x-slot>
    </x-dashboard-header>
 
    <x-dashboard-errors :errors="$errors"></x-dashboard-errors>
    
    <div class="mt-4">
        <x-button sm :href="route('dashboard.hotel.rooms.edit',$hotel)" color="slate">{!!__('dashboard.turn_back_to_hotel',[
            'hotel_name' => $hotel->name,
        ])!!}</x-button>
    </div>

    <div class="grid grid-cols-12 gap-4 mt-8"> 
        <div class="col-span-12 md:col-span-6 ">
            <x-textbox name="name" :label="__('dashboard.name')" :value="Request::old('name') ?? $room->name" />
        </div> 
        <div class="col-span-12 md:col-span-6 ">
            <x-textbox name="description" :label="__('dashboard.description')" :value="Request::old('description') ?? $room->description" />
        </div> 
        <div class="col-span-12 md:col-span-4 ">
            <x-selectbox name="bed_type_id" :label="__('dashboard.bed_type')" :items="$bed_types" :value="Request::old('bed_type_id') ?? $room->bed_type_id" />
        </div> 
        <div class="col-span-12 md:col-span-4 ">
            <x-textbox name="size" :label="__('dashboard.room_size')" :value="Request::old('size') ?? $room->size" type="number" />
        </div> 
        <div class="col-span-12 md:col-span-4 ">
            <x-textbox name="capacity" :label="__('dashboard.room_capacity')" :value="Request::old('capacity') ?? $room->capacity" type="number" />
        </div> 
        <div class="col-span-12 md:col-span-4 ">
            <x-checkbox name="children_allowed" :label="__('dashboard.children_allowed')" :value="Request::old('children_allowed') ?? $room->children_allowed" />
        </div> 
        <div class="col-span-12 md:col-span-4 ">
            <x-checkbox name="extra_bed_allowed" :label="__('dashboard.extra_bed_allowed')" :value="Request::old('extra_bed_allowed') ?? $room->extra_bed_allowed" />
        </div> 
    </div>
    <div class="mt-8 -mx-4 border-2 border-dashed"></div>
    <div class="grid grid-cols-12 gap-4 mt-8"> 
        <div class="col-span-12 sm:col-span-6 md:col-span-4 lg:col-span-3 ">
            <x-textbox name="price_effect" :label="__('dashboard.price_effect')"  :value="Request::old('price_effect') ?? $room->price_effect" />
        </div>  
        <div class="col-span-12 sm:col-span-6 md:col-span-4 lg:col-span-3">
            <x-selectbox name="bed_type_id" :label="__('dashboard.price_effect_unit')" :items="\App\Constants\PriceEffect::getUnitOptions()" item_value="value" item_text="text" :value="Request::old('bed_type_id') ?? $room->bed_type_id" />
        </div>  
    </div>

    <div class="grid w-full grid-cols-1 mt-8 md:hidden"> 
        <x-button submit sm >{{__('dashboard.save_changes')}}</x-button>
    </div>
</form>

@endsection
