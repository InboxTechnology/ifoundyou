@extends('layouts.full_dashboard')

@section('content')
<style type="text/css">
	.right-userdetails{
		padding-left: 30px !important;
	}
	.nav-inner {
    margin: 0px 17px;
}
</style>

<div class="col-md-10 col-md-offset-1 col-sm-12 col-xs-12">

	<ul class="nav-inner">
		<li><a href="{{ url('/user/dashboard')}}">Home</a></li>
		@if($menu_name == 'Search')
			<li class="active"><a href="{{ url('/user/search-member')}}">Search</a></li>
		@elseif($menu_name == 'Advance Search')
			<li class="active"><a href="{{ url('/user/advance-search')}}">Advance Search</a></li>
		@else
			<li class="active"><a href="">View Profile</a></li>
		@endif
		{{-- <li class=""><a href="{{ url('/user/change-photo')}}">Change Photo</a></li> --}}
	</ul>

	@if(@$next || @$previous)
	<!-- <div class="col-md-12 mrg-btm">
		<div class="pull-right next-prev-btns">
			<?php $a=array("icon-blue-color","icon-black-color","icon-dark-blue-color","icon-light-blue-color");  $icon = $a[array_rand($a)]; ?>
			<a title="prev" href="@if($previous) {{ url('/user/view-profile').'/'.$previous->id }} @endif" class="@if(!$previous)disabled @endif {{ $icon }}"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i></a>
			<a title="next" href="@if($next) {{ url('/user/view-profile').'/'.$next->id }} @endif" class="@if(!$next)disabled @endif {{ $icon }}"><i class="fa fa-chevron-circle-right" aria-hidden="true"></i></a>
		</div>
	</div> -->
	@endif
	<div class="cafe-form col-md-12">
		<div class="wrapper-cl">
			<div class="container-fluid">
				<div class="row mg-topal">
					<div class="col-md-3 col-sm-12 col-xs-12">
						<div class="user-panelleft">
							<span class="online-user"></span>
							<span class="imgs">
								@if($userDetail->image)
								<img src="{{ asset('public/img/').'/'.$userDetail->image }}" class="img-responsive center-block user-image">
								@else 
								<img src="{{ asset('public/img/profile-user.png') }}" class="img-responsive center-block user-image">
								@endif
								{{-- <img src="{{ asset('public/img/profile-user.png') }}" class="img-responsive center-block user-image"> --}}
							</span>
							{{-- @if(Auth::id() == $userDetail->id)<span class="img-top"><a href="{{ url('/user/change-photo') }}"></a>Change Photo</span>@endif --}}
							<h3 class="text-center">{{ title_case($userDetail->name) }}<br><br></h3>
						</div>
					</div>
					<div class="col-md-9 col-sm-12 col-xs-12">
						<div class="right-userdetails">
							<div class="col-md-4 col-sm-12 col-xs-12">
								<h3>Identity</h3>
								<ul>
									<li><span>Name:</span>{{ $userDetail->name }}</li>
									<li><span>Date Of Birth:</span>{{ $userDetail->month.'/'.$userDetail->day.'/'.$userDetail->year }}</li>
									<li><span>I was born in: </span>@if($userDetail->UserState) {{ $userDetail->UserState->nstate }} @endif</li>
									<li><span>Gender:</span>{{ $userDetail->sex }}</li>
									<li><span>Looking to Date:</span>{{ $userDetail->looking_for }}</li>
								</ul>
							</div>
							<div class="col-md-4 col-sm-12 col-xs-12">
								<h3>Looks</h3>
								<ul>
									<li><span>Ethnicity:</span>{{ $userDetail->ethnicity }}</li>
									<li><span>Height:</span>{{ $userDetail->height }}</li>
									<li><span>Hair Color:</span>{{ $userDetail->haircolor }}</li>
									<li><span>Language:</span>{{ $userDetail->language }}</li>
									<li><span>Body Type:</span>{{ $userDetail->bodytype }}</li>
									<li><span>Eye Color:</span>{{ $userDetail->eyecolor }}</li>
									<li><span>Gender:</span>{{ $userDetail->sex }}</li>
									<li><span>Relegion:</span>{{ $userDetail->religion }}</li>
								</ul>
							</div>
							<div class="col-md-4 col-sm-12 col-xs-12">
								<h3>Horoscope</h3>
								<ul>
									<li><span>Chinese Sign:</span>{{ $userDetail->chinese_sign }}</li>
									<li><span>Wester Sign:</span>{{ $userDetail->western_sign }}</li>
									<li><h4 style="font-size: 14px;">{{ 'IFY-'.$userDetail->state.'-'.$userDetail->datepoint.'-'.str_pad($userDetail->id, 4, '0', STR_PAD_LEFT) }}</h4></li>
								</ul>
							</div>
							
							@if(Auth::user()->id == $userDetail->id)
							<div class="col-md-12 col-sm-12 col-xs-12">
								<h3>About my match</h3>
								<div class="col-md-6 col-sm-12 col-xs-12">
									<ul>
										<li><span>Ethnicity:</span>{{ $userDetail->about_ethnicity }}</li>
										<li><span>Height:</span>{{ $userDetail->about_height }}</li>
										<li><span>Hair Color:</span>{{ $userDetail->about_haircolor }}</li>
										<li><span>Language:</span>{{ $userDetail->about_language }}</li>
									</ul>
								</div>
								<div class="col-md-6 col-sm-12 col-xs-12">
									<ul>
										<li><span>Body Type:</span>{{ $userDetail->about_bodytype }}</li>
										<li><span>Eye Color:</span>{{ $userDetail->about_eyecolor }}</li>
										<li><span>Gender:</span>{{ $userDetail->about_gender }}</li>
										<li><span>Relegion:</span>{{ $userDetail->about_religion }}</li>
									</ul>
								</div>
							</div>
							@endif

							<div class="col-md-12 col-sm-12 text-right">
								@if(!Auth::check())
									<a class="btn nptco" href="/join-today">Become A Member</a>
								@endif
								@if(Auth::check())
										<button class="btn nptco" type="submit" data-toggle="modal" data-target="#my_message">Contact Me</button>
									{{-- @if(!$friends)
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
												<div class="confirm-delete">
													<form method="post" action="{{ url('/user/cancel-request') }}">
														@csrf
														<input type="hidden" name="from" value="{{ $userDetail->id }}">
														<input type="hidden" name="to" value="{{ $userDetail->id }}">
														<button class="btn nptco">Remove Friend</button>
														<span class="btn nptco" data-toggle="modal" data-target="#my_message">Send Message</span>
													</form>	
												</div>
										@endif	
									@endif	 --}}
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
								@if($userDetail->UserLoc)
								<iframe
								width="100%"
								height="450"
								frameborder="0" style="border:0"
								src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBGO8o4JyybRaVx409C2tNowstVKD42FFU&q={{ urlencode($userDetail->UserLoc->store_name.','.$userDetail->UserLoc->address_line_1.','.$userDetail->UserLoc->city.','.$userDetail->UserLoc->state.','.$userDetail->UserLoc->zip_code) }}" allowfullscreen>
							</iframe>
							@endif
	                {{-- <iframe width="100%" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBGO8o4JyybRaVx409C2tNowstVKD42FFU&amp;q=Countryside+Mall+-+First+Level%2C27001+US+Hwy+19+N%2CClearwater%2CFL%2C33761-3402" allowfullscreen="">
	                </iframe> --}}
	            </div>
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
	} else {
		jQuery('#subject').next().text('');
	} if(msg == '') {
		jQuery('#msg').next().text('Please enter your message');
	} else {
		jQuery('#msg').next().text('');
	}

	if(sub != '' && msg != '') {
		jQuery('#send-message-form').submit();
	}
});
</script>

@endsection
