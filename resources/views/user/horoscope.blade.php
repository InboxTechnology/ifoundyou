@extends('layouts.full_dashboard_user')

@section('content')

<style type="text/css">
	.lo{
		padding-top: 24px !important;
	}
	select::-ms-expand {
    display: none !important;
}

.bot{
	font-size: 17px !important;
}

.n-al{
	padding-left: 0px !important;
    margin-bottom: 67px !important;
}

.n-al li {
	list-style: none !important;
    color: black !important;
}

.n-al li a{
	color: black;
    font-size: 20px;
    font-family: verdana;
}

.lii{
	float: right !important;
    width: auto !important;
    margin-top: 0px !important;
}

.ro{
	padding-top: 0px !important;
    margin: 0px !important;
    font-family: verdana;
    font-size: 18px !important;
    color: black !important;
    border: none !important;
}

.op{
	padding-left: 0px !important
}
.ol2{
	padding: 0px !important;
}

	.npx{
		float: right;border: 2px solid rgba(61,70,77,0.1) !important;
		padding: 82px !important;

	}

	.npx h4{
		padding-left: 62px !important;
	}

	.nav-inner li a{
		color: black !important;
	}

	.npx{
		float: right;border: 2px solid rgba(61,70,77,0.1) !important;
		padding: 82px !important;

	}

	.npx h4{
		padding-left: 62px !important;
	}

	.px{
		float: right;border: 2px solid rgba(61,70,77,0.1) !important;
		padding-top: 34px !important;

	}

	.px h4{
		padding-left: 62px !important;
		font-size: 18px;
    padding-left: 44px !important;
	}

	.gen{
    /*padding: 50px 0px 50px !important;*/
    padding: 12px 48px 20px !important;
	}

.main-content-area{padding-top: 7px;}

ul.list-unstyled.list-inline {
    margin: 0px 10px;
    width: 100%;
    display: inline-block;
    border-bottom: 0px;
}
ul.list-custom{position: absolute;right: 0;bottom: 0;width: auto !important;}
.tab-content {
    padding: 20px 5px;
}

.cross{
	position: absolute;
    right: 445px;
    cursor: pointer;
    font-size: 22px;
    color: #ff000096;
}
.nav-tabs li a {
    border: 1px solid #dedede !important;
    box-shadow: 1px 5px 10px 5px #aaa;
    margin: 2px 10px;
    padding: 8px 15px;
    text-transform: capitalize;
    width: 210px;
    text-align: center;
    }
 .nav-tabs{
 	border-bottom:0px !important;
 }
 .tab-content{
 	/*box-shadow:1px 3px 11px #337ab7;*/
 	padding-bottom: 86px !important;
 	margin-top:10px;
 	margin-bottom: 60px;
 	background-color: #fff;
 	/*border: 2px solid rgba(61,70,77,0.1);*/
 	border-top: 0px;
 	/*background: #80808030;*/
 }
 .edit-profile-tabs .active a{
 	background-color: #337ab7 !important;
    color: white !important;
    box-shadow: 1px 1px 1px 3px #dedede !important;
 }
 .edit-profile-tabs{margin-top: 0px;}
 #selected-locations {
		display: none;
	}
	#selected-locations .text{
		text-decoration: underline;
	}
	#selected-area h3,#new-selected-area h3,.thank-you-style {
		color: #797979;
		font-size: 18px;
	}
    #imageUpload .cropit-preview {
        background-size: cover;
        margin-top: 7px;
        width: 250px;
        height: 250px;
        padding: 0px;
      }

      .image-area.cropit-preview > img {
		    width: 100%;
		    height: 100%;
		    max-height: unset;
		}

      #imageUpload .cropit-preview-image-container {
        cursor: move;
      }

      #imageUpload .image-size-label {
        margin-top: 10px;
      }


      #imageUpload img.cropit-preview-image {
	    width: 100%;
	    height: 100%;
	    transform: none !important;
	    max-height: unset;
	}

	.ri{
		text-align: right !important;
	}
	/* #map_wrapper {
		height: 500px;
	} */
	.list-inline{
		text-align: center;
	}
	#map_canvas {
		width: 100%;
		height: 100%;
	}
	#search-cafe-result li {
		cursor: pointer;
	}
	.location{
		margin-right: 5px !important;
	}
	.cus-colr{
	    color: #2895f1;
	}

	.nl{
		position: inherit !important;
		/*margin-left: 129px !important;*/
	}

	.wod{
		width: 2071px !important;
    	left: -1016.84px !important;
	}
	.fir
	{
		width: 2071px !important;
    	left: 0px !important;
	}
	.cl{
		clear: both;
	}

	.forms-in ul li{
		margin-right: 0px !important;
	}
	input[type="file"]{width: auto;margin-top: 20px;}
	.nav-inner{margin: 0px 2px;}
	.image_error{float: left;width: 100%;text-align: center !important;margin-top: 10px;}
	.uploaded_image{max-height: 200px;}
	.buttonparent{text-align: center !important;margin-top: 20px;}
	.sign-text{
		width: 200px;
		background-color: #eee;
		display: block;
		padding: 5px 10px;
		max-width: 200px;
	}
</style>

<div class="col-md-12 col-sm-12 col-xs-12">

	<ul class="nav-inner">
		<li><a href="{{ url('/user/edit-profile-dashboard') }}">Home</a></li>
		<li class=""><a href="{{ url('/user/edit-profile-dashboard')}}">Edit Profile</a></li>
		<li class="active"><a href="javascript:;">Horoscope</a></li>
	</ul>

	<div class="edit-profile-tabs">
		 
		<!-- Tab panes -->
		<!-- <form method="post" action="{{ url('/user/horoscope_login_update') }}" id="profileForm" enctype="multipart/form-data"> -->
			<div class="tab-content forms-in" id="profile-page">
				{{ csrf_field() }}
			  
				<div role="tabpanel" class="" id="tab2">
					<div class="col-md-12 px"><h4>Horoscope Sign</h4>
					  	<div class="col-md-12 gen" >
							<div class="col-md-12 op">
								<div class="col-md-6 col-sm-6 col-xs-12 ol2">
									<label>Western Sign</label>
									<label class="sign-text">
										{{ $western_sign }}
									</label>

									<!-- <select class="form-control" id ="western" name="western_sign" disabled>
										<option value="">Choose one</option>
										
										<option value="Aries" @if(($western_sign=='Aries')) selected @endif>Aries</option>
										
										<option value="Aquarius" @if(($western_sign=='Aquarius'))selected @endif>Aquarius</option>
										
										<option value="Cancer" @if(($western_sign=='Cancer')) selected @endif>Cancer</option>
										
										<option value="Capricorn" @if(($western_sign=='Capricorn')) selected @endif>Capricorn</option>
										
										<option value="Gemini" @if(($western_sign=='Gemini')) selected @endif>Gemini</option>
										
										<option value="Leo" @if(($western_sign=='Leo')) selected @endif>Leo</option>
										
										<option value="Libra" @if(($western_sign=='Libra')) selected @endif>Libra</option>
										
										<option value="Pisces" @if(($western_sign=='Pisces')) selected @endif>Pisces</option>
										
										<option value="Sagittarius" @if(($western_sign=='Sagittarius')) selected @endif>Sagittarius</option>
										
										<option value="Scorpio" @if(($western_sign=='Scorpio')) selected @endif>Scorpio</option>
										
										<option value="Taurus" @if(($western_sign=='Taurus')) selected @endif>Taurus</option>
										
										<option value="Virgo" @if(($western_sign=='Virgo')) selected @endif>Virgo</option>
									</select> -->
								</div>

								<div class="col-md-6 col-sm-6 col-xs-12">
									<label>Chinese Sign</label>
									<label class="sign-text">
										{{ $chinese_sign }}
									</label>
									
									<!-- <select class="form-control" id="chinese" name="chinese_sign" disabled>
										<option value="">Choose one</option>
										<option value="Dog" @if((Auth::user()->year%12==2)) selected @endif>Dog </option>

										<option value="Dragon" @if((Auth::user()->year%12==8)) selected @endif>Dragon </option>

										<option value="Goat" @if((Auth::user()->year%12==11)) selected @endif>Goat </option>

										<option value="Horse" @if((Auth::user()->year%12==10)) selected @endif>Horse</option>

										<option value="Monkey" @if((Auth::user()->year%12==0)) selected @endif>Monkey</option>

										<option value="Ox" @if((Auth::user()->year%12==5)) selected @endif>Ox</option>

										<option value="Pig" @if((Auth::user()->year%12==3)) selected @endif>Pig</option>

										<option value="Rabbit" @if((Auth::user()->year%12==7)) selected @endif>Rabbit </option>

										<option value="Rat" @if((Auth::user()->year%12==4)) selected @endif>Rat </option>

										<option value="Rooster" @if((Auth::user()->year%12==1)) selected @endif>Rooster </option>

										<option value="Snake" @if((Auth::user()->year%12==9)) selected @endif>Snake</option>

										<option value="Tiger" @if((Auth::user()->year%12==6)) selected @endif>Tiger  </option>
									</select> -->
								</div>
							</div>
						</div>
					</div>
				
					<div class="clearfix"></div>
				</div>
				<!-- <input class="btn custom-btn acc-submit" type="submit" id="save" style="display: none;"> -->
			</div>
		<!-- </form> -->
	</div>
</div>

@endsection