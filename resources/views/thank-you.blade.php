@extends('layouts.newuser-edit-profile-dashboard')

@section('content')

<style type="text/css">
	.nh{
		border-top: 1px solid rgba(179,179,179,0.5) !important;
		margin:0px !important;
	}
	.forms-in ul li{
		margin-right: 0px !important;
	}

	.nx{
		text-align: right !important;
    padding-right: 26px !important;
	}

	.tab-pane h4{
		font-size: 18px !important;
		font-family: verdana;
	}

	.gen{
    padding: 12px 48px 97px !important;
	}

	.px{
		float: right;border: 2px solid rgba(61,70,77,0.1) !important;
		padding-top: 34px !important;

	}

	.px h4{
		padding-left: 62px !important;
	}

	.npx{
		float: right;border: 2px solid rgba(61,70,77,0.1) !important;
		padding: 45px !important;

	}

	.npx h4{
		padding-left: 62px !important;
	}

	.n-s{
		padding-top: 20px !important;
	}

	.ro{
	padding-top: 0px !important;
    margin: 0px !important;
    font-family: verdana;
    font-size: 18px !important;
    color: black !important;
    border: none !important;
}

.lii{
	/*float: right !important;*/
    width: 100% !important;
    margin-top: 0px !important;
    text-align: right;
}

.nav-inner li a{
		color: black !important;
	}
	.custom_nav{display: none !important;}
	ul.list-unstyled.list-inline {
    margin: 15px 10px;
    width: 100%;
    display: inline-block;
    border-bottom: 0px;
}
ul.list-custom{position: absolute;right: 0;bottom: 0;width: auto !important;}
.tab-content {
    padding: 0px 5px 20px;
}
.scrtabs-tab-container, .scrtabs-tabs-fixed-container{height: 0;}
.cross{
	position: absolute;
    right: 377px;
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
 	/*margin-top:20px;*/
 	margin-bottom: 60px;
 	padding-bottom: 80px !important;
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
 .edit-profile-tabs{margin-top: 30px;}
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

	.wod{
    	width: 2531px !important; left: -1212.84px !important;
	}

	.fir
	{
    	width: 2531px !important; left: 0px !important;
	}

	input[type="file"]{width: auto;margin-top: 20px;}
	.nav-inner{margin: 0px;}
	.image_error{float: left;width: 100%;text-align: center !important;margin-top: 10px;}
	.uploaded_image{max-height: 200px;}
	.buttonparent{text-align: center !important;margin-top: 20px;}
</style>

<div class="col-md-12 col-sm-12 col-xs-12">
                                 
	<hr class="nh">

	<div class="edit-profile-tabs">
		<div class="col-md-12 npx text-center">
			<p class="thank-you-style text-center">Thank you for created an Account.</p>
			<a href="{{ url('/').'/user/user-match-info' }}" class="btn cafe-submit saveExit">Edit Profile</a>
		</div>
	</div>

</div>

@endsection