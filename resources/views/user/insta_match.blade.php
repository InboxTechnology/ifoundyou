@extends('layouts.full_dashboard')

@section('content')
<!-- <style>
.cafe-form
{
	margin-bottom:500px;
}
</style> -->

<style>
	.button-blue
	{
		width: auto;
    	padding: 10px 35px;
    	/*margin: 25px 0 15px;*/
    	background: #0071e0;
    	border-color: #0071e0;
    	color: #fff;
    	letter-spacing: 0;
    	text-decoration: none!important;
    	text-transform: capitalize;
    	display: inline-block;
	}
	#cafe-members-form input:hover{
		border:1px solid #0071e0 !important;
	}
	#search-box
	{
		display:none;
	}
</style>

<div class="col-md-10 col-md-offset-1 col-sm-12 col-xs-12">

	<ul class="nav-inner">
		<!-- <li><a href="{{ url('/user/dashboard')}}">Home</a></li> -->
		<li class="active"><a href="{{ url('/user/match')}}">Match</a></li>
	</ul>
	<div class="cafe-form">
		<div class="no-records col-md-12" style="display: none;">No records found</div>
		<form method="get" action="{{ url('/user/match') }}" id="cafe-members-form">
			<div class="col-md-12">
				<div class="form-group">
					@if(Auth::user()->continent == 'Canada' || Auth::user()->continent == 'Europe' || Auth::user()->continent == 'England')
					<div class="row">
						<div class="col-md-4 col-sm-6 col-xs-12">
							<select id="cityname" name="city" class="form-control ipad">
								<option value="">Select City</option>
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
							<select id="locations" name="loc" class="form-control ipad">
								@if($loc != '')
									<option value = "">{{$cafee[0]->address_line_1}}</option>
								@else
									<option value = "">Choose Cafe Location:</option>	
								@endif		
							</select>
						</div>
						<div class="col-md-4">
							<input type="submit" value="Search" class="button-blue btn cafe-submit ipad" name="search-cafe-members" id="search-cafe-member">
						</div>
						
					</div>
					<div class="row">
						<div class="col-md-12 col-sm-6 col-xs-12">
							<input type="text" name="cafe_location" placeholder="Search by: Address" readonly class="form-control" id="search-box" autocomplete="off" value="{{ app('request')->input('cafe_location') }}">
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
								@if($city != '')
									<option value = "">{{$city}}</option>
								@else
									<option value="">Select City:</option>
								@endif	
							</select>
						</div>
						<div class="col-md-3 col-sm-6 col-xs-12">
							<select id="usa_locations" name="lop" class="form-control ipad">
								@if($lop != '')
									<option value = "">{{$cafeee[0]->store_name}},{{$cafeee[0]->city}},{{$cafeee[0]->country}},{{$cafeee[0]->zip_code}}</option></option>
								@else
									<option value = "">Choose Cafe Location:</option>
								@endif
							</select>
						</div>
						<div class="col-md-3">
							<input type="submit" value="Search" class="button-blue btn cafe-submit ipad" name="search-cafe-members" id="search-cafe-member">
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 col-sm-6 col-xs-12">
							<input type="text" name="cafe_location" placeholder="Search by: State or Zip/Postal Code" class="form-control" id="search-box" autocomplete="off" value="{{ app('request')->input('cafe_location') }}">
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
			
		</form>
		<div class="info-content">
			@if(count($cafes) > 0)
			@foreach($cafes as $cafe)
				@foreach($cafe->cafeUsers as $user)
					<div class="search-result">
						@if($user->name)
						 <h2><a class="view" href="{{ url('/') }}/profile/{{ $user->id }}"> {{ $user->name }} </a></h2>
						 <a href="{{ url('/') }}/profile/{{ $user->id }}" class="htt">{{ url('/').'/user/'.$user->name }}</a>
						@else
						 <h2><a class="view" href="{{ url('/') }}/profile/{{ $user->id }}"> {{ $user->email }} </a></h2>
						 <a href="{{ url('/') }}/profile/{{ $user->id }}" class="htt">{{ url('/').'/user/'.str_limit($user->email,5) }}</a>
						@endif 
						<div class="description" style="margin-top: 5px;">
						 <p>@if($user->sex)<b>Gender: </b>{{ $user->sex }}@endif @if($user->live_in) , 
						 @if($cities)
						 <b>Lives In:</b> {{ $user->state }}@endif @if($user->looking_for) 
						 @else
						  <b>Lives In:</b> {{ $user->UserState->nstate }}@endif @if($user->looking_for) ,
						 @endif
						 
						 <b>Looking For:</b> {{ $user->looking_for }} @endif</p>
						 @if($user->type_of_relationship)<p> {{ 'I am Looking For '. $user->type_of_relationship }} </p>@endif
						 @if($user->activity) <p>{{ 'I Like '. str_limit($user->activity,150) }} </p>@endif
						</div>
	           		</div>
				@endforeach
				@endforeach
			@else
	           <div class="row text-center">No records found</div>
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
