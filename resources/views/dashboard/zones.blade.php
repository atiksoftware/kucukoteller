@extends('dashboard.layout.layout')
  

@section('content')

    <x-dashboard-header>
        <x-slot name="title">{{__('dashboard.zones')}}</x-slot>
        <x-slot name="actions">
            <x-button :href="route('dashboard.zone.create')" sm >{{__('dashboard.add_a_new')}}</x-button>
        </x-slot>
        <x-slot name="description">{{__('dashboard.manage_zones')}}</x-slot>
    </x-dashboard-header>

    <x-dashboard-search />


    <div class="divide-y divide-dashed">
        @foreach ($zones as $zone)
            <div class="flex w-full rounded hover:bg-slate-100">
                <a href="{{ route('dashboard.zone.edit',$zone) }}" class="flex-1 block p-4 font-semibold">{{ $zone->name }}</a>
                <a href="{{ route('dashboard.zone.edit',$zone) }}" class="flex-1 block p-4 font-semibold">{{ $zone->title }}</a>
            </div>
        @endforeach
    </div>
 


    <x-dashboard-pagination :records="$zones" /> 

@endsection
