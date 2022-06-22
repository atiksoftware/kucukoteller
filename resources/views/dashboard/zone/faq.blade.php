@extends('dashboard.layout.layout')
   
@section('title',__('dashboard.zone_faq_edit_title'))

@section('content')

<form action="{{route('dashboard.zone.faq.update',$zone)}}" method="POST">
    @csrf
    
    <x-dashboard-header>
        <x-slot name="title">{{__('dashboard.zone_faq_edit_title')}}</x-slot>
        <x-slot name="actions" > 
            <x-button submit sm >{{__('dashboard.save_changes')}}</x-button>
        </x-slot>
        <x-slot name="description">{!!__('dashboard.zone_faq_edit_description',[
            'zone_name' => $zone->name,
        ])!!}</x-slot>
    </x-dashboard-header>
 
    <x-dashboard-errors :errors="$errors"></x-dashboard-errors>
    
    <div class="mt-4">
        <x-button sm :href="route('dashboard.zone.edit',$zone)" color="slate">{!!__('dashboard.proposal_turn_back_to_zone',[
            'name' => $zone->name,
        ])!!}</x-button>
    </div>

    <div class="mt-8 ">
        <x-dashboard-faq-editor :faqs="$zone->faqs" />
    </div>

    <div class="grid w-full grid-cols-1 mt-8 md:hidden"> 
        <x-button submit sm >{{__('dashboard.save_changes')}}</x-button>
    </div>
</form>

@endsection
