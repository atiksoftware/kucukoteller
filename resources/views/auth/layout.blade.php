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
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
 

</head>

<body class="">

    <div class="flex items-center justify-center min-h-screen">
        
        <div class=" max-w-full w-[448px] p-12  md:border rounded mx-auto"> 
            
            <div class="mb-12 mt-4 text-center">
                <h1 class="text-2xl ">@yield('title')</h1>
                <p class="text-sm">@yield('description')</p>
            </div>
            
            @yield('content', 'Default content')
            

        </div>
        
    </div>
 


</body>

 
<script src="{{ asset('js/auth.js') }}"></script>

</html>