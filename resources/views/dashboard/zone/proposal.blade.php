@extends('dashboard.layout.layout')
   
@section('title',__('dashboard.proposal_edit_title'))

@section('content')

<form action="{{route('dashboard.zone.proposal.update',$proposal)}}" method="POST">
    @csrf
    
    <x-dashboard-header>
        <x-slot name="title">{{__('dashboard.proposal_edit_title')}}</x-slot>
        <x-slot name="actions" > 
            <x-button submit sm >{{__('dashboard.save_changes')}}</x-button>
        </x-slot>
        <x-slot name="description">{!!__('dashboard.proposal_edit_description',[
            'proposal_type_name' => __('dashboard.proposal_type.' . $proposal->type->name),
            'zone_name' => $proposal->zone->name,
        ])!!}</x-slot>
    </x-dashboard-header>
 
    <x-dashboard-errors :errors="$errors"></x-dashboard-errors>

    <div class="mt-4">
        <x-button sm :href="route('dashboard.zone.edit',$proposal->zone)" color="slate">{!!__('dashboard.proposal_turn_back_to_zone',[
            'name' => $proposal->zone->name,
        ])!!}</x-button>
    </div>

    <div class="grid grid-cols-2 gap-4 mt-4">  
        <div class="col-span-2 md:col-span-1 ">
            <x-textbox name="title" :label="__('dashboard.title')" :placeholder="__('dashboard.title_placeholder')" :value="Request::old('title') ?? $proposal->title" />
        </div>
        <div class="col-span-2 md:col-span-1 ">
            <x-textbox name="slug" :label="__('dashboard.slug')" :placeholder="__('dashboard.slug_placeholder')" :value="Request::old('slug') ?? $proposal->slug" />
        </div>
 

        <div class="col-span-2 ">
            <x-textarea name="brief" :label="__('dashboard.brief')" :placeholder="__('dashboard.brief_placeholder')" :value="Request::old('brief') ?? $proposal->brief" />
        </div>
        <div class="col-span-2 ">
            <x-textarea name="content" :label="__('dashboard.content')" :placeholder="__('dashboard.content_placeholder')" :value="Request::old('content') ?? $proposal->content" />
        </div>
        <div class="col-span-2 ">
            <x-dashboard-meta-title-description :object="$proposal" />
        </div> 
    </div>

    <div class="grid w-full grid-cols-1 mt-8 md:hidden"> 
        <x-button submit sm >{{__('dashboard.save_changes')}}</x-button>
    </div>
</form>

@endsection
