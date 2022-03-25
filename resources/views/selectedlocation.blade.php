@extends('layouts.app')

@section('content')

<style>
	.nomargin{
		margin: 0px;
	}
	.abc{
		width:20%;
		position:absolute;
		top:119px;
		left:304px;
	}
	.form-control
	{
		width:20%;
	}
</style>

<select id ="selectedloc" class="abc form-control" name="selectedloc">
<option value="">selectedloc:</option>
@foreach($data as $view)
	<option value="{{$view->id}}">{{$view->location}}</option>
@endforeach
</select>




					
@endsection









