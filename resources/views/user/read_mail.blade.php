@extends('layouts.full_dashboard')

@section('content')

<div class="col-md-12">
    
	<ul class="nav-inner">
		<li><a href="{{ url('/user/dashboard') }}">Home</a></li>
		<li><a href="{{ url('/user/user-profile') }}">My Profile</a></li>
		<li class="active"><a href="javascript:;">Read Mail</a></li>
	</ul>

	<div class="container mt-45">
		<div class="row">
			<div class="col-md-12 px-0">
				@if( !empty($messages) )
					<div class="panel-group messages-panel-group" id="accordionMessages">
						@php $count = 1; @endphp

						@foreach( $messages as $message )
						  	<div class="panel panel-primary">
							    <div class="panel-heading" id="heading{{ $count }}">
							      	<h4 class="d-flex align-items-center" data-toggle="collapse" data-target="#collapse{{ $count }}" aria-expanded="{{ $count==1 ? 'true' : 'false' }}" aria-controls="collapse{{ $count }}">
							      		<a href="{{ url('user/user-profile/'.$message->user_from_id) }}">{{ $message->subject }}</a>
							      		<span class="message_date">{{ $message->updated_at_date }}</span>
							      		<i class="fa fa-right"></i>
							      	</h4>
							    </div>

							    <div id="collapse{{ $count }}" class="collapse {{ $count==1 ? 'in' : '' }}" aria-labelledby="heading{{ $count }}" data-parent="#accordionMessages">
							      	<div class="panel-body">
							        	{{ $message->message }}
							      	</div>
							    </div>
						  	</div>

						  	@php $count++; @endphp
						@endforeach
					</div>
				@else
					<div class="jumbotron jumbotron-fluid">
						<div class="container">
							<p class="lead text-center">Message not found.</p>
						</div>
					</div>
				@endif
			</div>
		</div>
	</div>
</div>

@endsection
