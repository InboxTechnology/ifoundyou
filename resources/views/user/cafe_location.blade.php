@extends('layouts.full_dashboard')

@section('content')
<style>
	.ffff{width: 36%;margin-top:19px;margin-left:15px;}

	.he{
		padding: 0px !important;
	}
	.nav-inner{margin: 0px 17px;}
	.nav-inner li a{
		color: black !important;
	}
	.edit-profile-tabs{margin-top: 30px;}
	#selected-locations {
		display: none;
	}
	#selected-area h3 {
		color: #797979;
		font-size: 18px;
	}
	.cus-colr{
	    color: #2895f1;
	}
</style>

<div class="col-md-12 col-sm-12 col-xs-12 he">
	
	<ul class="nav-inner">
		<li><a href="{{ url('/user/login_match_info') }}">Home</a></li>
		<!-- <li><a href="{{ url('/user/dashboard')}}">Dashboard</a></li> -->
		<li><a href="{{ url('/user/account-info')}}">Account</a></li>
		<!-- <li class="active"><a href="{{ url('/user/cafe-location')}}">Cafe Location</a></li> -->
		<li class="active"><a href="javascript:;">Cafe Location</a></li>
	</ul>
	<div class="edit-profile-tabs">
		@if (Session::has('success'))
		<div style ="background:white;border:none;" class="alert ffff alert-success" role="alert">
	    	<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
	    	<strong>Success ! </strong>
	    	<span>{{ session('success') }}</span>
		</div>					
		@endif
		<form method="post" action="{{ url('/user/update-cafe-location') }}" id="profileForm">
			<div class="tab-content forms-in" id="profile-page">
				{{csrf_field()}}
				<div>
				    @if( !empty($cafe_modify) )
						<h4>Selected Location: {{ $cafe_modify->address_line_1 }}, {{ $cafe_modify->store_name }}, {{ $cafe_modify->city }}, {{ $cafe_modify->country }}, {{ $cafe_modify->zip_code }}</h4>
					@endif

			  		<input type="hidden" value="{{ Auth::user()->cafe }}" name="cafe" id="cafe-input-hidden">

					<div class="col-md-4 col-sm-6 col-xs-12">
						<select id="cityname" name="city" class="form-control">
							<option value="">Select City</option>
							@foreach( $cities as $view )
							<option value="{{ $view->city }}" @if(Auth::user()->city == '{{ $view->city }}') selected @endif>{{ $view->city }}</option>
							@endforeach
						</select>
					</div>
					<div class="col-md-4 col-sm-6 col-xs-12">
						<select id="locations" class="form-control">
							<option value = "">Choose Cafe Location</option>
						</select>
						<div style="color:red;" class="choose_error"></div>
					</div>

					<div class="list-unstyled list-inline col-md-4">
						<button class="btn cafe-submit" type="button" id="save">Submit</button>
					</div>
				
					<div class="location-wrap">
							
					</div>
					<div class="col-md-12" style="margin-top: 10px;" id="selected-locations">
						<h3> New Selected Location:</h3>
						<div id="selectedlocation"></div>
					</div>
					<div class="clearfix"></div>
					
				</div>
			</div>
		</form>
	</div>

</div>
	   
<script type="text/javascript">
$(document).ready(function(){
	$('#save').click(function(){
		var continent  ="<?php echo  Auth::user()->continent; ?>";
		var cafe = '';
		
 		var value1 = $('#cityname').val();
		cafe = $('#locations').val();
		if(value1 !='')
		{
 			if(cafe == '')
 			{
				$('.choose_error').html('Please Choose Cafe Location');
					return false;
 			}
			else
			{
				$('.choose_error').hide();
				$('#profileForm').submit();
			}
 		}
	});

});

jQuery(document).ready(function(){
	$('#cityname').change(function(){
		var value = $(this).val();
		$.ajax({
			type:'GET',
		url:"{{url('/user/showlocations')}}",
		data : {'city':value},
			success: function(showlocations){
				if(showlocations){
					$('#locations').html(showlocations);
				}
			}
		});
	});
});

jQuery(document).ready(function(){
	$('#locations').change(function(){
		var value = $(this).val();
		if(value != '')
		{
			$.ajax({
				type:'GET',
				url:"{{url('/user/selectedlocation')}}",
				data : {'zip_code':value},
				dataType: "json",
				success:function(selectedlocation){
					console.log(selectedlocation);
					console.log(selectedlocation[0].address_line_1);
					console.log(selectedlocation[0].city);
					console.log(selectedlocation[0].country);
					console.log(selectedlocation[0].store_name);


					if(selectedlocation!=''){
						$('#selected-locations').show();
						$('#selectedlocation').html(''+selectedlocation[0].address_line_1+', '+selectedlocation[0].store_name+', '+selectedlocation[0].city+', '+selectedlocation[0].country+', '+selectedlocation[0].zip_code+'');
						$('#cafe-input-hidden').val(value);
						//$('.choose_error').hide();

					}
				}
			});
		}
		else
		{
			
		}
	});
});
</script>

@endsection