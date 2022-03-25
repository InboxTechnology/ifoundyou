@extends('layouts.full_dashboard')


@section('content')

<style type="text/css">
	
	.he{
		padding: 0px !important;
	}
	.nav-inner li a{
		color: black !important;
	}
</style>
<link href="{{ asset('public/css/jquery.scrolling-tabs.css') }}" rel="stylesheet">

<div class="col-md-12 col-sm-12 col-xs-12">

	<ul class="nav-inner">
		<li><a href="{{ url('/user/edit-profile-dashboard') }}">Home</a></li>
		<li class=""><a href="{{ url('/user/edit-profile-dashboard') }}">Edit Profile</a></li>
		<li class="active"><a href="javascript:;">My Cafe</a></li>
	</ul>

	<style type="text/css">
	#map_wrapper {
		height: 500px;
	}

	#map_canvas {
		width: 100%;
		height: 100%;
	}
	.search-information .col-md-12{
	    margin-left: 16px;
	}
	.nav-inner{margin: 0px 2px;}
	</style>

	<div class="col-md-12" style="margin-top: 10px;">
		<div id="map_wrapper">
			<div id="map_canvas" class="mapping"></div>
		</div>
	</div>

	@if( $cafes )
		<div class="row">
			<div class="col-md-12">
				<div id="map_wrapper">
					@foreach( $cafes as $cafe )
						<div class="row search-information">
							<div class="col-md-12">
								<h2>
									<a class="view" href="{{ url('/') }}/user/cafe-detail/{{ $cafe->id }}"> {{ $cafe->store_name.', '.$cafe->address_line_1 }} </a>
								</h2>	
								<a href="{{ url('/') }}/user/cafe-detail/{{ $cafe->id }}">
									<div class="htt">{{ url('/') }}/cafe-detail/{{ $cafe->store_name }}</div>
								</a>
							</div>
						</div>
					@endforeach
				</div>
			</div>
		</div>
	@else
		<div class="row text-center">No records found</div>
	@endif

	<div class="users-box text-left view-box">

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
	
		var lat = 40.730610;
		var lang = -73.935242;
		
		var map;
		var bounds = new google.maps.LatLngBounds();
		var mapOptions = {
			mapTypeId: 'roadmap',
			center: {lat: lat, lng: lang},
			zoom:5,
		};

		map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
		map.setTilt(45);
        var data = {!! $cafes !!};
        var myArray = new Array();
       	var infoWindow = new google.maps.InfoWindow(), marker, i;
       	// var cafeDetail = 1;
       	// console.log(cafeDetail);
       	var geocoder = new google.maps.Geocoder();
        if(data != null) {
        	 if(data.length > 0) {
        	 	// console.log(data);
        	 	for( i = 0; i < data.length; i++ ) {
        	 		/*make infowindow*/

        	 		var info_data = `<div class="info_content">`;
        	 		info_data+= `<a href="{{ url('/user/cafe-detail') }}/`+data[i]['id']+`"><h3>`+data[i]['store_name']+', '+data[i]['get_cafe_city']['city_name']+ ', '+data[i]['get_cafe_state']['state_name']+ ', '+data[i]['get_cafe_country']['country_name']+', ' +data[i]['zip_code']+`</h3></a>`;
        	 		info_data+= `<div style="text-align:left">`;
        	 		info_data+=`<p>Users registered in cafe - 1</p>`;
        	 		// info_data+=`<p>Users registered in cafe - `+(cafeDetail.length)+`</p>`;
        	 		
        			// for(j=0 ; j< cafeDetail.length; j++)
        			// {	

        	 	// 		info_data+=`<a  class="membrs users-box text-left view-box" style="color:black;text-decoration:none" href = "{{ url('/user/user-profile') }}/`+cafeDetail[j]['id']+`">
        	 	// 		<div class="img">
        	 				
        	 	// 		<img style="width:50px;height:50px;border-radius:100%" src = "{{ url('/public/img/') }}/`+cafeDetail[j]['image']+`">
        	 				
        	 	// 		</div>	
        	 	// 		<div style="color:black;text-decoration:none">`+cafeDetail[j]['name']+`</div></a>`;
        	 			
        	 	// 	}

        	 	
       

        	 		info_data+= `</div></div>`;

        	 		myArray[i] = info_data;
        	 	
        		

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
	        	 			map.setOptions({ minZoom: 10, maxZoom: 10 });
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
			        	 	map.setOptions({ minZoom: 5, maxZoom: 16 });
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



@endsection