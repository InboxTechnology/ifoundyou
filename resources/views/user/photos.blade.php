@extends('layouts.full_dashboard')

@section('content')
<div class="col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
	<ul class="nav-inner 123">
		<li><a href="{{ url('/user/dashboard') }}">Home</a></li>
		<li class="active"><a href="{{ url('/user/photos') }}">Photos</a></li>
	</ul>

	<div class="account-section">
		<div class="col-md-12">
			<div class="min-content-box">
				<form action="{{ url('/user/photos') }}" method="post" id="change-image-form" class="form-box photots" enctype="multipart/form-data" >
					@csrf
					<div class="profile-box profile-box-1">
						<a class="anchor" id="profile"></a>
						<div class="row text-center">
							<div class="col-md-4 col-md-offset-3">
								<p id="msg"></p>
								<input type="file" id="multiFiles" name="photos[]" multiple="multiple" accept="image/*" onchange="checkfile()">
								<div class="red-span-error" id="image_error">
									<strong>@if ($errors->has('photos')){{ $errors->first('photos') }}@endif</strong>
								</div>
							</div>
							<div class="col-md-2">
								<input type='hidden' name='actg' value='go21'>
								<input class="btn custom-btn acc-submit" id="upload" type="submit" value="Upload" style="font-weight: bold;">
							</div>
							
						</div>
					</div><!-- profile-tab-1 -->
				</form>
			</div>
			<div class="row">
				@foreach($getImages as $image)
				<div class="col-md-4 user-photos">
					<div class="inner-photo-area">
						<div class="image-section">
							 <img class="" src="{{ url('/public/img').'/'.$image->image }}" alt=""/>
						</div>
						 <div class="hover-section" style="display: none;">
							<a title="View" class="example-image-link" href="{{ url('/public/img').'/'.$image->image }}" data-lightbox="example-set" >
								<i class="fa fa-eye"></i>
							</a>
							<a title="Delete" href="javascript:void(0)" class="photodel" rel="tooltip" data-original-title="Delete this photo" onclick="deleteImage({{ $image->id }},'{{ $image->image}}');" data-toggle="modal" data-target="#deleteImage">
								<i class="fa fa-trash"></i>
							</a>

							<div class="select_img">
								<a href="javascript:void(0)" rel="tooltip" data-toggle="modal" class="photoupd" data-target= "#updateImage" onclick= "updateImage('{{ $image->image}}');" title="Set as a Profile Photo">
									<i class="fa fa-camera"></i>
								</a>
							</div>
						</div> 
					</div>
				</div> 
				@endforeach
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div id="updateImage" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<form method="post" action="{{ url('/user/update-image') }}">
				@csrf
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Update Photo</h4>
					<input type="hidden" name="image" id="image" value="">
				</div>
				<div class="modal-body" style="font-size: 16px;">
					<p>Are you sure you want to update your profile photo?</p>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn custom-btn">Yes</button>
					<button type="button" class="btn custom-btn" data-dismiss="modal">No</button>
				</div>
			</form>
		</div>

	</div>
</div>

<!-- Modal -->
<div id="deleteImage" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<form method="post" action="{{ url('/user/delete-image') }}">
				@csrf
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Delete Photo</h4>
					<input type="hidden" name="photoId" id="photoId" value="">
					<input type="hidden" name="image" id="image" value="">

				</div>
				<div class="modal-body" style="font-size: 16px;">
					<p>Are you sure you want to delete this photo?</p>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn custom-btn">Yes</button>
					<button type="button" class="btn custom-btn" data-dismiss="modal">No</button>
				</div>
			</form>
		</div>

	</div>
</div>
<script type="text/javascript">
	function deleteImage(photoId,image) {
		jQuery('#deleteImage #photoId').val(photoId);
		jQuery('#deleteImage #image').val(image);
		console.log(image);
		console.log(photoId);
	}
	function updateImage(image) {
		jQuery('#updateImage #image').val(image);
	}
	function checkfile() {
		var selection = document.getElementById('multiFiles');
		console.log('extselection',selection);
		for (var i=0; i<selection.files.length; i++) {
			var ext = selection.files[i].name.match(/.(jpg|jpeg|png|gif)$/i);
			if(!ext) {
				jQuery('#multiFiles').val('');
				jQuery('#image_error strong').text('Please upload only jpg,jpeg,png file');
			}
			/*if(ext!== "mp4" && ext!== "m4v" && ext!== "fv4")  {
				alert('not an accepted file extension');
				return false;
			}*/
		} 
	}
</script>
	
@endsection
