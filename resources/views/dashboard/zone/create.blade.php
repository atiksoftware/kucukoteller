@extends('dashboard.layout.layout')
  
@section('title',__('dashboard.zone_create_title'))

@section('content')

<form action="{{route('dashboard.zone.store')}}" method="POST">
    @csrf

    <x-dashboard-header>
        <x-slot name="title">{{__('dashboard.zone_create_title')}}</x-slot>
        <x-slot name="actions" >
            <x-button submit sm >{{__('dashboard.create')}}</x-button>
        </x-slot>
        <x-slot name="description">{{__('dashboard.zone_create_description')}}</x-slot>
    </x-dashboard-header>
 
    <x-dashboard-errors :errors="$errors"></x-dashboard-errors>
 

    <div class="grid grid-cols-12 gap-4 mt-8"> 
        <div class="col-span-12 md:col-span-4 ">
            <x-textbox name="name" :label="__('dashboard.name')" :placeholder="__('dashboard.name_placeholder')" :value="Request::old('name') ?? $zone->name" />
        </div>
        <div class="col-span-12 md:col-span-4 ">
            <x-textbox name="title" :label="__('dashboard.title')" :placeholder="__('dashboard.title_placeholder')" :value="Request::old('title') ?? $zone->title" />
        </div>
        <div class="col-span-12 md:col-span-4 ">
            <x-textbox name="slug" :label="__('dashboard.slug')" :placeholder="__('dashboard.slug_placeholder')" :value="Request::old('slug') ?? $zone->slug" />
        </div>

        <div class="col-span-12 md:max-w-xs">
            <x-selectbox name="parent_id" :label="__('dashboard.parent')" :placeholder="__('dashboard.parent_placeholder')" 
                :value="Request::old('parent_id') ?? $zone->parent_id" 
                :items="$zones"
                item_value="id"
                item_text="name" 
                searchable
            />
        </div> 

        <div class="col-span-12 ">
            <x-textarea name="brief" :label="__('dashboard.brief')" :placeholder="__('dashboard.brief_placeholder')" :value="Request::old('brief') ?? $zone->brief" />
        </div>
        <div class="col-span-12 ">
            <x-textarea name="content" :label="__('dashboard.content')" :placeholder="__('dashboard.content_placeholder')" :value="Request::old('content') ?? $zone->content" />
        </div>
        <div class="col-span-12 ">
            <x-dashboard-meta-title-description :object="$zone" />
        </div> 
    </div>

    <div class="grid w-full grid-cols-2 mt-8 md:hidden">
        <x-button submit class="col-span-2" >{{__('dashboard.create')}}</x-button>
    </div>
</form>

@endsection
