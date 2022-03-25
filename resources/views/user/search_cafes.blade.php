@extends('layouts.full_dashboard')

@section('content')

<div class="col-md-12 col-sm-12 col-xs-12">

	<ul class="nav-inner">
		<li><a href="{{ url('user/dashboard') }}">Home</a></li>
		<li class="active"><a href="javascript:;">Cafe Search</a></li>
	</ul>

	<div class="cafe-form col-md-12">
		<div class="row">
			<div class="col-md-12">
				<!-- <div class="form-group cl-width"> -->
				<div class="form-group">
					<form method="get" action="{{ url('/user/search-cafes') }}" class="search_cafe_form">
						<div class="row">
							<div class="col-md-3 col-sm-6 col-xs-12">
								<select id="state_id" name="state_id" class="form-control ipad">
									<option value="">Select Provinces</option>
									@if( !empty($states) )
										@foreach($states as $state)
											@php
												$stateSelected = ($search['state_id']==$state->id) ? 'selected' : '';
											@endphp
											<option value="{{ $state->id }}" {{ $stateSelected }}>{{ $state->state_name }}</option>
										@endforeach
									@endif
								</select>
							</div>

							<div class="col-md-3 col-sm-6 col-xs-12">
								<select id="city_id" name="city_id" class="form-control ipad">
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
								<select id="cafe_id" name="cafe_id" class="form-control ipad">
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
								<input type="submit" value="Search" name="search-cafes" class="btn button-blue cafe-submit ipad">
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 col-sm-6 col-xs-12">
								<input type="text" name="cafe_location" placeholder="Search by: State or Zip/Postal Code" style="position:relative;top:10px;width:83%;display: none;" readonly class="form-control" id="search-box" autocomplete="off" value="{{ app('request')->input('cafe_location') }}">
							</div>
						</div>
					</form>
					<div id="suggesstion-box" ></div>
				</div>
			</div>
		</div>
		<div class="row" style="margin-top: 10px;margin-bottom: 30px;">
			<div class="col-md-12 px-0">
				<div id="map_wrapper">
					<div id="map_canvas" class="mapping"></div>
				</div>
			</div>
		</div>
		@if(!empty($cafes))
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
			<!-- @if(empty($cafes))  -->
			<div class="row text-center">No records found</div>
			<!-- @endif -->
		@endif

	</div>

</div>

<?php 
if( !empty($script_cafes) )
{
	$script_cafes = $script_cafes; 
}
else
{
	$script_cafes = '';
}
?>
<script type="text/javascript">
	 // CMS.Maps.map.setZoom(14); 
	jQuery(function($) {
	    // Asynchronously Load the map API 
	    var script = document.createElement('script');
	    // script.src = "http://maps.googleapis.com/maps/api/js?key=AIzaSyATmIMiYgiXrPMtpjDdPKumYGk6cIcUDS0&callback=initialize";
	    script.src = "https://maps.googleapis.com/maps/api/js?key=AIzaSyCgy7EGnKxaHmvGwfHRgdsjtPXUmM0uCMc&callback=initialize&z=1";
	    //script.src = "//maps.googleapis.com/maps/api/js?key=AIzaSyBGO8o4JyybRaVx409C2tNowstVKD42FFU&q&sensor=false&callback=initialize";
	    // script.src = "https://maps.googleapis.com/maps/api/js?key=AIzaSyCebsL2vgVPv-bxs5GvFfMji0zjllqPdWs&callback=initialize";
	    document.body.appendChild(script);
	});

	function initialize() {
		var continent = "<?php echo Auth::user()->continent;?>";
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
		var check = {!! $script_cafes !!};
        if (check !='') {
        	var data =  {!! $script_cafes !!}; 
        	// console.log(data);
    	}else{
    		var data = '';
    	}

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
        	 		// if(data[i].cafe_users.length == 0) {
        	 		// 	info_data+= `<p>User Register In Cafe (0)<p>`;
        	 		// } else {
        	 		// 	info_data+= `<p>User Register In Cafe (`+data[i].cafe_users.length+`)<p>`;
        	 		// 	data[i].cafe_users.forEach(function(item) {
        	 		// 		info_data+= `<p><a href="{{ url('/user/user-profile/') }}/`+item.id+`">`+item.name+`</a><br></p>`;
        	 		// 	}); 
        	 		// }
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
