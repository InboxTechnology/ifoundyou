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
        			<li><a href="{{ url($stateName.'/'.$cityName.'/password') }}">Password</a></li>
        			<li class="active"><a href="javascript:;">Name</a></li>
			  	</ul>
            </div>
        </div>

		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="container-fluid mt-45">
		            <div class="row">
		            	<div class="col-md-5 col-md-offset-4">
		            		<form method="post" action="{{ url('register1') }}" >
			                	@csrf

				                <input type="hidden" name="state_name" value="{{ $stateName }}">
				                <input type="hidden" name="city_name" value="{{ $cityName }}">

			                	<input type="hidden" name="interested_in" value="{{ $RegisterStepData['interested_in'] }}">
			                	<input type="hidden" name="month" value="{{ $RegisterStepData['month'] }}">
			                	<input type="hidden" name="day" value="{{ $RegisterStepData['day'] }}">
			                	<input type="hidden" name="year" value="{{ $RegisterStepData['year'] }}">
			                	<input type="hidden" name="email" value="{{ $RegisterStepData['email'] }}">
			                	<input type="hidden" name="password" value="{{ $RegisterStepData['password'] }}">

								<div class="form-group text-center">
									<label>Name</label>
									@if ($errors->has('fullname'))
										<span class="red-span-error d-flex justify-content-center mb-10" id="fullname_error">
											<strong>{{ $errors->first('fullname') }}</strong>
										</span>
									@endif
                      				<input type="text" name="fullname" id="fullname" value="" class="form-control" required>
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
