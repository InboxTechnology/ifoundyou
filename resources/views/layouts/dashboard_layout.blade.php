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
</head>
<body>
 <div class="container-fluid">
    <div class="wrapper-cl">
        <div class="container-cl">
            <div class="row">
                <div class="col-md-2 col-sm-3 cl-nonembl">
                    <div class="serach-block">
                        <a href="{{ url('/') }}"><img src="{{ asset('public/img/search-icon1.png') }}" class="img-responsiver center-block"></a>
                    </div>
                </div>
                <div class="col-md-10 col-sm-9 col-xs-12">
                    <div class="profil-link">
                        <div class="btn-group">
                            <button type="button" class="dropdown-toggle" data-toggle="dropdown">
                                {{-- <img src="{{ asset('public/img/profile.png') }}"> <sup></sup> --}}
                                @if(Auth::user()->image)
                                <img src="{{ asset('public/img/').'/'.Auth::user()->image }}">
                                @else 
                                <img src="{{ asset('public/img/profile.png') }}">
                                @endif
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li class="flot_a">
                                    @if(Auth::user()->image)
                                        <a href="{{ url('/user/view-profile') }}"><img src="{{ asset('public/img/').'/'.Auth::user()->image }}"></a>
                                        <a href="{{ url('/user/dashboard') }}">Home</a>
                                    @else 
                                    <a href="{{ url('/user/view-profile') }}"> <img src="{{ asset('public/img/profile.png') }}"></a>
                                        <a href="{{ url('/user/dashboard') }}">Home</a>
                                    @endif
                                </li>
                                <li><a href="{{ url('/user/account-info') }}">Settings</a></li>
                                <li id="friend-request-count" style="display: none;"><a href="{{ url('/user/friend-request') }}">Friend Request <span></span></a></li>
                                <li><a href="{{ route('logout') }}">Sign Out</a></li>
                            </ul>
                            {{-- <ul class="dropdown-menu" role="menu">
                                <li class="flot_a">
                                    @if(Auth::user()->image)
                                        <a class="hoverover" href="{{ url('/user/change-photo') }}">
                                            <img src="{{ asset('public/img/').'/'.Auth::user()->image }}">
                                            <span>change</span>
                                        </a>
                                        <span class="username">
                                            <!-- <h4>@if(Auth::user()->name) {{ Auth::user()->name }} @else  {{ Auth::user()->email }} @endif</h4> -->
                                            <h4>@if(Auth::user()->name) {{ Auth::user()->name }} @else  @endif</h4>
                                            <a class="hovernext" href="{{ url('/user/dashboard') }}">Home</a>
                                        </span>
                                    @else 
                                        <a class="hoverover" href="{{ url('/user/change-photo') }}"> 
                                            <img src="{{ asset('public/img/profile.png') }}">
                                            <span>change</span>
                                        </a>
                                        <span class="username">
                                            <!-- <h4>@if(Auth::user()->name) {{ Auth::user()->name }} @else  {{ Auth::user()->email }} @endif</h4> -->
                                            
                                            <h4>@if(Auth::user()->name) {{ Auth::user()->name }} @else  @endif</h4>
                                            <a class="hovernext" href="{{ url('/user/dashboard') }}">Home</a>
                                        </span>
                                        
                                    @endif
                                </li>
                                <li class="btns">
                                    <a class="btn" href="{{ url('/user/account-info') }}">Settings</a>
                                    <a class="btn" href="{{ route('logout') }}">Sign Out</a>
                                </li>
                                <li id="friend-request-count" style="display: none;"><a href="{{ url('/user/friend-request') }}">Friend Request <span></span></a></li>
                            </ul> --}}
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
