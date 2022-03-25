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
        <script src="{{ asset('public/js/jquery.validate.min.js') }}"></script>

        <style type="text/css">
        body{
          outline: none !important;
        }
        button{
          outline: none !important;
        }
        	.sear{
        		background: #80808085;
        		border: none;
        		padding: 10px 7px 8px !important;
        		border-radius: 6px;
                margin-left: -28px !important;
        	}
            .all_open{
                background: #80808085;
                border: none;
                padding: 7px;
                border-radius: 6px;
            }
            .profil-link{
              padding-bottom: 12px !important;
            }

            .fl{
    padding-left: 0px !important;
  }

            .n-t{
              padding-top: 10px !important;
            }

            .lg-i{
              background: no-repeat!important;
              box-shadow: none!important;
            }

            #signin:hover {
    cursor: pointer;
    text-decoration: none;
    background: no-repeat !important;
  }

            #signin {
    /* color: black !important; */
    padding-right: 54px;
    /* font-weight: bolder; */
    font-family: verdana;
    font-size: 18px !important;
    padding-bottom: 0px !important;
    padding-top: 26px !important;
    color: black !important;}
            .custom_advance_search_box{padding: 0;text-align: left;}
            .co {
    padding: 0px !important;
}

.lo-in {
    text-align: left;
    padding-top: 6px;
}

        </style>
    </head>
    <script type="text/javascript">
        window.addEventListener( "pageshow", function ( event ) {
            var historyTraversal = event.persisted || 
            ( typeof window.performance != "undefined" && 
            window.performance.navigation.type === 2 );
            if ( historyTraversal ) {
                // Handle page restore.
                window.location.reload();
            }
        });
    </script>
    <script type="text/javascript">
        jQuery(document).ready(function(){
         var height = jQuery(window).height();
         var header_height = jQuery('.profil-link').height();
         var footer_height = jQuery('.footer').height();
         var final_height = height - header_height - footer_height;
         jQuery('.main-content-area').css('min-height', final_height);
      });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            var search_status = ''; 
            $(".search-input").on("keyup keydown change", function(e) {
                var search_result = $(this).val();
                var length = $(this).length;
                search_status = 'input';
                //console.log(search_result);
                // console.log(length);
                if(length >=1){
                    if(e.keyCode == 13 ){
                        // console.log('dd');
                        search_status = 'button';
                        searchAjax(search_result,search_status);
                    }
                    searchAjax(search_result,search_status);
                }
                if(length < 1){
                   
                    $(".displaynone").css("display","none");
                }
            });
            $(".searchButton").on('click change keyup keydown',function(e){
                if ($(window).width() < 1000){
                       // alert("mobile");
                    var search_result = $('.search-input-mobile').val();
                }else {
                   // alert("not mobile");
                   var search_result = $('.all_search_input').val();
                }
                if(search_result != ''){
                    console.log(search_result);
                        search_status = 'button';
                        if(e.keyCode == 13 ){
                        // console.log('dd');
                        search_status = 'button';
                        searchAjax(search_result,search_status);
                    }
                        searchAjax(search_result,search_status);
                }else{
                    // alert('Please enter value in input first');
                    return false;
                }
            });
            function searchAjax(search_result,search_status) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token()}}'
                        },
                    type: "post",
                    dataType: 'html',
                    url: "{{url ('/user/all_search')}}",
                    data: { "search_result":search_result } ,
                    success: function(data) {
                        // console.log(search_status);
                        if(search_status == 'input'){
                            $(".renderDiv").html(data);
                        }
                        if(search_status == 'button'){
                            window.location.href = "{{url('/user/all_user?search_result=')}}"+search_result;
                        } 
                    },
                    error: function(data){
                        return false;
                    }
                });
            }
        });
        $(document).ready(function(){
        	$('.menu-open').on('click',function(){
        	$('.mobile-head').toggle();
        	});
        });
    </script>

    {{-- advance search start --}}
    <script type="text/javascript">
    function registerCountries(value) 
    {
       if( value == 'USA' )
       {
          $('#custom_not_usa').hide();
          $('#custom_usa').show();
          $('.custom_interested_in').show();
       }
       
       if( value == 'Europe' )
       {
          $('#custom_not_usa').show();
          $('.custom_interested_in').show();
          $.ajax ( {
             url:  "{{ url('/get_europe_cities') }}",
             method: 'GET',
             data : {'continent':value},
             success: function(getcities) {
                if(getcities){
                   $('#adv_search_city').html(getcities);
                }
             }
          });
       }

       var value1 = $('#europecountries').val();
       if( value == 'England' || value == 'Canada' )
       {
          $('#custom_not_usa').show();
          $('.custom_interested_in').show();

          $.ajax ( {
             url:  "{{ url('/getcities') }}",
             method: 'GET',
             data : {'continent':value},
             success: function(getcities){
                if(getcities){
                   $('#adv_search_city').html(getcities);
                }
             }
          });
       }
    }

    $(window).load(function() {
       registerCountries($('#register_countries').val());
    });

    jQuery(document).ready(function(){
       $('#register_countries').change(function() {
          var value = $(this).val();
          //$('#adv_search_states').html('<option value="">Select State:</option>');
          $('#adv_search_city').html('<option value="">Select City</option>');
          //$('#adv_search_state').hide();
          $('#custom_usa').hide();
          $('#custom_not_usa').hide();
          $('.custom_interested_in').hide();

          registerCountries(value);
       });
       
    });
    </script>
    {{-- advance search end --}}
    <body>
        <div class="container-fluid">
            <div class="wrapper-cl">
                <div class="container-cl container co">
                    <div class="row">

                        <div class="col-md-12 col-sm-12 col-xs-12 full_dashboard fl">
                            <div class="profil-link col-md-12 col-lg-12 col-xs-12">
                                <div class="col-md-3 col-lg-3 col-xs-4">
                                    @if(Session::get('find_match'))
                                        <a href="/find-match" class="logo-dashboard logo-mob"><img src="{{ asset('public/img/logo.png') }}" style="float:left" class="img-responsive center-block logo-top mobile-logo"></a>
                                    @else
                                      <a href="{{ url('/user/dashboard') }}" class="logo-dashboard logo-mob"><img src="{{ asset('public/img/logo.png') }}" style="float:left" class="img-responsive center-block logo-top mobile-logo"></a>
                                    @endif
                                </div>

                                <div class="col-md-12 lo-in">
                                  <h4>Ifoundyou The Right One The Right Dating Service</h4>
                                </div>
                                {{--<div class="col-lg-5 col-md-5 col-xs-6 hidden-md-down down mob-button">
                                	<button type="button" class="fa fa-search menu-open all_open"></button>
                                	<div class="header-search mobile-head all_mobile">
                                        <div class="focus-search">
                                            <!-- <form method="post" action="{{url('user/all_search')}}" id="home-search-form"> -->
                                                <input type="search" autocomplete="off" placeholder="Search" name="first_Name" id="s" class="search-input input search-input-mobile">
                                                <input type="hidden" class="post_type" value="bounty">     
                                           
                                                <button type="button" class="fa fa-search header-search-btn search1 searchButton sear"></button>
                                                <div class="renderDiv">
                                                    @include('searchResultsRender')
                                                    <!-- <img loading="lazy" src="https://konnect.fan/staging/wp-content/themes/backer-child/images/lazyload.gif" class="channel_loader_modal lazyloaded" data-lazy-src="https://konnect.fan/staging/wp-content/themes/backer-child/images/lazyload.gif" data-was-processed="true"> -->
                                                </div>
                                            <!-- </form> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-5 col-xs-6 hidden-md-down down">
                                    <div class="header-search">
                                        <div class="focus-search">
                                            <!-- <form method="post" action="{{url('user/all_search')}}" id="home-search-form"> -->
                                                <input type="search" autocomplete="off" placeholder="Search" name="first_Name" id="s" class="search-input input all_search_input" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Search'">
                                                <input type="hidden" class="post_type" value="bounty">     
                                                <button type="button" class="header-search-btn search1 searchButton"><i class="fa fa-search search-icon"></i></button>
                                                <div class="renderDiv">
                                                    @include('searchResultsRender')
                                                    <!-- <img loading="lazy" src="https://konnect.fan/staging/wp-content/themes/backer-child/images/lazyload.gif" class="channel_loader_modal lazyloaded" data-lazy-src="https://konnect.fan/staging/wp-content/themes/backer-child/images/lazyload.gif" data-was-processed="true"> -->
                                                </div>
                                            <!-- </form> -->
                                        </div>
                                    </div>
                                </div>--}}

                                <div class="col-lg-7 col-md-7 col-xs-6 custom_advance_search_box">
                                  @if( Request::path() == 'user/dashboard' )
                                    <form method="post" action="{{ url('/advance-search-result') }}" id="home-search-form">
                                          @csrf
                                          <div class="row">
                                              <div class="col-md-10">
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
                                                      {{-- <div class="col-md-12">
                                                         <div class="form-group cus-form-group">
                                                            <select style="width:100%;" name="adv_search_state" id="adv_search_state" class="form-control">
                                                               <option value="">Select State:</option>
                                                            </select>
                                                            <span class="red-span-error" id="state_error">
                                                               <strong>@if ($errors->has('state')) {{ $errors->first('state') }} @endif</strong>
                                                            </span>
                                                         </div>
                                                      </div> --}}

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
                                                            <select class="form-control" name="adv_search_interested_in">
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

                                              <div class="col-md-2 text-center mt-25">
                                                  <input type="submit" value="Search" class="custom_search_btn" >
                                              </div>
                                          </div>
                                    </form>
                                  @endif
                                </div>

                                <div class="btn-group col-md-2 col-lg-2 col-xs-2">
                                 
                                  <div class="col-md-12 n-t">
                                    <!-- <ul class="nav navbar-nav navbar-right abcdef">
                                                        <li><a href="{{url('/log')}}"  id="signin">Sign in</a></li>
                                    </ul> -->
                                  </div>
                                  


                                    @if( Auth::check() )
                                        @if(Session::get('find_match'))
                                            <ul class="dropdown-menu" role="menu">
                                                <li class="flot_a">
                                                    @if( Auth::check() && Auth::user()->image)
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
                                                            
                                                            <h4>@if( Auth::check() && Auth::user()->name) {{ Auth::user()->name }} @else  @endif</h4>
                                                        </span>    
                                                    @endif
                                                </li>
                                                 <li> <a href="{{ url('/find-match') }}">Home</a> </li>
                                                <li><a href="{{ route('logout') }}">Sign Out</a></li>
                                            </ul>
                                        @else
                                            <ul class="dropdown-menu" role="menu">
                                                <li class="flot_a">
                                                    @if( Auth::check() && Auth::user()->image)
                                                        <a class="hoverover" href="{{ url('/user/change-photo') }}">
                                                            <img class="uploaded_image" src="{{ asset('public/img/').'/'.Auth::user()->image }}">1
                                                        </a>
                                                        {{--<span class="username">
                                                            <h4>@if( Auth::check() && Auth::user()->name && Auth::user()->type == "user") {{ Auth::user()->name }} @else  @endif</h4> 
                                                        </span>--}}


                                                    @else 
                                                        <a class="hoverover" href="{{ url('/user/change-photo') }}"> 
                                                            <img class="uploaded_image" src="{{ asset('public/img/profile1.png') }}">
                                                        </a>
                                                        {{--<span class="username">
                                                            <h4>@if( Auth::check() && Auth::user()->name) {{ Auth::user()->name }} @else  @endif</h4>
                                                        </span>--}}
                                                        
                                                    @endif
                                                </li>
                                                @if( Auth::user()->name ) 
                                                  <li>
                                                    <a class="text-center bt-0 pt-0">{{ Auth::user()->name }}</a>
                                                  </li>
                                                @endif
                                                @if(Auth::user()->email == 'no@gmail.com')

                                                @else

                                                <li>
                                                  <a class="text-center bt-0 pt-0">{{ Auth::user()->email }}</a>
                                                </li>
                                                @endif
                                                <li> <a href="{{ url('/user/dashboard') }}">Home</a> </li>
                                                <li> <a href="{{ url('/user/edit-user-profile') }}">Edit Profile</a> </li>
                                                <li> <a href="{{ url('/user/account-info') }}" class="text-center">Manage your ifoundyou account</a> </li>
                                                <!-- <li> <a href="{{ url('/user/dashboard') }}">Dashboard</a> </li> -->
                                                <li> <a href="{{ url('/advance-search-result') }}">Search</a> </li>
                                                {{--<li> <a href="{{ url('/find-match') }}">Find Match</a> </li>--}}
                                                {{--<li> <a href="{{ url('/user/change-photo') }}">Change Photo</a> </li>--}}
                                                {{--<li> <a href="{{ url('/user/account-info') }}">Settings</a> </li>--}}
                                                {{--<li id="friend-request-count"><a href="{{ url('/user/friend-request') }}">Friend Request <span></span></a></li>--}}
                                                <li><a href="{{ route('logout') }}">Sign Out</a></li>
                                                <li class="custom_profile_term d-flex">
                                                  <a href="{{ url('/privacy') }}">Privacy Policy</a>
                                                  <a href="{{ url('/terms') }}">Terms of Service</a>
                                                </li>
                                            </ul>
                                        @endif
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="container-fluid pd-none bg-main-content main-content-area @if(Request::path() == 'user/user-match-info') lg-i @elseif(Request::path()== 'user/new_user_aboutme') lg-i @elseif(Request::path() == 'user/new_user_aboutmymatch') lg-li  @elseif(Request::path() == 'user/horoscope')  lg-i @else  @endif">
                          @yield('content')
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class=" row footer">
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
    </body>
</html>
