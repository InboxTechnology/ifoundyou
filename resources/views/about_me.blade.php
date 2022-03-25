@extends('layouts.full_dashboard_wlogin')

@section('content')
	<!-- CODE 14 NOV PV -->
	<style type="text/css">
		#month, #day, #year{
		border: 1px solid #d0d4d9;
		border-radius: 4px;
		padding: 5px 10px;
		margin-bottom: 0px;
		font-size: 14px;
		width: auto;
		}	
	</style>
	<link href="{{ asset('public/css/jquery.scrolling-tabs.css') }}" rel="stylesheet">
	<div class="container ">
		<div class="heading-tabs">
			<ul class="nav-inner">
				{{--@if(Auth::user())
					<li><a href="{{ url('/find-match')}}">Home</a></li>
				@else
					<li><a href="{{ url('/dashboard_wlogin')}}">Home</a></li>
				@endif--}}
				<li><a href="{{ url('/user/dashboard') }}">Home</a></li>
				<!-- <li><a href="{{ url('/user/dashboard' )}}">Dashboard</a></li> -->
				<!-- <li class="active"><a href="{{ url('/user/edit-user-profile')}}">Match</a></li> -->
				<li class="active"><a  href="{{ url('/about-me')}}">Match</a></li>
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
				@if(Auth::user())
			  			<li style="display: none;" role="presentation" class="<?php if(!Auth::user()){?> active <?php }?>"><a href="javascript::void(0);" role="tab" data-toggle="tab">Email</a></li>
			  	@else
			  		<li role="presentation" class="<?php if(!Auth::user()){?> active <?php }?>"><a href="javascript::void(0);" role="tab" data-toggle="tab">Email</a></li>
			  	@endif
			  
			  	<li role="presentation" class="<?php if(Auth::user()){?> active <?php }?>"><a href="javascript::void(0);" role="tab" data-toggle="tab">About Me</a></li> 
			</ul>
			 
				<!-- Tab panes -->
			<div class="tab-content forms-in">

			
				@if(!Auth::user())
					<form method="post" action="{{ url('/checkEmailExist') }}" >
						{{csrf_field()}}
						<div role="tabpanel" class="tab-pane " id="tab1">
							<div class="col-md-5 col-sm-6 col-xs-12" >
								<label>Email</label>
								<input type="email" name="email" class="form-control" id="email">
								<p class="error"></p>
							</div>
									<!-- 					<div class="col-md-5 col-sm-6 col-xs-12" >
								<label>Phone Number</label>
								<input type="tel" name="phone_find" class="form-control" id="phone_find">
								<p class="error-phone" style="color: red;"></p>
							</div> -->
							<div class="col-md-5 col-sm-6 col-xs-12">
							    <label>Birthday:</label><br>
								<select name="month" id="month">
									<option value="">Month</option>
									<option value="1" @if(old('month') == 1) selected @endif  >January</option>
									<option value="2" @if(old('month') == 2) selected @endif  >February</option>
									<option value="3" @if(old('month') == 3) selected @endif  >March</option>
									<option value="4" @if(old('month') == 4) selected @endif  >April</option>
									<option value="5" @if(old('month') == 5) selected @endif  >May</option>
									<option value="6" @if(old('month') == 6) selected @endif  >June</option>
									<option value="7" @if(old('month') == 7) selected @endif  >July</option>
									<option value="8" @if(old('month') == 8) selected @endif  >August</option>
									<option value="9" @if(old('month') == 9) selected @endif  >September</option>
									<option value="10" @if(old('month') == 10) selected @endif  >October</option>
									<option value="11" @if(old('month') == 11) selected @endif  >November</option>
									<option value="12" @if(old('month') == 12) selected @endif  >December</option>
								</select>
								<select name="day" id="day">
									<option value="">Day</option>
									@for($day = 1; $day < 31; $day++)
									<option @if(old('day') == $day) selected @endif>{{ $day }}</option>
									@endfor
								</select>
								<select name="year" id="year">
									<option value="">Year</option>
									<?php $curr_year = Carbon\Carbon::now()->format('Y'); ?>
									@for($year = 1939; $year <= $curr_year; $year++)
									<option @if(old('year') == $year) selected @endif>{{ $year }}</option>
									@endfor
								</select>
								<br>
								<p id="birth_error" style="color: red;"></p>
							</div>
							<div class="clearfix"></div>
							<ul class="list-unstyled list-inline">
								<li><button type="button" class="btn cafe-submit next-step">Next {{--<i class="fa fa-chevron-right"></i>--}}</button></li>
							</ul>
						</div>
					</form>
				@endif
				<div role="tabpanel" class="tab-pane <?php if(Auth::user()){?> active <?php }?>" id="tab2">
					<!-- <form method="post" action="{{ url('/search-matching-result') }}" onsubmit="return checkEmail();"> -->
					<form method="post" action="{{ url('/save-about-me') }}" onsubmit="return checkEmail();">
						<input type="hidden" name="user_id" value="<?php if(Auth::user()){?>{{Auth::user()->id}}<?php } ?>">
						<input type="hidden" name="email" id="get_email" value="<?php if(Auth::user()){?>{{Auth::user()->email}}<?php } ?>">
						<input type="hidden" name="month" id="get_month" value="<?php if(Auth::user()){?>{{Auth::user()->month}}<?php } ?>">
						<input type="hidden" name="day" id="get_day" value="<?php if(Auth::user()){?>{{Auth::user()->day}}<?php } ?>">
						<input type="hidden" name="year" id="get_year" value="<?php if(Auth::user()){?>{{Auth::user()->year}}<?php } ?>">
						{{csrf_field()}}
						<h4>About Me</h4>
						<div class="col-md-6 col-sm-6 col-xs-12" id="about_match">
							<label>Gender</label>
							<?php //dd(Auth::user()->sex);?>
							<select class="form-control" name="about_gender">
								<!-- <option value="">Choose One</option> -->
								<option <?php if(Auth::user()->sex == 'Any') { echo 'selected'; }?> value="Any">Any</option>
								<option <?php if(Auth::user()->sex == 'Bi Male') { echo 'selected'; }?> value="Bi Male" >Bi Male</option>
								<option  <?php if(Auth::user()->sex == 'Bi Female') { echo 'selected'; }?> value="Bi Female" >Bi Female</option>
								<option  <?php if(Auth::user()->sex == 'Gay Male') { echo 'selected'; }?>value="Gay Male" >Gay Male</option>
								<option  <?php if(Auth::user()->sex == 'Gay Female') { echo 'selected'; }?> value="Gay Female" >Gay Female</option>
								<option  <?php if(Auth::user()->sex == 'Male') { echo 'selected'; }?> value="Male">Straight Male</option>
								<option  <?php if(Auth::user()->sex == 'Female') { echo 'selected'; }?> value="Female">Straight Female</option>
								<!-- <option value="All">All</option> -->
							</select>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<label>Body Type</label>
							<select class="form-control" name="about_bodytype">
								<!-- <option value="">Choose One</option> -->
								<option <?php if(Auth::user()->bodytype == 'Any') { echo 'selected'; }?> value="Any">Any</option> 
								<option <?php if(Auth::user()->bodytype == 'Above Average') { echo 'selected'; }?> value="Above Average" >Above Average</option>
								<option <?php if(Auth::user()->bodytype == 'Atheltic') { echo 'selected'; }?>  value="Atheltic">Athletic </option>
								<option <?php if(Auth::user()->bodytype == 'Average') { echo 'selected'; }?>  value="Average">Average </option>
								<option <?php if(Auth::user()->bodytype == 'Full Figured') { echo 'selected'; }?>  value="Full Figured" >Full Figured</option>
								<option <?php if(Auth::user()->bodytype == 'Slender') { echo 'selected'; }?>  value="Slender">Slender</option>
								<!-- <option value="All">All</option> -->
							</select>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<label>Height</label>
							<select class="form-control" name="about_height">
								<!-- <option value="">Choose One</option> -->
								<option <?php if(Auth::user()->height == 'Any') { echo 'selected'; }?> value="Any">Any</option>
								<option <?php if(Auth::user()->height == '5.1') { echo 'selected'; }?> value="5.1" >5.1</option>
								<option <?php if(Auth::user()->height == '5.2') { echo 'selected'; }?> value="5.2" >5.2</option>
								<option <?php if(Auth::user()->height == '5.3') { echo 'selected'; }?> value="5.3" >5.3</option>
								<option <?php if(Auth::user()->height == '5.4') { echo 'selected'; }?> value="5.4" >5.4</option>
								<option <?php if(Auth::user()->height == '5.5') { echo 'selected'; }?> value="5.5" >5.5</option>
								<option <?php if(Auth::user()->height == '5.6') { echo 'selected'; }?> value="5.6" >5.6</option>
								<option <?php if(Auth::user()->height == '5.7') { echo 'selected'; }?> value="5.7" >5.7</option>
								<option <?php if(Auth::user()->height == '5.8') { echo 'selected'; }?> value="5.8" >5.8</option>
								<option <?php if(Auth::user()->height == '5.9') { echo 'selected'; }?> value="5.9" >5.9</option>
								<option <?php if(Auth::user()->height == '6.0') { echo 'selected'; }?> value="6.0" >6.0</option>
								<option <?php if(Auth::user()->height == '6.0+') { echo 'selected'; }?> value="6.0+" >6.0+</option>
								<!-- <option value="All">All</option> -->
							</select>
						</div>
						
						<div class="col-md-6 col-sm-6 col-xs-12">
							<label>Eye Color</label>
							<select class="form-control" name="about_eyecolor">
								<!-- <option value="">Choose One</option> -->
								<option <?php if(Auth::user()->eyecolor == 'Any') { echo 'selected'; }?> value="Any">Any</option>
								<option <?php if(Auth::user()->eyecolor == 'Blue') { echo 'selected'; }?> value="Blue">Blue</option>
								<option <?php if(Auth::user()->eyecolor == 'Brown') { echo 'selected'; }?> value="Brown">Brown</option>
								<option <?php if(Auth::user()->eyecolor == 'Green') { echo 'selected'; }?> value="Green">Green</option>
								<option <?php if(Auth::user()->eyecolor == 'Hazel') { echo 'selected'; }?> value="Hazel">Hazel</option>
								<!-- <option value="All">All </option> -->
							</select>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<label>Hair Color</label>
							<select class="form-control" name="about_haircolor">
								<!-- <option value="">Choose One</option> -->
								<option <?php if(Auth::user()->haircolor == 'Any') { echo 'selected'; }?> value="Any">Any</option>
								<option <?php if(Auth::user()->haircolor == 'Bald') { echo 'selected'; }?> value="Bald">Bald</option>
								<option <?php if(Auth::user()->haircolor == 'Black') { echo 'selected'; }?> value="Black">Black</option>
								<option <?php if(Auth::user()->haircolor == 'Blonde') { echo 'selected'; }?> value="Blonde">Blonde</option>
								<option <?php if(Auth::user()->haircolor == 'Brown') { echo 'selected'; }?> value="Brown">Brown</option>
								<option <?php if(Auth::user()->haircolor == 'Brunette') { echo 'selected'; }?> value="Brunette">Brunette</option>
								<option <?php if(Auth::user()->haircolor == 'Red') { echo 'selected'; }?> value="Red">Red</option>
								<!-- <option value="All">All</option> -->
							</select>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<label>Ethnicity</label>
							<select class="form-control" name="about_ethnicity">
								<!-- <option value="">Choose One</option> -->
								<option <?php if(Auth::user()->ethnicity == 'Any') { echo 'selected'; }?> value="Any">Any</option>
								<option <?php if(Auth::user()->ethnicity == 'African American') { echo 'selected'; }?>  value="African American" >African American</option>
								<option <?php if(Auth::user()->ethnicity == 'Asian') { echo 'selected'; }?>  value="Asian">Asian</option>
								<option <?php if(Auth::user()->ethnicity == 'Caucasian') { echo 'selected'; }?>  value="Caucasian">Caucasian</option>
								<option <?php if(Auth::user()->ethnicity == 'European') { echo 'selected'; }?>  value="European">European</option>
								<option <?php if(Auth::user()->ethnicity == 'Hispanic') { echo 'selected'; }?>  value="Hispanic">Hispanic</option>
								<option <?php if(Auth::user()->ethnicity == 'Multiracial') { echo 'selected'; }?>  value="Multiracial">Multiracial</option>
								<option <?php if(Auth::user()->ethnicity == 'Native American') { echo 'selected'; }?>  value="Native American" >Native American</option>
							</select>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<label>Language</label>
							<select class="form-control" name="about_language">
								<!-- <option value="">Choose One</option> -->
								<option <?php if(Auth::user()->language == 'Any') { echo 'selected'; }?> value="Any">Any</option>
								<option <?php if(Auth::user()->language == 'Chinese') { echo 'selected'; }?> value="Chinese">Chinese</option>
								<option <?php if(Auth::user()->language == 'English') { echo 'selected'; }?> value="English">English </option>
								<option <?php if(Auth::user()->language == 'French') { echo 'selected'; }?> value="French">French </option>
								<option <?php if(Auth::user()->language == 'German') { echo 'selected'; }?> value="German">German</option>
								<option <?php if(Auth::user()->language == 'Hebrew') { echo 'selected'; }?> value="Hebrew">Hebrew</option>
								<option <?php if(Auth::user()->language == 'Hindi') { echo 'selected'; }?> value="Hindi">Hindi</option>
								<option <?php if(Auth::user()->language == 'Italian') { echo 'selected'; }?> value="Italian">Italian</option>
								<option <?php if(Auth::user()->language == 'Russian') { echo 'selected'; }?> value="Russian">Russian</option>
								<option <?php if(Auth::user()->language == 'Spanish') { echo 'selected'; }?> value="Spanish">Spanish</option>
								<!-- <option value="All">All</option> -->
							</select>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<label>Religion</label>
							<select class="form-control" name="about_religion">
								<!-- <option value="">Choose One</option> -->
								<option <?php if(Auth::user()->religion == 'Any') { echo 'selected'; }?> value="Any">Any </option>
								<option <?php if(Auth::user()->religion == 'Buddhism') { echo 'selected'; }?> value="Buddhism">Buddhism </option>
								<option <?php if(Auth::user()->religion == 'Catholicism') { echo 'selected'; }?> value="Catholicism">Catholicism  </option>
								<option <?php if(Auth::user()->religion == 'Christianity') { echo 'selected'; }?> value="Christianity">Christianity  </option>
								<option <?php if(Auth::user()->religion == 'Hinduism') { echo 'selected'; }?> value="Hinduism">Hinduism  </option>
								<option <?php if(Auth::user()->religion == 'Islam') { echo 'selected'; }?> value="Islam">Islam </option>
								<option <?php if(Auth::user()->religion == 'Judaism') { echo 'selected'; }?> value="Judaism">Judaism </option>
								<option <?php if(Auth::user()->religion == 'New Age') { echo 'selected'; }?> value="New Age" >New Age</option>
								<!-- <option value="All">All</option> -->
							</select>
						</div>
						<div class="clearfix"></div>
						<ul class="list-unstyled list-inline">
							@if(Auth::user())
								<li><a style="background-color: #0071e0 !important; box-shadow: none !important;" type="button" class="btn cafe-submit" href="{{ url('/find-match')}}">{{--<i class="fa fa-chevron-left"></i>--}} Back</a></li>
							@else
								<li><button type="button" class="btn cafe-submit prev-step" data-toggle="tab" href="#tab1">{{--<i class="fa fa-chevron-left"></i>--}} Back</button></li>
							@endif
								<li><button type="submit" class="btn cafe-submit search" >Next{{--<i style="padding-left: 5px;" class="fa fa-chevron-right"></i>--}}</button></li>
						</ul>
					</form>
				</div>
			</div>
			<!-- </form> -->
		</div>
	</div>
	<script src="{{ asset('public/js/jquery.scrolling-tabs.js') }}"></script>
	<script type="text/javascript">
		$('.nav-tabs').scrollingTabs({
		  forceActiveTab: true
		});

		$('.next-step').on('click', function () {
			var check = true;
			var email_error = "";
			if($('#email').val()==''){
				$('.error').text('Email is required');
				email_error = "yes";
				check = false;
			}
			else if(!isEmail($('#email').val())){
				$('.error').text('Please enter valid email');
				email_error = "yes";
				check = false;
			}
			if(email_error != "yes"){
				$('.error').text('');
			}

			if($('#day').val()=='' || $('#month').val()=='' || $('#year').val()==''){
				$('#birth_error').text('Birthdate is required');
				check = false;
			}else{
				$('#birth_error').text('');
			}
			if(check == false){
				return false;
			}else{
				$('.error').text('');
				$('#birth_error').text('');
				var email = $('#email').val();
				var month = $('#month').val();	
				var day   =	$('#day').val();
				var year  =	$('#year').val();
				$.ajax({
			        headers: {
			    		'X-CSRF-TOKEN': '{{ csrf_token()}}'
			  		},
		            type: 'POST',
		            data: {
		            	'userEmail' : email,
		            },
		            dataType: 'json',
		            url: '/checkEmailExist',
			        success: function(data){
			        	if(data == false){
			        		$('.error').text('Email-id already exist');
			        	}
			        	if(data == true){
			        		$('#get_email').val(email);
			        		$('#get_month').val(month);
			        		$('#get_day').val(day);
			        		$('#get_year').val(year);
			        		$("#tab1").hide();
			        		$("#tab2").show();
			        		moveTab("Next");

			        	}
	                }
		        });
			}        
		});
		function isEmail(email) {
		  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		  return regex.test(email);
		}

		$('.prev-step').on('click', function () {
		   	moveTab("Previous");
			$("#tab2").hide();
		   	$("#tab1").show();
		});
		// function checkEmail(){
		// 	if($('#email').val()==''){
		// 		$('.error').text('Email is required');
		// 		moveTab("Previous");
		// 		return false;
		// 	}
		// 	if($('#phone_find').val()==''){
		// 		$('.error-phone').text('Phone is required');
		// 		moveTab("Previous");
		// 		return false;
		// 	}	
		// 	if($('#day').val()=='' && $('#month').val()=='' && $('#year').val()==''){
		// 		$('#birth_error').text('Birthdate is required');
		// 		moveTab("Previous");
		// 		return false;
		// 	}	
		// }

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