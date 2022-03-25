@extends('layouts.full_dashboard')

@section('content')

<style>
.mm
{
  margin-top:50px;
}
a.blue-btn{
  margin: 15px 0 15px;
}

        .ccc {
            /*margin-bottom: 15px;*/
            margin-bottom: -14px;
        }

        .dd
    {
        display:none;
    }

    .all_search{
      /*background: #8080801c;
      box-shadow: 1px 3px 11px #337ab7;*/
      background: #f5f9fc;
      /*box-shadow: 0 -1px 4px 0 rgba(99,114,130,0.15);*/
      margin-bottom: 35px;
      /* max-width: 854px; */
      margin: auto;
      padding: 0px 48px;
      margin-top: 26px;
      padding-top: 21px;
  }
    }
    .se-wr{
      margin-bottom: 34px;
    }
    .all_in{
      margin-bottom: 15px;
      padding-top: 17px !important;
      margin-right: 17px;
    }

    .all_in li{
        margin-right: 0px !important;
    }

    @media screen and (max-width: 700px){
        .all_search{
            padding: 0px;
        }
    }
    @media screen and (max-width: 764px){
        .all_form label{
            margin-bottom: 0px !important;
        }
    }


</style>
<div class="col-md-10 col-md-offset-1 col-sm-12 col-xs-12">

    <ul class="nav-inner">
        <li><a href="{{ url('/') }}">Home</a></li>
      <!-- <li><a href="{{ url('/user/dashboard') }}">Dashboard</a></li> -->
      <li class="active"><a href="{{ url('/user/search-member') }}">Advance Search</a></li>
    </ul>

    @if( !app('request')->input('month') )
        <div class="container-fluid">
            <div class="wrapper-cl se-wr">
                <div class="row mg-toptwo all_search ">
                <!-- OLD DIV --><!-- <div class="middle mm"> -->
                <!--NEW DIV --><div class="">
                       <!--  <form method="post" action="{{ url('/user/search-result') }}" id="home-search-form"> -->
                            <!-- @csrf -->
                            <!-- <div class="col-md-12 text-center logo-section">
                                <img src="{{ asset('public/img/logo.png') }}">
                            </div> -->
                             <!--<div class="col-md-offset-4 col-md-4 col-sm-6">
                                <div class="form-group">
                                    <select class="form-control" name="sex"  id="sex">
                                        <option value="">Looking To Date</option>
                                        <option value="All" @if(@$parameters['sex'] == 'All') selected @endif>All</option>
                                        <option value="Bi Female" @if(@$parameters['sex'] == 'Bi Female') selected @endif>Bi Female</option>
                                        <option value="Bi Male" @if(@$parameters['sex'] == 'Bi Male') selected @endif>Bi Male</option>
                                        <option value="Gay Female" @if(@$parameters['sex'] == 'Gay Female') selected @endif>Gay Female</option>
                                        <option value="Gay Male" @if(@$parameters['sex'] == 'Gay Male') selected @endif>Gay Male</option>
                                        <option value="Female" @if(@$parameters['sex'] == 'Female') selected @endif>Straight Female</option>
                                        <option value="Male" @if(@$parameters['sex'] == 'Male') selected @endif>Straight Male</option>
                                    </select>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <select class="form-control" name="month" id="month">
                                    <option value="">Month</option>
                                    <option value="1" @if(@$parameters['month'] == '1') selected @endif>January</option>
                                    <option value="2" @if(@$parameters['month'] == '2') selected @endif>February</option>
                                    <option value="3" @if(@$parameters['month'] == '3') selected @endif>March</option>
                                    <option value="4" @if(@$parameters['month'] == '4') selected @endif>April</option>
                                    <option value="5" @if(@$parameters['month'] == '5') selected @endif>May</option>
                                    <option value="6" @if(@$parameters['month'] == '6') selected @endif>June</option>
                                    <option value="7" @if(@$parameters['month'] == '7') selected @endif>July</option>
                                    <option value="8" @if(@$parameters['month'] == '8') selected @endif>August</option>
                                    <option value="9" @if(@$parameters['month'] == '9') selected @endif>September</option>
                                    <option value="10" @if(@$parameters['month'] == '10') selected @endif>October</option>
                                    <option value="11" @if(@$parameters['month'] == '11') selected @endif>November</option>
                                    <option value="12" @if(@$parameters['month'] == '12') selected @endif>December</option>
                                </select>
                                <span class="blue-span" style="color: #4295fb;">Enter Birthday</span>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <select class="form-control" name="day" id="day">
                                    <option value="">Day</option>
                                    @for($day = 1; $day < 31; $day++)
                                    <option @if(@$parameters['day'] == $day) selected @endif>{{ $day }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <select class="form-control" name="year" id="year">
                                    <option value="">Year</option>
                                    <?php $curr_year = Carbon\Carbon::now()->format('Y'); ?>
                                    @for($year = 1939; $year <= $curr_year; $year++)
                                    <option @if(@$parameters['year'] == $year) selected @endif>{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-12 text-center">
                                <input name="menu_name" value="Search" type="hidden">
                                <input type="submit" name="" value="search" class="blue-btn" id="search-button">
                                <a href="/user/advance-search" class="blue-btn">Advance search</a>
                            </div>
                        </form>
                    </div>
                </div> -->
                <!-- NEW CODE 03 JULY 2019 -->
                    <!-- <form method="post" action="{{ url('/user/search-result') }}" id="home-search-form">
                       @csrf
                       <div class=" col-md-6 col-sm-6">
                          <div class="form-group">
                              <span style="visibility: hidden;">.</span><input type="text" name="first_Name" class="form-control" id="fname" placeholder="Enter Name"  > 
                          </div>
                       </div>
                       <div class=" col-md-4 text-center">
                          <input type="button" name="" value="Search" class="blue-btn" id="search-button">
                          <a href="{{ url('/find-match') }}" class="blue-btn">Find a Match</a>
                          @if(Auth::check()) -->
                             <!-- <a href="{{ url('/user/advance-search') }}" class="blue-btn">Advance search</a> -->
                          <!-- @else -->
                              <!-- <a href="{{ url('/register') }}" class="blue-btn">Advance search</a>  -->
                          <!-- @endif  -->
                       <!-- </div> -->
                       <!-- <div class=" col-md-2 text-center">
                          
                       </div>    -->
                       <!-- <div class="clearfix"></div>            -->
                    <!-- </form> -->
                   

                    <form method="get" action="{{ url('/user/user_advance_search') }}" id="formSub">
                    {{--<form method="get" action="{{ url('/user/search-member') }}" id="formSub">--}}
                                    {{csrf_field()}}
                                    <div class="tab-content forms-in all_form">
                                        <div role="tabpanel" class="tab-pane <?php if(Auth::user()){?> active <?php }?>" id="tab2">

                                             

                                                <!-- <h4>About My Match Location</h4> -->
                                                <!-- <h4>Advanced Search</h4> -->

                                                <div class="col-md-4 col-sm-4 col-xs-12 " id="about_match">
                                                    <label>Month<span class="astrik_required">*</span></label>
                                                    
                                                    <select class="form-control ipad custom_vali" name="month" id="month" data-one="day" data-two="year">
                                                        <option value=""></option>
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
                                                <div class="col-md-4 col-sm-4 col-xs-12 ">
                                                    <label>Day<span class="astrik_required">*</span></label>
                                                    <select class="form-control ipad custom_vali" name="day" id="day" data-one="month" data-two="year">
                                                        <option value=""></option>
                                                        @for($day = 1; $day < 31; $day++)
                                                        <option @if(app('request')->input('day') == $day) selected  @endif>{{ $day }}</option>
                                                        @endfor
                                                    </select>
                                                     <label class="error_day"></label>
                                        
                                                </div>
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                                    <label>Year<span class="astrik_required">*</span></label>
                                                    <select class="form-control ipad custom_vali" name="year" id="year" data-one="day" data-two="month">
                                                        <option value=""></option>
                                                        <?php $curr_year = Carbon\Carbon::now()->format('Y'); ?>
                                                        @for($year = 1939; $year <= $curr_year; $year++)
                                                        <option @if(app('request')->input('year') == $year) selected  @endif>{{ $year }}</option>
                                                        @endfor
                                                    </select>
                                                    <label class="error_year"></label>
                                                </div>

                                                <div class="col-md-12 col-sm-6 col-xs-12 ccc">
                                                    <label>Select Country</label>
                                                    <select name = "continent" id="registeredcountries" class="form-control custom_error" data-one1="city" data-two2="ustate"> 
                                                        <option value=""></option>
                                                        <option value="USA" >USA</option>
                                                        <option value="England" >England</option>
                                                        <option value="Canada" >Canada</option>
                                                        <option value="Europe" >Europe</option>
                                                        
                                                    </select>
                                                    <label class="error_registeredcountries"></label>
                                                </div>


                                                <div class="col-md-12 col-sm-6 col-xs-12 dd ccc">
                                                    <label>Select Country</label>
                                                   <select name ="country" id="europecountries" class="form-control custom_error" data-one1="city" data-two2="ustate">
                                                        <option value="Austria" >Austria</option>
                                                        <option value="Belgium" >Belgium</option>
                                                        <option value="Bulgaria" >Bulgaria</option>
                                                        <option value="Croatia" >Croatia</option>
                                                        <option value="Republic of Cyprus" >Republic of Cyprus</option>
                                                        <option value="Czech Republic" >Czech Republic</option>
                                                        <option value="Denmark">Denmark</option>
                                                        <option value="Estonia" >Estonia</option>
                                                        <option value="Finland" >Finland</option>
                                                        <option value="France" >France</option>
                                                        <option value="Germany" >Germany</option>
                                                        <option value="Greece" >Greece</option>
                                                        <option value="Hungary" >Hungary</option>
                                                        <option value="Ireland" >Ireland</option>
                                                        <option value="Italy" >Italy</option>
                                                        <option value="Latvia" >Latvia</option>
                                                        <option value="Lithuania" >Lithuania</option>
                                                        <option value="Luxembourg" >Luxembourg</option>
                                                        <option value="Malta" >Malta</option>
                                                        <option value="Netherlands" >Netherlands</option>
                                                        <option value="Poland" >Poland</option>
                                                        <option value="Portugal" >Portugal</option>
                                                        <option value="Romania" >Romania</option>
                                                        <option value="Slovakia" >Slovakia</option>
                                                        <option value="Slovenia" >Slovenia</option>
                                                        <option value="Spain" >Spain</option>
                                                        <option value="Sweden" >Sweden</option>
                                                        <option value="UK" >UK</option>
                                                    </select>
                                                    <label class="error_europecountries"></label>
                                                    <span class="red-span-error" id="europe_error">
                                                        <strong></strong>
                                                    </span>
                                                </div>


                                                <div class="col-md-12 col-sm-6 col-xs-12 ccc usa" id="usastates1">
                                                    <label>Select State</label>
                                                    <select id="usastates" name="ustate" class="form-control custom_error" data-one1="city" data-two2="continent">
                                                        <option value=""></option>
                                                        @if(!empty($states))
                                                            @foreach($states as $view)
                                                                
                                                                    <option value="{{$view->state_code}}">{{$view->nstate}}</option>
                                                                
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <label class="error_usastates"></label>
                                                </div>
                                                <span class="red-span-error" id="usastates_error">
                                                    <strong></strong>
                                                </span>


                                                <div class="col-md-12 col-sm-12 col-xs-12 ccc " id="cityName">
                                                    @if(Auth::user()->continent == 'England' || Auth::user()->continent == 'Canada')
                                                        <label>Select City</label>
                                                        <select id="cityname" name="city" class="form-control custom_error" data-one1="continent" data-two2="ustate">
                                                            <option value=""></option>
                                                            @if(Auth::user()->city != '')
                                                                
                                                                @foreach($city as $view)
                                                                    @if($view->city_name == Auth::user()->city)
                                                                        <option value="{{$view->city_name}}"selected>{{$view->city_name}}</option>
                                                                    @else
                                                                        <option value="{{$view->city_name}}">{{$view->city_name}}</option>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                        <label class="error_cityname"></label>
                                                    @elseif(Auth::user()->continent == 'USA')
                                                        <label>Select City</label>
                                                        <select id="cityname" name="city" class="form-control custom_error" data-one1="continent" data-two2="ustate">
                                                            <option value=""></option>
                                                           
                                                                
                                                                @if(!empty($usacity))
                                                                    @foreach($usacity as $view)
                                                                        
                                                                            <option value="{{$view->city}}">{{$view->city}}</option>
                                                                       
                                                                    @endforeach
                                                                @endif
                                                            
                                                        </select>
                                                        <label class="error_cityname"></label>
                                                    @else
                                                        <label>Select City</label>
                                                        <select id="cityname" name="city" class="form-control custom_error" data-one1="continent" data-two2="ustate">
                                                            <option value=""></option>
                                                            @if(Auth::user()->city != '')
                                                                
                                                                @foreach($eurocities as $view)
                                                                    @if($view->city_name == Auth::user()->city)
                                                                        <option value="{{$view->city_name}}"selected>{{$view->city_name}}</option>
                                                                    @else
                                                                        <option value="{{$view->city_name}}">{{$view->city_name}}</option>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                        <label class="error_cityname"></label>
                                                    @endif
                                                </div> 
                                                <div class="clearfix"></div>     
                                        </div>

                                          
                                        <div role="tabpanel" class="tab-pane <?php if(Auth::user()){?> active <?php }?>" id="tab2">
                                            

                                                

                                                <ul class="list-unstyled list-inline all_in">
                                                    <li><button type="submit" class="btn custom-cafe-submit search" id="submitButton">Search {{--<i class="fa fa-chevron-right"></i>--}}</button></li>
                                                </ul>

                                        </div>
                                    </div>

                                   
                                </form>

                                  <div style="background: none !important;" class="modal fade" id="myModal" role="dialog">
                                    <div class="modal-dialog">
            
              
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <button type="submit" class="close" data-dismiss="modal">&times;</button>
                                          <h4 class="modal-title">Please Fill Appropriate Location Details</h4>
                                        </div>
                                     
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-default mybt" data-dismiss="modal">Close</button>
                                        </div>
                                      </div>
                                      
                                    </div>
                                  </div>
                                  </div>
              </div>
              <!-- NEW CODE ENDS HERE  -->
                <div class="row">
                    <div class="col-md-12">
                      @if(@$users)
                        @if(count($users) > 0)
                            @foreach ($users as $user)
                            <div class="search-result">
                              @if($user->name)
                              <h2><a class="view" href="{{ url('/') }}/user/view-profile/{{ $user->id }}"> {{ $user->name }} </a></h2>
                              <a href="{{ url('/') }}/user/view-profile/{{ $user->id }}" class="htt">{{ url('/').'/user/'.$user->name }}</a>
                              @else
                              <h2><a class="view" href="{{ url('/') }}/user/view-profile/{{ $user->id }}"> {{ $user->email }} </a></h2>
                              <a href="{{ url('/') }}/user/view-profile/{{ $user->id }}" class="htt">{{ url('/').'/user/'.str_limit($user->email,5) }}</a>
                              @endif 
                              @if($user->type_of_relationship)<p> {{ 'I am Looking For '. $user->type_of_relationship }} </p>@endif
                              @if($user->activity) <p>{{ 'I Like '. $user->activity }} </p>@endif
                            </div>

                            @endforeach
                         @else
                          <div class="row text-center">No records found</div>
                         @endif   
                      @endif
                  </div>

                  <div class="col-md-12">
                      @if(@$users){{ $users->links() }}@endif
                  </div>
              </div>
          </div>
        </div>
    @endif

    @if( app('request')->input('month') )
        <div class="row top search-find">
           <div class = "col-md-12 col-xs-12 col-sm-12">
              <!-- <div class="container"> -->
                 @if(@$matchdetail)
                 @if(count($matchdetail) > 0)
                 @foreach($matchdetail as $user)
                    <div class="search-result col-md-12 line-content  paginate-class">
                       {{--<div class="col-md-3 col-xs-6 user">
                          @if(!empty($user->image))
                          <a class="view" href="{{ url('/user/user-profile').'/'.$user->id }}">
                             <img src="{{ url('public/img').'/'.$user->image }}" class="user-image1 yy">
                          </a>
                          @else
                          <a class="view" href="{{ url('/user/user-profile').'/'.$user->id }}">
                             <img class="image-message user-image yy1" src="https://ifoundyou.com/public/img/profile-user.png" data-toggle="popover" title="" data-placement="left">
                          </a>
                          @endif
                       </div> --}}
                       <div class="col-md-9 col-xs-6">
                          <a href="{{ url('/user/user-profile').'/'.$user->id }}">
                             @if($user->name)
                                <h2 class="view">{{ $user->name }}</h2>
                                {{--<a href="{{ url('/user/user-profile').'/'.$user->id }}" class="htt">{{ url('/').'/user/'.$user->name }}</a>--}}
                                <div class="description custom_description">
                                   <span class="htt">{{ url('/').'/user/'.$user->name }}</span>
                                   @if($user->month)
                                      <b>Date Of Birth:</b> {{ $user->month.'/'.$user->day.'/'.$user->year }}
                                   @endif
                                   @if($user->sex)
                                      <b>Gender:</b> {{ $user->sex }}
                                   @endif
                                </div>
                             @else
                                <h2 class="view">{{ $user->email }}</h2>
                                {{--<a href="{{ url('/user/user-profile').'/'.$user->id }}" class="htt">{{ url('/').'/user/'.str_limit($user->email,5) }}</a>--}}
                                <div class="description custom_description">
                                   <span class="htt">{{ url('/').'/user/'.str_limit($user->email,5) }}</span>
                                   @if($user->month)
                                      <b>Date Of Birth:</b> {{ $user->month.'/'.$user->day.'/'.$user->year }}
                                   @endif
                                   @if($user->sex)
                                      <b>Gender:</b> {{ $user->sex }}
                                   @endif
                                </div>
                             @endif

                             <div class="description" style="margin-top: 5px;"> 
                                {{--<b>Lives In : @if(!empty($user->state)) {{$user->state}} , {{$user->live_in}} @else {{$user->live_in}} @endif</b>--}}
                                @if($user->looking_for)
                                   <b>Looking to Date:</b> {{ $user->looking_for }}
                                @endif
                             </div>
                          </a>
                       </div>
                    </div>
                 @endforeach
                 <div class="col-md-12 col-xs-12 page">
                    <nav aria-label="Page navigation example">
                       <ul id="pagin" class="pagination"></ul>
                    </nav>
                 </div>
                  
                 @else
                    <div class="row text-center">No records found</div>
                 @endif   
                 @endif
                 
              </div>
           <!-- </div> -->
        </div>
    @endif

</div>

   <script type="text/javascript">
        var status = 0;

        $(".custom_vali").on('change',function(){
            var val_sel = $(this).val();
            var data_one = $(this).attr('data-one');
            var data_two = $(this).attr('data-two');
            var data_one_value = $('#'+data_one).val();
            var data_two_value = $('#'+data_two).val();
            var this_data = $(this).attr('id');
            if(val_sel == ''){
                // $(".error_"+this_data).text('This field is required');
                $(".error_"+this_data).text('');
            }else{ 
                $(".error_"+this_data).text('');
                if(data_one_value == ''){
                    $("#"+data_one).attr('required',true);
                    status = 0;
                    // $(".error_"+data_one).text('This field is required');
                    $(".error_"+data_one).text('');
                }
                if(data_two_value == ''){
                    $("#"+data_two).attr('required',true);
                    status = 0;
                    // $(".error_"+data_two).text('This field is required');
                    $(".error_"+data_two).text('');
                }

                if(val_sel != '' && data_two_value != '' && data_one_value != ''){
                    status = 3;

                }
            }
        });



        $(".custom_error").on('change',function(){
            var val_sel1 = $(this).val();

            if(val_sel1 == ''){
              status = 0; 
                
            }else{ 
              status = 3;
            }



        });

        $(document).on('click','#submitButton',function(){

            var formData = $("#formSub").serialize();
            var name = ''; 
            var val = '';
           
            $(".form-control").each(function() {
                name = $(this).attr('name');

                if(name != 'month' && name != 'year' && name != 'day' && name != 'ustate' && name != 'city' && name != 'continent' && name != 'country'){
                   
                        status = 1;
                        console.log(name);
                
                }
            
            });console.log(status);

            if(status == 1 || status == 3){
              var formData = $("#formSub").serialize();
              // console.log(formData);
              // return false;
              // console.log(window.location.href = "{{url('/user/user_advance_search?formData=')}}"+formData);
              $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token()}}'
                        },
                    type: "post",
                    dataType: 'html',
                    url: "{{url ('/user/user_advance_search')}}",
                    data: { "formData":formData } ,
                    success: function(data) {
                        // console.log(search_status);
                            window.location.href = "{{url('/user/user_advance_search?formData=')}}"+formData;
                    },
                    error: function(data){
                        return false;
                    }
                });
              // return true;
            }else if(status == 0){
               //$("#myModal").modal();
                return false;

            }
        });

    </script>


    <script type="text/javascript">
  jQuery(document).ready(function(){
    
    $('#registeredcountries').change(function(){
      var value =  $(this).val();
      if(value == 'Europe')
      {
        $('#europecountries').show();
        $('.dd').css('display','block');

        $.ajax({
          type:'GET',
          url: "{{ url('/user/euro') }}",
          success:function(euro){
            $('#europecountries').html(euro);
          }
        });

      }
      else
      {
        $('#europecountries').hide();
      }
    })    
  })

</script>

<script type="text/javascript">
  jQuery(document).ready(function() {
    var value = $('#registeredcountries').val();
    if(value == 'Europe')
    {
      $('#europecountries').show();
      $('.dd').css('display','block');

      $.ajax({
          type:'GET',
          url: "{{ url('/user/euro') }}",
          success:function(euro){
            $('#europecountries').html(euro);
          }
        });
    }
    else
    {
      $('#europecountries').hide();
      $('#europecountries').html('<option value="">Select Country</option>');
    }
  })

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
    $('#registeredcountries').change(function(){
      var value = $(this).val();
      if(value == 'England' || value == 'Canada')
      {
        $.ajax({
          type:'GET',
          data : {'country':value},
          url: "{{ url('/user/englandcanada') }}",
          success:function(englandcanada){
            // $('#cityName').html(englandcanada);
            // $('#cityName').css('display','block');
            $('#cityname').html(englandcanada);
            $('#europecountries').html('<option value="">Select Country</option>');
            $('#locations').html('<option value="">Select Cafe Location</option>');
            $('.dd').hide();
            $('.usa').hide();
            $('.usa1').hide();
            
          }
        });
      }
    })
  })
</script>


<script type="text/javascript">
  jQuery(document).ready(function(){
    $('#registeredcountries').change(function(){
      var value = $(this).val();
      if(value == 'Europe')
      {
        $('#usastates1').hide();
        $('#usastates').html();
        $('#cityname').html('<option value="">Select City</option>')
      }
    })
  });
</script>

<script type="text/javascript">
  
    $(document).on('change','#europecountries',function(){
      var value = $(this).val();
      if(value)
      {
        $.ajax({
          type:'GET',
          data : {'country':value},
          url: "{{ url('/user/englandcanada') }}",
          success:function(englandcanada){
            // $('#cityName').html(englandcanada);
            // $('#cityName').css('display','block');
            $('#cityname').html(englandcanada);
            $('.usa').hide();
            $('.usa1').hide();
          }
        });
      }
    })
</script>




<script type="text/javascript">

    $(document).on('change','#cityname',function(){
      var city = $(this).val(); 
      var continent = $('#registeredcountries').val();
      var country = $('#europecountries').val();

        $.ajax( {
          type:'GET',
        url:"{{url('/user/englandcanadalocations')}}",
        data : {'city':city, 'continent':continent, 'country':country},
          success: function(englandcanadalocations){
            if(englandcanadalocations){
              // $('#Locations').html(englandcanadalocations);
              // $('#Locations').css('display','block');
              $('#locations').html(englandcanadalocations);
            }
          }
        })
    })
  
</script>

<script type="text/javascript">
  $(document).on('change','#registeredcountries',function(){
    var value = $(this).val();
    if(value == "USA")
    {
      $.ajax( {
            type:'GET',
          url:"{{url('/user/usacodes')}}",
          success: function(usacodes){
              if(usacodes){
                // jQuery('#usastates1').html(usacodes);
                jQuery('#usastates').html(usacodes);
                jQuery('#europecountries').html('');
                jQuery('#europecountries').hide();
                jQuery('#cityname').html('<option value="">Select City</option>');
                jQuery('#locations').html('<option value="">Select Cafe Location</option>');
                jQuery('.usa').show();
                jQuery('.dd').hide();
            }
          }
        });
    }
});
</script>

<script type="text/javascript">
  $(document).ready(function(){
    var value = $('#registeredcountries').val();
    if(value == 'Canada' || value == 'England' || value== 'Europe')
    {
      $('#usastates1').hide();
      $('#usastates').html('');
    }
  })
</script>

<script type="text/javascript">
  $(document).on('change','#usastates',function(){
    var value = $(this).val();
    if(value)
    {
      $.ajax( {
            type:'GET',
          url:"{{url('/user/usacities')}}",
          data : {'state_code':value},
          success: function(usacities){
              if(usacities){
                // jQuery('#usacities1').html(usacities);
                // jQuery('#usacities').html(usacities);
                // jQuery('.usa1').show();
                jQuery('#cityname').html(usacities);
                $('#europecountries').html('<option value="">Select Country</option>');

            }
            else
            {
              jQuery('.usa1').hide();
            }
          }
        }); 
    }
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

<script>
  //Pagination
  pageSize = 6;
  incremSlide = 6;
  startPage = 0;
  numberPage = 0;
  var pageCount =  $(".line-content").length;
  console.log(pageCount);
  var pageCount =  $(".line-content").length / pageSize;
  var totalSlidepPage = Math.floor(pageCount / incremSlide);
  console.log(totalSlidepPage);
    for(var i = 0 ; i<pageCount;i++){
       
      $("#pagin").append('<li class="page-item "><a class="page-link" href="javascript:void(0);">'+(i+1)+'</a></li> ');
        if(i>pageSize){
           $("#pagin li").eq(i).hide();
        }
     }

     var prev = $("<li/>").addClass("prev").html("Prev").click(function(){
        startPage-=5;
        incremSlide-=5;
        numberPage--;
        slide();
     });

     prev.hide();

     var next = $("<li/>").addClass("page-item").html("Next").click(function(){
        startPage+=5;
        incremSlide+=5;
        numberPage++;
        slide();
     });
     $("#pagin").prepend(prev).append(next);
     $("#pagin li").first().find("a").addClass("current");

     if(totalSlidepPage == 0){
        next.hide();
     }

     slide = function(sens){
        $("#pagin li").hide();
        for(t=startPage;t<incremSlide;t++){
           $("#pagin li").eq(t+1).show();
        }
        if(startPage == 0){
           next.show();
           prev.hide();
        }else if(numberPage == totalSlidepPage ){
           next.hide();
           prev.show();
        }else if(totalSlidepPage == 1 ){
           next.hide();
        }
        else{
           // next.show();
           prev.show();
        }
     }
     showPage = function(page) {
        $(".line-content").hide();
        $(".line-content").each(function(n) {
          if (n >= pageSize * (page - 1) && n < pageSize * page)
              $(this).show();
        });        
     }
   
  showPage(1);
  $("#pagin li a").eq(0).addClass("current");
  $("#pagin li a").click(function() {
      $("#pagin li a").removeClass("current");
      $(this).addClass("current");
      showPage(parseInt($(this).text())) 
  });

  $('.page-item').each(function(){
     var text = $(this).text();
     if(text == 'Next'){
     console.log(text);
        $(this).addClass('item');
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
