@extends('dashboard.layout.layout')
  
@section('title',__('dashboard.hotel_create_title'))

@section('content')

<form action="{{route('dashboard.hotel.store')}}" method="POST">
    @csrf

    <x-dashboard-header>
        <x-slot name="title">{{__('dashboard.hotel_create_title')}}</x-slot>
        <x-slot name="actions" >
            <x-button submit sm >{{__('dashboard.create')}}</x-button>
        </x-slot>
        <x-slot name="description">{{__('dashboard.hotel_create_description')}}</x-slot>
    </x-dashboard-header>
 
    <x-dashboard-errors :errors="$errors"></x-dashboard-errors>
 

    <div class="grid grid-cols-12 gap-4 mt-8"> 
        <div class="col-span-12 md:col-span-6 ">
            <x-textbox name="name" :label="__('dashboard.name')" :placeholder="__('dashboard.name_placeholder')" :value="Request::old('name') ?? $hotel->name" />
        </div> 
        <div class="col-span-12 md:col-span-6 ">
            <x-textbox name="slug" :label="__('dashboard.slug')" :placeholder="__('dashboard.slug_placeholder')" :value="Request::old('slug') ?? $hotel->slug" />
        </div> 
        <div class="col-span-12 ">
            <x-textarea name="content" :label="__('dashboard.content')" :placeholder="__('dashboard.content_placeholder')" :value="Request::old('content') ?? $hotel->content" />
        </div>
        <div class="col-span-12 ">
            <x-dashboard-meta-title-description :object="$hotel" />
        </div> 
    </div>

    <div class="grid w-full grid-cols-2 mt-8 md:hidden">
        <x-button submit class="col-span-2" >{{__('dashboard.create')}}</x-button>
    </div>
</form>

@endsection
