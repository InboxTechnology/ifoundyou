@extends('layouts.app')

@section('content')
<style type="text/css">
    main .container {min-height: auto;}
    .form-box label{font-size: 16px;}
</style>

<div class="container-fluid pd-none">
    <div class="ct-acct">
        <div class="container px-0">
            <ul class="nav-inner ml-0 mr--15 mb-10">
                <li class="active"><a href="{{ url('/') }}">Home</a></li>
            </ul>
        </div>
        
        <div class="modal-login">
            <div class="modal-dialog form-box ct-form">
                    <div class="modal-content">
                        <div class="modal-header">
                            {{-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> --}}
                            <a href="{{ url('/') }}">
                                <h4 class="modal-title" id="myModalLabel"><img src="{{ asset('public/img/logo.png') }}"></h4>
                            </a>
                        </div>
                        <div class="modal-body">
                            @if (session('failure'))
                            <p class="red-span-error">
                                {{ session('failure') }}
                            </p>
                            @endif
                            @if (session('success'))
                            <p class="blue-span">
                                {{ session('success') }}
                            </p>
                            @endif
                            <form id="forget-form" method="post" action="{{ url('forget-password') }}">
                                @csrf
                                <div class="form-group">
                                    <div class="log-form">
                                        <div class="form-group">
                                            <label>Email address</label>
                                            <input type="email" name="email" class="form-control" placeholder="" id="forget-email">
                                            <span class="red-span-error" id="email_error"></span>
                                        </div>
                                        <div class="form-group text-center">
                                            <input type="submit" name="" value="Submit" id="forget-pass-btn">   
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        {{--<div class="modal-footer">

                        </div>--}}
                    </div>
                </div>
    </div>
</div>
@endsection
