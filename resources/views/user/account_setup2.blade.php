@extends('layouts.app') @section('content')
<style>
.pd-none
{
	margin-bottom:60px;
}
</style>
<div class="wrapper-cl" id="profile-page">
	<div class="container-cl">
		<div class="row">
			<div class="col-md-10 col-md-offset-1 col-sm-12 col-xs-12 full_dashboard">
				<div class="block-al">
					<div class="col-md-10 pd-none col-md-offset-1">
						<div class="forms-in">
							<div class="block-cl block-new-register col-md-12">
								<form method="post" action="{{ url('/user/profile-update') }}" enctype="multipart/form-data">
									@csrf
									<div class="process">
										<div class="process-row nav nav-tabs">
											<div class="process-step active">
												<button type="button" class="btn btn-info btn-circle" data-toggle="tab" href="#dob">1</button>
												<p>Date of Birthday</p>
											</div>
											<div class="process-step">
												<button type="button" disabled class="btn btn-default btn-circle looking" data-toggle="tab" href="#looking_to_date" >2</button>
												<p>Looking to Date</p>
											</div>
											<div class="process-step">
												<button type="button" disabled class="btn btn-default btn-circle" data-toggle="tab" href="#about_me">3</button>
												<p>About Me</p>
											</div>
											<div class="process-step">
												<button type="button" disabled class="btn btn-default btn-circle" data-toggle="tab" href="#about_match">4</button>
												<p>About My Match</p>
											</div>
											<div class="process-step">
												<button type="button" disabled class="btn btn-default btn-circle" data-toggle="tab" href="#where_live_in">5</button>
												<p>What state did you grow up in?</p>
											</div>
											<div class="process-step">
												<button type="button" disabled class="btn btn-default btn-circle" data-toggle="tab" href="#menuactivities">6</button>
												<p>My Interests</p>
											</div>
											<div class="process-step">
												<button type="button" disabled class="btn btn-default btn-circle" data-toggle="tab" href="#matchInterest">7</button>
												<p>My Match Interests</p>
											</div>
											<div class="process-step">
												<button type="button" disabled class="btn btn-default btn-circle" data-toggle="tab" href="#type_of_relationship">8</button>
												<p>Types of Relationship</p>
											</div>
											<div class="process-step">
												<button type="button" disabled class="btn btn-default btn-circle" data-toggle="tab" href="#horoscope">9</button>
												<p>Horoscope Sign</p>
											</div>
											<div class="process-step">
												<button type="button" disabled class="btn btn-default btn-circle" data-toggle="tab" href="#menu7">10</button>
												<p>Cafe Location</p>
											</div>
											<div class="process-step">
												<button type="button" disabled class="btn btn-default btn-circle" data-toggle="tab" href="#imageUpload">11</button>
												<p>Image Upload</p>
											</div>
										</div>
									</div>
									<div class="tab-content">
										<div id="dob" class="tab-pane fade active in">
										
											<div class="col-md-3 col-sm-4 col-xs-12">
												<h4>First Name</h4>

												<input type="hidden" name="month" value="{{Auth::user()->month}}">
												<!-- <select class="form-control" name="month">
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
												</select> -->
												<input type="text" maxlength="25" onkeypress="return validateChar(event);" placeholder ="Enter name" class="form-control user_name" name="firstname" id="firstname">
												<p style="color:red" class="error_firstname"></p>
											</div>
											<div class="col-md-3 col-sm-4 col-xs-12">
													<h4>Last Name</h4>

												<input type="hidden" name="day" value="{{Auth::user()->day}}">
												<!-- <select class="form-control" name="day" required>
													@for($day = 1; $day < 31; $day++)
													<option @if(Auth::user()->day == $day) selected @endif>{{ $day }}</option>
													@endfor
												</select> -->

												<input type="text" maxlength="25" onkeypress="return validateChar(event);" 	 placeholder ="Enter name" class="form-control user_name" name="lastname" id="lastname">
												<p style="color:red" class="error_lastname"></p>
											</div>
											<!-- <?php $year_value = '';$curr_year = Carbon\Carbon::now()->format('Y'); ?>
												@for($year = 1939; $year <= $curr_year; $year++)
													 @if(Auth::user()->year == $year)
													 $year_value = $year;
													 @endif 
												@endfor
											?> -->
											<input type="hidden" name="year" value="{{Auth::user()->year}}">

											<!--  <div class="col-md-3 col-sm-4 col-xs-12">
												<select class="form-control" name="year">
													<?php $curr_year = Carbon\Carbon::now()->format('Y'); ?>
													@for($year = 1939; $year <= $curr_year; $year++)
													<option @if(Auth::user()->year == $year) selected @endif>{{ $year }}</option>
													@endfor
												</select>
											</div>  -->

											<div class="clearfix"></div>
											<ul class="list-unstyled list-inline">
												<li><button type="button" class="btn cafe-submit next-step" data-toggle="tab" href="#looking_to_date">Next <i class="fa fa-chevron-right"></i></button></li>
											</ul>
										</div>
										<div id="looking_to_date" class="tab-pane fade">
											<h4>Looking to Date</h4>
											<?php 
											$looking_for = explode(",",Auth::user()->looking_for);
											$looking_for=array_map('trim',$looking_for);
											?>
											<div class="col-md-4 col-sm-4 col-xs-12" id="">
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
											<ul class="list-unstyled list-inline">
												<li><button type="button" class="btn cafe-submit prev-step" data-toggle="tab" href="#dob"><i class="fa fa-chevron-left"></i> Back</button></li>
												<li><button type="button" class="btn cafe-submit next-step" data-toggle="tab" href="#about_me">Next <i class="fa fa-chevron-right"></i></button></li>
											</ul>
										</div>
										<div id="about_me" class="tab-pane fade">
											<h4>About Me</h4>
											<div class="col-md-5 col-sm-6 col-xs-12" id="about_me">
												<select class="form-control" name="sex" required>
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
													<option value="All" @if(Auth::user()->eyecolor == 'All') selected @endif>All </option>
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
													<option value="All" @if(Auth::user()->haircolor == 'All') selected @endif>All</option>
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
													<option value="All" @if(Auth::user()->language == 'All') selected @endif>All</option>
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
													<option value="All" @if(Auth::user()->religion == 'All') selected @endif>All</option>
												</select>
												<label>Religion</label>
											</div>

											<div class="clearfix"></div>

											<ul class="list-unstyled list-inline">
												<li><button type="button" class="btn cafe-submit prev-step" data-toggle="tab" href="#looking_to_date"><i class="fa fa-chevron-left"></i> Back</button></li>
												<li><button type="button" class="btn cafe-submit next-step" data-toggle="tab" href="#about_match">Next <i class="fa fa-chevron-right"></i></button></li>
											</ul>
										</div>
										<div id="about_match" class="tab-pane fade">
											<h4>About My Match</h4>
											<div class="col-md-5 col-sm-6 col-xs-12">
												<select class="form-control" name="about_eyecolor">
													<option value="">Choose one</option>
													<option value="Any" @if(Auth::user()->about_eyecolor == 'Any') selected @endif>Any</option>
													<option value="Blue" @if(Auth::user()->about_eyecolor == 'Blue') selected @endif>Blue</option>
													<option value="Brown" @if(Auth::user()->about_eyecolor == 'Brown') selected @endif>Brown</option>
													<option value="Green" @if(Auth::user()->about_eyecolor == 'Green') selected @endif>Green</option>
													<option value="Hazel" @if(Auth::user()->about_eyecolor == 'Hazel') selected @endif>Hazel</option>
													<option value="All" @if(Auth::user()->about_eyecolor == 'All') selected @endif>All </option>
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
													<option value="All" @if(Auth::user()->about_haircolor == 'All') selected @endif>All</option>
												</select>
												<label>Hair Color</label>
											</div>
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
													<!-- <option value="Any" @if(Auth::user()->about_bodytype == 'Any') selected @endif>Any</option> -->
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
													<option value="All" @if(Auth::user()->about_language == 'All') selected @endif>All</option>
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
													<option value="All" @if(Auth::user()->about_religion == 'All') selected @endif>All</option>
												</select>
												<label>Religion</label>
											</div>
											<div class="clearfix"></div>
											<ul class="list-unstyled list-inline">
												<li><button type="button" class="btn cafe-submit prev-step" data-toggle="tab" href="#about_me"><i class="fa fa-chevron-left"></i> Back</button></li>
												<li><button type="button" class="btn cafe-submit next-step" data-toggle="tab" href="#where_live_in">Next <i class="fa fa-chevron-right"></i></button></li>
											</ul>
										</div>
										<div id="where_live_in" class="tab-pane fade">
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
											<ul class="list-unstyled list-inline">
												<li><button type="button" class="btn cafe-submit prev-step" data-toggle="tab" href="#about_match"><i class="fa fa-chevron-left"></i> Back</button></li>
												<li><button type="button" class="btn cafe-submit next-step" data-toggle="tab" href="#menuactivities">Next <i class="fa fa-chevron-right"></i></button></li>
											</ul>
										</div>
										<div id="menuactivities" class="tab-pane fade">
											<h4>My Interests</h4>
											<?php 
											$activity = explode(",",Auth::user()->activity);
											$activity_selected=array_map('trim',$activity);
											$count = count($activities);
											$div_str = floor($count/3);
											?>
											<div class="col-md-4 col-sm-4 col-sm-12" id="activity">
											<?php
												$counter = 1;
												$i = 1;
												foreach ($activities as $activity) { ?>

												<div><input type="checkbox" name="activities" @if(in_array("{{$activity->activity_name}}", $activity_selected)) checked @endif value="{{$activity->activity_name}}"> <label>{{$activity->activity_name}}</label></div>

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
													<textarea class="form-control" id="activities" name="activity" readonly>{{ Auth::user()->activity }}</textarea>
												</div>
											</div>
											<div class="clearfix"></div>
											<ul class="list-unstyled list-inline">
												<li><button type="button" class="btn cafe-submit prev-step" data-toggle="tab" href="#where_live_in"><i class="fa fa-chevron-left"></i> Back</button></li>
												<li><button type="button" class="btn cafe-submit next-step" data-toggle="tab" href="#matchInterest">Next <i class="fa fa-chevron-right"></i></button></li>
											</ul>
										</div>
										<div id="matchInterest" class="tab-pane fade">
											<h4>My Match Interests</h4>
											<?php 
											$matchInterest = explode(",",Auth::user()->matchInterest);
											$matchInterest_selected=array_map('trim',$matchInterest);
											$count = count($activities);
											$div_str = floor($count/3);
											?>
											<div class="col-md-4 col-sm-4 col-sm-12" id="activity">
											<?php
												$counter = 1;
												$i = 1;
												foreach ($activities as $activity) { ?>

												<div><input type="checkbox" name="matchInterests" @if(in_array("{{$activity->activity_name}}", $matchInterest_selected)) checked @endif value="{{$activity->activity_name}}"> <label>{{$activity->activity_name}}</label></div>

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
													<textarea class="form-control" id="matchInterests" name="matchInterest" readonly>{{ Auth::user()->matchInterest }}</textarea>
												</div>
											</div>
											<div class="clearfix"></div>
											<ul class="list-unstyled list-inline">
												<li><button type="button" class="btn cafe-submit prev-step" data-toggle="tab" href="#menuactivities"><i class="fa fa-chevron-left"></i> Back</button></li>
												<li><button type="button" class="btn cafe-submit next-step" data-toggle="tab" href="#type_of_relationship">Next <i class="fa fa-chevron-right"></i></button></li>
											</ul>
										</div>
										<div id="type_of_relationship" class="tab-pane fade">
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
													<textarea class="form-control" name="type_of_relationship" id="relations_type" readonly>{{ Auth::user()->type_of_relationship }}</textarea>
												</div>
											</div>
											<div class="clearfix"></div>
											<ul class="list-unstyled list-inline">
												<li><button type="button" class="btn cafe-submit prev-step" data-toggle="tab" href="#matchInterest"><i class="fa fa-chevron-left"></i> Back</button></li>
												<li><button type="button" class="btn cafe-submit next-step" data-toggle="tab" href="#horoscope">Next <i class="fa fa-chevron-right"></i></button></li>
											</ul>
										</div>
										<div id="horoscope" class="tab-pane fade">
											<h4>Horoscope Sign</h4>
											
											<div class="col-md-5 col-sm-6 col-xs-12">
												<select class="form-control" name="western_sign">
													<option value="">Choose one</option>
													
													<option value="Aries" @if($zodic=='Aries') selected @endif>Aries </option>
													
													<option value="Aquarius" @if($zodic=='Aquarius') selected @endif>Aquarius</option>
													
													<option value="Cancer" @if($zodic=='Cancer') selected @endif>Cancer</option>
													
													<option value="Capricorn" @if($zodic=='Capricorn') selected @endif>Capricorn</option>
													
													<option value="Gemini" @if($zodic=='Gemini') selected @endif>Gemini</option>
													
													<option value="Leo" @if($zodic=='Leo') selected @endif>Leo</option>
													
													<option value="Libra" @if($zodic=='Libra') selected @endif>Libra</option>
													
													<option value="Pisces" @if($zodic=='Pisces') selected @endif>Pisces</option>
													
													<option value="Sagittarius" @if($zodic=='Sagittarius') selected @endif>Sagittarius</option>
													
													<option value="Scorpio" @if($zodic=='Scorpio') selected @endif>Scorpio</option>
													
													<option value="Taurus" @if($zodic=='Taurus') selected @endif>Taurus</option>
													
													<option value="Virgo" @if($zodic=='Virgo') selected @endif>Virgo</option>
												</select>
												<label>Western Sign</label>
											</div>
											<div class="col-md-5 col-sm-6 col-xs-12" id="horoscope">
												<select class="form-control" name="chinese_sign">
													<option value="">Choose one</option>
													<option value="Dog" @if((Auth::user()->year%12==2)) selected @endif>Dog </option>
													<option value="Dragon" @if((Auth::user()->year%12==8)) selected @endif>Dragon </option>
													<option value="Goat" @if((Auth::user()->year%12==11)) selected @endif>Goat </option>
													<option value="Horse" @if((Auth::user()->year%12==10)) selected @endif>Horse</option>
													<option value="Monkey" @if((Auth::user()->year%12==0)) selected @endif>Monkey</option>
													<option value="Ox" @if((Auth::user()->year%12==5)) selected @endif>Ox</option>
													<option value="Pig" @if((Auth::user()->year%12==3)) selected @endif>Pig</option>
													<option value="Rabbit" @if((Auth::user()->year%12==7)) selected @endif>Rabbit </option>
													<option value="Rat" @if((Auth::user()->year%12==4)) selected @endif>Rat </option>
													<option value="Rooster" @if((Auth::user()->year%12==1)) selected @endif>Rooster </option>
													<option value="Snake" @if((Auth::user()->year%12==9)) selected @endif>Snake</option>
													<option value="Tiger" @if((Auth::user()->year%12==6)) selected @endif>Tiger  </option>
												</select>
												<label>Chinese Sign</label>
											</div>
											<div class="clearfix"></div>
											<ul class="list-unstyled list-inline">
												<li><button type="button" class="btn cafe-submit prev-step" data-toggle="tab" href="#type_of_relationship"><i class="fa fa-chevron-left"></i> Back</button></li>
												<li><button type="button" class="btn cafe-submit next-step" data-toggle="tab" href="#menu7">Next <i class="fa fa-chevron-right"></i></button></li>
											</ul>
										</div>
										 <div id="menu7" class="tab-pane fade">
											<h4>Cafe Location</h4>
											<div class="col-md-5 col-sm-6 col-xs-12" style="margin-top: 6px;">
												<input type="hidden" value="create_account" name="create_account"> 
												<input type="hidden" value="{{ Auth::user()->cafe }}" name="cafe" id="cafe-input-hidden"> 

												
												<input type="text" value="{{ Auth::user()->cafe }}" class="form-control" id="cafe-input" name="zip" autocomplete="off" placeholder="Enter Zip Code" maxlength="5" onkeypress='return validateQty(event);'>
												<p style="color:red" class="error_msgee"></p>

												<span class="cus-colr">(Choose location closest to your house)</span>	
												<div id="suggesstion-box"></div>

											</div>
											<!-- <div class="col-md-2 col-sm-6 col-xs-12">
												<button class="btn cafe-submit" id="get-cafe-loc">Submit</button>
											</div> -->
											<div class="clearfix"></div>
											<div class="col-md-12" style="margin-top: 10px;">
												<div class="location-wrap">
													
												</div>
												<p style="color:red" class="error_msge"></p>
											</div>
											<!-- <div class="col-md-12" style="margin-top: 10px;">
												<div id="map_wrapper">
													<div id="map_canvas" class="mapping"></div>
												</div>
											</div> -->

											<!-- <div class="col-md-12" style="margin-top: 10px;" id="selected-locations">
												<h3>Selected Location:</h3>
												<div id="selected-area"></div>
											</div> -->

											<div class="clearfix"></div>
											<ul class="list-unstyled list-inline">
												<li><button type="button" class="btn cafe-submit prev-step" data-toggle="tab" href="#horoscope"><i class="fa fa-chevron-left"></i> Back</button></li>
												<li><button type="button" class="btn cafe-submit next-step" data-toggle="tab" href="#imageUpload"> Next <i class="fa fa-chevron-right"></i></button></li>
											</ul>
										</div>
										<div id="imageUpload" class="tab-pane fade">
											<div class="account-section" id="change-photo">
												<div class="col-md-12">
													<div class="profile-box profile-box-1 image-editor">
														<div class="row">
															<div style="margin-bottom:10px" class="col-sm-4 col-sm-offset-4 image-area">
																@if(Auth::user()->image)
																<img src='{{ url('public/img').'/'.Auth::user()->image }}'class="uploaded_image">
																@else
																<img  class="uploaded_image"src="{{ url('/public/img/profile1.png')}}">
																@endif 
																<div class="loader-image loader" style="display: none;">
																	<img src="{{ url('/public/img/lg.ajax-spinner-gif.gif')}}">
																</div>  
															</div>
															<div class="col-sm-4 col-sm-offset-4">
																	<!-- {{-- <div class="cropit-preview"></div> --}} -->
																<div class="top-section">
																	<span style="display:none"><input type="file" class=" form-control" name="image" style="height: unset" id="image"></span>
																	<!--  {{-- <input type="file" name="image" id="image" class="form-control cropit-image-input" placeholder="Upload Profile Image" style="height: unset;"> --}} -->
																</div>

																<div style="text-align:center" class="buttonparent">
																	<input style="background-color:#0071e0;" type="button" class="btn btn-primary" onclick="document.getElementById('image').click()" id="btn1" value ="Select a photo from your computer">
																</div>


																<div class="btn-area pull-right">
																	{{-- <input class="btn custom-btn acc-submit" type="submit" value="Upload" id="save-image"> --}}
																</div>
																<div class="red-span-error" id="image_error" style="margin-top: 5px;">
																	<strong>@if ($errors->has('image')){{ $errors->first('image') }}@endif</strong>
																</div>   
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="clearfix"></div>
											<ul class="list-unstyled list-inline">
												<li><button type="button" class="btn cafe-submit prev-step" data-toggle="tab" href="#menu7"><i class="fa fa-chevron-left"></i> Back</button></li>
												<li><button type="submit" class="btn cafe-submit"><i class="fa fa-check"></i> Done!</button></li>
											</ul>
										</div>

									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<style>
	#selected-locations {
		display: none;
	}
	#selected-locations .text{
		text-decoration: underline;
	}
	#selected-area h3 {
		color: #797979;
		font-size: 18px;
	}
    #imageUpload .cropit-preview {
        background-size: cover;
        margin-top: 7px;
        width: 250px;
        height: 250px;
        padding: 0px;
      }

      .image-area.cropit-preview > img {
		    width: 100%;
		    height: 100%;
		    max-height: unset;
		}

      #imageUpload .cropit-preview-image-container {
        cursor: move;
      }

      #imageUpload .image-size-label {
        margin-top: 10px;
      }


      #imageUpload img.cropit-preview-image {
	    width: 100%;
	    height: 100%;
	    transform: none !important;
	    max-height: unset;
	}
	/* #map_wrapper {
		height: 500px;
	} */

	#map_canvas {
		width: 100%;
		height: 100%;
	}
	#search-cafe-result li {
		cursor: pointer;
	}
	.location{
		margin-right: 5px !important;
	}
	.cus-colr{
	    color: #2895f1;
	}
</style>
<script type="text/javascript">
function validateQty(event) {
		    var key = window.event ? event.keyCode : event.which;
			if (event.keyCode == 8 || event.keyCode == 46
			 || event.keyCode == 37 || event.keyCode == 39) {
			    return true;
			}
			else if ( key < 48 || key > 57 ) {
			    return false;
			}
			else return true;
		};

function validateChar(event) {
		    var key = window.event ? event.keyCode : event.which;
			if (event.keyCode == 8 || event.keyCode == 9) {
			    return true;
			}
			else if (( key < 65 || key > 90 ) && (key < 97 || key > 122)) {
			    return false;
			}
			else return true;
		};

   jQuery(document).ready(function() {
      jQuery('#save-image').click(function(e) {
         e.preventDefault();
         var img = jQuery('#image').val();
         var token = jQuery('#change-photo input[name="_token"]').val();
         if(img == '') {
            jQuery('#image_error strong').text('Please upload image');
         } else if(!img.match(/.(jpg|jpeg|png|gif)$/i)) {
         	jQuery('#image').val('');
            jQuery('#image_error strong').text('Please upload only jpg,jpeg,png file');
         } else {
            jQuery('#image_error strong').text('');
         }
      });

      jQuery('.user_name').keypress(function(){
      		if(jQuery('#lastname').val()!='' && jQuery('#firstname').val()!=''){
      		 	$('.error_firstname').html('');
      		 	$('.error_lastname').html('');
      			jQuery('#dob .next-step').removeAttr('disabled');
      		}
    		
    	});
    
      jQuery('#firstname').keypress(function(e){
      	$('.error_firstname').html('');
      });

       jQuery('#lastname').keypress(function(e){
      	$('.error_lastname').html('');
      })

       jQuery('#looking_to_date .next-step').on('click',function(e){
       	jQuery('#looking_to_date').hide();

       })

       jQuery('#looking_to_date .prev-step').on('click',function(e){
       	jQuery('#looking_to_date').hide();

       })

       jQuery('#about_me .prev-step').on('click',function(e){
       	jQuery('#looking_to_date').show();

       })

       jQuery('.btn-circle').on('click',function(e){
       	if($(this).hasClass('looking')){
       		jQuery('#looking_to_date').show();
       	}else{
       		jQuery('#looking_to_date').hide();
       	}

       })
  
      jQuery('.next-step').on('click',function(e){
      	if(jQuery('#dob').hasClass('active')){
      		if(jQuery('#firstname').val()==''){
      			var id = jQuery(this).attr('href');
      			jQuery('.error_firstname').html('Please enter first name');
      			jQuery('#looking_to_date').hide();
      			jQuery('.process-step [href="#dob"]').tab('show');
      			jQuery('.process-step button').removeClass('btn-info').addClass('btn-default');
				jQuery('.process-step [href="#dob"]').addClass('btn-info').removeClass('btn-default');
				jQuery('.process-step [href="'+id+'"]').attr('disabled','disabled');
				jQuery('#dob .next-step').attr('disabled','disabled');
      		}

      		if(jQuery('#lastname').val()==''){
      			var id = jQuery(this).attr('href');
      			jQuery('.error_lastname').html('Please enter last name');
      			jQuery('#looking_to_date').hide();
      			jQuery('.process-step [href="#dob"]').tab('show');
      			jQuery('.process-step button').removeClass('btn-info').addClass('btn-default');
				jQuery('.process-step [href="#dob"]').addClass('btn-info').removeClass('btn-default');
				jQuery('.process-step [href="'+id+'"]').attr('disabled','disabled');
				jQuery('#dob .next-step').attr('disabled','disabled');
      		}
      		
      		if(jQuery('#lastname').val()!='' && jQuery('#firstname').val()!=''){
      			 jQuery('#looking_to_date').show();

      		}
      		
      	 }
      	
      });
      

      jQuery('#cafe-input').keypress(function(){
 			jQuery('.error_msgee').text('');
		});

 		jQuery('#cafe-input').keypress(function(){
    		$('#menu7 .next-step').prop('disabled', true);
    	});

    	

      jQuery('.next-step').on('click',function(e){
      	if(jQuery('#menu7').hasClass('active')){
      		if(jQuery('#cafe-input').val()==''){
      			var id = jQuery(this).attr('href');
      			jQuery('.error_msgee').html('Please enter zip code');
      			jQuery('.error_msge').html('');
      			jQuery('.process-step button').removeClass('btn-info').addClass('btn-default');
				jQuery('.process-step [href="#menu7"]').addClass('btn-info').removeClass('btn-default');
				jQuery('.process-step [href="'+id+'"]').attr('disabled','disabled');
				jQuery('.process-step [href="#menu7"]').tab('show');
				jQuery('#imageUpload').hide();
				return false;
      		}else{
      			if(jQuery('.location').is(":checked")==false)
      			{
      				jQuery('.error_msge').html('Please select radio button');
      				jQuery('.error_msgee').html('');
	      			jQuery('.process-step button').removeClass('btn-info').addClass('btn-default');
					jQuery('.process-step [href="#menu7"]').addClass('btn-info').removeClass('btn-default');
					jQuery('.process-step [href="#menu7"]').removeAttr('disabled');
					jQuery('.process-step [href="#menu7"]').tab('show');
					jQuery('#imageUpload').hide();
					jQuery('#imageUpload').removeClass('active');
					jQuery('#menu7').addClass('active');
      			}
      			else
      			{
      				jQuery('#menu7').removeClass('active');
					jQuery('#imageUpload').addClass('active');
      				jQuery('#imageUpload').show();
	      			return true;
      			}
      		}
      	}
      })

      var error = '';
      jQuery('#cafe-input').keypress(function(event) {
		
      	var cafe = jQuery(this).val()+''+event.key;
      	if(cafe.trim()!='' && cafe.length==5){
	      	jQuery.ajax({
	      		type: "GET",
	      		url: "{{ url('/user/cafe-members') }}?cafe_location="+cafe+'&create_account=true',
	      		/*beforeSend: function(){
	      			jQuery('#map_wrapper').css('height','500px');
	      			jQuery("#map_wrapper").css("background","#FFF url({{ url('public/img/LoaderIcon.gif') }}) no-repeat 165px");
	      		},*/
	      		success: function(data){
	      			console.log(data);
	      			if(data!=null) {
	      				var location ="";
	      				var iframe = '';
	      				if(data.length>0){
	      					for(var i =0; i<data.length; i++) {
	      						location+=`<input id="location_`+i+`" type='radio' name='location' class='location' 
	      							onclick="getVal('`+data[i].store_name+`','`+data[i].city+`','`+data[i].country+`','`+data[i].zip_code+`')" >
	      							<label style="margin-top:0px;margin-bottom:0px" for="location_`+i+`">`+data[i].zip_code+`,`+data[i].store_name+`</label>
	      							<br />`;

	      					}
	      					error='';
	      					$('.error_msgee').html('');
	      					$('.location-wrap').html(location);
	      					
	      				}else{
	      					error='error';
	      					jQuery('.error_msgee').text('Please enter valid zipcode');
	      					jQuery('.error_msge').text('');
	      					$('.location-wrap').html('');
	      				}
	      				//initialize(data);
	      			}else{
	      				error='error';
	      				$('.error_msgee').html('Please enter valid zipcode');
	      				$('.location-wrap').html('');
	      			}
	      		}
	      	});
      	}if(error=='error'){
      		$('.error_msgee').html('Please enter valid zipcode');
      	}
      });
   });
   function getVal(store_name,city,country,zip_code){
	  	jQuery('#selected-locations').show();
	  	var text = `<h3>`+store_name+', '+city+', '+country+', '+zip_code+`</h3>`; 		
		jQuery('#selected-area').html(text);
		// jQuery('#cafe-input-hidden,#cafe-input').val(zip_code);
		jQuery('#cafe-input-hidden').val(zip_code);
		jQuery('#menu7 .next-step').removeAttr('disabled');
	  }
   $(function() {
        $('.image-editor').cropit({
          imageState: {
            src: '',
          },
        });

        $('.rotate-cw').click(function() {
          $('.image-editor').cropit('rotateCW');
        });
        $('.rotate-ccw').click(function() {
          $('.image-editor').cropit('rotateCCW');
        });

        $('.export').click(function() {
          var imageData = $('.image-editor').cropit('export');
          window.open(imageData);
        });
      });
</script>
<script type="text/javascript">
	jQuery(function($) {
		var script = document.createElement('script');
		script.src = "//maps.googleapis.com/maps/api/js?sensor=false";
		document.body.appendChild(script);
	});
	var data = new Array();
	function initialize(location) {
		var map;
		var bounds = new google.maps.LatLngBounds();
		var mapOptions = {
			mapTypeId: 'roadmap',
			center: {lat: 40.730610, lng: -73.935242},
			zoom:2,
		};

		map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
		map.setTilt(45);
        // Multiple Markers
        /* make marker*/
        data = location;
        var myArray = new Array();
       	var infoWindow = new google.maps.InfoWindow(), marker, i;
        if(data != null) {
        	 if(data.length > 0) {
        	 	jQuery('.no-records').hide();
        	 	for( i = 0; i < data.length; i++ ) {
        	 		/*make infowindow*/

        	 		var info_data = `<div class="info_content">`;
        	 		info_data+= `<a href="{{ url('/user/cafe-detail') }}/`+data[i]['id']+`"><h3>`+data[i]['store_name']+', ,'+data[i]['state']+`</h3></a>`;
        	 		info_data+= `<div style="text-align:left">`;
        	 		info_data+= `<p><b>Zip Code: </b>`+data[i]['zip_code']+`</p>`;
        	 		info_data+= `<p><a href="javascript:void(0);" onclick="selectedLoc(`+i+`)">Set as my location</a></p>`;
        	 		/*if(data[i].cafe_users.length == 0) {
        	 			info_data+= `<p>User Register In Cafe (0)<p>`;
        	 		} else {
        	 			info_data+= `<p>User Register In Cafe (`+data[i].cafe_users.length+`)<p>`;
        	 			data[i].cafe_users.forEach(function(item) {
        	 				info_data+= `<p><a href="{{ url('/user/view-profile/') }}/`+item.id+`">`+item.name+`</a><br></p>`;
        	 			}); 
        	 		}*/
        	 		info_data+= `</div></div>`;

        	 		myArray[i] = info_data;
        	 		
        	 		/*make infowindow*/

        	 		@if(app('request')->input('cafe_with_member'))
        	 		if(data[i].cafe_users.length > 0) {
        	 			var position = new google.maps.LatLng(data[i]['latitude'], data[i]['longitude']);
        	 			bounds.extend(position);

        	 			marker = new google.maps.Marker({
        	 				position: position,
        	 				map: map,
        	 				title: data[i]['store_name']
        	 			});	

        	 			google.maps.event.addListener(marker, 'click', (function(marker, i) {
        	 				return function() {
        	 					infoWindow.setContent(myArray[i]);
        	 					infoWindow.open(map, marker);
        	 					marker.setAnimation(google.maps.Animation.BOUNCE);
        	 				}
        	 			})(marker, i));

        	 			map.fitBounds(bounds);
        	 		}
	        	 	@else 
		        	 	var position = new google.maps.LatLng(data[i]['latitude'], data[i]['longitude']);
		        	 	bounds.extend(position);

		        	 	marker = new google.maps.Marker({
		        	 		position: position,
		        	 		map: map,
		        	 		title: data[i]['store_name']
		        	 	});	

		        	 	google.maps.event.addListener(marker, 'click', (function(marker, i) {
		        	 		return function() {
		        	 			infoWindow.setContent(myArray[i]);
		        	 			infoWindow.open(map, marker);
		        	 			marker.setAnimation(google.maps.Animation.BOUNCE);
		        	 		}
		        	 	})(marker, i));

		        	 	map.fitBounds(bounds);
        	 		@endif
        	 		
        	 	}
        	 } else {
        	 	jQuery('.no-records').show();
        	 }
        }

    // Override our map zoom level once our fitBounds function runs (Make sure it only runs once)
    var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
    	google.maps.event.removeListener(boundsListener);
    });
    
}

function selectedLoc(index) {
	console.log('index',index, 'loc', data);
	jQuery('#selected-locations').show();
	var text = `<h3>`+data[index]['store_name']+', '+data[index]['city']+', '+data[index]['country']+', '+data[index]['zip_code']+`</h3>`; 		
	jQuery('#selected-area').html(text);
	jQuery('#cafe-input-hidden,#cafe-input').val(data[index]['zip_code']);	
}
</script>
@endsection