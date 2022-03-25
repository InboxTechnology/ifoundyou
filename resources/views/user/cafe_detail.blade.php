@extends('layouts.full_dashboard')

@section('content')
<style type="text/css">
	.nav-inner{margin: 0 2px;}
</style>
<div class="col-md-12 col-sm-12 col-xs-12">

	<ul class="nav-inner">
		<li><a href="{{ url('/user/edit-profile-dashboard')}}">Home</a></li>
		<li><a href="{{ url()->previous() ?? url('/user/cafe-members') }}">Cafe Members</a></li>
		<li class="active"><a href="javascript:;">Cafe Location</a></li>
	</ul>

	<div class="cafe-form col-md-12">
		<div class="row">
			<div class="col-md-12 view-profile">
				<div class="col-sm-12 col-sm-offset-0">
					<h3 class="text-center" style="text-transform:capitalize; margin-top:5px;">{{ $cafeDetail->store_name }}</h3>
					<br />

					<div class="row">
						<div class="col-md-5">
							<div class="view-box">	
								<h2>Location</h2>
								<div >
									<label>Address :</label>
									<span>{{ $cafeDetail->address_line_1 }}</span>
								</div>
								@if( $cafeDetail->address_line_2!='' || $cafeDetail->address_line_3!='' )
									<div >
										<label>Address :</label>
										<span>{{ $cafeDetail->address_line_2.' '.$cafeDetail->address_line_3 }}</span>
									</div>
								@endif
								<div id="cafe-address">
									<label>City:</label>
									<span>{{ $cafeDetail->getCafeCity->city_name }}</span>

									<label>State:</label>
									<span>{{ $cafeDetail->getCafeState->state_name }}</span>

									<label>Zip:</label>	
									<span>{{ $cafeDetail->zip_code }}</span>
								</div>
							</div><!-- view-box -->
						</div><!-- col-md-4 -->

						<div class="col-md-4">
							<div class="view-box">
								<h2>Services</h2>
								<div>
									<label>Services:</label><br />					
									<span>{{ $cafeDetail->services }}</span>
								</div>
							</div><!-- view-box -->
						</div><!-- col-md-4 -->

						<div class="col-md-3">
							<div class="view-box">
								<h2>Store Hours</h2>
								<?php 
								$bvko=explode(":00 ",$cafeDetail->store_hours);
								for($h=0;$h<count($bvko);$h++){
									echo $bvko[$h];
									echo "<br>";
								} ?>
							</div><!-- view-box -->
						</div><!-- col-md-4 -->						
					</div><!-- row -->

					<div class="users-box text-left view-box">
						<h2>Members</h2>
						@if($cafeDetail->cafeUsers)
							@foreach($cafeDetail->cafeUsers as $user)
							<a href="{{ url('user/user-profile').'/'.$user->id }}" class="membrs">
								<div class="img">
									@if( $user->image && $user->profile_picture_status == 'Approve' )
										<img src="{{ url('/public/img/').'/'.$user->image }}" style="width:50px;height:50px;border-radius:100%">
									@else
										<img src="{{ url('/public/img/profile.png') }}" style="width:50px;height:50px;border-radius:100%">
									@endif
									<span class="gicon"></span>
									<br>
									{{ $user->name }}
								</div>
							</a>
							@endforeach
						@endif
					</div><!-- users-box -->

					<!-- cafe Block -->
					<div class="view-box" style="margin-top:45px">
						<h2>Cafe Location</h2>
						<div class="row">
							<div class="col-md-12">
							<iframe
								width="100%"
								height="450"
								frameborder="0" style="border:0"
								src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBGO8o4JyybRaVx409C2tNowstVKD42FFU&q={{ urlencode($cafeDetail->store_name.','.$cafeDetail->address_line_1.','.$cafeDetail->getCafeCity->city_name.','.$cafeDetail->getCafeState->state_name.','.$cafeDetail->zip_code) }}" allowfullscreen>
							</iframe>
							</div><!-- col -->
						</div><!-- row -->
					</div>
				</div>
			</div>
		</div>	
	</div>

</div>
@endsection
