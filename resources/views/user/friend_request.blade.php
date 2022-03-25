@extends('layouts.full_dashboard')

@section('content')

<div class="row">
	<div class="col-md-9">
		<div>&nbsp;</div>
		<div class="acc-table">
			<table class="table">
				<thead>
					<tr>
						<th style="text-align:center">Name</th>
						<th style="text-align:center">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($friends as $user)
					<tr>
						<td style="text-align:center">
							<a href="{{ url('/user/view-profile').'/'.$user->friendsDetail->id }}">
								@if($user->friendsDetail->image)
								<img src="{{ url('/public/img/').'/'.$user->friendsDetail->image }}" alt="" class="limpro" style="width: 75px;height: 75px;"/>
								@else
								<img src="{{ url('/public/img/profile.png') }}" alt="" class="limpro" style="width: 75px;height: 75px;"/>
								@endif
								<div style="text-align:center">{{ $user->friendsDetail->name }}</div>
							</a>
						</td>
						<td style="text-align:center">
							<div class="confirm-delete">
								<form method="post" action="{{ url('/user/confirm-request') }}">
									@csrf
									<input type="hidden" name="from" value="{{ $user->friendsDetail->id }}">
									<button class="btn nptco">Confirm</button>
								</form>	
								<form method="post" action="{{ url('/user/cancel-request') }}">
									@csrf
									<input type="hidden" name="from" value="{{ $user->friendsDetail->id }}">
									<button class="btn nptco">Delete</button>
								</form>	
							</div>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div><!-- acc-table -->
	</div><!-- col -->
</div><!-- row -->
@endsection
