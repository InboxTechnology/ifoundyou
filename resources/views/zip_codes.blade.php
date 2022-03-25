@extends('layouts.app')

@section('content')

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
                    margin: 33px auto !important;
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
    .modal-body p strong{color: red;}
</style>
<!-- <style>
.wrapper-cl
{
    margin-bottom:400px;
    min-height:unset;
    padding-bottom:unset;
}
</style> -->
<div class="container">
    <div class="row">
<div class="col-md-12 col-sm-12 col-xs-12 hei">
    <div class="container-fluid pd-none">
    <div class="ct-acct">

        <div class="modal-login">
            <div class="modal-dialog form-box ct-form rel-f">
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
                    <div class="modal-content mod rel-mod">
                        <div class="modal-header rel-head">
                            {{-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> --}}
                            <!-- <a href=""> -->
                                <h4 class="modal-title rel-t" id="myModalLabel">
                                    <img src="{{ asset('public/img/logo.png') }}">
                                </h4>
                            <!-- </a> -->
                        </div>
                        <div class="modal-body rel-bod">
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

                

                                <?php ///print_r($all); ?>
                            
                                
                                    <form method="post" action="{{url('/cafe')}}" >
                                                                        @csrf
                                        
                                        <input type="hidden" name="continent" value="USA">
                                        <input type="hidden" name="city" value="{{$all['city']}}">
                                        <input type="hidden" name="state" value="{{$statename}}">
                                        <input type="hidden" name="state_code" value="{{$all['state_code']}}">
                                        <input type="hidden" name="continent" value="{{$all['continent']}}">
                                        <input type="hidden" name="interested_in" value="{{$rel}}">
                                        <div class="form-group cus-form-group states rel">
                                                            <label>Zip Codes</label>
                                                            <select style="width:100%;" class="form-control" name="zip_code" id="zip_code">
                                                            <option value="">Choose One</option>
                                                             @foreach($zip_code as $value)
                                                                <option>{{$value->zip_code}}</option>
                                                             @endforeach
                                                            </select>
                                                            <span class="red-span-error" id="state_error">
                                                                <strong>@if ($errors->has('state')) {{ $errors->first('state') }} @endif</strong>
                                                            </span>
                                        </div>
                                        <div class="form-group text-center" style="margin-top: 18px;">
                                                <ul class="list-unstyled list-inline">
                                                    <li><button type="submit" class="btn cafe-submit search">Submit</button></li>
                                                </ul>  
                                        </div>
                                    </form>
                        <br>
                        <div class="col-md-12 tl-account pd-none center" style="padding-left: 187px;">
                            <!-- <div style="text-align: center;"> -->
                        <!--    <input type="submit" style="float:left;position:relative;" value="Submit" class="btn cafe-submit" > -->
                        <!-- </div> -->
                        </div>
                        
                        <hr style="border:1px solid #ccc;width:100%;margin-bottom:20px;display: inline-block;display: none;">
                    </div>
                </div>

                
                
            

                            
                        </div>
                        {{--<div class="modal-footer">

                        </div>--}}
                    </div>
        </div>
    </div>
</div>

    
</div>
</div>
</div>

<style type="text/css">
    .error{
        color: red;
    }
    .hei{
        height: 0px !important;
    }
</style>

<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('.search').click(function(e){
            var zip_code = $('#zip_code').find(":selected").val();
            if(zip_code == ''){
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
              zip_code:{
               required:true,
            },
        },
        messages: {
          zip_code: "Zip Code is required",
        }
    });
});
</script>   

<script type="text/javascript">
$(document).ready(function(){
    console.log('1');
    $("#all_location").validate({
        rules: {
              state:{
               required:true
            },
          cityname: {
            required: true
            
          },
          zip_code: {
            required: true
            
          },
        },
        messages: {
          state: "State Field is Required",
          cityname: "City Field is Required",
          zip_code: "Zip Code is Required",
        }
    });
});
</script>


@endsection
