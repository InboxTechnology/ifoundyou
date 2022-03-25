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

            .n-t{
              padding-top: 10px !important;
            }

            .lg-i{
              background: no-repeat!important;
              box-shadow: none!important;
            }

            .cl{
              padding: 0px !important;
            }

            .fl{
              padding: 0px !important; 
            }

            .logo-dashboard{
              width: 234px !important;
            }

            .lo-in{
      text-align: left;
      padding-top: 6px;

    }

    .lo-in h4{
      font-weight: normal !important;
    }

     .nav-inner{
      border-bottom-width: 1.5px !important;
      margin: 0px 2px;
    }

    .ig{
      padding-left: 10px !important;
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
    color: black !important;
    }
    .custom_advance_search_box{padding: 0;text-align: left;}
    .modal-open .modal {
      background: inherit;
    }
    .modal-content {
      text-align: left;
    }
    .btn-blue {
      background: #0071e0;
    }
    .modal-footer .btn-secondary:hover {
      color: #333 !important;
    }
    .modal-footer .btn:focus, .modal-footer .btn:active:focus, .modal-footer .btn:active {
      outline-offset: 0;
      outline: 0;
      border: 1px;
    }
        </style>
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
                <div class="container-cl container cl">
                    <div class="row">

                        <div class="col-md-12 col-sm-12 col-xs-12 full_dashboard fl">
                            <div class="profil-link col-md-12 col-lg-12 col-xs-12">
                                <div class="col-md-3 col-lg-3 col-xs-4 ig">
                                    @if(Session::get('find_match'))
                                        <a href="/find-match" class="logo-dashboard logo-mob"><img src="{{ asset('public/img/logo.png') }}" style="float:left" class="img-responsive center-block logo-top mobile-logo"></a>
                                    @else
                                      <a href="{{ url('/user/dashboard') }}" class="logo-dashboard logo-mob"><img src="{{ asset('public/img/logo.png') }}" style="float:left; width: 234px;" class="img-responsive center-block logo-top mobile-logo"></a>
                                    @endif
                                </div>
                                <div class="col-md-10 lo-in">
                                <h4>Ifoundyou The Right One The Right Dating Service</h4>
                              </div>

                              <div class="btn-group col-md-2 col-lg-2 col-xs-2" style="float: right; top: -31px;">
                                  @if(Request::path() == 'user/new_user_edit_profile')
                                  <div class="col-md-12 n-t">
                                    <ul class="nav navbar-nav navbar-right abcdef">
                                      <li><a href="{{url('/log')}}"  id="signin">Sign in</a></li>
                                    </ul>
                                  </div>
                                  @elseif( Auth::check() && !Auth::user()->email)
                                     <div class="col-md-12 n-t">
                                      <ul class="nav navbar-nav navbar-right abcdef">
                                        <li><a href="{{url('/log')}}"  id="signin">Sign in</a></li>
                                      </ul>
                                    </div>
                                  @else
                                    <a class="hoverover" href="{{ url('/user/change-photo') }}">
                                      @if( Auth::check() && Auth::user()->image && Auth::user()->profile_picture_status == 'Approve' )
                                          <img src="{{ asset('public/img/').'/'.Auth::user()->image }}" class="uploaded_image">
                                      @else 
                                          <img class="uploaded_image" src="{{ asset('public/img/profile1.png') }}">
                                      @endif
                                    </a>
                                    <br>
                                    <button type="button" class="dropdown-toggle mt-5" data-toggle="dropdown">Menu</button>
                                  @endif

                                    @if( Auth::check() )
                                        @if(Session::get('find_match'))
                                            <ul class="dropdown-menu" role="menu">
                                                <li class="flot_a">
                                                    @if( Auth::check() && Auth::user()->image && Auth::user()->profile_picture_status == 'Approve' )
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
                                                <li><a href="javascript:;" data-toggle="modal" data-target="#logoutModal">Sign Out</a></li>
                                            </ul>
                                        @else
                                            <ul class="dropdown-menu" role="menu">
                                                <li class="flot_a">
                                                    @if( Auth::check() && Auth::user()->image && Auth::user()->profile_picture_status == 'Approve' )
                                                      <a class="hoverover" href="{{ url('/user/change-photo') }}">
                                                        <img class="uploaded_image" src="{{ asset('public/img/').'/'.Auth::user()->image }}">1
                                                        </a>
                                                    @else 
                                                      <a class="hoverover" href="{{ url('/user/change-photo') }}"> 
                                                        <img class="uploaded_image" src="{{ asset('public/img/profile1.png') }}">
                                                        </a>
                                                    @endif
                                                </li>
                                                <li>
                                                  <a class="text-center bt-0 pt-0">{{ Auth::user()->name }}</a>
                                                </li>
                                                
                                                <li> <a href="{{ url('/user/dashboard') }}">Home</a> </li>
                                                <li> <a href="{{ url('/user/edit-user-profile') }}">Edit Profile</a> </li>
                                                <!-- <li> <a href="{{ url('/user/account-info') }}" class="text-center">Manage your ifoundyou account</a> </li> -->
                                                <li> <a href="{{ url('/advance-search-result') }}">Search</a> </li>
                                                <li><a href="javascript:;" data-toggle="modal" data-target="#logoutModal">Sign Out</a></li>
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

                            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h4 id="logoutModalLabel">Sign Out <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button></h4>
                                  </div>
                                  <div class="modal-body">
                                    Do you really want to sign out?
                                  </div>
                                  <div class="modal-footer">
                                    <a href="{{ route('logout') }}" class="btn btn-primary btn-blue">Yes</a>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>
                        </div>

                        <div class="container-fluid pd-none bg-main-content main-content-area lg-i">
                          <div class="container">
                            <form method="post" action="{{ url('/advance-search-result') }}" >
                                @csrf

                                <div class="row custom_advance_search_box">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-2 px-5">
                                        <div class="form-group">
                                            <select class="form-control" name="adv_search_month" id="adv_search_month">
                                                <option value="">Select Month</option>
                                                <option value="1" {{ Auth::user()->month=='1' ? 'selected' : '' }}>January</option>
                                                <option value="2" {{ Auth::user()->month=='2' ? 'selected' : '' }}>February</option>
                                                <option value="3" {{ Auth::user()->month=='3' ? 'selected' : '' }}>March</option>
                                                <option value="4" {{ Auth::user()->month=='4' ? 'selected' : '' }}>April</option>
                                                <option value="5" {{ Auth::user()->month=='5' ? 'selected' : '' }}>May</option>
                                                <option value="6" {{ Auth::user()->month=='6' ? 'selected' : '' }}>June</option>
                                                <option value="7" {{ Auth::user()->month=='7' ? 'selected' : '' }}>July</option>
                                                <option value="8" {{ Auth::user()->month=='8' ? 'selected' : '' }}>August</option>
                                                <option value="9" {{ Auth::user()->month=='9' ? 'selected' : '' }}>September</option>
                                                <option value="10" {{ Auth::user()->month=='10' ? 'selected' : '' }}>October</option>
                                                <option value="11" {{ Auth::user()->month=='11' ? 'selected' : '' }}>November</option>
                                                <option value="12" {{ Auth::user()->month=='12' ? 'selected' : '' }}>December</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2 px-5">
                                        <div class="form-group">
                                            <select class="form-control" name="adv_search_day">
                                                <option value="">Select Day</option>
                                                @php
                                                    $day = 1;
                                                @endphp

                                                @for( $i = $day; $i<=31; $i++ )
                                                    <option value="{{ $i }}" {{ Auth::user()->day==$i ? 'selected' : '' }}>{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2 px-5">
                                        <div class="form-group">
                                            <select class="form-control" name="adv_search_year">
                                                <option value="">Select Year</option>
                                                @php
                                                    $startYear = '1950';
                                                    $currentYear = date('Y');
                                                @endphp

                                                @for( $i = $startYear; $i<=$currentYear; $i++ )
                                                    <option value="{{ $i }}" {{ Auth::user()->year==$i ? 'selected' : '' }}>{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-1">
                                        <input type="submit" value="Search" class="custom_search_btn" >
                                    </div>
                                </div>
                            </form>
                          </div>
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
