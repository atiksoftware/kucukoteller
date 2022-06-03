@extends('auth.layout')
 

@section('title', __('auth.two_factor_authentication'))

@section('description',  __('auth.enter_your_google_authenticator_code'))

@section('content')
@if ($errors->any())
    
<x-alert error :value="$errors->all()" class="mb-4 text-sm" /> 

@endif
  
    <form method="POST" action="{{ route('auth.otp-verify') }}">

        @csrf 

        <x-textbox name="otp_password" label="{{__('auth.password')}}" type="password" required />
    

        <x-button submit block lg class="mt-4">{{__('auth.continue')}}</x-button> 

        <div class="text-xs text-center text-slate-400 pt-4">{{__('auth.or')}}</div> 

        <x-button href="{{ route('auth.signout') }}" block text>{{__('auth.signout')}}</x-button> 

    </form>

@endsection
