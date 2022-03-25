@extends('layouts.app')

@section('content')
<link href="{{ asset('public/css/jquery.scrolling-tabs.css') }}" rel="stylesheet">
<div class="container ">
	<div class="heading-tabs">
		<ul class="nav-inner">
			<li><a href="{{ url('/user/dashboard')}}">Home</a></li>
			<li class="active"><a href="{{ url('/user/edit-user-profile')}}">Match</a></li>
		</ul>
	</div>
	<div class="match-tabs">
		<!-- Nav tabs -->
		<ul class="nav nav-tabs" role="tablist">
		  
		  <li role="presentation" class="active"><a href="#tab2" role="tab" data-toggle="tab">About My Match</a></li>
		</ul>
		 
		<!-- Tab panes -->
		<form method="post" action="{{ url('/get-matching-result') }}" >
			<div class="tab-content forms-in">
				{{csrf_field()}}
				<div role="tabpanel" class="tab-pane active" id="tab2">
					<h4>About My Match</h4>
					<div class="col-md-5 col-sm-6 col-xs-12" id="about_match">
						<label>Gender</label>
						<select class="form-control" name="about_gender">
							<!-- <option value="">Choose One</option> -->
							<option value="Any">Any</option>
							<option value="Bi Male" >Bi Male</option>
							<option value="Bi Female" >Bi Female</option>
							<option value="Gay Male" >Gay Male</option>
							<option value="Gay Female" >Gay Female</option>
							<option value="Male">Straight Male</option>
							<option value="Female">Straight Female</option>
							<!-- <option value="All">All</option> -->
						</select>
					</div>
					<div class="col-md-5 col-sm-6 col-xs-12">
						<label>Body Type</label>
						<select class="form-control" name="about_bodytype">
							<!-- <option value="">Choose One</option> -->
							<option value="Any">Any</option> 
							<option value="Above Average" >Above Average</option>
							<option value="Atheltic">Atheltic </option>
							<option value="Average">Average </option>
							<option value="Full Figured" >Full Figured</option>
							<option value="Slender">Slender</option>
							<!-- <option value="All">All</option> -->
						</select>
					</div>
					<div class="col-md-5 col-sm-6 col-xs-12">
						<label>Height</label>
						<select class="form-control" name="about_height">
							<!-- <option value="">Choose One</option> -->
							<option value="Any">Any</option>
							<option value="5.1" >5.1</option>
							<option value="5.2" >5.2</option>
							<option value="5.3" >5.3</option>
							<option value="5.4" >5.4</option>
							<option value="5.5" >5.5</option>
							<option value="5.6" >5.6</option>
							<option value="5.7" >5.7</option>
							<option value="5.8" >5.8</option>
							<option value="5.9" >5.9</option>
							<option value="6.0" >6.0</option>
							<option value="6.0+" >6.0+</option>
							<!-- <option value="All">All</option> -->
						</select>
					</div>
					<div class="col-md-5 col-sm-6 col-xs-12">
						<label>Eye Color</label>
						<select class="form-control" name="about_eyecolor">
							<!-- <option value="">Choose One</option> -->
							<option value="Any">Any</option>
							<option value="Blue">Blue</option>
							<option value="Brown">Brown</option>
							<option value="Green">Green</option>
							<option value="Hazel">Hazel</option>
							<!-- <option value="All">All </option> -->
						</select>
					</div>
					<div class="col-md-5 col-sm-6 col-xs-12">
						<label>Hair Color</label>
						<select class="form-control" name="about_haircolor">
							<!-- <option value="">Choose One</option> -->
							<option value="Any">Any</option>
							<option value="Bald">Bald</option>
							<option value="Black">Black</option>
							<option value="Blonde">Blonde</option>
							<option value="Brown">Brown</option>
							<option value="Brunette">Brunette</option>
							<option value="Red">Red</option>
							<!-- <option value="All">All</option> -->
						</select>
					</div>
					<div class="col-md-5 col-sm-6 col-xs-12">
						<label>Ethnicity</label>
						<select class="form-control" name="about_ethnicity">
							<!-- <option value="">Choose One</option> -->
							<option value="Any">Any</option>
							<option value="African American" >African American</option>
							<option value="Asian">Asian</option>
							<option value="Caucasian">Caucasian</option>
							<option value="European">European</option>
							<option value="Hispanic">Hispanic</option>
							<option value="Multiracial">Multiracial</option>
							<option value="Native American" >Native American</option>
						</select>
					</div>
					<div class="col-md-5 col-sm-6 col-xs-12">
						<label>Language</label>
						<select class="form-control" name="about_language">
							<!-- <option value="">Choose One</option> -->
							<option value="Any">Any</option>
							<option value="Chinese">Chinese</option>
							<option value="English">English </option>
							<option value="French">French </option>
							<option value="German">German</option>
							<option value="Hebrew">Hebrew</option>
							<option value="Hindi">Hindi</option>
							<option value="Italian">Italian</option>
							<option value="Russian">Russian</option>
							<option value="Spanish">Spanish</option>
							<!-- <option value="All">All</option> -->
						</select>
					</div>
					<div class="col-md-5 col-sm-6 col-xs-12">
						<label>Religion</label>
						<select class="form-control" name="about_religion">
							<!-- <option value="">Choose One</option> -->
							<option value="Any">Any </option>
							<option value="Buddhism">Buddhism </option>
							<option value="Catholicism">Catholicism  </option>
							<option value="Christianity">Christianity  </option>
							<option value="Hinduism">Hinduism  </option>
							<option value="Islam">Islam </option>
							<option value="Judaism">Judaism </option>
							<option value="New Age" >New Age</option>
							<!-- <option value="All">All</option> -->
						</select>
					</div>
					<div class="clearfix"></div>
					<ul class="list-unstyled list-inline">
						<li><button type="submit" class="btn cafe-submit search">Search</button></li>
					</ul>
				</div>
			</div>
		</form>
	</div>



</div>
<script src="{{ asset('public/js/jquery.scrolling-tabs.js') }}"></script>
<script type="text/javascript">
	$('.nav-tabs').scrollingTabs({
  forceActiveTab: true
});

	$('.next-step').on('click', function () {
	   moveTab("Next");
	});
	$('.prev-step').on('click', function () {
	   moveTab("Previous");
	});

	function moveTab(nextOrPrev) {
	   var currentTab = "";
	   $('.nav-tabs li').each(function () {
	      if ($(this).hasClass('active')) {
	        currentTab = $(this);
	      }
	   });
	   $('.tab-pane').each(function () {
	      if ($(this).hasClass('active')) {
	        currentTabPane = $(this);
	      }
	   });

	   if (nextOrPrev == "Next") {
	      if (currentTab.next().length) 
	      {
	         currentTab.removeClass('active');
	         currentTab.next().addClass('active');
	         currentTabPane.removeClass('active');
	         currentTabPane.next().addClass('active');
	      }

	    } else {
	      if (currentTab.prev().length) 
	      {
	        currentTab.removeClass('active');
	        currentTab.prev().addClass('active');
	        currentTabPane.removeClass('active');
	        currentTabPane.prev().addClass('active');
	      }
	    }
	  }
</script>

<style>
ul.list-unstyled.list-inline {
    margin: 15px 10px;
    width: 100%;
    display: inline-block;
}
.tab-content {
    padding: 20px 5px;
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
 	box-shadow:1px 3px 11px #337ab7;
 	margin-top:20px;
 	margin-bottom: 60px;

 }
 .match-tabs .active a{
 	background-color: #337ab7 !important;
    color: white !important;
    box-shadow: 1px 1px 1px 3px #dedede !important;
 }
 .match-tabs{margin-top: 30px;}
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
</style>

@endsection