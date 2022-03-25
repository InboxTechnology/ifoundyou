@extends('layouts.full_dashboard')

@section('content')

<style>
	.logo-section
	{	
		padding: 0px 0px 20px;
		margin-top:-135px;
	}
	.nav-inner{margin: 0px 2px;}
	.container.custom_nav{padding: 0px 0px 20px;min-height: auto;}

	.he{
		padding: 0px !important;
	}
	.nav-inner li a{
		color: black !important;
	}
	.custom_advance_search_box{
		margin-top: -75px;
	}
	.custom_advance_search_box .custom_search_btn{
		position: relative;
		padding: 7px 30px;
	}
	.middle {
		margin: 0 auto;
	}
	@media(max-width: 767px){
		.tc-cs-btn{
			text-align: center;
		}
	}
</style>

<div class="container custom_nav">
	<ul class="nav-inner">
	    <li><a href="{{ url('user/dashboard') }}">Home</a></li>
	    <li class="active"><a>Find a Match</a></li>
	</ul>
</div>

<div class="container-fluid">
	@if (session('success'))
		<div class="alert alert-success">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>{{ session('success') }}</strong>
		</div>					
	@endif

	@if (session('failure'))
		<div class="alert alert-danger">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>{{ session('failure') }}</strong>
		</div>					
	@endif

	@if (session('warning'))
		<div class="alert alert-warning">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>{{ session('warning') }}</strong>
		</div>					
	@endif


	<div class="wrapper-cl">
		<div class="row mg-toptwo">
			<div class="middle">
				<form method="post" action="{{ url('/advance-search-result') }}" >
					@csrf
					{{-- <div class="col-md-12 text-center logo-section">
						<img src="{{ asset('public/img/logo.png') }}">
					</div> --}}

					{{-- <div class="col-md-offset-3 col-md-6 col-sm-6 bg-dark_custom">
						<div class="row">
							<div class="col-md-10">
								<div class="form-group">
									<input type="text" name="first_Name" class="form-control custom_border search_input" id="fname" placeholder="Example: United States" autocomplete="off" > 
								</div>

								<div class="renderDiv custom_render">
	                                @include('searchResultsRender')
	                            </div>
							</div>
							<div class="col-md-2">
								<input type="button" name="" value="Search" class="blue-btn" id="search-button">
							</div>

							<div class="col-md-12 text-center">
								<label class="radio-inline">
							      <input type="radio" name="gender" value="All" checked>All
							    </label>
							    <label class="radio-inline">
							      <input type="radio" name="gender" value="Male">Male
							    </label>
							    <label class="radio-inline">
							      <input type="radio" name="gender" value="Female">Female
							    </label>
							</div>
						</div>
					</div> --}}
	
					{{-- <div class="col-md-offset-4 col-md-4 text-center">
						<a href="{{ url('/find-match') }} " class="blue-btn" id="match-btn">Find a Match</a>
						<a href="javascript:; " class="blue-btn" id="custom_advance_search">Advance Search</a>
						@if(Auth::check())
							<a href="{{ url('/user/advance-search') }}" class="blue-btn">Advance search</a>
						@else
							 <!-- <a href="{{ url('/register') }}" class="blue-btn">Advance search</a>  -->
						@endif 
					</div> --}}

					<?php /*<div class=" col-md-12 col-sm-12 custom_advance_search_box">
						<div class="row">

							<div class="col-md-3 col-sm-3">
								<div class="form-group">
									<!-- <label>Month</label> -->
									<select class="form-control" name="adv_search_month" id="adv_search_month">
										<option value="">Select Month</option>
										<option value="1">January</option>
										<option value="2">February</option>
										<option value="3">March</option>
										<option value="4">April</option>
										<option value="5">May</option>
										<option value="6">June</option>
										<option value="7">July</option>
										<option value="8">August</option>
										<option value="9">September</option><option value="10">October</option>
										<option value="11">November</option>
										<option value="12">December</option>
									</select>
								</div>
							</div>

							<div class="col-md-3 col-sm-3">
								<div class="form-group">
									<!-- <label>Day</label> -->
									<select class="form-control" name="adv_search_day">
										<option value="">Select Day</option>
										@php
											$day = 1;
										@endphp

										@for( $i = $day; $i<=31; $i++ )
									        <option value="{{ $i }}">{{ $i }}</option>
									    @endfor
									</select>
								</div>
							</div>

							<div class="col-md-3 col-sm-3" style="padding:0;">
								<div class="form-group">
									<!-- <label>Year</label> -->
									<select class="form-control" name="adv_search_year">
										<option value="">Select Year</option>
										@php
											$startYear = '1950';
											$currentYear = date('Y');
										@endphp

										@for( $i = $startYear; $i<=$currentYear; $i++ )
									        <option value="{{ $i }}">{{ $i }}</option>
									    @endfor
									</select>
								</div>
							</div>

							<span id="custom_not_usa" style="display: none;">
								<div class="col-md-12">
									<div class="form-group cus-form-group">
										<label>Select City</label>
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
										<label>Zip code</label>
										<input type="text" name="adv_search_zipcode" id="adv_search_zipcode" class="form-control" placeholder="zip code">
									</div>
								</div>
							</span>

							<span class="custom_interested_in" style="display: none;">
								<div class="col-md-12">
									<div class="form-group">
										<label>Who are you interested in?</label>
										<select class="form-control" name="adv_search_interested_in" id="adv_search_interested_in">
											<option value="">Who are you interested in?</option>
			                                 <option value="I am a man seeking a women">I am a man seeking a women</option>
			                                 <option value="I am a women seeking a man">I am a women seeking a man</option>
			                                 <option value="I am a man seeking a man">I am a man seeking a man</option>
			                                 <option value="I am a women seeking a women">I am a women seeking a women</option>
			                            </select>
			                        </div>
			                    </div>
		                    </span>

							<div class="col-md-3 col-sm-3 tc-cs-btn">
								<input type="submit" value="Search" class="custom_search_btn" >
							</div>

						</div>
					</div> */ ?>

					<div class="row">
		               <div class = "col-md-12">
		                  	<div class="row">
		                     	@if( @$users )
			                     	@foreach( $users as $user )
				                        <div class="search-result col-md-12">
				                           	<div class="col-md-10 col-xs-12">
				                              	<a href="{{ url('/user/user-profile').'/'.$user->id }}">
			                                    	<h2 class="view">{{ $user->name }}</h2>
			                                       	<div class="description custom_description">
			                                          <span class="htt">{{ url('/').'/user/'.$user->name }}</span>
			                                          @if($user->month)
			                                             <b>Date Of Birth:</b> {{ $user->month.'/'.$user->day.'/'.$user->year }}
			                                          @endif
			                                          @if($user->sex)
			                                             <b>Gender:</b> {{ $user->sex }}
			                                          @endif
			                                          @if( $user->UserCity )
			                                             <b>City:</b> {{ $user->UserCity->city_name }}
			                                          @endif
			                                       	</div>

				                                 	<div class="description row" style="margin-top: 5px;"> 
					                                    @if($user->looking_for)
					                                       <div class="col-md-12">
					                                          <b>Looking to Date:</b> {{ $user->looking_for }}
					                                       </div>
					                                    @endif
				                                 	</div>
				                              	</a>
				                           	</div>
				                        </div>
			                     	@endforeach
		                        @else
		                           <div class="col-md-12 text-left" style="margin-top: 10px;">No records found</div>
		                        @endif
		                  </div>
		               </div>
		            </div>

				</form>
			</div>
		</div>
	</div>
</div>

@endsection