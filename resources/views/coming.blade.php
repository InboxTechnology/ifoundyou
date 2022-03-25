@extends('layouts.app')

@section('content')

<script type="text/javascript">
	jQuery(document).ready(function(){
		$('#countryname').change(function() {

  			if( $(this).val() == 'Europe' )
  			{
  				$.ajax( {
  					url: './showcountries',
  					method: 'GET',
  					success: function(showcountries){
  						if(showcountries){
  							$('#showcountry').show();
  							$('#showcountry').html(showcountries);
  						}
  					}
  				})
  			}else{
  				localStorage.removeItem('country_name');
  				localStorage.removeItem('continent');
  				window.location = 'home';
  			}
		});
	});

</script>

<script type="text/javascript">
	jQuery(document).ready(function(){
		$('#showcountry').change(function(){

			var value = $(this).val();
			if( value != '' ){
				
				localStorage.setItem('country_name',value);
				
			}
			window.location = 'home';
		})
	})

</script>

<script type="text/javascript">
	jQuery(document).ready(function(){
		$('#countryname').change(function(){
			var value = $(this).val();
			if(value != '')
			{
				localStorage.setItem('continent',value);
			}
		})
	})
</script>


<style>
	.nomargin{
		margin: 0px;
	}
	.country{
		position:absolute;
		top:40%;
		right:15%;
	}
	.def{
		margin: 15px 0px;
		display: none;
	}
</style>

<div style="height:100%" class="inverse-container">
	<img style="width:100%;" src="public/img/bg-img.jpg">	
</div>

<div class="country">
	<select id="countryname" class="form-control" name="countryname">
		<option value="">Choose a country to find a match:</option>
		@foreach($data as $view)
			<option value="{{$view->country_name}}">{{$view->country_name}}</option>
		@endforeach
	</select>
	<select id="showcountry" class="form-control def" name="showcountry">
	</select>
</div>



@endsection

	

