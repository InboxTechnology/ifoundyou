


@extends('layouts.full_dashboard_wlogin')

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

		.cl-appform .error label{
			color: red !important;
			padding-left: 56px !important;
		}

		.search {
			margin-top: 35px !important;
		}

		.cl-appform .form-control {
			width: calc(100% - 9px) !important;
		}

		.state{
			padding: 0px !important;
		}
		.filter{
			margin-left: 16px;
			margin-bottom: 49px;
		}
		/*#cafe-members-form input:hover
		{
			border:1px solid #0071e0 !important;
		}*/
	</style>
	<ul class="nav-inner">
		@if(Session::get('custom'))
			<li><a href="{{ url('/user/dashboard')}}">Home</a></li>
			<li class="active"><a href="{{ url('/user/custom')}}">Find Match</a></li>
		@else
			<li><a href="{{ url('/find-match')}}">Home</a></li>
			<li class="active"><a href="{{ url('/custom')}}">Find Match</a></li>
		@endif
	</ul>
	<div class="cafe-form">
		<!-- <div class="no-records col-md-12" style="display: none;">No records found</div> -->
			<form method="get" action="{{ url('/custom-search') }}" id="cafe-members-form">
				<div class="col-md-12">
					<div class="form-group">
						
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12 state">
								<div class="col-md-5 col-sm-6 col-xs-12">
									<!-- <label><strong>State:</strong></label> -->
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
							
								<div class="col-md-5 col-sm-6 col-xs-12">
									<!-- <label><strong>City:</strong></label> -->
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
							</div>

							
							

							<div class="clearfix"></div>
								<div class="col-md-3 col-sm-6 col-xs-12 cl-appform">
									<!-- <label style="padding: 0px !important;"><strong>Month:</strong></label> -->
									<select class="form-control ipad" name="month" id="month">
									<option value="">Select Month</option>
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
								
							</div>
							<div class="col-md-3 col-sm-6 col-xs-12 cl-appform">
								<!-- <label><strong>Day:</strong></label> -->
								<select class="form-control ipad" name="day" id="day">
									<option value="">Select Day</option>
									@for($day = 1; $day < 31; $day++)
									<option @if(app('request')->input('day') == $day) selected  @endif>{{ $day }}</option>
									@endfor
								</select>
								
							</div>
							<div class="col-md-3 col-sm-6 col-xs-12 cl-appform">
								<!-- <label ><strong>Year:</strong></label> -->
								<select class="form-control ipad" name="year" id="year">
									<option value="">Select Year</option>
									<?php $curr_year = Carbon\Carbon::now()->format('Y'); ?>
									@for($year = 1939; $year <= $curr_year; $year++)
									<option @if(app('request')->input('year') == $year) selected  @endif>{{ $year }}</option>
									@endfor
								</select>
								
							</div>
							<div class="col-md-3 cl-appform">
								<input type="submit" value="Search" class="btn button-blue cafe-submit ipad" name="search-cafe-members" id="search-cafe-member">
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 col-sm-6 col-xs-12">
								<input type="text" name="cafe_location" placeholder="Search by: State or Zip/Postal Code"  style="position:relative;top:10px;width:87%"class="form-control" id="search-box" autocomplete="off" value="{{ app('request')->input('cafe_location') }}">
							</div>
						</div>
						
						<input name="menu_name" value="Cafe Members" type="hidden">

						<input type="hidden" name="continent" value="{{ Auth::user()->continent }}" id="continent">
						<input type="hidden" name="country" value="{{ Auth::user()->country }}" id="country">
						<div id="suggesstion-box" ></div>
					</div>

				</div>
				
				<!-- <div class="col-md-3 col-sm-6 col-xs-12 cl-appform checkbox-form">
					<label>Cafe With Members: <input type="checkbox" name="cafe_with_member" @if(app('request')->input('cafe_with_member')) checked  @endif></label>
				</div> -->

			</form>
			<!-- <div class="col-md-12" style="margin-top: 10px;">
				<div id="map_wrapper">
					<div id="map_canvas" class="mapping"></div>
				</div>
			</div> -->

				
				<!-- NEW CODE -->
				@if(!empty($filtered_data))
					<div class="row">
						<div class="col-md-12 filter">
							<div id="map_wrapper">
								@foreach($filtered_data as $user)
									<div class="row search-information">
										<div class="col-md-12 search">
											<h2>
												@if(!empty($user['name']))
													<a class="view" href="{{ url('/') }}/user-profile/{{ $user['id'] }}"> {{ $user['name']}} </a>
												@else
													<a class="view" href="{{ url('/') }}/user-profile/{{ $user['id'] }}"> {{ substr($user['email'],0 , strpos($user['email'], '@')) }}  </a>
												@endif
											</h2>	
											@if(!empty($user['name']))
												<a href="{{ url('/') }}/user-profile/{{ $user['id'] }}">
												<div class="htt">{{ url('/') }}/{{ $user['name'] }}</div>
												</a>
											@else
												<a href="{{ url('/') }}/user-profile/{{ $user['id'] }}">
												<div class="htt">{{ url('/') }}/{{ $user['email'] }}</div>
												</a>
											@endif
											<div>
												<b>Lives In : @if(!empty($user['state'])) {{$user['state']}} , {{$user['live_in']}} @else {{$user['live_in']}} @endif</b>
											</div>
										</div>
									</div>
								@endforeach
							</div>
						</div>
					</div>
				@else	
				@if(!empty($_GET['ustate']) or !empty($_GET['city']))
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
		/*#map_wrapper {
			height: 500px;
		}

		#map_canvas {
			width: 100%;
			height: 100%;
		}*/

		/*#map_canvas > div:nth-child(2)
		{
			display:none;
		}*/

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
				jQuery('#day').attr('required','required').addClass('error');
				jQuery('#month').attr('required','required').addClass('error');
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

	<script type="text/javascript">
		$(document).ready(function(){
			$("#cafe-members-form").validate({
	        rules: {
	            ustate: "required",
	            city: "required",
	        },
	        messages: {
	            firstname: "Enter your First Name",
	            lastname: "Enter your Last Name",
	            email: {
	                required: "Enter your Email",
	                email: "Please enter a valid email address.",
	            }
	        }
	    })
		})
	</script>


@endsection

