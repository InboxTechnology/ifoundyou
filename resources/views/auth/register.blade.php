@extends('layouts.app')

@section('content')
<style>

#europecountries, .europecountries{
	display:none;
}
/*#continent_error{
	position:relative;
	top:-14px;
}
#country_error{
	position:relative;
	top:-4px;
}*/
#cities, .cities
{
	display:none;
}
#locations, .locations
{
	display:none;
}
#states, .states
{
	display:none;
}
.form-group{
    position: relative;
    margin-bottom: 25px;
}

.form-group.cus-form-group{
    position: relative;
    margin-bottom: 25px;
}
</style>
<?php
	if(isset($_GET['user']) && isset($_GET['page'])){
		$id = $_GET['user']; 
		$info = DB::table('user_temp_about_me')->where('id',$id)->first();
	}else{
		$info = [];
	}
?>
<div class="container-fluid pd-none">
	<div class="wrapper-cl ct-acct">
		<div class="container">
			<ul class="nav-inner mb-10">
		        <li><a href="{{ url('/') }}">Home</a></li>
		        <li><a href="{{ url('/user/user-profile') }}">My Profile</a></li>
		        <li class="active"><a href="{{ url('/register') }}">Subscription</a></li>
		    </ul>

			<div class="row">
				<div class="col-md-12">
					<div class="col-md-5 col-sm-6 col-xs-12">
						@if (session('success'))
						<div class="alert alert-success" role="alert">
						    <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
						    <strong>Success ! </strong>
						    <span>{{ session('success') }}</span>
						</div>
						@endif
						<div class="ct-form" id="newmain">
							<form  action="{{ route('register') }}" method="post" class="form-box" id="create-account-from">
								@csrf
								{{--<h2>Sign up</h2>--}}
								<input type="hidden" name="param" value="{{ app('request')->input('id') }}">
								<div class="form-group">
									<div class="row">
										<div class="col-md-5 sign_up_form">
											<div class="label-box text-center">I am a</div>
											<select name="sex" class="field select chzn-done">
												<option value="Male" <?php if(isset($info->sex) && $info->sex == "Male"){ ?> selected <?php } ?> >Male</option>
												<option value="Female" <?php if(isset($info->sex) && $info->sex == "Female"){ ?>  selected <?php } ?> >Female</option>
											</select>  
										</div>
										<div class="col-md-7 sign_up_form">
											<div class="label-box text-center">looking for a</div>
											<select name="lfor" class="field select chzn-done">
												<option value="Male">Male</option>
												<option value="Female" selected>Female</option>
											</select>
										</div>
									</div>
								</div>
								<div class="form-group bd-block">
									<div class="row">
										<div class="col-sm-12 sign_up_form sign_up_form_select">
										    <div class="label-box text-center">Birthday:</div>

										    <div>
										    	<label>Month</label>
												<select name="month" id="month">
													<option <?php if(!isset($info->month)){ ?> selected <?php } ?> ></option>
													<option value="1" <?php if(isset($info->month) && $info->month == '1'){ ?> selected <?php } ?>  >January</option>
													<option value="2" <?php if(isset($info->month) && $info->month == '2'){ ?> selected <?php } ?>  >February</option>
													<option value="3" <?php if(isset($info->month) && $info->month == '3'){ ?> selected <?php } ?>  >March</option>
													<option value="4" <?php if(isset($info->month) && $info->month == '4'){ ?> selected <?php } ?>  >April</option>
													<option value="5" <?php if(isset($info->month) && $info->month == '5'){ ?> selected <?php } ?>  >May</option>
													<option value="6" <?php if(isset($info->month) && $info->month == '6'){ ?> selected <?php } ?>  >June</option>
													<option value="7" <?php if(isset($info->month) && $info->month == '7'){ ?> selected <?php } ?>  >July</option>
													<option value="8" <?php if(isset($info->month) && $info->month == '8'){ ?> selected <?php } ?>  >August</option>
													<option value="9" <?php if(isset($info->month) && $info->month == '9'){ ?> selected <?php } ?>  >September</option>
													<option value="10" <?php if(isset($info->month) && $info->month == '10'){ ?> selected <?php } ?>  >October</option>
													<option value="11" <?php if(isset($info->month) && $info->month == '11'){ ?> selected <?php } ?>  >November</option>
													<option value="12" <?php if(isset($info->month) && $info->month == '12'){ ?> selected <?php } ?>  >December</option>
												</select>
											</div>

											<div>
										    	<label>Day</label>
												<select name="day" id="day">
													<option value=""></option>
													@for($day = 1; $day < 31; $day++)
													<option <?php if(isset($info->day) && $info->day == $day){ ?> selected <?php } ?> >{{ $day }}</option>
													@endfor
												</select>
											</div>

											<div>
										    	<label>Year</label>
												<select name="year" id="year">
													<option value=""></option>
													<?php $curr_year = Carbon\Carbon::now()->format('Y'); ?>
													@for($year = 1939; $year <= $curr_year; $year++)
													<option <?php if(isset($info->year) && $info->year == $year){ ?> selected <?php } ?>>{{ $year }}</option>
													@endfor
												</select>
											</div>
										</div>
									</div>
									<span class="red-span-error" id="birth_error">
										<strong>
											@if ($errors->has('month') || $errors->has('day') || $errors->has('year'))
											Please enter your birth date
											@endif
										</strong>
									</span>
									
									<!-- <span class="blue-span">Please enter your birth date</span> -->
								</div>
								
								<div class="form-group">
									<label>First Name</label>
									<input type="text" class="form-control" name="name" placeholder="" id="name" value="<?php if(isset($info->name)){ ?>  {{$info->name}} <?php } ?>">
									<span class="red-span-error" id="name_error">
										<strong>@if ($errors->has('name')) {{ $errors->first('name') }} @endif</strong>
									</span>
									<!-- <span class="blue-span">Please enter valid email</span> -->
								</div>
								<div class="form-group">
									<label>Email address</label>
									<input type="email" class="form-control" name="email" placeholder="" id="email" value="<?php if(isset($info->email)){ ?>  {{$info->email}} <?php } ?>">
									<span class="red-span-error" id="email_error">
										<strong>@if ($errors->has('email')) {{ $errors->first('email') }} @endif</strong>
									</span>
									<!-- <span class="blue-span">Please enter valid email</span> -->
								</div>
								<div class="form-group">
									<label>Choose password</label>
									<input type="password" name="password" placeholder="" class="form-control" id="password">
									<span class="red-span-error" id="pass_error">
										<strong>
											@if ($errors->has('password'))
											{{ $errors->first('password') }}
											@endif
										</strong>
									</span>
									<!-- <span class="blue-span">Please enter your password</span> -->
								</div>

								<div class="form-group">
									<label>Select Country</label>
									<select style="width:100%;" name = "continent" id="registercountries" class="form-control">
										<option value="">Select Country</option>
										<option value="Canada">Canada</option>
									</select>
									<span class="red-span-error" id="continent_error">
										<strong>@if ($errors->has('continent')) {{ $errors->first('continent') }} @endif</strong>
									</span>
								</div>

								<div class="form-group usa_zipcode" style="display:none;">
									<label>Zip code</label>
									<input type="text" value="@if( isset($info->zip_code) ) {{ $info->zip_code }} @endif" name="zip_code" id="zip_code" class="form-control" placeholder="">
									<span class="red-span-error" id="zip_code_error">
										<strong>@if ($errors->has('zip_code')) {{ $errors->first('zip_code') }} @endif</strong>
									</span>
								</div>

								<div class="form-group cus-form-group europecountries">
									<label>Select Country</label>
									<select style="width:100%;" name ="country" id="europecountries" class="form-control">
										<option value="">Select Country:</option>
									</select>
									<span class="red-span-error" id="country_error">
										<strong>@if ($errors->has('country')) {{ $errors->first('country') }} @endif</strong>
									</span>
								</div>

								<div class="form-group cus-form-group states">
									<label>Select State</label>
									<select style="width:100%;" name="state" id="states" class="form-control">
										<option value="">Select State:</option>
									</select>
									<span class="red-span-error" id="state_error">
										<strong>@if ($errors->has('state')) {{ $errors->first('state') }} @endif</strong>
									</span>
								</div>

								<div class="form-group cus-form-group cities">
									<label>Select City</label>
									<select style="width:100%;" name="cityname" id="cities" class="form-control">
										<option value="">Select City</option>
									</select>
									<span class="red-span-error" id="city_error">
										<strong>@if ($errors->has('cityname')) {{ $errors->first('cityname') }} @endif</strong>
									</span>
								</div>

								<div class="form-group cus-form-group locations">
									<label>Choose Cafe Location</label>
									<select style="width:100%;" name="cafe" id="locations" class="form-control">
										<option value="">Choose Cafe Location</option>
									</select>
									<input type="hidden" name="location_count" id="location_count" value="1">
									<span class="red-span-error" id="location_error">
										<strong>@if ($errors->has('cafe')) {{ $errors->first('cafe') }} @endif</strong>
									</span>
								</div>

								<div class="form-group cus-form-group custom_interested_in" style="display: none;">
									<label>Who are you interested in?</label>
									<select class="form-control" style="width:100%;" name="interested_in" id="interested_in">
										<option value=""></option>
		                                 <option value="I am a man seeking a women">I am a man seeking a women</option>
		                                 <option value="I am a women seeking a man">I am a women seeking a man</option>
		                                 <option value="I am a man seeking a man">I am a man seeking a man</option>
		                                 <option value="I am a women seeking a women">I am a women seeking a women</option>
		                            </select>

									<span class="red-span-error" id="interested_in_error">
										<strong>@if ($errors->has('interested_in')) {{ $errors->first('interested_in') }} @endif</strong>
									</span>
								</div>

								<div class="form-group cus-form-group">
									<div class="checkbox">
										<label>
											<input name="remember" type="checkbox" value="Remember Me" id="agreemnt" @if(old('remember')) checked @endif> <a href="{{ url('/terms') }}" class="agreemnt">I accept <span style="color: #0071e0; text-decoration: underline;">terms and conditions</span></a>
										</label>
									</div>

									<span class="red-span-error" id="agreemnt_error">
										<strong>@if ($errors->has('remember')) Please Check Terms @endif</strong>
									</span>
								</div>
								<div class="form-group text-center cus-form-group">
									<input class="submit-btn" type="submit" name="" id="sign_up_button" value="Submit">
								</div>
							</form>
						</div>
					</div>
					<div class="col-md-6 col-sm-6 col-xs-12 pull-right">
						<img src="{{ asset('public/img/create-account-ifoundyou.jpg') }}" alt="Reinventing Matchmaking" class="img-responsive">
						{{--<div class="left-block">
							<h1>Reinventing Matchmaking</h1>
							<p>A simpler easier way to meet new people</p>
						</div>--}}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
/*jQuery(document).ready(function(){
	$.ajax({
		url: "{{ url('/registercountries') }}",
		method: 'GET',
		success: function(registercountries) {
  			if(registercountries) {
  				$('#registercountries').html(registercountries);
  			}
  		}
  	});
});*/
</script>

<script type="text/javascript">
	jQuery(document).ready(function(){

		// unique user check start
		$('#email').blur(function() {
			var emailId = $(this).val();
			$('#email_error strong').html('');
			$('#sign_up_button').attr('disabled', false);
			
			$.ajax({
				url:  "{{ url('/check-unique-user') }}",
				method: 'GET',
				data : {'email': emailId},
				success: function( response ) {
					if( response > 0 ) {
						$('#email_error strong').html('Email not available.');
						$('#sign_up_button').attr('disabled', true);
					}
				}
			});
		});
		// unique user check end

		$('#registercountries').change(function(){

			var value = $(this).val();

			$('#zip_code').val('');
			$('.usa_zipcode').hide();
			$('.custom_interested_in').hide();
			if(value == 'USA')
			{
				$('.usa_zipcode').show();
				$('.custom_interested_in').show();
			}

			if(value == 'Europe')
			{
				$.ajax ( {

					url:  "{{ url('/europecountries') }}",
					method: 'GET',
						success: function(europecountries){
						if(europecountries){
							$('#europecountries').html(europecountries);
							$('#country_error').show();
							$('#europecountries').show();
							$('.europecountries').show();
							$('#continent_error strong').text('');
							$('#cities').css('display','block');
							$('#locations').css('display','block');

							$('.cities').show();
							$('.locations').show();
						}
					}
				})

				$('.custom_interested_in').show();
			}
			else
			{
				$('#europecountries').hide();
				$('.europecountries').hide();
				$('#europecountries').html('<option value="">Select Country</option>');
				$('#country_error').hide();
			}

		})
		
	})
</script>	

<script type="text/javascript">
	jQuery(document).ready(function(){
		var value = localStorage.getItem('continent');
		var value1 = localStorage.getItem('country_name');
		if(value == 'Europe'){
			$.ajax ( {

					url:  "{{ url('/europecountries') }}",
					method: 'GET',
					data: {'country_name':value1},
						success: function(europecountries){
						if(europecountries){
							$('#europecountries').html(europecountries);
							$('#europecountries').show();
							$('.europecountries').show();
						}

					}
				})
		}
		

	})
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$('#registercountries').change(function(){
			var value = $(this).val();
			var value1 = $('#europecountries').val();
			if(value == 'Canada')
			{
				$.ajax ( {

					url:  "{{ url('/getcities') }}",
					method: 'GET',
					data : {'continent':value,'country':value1},
						success: function(getcities){
						if(getcities){
							$('#cities').html(getcities);
							$('#cities').css('display','block');
							$('#locations').css('display','block');
							$('#locations').html('<option value="">Choose Cafe Location</option>');
							$('#states').html('');
							$('#states').css('display','none');
							$('#states').html('<option value="">Select State:</option>');

							$('.cities').show();
							$('.locations').show();
							$('.states').hide();
						}
					}
				})

				$('.custom_interested_in').show();
			}
		})
	})
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$('#europecountries').change(function(){
			var value = $(this).val();
			var value1 = $('#registercountries').val();
			{
				$.ajax ( {

					url:  "{{ url('/getcities') }}",
					method: 'GET',
					data : {'continent':value1,'country':value},
						success: function(getcities){
						if(getcities){
							$('#cities').html(getcities);
							$('.cities').show();
						}
					}
				})
			}
		})
	})
</script>


<script type="text/javascript">
$(document).ready(function(){
	$('#cities').change(function()
	{
		var value = $(this).val();
		var value1 = $('#registercountries').val();
		var value2 = $('#europecountries').val();
		var location_count = $('#location_count').val();

		if( value1 != 'USA' || (value1 == 'USA' && location_count == 0) )
		{
			$.ajax ( {
				url:  "{{ url('/getlocations') }}",
				method: 'GET',
				data : {'city':value,'continent':value1,'country':value2,'location_count':location_count},
				success: function(getlocations) {
					if(getlocations) {
						$('#locations').html(getlocations);
						$('.locations').show();
					}
				}
			});
		}
	});
});
</script>


<script type="text/javascript">
	$(document).ready(function(){
		$('#registercountries').change(function(){
			var value = $(this).val();
			if(value == 'USA')
			{
				$.ajax ( {

					url:  "{{ url('/usastates') }}",
					method: 'GET',
						success: function(usastates){
						if(usastates){
							$('.states').show();
							$('.cities').show();
							$('.locations').show();

							$('#states').html(usastates);
							$('#states').css('display','block');
							$('#cities').css('display','block');
							$('#locations').css('display','block');
							$('#cities').html('<option value="">Select City</option>');
							$('#locations').html('<option value="">Choose Cafe Location</option>');
						}
					}
				})
			}
		})
	})
</script>


<script type="text/javascript">
	$(document).ready(function(){
		$('#states').change(function(){
			var value = $(this).val();
			
			$.ajax ( {

				url:  "{{ url('/usacities') }}",
				method: 'GET',
				data : {'state_code':value},
					success: function(usacities){
					if(usacities){
						$('#cities').html(usacities);
						$('.cities').show();
					}
				}
			})
			
		})
	})
</script>


<script type="text/javascript">
	$(document).ready(function(){
		$('#registercountries').change(function(){
			var value = $(this).val();
			if(value == 'Europe')
			{
				$('#cities').html('<option value="">Select City</option>');
				$('#locations').html('<option value="">Choose Cafe Location</option>');
				$('#states').css('display','none');
				$('.states').hide();
			}
		})
	})
</script>

@endsection
