@extends('layouts.app')

@section('content')
<main class="py-4 back">
	<div class="container">

		<div class="row nav-bottom-border">
            <div class="col-md-12 col-sm-12 col-xs-12 px-0 mt-20">
            	<ul class="nav navbar-nav">
				    <li><a href="{{ url('/') }}" class="pl-0">Home</a></li>
				    <li><a href="{{ url('/provinces-list') }}">Provinces List</a></li>
				    <li><a href="{{ url($stateName.'/cities-list') }}">{{ $stateName }}</a></li>
				    <li><a href="{{ url($stateName.'/cities-list') }}">{{ $cityName }}</a></li>
				    <li class="active"><a href="javascript:;">Type of Relationship</a></li>
			  	</ul>
            </div>
        </div>

		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="container-fluid mt-45">
		            <div class="row">
		            	<div class="col-md-4 col-sm-offset-4">
		                	<form method="post" action="{{ url($stateName.'/'.$cityName.'/birthday') }}" >
			                	@csrf
								<div class="form-group cus-form-group states rel">
									<label>Select Type of Relationship</label>
									<select style="width:100%;" class="form-control" name="interested_in" id="interested_in" required>
										<option value="">Choose One</option>
	    								 <option value="I am a man seeking a women" >I am a man seeking a women</option>
	     								<option value="I am a women seeking a man">I am a women seeking a man</option>
	     								<option value="I am a man seeking a man" >I am a man seeking a man</option>
	     								<option value="I am a women seeking a women" >I am a women seeking a women</option>
    								</select>
    								@if( $errors->has('interested_in') )
										<span class="red-span-error text-danget">
											<strong>{{ $errors->first('interested_in') }}</strong>
										</span>
									@endif
								</div>
                               
				 				<div class="form-group text-center" style="margin-top: 24px;">
                                    <ul class="list-unstyled list-inline">
                                        <li><button type="submit" class="btn cafe-submit search">Next</button></li>
                                    </ul>  
                                </div>
                            </form>
                        </div>
		        	</div>
				</div>
			</div>
		</div>
	</div>
</main>

@endsection
