<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>IFoundYou</title>
    <link href="{{ asset('public/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/font-awesome.min.css') }}">
    <script src="{{ asset('public/js/jquery.js') }}"></script>
    <script src="{{ asset('public/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/js/custom.js') }}"></script>
</head>
<body>
    <div class="container">
       <div class="row">
        <div class="col-md-12 header-top">
            <a href="/"><img src="{{ asset('public/img/logo.png') }}" class="img-responsive center-block logo-top"></a>
        </div>
    </div>
</div>


<main class="py-4">
    @yield('content')
</main>
</div>


<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <ul>
                    <li><a href="{{ url('/about') }}">About Us</a></li>
                    <li><a href="{{ url('/terms') }}">Terms of Service</a></li>
                    <li><a href="{{ url('/privacy') }}">Privacy</a></li>
                    <li><a href="{{ url('/safety') }}">Safety</a></li>
                </ul>
            </div>
            <div class="col-md-4">
              @include('../social_icons')
            </div>
        </div>
    </div>
</div>
</body>

</html>
