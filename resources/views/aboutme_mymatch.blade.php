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
				<li><a href="{{ url('/') }}">Home</a></li>
				<!-- <li><a href="{{ url('/user/dashboard' )}}">Dashboard</a></li> -->
				<li class="active"><a href="{{ url('/aboutme_mymatch')}}">Find Match</a></li>
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
			<?php /*<ul class="nav nav-tabs" role="tablist">
				@if(Auth::user())
			  			<li style="display: none;" role="presentation" class="<?php if(!Auth::user()){?> active <?php }?>"><a href="javascript::void(0);" role="tab" data-toggle="tab">Email</a></li>
			  	@else
			  		<li role="presentation" class="<?php if(!Auth::user()){?> active <?php }?>"><a href="javascript::void(0);" role="tab" data-toggle="tab">Email</a></li>
			  	@endif
			  
			  <li role="presentation" class="<?php if(Auth::user()){?> active <?php }?>"><a href="javascript::void(0);" role="tab" data-toggle="tab">About Me</a></li>
			  
			</ul> */ ?>
			 
				<!-- Tab panes -->
				<div class="tab-content forms-in">

				
					@if(!Auth::user())
						<form method="post" action="{{ url('/checkEmailExist') }}" >
							{{csrf_field()}}
							<div role="tabpanel" class="tab-pane " id="tab1">
								<div class="col-md-6 col-sm-6 col-xs-12" >
									<label>Email</label>
									<input type="email" name="email" class="form-control" id="email">
									<p class="error"></p>
								</div>
										<!-- 					<div class="col-md-6 col-sm-6 col-xs-12" >
									<label>Phone Number</label>
									<input type="tel" name="phone_find" class="form-control" id="phone_find">
									<p class="error-phone" style="color: red;"></p>
								</div> -->
								<div class="col-md-6 col-sm-6 col-xs-12">
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
								<?php if(Auth::user()->sex == 'Male'){
										$gender = 'Straight Male';
									?>
									<input class="form-control" type="text" name="about_gender" value="<?php echo $gender; ?>" readonly="">
									<?php
								 }elseif(Auth::user()->sex == 'Female'){
								 		$gender = 'Straight Female';
								 	?>
								 	<input class="form-control" type="text" name="about_gender" value="<?php echo $gender; ?>" readonly="">
								 	<?php
								 }
								 else{
								 	?>
								 		<input class="form-control" type="text" name="about_gender" value="<?php echo Auth::user()->sex; ?>" readonly="">
								 	<?php

								 }

								 ?>
								
								
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<label>Body Type</label>

								<?php if(Auth::user()->bodytype){
										$bodytype = Auth::user()->bodytype;
									?>
									<input class="form-control" type="text" name="about_bodytype" value="<?php echo $bodytype; ?>" readonly="">
									<?php
								 }

								 ?>
								
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<label>Height</label>

								<?php if(Auth::user()->height){
										$height = Auth::user()->height;
									?>
									<input class="form-control" type="text" name="about_height" value="<?php echo $height; ?>" readonly="">
									<?php
								 }

								 ?>
								
							</div>
							
							<div class="col-md-6 col-sm-6 col-xs-12">
								<label>Eye Color</label>
								<?php if(Auth::user()->eyecolor){
										$eyecolor = Auth::user()->eyecolor;
									?>
									<input class="form-control" type="text" name="about_eyecolor" value="<?php echo $eyecolor; ?>" readonly="">
									<?php
								 }

								 ?>
								
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<label>Hair Color</label>
								<?php if(Auth::user()->haircolor){
										$haircolor = Auth::user()->haircolor;
									?>
									<input class="form-control" type="text" name="about_haircolor" value="<?php echo $haircolor; ?>" readonly="">
									<?php
								 }

								 ?>
								
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<label>Ethnicity</label>
								<?php if(Auth::user()->ethnicity){
										$ethnicity = Auth::user()->ethnicity;
									?>
									<input class="form-control" type="text" name="about_ethnicity" value="<?php echo $ethnicity; ?>" readonly="">
									<?php
								 }

								 ?>
								
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<label>Language</label>
								<?php if(Auth::user()->language){
										$language = Auth::user()->language;
									?>
									<input class="form-control" type="text" name="about_language" value="<?php echo $language; ?>" readonly="">
									<?php
								 }

								 ?>
								
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<label>Religion</label>
								<?php if(Auth::user()->religion){
										$religion = Auth::user()->religion;
									?>
									<input class="form-control" type="text" name="about_religion" value="<?php echo $religion; ?>" readonly="">
									<?php
								 }

								 ?>
								
							</div>
							<div class="clearfix"></div>
							
						</form>
						<hr>
						<form method="post" onsubmit="return checkEmail();">
							<div class="forms-in">
								{{csrf_field()}}
								<?php

									$user = Auth::user();
								?>
								<input type="hidden" name="email" value="{{Auth::user()->email}}" >
								<input type="hidden" name="month" value="{{Auth::user()->month}}">
								<input type="hidden" name="day" value="{{Auth::user()->day}}">
								<input type="hidden" name="year" value="{{Auth::user()->email}}">

								<div role="tabpanel" class="tab-pane active" id="tab2">
									<h4>About My Match</h4>
									<?php 
										if(isset($ses) && !empty($ses)){
											// echo "session";
											$userData = $ses;
										}else{
											// echo "auth";
											$userData = Auth::user();
										}
										// dd($userData);
									?>
									<div class="col-md-6 col-sm-6 col-xs-12" id="about_match">
										<label>Gender</label>
										<?php 
										if(isset($userData) && !empty($userData)){  
											if(@$userData['about_gender'] == 'Male'){
														$gender = 'Straight Male';
													?>
													<input class="form-control" type="text" name="about_gender" value="<?php echo $gender; ?>" readonly="">
													<?php
											}
											elseif(@$userData['about_gender'] == 'Female'){
											 		$gender = 'Straight Female';
											 	?>
										 		<input class="form-control" type="text" name="about_gender" value="<?php echo $gender; ?>" readonly="">
										 		<?php
											}
											else{?>
											 		<input class="form-control" type="text" name="about_gender" value="<?php echo $userData['about_gender']; ?>" readonly="">
											 	<?php
											}
										}
									

											 ?>
										
									</div>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<label>Body Type</label>
										<?php if(@$ses['about_bodytype']){
													$about_bodytype = $ses['about_bodytype'];
												?>
												<input class="form-control" type="text" name="about_bodytype" value="<?php echo $about_bodytype; ?>" readonly="">
												<?php
											 }
											 else{
											 	?>
											 		<input class="form-control" type="text" name="about_bodytype" value="<?php echo Auth::user()->about_bodytype; ?>" readonly="">
											 	<?php
											 }

											 ?>
										
									</div>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<label>Height</label>
										<?php if(@$ses['about_height']){
													$about_height = $ses['about_height'];
												?>
												<input class="form-control" type="text" name="about_height" value="<?php echo $about_height; ?>" readonly="">
												<?php
											}
											else{
												?>
													<input class="form-control" type="text" name="about_height" value="<?php echo Auth::user()->about_height; ?>" readonly="">
												<?php
											}

											 ?>
										
									</div>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<label>Eye Color</label>
										<?php if(@$ses['about_eyecolor']){
													$about_eyecolor = $ses['about_eyecolor'];
												?>
												<input class="form-control" type="text" name="about_eyecolor" value="<?php echo $about_eyecolor; ?>" readonly="">
												<?php
											}
											else{
												?>
													<input class="form-control" type="text" name="about_eyecolor" value="<?php echo Auth::user()->about_eyecolor; ?>" readonly="">
												<?php
											}

											 ?>
										
									</div>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<label>Hair Color</label>
										<?php if(@$ses['about_haircolor']){
													$about_haircolor = $ses['about_haircolor'];
												?>
												<input class="form-control" type="text" name="about_haircolor" value="<?php echo $about_haircolor; ?>" readonly="">
												<?php
											}
											else{
												?>
													<input class="form-control" type="text" name="about_haircolor" value="<?php echo Auth::user()->about_haircolor; ?>" readonly="">
												<?php
											}

											 ?>
										
									</div>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<label>Ethnicity</label>
										<?php if(@$ses['about_ethnicity']){
													$about_ethnicity = $ses['about_ethnicity'];
												?>
												<input class="form-control" type="text" name="about_ethnicity" value="<?php echo $about_ethnicity; ?>" readonly="">
												<?php
											}else{
												?>
													<input class="form-control" type="text" name="about_ethnicity" value="<?php echo Auth::user()->about_ethnicity; ?>" readonly="">
												<?php
											}

											 ?>
										
									</div>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<label>Language</label>
										<?php if(@$ses['about_language']){
													$about_language =$ses['about_language'];
												?>
												<input class="form-control" type="text" name="about_language" value="<?php echo $about_language; ?>" readonly="">
												<?php
											}else{
												?>
													<input class="form-control" type="text" name="about_language" value="<?php echo Auth::user()->about_language; ?>" readonly="">
												<?php
											}

											 ?>
										
									</div>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<label>Religion</label>
										<?php if(@$ses['about_religion']){
													$about_religion = $ses['about_religion'];
												?>
												<input class="form-control" type="text" name="about_religion" value="<?php echo $about_religion; ?>" readonly="">
												<?php
											}else{
												?>
													<input class="form-control" type="text" name="about_religion" value="<?php echo Auth::user()->about_religion; ?>" readonly="">
												<?php
											}

											 ?>
									
									</div>
									<div class="clearfix"></div>
								</div>
							</div>
							<div class="row">
								<div class = "col-md-12 col-sm-6 col-xs-12">
									<ul class="list-unstyled list-inline">
										{{--@if(Auth::user())
											<li><a style="background-color: #0071e0 !important; box-shadow: none !important;" type="button" class="btn cafe-submit prev-step" href="{{url('/findmatch')}}"><i class="fa fa-chevron-left"></i> Back</a></li>
										@else
											<li><button type="button" class="btn cafe-submit prev-step" data-toggle="tab" href="#tab1"><i class="fa fa-chevron-left"></i> Back</button></li>
										@endif--}}
										<li style="padding-right: 10px !important;"><button type="button" id="ajax" class="btn cafe-submit search" >Submit</button></li>
									</ul>
								</div>
							</div>
						</form>
					</div>
				</div>
			<!-- </form> -->
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
			<?php /*<ul class="nav nav-tabs" role="tablist">
			  <!-- <li role="presentation" class="active"><a href="#tab1" role="tab" data-toggle="tab">Email</a></li> -->
			  <li role="presentation" class="<?php if(Auth::user()){?> active <?php }?>" ><a href="#tab2" role="tab" data-toggle="tab">About My Match</a></li>
			</ul> */ ?>
			 
			<!-- Tab panes -->
			<?php /* <form method="post" onsubmit="return checkEmail();">
				<div class="tab-content forms-in">
					{{csrf_field()}}
					<!-- <input type="hidden" id="csrf" name="_token" value=""> -->
					<?php

						$user = Auth::user();
					?>
					<input type="hidden" name="email" value="{{Auth::user()->email}}" >
					<input type="hidden" name="month" value="{{Auth::user()->month}}">
					<input type="hidden" name="day" value="{{Auth::user()->day}}">
					<input type="hidden" name="year" value="{{Auth::user()->email}}">
					<!-- 				<div role="tabpanel" class="tab-pane active" id="tab1">
						<div class="col-md-6 col-sm-6 col-xs-12" >
							<label>Email</label>
							<input type="email" name="email" class="form-control" id="email">
							<p class="error"></p>
						</div>
						<div class="clearfix"></div>
						<ul class="list-unstyled list-inline">
							<li><button type="button" clascheckEmails="btn cafe-submit next-step" data-toggle="tab" href="#tab2">Next <i class="fa fa-chevron-right"></i></button></li>
						</ul>
					</div> -->

					<div role="tabpanel" class="tab-pane active" id="tab2">
						<h4>About My Match</h4>
						<?php 
							if(isset($ses) && !empty($ses)){
								// echo "session";
								$userData = $ses;
							}else{
								// echo "auth";
								$userData = Auth::user();
							}
							// dd($userData);
						?>
						<div class="col-md-6 col-sm-6 col-xs-12" id="about_match">
							<label>Gender</label>
							<?php 
							if(isset($userData) && !empty($userData)){  
								if(@$userData['about_gender'] == 'Male'){
											$gender = 'Straight Male';
										?>
										<input class="form-control" type="text" name="about_gender" value="<?php echo $gender; ?>" readonly="">
										<?php
								}
								elseif(@$userData['about_gender'] == 'Female'){
								 		$gender = 'Straight Female';
								 	?>
							 		<input class="form-control" type="text" name="about_gender" value="<?php echo $gender; ?>" readonly="">
							 		<?php
								}
								else{?>
								 		<input class="form-control" type="text" name="about_gender" value="<?php echo $userData['about_gender']; ?>" readonly="">
								 	<?php
								}
							}
						

								 ?>
							
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<label>Body Type</label>
							<?php if(@$ses['about_bodytype']){
										$about_bodytype = $ses['about_bodytype'];
									?>
									<input class="form-control" type="text" name="about_bodytype" value="<?php echo $about_bodytype; ?>" readonly="">
									<?php
								 }
								 else{
								 	?>
								 		<input class="form-control" type="text" name="about_bodytype" value="<?php echo Auth::user()->about_bodytype; ?>" readonly="">
								 	<?php
								 }

								 ?>
							
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<label>Height</label>
							<?php if(@$ses['about_height']){
										$about_height = $ses['about_height'];
									?>
									<input class="form-control" type="text" name="about_height" value="<?php echo $about_height; ?>" readonly="">
									<?php
								}
								else{
									?>
										<input class="form-control" type="text" name="about_height" value="<?php echo Auth::user()->about_height; ?>" readonly="">
									<?php
								}

								 ?>
							
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<label>Eye Color</label>
							<?php if(@$ses['about_eyecolor']){
										$about_eyecolor = $ses['about_eyecolor'];
									?>
									<input class="form-control" type="text" name="about_eyecolor" value="<?php echo $about_eyecolor; ?>" readonly="">
									<?php
								}
								else{
									?>
										<input class="form-control" type="text" name="about_eyecolor" value="<?php echo Auth::user()->about_eyecolor; ?>" readonly="">
									<?php
								}

								 ?>
							
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<label>Hair Color</label>
							<?php if(@$ses['about_haircolor']){
										$about_haircolor = $ses['about_haircolor'];
									?>
									<input class="form-control" type="text" name="about_haircolor" value="<?php echo $about_haircolor; ?>" readonly="">
									<?php
								}
								else{
									?>
										<input class="form-control" type="text" name="about_haircolor" value="<?php echo Auth::user()->about_haircolor; ?>" readonly="">
									<?php
								}

								 ?>
							
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<label>Ethnicity</label>
							<?php if(@$ses['about_ethnicity']){
										$about_ethnicity = $ses['about_ethnicity'];
									?>
									<input class="form-control" type="text" name="about_ethnicity" value="<?php echo $about_ethnicity; ?>" readonly="">
									<?php
								}else{
									?>
										<input class="form-control" type="text" name="about_ethnicity" value="<?php echo Auth::user()->about_ethnicity; ?>" readonly="">
									<?php
								}

								 ?>
							
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<label>Language</label>
							<?php if(@$ses['about_language']){
										$about_language =$ses['about_language'];
									?>
									<input class="form-control" type="text" name="about_language" value="<?php echo $about_language; ?>" readonly="">
									<?php
								}else{
									?>
										<input class="form-control" type="text" name="about_language" value="<?php echo Auth::user()->about_language; ?>" readonly="">
									<?php
								}

								 ?>
							
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<label>Religion</label>
							<?php if(@$ses['about_religion']){
										$about_religion = $ses['about_religion'];
									?>
									<input class="form-control" type="text" name="about_religion" value="<?php echo $about_religion; ?>" readonly="">
									<?php
								}else{
									?>
										<input class="form-control" type="text" name="about_religion" value="<?php echo Auth::user()->about_religion; ?>" readonly="">
									<?php
								}

								 ?>
						
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				<div class = "col-md-12 col-sm-6 col-xs-12">
					<ul class="list-unstyled list-inline">
						@if(Auth::user())
							<li><a style="background-color: #0071e0 !important; box-shadow: none !important;" type="button" class="btn cafe-submit prev-step" href="{{url('/findmatch')}}"><i class="fa fa-chevron-left"></i> Back</a></li>
						@else
							<li><button type="button" class="btn cafe-submit prev-step" data-toggle="tab" href="#tab1"><i class="fa fa-chevron-left"></i> Back</button></li>
						@endif
						<li style="padding-right: 10px !important;"><button type="button" id="ajax" class="btn cafe-submit search" >Submit</button></li>
					</ul>
				</div>
			</form> */ ?>
		</div>

		<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="background:none !important;">
			<div class="modal-dialog modal-dialog-centered" role="document">
			    <div class="modal-content">
					<div class="modal-header">
					<!-- <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5> -->
						<div style="float: left;">
							<h4>Your details has been submitted.</h4>
						</div>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					</div>
			      	<!-- <div class="modal-body">
			        ...
			      	</div> -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<!-- <button type="button" class="btn btn-primary">Save changes</button> -->
					</div>
			    </div>
			</div>
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

	<script type="text/javascript">
		$(document).ready(function() {
			$("#ajax").click(function(event) {
				event.preventDefault();
	    		var form = $(this).closest('form').serialize();
	    		console.log(form);
	    		// var form = $('#ajax').serialize();
	    		// var token =  $("#csrf").val();
	    		$.ajax({
			    	headers: {
			    		'X-CSRF-TOKEN': '{{ csrf_token()}}'
			  		},
			        type: "post",
			        url: "{{url('/search-matching-result')}}",
			        dataType: "json",
			        data: form,
			        success: function(data){
			               $("#exampleModalCenter").modal('show');
			        },
			        error: function(data){
			             // alert("Error")
			             console.log(error);
			        }
			    });
			});
		});
	</script>

	<style>
		ul.list-unstyled.list-inline {
		    margin: 15px 10px;
		    width: 100%;
		    display: inline-block;
		    border-bottom: 0px;
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
		 	margin-bottom: 40px;
		 	padding: 20px 5px 0px;

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