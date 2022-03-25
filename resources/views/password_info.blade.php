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
				    <li><a href="{{ url($stateName.'/'.$cityName.'/birthday') }}">Birthday</a></li>
				    <li><a href="{{ url($stateName.'/'.$cityName.'/email') }}">Email</a></li>
        			<li class="active"><a href="javascript:;">Password</a></li>
			  	</ul>
            </div>
        </div>

		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="container-fluid mt-45">
		            <div class="row">
		            	<div class="col-md-5 col-md-offset-4">
		                	<form method="post" action="{{ url($stateName.'/'.$cityName.'/fullname') }}" >
			                	@csrf

			                	<input type="hidden" name="interested_in" value="{{ $RegisterStepData['interested_in'] }}">
			                	<input type="hidden" name="month" value="{{ $RegisterStepData['month'] }}">
			                	<input type="hidden" name="day" value="{{ $RegisterStepData['day'] }}">
			                	<input type="hidden" name="year" value="{{ $RegisterStepData['year'] }}">
			                	<input type="hidden" name="email" value="{{ $RegisterStepData['email'] }}">

								<div class="form-group text-center">
									<label>Password</label>
				                    <input type="password" name="password" id="password" value="" class="form-control" required>
				                    <span class="red-span-error" id="password_error">
				                        <strong>@if ($errors->has('password')) {{ $errors->first('password') }} @endif</strong>
				                    </span>
								</div>

								<div class="form-group text-center" style="margin-top: 18px;">
			                      	<ul class="list-unstyled list-inline">
			                          <li><button type="submit" class="btn cafe-submit search">Next</button></li>
			                      	</ul>  
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
