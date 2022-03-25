@extends('layouts.full_dashboard_user')

@section('content')

    <ul class="nav-inner">
        <li class="active"><a href="{{ url('user/dashboard') }}">Home</a> </li>
    </ul>

    <ul class="app-links">
        <li>
            <a href="{{ url('/user/cafe-members') }}">
                <img src="{{ asset('public/img/cafe-members.png') }}">
                <span>Cafe Members</span>
            </a>
        </li>
        <li>
            <a href="{{ url('/user/search-cafes') }}">
                <img src="{{ asset('public/img/cafe-search.png') }}">
                <span>Cafe Search</span>
            </a>
        </li>

        <li>
            <a href="{{ url('/user/edit-profile-dashboard') }}">
                <img src="{{ asset('public/img/edit-profile.png') }}">
                <span>Edit Profile</span>
            </a>
        </li>
        <li>
            <a href="{{ url('/find-a-match') }}" >
                <img src="{{ asset('public/img/find-match.png') }}">
                <span>Find Match</span>
            </a>
        </li>
        <li>
            <a href="javascript:;">
                <img src="{{ asset('public/img/membership.png') }}">
                <span>Membership</span>
            </a>
        </li>
        <li>
            <a href="{{ url('/user/account-info') }}">
                <img src="{{ asset('public/img/my-account.png') }}">
                <span>My Account</span>
            </a>
        </li>
        <li>
            <a href="{{ url('/user/user-profile') }}">
                <img src="{{ asset('public/img/my-profile.png') }}">
                <span>My Profile</span>
            </a>
        </li>
        <li>
            <a href="{{ url('/user/change-photo') }}">
                <img src="{{ asset('public/img/my-profile-photo.png') }}">
                <span>My Profile Photo</span>
            </a>
        </li>
        <li>
            <a href="{{ url('/user/read-mail') }}">
                <img src="{{ asset('public/img/read-mail.png') }}">
                <span>Read Mail</span>
            </a>
        </li>
        <li>
            <a href="javascript:;">
                <img src="{{ asset('public/img/send-letter.png') }}">
                <span>Send Letter</span>
            </a>
        </li>
        <li>
            <a href="{{ url('/user/terms') }}">
                <img src="{{ asset('public/img/terms-of-services.png') }}">
                <span>Terms of Services</span>
            </a>
        </li>
        <li>
            <a href="javascript:;" data-toggle="modal" data-target="#logoutModal">
                <img src="{{ asset('public/img/log-out.png') }}">
                <span>Log Out</span>
            </a>
        </li>
    </ul>

@endsection
