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

                .state ul{
                	list-style: none;
                }

                .state ul li{
                	padding-bottom: 10px;
				    color: black !important;
				   font-size: 15.3px;
                }
                .state ul li a{
                	color: black;
                	text-decoration: none;
                }
                .state h4{
                	font-size: 21px;
				    padding: 0px !important;
				    margin: 0px !important;
    				/*margin-left: 14px !important;*/
    				/*margin-bottom: 47px !important;*/
    				margin-bottom: 18px !important;
				    color: black !important;
                }

                .state hr{
                	border-top: 2px solid #00000026 !important;
                	padding: 0px !important;
                }

                .state{
                	padding-left: 0px !important;
                }

                .modal-login .modal-body{
                	padding: 23px !important;
                }

                .mar{
                	margin: 7px auto !important;
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

                .back{
                	background: white !important;
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

                .hr{
                	padding:0px !important;
                }

                .state-nav{
                	/*margin: 12px 20px 12px !important;*/
                	padding-left: 0px !important;
                	margin-top: 14px;
                	font-family: verdana;
                }

                .h1 hr{
                	border-top: 2px solid #00000026 !important;
                	margin-top: -8px !important;
                }

                .alba{
                	padding-left: 0px !important;
                }

                .li-cont{
                	 border-top-color: #E0E0E0;
    border-width: 2px !important;
    opacity: 33;
    /* min-height: 474px !important; */
    /* min-height: 758px !important; */
    border-width: 1.5px !important;
    border-top-style: solid !important;
    /*border-bottom-style: solid !important;*/
                	min-height: 532px !important;
                }

                .do-hr{
                	margin-top: 0px !important;
                	padding: 0px !important;
                }

                /*.mode{
                	min-height: none;
                }
*/
                .mod{
                	box-shadow: none !important;
                	border-radius: 32px !important;
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
<main class="py-4 back">
<div class="container li-cont">
	<div class="row">
<div class="col-md-12 col-sm-12 col-xs-12 hei state-nav">

	<!-- <ul class="nav-inner">
		<li><a href="{{ url('https://ifoundyou.com') }}">Home</a></li>
		<li class=""><a href="{{url('/')}}">State List</a></li>
		<li class="active"><a href="">{{$statename}}</a></li> -->
		<!-- <li class="active"><a href="{{url('/country')}}">Country</a></li> -->
		<!-- <li><a href="{{url('/user/cafe-location')}}">Cafe Location</a></li> -->
	<!-- </ul> -->


	<div class="container-fluid pd-none">
    <div class="ct-acct  vg">

        <div class="modal-log mode">
            <div class="modal-dialog form-box ct-form mar">
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
                    <!-- <div class="modal-content mod"> -->
                        <!-- <div class="modal-header">
                            
                           
                                <h4 class="modal-title" id="myModalLabel">
                                    <img src="{{ asset('public/img/logo.png') }}">
                                </h4>
                            
                        </div> -->
                        <!-- <div class="modal-body"> -->
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
								@csrf
				

								<?php //print_r($data); ?>
						 	
                          			<form method="post" action="" id="all_location">
										<div class="form-group" style="display: none;">
											<label>Select Country</label>
											<select style="width:100%;" name = "continent" id="registercountries" class="form-control">
												
													<option value="USA">USA</option>
												
											</select>
											<span class="red-span-error" id="continent_error">
												<strong>@if ($errors->has('continent')) {{ $errors->first('continent') }} @endif</strong>
											</span>
										</div>

					
									
										
                                    </form>
							<br>
							
							<hr style="border:1px solid #ccc;width:100%;margin-bottom:20px;display: inline-block;display: none;">
						
						 	
				

                        </div>
                        {{--<div class="modal-footer">

                        </div>--}}

                        @if($statename == 'Alaska')
                        	 <div class="col-md-12 state">
                        	<h4>{{$statename}} Cities</h4>
                        	<div class="col-md-12 hr">
                        		<!-- <hr> -->
                        	</div>
	                        <div class="col-md-2 alba">
					        	<ul id="ala" class="list-group">
					        		@foreach($us_cities as $key => $value)
					        			@if($key < 7)
					        				<li>
			                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
			                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
			                         			</a>
		                         			</li>
					        			@endif
					        		@endforeach
					        	</ul>
					        </div>
					        <div class="col-md-2 alba">
					        	<ul id="ala" class="list-group">
					        		@foreach($us_cities as $key => $value)
					        			@if($key > 6 && $key < 16)
					        				<li>
			                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
			                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
			                         			</a>
		                         			</li>
					        			@endif
					        		@endforeach
					        	</ul>
					        </div>

					        <div class="col-md-2">
					        	<ul id="ala" class="list-group">
					        		@foreach($us_cities as $key => $value)
					        			@if($key > 19 && $key < 30)
					        				<li>
			                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
			                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
			                         			</a>
		                         			</li>
					        			@endif
					        		@endforeach
					        	</ul>
					        </div>

					        <div class="col-md-2">
					        	<ul id="ala" class="list-group">
					        		@foreach($us_cities as $key => $value)
					        			@if($key > 30 && $key < 41 )
					        				<li>
			                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
			                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
			                         			</a>
		                         			</li>
					        			@endif
					        		@endforeach
					        	</ul>
					        </div>

					        <div class="col-md-2">
					        	<ul id="ala" class="list-group">
					        		@foreach($us_cities as $key => $value)
					        			@if($key > 40  && $key < 51)
					        				<li>
			                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
			                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
			                         			</a>
		                         			</li>
					        			@endif
					        		@endforeach
					        	</ul>
					        </div>


					        <div class="col-md-2">
					        	<ul id="ala" class="list-group">
					        		@foreach($us_cities as $key => $value)
					        			@if($key > 50  && $key < 61)
					        				<li>
			                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
			                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
			                         			</a>
		                         			</li>
					        			@endif
					        		@endforeach
					        	</ul>
					        </div>

					        <div class="col-md-12">
	                    		<div class="col-md-2">
	                    			<ul id="ala" class="list-group">
					        		@foreach($us_cities as $key => $value)
					        			@if($key > 60  && $key < 61)
					        				<li>
			                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
			                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
			                         			</a>
		                         			</li>
					        			@endif
					        		@endforeach
					        	</ul>
	                    		</div>
	                    	</div>
	                    	</div>
	                    	
	                    	<div class="col-md-12 do-hr h1">
	                    		<!-- <hr> -->
	                    	</div>
                    		</div>
                    		<!-- <hr> -->
                        @elseif($statename == 'Delaware')

	                        <div class="col-md-12 state">
	                        	<h4>{{$statename}} Cities</h4>
	                        	<div class="col-md-12 hr">
	                        		<!-- <hr> -->
	                        	</div>
		                        <div class="col-md-2 alba">
						        	<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key < 5)
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
						        </div>
						        <div class="col-md-2 alba">
						        	<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key > 4 && $key < 10)
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
						        </div>

						        <div class="col-md-2">
						        	<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key > 19 && $key < 30)
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
						        </div>

						        <div class="col-md-2">
						        	<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key > 30 && $key < 41 )
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
						        </div>

						        <div class="col-md-2">
						        	<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key > 40  && $key < 51)
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
						        </div>


						        <div class="col-md-2">
						        	<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key > 50  && $key < 61)
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
						        </div>

						        <div class="col-md-12">
		                    		<div class="col-md-2">
		                    			<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key > 60  && $key < 61)
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
		                    		</div>
		                    	</div>
		                    	</div>
		                    	
		                    	<div class="col-md-12 do-hr h1">
		                    		<!-- <hr> -->
		                    	</div>
	                    	</div>
	                    	<!-- <hr> -->

	                    @elseif($statename == 'Maine')

	                        <div class="col-md-12 state">
	                        	<h4>{{$statename}} Cities</h4>
	                        	<div class="col-md-12 hr">
	                        		<!-- <hr> -->
	                        	</div>
		                        <div class="col-md-2 alba">
						        	<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key < 8)
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
						        </div>
						        <div class="col-md-2 alba">
						        	<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key > 7 && $key < 16)
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
						        </div>

						        <div class="col-md-2">
						        	<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key > 19 && $key < 30)
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
						        </div>

						        <div class="col-md-2">
						        	<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key > 30 && $key < 41 )
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
						        </div>

						        <div class="col-md-2">
						        	<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key > 40  && $key < 51)
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
						        </div>


						        <div class="col-md-2">
						        	<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key > 50  && $key < 61)
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
						        </div>

						        <div class="col-md-12">
		                    		<div class="col-md-2">
		                    			<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key > 60  && $key < 61)
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
		                    		</div>
		                    	</div>
		                    	</div>
		                    	
		                    	<div class="col-md-12 do-hr h1">
		                    		<!-- <hr> -->
		                    	</div>
	                    	</div>
	                    	<!-- <hr> -->

	                    @elseif($statename == 'Mississippi')

	                        <div class="col-md-12 state">
	                        	<h4>{{$statename}} Cities</h4>
	                        	<div class="col-md-12 hr">
	                        		<!-- <hr> -->
	                        	</div>
		                        <div class="col-md-2 alba">
						        	<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key < 6)
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
						        </div>
						        <div class="col-md-2 alba">
						        	<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key > 5 && $key < 12)
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
						        </div>

						        <div class="col-md-2">
						        	<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key > 11 && $key < 18)
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
						        </div>

						        <div class="col-md-2">
						        	<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key > 30 && $key < 41 )
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
						        </div>

						        <div class="col-md-2">
						        	<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key > 40  && $key < 51)
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
						        </div>


						        <div class="col-md-2">
						        	<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key > 50  && $key < 61)
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
						        </div>

						        <div class="col-md-12">
		                    		<div class="col-md-2">
		                    			<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key > 60  && $key < 61)
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
		                    		</div>
		                    	</div>
		                    	</div>
		                    	
		                    	<div class="col-md-12 do-hr h1">
		                    		<!-- <hr> -->
		                    	</div>
	                    	</div>
	                    	<!-- <hr> -->
	                    @elseif($statename == 'Montana')

	                        <div class="col-md-12 state">
	                        	<h4>{{$statename}} Cities</h4>
	                        	<div class="col-md-12 hr">
	                        		<!-- <hr> -->
	                        	</div>
		                        <div class="col-md-2 alba">
						        	<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key < 6)
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
						        </div>
						        <div class="col-md-2 alba">
						        	<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key > 5 && $key < 12)
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
						        </div>

						        <div class="col-md-2">
						        	<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key > 11 && $key < 18)
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
						        </div>

						        <div class="col-md-2">
						        	<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key > 30 && $key < 41 )
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
						        </div>

						        <div class="col-md-2">
						        	<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key > 40  && $key < 51)
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
						        </div>


						        <div class="col-md-2">
						        	<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key > 50  && $key < 61)
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
						        </div>

						        <div class="col-md-12">
		                    		<div class="col-md-2">
		                    			<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key > 60  && $key < 61)
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
		                    		</div>
		                    	</div>
		                    	</div>
		                    	
		                    	<div class="col-md-12 do-hr h1">
		                    		<!-- <hr> -->
		                    	</div>
	                    	</div>
	                    	<!-- <hr> -->
	                    @elseif($statename == 'Nebraska')

	                        <div class="col-md-12 state">
	                        	<h4>{{$statename}} Cities</h4>
	                        	<div class="col-md-12 hr">
	                        		<!-- <hr> -->
	                        	</div>
		                        <div class="col-md-2 alba">
						        	<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key < 8)
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
						        </div>
						        <div class="col-md-2 alba">
						        	<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key > 7 && $key < 15)
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
						        </div>

						        <div class="col-md-2">
						        	<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key > 14 && $key < 18)
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
						        </div>

						        <div class="col-md-2">
						        	<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key > 30 && $key < 41 )
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
						        </div>

						        <div class="col-md-2">
						        	<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key > 40  && $key < 51)
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
						        </div>


						        <div class="col-md-2">
						        	<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key > 50  && $key < 61)
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
						        </div>

						        <div class="col-md-12">
		                    		<div class="col-md-2">
		                    			<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key > 60  && $key < 61)
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
		                    		</div>
		                    	</div>
		                    	</div>
		                    	
		                    	<div class="col-md-12 do-hr h1">
		                    		<!-- <hr> -->
		                    	</div>
	                    	</div>
	                    	<!-- <hr> -->
	                    @elseif($statename == 'New Hampshire')

	                        <div class="col-md-12 state">
	                        	<h4>{{$statename}} Cities</h4>
	                        	<div class="col-md-12 hr">
	                        		<!-- <hr> -->
	                        	</div>
		                        <div class="col-md-2 alba">
						        	<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key < 8)
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
						        </div>
						        <div class="col-md-2 alba">
						        	<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key > 7 && $key < 16)
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
						        </div>

						        <div class="col-md-2">
						        	<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key > 15 && $key < 18)
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
						        </div>

						        <div class="col-md-2">
						        	<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key > 30 && $key < 41 )
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
						        </div>

						        <div class="col-md-2">
						        	<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key > 40  && $key < 51)
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
						        </div>


						        <div class="col-md-2">
						        	<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key > 50  && $key < 61)
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
						        </div>

						        <div class="col-md-12">
		                    		<div class="col-md-2">
		                    			<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key > 60  && $key < 61)
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
		                    		</div>
		                    	</div>
		                    	</div>
		                    	
		                    	<div class="col-md-12 do-hr h1">
		                    		<!-- <hr> -->
		                    	</div>
	                    	</div>
	                    	<!-- <hr> -->
	                    @elseif($statename == 'New Mexico')

	                        <div class="col-md-12 state">
	                        	<h4>{{$statename}} Cities</h4>
	                        	<div class="col-md-12 hr">
	                        		<!-- <hr> -->
	                        	</div>
		                        <div class="col-md-2 alba">
						        	<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key < 6)
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
						        </div>
						        <div class="col-md-2 alba">
						        	<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key > 5 && $key < 12)
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
						        </div>

						        <div class="col-md-2">
						        	<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key > 11 && $key < 18)
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
						        </div>

						        <div class="col-md-2">
						        	<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key > 30 && $key < 41 )
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
						        </div>

						        <div class="col-md-2">
						        	<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key > 40  && $key < 51)
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
						        </div>


						        <div class="col-md-2">
						        	<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key > 50  && $key < 61)
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
						        </div>

						        <div class="col-md-12">
		                    		<div class="col-md-2">
		                    			<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key > 60  && $key < 61)
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
		                    		</div>
		                    	</div>
		                    	</div>
		                    	
		                    	<div class="col-md-12 do-hr h1">
		                    		<!-- <hr> -->
		                    	</div>
	                    	</div>
	                    	<!-- <hr> -->
	                    @elseif($statename == 'Rhode Island')

	                        <div class="col-md-12 state">
	                        	<h4>{{$statename}} Cities</h4>
	                        	<div class="col-md-12 hr">
	                        		<!-- <hr> -->
	                        	</div>
		                        <div class="col-md-2 alba">
						        	<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key < 6)
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
						        </div>
						        <div class="col-md-2 alba">
						        	<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key > 5 && $key < 12)
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
						        </div>

						        <div class="col-md-2">
						        	<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key > 11 && $key < 18)
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
						        </div>

						        <div class="col-md-2">
						        	<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key > 30 && $key < 41 )
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
						        </div>

						        <div class="col-md-2">
						        	<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key > 40  && $key < 51)
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
						        </div>


						        <div class="col-md-2">
						        	<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key > 50  && $key < 61)
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
						        </div>

						        <div class="col-md-12">
		                    		<div class="col-md-2">
		                    			<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key > 60  && $key < 61)
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
		                    		</div>
		                    	</div>
		                    	</div>
		                    	
		                    	<div class="col-md-12 do-hr h1">
		                    		<!-- <hr> -->
		                    	</div>
	                    	</div>
	                    	<!-- <hr> -->

	                    @elseif($statename == 'Vermont')

	                        <div class="col-md-12 state">
	                        	<h4>{{$statename}} Cities</h4>
	                        	<div class="col-md-12 hr">
	                        		<!-- <hr> -->
	                        	</div>
		                        <div class="col-md-2 alba">
						        	<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key < 6)
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
						        </div>
						        <div class="col-md-2 alba">
						        	<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key > 5 && $key < 12)
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
						        </div>

						        <div class="col-md-2">
						        	<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key > 11 && $key < 18)
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
						        </div>

						        <div class="col-md-2">
						        	<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key > 30 && $key < 41 )
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
						        </div>

						        <div class="col-md-2">
						        	<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key > 40  && $key < 51)
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
						        </div>


						        <div class="col-md-2">
						        	<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key > 50  && $key < 61)
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
						        </div>

						        <div class="col-md-12">
		                    		<div class="col-md-2">
		                    			<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key > 60  && $key < 61)
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
		                    		</div>
		                    	</div>
		                    	</div>
		                    	
		                    	<div class="col-md-12 do-hr h1">
		                    		<!-- <hr> -->
		                    	</div>
	                    	</div>
	                    	<!-- <hr> -->

	                    @elseif($statename == 'Wyoming')

	                        <div class="col-md-12 state">
	                        	<h4>{{$statename}} Cities</h4>
	                        	<div class="col-md-12 hr">
	                        		<!-- <hr> -->
	                        	</div>
		                        <div class="col-md-2 alba">
						        	<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key < 5)
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
						        </div>
						        <div class="col-md-2 alba">
						        	<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key > 4 && $key < 12)
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
						        </div>

						        <div class="col-md-2">
						        	<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key > 11 && $key < 18)
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
						        </div>

						        <div class="col-md-2">
						        	<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key > 30 && $key < 41 )
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
						        </div>

						        <div class="col-md-2">
						        	<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key > 40  && $key < 51)
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
						        </div>


						        <div class="col-md-2">
						        	<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key > 50  && $key < 61)
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
						        </div>

						        <div class="col-md-12">
		                    		<div class="col-md-2">
		                    			<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key > 60  && $key < 61)
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
		                    		</div>
		                    	</div>
		                    	</div>
		                    	
		                    	<div class="col-md-12 do-hr h1">
		                    		<!-- <hr> -->
		                    	</div>
	                    	</div>
	                    	<!-- <hr> -->
	                    @elseif($statename == 'Texas')
	                    	<div class="col-md-12 state">
	                        	<h4>{{$statename}} Cities</h4>
	                        	<div class="col-md-12 hr">
	                        		<!-- <hr> -->
	                        	</div>
		                        <div class="col-md-2 alba">
						        	<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key < 31)
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
						        </div>
						        <div class="col-md-2 alba">
						        	<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key > 30 && $key < 62)
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
						        </div>

						        <div class="col-md-2">
						        	<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key > 61 && $key < 93)
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
						        </div>

						        <div class="col-md-2">
						        	<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key > 92 && $key < 124 )
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
						        </div>

						        <div class="col-md-2">
						        	<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key > 123  && $key < 155)
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
						        </div>


						        <div class="col-md-2">
						        	<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key > 154  && $key < 186)
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
						        </div>

						        <div class="col-md-12">
		                    		<div class="col-md-2">
		                    			<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key > 60  && $key < 61)
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
		                    		</div>
		                    	</div>
		                    	</div>
		                    	
		                    	<div class="col-md-12 do-hr h1">
		                    		<!-- <hr> -->
		                    	</div>
	                    	</div>
	                    @else
	                    	<div class="col-md-12 state">
	                        	<h4>{{$statename}} Cities</h4>
	                        	<div class="col-md-12 hr">
	                        		<!-- <hr> -->
	                        	</div>
		                        <div class="col-md-2 alba">
						        	<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key < 10)
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
						        </div>
						        <div class="col-md-2 alba">
						        	<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key > 9 && $key < 20)
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
						        </div>

						        <div class="col-md-2">
						        	<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key > 19 && $key < 30)
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
						        </div>

						        <div class="col-md-2">
						        	<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key > 30 && $key < 41 )
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
						        </div>

						        <div class="col-md-2">
						        	<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key > 40  && $key < 51)
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
						        </div>


						        <div class="col-md-2">
						        	<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key > 50  && $key < 61)
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
						        </div>

						        <div class="col-md-12">
		                    		<div class="col-md-2">
		                    			<ul id="ala" class="list-group">
						        		@foreach($us_cities as $key => $value)
						        			@if($key > 60  && $key < 61)
						        				<li>
				                         			<a  href="{{url('/')}}/{{$value['state_name']}}/{{$value['city']}}/" value="{{$value['city']}}" >
				                         				<span value="{{$value['city']}}">{{$value['city']}}</span>
				                         			</a>
			                         			</li>
						        			@endif
						        		@endforeach
						        	</ul>
		                    		</div>
		                    	</div>
		                    	</div>
		                    	
		                    	<div class="col-md-12 do-hr h1">
		                    		<!-- <hr> -->
		                    	</div>
	                    	</div>
	                    	<!-- <hr> -->
                    	@endif

                    	
        </div>
        </div>
    </div>
</div>

	
</div>
</div>
</div>
</main>

<style type="text/css">
	.error{
		color: red;
	}
	/*.hei{
    	height: 0px !important;
    }*/
</style>

<script type="text/javascript">
	jQuery(document).ready(function(){
		$.ajax( {
  			
  			url: "{{ url('/registercountries_signin') }}",
  			method: 'GET',
  			success: function(registercountries_signin){
  			if(registercountries_signin){
  				$('#registercountries').html(registercountries_signin);
  			}
  		}
  	})
})
</script>



<script type="text/javascript">
	jQuery(document).ready(function(){
		$('#registeredcountries').change(function(){
			var value = $(this).val();
			if(value == 'England' || value == 'Canada')
			{
				$.ajax({
					type:'GET',
					data : {'country':value},
					url: "{{ url('/user/englandcanada') }}",
					success:function(englandcanada){
						// $('#cityName').html(englandcanada);
						// $('#cityName').css('display','block');
						$('#cityname').html(englandcanada);
						$('#europecountries').html('<option value="">Select Country</option>');
						$('#locations').html('<option value="">Select Cafe Location</option>');
						$('.dd').hide();
						$('.usa').hide();
						$('.usa1').hide();
						
					}
				});
			}
		})
	})
</script>


<script type="text/javascript">
	jQuery(document).ready(function(){
		$('#registeredcountries').change(function(){
			var value = $(this).val();
			if(value == 'Europe')
			{
				$('#usastates1').hide();
				$('#usastates').html();
				$('#cityname').html('<option value="">Select City</option>')
			}
		})
	});
</script>

<script type="text/javascript">
	
		$(document).on('change','#europecountries',function(){
			var value = $(this).val();
			if(value)
			{
				$.ajax({
					type:'GET',
					data : {'country':value},
					url: "{{ url('/user/englandcanada') }}",
					success:function(englandcanada){
						// $('#cityName').html(englandcanada);
						// $('#cityName').css('display','block');
						$('#cityname').html(englandcanada);
						$('.usa').hide();
						$('.usa1').hide();
					}
				});
			}
		})
</script>




<script type="text/javascript">

		$(document).on('change','#cityname',function(){
			var city = $(this).val(); 
			var continent = $('#registeredcountries').val();
			var country = $('#europecountries').val();

  			$.ajax( {
  				type:'GET',
				url:"{{url('/user/englandcanadalocations')}}",
				data : {'city':city, 'continent':continent, 'country':country},
  				success: function(englandcanadalocations){
  					if(englandcanadalocations){
  						// $('#Locations').html(englandcanadalocations);
  						// $('#Locations').css('display','block');
  						$('#locations').html(englandcanadalocations);
  					}
  				}
  			})
		})
	
</script>

<script type="text/javascript">
	$(document).on('change','#registeredcountries',function(){
		var value = $('#aioConceptName').find(":selected").text();
		if(value == "USA")
		{
			$.ajax( {
  					type:'GET',
					url:"{{url('/user/usacodes')}}",
					success: function(usacodes){
  						if(usacodes){
  							// jQuery('#usastates1').html(usacodes);
  							jQuery('#usastates').html(usacodes);
  							jQuery('#europecountries').html('');
  							jQuery('#europecountries').hide();
  							jQuery('#cityname').html('<option value="">Select City</option>');
  							jQuery('#locations').html('<option value="">Select Cafe Location</option>');
  							jQuery('.usa').show();
  							jQuery('.dd').hide();
  					}
  				}
  			});
		}
});
</script>

<script type="text/javascript">
	$(document).ready(function(){
		var value = $('#registeredcountries').val();
		if(value == 'Canada' || value == 'England' || value== 'Europe')
		{
			$('#usastates1').hide();
			$('#usastates').html('');
		}
	})
</script>

<script type="text/javascript">
	$(document).on('change','#usastates',function(){
		var value = $(this).val();
		if(value)
		{
			$.ajax( {
  					type:'GET',
					url:"{{url('/user/usacities')}}",
					data : {'state_code':value},
					success: function(usacities){
  						if(usacities){
  							// jQuery('#usacities1').html(usacities);
  							// jQuery('#usacities').html(usacities);
  							// jQuery('.usa1').show();
  							jQuery('#cityname').html(usacities);
  							$('#europecountries').html('<option value="">Select Country</option>');

  					}
  					else
  					{
  						jQuery('.usa1').hide();
  					}
  				}
  			});	
		}
})
</script>

<!-- <script type="text/javascript">
	$(document).on('change','#cityname',function(){
		var value = $(this).val();

		$.ajax( {
  					type:'GET',
					url:"{{url('/user/usalocations')}}",
					data : {'city':value},
					success: function(usalocations){
  						if(usalocations){
  							$('#Locations').html(usalocations);
  							$('#Locations').css('display','block');
  							

  					}
  				}
  			})
	})
</script> -->

<script type="text/javascript">
	$('#delete-account').click(function(){
		var checkedValue = $('.product-list:checked').val();
		if(checkedValue == 'Yes')
		{
			$('#confirm1').show();
		}
	});
</script>

<!-- <script type="text/javascript">
jQuery(document).ready(function(){
	$('#ala').click(function(){
		var code = $('#ala li a').find(":selected").attr('data-cod');
			// var code = $('#ala').find(":selected").attr('data-cod');
			alert(code);
			return false;
		alert(code);
			$.ajax( {
  					type:'GET',
					url:"{{url('/Alabama')}}",
					data : {'state_code':code},
					success: function(Alabama){
						console.log(data);
  				}
  			});	
		// if(checkedValue == 'Yes')
		// {
		// 	$('#confirm1').show();
		// }
	});
});
</script> -->

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
		// $('#registercountries').change(function(){
			var value = $('#registercountries').find(":selected").text();
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
							// $('#cities').html('<option value=""><strong>Choose One</strong></option>').css('color','black');
							$('#locations').html('<option value="">Choose Cafe Location</option>');
						}
					}
				})
			}
		})
	// })
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$('#states').change(function(){
			var value = $(this).val();
			// alert('1');
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
		$('#cities').change(function(){
			var value = $(this).val();
			var value1 = $('#states').find(":selected").val();
			// alert(value);
			// alert(value1);
			$.ajax ( {

				url:  "{{ url('/usacodes') }}",
				method: 'GET',
				data : {'city':value,'state':value1},
					success: function(usacodes){
					if(usacodes){
						$('#zip_code1').html(usacodes);
						$('.zip_code1').show();
					}
				}
			})
			
		})
	})
</script>



<script type="text/javascript">
	$(document).ready(function(){
		// $('#registercountries').change(function(){
			var value = $('#registercoun').find(":selected").text();
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
							// $('#states').html('<option value="">Select State:</option>');

							$('.cities').show();
							$('.locations').show();
							$('.states').hide();
						}
					}
				})

				$('.custom_interested_in').show();
			}

		$('.search').click(function(){
			// alert("hii");
			var states = $('#states').find(":selected").val();
			var cities = $('#cities').find(":selected").val();
			var zip_code = $('#zip_code1').find(":selected").val();
			if(states == '' || cities == '' || zip_code == '') {
				// jQuery('#state_error strong').text('State is Required');
				// jQuery('#city_error strong').text('City is Required');
				// jQuery('#zip_code_error strong').text('Zip Code is Required');
				$('#search').attr('disabled', true);
			} else {
				jQuery('#state_error strong').text('');
				jQuery('#city_error strong').text('');
				jQuery('#zip_code_error strong').text('');
				$('#search').attr('disabled', false);
			}
		});
	});
	// })
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
