@extends('layouts.app')

@section('content')

<style>
	.nomargin{
		margin: 0px;
	}
	.form-control{
		width:20%;
		position:absolute;
		top:269px;
		left:304px;
	}
</style>


<select id ="cityname" class="form-control" name="cityname">
<option value="">Cities:</option>
@foreach($data as $view)
	<option value="{{$view->id}}">{{$view->city_name}}</option>
@endforeach
</select>






@endsection









