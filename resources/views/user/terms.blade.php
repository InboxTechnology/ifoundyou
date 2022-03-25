@extends('layouts.full_dashboard')

@section('content')

<style type="text/css">
	.he{
		padding: 0px !important;
	}
	.nav-inner{margin: 0px 2px !important;}
	.nav-inner li a{
		color: black !important;
	}
</style>
<div class="page-wrap">
	<div class="hnew-page-wrap">
		<section class="min-content-box">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<style>
				.breadcrumbs {
					padding-bottom: 10px;
					border-bottom: 3px solid #f7f9fa;
					width: 75%;
					font-size:14px;
				}

				.text-left {
					text-align: left;
					font-size:14px;
				}
				.nav-inner{margin: 0px;}
			</style>

			<!-- <div class="breadcrumbs text-left">
				<a href="{{ url('/') }}" style="font-size:14px;">Home</a>
			<span style="margin-left: 20px;">Terms of Service</span></div> -->
			<ul class="nav-inner">
				<li><a href="{{ url('user/dashboard') }}">Home</a></li>
    			<li class="active"><a href="javascript:;">Terms of Service</a></li>
			</ul>

			<p style="font-weight: normal;
			font-size: 14px;margin-top:20px">{!!$content!!}</p>
		</div>
	</section>

</div>


</div>
@endsection
