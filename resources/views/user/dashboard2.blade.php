@extends('layouts.full_dashboard_user')

@section('content')
@if (session('success'))
<div class="alert alert-success" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
    <strong>Success! </strong>
    <span>{{ Session::get('success') }}</span>
</div>
@endif
	<style type="text/css">
		.find{
			margin-bottom: -29px !important;
		}

		.find  img {
			width: 162px !important;
		}
        .block-al {padding: 0px 20px 0 10px;}
        .nav-inner{margin: -15px 15px 0 25px;float: left;width: 100%;}
        /*.nav-inner li, .nav-inner li:first-child{padding: 0px 10px;}*/
        .logo-dashboard img {margin-top: 30px;}

        .ro{
    padding-top: 0px !important;
    margin: 0px !important;
    font-family: verdana;
    font-size: 18px !important;
    color: black !important;
    border: none !important;
}

.lii{
    float: right !important;
    width: auto !important;
    margin-top: 0px !important;
}

.main-content-area{
    background: no-repeat !important;
    }

    .in-nv{
        margin-left: 21px !important;
    }
	</style>

<!-- start EDIT-CODE-PAV -->
<!-- @if (session('find_match'))
<input type="hidden" name="" id="find_match_session" value="{{ Session::get('find_match') }}">
@endif
<script type="text/javascript">
    jQuery(document).ready(function(){
        if (jQuery('#find_match_session').val() != '' && jQuery('#find_match_session').val() != null ) {
            window.location.href= "/find-match";
        }
    })   
</script>
 --><!-- end -->


<ul class="nav-inner in-nv">
    <li class="active"><a {{--href="{{ url('/advance-search-result') }}"--}}>Home</a></li>
    <li class="lii"><a href="{{url('/log')}}" class="ro"  id="">Sign in</a></li>
    <!-- <li class="active"><a href="/user/dashboard">Dashboard</a></li> -->
</ul>

<ul class="app-links">
    <li><a href="{{ url('/user/account-info') }}"><img src="{{ asset('public/img/Account-3009.png') }}">{{-- Account --}}</a></li>
    {{--<li><a href="{{ url('/user/search-member') }}"><img src="{{ asset('public/img/member search icon.png') }}">Advance Search</a></li>--}}
    <li><a href="{{ url('/user/cafe-members') }}"><img src="{{ asset('public/img/CAFE-MEMBERS-300.png') }}">{{-- Cafe Members --}}</a></li>
    <li><a href="{{ url('/user/search-cafes') }}"><img src="{{ asset('public/img/CAFE-SEARCH300.png') }}">{{-- Café Search --}}</a></li>
<!--     <li><a href="{{ url('/find-match') }}"><img src="{{ asset('public/img/my match.jpg') }}">My Match</a></li>
    <li><a href="{{ url('/about-me') }}"><img src="{{ asset('public/img/about my match.png') }}">About Me</a></li> -->
    <!-- <li><a href="#"><img src="{{ asset('public/img/calendar icon.png') }}">Calendar</a></li> -->
    <!-- <li><a href="#"><img src="{{ asset('public/img/event icon.png') }}">Calender Event</a></li> -->
    <!-- <li><a href="https://ifoundyou.clothing"><img src="{{ asset('public/img/clothing icon.png') }}">Clothing</a></li> -->
    <li><a href="{{ url('/user/leaving') }}"><img src="{{ asset('public/img/CLOTHING-300.png') }}">{{-- Clothing --}}</a></li>
    
    <li><a href="{{ url('/user/user-match-info') }}"><img src="{{ asset('public/img/EDIT-PROFILE-300.png') }}">{{-- Edit Profile --}}</a></li>
    {{--<li class="find"><a href="{{ url('/user/custom') }}" ><img src="{{ asset('public/img/Find Match.png') }}">Find Match</a></li>--}}
    <li><a href="{{ url('/find-a-match') }}" ><img src="{{ asset('public/img/FIND-MATCH-300.png') }}">{{-- Find Match --}}</a></li>
    
    <!-- <li><a href="{{ url('/user/match') }}"><img src="{{ asset('public/img/match.png') }}">Match</a></li> -->
    <li><a href="{{ url('/user/mycafe') }}"><img src="{{ asset('public/img/MY-CAFE-300.png') }}">{{-- My Cafe --}}</a></li>
    <!-- <li><a href="{{ url('/user/mailbox') }}"><img src="{{ asset('public/img/email icon.png') }}">Mailbox</a></li> -->
    <li><a href="{{ url('/user/user-profile') }}"><img src="{{ asset('public/img/MY-PROFILE-300.png') }}">{{-- My Profile --}}</a></li>
    <li><a href="{{ url('/user/change-photo') }}"><img src="{{ asset('public/img/MY-PROFILE-PHOTO-300.png') }}">{{-- My Profile Photo --}}</a></li>
    <li><a href="{{ url('/user/numerology') }}"><img src="{{ asset('public/img/NUMEROLOGY-300.png') }}">{{-- Numerology --}}</a></li>
    
    <!-- <li><a href="#"><img src="{{ asset('public/img/privacy.png') }}">Privacy</a></li> -->
    <!-- <li><a href="{{ url('/user/search-cafes') }}"><img src="{{ asset('public/img/cafe locator icon.png') }}">Café Search</a></li> -->
    {{--<li><a href="#"><img src="{{ asset('public/img/cruise.png') }}">Single Cruises</a></li>--}}
    <li><a href="{{ url('/user/terms') }}"><img src="{{ asset('public/img/TERMS-OF-SERVICE-300.png') }}">{{-- Terms of Service --}}</a></li>
    <li><a href="{{ url('/logout') }}"><img src="{{ asset('public/img/LOGOUT-300.png') }}">{{-- Logout --}}</a></li>
    {{-- <li><a href="#"><img src="{{ asset('public/img/phone icon.png') }}">Phone</a></li> --}}
    <!-- <li><a href="#"><img src="{{ asset('public/img/setting.png') }}">Setting</a></li> -->
    <!-- <li><a href="#"><img src="{{ asset('public/img/train.jpg') }}">Train</a></li> -->
    <!-- <li><a href="#"><img src="{{ asset('public/img/word.png') }}">Word</a></li> -->
</ul>



@endsection
