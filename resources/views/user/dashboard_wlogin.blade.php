@extends('layouts.full_dashboard')

@section('content')
<!-- @if (session('success'))
<div class="alert alert-success" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
    <strong>Success! </strong>
    <span>{{ Session::get('success') }}</span>
</div>
@endif
 --><ul class="nav-inner">
    <li class="active"><a href="/user/dashboard">Home</a></li>
</ul>

<ul class="app-links">
    <li><a href="{{ url('/user/account-info') }}"><img src="{{ asset('public/img/account icon.png') }}">Account</a></li>
    <li><a href="{{ url('/user/cafe-members') }}"><img src="{{ asset('public/img/meet members icon.png') }}">Cafe Members</a></li>
    <li><a href="{{ url('/user/search-cafes') }}"><img src="{{ asset('public/img/cafe locator icon.png') }}">Café Search</a></li>
<!--     <li><a href="{{ url('/find-match') }}"><img src="{{ asset('public/img/my match.jpg') }}">My Match</a></li>
    <li><a href="{{ url('/about-me') }}"><img src="{{ asset('public/img/about my match.png') }}">About Me</a></li> -->
    <!-- <li><a href="#"><img src="{{ asset('public/img/calendar icon.png') }}">Calendar</a></li> -->
    <!-- <li><a href="#"><img src="{{ asset('public/img/event icon.png') }}">Calender Event</a></li> -->
    <!-- <li><a href="https://ifoundyou.clothing"><img src="{{ asset('public/img/clothing icon.png') }}">Clothing</a></li> -->
    <li><a href="{{ url('/user/leaving') }}"><img src="{{ asset('public/img/clothing icon.png') }}">Clothing</a></li>
    <!-- <li><a href="#"><img src="{{ asset('public/img/cruise icon.png') }}">Cruise</a></li> -->
    <li><a href="{{ url('/user/edit-user-profile') }}"><img src="{{ asset('public/img/account personalization icon.png') }}">Edit Profile</a></li>
    <li><a href="{{ url('/logout') }}"><img src="{{ asset('public/img/logout.png') }}">Logout</a></li>
    <!-- <li><a href="{{ url('/user/match') }}"><img src="{{ asset('public/img/match.png') }}">Match</a></li> -->
    <li><a href="{{ url('/user/mycafe') }}"><img src="{{ asset('public/img/match.png') }}">My Cafe</a></li>
    <!-- <li><a href="{{ url('/user/mailbox') }}"><img src="{{ asset('public/img/email icon.png') }}">Mailbox</a></li> -->
    <li><a href="{{ url('/user/user-profile') }}"><img src="{{ asset('public/img/view-profile.png') }}">My Profile</a></li>
    <li><a href="{{ url('/user/change-photo') }}"><img src="{{ asset('public/img/images icon.png') }}">My Profile Photo</a></li>
    <li><a href="{{ url('/user/numerology') }}"><img src="{{ asset('public/img/Numerology.jpg') }}">Numerology</a></li>
    
    <!-- <li><a href="#"><img src="{{ asset('public/img/privacy.png') }}">Privacy</a></li> -->
    <li><a href="{{ url('/user/search-member') }}"><img src="{{ asset('public/img/member search icon.png') }}">Search</a></li>
    <!-- <li><a href="{{ url('/user/search-cafes') }}"><img src="{{ asset('public/img/cafe locator icon.png') }}">Café Search</a></li> -->
    <li><a href="{{ url('/terms') }}"><img src="{{ asset('public/img/terms.png') }}">Terms of Service</a></li>
    {{-- <li><a href="#"><img src="{{ asset('public/img/phone icon.png') }}">Phone</a></li> --}}
    <!-- <li><a href="#"><img src="{{ asset('public/img/setting.png') }}">Setting</a></li> -->
    <!-- <li><a href="#"><img src="{{ asset('public/img/train.jpg') }}">Train</a></li> -->
    <!-- <li><a href="#"><img src="{{ asset('public/img/word.png') }}">Word</a></li> -->
</ul>

@endsection
