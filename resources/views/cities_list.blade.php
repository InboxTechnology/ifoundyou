@extends('layouts.app')

@section('content')
<main class="py-4 back">
	<div class="container">

		<div class="row nav-bottom-border">
            <div class="col-md-12 col-sm-12 col-xs-12 px-0 mt-20">
            	<ul class="nav navbar-nav">
				    <li><a href="{{ url('/') }}" class="pl-0">Home</a></li>
				    <li><a href="{{ url('/provinces-list') }}">Provinces List</a></li>
				    <li class="active"><a href="javascript:;">{{ $stateName }}</a></li>
			  	</ul>
            </div>
        </div>

		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12 hei state-nav">
				<div class="container-fluid pd-none">
				    <div class="ct-acct  vg">
				        <div class="modal-log mode">
				            <div class="row form-box ct-form mar">

			                	<div class="col-md-12 state">
			                    	<h4>{{ $stateName }} Cities</h4>
			                        <div class="row">

			                        	<div class="col-md-2">
						        			@foreach($cities as $key => $value)
						        				@if( $key < 10 )
								        			<a href="{{ url($stateName) }}/{{ $value['city_name'] }}" value="{{ $value['city_name'] }}" >
				                         				<span value="{{ $value['city_name'] }}">{{ $value['city_name'] }}</span>
				                         			</a>
				                         		@endif
						        			@endforeach
						        		</div>

						        		<div class="col-md-2">
						        			@foreach($cities as $key => $value)
						        				@if( $key > 9 && $key < 20 )
								        			<a href="{{ url($stateName) }}/{{$value['city_name'] }}" value="{{ $value['city_name'] }}" >
				                         				<span value="{{ $value['city_name'] }}">{{ $value['city_name'] }}</span>
				                         			</a>
				                         		@endif
						        			@endforeach
						        		</div>

						        		<div class="col-md-2">
						        			@foreach($cities as $key => $value)
						        				@if( $key > 19 && $key < 30 )
								        			<a href="{{ url($stateName) }}/{{$value['city_name'] }}" value="{{ $value['city_name'] }}" >
				                         				<span value="{{ $value['city_name'] }}">{{ $value['city_name'] }}</span>
				                         			</a>
				                         		@endif
						        			@endforeach
						        		</div>

						        		<div class="col-md-2">
						        			@foreach($cities as $key => $value)
						        				@if( $key > 29 && $key < 40 )
								        			<a href="{{ url($stateName) }}/{{$value['city_name'] }}" value="{{ $value['city_name'] }}" >
				                         				<span value="{{ $value['city_name'] }}">{{ $value['city_name'] }}</span>
				                         			</a>
				                         		@endif
						        			@endforeach
						        		</div>

						        		<div class="col-md-2">
						        			@foreach($cities as $key => $value)
						        				@if( $key > 39 && $key < 50 )
								        			<a href="{{ url($stateName) }}/{{$value['city_name'] }}" value="{{ $value['city_name'] }}" >
				                         				<span value="{{ $value['city_name'] }}">{{ $value['city_name'] }}</span>
				                         			</a>
				                         		@endif
						        			@endforeach
						        		</div>

						        		<div class="col-md-2">
						        			@foreach($cities as $key => $value)
						        				@if( $key > 49 && $key < 60 )
								        			<a href="{{ url($stateName) }}/{{$value['city_name'] }}" value="{{ $value['city_name'] }}" >
				                         				<span value="{{ $value['city_name'] }}">{{ $value['city_name'] }}</span>
				                         			</a>
				                         		@endif
						        			@endforeach
						        		</div>

						        	</div>

			                	</div>
				        	</div>
				        </div>
				    </div>
				</div>
			</div>
		</div>
	</div>
</main>

@endsection
