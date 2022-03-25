@extends('layouts.newuser-edit-profile-dashboard')

@section('content')

<style type="text/css">
	
	/* .glyphicon-chevron-left{
		display: none !important;
	}*/

	.scrtabs-tab-scroll-arrow {
		/*display: none !important;*/
	}

	/*.scrtabs-tab-scroll-arrow-left{
		display: none !important;
	}*/

	.scrtabs-tab-scroll-arrow-right span{
		font-size: 16px !important;
	}
	.scrtabs-tab-scroll-arrow-left{
		font-size: 16px !important;
	}
	.forms-in ul li{
		margin-right: 0px !important;
	}

	.nx {
    text-align: right !important;
    padding-right: 26px !important;
}

.tab-pane h4{
		font-size: 18px !important;
		font-family: verdana;
	}


	.gen{
    /*padding: 50px 0px 50px !important;*/
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

	.npx{
		float: right;border: 2px solid rgba(61,70,77,0.1) !important;
		padding: 45px !important;

	}

	.npx h4{
		padding-left: 62px !important;
	}

	.ro{
	padding-top: 0px !important;
    margin: 0px !important;
    font-family: verdana;
    font-size: 18px !important;
    color: black !important;
    border: none !important;
}

.lii{
	float: right !important;
    width: auto !important;
    margin-top: 0px !important;
}

.nav-inner li a{
		color: black !important;
	}
	.custom_nav{display: none !important;}
	
</style>
<link href="{{ asset('public/css/jquery.scrolling-tabs.css') }}" rel="stylesheet">

<div class="col-md-12 col-sm-12 col-xs-12">

	<ul class="nav-inner">
		<li><a href="{{ url('/user/user-match-info') }}">Home</a></li>
		<!-- <li><a href="{{ url('/user/dashboard')}}">Dashboard</a></li> -->
		<li class=""><a href="{{ url('/user/user-match-info')}}">Edit Profile</a></li>
		<li class=""><a href="{{ url('/user/new_user_edit_profile')}}">About Me</a></li>
		<li class="active"><a href="">About My Match</a></li>
		<li><a href="{{ url('/user/user-profile')}}">My Profile</a></li>
		<li class="lii"><a href="{{url('/log')}}" class="ro"  id="">Sign in</a></li>
		<!-- <li><a href="{{ url('/user/change-photo')}}">My Profile Photo</a></li> -->
	</ul>

	<div class="edit-profile-tabs">
		<!-- Nav tabs -->
		<ul class="nav nav-tabs custom_nav" role="tablist">
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
		<!--   <li role="presentation"><a href="#tab10" role="tab" data-toggle="tab">Cafe Location</a></li> -->
		  <li class="al last-step-li" role="presentation"><a href="#tab12" role="tab" data-toggle="tab">Thank You</a></li>
		</ul>
		 
		<!-- Tab panes -->
		<form method="post" action="{{ url('/user/new_aboutme_profile_update') }}" id="profileForm" enctype="multipart/form-data">
			<div class="tab-content forms-in" id="profile-page">
				{{csrf_field()}}
			  	<div role="tabpanel" class="tab-pane active" id="tab2">
			  		<div class="col-md-12">
			  		<div class="col-md-8 n-s" style="display: none;"><h4 style="display: none;">Gender</h4></div>
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
					<?php 
					// $looking_for = explode(",",Auth::user()->looking_for);
					// $looking_for=array_map('trim',$looking_for);
					?>
					<div class="col-md-12 px"><h4>Gender</h4>
					<div class="col-md-12 gen">
					<div class="col-md-3 col-sm-3 col-xs-12" id="">
						<input type="hidden" name="name" value="{{Auth::user()->name}}">
						<input type="hidden" name="day" value = "{{Auth::user()->day}}">
						<input type="hidden" name="month" value = "{{ Auth::user()->month}}">
						<input type="hidden" name="year" value = "{{Auth::user()->year}}">
						<input type="hidden" name="chinese_sign" value="{{Auth::user()->chinese_sign}}">
						<input type="hidden" name="western_sign" value="{{$zodic}}">
						<input type="hidden" name="sex" id="looking_for_date" value="{{ Auth::user()->sex }}">

						

						<div><input type="checkbox" name="about_gender" class="check" @if(Auth::user()->about_gender == "Male") checked @endif  value="Straight Male"> <label>Straight Male</label></div>
						<div><input type="checkbox" name="about_gender" class="check" @if(Auth::user()->about_gender == "Gay Male") checked @endif  value="Gay Male"> <label>Gay Male </label></div>
						
					</div>
					<div class="col-md-3 col-sm-3 col-xs-12">
						<div><input type="checkbox" name="about_gender" class="check" @if(Auth::user()->about_gender == "Female") checked @endif  value="Straight Female"> <label>Straight Female</label></div>
						<div><input type="checkbox" name="about_gender" class="check" @if(Auth::user()->about_gender == "Gay Female") checked @endif  value="Gay Female"> <label>Gay Female </label></div>
					</div>
					<div class="col-md-2 col-sm-2 col-xs-12">
						<div><input type="checkbox" name="about_gender" class="check" @if(Auth::user()->about_gender == "Bi Female") checked @endif  value="Bi Female"> <label>Bi Female</label></div>
						<div><input type="checkbox" name="about_gender" class="check" @if(Auth::user()->about_gender == "Bi Male") checked @endif  value="Bi Male"> <label>Bi Male </label></div>
						<div><input type="checkbox" name="about_gender" class="about_gender" @if(Auth::user()->about_gender == "Any") checked @endif  value = "Any"> <label>Any </label></div>
					</div>
				</div>
			</div>
					<div class="col-md-3 col-sm-3 col-xs-12">

					
				</div>

					<div class="clearfix"></div>
					
			  	</div>
			  	<div role="tabpanel" class="tab-pane" id="tab3">
			  		<div class="col-md-12">
			  		<div class="col-md-8" style="display: none;"><h4 style="display: none;">Height</h4></div>
			  		<div class="col-md-12"><ul class="list-unstyled list-inline">
			  			<li class="prev-step-li"><button type="button" class="btn cafe-submit prev-step" data-toggle="tab" href="#tab2">{{--<i class="fa fa-chevron-left"></i>--}}First</button></li>
						<li class="prev-step-li"><button type="button" class="btn cafe-submit prev-step" data-toggle="tab" href="#tab2">{{--<i class="fa fa-chevron-left"></i>--}} Back</button></li>
						<li class="next-step-li"><button type="button" class="btn cafe-submit next-step" data-toggle="tab" href="#tab4">Next {{--<i class="fa fa-chevron-right"></i>--}}</button></li>
						<li class=""><button type="button" class="btn cafe-submit last-step" data-toggle="tab" href="#tab12">Last {{--<i class="fa fa-chevron-right"></i>--}}</button></li>
						<!-- <li><button type="button" class="btn cafe-submit saveExit">Save & Exit</button></li> -->
					</ul></div></div>

					<div class="col-md-12 px"><h4>Height</h4>
					<div class="col-md-12 gen">
					<div class="col-md-3 col-sm-3 col-xs-12" id="">
						

						<div><input type="checkbox" name="about_height" class="about_height" @if(Auth::user()->about_height == "5.1") checked @endif value = "5.1" > <label>5.1</label></div>
						<div><input type="checkbox" name="about_height" class="about_height" @if(Auth::user()->about_height == "5.2") checked @endif value = "5.2" > <label>5.2 </label></div>
						<div><input type="checkbox" name="about_height" class="about_height" @if(Auth::user()->height == "5.3") checked @endif value = "5.3" > <label>5.3</label></div>
					</div>
					<div class="col-md-3 col-sm-3 col-xs-12">
						<div><input type="checkbox" name="about_height" class="about_height" @if(Auth::user()->about_height == "5.4") checked @endif value = "5.4" > <label>5.4</label></div>
						<div><input type="checkbox" name="about_height" class="about_height" @if(Auth::user()->about_height == "5.5") checked @endif value = "5.5" > <label>5.5 </label></div>
						<div><input type="checkbox" name="height" class="height" @if(Auth::user()->height == "5.6") checked @endif value = "5.6" > <label>5.6 </label></div>
					</div>
					<div class="col-md-3 col-sm-3 col-xs-12">
						<div><input type="checkbox" name="about_height" class="about_height" @if(Auth::user()->about_height == "5.7") checked @endif value = "5.7" > <label>5.7</label></div>
						<div><input type="checkbox" name="about_height" class="about_height" @if(Auth::user()->about_height == "5.8") checked @endif  value = "5.8"> <label>5.8 </label></div>
						<div><input type="checkbox" name="about_height" class="about_height" @if(Auth::user()->about_height == "5.9") checked @endif value = "5.9" > <label>5.9 </label></div>
					</div>

					<div class="col-md-3 col-sm-3 col-xs-12">
						<div><input type="checkbox" name="about_height" class="about_height" @if(Auth::user()->about_height == "6.0") checked @endif  value = "6.0"> <label>6.0</label></div>
						<div><input type="checkbox" name="about_height" class="about_height" @if(Auth::user()->about_height == "6.0+") checked @endif  value = "6.0+"> <label>6.0+ </label></div>
						<div><input type="checkbox" name="about_height" class="about_height" @if(Auth::user()->about_height == "Any") checked @endif  value = "Any"> <label>Any </label></div>
					</div>
				</div>
			</div>

					<div class="clearfix"></div>

					
			  	</div>
				<div role="tabpanel" class="tab-pane" id="tab4">
					<div class="col-md-12">
					<div class="col-md-8 n-s" style="display: none;"><h4 style="display: none;">Hair Color</h4></div>
					<div class="col-md-12"><ul class="list-unstyled list-inline ">
						<li class="-li"><button type="button" class="btn cafe-submit first-step" data-toggle="tab" href="#tab2">{{--<i class="fa fa-chevron-left"></i>--}} First</button></li>
						<li class="prev-step-li"><button type="button" class="btn cafe-submit prev-step" data-toggle="tab" href="#tab3">{{--<i class="fa fa-chevron-left"></i>--}} Back</button></li>
						<!-- <li><button type="button" class="btn cafe-submit saveExit">Save & Exit</button></li> -->
						<li class="next-step-li"><button type="button" class="btn cafe-submit next-step" data-toggle="tab" href="#tab6">Next {{--<i class="fa fa-chevron-right"></i>--}}</button></li>
						<li class=""><button type="button" class="btn cafe-submit last-step" data-toggle="tab" href="#tab12">Last {{--<i class="fa fa-chevron-right"></i>--}}</button></li>
					</ul></div>
					</div>
					<div class="col-md-12 px"><h4>Hair Color</h4>
					<div class="col-md-12 gen">
					<div class="col-md-4 col-sm-4 col-xs-12">
						<div><input type="checkbox" name="about_haircolor" class="about_haircolor" @if(Auth::user()->about_haircolor == "Bald") checked @endif  value="Bald"> <label>Bald</label></div>
						<div><input type="checkbox" name="about_haircolor" class="about_haircolor" @if(Auth::user()->about_haircolor == "Black") checked @endif  value="Black"> <label>Black </label></div>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12">
						<div><input type="checkbox" name="about_haircolor" class="about_haircolor" @if(Auth::user()->about_haircolor == "Blonde") checked @endif  value="Blonde"> <label>Blonde</label></div>
						<div><input type="checkbox" name="about_haircolor"  class="about_haircolor" @if(Auth::user()->about_haircolor == "Brown") checked @endif  value="Brown"> <label>Brown </label></div>
					</div>

					<div class="col-md-4 col-sm-4 col-xs-12">
						<div><input type="checkbox" name="about_haircolor" class="about_haircolor" @if(Auth::user()->about_haircolor == "Burnette") checked @endif  value="Burnette"> <label>Burnette</label></div>
						<div><input type="checkbox" name="about_haircolor" class="about_haircolor" @if(Auth::user()->about_haircolor == "Red") checked @endif  value="Red"> <label>Red </label></div>
						<div><input type="checkbox" name="about_haircolor" class="about_haircolor" @if(Auth::user()->about_haircolor == "Any") checked @endif  value="Any"> <label>Any </label></div>
					</div>
				</div>
			</div>

					<div class="clearfix"></div>
					
				</div>
				<!-- <div role="tabpanel" class="tab-pane" id="tab5">
				@if(Auth::user()->continent == 'Europe' || Auth::user()->continent == 'Canada' || Auth::user()->continent == 'England')
					<div class="col-md-5 col-sm-6 col-xs-12">
						<h4>What city did you grow up in?</h4>
						<select class="form-control" name="state">
							<option value="">Select City</option>
							@foreach($cities as $view)
								<option value="{{$view->city_name}}" @if(Auth::user()->state == $view->city_name) selected @endif>{{$view->city_name}}</option>
							@endforeach
						</select>
					</div>
					<div class="col-md-5 col-sm-6 col-xs-12">
						<h4>I Live In</h4>
						<select class="form-control" name="live_in">
							<option value="">Select City</option>
							@foreach($cities as $view)
								<option value="{{$view->city_name}}" @if(Auth::user()->live_in == $view->city_name) selected @endif>{{$view->city_name}}</option>
							@endforeach
						</select>
					</div>
					@else
					
					<div class="col-md-5 col-sm-6 col-xs-12">
						<h4>What state did you grow up in?</h4>
						<select class="form-control" id="growupstate" name="state">
							<option value="">Select State</option>
							@foreach($states as $state)
							<option value="{{ $state->nstate }}" @if(Auth::user()->state == $state->nstate) selected @endif>{{ $state->nstate }}</option>
							@endforeach
						</select>
					</div>
					<div class="col-md-5 col-sm-6 col-xs-12">
						<h4>What city did you grow up in?</h4>
						<select class="form-control" id="liveincity" name="live_in">
								
						</select>
					</div>
					
					@endif
					<div class="clearfix"></div>
					<ul class="list-unstyled list-inline">
						<li class="prev-step-li"><button type="button" class="btn cafe-submit prev-step" data-toggle="tab" href="#tab4"><i class="fa fa-chevron-left"></i> Back</button></li>
						<li class="next-step-li"><button type="button" class="btn cafe-submit next-step" data-toggle="tab" href="#tab6">Next <i class="fa fa-chevron-right"></i></button></li>
					</ul>
				</div> -->
				<div role="tabpanel" class="tab-pane" id="tab6">
					<div class="col-md-12">
					<div class="col-md-8" style="display: none;"><h4 style="display: none;">Language</h4></div>
					<div class="col-md-12"><ul class="list-unstyled list-inline ">
						<li class="-li"><button type="button" class="btn cafe-submit first-step" data-toggle="tab" href="#tab2">{{--<i class="fa fa-chevron-left"></i>--}} First</button></li>
						<li class="prev-step-li"><button type="button" class="btn cafe-submit prev-step" data-toggle="tab" href="#tab4">{{--<i class="fa fa-chevron-left"></i>--}} Back</button></li>
						<!-- <li><button type="button" class="btn cafe-submit saveExit">Save & Exit</button></li> -->
						<li class="next-step-li"><button type="button" class="btn cafe-submit next-step" data-toggle="tab" href="#tab7">Next {{--<i class="fa fa-chevron-right"></i>--}}</button></li>
						<li class="last-step"><button type="button" class="btn cafe-submit last-step" data-toggle="tab" href="#tab12">Last {{--<i class="fa fa-chevron-right"></i>--}}</button></li>
					</ul></div></div>
					<div class="col-md-12 px"><h4>Language</h4>
					<div class="col-md-12 gen">
						<div class="col-md-4 col-sm-4 col-xs-12">
						<div><input type="checkbox" name="about_language" class="about_language" @if(Auth::user()->about_language == "Chinese") checked @endif  value="Chinese"> <label>Chinese</label></div>
						<div><input type="checkbox" name="about_language" class="about_language" @if(Auth::user()->about_language == "English") checked @endif  value="English"> <label>English </label></div>
						<div><input type="checkbox" name="about_language" class="about_language" @if(Auth::user()->about_language == "French") checked @endif  value="French"> <label>French </label></div>
						<div><input type="checkbox" name="about_language" class="about_language" @if(Auth::user()->about_language == "German") checked @endif  value="German"> <label>German </label></div>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12">
						<div><input type="checkbox" name="about_language" class="about_language" @if(Auth::user()->about_language == "Hebrew") checked @endif  value="Hebrew"> <label>Hebrew </label></div>
						<div><input type="checkbox" name="about_language" class="about_language" @if(Auth::user()->about_language == "Hindi") checked @endif  value="Hindi"> <label>Hindi </label></div>
						<div><input type="checkbox" name="about_language" class="about_language" @if(Auth::user()->about_language == "Itilian") checked @endif  value="Itilian"> <label>Itilian </label></div>
						<div><input type="checkbox" name="about_language" class="about_language" @if(Auth::user()->about_language == "Russian") checked @endif  value="Russian"> <label>Russian </label></div>
					</div>

					<div class="col-md-4 col-sm-4 col-xs-12">
						<div><input type="checkbox" name="about_language" class="about_language" @if(Auth::user()->about_language == "Spanish") checked @endif  value="Spanish"> <label>Spanish </label></div>
						<div><input type="checkbox" name="about_language" class="about_language" @if(Auth::user()->about_language == "Any") checked @endif  value="Any"> <label>Any </label></div>
					</div>
				</div>
			</div>
					<div class="clearfix"></div>
					
					<div class="clearfix"></div>
					
				</div>
				<div role="tabpanel" class="tab-pane" id="tab7">
					<div class="col-md-12">
					<div class="col-md-8" style="display: none;"><h4 style="display: none;">Body Type</h4></div>
					<div class="col-md-12"><ul class="list-unstyled list-inline ">
						<li class="-li"><button type="button" class="btn cafe-submit first-step" data-toggle="tab" href="#tab2">{{--<i class="fa fa-chevron-left"></i>--}} First</button></li>
						<li class="prev-step-li"><button type="button" class="btn cafe-submit prev-step" data-toggle="tab" href="#tab6">{{--<i class="fa fa-chevron-left"></i>--}} Back</button></li>
						<!-- <li><button type="button" class="btn cafe-submit saveExit">Save & Exit</button></li> -->
						<li class="next-step-li"><button type="button" class="btn cafe-submit next-step" data-toggle="tab" href="#tab8">Next {{--<i class="fa fa-chevron-right"></i>--}}</button></li>
						<li class="last-step"><button type="button" class="btn cafe-submit last-step" data-toggle="tab" href="#tab12">Last {{--<i class="fa fa-chevron-right"></i>--}}</button></li>
					</ul></div></div>
					<div class="col-md-12 px"><h4>Body Type</h4>
					<div class="col-md-12 gen">
						<div class="col-md-4 col-sm-4 col-xs-12">
						<div><input type="checkbox" name="about_bodytype" class="about_bodytype" @if(Auth::user()->about_bodytype == "Above Average") checked @endif  value="Above Average"> <label>Above Average</label></div>
						<div><input type="checkbox" name="about_bodytype" class="about_bodytype" @if(Auth::user()->about_bodytype == "Atheltic") checked @endif  value="Atheltic"> <label>Athletic </label></div>
						
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12">
						<div><input type="checkbox" name="about_bodytype" class="about_bodytype" @if(Auth::user()->about_bodytype == "Average") checked @endif  value="Average"> <label>Average </label></div>
						<div><input type="checkbox" name="about_bodytype" class="about_bodytype" @if(Auth::user()->about_bodytype == "Full Figured") checked @endif  value="Full Figured"> <label>Full Figured </label></div>
					</div>

					<div class="col-md-4 col-sm-4 col-xs-12">
						<div><input type="checkbox" name="about_bodytype" class="about_bodytype" @if(Auth::user()->about_bodytype == "Slender") checked @endif  value="Slender"> <label>Slender </label></div>
						<div><input type="checkbox" name="about_bodytype" class="about_bodytype" @if(Auth::user()->about_bodytype == "Any") checked @endif  value="Any"> <label>Any </label></div>
					</div>
				</div>
			</div>
					<div class="clearfix"></div>
					
					
					<div class="clearfix"></div>
					<!-- <ul class="list-unstyled list-inline">
						<li class="prev-step-li"><button type="button" class="btn cafe-submit prev-step" data-toggle="tab" href="#tab6"> -->
							{{--<i class="fa fa-chevron-left"></i>--}} <!-- Back</button></li> -->
						<!-- <li><button type="button" class="btn cafe-submit saveExit">Save & Exit</button></li> -->
						<!-- <li class="next-step-li"><button type="button" class="btn cafe-submit next-step" data-toggle="tab" href="#tab8"> --><!-- Next --> {{--<i class="fa fa-chevron-right"></i>--}}<!-- </button></li> -->
					<!-- </ul> -->
				</div>
				<div role="tabpanel" class="tab-pane" id="tab8">
					<div class="col-md-12">
					<div class="col-md-8 n-s" style="display: none;"><h4 style="display: none;">Eye Color</h4></div>
					<div class="col-md-12"><ul class="list-unstyled list-inline ">

						<li class="-li"><button type="button" class="btn cafe-submit first-step" data-toggle="tab" href="#tab2">{{--<i class="fa fa-chevron-left"></i>--}} First</button></li>
						<li class="prev-step-li"><button type="button" class="btn cafe-submit prev-step" data-toggle="tab" href="#tab7">{{--<i class="fa fa-chevron-left"></i>--}} Back</button></li>
						<!-- <li><button type="button" class="btn cafe-submit saveExit">Save & Exit</button></li> -->
						<li class="next-step-li"><button type="button" class="btn cafe-submit next-step" data-toggle="tab" href="#tab9">Next {{--<i class="fa fa-chevron-right"></i>--}}</button></li>
						<li class="last-step"><button type="button" class="btn cafe-submit last-step" data-toggle="tab" href="#tab12">Last {{--<i class="fa fa-chevron-right"></i>--}}</button></li>
					</ul></div></div>
					<div class="col-md-12 px"><h4>Eye Color</h4>
				<div class="col-md-12 gen">
						<div class="col-md-4 col-sm-4 col-xs-12">
						<div><input type="checkbox" name="about_eyecolor" class="about_eyecolor" @if(Auth::user()->about_eyecolor == "Blue") checked @endif  value="Blue"> <label>Blue</label></div>
						<div><input type="checkbox" name="about_eyecolor" class="about_eyecolor" @if(Auth::user()->about_eyecolor == "Brown") checked @endif  value="Brown"> <label>Brown </label></div>
						
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12">
						<div><input type="checkbox" name="about_eyecolor" class="about_eyecolor" @if(Auth::user()->about_eyecolor == "Green") checked @endif  value="Green"> <label>Green </label></div>
						
						<div><input type="checkbox" name="about_eyecolor" class="about_eyecolor" @if(Auth::user()->about_eyecolor == "Hazel") checked @endif  value="Hazel"> <label>Hazel </label></div>
					</div>

					<div class="col-md-4 col-sm-4 col-xs-12">
						<div><input type="checkbox" name="about_eyecolor" class="about_eyecolor" @if(Auth::user()->about_eyecolor == "Any") checked @endif  value="Any"> <label>Any </label></div>
					</div>
				</div>
			</div>

					

					<div class="clearfix"></div>
					
					
				</div>
				<div role="tabpanel" class="tab-pane" id="tab9">
					
					<div class="col-md-12">
					<div class="col-md-8 n-s" style="display: none;"><h4 style="display: none;">Ethnicity</h4></div>
					<div class="col-md-12"><ul class="list-unstyled list-inline">
						<li class="-li"><button type="button" class="btn cafe-submit first-step" data-toggle="tab" href="#tab2">{{--<i class="fa fa-chevron-left"></i>--}} First</button></li>
						<li class="prev-step-li"><button type="button" class="btn cafe-submit prev-step" data-toggle="tab" href="#tab8">{{--<i class="fa fa-chevron-left"></i>--}} Back</button></li>
						<!-- <li><button type="button" class="btn cafe-submit saveExit">Save & Exit</button></li> -->
						<li class="next-step-li"><button type="button" class="btn cafe-submit next-step" data-toggle="tab" href="#tab10">Next {{--<i class="fa fa-chevron-right"></i>--}}</button></li>
						<li class="last-step"><button type="button" class="btn cafe-submit last-step" data-toggle="tab" href="#tab12">Last {{--<i class="fa fa-chevron-right"></i>--}}</button></li>
					</ul></div></div>
					<div class="col-md-12 px"><h4>Ethnicity</h4>
					<div class="col-md-12 gen">
					<div class="col-md-3 col-sm-3 col-xs-12">
						<div><input type="checkbox" name="about_ethnicity" class="about_ethnicity" @if(Auth::user()->about_ethnicity == "African American") checked @endif  value="African American"> <label>African American </label></div>
						
						<div><input type="checkbox" name="about_ethnicity" class="about_ethnicity" @if(Auth::user()->about_ethnicity == "Asian") checked @endif  value="Asian"> <label>Asian </label></div>
					</div>

					<div class="col-md-3 col-sm-3 col-xs-12">
						<div><input type="checkbox" name="about_ethnicity" class="about_ethnicity" @if(Auth::user()->about_ethnicity == "Caucasian") checked @endif  value="Caucasian"> <label>Caucasian </label></div>
						
						<div><input type="checkbox" name="about_ethnicity" class="about_ethnicity" @if(Auth::user()->about_ethnicity == "European") checked @endif  value="European"> <label>European </label></div>
					</div>

					<div class="col-md-3 col-sm-3 col-xs-12">
						<div><input type="checkbox" name="about_ethnicity" class="about_ethnicity" @if(Auth::user()->about_ethnicity == "Hispanic") checked @endif  value="Hispanic"> <label>Hispanic </label></div>
						
						<div><input type="checkbox" name="about_ethnicity" class="about_ethnicity" @if(Auth::user()->about_ethnicity == "Multiracial") checked @endif  value="Multiracial"> <label>Multiracial </label></div>
					</div>

					<div class="col-md-3 col-sm-3 col-xs-12">
						<div><input type="checkbox" name="about_ethnicity" class="about_ethnicity" @if(Auth::user()->about_ethnicity == "Native American") checked @endif  value="Native American"> <label>Native American </label></div>
						<div><input type="checkbox" name="about_ethnicity" class="about_ethnicity" @if(Auth::user()->about_ethnicity == "Any") checked @endif  value="Any"> <label>Any </label></div>
					</div>

				</div>
			</div>
					<div class="clearfix"></div>
					
				</div>

				<div role="tabpanel" class="tab-pane" id="tab10">
					
					<div class="col-md-12">
					<div class="col-md-8 n-s" style="display: none;"><h4 style="display: none;">Religion</h4></div>
					<div class="col-md-12"><ul class="list-unstyled list-inline">
						<li class="-li"><button type="button" class="btn cafe-submit first-step" data-toggle="tab" href="#tab2">{{--<i class="fa fa-chevron-left"></i>--}} First</button></li>
						<li class="prev-step-li"><button type="button" class="btn cafe-submit prev-step" data-toggle="tab" href="#tab9">{{--<i class="fa fa-chevron-left"></i>--}} Back</button></li>
						<!-- <li><button type="button" class="btn cafe-submit saveExit">Save & Exit</button></li> -->
						<li class="next-step-li"><button type="button" class="btn cafe-submit next-step" data-toggle="tab" href="#tab11">Next {{--<i class="fa fa-chevron-right"></i>--}}</button></li>
						<li class="last-step"><button type="button" class="btn cafe-submit last-step" data-toggle="tab" href="#tab12">Last {{--<i class="fa fa-chevron-right"></i>--}}</button></li>
					</ul></div></div>
					<div class="col-md-12 px"><h4>Religion</h4>
				<div class="col-md-12 gen">
					<div class="col-md-3 col-sm-3 col-xs-12">
						<div><input type="checkbox" name="about_religion" class="about_religion" @if(Auth::user()->about_religion == "Buddhism") checked @endif  value="Buddhism"> <label>Buddhism </label></div>
						
						<div><input type="checkbox" name="about_religion" class="about_religion" @if(Auth::user()->about_religion == "Catholicism") checked @endif  value="Catholicism"> <label>Catholicism </label></div>
					</div>

					<div class="col-md-3 col-sm-3 col-xs-12">
						<div><input type="checkbox" name="about_religion" class="about_religion" @if(Auth::user()->about_religion == "Christianity") checked @endif  value="Christianity"> <label>Christianity </label></div>
						
						<div><input type="checkbox" name="about_religion" class="about_religion" @if(Auth::user()->about_religion == "Hinduism") checked @endif  value="Hinduism"> <label>Hinduism </label></div>
					</div>

					<div class="col-md-3 col-sm-3 col-xs-12">
						<div><input type="checkbox" name="about_religion" class="about_religion" @if(Auth::user()->about_religion == "Islam") checked @endif  value="Islam"> <label>Islam </label></div>
						
						<div><input type="checkbox" name="about_religion" class="about_religion" @if(Auth::user()->about_religion == "Judaism") checked @endif  value="Judaism"> <label>Judaism </label></div>
					</div>

					<div class="col-md-3 col-sm-3 col-xs-12">
						<div><input type="checkbox" name="about_religion" class="about_religion" @if(Auth::user()->about_religion == "New Age") checked @endif  value="New Age"> <label>New Age </label></div>
						<div><input type="checkbox" name="about_religion" class="about_religion" @if(Auth::user()->about_religion == "Any") checked @endif  value="Any"> <label>Any </label></div>
					</div>
				</div>
			</div>
					<div class="clearfix"></div>
					
				</div>
					<!-- <input type="hidden" value="create_account" name="create_account">  -->
					<input type="hidden" value="{{ Auth::user()->cafe }}" name="cafe" id="cafe-input-hidden"> 
					<input type="hidden" id="cctv" value="{{Auth::user()->city}}" name="cccity">
					<input type="hidden" id="" value = "{{Auth::user()->ustate}}" name="states">
<!-- 
					@if(Auth::user()->continent == 'USA')
					<div class="col-md-6 col-sm-6 col-xs-12">
						<select id="states" class="form-control" name="states">
							<option value="">Select State:</option>
							@foreach($states as $view)
								@if(Auth::user()->ustate == $view->state_code)
									<option value="{{$view->state_code}}" selected>{{$view->nstate}}</option>
								@else
									<option value="{{$view->state_code}}">{{$view->nstate}}</option>
								@endif
							@endforeach
						</select>
						<p style="color:red;text-align:left" class="error_mgs"></p>
					</div>

					<div class="col-md-6 col-sm-6 col-xs-12">
						
						<select id="cities" class="form-control" name="cityname">
							
						</select>
						<p style="color:red;text-align:left" class="error_mg"></p>
					</div>

					<div class="col-md-12" style="margin-top: 10px;" id="selected-locations">
						<h3>Selected Location:</h3>
						<div id="selectedlocation"></div>
					</div> 
					@else
					<div id="citywise" class="citywse">
						<div class="col-md-5 col-sm-6 col-xs-12">
							<select id="cityname" class="form-control" name="cityname">
							<option value="">Select City:</option>
							@foreach($cities as $view)
								@if(Auth::user()->city == $view->city_name)
									<option value="{{$view->city_name}}" selected>{{$view->city_name}}</option>
								@else
									<option value="{{$view->city_name}}">{{$view->city_name}}</option>
								@endif
							@endforeach
							</select>
						</div>
						<div class="col-md-5 col-sm-6 col-xs-12">
							<select id ="locations" class="form-control">
								@if(Auth::user()->cafe != '')
									<option value = "">{{$cafe_modify->address_line_1}}:</option>
								@else
									<option value = "">Choose Location:</option>
								@endif
							</select>
						</div>
						<div class="col-md-12" style="margin-top: 10px;" id="selected-locations">
							<h3>Selected Location:</h3>
							<div id="selectedlocation"></div>
						</div> 
					</div>
					@endif
					
					<div class="clearfix"></div>
					<div class="col-md-12" style="margin-top: 10px;">
						<div class="location-wrap">
							
						</div>
						<span class="blue-span option_error"></span>
					</div>
					<div class="clearfix"></div>
					<ul class="list-unstyled list-inline">
						<li class="prev-step-li"><button type="button" class="btn cafe-submit prev-step" data-toggle="tab" href="#tab9"><i class="fa fa-chevron-left"></i> Back</button></li>
						<li><button type="button" class="btn cafe-submit next-step" href="#tab11">Next <i class="fa fa-chevron-right"></i></button></li>
					</ul>
				</div> -->

				<div role="tabpanel" class="tab-pane" id="tab11">
					
					<div class="col-md-12">
				<div class="col-md-8 n-s" style="display: none;"><h4 style="display: none;">My Match Interests</h4></div>
					<div class="col-md-12"><!-- ul class="list-unstyled list-inline list-custom">
						<li class="prev-step-li"><button type="button" class="btn cafe-submit prev-step" data-toggle="tab" href="#tab10">{{--<i class="fa fa-chevron-left"></i>--}} Back</button></li>
						<li><button type="button" class="btn cafe-submit saveExit">Next</button></li>
					</ul> --> <ul class="list-unstyled list-inline">
						<li class="-li"><button type="button" class="btn cafe-submit first-step" data-toggle="tab" href="#tab2">{{--<i class="fa fa-chevron-left"></i>--}} First</button></li>
						<li class="prev-step-li"><button type="button" class="btn cafe-submit prev-step" data-toggle="tab" href="#tab10">{{--<i class="fa fa-chevron-left"></i>--}} Back</button></li>
						<li class="next-step-li"><button type="button" class="btn cafe-submit next-step" data-toggle="tab" href="#tab12">Next {{--<i class="fa fa-chevron-right"></i>--}}</button></li>
						<li class="last-step"><button type="button" class="btn cafe-submit last-step" data-toggle="tab" href="#tab12">Last {{--<i class="fa fa-chevron-right"></i>--}}</button></li>
						
					</ul></div></div>
					<div class="col-md-12 px"><h4>My Match Interests</h4>
					<div class="col-md-12 gen">
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
								foreach ($activities as $activity) {
									if(in_array("$activity->activity_name",$matchInterest_selected)){
										$checked = 'checked';
									}else{
										$checked ='';
									}
								 ?>

								<div><input type="checkbox" class="act" id="{{$activity->id}}" name="matchInterests" value="{{$activity->activity_name}}" <?php echo $checked; ?> > <label>{{$activity->activity_name}}</label></div>

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

				<!-- <div role="tabpanel" class="tab-pane" id="tab11"> -->
					<!-- <div class="col-md-12">	
						<p style="text-align:center" class="thank-you-style">Thank you for filling out your ifoundyou profile.</p>
						<p style="text-align:center" class="thank-you-style">Please check your email to confirm your account .</p>
					</div> -->
					<!-- <div class="col-md-12 show_map" style="margin-top: 10px;">
					@if($cafe)
						<iframe
							width="100%"
							height="450"
							frameborder="0" style="border:0"
							src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBGO8o4JyybRaVx409C2tNowstVKD42FFU&q={{ urlencode($cafe->store_name.','.$cafe->city.','.$cafe->country.','.$cafe->zip_code) }}" allowfullscreen>
							</iframe>
					@else
						<iframe
							width="100%"
							height="450"
							frameborder="0" style="border:0"
							src="" allowfullscreen>
						</iframe>
					@endif
					</div> -->
					<!-- <div class="col-md-12" style="margin-top: 10px;" id="new-selected-locations">
						<div id="new-selected-area">
						@if($cafe)
							<h3 style="text-align:center">{{$cafe->store_name}},{{$cafe->city}}, {{$cafe->country}},{{$cafe->zip_code}}</h3>
						@endif
						</div>
					</div> -->

					<div class="clearfix"></div>
					<!-- <ul class="list-unstyled list-inline">
						<li class="prev-step-li"><button type="button" class="btn cafe-submit prev-step" data-toggle="tab" href="#tab10">{{--<i class="fa fa-chevron-left"></i>--}} Back</button></li>
						<li><button type="button" class="btn cafe-submit saveExit">Submit</button></li>
					</ul> -->
				<!-- </div> -->
				<input class="btn custom-btn acc-submit" type="submit" id="save" style="display: none;">
			</div>

			<div role="tabpanel" class="tab-pane last-step-div" id="tab12">
					<div class="col-md-12" style="float: right;">
						<ul class="list-unstyled list-inline ri nx">
							<!-- <li class="prev-step-li"><button type="button" class="btn cafe-submit prev-step-li first-step" data-toggle="tab" href="#tab2">{{--<i class="fa fa-chevron-left"></i>--}} First</button></li>
						<li class="prev-step-li"><button type="button" class="btn cafe-submit prev-step" data-toggle="tab" href="#tab11">{{--<i class="fa fa-chevron-left"></i>--}} Back</button></li> -->
						<!-- <li><button type="button" class="btn cafe-submit saveExit">Submit</button></li> -->
					</ul>
					</div>
					<div class="col-md-12 npx">	
						<p style="text-align:center;" class="thank-you-style">Thank you for filling out the About My Match.</p>
						<!-- <p style="text-align:center" class="thank-you-style">Please check your email to confirm your account .</p> -->
						<ul class="list-unstyled list-inline ri cn">
							
						<li class=""><button type="button" class="btn cafe-submit saveExit ">Submit</button></li>
						<!-- <li><button type="button" class="btn cafe-submit saveExit">Next</button></li> -->
					</ul>
					</div>

					
					<!-- <div class="col-md-12 show_map" style="margin-top: 10px;">
					@if($cafe)
						<iframe
							width="100%"
							height="450"
							frameborder="0" style="border:0"
							src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBGO8o4JyybRaVx409C2tNowstVKD42FFU&q={{ urlencode($cafe->store_name.','.$cafe->city.','.$cafe->country.','.$cafe->zip_code) }}" allowfullscreen>
							</iframe>
					@else
						<iframe
							width="100%"
							height="450"
							frameborder="0" style="border:0"
							src="" allowfullscreen>
						</iframe>
					@endif
					</div> -->
					<!-- <div class="col-md-12" style="margin-top: 10px;" id="new-selected-locations">
						<div id="new-selected-area">
						@if($cafe)
							<h3 style="text-align:center">{{$cafe->store_name}},{{$cafe->city}}, {{$cafe->country}},{{$cafe->zip_code}}</h3>
						@endif
						</div>
					</div> -->

					<div class="clearfix"></div>
					
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

		// $('.scrtabs-tabs-movable-container').addClass('sx');
	})

	$('.scrtabs-tab-scroll-arrow-right').on('click',function(){
		$('.scrtabs-tabs-movable-container').removeClass('wod');
	    $('.scrtabs-tabs-movable-container').removeClass('fir');


		// $('.scrtabs-tabs-movable-container').addClass('sx');
	})

	$('.last-step').on('click', function () {
		$('.nav-tabs li').removeClass('active');
		$('.scrtabs-tabs-movable-container').removeClass('fir');
	    $('.al').addClass('active');
	    $('.scrtabs-tabs-movable-container').addClass('wod');
	    $(".last-step-li").addClass('active');
	    $("#tab2").removeClass('active');
	    $("#tab12").addClass('active');
	    // currentTabPane.removeClass('active');
	    // currentTabPane.next().addClass('active');
	});

	$('.first-step').on('click', function () {
		$('.nav-tabs li').removeClass('active');
		$('.scrtabs-tabs-movable-container').removeClass('wod');
	    $('.fr').addClass('active');
	    $('.scrtabs-tabs-movable-container').addClass('fir');
	    $(".first-step-li").addClass('active');
	    $("#tab13").removeClass('active');
	    $("#tab2").addClass('active');
	    // currentTabPane.removeClass('active');
	    // currentTabPane.next().addClass('active');
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

	    } else {
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

.cross{
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
 .nav-tabs{
 	border-bottom:0px !important;
 }
 .tab-content{
 	/*box-shadow:1px 3px 11px #337ab7;*/
 	margin-top:20px;
 	margin-bottom: 60px;
 	padding-bottom: 80px !important;
 	background-color: #fff;
 	/*border: 2px solid rgba(61,70,77,0.1);*/
 	border-top: 0px;
 	/*background: #80808030;*/
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
	.wod{
		/*width: 2071px !important;
    	left: -1016.84px !important;*/
    	width: 2301px !important; left: -976px !important;
	}

	.fir
	{
		/*width: 2071px !important;
    	left: 0px !important;*/
    	width: 2301px !important;
    	left: 0px !important;
	}
	input[type="file"]{width: auto;margin-top: 20px;}
	.nav-inner{margin: 0px;}
	.image_error{float: left;width: 100%;text-align: center !important;margin-top: 10px;}
	.uploaded_image{max-height: 200px;}
	.buttonparent{text-align: center !important;margin-top: 20px;}
	.scrtabs-tab-container, .scrtabs-tabs-fixed-container{height: 0;}
</style>
<script type="text/javascript">
	
	jQuery(document).ready(function(){
		jQuery('.cross').on('click', function(){
			var src = $('#up').attr('src');
			// alert(src);
			// $("#up").remove(); 
			 // $("#up").empty();
			 // $('#up').val('');
			 $('#up').attr('src', 'https://ifoundyoucanada.com/public/img/profile1.png');
			 // $("#up");
			// id = $(this).attr('data-id');
			// alert(id);
			 // $.ajax({
    //             url:  "{{ url('/user/deleteimage') }}",
    //             method: 'GET',
    //             data : {'id': id},
    //             success: function( data ) {
    //                 if( data ) {
    //                     jQuery("#up").load("#up");
    //                 }
    //             }
    //         });
		});
	});
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