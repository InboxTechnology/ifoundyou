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
        			<li class="active"><a href="javascript:;">Email</a></li>
			  	</ul>
            </div>
        </div>

		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="container-fluid mt-45">
		            <div class="row">
		            	<div class="col-md-5 col-md-offset-4">
		                	<form method="post" action="{{ url($stateName.'/'.$cityName.'/password') }}" >
			                	@csrf

			                	<input type="hidden" name="interested_in" value="{{ $RegisterStepData['interested_in'] }}">
			                	<input type="hidden" name="month" value="{{ $RegisterStepData['month'] }}">
			                	<input type="hidden" name="day" value="{{ $RegisterStepData['day'] }}">
			                	<input type="hidden" name="year" value="{{ $RegisterStepData['year'] }}">

								<div class="form-group text-center">
									<label>Email Address</label>
									@if ($errors->has('email'))
										<span class="red-span-error d-flex justify-content-center mb-10" id="email_error">
											<strong>{{ $errors->first('email') }}</strong>
										</span>
									@endif
                      				<input type="email" name="email" id="email" value="" class="form-control" required>
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
