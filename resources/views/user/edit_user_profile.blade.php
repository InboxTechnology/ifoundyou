@extends('layouts.full_dashboard')

@section('content')
<style>
ul.list-unstyled.list-inline {
    margin: 15px 10px;
    width: 100%;
    display: inline-block;
    border-bottom: 0px;
}
ul.list-custom{position: absolute;right: 0;bottom: 0;width: auto !important;}
.tab-content {
    padding: 20px 5px;
}
.nav-inner {
    margin: 0px 2px !important;
}
.nav-tabs li a {
    border: 1px solid #dedede !important;
    box-shadow: 1px 5px 10px 5px #aaa;
    margin: 2px 10px;
    padding: 8px 15px;
    text-transform: capitalize;
    width: 210px;
    text-align: center;
    }
 .nav-tabs{
 	border-bottom:0px !important;
 }
 .tab-content{
 	/*box-shadow:1px 3px 11px #337ab7;*/
 	margin-top:20px;
 	margin-bottom: 60px;
 	background-color: #fff;
 	border: 2px solid rgba(61,70,77,0.1);
 }
 .edit-profile-tabs .active a{
 	background-color: #337ab7 !important;
    color: white !important;
    box-shadow: 1px 1px 1px 3px #dedede !important;
 }
 .edit-profile-tabs{margin-top: 30px;}
 #selected-locations {
		display: none;
	}
	#selected-locations .text{
		text-decoration: underline;
	}
	#selected-area h3,#new-selected-area h3,.thank-you-style {
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
	.list-inline{
		text-align: center;
	}
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
	input[type="file"]{width: auto;margin-top: 20px;}
	.nav-inner{margin: 0px;}
	.image_error{float: left;width: 100%;text-align: center !important;margin-top: 10px;}
	.uploaded_image{max-height: 200px;}
	.buttonparent{text-align: center !important;margin-top: 20px;}
</style>

<link href="{{ asset('public/css/jquery.scrolling-tabs.css') }}" rel="stylesheet">

<div class="col-md-12 col-sm-12 col-xs-12">

	<ul class="nav-inner">
		<li><a href="{{ url('/user/dashboard') }}">Home</a></li>
		<!-- <li><a href="{{ url('/user/dashboard')}}">Dashboard</a></li> -->
		<li class="active"><a href="{{ url('/user/edit-user-profile')}}">Edit Profile</a></li>
		<!-- <li><a href="{{ url('/user/user-profile')}}">My Profile</a></li> -->
		<!-- <li><a href="{{ url('/user/change-photo')}}">My Profile Photo</a></li> -->
	</ul>

	<div class="edit-profile-tabs">
		<!-- Nav tabs -->
		<ul class="nav nav-tabs" role="tablist">
		  <li  class="active" role="presentation"><a href="#tab1" role="tab" data-toggle="tab">Looking to Date</a></li>
		  <li role="presentation"><a href="#tab2" role="tab" data-toggle="tab">About Me</a></li>
		  <li role="presentation"><a href="#tab3" role="tab" data-toggle="tab">About My Match</a></li>
		  <li role="presentation"><a href="#tab4" role="tab" data-toggle="tab">My Interests</a></li>
		  <li role="presentation"><a href="#tab5" role="tab" data-toggle="tab">My Match Interests</a></li>
		  <li role="presentation"><a href="#tab6" role="tab" data-toggle="tab">Types of Relationship</a></li>
		  <li role="presentation"><a href="#tab7" role="tab" data-toggle="tab">Horoscope Sign</a></li>
		  <!-- <li role="presentation"><a href="#tab8" role="tab" data-toggle="tab">Biography</a></li> -->
		  <!-- <li role="presentation"><a href="#tab9" role="tab" data-toggle="tab">My Profile Photo</a></li> -->
		  <!-- <li role="presentation"><a href="#tab10" role="tab" data-toggle="tab">Thank You</a></li> -->
		</ul>
		 
		<!-- Tab panes -->
		<form method="post" action="{{ url('/user/edit-user-profile') }}" id="profileForm" enctype="multipart/form-data">
			<div class="tab-content forms-in" id="profile-page">
				{{csrf_field()}}
				<input type="hidden" value="create_account" name="create_account"> 
				<input type="hidden" value="{{ Auth::user()->cafe }}" name="cafe" id="cafe-input-hidden"> 
				<input type="hidden" id="cctv" value="{{Auth::user()->city}}" name="cccity">
				<input type="hidden" id="" value = "{{Auth::user()->ustate}}" name="states">

			  	<div role="tabpanel" class="tab-pane active" id="tab1">
			  		<h4>Looking to Date</h4>
					<?php 
						$looking_for = explode(",", Auth::user()->looking_for);
						$looking_for = array_map('trim', $looking_for);
					?>

					<div class="col-md-4 col-sm-4 col-xs-12" id="">

						<div><input type="checkbox" name="looking_for_date" class="looks" @if(in_array("All", $looking_for)) checked @endif value="All"> <label>All</label></div>

						<div><input type="checkbox" name="looking_for_date" @if(in_array("Straight Male", $looking_for)) checked @endif  value="Straight Male"> <label>Straight Male</label></div>
						<div><input type="checkbox" name="looking_for_date" @if(in_array("Gay Male", $looking_for)) checked @endif  value="Gay Male"> <label>Gay Male </label></div>
						
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12">
						<div><input type="checkbox" name="looking_for_date" @if(in_array("Straight Female", $looking_for)) checked @endif  value="Straight Female"> <label>Straight Female</label></div>
						<div><input type="checkbox" name="looking_for_date" @if(in_array("Gay Female", $looking_for)) checked @endif  value="Gay Female"> <label>Gay Female </label></div>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12">
						<div><input type="checkbox" name="looking_for_date" @if(in_array("Bi Female", $looking_for)) checked @endif  value="Bi Female"> <label>Bi Female</label></div>
						<div><input type="checkbox" name="looking_for_date" @if(in_array("Bi Male", $looking_for)) checked @endif  value="Bi Male"> <label>Bi Male </label></div>
					</div>
					<div class="clearfix"></div>
					<ul class="list-unstyled list-inline">
						<li class="prev-step-li"><button type="button" class="btn cafe-submit prev-step" data-toggle="tab" href="#tab1">{{--<i class="fa fa-chevron-left"></i>--}} Back</button></li>
						<li class="next-step-li"><button type="button" class="btn cafe-submit next-step" data-toggle="tab" href="#tab2">Next {{--<i class="fa fa-chevron-right"></i>--}}</button></li>
					</ul>
			  	</div>

			  	<div role="tabpanel" class="tab-pane" id="tab2">
			  		<h4>About Me</h4>

					<div class="col-md-5 col-sm-6 col-xs-12"> <!-- id="about_me" -->
						<label>Gender</label>
						<select class="form-control" name="sex" required>
							<option value="">Choose One</option>
							<option value="Bi Female" @if(Auth::user()->sex == 'Bi Female') selected @endif>Bi Female</option>
							<option value="Bi Male" @if(Auth::user()->sex == 'Bi Male') selected @endif>Bi Male</option>
							<option value="Gay Female" @if(Auth::user()->sex == 'Gay Female') selected @endif>Gay Female</option>
							<option value="Gay Male" @if(Auth::user()->sex == 'Gay Male') selected @endif>Gay Male</option>
							<option value="Female" @if(Auth::user()->sex == 'Female') selected @endif>Straight Female</option>
							<option value="Male" @if(Auth::user()->sex == 'Male') selected @endif>Straight Male</option>
							<option value="Other" @if(Auth::user()->sex == 'Other') selected @endif>Other</option>
						</select>
					</div>
					<div class="col-md-5 col-sm-6 col-xs-12">
						<label>Body Type</label>
						<select class="form-control" name="bodytype">
							<option value="">Choose One</option>
							<option value="Above Average" @if(Auth::user()->bodytype == 'Above Average') selected @endif>Above Average</option>
							<option value="Atheltic" @if(Auth::user()->bodytype == 'Atheltic') selected @endif>Athletic </option>
							<option value="Average" @if(Auth::user()->bodytype == 'Average') selected @endif>Average </option>
							<option value="Full Figured" @if(Auth::user()->bodytype == 'Full Figured') selected @endif>Full Figured</option>
							<option value="Slender" @if(Auth::user()->bodytype == 'Slender') selected @endif>Slender</option>
							<option value="Other" @if(Auth::user()->bodytype == 'Other') selected @endif>Other</option>
						</select>
					</div>
					<div class="col-md-5 col-sm-6 col-xs-12">
						<label>Height</label>
						<select class="form-control" name="height">
							<option value="">Choose One</option>
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
							<option value="Other" @if(Auth::user()->height == 'Other') selected @endif>Other</option>
						</select>
					</div>
					<div class="col-md-5 col-sm-6 col-xs-12">
						<label>Eye Color</label>
						<select class="form-control" name="eyecolor">
							<option value="">Choose One</option>
							<option value="Blue" @if(Auth::user()->eyecolor == 'Blue') selected @endif>Blue</option>
							<option value="Brown" @if(Auth::user()->eyecolor == 'Brown') selected @endif>Brown</option>
							<option value="Green" @if(Auth::user()->eyecolor == 'Green') selected @endif>Green</option>
							<option value="Hazel" @if(Auth::user()->eyecolor == 'Hazel') selected @endif>Hazel</option>
							<option value="Other" @if(Auth::user()->eyecolor == 'Other') selected @endif>Other</option>
						</select>
					</div>
					<div class="col-md-5 col-sm-6 col-xs-12">
						<label>Hair Color</label>
						<select class="form-control" name="haircolor">
							<option value="">Choose One</option>
							<option value="Bald" @if(Auth::user()->haircolor == 'Bald') selected @endif>Bald</option>
							<option value="Black" @if(Auth::user()->haircolor == 'Black') selected @endif>Black</option>
							<option value="Blonde" @if(Auth::user()->haircolor == 'Blonde') selected @endif>Blonde</option>
							<option value="Brown" @if(Auth::user()->haircolor == 'Brown') selected @endif>Brown</option>
							<option value="Brunette" @if(Auth::user()->haircolor == 'Brunette') selected @endif>Brunette</option>
							<option value="Red" @if(Auth::user()->haircolor == 'Red') selected @endif>Red</option>
							<option value="Other" @if(Auth::user()->haircolor == 'Other') selected @endif>Other</option>
						</select>
					</div>
					<div class="col-md-5 col-sm-6 col-xs-12">
						<label>Ethnicity</label>
						<select class="form-control" name="ethnicity">
							<option value="">Choose One</option>
							<option value="African American" @if(Auth::user()->ethnicity == 'African American') selected @endif>African American</option>
							<option value="Asian" @if(Auth::user()->ethnicity == 'Asian') selected @endif>Asian</option>
							<option value="Caucasian" @if(Auth::user()->ethnicity == 'Caucasian') selected @endif>Caucasian</option>
							<option value="European" @if(Auth::user()->ethnicity == 'European') selected @endif>European</option>
							<option value="Hispanic" @if(Auth::user()->ethnicity == 'Hispanic') selected @endif>Hispanic</option>
							<option value="Multiracial" @if(Auth::user()->ethnicity == 'Multiracial') selected @endif>Multiracial</option>
							<option value="Native American" @if(Auth::user()->ethnicity == 'Native American') selected @endif>Native American</option>
							<option value="Other" @if(Auth::user()->ethnicity == 'Other') selected @endif>Other</option>
						</select>
					</div>
					<div class="col-md-5 col-sm-6 col-xs-12">
						<label>Language</label>
						<select class="form-control" name="language">
							<option value="">Choose One</option>
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
					</div>
					<div class="col-md-5 col-sm-6 col-xs-12">
						<label>Religion</label>
						<select class="form-control" name="religion">
							<option value="">Choose One</option>
							<option value="Buddhism" @if(Auth::user()->religion == 'Buddhism') selected @endif>Buddhism </option>
							<option value="Catholicism" @if(Auth::user()->religion == 'Catholicism') selected @endif>Catholicism  </option>
							<option value="Christianity" @if(Auth::user()->religion == 'Christianity') selected @endif>Christianity  </option>
							<option value="Hinduism" @if(Auth::user()->religion == 'Hinduism') selected @endif>Hinduism  </option>
							<option value="Islam" @if(Auth::user()->religion == 'Islam') selected @endif>Islam </option>
							<option value="Judaism" @if(Auth::user()->religion == 'Judaism') selected @endif>Judaism </option>
							<option value="New Age" @if(Auth::user()->religion == 'New Age') selected @endif>New Age</option>
							<option value="Other" @if(Auth::user()->religion == 'Other') selected @endif>Other</option>
						</select>
					</div>

					<div class="clearfix"></div>

					<ul class="list-unstyled list-inline">
						<li class="prev-step-li"><button type="button" class="btn cafe-submit prev-step" data-toggle="tab" href="#tab1">{{--<i class="fa fa-chevron-left"></i>--}} Back</button></li>
						<li class="next-step-li"><button type="button" class="btn cafe-submit next-step" data-toggle="tab" href="#tab3">Next {{--<i class="fa fa-chevron-right"></i>--}}</button></li>
					</ul>
			  	</div>

				<div role="tabpanel" class="tab-pane" id="tab3">
					<h4>About My Match</h4>
					<div class="col-md-5 col-sm-6 col-xs-12" id="about_match">
						<label>Gender</label>
						<select class="form-control" name="about_gender">
							<option value="">Choose One</option>
							<option value="Any" @if(Auth::user()->about_gender == 'Any') selected @endif>Any</option>
							<option value="Bi Male" @if(Auth::user()->about_gender == 'Bi Male') selected @endif>Bi Male</option>
							<option value="Bi Female" @if(Auth::user()->about_gender == 'Bi Female') selected @endif>Bi Female</option>
							<option value="Gay Male" @if(Auth::user()->about_gender == 'Gay Male') selected @endif>Gay Male</option>
							<option value="Gay Female" @if(Auth::user()->about_gender == 'Gay Female') selected @endif>Gay Female</option>
							<option value="Female" @if(Auth::user()->about_gender == 'Female') selected @endif>Straight Female</option>
							<option value="Male" @if(Auth::user()->about_gender == 'Male') selected @endif>Straight Male</option>
							<!-- <option value="All" @if(Auth::user()->about_gender == 'All') selected @endif>All</option> -->
						</select>
					</div>
					<div class="col-md-5 col-sm-6 col-xs-12">
						<label>Body Type</label>
						<select class="form-control" name="about_bodytype">
							<option value="">Choose One</option>
							<option value="Any" @if(Auth::user()->about_bodytype == 'Any') selected @endif>Any</option> 
							<option value="Above Average" @if(Auth::user()->about_bodytype == 'Above Average') selected @endif>Above Average</option>
							<option value="Atheltic" @if(Auth::user()->about_bodytype == 'Atheltic') selected @endif>Athletic </option>
							<option value="Average" @if(Auth::user()->about_bodytype == 'Average') selected @endif>Average </option>
							<option value="Full Figured" @if(Auth::user()->about_bodytype == 'Full Figured') selected @endif>Full Figured</option>
							<option value="Slender" @if(Auth::user()->about_bodytype == 'Slender') selected @endif>Slender</option>
							<!-- <option value="All" @if(Auth::user()->about_bodytype == 'All') selected @endif>All</option> -->
						</select>
					</div>
					<div class="col-md-5 col-sm-6 col-xs-12">
						<label>Height</label>
						<select class="form-control" name="about_height">
							<option value="">Choose One</option>
							<option value="Any" @if(Auth::user()->about_height == 'Any') selected @endif>Any</option>
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
							<!-- <option value="All" @if(Auth::user()->about_height == 'All') selected @endif>All</option> -->
						</select>
					</div>
					<div class="col-md-5 col-sm-6 col-xs-12">
						<label>Eye Color</label>
						<select class="form-control" name="about_eyecolor">
							<option value="">Choose One</option>
							<option value="Any" @if(Auth::user()->about_eyecolor == 'Any') selected @endif>Any</option>
							<option value="Blue" @if(Auth::user()->about_eyecolor == 'Blue') selected @endif>Blue</option>
							<option value="Brown" @if(Auth::user()->about_eyecolor == 'Brown') selected @endif>Brown</option>
							<option value="Green" @if(Auth::user()->about_eyecolor == 'Green') selected @endif>Green</option>
							<option value="Hazel" @if(Auth::user()->about_eyecolor == 'Hazel') selected @endif>Hazel</option>
							<!-- <option value="All" @if(Auth::user()->about_eyecolor == 'All') selected @endif>All </option> -->
						</select>
					</div>
					<div class="col-md-5 col-sm-6 col-xs-12">
						<label>Hair Color</label>
						<select class="form-control" name="about_haircolor">
							<option value="">Choose One</option>
							<option value="Any" @if(Auth::user()->about_haircolor == 'Any') selected @endif>Any</option>
							<option value="Bald" @if(Auth::user()->about_haircolor == 'Bald') selected @endif>Bald</option>
							<option value="Black" @if(Auth::user()->about_haircolor == 'Black') selected @endif>Black</option>
							<option value="Blonde" @if(Auth::user()->about_haircolor == 'Blonde') selected @endif>Blonde</option>
							<option value="Brown" @if(Auth::user()->about_haircolor == 'Brown') selected @endif>Brown</option>
							<option value="Brunette" @if(Auth::user()->about_haircolor == 'Brunette') selected @endif>Brunette</option>
							<option value="Red" @if(Auth::user()->about_haircolor == 'Red') selected @endif>Red</option>
							<!-- <option value="All" @if(Auth::user()->about_haircolor == 'All') selected @endif>All</option> -->
						</select>
					</div>
					<div class="col-md-5 col-sm-6 col-xs-12">
						<label>Ethnicity</label>
						<select class="form-control" name="about_ethnicity">
							<option value="">Choose One</option>
							<option value="Any" @if(Auth::user()->about_ethnicity == 'Any') selected @endif>Any</option>
							<option value="African American" @if(Auth::user()->about_ethnicity == 'African American') selected @endif>African American</option>
							<option value="Asian" @if(Auth::user()->about_ethnicity == 'Asian') selected @endif>Asian</option>
							<option value="Caucasian" @if(Auth::user()->about_ethnicity == 'Caucasian') selected @endif>Caucasian</option>
							<option value="European" @if(Auth::user()->about_ethnicity == 'European') selected @endif>European</option>
							<option value="Hispanic" @if(Auth::user()->about_ethnicity == 'Hispanic') selected @endif>Hispanic</option>
							<option value="Multiracial" @if(Auth::user()->about_ethnicity == 'Multiracial') selected @endif>Multiracial</option>
							<option value="Native American" @if(Auth::user()->about_ethnicity == 'Native American') selected @endif>Native American</option>
						</select>
					</div>
					<div class="col-md-5 col-sm-6 col-xs-12">
						<label>Language</label>
						<select class="form-control" name="about_language">
							<option value="">Choose One</option>
							<option value="Any" @if(Auth::user()->about_language == 'Any') selected @endif>Any</option>
							<option value="Chinese" @if(Auth::user()->about_language == 'Chinese') selected @endif>Chinese</option>
							<option value="English" @if(Auth::user()->about_language == 'English') selected @endif>English </option>
							<option value="French" @if(Auth::user()->about_language == 'French') selected @endif>French </option>
							<option value="German" @if(Auth::user()->about_language == 'German') selected @endif>German</option>
							<option value="Hebrew" @if(Auth::user()->about_language == 'Hebrew') selected @endif>Hebrew</option>
							<option value="Hindi" @if(Auth::user()->about_language == 'Hindi') selected @endif>Hindi</option>
							<option value="Italian" @if(Auth::user()->about_language == 'Italian') selected @endif>Italian</option>
							<option value="Russian" @if(Auth::user()->about_language == 'Russian') selected @endif>Russian</option>
							<option value="Spanish" @if(Auth::user()->about_language == 'Spanish') selected @endif>Spanish</option>
							<!-- <option value="All" @if(Auth::user()->about_language == 'All') selected @endif>All</option> -->
						</select>
					</div>
					<div class="col-md-5 col-sm-6 col-xs-12">
						<label>Religion</label>
						<select class="form-control" name="about_religion">
							<option value="">Choose One</option>
							<option value="Any" @if(Auth::user()->about_religion == 'Any') selected @endif>Any </option>
							<option value="Buddhism" @if(Auth::user()->about_religion == 'Buddhism') selected @endif>Buddhism </option>
							<option value="Catholicism" @if(Auth::user()->about_religion == 'Catholicism') selected @endif>Catholicism  </option>
							<option value="Christianity" @if(Auth::user()->about_religion == 'Christianity') selected @endif>Christianity  </option>
							<option value="Hinduism" @if(Auth::user()->about_religion == 'Hinduism') selected @endif>Hinduism  </option>
							<option value="Islam" @if(Auth::user()->about_religion == 'Islam') selected @endif>Islam </option>
							<option value="Judaism" @if(Auth::user()->about_religion == 'Judaism') selected @endif>Judaism </option>
							<option value="New Age" @if(Auth::user()->about_religion == 'New Age') selected @endif>New Age</option>
							<!-- <option value="All" @if(Auth::user()->about_religion == 'All') selected @endif>All</option> -->
						</select>
					</div>
					<div class="clearfix"></div>
					<ul class="list-unstyled list-inline ">
						<li class="prev-step-li"><button type="button" class="btn cafe-submit prev-step" data-toggle="tab" href="#tab2">{{--<i class="fa fa-chevron-left"></i>--}} Back</button></li>
						<li class="next-step-li"><button type="button" class="btn cafe-submit next-step" data-toggle="tab" href="#tab4">Next {{--<i class="fa fa-chevron-right"></i>--}}</button></li>
					</ul>
				</div>

				<div role="tabpanel" class="tab-pane" id="tab4">
					<h4>My Interests</h4>
					<?php 
						$activity = explode(",", Auth::user()->activity);
						$activity_selected = array_map('trim', $activity);

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

								<div><input type="checkbox" class="act" id="{{$activity->id}}" name="activities" value="{{$activity->activity_name}}" <?php echo $checked; ?> > <label>{{$activity->activity_name}}</label></div>

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
							<ul class="list-unstyled list-inline list-custom">
								<li class="prev-step-li"><button type="button" class="btn cafe-submit prev-step" data-toggle="tab" href="#tab3">{{--<i class="fa fa-chevron-left"></i>--}} Back</button></li>
								<li class="next-step-li"><button type="button" class="btn cafe-submit next-step" data-toggle="tab" href="#tab5">Next {{--<i class="fa fa-chevron-right"></i>--}}</button></li>
							</ul>
						</div>
					<div class="col-md-12 mt-20">
						<div class="from-group">
							<textarea class="form-control" id="activities" name="activity" readonly>{{ Auth::user()->activity }}</textarea>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>

				<div role="tabpanel" class="tab-pane" id="tab5">
					<h4>My Match Interests</h4>
					<?php 
						$matchInterest = explode(",", Auth::user()->matchInterest);
						$matchInterest_selected = array_map('trim', $matchInterest);

						$count = count($activities);
						$div_str = floor($count/3);
					?>
						<div class="col-md-4 col-sm-4 col-sm-12" id="activity">
							<?php
								$counter = 1;
								$i = 1;
								foreach ($activities as $activity) {
									if(in_array("$activity->activity_name",$matchInterest_selected)){
										$checked = 'checked';
									}else{
										$checked ='';
									}
								 ?>

								<div><input type="checkbox" class="acts" id="{{$activity->id}}" name="matchInterests" value="{{$activity->activity_name}}" <?php echo $checked; ?> > <label>{{$activity->activity_name}}</label></div>

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
							<ul class="list-unstyled list-inline list-custom">
								<li class="prev-step-li"><button type="button" class="btn cafe-submit prev-step" data-toggle="tab" href="#tab4">{{--<i class="fa fa-chevron-left"></i>--}} Back</button></li>
								<li class="next-step-li"><button type="button" class="btn cafe-submit next-step" data-toggle="tab" href="#tab6">Next {{--<i class="fa fa-chevron-right"></i>--}}</button></li>
							</ul>
						</div>
					<div class="col-md-12 mt-20">
						<div class="from-group">
							<textarea class="form-control" id="matchInterests" name="matchInterest" readonly>{{ Auth::user()->matchInterest }}</textarea>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>

				<div role="tabpanel" class="tab-pane" id="tab6">
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
					<div class="col-md-12 mt-20">
						<div class="from-group">
							<textarea class="form-control" name="type_of_relationship" id="relations_type" readonly>{{ Auth::user()->type_of_relationship }}</textarea>
						</div>
					</div>
					<div class="clearfix"></div>
					<ul class="list-unstyled list-inline">
						<li class="prev-step-li"><button type="button" class="btn cafe-submit prev-step" data-toggle="tab" href="#tab5">{{--<i class="fa fa-chevron-left"></i>--}} Back</button></li>
						<li class="next-step-li"><button type="button" class="btn cafe-submit next-step" data-toggle="tab" href="#tab7">Next {{--<i class="fa fa-chevron-right"></i>--}}</button></li>
					</ul>
				</div>

				<div role="tabpanel" class="tab-pane" id="tab7">
					<h4>Horoscope Sign</h4>
					
					<div class="col-md-5 col-sm-6 col-xs-12">
						<label>Western Sign</label>
						<select class="form-control" id ="western" name="western_sign" disabled>
							<option value="{{ $western_sign }}" selected>{{ $western_sign }}</option>
						</select>
					</div>
					<div class="col-md-5 col-sm-6 col-xs-12" id="horoscope">
						<label>Chinese Sign</label>
						<select class="form-control" id="chinese" name="chinese_sign" disabled>
							<option value="{{ $chinese_sign }}" selected>{{ $chinese_sign }}</option>
						</select>
					</div>
					<div class="clearfix"></div>
					<ul class="list-unstyled list-inline">
						<li class="prev-step-li"><button type="button" class="btn cafe-submit prev-step" data-toggle="tab" href="#tab6">{{--<i class="fa fa-chevron-left"></i>--}} Back</button></li>
						<!-- <li class="next-step-li"><button type="button" class="btn cafe-submit next-step" data-toggle="tab" href="#tab8">Next {{--<i class="fa fa-chevron-right"></i>--}}</button></li>
						-->
						<li><button type="button" class="btn cafe-submit saveExit">Submit</button></li>
					</ul>
				</div>

				<div role="tabpanel" class="tab-pane" id="tab8">
					<h4>Biography</h4>
					
					<div class="col-md-12 mt-20">
						<div class="from-group">
							<textarea class="form-control" name="biography" id="biography">{{ Auth::user()->biography }}</textarea>
						</div>
					</div>
					
					<div class="clearfix"></div>
					<ul class="list-unstyled list-inline">
						<li class="prev-step-li"><button type="button" class="btn cafe-submit prev-step" data-toggle="tab" href="#tab7">{{--<i class="fa fa-chevron-left"></i>--}} Back</button></li>
						<li><button type="button" class="btn cafe-submit saveExit">Submit</button></li>
						<!-- <li class="next-step-li"><button type="button" class="btn cafe-submit next-step" data-toggle="tab" href="#tab9">Next {{--<i class="fa fa-chevron-right"></i>--}}</button></li> -->
					</ul>
				</div>

				<div role="tabpanel" class="tab-pane" id="tab9" style="display: none;">
					<!-- <h4>Profile Image</h4> -->
					
					<!-- <div class="col-md-12 d-flex d-flex-center">
						@if(Auth::user()->image)
							<img src="{{ url('public/img/'.Auth::user()->image) }}" class="uploaded_image">
						@else
							<img src="{{ url('/public/img/profile1.png')}}" class="uploaded_image">
						@endif
					</div>
					<div class="col-md-12 d-flex d-flex-center">
						<input type="file" name="profile_image" id="profile_image" class="form-control" placeholder="Upload Profile Image" style="height: unset;display: none;">
					</div>
					<div class="col-md-12 buttonparent">
						<input style="background-color:#0071e0;" type="button" class="btn btn-primary" onclick="document.getElementById('profile_image').click()" id="btn1" value ="Select a photo from your computer">
					</div> -->
					<div class="row d-flex justify-content-center ">
						@forelse( $profileImages as $profileImage )
							<div class="col-md-3 profile_image d-flex d-flex-center">
								<input type="radio" name="profile_image" value="{{ $profileImage->image_name }}" @if( $profileImage->image_name == Auth::user()->image ) checked @endif >
								<img src="{{ url('public/img/'.$profileImage->image_name) }}" class="uploaded_image">
							</div>
						@empty
							<div class="col-md-3 profile_image">
								<input type="radio" name="profile_image" value="profile1.png">
								<img class="uploaded_image" src="{{ url('/public/img/profile1.png') }}">
							</div>
						@endforelse
					</div>
					<div class="red-span-error image_error" id="image_error"><strong></strong></div>
					
					<div class="clearfix"></div>
					<ul class="list-unstyled list-inline">
						<li class="prev-step-li"><button type="button" class="btn cafe-submit prev-step" data-toggle="tab" href="#tab8">{{--<i class="fa fa-chevron-left"></i>--}} Back</button></li>
						<li><button type="button" class="btn cafe-submit saveExit">Submit</button></li>
					</ul>
				</div>

				<!-- <div role="tabpanel" class="tab-pane" id="tab9">
					<div class="col-md-12">	
						<p style="text-align:center" class="thank-you-style">Thank you for filling out your ifoundyou profile.</p>
					</div>

					<div class="clearfix"></div>
					<ul class="list-unstyled list-inline">
						<li class="prev-step-li"><button type="button" class="btn cafe-submit prev-step" data-toggle="tab" href="#tab10">{{--<i class="fa fa-chevron-left"></i>--}} Back</button></li>
						<li><button type="button" class="btn cafe-submit saveExit">Submit</button></li>
					</ul>
				</div> -->
				<input class="btn custom-btn acc-submit" type="submit" id="save" style="display: none;">
			</div>
		</form>
	</div>

</div>

<script src="{{ asset('public/js/jquery.scrolling-tabs.js') }}"></script>
<script type="text/javascript">
	$('.nav-tabs').scrollingTabs({
  forceActiveTab: true
});

	$('.next-step').on('click', function () {
	   moveTab("Next");
	});
	$('.prev-step').on('click', function () {
	   moveTab("Previous");
	});

	 // var continent = "<?php echo Auth::user()->continent ;?>";
	 //   if(continent == 'Europe' || continent == 'Canada' || continent == 'England')
	 //   {
	 //   		$('#tab10 .zipcode').hide();
	 //   		$('#tab10 .citywse').show();
	 //   }
	 //   else
	 //   {
	 //   		$('#tab10 .zipcode').show();
	 //   		$('#tab10 .citywse').hide();
	 //   }

	$('.selectall').click(function() {
		var newarray = Array();
		var i=0;
		if($(this).is(':checked')){
			$('#tab8 input').prop('checked',true);
			$('#tab8 input').each(function(){
				if($(this).is(':checked')){
					newarray[i] = $(this).val();
				}
				i++;
			})
			newarray.splice(0,1);
			$('#relations_type').text(newarray);
		}
		else
		{
			$('#tab8 input').prop('checked',false);
			$('#relations_type').text('');
		}
	});



	$('.looks').click(function() {
		//var lookingarray = Array();
		var i=0;
		if($(this).is(':checked')){
			$('#tab2 input').prop('checked',true);
			//$('#tab2 input').each(function(){
				//if($(this).is(':checked')){
					//lookingarray[i] = $(this).val();
				//}
				//i++;
			//})
			//lookingarray.splice(0,1);
		}
		else
		{
			$('#tab2 input').prop('checked',false);
		}
	});



	$('.act').click(function() {
		var arr = Array();
		var i=0;
		var val1 = $(this).attr('value');
		var id = $(this).attr('id');
		if($(this).is(':checked'))
		{
			$('#tab7 #'+id).prop('checked',true);
		}	
		else
		{
			$('#tab7 #'+id).prop('checked',false);
		}
			
			$('#tab7 input:checked').each(function(){
				arr.push($(this).val());
			});
			$('#tab7 #matchInterests').val(arr.join(", "));
		
	})

	function moveTab(nextOrPrev) {
	   var currentTab = "";
	   $('.nav-tabs li').each(function () {
	      if ($(this).hasClass('active')) {
	        currentTab = $(this);
	      }
	   });
	   $('.tab-pane').each(function () {
	      if ($(this).hasClass('active')) {
	        currentTabPane = $(this);
	      }
	   });

	   if (nextOrPrev == "Next") {
	      if (currentTab.next().length) 
	      {
	         currentTab.removeClass('active');
	         currentTab.next().addClass('active');
	         currentTabPane.removeClass('active');
	         currentTabPane.next().addClass('active');
	         if($('.edit-profile-tabs .active').find('a').attr('href')>='#tab5'){
	         	$('.scrtabs-tab-scroll-arrow-right').trigger('click');
	         	$('.scrtabs-tab-scroll-arrow-right').trigger('click');
	         }
	      }

	    } else {
	      if (currentTab.prev().length) 
	      {
	        currentTab.removeClass('active');
	        currentTab.prev().addClass('active');
	        currentTabPane.removeClass('active');
	        currentTabPane.prev().addClass('active');
	        if($('.edit-profile-tabs .active').find('a').attr('href')<='#tab5'){
				$('.scrtabs-tab-scroll-arrow-left').trigger('click');
				$('.scrtabs-tab-scroll-arrow-left').trigger('click');
			}
	      }
	    }
	  }

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

	   jQuery('#cafe-input').keypress(function(){
 			jQuery('.error_msgee').text('');
		});

	   jQuery('#locations').change(function(){
    		var value = $(this).val();
    		if(value != '')
    		{
    			$('#selected-locations').css('display','block');
    			$('.error_mgss').html('');
    		}

    	})

	   jQuery('#cityname').change(function(){
    		var value = $(this).val();
    		if(value == '')
    		{
    			$('#selected-locations').css('display','none');
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
	      			if(data!=null) {
	      				var location ="";
	      				var iframe = '';
	      				var data = JSON.parse(data);
	      				if(data.length>0){
	      					for (var i =0; i<data.length; i++) {
	      						location+=`<input id="location_`+i+`" type='radio' name='location' class='location' onclick="getVal('`+data[i].store_name+`','`+data[i].city+`','`+data[i].state+`','`+data[i].zip_code+`')" >
	      						<label style="margin-top:0px;margin-bottom:0px" for="location_`+i+`">`+data[i].store_name+`, `+data[i].city+`, `+data[i].country+`, `+data[i].zip_code+`</label>
	      						<br />`;

	      					}
	      					error='';
	      					$('.error_msgee').html('');
	      					$('.location-wrap').html(location);
	      				}else{
	      					error='error';
	      					$('.error_msgee').html('Please enter valid zipcode');
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

	  $('.saveExit').click(function(){
	  	$('#save').trigger('click');
	  });

	  function getVal(store_name,city,state,zip_code){
	  	$('.option_error').html('');
	  	jQuery('#selected-locations').show();
	  	//var text = `<h3>`+store_name+', '+city+', '+country+', '+zip_code+`</h3>`;
	  	var text_map = `<h3 style="text-align:center">`+store_name+', '+city+', '+state+', '+zip_code+`</h3>`;
	  	$('#tab11 .show_map iframe').attr('src','https://www.google.com/maps/embed/v1/place?key=AIzaSyBGO8o4JyybRaVx409C2tNowstVKD42FFU&q='+encodeURIComponent(store_name+city+state+zip_code).replace(/\%20/g, '+'));
		//jQuery('#selected-area').html(text);
		jQuery('#new-selected-area').html(text_map);
		jQuery('#cafe-input-hidden').val(zip_code);
		 //jQuery('#cafe-input-hidden,#cafe-input').val(zip_code);

	  }	  
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
        	 	console.log("juewf");
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


<script type="text/javascript">
	jQuery(document).ready(function(){
		$('#cityname').change(function(){
			var value = $(this).val(); 
  				$.ajax( {
  					type:'GET',
  					url: "{{ url('/user/showlocations') }}",
  					data : {'city':value},
  					success: function(showlocations){
  						if(showlocations){
  							$('#locations').html(showlocations);
  							$('#cctv').val(value);
  						}
  					}
  				})
		})
	})
</script>

<script type="text/javascript">
	jQuery(document).ready(function(){
		$('#locations').change(function(){
			var value = $(this).val();

			$.ajax( {
					type:'GET',
					url:"{{url('/user/selectedlocation')}}",
					data : {'zip_code':value},
					dataType: "json",
					success:function(selectedlocation){
						if(selectedlocation!=''){
							var stores = selectedlocation[0].store_name;
							$('#selectedlocation').html(''+selectedlocation[0].address_line_1+', '+selectedlocation[0].store_name+', '+selectedlocation[0].city+', '+selectedlocation[0].country+', '+selectedlocation[0].zip_code+'');
							var zips = selectedlocation[0].zip_code;
							var citis = selectedlocation[0].city;
							var countr = selectedlocation[0].country;
							var text_map1 = `<h3 style="text-align:center">`+stores+', '+citis+', '+countr+', '+zips+`</h3>`;
							$('#tab11 .show_map iframe').attr('src','https://www.google.com/maps/embed/v1/place?key=AIzaSyBGO8o4JyybRaVx409C2tNowstVKD42FFU&q='+encodeURIComponent(stores+citis+countr+zips).replace(/\%20/g, '+'));

							 $('#tab11 #new-selected-locations #new-selected-area').html(text_map1);


						}
					}
				})
			})
		})
</script>

<script type="text/javascript">
	jQuery(document).ready(function(){
		$('#locations').change(function(){
			var value = $(this).val();

			if(value != ''){
				$('#cafe-input-hidden').val(value);
			}
		})
	})
</script>

<script type="text/javascript">
	jQuery(document).ready(function(){
   			if($('#western').find('option:selected'))
   			{
   				// $('#western').prop("disabled",true);
   			}
   		});
</script>

<script type="text/javascript">
	jQuery(document).ready(function(){
   			if($('#chinese').find('option:selected'))
   			{
   				// $('#chinese').prop("disabled",true);
   			}
   		});
</script>

<!-- <script type="text/javascript">
	$(document).ready(function(){
			$.ajax( {
  					type:'GET',
					url:"{{url('/user/usacodes')}}",
					success: function(usacodes){
  						if(usacodes){
  							jQuery('#states').html(usacodes);
  					}
  				}
  			});
});
</script> -->

<script type="text/javascript">
	$(document).on('change','#states',function(){
		var value = $(this).val();
		if(value)
		{
			$.ajax( {
  					type:'GET',
					url:"{{url('/user/usacities')}}",
					data : {'state_code':value},
					success: function(usacities){
  						if(usacities){
  							jQuery('#cities').html(usacities);

  					}
  				}
  			});	
		}
})
</script>

<script type="text/javascript">
	$(document).on('change','#cities',function(){
		var value = $(this).val();

		$.ajax( {
  					type:'GET',
					url:"{{url('/user/usalocations')}}",
					data : {'city':value},
					success: function(usalocations){
  						if(usalocations){
  							$('#locations').html(usalocations);
  							$('#cctv').val(value);
  							

  					}
  				}
  			})
	})
</script>


<script type="text/javascript">
	$(document).on('change','#growupstate',function(){
		var value = $(this).val();
		console.log(value);
		if(value)
		{
			$.ajax( {
  					type:'GET',
					url:"{{url('/user/usacities123')}}",
					data : {'nstate':value},
					success: function(usacities123){
  						if(usacities123){
  							jQuery('#liveincity').html(usacities123);

  					}
  				}
  			});	
		}
})


$("#profile_image").change( function() {
    var profileImg = jQuery('#profile_image').val();
	if( !profileImg.match(/.(jpg|jpeg|png|gif)$/i) ) {
		jQuery('#profile_image').val('');
		jQuery('#image_error strong').text('Please upload only jpg, jpeg, png file');
	}
	else {
		jQuery('#image_error strong').text('');
		readImgURL(this);
	}
});

function readImgURL( input ) {
    if( input.files && input.files[0] ) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('.uploaded_image').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>


@endsection