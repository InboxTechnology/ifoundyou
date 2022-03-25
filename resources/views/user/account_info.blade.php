@extends('layouts.full_dashboard')

@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js">
      </script>
<style>
	.row_flex{
        display: flex;
        flex-wrap: wrap;
        border: 1px solid rgba(0,0,0,.2);
        background-color: #deeff5;
    }
    .custom_col{
        background-color: #fff;
        border: 1px solid rgba(0,0,0,.2);
    }
	.wid{width: 32.333333%;margin-bottom:15px;}
	.ss{position:relative;top:11px;}
	.sd{margin-right:12px;}
	.ccc{margin-bottom:15px;width:97%;}
    .dd{display:none;}
    .gg{position:relative;right:16px;margin-bottom: 6px;margin-top: -14px;}
   
    #confirm 
    {
        /*display: none;*/
        background-color: #fff;
        border: 1px solid #aaa;
        /*position: fixed;*/
        width: 450px;
        height: 132px;
        margin:auto;    
        /*left: 50%;
        margin-left: -100px;*/
        padding: 12px 15px 8px;
        box-sizing: border-box;
        border-radius : 3px;
        box-shadow: 1px 1px 10px #888888;
    }
    #confirm button 
    {
        background-color: #fff;
        display: inline-block;
        border-radius: 5px;
        border: 1px solid #aaa;
        padding: 5px;
        text-align: center;
        width: 70px;
        cursor: pointer;
        float:right;
        margin-left:5px;
    }

    
    #confirm .message 
    {
        text-align: left;
    }
    /*#cityName
    {
    	display:none;
    }*/
   /* #Locations
    {
    	display:none;
    }*/
    .load
    {
    	display:none;
    }

    .he{
    	padding-right: 0px !important;
    }
   	/*.usa
   	{
   		display:none;
   	}*/
   	/*.usa1
   	{
   		display:none;
   	}*/
   	.red-span-error 
   	{
    	font-size: 14px;
    	color: red;
    	position: relative;
    	bottom: 15px;
    }

    .fm{
    	padding-top: 10px;
    }

    .nav-inner{
    	margin: 0px 2px !important;
    }

    .nav-inner li a{
    	color: black !important;
    }
    label{font-size: 17px;font-weight: 400;margin-bottom: 0px;color:#51656a;font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;} 
    #account-form table th {
    	text-align: center;
    }
    #account-form table th, #account-form table td {
    	padding: 10px;
    }
    #account-form table, #account-form table th, #account-form table td {
		border: 1px solid rgba(0,0,0,.2);
		border-collapse: collapse;
	}
</style>

<div class="col-md-12 col-sm-12 col-xs-12 hei he">

	<ul class="nav-inner">
		<li><a href="{{ url('/user/dashboard') }}">Home</a></li>
		<li><a href="{{ url('/user/edit-profile-dashboard') }}">Edit Profile</a></li>
		<li class="active"><a href="javascript:;">My Account</a></li>
	</ul>

	<div class="row mt-35 mb-35 ml-0 mr-0 pt-10 pb-10">
		@if (session('success'))
			<div style="background:white;border:none"class="alert gg alert-success text-center" role="alert">
			    <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
			    <strong>Success ! </strong>
			    <span>{{ session('success') }}</span>
			</div>
		@endif
		<form method="post" action="{{ url('user/account-info') }}" id="account-form">
			@csrf
			<table>
				<thead>
					<tr>
						<th width="20%">Personal Information</th>
						<th width="20%">My Email</th>
						<th width="20%">My Cafe</th>
					</tr>
				</thead>
				<tbody>
					<tr style="vertical-align: top;">
						<td>
							<div>
								<div class="form-group">
									<label>Full Name: </label>
									<label>{{ Auth::user()->name }}</label>
									<!-- <input type="text" name="name" class="form-control" placeholder="Full Name" value="{{ Auth::user()->name }}" id="full_name"> -->
								</div>
								<span class="red-span-error" id="full_name_error">
									<strong> @if ($errors->has('name')) {{ $errors->first('name') }} @endif</strong>
								</span>
							</div>

							<div>
								<div class="form-group" id="div_interested_in">
								<label>Who are you interested in? </label>
								<label>{{ Auth::user()->interested_in }}</label>
							</div>
							</div>
						</td>
						<td>
							<div>
								<div class="form-group">
									<label>Email address: </label>
									<label>{{ Auth::user()->email }}</label>
								</div>
								@if ($errors->has('email'))
								<span class="red-span-error">
									<strong>{{ $errors->first('email') }}</strong>
								</span>
								@endif
							</div>

							<div>
								<div class="form-group">
									<label>Life Number: </label>
									<label>{{ $life_path_number }}</label>
								</div>
							</div>

							<div>
								<div class="form-group">
									<label>Chinese Sign: </label>
									<label>{{ $chinese_sign }}</label>
								</div>
							</div>

							<div>
								<div class="form-group">
									<label>Wester Sign: </label>
									<label>{{ $western_sign }}</label>
								</div>
							</div>
						</td>
						<td>
							<div>
								<div class="form-group">
									<label>Country: </label>
									<label>{{ Auth::user()->UserCountry->country_name }}</label>
								</div>
							</div>

							<div>
								<div class="form-group">
									<label>City: </label>
									<label>{{ Auth::user()->UserCity->city_name }}</label>
								</div>
							</div>

							<div>
								<div class="form-group">
									<label>Cafe Location: </label>
									<label>{{ Auth::user()->UserCafe->address_line_1 }}, {{ Auth::user()->UserCafe->store_name }}, {{ Auth::user()->UserCity->city_name }}, {{ Auth::user()->UserCountry->country_name }}, {{ Auth::user()->UserCafe->zip_code }}</label>
								</div>
							</div>
						</td>
					</tr>

					<tr>
						<td>
							<div class="row">
								<div class="col-md-12">
									@php
										$Month = date('F', strtotime(Auth::user()->month));

										$Day = date('d', strtotime(Auth::user()->day));

										$Year = date('Y', strtotime(Auth::user()->year));
									@endphp
									<label>{{ $Month }} {{ $Day }} {{ $Year }}</label>
								</div>
							</div>
						</td>

						<td>&nbsp;</td>

						<td>&nbsp;</td>
					</tr>
				</tbody>
			</table>
		</form>
	</div>
	
</div>
			
@endsection
