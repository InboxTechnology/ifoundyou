@extends('layouts.full_dashboard')

@section('content')

<div class="col-md-12 col-sm-12 col-xs-12 he">
    
	<ul class="nav-inner">
		<li><a href="{{ url('/user/dashboard') }}">Home</a></li>
		<li><a href="{{ url('/user/user-profile') }}">My Profile</a></li>
		<li class="active"><a href="javascript:;">Contact Member</a></li>
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

							$ID_Number = 'IFY-'.substr_replace($userDetail->year,"0",-4,2).'-'.$result.$userDetail->datepoint.'-'.str_pad($userDetail->id, 4, '0', STR_PAD_LEFT);
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

							<div style="margin-top:30px;text-align:center">
								<span style="font-weight:bold;color:#51656a;font-size: 14px;"> ID #:</span> <span style="color: #51656a;font-family:font-size: 14px;">{{ $ID_Number }}</span>
							</div>
						</div>
					</div>
					<div class="col-md-9 col-sm-12 col-xs-12">
						<div class="contact-member-right">

							@if( Session::has('messageType') )
							    <div class="row mb-20">
							    	<div class="col-md-12">
								        <div class="alert @if( Session::get('messageType' ) == 'success') alert-success @elseif( Session::get('messageType' ) == 'info') alert-info @else alert-danger @endif">
								            {{ Session::get('message') }}
								        </div>
							    	</div>
							    </div>
							@endif

							<form id="frmContactMember" method="post" action="{{ url('/user/contact-member') }}" enctype="multipart/form-data">
								{{ csrf_field() }}

								<div class="row">
									<div class="col-md-12 from-group">
										<input type="text" name="ify_id" id="ify_id" class="form-control" placeholder="ID Number" value="{{ $ID_Number }}" required>
									</div>

									<div class="col-md-12 from-group">
										<label>Message</label>
										<textarea class="form-control form-control-textarea" id="description" name="description" required></textarea>
									</div>

									<div class="col-md-12 from-group text-right">
										<input type="submit" name="btnSend" id="btnSend" value="Send" class="btn custom-btn acc-submit">
									</div>
								</div>
							</form>
						</div>
				    </div>
				</div>
			</div>
		</div>

	</div>

@endsection
