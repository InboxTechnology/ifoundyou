@extends('layouts.app')

@section('content')
<main class="py-4 back">
	<div class="container">

		<div class="row nav-bottom-border">
            <div class="col-md-12 col-sm-12 col-xs-12 px-0 mt-20">
            	<ul class="nav navbar-nav">
				    <li><a href="{{ url('/') }}" class="pl-0">Home</a></li>
				    <li><a href="{{ url('/provinces-list') }}">Provinces List</a></li>
				    <li><a href="{{ url($stateName.'/cities-list') }}">{{ $stateName }}</a></li>
				    <li><a href="{{ url($stateName.'/cities-list') }}">{{ $cityName }}</a></li>
				    <li><a href="{{ url($stateName.'/'.$cityName) }}">Type of Relationship</a></li>
        			<li class="active"><a href="javascript:;">Birthday</a></li>
			  	</ul>
            </div>
        </div>

		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="container-fluid mt-45">
		            <div class="row">
		            	<div class="col-md-8 col-sm-offset-2">
		            		@if( Auth::check() && !empty(Auth::user()->provider_name) )
		            			<form method="post" action="{{ url('/social-register') }}" >
		            				<input type="hidden" name="state_name" value="{{ $stateName }}">
				                	<input type="hidden" name="city_name" value="{{ $cityName }}">
		            		@else
		                		<form method="post" action="{{ url($stateName.'/'.$cityName.'/email') }}" >
		                	@endif
			                	@csrf

			                	<input type="hidden" name="interested_in" value="{{ $RegisterStepData['interested_in'] }}">

								<div class="col-md-12 col-sm-12 classol-xs-12 ">
									<div class="col-md-4 col-sm-12 col-xs-12">
										<label>Month</label>
										<select class="form-control" name="month" id="month" required>
											<option value="">Choose One</option>
											<option value="1" >January</option>
											<option value="2" >February</option>
											<option value="3" >March</option>
											<option value="4" >April</option>
											<option value="5" >May</option>
											<option value="6" >June</option>
											<option value="7" >July</option>
											<option value="8" >August</option>
											<option value="9" >September</option>
											<option value="10" >October</option>
											<option value="11" >November</option>
											<option value="12">December</option>
										</select>
										@if ($errors->has('month') || $errors->has('day') || $errors->has('year'))
											<span class="red-span-error" id="birth_error">
												<strong>
													Please enter your birth date
												</strong>
											</span>
										@endif
									</div>

									<div class="col-md-4 col-sm-12 col-xs-12" >
										<label>Day</label>
										<select class="form-control" name="day" id="day" required>
											<option value="">Choose One</option>
											@for($day = 1; $day < 31; $day++)
												<option>{{ $day }}</option>
											@endfor
										</select>
									</div>

									<div class="col-md-4 col-sm-12 col-xs-12" >
										<label>Year</label>
										<select class="form-control" name="year" id="year" required>
											<option value="">Choose One</option>
											<?php $curr_year = Carbon\Carbon::now()->format('Y'); $year = $curr_year - 65; ?>
											@for($year ; $year <= $curr_year; $year++)
												<option>{{ $year }}</option>
											@endfor
										</select>
									</div>
                               	
                               		<div class="col-md-12">
						 				<div class="form-group text-center" style="margin-top: 24px;">
		                                    <ul class="list-unstyled list-inline">
		                                        <li><button type="submit" class="btn cafe-submit search">Next</button></li>
		                                    </ul>  
		                                </div>
	                                </div>

	                            </div>
                            </form>
                        </div>
		        	</div>
				</div>
			</div>
		</div>
	</div>
</main>

@endsection
