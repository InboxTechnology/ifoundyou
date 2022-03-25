@extends('layouts.app')

@section('content')

<style type="text/css">
	                .cafe-submit {
                  width: 123px !important;
                  height: 39px !important;
                  border-radius: 6px !important;
                }

                .form-box select {
                    border-radius: 4px !important;
                    /*padding: 9px 10px !important;*/
                    padding: 7px 6px !important;
                    background: white !important;
                    margin-bottom: 6px !important;
                    border: 1px solid #0000003d !important;
                }

                .modal-login .modal-body{
                	padding: 23px !important;
                }

                .form-box select:hover {
                    border-bottom: 1px solid #0000003d !important;
                }

                .look{
                    margin-bottom: 5px !important;
                }
                .strong{
                    font-size: 15px !important;
                    padding-left: 10px !important;
                }

                .form-control:active, .form-control:focus {
                    border-bottom: 1px solid #0000003d !important;
                }
                .form-control:hover{
                    border-bottom: 1px solid #0000003d !important;
                }

                .modal-header{
                	border-bottom: none !important;
                }

                .mod{
                	box-shadow: none !important;
                	border-radius: 32px !important;
                }

                .city{
                	color: black !important;
                	/*font-weight: bold !important;*/
                }
    .modal-body p strong{color: red;}
</style>
<!-- <style>
.wrapper-cl
{
	margin-bottom:400px;
	min-height:unset;
	padding-bottom:unset;
}
</style> -->
<div class="container">
	<div class="row">
<div class="col-md-12 col-sm-12 col-xs-12 hei">

	<!-- <ul class="nav-inner"> -->
		<!-- <li><a href="{{ url('/') }}">Home</a></li> -->
		<!-- <li><a href="{{ url('/user/dashboard')}}">Dashboard</a></li> -->
		<!-- <li class=""><a href="{{url('/account')}}">Account</a></li> -->
		<!-- <li class="active"><a href="{{url('/country')}}">Country</a></li> -->
		<!-- <li><a href="{{url('/user/cafe-location')}}">Cafe Location</a></li> -->
	<!-- </ul> -->


	<div class="container-fluid pd-none">
    <div class="ct-acct">

        <div class="modal-login">
            <div class="modal-dialog form-box ct-form">
                @if (session('success'))
                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                    <strong>Success ! </strong>
                    <span>{{ session('success') }}</span>
                </div>
                @endif

                @if (session('failure'))
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                    <strong>Warning ! </strong>
                    <span>{{ session('failure') }}</span>
                </div>
                @endif

                 @if (session('info'))
                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                    <strong>Info ! </strong>
                    <span>{{ session('info') }}</span>
                </div>
                @endif

                @if (session('warning'))
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                    <strong>Warning ! </strong>
                    <span>{{ session('warning') }}</span>
                </div>
                @endif
                    <div class="modal-content mod">
                        <div class="modal-header">
                            {{-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> --}}
                            <!-- <a href=""> -->
                                <h4 class="modal-title" id="myModalLabel">
                                    <img src="{{ asset('public/img/logo.png') }}">
                                </h4>
                            <!-- </a> -->
                        </div>
                        <div class="modal-body">
                            <!-- @if ($errors->has('email'))
                            <p class="red-span-error">
                                <p><strong>{{ $errors->first('email') }}</strong>
                                </p>
                            @endif
                            @if ($errors->has('password'))
                            <p class="red-span-error">
                                <strong>{{ $errors->first('password') }}</strong>
                            </p>
                            @endif -->
								@csrf
				

								<?php //print_r($data); ?>
						 	
								
                          			<form method="post" action="" id="all_location">
										<div class="form-group" style="display: none;">
											<label>Select Country</label>
											<select style="width:100%;" name = "continent" id="registercountries" class="form-control">
												
													<option value="USA">USA</option>
												
											</select>
											<span class="red-span-error" id="continent_error">
												<strong>@if ($errors->has('continent')) {{ $errors->first('continent') }} @endif</strong>
											</span>
										</div>

					
									
										<div class="form-group cus-form-group states">
															<label>Select State</label>
															<select style="width:100%;" name="state" id="states" class="form-control city">
																<option value="">Choose One:</option>
															</select>
															<span class="red-span-error" id="state_error">
																<strong>@if ($errors->has('state')) {{ $errors->first('state') }} @endif</strong>
															</span>
										</div>

										<div class="form-group cus-form-group cities">
											<label>Select City</label>
											<select style="width:100%;padding-bottom: 2px !important;" name="cityname" id="cities" class="form-control city">
												<option value="">Choose One</option>
											</select>
											<span class="red-span-error" id="city_error">
												<strong>@if ($errors->has('cityname')) {{ $errors->first('cityname') }} @endif</strong>
											</span>
										</div>

										<div class="form-group usa_zipcode">
											<label>Zip code</label>
											<!-- <input type="text" value="@if( isset($info->zip_code) ) {{ $info->zip_code }} @endif" name="zip_code" id="zip_code" class="form-control" placeholder=""> -->
											<select style="width:100%;padding-bottom: 2px !important;" name="zip_code" id="zip_code1" class="form-control zip_code1 city">
												<option value="">Choose One</option>
											</select>

											<span class="red-span-error" id="zip_code_error">
												<strong>@if ($errors->has('zip_code')) {{ $errors->first('zip_code') }} @endif</strong>
											</span>
										</div>
						 				<div class="form-group text-center" style="margin-top: 18px;">
	                                            <ul class="list-unstyled list-inline">
	                                                <li><button type="button" class="btn cafe-submit search">Submit</button></li>
	                                            </ul>  
	                                    </div>
                                    </form>
						<br>
						<div class="col-md-12 tl-account pd-none center" style="padding-left: 187px;">
							<!-- <div style="text-align: center;"> -->
						<!-- 	<input type="submit" style="float:left;position:relative;" value="Submit" class="btn cafe-submit" > -->
						<!-- </div> -->
						</div>
						
						<hr style="border:1px solid #ccc;width:100%;margin-bottom:20px;display: inline-block;display: none;">
						
						 <!-- <div>
						 	<label for="del">Delete Account:</label>&nbsp;
						    <label class="checkbox-inline">
						      <input class="product-list" name="check" type="checkbox" value="Yes">Yes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						      <input class="product-list"  name="check" type="checkbox" value="No">No
						</div> -->
						<!-- <input style="margin-top:-30px" type="button" style="float:right" value="Delete Account" class="btn del-btn1 sd" id="delete-account"> -->
					</div>
				</div>

				
				
			

                            
                        </div>
                        {{--<div class="modal-footer">

                        </div>--}}
                    </div>
        </div>
    </div>
</div>

	
</div>
</div>
</div>

<style type="text/css">
	.error{
		color: red;
	}
	.hei{
    	height: 0px !important;
    }
</style>

<script type="text/javascript">
	jQuery(document).ready(function(){
		$.ajax( {
  			
  			url: "{{ url('/registercountries_signin') }}",
  			method: 'GET',
  			success: function(registercountries_signin){
  			if(registercountries_signin){
  				$('#registercountries').html(registercountries_signin);
  			}
  		}
  	})
})
</script>

<!-- <script type="text/javascript">
jQuery(document).ready(function(){

	$('#registercountries').change(function(){

			var value = $(this).val();

			$('#zip_code').val('');
			$('.usa_zipcode').hide();
			$('.custom_interested_in').hide();
			if(value == 'USA')
			{
				$('.usa_zipcode').show();
				$('.custom_interested_in').show();
			}

			if(value == 'Europe')
			{
				$.ajax ( {

					url:  "{{ url('/europecountries') }}",
					method: 'GET',
						success: function(europecountries){
						if(europecountries){
							$('#europecountries').html(europecountries);
							$('#country_error').show();
							$('#europecountries').show();
							$('.europecountries').show();
							$('#continent_error strong').text('');
							$('#cities').css('display','block');
							$('#locations').css('display','block');

							$('.cities').show();
							$('.locations').show();
						}
					}
				})

				$('.custom_interested_in').show();
			}
			else
			{
				$('#europecountries').hide();
				$('.europecountries').hide();
				$('#europecountries').html('<option value="">Select Country</option>');
				$('#country_error').hide();
			}

	});
	$('#zip_code').keyup(function()
	{
		var value = $(this).val();
		var value1 = $('#registercountries').val();

		if( value != '' && value.length >= 4)
		{
			$.ajax ( {
				url:  "{{ url('/getlocations') }}",
				method: 'GET',
				data : {'zip_code':value,'continent':value1},
				success: function(getlocations) {
					if(getlocations) {
						var loc = getlocations.split(":::");
						if( loc[0] == 0 )
						{
							$('#locations').html(loc[1]);
							$('#location_count').val(0);
						}
						else
						{
							$('#locations').html(getlocations);
							$('#location_count').val(1);
						}
						$('.locations').show();
					}
				}
			});

			$.ajax ( {
				url:  "{{ url('/usastates') }}",
				method: 'GET',
				data : {'zip_code':value},
				success: function(usastates)
				{
					if(usastates)
					{
						$('.states').show();
						// $('.cities').show();
						//$('.locations').show();

						$('#states').html(usastates);
						$('#states').css('display','block');
						// $('#cities').css('display','block');
						//$('#locations').css('display','block');
						//$('#cities').html('<option value="">Select City</option>');
						//$('#locations').html('<option value="">Choose Cafe Location:</option>');
					}
				}
			});

			$.ajax ( {
				url:  "{{ url('/usacities') }}",
				method: 'GET',
				data : {'zip_code':value},
				success: function(usacities)
				{
					if(usacities)
					{
						$('.cities').show();

						$('#cities').html(usacities);
						$('#cities').css('display','block');

					}
				}
			});
		}
		else
		{
			$('#locations').html('<option value="">Choose Cafe Location</option>');
		}
	});
});
</script> -->



<script type="text/javascript">
	jQuery(document).ready(function(){
		$('#registeredcountries').change(function(){
			var value = $(this).val();
			if(value == 'England' || value == 'Canada')
			{
				$.ajax({
					type:'GET',
					data : {'country':value},
					url: "{{ url('/user/englandcanada') }}",
					success:function(englandcanada){
						// $('#cityName').html(englandcanada);
						// $('#cityName').css('display','block');
						$('#cityname').html(englandcanada);
						$('#europecountries').html('<option value="">Select Country</option>');
						$('#locations').html('<option value="">Select Cafe Location</option>');
						$('.dd').hide();
						$('.usa').hide();
						$('.usa1').hide();
						
					}
				});
			}
		})
	})
</script>


<script type="text/javascript">
	jQuery(document).ready(function(){
		$('#registeredcountries').change(function(){
			var value = $(this).val();
			if(value == 'Europe')
			{
				$('#usastates1').hide();
				$('#usastates').html();
				$('#cityname').html('<option value="">Select City</option>')
			}
		})
	});
</script>

<script type="text/javascript">
	
		$(document).on('change','#europecountries',function(){
			var value = $(this).val();
			if(value)
			{
				$.ajax({
					type:'GET',
					data : {'country':value},
					url: "{{ url('/user/englandcanada') }}",
					success:function(englandcanada){
						// $('#cityName').html(englandcanada);
						// $('#cityName').css('display','block');
						$('#cityname').html(englandcanada);
						$('.usa').hide();
						$('.usa1').hide();
					}
				});
			}
		})
</script>




<script type="text/javascript">

		$(document).on('change','#cityname',function(){
			var city = $(this).val(); 
			var continent = $('#registeredcountries').val();
			var country = $('#europecountries').val();

  			$.ajax( {
  				type:'GET',
				url:"{{url('/user/englandcanadalocations')}}",
				data : {'city':city, 'continent':continent, 'country':country},
  				success: function(englandcanadalocations){
  					if(englandcanadalocations){
  						// $('#Locations').html(englandcanadalocations);
  						// $('#Locations').css('display','block');
  						$('#locations').html(englandcanadalocations);
  					}
  				}
  			})
		})
	
</script>

<script type="text/javascript">
	$(document).on('change','#registeredcountries',function(){
		var value = $('#aioConceptName').find(":selected").text();
		if(value == "USA")
		{
			$.ajax( {
  					type:'GET',
					url:"{{url('/user/usacodes')}}",
					success: function(usacodes){
  						if(usacodes){
  							// jQuery('#usastates1').html(usacodes);
  							jQuery('#usastates').html(usacodes);
  							jQuery('#europecountries').html('');
  							jQuery('#europecountries').hide();
  							jQuery('#cityname').html('<option value="">Select City</option>');
  							jQuery('#locations').html('<option value="">Select Cafe Location</option>');
  							jQuery('.usa').show();
  							jQuery('.dd').hide();
  					}
  				}
  			});
		}
});
</script>

<script type="text/javascript">
	$(document).ready(function(){
		var value = $('#registeredcountries').val();
		if(value == 'Canada' || value == 'England' || value== 'Europe')
		{
			$('#usastates1').hide();
			$('#usastates').html('');
		}
	})
</script>

<script type="text/javascript">
	$(document).on('change','#usastates',function(){
		var value = $(this).val();
		if(value)
		{
			$.ajax( {
  					type:'GET',
					url:"{{url('/user/usacities')}}",
					data : {'state_code':value},
					success: function(usacities){
  						if(usacities){
  							// jQuery('#usacities1').html(usacities);
  							// jQuery('#usacities').html(usacities);
  							// jQuery('.usa1').show();
  							jQuery('#cityname').html(usacities);
  							$('#europecountries').html('<option value="">Select Country</option>');

  					}
  					else
  					{
  						jQuery('.usa1').hide();
  					}
  				}
  			});	
		}
})
</script>

<!-- <script type="text/javascript">
	$(document).on('change','#cityname',function(){
		var value = $(this).val();

		$.ajax( {
  					type:'GET',
					url:"{{url('/user/usalocations')}}",
					data : {'city':value},
					success: function(usalocations){
  						if(usalocations){
  							$('#Locations').html(usalocations);
  							$('#Locations').css('display','block');
  							

  					}
  				}
  			})
	})
</script> -->

<script type="text/javascript">
	$('#delete-account').click(function(){
		var checkedValue = $('.product-list:checked').val();
		if(checkedValue == 'Yes')
		{
			$('#confirm1').show();
		}
	});
</script>

<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery("#accountform").validate({
	    rules: {
		      zip_code:{
		       required:true,
	   		},
	    },
	    messages: {
	      zip_code: "Zip Code is required",
	    }
	});
});
</script>

<script type="text/javascript">
	$(document).ready(function(){
		// $('#registercountries').change(function(){
			var value = $('#registercountries').find(":selected").text();
			if(value == 'USA')
			{
				$.ajax ( {

					url:  "{{ url('/usastates') }}",
					method: 'GET',
						success: function(usastates){
						if(usastates){
							$('.states').show();
							$('.cities').show();
							$('.locations').show();

							$('#states').html(usastates);
							$('#states').css('display','block');
							$('#cities').css('display','block');
							$('#locations').css('display','block');
							// $('#cities').html('<option value=""><strong>Choose One</strong></option>').css('color','black');
							$('#locations').html('<option value="">Choose Cafe Location</option>');
						}
					}
				})
			}
		})
	// })
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$('#states').change(function(){
			var value = $(this).val();
			// alert('1');
			$.ajax ( {

				url:  "{{ url('/usacities') }}",
				method: 'GET',
				data : {'state_code':value},
					success: function(usacities){
					if(usacities){
						$('#cities').html(usacities);
						$('.cities').show();
					}
				}
			})
			
		})
	})
</script>


<script type="text/javascript">
	$(document).ready(function(){
		$('#cities').change(function(){
			var value = $(this).val();
			var value1 = $('#states').find(":selected").val();
			// alert(value);
			// alert(value1);
			$.ajax ( {

				url:  "{{ url('/usacodes') }}",
				method: 'GET',
				data : {'city':value,'state':value1},
					success: function(usacodes){
					if(usacodes){
						$('#zip_code1').html(usacodes);
						$('.zip_code1').show();
					}
				}
			})
			
		})
	})
</script>



<script type="text/javascript">
	$(document).ready(function(){
		// $('#registercountries').change(function(){
			var value = $('#registercoun').find(":selected").text();
			var value1 = $('#europecountries').val();
			if(value == 'England' || value == 'Canada')
			{
				$.ajax ( {

					url:  "{{ url('/getcities') }}",
					method: 'GET',
					data : {'continent':value,'country':value1},
						success: function(getcities){
						if(getcities){
							$('#cities').html(getcities);
							$('#cities').css('display','block');
							$('#locations').css('display','block');
							$('#locations').html('<option value="">Choose Cafe Location</option>');
							$('#states').html('');
							$('#states').css('display','none');
							$('#states').html('<option value="">Select State:</option>');

							$('.cities').show();
							$('.locations').show();
							$('.states').hide();
						}
					}
				})

				$('.custom_interested_in').show();
			}

		$('.search').click(function(){
			// alert("hii");
			var states = $('#states').find(":selected").val();
			var cities = $('#cities').find(":selected").val();
			var zip_code = $('#zip_code1').find(":selected").val();
			if(states == '' || cities == '' || zip_code == '') {
				// jQuery('#state_error strong').text('State is Required');
				// jQuery('#city_error strong').text('City is Required');
				// jQuery('#zip_code_error strong').text('Zip Code is Required');
				$('#search').attr('disabled', true);
			} else {
				jQuery('#state_error strong').text('');
				jQuery('#city_error strong').text('');
				jQuery('#zip_code_error strong').text('');
				$('#search').attr('disabled', false);
			}
		});
	});
	// })
</script>


<script type="text/javascript">
$(document).ready(function(){
	console.log('1');
    $("#all_location").validate({
        rules: {
              state:{
               required:true
            },
          cityname: {
            required: true
            
          },
          zip_code: {
            required: true
            
          },
        },
        messages: {
          state: "State Field is Required",
          cityname: "City Field is Required",
          zip_code: "Zip Code is Required",
        }
    });
});
</script>


@endsection
