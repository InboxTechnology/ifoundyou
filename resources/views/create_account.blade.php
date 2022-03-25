@extends('layouts.app')

@section('content')
<div class="container-fluid pd-none">
	<div class="wrapper-cl ct-acct">
		<div class="container col-md-9 col-md-offset-1">
			<div class="row">
				<div class="col-md-12">
					<!-- <div class="col-md-6 col-sm-6 col-xs-12">
						<div class="left-block">
							<h1>Reinventing Matchmaking</h1>
							<p>A simpler easier way to meet new people</p>
						</div>
					</div> -->
					<div class="col-md-5 col-sm-5 col-xs-12">
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
								<h2>Sign up</h2>
								
								<div class="form-group">
									<div class="row">
										<div class="col-md-6 sign_up_form">
											<div class="label-box text-center">I am a</div>
											<select name="sex" class="field select chzn-done">
												<option value="Male" selected>Male</option>
												<option value="Female">Female</option>
											</select>  
										</div>
										<div class="col-md-6 sign_up_form">
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
									<input type="email" class="" name="email" placeholder="Email address" id="email" value="{{ old('email') }}">
									<span class="red-span-error" id="email_error">
										<strong>@if ($errors->has('email')) {{ $errors->first('email') }} @endif</strong>
									</span>
									<!-- <span class="blue-span">Please enter valid email</span> -->
								</div>
								<div class="form-group">
									<input type="password" name="password" placeholder="Choose password" class="" id="password">
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
									<div class="checkbox">
										<label>
											<input name="remember" type="checkbox" value="Remember Me" id="agreemnt" @if(old('remember')) checked @endif> <a href="{{ url('/terms') }}" class="agreemnt">I accept <span style="color: #0071e0; text-decoration: underline;">terms and conditions</span></a>
										</label>
									</div>
									<span class="red-span-error" id="agreemnt_error">
										<strong>@if ($errors->has('remember')) Please Check Terms @endif</strong>
									</span>
								</div>
								<div class="form-group text-center">
									<input class="submit-btn" type="submit" name="" id="sign_up_button" value="Next">
								</div>
							</form>
						</div>
					</div>
					<div class="col-md-2"></div>
					<div class="col-md-5 col-sm-5 col-xs-12">
						<div class="ct-form" id="newmain">
							<form  action="" method="post" class="form-box" id="create-account-form2">
								@csrf
								<h2>Sign up</h2>
								
								<div class="form-group marginTop">
									<input type="text" class="" name="full_name" placeholder="Full Name" id="full_name" value="{{ old('full_name') }}">
									<span class="red-span-error" id="email_error">
										<strong>@if ($errors->has('full_name')) {{ $errors->first('full_name') }} @endif</strong>
									</span>
								</div>
								<div class="form-group marginTop">
									<input type="text" class="" name="phone_number" placeholder="Phone Number" id="phone_number" value="{{ old('phone_number') }}">
									<span class="red-span-error" id="email_error">
										<strong>@if ($errors->has('phone_number')) {{ $errors->first('phone_number') }} @endif</strong>
									</span>
								</div>
								<div class="form-group marginTop">
									<div class="col-md-6" style="padding-left: 0px">
										<div class="form-group">
											<input type="email" class="" name="email2" placeholder="Email" id="email2" value="{{ old('email2') }}">
											<span class="red-span-error" id="email_error">
												<strong>@if ($errors->has('email2')) {{ $errors->first('email2') }} @endif</strong>
											</span>
										</div>
									</div>
									<div class="col-md-6" style="padding-right: 0px">
										<div class="form-group">
											<input type="password" class="" name="password" placeholder="Password" id="password2" value="{{ old('password') }}">
											<span class="red-span-error" id="email_error">
												<strong>@if ($errors->has('password')) {{ $errors->first('password') }} @endif</strong>
											</span>
										</div>
									</div>
								</div>
								
								<div class="form-group marginTop text-center">
									<button type="submit" class="submit-btn">Submit</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
