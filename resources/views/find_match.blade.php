@extends('layouts.full_dashboard_wlogin')

@section('content')
	<link href="{{ asset('public/css/jquery.scrolling-tabs.css') }}" rel="stylesheet">
	<div class="container ">
		<div class="heading-tabs">
			<ul class="nav-inner">
				{{--@if(Auth::user())
					<!-- <li><a href="{{ url('/user/dashboard')}}">Home</a></li> -->
					<li><a href="{{ url('/find-match')}}">Home</a></li>	
								

				@else
					<li><a href="{{ url('/user/dashboard')}}">Home</a></li>
				@endif--}}
				<li><a href="{{ url('/user/dashboard') }}">Home</a></li>
				<!-- <li><a href="{{ url('/user/dashboard' )}}">Dashboard</a></li> -->
				<li class="active"><a href="{{ url('/findmatch')}}">Match</a></li>
			

			</ul>
		</div>
		<div class="match-tabs">
			@if (session('success'))
			<div class="alert alert-success" role="alert">
			    <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
			    <strong>Success ! </strong>
			    <span>{{ session('success') }}</span>
			</div>
			@endif
			<!-- Nav tabs -->
			<ul class="nav nav-tabs" role="tablist">
			  <!-- <li role="presentation" class="active"><a href="#tab1" role="tab" data-toggle="tab">Email</a></li> -->
			  <li role="presentation" class="<?php if(Auth::user()){?> active <?php }?>" ><a href="#tab2" role="tab" data-toggle="tab">About My Match</a></li>
			</ul>
			 
			<!-- Tab panes -->
			<form method="post" action="{{ url('/Mymatch') }}" onsubmit="return checkEmail();">
				<div class="tab-content forms-in">
					{{csrf_field()}}
					<?php
						$user = Auth::user();
					?>
					<input type="hidden" name="email" value="{{$user->email}}">
					<input type="hidden" name="month" value="{{$user->month}}">
					<input type="hidden" name="day" value="{{$user->day}}">
					<input type="hidden" name="year" value="{{$user->year}}">
					<!-- 				<div role="tabpanel" class="tab-pane active" id="tab1">
						<div class="col-md-5 col-sm-6 col-xs-12" >
							<label>Email</label>
							<input type="email" name="email" class="form-control" id="email">
							<p class="error"></p>
						</div>
						<div class="clearfix"></div>
						<ul class="list-unstyled list-inline">
							<li><button type="button" class="btn cafe-submit next-step" data-toggle="tab" href="#tab2">Next <i class="fa fa-chevron-right"></i></button></li>
						</ul>
					</div> -->

					<div role="tabpanel" class="tab-pane active" id="tab2">
						<h4>About My Match</h4>
						<div class="col-md-6 col-sm-6 col-xs-12" id="about_match">
							<label>Gender</label>
							<select class="form-control" name="about_gender">
								<!-- <option value="">Choose One</option> -->
								<option value="Any" @if($user->about_gender == "Any") selected @endif >Any</option>
								<option value="Bi Male" @if($user->about_gender == "Bi Male") selected @endif>Bi Male</option>
								<option value="Bi Female" @if($user->about_gender == "Bi Female") selected @endif>Bi Female</option>
								<option value="Gay Male" @if($user->about_gender == "Gay Male") selected @endif>Gay Male</option>
								<option value="Gay Female" @if($user->about_gender == "Gay Female") selected @endif>Gay Female</option>
								<option value="Male" @if($user->about_gender == "Male") selected @endif>Straight Male</option>
								<option value="Female" @if($user->about_gender == "Female") selected @endif>Straight Female</option>
								<!-- <option value="All">All</option> -->
							</select>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<label>Body Type</label>
							<select class="form-control" name="about_bodytype">
								<!-- <option value="">Choose One</option> -->
								<option value="Any" @if($user->about_bodytype == "Any") selected @endif >Any</option> 
								<option value="Above Average"  @if($user->about_bodytype == "Above Average") selected @endif >Above Average</option>
								<option value="Atheltic" @if($user->about_bodytype == "Atheltic") selected @endif >Athletic </option>
								<option value="Average" @if($user->about_bodytype == "Average") selected @endif >Average </option>
								<option value="Full Figured" @if($user->about_bodytype == "Full Figured") selected @endif >Full Figured</option>
								<option value="Slender" @if($user->about_bodytype == "Slender") selected @endif >Slender</option>
								<!-- <option value="All">All</option> -->
							</select>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<label>Height</label>
							<select class="form-control" name="about_height">
								<!-- <option value="">Choose One</option> -->
								<!-- <option value="Any">Any</option>
								<option value="5.1" @if($user->about_bodytype == "Any") selected @endif >5.1</option>
								<option value="5.2" @if($user->about_bodytype == "Any") selected @endif >5.2</option>
								<option value="5.3" @if($user->about_bodytype == "Any") selected @endif >5.3</option>
								<option value="5.4" @if($user->about_bodytype == "Any") selected @endif >5.4</option>
								<option value="5.5" @if($user->about_bodytype == "Any") selected @endif >5.5</option>
								<option value="5.6" @if($user->about_bodytype == "Any") selected @endif >5.6</option>
								<option value="5.7" @if($user->about_bodytype == "Any") selected @endif >5.7</option>
								<option value="5.8" @if($user->about_bodytype == "Any") selected @endif >5.8</option>
								<option value="5.9" @if($user->about_bodytype == "Any") selected @endif >5.9</option>
								<option value="6.0" @if($user->about_bodytype == "Any") selected @endif >6.0</option>
								<option value="6.0+" @if($user->about_bodytype == "Any") selected @endif >6.0+</option> -->

								<option value="Any" @if($user->about_height == "Any") selected @endif >Any</option>
								
								<option value="5.1" @if($user->about_height == "5.1") selected @endif >5.1</option>
								<option value="5.2" @if($user->about_height == "5.2") selected @endif >5.2</option>
								<option value="5.3" @if($user->about_height == "5.3") selected @endif >5.3</option>
								<option value="5.4" @if($user->about_height == "5.4") selected @endif >5.4</option>
								<option value="5.5" @if($user->about_height == "5.5") selected @endif >5.5</option>
								<option value="5.6" @if($user->about_height == "5.6") selected @endif >5.6</option>
								<option value="5.7" @if($user->about_height == "5.7") selected @endif >5.7</option>
								<option value="5.8" @if($user->about_height == "5.8") selected @endif >5.8</option>
								<option value="5.9" @if($user->about_height == "5.9") selected @endif >5.9</option>
								<option value="6.0" @if($user->about_height == "6.0") selected @endif >6.0</option>
								<option value="6.0+" @if($user->about_height == "6.0+") selected @endif >6.0+</option>
								<!-- <option value="All">All</option> -->
							</select>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<label>Eye Color</label>
							<select class="form-control" name="about_eyecolor">
								<!-- <option value="">Choose One</option> -->
								<option value="Any" @if($user->about_eyecolor == "Any") selected @endif>Any</option>
								<option value="Blue" @if($user->about_eyecolor == "Blue") selected @endif>Blue</option>
								<option value="Brown" @if($user->about_eyecolor == "Brown") selected @endif>Brown</option>
								<option value="Green" @if($user->about_eyecolor == "Green") selected @endif>Green</option>
								<option value="Hazel" @if($user->about_eyecolor == "Hazel") selected @endif>Hazel</option>
								<!-- <option value="All">All </option> -->
							</select>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<label>Hair Color</label>
							<select class="form-control" name="about_haircolor">
								<!-- <option value="">Choose One</option> -->
								<option value="Any" @if($user->about_haircolor == "Any") selected @endif>Any</option>
								<option value="Bald" @if($user->about_haircolor == "Bald") selected @endif>Bald</option>
								<option value="Black" @if($user->about_haircolor == "Black") selected @endif>Black</option>
								<option value="Blonde" @if($user->about_haircolor == "Blonde") selected @endif>Blonde</option>
								<option value="Brown" @if($user->about_haircolor == "Brown") selected @endif>Brown</option>
								<option value="Brunette" @if($user->about_haircolor == "Brunette") selected @endif>Brunette</option>
								<option value="Red" @if($user->about_haircolor == "Red") selected @endif> Red</option>
								<!-- <option value="All">All</option> -->
							</select>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<label>Ethnicity</label>
							<select class="form-control" name="about_ethnicity">
								<!-- <option value="">Choose One</option> -->
								<option value="Any" @if($user->about_ethnicity == "Any") selected @endif>Any</option>
								<option value="African American" @if($user->about_ethnicity == "African American") selected @endif >African American</option>
								<option value="Asian" @if($user->about_ethnicity == "Asian") selected @endif>Asian</option>
								<option value="Caucasian" @if($user->about_ethnicity == "Caucasian") selected @endif>Caucasian</option>
								<option value="European" @if($user->about_ethnicity == "European") selected @endif>European</option>
								<option value="Hispanic" @if($user->about_ethnicity == "Hispanic") selected @endif>Hispanic</option>
								<option value="Multiracial" @if($user->about_ethnicity == "Multiracial") selected @endif>Multiracial</option>
								<option value="Native American" @if($user->about_ethnicity == "Native American") selected @endif >Native American</option>
							</select>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<label>Language</label>
							<select class="form-control" name="about_language">
								<!-- <option value="">Choose One</option> -->
								<option value="Any" @if($user->about_language == "Any") selected @endif>Any</option>
								<option value="Chinese" @if($user->about_language == "Chinese") selected @endif>Chinese</option>
								<option value="English" @if($user->about_language == "English") selected @endif>English </option>
								<option value="French" @if($user->about_language == "French") selected @endif>French </option>
								<option value="German" @if($user->about_language == "German") selected @endif>German</option>
								<option value="Hebrew" @if($user->about_language == "Hebrew") selected @endif>Hebrew</option>
								<option value="Hindi" @if($user->about_language == "Hindi") selected @endif>Hindi</option>
								<option value="Italian" @if($user->about_language == "Italian") selected @endif>Italian</option>
								<option value="Russian" @if($user->about_language == "Russian") selected @endif>Russian</option>
								<option value="Spanish" @if($user->about_language == "Spanish") selected @endif>Spanish</option>
								<!-- <option value="All">All</option> -->
							</select>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<label>Religion</label>
							<select class="form-control" name="about_religion">
								<!-- <option value="">Choose One</option> -->
								<option value="Any" @if($user->about_religion == "Any") selected @endif>Any </option>
								<option value="Buddhism" @if($user->about_religion == "Buddhism") selected @endif>Buddhism </option>
								<option value="Catholicism" @if($user->about_religion == "Catholicism") selected @endif>Catholicism  </option>
								<option value="Christianity" @if($user->about_religion == "Christianity") selected @endif>Christianity  </option>
								<option value="Hinduism" @if($user->about_religion == "Hinduism") selected @endif>Hinduism  </option>
								<option value="Islam" @if($user->about_religion == "Islam") selected @endif>Islam </option>
								<option value="Judaism" @if($user->about_religion == "Judaism") selected @endif>Judaism </option>
								<option value="New Age" @if($user->about_religion == "New Age") selected @endif >New Age</option>
								<!-- <option value="All">All</option> -->
							</select>
						</div>
						<div class="clearfix"></div>
						<ul class="list-unstyled list-inline">
							@if(Auth::user())
								<li><a style="background-color: #0071e0 !important; box-shadow: none !important;" type="button" class="btn cafe-submit prev-step" href="{{url('/about-me')}}">{{--<i class="fa fa-chevron-left"></i>--}} Back</a></li>
							@else
								<li><button type="button" class="btn cafe-submit prev-step" data-toggle="tab" href="#tab1">{{--<i class="fa fa-chevron-left"></i>--}} Back</button></li>
							@endif
							<li><button type="submit" class="btn cafe-submit search" >Next {{--<i class="fa fa-chevron-right"></i>--}}</button></li>
						</ul>
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
			if($('#email').val()==''){
				$('.error').text('Email is required');
				return false;
			}else if(!isEmail($('#email').val())){
				$('.error').text('Please enter valid email');
				return false;
			}
			$('.error').text('');
		   	moveTab("Next");
		});
		function isEmail(email) {
		  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		  return regex.test(email);
		}

		$('.prev-step').on('click', function () {
		   moveTab("Previous");
		});
		function checkEmail(){
			if($('#email').val()==''){
				$('.error').text('Email is required');
				moveTab("Previous");
				return false;
			}
		}

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
		      }

		    } else {
		      if (currentTab.prev().length) 
		      {
		        currentTab.removeClass('active');
		        currentTab.prev().addClass('active');
		        currentTabPane.removeClass('active');
		        currentTabPane.prev().addClass('active');
		      }
		    }
		  }
	</script>

	<style>
		ul.list-unstyled.list-inline {
		    margin: 15px 10px;
		    width: 100%;
		    display: inline-block;
		}
			.tab-content {
			    padding: 20px 5px;
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
		 	box-shadow:1px 3px 11px #337ab7;
		 	margin-top:20px;
		 	margin-bottom: 60px;

		 }
		 .match-tabs .active a{
		 	background-color: #337ab7 !important;
		    color: white !important;
		    box-shadow: 1px 1px 1px 3px #dedede !important;
		 }
		 .match-tabs{margin-top: 30px;}
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
			.error{
				color: red;
			}
	</style>

@endsection