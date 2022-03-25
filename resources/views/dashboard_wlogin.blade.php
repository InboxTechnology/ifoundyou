@extends('layouts.full_dashboard_wlogin')

@section('content')
<!-- @if (session('success'))
<div class="alert alert-success" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
    <strong>Success! </strong>
    <span>{{ Session::get('success') }}</span>
</div>
@endif
 --><ul class="nav-inner">
    <!-- <li class="active"><a href="/user/dashboard">Home</a></li> -->
    <li><a href="{{ url('/user/dashboard') }}">Home</a></li>
    <!-- <li><a href="{{ url('/user/dashboard') }}">Dashboard</a></li> -->
    <li class="active"><a href="{{ url('/find-match') }}">Find Match</a></li>

</ul>

<ul class="app-links about-my-match-dash">
<!--     <li><a href="{{ url('/user/account-info') }}"><img src="{{ asset('public/img/account icon.png') }}">Account</a></li>
    <li><a href="{{ url('/user/cafe-members') }}"><img src="{{ asset('public/img/meet members icon.png') }}">Cafe Members</a></li>
    <li><a href="{{ url('/user/search-cafes') }}"><img src="{{ asset('public/img/cafe locator icon.png') }}">Café Search</a></li>-->
    <!-- {{Session::get('find_match')}} -->
    <li><a href="{{ url('/about-me') }}"><img src="{{ asset('public/img/about my match.png') }}">About Me</a></li>
    <li>
      <a href="JavaScript:Void(0)" data-aboutme="@if(Auth::user()){{Auth::user()->about_me_details}}@endif" id="myBtn" ><img src="{{ asset('public/img/my match.jpg') }}">My Match
      </a>
    </li>
    {{--<li>
      <a href="{{ url('/custom') }}" ><img style="width: 164px !important;" src="{{ asset('public/img/find-match.png') }}">Find Match
      </a>
    </li>--}}
     <!-- <li class="find"><a href="{{ url('/custom') }}" ><img style="width: 164px !important;" src="{{ asset('public/img/find-match.png') }}"></a></li> -->

     <!-- <li><a href="{{ url('/custom') }}"><img src="{{ asset('public/img/member search icon.png')}}">Search</a></li> -->
     <?php //if(Session::get('find_match')) {
      // Session::forget('find_match');
      ?>
     <li><a href="{{ url('/user/dashboard') }}"><img style="width: 150px !important;" src="{{ asset('public/img/dashboard.png') }}">Main Dashboard</a></li>
   <?php //} ?>
    <!-- <button type="button" class="btn btn-info btn-lg" >Open Modal</button> -->
    <!-- <li><a href="#"><img src="{{ asset('public/img/calendar icon.png') }}">Calendar</a></li> -->
    <!-- <li><a href="#"><img src="{{ asset('public/img/event icon.png') }}">Calender Event</a></li> -->
    <!-- <li><a href="https://ifoundyou.clothing"><img src="{{ asset('public/img/clothing icon.png') }}">Clothing</a></li> -->
    <!-- <li><a href="{{ url('/user/leaving') }}"><img src="{{ asset('public/img/clothing icon.png') }}">Clothing</a></li> -->
    <!-- <li><a href="#"><img src="{{ asset('public/img/cruise icon.png') }}">Cruise</a></li> -->
    <!-- <li><a href="{{ url('/user/edit-user-profile') }}"><img src="{{ asset('public/img/account personalization icon.png') }}">Edit Profile</a></li> -->
    <!-- <li><a href="{{ url('/logout') }}"><img src="{{ asset('public/img/logout.png') }}">Logout</a></li> -->
    <!-- <li><a href="{{ url('/user/match') }}"><img src="{{ asset('public/img/match.png') }}">Match</a></li> -->
    <!-- <li><a href="{{ url('/user/mycafe') }}"><img src="{{ asset('public/img/match.png') }}">My Cafe</a></li> -->
    <!-- <li><a href="{{ url('/user/mailbox') }}"><img src="{{ asset('public/img/email icon.png') }}">Mailbox</a></li> -->
<!--     <li><a href="{{ url('/user/user-profile') }}"><img src="{{ asset('public/img/view-profile.png') }}">My Profile</a></li>
    <li><a href="{{ url('/user/change-photo') }}"><img src="{{ asset('public/img/images icon.png') }}">My Profile Photo</a></li>
    <li><a href="{{ url('/user/numerology') }}"><img src="{{ asset('public/img/Numerology.jpg') }}">Numerology</a></li>
 -->    
    <!-- <li><a href="#"><img src="{{ asset('public/img/privacy.png') }}">Privacy</a></li> -->
    <!-- <li><a href="{{ url('/user/search-member') }}"><img src="{{ asset('public/img/member search icon.png') }}">Search</a></li> -->
    <!-- <li><a href="{{ url('/user/search-cafes') }}"><img src="{{ asset('public/img/cafe locator icon.png') }}">Café Search</a></li> -->
    <!-- <li><a href="{{ url('/terms') }}"><img src="{{ asset('public/img/terms.png') }}">Terms of Service</a></li> -->
    <!-- {{-- <li><a href="#"><img src="{{ asset('public/img/phone icon.png') }}">Phone</a></li> --}} -->
    <!-- <li><a href="#"><img src="{{ asset('public/img/setting.png') }}">Setting</a></li> -->
    <!-- <li><a href="#"><img src="{{ asset('public/img/train.jpg') }}">Train</a></li> -->
    <!-- <li><a href="#"><img src="{{ asset('public/img/word.png') }}">Word</a></li> -->
</ul>
<div>
            @if(@$users)
               @if(count($users) > 0)
               @foreach($users as $user)
                {{$user}}
               <div class="search-result">
                  @if($user->name)
                  <h2><a class="view" href="{{ url('/user/user-profile').'/'.$user->id }}"> {{ $user->name }} </a></h2>
                  <a href="{{ url('/user/user-profile').'/'.$user->id }}" class="htt">{{ url('/').'/user/'.$user->name }}</a>
                  @else
                  <h2><a class="view" href="{{ url('/user/user-profile').'/'.$user->id }}"> {{ $user->email }} </a></h2>
                  <a href="{{ url('/user/user-profile').'/'.$user->id }}" class="htt">{{ url('/').'/user/'.str_limit($user->email,5) }}</a>
                  @endif 
                  <div class="description" style="margin-top: 5px;">
                     <!-- <p>@if($user->sex)<b>Gender: </b>{{ $user->sex }}@endif --> 
                     @if($user->live_in) , <b>Lives In:</b> {{ $user->state }}@endif
                   <!--   @if($user->looking_for) , <b>Looking For:</b> {{ $user->looking_for }} @endif</p>
                     @if($user->type_of_relationship)<p> {{ 'I am Looking For '. $user->type_of_relationship }} </p>@endif
                     @if($user->activity) <p>{{ 'I Like '. str_limit($user->activity,150) }} </p>@endif -->
                  </p></div>
                </div>
                @endforeach
                @else
                <div class="row text-center">No records found</div>
                @endif   
            @endif
</div>



  <!-- Modal -->
  <div style="background: none !important;" class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Please Fill About me First</h4>
        </div>
        <!-- <div class="modal-body">
          <p>Some text in the modal.</p>
        </div> -->
        <div class="modal-footer">
          <button type="button" class="btn btn-default mybt" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

    <script>
      $(document).ready(function(){
        $("#myBtn").click(function(){
           var unfill = ($(this).attr('data-aboutme'));
           // console.log(unfill);
           // if(unfill == '') {
           //    console.log("empty");
           // }
           // return false;
            if(unfill == 'unfill' || unfill == ''){
              // alert('Please Fill About me First');
              $("#myModal").modal();
            }
            else{
              window.location.href = '{{url("/findmatch")}}';
            }
        });
      });
    </script>
    <style>
      /*.mybt{
        background-color: #ff000096 !important;
        border-color: white !important;
      }*/

      .mybt:hover{
        color: black !important;
        background: white;
      }

      .mybtn:active:hover{
        background-color: white;
      }
      .icon{
        color: #c48326;
        max-width: 154px;
        border: 3px solid #c48326;
        border-radius: 71px;
        margin: auto;
        height: 142px;
      }

      .custom{
        font-size: 107px !important;
        padding-top: 9px;
      }


      .find{
      margin-bottom: -29px !important;
    }

    .find  img {
      width: 157px !important;
    }
    </style>
@endsection