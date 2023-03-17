<!DOCTYPE html>
<html lang="en">

<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LMS</title>
    {{ View::make('includes/styles') }}
    
</head>

{{-- <body class="bg-light">
    <div class="container">
        {{ View::make('layout/header') }}
        @yield('content')
        {{View::make('layout/footer')}}
    </div>
    {{ View::make('layout/script') }}
</body> --}}


{{-- {{ asset('js/app.js') }} --}}
<body data-sidebar='dark' style="background-image: url('{{ asset("images/bg-lms.jpg") }}'); background-size: contain;">


    <div >

        {{ View::make('includes/header') }}



        <div class="mt-5 pt-5">
            @yield('content')
        </div>



        {{-- {{View::make('includes/footer')}} --}}






        {{ View::make('includes/scripts') }}
</body>

</html>
