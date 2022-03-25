@extends('layouts.app')

@section('content')
<style type="text/css">
    main .container {min-height: auto;}
    .ct-acct
    {
        /*background: #fff;*/
        /*border-top: 1px solid #808080a1;*/
    /*border-bottom: 1px solid #808080a1;*/
        background: #f5f9fc;
     }
     .form-box label{

     }
     .modal-login {
        /*min-height: 350px !important;*/
        min-height: auto !important;
     }
    .modal-login .modal-dialog{margin-top: 20px;}
    .modal-content{box-shadow: none !important;border-radius: 32px;height: 327px !important;
    max-width: 373px !important;
    margin: auto !important;}
    .modal-login .modal-dialog{width: 600px;}
    .modal-header{border-bottom: none;padding-bottom: 0;padding-top: 15px;}
    .modal-login .modal-title img{    max-width: 209px;width: 300px;}
    .modal-login .modal-title::after{border-top: 1px solid #000;}
    .modal-login .modal-body .form-group{color: rgb(25, 39, 240);}
    .modal-login .modal-body .form-group a{color: rgb(25, 39, 240);}
    .modal-login .modal-body{margin: 0 5%;padding-top: 15px;}
    .modal-dialog { font-family: verdana; }
    .custom_line {border-top: 1px solid rgba(0,0,0,.2);float: left;position: absolute;width: 300px;top: 40px;margin-left: 50px;}
    .list-inline{ margin-top: 51px; }
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
    .modal-login{
        padding-top: 15px !important;
        padding-left: 24px !important;
        padding-right: 24px !important;
        margin: 0px !important;
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

    .error{
        color: #DD2C00 !important;
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

                .cafe-submit {
                  width: 123px !important;
                  height: 39px !important;
                  border-radius: 23px !important;
                }

                .form-box select {
                    border-radius: 4px !important;
                    padding: 9px 10px !important;
                    background: white !important;
                    margin-bottom: 6px !important;
                    border: 1px solid #0000003d !important;
                }

                .form-box select:hover {
                    border-bottom: 1px solid #0000003d !important;
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

                /*.pd{
                    border-top: 1px solid #0000005c;
                }*/


    .modal-body p strong{color: red;}
</style>

<div class="container-fluid pd-none pd">
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
                            <!-- <a href=""> -->
                                <h4 class="modal-title" id="myModalLabel">
                                    <img src="{{ asset('public/img/logo.png') }}">
                                </h4>
                            <!-- </a> -->
                        </div>
                        <div class="modal-body">
                            <!-- @if ($errors->has('email'))
                            <p class="red-span-error">
                                <p><strong>{{ $errors->first('email') }}</strong>
                                </p>
                            @endif
                            @if ($errors->has('password'))
                            <p class="red-span-error">
                                <strong>{{ $errors->first('password') }}</strong>
                            </p>
                            @endif -->
                            <form method="get" id="search-form1" action="">
                             
                                @csrf
                                <div class="form-group">
                                    <div class="log-form">
                                        <div class="form-group">
                                            <!-- <input type="hidden" name="user_loginID" value="{{app('request')->input('id')}}">
                                            <input type="email" name="email" class="form-control" placeholder="Email" id="login-email" value="{{ session('email') }}"> -->
                                            <!-- <label class="look"><strong class="strong">I am interested in dating?</strong></label> -->
                                           <!--  <select class="form-control" name="adv_search_interested_in" id="adv_search_interested_in">
                                                <option value="">Who are you interested in?</option>
                                                 <option value="I am a man seeking a women">I am a man seeking a women</option>
                                                 <option value="I am a women seeking a man">I am a women seeking a man</option>
                                                 <option value="I am a man seeking a man">I am a man seeking a man</option>
                                                 <option value="I am a women seeking a women">I am a women seeking a women</option>
                                            </select>

                                               <span class="red-span-error" id="birth_error">
                                                <strong>
                                                    @if ($errors->has('month') || $errors->has('day') || $errors->has('year'))
                                                    Please enter your birth date
                                                    @endif
                                                </strong>
                                    </span> -->
                                            
                                            <!-- <label class="email-label-helper" for="login-email">Email</label> -->
                                            <span class="red-span-error" id="email_error"></span>
                                        </div>
                                        <!-- <div class="form-group"> -->

                                            <!-- <label><strong>Country</strong></label> -->
                                            <!-- <div class="form-group">
                                          <input type="text" name="adv_search_zipcode" id="adv_search_zipcode" class="form-control" placeholder="zip code" value="{{ @$parameters['adv_search_zipcode'] }}" style="font-weight: bolder; border: 1px solid #00000045;">
                                       </div> -->
                                            <!-- <label class="look"><strong class="strong">Country</strong></label> -->
                                            <label style="margin-bottom: 10px !important;"><strong style="color: #000000c2;">Country</strong></label>

                                        <select class="form-control" name="adv_search_country" id="registercountries">
                                            <option value="">Choose One</option>
                                            <option value="Canada">Canada</option>
                                            <option value="England">England</option>
                                            <option value="Europe">Europe</option>
                                            <option value="USA">United States</option>
                                           <!-- <option value="">Choose One</option> -->
                                            <!-- @php
                                                $RS_Countries = DB::table('country')->select('*')->where('continent', null)->get();
                                            @endphp

                                            @forelse( $RS_Countries as $RS_Country )
                                                <option value="{{ $RS_Country->country_name }}">{{ $RS_Country->country_name }}</option>
                                            @empty
                                            @endforelse -->
                                        </select>

                                        <span class="red-span-error" id="country">
                                                <strong>
                                                    @if ($errors->has('country') || $errors->has('day') || $errors->has('year'))
                                                    Please enter your birth date
                                                    @endif
                                                </strong>
                                    </span>
                                    
                                           <!--  <input type="password" name="password" class="form-control" placeholder="Password" id="login-password">
                                            <label class="password-label-helper" for="login-password">Password</label>
                                            <span class="red-span-error" id="pass_error"></span> -->
                                        <!-- </div> -->
                                        <div class="form-group text-center" style="margin-top: 19px;">
                                            <ul class="list-unstyled list-inline">
                                                <li><button type="button" class="btn cafe-submit search">Submit</button></li>
                                            </ul>  
                                        </div>

                                       <!--  <div class="form-group d-flex d-flex-center mt-35">
                                            <a href="{{ url('/register?id='.app('request')->input('id') ) }}">Join for Free</a>
                                        </div> -->

                                        <!-- <div class="custom_loing_link form-group d-flex d-flex-center">
                                            <a href="#" id="forget-password">Forgot Email</a> | 
                                            <a href="{{ url('/forgot') }}" id="forget-password">Forgot Password</a> | 
                                            <a href="#" id="forget-password">Help</a>
                                        </div> -->

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

<script type="text/javascript">
    jQuery(document).ready(function(){
        $('.cafe-submit').on('click', function(){
            var val = $("#registercountries option:selected").val();
            // var val1 = $("#adv_search_interested_in option:selected").val();
            if(val  == ''){
               // jQuery('#birth_error strong').text('This Field is Required');
               // jQuery('#country strong').text('Country Field is Required');
            }

            else{

                window.location.href =  "{{url('')}}"+'/account?country='+val + '&id=';

                // window.location.href = "{{url('/country=')}}"+val + val1;

            //     $.ajax ( {
            //     url:  "{{ url('/country') }}",
            //     method: 'GET',
            //     data : {'val':val1 , 'val2' : val2},
            //         success: function(result){

            //     }
            // })
            }
        });

        // $("#search-form").validate({
        //   rules: {
        //     adv_search_zipcode: {
        //       required: true,
        //       digits: true, 
        //     },
        //   },
        // });
    });
</script>


<script type="text/javascript">
jQuery(document).ready(function(){

    jQuery("#search").validate({
    
        rules: {
              adv_search_interested_in:{
               required:true,
            },
          adv_search_country: {
            required: true,
            
          },
        },
        messages: {
          adv_search_interested_in: "Please Fill in this field.",
          adv_search_country: "Country Field is Required",
        }
    });
});
</script>

<!-- <script type="text/javascript">
    jQuery(document).ready(function(){

    });
</script> -->
@endsection
