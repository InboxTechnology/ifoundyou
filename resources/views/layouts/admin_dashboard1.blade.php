<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ifound</title>
    <link href="{{ asset('public/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/font-awesome.min.css') }}">
    <script src="{{ asset('public/js/jquery.js') }}"></script>
    <script src="{{ asset('public/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/js/custom.js') }}"></script>
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
</head>
<body>
    <div class="container">
       <div class="row">
        <div class="col-md-12 header-top">
        	<nav class="navbar navbar-default">
        		<div class="container-fluid">
        			<div class="navbar-header">
        				<a class="navbar-brand" href="{{ url('/admin/dashboard') }}">ifoundyou</a>
        			</div>
        			<ul class="nav navbar-nav">
        				<li class=""><a href="{{ url('/admin/get-users') }}">Users</a></li>
        				<li><a href="#">Pages</a></li>
        				<li><a href="{{ url('/admin/logout') }}">Logout</a></li>
        			</ul>
        		</div>
        	</nav>
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
                    <li><a href="{{ url('/terms') }}">Terms of Service and Privacy</a></li>
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
