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
    				/*margin-left: 27px !important;*/
    				/*margin-bottom: 47px !important;*/
    				margin-bottom: 18px !important;
				    color: black !important;
                }

                .state hr{
                	border-top: 2px solid #00000026 !important;
                	padding: 0px !important;
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
                .padd{
                	padding-left: 0px !important;
                }

                .do-hr{
                	margin-top: 0px !important;
                	padding: 0px !important;
                }

                .state-nav{
                	/*margin: 12px 20px 12px !important;*/
                	padding-left: 0px !important;
                	margin-top: 14px;
                	font-family: verdana;
                }

                .state{
                	padding-left: 0px !important;
                }

                /*.cona{
                	min-height: 3900px !important;
                }*/

                /*.mode{
                	min-height: 0px !important;
                }*/
				
                .mod{
                	box-shadow: none !important;
                	border-radius: 32px !important;
                }

                .city{
                	color: black !important;
                	/*font-weight: bold !important;*/
                }

                .con-new{
          border-top-color: #E0E0E0;
    border-width: 1px !important;
    opacity: 33;
    /* min-height: 474px !important; */
    /* min-height: 758px !important; */
    border-width: 1.5px !important;
    border-top-style: solid !important;
    /*border-bottom-style: solid !important;*/
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
<div class="container cona con-new">
	<div class="row">
<div class="col-md-12 col-sm-12 col-xs-12 state-nav">

	<!-- <ul class="nav-inner ">
		<li><a href="https://ifoundyou.com/">Home</a></li> -->
		<!-- <li><a href="{{ url('/user/dashboard')}}">Dashboard</a></li> -->
		<!-- <li class="active"><a href="{{url('/')}}">State List</a></li> -->
		<!-- <li class="active"><a href="{{url('/country')}}">Country</a></li> -->
		<!-- <li><a href="{{url('/user/cafe-location')}}">Cafe Location</a></li> -->
	<!-- </ul> -->


	<div class="container-fluid pd-none">
    <div class="ct-acct">

        <div class="modal-login mode">
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

					
									
										<!-- <div class="form-group cus-form-group states">
															<label>Select State</label>
															<select style="width:100%;" name="state" id="states" class="form-control city">
																<option value="">Choose One:</option>
															</select>
															<span class="red-span-error" id="state_error">
																<strong>@if ($errors->has('state')) {{ $errors->first('state') }} @endif</strong>
															</span>
										</div>

										<div class="form-group cus-form-group cities">
											<label>Select City</label>
											<select style="width:100%;padding-bottom: 2px !important;" name="cityname" id="cities" class="form-control city">
												<option value="">Choose One</option>
											</select>
											<span class="red-span-error" id="city_error">
												<strong>@if ($errors->has('cityname')) {{ $errors->first('cityname') }} @endif</strong>
											</span>
										</div> -->

										<!-- <div class="form-group usa_zipcode">
											<label>Zip code</label>
											
											<select style="width:100%;padding-bottom: 2px !important;" name="zip_code" id="zip_code1" class="form-control zip_code1 city">
												<option value="">Choose One</option>
											</select>

											<span class="red-span-error" id="zip_code_error">
												<strong>@if ($errors->has('zip_code')) {{ $errors->first('zip_code') }} @endif</strong>
											</span>
										</div> -->
						 				<!-- <div class="form-group text-center" style="margin-top: 18px;">
	                                            <ul class="list-unstyled list-inline">
	                                                <li><button type="button" class="btn cafe-submit search">Submit</button></li>
	                                            </ul>  
	                                    </div> -->
                                    </form>
							<br>
							<!-- <div class="col-md-12 tl-account pd-none center" style="padding-left: 187px;"> -->
								<!-- <div style="text-align: center;"> -->
							<!-- 	<input type="submit" style="float:left;position:relative;" value="Submit" class="btn cafe-submit" > -->
							<!-- </div> -->
							<!-- </div> -->
						
							<hr style="border:1px solid #ccc;width:100%;margin-bottom:20px;display: inline-block;display: none;">
						
						 	<!-- <div>
						 	<label for="del">Delete Account:</label>&nbsp;
						    <label class="checkbox-inline">
						      <input class="product-list" name="check" type="checkbox" value="Yes">Yes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						      <input class="product-list"  name="check" type="checkbox" value="No">No
							</div> -->
							<!-- <input style="margin-top:-30px" type="button" style="float:right" value="Delete Account" class="btn del-btn1 sd" id="delete-account"> -->
						<!-- </div> -->
				<!-- </div> -->

				

                        </div>
                        {{--<div class="modal-footer">

                        </div>--}}

                        
                        <div class="col-md-12 state">
                        	<h4>State List</h4>
                        	<div class="col-md-12 hr">
                        		<!-- <hr> -->
                        	</div>
	                        <div class="col-md-7 padd">
	                         	<div class="col-md-3 padd">
	                         		<!-- <h3>A</h3> -->
						        	<ul id="ala" class="list-group">
			                         	@foreach($states as $key => $value)
			                         		@if($key < 8)
				                         		
				                         			<li>
					                         			<a  href="{{url('/:'. $value->nstate)}}" value="{{$value->state_code}}" >
					                         				<span value="{{$value->state_code}}">{{$value->nstate}}</span>
					                         			</a>
			                         				</li>
				                         		
			                         		@endif
			                         	@endforeach
						        	</ul>
	        					</div>
	        					<div class="col-md-3 padd">
						        	<ul id="" class="list-group">
			                         	@foreach($states as $key => $value)
			                         		@if($key > 7  && $key < 16)
		                         				<li>
				                         			<a  href="{{url('/:'. $value->nstate)}}" value="{{$value->state_code}}" >
				                         				<span value="{{$value->state_code}}">{{$value->nstate}}</span>
				                         			</a>
		                         				</li>
			                         		@endif
			                         	@endforeach
						        	</ul>
	        					</div>

	        					<div class="col-md-3 padd">
						        	<ul id="" class="list-group">
			                         	@foreach($states as $key => $value)
			                         		@if($key > 15  && $key < 24)
			                         			<li>
				                         			<a  href="{{url('/:'. $value->nstate)}}" value="{{$value->state_code}}" >
				                         				<span value="{{$value->state_code}}">{{$value->nstate}}</span>
				                         			</a>
		                         				</li>
			                         		@endif
			                         	@endforeach
						        	</ul>
	        					</div>

	        					<div class="col-md-3">
						        	<ul id="" class="list-group">
			                         	@foreach($states as $key => $value)
			                         		@if($key > 23  && $key < 32)
			                         			<li>
				                         			<a  href="{{url('/:'. $value->nstate)}}" value="{{$value->state_code}}" >
				                         				<span value="{{$value->state_code}}">{{$value->nstate}}</span>
				                         			</a>
		                         				</li>
			                         		@endif
			                         	@endforeach
						        	</ul>
	        					</div>
	                    	</div>

	                    	<div class="col-md-5">
	                    		<div class="col-md-4">
	                    			<ul id="" class="list-group">
		                    			@foreach($states as $key => $value)
				                         		@if($key > 31  && $key < 40)
				                         			<li>
				                         			<a  href="{{url('/:'. $value->nstate)}}" value="{{$value->state_code}}" >
				                         				<span value="{{$value->state_code}}">{{$value->nstate}}</span>
				                         			</a>
		                         				</li>
				                         		@endif
				                        @endforeach
				                    </ul>
	                    		</div>

	                    		<div class="col-md-4">
	                    			<ul id="" class="list-group">
		                    			@foreach($states as $key => $value)
				                         		@if($key > 39  && $key < 48)
				                         			<li>
				                         			<a  href="{{url('/:'. $value->nstate)}}" value="{{$value->state_code}}" >
				                         				<span value="{{$value->state_code}}">{{$value->nstate}}</span>
				                         			</a>
		                         				</li>
				                         		@endif
				                        @endforeach
				                    </ul>
	                    		</div>
	                    		<div class="col-md-4">
	                    			<ul id="" class="list-group">
		                    			@foreach($states as $key => $value)
				                         		@if($key > 47)
				                         			<li>
				                         			<a  href="{{url('/:'. $value->nstate)}}" value="{{$value->state_code}}" >
				                         				<span value="{{$value->state_code}}">{{$value->nstate}}</span>
				                         			</a>
		                         				</li>
				                         		@endif
				                        @endforeach
				                    </ul>
	                    		</div>
	                    	</div>
	                    	<div class="col-md-12 do-hr">
	                    		<!-- <hr> -->
	                    	</div>
                    	</div>


                    	<!-- <div class="col-md-12 state"> -->
                        	<!-- <h4>State List</h4> -->
                        	<!-- <div class="col-md-12 hr"><hr></div> -->
	                        	<!-- <div class="col-md-7"> -->
	                         	<!-- <div class="col-md-12">
	                         		<h3>A</h3>
						        	<ul id="ala" class="list-group">
			                         	@foreach($states as $key => $value)
			                         	
			                         		@if($key < 4)
				                         			
				                         			<li>
					                         			<a  href="{{url('/:'. $value->nstate)}}" value="{{$value->state_code}}" >
					                         				<span value="{{$value->state_code}}">{{$value->nstate}}</span>
					                         			</a>
			                         				</li>
				                         		
			                         		@endif
			                         	@endforeach
						        	</ul>
	        					</div> -->
	                    	<!-- <div class="col-md-12 do-hr"><hr></div> -->

	        					<!-- <div class="col-md-12">
	        						<h3>C</h3>
						        	<ul id="" class="list-group">
			                         	@foreach($states as $key => $value)
			                         		@if($key > 3  && $key < 7)
		                         				<li>
				                         			<a  href="{{url('/:'. $value->nstate)}}" value="{{$value->state_code}}" >
				                         				<span value="{{$value->state_code}}">{{$value->nstate}}</span>
				                         			</a>
		                         				</li>
			                         		@endif
			                         	@endforeach
						        	</ul>
	        					</div>

	        					<div class="col-md-12">
	        						<h3>D</h3>
						        	<ul id="" class="list-group">
			                         	@foreach($states as $key => $value)
			                         		@if($key > 6  && $key < 8)
			                         			<li>
				                         			<a  href="{{url('/:'. $value->nstate)}}" value="{{$value->state_code}}" >
				                         				<span value="{{$value->state_code}}">{{$value->nstate}}</span>
				                         			</a>
		                         				</li>
			                         		@endif
			                         	@endforeach
						        	</ul>
	        					</div>
	                    		<div class="col-md-12 do-hr"><hr></div>

	        					<div class="col-md-12">
	        						<h3>F</h3>
						        	<ul id="" class="list-group">
			                         	@foreach($states as $key => $value)
			                         		@if($key > 7  && $key < 9)
			                         			<li>
				                         			<a  href="{{url('/:'. $value->nstate)}}" value="{{$value->state_code}}" >
				                         				<span value="{{$value->state_code}}">{{$value->nstate}}</span>
				                         			</a>
		                         				</li>
			                         		@endif
			                         	@endforeach
						        	</ul>
	        					</div>

	        					<div class="col-md-12 do-hr"><hr></div>

	        					<div class="col-md-12">
	        						<h3>G</h3>
						        	<ul id="" class="list-group">
			                         	@foreach($states as $key => $value)
			                         		@if($key > 8  && $key < 10)
			                         			<li>
				                         			<a  href="{{url('/:'. $value->nstate)}}" value="{{$value->state_code}}" >
				                         				<span value="{{$value->state_code}}">{{$value->nstate}}</span>
				                         			</a>
		                         				</li>
			                         		@endif
			                         	@endforeach
						        	</ul>
	        					</div>

	        					<div class="col-md-12 do-hr"><hr></div>

	        					<div class="col-md-12">
	        						<h3>H</h3>
						        	<ul id="" class="list-group">
			                         	@foreach($states as $key => $value)
			                         		@if($key > 9  && $key < 11)
			                         			<li>
				                         			<a  href="{{url('/:'. $value->nstate)}}" value="{{$value->state_code}}" >
				                         				<span value="{{$value->state_code}}">{{$value->nstate}}</span>
				                         			</a>
		                         				</li>
			                         		@endif
			                         	@endforeach
						        	</ul>
	        					</div>
	        					<div class="col-md-12 do-hr"><hr></div>

	        					<div class="col-md-12">
	        						<h3>I</h3>
						        	<ul id="" class="list-group">
			                         	@foreach($states as $key => $value)
			                         		@if($key > 10  && $key < 15)
			                         			<li>
				                         			<a  href="{{url('/:'. $value->nstate)}}" value="{{$value->state_code}}" >
				                         				<span value="{{$value->state_code}}">{{$value->nstate}}</span>
				                         			</a>
		                         				</li>
			                         		@endif
			                         	@endforeach
						        	</ul>
	        					</div>

	        					<div class="col-md-12 do-hr"><hr></div>
	        					
	        					<div class="col-md-12">
	        						<h3>K</h3>
						        	<ul id="" class="list-group">
			                         	@foreach($states as $key => $value)
			                         		@if($key > 14  && $key < 17)
			                         			<li>
				                         			<a  href="{{url('/:'. $value->nstate)}}" value="{{$value->state_code}}" >
				                         				<span value="{{$value->state_code}}">{{$value->nstate}}</span>
				                         			</a>
		                         				</li>
			                         		@endif
			                         	@endforeach
						        	</ul>
	        					</div>

	        					<div class="col-md-12 do-hr"><hr></div>
	        					
	        					<div class="col-md-12">
	        						<h3>L</h3>
						        	<ul id="" class="list-group">
			                         	@foreach($states as $key => $value)
			                         		@if($key > 16  && $key < 18)
			                         			<li>
				                         			<a  href="{{url('/:'. $value->nstate)}}" value="{{$value->state_code}}" >
				                         				<span value="{{$value->state_code}}">{{$value->nstate}}</span>
				                         			</a>
		                         				</li>
			                         		@endif
			                         	@endforeach
						        	</ul>
	        					</div>


	        					<div class="col-md-12 do-hr"><hr></div>
	        					
	        					<div class="col-md-12">
	        						<h3>M</h3>
						        	<ul id="" class="list-group">
			                         	@foreach($states as $key => $value)
			                         		@if($key > 17  && $key < 26)
			                         			<li>
				                         			<a  href="{{url('/:'. $value->nstate)}}" value="{{$value->state_code}}" >
				                         				<span value="{{$value->state_code}}">{{$value->nstate}}</span>
				                         			</a>
		                         				</li>
			                         		@endif
			                         	@endforeach
						        	</ul>
	        					</div>

	        					<div class="col-md-12 do-hr"><hr></div>
	        					
	        					<div class="col-md-12">
	        						<h3>N</h3>
						        	<ul id="" class="list-group">
			                         	@foreach($states as $key => $value)
			                         		@if($key > 25  && $key < 34)
			                         			<li>
				                         			<a  href="{{url('/:'. $value->nstate)}}" value="{{$value->state_code}}" >
				                         				<span value="{{$value->state_code}}">{{$value->nstate}}</span>
				                         			</a>
		                         				</li>
			                         		@endif
			                         	@endforeach
						        	</ul>
	        					</div>

	        					<div class="col-md-12 do-hr"><hr></div>
	        					
	        					<div class="col-md-12">
	        						<h3>O</h3>
						        	<ul id="" class="list-group">
			                         	@foreach($states as $key => $value)
			                         		@if($key > 33  && $key < 37)
			                         			<li>
				                         			<a  href="{{url('/:'. $value->nstate)}}" value="{{$value->state_code}}" >
				                         				<span value="{{$value->state_code}}">{{$value->nstate}}</span>
				                         			</a>
		                         				</li>
			                         		@endif
			                         	@endforeach
						        	</ul>
	        					</div>

	        					<div class="col-md-12 do-hr"><hr></div>
	        					
	        					<div class="col-md-12">
	        						<h3>P</h3>
						        	<ul id="" class="list-group">
			                         	@foreach($states as $key => $value)
			                         		@if($key > 36  && $key < 38)
			                         			<li>
				                         			<a  href="{{url('/:'. $value->nstate)}}" value="{{$value->state_code}}" >
				                         				<span value="{{$value->state_code}}">{{$value->nstate}}</span>
				                         			</a>
		                         				</li>
			                         		@endif
			                         	@endforeach
						        	</ul>
	        					</div>

	        					<div class="col-md-12 do-hr"><hr></div>
	        					
	        					<div class="col-md-12">
	        						<h3>R</h3>
						        	<ul id="" class="list-group">
			                         	@foreach($states as $key => $value)
			                         		@if($key > 37  && $key < 39)
			                         			<li>
				                         			<a  href="{{url('/:'. $value->nstate)}}" value="{{$value->state_code}}" >
				                         				<span value="{{$value->state_code}}">{{$value->nstate}}</span>
				                         			</a>
		                         				</li>
			                         		@endif
			                         	@endforeach
						        	</ul>
	        					</div>

	        					<div class="col-md-12 do-hr"><hr></div>
	        					
	        					<div class="col-md-12">
	        						<h3>S</h3>
						        	<ul id="" class="list-group">
			                         	@foreach($states as $key => $value)
			                         		@if($key > 38  && $key < 41)
			                         			<li>
				                         			<a  href="{{url('/:'. $value->nstate)}}" value="{{$value->state_code}}" >
				                         				<span value="{{$value->state_code}}">{{$value->nstate}}</span>
				                         			</a>
		                         				</li>
			                         		@endif
			                         	@endforeach
						        	</ul>
	        					</div>


	        					<div class="col-md-12 do-hr"><hr></div>
	        					
	        					<div class="col-md-12">
	        						<h3>T</h3>
						        	<ul id="" class="list-group">
			                         	@foreach($states as $key => $value)
			                         		@if($key > 40  && $key < 43)
			                         			<li>
				                         			<a  href="{{url('/:'. $value->nstate)}}" value="{{$value->state_code}}" >
				                         				<span value="{{$value->state_code}}">{{$value->nstate}}</span>
				                         			</a>
		                         				</li>
			                         		@endif
			                         	@endforeach
						        	</ul>
	        					</div>

	        					<div class="col-md-12 do-hr"><hr></div>
	        					
	        					<div class="col-md-12">
	        						<h3>U</h3>
						        	<ul id="" class="list-group">
			                         	@foreach($states as $key => $value)
			                         		@if($key > 42  && $key < 44)
			                         			<li>
				                         			<a  href="{{url('/:'. $value->nstate)}}" value="{{$value->state_code}}" >
				                         				<span value="{{$value->state_code}}">{{$value->nstate}}</span>
				                         			</a>
		                         				</li>
			                         		@endif
			                         	@endforeach
						        	</ul>
	        					</div>

	        					<div class="col-md-12 do-hr"><hr></div>
	        					
	        					<div class="col-md-12">
	        						<h3>V</h3>
						        	<ul id="" class="list-group">
			                         	@foreach($states as $key => $value)
			                         		@if($key > 43  && $key < 46)
			                         			<li>
				                         			<a  href="{{url('/:'. $value->nstate)}}" value="{{$value->state_code}}" >
				                         				<span value="{{$value->state_code}}">{{$value->nstate}}</span>
				                         			</a>
		                         				</li>
			                         		@endif
			                         	@endforeach
						        	</ul>
	        					</div>
 -->

	        					<!-- <div class="col-md-12 do-hr"><hr></div>
	        					
	        					<div class="col-md-12">
	        						<h3>W</h3>
						        	<ul id="" class="list-group">
			                         	@foreach($states as $key => $value)
			                         		@if($key > 45  && $key < 49)
			                         			<li>
				                         			<a  href="{{url('/:'. $value->nstate)}}" value="{{$value->state_code}}" >
				                         				<span value="{{$value->state_code}}">{{$value->nstate}}</span>
				                         			</a>
		                         				</li>
			                         		@endif
			                         	@endforeach
						        	</ul>
	        					</div> -->
		                    	<!-- </div> -->

		                    	<!-- <div class="col-md-5">
		                    		<div class="col-md-4">
		                    			<ul id="" class="list-group">
			                    			@foreach($states as $key => $value)
					                         		@if($key > 31  && $key < 40)
					                         			<li>
					                         			<a  href="{{url('/:'. $value->nstate)}}" value="{{$value->state_code}}" >
					                         				<span value="{{$value->state_code}}">{{$value->nstate}}</span>
					                         			</a>
			                         				</li>
					                         		@endif
					                        @endforeach
					                    </ul>
		                    		</div>

		                    		<div class="col-md-4">
		                    			<ul id="" class="list-group">
			                    			@foreach($states as $key => $value)
					                         		@if($key > 39  && $key < 48)
					                         			<li>
					                         			<a  href="{{url('/:'. $value->nstate)}}" value="{{$value->state_code}}" >
					                         				<span value="{{$value->state_code}}">{{$value->nstate}}</span>
					                         			</a>
			                         				</li>
					                         		@endif
					                        @endforeach
					                    </ul>
		                    		</div>
		                    		<div class="col-md-4">
		                    			<ul id="" class="list-group">
			                    			@foreach($states as $key => $value)
					                         		@if($key > 47)
					                         			<li>
					                         			<a  href="{{url('/:'. $value->nstate)}}" value="{{$value->state_code}}" >
					                         				<span value="{{$value->state_code}}">{{$value->nstate}}</span>
					                         			</a>
			                         				</li>
					                         		@endif
					                        @endforeach
					                    </ul>
		                    		</div>
		                    	</div> -->
	                    	<!-- <div class="col-md-12 do-hr"><hr></div> -->
                    	<!-- </div> -->
                    	<hr>

                    	
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
	.hei{
    	height: 0px !important;
    }
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
