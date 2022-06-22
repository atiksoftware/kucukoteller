@extends('dashboard.layout.layout')
  

@section('content')

<form action="" method="POST">
    <x-dashboard-header>
        <x-slot name="title">{{__('dashboard.categories')}}</x-slot>
        <x-slot name="actions">
            @if ($zone->id)
            <x-button :href="route('dashboard.zone.remove',$zone)" sm color="rose" text >{{__('dashboard.remove_this_content')}}</x-button>
            <x-button :href="route('dashboard.zone.store')" sm >{{__('dashboard.save_changes')}}</x-button>
            @else
            <x-button :href="route('dashboard.zone.update',$zone)" sm >{{__('dashboard.save_as_new')}}</x-button>
            @endif
        </x-slot>
        <x-slot name="description">{{__('dashboard.manage_categories')}}</x-slot>
    </x-dashboard-header>
 

    <div class="grid grid-cols-12 gap-4 mt-8">

        <div class="col-span-4 ">
            <x-textbox name="name" :label="__('dashboard.name')" :placeholder="__('dashboard.name_placeholder')" :value="$zone->name" />
        </div>
        <div class="col-span-4 ">
            <x-textbox name="title" :label="__('dashboard.title')" :placeholder="__('dashboard.title_placeholder')" :value="$zone->title" />
        </div>
        <div class="col-span-4 ">
            <x-textbox name="slug" :label="__('dashboard.slug')" :placeholder="__('dashboard.slug_placeholder')" :value="$zone->slug" />
        </div>

        <div class="max-w-xs col-span-12">
            <x-selectbox name="parent_id" :label="__('dashboard.parent')" :placeholder="__('dashboard.parent_placeholder')" 
                :value="$zone->parent_id" 
                :items="$zones"
                item_value="id"
                item_text="name" 
            />
        </div>

        {{-- <div class="col-span-12 ">
            <x-selectbox name="parent_id" :label="__('dashboard.parent')" :placeholder="__('dashboard.parent_placeholder')" :value="$zone->parent_id">
                <x-slot name="item_slot">
                    @foreach ($zones as $item)
                    <div class="p-2 cursor-pointer hover:bg-slate-200">{{$item->name}}</div>
                    @endforeach
                </x-slot>
            </x-selectbox>
        </div> --}}

        <div class="col-span-12 ">
            <x-textarea name="brief" :label="__('dashboard.brief')" :placeholder="__('dashboard.brief_placeholder')" :value="$zone->brief" />
        </div>
        <div class="col-span-12 ">
            <x-textarea name="content" :label="__('dashboard.content')" :placeholder="__('dashboard.content_placeholder')" :value="$zone->content" />
        </div>

    </div>
</form>

@endsection
