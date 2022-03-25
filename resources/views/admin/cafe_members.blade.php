

@extends('layouts.full_dashboard')

@section('content')
<style>
	.button-blue
	{
		width: auto;
    	padding: 10px 35px;
    	/*margin: -10px 0 15px;*/
    	background: #0071e0;
    	border-color: #0071e0;
    	color: #fff;
    	letter-spacing: 0;
    	text-decoration: none!important;
    	text-transform: capitalize;
    	display: inline-block;
	}
	#search-box
	{
		display:none;
	}
	/*#cafe-members-form input:hover
	{
		border:1px solid #0071e0 !important;
	}*/
</style>
<ul class="nav-inner">
	<li><a href="{{ url('/user/dashboard')}}">Home</a></li>
	<li class="active"><a href="{{ url('/user/cafe-members')}}">Cafe Members</a></li>
</ul>
<div class="cafe-form">
	<div class="no-records col-md-12" style="display: none;">No records found</div>
	<form method="get" action="{{ url('/user/cafe-members') }}" id="cafe-members-form">
		<div class="col-md-12">
			<div class="form-group">
				@if(Auth::user()->continent == 'Canada' || Auth::user()->continent == 'Europe' || Auth::user()->continent == 'England')
				<div class="row">
					<div class="col-md-4 col-sm-6 col-xs-12">
						<select id="cityname" name="city" class="form-control ipad">
							<option value="">Select City:</option>
							@foreach($cities as $view)
								@if($view->city_name == $city)
									<option value="{{$view->city_name}}" selected>{{$view->city_name}}</option>
								@else
									<option value="{{$view->city_name}}">{{$view->city_name}}</option>
								@endif
							@endforeach
						</select>
					</div>
					<div class="col-md-4 col-sm-6 col-xs-12">
						<select id="locations" class="form-control ipad">
							<option value="">Choose Cafe Location:</option>
								@foreach($locations as $view)
									@if($view->address_line_1 == $cafe_location)
										<option value="{{$view->zip_code}}" selected>{{$view->address_line_1}}</option>
									@else
										<<option value="{{$view->zip_code}}">{{$view->address_line_1}}</option>
									@endif
								@endforeach
							<!-- @if($cafe_location != '')
									<option value = "">{{$cafe_location}}</option>
								@else
									<option value = "">Choose Cafe Location:</option>	
								@endif -->
						</select>
					</div>
					<div class="col-md-4">
						<input type="submit" value="Search" class="btn button-blue cafe-submit ipad" name="search-cafe-members" id="search-cafe-member">
					</div>
				</div>	
				<div class="row">
					<div class="col-md-12 col-sm-6 col-xs-12">
						<input type="text" name="cafe_location" placeholder="Search by: Address" style="position:relative;top:10px;width:87%" readonly class="form-control" id="search-box" autocomplete="off" value="{{ app('request')->input('cafe_location') }}">
					</div>
				</div>
				@else
				<div class="row">
					<div class="col-md-3 col-sm-6 col-xs-12">
						<select id="states" name="ustate" class="form-control ipad">
							<option value="">Select State:</option>
								@foreach($states as $view)
									@if($view->state_code == $ustate)
										<option value="{{$view->state_code}}" selected>{{$view->nstate}}</option>
									@else
										<option value="{{$view->state_code}}">{{$view->nstate}}</option>	
									@endif	
								@endforeach
						</select>
					</div>
					<div class="col-md-3 col-sm-6 col-xs-12">
						<select id="usa_cityname" name="city" class="form-control ipad">
							<!-- @if($city != '')
									<option value = "">{{$city}}</option>
								@else
									<option value="">Select City:</option>
								@endif -->
							<option value="">Select City:</option>
							@foreach($usacities as $view)
							@if($view->city == $city)
								<option value="{{$view->city}}" selected>{{$view->city}}</option>
							@else
								<option value="{{$view->city}}">{{$view->city}}</option>
							@endif
						@endforeach

						</select>
					</div>

					
					<div class="col-md-3 col-sm-6 col-xs-12">
					<select id="usa_locations" class="form-control ipad">
						
						<!-- @if($cafe_location != '')
							<option value = "">{{$cafeee[0]->store_name}},{{$cafeee[0]->city}},{{$cafeee[0]->country}},{{$cafeee[0]->zip_code}}</option>
						@else
							<option value = "">Choose Cafe Location:</option>
						@endif -->
						<option value = "">Choose Cafe Location:</option>
							@foreach($usalocations as $view)
								@if($view->zip_code == $cafe_location)
								<option value = "{{$view->zip_code}}" selected>{{$view->store_name}}, {{$view->city}}, {{$view->country}}, {{$view->zip_code}}</option>
								@else
								<option value = "{{$view->zip_code}}">{{$view->store_name}}, {{$view->city}}, {{$view->country}}, {{$view->zip_code}}</option>
								@endif
							@endforeach
						

						
					
					</select>
					</div>
					<div class="col-md-3">
						<input type="submit" value="Search" class="btn button-blue cafe-submit ipad" name="search-cafe-members" id="search-cafe-member">
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 col-sm-6 col-xs-12">
						<input type="text" name="cafe_location" placeholder="Search by: State or Zip/Postal Code"  style="position:relative;top:10px;width:87%"class="form-control" id="search-box" autocomplete="off" value="{{ app('request')->input('cafe_location') }}">
					</div>
				</div>
				@endif
				<input name="menu_name" value="Cafe Members" type="hidden">

				<input type="hidden" name="continent" value="{{ Auth::user()->continent }}" id="continent">
				<input type="hidden" name="country" value="{{ Auth::user()->country }}" id="country">
				<div id="suggesstion-box" ></div>
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
		<div class="col-md-12" style="margin-top: 10px;">
			<div id="map_wrapper">
				<div id="map_canvas" class="mapping"></div>
			</div>
		</div>

<!-- 	@if($cafes == null )
			its null
	@else
			is not null		
	@endif
 -->
<!-- NEW CODE -->
	@if($cafes != 'null')
		<div class="row">
			<div class="col-md-12" style="margin-left: 16px;">
				<div id="map_wrapper">
					@foreach($cafes as $cafe)
					<div class="row search-information">
						<div class="col-md-12">
							<h2>
								<a class="view" href="{{ url('/') }}/user/cafe-detail/{{ $cafe->id }}"> {{ $cafe->store_name.', '.$cafe->address_line_1 }} </a>
							</h2>	
							<a href="{{ url('/') }}/user/cafe-detail/{{ $cafe->id }}">
								<div class="htt">{{ url('/') }}/cafe/{{ $cafe->store_name }}</div>
							</a>
						</div>
					</div>
					@endforeach
				</div>
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
<style type="text/css">
#map_wrapper {
	height: 500px;
}

#map_canvas {
	width: 100%;
	height: 100%;
}

/*#map_canvas > div:nth-child(2)
{
	display:none;
}*/

#search-cafe-result li {
	cursor: pointer;
}

</style>
<script type="text/javascript">
	jQuery(function($) {
    // Asynchronously Load the map API 
    var script = document.createElement('script');
    // script.src = "http://maps.googleapis.com/maps/api/js?key=AIzaSyATmIMiYgiXrPMtpjDdPKumYGk6cIcUDS0&callback=initialize";
    script.src = "http://maps.googleapis.com/maps/api/js?key=AIzaSyCgy7EGnKxaHmvGwfHRgdsjtPXUmM0uCMc&callback=initialize";
    //script.src = "//maps.googleapis.com/maps/api/js?key=AIzaSyBGO8o4JyybRaVx409C2tNowstVKD42FFU&q&sensor=false&callback=initialize";
    // script.src = "https://maps.googleapis.com/maps/api/js?key=AIzaSyCebsL2vgVPv-bxs5GvFfMji0zjllqPdWs&callback=initialize";
    document.body.appendChild(script);
});

	/*if(data.length == 0) {
		jQuery('.no-records').show();
		jQuery('.top-options').hide();
	}*/

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
			zoom:2,
		};

		map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
		map.setTilt(45);
        var data = {!! $cafes !!};
        var myArray = new Array();
       	var infoWindow = new google.maps.InfoWindow(), marker, i;
       	var geocoder = new google.maps.Geocoder();
        if(data != null) {
        	 if(data.length > 0) {
        	 	console.log(data);
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
	jQuery("#search-box").keyup(function(){
		var val = jQuery(this).val();
		var token = jQuery('meta[name="csrf-token"]').attr('content');
		var url_data='';
		var continent = "<?php echo Auth::user()->continent;?>";
		var country = "<?php echo Auth::user()->country;?>";

		if(continent!='' && continent == 'Europe')
		{
			url_data = 'get_address='+val+'&country='+country;
		}
		else if(continent == 'Canada' || continent == 'England')
		{
			url_data = 'get_address='+val+'&continent='+continent;
		}
		else
		{
			if(isNaN(val)){
				url_data = 'get_state='+val; 
			} else{
				url_data = 'keyword='+val;
			}
		}
		if(val == '') {
			jQuery("#suggesstion-box").html('');
		} else {
			jQuery.ajax({
				type: "POST",
				url: "{{ url('/search-cafe') }}",
				data: url_data+'&_token='+token,
				beforeSend: function(){
					jQuery("#search-box").css("background","#FFF url({{ url('public/img/LoaderIcon.gif') }}) no-repeat 165px");
				},
				success: function(data){
					var res = data.split('::');
					jQuery("#suggesstion-box").show();
					data = '<ul id="search-cafe-result">';
					res.forEach(function(item) {
						data+= '<li>'+item+'</li>';	
					});
					data+= '</ul>';
					jQuery("#suggesstion-box").html(data);
					jQuery("#search-box").css("background","#FFF");
				}
			});
		}
	});

	jQuery('body').on('click','#search-cafe-result li',function(event) {
		jQuery("#suggesstion-box").html('');
		jQuery('#search-box').val(jQuery(this).text());
	});

	jQuery('#day').on('change',function(){
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
	
	jQuery('#year').on('change',function(){
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
	
	jQuery('#month').on('change',function(){
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
</script>


<?php $continent = Auth::user()->continent;?>
<?php $country = Auth::user()->country;?>

<script type="text/javascript">

		$(document).on('change','#cityname',function(){
			var city = $(this).val(); 
			var continent = '<?php echo $continent; ?>';
			var country = '<?php echo $country; ?>';

  			$.ajax( {
  				type:'GET',
				url:"{{url('/user/englandcanadalocations2')}}",
				data : {'city':city, 'continent':continent, 'country':country},
  				success: function(englandcanadalocations2){
  					if(englandcanadalocations2){
  						$('#locations').html(englandcanadalocations2);
  					}
  				}
  			})
		})
	
</script>

<script type="text/javascript">
	$(document).on('change','#locations',function(){
		var val=$("#locations :selected").text();
		$('#search-box').val(val);
	})
</script>

<!-- <script type="text/javascript">
	$(document).ready(function(){
			$.ajax( {
  					type:'GET',
					url:"{{url('/user/usacodes')}}",
					success: function(usacodes){
  						if(usacodes){
  							jQuery('#states').html(usacodes);	
  					}
  				}
  			})	
});
</script> -->

<script type="text/javascript">
	$(document).on('change','#states',function(){
		var value = $(this).val();
		if(value)
		{
			$.ajax( {
  					type:'GET',
					url:"{{url('/user/usacities')}}",
					data : {'state_code':value},
					success: function(usacities){
  						if(usacities){
  							jQuery('#usa_cityname').html(usacities);
						}
  					}
  				})

		}
})
</script>

<script type="text/javascript">
	$(document).on('change','#usa_cityname',function(){
		var value = $(this).val();

		$.ajax( {
  					type:'GET',
					url:"{{url('/user/usalocations')}}",
					data : {'city':value},
					success: function(usalocations){
  						if(usalocations){
  							$('#usa_locations').html(usalocations);
  					}
  				}
  			})
	})
</script>


<!-- <script type="text/javascript">
	$(document).on('change','#usa_locations',function(){
		var val=$("#usa_locations :selected").text();
		$('#search-box').val(val);
	})
</script> -->

<script type="text/javascript">
	$(document).on('change','#usa_locations',function(){
		var value = $(this).val();

		$.ajax( {
  					type:'GET',
					url:"{{url('/user/usazipcode')}}",
					data : {'zip_code':value},
					success: function(usazipcode){
  						if(usazipcode){
  							$('#search-box').val(usazipcode);
  					}
  				}
  			})
	})
</script>


@endsection
