@extends('auth.layout')
 

@section('title', __('auth.setup_two_factor_authentication'))

@section('description',  __('auth.setup_two_factor_authentication_description'))

@section('content')

    <div class="text-center">{{__('auth.otp.scan-qr-code')}}</div>

    <div class="flex justify-center w-full">
        {!!$image_svg!!}
    </div>

    <x-button href="{{$otp_url}}" block text bold >{{__('auth.otp.open-as-link')}}</x-button> 


    <form method="POST" action="{{ route('auth.otp-setup') }}">

        @csrf 

        <x-checkbox name="completed" label="{{__('auth.otp.i-have-scanned-qr-code')}}" value="1" required class="mt-4"/>

        <x-button submit block lg class="mt-4">{{__('auth.otp.complete-setup')}}</x-button> 

    </form>

@endsection
