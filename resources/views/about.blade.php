@extends('layouts.app')

@section('content')
<div class="page-wrap">
	<div class="hnew-page-wrap">
		<section class="min-content-box">
			<div class="container">
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
			</style>

				<ul class="nav-inner">
    				<li><a href="{{ url('/') }}">Home</a></li>
    				<li class="active"><a href="javascript:;">About Us</a></li>
				</ul>

			<p style="font-weight: normal;
			font-size: 14px;margin-top:20px">{!!$content!!}</p>
    
		</div>
	</section>

</div>


</div>
@endsection
