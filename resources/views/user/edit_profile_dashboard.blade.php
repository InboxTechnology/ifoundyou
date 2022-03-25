@extends('layouts.full_dashboard_user')

@section('content')

<style type="text/css">
  .app-links li a{
    text-decoration: none !important;
  }
  .ro{
    padding-top: 0px !important;
    margin: 0px !important;
    font-family: verdana;
    font-size: 20px !important;
    color: black !important;
    border: none !important;
  }
  .lii{
      float: right !important;
      width: auto !important;
      margin-top: 0px !important;
  }
  .nav-inner {
      margin: 0px 2px !important;
      top: 15px;
      position: relative;
  }
 
  .nav-inner li a{
    color: black !important;
  }
  .about-match-img {
    padding:-18px !important;
    /* margin:-6px !important; */
    /*height:213px;*/
  }
  .main-content-area{
    padding-top: 7px;
  }
  .img_size{
    /* width: 240px !important; */
    /* height: 210px !important; */
  }
  ul.list-unstyled.list-inline {
    margin: 15px 10px;
    width: 100%;
    display: inline-block;
    border-bottom: 0px;
  }
  ul.list-custom{
    position: absolute;
    right: 0;
    bottom: 0;
    width: auto !important;
  }
  .tab-content {
    padding: 20px 5px;
  }
  .nav-tabs li a {
    border: 1px solid #dedede !important;
    box-shadow: 1px 5px 10px 5px #aaa;
    margin: 2px 10px;
    padding: 8px 15px;
    text-transform: capitalize;
    width: 210px;
    text-align: center;
  }
  .nav-tabs{
    border-bottom:0px !important;
  }
  .tab-content{
    /*box-shadow:1px 3px 11px #337ab7;*/
    margin-top:20px;
    margin-bottom: 60px;
    background-color: #fff;
    border: 2px solid rgba(61,70,77,0.1);
    border-top: 0px;
  }
  .edit-profile-tabs .active a{
    background-color: #337ab7 !important;
    color: white !important;
    box-shadow: 1px 1px 1px 3px #dedede !important;
  }
  .edit-profile-tabs{
    margin-top: 30px;
  }
  #selected-locations {
    display: none;
  }
  #selected-locations .text{
    text-decoration: underline;
  }
  #selected-area h3,#new-selected-area h3,.thank-you-style {
    color: #797979;
    font-size: 18px;
  }
  #imageUpload .cropit-preview {
    background-size: cover;
    margin-top: 7px;
    width: 250px;
    height: 250px;
    padding: 0px;
  }
  .image-area.cropit-preview > img {
    width: 100%;
    height: 100%;
    max-height: unset;
  }
  #imageUpload .cropit-preview-image-container {
    cursor: move;
  }
  #imageUpload .image-size-label {
    margin-top: 10px;
  }
  #imageUpload img.cropit-preview-image {
    width: 100%;
    height: 100%;
    transform: none !important;
    max-height: unset;
  }
  .list-inline{
    text-align: center;
  }
  #map_canvas {
    width: 100%;
    height: 100%;
  }
  #search-cafe-result li {
    cursor: pointer;
  }
  .location{
    margin-right: 5px !important;
  }
  .cus-colr{
      color: #2895f1;
  }
  input[type="file"]{
    width: auto;
    margin-top: 20px;
  }
  .nav-inner{
    margin: 0px;
  }
  .image_error{
    float: left;
    width: 100%;
    text-align: center !important;
    margin-top: 10px;
  }
  .uploaded_image{
    max-height: 200px;
  }
  .buttonparent{
    text-align: center !important;
    margin-top: 20px;
  }

  @media(max-width:767px) {
    .about-match-img {
      width:100% !important;
      margin:0 !important;
    } 
  }

  @media(max-width:640px){
    .app-links li img {
        margin: 0px auto !important;
    }
  }

  .nav-inner li .noho:hover{
  	border-bottom: none !important;
  }
</style>

  <div class="col-md-12 col-sm-12 col-xs-12">
    <ul class="nav-inner">
      <li><a href="{{ url('/user/dashboard') }}">Home</a></li>
      <li class="active"><a href="{{ url('/user/edit-profile-dashboard')}}">Edit Profile</a></li>
    </ul>

    <!-- foundwhere the changes are needed -->
    <div class="col-md-12 all" style="text-align: center; clear: both;">
      <ul class="app-links">
        <li class="about">
          <a href="{{ url('/user/about-me') }}" >
            <img  class="img_size" src="{{ asset('public/img/my-account.png') }}">
            <span>About Me</span>
          </a>
        </li>

        <li>
          <a  href="{{url('user/about-my-match')}}">
            <img  class="about-match-img img_size" src="{{ asset('public/img/about-my-match.png') }}">
            <span>About My Match</span>
          </a>
        </li>
        
        <li>
          <a href="{{ url('user/dashboard') }}">
            <img  class="img_size" src="{{ asset('public/img/home.png') }}">
            <span>Home</span>
          </a>
        </li>

        <li>
          <a href="{{ url('user/horoscope') }}">
            <img  src="{{ asset('public/img/horoscope.png') }}" class="img_size">
            <span>Horoscope</span>
          </a>
        </li>

        <li>
          <a href="{{ url('user/account-info') }}">
            <img class="img_size" src="{{ asset('public/img/my-account.png') }}">
            <span>My Account</span>
          </a>
        </li>

        <li>
          <a href="{{ url('user/mycafe') }}">
            <img  class="img_size" src="{{ asset('public/img/my-cafe.png') }}">
            <span>My Cafe</span>
          </a>
        </li>

        <li>
          <a href="{{ url('/user/user-profile') }}">
            <img class="img_size" src="{{ asset('public/img/my-profile.png') }}">
            <span>My Profile</span>
          </a>
        </li>

        <li>
          <a href="{{ url('/user/change-photo') }}">
            <img src="{{ asset('public/img/my-profile-photo.png') }}">
            <span>My Profile Photo</span>
          </a>
        </li>
      </ul>
    </div>

  </div>
@endsection