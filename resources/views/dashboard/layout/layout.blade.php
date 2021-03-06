<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="robots" content="noindex, nofollow">

    <title>@yield('title')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"> 


    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
 

</head>

<body class="bg-slate-200">

    <div id="app" class="antialiased min-h-screen relative block md:pl-[300px] pt-[64px] transition-all">
        
        @include('dashboard.layout.header')
        @include('dashboard.layout.left-sidebar')
        
        <main class="p-4">
            <div class="p-4 bg-white rounded ">
                @yield('content')
            </div>
        </main>
        
    </div>
 
    @foreach (\App\Helpers\ToastHelper::get() as $toast)
    <div class="hidden toast" data-type="{{$toast['type']}}" data-message="{{$toast['text']}}" ></div> 
    @endforeach  

</body>

 
<script src="{{ asset('js/dashboard.js') }}"></script>

</html>