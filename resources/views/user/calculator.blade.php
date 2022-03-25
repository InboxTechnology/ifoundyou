@extends('layouts.full_dashboard')

@section('content')
<style type="text/css">
	.main-div{
		width: 100%;
		display: inline-block;
	}
	.main-div h1{
		color: #3F6FD6;
	}
	.birth-title{
		padding: 10px;
		padding-left: 0px;
		/*text-align: right;*/
	}
	.number-cal{
		/*background-color: rgba(0, 167, 249, 0.1);*/
		background-color: #fff;
		padding: 2%;
		margin-top: 20px;
		
	}
	
	.number-cal div{
		font-size: 20px;
    	margin: 10px 0px;
	}
	span{
		font-size: 20px;
	}
	.number{
		font-size: 24px;
	    display: inline-block;
	    width: 100%;
	    margin: 10px auto;
	}
	.cus-select select
	{
		-webkit-appearance: button;
	    -moz-appearance: button;
	    -webkit-user-select: none;
	    -moz-user-select: none;
	    -webkit-padding-end: 20px;
	    -moz-padding-end: 20px;
	    -webkit-padding-start: 2px;
	    -moz-padding-start: 2px;
	    background-color: transparent; /* fallback color if gradients are not supported */
	    background-image: url('/public/img/arrow.png'); /* For Chrome and Safari */
	    background-image: url('/public/img/arrow.png'); /* For old Fx (3.6 to 15) */
	    background-image: url('/public/img/arrow.png'); /* For pre-releases of IE 10*/
	    background-image: url('/public/img/arrow.png'); /* For old Opera (11.1 to 12.0) */ 
	    background-image: url('/public/img/arrow.png'); /* Standard syntax; must be last */
	    background-position: 97% center;
	    background-size: 10px;
	    background-repeat: no-repeat;
	    box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.1);
	    margin: 0;
	    overflow: hidden;
	    text-overflow: ellipsis;
	    white-space: nowrap;
	}

	.he{
		padding: 0px !important;
	}
	.nav-inner{margin: 0px 17px;}
	.nav-inner li a{
		color: black !important;
	}
</style>

<div class="col-md-12 col-sm-12 col-xs-12 he">

	<ul class="nav-inner">
		<li><a href="{{ url('/user/login_match_info') }}">Home</a></li>
		<!-- <li><a href="{{ url('/user/dashboard')}}">Dashboard</a></li> -->
		<!-- <li class="active"><a href="{{ url('/user/numerology')}}">Numerology</a></li> -->
		<li class="active"><a href="javascript:;">Numerology</a></li>
	</ul>

	<div class="cafe-form main-div">
			<div class="col-md-8 dob cus-select col-md-offset-2">
				<div class="text-center number"></div>
				<div class="col-md-4 birth-title">
					<span>Enter your birth date:</span>
				</div>
				<div class="col-md-2 col-sm-3 col-xs-12">
					<select class="form-control day" name="day">
						@for($day = 1; $day <= 31; $day++)
						<option @if(Auth::user()->day == $day) selected @endif>{{ $day }}</option>
						@endfor
					</select>
				</div>
				<div class="col-md-3 col-sm-4 col-xs-12">
					<select class="form-control month" name="month">
						<option value="1" @if(Auth::user()->month == 1) selected @endif>January</option>
						<option value="2" @if(Auth::user()->month == 2) selected @endif>February</option>
						<option value="3" @if(Auth::user()->month == 3) selected @endif>March</option>
						<option value="4" @if(Auth::user()->month == 4) selected @endif>April</option>
						<option value="5" @if(Auth::user()->month == 5) selected @endif>May</option>
						<option value="6" @if(Auth::user()->month == 6) selected @endif>June</option>
						<option value="7" @if(Auth::user()->month == 7) selected @endif>July</option>
						<option value="8" @if(Auth::user()->month == 8) selected @endif>August</option>
						<option value="9" @if(Auth::user()->month == 9) selected @endif>September</option>
						<option value="10" @if(Auth::user()->month == 10) selected @endif>October</option>
						<option value="11" @if(Auth::user()->month == 11) selected @endif>November</option>
						<option value="12" @if(Auth::user()->month == 12) selected @endif>December</option>
					</select>
				</div>
				<div class="col-md-3 col-sm-4 col-xs-12">
					<select class="form-control year" name="year">
						<?php //$curr_year = Carbon\Carbon::now()->format('Y'); ?>
						@for($year = 1920; $year <= 2030; $year++)
						<option @if(Auth::user()->year == $year) selected @endif>{{ $year }}</option>
						@endfor
					</select>
				</div>
			</div>
			<div class="col-md-8 col-md-offset-2">
				<div class="number-cal">
					<h3>Your Numbers</h3>
					<div class="show_day" attr="{{Auth::user()->day}}"></div>
					<div class="show_month" attr="{{Auth::user()->month}}"></div>
					<div class="show_year" attr="{{Auth::user()->year}}"></div>
					<div class="lpn"></div>
				</div>	
			</div>
	</div>

</div>
<script type="text/javascript">
	$(document).ready(function(){
		day = {{Auth::user()->day}};
		month = {{Auth::user()->month}};
		year = {{Auth::user()->year}};
		rec(day.toString(),'','show_day');
		rec(month.toString(),'','show_month');
		rec(year.toString(),'','show_year');
		//var lpn = $('.show_day').attr('attr') + $('.show_month').attr('attr') + $('.show_year').attr('attr');
		calLpnNumber();
	});
	$('.day').change(function(){
		var day =$(this).val();
		var month = $('.month').val();
		var year = $('.year').val();
		rec(day,'','show_day');
		rec(month,'','show_month');
		rec(year,'','show_year');
		var lpn = $('.show_day').attr('attr') + $('.show_month').attr('attr') + $('.show_year').attr('attr');
		calLpnNumber(lpn,'','lpn');
	});
	$('.month').change(function(){
		var month = $(this).val();
		var day =$('.day').val();
		var year = $('.year').val();
		rec(day,'','show_day');
		rec(month,'','show_month');
		rec(year,'','show_year');
		var lpn = $('.show_day').attr('attr') + $('.show_month').attr('attr') + $('.show_year').attr('attr');
		calLpnNumber(lpn,'','lpn');
		
	});
	$('.year').change(function(){
		var year = $(this).val();
		var day =$('.day').val();
		var month = $('.month').val();
		rec(day,'','show_day');
		rec(month,'','show_month');
		rec(year,'','show_year');
		var lpn = $('.show_day').attr('attr') + $('.show_month').attr('attr') + $('.show_year').attr('attr');
		calLpnNumber(lpn,'','lpn');
		
	});
	
	function getSum(total,num){
		return parseInt(total) + parseInt(num);

	}

	function rec(num,str,digi_class){
		if(str==''){
			str = "<span>"+num+"</span> = ";
		}
		// if(num!=11 && num!=22){

		 if(num){

			day_num = num.split('');
			var array_num = new Array();
			array_num = day_num;
			if(array_num.length>1){
				str+=array_num.join(' + ');
				str+=" = ";
			}
			sum = day_num.reduce(getSum);
			str+=sum;
			$('.'+digi_class).html(str);
			$('.'+digi_class).attr('attr',sum);
			if(digi_class=="lpn"){
				$('.number').html(sum);
			}
			if(sum>=10 ){
				str+=" and ";
				rec(sum.toString(),str,digi_class);
			}
			
			var n = str.search("Life");
			if( n > 0 )
			{
				//console.log(str);
				var sliceStr = str.slice(0, 47);
				// console.log(sliceStr);
				var finalNum = sliceStr.split("= ").pop();
				// console.log(tabId);
				$('.number').html(finalNum);
				$('.lpn').html(sliceStr);
			}
			
		}else{
			str+=num;
			$('.'+digi_class).attr('attr',num);
			$('.'+digi_class).html(str);
			if(digi_class=="lpn"){
				$('.number').html(num);
			}
		}
	}
	function calLpnNumber(){
		var str = "<span>Life Path Number</span> = "+$('.show_day').attr('attr') +' + '+ $('.show_month').attr('attr') +' + '+ $('.show_year').attr('attr')+" = ";
		var sum = parseInt($('.show_day').attr('attr')) + parseInt($('.show_month').attr('attr')) + parseInt($('.show_year').attr('attr'));


		if(sum>=10 )str+=sum+" and ";

		rec(sum.toString(),str,'lpn');
	}
</script>
@endsection
