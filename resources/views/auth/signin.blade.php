@extends('auth.layout')
 

@section('title', __('auth.signin'))

@section('description',  __('auth.fill_informations'))

@section('content')

    <form method="POST" action="{{ route('auth.signin') }}">

        @csrf

        <div class="space-y-4 ">

            <x-textbox name="email" label="{{__('auth.email')}}" value="{{Request::old('email')}}" required autofocus />

            <x-textbox name="password" label="{{__('auth.password')}}" type="password" required />
    
            @if (Route::has('auth.password.request'))

                <div>

                    <a href="{{ route('auth.password.request') }}" class="text-sm font-semibold text-rose-500 hover:text-rose-600">{{__('auth.forgot_password')}}</a>
                
                </div>

            @endif
    
            <x-button submit block lg>{{__('auth.signin')}}</x-button> 

            <div class="text-xs text-center text-slate-400 pt-4">{{__('auth.dont_have_an_account')}}</div> 

            <x-button href="{{ route('auth.signup') }}" block text>{{__('auth.create_new_account')}}</x-button> 

        </div>

    </form>

@endsection