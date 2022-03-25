@extends('layouts.full_dashboard')

@section('content')
<!-- <style>
.wrapper-cl
{
	margin-bottom:400px;
	min-height:unset;
	padding-bottom:unset;
}
</style> -->
<ul class="nav-inner">
	<li><a href="{{ url('/user/dashboard') }}">Home</a></li>
	<li class="active"><a href="{{ url('/user/search-member') }}">Search</a></li>
</ul>
<div class="container-fluid">
	<div class="wrapper-cl">
		<div class="row mg-toptwo">
			<div class="">
				<!-- <form method="post" action="{{ url('/user/search-result') }}" id="home-search-form"> -->
					<!-- @csrf -->
					<!-- <div class="col-md-2 text-center logo-section"> -->
						<!-- <a href="{{ url('/') }}"><img src="{{ asset('public/img/logo.png') }}" style="width: 80%;"></a> -->
					<!-- </div>
					<div class="col-md-10" style="margin-top: 10px;">
						<div class="col-md-offset-3 col-md-3 col-sm-6">
							<div class="form-group">
								<select class="form-control" name="sex"  id="sex">
									<option value="">Looking To Date</option>
									<option value="All" @if(@$parameters['sex'] == 'All') selected @endif>All</option>
									<option value="Bi Female" @if(@$parameters['sex'] == 'Bi Female') selected @endif>Bi Female</option>
									<option value="Bi Male" @if(@$parameters['sex'] == 'Bi Male') selected @endif>Bi Male</option>
									<option value="Gay Female" @if(@$parameters['sex'] == 'Gay Female') selected @endif>Gay Female</option>
									<option value="Gay Male" @if(@$parameters['sex'] == 'Gay Male') selected @endif>Gay Male</option>
									<option value="Female" @if(@$parameters['sex'] == 'Female') selected @endif>Straight Female</option>
									<option value="Male" @if(@$parameters['sex'] == 'Male') selected @endif>Straight Male</option>
								</select>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="col-md-3 col-sm-4 col-xs-12 form-group">
							<select class="form-control" name="month" id="month">
								<option value="">Month</option>
								<option value="1" @if(@$parameters['month'] == '1') selected @endif>January</option>
								<option value="2" @if(@$parameters['month'] == '2') selected @endif>February</option>
								<option value="3" @if(@$parameters['month'] == '3') selected @endif>March</option>
								<option value="4" @if(@$parameters['month'] == '4') selected @endif>April</option>
								<option value="5" @if(@$parameters['month'] == '5') selected @endif>May</option>
								<option value="6" @if(@$parameters['month'] == '6') selected @endif>June</option>
								<option value="7" @if(@$parameters['month'] == '7') selected @endif>July</option>
								<option value="8" @if(@$parameters['month'] == '8') selected @endif>August</option>
								<option value="9" @if(@$parameters['month'] == '9') selected @endif>September</option>
								<option value="10" @if(@$parameters['month'] == '10') selected @endif>October</option>
								<option value="11" @if(@$parameters['month'] == '11') selected @endif>November</option>
								<option value="12" @if(@$parameters['month'] == '12') selected @endif>December</option>
							</select>
							<span class="blue-span" style="color: #4295fb;">Enter Birthday</span>
						</div>
						<div class="col-md-3 col-sm-4 col-xs-12 form-group">
							<select class="form-control" name="day" id="day">
								<option value="">Day</option>
								@for($day = 1; $day < 31; $day++)
								<option @if(@$parameters['day'] == $day) selected @endif>{{ $day }}</option>
								@endfor
							</select>
						</div>
						<div class="col-md-3 col-sm-4 col-xs-12 form-group">
							<select class="form-control" name="year" id="year">
								<option value="">Year</option>
								<?php $curr_year = Carbon\Carbon::now()->format('Y'); ?>
								@for($year = 1939; $year <= $curr_year; $year++)
								<option @if(@$parameters['year'] == $year) selected @endif>{{ $year }}</option>
								@endfor
							</select>
						</div>
						<div class="col-md-3 col-sm-4 col-xs-12 form-group">
							 <input name="menu_name" value="Search" type="hidden">
							<input type="submit" name="" value="search" class="blue-btn" id="search-button" style="margin: -4px 0 15px; padding: 9px 35px;">
						</div>
						<div class="clearfix"></div>
					</div>
				</form>
			</div>
		</div> -->
<!-- NEW CODE 03 JULT 2019 -->
            <form method="post" action="{{ url('/user/search-result') }}" id="home-search-form">
               @csrf
               <div class="  col-md-6 col-sm-6">
                  <div class="form-group">
                      <span style="visibility: hidden;">.</span><input type="text" name="first_Name" class="form-control" id="fname" placeholder="Enter Name" > 
                  </div>
               </div>
   
               <div class=" col-md-2 text-center">
                  <input type="button" name="" value="Search" class="blue-btn" id="search-button">
                  <!-- <input type="button" name="" value="Find a Match" class="blue-btn" id="search-button"> -->
                  @if(Auth::check())
                     <!-- <a href="{{ url('/user/advance-search') }}" class="blue-btn">Advance search</a> -->
                  @else
                      <!-- <a href="{{ url('/register') }}" class="blue-btn">Advance search</a>  -->
                  @endif 
               </div>   
               <div class="clearfix"></div>           
            </form>
         </div>
      </div>
      <!-- NEW CODE END HERE -->
		<div class="row">
			<div class="col-md-12">
				@if(@$users)
					@if(count($users) > 0)
					@foreach ($users as $user)
					<div class="search-result">
						@if($user->name)
						<h2><a class="view" href="{{ url('/user/user-profile').'/'.$user->id }}"> {{ $user->name }} </a></h2>
						<a href="{{ url('/user/user-profile').'/'.$user->id }}" class="htt">{{ url('/').'/user/'.$user->name }}</a>
						@else
						<h2><a class="view" href="{{ url('/user/user-profile').'/'.$user->id }}"> {{ $user->email }} </a></h2>
						<a href="{{ url('/user/user-profile').'/'.$user->id }}" class="htt">{{ url('/').'/user/'.str_limit($user->email,5) }}</a>
						@endif 
						<div class="description" style="margin-top: 5px;">
							<!-- <p>@if($user->sex)<b>Gender: </b>{{ $user->sex }}@endif  -->
<!-- 							@if($cities)
							@if($user->live_in) , <b>Lives In:</b> {{ $user->state }}@endif
							@else
							@if($user->live_in) , <b>Lives In:</b> {{ $user->UserState->nstate }}@endif
							@endif
							@if($user->looking_for) , <b>Looking For:</b> {{ $user->looking_for }} @endif</p>
							@if($user->type_of_relationship)<p> {{ 'I am Looking For '. $user->type_of_relationship }} </p>@endif
							@if($user->activity) <p>{{ 'I Like '. str_limit($user->activity,150) }} </p>@endif -->
						</div>
					</div>
					@endforeach
					<div class="col-md-12">
						@if(@$users)
						<!-- 'sum' => $sum WAS ADDED BELOW AFTER SEX. -->
							<!-- {{ $users->appends(['sex' => $sex])->links() }} -->
							{{ $users->appends(['sex' => $sex])->links() }}
						@endif
					</div>
					@else
					<div class="row text-center">No records found</div>
					@endif   
				@endif
			</div>
			
		</div>
	</div>
</div>
@endsection
