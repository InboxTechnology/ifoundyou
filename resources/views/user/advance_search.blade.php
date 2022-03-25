@extends('layouts.full_dashboard')

@section('content')
<div class="col-md-10 col-md-offset-1 col-sm-12 col-xs-12">

	<ul class="nav-inner">
		<li><a href="{{ url('/user/dashboard') }}">Home</a></li>
		<li class="active"><a href="{{ url('/user/advance-search') }}">Advance Search</a></li>
	</ul>
	<div class="form-bg">
		<form method="post" action="{{ url('/user/advance-search') }}">
			@csrf
			<div class="col-md-8 pd-none">
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="form-group">
						<label>Looking to Date</label>
						<select class="form-control" name="sex" required>
							<option value="">Choose One</option>
							<option value="Bi Female" @if(@$parameters['sex'] == 'Bi Female') selected  @endif>Bi Female</option>
							<option value="Bi Male" @if(@$parameters['sex'] == 'Bi Male') selected  @endif>Bi Male</option>
							<option value="Gay Female" @if(@$parameters['sex'] == 'Gay Female') selected  @endif>Gay Female</option>
							<option value="Gay Male" @if(@$parameters['sex'] == 'Gay Male') selected  @endif>Gay Male</option>
							<option value="Female" @if(@$parameters['sex'] == 'Female') selected  @endif>Straight Female</option>
							<option value="Male" @if(@$parameters['sex'] == 'Male') selected  @endif>Straight Male</option>
						</select>
					</div>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="form-group chk-label">
						<label>Birthday Match:<input type="checkbox" name="birthday_match" @if(@$parameters['birthday_match']) checked  @endif></label>
					</div>
				</div>
			</div>
			<div class="col-md-8 pd-none">
				<div class="col-md-4 col-sm-4 col-xs-12">
					<div class="form-group">
						<label>Year</label>
						<select class="form-control" name="year" required>
							<option value="">Year</option>
							<?php $curr_year = Carbon\Carbon::now()->format('Y'); ?>
							@for($year = 1939; $year <= $curr_year; $year++)
							<option @if(@$parameters['year'] == $year) selected  @endif>{{ $year }}</option>
							@endfor
						</select>
					</div>
					
				</div>
				<div class="col-md-4 col-sm-4 col-xs-12">
					<div class="form-group">
						<label>Month</label>
						<select class="form-control" name="month" required>
							<option>Choose One</option>
							<option value="1" @if(@$parameters['month'] == '1')  selected  @endif>January</option>
							<option value="2" @if(@$parameters['month'] == '2')  selected  @endif>February</option>
							<option value="3" @if(@$parameters['month'] == '3')  selected  @endif>March</option>
							<option value="4" @if(@$parameters['month'] == '4')  selected  @endif>April</option>
							<option value="5" @if(@$parameters['month'] == '5')  selected  @endif>May</option>
							<option value="6" @if(@$parameters['month'] == '6')  selected  @endif>June</option>
							<option value="7" @if(@$parameters['month'] == '7')  selected  @endif>July</option>
							<option value="8" @if(@$parameters['month'] == '8')  selected  @endif>August</option>
							<option value="9" @if(@$parameters['month'] == '9')  selected  @endif>September</option>
							<option value="10" @if(@$parameters['month'] == '10')  selected  @endif>October</option>
							<option value="11" @if(@$parameters['month'] == '11')  selected  @endif>November</option>
							<option value="12" @if(@$parameters['month'] == '12')  selected  @endif>December</option>
						</select>
					</div>
				</div>
				<div class="col-md-4 col-sm-4 col-xs-12">
					<div class="form-group">
						<label>Day</label>
						<select class="form-control" name="day" required>
							<option value="">Day</option>
							@for($day = 1; $day < 31; $day++)
							<option  @if(@$parameters['day'] == $day) selected  @endif>{{ $day }}</option>
							@endfor
						</select>
					</div>
				</div>
				
			</div>
			
			<div class="col-md-8 pd-none">
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="form-group">
						<label>Language</label>
						<select class="form-control" name="language">
							<option value="">Choose One</option>
							<option value="Chinese" @if(@$parameters['language'] == 'Chinese') selected  @endif>Chinese</option>
							<option value="English" @if(@$parameters['language'] == 'English') selected  @endif>English </option>
							<option value="French" @if(@$parameters['language'] == 'French') selected  @endif>French </option>
							<option value="German" @if(@$parameters['language'] == 'German') selected  @endif>German</option>
							<option value="Hebrew" @if(@$parameters['language'] == 'Hebrew') selected  @endif>Hebrew</option>
							<option value="Hindi" @if(@$parameters['language'] == 'Hindi') selected  @endif>Hindi</option>
							<option value="Italian" @if(@$parameters['language'] == 'Italian') selected  @endif>Italian</option>
							<option value="Russian" @if(@$parameters['language'] == 'Russian') selected  @endif>Russian</option>
							<option value="Spanish" @if(@$parameters['language'] == 'Spanish') selected  @endif>Spanish</option>
							<option value="Other" @if(@$parameters['language'] == 'Other') selected  @endif>Other</option>
						</select>
					</div>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="form-group">
						<label>Height</label>
						<select class="form-control" name="height">
							<option value="">Choose One</option>
							<option value="5.1" @if(@$parameters['height'] == '5.1') selected @endif>5.1</option>
							<option value="5.2" @if(@$parameters['height'] == '5.2') selected @endif>5.2</option>
							<option value="5.3" @if(@$parameters['height'] == '5.3') selected @endif>5.3</option>
							<option value="5.4" @if(@$parameters['height'] == '5.4') selected @endif>5.4</option>
							<option value="5.5" @if(@$parameters['height'] == '5.5') selected @endif>5.5</option>
							<option value="5.6" @if(@$parameters['height'] == '5.6') selected @endif>5.6</option>
							<option value="5.7" @if(@$parameters['height'] == '5.7') selected @endif>5.7</option>
							<option value="5.8" @if(@$parameters['height'] == '5.8') selected @endif>5.8</option>
							<option value="5.9" @if(@$parameters['height'] == '5.9') selected @endif>5.9</option>
							<option value="6.0" @if(@$parameters['height'] == '6.0') selected @endif>6.0</option>
							<option value="6.0+" @if(@$parameters['height'] == '6.0+') selected @endif>6.0+</option>
						</select>
					</div>
					
				</div>
			</div>
			<div class="col-md-8 pd-none">
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="form-group">
						<label>Eye Color</label>
						<select class="form-control" name="eyecolor">
							<option value="">Choose One</option>
							<option value="Any" @if(@$parameters['eyecolor'] == 'Any') selected  @endif>Any</option>
							<option value="Blue" @if(@$parameters['eyecolor'] == 'Blue') selected  @endif>Blue</option>
							<option value="Brown" @if(@$parameters['eyecolor'] == 'Brown') selected  @endif>Brown</option>
							<option value="Green" @if(@$parameters['eyecolor'] == 'Green') selected  @endif>Green</option>
							<option value="Hazel" @if(@$parameters['eyecolor'] == 'Hazel') selected  @endif>Hazel</option>
							<option value="Other" @if(@$parameters['eyecolor'] == 'Other') selected  @endif>Other </option>
						</select>
					</div>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="form-group">
						<label>Body Type</label>
						<select class="form-control" name="bodytype">
							<option value="">Choose One</option>
							<option value="Above Average" @if(@$parameters['bodytype'] == 'Above Average') selected  @endif>Above Average</option>
							<option value="Average" @if(@$parameters['bodytype'] == 'Average') selected  @endif>Average </option>
							<option value="Atheltic" @if(@$parameters['bodytype'] == 'Atheltic') selected  @endif>Atheltic </option>
							<option value="Full Figured" @if(@$parameters['bodytype'] == 'Full Figured') selected  @endif>Full Figured</option>
							<option value="Slender" @if(@$parameters['bodytype'] == 'Slender') selected  @endif>Slender</option>
						</select>
					</div>
					
				</div>
			</div>
			<div class="col-md-8 pd-none">
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="form-group">
						<label>Relegion</label>
						<select class="form-control" name="religion">
							<option value="">Choose One</option>
							<option value="Any" @if(@$parameters['religion'] == 'Any') selected  @endif>Any </option>
							<option value="Buddhism" @if(@$parameters['religion'] == 'Buddhism') selected  @endif>Buddhism </option>
							<option value="Catholicism" @if(@$parameters['religion'] == 'Catholicism') selected @endif>Catholicism  </option>
							<option value="Christianity" @if(@$parameters['religion'] == 'Christianity') selected  @endif>Christianity  </option>
							<option value="Hinduism" @if(@$parameters['religion'] == 'Hinduism') selected  @endif>Hinduism  </option>
							<option value="Islam" @if(@$parameters['religion'] == 'Islam') selected  @endif>Islam </option>
							<option value="Judaism" @if(@$parameters['religion'] == 'Judaism') selected  @endif>Judaism </option>
							<option value="New Age" @if(@$parameters['religion'] == 'New Age') selected  @endif>New Age</option>
							<option value="Other" @if(@$parameters['religion'] == 'Other') selected  @endif>Other</option>
						</select>
					</div>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="form-group">
						<label>Ethnicity</label>
						<select class="form-control" name="ethnicity">
							<option value="">Choose One</option>
							<option value="African American" @if(@$parameters['ethnicity'] == 'African American') selected  @endif>African American</option>
							<option value="Asian" @if(@$parameters['ethnicity'] == 'Asian') selected  @endif>Asian</option>
							<option value="Caucasian" @if(@$parameters['ethnicity'] == 'Caucasian') selected  @endif>Caucasian</option>
							<option value="European" @if(@$parameters['ethnicity'] == 'European') selected @endif>European</option>
							<option value="Hispanic" @if(@$parameters['ethnicity'] == 'Hispanic') selected  @endif>Hispanic</option>
							<option value="Multiracial" @if(@$parameters['ethnicity'] == 'Multiracial') selected  @endif>Multiracial</option>
							<option value="Native American" @if(@$parameters['ethnicity'] == 'Native American') selected  @endif>Native American</option>
						</select>
					</div>
					
				</div>
			</div>
			<div class="col-md-8">
				<input name="menu_name" value="Advance Search" type="hidden">
				<input type="submit" value="Search" class="btn cafe-submit">
			</div>
		</form>
	</div>

	@if(@$users)
		@if(count($users) > 0)
			<div class="col-md-12">
					@foreach ($users as $user)
						<div class="search-result">
							@if($user->name)
							<h2><a class="view" href="{{ url('/') }}/user/view-profile/{{ $user->id }}"> {{ $user->name }} </a></h2>
							<a href="{{ url('/') }}/user/view-profile/{{ $user->id }}" class="htt">{{ url('/').'/user/'.$user->name }}</a>
							@else
							<h2><a class="view" href="/user/view-profile/{{ $user->id }}"> {{ $user->email }} </a></h2>
							<a href="{{ url('/') }}/user/view-profile/{{ $user->id }}" class="htt">{{ url('/').'/user/'.str_limit($user->email,5) }}</a>
							@endif 
							@if($user->type_of_relationship)<p> {{ 'I am Looking For '. $user->type_of_relationship }} </p>@endif
							@if($user->activity) <p>{{ 'I Like '. $user->activity }} </p>@endif
						</div>
					@endforeach
			</div>
		@else
		<div class="row text-center">No records found</div>
		@endif	
	<div class="col-md-12">
		{{ $users->links() }}
	</div>
	@endif

</div>
@endsection
