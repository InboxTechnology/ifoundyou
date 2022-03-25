@extends('layouts.full_dashboard')

@section('content')

<div class="col-md-10 col-md-offset-1 col-sm-12 col-xs-12">

	<ul class="nav-inner">
		<li><a href="{{ url('/') }}">Home</a></li>
		<li><a href="{{ url('/user/dashboard') }}">Dashboard</a></li>
		<li class="active"><a href="{{ url('/user/profile') }}">Profile</a></li>
		<li><a href="{{ url('/user/my-profile') }}">My Profile</a></li>
	</ul>
	<div class="col-md-10 pd-none" id="profile-page">
		@if (session('success'))
		<div class="blue-span" style="margin-top: 15px; text-align: center;">
			{{ session('success') }}
		</div>						
		@endif
		<div class="forms-in">
			<ul>
				<li><a href="#about_me">About Me</a></li>
				<li><a href="#about_match">About My Match</a></li>
				<li><a href="#activity">Activities</a></li>
				<li><a href="#dob">Date of Birth</a></li>
				<li><a href="#horoscope">Horoscope</a></li>
				<li><a href="#looking_to_date">Looking to Date</a></li>
				<li><a href="#type_of_relationship">Type of Relationship</a></li>
			</ul>
			<div class="block-cl col-md-12" >
				<form method="post" action="{{ url('/user/profile-update') }}">
					@csrf
					<h4>Date of Birth</h4>
					<div class="col-md-3 col-sm-4 col-xs-12 123456" id="dob">
						<select class="form-control" name="month">
							<option value="1" @if(Auth::user()->month == 1) selected @endif>January</option>
							<option value="2" @if(Auth::user()->month == 2) selected @endif>February</option>
							<option value="3" @if(Auth::user()->month == 3) selected @endif>March</option>
							<option value="4" @if(Auth::user()->month == 4) selected @endif>April</option>
							<option value="5" @if(Auth::user()->month == 5) selected @endif>May</option>
							<option value="6" @if(Auth::user()->month == 6) selected @endif>June</option>
							<option value="7" @if(Auth::user()->month == 7) selected @endif>July</option>
							<option value="8" @if(Auth::user()->month == 8) selected @endif>August</option>
							<option value="9" @if(Auth::user()->month == 9) selected @endif>September</option>
							<option value="10" @if(Auth::user()->month == 10) selected @endif>October</option>
							<option value="11" @if(Auth::user()->month == 11) selected @endif>November</option>
							<option value="12" @if(Auth::user()->month == 12) selected @endif>December</option>
						</select>
					</div>
					<div class="col-md-2 col-sm-4 col-xs-12">
						<select class="form-control" name="day" required>
							@for($day = 1; $day < 31; $day++)
							<option @if(Auth::user()->day == $day) selected @endif>{{ $day }}</option>
							@endfor
						</select>
					</div>
					<div class="col-md-3 col-sm-4 col-xs-12">
						<select class="form-control" name="year">
							<?php $curr_year = Carbon\Carbon::now()->format('Y'); ?>
							@for($year = 1939; $year <= $curr_year; $year++)
							<option @if(Auth::user()->year == $year) selected @endif>{{ $year }}</option>
							@endfor
						</select>
					</div>
					<div class="clearfix"></div>
					<hr>
					<div class="clearfix"></div>
					<h4>Looking to Date</h4>
					<?php 
					$looking_for = explode(",",Auth::user()->looking_for);
					$looking_for=array_map('trim',$looking_for);
					?>
					<div class="col-md-4 col-sm-4 col-xs-12" id="looking_to_date">
						<input type="hidden" name="looking_for" id="looking_for_date" value="{{ Auth::user()->looking_for }}">
						<div><input type="checkbox" name="looking_for_date" @if(in_array("Striaght Male", $looking_for)) checked @endif  value="Striaght Male"> <label>Striaght Male</label></div>
						<div><input type="checkbox" name="looking_for_date" @if(in_array("Gay Male", $looking_for)) checked @endif  value="Gay Male"> <label>Gay Male </label></div>
						<div><input type="checkbox" name="looking_for_date" @if(in_array("Bi Male", $looking_for)) checked @endif  value="Bi Male"> <label>Bi Male </label></div>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12">
						<div><input type="checkbox" name="looking_for_date" @if(in_array("Straight Female", $looking_for)) checked @endif  value="Straight Female"> <label>Straight Female</label></div>
						<div><input type="checkbox" name="looking_for_date" @if(in_array("Gay Female", $looking_for)) checked @endif  value="Gay Female"> <label>Gay Female </label></div>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12">
						<div><input type="checkbox" name="looking_for_date" @if(in_array("Bi Female", $looking_for)) checked @endif  value="Bi Female"> <label>Bi Female</label></div>
					</div>
					<div class="clearfix"></div>
					<hr>
					<div class="clearfix"></div>
					<h4>About Me</h4>
					<div class="col-md-5 col-sm-6 col-xs-12" id="about_me">
						<select class="form-control" name="sex">
							<option value="">Choose one</option>
							<option value="Bi Female" @if(Auth::user()->sex == 'Bi Female') selected @endif>Bi Female</option>
							<option value="Bi Male" @if(Auth::user()->sex == 'Bi Male') selected @endif>Bi Male</option>
							<option value="Gay Female" @if(Auth::user()->sex == 'Gay Female') selected @endif>Gay Female</option>
							<option value="Gay Male" @if(Auth::user()->sex == 'Gay Male') selected @endif>Gay Male</option>
							<option value="Female" @if(Auth::user()->sex == 'Female') selected @endif>Straight Female</option>
							<option value="Male" @if(Auth::user()->sex == 'Male') selected @endif>Straight Male</option>
						</select>
						<label>Gender</label>
					</div>
					<div class="col-md-5 col-sm-6 col-xs-12">
						<select class="form-control" name="bodytype">
							<option value="">Choose one</option>
							<option value="Above Average" @if(Auth::user()->bodytype == 'Above Average') selected @endif>Above Average</option>
							<option value="Atheltic" @if(Auth::user()->bodytype == 'Atheltic') selected @endif>Atheltic </option>
							<option value="Average" @if(Auth::user()->bodytype == 'Average') selected @endif>Average </option>
							<option value="Full Figured" @if(Auth::user()->bodytype == 'Full Figured') selected @endif>Full Figured</option>
							<option value="Slender" @if(Auth::user()->bodytype == 'Slender') selected @endif>Slender</option>
						</select>
						<label>Body Type</label>
					</div>
					<div class="col-md-5 col-sm-6 col-xs-12">
						<select class="form-control" name="height">
							<option value="">Choose one</option>
							<option value="5.1" @if(Auth::user()->height == '5.1') selected @endif>5.1</option>
							<option value="5.2" @if(Auth::user()->height == '5.2') selected @endif>5.2</option>
							<option value="5.3" @if(Auth::user()->height == '5.3') selected @endif>5.3</option>
							<option value="5.4" @if(Auth::user()->height == '5.4') selected @endif>5.4</option>
							<option value="5.5" @if(Auth::user()->height == '5.5') selected @endif>5.5</option>
							<option value="5.6" @if(Auth::user()->height == '5.6') selected @endif>5.6</option>
							<option value="5.7" @if(Auth::user()->height == '5.7') selected @endif>5.7</option>
							<option value="5.8" @if(Auth::user()->height == '5.8') selected @endif>5.8</option>
							<option value="5.9" @if(Auth::user()->height == '5.9') selected @endif>5.9</option>
							<option value="6.0" @if(Auth::user()->height == '6.0') selected @endif>6.0</option>
							<option value="6.0+" @if(Auth::user()->height == '6.0+') selected @endif>6.0+</option>
						</select>
						<label>Height</label>
					</div>
					<div class="col-md-5 col-sm-6 col-xs-12">
						<select class="form-control" name="eyecolor">
							<option value="">Choose one</option>
							<option value="Blue" @if(Auth::user()->eyecolor == 'Blue') selected @endif>Blue</option>
							<option value="Brown" @if(Auth::user()->eyecolor == 'Brown') selected @endif>Brown</option>
							<option value="Green" @if(Auth::user()->eyecolor == 'Green') selected @endif>Green</option>
							<option value="Hazel" @if(Auth::user()->eyecolor == 'Hazel') selected @endif>Hazel</option>
							<option value="Other" @if(Auth::user()->eyecolor == 'Other') selected @endif>Other </option>
						</select>
						<label>Eye Color</label>
					</div>
					<div class="col-md-5 col-sm-6 col-xs-12">
						<select class="form-control" name="haircolor">
							<option value="">Choose one</option>
							<option value="Bald" @if(Auth::user()->haircolor == 'Bald') selected @endif>Bald</option>
							<option value="Black" @if(Auth::user()->haircolor == 'Black') selected @endif>Black</option>
							<option value="Blonde" @if(Auth::user()->haircolor == 'Blonde') selected @endif>Blonde</option>
							<option value="Brown" @if(Auth::user()->haircolor == 'Brown') selected @endif>Brown</option>
							<option value="Brunette" @if(Auth::user()->haircolor == 'Brunette') selected @endif>Brunette</option>
							<option value="Red" @if(Auth::user()->haircolor == 'Red') selected @endif>Red</option>
							<option value="Other" @if(Auth::user()->haircolor == 'Other') selected @endif>Other</option>
						</select>
						<label>Hair Color</label>
					</div>
					<div class="col-md-5 col-sm-6 col-xs-12">
						<select class="form-control" name="ethnicity">
							<option value="">Choose one</option>
							<option value="African American" @if(Auth::user()->ethnicity == 'African American') selected @endif>African American</option>
							<option value="Asian" @if(Auth::user()->ethnicity == 'Asian') selected @endif>Asian</option>
							<option value="Caucasian" @if(Auth::user()->ethnicity == 'Caucasian') selected @endif>Caucasian</option>
							<option value="European" @if(Auth::user()->ethnicity == 'European') selected @endif>European</option>
							<option value="Hispanic" @if(Auth::user()->ethnicity == 'Hispanic') selected @endif>Hispanic</option>
							<option value="Multiracial" @if(Auth::user()->ethnicity == 'Multiracial') selected @endif>Multiracial</option>
							<option value="Native American" @if(Auth::user()->ethnicity == 'Native American') selected @endif>Native American</option>
						</select>
						<label>Ethnicity</label>
					</div>
					<div class="col-md-5 col-sm-6 col-xs-12">
						<select class="form-control" name="language">
							<option value="">Choose one</option>
							<option value="Chinese" @if(Auth::user()->language == 'Chinese') selected @endif>Chinese</option>
							<option value="English" @if(Auth::user()->language == 'English') selected @endif>English </option>
							<option value="French" @if(Auth::user()->language == 'French') selected @endif>French </option>
							<option value="German" @if(Auth::user()->language == 'German') selected @endif>German</option>
							<option value="Hebrew" @if(Auth::user()->language == 'Hebrew') selected @endif>Hebrew</option>
							<option value="Hindi" @if(Auth::user()->language == 'Hindi') selected @endif>Hindi</option>
							<option value="Italian" @if(Auth::user()->language == 'Italian') selected @endif>Italian</option>
							<option value="Russian" @if(Auth::user()->language == 'Russian') selected @endif>Russian</option>
							<option value="Spanish" @if(Auth::user()->language == 'Spanish') selected @endif>Spanish</option>
							<option value="Other" @if(Auth::user()->language == 'Other') selected @endif>Other</option>
						</select>
						<label>Language</label>
					</div>
					<div class="col-md-5 col-sm-6 col-xs-12">
						<select class="form-control" name="religion">
							<option value="">Choose one</option>
							<option value="Buddhism" @if(Auth::user()->religion == 'Buddhism') selected @endif>Buddhism </option>
							<option value="Catholicism" @if(Auth::user()->religion == 'Catholicism') selected @endif>Catholicism  </option>
							<option value="Christianity" @if(Auth::user()->religion == 'Christianity') selected @endif>Christianity  </option>
							<option value="Hinduism" @if(Auth::user()->religion == 'Hinduism') selected @endif>Hinduism  </option>
							<option value="Islam" @if(Auth::user()->religion == 'Islam') selected @endif>Islam </option>
							<option value="Judaism" @if(Auth::user()->religion == 'Judaism') selected @endif>Judaism </option>
							<option value="New Age" @if(Auth::user()->religion == 'New Age') selected @endif>New Age</option>
							<option value="Other" @if(Auth::user()->religion == 'Other') selected @endif>Other</option>
						</select>
						<label>Relegion</label>
					</div>
					<div class="clearfix"></div>
					<hr>
					<div class="clearfix"></div>
					<h4>About My Match</h4>
					<div class="col-md-5 col-sm-6 col-xs-12" id="about_match">
						<select class="form-control" name="about_gender">
							<option value="">Choose one</option>
							<option value="Bi Male" @if(Auth::user()->about_gender == 'Bi Male') selected @endif>Bi Male</option>
							<option value="Bi Female" @if(Auth::user()->about_gender == 'Bi Female') selected @endif>Bi Female</option>
							<option value="Gay Male" @if(Auth::user()->about_gender == 'Gay Male') selected @endif>Gay Male</option>
							<option value="Gay Female" @if(Auth::user()->about_gender == 'Gay Female') selected @endif>Gay Female</option>
							<option value="Male" @if(Auth::user()->about_gender == 'Male') selected @endif>Straight Male</option>
							<option value="Female" @if(Auth::user()->about_gender == 'Female') selected @endif>Straight Female</option>
						</select>
						<label>Gender</label>
					</div>
					<div class="col-md-5 col-sm-6 col-xs-12">
						<select class="form-control" name="about_bodytype">
							<option value="">Choose one</option>
							<option value="Any" @if(Auth::user()->about_bodytype == 'Any') selected @endif>Any</option>
							<option value="Above Average" @if(Auth::user()->about_bodytype == 'Above Average') selected @endif>Above Average</option>
							<option value="Atheltic" @if(Auth::user()->about_bodytype == 'Atheltic') selected @endif>Atheltic </option>
							<option value="Average" @if(Auth::user()->about_bodytype == 'Average') selected @endif>Average </option>
							<option value="Full Figured" @if(Auth::user()->about_bodytype == 'Full Figured') selected @endif>Full Figured</option>
							<option value="Slender" @if(Auth::user()->about_bodytype == 'Slender') selected @endif>Slender</option>
						</select>
						<label>Body Type</label>
					</div>
					<div class="col-md-5 col-sm-6 col-xs-12">
						<select class="form-control" name="about_height">
							<option value="">Choose one</option>
							<option value="5.1" @if(Auth::user()->about_height == '5.1') selected @endif>5.1</option>
							<option value="5.2" @if(Auth::user()->about_height == '5.2') selected @endif>5.2</option>
							<option value="5.3" @if(Auth::user()->about_height == '5.3') selected @endif>5.3</option>
							<option value="5.4" @if(Auth::user()->about_height == '5.4') selected @endif>5.4</option>
							<option value="5.5" @if(Auth::user()->about_height == '5.5') selected @endif>5.5</option>
							<option value="5.6" @if(Auth::user()->about_height == '5.6') selected @endif>5.6</option>
							<option value="5.7" @if(Auth::user()->about_height == '5.7') selected @endif>5.7</option>
							<option value="5.8" @if(Auth::user()->about_height == '5.8') selected @endif>5.8</option>
							<option value="5.9" @if(Auth::user()->about_height == '5.9') selected @endif>5.9</option>
							<option value="6.0" @if(Auth::user()->about_height == '6.0') selected @endif>6.0</option>
							<option value="6.0+" @if(Auth::user()->about_height == '6.0+') selected @endif>6.0+</option>
						</select>
						<label>Height</label>
					</div>
					<div class="col-md-5 col-sm-6 col-xs-12">
						<select class="form-control" name="about_eyecolor">
							<option value="">Choose one</option>
							<option value="Any" @if(Auth::user()->about_eyecolor == 'Any') selected @endif>Any</option>
							<option value="Blue" @if(Auth::user()->about_eyecolor == 'Blue') selected @endif>Blue</option>
							<option value="Brown" @if(Auth::user()->about_eyecolor == 'Brown') selected @endif>Brown</option>
							<option value="Green" @if(Auth::user()->about_eyecolor == 'Green') selected @endif>Green</option>
							<option value="Hazel" @if(Auth::user()->about_eyecolor == 'Hazel') selected @endif>Hazel</option>
							<option value="Other" @if(Auth::user()->about_eyecolor == 'Other') selected @endif>Other </option>
						</select>
						<label>Eye Color</label>
					</div>
					<div class="col-md-5 col-sm-6 col-xs-12">
						<select class="form-control" name="about_haircolor">
							<option value="">Choose one</option>
							<option value="Any" @if(Auth::user()->about_haircolor == 'Any') selected @endif>Any</option>
							<option value="Bald" @if(Auth::user()->about_haircolor == 'Bald') selected @endif>Bald</option>
							<option value="Black" @if(Auth::user()->about_haircolor == 'Black') selected @endif>Black</option>
							<option value="Blonde" @if(Auth::user()->about_haircolor == 'Blonde') selected @endif>Blonde</option>
							<option value="Brown" @if(Auth::user()->about_haircolor == 'Brown') selected @endif>Brown</option>
							<option value="Brunette" @if(Auth::user()->about_haircolor == 'Brunette') selected @endif>Brunette</option>
							<option value="Red" @if(Auth::user()->about_haircolor == 'Red') selected @endif>Red</option>
							<option value="Other" @if(Auth::user()->about_haircolor == 'Other') selected @endif>Other</option>
						</select>
						<label>Hair Color</label>
					</div>
					<div class="col-md-5 col-sm-6 col-xs-12">
						<select class="form-control" name="about_ethnicity">
							<option value="">Choose one</option>
							<option value="African American" @if(Auth::user()->about_ethnicity == 'African American') selected @endif>African American</option>
							<option value="Asian" @if(Auth::user()->about_ethnicity == 'Asian') selected @endif>Asian</option>
							<option value="Caucasian" @if(Auth::user()->about_ethnicity == 'Caucasian') selected @endif>Caucasian</option>
							<option value="European" @if(Auth::user()->about_ethnicity == 'European') selected @endif>European</option>
							<option value="Hispanic" @if(Auth::user()->about_ethnicity == 'Hispanic') selected @endif>Hispanic</option>
							<option value="Multiracial" @if(Auth::user()->about_ethnicity == 'Multiracial') selected @endif>Multiracial</option>
							<option value="Native American" @if(Auth::user()->about_ethnicity == 'Native American') selected @endif>Native American</option>
						</select>
						<label>Ethnicity</label>
					</div>
					<div class="col-md-5 col-sm-6 col-xs-12">
						<select class="form-control" name="about_language">
							<option value="">Choose one</option>
							<option value="Chinese" @if(Auth::user()->about_language == 'Chinese') selected @endif>Chinese</option>
							<option value="English" @if(Auth::user()->about_language == 'English') selected @endif>English </option>
							<option value="French" @if(Auth::user()->about_language == 'French') selected @endif>French </option>
							<option value="German" @if(Auth::user()->about_language == 'German') selected @endif>German</option>
							<option value="Hebrew" @if(Auth::user()->about_language == 'Hebrew') selected @endif>Hebrew</option>
							<option value="Hindi" @if(Auth::user()->about_language == 'Hindi') selected @endif>Hindi</option>
							<option value="Italian" @if(Auth::user()->about_language == 'Italian') selected @endif>Italian</option>
							<option value="Russian" @if(Auth::user()->about_language == 'Russian') selected @endif>Russian</option>
							<option value="Spanish" @if(Auth::user()->about_language == 'Spanish') selected @endif>Spanish</option>
							<option value="Other" @if(Auth::user()->about_language == 'Other') selected @endif>Other</option>
						</select>
						<label>Language</label>
					</div>
					<div class="col-md-5 col-sm-6 col-xs-12">
						<select class="form-control" name="about_religion">
							<option value="">Choose one</option>
							<option value="Any" @if(Auth::user()->about_religion == 'Any') selected @endif>Any </option>
							<option value="Buddhism" @if(Auth::user()->about_religion == 'Buddhism') selected @endif>Buddhism </option>
							<option value="Catholicism" @if(Auth::user()->about_religion == 'Catholicism') selected @endif>Catholicism  </option>
							<option value="Christianity" @if(Auth::user()->about_religion == 'Christianity') selected @endif>Christianity  </option>
							<option value="Hinduism" @if(Auth::user()->about_religion == 'Hinduism') selected @endif>Hinduism  </option>
							<option value="Islam" @if(Auth::user()->about_religion == 'Islam') selected @endif>Islam </option>
							<option value="Judaism" @if(Auth::user()->about_religion == 'Judaism') selected @endif>Judaism </option>
							<option value="New Age" @if(Auth::user()->about_religion == 'New Age') selected @endif>New Age</option>
							<option value="Other" @if(Auth::user()->about_religion == 'Other') selected @endif>Other</option>
						</select>
						<label>Relegion</label>
					</div>
					<div class="clearfix"></div>
					<hr>
					<div class="clearfix"></div>
					<div class="col-md-5 col-sm-6 col-xs-12">
						<h4>What state did you grow up in?</h4>
						<select class="form-control" name="state">
							<option value="">Select State</option>
							@foreach($states as $state)
							<option value="{{ $state->zstate }}" @if(Auth::user()->state == $state->zstate) selected @endif>{{ $state->nstate }}</option>
							@endforeach
						</select>
					</div>
					<div class="col-md-5 col-sm-6 col-xs-12">
						<h4>I Live In</h4>
						<select class="form-control" name="live_in">
							<option value="">Select State</option>
							@foreach($states as $state)
							<option value="{{ $state->zstate }}" @if(Auth::user()->live_in == $state->zstate) selected @endif>{{ $state->nstate }}</option>
							@endforeach
						</select>
					</div>
					<div class="clearfix"></div>
					<hr>
					<div class="clearfix"></div>
					<h4>Activities</h4>
					<?php 
					$activity = explode(",",Auth::user()->activity);
					$activity_selected=array_map('trim',$activity);
					//echo "<pre>";print_r($activity_selected);
					//echo "<pre>";print_r($activities);die;

					$count = count($activities);
					$div_str = floor($count/3);
					?>
					<div class="col-md-4 col-sm-4 col-sm-12" id="activity">
						<?php
							$counter = 1;
							$i = 1;
							foreach ($activities as $activity) {
								if(in_array("$activity->activity_name",$activity_selected)){
									$checked = 'checked';
								}else{
									$checked ='';
								}
							 ?>

							<div><input type="checkbox" name="activities" value="{{$activity->activity_name}}" <?php echo $checked; ?> > <label>{{$activity->activity_name}}</label></div>

						<?php
									
								if($counter==($div_str*$i)){
									?>
									</div>
									<div class="col-md-4 col-sm-4 col-sm-12">
									<?php
									$i++;
								}

								$counter++;
							}
						?>
					</div>
					
					<div class="col-md-12">
						<div class="from-group">
							<textarea class="form-control" id="activities" name="activity">{{ Auth::user()->activity }}</textarea>
						</div>
					</div>
					<div class="clearfix"></div>
					<hr>
					<div class="clearfix"></div>
					<h4>Types of Relationship</h4>
					<?php 
					$relations_type = explode(",",Auth::user()->type_of_relationship);
					$relations_type=array_map('trim',$relations_type);
					?>
					<div class="col-md-4 col-sm-4 col-xs-12" id="type_of_relationship">
						<div><input type="checkbox" name="relations_type" @if(in_array("Activity Partner", $relations_type)) checked @endif value="Activity Partner"> <label>Activity Partner</label></div>
						<div><input type="checkbox" name="relations_type" @if(in_array("Friendship", $relations_type)) checked @endif value="Friendship"> <label>Friendship</label></div>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12">
						<div><input type="checkbox" name="relations_type" @if(in_array("Marriage", $relations_type)) checked @endif value="Marriage"> <label>Marriage</label></div>
						<div><input type="checkbox" name="relations_type" @if(in_array("Pen Pal", $relations_type)) checked @endif value="Pen Pal"> <label>Pen Pal </label></div>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12">
						<div><input type="checkbox" name="relations_type" @if(in_array("Romance", $relations_type)) checked @endif value="Romance"> <label>Romance</label></div>
						<div><input type="checkbox" name="relations_type" @if(in_array("Travel Partner", $relations_type)) checked @endif value="Travel Partner"> <label>Travel Partner</label></div>
					</div>
					<div class="col-md-12">
						<div class="from-group">
							<textarea class="form-control" name="type_of_relationship" id="relations_type">{{ Auth::user()->type_of_relationship }}</textarea>
						</div>
					</div>
					<div class="clearfix"></div>
					<hr>
					<div class="clearfix"></div>
					<h4>Horoscope Sign</h4>
					
					<div class="col-md-5 col-sm-6 col-xs-12">
						<select class="form-control" name="western_sign">
							{{-- <option value="">Choose one</option> --}}
							<option value="Aries" @if(Auth::user()->western_sign == 'Aries') selected @endif>Aries </option>
							<option value="Aquarius" @if(Auth::user()->western_sign == 'Aquarius') selected @endif>Aquarius</option>
							<option value="Cancer" @if(Auth::user()->western_sign == 'Cancer') selected @endif>Cancer</option>
							<option value="Capricorn" @if(Auth::user()->western_sign == 'Capricorn') selected @endif>Capricorn</option>
							<option value="Gemini" @if(Auth::user()->western_sign == 'Gemini') selected @endif>Gemini</option>
							<option value="Leo" @if(Auth::user()->western_sign == 'Leo') selected @endif>Leo</option>
							<option value="Libra" @if(Auth::user()->western_sign == 'Libra') selected @endif>Libra</option>
							<option value="Pisces" @if(Auth::user()->western_sign == 'Pisces') selected @endif>Pisces</option>
							<option value="Sagittarius" @if(Auth::user()->western_sign == 'Sagittarius') selected @endif>Sagittarius</option>
							<option value="Scorpio" @if(Auth::user()->western_sign == 'Scorpio') selected @endif>Scorpio</option>
							<option value="Taurus" @if(Auth::user()->western_sign == 'Taurus') selected @endif>Taurus</option>
							<option value="Virgo" @if(Auth::user()->western_sign == 'Virgo') selected @endif>Virgo</option>
						</select>
						<label>Western Sign</label>
					</div>
					<div class="col-md-5 col-sm-6 col-xs-12" id="horoscope">
						<select class="form-control" name="chinese_sign">
							{{-- <option value="">Choose one</option> --}}
							<option value="Dog" @if(Auth::user()->chinese_sign == 'Dog') selected @endif>Dog </option>
							<option value="Dragon" @if(Auth::user()->chinese_sign == 'Dragon') selected @endif>Dragon </option>
							<option value="Goat" @if(Auth::user()->chinese_sign == 'Goat') selected @endif>Goat </option>
							<option value="Horse" @if(Auth::user()->chinese_sign == 'Horse') selected @endif>Horse</option>
							<option value="Monkey" @if(Auth::user()->chinese_sign == 'Monkey') selected @endif>Monkey</option>
							<option value="Ox" @if(Auth::user()->chinese_sign == 'Ox') selected @endif>Ox</option>
							<option value="Pig" @if(Auth::user()->chinese_sign == 'Pig') selected @endif>Pig</option>
							<option value="Rabbit" @if(Auth::user()->chinese_sign == 'Rabbit') selected @endif>Rabbit </option>
							<option value="Rat" @if(Auth::user()->chinese_sign == 'Rat') selected @endif>Rat </option>
							<option value="Rooster" @if(Auth::user()->chinese_sign == 'Rooster') selected @endif>Rooster </option>
							<option value="Snake" @if(Auth::user()->chinese_sign == 'Snake') selected @endif>Snake</option>
							<option value="Tiger" @if(Auth::user()->chinese_sign == 'Tiger') selected @endif>Tiger  </option>
						</select>
						<label>Chinese Sign</label>
					</div>
					<div class="clearfix"></div>
					<hr>
					<div class="clearfix"></div>
					<h4>Cafe Location</h4>
					<div class="col-md-5 col-sm-6 col-xs-12">
						<input type="hidden" value="{{ Auth::user()->cafe }}" name="cafe" id="search-cafe"> 
						@if(Auth::user()->cafe)
						<input type="text" value="{{ Auth::user()->cafe }}" class="form-control" id="search-box" autocomplete="off">
						@else
						<input type="text" value="" class="form-control" id="search-box" autocomplete="off">
						@endif
						<div id="suggesstion-box"></div>
					</div>
					<div class="clearfix"></div>
					<hr>
					<div class="clearfix"></div>
					<div class="col-sm-12 text-center">
						<input type="hidden" name="actg" value="go2">
						<input name="submit" class="btn custom-btn acc-submit" type="submit" value="Save">
					</div>
				</form>
			</div>
		</div>
	</div>

</div>

@endsection