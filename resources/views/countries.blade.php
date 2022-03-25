@extends('layouts.app')

@section('content')


<style>
	.nomargin{
		margin: 0px;
	}
	.abc{
		width:20%;
		position:absolute;
		top:119px;
		left:304px;
	}
	.form-control
	{
		width:20%;
	}
	#map_wrapper
	{
		height: 500px;
	}
	#map_canvas
	{
		width: 100%;
		height: 100%;
	}
</style>

<select id ="countryname" class="abc form-control" name="countryname">
	<option value="">Countries:</option>
	@foreach($data as $view)
		<option value="{{$view->id}}">{{$view->country_name}}</option>
	@endforeach
</select>

<select id ="cityname" class="form-control" name="cityname">
<option value ="">Select City:</option>
</select>

<select id ="locations" class="form-control" name="locations">
<option value = "">Choose Location:</option>
</select>

<input type="text" class="form-control" id="selectedloc">

<div class="col-md-12" style="margin-top: 10px;">
	<div id="map_wrapper">
		<div id="map_canvas" class="mapping"></div>
	</div>
</div>


<script type="text/javascript">
var store_name ='';
	jQuery(document).ready(function(){
		$('#countryname').change(function() {

  			if( $(this).val() == 4 )
  			{
  				$.ajax( {
  					url: './cities',
  					method: 'GET',
  					success: function(cities){
  						if(cities){
  							$('#cityname').html(cities);
  						}
  					}
  				})
  			}
		});


		$('#cityname').change(function() {
  			 var value = $(this).val(); 
  			
  				$.ajax( {
  					url: './location',
  					data : 'city='+value,
  					success: function(location){
  						if(location){
  							$('#locations').html(location);
  						}
  					}
  				})
  			
		});


		$('#locations').change(function(){
			var value = $(this).val(); 
			var map;
			var geocoder = new google.maps.Geocoder();
			var infowindow = new google.maps.InfoWindow({ content: '' });

				$.ajax( {

					url:'./selectedloc',
					data : 'id='+value,
					dataType: "json",
					success:function(selectedloc){
						if(selectedloc!=''){
							$('#selectedloc').val(selectedloc[0].address_line_1);
							store_name = selectedloc[0].store_name;
							var address_line_1 = selectedloc[0].address_line_1;
							var lat = "";
  							var lng = "";
							geocoder.geocode({'address': address_line_1},function(results,status){
							         
								if(status == google.maps.GeocoderStatus.OK){
									var latitude = results[0].geometry.location.lat();
		 							var longitude = results[0].geometry.location.lng();
		 							console.log(latitude);
		 							console.log(longitude);
									var latlng = new google.maps.LatLng(latitude, longitude);
									var mapOptions = { mapTypeId: 'roadmap',center: latlng,zoom:15,};
									map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
									map.setCenter(latlng);
									var marker = new google.maps.Marker({
		    							position: latlng,
		    							map: map,
		    							title: store_name
									});	

								}
							})
							
						}
					}
				})
		})


})

	jQuery(function($) {

		var script = document.createElement('script');
		script.src = "http://maps.googleapis.com/maps/api/js?key=AIzaSyCgy7EGnKxaHmvGwfHRgdsjtPXUmM0uCMc&callback=initialize";
		document.body.appendChild(script);
	});
	var geocoder;
	var map;
	var places;
    var markers = [];
	function initialize() {
		geocoder = new google.maps.Geocoder();
		var latlngCenter = new google.maps.LatLng(54.34442, -6.64404);
		var mapOptions = {
			mapTypeId: 'roadmap',
			center:  latlngCenter,
			zoom:7,
		};
		map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
	}


</script>	


@endsection









