@extends('dashboard.layout.layout')
  
@section('title',__('dashboard.hotel_list_title'))

@section('content')

    <x-dashboard-header static_actions >
        <x-slot name="title">{{__('dashboard.hotel_list_title')}}</x-slot>
        <x-slot name="actions">
            <x-button :href="route('dashboard.hotel.create')" sm >{{__('dashboard.add_a_new')}}</x-button>
        </x-slot>
        <x-slot name="description">{{__('dashboard.hotel_list_description')}}</x-slot>
    </x-dashboard-header>

    <x-dashboard-search />


    <div class="divide-y divide-dashed">
        @foreach ($hotels as $hotel)
            <a class="flex w-full rounded hover:bg-slate-100" href="{{ route('dashboard.hotel.edit',$hotel) }}">
                <div>
                    <div>{{ $hotel->name }}</div>
                    <div>{{ $hotel->slug }}</div>
                </div> 
                <div>
                    @if ($hotel->category)
                    {{ $hotel->category->name }}
                    @endif
                </div> 
                <div>
                    @if ($hotel->zone)
                    {{ $hotel->zone->name }}
                    @endif
                </div> 
            </a>
        @endforeach
    </div>



    <x-dashboard-pagination :records="$hotels" /> 

@endsection
