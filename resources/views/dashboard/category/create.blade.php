@extends('dashboard.layout.layout')
  
@section('title',__('dashboard.category_create_title'))

@section('content')

<form action="{{route('dashboard.category.store')}}" method="POST">
    @csrf
    
    <x-dashboard-header>
        <x-slot name="title">{{__('dashboard.category_create_title')}}</x-slot>
        <x-slot name="actions" >
            <x-button submit sm >{{__('dashboard.create')}}</x-button>
        </x-slot>
        <x-slot name="description">{{__('dashboard.category_create_description')}}</x-slot>
    </x-dashboard-header>
 
    <x-dashboard-errors :errors="$errors"></x-dashboard-errors>

    <div class="grid grid-cols-2 gap-4 mt-8"> 
        <div class="col-span-2 md:col-span-1">
            <x-textbox name="title" :label="__('dashboard.title')" :placeholder="__('dashboard.title_placeholder')" :value="$category->title" />
        </div>
        <div class="col-span-2 md:col-span-1">
            <x-textbox name="slug" :label="__('dashboard.slug')" :placeholder="__('dashboard.slug_placeholder')" :value="$category->slug" />
        </div>
        <div class="col-span-2 ">
            <x-textarea name="brief" :label="__('dashboard.brief')" :placeholder="__('dashboard.brief_placeholder')" :value="$category->brief" />
        </div>
        <div class="col-span-2 ">
            <x-textarea name="content" :label="__('dashboard.content')" :placeholder="__('dashboard.content_placeholder')" :value="$category->content" />
        </div> 
    </div>

    <div class="grid w-full grid-cols-2 mt-8 md:hidden">
        <x-button submit class="col-span-2" >{{__('dashboard.create')}}</x-button>
    </div>
</form>

@endsection
