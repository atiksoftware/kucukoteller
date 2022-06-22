@extends('dashboard.layout.layout')
  

@section('content')

<form action="" method="POST">
    <x-dashboard-header>
        <x-slot name="title">{{__('dashboard.categories')}}</x-slot>
        <x-slot name="actions">
            @if ($category->id)
            <x-button :href="route('dashboard.category.remove',$category)" sm color="rose" text >{{__('dashboard.remove_this_content')}}</x-button>
            <x-button :href="route('dashboard.category.store')" sm >{{__('dashboard.save_changes')}}</x-button>
            @else
            <x-button :href="route('dashboard.category.update',$category)" sm >{{__('dashboard.save_as_new')}}</x-button>
            @endif
        </x-slot>
        <x-slot name="description">{{__('dashboard.manage_categories')}}</x-slot>
    </x-dashboard-header>
 

    <div class="grid grid-cols-2 gap-4 mt-8">

        <div>
            <x-textbox name="title" :label="__('dashboard.title')" :placeholder="__('dashboard.title_placeholder')" :value="$category->title" />
        </div>
        <div>
            <x-textbox name="slug" :label="__('dashboard.slug')" :placeholder="__('dashboard.slug_placeholder')" :value="$category->slug" />
        </div>
        <div class="col-span-2 ">
            <x-textarea name="brief" :label="__('dashboard.brief')" :placeholder="__('dashboard.brief_placeholder')" :value="$category->brief" />
        </div>
        <div class="col-span-2 ">
            <x-textarea name="content" :label="__('dashboard.content')" :placeholder="__('dashboard.content_placeholder')" :value="$category->content" />
        </div>

    </div>
</form>

@endsection
