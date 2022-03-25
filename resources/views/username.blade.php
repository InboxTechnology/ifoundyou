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
        .embeddedServiceHelpButton .helpButton .uiButton {
        background-color: #005290;
        font-family: "Arial", sans-serif;
        }
        .embeddedServiceHelpButton .helpButton .uiButton:focus {
        outline: 1px solid #005290;
        }

        #signin{
          /*color: black !important;*/
          /*font-weight: bolder;*/
          font-family: verdana;
          font-size: 18px !important;
          padding-bottom: 0px !important;
          padding-top: 26px !important;
          color: black !important;
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

        .py-4{
          font-family: verdana !important;
        }

        .new{
          /*background-image: linear-gradient(white,#00000075) !important;*/
        }

        .maa{
          background: white !important;
        }
    </style>

    <script type="text/javascript">
    jQuery(document).ready(function(){
     var height = jQuery(window).height();
     var header_height = jQuery('.header-area').height();
     var footer_height = jQuery('.footer').height();
     var final_height = height - header_height - footer_height;
     jQuery('.main-content-area').css('min-height', final_height);

     // var divs = document.getElementById('cookie');
     //    if(divs)
     //    {
     //        var final_height = final_height - 60;
     //        jQuery('body > div').addClass('alert-present');
     //        jQuery('.main-content-area').css('min-height', final_height);
     //    }
     //    else {
     //        alert('no-div');
     //        jQuery('body > div').removeClass('alert-present');
     //        jQuery('.main-content-area').css('min-height', final_height);
     //    }
  });
</script>
<style>
    .modal-login
    {
        min-height:500px;
    }
    .abcdef>li>a:hover
    {
        background-color:unset;
    }
    .abcdef{
        margin-top: 6px !important;
    }
    .alert-present .footer{
        margin-bottom: -60px;
    }
    .alert-present .alert-parent{
        margin-top: 20px;
    }

    .col
    {
      background: #f5f9fc !important;
    }

    #head-des{
      /*min-height: 474px !important;*/
      /* min-height: 758px !important; */

    border-width: 1px !important;
    border-top-style: solid !important;
    border-bottom-style: solid !important;
    min-height: calc(100vh - 150px) !important;
     /*display: grid;*/
     place-content: center;
    }
</style>

<style>

#europecountries, .europecountries{
    display:none;
}

.error{
    color: red !important;
}
.password_confirm-error{
    color: red !important;
}
/*#continent_error{
    position:relative;
    top:-14px;
}
#country_error{
    position:relative;
    top:-4px;
}*/
#cities, .cities
{
    display:none;
}
#locations, .locations
{
    display:none;
}
#states, .states
{
    display:none;
}
.form-group{
    position: relative;
    margin-bottom: 25px;
}

.form-group.cus-form-group{
    position: relative;
    margin-bottom: 25px;
}

.cont{
    padding: 0px !important;
}

.mb-10{
    margin-left: 7px !important;
}


#newmain .form-box input{
    /*margin-top: 29px !important;*/
    /*padding: 5px 34px !important;*/
    /*border: 1px solid black !important;*/
    /*border-radius: 1px !important;*/
    /*border-width: 1.4px !important;*/
    /*max-width: 72% !important;*/
}
#newmain .submit-btn{
    max-width: none important;
}

.ct-acct{
    background: white;
    /*box-shadow: 0 -1px 4px 0 rgba(99,114,130,0.15);*/
    /*border-top: 1px solid #808080a1;*/
    /*border-bottom: 1px solid #808080a1;*/
}

.cent{
    float: right !important;
}

/*.auto{
    width: auto !important;
}*/

.gri{
    display: grid;
    place-content: center;
    /*padding: 185px 0px;*/
    /*padding: 90px 0px;*/
    padding: 20px 0px;
}

.new_sub{
    margin-top: 27px !important;
    padding: 5px 38px !important;
    font-weight: bold;
}

.disabled {
    pointer-events:none; 
 
}


/*.form-box label {
    color: #000000a6 !important;
    font-weight: 700 !important;
}*/
</style>

<style type="text/css">
                    .cafe-submit {
                  width: 123px !important;
                  height: 39px !important;
                  border-radius: 6px !important;
                }

                .form-box select {
                    border-radius: 4px !important;
                    /*padding: 9px 10px !important;*/
                    padding: 7px 6px !important;
                    background: white !important;
                    margin-bottom: 6px !important;
                    border: 1px solid #0000003d !important;
                }

                .modal-login .modal-body{
                    padding: 23px !important;
                }

                .form-box select:hover {
                    border-bottom: 1px solid #0000003d !important;
                }

                .state-nav{
                    /*margin: 12px 20px 12px !important;*/
                    margin-top: 14px;
                    font-family: verdana;
                }

                .rel-t img{
                    width: 200px !important;
                }

                .look{
                    margin-bottom: 5px !important;
                }
                .strong{
                    font-size: 15px !important;
                    padding-left: 10px !important;
                }

                .form-control:active, .form-control:focus {
                    border-bottom: 1px solid #0000003d !important;
                }
                .form-control:hover{
                    border-bottom: 1px solid #0000003d !important;
                }

                .modal-header{
                    border-bottom: none !important;
                }

                .rel-f{
                    width: 341px !important;
                    /*margin: 33px auto !important;*/
                    margin: 34px 443px auto !important;
                }

                .rel-f label{
                    color: black !important;
                    font-size: 16px !important;
                    margin-bottom: 5px !important;
                }

                .mod{
                    box-shadow: none !important;
                    border-radius: 32px !important;
                }

                .rel{
                    margin-top: 48px !important;
                    margin-bottom: 51px!important;
                }

                .rel-mod{
                    padding-bottom: 0px !important;
                }

                .modal-login .modal-body{
                    padding-top: 0px !important;
                }

                .rel-head{
                    padding-bottom: 0px !important;
                }

                .city{
                    color: black !important;
                    /*font-weight: bold !important;*/
                }
                .nav-inner{
                    float: left;
                    margin: 0px -11px;
                    /*margin-top: 7px;*/
                    margin-top: 28px;
                }

                .top-rel{
                    padding: 33px 0 !important;
                }
    .modal-body p strong{color: red;}
</style>

<style>

#europecountries, .europecountries{
    display:none;
}

.error{
    color: red !important;
}
.password_confirm-error{
    color: red !important;
}
/*#continent_error{
    position:relative;
    top:-14px;
}
#country_error{
    position:relative;
    top:-4px;
}*/
#cities, .cities
{
    display:none;
}
#locations, .locations
{
    display:none;
}
#states, .states
{
    display:none;
}
.form-group{
    position: relative;
    margin-bottom: 25px;
}

.form-group.cus-form-group{
    position: relative;
    margin-bottom: 25px;
}

.cont{
    padding: 0px !important;
}

.mb-10{
    margin-left: 7px !important;
}


#newmain .form-box input{
    /*margin-top: 29px !important;*/
    /*padding: 5px 34px !important;*/
    /*border: 1px solid black !important;*/
    /*border-radius: 1px !important;*/
    /*border-width: 1.4px !important;*/
    /*max-width: 72% !important;*/
}
#newmain .submit-btn{
    max-width: none important;
}

.ct-acct{
    background: white;
    /*box-shadow: 0 -1px 4px 0 rgba(99,114,130,0.15);*/
    /*border-top: 1px solid #808080a1;*/
    /*border-bottom: 1px solid #808080a1;*/
}

.cent{
    float: right !important;
}

/*.auto{
    width: auto !important;
}*/

.gri{
    display: grid;
    place-content: center;
    /*padding: 185px 0px;*/
    /*padding: 90px 0px;*/
    padding: 20px 0px;
}

.new_sub{
    margin-top: 27px !important;
    padding: 5px 38px !important;
    font-weight: bold;
}

.disabled {
    pointer-events:none; 
 
}


/*.form-box label {
    color: #000000a6 !important;
    font-weight: 700 !important;
}*/
</style>
</head>

<body>
    
    <div class="container-fluid">
        <div class="@if( Request::path() == 'advance-search-result' ) container-fluid @else container @endif header-area">
             <div class="row">
                <?php /*@if( 
                  ( Request::path() != '/' || Auth::user() ) && 
                  ( Request::path() != 'login' ) 
                ) */?>
                  <div class="col-md-12 header-top">
                      <div class="row">

                          <?php /*@if( Request::path() != '/' &&  Request::path() != 'home')*/?>
                              <div class="col-lg-2 col-md-3 col-xs-12">
                                <?php //$ses = ''; ?>
                                @if(isset($ses) && empty(Session::get($ses)))
                                <a href="{{url('/')}}">
                                    <img src="{{ asset('public/img/logo.png') }}" style="float:left" class=" center-block logo-top">
                                </a>
                                @elseif(!empty($statename))
                                  <a href="{{url('/')}}">
                                    <img src="{{ asset('public/img/logo.png') }}" style="float:left" class=" center-block logo-top">
                                </a>
                                @elseif(!empty($state1))
                                  <a href="{{('/')}}">
                                    <img src="{{ asset('public/img/logo.png') }}" style="float:left" class=" center-block logo-top">
                                </a>
                                @else
                                  <a href="https://ifoundyou.com">
                                    <img src="{{ asset('public/img/logo.png') }}" style="float:left" class=" center-block logo-top">
                                </a>
                        
                                @endif
                              </div>
                          <?php /*@endif*/?>
                         <!--  @if(Request::path() == '/')
                             <img src="{{ asset('public/img/logo.png') }}" class="img-responsive center-block logo-top">
                          @endif -->

                         
                         <?php
                         if(!isset($id)){
                          $id = '';
                         }
                         ?>
                    
                      </div>
                  </div>

                  <div class="col-md-12">
                    <ul class="nav-inner mb-10">
                <li><a href="https://ifoundyou.com/">Home</a></li>
                <li class=""><a href="{{url('/')}}">State List</a></li>
                <li class=""><a href="{{url('/:').@$sesion['state']}}">{{@$sesion['state']}}</a></li>
                <li class=""><a href="{{url('/:').@$sesion['state']}}">{{@$sesion['city']}}</a></li>
                <li class=""><a href="{{url('/').'/'.@$sesion['state'].'/'.@$sesion['city']}}">Type of Relationship</a></li>
                <li class=""><a href="{{url('/_').@$sesion['state'].'/'.@$sesion['city']}}">@if(!empty(@$sesion['day'])) {{@$sesion['day']}} @else {{@$day}} @endif @if(!empty(@$sesion['month'])) -{{@$sesion['month']}} @else -{{@$month}} @endif @if(!empty(@$sesion['year'])) -{{@$sesion['year']}} @else -{{@$year}} @endif </a></li>
                <li class="active disabled"><a href="">User Name</a></li>

                <!-- <li><a href="{{ url('/user/user-profile') }}">My Profile</a></li> -->
                <!-- <li class="active"><a href="">Account</a></li>
                <li class="disabled"><a  href="{{url('/country')}}">Country</a></li>
                <li class="disabled"><a  href="{{url('/country')}}">Cafe</a></li> -->

            </ul>


         <ul class="nav navbar-nav navbar-right abcdef">
                           
                              @if( Request::url() == 'https://ifoundyoucanada.com')
                              <li><a href="{{url('/login')}}"  id="signin">Sign in</a></li>
                              @else
                                 <!-- <li><a href="{{ url('/login?id='.app('request')->input('id') ) }}" id="signin1">ifoundyou Sign In</a></li> -->
                              @endif
                              @if(!empty($statename))
                              <li><a href="{{url('/login')}}"  id="signin">Sign in</a></li>
                                @endif

                               
                          
                         </ul>
                  </div>
                <?php /*@endif */?>
             </div>
         </div>
         <div id="head-des" class="  row main-content-area maa @if( Request::path() == 'advance-search-result' ) bg-main-content mr--15 @endif   @if( Request::path() == 'login')  col  @endif " >
            <main class="py-4">

<?php
    if(isset($_GET['user']) && isset($_GET['page'])){
        $id = $_GET['user']; 
        $info = DB::table('user_temp_about_me')->where('id',$id)->first();
    }else{
        $info = [];
    }
?>
<div class="container-fluid pd-none bod">
    <div class="wrapper-cl ct-acct">
        <div class="container cont">
            
            <div class="row">
                <form  action="{{ url('/registeration') }}" method="post" class="form-box" id="accountform" >
                <div class="col-md-12 gri">
                    
                        @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                            <strong>Success ! </strong>
                            <span>{{ session('success') }}</span>
                        </div>
                        @endif
                        <div class="ct-form" id="newmain">
                            <?php //print_r(@$sesion); ?>

                            <?php //print_r(@$sesio); ?>                            

                               
                            
                                <div class="col-md-5 col-sm-6 col-xs-12">
                                @csrf
                                {{--<h2>Sign up</h2>--}}
                                <!-- <input type="hidden" name="country" value="{{$country}}"> -->
                                <input type="hidden" name="city" value="{{@$sesion['city']}}">
                                <input type="hidden" name="state_code" value="{{@$sesion['state_code']}}">
                                <input type="hidden" name="state" value="{{@$sesion['state']}}">
                                
                                <input type="hidden" name="continent" value="{{@$sesion['continent']}}">
                                <input type="hidden" name="interested_in" value="{{@$sesion['interested_in']}}">
                                <input type="hidden" name="cafe" value="@if(!empty(@$sesion['cafe'])){{@$sesion['cafe']}} @else {{@$cafe}} @endif">
                                <input type="hidden" name="day" value="@if(!empty(@$sesion['day'])){{@$sesion['day']}} @else {{@$day}} @endif ">
                                <input type="hidden" name="month" value="@if(!empty(@$sesion['month'])){{@$sesion['month']}} @else {{@$month}} @endif">
                                <input type="hidden" name="year" value="@if(!empty(@$sesion['year'])){{@$sesion['year']}} @else {{@$year}} @endif">


                                <input type="hidden" name="param" value="{{ app('request')->input('id') }}">
                                
                                <div class="form-group bd-block">
                                    
                                </div>
                                
                                <!-- <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="" id="name" value="<?php if(isset($info->name)){ ?>  {{$info->name}} <?php } ?>">
                                    <span class="red-span-error" id="name_error">
                                        <strong>@if ($errors->has('name')) {{ $errors->first('name') }} @endif</strong>
                                    </span>
                                    <span class="blue-span">Please enter valid email</span>
                                </div> -->
                                <!-- <div class="form-group">
                                    <label>Email address</label>
                                    <input type="email" class="form-control" name="email" placeholder="" id="email" value="<?php if(isset($info->email)){ ?>  {{$info->email}} <?php } ?>">
                                    <span class="red-span-error" id="email_error">
                                        <strong>@if ($errors->has('email')) {{ $errors->first('email') }} @endif</strong>
                                    </span>
                                    <span class="blue-span">Please enter valid email</span>
                                </div> -->
                                <!-- <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" placeholder="" class="form-control" id="password" value="<?php if(isset($info->password)){ ?>  {{$info->password}} <?php } ?>">
                                    <span class="red-span-error" id="pass_error">
                                        <strong>
                                            @if ($errors->has('password'))
                                            {{ $errors->first('password') }}
                                            @endif
                                        </strong>
                                    </span>
                                    <span class="blue-span">Please enter your password</span>   
                                </div> -->

                                <!-- <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input type="password" name="password_confirm" id="password_confirm" class="form-control" placeholder="" value="">
                                    <span class="red-span-error" id="pass_error"> -->
                                        <!-- <strong>
                                            @if ($errors->has('password'))
                                            {{ $errors->first('password') }}
                                            @endif
                                        </strong> -->
                                    <!-- </span> -->
                                    <!-- <span class="blue-span">Please enter your password</span> -->
                                <!-- </div> -->


                                <!-- <div class="form-group">
                                    <label>Phone Number</label>
                                    <input type="text" value="" name="phone" class="form-control" placeholder=""> -->
                                    <!-- <span class="red-span-error" id="pass_error"> -->
                                        <!-- <strong>
                                            @if ($errors->has('password'))
                                            {{ $errors->first('password') }}
                                            @endif
                                        </strong> -->
                                    <!-- </span> -->
                                    <!-- <span class="blue-span">Please enter your password</span> -->
                                <!-- </div> -->

                                <!-- <div class="row">
                            
                            
                        </div> -->
                        
                        <!-- <span class="red-span-error" id="birth_error">
                                        <strong>
                                            @if ($errors->has('month') || $errors->has('day') || $errors->has('year'))
                                            Please enter your birth date
                                            @endif
                                        </strong>
                                    </span> -->
                                    

                        
                                <!-- <div class="form-group text-center cus-form-group">
                                    <input class="submit-btn" type="submit" name="" id="sign_up_button" value="Submit">
                                </div> -->
                                
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12 ">
                               

                            <div class="form-group">
                                    <label>User Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="" id="name" value="<?php if(isset($info->name)){ ?>  {{$info->name}} <?php } ?>">
                                    <span class="red-span-error" id="name_error">
                                        <strong>@if ($errors->has('name')) {{ $errors->first('name') }} @endif</strong>
                                    </span>
                                    <!-- <span class="blue-span">Please enter valid email</span> -->
                                </div>
                           

                            
                            
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group text-center cus-form-group cent">
                                    <div class="next">
                                        <input class="submit-btn new_sub search" type="submit" name="" id="sign_up_button3" value="Next" style="margin-top: 0px !important;">
                                    </div>
                                </div>

                            </div>

                            
                    </div>
                    <!-- <div class="col-md-6 col-sm-6 col-xs-12 pull-right">
                        <img src="{{ asset('public/img/create-account-ifoundyou.jpg') }}" alt="Reinventing Matchmaking" class="img-responsive">
                        {{--<div class="left-block">
                            <h1>Reinventing Matchmaking</h1>
                            <p>A simpler easier way to meet new people</p>
                        </div>--}}
                    </div> -->
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

</main>
        </div>

         @if(Request::path() == '/')
         <style>
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
         {{--<div id ="cookie" class="alert-parent alert alert-dismissible">
            <div  style="color:#7b8994" class="alert-inner">
                <!-- <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> -->
                 This site uses cookies. By continuing to browse the site you are agreeing to our use of cookies.
                   <button><a href="#"  data-dismiss="alert" aria-label="close">Yes</a></button>
                   <button><a href="https://www.google.com">No</a></button>
               </div>
          </div>--}}
        @endif
    </div>

  <!-- <div class="row"> -->
         @if(Request::path() == 'login')
          <div class=" footer search-footer foot new" >
              <div class="col-md-12"> 
                  <ul>
                      <li><a href="{{ url('/about') }}">About Us</a></li>
                      <li><a href="{{ url('/terms') }}">Terms of Service</a></li>
                      <li><a href="{{ url('/privacy') }}">Privacy</a></li>
                      <li><a href="{{ url('/safety') }}">Safety</a></li>
                      <!-- <li>{{ App::VERSION() }}</li> -->
                  </ul>
              </div>
          </div>

          @else
             <div class=" footer search-footer foot new">
              <div class="col-md-12"> 
                  <ul>
                      <li><a href="{{ url('/about') }}">About Us</a></li>
                      <li><a href="{{ url('/terms') }}">Terms of Service</a></li>
                      <li><a href="{{ url('/privacy') }}">Privacy</a></li>
                      <li><a href="{{ url('/safety') }}">Safety</a></li>
                      <!-- <li>{{ App::VERSION() }}</li> -->
                  </ul>
              </div>
          </div>
          <!-- </div> -->
        @endif
    <script type='text/javascript' src='https://service.force.com/embeddedservice/5.0/esw.min.js'></script>

</body>
</html>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('.search').click(function(e){
            var day = $('#day').find(":selected").val();
            var month = $('#month').find(":selected").val();
            var year = $('#year').find(":selected").val();
            // alert(day);
            // alert(month);
            // alert(year);
            if(day == '' || month == '' || year == ''){
                e.preventDefault();
               // jQuery('.search').attr('disabled', true);
            }else{
                jQuery('.search').attr('disabled', false);
            }
            alert(states);
        })
    })
</script>

<script type="text/javascript">
    jQuery(document).ready(function(){
        $.ajax( {
            
            url: "{{ url('/registercountries') }}",
            method: 'GET',
            success: function(registercountries){
            if(registercountries){
                $('#registercountries').html(registercountries);
            }
        }
    })
})
</script>

<script type="text/javascript">
    jQuery(document).ready(function(){

        // unique user check start
        $('#email').blur(function() {
            var emailId = $(this).val();
            $('#email_error strong').html('');
            $('#sign_up_button3').attr('disabled', false);
            
            $.ajax({
                url:  "{{ url('/check-unique-user') }}",
                method: 'GET',
                data : {'email': emailId},
                success: function( response ) {
                    if( response > 0 ) {
                        $('#email_error strong').html('Email Already Taken.');
                        $('#sign_up_button3').attr('disabled', true);
                    }
                }
            });
        });
        // unique user check end

        $('#registercountries').change(function(){

            var value = $(this).val();

            $('#zip_code').val('');
            $('.usa_zipcode').hide();
            $('.custom_interested_in').hide();
            if(value == 'USA')
            {
                $('.usa_zipcode').show();
                $('.custom_interested_in').show();
            }

            if(value == 'Europe')
            {
                $.ajax ( {

                    url:  "{{ url('/europecountries') }}",
                    method: 'GET',
                        success: function(europecountries){
                        if(europecountries){
                            $('#europecountries').html(europecountries);
                            $('#country_error').show();
                            $('#europecountries').show();
                            $('.europecountries').show();
                            $('#continent_error strong').text('');
                            $('#cities').css('display','block');
                            $('#locations').css('display','block');

                            $('.cities').show();
                            $('.locations').show();
                        }
                    }
                })

                $('.custom_interested_in').show();
            }
            else
            {
                $('#europecountries').hide();
                $('.europecountries').hide();
                $('#europecountries').html('<option value="">Select Country</option>');
                $('#country_error').hide();
            }

        })
        
    })
</script>   

<script type="text/javascript">
    jQuery(document).ready(function(){
        var value = localStorage.getItem('continent');
        var value1 = localStorage.getItem('country_name');
        if(value == 'Europe'){
            $.ajax ( {

                    url:  "{{ url('/europecountries') }}",
                    method: 'GET',
                    data: {'country_name':value1},
                        success: function(europecountries){
                        if(europecountries){
                            $('#europecountries').html(europecountries);
                            $('#europecountries').show();
                            $('.europecountries').show();
                        }

                    }
                })
        }
        

    })
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#registercountries').change(function(){
            var value = $(this).val();
            var value1 = $('#europecountries').val();
            if(value == 'England' || value == 'Canada')
            {
                $.ajax ( {

                    url:  "{{ url('/getcities') }}",
                    method: 'GET',
                    data : {'continent':value,'country':value1},
                        success: function(getcities){
                        if(getcities){
                            $('#cities').html(getcities);
                            $('#cities').css('display','block');
                            $('#locations').css('display','block');
                            $('#locations').html('<option value="">Choose Cafe Location</option>');
                            $('#states').html('');
                            $('#states').css('display','none');
                            $('#states').html('<option value="">Select State:</option>');

                            $('.cities').show();
                            $('.locations').show();
                            $('.states').hide();
                        }
                    }
                })

                $('.custom_interested_in').show();
            }
        })
    })
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#europecountries').change(function(){
            var value = $(this).val();
            var value1 = $('#registercountries').val();
            {
                $.ajax ( {

                    url:  "{{ url('/getcities') }}",
                    method: 'GET',
                    data : {'continent':value1,'country':value},
                        success: function(getcities){
                        if(getcities){
                            $('#cities').html(getcities);
                            $('.cities').show();
                        }
                    }
                })
            }
        })
    })
</script>


<script type="text/javascript">
$(document).ready(function(){
    $('#cities').change(function()
    {
        var value = $(this).val();
        var value1 = $('#registercountries').val();
        var value2 = $('#europecountries').val();
        var location_count = $('#location_count').val();

        if( value1 != 'USA' || (value1 == 'USA' && location_count == 0) )
        {
            $.ajax ( {
                url:  "{{ url('/getlocations') }}",
                method: 'GET',
                data : {'city':value,'continent':value1,'country':value2,'location_count':location_count},
                success: function(getlocations) {
                    if(getlocations) {
                        $('#locations').html(getlocations);
                        $('.locations').show();
                    }
                }
            });
        }
    });

    $('#zip_code').keyup(function()
    {
        var value = $(this).val();
        var value1 = $('#registercountries').val();

        if( value != '' && value.length >= 4)
        {
            $.ajax ( {
                url:  "{{ url('/getlocations') }}",
                method: 'GET',
                data : {'zip_code':value,'continent':value1},
                success: function(getlocations) {
                    if(getlocations) {
                        var loc = getlocations.split(":::");
                        if( loc[0] == 0 )
                        {
                            $('#locations').html(loc[1]);
                            $('#location_count').val(0);
                        }
                        else
                        {
                            $('#locations').html(getlocations);
                            $('#location_count').val(1);
                        }
                        $('.locations').show();
                    }
                }
            });

            $.ajax ( {
                url:  "{{ url('/usastates') }}",
                method: 'GET',
                data : {'zip_code':value},
                success: function(usastates)
                {
                    if(usastates)
                    {
                        $('.states').show();
                        //$('.cities').show();
                        //$('.locations').show();

                        $('#states').html(usastates);
                        $('#states').css('display','block');
                        //$('#cities').css('display','block');
                        //$('#locations').css('display','block');
                        //$('#cities').html('<option value="">Select City</option>');
                        //$('#locations').html('<option value="">Choose Cafe Location:</option>');
                    }
                }
            });

            $.ajax ( {
                url:  "{{ url('/usacities') }}",
                method: 'GET',
                data : {'zip_code':value},
                success: function(usacities)
                {
                    if(usacities)
                    {
                        $('#cities').html(usacities);
                        $('.cities').show();
                    }
                }
            });
        }
        else
        {
            $('#locations').html('<option value="">Choose Cafe Location</option>');
        }
    });
});
</script>


<script type="text/javascript">
    $(document).ready(function(){
        $('#registercountries').change(function(){
            var value = $(this).val();
            if(value == 'USA')
            {
                $.ajax ( {

                    url:  "{{ url('/usastates') }}",
                    method: 'GET',
                        success: function(usastates){
                        if(usastates){
                            $('.states').show();
                            $('.cities').show();
                            $('.locations').show();

                            $('#states').html(usastates);
                            $('#states').css('display','block');
                            $('#cities').css('display','block');
                            $('#locations').css('display','block');
                            $('#cities').html('<option value="">Select City</option>');
                            $('#locations').html('<option value="">Choose Cafe Location</option>');
                        }
                    }
                })
            }
        })
    })
</script>


<script type="text/javascript">
    $(document).ready(function(){
        $('#states').change(function(){
            var value = $(this).val();
            
            $.ajax ( {

                url:  "{{ url('/usacities') }}",
                method: 'GET',
                data : {'state_code':value},
                    success: function(usacities){
                    if(usacities){
                        $('#cities').html(usacities);
                        $('.cities').show();
                    }
                }
            })
            
        })
    })
</script>


<script type="text/javascript">
    $(document).ready(function(){
        $('#registercountries').change(function(){
            var value = $(this).val();
            if(value == 'Europe')
            {
                $('#cities').html('<option value="">Select City</option>');
                $('#locations').html('<option value="">Choose Cafe Location</option>');
                $('#states').css('display','none');
                $('.states').hide();
            }
        })
    })
</script>
<script type="text/javascript">
jQuery(document).ready(function(){

    jQuery("#accountform").validate({
    
        rules: {
              name:{
               required:true
            },
          email: {
            required: true,
            email: true
          },
          phone : {
            number: true,
            required: true,
          },
          // month : {
          //    required : true,
          // },
          // month :{
          //    required: true,
          // },
          password: {
            required: true,
            minlength: 5,
          },
          password_confirm: {
                minlength : 5,
                equalTo: "#password"
           },
        },
        messages: {
          name: "Please enter your Full name",
          email: "Please enter a valid email address",
          phone : " Phone Number is required",
          // month : "Date Of Birth is Required",
          password: {
            required: "Please provide a password",
            minlength: "Your password must be at least 5 characters long",
            password_confirm: " Enter Confirm Password Same as Password"
          },
        }
    });

    // $('#month').click(function(){
    //  var month = jQuery('#month').val();
    //  var day = jQuery('#day').val();
    //  var year = jQuery('#year').val();
    //  if(month == '' || day == '' || year == '') {
    //      jQuery('#birth_error strong').text('Please Enter Your Birthdate');
    //      $('#sign_up_button3').attr('disabled', true);
    //  } else {
    //      jQuery('#birth_error strong').text('');
    //      $('#sign_up_button3').attr('disabled', false);
    //  }
    // });
});
</script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('.search').click(function(e){
            var day = $('#day').find(":selected").val();
            var month = $('#month').find(":selected").val();
            var year = $('#year').find(":selected").val();
            // alert(day);
            // alert(month);
            // alert(year);
            if(day == '' || month == '' || year == ''){
                e.preventDefault();
               // jQuery('.search').attr('disabled', true);
            }else{
                jQuery('.search').attr('disabled', false);
            }
            // alert(states);
        })
    })
</script>



 







<script type="text/javascript">
jQuery(document).ready(function(){

    jQuery("#accountform").validate({
    
        rules: {
              name:{
               required:true
            },
          email: {
            required: true,
            email: true
          },
          phone : {
            number: true,
            required: true,
          },
          // month : {
          //    required : true,
          // },
          // month :{
          //    required: true,
          // },
          password: {
            required: true,
            minlength: 5,
          },
          password_confirm: {
                minlength : 5,
                equalTo: "#password"
           },
        },
        messages: {
          name: "Please enter your User Name",
          email: "Please enter a valid email address",
          phone : " Phone Number is required",
          // month : "Date Of Birth is Required",
          password: {
            required: "Please provide a password",
            minlength: "Your password must be at least 5 characters long",
            password_confirm: " Enter Confirm Password Same as Password"
          },
        }
    });

    // $('#month').click(function(){
    //  var month = jQuery('#month').val();
    //  var day = jQuery('#day').val();
    //  var year = jQuery('#year').val();
    //  if(month == '' || day == '' || year == '') {
    //      jQuery('#birth_error strong').text('Please Enter Your Birthdate');
    //      $('#sign_up_button3').attr('disabled', true);
    //  } else {
    //      jQuery('#birth_error strong').text('');
    //      $('#sign_up_button3').attr('disabled', false);
    //  }
    // });
});
</script>
