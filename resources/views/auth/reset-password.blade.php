@extends('auth.layout')
 

@section('title', __('auth.forgot_password'))

@section('description',  __('auth.fill_informations'))

@section('content')

    @if ($errors->any())
        <x-alert error :value="$errors->all()" class="mb-4 text-sm" /> 
    @endif

    <form method="POST" action="{{ route('auth.password.update') }}">

        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">
        
        <div class="space-y-4 "> 

            <x-textbox name="email" label="{{__('auth.email')}}" value="{{Request::old('email') ?? $request->email}}" required readonly />

            <x-textbox name="password" label="{{__('auth.password')}}" type="password" required  />
            
            <x-textbox name="password_confirmation" label="{{__('auth.password_confirmation')}}" type="password" required  />

            <x-button submit block lg>{{__('auth.reset_password')}}</x-button> 
    
        </div>

    </form> 

@endsection
