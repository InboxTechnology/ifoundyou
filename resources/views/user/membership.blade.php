@extends('layouts.full_dashboard')

@section('content')

<div class="col-md-10 col-md-offset-1 col-sm-12 col-xs-12">

	<ul class="nav-inner">
		<li><a href="{{ url('/') }}">Home</a></li>
		<!-- <li><a href="{{ url('/user/dashboard')}}">Dashboard</a></li> -->
		<li><a href="{{ url('/user/membership') }}" class="active">Membership</a></li>
	</ul>

	<div class="cafe-form col-md-12">
		<div class="wrapper-cl">
			<div class="container-fluid">
				<div class="row">
					<h3>Membership</h3>
				</div>
	        </div>
	    </div>
	</div>

</div>
@endsection