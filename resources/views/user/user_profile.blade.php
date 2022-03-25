@extends('layouts.full_dashboard')

@section('content')
<style>
	.cafe-form
	{
		margin-bottom:80px;
	}
	.wrapper-cl
	{
		min-height:unset;
		padding-bottom:unset;
	}

		.he{
		padding: 0px !important;
	}
	.nav-inner {
	    margin: 0px 17px;
	}
	.nav-inner li a{
		color: black !important;
	}
</style>

<div class="col-md-12 col-sm-12 col-xs-12 he">
    
	<ul class="nav-inner">
		<li><a href="{{ url('/user/dashboard') }}">Home</a></li>

		@if( Auth::check() )
			<li><a href="{{ url('/user/edit-profile-dashboard') }}">Edit Profile</a></li>
			
			@if( Auth::id() != $userDetail->id )
				<li class="active"><a href="javascript:;">User Profile</a></li>
			@else
				<li class="active"><a href="javascript:;">My Profile</a></li>
			@endif
		@else
			<li class="active"><a href="{{ url('/user/user-profile').'/'.$userDetail->id }}">User Profile</a></li>
		@endif
	</ul>

	<div class="cafe-form col-md-12">
		<div class="wrapper-cl">
			<div class="container-fluid">
				<div class="row mg-topal">
					<div class="col-md-3 col-sm-12 col-xs-12">
						<div class="user-panelleft">
							<?php
							$result = "";
							if( $userDetail->datepoint<10 )
							{
								$result = "0";
							}
							?>
							<span class="online-user"></span>
							<span class="imgs">
								@if( empty($userDetail->image) && $userDetail->profile_picture_status == 'Unapproved' )
									<img class="image-message img-responsive center-block user-image yy" src="{{asset('/public/img/profile1.png')}}" data-toggle="popover">
								@else
									@if(Request::path() == 'user/user-profile/' && empty($userDetail->PaymentCurrent) && $userDetail->profile_picture_status == 'Approve' )
										<a href="/user/change-photo"><img src="{{ asset('public/img/').'/'.$userDetail->image }}" class="img-responsive center-block user-image ww"></a>
									@elseif( Request::path() == 'user/user-profile/'.request()->route('id') && empty($userDetail->PaymentCurrent) && $userDetail->profile_picture_status == 'Approve' )
										<img src="{{ asset('public/img/').'/'.$userDetail->image }}" class="img-responsive center-block user-image ww">
									@elseif( empty($userDetail->image) && $userDetail->profile_picture_status == 'Unapproved' )
										<img class="image-message img-responsive center-block user-image yy" src="{{asset('/public/img/profile1.png')}}" data-toggle="popover">
									@else
										<a href="/user/change-photo">
											@if( $userDetail->profile_picture_status == 'Approve' )
												<img src="{{ asset('public/img/').'/'.$userDetail->image }}" class="img-responsive center-block user-image xx">
											@else
												<img src="{{asset('/public/img/profile1.png')}}" class="img-responsive center-block user-image xx">
											@endif
										</a>
									@endif
								@endif
							</span>
							<!-- <h3 class="text-center">{{ title_case($userDetail->name) }}<br><br></h3> -->

							<div style="margin-top:30px;text-align:center">
								<span style="font-weight:bold;color:#51656a;font-size: 14px;"> ID #:</span> <span style="color: #51656a;font-family:font-size: 14px;">{{ 'IFY-'.substr_replace($userDetail->year,"0",-4,2).'-'.$result.$userDetail->datepoint.'-'.str_pad($userDetail->id, 4, '0', STR_PAD_LEFT) }}</span>
							</div>
						</div>

						<ul class="nav flex-column user_profile_left_menu mt-45">
						  	<li class="nav-item">
						    	<a class="nav-link" href="javascript:;">Buy Credits</a>
						  	</li>
						  	<li class="nav-item">
						    	<a class="nav-link" href="{{ url('/user/contact-member/'.$userDetail->id) }}">Contact Member</a>
						  	</li>
						  	<li class="nav-item">
						    	<a class="nav-link" href="{{ url('/user/read-mail') }}">Read Mail</a>
						  	</li>
						  	<li class="nav-item">
						    	<a class="nav-link" id="send_letter" data-id="{{ $userDetail->id }}" href="javascript:;">Send Letter</a>
						  	</li>
						</ul>
					</div>
					<div class="col-md-9 col-sm-12 col-xs-12">
						<div class="right-userdetails">
							<div class="col-md-4 col-sm-12 col-xs-12">
								<h3>Identity</h3>
								<ul>
									<li><span>First Name:</span><p>{{ $userDetail->name }}</p></li>
									<li><span>Date Of Birth:</span><p>{{ $userDetail->month.'/'.$userDetail->day.'/'.$userDetail->year }}</p></li>
									<li><span>I was born in: </span><p>@if($userDetail->UserState) {{ $userDetail->UserState->nstate }} @endif</p></li>
									<li><span>Gender:</span><p>{{ $userDetail->sex }}</p></li>
								</ul>
							</div>
							<div class="col-md-4 col-sm-12 col-xs-12">
								<h3>Looks</h3>
								<ul>
									<li><span>Ethnicity:</span><p>{{ $userDetail->ethnicity }}</p></li>
									<li><span>Height:</span><p>{{ $userDetail->height }}</p></li>
									<li><span>Hair Color:</span><p>{{ $userDetail->haircolor }}</p></li>
									<li><span>Language:</span><p>{{ $userDetail->language }}</p></li>
									<li><span>Body Type:</span><p>{{ $userDetail->bodytype }}</p></li>
									<li><span>Eye Color:</span><p>{{ $userDetail->eyecolor }}</p></li>
								</ul>
							</div>
							<div class="col-md-4 col-sm-12 col-xs-12">
								<h3>Horoscope</h3>
								<ul>
									<li><span>Chinese Sign:</span><p>{{ $chinese_sign }}</p></li>
									<li><span>Wester Sign:</span><p>{{ $western_sign }}</p></li>
									<li><span>Gender:</span><p>{{ $userDetail->sex }}</p></li>
									<li><span>Religion:</span><p>{{ $userDetail->religion }}</p></li>
								</ul>
							</div>	
							
							@if( Auth::check() )
								@if(Auth::user()->id == $userDetail->id)
									<div class="col-md-12 col-sm-12 col-xs-12">
										<h3>About my match</h3>
										<div class="col-md-6 col-sm-12 col-xs-12">
											<ul>
												<li><span>Ethnicity:</span><p>{{ $userDetail->about_ethnicity }}</p></li>
												<li><span>Height:</span><p>{{ $userDetail->about_height }}</p></li>
												<li><span>Hair Color:</span><p>{{ $userDetail->about_haircolor }}</p></li>
												<li><span>Language:</span><p>{{ $userDetail->about_language }}</p></li>
											</ul>
										</div>
										<div class="col-md-6 col-sm-12 col-xs-12">
											<ul>
												<li><span>Body Type:</span>{{ $userDetail->about_bodytype }}</li>
												<li><span>Eye Color:</span><p>{{ $userDetail->about_eyecolor }}</p></li>
												<li><span>Gender:</span><p>{{ $userDetail->about_gender }}</p></li>
												<li><span>Relegion:</span><p>{{ $userDetail->about_religion }}</p></li>
											</ul>
										</div>
									</div>
								@endif
							@endif

							<?php /*<div class="col-md-12 col-sm-12">
								<h3>Contact</h3>
								<div class="row custom_profile_contact">
									@php
										$memberUrl = '';
										$emailId = '';
										$phoneNo = '';
									@endphp
									
									@if( Auth::check() )
										@if( $userPaymentDetail )
											@php
												$emailId = $userDetail->email;
												$phoneNo = $userDetail->phone;
											@endphp
										@else
											@if( $payment_settings->membership_status == 'Enable' )
												@php
													$memberUrl = url('/').'/join-today/'.$userDetail->id;
												@endphp
											@else
												@php
													$memberUrl = '#';
												@endphp
											@endif
										@endif
									@else
										@php
											$memberUrl = url('/register');
										@endphp
									@endif

									<div class="col-md-4">
										<span>Contact:</span>
										@if( $memberUrl )
											<a href="{{ $memberUrl }}" class="custom_btn">Membership</a>
										@else
											{{ $phoneNo }}
										@endif
									</div>

									<div class="col-md-4">
										<span>Email:</span>
										@if( $memberUrl )
											<a href="{{ $memberUrl }}" class="custom_btn">Membership</a>
										@else
											{{ $emailId }}
										@endif
									</div>

									<div class="col-md-4">
										<span>Phone:</span>
										@if( $memberUrl )
											<a href="{{ $memberUrl }}" class="custom_btn">Membership</a>
										@else
											{{ $phoneNo }}
										@endif
									</div>
								</div>
							</div> */ ?>

							@if( $userBiography )
								<div class="col-md-12 col-sm-12">
									<h3>Biography</h3>
									<p class="text-justify">{{ $userBiography }}</p>
								</div>
							@endif

							<div class="col-md-12 col-sm-12">
								<h3>I am Looking For</h3>
								@if(Auth::check())
									<div>{{ $userDetail->type_of_relationship }}</div>
								@endif
							</div>

							<div class="col-md-12 col-sm-12">
								<h3>I Like</h3>
								@if(Auth::check())
								<div>{{ $userDetail->activity }}</div>
								@endif
							</div>

							<div class="col-md-12 col-sm-12">
								<h3>Looking to Date</h3>
								<div>{{ $userDetail->looking_for }}</div>
							</div>

							<div class="col-md-12 col-dm-12">
								<h3>My Cafe Location</h3> 
								@if( $userDetail->UserCafe || $userDetail->id==Auth::user()->id )
										<iframe
										width="100%"
										height="450"
										frameborder="0" style="border:0"
										src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBGO8o4JyybRaVx409C2tNowstVKD42FFU&q={{ urlencode($userDetail->UserCafe->store_name.','.$userDetail->UserCity->city_name.','.$userDetail->UserState->state_name.','.$userDetail->UserCafe->zip_code) }}" allowfullscreen>
										</iframe>
								@elseif( empty($userPaymentDetail) )
									<a href="{{ $memberUrl }}" class="cafe_loc_custom_btn">Membership</a>
								@endif
				            </div>
				        </div>
				    </div>
				</div>
			</div>
		</div>

	</div>

<div class="modal fade" id="sendLetterModal" tabindex="-1" aria-hidden="true">
  	<div class="modal-dialog" role="document">
	    <div class="modal-content">
	      	<div class="modal-header">
		        <h4 id="sendLetterModalLabel">Send Letter 
		        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          	<span aria-hidden="true">&times;</span>
		        	</button>
		        </h4>
	      	</div>
	      	<div class="modal-body">
	      		<p>{{ $loggedinUserBiography }}</p>
	      	</div>
	      	<div class="modal-footer d-flex justify-content-end align-items-center">
	      		<span id="sendMsg" class="text-success mr-15" style="display: none;">Send Letter Successfully.</span>
	      		<span id="send_letter_loader" class="loader mr-10"></span>
	        	<button type="button" id="btn_send_letter" data-id="" class="btn custom-btn-primary">Send</button>
	      	</div>
	    </div>
  	</div>
</div>

<script type="text/javascript">
jQuery(document).on('click', '#send_letter', function(e)
{
	jQuery('#sendMsg').hide();
    var id = jQuery(this).data('id');
    jQuery('#btn_send_letter').data('id', id);

    jQuery('#sendLetterModal').modal('show');
});

jQuery(document).on('click', '#btn_send_letter', function(e)
{
    // e.preventDefault();
    var id = jQuery(this).data('id');
    let _token = $('meta[name="csrf-token"]').attr('content');

    jQuery.ajax({
        url: "<?php echo url('user/send-message'); ?>",
        type: 'POST',
        data: {
            _token: _token,
            id: id,
        },
        cache: false,
        beforeSend: function()
        {
            jQuery("#send_letter_loader").show();
        },
        success: function(response)
        {
        	jQuery('#sendMsg').show();
        	setTimeout(
                function() {
                    jQuery('#sendLetterModal').modal('hide');
                }
                .bind(this)
            , 1000);
        },
        complete:function(data)
        {
            jQuery("#send_letter_loader").hide();
        }
    });
});
</script>

@endsection
