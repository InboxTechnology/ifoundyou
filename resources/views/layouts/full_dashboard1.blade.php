<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ifound</title>
    <!-- Bootstrap -->
    <link href="{{ asset('public/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/lightbox.css') }}">
    <script src="{{ asset('public/js/jquery.js') }}"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{ asset('public/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/js/custom.js') }}"></script>
    <script src="{{ asset('public/js/lightbox.js') }}"></script>
    <script src="{{ asset('public/js/jquery.cropit.js') }}"></script>

</head>

<body>
 <div class="container-fluid">
    <div class="wrapper-cl">
        <div class="container-cl">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 col-sm-12 col-xs-12 full_dashboard">
                    <div class="profil-link">
                        <div class="btn-group">
                            <button type="button" class="dropdown-toggle" data-toggle="dropdown">
                                @if(Auth::user()->image)
                                <img src='{{ asset('public/img/').'/'.Auth::user()->image }}' class="uploaded_image">
                                @else 
                                <img class="uploaded_image" src="{{ asset('public/img/profile1.png') }}">
                                @endif
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li class="flot_a">
                                    @if(Auth::user()->image)
                                        <a class="hoverover" href="{{ url('/user/change-photo') }}">
                                            <img class="uploaded_image" src="{{ asset('public/img/').'/'.Auth::user()->image }}">
                                        </a>
                                        <span class="username">
                                            <!-- <h4>@if(Auth::user()->name) {{ Auth::user()->name }} @else  {{ Auth::user()->email }} @endif</h4>-->

                                            <h4>@if(Auth::user()->name) {{ Auth::user()->name }} @else  @endif</h4> 
                                        </span>
                                    @else 
                                        <a class="hoverover" href="{{ url('/user/change-photo') }}"> 
                                            <img class="uploaded_image" src="{{ asset('public/img/profile1.png') }}">
                                        </a>
                                        <span class="username">
                                            <!-- <h4>@if(Auth::user()->name) {{ Auth::user()->name }} @else  {{ Auth::user()->email }} @endif</h4> -->
                                            <h4>@if(Auth::user()->name) {{ Auth::user()->name }} @else  @endif</h4>
                                        </span>
                                        
                                    @endif
                                </li>
                                 <li> <a href="{{ url('/user/dashboard') }}">Home</a> </li>
                                <li> <a href="{{ url('/user/change-photo') }}">Change Profile Photo</a> </li>
                                <li> <a href="{{ url('/user/my-profile') }}">My Account</a> </li>
                                <li> <a href="{{ url('/user/account-info') }}">Settings</a> </li>
                                <li id="friend-request-count" style="display: none;"><a href="{{ url('/user/friend-request') }}">Friend Request <span></span></a></li>
                                <li><a href="{{ route('logout') }}">Sign Out</a></li>
                            </ul>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                        </div>
                    </div>
                    <div class="block-al">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
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
