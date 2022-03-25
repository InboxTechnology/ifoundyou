@extends('layouts.admin_dashboard')

@section('content')
    <style type="text/css">
        #month, #day, #year{
        border: 1px solid #d0d4d9;
        border-radius: 4px;
        padding: 5px 10px;
        margin-bottom: 0px;
        font-size: 14px;
        /*width: auto;*/
        }   

        .ccc {
            /*margin-bottom: 15px;*/
            margin-bottom: -14px;
        }

        .dd
    {
        display:none;
    }

     ul.list-unstyled.list-inline {
            margin: 15px 10px;
            width: 100%;
            display: inline-block;
        }
        .tab-content {
            /*padding: 20px 5px;*/
            padding: 20px 5px 38px;
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
            margin-top:0px;
            /*margin-bottom: 60px;*/
            /*height: 500px !important;*/
            /*height: 388px !important;*/

         }

           .tab-content2{
            box-shadow:1px 3px 11px #337ab7;
            margin-top:20px;
            /*margin-bottom: 60px;*/
            /*height: 510px !important;*/

         }

         .forms-in ul{
            border-bottom:none !important;
         }
        .match-tabs .active a{
            background-color: #337ab7 !important;
            color: white !important;
            box-shadow: 1px 1px 1px 3px #dedede !important;
         }
         /*.match-tabs{margin-top: 30px;}*/
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
        .error{
            color: red;
        }

        .forms-in ul li{
            border-bottom: none !important;
        }
    </style>
    <div class="container">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Find match</div>
                <div class="match-tabs">
                   
                    <div>
                        <form method="post" action="{{ url('/admin/findmatchusers') }}" id="formSub">
                            {{csrf_field()}}
                            <div class="tab-content forms-in">
                                <div role="tabpanel" class="tab-pane <?php if(Auth::user()){?> active <?php }?>" id="tab2">

                                     <?php /*<ul class="nav nav-tabs" role="tablist">
                  
                                         <li role="presentation" class="<?php if(Auth::user()){?> active <?php }?>"><a href="javascript::void(0);" role="tab" data-toggle="tab">About My Match Location</a></li>
                                    </ul> */?>
                                    

                                        <h4>About My Match Location</h4>
                                        <div class="col-md-4 col-sm-6 col-xs-12 " id="about_match">
                                            <label>Month</label>
                                            
                                            <select class="form-control ipad custom_vali" name="month" id="month" data-one="day" data-two="year">
                                                <option value="">Select Month</option>
                                                <option value="1" @if(app('request')->input('month') == '1') selected  @endif>January</option>
                                                <option value="2" @if(app('request')->input('month') == '2') selected  @endif>February</option>
                                                <option value="3" @if(app('request')->input('month') == '3') selected  @endif>March</option>
                                                <option value="4" @if(app('request')->input('month') == '4') selected  @endif>April</option>
                                                <option value="5" @if(app('request')->input('month') == '5') selected  @endif>May</option>
                                                <option value="6" @if(app('request')->input('month') == '6') selected  @endif>June</option>
                                                <option value="7" @if(app('request')->input('month') == '7') selected  @endif>July</option>
                                                <option value="8" @if(app('request')->input('month') == '8') selected  @endif>August</option>
                                                <option value="9" @if(app('request')->input('month') == '9') selected  @endif>September</option>
                                                <option value="10" @if(app('request')->input('month') == '10') selected  @endif>October</option>
                                                <option value="11" @if(app('request')->input('month') == '11') selected  @endif>November</option>
                                                <option value="12" @if(app('request')->input('month') == '12') selected  @endif>December</option>
                                            </select>
                                            <label class="error_month"></label>
                                        </div>
                                        <div class="col-md-4 col-sm-6 col-xs-12 ">
                                            <label>Day</label>
                                            <select class="form-control ipad custom_vali" name="day" id="day" data-one="month" data-two="year">
                                                <option value="">Select Day</option>
                                                @for($day = 1; $day < 31; $day++)
                                                <option @if(app('request')->input('day') == $day) selected  @endif>{{ $day }}</option>
                                                @endfor
                                            </select>
                                             <label class="error_day"></label>
                                
                                        </div>
                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                            <label>Year</label>
                                            <select class="form-control ipad custom_vali" name="year" id="year" data-one="day" data-two="month">
                                                <option value="">Select Year</option>
                                                <?php $curr_year = Carbon\Carbon::now()->format('Y'); ?>
                                                @for($year = 1939; $year <= $curr_year; $year++)
                                                <option @if(app('request')->input('year') == $year) selected  @endif>{{ $year }}</option>
                                                @endfor
                                            </select>
                                            <label class="error_year"></label>
                                        </div>

                                        <div class="col-md-12 col-sm-6 col-xs-12 ccc">
                                            
                                            <select name="country_id" id="registeredcountries" class="form-control custom_error" data-one1="city" data-two2="ustate"> 
                                                <option value="">Select Country</option>
                                                <option value="2" >Canada</option>
                                            </select>
                                            <label class="error_registeredcountries"></label>
                                        </div>


                                        <div class="col-md-12 col-sm-12 col-xs-12 ccc " id="cityName">
                                            @if( Auth::user()->continent == 'Canada')
                                                <select id="city_id" name="city_id" class="form-control custom_error">
                                                    <option value="">Select City:</option>
                                                    @if( Auth::user()->city_id )
                                                        @foreach($cities as $view)
                                                            @if( $view->id == Auth::user()->city_id )
                                                                <option value="{{ $view->city_name }}"selected>{{ $view->city_name }}</option>
                                                            @else
                                                                <option value="{{ $view->city_name }}">{{ $view->city_name }}</option>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </select>
                                                <label class="error_cityname"></label>
                                            @endif
                                        </div> 
                                        <div class="clearfix"></div>     
                                </div>

                                  <?php /* <ul class="nav nav-tabs" role="tablist">
                                               
                                                <li role="presentation" class="<?php if(Auth::user()){?> active <?php }?> act2" ><a href="#tab2" role="tab" data-toggle="tab">About My Match</a></li>
                                </ul> */ ?>
                                <div role="tabpanel" class="tab-pane <?php if(Auth::user()){?> active <?php }?>" id="tab2">
                                    

                                        <h4>About My Match</h4>
                                        <div class="col-md-6 col-sm-6 col-xs-12" id="about_match">
                                            <label>Gender</label>
                                            
                                            <select class="form-control" name="about_gender">
                                                
                                                <option  value="Any">Any</option>
                                                <option  value="Bi Male" >Bi Male</option>
                                                <option   value="Bi Female" >Bi Female</option>
                                                <option  value="Gay Male" >Gay Male</option>
                                                <option   value="Gay Female" >Gay Female</option>
                                                <option   value="Male">Straight Male</option>
                                                <option   value="Female">Straight Female</option>
                                                
                                            </select>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <label>Body Type</label>
                                            <select class="form-control" name="about_bodytype">
                                               
                                                <option value="Any">Any</option> 
                                                <option value="Above Average" >Above Average</option>
                                                <option  value="Atheltic">Athletic </option>
                                                <option  value="Average">Average </option>
                                                <option  value="Full Figured" >Full Figured</option>
                                                <option  value="Slender">Slender</option>
                                                
                                            </select>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <label>Height</label>
                                            <select class="form-control" name="about_height">
                                           
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
                                            
                                            </select>
                                        </div>

                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <label>Eye Color</label>
                                            <select class="form-control" name="about_eyecolor">
                                                
                                                <option value="Any">Any</option>
                                                <option value="Blue">Blue</option>
                                                <option value="Brown">Brown</option>
                                                <option value="Green">Green</option>
                                                <option value="Hazel">Hazel</option>
                                                
                                            </select>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <label>Hair Color</label>
                                            <select class="form-control" name="about_haircolor">
                                                
                                                <option  value="Any">Any</option>
                                                <option  value="Bald">Bald</option>
                                                <option  value="Black">Black</option>
                                                <option  value="Blonde">Blonde</option>
                                                <option  value="Brown">Brown</option>
                                                <option  value="Brunette">Brunette</option>
                                                <option  value="Red">Red</option>
                                                
                                            </select>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <label>Ethnicity</label>
                                            <select class="form-control" name="about_ethnicity">
                                                
                                                <option  value="Any">Any</option>
                                                <option   value="African American" >African American</option>
                                                <option   value="Asian">Asian</option>
                                                <option   value="Caucasian">Caucasian</option>
                                                <option   value="European">European</option>
                                                <option   value="Hispanic">Hispanic</option>
                                                <option   value="Multiracial">Multiracial</option>
                                                <option   value="Native American" >Native American</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <label>Language</label>
                                            <select class="form-control" name="about_language">
                                                
                                                <option  value="Any">Any</option>
                                                <option  value="Chinese">Chinese</option>
                                                <option  value="English">English </option>
                                                <option  value="French">French </option>
                                                <option  value="German">German</option>
                                                <option  value="Hebrew">Hebrew</option>
                                                <option  value="Hindi">Hindi</option>
                                                <option  value="Italian">Italian</option>
                                                <option  value="Russian">Russian</option>
                                                <option  value="Spanish">Spanish</option>
                                                
                                            </select>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <label>Religion</label>
                                            <select class="form-control" name="about_religion">
                                                
                                                <option  value="Any">Any </option>
                                                <option  value="Buddhism">Buddhism </option>
                                                <option  value="Catholicism">Catholicism  </option>
                                                <option  value="Christianity">Christianity  </option>
                                                <option  value="Hinduism">Hinduism  </option>
                                                <option  value="Islam">Islam </option>
                                                <option  value="Judaism">Judaism </option>
                                                <option  value="New Age" >New Age</option>
                                               
                                            </select>
                                        </div>
                                        <div class="clearfix"></div>

                                        <ul class="list-unstyled list-inline">
                                            <li><button type="submit" class="btn cafe-submit search" id="submitButton">Submit <i class="fa fa-chevron-right"></i></button></li>
                                        </ul>

                                </div>
                            </div>

                           
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <div>

       
  <div style="background: none !important;" class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Please Fill Appropriate My Match Location and About My Match Details</h4>
        </div>
     
        <div class="modal-footer">
          <button type="button" class="btn btn-default mybt" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>


    <script type="text/javascript">
        $(".custom_vali").on('change',function()
        {
            var val_sel = $(this).val();
            var data_one = $(this).attr('data-one');
            var data_two = $(this).attr('data-two');
            var data_one_value = $('#'+data_one).val();
            var data_two_value = $('#'+data_two).val();
            var this_data = $(this).attr('id');
            if(val_sel == '')
            {
                $(".error_"+this_data).text('This field is required');
                
            }
            else
            { 
                $(".error_"+this_data).text('');
                if(data_one_value == ''){
                    $("#"+data_one).attr('required',true);
                    status = 0;
                    $(".error_"+data_one).text('This field is required');
                }
                if(data_two_value == ''){
                    $("#"+data_two).attr('required',true);
                    status = 0;
                    $(".error_"+data_two).text('This field is required');
                }

                if(val_sel != '' && data_two_value != '' && data_one_value != ''){
                    status = 3;

                }
            }
        });


        $(".custom_error").on('change',function(){
            var val_sel1 = $(this).val();
            if(val_sel1 == '')
            {
              status = 0;
            }
            else
            { 
              status = 3;
            }
        });

        $(document).on('click', '#submitButton',function()
        {
            var formData = $("#formSub").serialize();
            var name = ''; 
            var val = '';
           
            $(".form-control").each(function() {
                name = $(this).attr('name');

                if(name != 'month' && name != 'year' && name != 'day' && name != 'ustate' && name != 'city' && name != 'continent' && name != 'country'){
                    val = $('select[name="'+name+'"] option:selected').val();
                    if(val != 'Any' && val != " "){
                        status = 1;
                        console.log(name);
                    }
                }
            
            });
            console.log(status);

            if( status == 1 || status == 3) 
            {
                return true;
            }
            else if( status == 0 )
            {
               $("#myModal").modal();
                return false;
            }
        });
    </script>

<script>
    function functionAlert(msg, myYes) {
        $('#confirm1').show();
        var confirmBox = $("#confirm1");
        confirmBox.find(".message").text(msg);
        confirmBox.find(".yes").unbind().click(function() {
            confirmBox.hide();
        });
        confirmBox.find(".yes").click(myYes);
        confirmBox.show();
    }
</script>


<script type="text/javascript">
     //Near checkboxes
    $('.product-list').click(function() {
        $(this).siblings('input:checkbox').prop('checked', false);
    });
</script>


<script>
    jQuery(document).ready(function(){
        $('.popbtn').click(function(){
            var val = $(this).attr('value');
            if(val == 'no'){
                $('#confirm1').hide();
            }else{
            	$('#confirm2').show();
            }
          })
      })

</script>

<script type="text/javascript">
	jQuery(document).ready(function(){
		$('.popsbtn').click(function(){
			var value = $(this).val();
			if(value == 'cancel')
			{	
				$('#confirm1').hide();
				$('#confirm2').hide();
			}
			else
			{
				$.ajax({
					type:'GET',
					url: "{{ url('/user/delete-account') }}",
					success:function(data){
						alert('Your account has been deleted.');
						window.location.href = "/";
					}
				});
			}
		})
	})
</script>

<script type="text/javascript">
	jQuery(document).ready(function(){
		$('#registeredcountries').change(function()
        {
            var countryID = $(this).val();
            $.ajax({
                type:'GET',
                url:"{{ url('/user/cities') }}",
                data : {'countryID':countryID},
                success: function(cities)
                {
                    if( cities )
                    {
                        jQuery('#city_id').html(cities);
                    }
                }
            });
		})
	})
</script>



<script type="text/javascript">
	$('#delete-account').click(function(){
		var checkedValue = $('.product-list:checked').val();
		if(checkedValue == 'Yes')
		{
			$('#confirm1').show();
		}
	});
</script>

<script type="text/javascript">
	window.addEventListener( "pageshow", function ( event ) {
  var historyTraversal = event.persisted || 
                         ( typeof window.performance != "undefined" && 
                              window.performance.navigation.type === 2 );
  if ( historyTraversal ) {
    // Handle page restore.
    window.location.reload();
  }
});
</script>
@endsection