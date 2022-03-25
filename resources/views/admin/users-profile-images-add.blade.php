@extends('layouts.admin_dashboard')

@section('content')
<style>
	.max-height-150 {
        max-height: 150px;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Add User Image</div>
                <div class="panel-body">
					<form method="POST" enctype="multipart/form-data">
						{{ csrf_field() }}

						<div class="form-group">
							<label class="mr-10">Gender</label>
							<div class="radio-inline">
					        	<input class="form-check-input" type="radio" name="image_gender" id="image_gender_men" value="Men" required <?php echo ( isset($usersProfileImage->image_gender) && $usersProfileImage->image_gender=='Men' ) ? 'checked' : ''; ?>>
					          	<label class="form-check-label" for="image_gender_men"> Men
					          </label>
					        </div>
					        <div class="radio-inline">
					        	<input class="form-check-input" type="radio" name="image_gender" id="image_gender_women" value="Women" <?php echo ( isset($usersProfileImage->image_gender) && $usersProfileImage->image_gender=='Women' ) ? 'checked' : ''; ?>>
					          	<label class="form-check-label" for="image_gender_women" required> Women
					          </label>
					        </div>
						</div>

						<div class="form-group">
							<label>Image</label>
							<input type="file" class="form-control" value="" id="image_name" name="image_name" placeholder="User Image" <?php echo empty($usersProfileImage->image_name) ? 'required' : ''; ?> accept="image/*">
							@if( !empty($usersProfileImage->image_name) )
								<img src="{{ asset('public/img/').'/'.$usersProfileImage->image_name }}" class="img-thumbnail img-rounded max-height-150" style="margin-top: 10px;">
								<input type="hidden" name="old_image_name" value="{{ $usersProfileImage->image_name }}">
							@endif
						</div>

						<!-- <div class="form-group">
							<label>Image Status</label>
							<div class="radio-inline">
					        	<input class="form-check-input" type="radio" name="image_status" id="image_status_activate" value="Activate" checked required>
					          	<label class="form-check-label" for="image_status_activate"> Activate
					          </label>
					        </div>
					        <div class="radio-inline">
					        	<input class="form-check-input" type="radio" name="image_status" id="image_status_deactivate" value="Deactivate">
					          	<label class="form-check-label" for="image_status_deactivate" required> Deactivate
					          </label>
					        </div>
						</div> -->

						<span class="d-flex" style="justify-content: space-between">
							<input type="hidden" name="id" id="id" value="@if( !empty($usersProfileImage->id) ) {{ $usersProfileImage->id }} @endif">
							<button type="submit" class="btn btn-primary">Submit</button>&nbsp&nbsp
							<a href="{{ route('admin.usersprofileimage') }}" class="btn btn-info">Back</a>
						</span>
					</form>
				</div>
  			</div>
  		</div>
  	</div>
</div>

@endsection