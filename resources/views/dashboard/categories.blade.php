@extends('dashboard.layout.layout')
  

@section('content')

    <x-dashboard-header>
        <x-slot name="title">{{__('dashboard.categories')}}</x-slot>
        <x-slot name="actions">
            <x-button :href="route('dashboard.category.create')" sm >{{__('dashboard.add_a_new')}}</x-button>
        </x-slot>
        <x-slot name="description">{{__('dashboard.manage_categories')}}</x-slot>
    </x-dashboard-header>

    <x-dashboard-search />


    <div class="divide-y divide-dashed">
        @foreach ($categories as $category)
            <div class="flex w-full rounded hover:bg-slate-100">
                <a href="{{ route('dashboard.category.edit',$category) }}" class="flex-1 block p-4 font-semibold">{{ $category->title }}</a>
            </div>
        @endforeach
    </div>
 


    <x-dashboard-pagination :records="$categories" /> 

@endsection
