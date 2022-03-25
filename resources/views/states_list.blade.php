@extends('layouts.app')

@section('content')

<main class="py-4 back">
	<div class="container cona con-new">
        
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 nav-bottom-border pb-5">
            </div>
        </div>

		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12 state-nav">
				<div class="container-fluid pd-none">
				    <div class="ct-acct">
				        <div class="modal-login mode">
				            <div class="row form-box ct-form mar">

				                <div class="col-md-12 state">
				                	<h4>Provinces List</h4>
				                    <div class="row">

                                        <div class="col-md-3">
    			                         	@foreach( $states as $key => $value )
                                                @if( $key < 4 )
        			                         		<a  href="{{ url($value->state_name.'/cities-list') }}" value="{{$value->state_code}}" >
        		                         				<span value="{{$value->state_code}}">{{$value->state_name}}</span>
        		                         			</a>
                                                @endif
    			                         	@endforeach
                                        </div>

                                        <div class="col-md-3">
                                            @foreach( $states as $key => $value )
                                                @if( $key > 3 && $key < 8 )
                                                    <a  href="{{ url($value->state_name.'/cities-list') }}" value="{{$value->state_code}}" >
                                                        <span value="{{$value->state_code}}">{{$value->state_name}}</span>
                                                    </a>
                                                @endif
                                            @endforeach
                                        </div>

                                        <div class="col-md-3">
                                            @foreach( $states as $key => $value )
                                                @if( $key > 7 && $key < 12 )
                                                    <a  href="{{ url($value->state_name.'/cities-list') }}" value="{{$value->state_code}}" >
                                                        <span value="{{$value->state_code}}">{{$value->state_name}}</span>
                                                    </a>
                                                @endif
                                            @endforeach
                                        </div>

                                        <div class="col-md-3">
                                            @foreach( $states as $key => $value )
                                                @if( $key > 11 && $key < 16 )
                                                    <a  href="{{ url($value->state_name.'/cities-list') }}" value="{{$value->state_code}}" >
                                                        <span value="{{$value->state_code}}">{{$value->state_name}}</span>
                                                    </a>
                                                @endif
                                            @endforeach
                                        </div>

				                	</div>
				            	</div>
				                <hr>
				        	</div>
				        </div>
				    </div>
				</div>
			</div>
		</div>
	</div>
</main>

@endsection
