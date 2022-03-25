@extends('layouts.full_dashboard_wlogin')


@section('content')
<ul class="nav-inner">
	<li><a href="{{ url('/find-match')}}">Home</a></li>

	@if(Auth::id() != $userDetail->id)
		<li class="active"><a href="{{ url('/user-profile').'/'.$userDetail->id }}">User Profile</a></li>
	@else
		<li class="active"><a href="{{ url('/user/user-profile')}}">My Profile</a></li>
	@endif

	<!-- @if(Auth::id() == $userDetail->id)
		<li class=""><a href="{{ url('/user/change-photo')}}">Change Photo</a></li>
	@endif -->
</ul>
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
</style>
@if(@$next || @$previous)
<div class="col-md-12 mrg-btm">

	<div class="pull-right next-prev-btns">
		<?php $a=array("icon-blue-color","icon-black-color","icon-dark-blue-color","icon-light-blue-color");  $icon = $a[array_rand($a)]; ?>
		<a title="prev" href="@if($previous) {{ url('/user/view-profile').'/'.$previous->id }} @endif" class="@if(!$previous)disabled @endif {{ $icon }}"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i></a>
		<a title="next" href="@if($next) {{ url('/user/view-profile').'/'.$next->id }} @endif" class="@if(!$next)disabled @endif {{ $icon }}"><i class="fa fa-chevron-circle-right" aria-hidden="true"></i></a>
	</div>

</div>
@endif

<?php 

  $paymentUser = DB::table('payments')->where('user_id',Auth::user()->id)->get();
  $paymentUser = json_decode(json_encode($paymentUser),true);


 ?>
<div class="cafe-form col-md-12">
	<div class="wrapper-cl">
		<div class="container-fluid">
			<div class="row mg-topal">
				<div class="col-md-3 col-sm-12 col-xs-12">
					<div class="user-panelleft">
						<?php
							
							$result = "";
							if($userDetail->datepoint<10)
							{
								$result = "0";
							}

						?>
						<span class="online-user"></span>
						<span class="imgs">
							@if(!empty($paymentUser))
								@if($userDetail->image)
								<a href="/user/change-photo"><img src="{{ asset('public/img/').'/'.$userDetail->image }}" class="img-responsive center-block user-image"></a>
								@else 
								<img src="{{ asset('public/img/profile-user.png') }}" class="img-responsive center-block user-image">
								@endif
							@else
						  		<img class="image-message img-responsive center-block user-image" src="{{ asset('public/img/profile-user.png') }}" data-toggle="popover" title="Please do payment first" data-placement="left">
						  	@endif

							{{-- <img src="{{ asset('public/img/profile-user.png') }}" class="img-responsive center-block user-image"> --}}
						</span>
						{{-- @if(Auth::id() == $userDetail->id)<span class="img-top"><a href="{{ url('/user/change-photo') }}"></a>Change Photo</span>@endif --}}
						<h3 class="text-center">{{ title_case($userDetail->name) }}<br><br></h3>

						<div style="margin-top:-29px;text-align:center">
							<span style="font-weight:bold;color:#51656a;font-size: 14px;"> ID #:</span> <span style="color: #51656a;font-family:font-size: 14px;">{{ 'IFY-'.substr_replace($userDetail->year,"0",-4,2).'-'.$result.$userDetail->datepoint.'-'.str_pad($userDetail->id, 4, '0', STR_PAD_LEFT) }}</span>
						</div>
					</div>
				</div>
				<div class="col-md-9 col-sm-12 col-xs-12">
					<div class="right-userdetails">
						<div class="col-md-4 col-sm-12 col-xs-12">
							<h3>Identity</h3>
							<ul>
								<li><span>Name:</span><p>{{ $userDetail->name }}</p></li>
								<li><span>Date Of Birth:</span><p>{{ $userDetail->month.'/'.$userDetail->day.'/'.$userDetail->year }}</p></li>
								<li><span>I was born in: </span><p>@if($userDetail->UserState) {{ $userDetail->UserState->nstate }} @endif</p></li>
								<li><span>Gender:</span><p>{{ $userDetail->sex }}</p></li>
								<li><span>Looking to Date:</span><p>{{ $userDetail->looking_for }}</p></li>
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
								<!-- <li><span>Gender:</span><p>{{ $userDetail->sex }}</p></li>
								<li><span>Religion:</span><p>{{ $userDetail->religion }}</p></li> -->
							</ul>
						</div>
						<div class="col-md-4 col-sm-12 col-xs-12">
							<!-- <?php

								$result = "";

								if($userDetail->datepoint<10)
								{
									$result = "0";
								}

							?> -->
							<h3>Horoscope</h3>
							<ul>
								<li><span>Chinese Sign:</span><p>{{ $userDetail->chinese_sign }}</p></li>
								<li><span>Wester Sign:</span><p>{{ $userDetail->western_sign }}</p></li>
								<li><span>Gender:</span><p>{{ $userDetail->sex }}</p></li>
								<li><span>Religion:</span><p>{{ $userDetail->religion }}</p></li>
								<!-- <li><span> ID #:</span><p>{{ 'IFY-'.substr_replace($userDetail->year,"0",-4,2).'-'.$result.$userDetail->datepoint.'-'.str_pad($userDetail->id, 4, '0', STR_PAD_LEFT) }}</p></li> -->
							</ul>
						</div>	
						
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

						<div class="col-md-12 col-sm-12 text-right">
							@if(!Auth::check())
								<a class="btn nptco" href="/join-today">Become A Member</a>
							@endif
							@if(Auth::check())

								@if(Auth::id() != $userDetail->id)
									@if($paymentUser)
								 		<button class="btn nptco" type="submit" data-toggle="modal" data-target="#my_message">Contact Me</button>
								 	@else
										<a class="btn nptco return_url_btn" href="{{ url('/') }}/join-today/{{ $userDetail->id }}" returnurl = "{{ url('/') }}/user/user-profile/{{ $userDetail->id }}">Contact Me</button></a>
									@endif
								@endif
							

								<!-- @if(!$friends)
									@if(Auth::id() != $userDetail->id)
									<form method="post" action="{{ url('/user/add-friend') }}">
										@csrf
										<input type="hidden" name="to" value="{{ $userDetail->id }}">
										<button class="btn nptco" type="submit">Add Friend</button>
									</form>
									@endif
								@else 
									@if($friends->status == 0)
										@if($friends->from == Auth::id())
											<form method="post" action="{{ url('/user/cancel-request') }}">
												@csrf
												<span class="btn nptco">Request Pending</span>
												<input type="hidden" name="to" value="{{ $userDetail->id }}">
												<button class="btn nptco">Cancel</button>
											</form>	
										@else 
											<div class="confirm-delete">
												<form method="post" action="{{ url('/user/confirm-request') }}">
													@csrf
													<input type="hidden" name="from" value="{{ $userDetail->id }}">
													<button class="btn nptco">Confirm</button>
												</form>	
												<form method="post" action="{{ url('/user/cancel-request') }}">
													@csrf
													<input type="hidden" name="from" value="{{ $userDetail->id }}">
													<button class="btn nptco">Delete</button>
												</form>	
											</div>
										@endif
									@else 
										{{-- @if(Auth::id() != $userDetail->id) --}}
											<div class="confirm-delete">
												<form method="post" action="{{ url('/user/cancel-request') }}">
													@csrf
													<input type="hidden" name="from" value="{{ $userDetail->id }}">
													<input type="hidden" name="to" value="{{ $userDetail->id }}">
														<button class="btn nptco">Remove Friend</button>
													<span class="btn nptco" data-toggle="modal" data-target="#my_message">Send Message</span>
												</form>	
											</div>
										{{-- @endif --}}
									@endif	
								@endif -->
							@endif 
						</div>
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
						<div class="col-md-12 col-dm-12">
							<h3>My Cafe Location</h3> 
							@if(!empty($paymentUser))
								@if($userDetail->UserLoc)
									<iframe
									width="100%"
									height="450"
									frameborder="0" style="border:0"
									src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBGO8o4JyybRaVx409C2tNowstVKD42FFU&q={{ urlencode($userDetail->UserLoc->store_name.','.$userDetail->UserLoc->city.','.$userDetail->UserLoc->state.','.$userDetail->UserLoc->zip_code) }}" allowfullscreen>
									</iframe>
								@endif
							@else
								<h4>Please do payment first</h4>
							@endif
                {{-- <iframe width="100%" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBGO8o4JyybRaVx409C2tNowstVKD42FFU&amp;q=Countryside+Mall+-+First+Level%2C27001+US+Hwy+19+N%2CClearwater%2CFL%2C33761-3402" allowfullscreen="">
                </iframe> --}}
            </div>
        </div>
    </div>
</div>
</div>
</div>
<!-- show a message model-->
<div class="modal fade" id="my_message" role="dialog">
	<div class="modal-dialog">    
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Send Message</h4>
			</div>
			<div class="modal-body">
				<form action="{{ url('/user/send-message') }}" method="post" id="send-message-form" class="form-box">
					@csrf
					<div class="profile-box profile-box-1">				
						<div class="row">
							<div class="col-sm-12">
								<input type="hidden" value="{{ $userDetail->id }}" name="to">
								<input type="text" name="subject" id="subject" placeholder="Subject">
								<span class="blue-span"></span>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-12">
								<textarea name="message" placeholder="Type Your Message" rows="6" style="margin-bottom:0;" id="msg"></textarea>
								<span class="blue-span"></span>
							</div>
						</div>		

						<div class="row">
							<div class="col-sm-12 text-center">
								<input class="btn custom-btn acc-submit" type="submit" value="Submit" id="send-message">
							</div>
						</div>		
					</div><!-- profile-tab-1 -->
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
<script type="text/javascript">
jQuery('body').on('click','#send-message',function(e) {
	e.preventDefault();
	var sub = jQuery('#my_message #subject').val();
	var msg = jQuery('#my_message #msg').val();
	if(sub == '') {
		jQuery('#subject').next().text('Please enter a subject');
	} else if(msg == '') {
		jQuery('#msg').next().text('Please enter your message');
	} else {
		jQuery('#send-message-form').submit();
	}
});


$(function () {
  // $('.popover-example').popover({
  //   trigger: 'hover'
  // });
   $('.image-message').tooltip();
});

</script>

@endsection
