@extends('layouts.newuser-edit-profile-dashboard')

@section('content')

<style type="text/css">
	.scrtabs-tab-scroll-arrow-right span{
		font-size: 16px !important;
	}
	.scrtabs-tab-scroll-arrow-left{
		font-size: 16px !important;
	}
	.forms-in ul li{
		margin-right: 0px !important;
	}
	.tab-pane h4{
		font-size: 18px !important;
		font-family: verdana;
	}
	.gen{
    	padding: 12px 48px 97px !important;
	}
	.px{
		float: right;border: 2px solid rgba(61,70,77,0.1) !important;
		padding-top: 34px !important;
	}
	.px h4{
		padding-left: 62px !important;
	}
	.n-s{
		padding-top: 20px !important;
	}
	.ro{
		padding-top: 0px !important;
	    margin: 0px !important;
	    font-family: verdana;
	    font-size: 18px !important;
	    color: black !important;
	    border: none !important;
	}
	.lii
	{
		float: right !important;
	    width: auto !important;
	    margin-top: 0px !important;
	}
	.nav-inner li a{
		color: black !important;
	}
	.custom_nav{
		display: none;
	}
	.form-control[readonly]{
		background-color: #fff;
	}
	ul.list-unstyled.list-inline {
	    margin: 15px 10px;
	    width: 100%;
	    display: inline-block;
	    border-bottom: 0px;
	}
	ul.list-custom {
		position: absolute;right: 0;bottom: 0;width: auto !important;
	}
	.tab-content {
	    padding: 20px 5px;
	}
	.cross {
		position: absolute;
	    right: 445px;
	    cursor: pointer;
	    font-size: 22px;
	    color: #ff000096;
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
	.nav-tabs {
	 	border-bottom:0px !important;
	}
	.tab-content{
	 	margin-top:20px;
	 	margin-bottom: 60px;
	 	padding-bottom: 80px !important;
	 	background-color: #fff;
	 	border-top: 0px;
	}
	.edit-profile-tabs .active a{
	 	background-color: #337ab7 !important;
	    color: white !important;
	    box-shadow: 1px 1px 1px 3px #dedede !important;
	}
 	.edit-profile-tabs{
 		margin-top: 30px;
 	}
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
	.wod {
    	width: 2301px !important; left: -976px !important;
	}
	.fir
	{
    	width: 2301px !important;
    	left: 0px !important;
	}
	input[type="file"]{
		width: auto;margin-top: 20px;
	}
	.nav-inner{
		margin: 0px;
	}
	.image_error{
		float: left;width: 100%;text-align: center !important;margin-top: 10px;
	}
	.uploaded_image{
		max-height: 200px;
	}
	.buttonparent{
		text-align: center !important;margin-top: 20px;
	}
	.scrtabs-tab-container, .scrtabs-tabs-fixed-container{
		height: 0; display: none;
	}
	.form-check-label {
		font-weight: bold !important;
	}
</style>
<!-- <link href="{{ asset('public/css/jquery.scrolling-tabs.css') }}" rel="stylesheet"> -->

<div class="col-md-12 col-sm-12 col-xs-12">

	<ul class="nav-inner">
		<li><a href="{{ url('/user/user-match-info') }}">Home</a></li>
		<li class=""><a href="{{ url('/user/user-match-info')}}">Edit Profile</a></li>
		<!-- <li class=""><a href="{{ url('/user/new_user_aboutme')}}">About Me</a></li> -->
		<li class="active"><a href="">About My Match</a></li>
		<!-- <li><a href="{{ url('/user/user-profile')}}">My Profile</a></li> -->
		<!-- <li><a href="{{ url('/user/change-photo')}}">My Profile Photo</a></li> -->
		
		@guest
          <li class="lii"><a href="{{url('/login')}}" class="ro">Sign in</a></li>
        @else
          <!-- <li class="lii"><a href="{{url('/log')}}" class="ro">Sign out</a></li> -->
        @endguest
	</ul>

	<div class="edit-profile-tabs">
		<!-- Nav tabs -->
		<ul class="nav nav-tabs custom_nav" role="tablist" style="display: none !important">
		  <li  class="active fr" role="presentation"><a href="#tab2" role="tab" data-toggle="tab">Gender</a></li>
		  <li role="presentation"><a href="#tab3" role="tab" data-toggle="tab">Height</a></li>
		  <li role="presentation"><a href="#tab4" role="tab" data-toggle="tab">Hair Color</a></li>
		  <!-- <li role="presentation"><a href="#tab5" role="tab" data-toggle="tab">Location</a></li> -->
		  <li role="presentation"><a href="#tab6" role="tab" data-toggle="tab">Language</a></li>
		  <li role="presentation"><a href="#tab7" role="tab" data-toggle="tab">Body Type</a></li>
		  <li role="presentation"><a href="#tab8" role="tab" data-toggle="tab">Eye Color</a></li>
		  <li role="presentation"><a href="#tab9" role="tab" data-toggle="tab">Ethnicity</a></li>
		  <li role="presentation"><a href="#tab10" role="tab" data-toggle="tab">Religion</a></li>
		  <li  role="presentation"><a href="#tab11" role="tab" data-toggle="tab">My Match Interest</a></li>
		  <li class="al last-step-li" role="presentation"><a href="#tab12" role="tab" data-toggle="tab">Thank You</a></li>
		</ul>
		 
		<!-- Tab panes -->
		<form method="post" action="{{ url('/user/new_aboutme_profile_update') }}" id="profileForm" enctype="multipart/form-data">
			@php
				$aboutHeights = explode(", ", Auth::user()->about_height);
			@endphp

			@php
				$aboutHaircolors = explode(", ", Auth::user()->about_haircolor);
			@endphp

			@php
				$aboutLanguages = explode(", ", Auth::user()->about_language);
			@endphp

			@php
				$aboutBodytypes = explode(", ", Auth::user()->about_bodytype);
			@endphp

			@php
				$aboutEyecolors = explode(", ", Auth::user()->about_eyecolor);
			@endphp

			@php
				$aboutEthnicitys = explode(", ", Auth::user()->about_ethnicity);
			@endphp

			@php
				$aboutReligions = explode(", ", Auth::user()->about_religion);
			@endphp
			
			<div class="tab-content forms-in" id="profile-page">
				{{csrf_field()}}
				<input type="hidden" name="name" value="{{Auth::user()->name}}">
				<input type="hidden" name="day" value = "{{Auth::user()->day}}">
				<input type="hidden" name="month" value = "{{ Auth::user()->month}}">
				<input type="hidden" name="year" value = "{{Auth::user()->year}}">
				<input type="hidden" name="chinese_sign" value="{{Auth::user()->chinese_sign}}">
				<input type="hidden" name="western_sign" value="{{$zodic}}">
				<input type="hidden" name="sex" id="looking_for_date" value="{{ Auth::user()->sex }}">
				<input type="hidden" value="{{ Auth::user()->cafe }}" name="cafe" id="cafe-input-hidden"> 
				<input type="hidden" id="cctv" value="{{Auth::user()->city}}" name="cccity">
				<input type="hidden" id="" value = "{{Auth::user()->ustate}}" name="states">

			  	<div role="tabpanel" class="tab-pane active" id="tab2">
			  		<div class="col-md-12">
				  		<div class="col-md-12" style="float: right;">
				  			<ul class="list-unstyled list-inline">
				  				<li class="prev-step-li"><button type="button" class="btn cafe-submit -step" data-toggle="tab" href="#tab1">{{--<i class="fa fa-chevron-left"></i>--}} First</button></li>
								<li class="prev-step-li"><button type="button" class="btn cafe-submit prev-step" data-toggle="tab" href="#tab1">{{--<i class="fa fa-chevron-left"></i>--}} Back</button></li>
								<li class="next-step-li"><button type="button" class="btn cafe-submit next-step" data-toggle="tab" href="#tab3">Next {{--<i class="fa fa-chevron-right"></i>--}}</button></li>
								<li class=""><button type="button" class="btn cafe-submit last-step" data-toggle="tab" href="#tab12">Last {{--<i class="fa fa-chevron-right"></i>--}}</button></li>
								<!-- <li><button type="button" class="btn cafe-submit saveExit">Save & Exit</button></li> -->
							</ul>
				  		</div>
			  		</div>
					<div class="col-md-12 px"><h4>Gender</h4>
						<div class="col-md-12 gen">
							<div class="col-md-4 col-sm-4 col-xs-12" id="">
								<div><input type="checkbox" id="sex_straight_male" name="about_gender" class="check" @if(Auth::user()->about_gender == "Male" || Auth::user()->about_gender == "Straight Male") checked @endif  value="Straight Male"> <label for="sex_straight_male">Straight Male</label></div>

								<div><input type="checkbox" id="sex_gay_male" name="about_gender" class="check" @if(Auth::user()->about_gender == "Gay Male") checked @endif  value="Gay Male"> <label for="sex_gay_male">Gay Male </label></div>
								
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<div><input type="checkbox" id="sex_straight_female" name="about_gender" class="check" @if(Auth::user()->about_gender == "Female" || Auth::user()->about_gender == "Straight Female") checked @endif  value="Straight Female"> <label for="sex_straight_female">Straight Female</label></div>

								<div><input type="checkbox" id="sex_gay_female" name="about_gender" class="check" @if(Auth::user()->about_gender == "Gay Female") checked @endif  value="Gay Female"> <label for="sex_gay_female">Gay Female </label></div>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<div><input type="checkbox" id="sex_bi_female" name="about_gender" class="check" @if(Auth::user()->about_gender == "Bi Female") checked @endif  value="Bi Female"> <label for="sex_bi_female">Bi Female</label></div>

								<div><input type="checkbox" id="sex_bi_male" name="about_gender" class="check" @if(Auth::user()->about_gender == "Bi Male") checked @endif  value="Bi Male"> <label for="sex_bi_male">Bi Male </label></div>

								<div><input type="checkbox" id="sex_any" name="about_gender" class="about_gender" @if(Auth::user()->about_gender == "Any") checked @endif  value = "Any"> <label for="sex_any">Any </label></div>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
			  	</div>

			  	<div role="tabpanel" class="tab-pane" id="tab3">
			  		<div class="col-md-12">
			  			<ul class="list-unstyled list-inline">
				  			<li class="prev-step-li"><button type="button" class="btn cafe-submit prev-step" data-toggle="tab" href="#tab2">{{--<i class="fa fa-chevron-left"></i>--}}First</button></li>
							<li class="prev-step-li"><button type="button" class="btn cafe-submit prev-step" data-toggle="tab" href="#tab2">{{--<i class="fa fa-chevron-left"></i>--}} Back</button></li>
							<li class="next-step-li"><button type="button" class="btn cafe-submit next-step" data-toggle="tab" href="#tab4">Next {{--<i class="fa fa-chevron-right"></i>--}}</button></li>
							<li class=""><button type="button" class="btn cafe-submit last-step" data-toggle="tab" href="#tab12">Last {{--<i class="fa fa-chevron-right"></i>--}}</button></li>
						</ul>
					</div>
					<div class="col-md-12 px"><h4>Height</h4>
						<div class="col-md-12 gen">
							<div class="col-md-3 col-sm-3 col-xs-12" id="">
								<div><input type="checkbox" id="height_5.1" name="about_height[]" class="about_height" @if(in_array('5.1', $aboutHeights)) checked @endif value = "5.1" > <label for="height_5.1">5.1</label></div>

								<div><input type="checkbox" id="height_5.2" name="about_height[]" class="about_height" @if(in_array('5.2', $aboutHeights)) checked @endif value = "5.2" > <label for="height_5.2">5.2 </label></div>

								<div><input type="checkbox" id="height_5.3" name="about_height[]" class="about_height" @if(in_array('5.3', $aboutHeights)) checked @endif value = "5.3" > <label for="height_5.3">5.3</label></div>
							</div>

							<div class="col-md-3 col-sm-3 col-xs-12">
								<div><input type="checkbox" id="height_5.4" name="about_height[]" class="about_height" @if(in_array('5.4', $aboutHeights)) checked @endif value = "5.4" > <label for="height_5.4">5.4</label></div>

								<div><input type="checkbox" id="height_5.5" name="about_height[]" class="about_height" @if(in_array('5.5', $aboutHeights)) checked @endif value = "5.5" > <label for="height_5.5">5.5 </label></div>

								<div><input type="checkbox" id="height_5.6" name="about_height[]" class="height" @if(in_array('5.6', $aboutHeights)) checked @endif value = "5.6" > <label class="height_5.6">5.6 </label></div>
							</div>

							<div class="col-md-3 col-sm-3 col-xs-12">
								<div><input type="checkbox" id="height_5.7" name="about_height[]" class="about_height" @if(in_array('5.7', $aboutHeights)) checked @endif value = "5.7" > <label for="height_5.7">5.7</label></div>

								<div><input type="checkbox" id="height_5.8" name="about_height[]" class="about_height" @if(in_array('5.8', $aboutHeights)) checked @endif  value = "5.8"> <label for="height_5.8">5.8 </label></div>

								<div><input type="checkbox" id="height_5.9" name="about_height[]" class="about_height" @if(in_array('5.9', $aboutHeights)) checked @endif value = "5.9" > <label for="height_5.9">5.9 </label></div>
							</div>

							<div class="col-md-3 col-sm-3 col-xs-12">
								<div><input type="checkbox" id="height_6.0" name="about_height[]" class="about_height" @if(in_array('6.0', $aboutHeights)) checked @endif  value = "6.0"> <label for="height_6.0">6.0</label></div>

								<div><input type="checkbox" id="height_6.0+" name="about_height[]" class="about_height" @if(in_array('6.0+', $aboutHeights)) checked @endif  value = "6.0+"> <label for="height_6.0+">6.0+ </label></div>

								<div><input type="checkbox" id="height_any" name="about_height[]" class="about_height" @if(in_array('Any', $aboutHeights)) checked @endif  value = "Any"> <label for="height_any">Any </label></div>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
			  	</div>

				<div role="tabpanel" class="tab-pane" id="tab4">
					<div class="row">
						<div class="col-md-12">
							<ul class="list-unstyled list-inline ">
								<li class="-li"><button type="button" class="btn cafe-submit first-step" data-toggle="tab" href="#tab2">{{--<i class="fa fa-chevron-left"></i>--}} First</button></li>
								<li class="prev-step-li"><button type="button" class="btn cafe-submit prev-step" data-toggle="tab" href="#tab3">{{--<i class="fa fa-chevron-left"></i>--}} Back</button></li>
								<li class="next-step-li"><button type="button" class="btn cafe-submit next-step" data-toggle="tab" href="#tab6">Next {{--<i class="fa fa-chevron-right"></i>--}}</button></li>
								<li class=""><button type="button" class="btn cafe-submit last-step" data-toggle="tab" href="#tab12">Last {{--<i class="fa fa-chevron-right"></i>--}}</button></li>
							</ul>
						</div>
					</div>
					<div class="col-md-12 px"><h4>Hair Color</h4>
						<div class="col-md-12 gen">
							<div class="col-md-4 col-sm-4 col-xs-12">
								<div><input type="checkbox" id="haircolor_bald" name="about_haircolor[]" class="about_haircolor" @if(in_array('Bald', $aboutHaircolors)) checked @endif  value="Bald"> <label for="haircolor_bald">Bald</label></div>

								<div><input type="checkbox" id="haircolor_black" name="about_haircolor[]" class="about_haircolor" @if(in_array('Black', $aboutHaircolors)) checked @endif  value="Black"> <label for="haircolor_black">Black </label></div>
							</div>

							<div class="col-md-4 col-sm-4 col-xs-12">
								<div><input type="checkbox" id="haircolor_blonde" name="about_haircolor[]" class="about_haircolor" @if(in_array('Blonde', $aboutHaircolors)) checked @endif  value="Blonde"> <label for="haircolor_blonde">Blonde</label></div>

								<div><input type="checkbox" id="haircolor_brown" name="about_haircolor[]"  class="about_haircolor" @if(in_array('Brown', $aboutHaircolors)) checked @endif  value="Brown"> <label for="haircolor_brown">Brown </label></div>
							</div>

							<div class="col-md-4 col-sm-4 col-xs-12">
								<div><input type="checkbox" id="haircolor_burnette" name="about_haircolor[]" class="about_haircolor" @if(in_array('Burnette', $aboutHaircolors)) checked @endif  value="Burnette"> <label for="haircolor_burnette">Burnette</label></div>

								<div><input type="checkbox" id="haircolor_red" name="about_haircolor[]" class="about_haircolor" @if(in_array('Red', $aboutHaircolors)) checked @endif  value="Red"> <label for="haircolor_red">Red </label></div>

								<div><input type="checkbox" id="haircolor_any" name="about_haircolor[]" class="about_haircolor" @if(in_array('Any', $aboutHaircolors)) checked @endif  value="Any"> <label for="haircolor_any">Any </label></div>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
				
				<div role="tabpanel" class="tab-pane" id="tab6">
					<div class="row">
						<div class="col-md-12">
							<ul class="list-unstyled list-inline ">
								<li class="-li"><button type="button" class="btn cafe-submit first-step" data-toggle="tab" href="#tab2">{{--<i class="fa fa-chevron-left"></i>--}} First</button></li>
								<li class="prev-step-li"><button type="button" class="btn cafe-submit prev-step" data-toggle="tab" href="#tab4">{{--<i class="fa fa-chevron-left"></i>--}} Back</button></li>
								<li class="next-step-li"><button type="button" class="btn cafe-submit next-step" data-toggle="tab" href="#tab7">Next {{--<i class="fa fa-chevron-right"></i>--}}</button></li>
								<li class="last-step"><button type="button" class="btn cafe-submit last-step" data-toggle="tab" href="#tab12">Last {{--<i class="fa fa-chevron-right"></i>--}}</button></li>
							</ul>
						</div>
					</div>
					<div class="col-md-12 px">
						<h4>Language</h4>
						<div class="col-md-12 gen">
							<div class="col-md-4 col-sm-4 col-xs-12">
								<div><input type="checkbox" id="language_chinese" name="about_language[]" class="about_language" @if(in_array('Chinese', $aboutLanguages)) checked @endif  value="Chinese"> <label for="language_chinese">Chinese</label></div>

								<div><input type="checkbox" id="language_english" name="about_language[]" class="about_language" @if(in_array('English', $aboutLanguages)) checked @endif  value="English"> <label for="language_english">English </label></div>

								<div><input type="checkbox" id="language_french" name="about_language[]" class="about_language" @if(in_array('French', $aboutLanguages)) checked @endif  value="French"> <label for="language_french">French </label></div>

								<div><input type="checkbox" id="language_german" name="about_language[]" class="about_language" @if(in_array('German', $aboutLanguages)) checked @endif  value="German"> <label for="language_german">German </label></div>
							</div>

							<div class="col-md-4 col-sm-4 col-xs-12">
								<div><input type="checkbox" id="language_hebrew" name="about_language[]" class="about_language" @if(in_array('Hebrew', $aboutLanguages)) checked @endif  value="Hebrew"> <label for="language_hebrew">Hebrew </label></div>

								<div><input type="checkbox" id="language_hindi" name="about_language[]" class="about_language" @if(in_array('Hindi', $aboutLanguages)) checked @endif  value="Hindi"> <label for="language_hindi">Hindi </label></div>

								<div><input type="checkbox" id="language_itilian" name="about_language[]" class="about_language" @if(in_array('Itilian', $aboutLanguages)) checked @endif  value="Itilian"> <label for="language_itilian">Itilian </label></div>

								<div><input type="checkbox" id="language_russian" name="about_language[]" class="about_language" @if(in_array('Russian', $aboutLanguages)) checked @endif  value="Russian"> <label for="language_russian">Russian </label></div>
							</div>

							<div class="col-md-4 col-sm-4 col-xs-12">
								<div><input type="checkbox" id="language_spanish" name="about_language[]" class="about_language" @if(in_array('Spanish', $aboutLanguages)) checked @endif  value="Spanish"> <label for="language_spanish">Spanish </label></div>

								<div><input type="checkbox" id="language_any" name="about_language[]" class="about_language" @if(in_array('Any', $aboutLanguages)) checked @endif  value="Any"> <label for="language_any">Any </label></div>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>

				<div role="tabpanel" class="tab-pane" id="tab7">
					<div class="row">
						<div class="col-md-12">
							<ul class="list-unstyled list-inline ">
								<li class="-li"><button type="button" class="btn cafe-submit first-step" data-toggle="tab" href="#tab2">{{--<i class="fa fa-chevron-left"></i>--}} First</button></li>
								<li class="prev-step-li"><button type="button" class="btn cafe-submit prev-step" data-toggle="tab" href="#tab6">{{--<i class="fa fa-chevron-left"></i>--}} Back</button></li>
								<li class="next-step-li"><button type="button" class="btn cafe-submit next-step" data-toggle="tab" href="#tab8">Next {{--<i class="fa fa-chevron-right"></i>--}}</button></li>
								<li class="last-step"><button type="button" class="btn cafe-submit last-step" data-toggle="tab" href="#tab12">Last {{--<i class="fa fa-chevron-right"></i>--}}</button></li>
							</ul>
						</div>
					</div>
					<div class="col-md-12 px"><h4>Body Type</h4>
						<div class="col-md-12 gen">
							<div class="col-md-4 col-sm-4 col-xs-12">
								<div><input type="checkbox" id="bodytype_above_average" name="about_bodytype[]" class="about_bodytype" @if(in_array('Above Average', $aboutBodytypes)) checked @endif  value="Above Average"> <label for="bodytype_above_average">Above Average</label></div>

								<div><input type="checkbox" id="bodytype_athlethic" name="about_bodytype[]" class="about_bodytype" @if(in_array('Athletic', $aboutBodytypes)) checked @endif  value="Athletic"> <label for="bodytype_athlethic">Athletic </label></div>
								
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<div><input type="checkbox" id="bodytype_average" name="about_bodytype[]" class="about_bodytype" @if(in_array('Average', $aboutBodytypes)) checked @endif  value="Average"> <label for="bodytype_average">Average </label></div>

								<div><input type="checkbox" id="bodytype_full_figured" name="about_bodytype[]" class="about_bodytype" @if(in_array('Full Figured', $aboutBodytypes)) checked @endif  value="Full Figured"> <label for="bodytype_full_figured">Full Figured </label></div>
							</div>

							<div class="col-md-4 col-sm-4 col-xs-12">
								<div><input type="checkbox" id="bodytype_slender" name="about_bodytype[]" class="about_bodytype" @if(in_array('Slender', $aboutBodytypes)) checked @endif  value="Slender"> <label for="bodytype_slender">Slender </label></div>

								<div><input type="checkbox" id="bodytype_any" name="about_bodytype[]" class="about_bodytype" @if(in_array('Any', $aboutBodytypes)) checked @endif  value="Any"> <label for="bodytype_any">Any </label></div>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>

				<div role="tabpanel" class="tab-pane" id="tab8">
					<div class="row">
						<div class="col-md-12">
							<ul class="list-unstyled list-inline ">
								<li class="-li"><button type="button" class="btn cafe-submit first-step" data-toggle="tab" href="#tab2">{{--<i class="fa fa-chevron-left"></i>--}} First</button></li>
								<li class="prev-step-li"><button type="button" class="btn cafe-submit prev-step" data-toggle="tab" href="#tab7">{{--<i class="fa fa-chevron-left"></i>--}} Back</button></li>
								<li class="next-step-li"><button type="button" class="btn cafe-submit next-step" data-toggle="tab" href="#tab9">Next {{--<i class="fa fa-chevron-right"></i>--}}</button></li>
								<li class="last-step"><button type="button" class="btn cafe-submit last-step" data-toggle="tab" href="#tab12">Last {{--<i class="fa fa-chevron-right"></i>--}}</button></li>
							</ul>
						</div>
					</div>
					<div class="col-md-12 px"><h4>Eye Color</h4>
						<div class="col-md-12 gen">
							<div class="col-md-4 col-sm-4 col-xs-12">
								<div><input type="checkbox" id="eyecolor_blue" name="about_eyecolor[]" class="about_eyecolor" @if(in_array('Blue', $aboutEyecolors)) checked @endif  value="Blue"> <label for="eyecolor_blue">Blue</label></div>

								<div><input type="checkbox" id="eyecolor_brown" name="about_eyecolor[]" class="about_eyecolor" @if(in_array('Brown', $aboutEyecolors)) checked @endif  value="Brown"> <label for="eyecolor_brown">Brown </label></div>
							</div>

							<div class="col-md-4 col-sm-4 col-xs-12">
								<div><input type="checkbox" id="eyecolor_green" name="about_eyecolor[]" class="about_eyecolor" @if(in_array('Green', $aboutEyecolors)) checked @endif  value="Green"> <label for="eyecolor_green">Green </label></div>
								
								<div><input type="checkbox" id="eyecolor_hazel" name="about_eyecolor[]" class="about_eyecolor" @if(in_array('Hazel', $aboutEyecolors)) checked @endif  value="Hazel"> <label for="eyecolor_hazel">Hazel </label></div>
							</div>

							<div class="col-md-4 col-sm-4 col-xs-12">
								<div><input type="checkbox" id="eyecolor_any" name="about_eyecolor[]" class="about_eyecolor" @if(in_array('Any', $aboutEyecolors)) checked @endif  value="Any"> <label for="eyecolor_any">Any </label></div>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>

				<div role="tabpanel" class="tab-pane" id="tab9">
					<div class="row">
						<div class="col-md-12">
							<ul class="list-unstyled list-inline">
								<li class="-li"><button type="button" class="btn cafe-submit first-step" data-toggle="tab" href="#tab2">{{--<i class="fa fa-chevron-left"></i>--}} First</button></li>
								<li class="prev-step-li"><button type="button" class="btn cafe-submit prev-step" data-toggle="tab" href="#tab8">{{--<i class="fa fa-chevron-left"></i>--}} Back</button></li>
								<li class="next-step-li"><button type="button" class="btn cafe-submit next-step" data-toggle="tab" href="#tab10">Next {{--<i class="fa fa-chevron-right"></i>--}}</button></li>
								<li class="last-step"><button type="button" class="btn cafe-submit last-step" data-toggle="tab" href="#tab12">Last {{--<i class="fa fa-chevron-right"></i>--}}</button></li>
							</ul>
						</div>
					</div>
					<div class="col-md-12 px"><h4>Ethnicity</h4>
						<div class="col-md-12 gen">
							<div class="col-md-3 col-sm-3 col-xs-12">
								<div><input type="checkbox" id="ethnicity_african_american" name="about_ethnicity[]" class="about_ethnicity" @if(in_array('African American', $aboutEthnicitys)) checked @endif  value="African American"> <label for="ethnicity_african_american">African American </label></div>
								
								<div><input type="checkbox" id="ethnicity_asian" name="about_ethnicity[]" class="about_ethnicity" @if(in_array('Asian', $aboutEthnicitys)) checked @endif  value="Asian"> <label for="ethnicity_asian">Asian </label></div>
							</div>

							<div class="col-md-3 col-sm-3 col-xs-12">
								<div><input type="checkbox" id="ethnicity_caucasian" name="about_ethnicity[]" class="about_ethnicity" @if(in_array('Caucasian', $aboutEthnicitys)) checked @endif  value="Caucasian"> <label for="ethnicity_caucasian">Caucasian </label></div>
								
								<div><input type="checkbox" id="ethnicity_european" name="about_ethnicity[]" class="about_ethnicity" @if(in_array('European', $aboutEthnicitys)) checked @endif  value="European"> <label for="ethnicity_european">European </label></div>
							</div>

							<div class="col-md-3 col-sm-3 col-xs-12">
								<div><input type="checkbox" id="ethnicity_hispanic" name="about_ethnicity[]" class="about_ethnicity" @if(in_array('Hispanic', $aboutEthnicitys)) checked @endif  value="Hispanic"> <label for="ethnicity_hispanic">Hispanic </label></div>
								
								<div><input type="checkbox" id="ethnicity_multiracial" name="about_ethnicity[]" class="about_ethnicity" @if(in_array('Multiracial', $aboutEthnicitys)) checked @endif  value="Multiracial"> <label for="ethnicity_multiracial">Multiracial </label></div>
							</div>

							<div class="col-md-3 col-sm-3 col-xs-12">
								<div><input type="checkbox" id="ethnicity_native_american" name="about_ethnicity[]" class="about_ethnicity" @if(in_array('Native American', $aboutEthnicitys)) checked @endif  value="Native American"> <label for="ethnicity_native_american">Native American </label></div>

								<div><input type="checkbox" id="ethnicity_any" name="about_ethnicity[]" class="about_ethnicity" @if(in_array('Any', $aboutEthnicitys)) checked @endif  value="Any"> <label for="ethnicity_any">Any </label></div>
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>

				<div role="tabpanel" class="tab-pane" id="tab10">
					<div class="col-md-12">
						<div class="col-md-12">
							<ul class="list-unstyled list-inline">
								<li class="-li"><button type="button" class="btn cafe-submit first-step" data-toggle="tab" href="#tab2">{{--<i class="fa fa-chevron-left"></i>--}} First</button></li>
								<li class="prev-step-li"><button type="button" class="btn cafe-submit prev-step" data-toggle="tab" href="#tab9">{{--<i class="fa fa-chevron-left"></i>--}} Back</button></li>
								<li class="next-step-li"><button type="button" class="btn cafe-submit next-step" data-toggle="tab" href="#tab11">Next {{--<i class="fa fa-chevron-right"></i>--}}</button></li>
								<li class="last-step"><button type="button" class="btn cafe-submit last-step" data-toggle="tab" href="#tab12">Last {{--<i class="fa fa-chevron-right"></i>--}}</button></li>
							</ul>
						</div>
					</div>
					<div class="col-md-12 px"><h4>Religion</h4>
						<div class="col-md-12 gen">
							<div class="col-md-3 col-sm-3 col-xs-12">
								<div><input type="checkbox" id="religion_buddhism" name="about_religion[]" class="about_religion" @if(in_array('Buddhism', $aboutReligions)) checked @endif  value="Buddhism"> <label for="religion_buddhism">Buddhism </label></div>
								
								<div><input type="checkbox" id="religion_catholicism" name="about_religion[]" class="about_religion" @if(in_array('Catholicism', $aboutReligions)) checked @endif  value="Catholicism"> <label for="religion_catholicism">Catholicism </label></div>
							</div>

							<div class="col-md-3 col-sm-3 col-xs-12">
								<div><input type="checkbox" id="religion_christianity" name="about_religion[]" class="about_religion" @if(in_array('Christianity', $aboutReligions)) checked @endif  value="Christianity"> <label for="religion_christianity">Christianity </label></div>
								
								<div><input type="checkbox" id="religion_hinduism" name="about_religion[]" class="about_religion" @if(in_array('Hinduism', $aboutReligions)) checked @endif  value="Hinduism"> <label for="religion_hinduism">Hinduism </label></div>
							</div>

							<div class="col-md-3 col-sm-3 col-xs-12">
								<div><input type="checkbox" id="religion_islam" name="about_religion[]" class="about_religion" @if(in_array('Islam', $aboutReligions)) checked @endif  value="Islam"> <label for="religion_islam">Islam </label></div>
								
								<div><input type="checkbox" id="religion_judaism" name="about_religion[]" class="about_religion" @if(in_array('Judaism', $aboutReligions)) checked @endif  value="Judaism"> <label for="religion_judaism">Judaism </label></div>
							</div>

							<div class="col-md-3 col-sm-3 col-xs-12">
								<div><input type="checkbox" id="religion_new_age" name="about_religion[]" class="about_religion" @if(in_array('New Age', $aboutReligions)) checked @endif  value="New Age"> <label for="religion_new_age">New Age </label></div>

								<div><input type="checkbox" id="religion_any" name="about_religion[]" class="about_religion" @if(in_array('Any', $aboutReligions)) checked @endif  value="Any"> <label for="religion_any">Any </label></div>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>

				<div role="tabpanel" class="tab-pane" id="tab11">
					<div class="row">
						<div class="col-md-12">
							<ul class="list-unstyled list-inline">
								<li class="-li"><button type="button" class="btn cafe-submit first-step" data-toggle="tab" href="#tab2">{{--<i class="fa fa-chevron-left"></i>--}} First</button></li>
								<li class="prev-step-li"><button type="button" class="btn cafe-submit prev-step" data-toggle="tab" href="#tab10">{{--<i class="fa fa-chevron-left"></i>--}} Back</button></li>
								<li class="next-step-li"><button type="button" class="btn cafe-submit next-step" data-toggle="tab" href="#tab12">Next {{--<i class="fa fa-chevron-right"></i>--}}</button></li>
								<li class="last-step"><button type="button" class="btn cafe-submit last-step" data-toggle="tab" href="#tab12">Last {{--<i class="fa fa-chevron-right"></i>--}}</button></li>
								
							</ul>
						</div>
					</div>
					<div class="col-md-12 px">
						<div class="row">
							<div class="col-md-12">
								<h4>My Match Interests</h4>
							</div>
							<div class="col-md-12 d-flex" style="padding-left: 78px;">
								<div class="form-check form-check-inline mr-10">
									<input class="form-check-input" type="checkbox" id="select_all" value="true">
								  	<label class="form-check-label" for="select_all"> Select All</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="clear_all" value="true">
								  	<label class="form-check-label" for="clear_all"> Clear All</label>
								</div>
							</div>
						</div>

						<div class="col-md-12 gen">
						<?php
							if( Auth::user()->matchInterest == '' )
							{
								$matchInterest = explode(",", Auth::user()->activity);
							}
							else
							{
								$matchInterest = explode(",", Auth::user()->matchInterest);
							}
							$matchInterest_selected=array_map('trim',$matchInterest);

							$count = count($activities);
							$div_str = floor($count/3);
						?>
							<div class="col-md-4 col-sm-4 col-sm-12" id="activity">
								<?php
									$counter = 1;
									$i = 1;
									foreach ($activities as $activity) {
										if(in_array("$activity->activity_name",$matchInterest_selected)) {
											$checked = 'checked';
										}
										else {
											$checked ='';
										}
									 ?>

									<div><input type="checkbox" class="act" id="{{$activity->id}}" name="matchInterests" value="{{$activity->activity_name}}" <?php echo $checked; ?> > <label for="{{$activity->id}}">{{$activity->activity_name}}</label></div>

								<?php
									if($counter==($div_str*$i)) {
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
						</div>
					</div>
					<div class="col-md-12" >
					</div>

					<div class="col-md-12 mt-20">
						<div class="from-group">
							<textarea class="form-control" id="matchInterests" name="matchInterest" readonly>{{ Auth::user()->matchInterest }}</textarea>
						</div>
					</div>
					<div class="clearfix"></div>
					<input class="btn custom-btn acc-submit" type="submit" id="save" style="display: none;">
				</div>

				<div role="tabpanel" class="tab-pane last-step-div" id="tab12">
					<div class="col-md-12" style="float: right;">
						<ul class="list-unstyled list-inline ri nx">
							<li class="prev-step-li"><button type="button" class="btn cafe-submit prev-step-li first-step" data-toggle="tab" href="#tab2">{{--<i class="fa fa-chevron-left"></i>--}} First</button></li>
							<li class="prev-step-li"><button type="button" class="btn cafe-submit prev-step" data-toggle="tab" href="#tab11">{{--<i class="fa fa-chevron-left"></i>--}} Back</button></li>
							<!-- <li><button type="button" class="btn cafe-submit saveExit">Submit</button></li> -->
						</ul>
					</div>
					<div class="col-md-12 px">
						<div class="col-md-12 gen">	
							<p style="text-align:center;" class="thank-you-style">Thank you for filling out the About My Match.</p>
							<ul class="list-unstyled list-inline ri cn">
								<li class=""><button type="button" class="btn cafe-submit saveExit ">Submit</button></li>
								<!-- <li><button type="button" class="btn cafe-submit saveExit">Next</button></li> -->
							</ul>
						</div>
					</div>
					<div class="clearfix"></div>	
				</div>
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

	$('.scrtabs-tab-scroll-arrow-left').on('click',function(){
		$('.scrtabs-tabs-movable-container').removeClass('wod');
	    $('.scrtabs-tabs-movable-container').removeClass('fir');
	});

	$('.scrtabs-tab-scroll-arrow-right').on('click',function(){
		$('.scrtabs-tabs-movable-container').removeClass('wod');
	    $('.scrtabs-tabs-movable-container').removeClass('fir');
	});

	$('.last-step').on('click', function () {
		$('.nav-tabs li').removeClass('active');
		$('.scrtabs-tabs-movable-container').removeClass('fir');
	    $('.al').addClass('active');
	    $('.scrtabs-tabs-movable-container').addClass('wod');
	    $(".last-step-li").addClass('active');
	    $("#tab2").removeClass('active');
	    $("#tab12").addClass('active');
	});

	$('.first-step').on('click', function () {
		$('.nav-tabs li').removeClass('active');
		$('.scrtabs-tabs-movable-container').removeClass('wod');
	    $('.fr').addClass('active');
	    $('.scrtabs-tabs-movable-container').addClass('fir');
	    $(".first-step-li").addClass('active');
	    $("#tab13").removeClass('active');
	    $("#tab2").addClass('active');
	});

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
		var i=0;
		if($(this).is(':checked')){
			$('#tab2 input').prop('checked',true);
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
			$('#tab11 #'+id).prop('checked',true);
		}	
		else
		{
			$('#tab11 #'+id).prop('checked',false);
		}

		$('#tab11 input:checked').each(function(){
			arr.push($(this).val());
		});

		$('#tab11 #matchInterests').val(arr.join(", "));
	});

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
	      		$('.scrtabs-tabs-movable-container').removeClass('wod');
	      		$('.scrtabs-tabs-movable-container').removeClass('fir');
	         	currentTab.removeClass('active');
	         	currentTab.next().addClass('active');
	         	currentTabPane.removeClass('active');
	         	currentTabPane.next().addClass('active');
	         	if($('.edit-profile-tabs .active').find('a').attr('href')>='#tab5'){
	         		$('.scrtabs-tab-scroll-arrow-right').trigger('click');
	         		$('.scrtabs-tab-scroll-arrow-right').trigger('click');
	        	}
	      	}
	    }
	    else {
	      	if (currentTab.prev().length) 
	      	{
	      		$('.scrtabs-tabs-movable-container').removeClass('wod');
	      		$('.scrtabs-tabs-movable-container').removeClass('fir');
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

   	jQuery('#cafe-input').keypress(function() {
			jQuery('.error_msgee').text('');
	});

	jQuery('#locations').change(function() {
		var value = $(this).val();
		if(value != '')
		{
			$('#selected-locations').css('display','block');
			$('.error_mgss').html('');
		}
	});

   	jQuery('#cityname').change(function() {
		var value = $(this).val();
		if(value == '')
		{
			$('#selected-locations').css('display','none');
		}
	});


	var error = '';
	jQuery('#cafe-input').keypress(function(event) {
      	var cafe = jQuery(this).val()+''+event.key;
      	if(cafe.trim()!='' && cafe.length==5){
	      	jQuery.ajax({
	      		type: "GET",
	      		url: "{{ url('/user/cafe-members') }}?cafe_location="+cafe+'&create_account=true',
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

	function getVal(store_name,city,state,zip_code) {
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

	jQuery(document).ready(function(){
		$('#cityname').change(function(){
			var value = $(this).val(); 
			$.ajax({
				type:'GET',
				url: "{{ url('/user/showlocations') }}",
				data : {'city':value},
				success: function(showlocations){
					if(showlocations){
						$('#locations').html(showlocations);
						$('#cctv').val(value);
					}
				}
			});
		});

		jQuery('.check').on('change', function() {
		   jQuery('.check').not(this).prop('checked', false);
		});

		jQuery('.height').on('change', function() {
		   jQuery('.height').not(this).prop('checked', false);
		});

		jQuery('.haircolor').on('change', function() {
		   jQuery('.haircolor').not(this).prop('checked', false);
		});

		jQuery('.language').on('change', function() {
		   jQuery('.language').not(this).prop('checked', false);
		});

		jQuery('.bodytype').on('change', function() {
		   jQuery('.bodytype').not(this).prop('checked', false);
		});

		jQuery('.eyecolor').on('change', function() {
		   jQuery('.eyecolor').not(this).prop('checked', false);
		});

		jQuery('.ethnicity').on('change', function() {
		   jQuery('.ethnicity').not(this).prop('checked', false);
		});

		jQuery('.religion').on('change', function() {
		   jQuery('.religion').not(this).prop('checked', false);
		});
	});

	jQuery(document).ready(function() {
		$('#locations').change(function() {
			var value = $(this).val();
			$.ajax({
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
			});
		});
	});

	jQuery(document).ready(function() {
		$('#locations').change(function() {
			var value = $(this).val();

			if(value != ''){
				$('#cafe-input-hidden').val(value);
			}
		});
	});

	jQuery(document).ready(function(){
		if($('#western').find('option:selected'))
		{
			// $('#western').prop("disabled",true);
		}
	});

	jQuery(document).ready(function(){
		if($('#chinese').find('option:selected'))
		{
			// $('#chinese').prop("disabled",true);
		}
	});

	$(document).on('change','#states',function() {
		var value = $(this).val();
		if(value)
		{
			$.ajax({
  					type:'GET',
					url:"{{url('/user/usacities')}}",
					data : {'state_code':value},
					success: function(usacities) {
  						if(usacities){
  							jQuery('#cities').html(usacities);
  					}
  				}
  			});	
		}
	});

	$(document).on('change','#cities',function() {
		var value = $(this).val();
		$.ajax({
			type:'GET',
			url:"{{url('/user/usalocations')}}",
			data : {'city':value},
			success: function(usalocations){
				if(usalocations){
					$('#locations').html(usalocations);
					$('#cctv').val(value);
				}
			}
		});
	});
	
	jQuery(document).ready(function(){
		jQuery('.cross').on('click', function(){
			var src = $('#up').attr('src');
			$('#up').attr('src', 'https://ifoundyoucanada.com/public/img/profile1.png');
		});
	});

	$(document).on('change','#growupstate',function() {
		var value = $(this).val();
		console.log(value);
		if(value)
		{
			$.ajax({
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
	});

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

jQuery(document).ready(function() {
	$("#select_all").click(function () {
		$(this).prop('checked', true);
	    $("#clear_all").prop('checked', false);
	    $(".act").prop('checked', true);

	    $('.act').each(function()
		{
			var arr = Array();
			$('#tab11 input:checked').each(function()
			{
				arr.push($(this).val());
			});

			$('#tab11 #matchInterests').val(arr.join(", "));
		});
	});

	$("#clear_all").click(function () {
		$(this).prop('checked', true);
		$("#select_all").prop('checked', false);
	    $(".act").prop('checked', false);
	    $("#matchInterests").val('');
	});
});
</script>

@endsection