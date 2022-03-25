@extends('layouts.full_dashboard')

@section('content')

<style type="text/css">
   .nav-inner li a
   {
      color: black !important;
   }
   .al
   {
      margin-left: 9px !important;
   }
   .user
   {
      width: auto;
      padding: 0px;
      padding-top: 28px;
   }
   .yy1
   {
      padding-top: 5px !important;
   }
   .image-message
   {
      width: 72px !important;
      padding-top: 0px !important;
   }
   .user-image1
   {
      border-radius: 100%;
      width: 70px;
      height: 70px;
      overflow: hidden;
      max-width: 250px;
      border: 1px solid #1f67b2;
      object-fit: cover;
   }
   .search-result
   {
      clear: both;
      border-radius: 0px;
      float: left;
      width: 100%;
      border-bottom: 1px solid #eaeff5;
      padding-bottom: 15px;
      margin-bottom: 10px;
   }
   .custom_advance_search_box label
   {
      text-align: left;display: block;
   }
   .custom_advance_search_box .custom_search_btn
   {
      padding: 8px 20px;
   }
   hr
   {
      margin-top: 0;margin-bottom: 0;border-top: 1px solid rgba(179,179,179,0.5);
   }
   .nav-inner
   {
      margin: 0 10px;
   }
   /* .header-top img.logo-top
   {
      width: 150px;
      text-align: center;
      float: none !important;
   } */


   @media only screen and (min-width: 812px) {
      .row
      {
         margin-right: 0px;
      }
      .header-top
      {
         padding: 15px 0px 5px;
      }
      .header-top img.logo-top
      {
         margin: 35px auto 0;
      }
      .header-top ul
      {
         margin-right: 16px;
      }
      .col-md-offset-1
      {
         margin-left: 1%;
      }
   }

   @media only screen and (max-width: 811px) {
      .custom_advance_search_box
      {
         padding: 0 15px;
      }
   }

   @media (min-width: 768px) {
      .navbar-right
      {
         margin-right: 0;
      }
   }   
</style>

<div class="row">
   <div class="col-lg-2 col-md-3 col-xs-12"></div>

   <div class="col-lg-12 col-md-9 col-xs-12">
   
      <div class="wrapper-cl al">
            <ul class="nav-inner">
               <li><a href="{{ url('/user/dashboard') }}">Home</a></li>
               @if( Auth::check() )
                  <!-- <li><a href="{{ url('/user/dashboard') }}">Dashboard</a></li> -->
               @endif
               <li><a href="{{ url('/find-a-match') }}">Find a Match</a></li>
               <li class="active"><a>Search Results</a></li>
            </ul>

            <div class="row find">
               <div class = "col-md-7 col-sm-7 col-xs-10 col-md-offset-1">
                  <div class="row">
                     @if(@$users)
                     @if(count($users) > 0)
                     @foreach($users as $user)
                        <div class="search-result col-md-12">
                           
                           <div class="col-md-10 col-xs-12">
                              <a href="{{ url('/user/user-profile').'/'.$user->id }}">
                              	<h2 class="view">{{ $user->name }}</h2>
                                 <div class="description custom_description">
                                    <span class="htt">{{ url('/').'/user/'.$user->name }}</span>
                                    @if($user->month)
                                       <b>Date Of Birth:</b> {{ $user->month.'/'.$user->day.'/'.$user->year }}
                                    @endif
                                    @if($user->sex)
                                       <b>Gender:</b> {{ $user->sex }}
                                    @endif
                                    @if( $user->UserCity )
                                       <b>City:</b> {{ $user->UserCity->city_name }}
                                    @endif
                                 </div>
                                 
                                 <div class="description row" style="margin-top: 5px;"> 
                                    {{--@if($user->live_in)
                                       <div class="col-md-12">
                                          <b>Lives In:</b> {{ $user->state }}
                                       </div>
                                    @endif--}}

                                    @if($user->looking_for)
                                       <div class="col-md-12">
                                          <b>Looking to Date:</b> {{ $user->looking_for }}
                                       </div>
                                    @endif
                                 </div>
                              </a>
                           </div>
                        </div>
                     @endforeach
                        <div class="col-md-12">
                           @if(@$users)
                              {{-- $users->appends(['sex' => $sex])->links() --}}
                           @endif
                        </div>
                        @else
                           <div class="col-md-12 text-left" style="margin-top: 10px;">No records found</div>
                        @endif   
                        @endif
                     
                  </div>
               </div>
            </div>
      </div>

   </div>

</div>

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
         //console.log(value);
         if(value == 'USA')
         {
            $.ajax({
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

{{-- advance search start --}}
<script type="text/javascript">
function registerCountries(value) 
{
   if( value == 'USA' )
   {
      $('#custom_not_usa').hide();
      $('#custom_usa').show();
      $('.custom_interested_in').show();
   }
   
   if( value == 'Europe' )
   {
      $('#custom_not_usa').show();
      $('.custom_interested_in').show();
      $.ajax ( {
         url:  "{{ url('/get_europe_cities') }}",
         method: 'GET',
         data : {'continent':value},
         success: function(getcities) {
            if(getcities){
               $('#adv_search_city').html(getcities);
            }
         }
      });
   }

   var value1 = $('#europecountries').val();
   if( value == 'England' || value == 'Canada' )
   {
      $('#custom_not_usa').show();
      $('.custom_interested_in').show();

      $.ajax ( {
         url:  "{{ url('/getcities') }}",
         method: 'GET',
         data : {'continent':value},
         success: function(getcities){
            if(getcities){
               $('#adv_search_city').html(getcities);
            }
         }
      });
   }
}

/*$(window).load(function() {
   registerCountries($('#register_countries').val());
});*/

jQuery(document).ready(function(){
   $('#register_countries').change(function() {
      var value = $(this).val();
      //$('#adv_search_states').html('<option value="">Select State:</option>');
      $('#adv_search_city').html('<option value="">Select City</option>');
      //$('#adv_search_state').hide();
      $('#custom_usa').hide();
      $('#custom_not_usa').hide();
      $('.custom_interested_in').hide();

      registerCountries(value);
   });
   
});

/*$('#adv_search_interested_in').on('change', function(e)
{
    $(this).closest('form').submit();
});*/
</script>
{{-- advance search end --}}

@endsection