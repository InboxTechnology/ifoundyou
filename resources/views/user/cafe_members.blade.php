@extends('layouts.full_dashboard')

@section('content')

<div class="col-md-12 col-sm-12 col-xs-12">

	<ul class="nav-inner">
		<li><a href="{{ url('/user/dashboard') }}">Home</a></li>
		<li class="active"><a href="javascript:;">Cafe Members</a></li>
	</ul>
	<div class="cafe-form">
		<div class="no-records col-md-12" style="display: none;">No records found</div>
		<div class="row">
			<form method="get" action="{{ url('/user/cafe-members') }}" id="cafe-members-form">
				<div class="col-md-12">
					<div class="form-group">
						
						<div class="row">
							<div class="col-md-3 col-sm-6 col-xs-12">
								<select id="state_id" name="state_id" class="form-control ipad" required>
									<option value="">Select Provinces</option>
									@if( !empty($states) )
										@foreach( $states as $state )
											@php
												$stateSelected = ($search['state_id']==$state->id) ? 'selected' : '';
											@endphp
											<option value="{{ $state->id }}" {{ $stateSelected }}>{{ $state->state_name }}</option>	
										@endforeach
									@endif
								</select>
							</div>

							<div class="col-md-3 col-sm-6 col-xs-12">
								<select id="city_id" name="city_id" class="form-control ipad" required>
									<option value="">Select Cities</option>
									@if( !empty($cities) )
										@foreach( $cities as $city )
											@php
												$citySelected = ($search['city_id']==$city->id) ? 'selected' : '';
											@endphp
											<option value="{{ $city->id }}" {{ $citySelected }}>{{ $city->city_name }}</option>
										@endforeach
									@endif
								</select>
							</div>

							<div class="col-md-3 col-sm-6 col-xs-12">
								<select id="cafe_id" name="cafe_id" class="form-control ipad" required>
									<option value = "">Choose Cafe Location</option>
									@if( !empty($cafes) )
										@foreach( $cafes as $cafe )
											@php
												$cafeSelected = ($search['cafe_id']==$cafe->id) ? 'selected' : '';
											@endphp
											<option value="{{ $cafe->id }}" {{ $cafeSelected }}>{{ $cafe->store_name }}, {{ $cafe->getCafeCity->city_name }}, {{ $cafe->getCafeCountry->country_name }}, {{ $cafe->zip_code }}</option>
										@endforeach
									@endif
								</select>
							</div>
							<div class="col-md-3">
								<input type="submit" value="Search" class="btn button-blue cafe-submit ipad" name="search-cafe-members" id="search-cafe-member">
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 col-sm-6 col-xs-12">
								<input type="text" name="cafe_location" placeholder="Search by: City or Zip/Postal Code"  style="position:relative;top:10px;width:87%;display: none;" class="form-control" id="search-box" autocomplete="off" value="{{ app('request')->input('cafe_location') }}">
							</div>
						</div>
						
						<input name="menu_name" value="Cafe Members" type="hidden">
						<div id="suggesstion-box"></div>
					</div>

				</div>
				<div class="clearfix"></div>
				<div class="col-md-3 col-sm-6 col-xs-12 cl-appform">
					<select class="form-control ipad" name="month" id="month">
						<option value="">Choose one</option>
						<option value="1" @if(app('request')->input('month') == '1') selected  @endif>January</option>
						<option value="2" @if(app('request')->input('month') == '2') selected  @endif>February</option>
						<option value="3" @if(app('request')->input('month') == '3') selected  @endif>March</option>
						<option value="4" @if(app('request')->input('month') == '4') selected  @endif>April</option>
						<option value="5" @if(app('request')->input('month') == '5') selected  @endif>May</option>
						<option value="6" @if(app('request')->input('month') == '6') selected  @endif>June</option>
						<option value="7" @if(app('request')->input('month') == '7') selected  @endif>July</option>
						<option value="8" @if(app('request')->input('month') == '8') selected  @endif>August</option>
						<option value="9" @if(app('request')->input('month') == '9') selected  @endif>September</option>
						<option value="10" @if(app('request')->input('month') == '10') selected  @endif>October</option>
						<option value="11" @if(app('request')->input('month') == '11') selected  @endif>November</option>
						<option value="12" @if(app('request')->input('month') == '12') selected  @endif>December</option>
					</select>
					<label>Month</label>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12 cl-appform">
					<select class="form-control ipad" name="day" id="day">
						<option value="">Choose one</option>
						@for($day = 1; $day < 31; $day++)
						<option @if(app('request')->input('day') == $day) selected  @endif>{{ $day }}</option>
						@endfor
					</select>
					<label>Day</label>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12 cl-appform">
					<select class="form-control ipad" name="year" id="year">
						<option value="">Choose one</option>
						<?php $curr_year = Carbon\Carbon::now()->format('Y'); ?>
						@for($year = 1939; $year <= $curr_year; $year++)
						<option @if(app('request')->input('year') == $year) selected  @endif>{{ $year }}</option>
						@endfor
					</select>
					<label>Year</label>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12 cl-appform checkbox-form">
					<label>Cafe With Members: <input type="checkbox" name="cafe_with_member" @if(app('request')->input('cafe_with_member')) checked  @endif></label>
				</div>

			</form>
		</div>

		<div class="row" style="margin-top: 20px;margin-bottom: 30px;">
			<div class="col-md-12">
				<div id="map_wrapper">
					<div id="map_canvas" class="mapping"></div>
				</div>
			</div>
		</div>

		<!-- NEW CODE -->
		@if($cafes != 'null')
			<div class="row py-20" style="border: 1px solid #ddd;min-height: 150px;">
				<div class="col-md-12 text-center">
					<h3 class="mt-0">Cafe Location List</h3>
				</div>
				<div class="col-md-12">
					@foreach($cafes as $cafe)
						<div class="row search-information">
							<div class="col-md-12">
								<h2>
									<a class="view" href="{{ url('/') }}/user/cafe-detail/{{ $cafe->id }}"> {{ $cafe->store_name.', '.$cafe->address_line_1 }} </a>
								</h2>	
								<!-- <a href="{{ url('/') }}/user/cafe-detail/{{ $cafe->id }}">
									<div class="htt">{{ url('/') }}/cafe/{{ $cafe->store_name }}</div>
								</a> -->
							</div>
						</div>
					@endforeach
				</div>
			</div>
		@else	
			@if($cafes == 0) 
			<div class="row text-center">
				<div class="col-md-12">
					<div id="map_wrapper">
						<div class= "cafe-members-result" style="margin-top: 57px;">
						<b>No Records Found<b>
						</div>
					</div>
				</div>
			</div>			
			@endif 
		@endif
	</div>
</div>

<script type="text/javascript">
jQuery(function($) {
    // Asynchronously Load the map API 
    var script = document.createElement('script');
    // script.src = "http://maps.googleapis.com/maps/api/js?key=AIzaSyATmIMiYgiXrPMtpjDdPKumYGk6cIcUDS0&callback=initialize";
    script.src = "https://maps.googleapis.com/maps/api/js?key=AIzaSyCgy7EGnKxaHmvGwfHRgdsjtPXUmM0uCMc&callback=initialize";
    //script.src = "//maps.googleapis.com/maps/api/js?key=AIzaSyBGO8o4JyybRaVx409C2tNowstVKD42FFU&q&sensor=false&callback=initialize";
    // script.src = "https://maps.googleapis.com/maps/api/js?key=AIzaSyCebsL2vgVPv-bxs5GvFfMji0zjllqPdWs&callback=initialize";
    document.body.appendChild(script);
});

	function initialize() {
		var continent = "Canada";
		var lat = 40.730610;
		var lang = -73.935242;

		if(continent!=''){
			lat = 55.3781;
			lang = 3.4360;
		}
		var map;
		var bounds = new google.maps.LatLngBounds();
		var mapOptions = {
			mapTypeId: 'roadmap',
			center: {lat: lat, lng: lang},
			zoom:1,
		};

		map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
		map.setTilt(45);
		map.setOptions({ maxZoom: 18 });
        var data = {!! $cafes !!};
        var myArray = new Array();
       	var infoWindow = new google.maps.InfoWindow(), marker, i;
       	var geocoder = new google.maps.Geocoder();
        if(data != null) {
        	 if(data.length > 0) {
        	 	// console.log(data);
        	 	jQuery('.no-records').hide();
        	 	for( i = 0; i < data.length; i++ ) {
        	 		/*make infowindow*/

        	 		var info_data = `<div class="info_content">`;
        	 		info_data+= `<a href="{{ url('/user/cafe-detail') }}/`+data[i]['id']+`"><h3>`+data[i]['store_name']+', '+(data[i]['state'] ? data[i]['state'] : data[i]['city'])+`</h3></a>`;
        	 		info_data+= `<div style="text-align:left">`;
        	 		if(data[i].cafe_users.length == 0) {
        	 			info_data+= `<p>User Register In Cafe (0)<p>`;
        	 		} else {
        	 			info_data+= `<p>User Register In Cafe (`+data[i].cafe_users.length+`)<p>`;
        	 			data[i].cafe_users.forEach(function(item) {
        	 				info_data+= `<p><a href="{{ url('/user/user-profile/') }}/`+item.id+`">`+item.name+`</a><br></p>`;
        	 			}); 
        	 		}
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
        	 }
        }else{
        	jQuery('.no-records').hide();
        }

    // Override our map zoom level once our fitBounds function runs (Make sure it only runs once)
    var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
    	google.maps.event.removeListener(boundsListener);
    });
    
	}
</script>

<script type="text/javascript">
	jQuery('#day').on('change',function()
	{
		if(jQuery(this).val()!=''){
			jQuery('#month').attr('required','required');
			jQuery('#year').attr('required','required');
		}
		if(jQuery(this).val()==''){
			if(jQuery('#month').val() != ''|| jQuery('#year').val() !='') {
				jQuery(this).attr('required','required');
			}
			jQuery('#month').removeAttr('required');
			jQuery('#year').removeAttr('required');
		}
	});
	
	jQuery('#year').on('change',function()
	{
		if(jQuery(this).val()!=''){
			jQuery('#day').attr('required','required');
			jQuery('#month').attr('required','required');
		}
		if(jQuery(this).val()==''){
			if(jQuery('#month').val() != '' || jQuery('#day').val() !='') {
				jQuery(this).attr('required','required');
			}
			jQuery('#day').removeAttr('required');
			jQuery('#month').removeAttr('required');
		}
	});
	
	jQuery('#month').on('change',function()
	{
		if(jQuery(this).val()!=''){
			jQuery('#day').attr('required','required');
			jQuery('#year').attr('required','required');
		}
		if(jQuery(this).val()==''){
			if(jQuery('#year').val() != ''|| jQuery('#day').val() !='') {
				jQuery(this).attr('required','required');
			}
			jQuery('#day').removeAttr('required');
			jQuery('#year').removeAttr('required');
		}
	});


	jQuery(document).on('change','#state_id', function()
	{
		var stateID = $(this).val();
		$.ajax({
			type:'GET',
			url:"{{ url('/user/cities') }}",
			data : {'stateID':stateID},
			success: function(cities)
			{
				if( cities )
				{
					jQuery('#city_id').html(cities);
					jQuery('#cafe_id').html('<option value="">Choose Cafe Location</option>');
				}
			}
		});
	});


	$(document).on('change','#city_id',function()
	{
		var cityID = $(this).val();
		$.ajax({
			type:'GET',
			url:"{{ url('/user/cafes') }}",
			data : {'cityID':cityID},
			success: function(cafes)
			{
				if( cafes )
				{
					$('#cafe_id').html(cafes);
				}
			}
		});
	});
</script>
@endsection
