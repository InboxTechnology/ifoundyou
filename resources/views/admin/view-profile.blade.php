@extends('layouts.admin_dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">User Profile</div>

                <div class="panel-body">
                   <div class="container-fluid">
                    <div class="mg-topal">
                        <div class="col-md-3 col-sm-12 col-xs-12">
                            <div class="user-panelleft">
                                <span class="online-user"></span>
                                @if($userDetail->image)
                                <img src='{{ url('public/img').'/'.$userDetail->image }}' class="img-responsive center-block user-image">
                                @else
                                <img src="{{ url('/public/img/profile-user.png')}}" class="img-responsive center-block user-image">
                                @endif  
                                <h3 class="text-center">{{ title_case($userDetail->name) }}</h3>
                            </div>
                        </div>
                        <div class="col-md-9 col-sm-12 col-xs-12">
                            <div class="right-userdetails">
                                <div class="col-md-4 col-sm-12 col-xs-12">
                                    <h3>Identity</h3>
                                    <ul>
                                        <li><span>Name:</span>{{ $userDetail->name }}</li>
                                        <li><span>Date Of Birth:</span>{{ $userDetail->month.'/'.$userDetail->day.'/'.$userDetail->year }}</li>
                                        <li><span>I was born in:</span>@if($userDetail->UserState) {{ $userDetail->UserState->nstate }} @endif</li>
                                        <li><span>Gender:</span>{{ $userDetail->sex }}</li>
                                        <li><span>Looking to Date:</span>{{ $userDetail->looking_for }}</li>
                                    </ul>
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12">
                                    <h3>Looks</h3>
                                    <ul>
                                        <li><span>Ethnicity:</span>{{ $userDetail->ethnicity }}</li>
                                        <li><span>Height:</span>{{ $userDetail->height }}</li>
                                        <li><span>Hair Color:</span>{{ $userDetail->haircolor }}</li>
                                        <li><span>Language:</span>{{ $userDetail->language }}</li>
                                        <li><span>Body Type:</span>{{ $userDetail->bodytype }}</li>
                                        <li><span>Eye Color:</span>{{ $userDetail->eyecolor }}</li>
                                        <li><span>Gender:</span>{{ $userDetail->sex }}</li>
                                        <li><span>Relegion:</span>{{ $userDetail->religion }}</li>
                                    </ul>
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12">
                                    <h3>Horoscope</h3>
                                    <ul>
                                        <li><span>Chinese Sign:</span>{{ $userDetail->chinese_sign }}</li>
                                        <li><span>Wester Sign:</span>{{ $userDetail->western_sign }}</li>
                                    </ul>
                                    <h4>{{ 'IFY-'.$userDetail->state.'-'.$userDetail->datepoint.'-'.str_pad($userDetail->id, 4, '0', STR_PAD_LEFT) }}</h4>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <h3>About my match</h3>
                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                        <ul>
                                            <li><span>Ethnicity:</span>{{ $userDetail->about_ethnicity }}</li>
                                            <li><span>Height:</span>{{ $userDetail->about_height }}</li>
                                            <li><span>Hair Color:</span>{{ $userDetail->about_haircolor }}</li>
                                            <li><span>Language:</span>{{ $userDetail->about_language }}</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                        <ul>
                                            <li><span>Body Type:</span>{{ $userDetail->about_bodytype }}</li>
                                            <li><span>Eye Color:</span>{{ $userDetail->about_eyecolor }}</li>
                                            <li><span>Gender:</span>{{ $userDetail->about_gender }}</li>
                                            <li><span>Relegion:</span>{{ $userDetail->about_religion }}</li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <h3>I am Looking For</h3>
                                    <div>{{ $userDetail->type_of_relationship }}</div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <h3>I Like</h3>
                                    <div>{{ $userDetail->activity }}</div>
                                </div>
                                <div class="col-md-12 col-dm-12">
                                    @if($userDetail->UserLoc)
                                    <h3>My Cafe Location</h3> 
                                    <iframe
                                    width="100%"
                                    height="450"
                                    frameborder="0" style="border:0"
                                    src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBGO8o4JyybRaVx409C2tNowstVKD42FFU&q={{ urlencode($userDetail->UserLoc->store_name.','.$userDetail->UserLoc->address_line_1.','.$userDetail->UserLoc->city.','.$userDetail->UserLoc->state.','.$userDetail->UserLoc->zip_code) }}" allowfullscreen>
                                </iframe>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection