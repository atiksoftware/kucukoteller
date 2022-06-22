@extends('dashboard.layout.layout')
   
@section('title',$title)

@section('content')

<form action="{{$action}}" method="POST">
    @csrf
    
    <x-dashboard-header>
        <x-slot name="title">{!!$title!!}</x-slot>
        <x-slot name="actions" >
            <x-button :href="route('dashboard.hotel.remove',$hotel)" sm color="rose" text >{{__('dashboard.remove_this_content')}}</x-button>
            <x-button submit sm >{{__('dashboard.save_changes')}}</x-button>
        </x-slot>
        <x-slot name="description">{!!$description!!}</x-slot>
    </x-dashboard-header>
 
    <x-dashboard-errors :errors="$errors"></x-dashboard-errors>

    @include('dashboard.hotel.tabs') 

    @include('dashboard.hotel.modules.'.$module_name)
  

    <div class="grid w-full grid-cols-2 mt-8 md:hidden">
        <x-button submit class="col-span-2" >{{__('dashboard.save_changes')}}</x-button>
    </div>
</form>

@endsection
