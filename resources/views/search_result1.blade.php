@extends('layouts.app')
@section('content')
<div class="wrapper-cl">
   <div class="mg-toptwo">
      <div class="middle">
         <form method="post" action="{{ url('/search-result') }}">
            @csrf
            <div class="col-md-2 col-sm-2 col-xs-12">
               <select class="form-control" name="month" required>
                  <option value="">Month</option>
                  <option value="1" @if($parameters['month'] == '1') selected @endif>January</option>
                  <option value="2" @if($parameters['month'] == '2') selected @endif>February</option>
                  <option value="3" @if($parameters['month'] == '3') selected @endif>March</option>
                  <option value="4" @if($parameters['month'] == '4') selected @endif>April</option>
                  <option value="5" @if($parameters['month'] == '5') selected @endif>May</option>
                  <option value="6" @if($parameters['month'] == '6') selected @endif>June</option>
                  <option value="7" @if($parameters['month'] == '7') selected @endif>July</option>
                  <option value="8" @if($parameters['month'] == '8') selected @endif>August</option>
                  <option value="9" @if($parameters['month'] == '9') selected @endif>September</option>
                  <option value="10" @if($parameters['month'] == '10') selected @endif>October</option>
                  <option value="11" @if($parameters['month'] == '11') selected @endif>November</option>
                  <option value="12" @if($parameters['month'] == '12') selected @endif>December</option>
               </select>
               <span class="blue-span" style="color: #4295fb;">Enter Birthday</span>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-12">
               <select class="form-control" name="day" required>
                  <option value="">Day</option>
                  @for($day = 1; $day < 31; $day++)
                  <option @if($parameters['day'] == $day) selected @endif>{{ $day }}</option>
                  @endfor
               </select>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-12">
               <select class="form-control" name="year" required>
                  <option value="">Year</option>
                  <?php $curr_year = Carbon\Carbon::now()->format('Y'); ?>
                  @for($year = 1939; $year <= $curr_year; $year++)
                  <option @if($parameters['year'] == $year) selected @endif>{{ $year }}</option>
                  @endfor
               </select>
            </div>
            <div class="col-md-2 col-sm-2">
               <div class="form-group">
                  <select class="form-control" name="sex" required>
                     <option value="">Looking To Date</option>
                     <option value="All" @if($parameters['sex'] == 'All') selected @endif>All</option>
                     <option value="Bi Female" @if($parameters['sex'] == 'Bi Female') selected @endif>Bi Female</option>
                     <option value="Bi Male" @if($parameters['sex'] == 'Bi Male') selected @endif>Bi Male</option>
                     <option value="Gay Female" @if($parameters['sex'] == 'Gay Female') selected @endif>Gay Female</option>
                     <option value="Gay Male" @if($parameters['sex'] == 'Gay Male') selected @endif>Gay Male</option>
                     <option value="Female" @if($parameters['sex'] == 'Female') selected @endif>Straight Female</option>
                     <option value="Male" @if($parameters['sex'] == 'Male') selected @endif>Straight Male</option>
                  </select>
               </div>
            </div>
            <div class="col-md-4 col-sm-2 text-center btn-in">
               <input type="submit" name="" value="search" class="blue-btn">
               <a href="{{ url('/') }}" type="submit" name="" value="search" class="blue-btn">Back</a>
            </div>
            <div class="col-md-12">
            {{-- <div class="search-result">
               <h2><a class="view" href="" >testman (22/1/1981)</a></h2>
               <a href="" class="htt">http://ifoundyou.com/user/testman</a>
            </div>
            <div class="search-result">
               <h2><a class="view" href="" >testman (22/1/1981)</a></h2>
               <a href="" class="htt">http://ifoundyou.com/user/testman</a>
            </div>
            <div class="search-result">
               <h2><a class="view" href="" >testman (22/1/1981)</a></h2>
               <a href="" class="htt">http://ifoundyou.com/user/testman</a>
               <p>I am Looking For Activity Partner, Friendship, Pen Pal, Romance, Travel Partner I Like Book Stores, Yoga, Bowling, Swimming, Biking, Comedy Club</p>
            </div> --}}
            @if(count($users) > 0)
            @foreach ($users as $user)
               <div class="search-result">
                  @if($user->name)
                     <h2><a class="view" href="{{ url('/') }}/profile/{{ $user->id }}"> {{ $user->name }} </a></h2>
                     <a data="{{ url('/') }}/profile/{{ $user->id }}" class="htt">{{ url('/').'/user/'.$user->name }}</a>
                  @else
                     <h2><a class="view" href="{{ url('/') }}/profile/{{ $user->id }}"> {{ $user->email }} </a></h2>
                     <a data="{{ url('/') }}/profile/{{ $user->id }}" class="htt">{{ url('/').'/user/'.str_limit($user->email,5) }}</a>
                  @endif 
                  <div class="description" style="margin-top: 5px;">
                     <p>@if($user->sex)<b>Gender: </b>{{ $user->sex }}@endif @if($user->live_in) , <b>Lives In:</b> {{ $user->UserState->nstate }}@endif @if($user->looking_for) , <b>Looking For:</b> {{ $user->looking_for }} @endif</p>
                     @if($user->type_of_relationship)<p> {{ 'I am Looking For '. $user->type_of_relationship }} </p>@endif
                     @if($user->activity) <p>{{ 'I Like '. str_limit($user->activity,150) }} </p>@endif
                  </div>
               </div>
            @endforeach
            @else
               <div class="row text-center">No records found</div>
            @endif
         </div>
         <div class="col-md-12">
            {{ $users->links() }}
         </div>
      </form>
      </div>
   </div>
</div>
@endsection