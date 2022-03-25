<style type="text/css">
   /*.find{
      margin-right: 0px !important;
     margin-left: 0px !important;
   }
*//*   .text-center{
      text-align: left !important;
   }
*/
   .user{
      /*width: auto;*/
      /*padding: 0px;*/
      /*padding-top: 28px;*/
        padding-top: 12px;
        padding-left: 5px;
   }

   .yy1{
      padding-top: 5px !important;
   }

   .image-message{
      width: 72px !important;
      /*padding-top: 14px;*/
      padding-top: 0px !important;
   }

   .user-image1{
      border-radius: 100%;
      width: 70px;
      height: 70px;
      overflow: hidden;
      max-width: 250px;
      border: 1px solid #1f67b2;
      object-fit: cover;
   }

   .search-result{
      padding: 0px 10px;
      clear: both;
   }
   .allinfo{
        text-align: left;
        word-break: break-word;
   }

   .seemore{
    clear: both;
    text-align: center;
    background: #80808052;
    text-decoration: none;
    font-size: 20px;
   }

   .seemore a{
        color: black;
        font-family: cursive;
   }

   .seemore a:hover{
    text-decoration: none;
   }
</style>

@if(@$allusers)
    @if(count($allusers) > 0)
        <div class="search-results-div displaynone">
            <div class="modal_loader_wrap  renderDiv">
                @foreach($allusers as $user)
                    <div class="search-result col-md-12 col-xs-12 col-sm-12">
                        <div class="col-md-4 col-xs-6 user">
                            <i class="fa fa-search search-icon"></i>
                            {{-- @if(!empty($user->image))
                                <a class="view" href="{{ url('/user/user-profile').'/'.$user->id }}">
                                    <img src="{{ url('public/img').'/'.$user->image }}" class="user-image1 yy">
                                </a>
                            @else
                                <a class="view" href="{{ url('/user/user-profile').'/'.$user->id }}">
                                    <img class="image-message user-image yy1" src="https://ifoundyou.com/public/img/profile-user.png" data-toggle="popover" title="" data-placement="left">
                                </a>
                            @endif --}}
                        </div>
                        <div class="col-md-8 col-xs-6 allinfo">
                            @if($user->name)
                                <h2><a class="view" href="{{ url('/user/user-profile').'/'.$user->id }}"> {{ $user->name }} </a></h2>
                               <!--  <a href="{{ url('/user/user-profile').'/'.$user->id }}" class="htt">{{ url('/').'/user/'.$user->name }}</a> -->
                            @else
                                <h2><a class="view" href="{{ url('/user/user-profile').'/'.$user->id }}"> {{ $user->email }} </a></h2>
                                <!-- <a href="{{ url('/user/user-profile').'/'.$user->id }}" class="htt">{{ url('/').'/user/'.str_limit($user->email,5) }}</a> -->
                            @endif 
                            <div class="description" style="margin-top: 5px;"> 
                               @if($user->live_in)  <b>Lives In:</b> {{ $user->state }}@endif 
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="seemore">
                    @if(!empty($search_result))
                        @if(count($allusers) > 3)
                            <a href="{{url('user/all_user?search_result='.$search_result)}}" type="button" class="searchButton1">See More</a>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    @else
        <div class="search-results-div displaynone">
            <div class="modal_loader_wrap  renderDiv">
                <div class="row text-center">No records found</div>
            </div>
        </div>
    @endif   
@endif