<?php 
// header('Access-Control-Allow-Methods: GET, POST');
// header("Access-Control-Allow-Headers: X-Requested-With"); 
?>
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- ?<meta http-equiv="Access-Control-Allow-Origin" content="*" /> -->
    <title>IFoundYou</title>
    <!-- Bootstrap -->
    <link href="{{ asset('public/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/owl.theme.css') }}">
    <script src="{{ asset('public/js/jquery.js') }}"></script>
    <script src="{{ asset('public/js/jquery.validate.min.js') }}"></script>


    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{ asset('public/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/js/custom.js') }}"></script>
    <script src="{{ asset('public/js/jquery.cropit.js') }}"></script>
    <script src="{{ asset('public/js/owl.carousel.js') }}"></script>
</head>

<script type="text/javascript">
  jQuery(document).ready(function(){
     var height = jQuery(window).height();
     var header_height = jQuery('.header-area').height();
     var footer_height = jQuery('.footer').height();
     var final_height = height - header_height - footer_height;
     jQuery('.main-content-area').css('min-height', final_height);
  });
</script>

<body>
    
  <div class="container-fluid">
      <div class="@if( Request::path() == 'advance-search-result' ) container-fluid @elseif( Request::path() == '/' )  @else container @endif header-area">
        <div class="row">
          <div class="col-md-12">
              <div class="row">
                  <div class="container pt-15 px-0">
                    <div class="col-lg-12 col-md-12 col-xs-12 px-0">
                      <a href="{{ url('/') }}">
                          <img src="{{ asset('public/img/logo.png') }}" class="logo-top">
                      </a>
                    </div>

                    <div class="col-md-8 mt-5 pl-0">
                      <h4>Ifoundyou The Right One The Right Dating Service</h4>
                    </div>

                    @if( Request::path() == '/' && !Auth::user() )
                      <?php /*<div class="col-md-4 text-right">
                        <a href="{{ url('/provinces-list') }}" class="create_account">Create an Account</a>
                      </div> */?>
                    @endif

                    @guest

                    @else
                      <div class="col-md-4 text-right">
                        <ul class="nav navbar-nav navbar-right abcdef">
                          <div class="profil-link" style="padding:unset">
                            <div class="btn-group">
                              <a class="hoverover" href="{{ url('/user/change-photo') }}">
                                @if( Auth::check() && Auth::user()->image && Auth::user()->profile_picture_status == 'Approve' )
                                    <img src="{{ asset('public/img/').'/'.Auth::user()->image }}" class="uploaded_image">
                                @else 
                                    <img class="uploaded_image" src="{{ asset('public/img/profile1.png') }}">
                                @endif
                              </a>
                              <br>
                              <button type="button" class="dropdown-toggle mt-5" data-toggle="dropdown">Menu</button>
                              <ul class="dropdown-menu" role="menu">
                                  <li class="flot_a">
                                      @if(Auth::user()->image)
                                          <a class="hoverover" href="{{ url('/user/change-photo') }}">
                                              <img class="uploaded_image" src="{{ asset('public/img/').'/'.Auth::user()->image }}">
                                          </a>
                                          {{--<span class="username">
                                              <!-- <h4>@if(Auth::user()->name) {{ Auth::user()->name }} @else  {{ Auth::user()->email }} @endif</h4> -->
                                              <h4>@if(Auth::user()->name) {{ Auth::user()->name }} @else  @endif</h4>
                                          </span>--}}
                                      @else 
                                          <a class="hoverover" href="{{ url('/user/change-photo') }}"> 
                                              <img class="uploaded_image" src="{{ asset('public/img/profile1.png') }}">
                                          </a>
                                          {{--<span class="username">
                                              <!-- <h4>@if(Auth::user()->name) {{ Auth::user()->name }} @else  {{ Auth::user()->email }} @endif</h4> -->
                                              <h4>@if(Auth::user()->name) {{ Auth::user()->name }} @else  @endif</h4>
                                          </span>--}}
                                          
                                      @endif
                                  </li>
                                  <li>
                                    <a class="text-center bt-0 pt-0">{{ Auth::user()->name }}</a>
                                  </li>
                                  
                                  @if(Auth::user()->account_setup == 1)
                                      <li> <a href="{{ url('/user/dashboard') }}">Home</a> </li>
                                      <li> <a href="{{ url('/user/edit-user-profile') }}">Edit Profile</a> </li>
                                      <li> <a href="{{ url('/user/account-info') }}" class="text-center">Manage your ifoundyou account</a> </li>
                                      <!-- <li> <a href="{{ url('/user/dashboard') }}">Dashboard</a> </li> -->
                                      <li> <a href="{{ url('/advance-search-result') }}">Search</a> </li>
                                      {{--<li> <a href="{{ url('/user/change-photo') }}">Change Photo</a> </li>--}}
                                      {{--<li> <a href="{{ url('/user/account-info') }}">Settings</a> </li>--}}
                                      {{--<li id="friend-request-count"><a href="{{ url('/user/friend-request') }}">Friend Request <span></span></a></li>--}}
                                  @endif
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
                          </div>
                        </ul>
                      </div>
                    @endguest
                  </div>

                  @if( Request::path() == 'advance-search-result' )
                      <div class="col-lg-7 col-md-6 col-xs-12 custom_advance_search_box">
                          <form method="post" action="{{ url('/advance-search-result') }}" id="home-search-form">
                          @csrf
                            <div class="row">
                              <div class="col-md-10 pr-0">
                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                           <label>Month</label>
                                           <select class="form-control" name="adv_search_month">
                                              <option value="">Select Month</option>
                                              <option value="1" @if(@$parameters['adv_search_month'] == '1') selected @endif>January</option>
                                              <option value="2" @if(@$parameters['adv_search_month'] == '2') selected @endif>February</option>
                                              <option value="3" @if(@$parameters['adv_search_month'] == '3') selected @endif>March</option>
                                              <option value="4" @if(@$parameters['adv_search_month'] == '4') selected @endif>April</option>
                                              <option value="5" @if(@$parameters['adv_search_month'] == '5') selected @endif>May</option>
                                              <option value="6" @if(@$parameters['adv_search_month'] == '6') selected @endif>June</option>
                                              <option value="7" @if(@$parameters['adv_search_month'] == '7') selected @endif>July</option>
                                              <option value="8" @if(@$parameters['adv_search_month'] == '8') selected @endif>August</option>
                                              <option value="9" @if(@$parameters['adv_search_month'] == '9') selected @endif>September</option><option value="10">October</option>
                                              <option value="11" @if(@$parameters['adv_search_month'] == '11') selected @endif>November</option>
                                              <option value="12" @if(@$parameters['adv_search_month'] == '12') selected @endif>December</option>
                                           </select>
                                        </div>
                                     </div>

                                     <div class="col-md-4">
                                        <div class="form-group">
                                           <label>Day</label>
                                           <select class="form-control" name="adv_search_day">
                                              <option value="">Select Day</option>
                                              @php
                                                 $day = 1;
                                              @endphp

                                              @for( $i = $day; $i<=31; $i++ )
                                                   <option value="{{ $i }}" @if(@$parameters['adv_search_day'] == $i) selected @endif>{{ $i }}</option>
                                               @endfor
                                           </select>
                                        </div>
                                     </div>

                                     <div class="col-md-4">
                                        <div class="form-group">
                                           <label>Year</label>
                                           <select class="form-control" name="adv_search_year">
                                              <option value="">Select Year</option>
                                              @php
                                                 $startYear = '1950';
                                                 $currentYear = date('Y');
                                              @endphp

                                              @for( $i = $startYear; $i<=$currentYear; $i++ )
                                                   <option value="{{ $i }}" @if(@$parameters['adv_search_year'] == $i) selected @endif>{{ $i }}</option>
                                               @endfor
                                           </select>
                                        </div>
                                     </div>

                                     <div class="col-md-12">
                                        <div class="form-group">
                                           <select class="form-control" name="adv_search_country" id="register_countries">
                                              <option value="">Select Country</option>
                                              @php
                                                 $RS_Countries = DB::table('country')->select('*')->where('continent', null)->get();
                                              @endphp

                                              @forelse( $RS_Countries as $RS_Country )
                                                  <option value="{{ $RS_Country->country_name }}" @if(@$parameters['adv_search_country'] == $RS_Country->country_name) selected @endif>{{ $RS_Country->country_name }}</option>
                                              @empty
                                              @endforelse
                                           </select>
                                        </div>
                                     </div>

                                     <span id="custom_not_usa" style="display: none;">

                                        <div class="col-md-12">
                                           <div class="form-group cus-form-group">
                                              <select style="width:100%;" name="adv_search_city" id="adv_search_city" class="form-control">
                                                 <option value="">Select City:</option>
                                              </select>
                                              <span class="red-span-error" id="city_error">
                                                 <strong>@if ($errors->has('city')) {{ $errors->first('city') }} @endif</strong>
                                              </span>
                                           </div>
                                        </div>
                                     </span>

                                     <span id="custom_usa" style="display: none;">
                                        <div class="col-md-12">
                                           <div class="form-group">
                                              <input type="text" name="adv_search_zipcode" id="adv_search_zipcode" class="form-control" placeholder="zip code" value="{{ @$parameters['adv_search_zipcode'] }}">
                                           </div>
                                        </div>
                                     </span>

                                     <span class="custom_interested_in" style="display: none;">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <select class="form-control" name="adv_search_interested_in" id="adv_search_interested_in">
                                                 <option value="">Who are you interested in?</option>
                                                 <option value="I am a man seeking a women" @if(@$parameters['adv_search_interested_in'] == 'I am a man seeking a women') selected @endif>I am a man seeking a women</option>
                                                 <option value="I am a women seeking a man" @if(@$parameters['adv_search_interested_in'] == 'I am a women seeking a man') selected @endif>I am a women seeking a man</option>
                                                 <option value="I am a man seeking a man" @if(@$parameters['adv_search_interested_in'] == 'I am a man seeking a man') selected @endif>I am a man seeking a man</option>
                                                 <option value="I am a women seeking a women" @if(@$parameters['adv_search_interested_in'] == 'I am a women seeking a women') selected @endif>I am a women seeking a women</option>
                                                </select>
                                            </div>
                                        </div>
                                    </span>

                                </div>
                              </div>

                              <div class="col-md-2 text-center mt-25 pl-0">
                                  <input type="submit" value="Search" class="custom_search_btn" >
                              </div>
                            </div>
                          </form>
                      </div>
                  @endif
                 
              </div>
          </div>
        </div>
      </div>

      <div id="" class="  row main-content-area maa @if( Request::path() == 'advance-search-result' ) bg-main-content mr--15 @endif   @if( Request::path() == 'login')  col  @endif   @if(Request::path() == 'login') @elseif(Request::path() == 'log') head2 @else col   @endif  " >
          <main class="py-4">
              @yield('content')
          </main>
      </div>

  </div>

    <div class="footer search-footer foot f2 new" >
      <div class="@if(Request::path() == '/') col-md-12 @else col-md-8 @endif">
      	<ul>
        	@if( Request::path() == 'login' )
              <li><a href="{{ url('/about') }}">About Us</a></li>
              <li><a href="{{ url('/safety') }}">Help</a></li>
              <li><a href="{{ url('/privacy') }}">Privacy</a></li>
              <li><a href="{{ url('/terms') }}">Terms</a></li>
        	@else
              <li><a href="{{ url('/about') }}">About Us</a></li>
              <li><a href="{{ url('/privacy') }}">Privacy</a></li>
              <li><a href="{{ url('/safety') }}">Safety</a></li>
              <li><a href="{{ url('/terms') }}">Terms of Use</a></li>
        	@endif
        	<!-- <li>{{ App::VERSION() }}</li> -->
        </ul>
      </div>

      @if( Request::path() != '/' )
        <div class="col-md-4">
          @include('../social_icons')
        </div>
      @endif
    </div>


    <div id="cookie" class="alert-parent alert alert-dismissible text-center">
        <div class="alert-inner">
         This site uses cookies. By continuing to browse the site you are agreeing to our use of cookies.
         <button><a href="#" id="btnCookie" data-dismiss="alert" aria-label="close">Yes</a></button>
         <button><a href="#">No</a></button>
       </div>
    </div>

<script type='text/javascript' src='https://service.force.com/embeddedservice/5.0/esw.min.js'></script>
<script type="text/javascript">
$(document).ready(function() {
    $("#btnCookie").click(function(e) {
      e.preventDefault();
      var d = new Date();
      localStorage.setItem('BrowseCookie', d.getTime() + (30*24*60*60*1000));
      $('#cookie').hide();
    });

    if( localStorage.getItem('BrowseCookie') )
    {
      $('#cookie').hide();
    }
    else
    {
      $('#cookie').show();
    }
});
</script>

</body>
</html>