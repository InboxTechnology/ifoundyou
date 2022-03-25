@extends('layouts.app')

@section('content')

<style>
	.nomargin{
		margin: 0px;
	}
	.abc{
		width:20%;
		position:absolute;
		top:269px;
		left:304px;
	}
	.form-control
	{
		width:20%;
	}
</style>

<select id="locationname" class="abc form-control" name="locationname">
<option value="">Locations:</option>
@foreach($data as $view)
	<option value="{{$view->city}}">{{$view->location}}</option>
@endforeach
</select>


@endsection

