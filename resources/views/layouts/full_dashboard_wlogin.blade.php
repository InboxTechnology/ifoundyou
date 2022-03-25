<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>IFoundYou</title>
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
        <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

    </head>
    <script type="text/javascript">
        jQuery(document).ready(function(){
         var height = jQuery(window).height();
         var header_height = jQuery('.profil-link').height();
         var footer_height = jQuery('.footer').height();
         var final_height = height - header_height - footer_height;
         jQuery('.main-content-area').css('min-height', final_height);
      });
    </script>

    <body>

        <div class="container">
            <div class="container header-area">
                 <div class="row">
                    <div class="col-md-12 header-top">
                        @if(Request::path() != '/' && Request::path() != 'login' && Request::path() != 'forgot' && Request::path() != 'home' && Request::path() != 'find-match' &&  Request::path() != 'findmatch' &&  Request::path() != 'aboutme_mymatch' &&  Request::path() != 'about-me'  && Request::path() != 'custom-search' && Request::path() != 'custom' && Request::path() != 'user-profile/'.request()->route('id') && Request::path() != 'user/custom' && Request::path() != 'Mymatch' )


                            <img src="{{ asset('public/img/logo.png') }}" style="float:left" class="img-responsive center-block logo-top">
                        @endif
                       <!--  @if(Request::path() == '/')
                           <img src="{{ asset('public/img/logo.png') }}" class="img-responsive center-block logo-top">
                        @endif -->

                       <?php
                       if(!isset($id)){
                        $id = '';
                       }
                       ?>
                        @if(!Auth::user())
                           <ul class="nav navbar-nav navbar-right abcdef">

                                <li><a href="{{ url('/register?id='.app('request')->input('id')) }}">Create an account</a></li>
                                <li><a href="{{ url('/login?id='.app('request')->input('id') ) }}" id="signin">Sign in</a></li>  
                           </ul> 
                        @else                   
                            <div class="profil-link">
                                @if(Session::get('custom'))
                                    <a href="/user/dashboard" class="logo-dashboard"><img src="{{ asset('public/img/logo.png') }}" style="float:left" class="img-responsive center-block logo-top"></a>
                                @else

                                    <a href="/find-match" class="logo-dashboard"><img src="{{ asset('public/img/logo.png') }}" style="float:left" class="img-responsive center-block logo-top"></a>
                                @endif

                                @if(Session('custom'))
                                    <div class="btn-group">
                                        <button type="button" class="dropdown-toggle" data-toggle="dropdown">
                                        {{-- <img src="{{ asset('public/img/profile.png') }}"> <sup></sup> --}}
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
                                            <h4>@if(Auth::user()->name && Auth::user()->type == "user") {{ Auth::user()->name }} @else  @endif</h4> 
                                        </span>
                                    @else 
                                        <a class="hoverover" href="{{ url('/user/change-photo') }}"> 
                                            <img class="uploaded_image" src="{{ asset('public/img/profile1.png') }}">
                                        </a>
                                        <span class="username">
                                            
                                            <h4>@if(Auth::user()->name) {{ Auth::user()->name }} @else  @endif</h4>
                                        </span>
                                        
                                    @endif
                                    </li>
                                    <li> <a href="{{ url('/user/dashboard') }}">Home</a> </li>
                                    <li> <a href="{{ url('/find-match') }}">Fast Match</a> </li>
                                    <li> <a href="{{ url('/user/change-photo') }}">Change Profile Photo</a> </li>
                                    <li> <a href="{{ url('/user/user-profile') }}">My Account</a> </li>
                                    <li> <a href="{{ url('/user/account-info') }}">Settings</a> </li>
                                    <li id="friend-request-count" style="display: none;"><a href="{{ url('/user/friend-request') }}">Friend Request <span></span></a></li>
                                    <li><a href="{{ route('logout') }}">Sign Out</a></li>
                                </ul>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        @else

                                <div class="btn-group">
                                    <button type="button" class="dropdown-toggle" data-toggle="dropdown">
                                        {{-- <img src="{{ asset('public/img/profile.png') }}"> <sup></sup> --}}
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
                                                {{--<span class="username">
                                                    <h4>@if(Auth::user()->name && Auth::user()->type == "user") {{ Auth::user()->name }} @else  @endif</h4> 
                                                </span>--}}
                                            @else 
                                                <a class="hoverover" href="{{ url('/user/change-photo') }}"> 
                                                    <img class="uploaded_image" src="{{ asset('public/img/profile1.png') }}">
                                                </a>
                                                {{--<span class="username">
                                                    <h4>@if(Auth::user()->name && Auth::user()->type == "user") {{ Auth::user()->name }} @else  @endif</h4>
                                                </span>--}}
                                            @endif
                                        </li>
                                        @if( Auth::user()->name ) 
                                          <li>
                                            <a class="text-center bt-0 pt-0">{{ Auth::user()->name }}</a>
                                          </li>
                                        @endif
                                        <li>
                                            <a class="text-center bt-0 pt-0">{{ Auth::user()->email }}</a>
                                        </li>

                                        <li> <a href="{{ url('/user/dashboard') }}">Home</a> </li>
                                        <li> <a href="{{ url('/user/edit-user-profile') }}">Edit Profile</a> </li>
                                        {{--<li> <a href="{{ url('/find-match') }}">Home</a> </li>--}}
                                        <li> <a href="{{ url('/user/account-info') }}" class="text-center">Manage your ifoundyou account</a> </li>
                                        <!-- <li> <a href="{{ url('/user/dashboard') }}">Dashboard</a> </li> -->
                                        <li> <a href="{{ url('/advance-search-result') }}">Search</a> </li>
                                        <!-- <li> <a href="{{ url('/user/change-photo') }}">Change Profile Photo</a> </li>
                                        <li> <a href="{{ url('/user/user-profile') }}">My Account</a> </li>
                                        <li> <a href="{{ url('/user/account-info') }}">Settings</a> </li>
                                        <li id="friend-request-count" style="display: none;"><a href="{{ url('/user/friend-request') }}">Friend Request <span></span></a></li> -->
                                        <li><a href="{{ route('logout') }}">Sign Out</a></li>
                                        <li class="custom_profile_term d-flex">
                                          <a href="{{ url('/privacy') }}">Privacy Policy</a>
                                          <a href="{{ url('/terms') }}">Terms of Service</a>
                                        </li>
                                    </ul>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                        @endif
                            </div>
                        @endif
                    </div>
                 </div>
             </div>
             <div class="row main-content-area">
                <main class="py-4">
                    @yield('content')
                </main>
            </div>
            <div class="row footer">
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
        <!-- <div class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <ul>
                            <li><a href="{{ url('/about') }}">About Us</a></li>
                            <li><a href="{{ url('/terms') }}">Terms of Service</a></li>
                            <li><a href="{{ url('/privacy') }}">Privacy</a></li>
                            <li><a href="{{ url('/safety') }}">Safety</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div> -->

            
    </body>
</html>
