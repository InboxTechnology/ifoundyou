@extends('layouts.full_dashboard')

@section('content')
<style type="text/css">
   .search-result{padding-left: 5px;padding-right: 15px;}
</style>
   <div class="col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
      <!-- <div class="wrapper-cl"> -->
         <!-- <div class="mg-toptwo"> -->
            {{--<div class="top-tab">
              <div class="heading-tabs">--}}
                  <ul class="nav-inner">
                     <li><a href="{{url('/')}}">Home</a></li>
                     <!-- <li><a href="{{ url('/user/dashboard')}}">Dashboard</a></li> -->
                     <li><a href="{{ url('/user/search-member') }}">Advance Search</a></li>
                     <li class="active"><a href="">Advance Search Results</a></li>
                  </ul>
               {{--</div>
            </div>--}}
         
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
         <!-- </div> -->
      <!-- </div> -->
   </div>
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

   <!-- <script type="text/javascript">
      $(document).ready(function(){
         var $pageItem = $(".pagination li")

         $pageItem.click(function(){
           console.log($(this).html().indexOf('Next'));
           if($(this).html().indexOf('Next') <= -1 && $(this).html().indexOf('Previous') <= -1){
           $pageItem.removeClass("active");
           $(this).addClass("active");
             }
         });
       });
   </script> -->
   <script type="text/javascript">
      jQuery(document).ready(function(){
         $.ajax( {
            
            url: "{{ url('/registercountries') }}",
            method: 'GET',
            success: function(registercountries){
            if(registercountries){
               $('#registercountries').html(registercountries);
            }
         }
      })
   })
   </script>

   <script type="text/javascript">
      jQuery(document).ready(function(){
         $('#registercountries').change(function(){
            var value = $(this).val();
            if(value == 'USA')
            {
               $.ajax ( {

                  url:  "{{ url('/usastates') }}",
                  method: 'GET',
                     success: function(usastates){
                     if(usastates){
                        $('#location').html(usastates);
                        $('#location').css('display','block');
                        $('#location').css('display','block');
                        $('#locations').css('display','block');
                        $('#cities').html('<option value="">Select City:</option>');
                        $('#locations').html('<option value="">Choose Cafe Location:</option>');
                     }
                  }
               })
            }
            if(value == 'Europe')
            {
               $.ajax ( {

                  url:  "{{ url('/europecountries') }}",
                  method: 'GET',
                     success: function(europecountries){
                     if(europecountries){
                        $('#location').html(europecountries);
                        $('#country_error').show();
                        $('#location').show();
                        $('#continent_error strong').text('');
                     }
                  }
               })
            }
            else
            {
               $('#europecountries').hide();
               $('#europecountries').html('<option value="">Select Country</option>');
               $('#country_error').hide();
            }
            // var value = $(this).val();
            var value1 = $('#europecountries').val();
            if(value == 'England' || value == 'Canada')
            {
               $.ajax ( {

                  url:  "{{ url('/getcities') }}",
                  method: 'GET',
                  data : {'continent':value,'country':value1},
                     success: function(getcities){
                     if(getcities){
                        $('#location').html(getcities);
                        $('#location').css('display','block');
                     }
                  }
               })
            }        

         })
         
      })
   </script>   

   <script type="text/javascript">
      jQuery(document).ready(function(){
         var value = localStorage.getItem('continent');
         var value1 = localStorage.getItem('country_name');
         if(value == 'Europe'){
            $.ajax ( {

                  url:  "{{ url('/europecountries') }}",
                  method: 'GET',
                  data: {'country_name':value1},
                     success: function(europecountries){
                     if(europecountries){
                        $('#europecountries').html(europecountries);
                        $('#europecountries').show();
                     }

                  }
               })
         }
         

      })
   </script>
   <script type="text/javascript">
      $(document).ready(function(){
         $('#europecountries').change(function(){
            var value = $(this).val();
            var value1 = $('#registercountries').val();
            {
               $.ajax ( {

                  url:  "{{ url('/getcities') }}",
                  method: 'GET',
                  data : {'continent':value1,'country':value},
                     success: function(getcities){
                     if(getcities){
                        $('#cities').html(getcities);
                     }
                  }
               })
            }
         })
      })
   </script>


   <script type="text/javascript">
      $(document).ready(function(){
         $('#cities').change(function(){
            var value = $(this).val();
            var value1 = $('#registercountries').val();
            var value2 = $('#europecountries').val();

            $.ajax ( {

                  url:  "{{ url('/getlocations') }}",
                  method: 'GET',
                  data : {'city':value,'continent':value1,'country':value2},
                     success: function(getlocations){
                     if(getlocations){
                        $('#locations').html(getlocations);
                     }
                  }
               })


         })
      })
   </script>
   <script type="text/javascript">
      $(document).ready(function(){
         $('#states').change(function(){
            var value = $(this).val();
            
            $.ajax ( {

               url:  "{{ url('/usacities') }}",
               method: 'GET',
               data : {'state_code':value},
                  success: function(usacities){
                  if(usacities){
                     $('#cities').html(usacities);
                  }
               }
            })
            
         })
      })
   </script>
   <script type="text/javascript">
      $(document).ready(function(){
         $('#registercountries').change(function(){
            var value = $(this).val();
            if(value == 'Europe')
            {
               $('#cities').html('<option value="">Select City:</option>');
               $('#locations').html('<option value="">Choose Cafe Location:</option>');
               $('#states').css('display','none');
            }
         })
      })
   </script>
@endsection