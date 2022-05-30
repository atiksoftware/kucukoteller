@extends('auth.layout')
 
@section('title', __('auth.signup'))

@section('description',  __('auth.fill_informations'))

@section('content')
@if ($errors->any())
    <div class="p-4 mt-8 rounded bg-rose-50">
        <div class="font-medium text-red-600">
            {{__('app.oops')}}
        </div>

        <ul class="mt-3 text-sm text-red-600 list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form method="POST" action="{{ route('signup') }}">
    @csrf
    <div class="mt-8 space-y-4"> 

        <x-textbox name="firstname" label="{{__('auth.firstname')}}" value="{{Request::old('firstname')}}" required autofocus />

        <x-textbox name="lastname" label="{{__('auth.lastname')}}" value="{{Request::old('lastname')}}" required />
        
        <x-textbox name="email" label="{{__('auth.email')}}" value="{{Request::old('email')}}" required type="email" />
        
        <x-textbox name="password" label="{{__('auth.password')}}" type="password" required />
        
        <x-textbox name="password_confirmation" label="{{__('auth.password_confirmation')}}" type="password" required />
 
        <x-g-recaptcha />
 
        <x-button type="submit" block lg>{{__('auth.signup')}}</x-button>

        <div class="text-xs text-center text-slate-400 pt-4">{{__('auth.already_have_account')}}</div> 

        <x-button href="{{ route('signin') }}" block text>{{__('auth.signin')}}</x-button> 
 
    </div>
</form>


@endsection