@extends('layouts.full_dashboard')

@section('content')

<div class="col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
	
	<ul class="nav-inner">
		<!-- <li><a href="{{ url('/user/dashboard')}}">Home</a></li> -->
	</ul>
	<div class="cafe-form">
			<div class="col-md-12">	
				<p>Thank you for completing your profile. Your selected cafe location on map:</p>
			</div>
			<div class="col-md-12" style="margin-top: 10px;">
				@if($cafe)
					<iframe
						width="100%"
						height="450"
						frameborder="0" style="border:0"
						src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBGO8o4JyybRaVx409C2tNowstVKD42FFU&q={{ urlencode($cafe->store_name.','.$cafe->address_line_1.','.$cafe->city.','.$cafe->state.','.$cafe->zip_code) }}" allowfullscreen>
						</iframe>
				@endif
			</div>
	</div>

</div>

<style type="text/css">
#map_wrapper {
	height: 500px;
}

#map_canvas {
	width: 100%;
	height: 100%;
}
#search-cafe-result li {
	cursor: pointer;
}
</style>

@endsection
