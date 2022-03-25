@extends('layouts.admin_dashboard')

@section('content')
<style>
	/*.panel-default
	{
		width:300px;
    	margin-left:198px;
	}*/
</style>

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">Membership</div>
                <div class="panel-body">
					<form method="POST">
						{{ csrf_field() }}

						<div class="form-group">
							<label>Membership Fees</label>
							<input type="text" class="form-control" value="{{ $data->membership_fees }}" id="amount" name="amount" placeholder="Enter Amount">
						</div>

						<div class="form-group">
							<label>Membership Status</label>
							<div class="form-check">
					        	<input class="form-check-input" type="radio" name="membership_status" id="membership_status_enable" value="Enable" @if( $data->membership_status == 'Enable' ) {{ 'checked' }} @endif required>
					          	<label class="form-check-label" for="membership_status_enable"> Enable
					          </label>
					        </div>
					        <div class="form-check">
					        	<input class="form-check-input" type="radio" name="membership_status" id="membership_status_disable" value="Disable" @if( $data->membership_status == 'Disable' ) {{ 'checked' }} @endif>
					          	<label class="form-check-label" for="membership_status_disable" required> Disable
					          </label>
					        </div>
						</div>

						<button type="submit" class="btn btn-default">Submit</button>&nbsp&nbsp

						<a href="/admin/dashboard" class="btn btn-default">Close</a>
					</form>
				</div>
  			</div>
  		</div>
  	</div>
</div>

@endsection