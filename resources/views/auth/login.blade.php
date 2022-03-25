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
    <!-- <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script> -->

    <style type='text/css'>

    body{
      color: #3181EA !important;
    }
        .embeddedServiceHelpButton .helpButton .uiButton {
        background-color: #005290;
        }
        .embeddedServiceHelpButton .helpButton .uiButton:focus {
        outline: 1px solid #005290;
        }

        #signin{
          padding-right: 54px;
          color: black !important;
          /*font-weight: bolder;*/
          font-size: 18px !important;
          padding-bottom: 0px !important;
          padding-top: 26px !important;
        }
        #signin:hover{
          cursor: pointer;
          text-decoration: none;
        }

        .foot{
          background: #f5f9fc !important;
        }

        #signin1{
          color: black !important;
        }

        .new{
          /*background-image: linear-gradient(white,#00000075) !important;*/
        }

        .maa{
          background: white !important;
        }

        .new-nav{
          margin-top: 6px !important;
        }

        .new-in{
          float: left;
          margin-left: 8px !important;
          float: left !important;
          /*margin-left: 0px !important;*/
          margin-top: 28px !important;
        }
        .footer ul li a {
          border-right: none;
        }
        .modal-login
    {
        min-height:500px;
    }
    .abcdef>li>a:hover
    {
        background-color:unset;
    }
    .alert-present .footer{
        margin-bottom: -60px;
    }
    .alert-present .alert-parent{
        margin-top: 20px;
    }

    .ct-acct{
      background: no-repeat !important;
    }

    .head-des{
    border-bottom-width: 1px;
    border-bottom-style: solid !important;
    min-height: calc(100vh - 150px) !important;
    }

     .head2{
     /* border-top-color: #E0E0E0;
    border-width: 1px !important;
    opacity: 33;*/
      /*min-height: 474px !important;*/
      /* min-height: 758px !important; */

   /* border-width: 1px !important;
    border-top-style: solid !important;*/
    border-bottom-width: 1px;
    /*border-bottom-style: solid !important;*/
    min-height: calc(100vh - 150px) !important;
     /*display: grid;*/
     place-content: center;
    }

    .lo-in{
      text-align: left;
      padding-top: 6px;
    }
    .lo-in h4{
      font-size: 18px;
      margin-left: 6px !important;
    }

    .header-top img.logo-top{
      width: 234px;
    }

    .header-top{
      padding-bottom: 0px !important;
    }

    .nav-inner{
      border-bottom: none !important;
    }
    .nav-inner li a{
      color: black !important;
    }
    .nav-inner li.active a{
      /*border-bottom: 3px solid #dc1212 !important;*/
    border-width: 4px !important;
    }

    .nav-inner li a:hover{
      /*border-bottom: 3px solid #dc1212 !important;*/
    border-width: 4px !important;
    }

    .le-ali{
      padding-left: 0px !important;
    }

    .ab{
      padding-left: 8px !important;
    }
    .f2{
      background: no-repeat !important;
      box-shadow: none !important;
    }

    .f2 ul{
      padding-left: 290px !important;
      margin-top: -30px !important;
    }
    main .container {min-height: auto;}
    .ct-acct{background: #f5f9fc; }
    .modal-login .modal-dialog{margin-top: 32px;}
    .modal-content{box-shadow: none !important;padding: 0 6%;/*border-radius: 32px;*/ padding-bottom: 78px !important;}
    .modal-login .modal-dialog{width: 466px;}
    .modal-header{border-bottom: none;padding-bottom: 0;padding-top: 15px;}
    .modal-login .modal-title img{max-width: 160px;width: 160px;}
    .modal-login .modal-title::after{border-top: 1px solid #000;}
    .modal-login .modal-body .form-group{color: rgb(25, 39, 240);}
    .modal-login .modal-body .form-group a{color: rgb(25, 39, 240);}
    .modal-login .modal-body{margin: 0 5%;padding-top: 40px !important;}
    .custom_line {border-top: 1px solid rgba(0,0,0,.2);float: left;position: absolute;width: 300px;top: 40px;margin-left: 50px;}
    .form-control {
        box-sizing: border-box;
        margin: 0px;
        outline: currentcolor none 0px;
        color:rgb(42, 43, 44);
        box-shadow: none;
        font-size: 16px;
        background: rgb(250, 250, 250) none repeat scroll 0% 0%;
        border-color: currentcolor currentcolor
        transparent;
        border-style: none none solid;
        border-width: 0px 0px 2px;
        border-image: none 100% / 1 / 0 stretch;
        border-radius: 8px 8px 0px 0px;
        padding: 18px 16px 14px;width: 100%;
        height: auto;
    }
    .form-control:hover {
        background: rgba(25, 39, 240, 0.05) none repeat scroll 0% 0%;
        border-bottom: 2px solid rgb(25, 39, 240) !important;
        border: 0;
    }
    .form-control:active, .form-control:focus {
        border-bottom: 2px solid rgb(25, 39, 240) !important;
        border: 0;
    }
    .email-label-helper, .password-label-helper {
        position: absolute;
        opacity: 0;
        transition: .2s bottom, .2s opacity;
        bottom: 0;
        left: 0;
        z-index: 1;
        color: rgb(25, 39, 240) !important;
        padding-left: 45px;
    }
    .form-control:focus + .email-label-helper, .form-control:focus + .password-label-helper
    {
        bottom: 87%;
        font-size: 14px;
        line-height: 1;
        opacity: 1;
        padding-left: 15px;
        position: relative;
    }

    .modal-login .modal-body .form-group input[type="submit"]
    {
        padding: 0px 20px;
        vertical-align: middle;
        -moz-appearance: none;
        background: rgb(25, 39, 240) none repeat scroll 0% 0%;
        border-color: transparent;
        border-radius: 1000px;
        border-style: solid;
        border-width: 1px;
        color: rgb(255, 255, 255);
        cursor: pointer;
        font-size: 18px;
        font-weight: 700;
        line-height: 1;
        text-align: center;
        transition: background 0.25s ease-out 0s, color 0.25s ease-out 0s;
        white-space: nowrap;
        height: 56px;
        width: 100%;
        margin-top: 15px;
    }

    .log{
      font-size: 22px !important;
      color: black !important;
      margin-bottom: 10px;
      width: 100%;
      display: inline-block;
    }
    .log1{
      color: black !important;
      font-size: 18px !important;
      font-weight: normal;
    }

    .form-c{
        display: block;
    width: 100%;
    border-color: black;
    height: 49px;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
    -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    }

    .modal-login .modal-body .form-group input[type="submit"]{
        /*width: 143px !important;*/
    height: 45px !important;
    border-radius: 23px !important;
    text-transform: capitalize;
    letter-spacing: 1px;
    /*background-color: #0071e0;*/
    border-color: #0071e0;
    font-size: 14px !important;
    font-weight: bolder !important;
    }

    ..modal-login .modal-body{
        padding: 21px !important;
    }

    .con-new {
    /*border-top-color: #E0E0E0;
    border-width: 1px !important;
    opacity: 33;*/
    /* min-height: 474px !important; */
    /* min-height: 758px !important; */
    /*border-width: 1.5px !important;
    border-top-style: solid !important;*/
    /* border-bottom-style: solid !important; */
}
    .modal-body p strong{color: red;}

    .ct-form h2{
        text-align: center !important;
        margin: 0px !important;
        margin-top: 20px !important;
    }

    .cen{
        text-align: center !important;
    }

    .mb{
        padding: 0px !important;
    }

    .cen span{
        font-size: 20px;
    }

    .em{
        color: black !important;
    font-weight: bold !important;
    margin-bottom: 4px !important;
    }

    .af{
        margin-top: 2px !important;
    }
    .frm-a{
      color:#3181EA !important;
    }

    .fl{
        float: left !important;
    margin-top: 10px !important;
    }

    .m-t{
        float: right !important;
    margin-top: -17px !important;
    }
    .inp{
        
    padding: 13px 31px !important;
    background-color: #0071e0!important;
    }
    .close
    {
        opacity :unset;
    }
    .alert
    {
        margin-bottom:unset;
        border-radius:unset;
    }
    .alert-inner 
    {
        position: fixed;
        bottom: 0px;
        left: 0px;
        right: 0px;
        background-color: #fff !important;
        box-shadow: 2px 2px 10px 2px #dedede;
        padding: 15px;
    }
    .alert-parent{
        position: relative;
        height: 60px;
    }
    .alert-inner .close{
        right:0px;
    }
    .search-footer{
        margin-right: 0px !important; 
        margin-left: 0px !important ;
    }
    </style>
</head>
<script type="text/javascript">
    jQuery(document).ready(function(){
     var height = jQuery(window).height();
     var header_height = jQuery('.header-area').height();
     var footer_height = jQuery('.footer').height();
     var final_height = height - header_height - footer_height;
  });
</script>
<body>
    
    <div class="container-fluid">
        <div class="ab @if( Request::path() == 'advance-search-result' ) container-fluid @else container @endif header-area">
             <div class="row">
                  <div class="col-md-12 header-top">
                      <div class="row">
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
                         <?php
                         if(!isset($id)){
                          $id = '';
                         }
                         ?>


                         <ul class="nav navbar-nav navbar-right abcdef">
                            @guest

                               
                              
                                
                          @else
                          <div class="profil-link" style="padding:unset">
                                <div class="btn-group">
                                    <button type="button" class="dropdown-toggle" data-toggle="dropdown">
                                        @if(Auth::user()->image)
                                       <img src='{{ asset('public/img/').'/'.Auth::user()->image }}' class="uploaded_image">
                                       @else
                                       <img class="uploaded_image" src="{{ url('/public/img/profile1.png')}}">
                                       @endif  
                                      {{-- <img src="{{ asset('public/img/profile.png') }}"> <sup></sup> --}}
                                    </button>
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
                                          @if( Auth::user()->name ) 
                                            <li>
                                              <a class="text-center bt-0 pt-0">{{ Auth::user()->name }}</a>
                                            </li>
                                          @endif
                                          <li>
                                            <a class="text-center bt-0 pt-0">{{ Auth::user()->email }}</a>
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
                            @endguest
                         </ul>
                      </div>
                  </div>
                  
  </ul>
             </div>
         </div>
         <div id="" class="  row main-content-area maa @if( Request::path() == 'advance-search-result' ) bg-main-content mr--15 @endif   @if( Request::path() == 'login')  col  @endif   @if(Request::path() == 'login') @elseif(Request::path() == 'log') head2 @else head-des   @endif  " >
            <main class="py-4">

<div class="container con-new">
<div class="container-fluid pd-none">
    <div class="ct-acct">

        <div class="modal-login">
            <div class="modal-dialog form-box ct-form">
                @if (session('success'))
                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                    <strong>Success ! </strong>
                    <span>{{ session('success') }}</span>
                </div>
                @endif

                @if (session('failure'))
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                    <strong>Warning ! </strong>
                    <span>{{ session('failure') }}</span>
                </div>
                @endif

                 @if (session('info'))
                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                    <strong>Info ! </strong>
                    <span>{{ session('info') }}</span>
                </div>
                @endif

                @if (session('warning'))
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                    <strong>Warning ! </strong>
                    <span>{{ session('warning') }}</span>
                </div>
                @endif
                    <div class="modal-content">
                        <div class="modal-header">
                            {{-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> --}}
                            <!-- <a href="{{ url('/') }}"> -->
                                <h4 class="modal-title" id="myModalLabel">
                                    <img src="{{ asset('public/img/logo.png') }}">
                                </h4>
                            <!-- </a> -->
                        </div>
                        <h2><strong class="log">Sign in</strong></h2>
                        <div class="cen">
                          <strong class="log log1">Use ifoundyou Account</strong>
                        </div>
                        <div class="modal-body mb">
                            @if ($errors->has('email'))
                            <p class="red-span-error">
                                <p><strong>{{ $errors->first('email') }}</strong>
                                </p>
                            @endif
                            @if ($errors->has('password'))
                            <p class="red-span-error">
                                <strong>{{ $errors->first('password') }}</strong>
                            </p>
                            @endif
                            <form method="POST" action="{{ route('login') }}" id="signin-form">
                                @csrf
                                <div class="form-group">
                                    <div class="log-form">
                                        <div class="form-group">
                                            <input type="hidden" name="user_loginID" value="{{app('request')->input('id')}}">
                                            <label class="em" for="login-email">Email</label>
                                            <input type="email" name="email" class="form-c" placeholder="" id="login-email" value="{{ session('email') }}">
                                            {{-- <a href="{{ url('/forgot') }}" id="forget-password" class="af frm-a">Forgot Email?</a> --}}
                                            
                                            <span class="red-span-error" id="email_error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label class="em" for="login-password">Password</label>
                                            <input type="password" name="password" class="form-c" placeholder="" id="login-password">
                                            <span class="red-span-error" id="pass_error"></span>
                                        </div>
                                        
                                        <a href="{{ url('/forgot') }}" id="forget-password" class="af frm-a">Forgot Password?</a>
                                        <a class="fl frm-a" href="{{ url('/') }}">Create Account</a>
                                        
                                        <div class="form-group text-center m-t">
                                            <input type="submit" name="" value="Next" id="sign-in-btn log-bt" class="inp" style="border-radius: 6px !important;">   
                                        </div>

                                        <!-- </div> -->

                                    </div>
                                </div>
                            </form>

                            
                        </div>
                        {{--<div class="modal-footer">

                        </div>--}}
                    </div>
        </div>
    </div>
</div>
</div>
</main>
        </div>

         
    </div>

         @if(Request::path() == 'login')
          <div class=" footer search-footer foot f2 new" >
              <div class="col-md-12"> 
                  <ul>
                      <!-- <li><a href="{{ url('/about') }}">About Us</a></li> -->
                      <li><a href="{{ url('/safety') }}">Help</a></li>
                      <li><a href="{{ url('/privacy') }}">Privacy</a></li>
                      <li><a href="{{ url('/terms') }}">Terms</a></li>
                      <!-- <li>{{ App::VERSION() }}</li> -->
                  </ul>
              </div>
          </div>

          @elseif(Request::path() == 'log')
            <div class=" footer search-footer foot f2 new" >
                <div class="col-md-12"> 
                    <ul>
                        <!-- <li><a href="{{ url('/about') }}">About Us</a></li> -->
                        <li><a href="{{ url('/safety') }}">Help</a></li>
                        <li><a href="{{ url('/privacy') }}">Privacy</a></li>
                        <li><a href="{{ url('/terms') }}">Terms</a></li>
                        <!-- <li>{{ App::VERSION() }}</li> -->
                    </ul>
                </div>
            </div>
          @else
             <div class=" footer search-footer foot new">
              <div class="col-md-12"> 
                  <ul>
                      <!-- <li><a href="{{ url('/about') }}">About Us</a></li> -->
                      <li><a href="{{ url('/terms') }}">Terms of Service</a></li>
                      <li><a href="{{ url('/privacy') }}">Privacy</a></li>
                      <li><a href="{{ url('/safety') }}">Safety</a></li>
                      <!-- <li>{{ App::VERSION() }}</li> -->
                  </ul>
              </div>
          </div>
        @endif

    <script type='text/javascript' src='https://service.force.com/embeddedservice/5.0/esw.min.js'></script>

</body>
</html>
