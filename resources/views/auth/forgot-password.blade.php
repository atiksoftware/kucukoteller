@extends('auth.layout')
 

@section('title', __('auth.forgot_password'))

@section('description',  __('auth.fill_informations'))

@section('content')

    @if ($errors->any())
    
        <x-alert error :value="$errors->all()" class="mb-4 text-sm" /> 

    @endif

    @if (session('status'))

        <div class="p-4 mt-6 mb-6 rounded bg-emerald-100">

            <div class="font-medium text-emerald-600">

                {{session('status')}}

            </div> 

        </div>

    @else

        <form method="POST" action="{{ route('auth.password.email') }}">

            @csrf

            <div class="space-y-4 ">

                <x-textbox name="email" label="{{__('auth.email')}}" value="{{Request::old('email')}}" required autofocus />
        
                <x-g-recaptcha />
        
                <x-button submit block lg>{{__('auth.continue')}}</x-button> 

                <div class="text-xs text-center text-slate-400 pt-4">{{__('auth.already_have_account')}}</div> 

                <x-button href="{{ route('auth.signin') }}" block text>{{__('auth.signin')}}</x-button> 
        
            </div>

        </form>

    @endif

@endsection
