@extends('layouts.app')

@section('content')

<style>
	.logo-section
	{	
		padding: 0px 0px 20px;
		margin-top:-135px;
	}
</style>
<div class="container-fluid">
	@if (session('success'))
		<div class="alert alert-success">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>{{ session('success') }}</strong>
		</div>					
	@endif

	@if (session('failure'))
		<div class="alert alert-danger">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>{{ session('failure') }}</strong>
		</div>					
	@endif

	@if (session('warning'))
		<div class="alert alert-warning">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>{{ session('warning') }}</strong>
		</div>					
	@endif


	<div class="wrapper-cl">
		<div class="row mg-toptwo">
			<div class="middle">
				<form method="post" action="{{ url('/advance-search-result') }}" id="home-search-form">
					@csrf
					<div class="col-md-12 text-center logo-section">
						<img src="{{ asset('public/img/logo.png') }}">
					</div>

					{{-- <div class="col-md-offset-3 col-md-6 col-sm-6 bg-dark_custom">
						<div class="row">
							<div class="col-md-10">
								<div class="form-group">
									<input type="text" name="first_Name" class="form-control custom_border search_input" id="fname" placeholder="Example: United States" autocomplete="off" > 
								</div>

								<div class="renderDiv custom_render">
	                                @include('searchResultsRender')
	                            </div>
							</div>
							<div class="col-md-2">
								<input type="button" name="" value="Search" class="blue-btn" id="search-button">
							</div>

							<div class="col-md-12 text-center">
								<label class="radio-inline">
							      <input type="radio" name="gender" value="All" checked>All
							    </label>
							    <label class="radio-inline">
							      <input type="radio" name="gender" value="Male">Male
							    </label>
							    <label class="radio-inline">
							      <input type="radio" name="gender" value="Female">Female
							    </label>
							</div>
						</div>
					</div> --}}
<!-- 					<div class="col-md-3 col-sm-6">
						<div class="form-group">
							Last Name <input type="text" name="last_Name" class="form-control" id="lname" > 
						</div>
					</div> -->
<!-- 					<div class="col-md-2 col-sm-6">
						<div class="form-group">
						Country <select name = "continent" id="registercountries" class="form-control">
						</select>
						<span class="red-span-error" id="continent_error">
							<strong>@if ($errors->has('continent')) {{ $errors->first('continent') }} @endif</strong>
						</span>
						</div>
					</div>		
					<div class="col-md-2 col-sm-6">
						<div class="form-group">
						Location <select name ="country" id="location" class="form-control">
							<option value="">Location:</option>
						</select>
						<span class="red-span-error" id="country_error">
							<strong>@if ($errors->has('country')) {{ $errors->first('country') }} @endif</strong>
						</span>
						</div>
					</div> -->
<!-- 					<div class="form-group cus-form-group">
						<select name ="country" id="europecountries" class="form-control">
							<option value="">country:</option>
						</select>
						<span class="red-span-error" id="country_error">
							<strong>@if ($errors->has('country')) {{ $errors->first('country') }} @endif</strong>
						</span>
					</div> -->
<!-- 					<div class="form-group cus-form-group">
						<select style="width:100%;" name="state" id="states" class="form-control">
							<option value="">Select State:</option>
						</select>
						<span class="red-span-error" id="state_error">
							<strong>@if ($errors->has('state')) {{ $errors->first('state') }} @endif</strong>
						</span>
					</div>	 -->		
					{{-- <div class="col-md-offset-4 col-md-4 text-center">
						<a href="{{ url('/find-match') }} " class="blue-btn" id="match-btn">Find a Match</a>
						<a href="javascript:; " class="blue-btn" id="custom_advance_search">Advance Search</a>
						@if(Auth::check())
							<a href="{{ url('/user/advance-search') }}" class="blue-btn">Advance search</a>
						@else
							 <!-- <a href="{{ url('/register') }}" class="blue-btn">Advance search</a>  -->
						@endif 
					</div> --}}

					<div class="col-md-offset-2 col-md-8 col-sm-6 custom_advance_search_box">
						<div class="row">

							<div class="col-md-4">
								<div class="form-group">
									<label>Month</label>
									<select class="form-control" name="adv_search_month">
										<option value="">Select Month</option>
										<option value="1">January</option>
										<option value="2">February</option>
										<option value="3">March</option>
										<option value="4">April</option>
										<option value="5">May</option>
										<option value="6">June</option>
										<option value="7">July</option>
										<option value="8">August</option>
										<option value="9">September</option><option value="10">October</option>
										<option value="11">November</option>
										<option value="12">December</option>
									</select>
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label>Day</label>
									<select class="form-control" name="adv_search_day">
										<option value="">Select Day</option>
										@php
											$day = 1;
										@endphp

										@for( $i = $day; $i<=31; $i++ )
									        <option value="{{ $i }}">{{ $i }}</option>
									    @endfor
									</select>
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label>Year</label>
									<select class="form-control" name="adv_search_year">
										<option value="">Select Year</option>
										@php
											$startYear = '1950';
											$currentYear = date('Y');
										@endphp

										@for( $i = $startYear; $i<=$currentYear; $i++ )
									        <option value="{{ $i }}">{{ $i }}</option>
									    @endfor
									</select>
								</div>
							</div>

							<div class="col-md-12">
								<div class="form-group">
									<label>Country</label>
									<select class="form-control" name="adv_search_country" id="registercountries">
										<option value="">Select Country</option>
										@php
											$RS_Countries = DB::table('country')->select('*')->where('continent', null)->get();
										@endphp

										@forelse( $RS_Countries as $RS_Country )
										    <option value="{{ $RS_Country->country_name }}">{{ $RS_Country->country_name }}</option>
										@empty
										@endforelse
									</select>
								</div>
							</div>

							<span id="custom_not_usa" style="display: none;">
								<!-- <div class="col-md-12">
									<div class="form-group cus-form-group">
										<select style="width:100%;" name="adv_search_state" id="adv_search_state" class="form-control">
											<option value="">Select State:</option>
										</select>
										<span class="red-span-error" id="state_error">
											<strong>@if ($errors->has('state')) {{ $errors->first('state') }} @endif</strong>
										</span>
									</div>
								</div> -->

								<div class="col-md-12">
									<div class="form-group cus-form-group">
										<label>Select City</label>
										<select style="width:100%;" name="adv_search_city" id="adv_search_city" class="form-control">
											<option value="">Select City:</option>
										</select>
										<span class="red-span-error" id="city_error">
											<strong>@if ($errors->has('city')) {{ $errors->first('city') }} @endif</strong>
										</span>
									</div>
								</div>
							</span>

							<span id="custom_usa" style="display: none;">
								<div class="col-md-12">
									<div class="form-group">
										<label>Zip code</label>
										<input type="text" name="adv_search_zipcode" id="adv_search_zipcode" class="form-control" placeholder="zip code">
									</div>
								</div>
							</span>

							<span class="custom_interested_in" style="display: none;">
								<div class="col-md-12">
									<div class="form-group">
										<label>Who are you interested in?</label>
										<select class="form-control" name="adv_search_interested_in" id="adv_search_interested_in">
											<option value="">Who are you interested in?</option>
			                                 <option value="I am a man seeking a women">I am a man seeking a women</option>
			                                 <option value="I am a women seeking a man">I am a women seeking a man</option>
			                                 <option value="I am a man seeking a man">I am a man seeking a man</option>
			                                 <option value="I am a women seeking a women">I am a women seeking a women</option>
			                            </select>
			                        </div>
			                    </div>
		                    </span>

							<div class="col-md-12 text-center mt-5">
								<input type="submit" value="Search" class="custom_search_btn" >
							</div>

						</div>
					</div>		

					<!-- <div class="col-md-offset-4 col-md-4 col-sm-6">
						<div class="form-group">
							<select class="form-control" name="sex" id="sex">
								<option value="">Looking To Date</option>
								<option value="All">All</option>
								<option value="Bi Female">Bi Female</option>
								<option value="Bi Male">Bi Male</option>
								<option value="Gay Female">Gay Female</option>
								<option value="Gay Male">Gay Male</option>
								<option value="Female">Straight Female</option>
								<option value="Male">Straight Male</option>
							</select>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="col-md-4 col-sm-4 col-xs-12">
						<select class="form-control" name="month" id="month">
							<option value="">Month</option>
							<option value="1">January</option>
							<option value="2">February</option>
							<option value="3">March</option>
							<option value="4">April</option>
							<option value="5">May</option>
							<option value="6">June</option>
							<option value="7">July</option>
							<option value="8">August</option>
							<option value="9">September</option>
							<option value="10">October</option>
							<option value="11">November</option>
							<option value="12">December</option>
						</select>
						<span class="blue-span" style="color: #4295fb;">Enter Birthday</span>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12">
						<select class="form-control" name="day" id="day">
							<option value="">Day</option>
							@for($day = 1; $day < 31; $day++)
							<option>{{ $day }}</option>
							@endfor
						</select>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12">
						<select class="form-control" name="year" id="year">
							<option value="">Year</option>
							<?php $curr_year = Carbon\Carbon::now()->format('Y'); ?>
							@for($year = 1939; $year <= $curr_year; $year++)
							<option>{{ $year }}</option>
							@endfor
						</select>
					</div>
					<div class="col-md-12 text-center">
						<input type="submit" name="" value="search" class="blue-btn" id="search-button">
						@if(Auth::check())
							<a href="{{ url('/user/advance-search') }}" class="blue-btn">Advance search</a>
						@else
							 <a href="{{ url('/register') }}" class="blue-btn">Advance search</a> 
						@endif 
					</div> -->
				</form>
			</div>
		</div>
	</div>
</div>
@if(Auth::check())
<script type="text/javascript">
	jQuery(document).ready(function(){
		$.ajax( {
  			url: "{{ url('/registercountries') }}",
  			method: 'GET',
  			success: function(registercountries){
  			if(registercountries){
  				$('#registercountries').html(registercountries);
  			}
  		}
  	});
});
</script>
@endif

<script type="text/javascript">
function registerCountries(value) 
{
	if( value == 'USA' )
	{
		$('#custom_not_usa').hide();
		$('#custom_usa').show();
		$('.custom_interested_in').show();
		/*$.ajax ( {

			url:  "{{ url('/usastates') }}",
			method: 'GET',
				success: function(usastates){
				if( usastates )
				{
					$('#adv_search_state').html(usastates);
					$('#adv_search_state').show();
					// $('#location').css('display','block');
					// $('#locations').css('display','block');
					// $('#cities').html('<option value="">Select City:</option>');
					// $('#locations').html('<option value="">Choose Cafe Location:</option>');
				}
			}
		})*/
	}
	
	if( value == 'Europe' )
	{
		$('#custom_not_usa').show();
		$('.custom_interested_in').show();
		/*$.ajax ( {
			url:  "{{ url('/europecountries') }}",
			method: 'GET',
				success: function(europecountries){
				if(europecountries){
					$('#adv_search_state').html(europecountries);
					$('#country_error').show();
					$('#adv_search_state').show();
					$('#continent_error strong').text('');
				}
			}
		});*/
		$.ajax ( {
			url:  "{{ url('/get_europe_cities') }}",
			method: 'GET',
			data : {'continent':value},
			success: function(getcities) {
				if(getcities){
					$('#adv_search_city').html(getcities);
				}
			}
		});
	}

	var value1 = $('#europecountries').val();
	if( value == 'England' || value == 'Canada' )
	{
		$('#custom_not_usa').show();
		$('.custom_interested_in').show();

		$.ajax ( {
			url:  "{{ url('/getcities') }}",
			method: 'GET',
			data : {'continent':value},
			success: function(getcities){
				if(getcities){
					$('#adv_search_city').html(getcities);
					// $('#adv_search_city').css('display','block');
				}
			}
		});
	}
}

/*$(window).load(function() {
	registerCountries($('#registercountries').val());
});*/

jQuery(document).ready(function(){
	$('#registercountries').change(function() {
		var value = $(this).val();
		//console.log(value);
		//$('#adv_search_states').html('<option value="">Select State:</option>');
		$('#adv_search_city').html('<option value="">Select City</option>');
		//$('#adv_search_state').hide();
		$('#custom_usa').hide();
		$('#custom_not_usa').hide();
		$('.custom_interested_in').hide();

		registerCountries(value);
	});

	$('#adv_search_state').change(function() {
		var countryValue = $('#registercountries').val();
		var value = $(this).val();
		$('#adv_search_city').html('<option value="">Select City</option>');

		/*if( countryValue == 'USA' ) {
			$.ajax ( {
				url:  "{{ url('/usacities') }}",
				method: 'GET',
				data : {'state_code':value},
				success: function(usacities) {
					if(usacities) {
						$('#adv_search_city').html(usacities);
					}
				}
			});
		}*/

		if( countryValue == 'Europe' ) {
			$.ajax ( {

				url:  "{{ url('/getcities') }}",
				method: 'GET',
				data : {'continent':countryValue,'country':value},
				success: function(getcities){
					if(getcities){
						$('#adv_search_city').html(getcities);
					}
				}
			});
		}
	});
	
});

/*$('#adv_search_interested_in').on('change', function(e)
{
    $(this).closest('form').submit();
});*/
</script>	

<script type="text/javascript">
	jQuery(document).ready(function(){
		var value = localStorage.getItem('continent');
		var value1 = localStorage.getItem('country_name');
		if(value == 'Europe'){
			$.ajax ( {

					url:  "{{ url('/europecountries') }}",
					method: 'GET',
					data: {'country_name':value1},
						success: function(europecountries){
						if(europecountries){
							$('#europecountries').html(europecountries);
							$('#europecountries').show();
						}

					}
				})
		}
		

	})
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#europecountries').change(function(){
			var value = $(this).val();
			var value1 = $('#registercountries').val();
			{
				$.ajax ( {

					url:  "{{ url('/getcities') }}",
					method: 'GET',
					data : {'continent':value1,'country':value},
						success: function(getcities){
						if(getcities){
							$('#cities').html(getcities);
						}
					}
				})
			}
		})
	})
</script>


<script type="text/javascript">
	$(document).ready(function(){
		$('#cities').change(function(){
			var value = $(this).val();
			var value1 = $('#registercountries').val();
			var value2 = $('#europecountries').val();

			$.ajax ( {

					url:  "{{ url('/getlocations') }}",
					method: 'GET',
					data : {'city':value,'continent':value1,'country':value2},
						success: function(getlocations){
						if(getlocations){
							$('#locations').html(getlocations);
						}
					}
				})


		})
	})
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#states').change(function(){
			var value = $(this).val();
			
			$.ajax ( {

				url:  "{{ url('/usacities') }}",
				method: 'GET',
				data : {'state_code':value},
					success: function(usacities){
					if(usacities){
						$('#cities').html(usacities);
					}
				}
			})
			
		})
	})
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#registercountries').change(function(){
			var value = $(this).val();
			if(value == 'Europe')
			{
				$('#cities').html('<option value="">Select City:</option>');
				$('#locations').html('<option value="">Choose Cafe Location:</option>');
				$('#states').css('display','none');
			}
		})
	})
</script>

<script type="text/javascript">
$(document).ready(function() {
	// auto search start
	var search_status = ''; 
    $(".search_input").on("keyup keydown change", function(e) {
        var search_result = $(this).val();
        var length = $(this).length;
        search_status = 'input';
        // console.log(search_result);
        // console.log(length);
        // return false;
        if( length >= 1 ) {
            if( e.keyCode == 13 ) {
                search_status = 'button';
                searchAjax(search_result,search_status);
            }
            searchAjax(search_result, search_status);
        }

        if(length < 1){
            $(".displaynone").css("display","none");
        }
    });

    function searchAjax(search_result,search_status) {
        $.ajax({
            headers: {'X-CSRF-TOKEN': '{{ csrf_token()}}'},
            type: "post",
            dataType: 'html',
            url: "{{url ('/user/all_search')}}",
            data: { "search_result":search_result } ,
            success: function(data) {
                // console.log(search_status);
                if(search_status == 'input'){
                    $(".renderDiv").html(data);
                }
                if(search_status == 'button'){
                    window.location.href = "{{url('/user/all_user?search_result=')}}"+search_result;
                } 
            },
            error: function(data){
                return false;
            }
        });
    }

    // advance search show / hide
	$('#custom_advance_search').click( function() {
		$('.custom_advance_search_box').show();
	});
});
</script>
@endsection


