@extends('layouts.full_dashboard')

@section('content')
<ul class="nav-inner">
	<li><a href="{{ url('/user/dashboard') }}">Home</a></li>
	<li class="active"><a href="{{ url('/user/change-photo') }}">Photo</a></li>
	<li><a href="{{ url('/user/photos') }}">My Photos</a></li>
</ul>

<div class="account-section" id="change-photo">
	<div class="col-md-12">
		<form action="{{ url('/user/change-photo') }}" method="post" id="change-image-form" class="form-box chng-photo" enctype="multipart/form-data" >
			@csrf
			<div class="profile-box profile-box-1">
				<a class="anchor" id="profile"></a>
				<h3>Upload Profile Photo</h3>
				<div class="row">
					<div class="col-sm-3 image-area">
						@if(Auth::user()->image)
							<img src='{{ url('public/img').'/'.Auth::user()->image }}'><br><br>
						@else
							<img src="{{ url('/public/img/profile.png')}}">
						@endif	
					</div>			
					<div class="col-sm-6 col-sm-offset-1">
						<div class="top-section">
							<input type="file" name="image" id="image" class="form-control" placeholder="Upload Profile Image" style="height: unset;">
						</div>
						<div class="btn-area pull-right">
							<input class="btn custom-btn acc-submit" type="submit" value="Upload" id="save-image">
						</div>
						<div class="red-span-error" id="image_error">
							<strong>@if ($errors->has('image')){{ $errors->first('image') }}@endif</strong>
						</div>
					</div>
					
					
				</div>	
			</div><!-- profile-tab-1 -->
		</form>
	</div>
</div>
<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery('#save-image').click(function(e) {
			e.preventDefault();
			var img = jQuery('#image').val();
			if(img == '') {
				jQuery('#image_error strong').text('Please upload image');
			} else if(!img.match(/.(jpg|jpeg|png|gif)$/i)) {
				jQuery('#image').val('');
				jQuery('#image_error strong').text('Please upload only jpg,jpeg,png file');
			} else {
				jQuery('#image_error strong').text('');
				jQuery('#change-image-form').submit();
			}

		});
	});
</script>

@endsection
