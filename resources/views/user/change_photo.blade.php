@extends('layouts.full_dashboard')

@section('content')

<style type="text/css">
		.he{
		padding: 0px !important;
	}
	.nav-inner {
	    margin: 0px 17px;
	}
	.nav-inner li a{
		color: black !important;
	}
	.account-section .profile-box
	{
		min-height:500px;
		padding-top: 30px;
	}
	.nav-tabs {
		border: 0;
	}
	.nav-tabs > li.active > a, .nav-tabs > li.active > a:focus, .nav-tabs > li.active > a:hover {
		border: 0;
	}
	.tab-pane {
		border: 2px solid rgba(61,70,77,0.1);
	}
	.image-area img
	{
		height: auto;
	}
</style>

<div class="col-md-12 col-sm-12 col-xs-12 he">

	<ul class="nav-inner">
		<li><a href="{{ url('/user/dashboard') }}">Home</a></li>
		<li><a href="{{ url('/user/edit-profile-dashboard') }}">Edit Profile</a></li>
		<li class="active"><a href="javascript:;">My Profile Photo</a></li>
	</ul>

	<div class="account-section" id="change-photo">
		<div class="col-md-12">
			<form action="{{ url('/user/change-photo') }}" method="post" id="change-image-form" class="form-box chng-photo" enctype="multipart/form-data" >
				@csrf
				<div class="profile-box profile-box-1">
					<a class="anchor" id="profile"></a>
					<div class="row">
						<div style="margin-bottom:30px" class="col-sm-12 image-area">

							<!-- @if(Auth::user()->image)
								<img src='{{ url('public/img').'/'.Auth::user()->image }}' class="uploaded_image"><br><br>
							@else
								<img class="uploaded_image" src="{{ url('/public/img/profile1.png')}}">
							@endif -->

							<ul class="nav nav-tabs" role="tablist">
								<li  class="nav-item waves-effect waves-light">
									<a class="nav-link active" id="men-tab" data-toggle="tab" href="#men" role="tab" aria-controls="men" aria-selected="true">Men</a>
								</li>
								<li  class="nav-item waves-effect waves-light">
									<a class="nav-link" id="women-tab" data-toggle="tab" href="#women" role="tab" aria-controls="women" aria-selected="true">Women</a>
								</li>
							</ul>

							<div class="tab-content" id="myTabContent">
								<div role="tabpanel" id="men" class="tab-pane fade active in" aria-labelledby="men-tab">
									<div class="row py-10 m-0">
										@forelse( $profileMenImages as $profileImage )
											<div class="col-md-2 profile_image">
												<input type="radio" name="profile_image" value="{{ $profileImage->image_name }}" @if( $profileImage->image_name == Auth::user()->image ) checked @endif >
												<img src="{{ url('public/img/'.$profileImage->image_name) }}" class="uploaded_image">
											</div>
										@empty
											<div class="col-md-3 profile_image">
												<input type="radio" name="profile_image" value="profile1.png">
												<img class="uploaded_image" src="{{ url('/public/img/profile1.png') }}">
											</div>
										@endforelse
									</div>
								</div>

								<div role="tabpanel" id="women" class="tab-pane fade" aria-labelledby="women-tab">
									<div class="row py-10 m-0">
										@forelse( $profileWomenImages as $profileImage )
											<div class="col-md-2 profile_image">
												<input type="radio" name="profile_image" value="{{ $profileImage->image_name }}" @if( $profileImage->image_name == Auth::user()->image ) checked @endif >
												<img src="{{ url('public/img/'.$profileImage->image_name) }}" class="uploaded_image">
											</div>
										@empty
											<div class="col-md-3 profile_image">
												<input type="radio" name="profile_image" value="profile1.png">
												<img class="uploaded_image" src="{{ url('/public/img/profile1.png') }}">
											</div>
										@endforelse
									</div>
								</div>
							</div>

							<div class="loader-image loader" style="display: none;">
								<img src="{{ url('/public/img/lg.ajax-spinner-gif.gif')}}">
							</div>
						</div>

						<div class="col-sm-4 col-sm-offset-4">
							<!-- <div class="top-section">
								<span style="display:none"><input type="file" name="profile_image" id="profile_image" class="form-control" placeholder="Upload Profile Image" style="height: unset;"></span> 
							</div> -->
							<div class="buttonparent">
								<!-- <input style="background-color:#0071e0;" type="button" class="btn btn-primary" onclick="document.getElementById('profile_image').click()" id="btn1" value ="Add Photo"> -->

								<input type="button" name="btnSubmit" id="btnSubmit" class="btn btn-primary" style="background-color:#0071e0;" value="Submit">
							</div> 
							<div class="red-span-error" id="image_error">
								<strong>@if ($errors->has('profile_image')){{ $errors->first('profile_image') }}@endif</strong>
							</div>
							<span id="image_success" class="text-success text-center mt-20" style="display: block;"></span>
						</div>
						
					</div>	
				</div><!-- profile-tab-1 -->
			</form>
		</div>
	</div>

</div>

<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery('#btnSubmit').click(function(e) {
			e.preventDefault();
			var img = jQuery('#profile_image').val();
			/*if( img == '' )
			{
				jQuery('#image_error strong').text('Please upload image');
			}
			else if( !img.match(/.(jpg|jpeg|png|gif)$/i) )
			{
				jQuery('#profile_image').val('');
				jQuery('#image_error strong').text('Please upload only jpg, jpeg, png file');
			} else {*/
				jQuery('#image_error strong').text('');
				jQuery('#change-image-form').submit();
			//}
		});

		jQuery(document).on('change','#profile_image',function()
		{
			var property1 = document.getElementById("profile_image").files[0];
	        var image_name = property1.name;
	        var image_extension = image_name.split(".").pop().toLowerCase();
	        if(jQuery.inArray(image_extension, ['gif','png','jpg','jpeg']) == -1)
	        {
	            alert("Invalid Image File");
	            return false;
	        }  
	        var image_size = property1.size;	
	        if(image_size > 5000000)
	        {
	            alert("Please select file less than 5MB");
	            return false;
	        }
	        else
	        {
	        	// $('.uploaded_image').attr('src','/public/img/'+image_name);
	        }
		});
	});
</script>

@endsection
