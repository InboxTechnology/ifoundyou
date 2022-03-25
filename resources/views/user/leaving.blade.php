@extends('layouts.full_dashboard')

@section('content')

<style type="text/css">
    .he{
        padding: 0px !important;
    }
    .nav-inner li a{
        color: black !important;
    }

    .nav-inner{
        margin: 0px 17px !important;
    }

    .ct{
        padding: 0px !important;
    }
</style>
</style>

<div class="col-md-12 col-sm-12 col-xs-12 he">

    <ul class="nav-inner">
        <li><a href="{{ url('/user/login_match_info') }}">Home</a></li>
        <!-- <li><a href="/user/dashboard">Dashboard</a></li> -->
        <!-- <li class="active"><a href="{{ url('/user/leaving')}}">Leaving ifoundyou</a></li> -->
        <li class="active"><a href="javascript:;">Leaving ifoundyou</a></li>
    </ul>
    
    <div class="container ct">
    <div style="background:#f1f9f9;height:500px;width:90%;margin-top:30px">
        <h4 style="position:relative;top:20px;left:10px;">You are leaving ifoundyou. You will be subject to new website privacy and terms of service.  

        <a target="_blank" onclick="window.location.href = 'https://www.ifoundyou.clothing'" href="https://ifoundyou.clothing"  style="background:#0071e0" class="btn btn-primary">Yes</a>  &nbsp;

        <a href="{{ url('user/login_match_info') }}" class="btn btn-primary" style="background:#0071e0" >No</a></h4>
    </div>
    </div>
    
</div>

@endsection
