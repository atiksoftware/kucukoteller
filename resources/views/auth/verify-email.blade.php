@extends('auth.layout')
 

@section('title', __('auth.verify_email'))

@section('description',  __('auth.verify_email_description'))

@section('content')

 

    @if (session('status'))

        <x-alert success :value="session('status')" class="mb-4 text-sm" />  

    @else
        

        @if ($errors->any())
            <x-alert error :value="$errors->all()" class="mb-4 text-sm" /> 
        @else
            <x-alert error :value="__('auth.verify-email.email-not-verified')" class="mb-4 text-sm" /> 
        @endif

        <form method="POST" action="{{ route('auth.verify-email.create') }}">

            @csrf

            <div class="mt-8 space-y-4"> 

                <div class="text-xs text-center text-slate-400 pt-4">{{__('auth.verify-email.if-not-received')}}</div> 

                <x-g-recaptcha />

                <x-button submit block>{{__('auth.verify-email.get-new-verification-link')}}</x-button> 
            
            </div>

        </form>

    @endif

@endsection
