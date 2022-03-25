@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="modal-login">
                <div class="modal-dialog form-box home_login">

                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">
                                <img src="{{ asset('public/img/logo.png') }}">
                            </h4>
                        </div>

                        @if (!session('success'))
                            <h2>Sign in</h2>
                            <div class="text-center sub_title">
                              to continue to ifoundyou Account
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success mt-15 mb-35" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                <strong>Success ! </strong>
                                <span>{{ session('success') }}</span>
                            </div>
                        @endif

                        @if (session('failure'))
                            <div class="alert alert-danger mt-15" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                <strong>Warning ! </strong>
                                <span>{{ session('failure') }}</span>
                            </div>
                        @endif

                        @if (session('info'))
                            <div class="alert alert-success mt-15" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                <strong>Info ! </strong>
                                <span>{{ session('info') }}</span>
                            </div>
                        @endif

                        @if (session('warning'))
                            <div class="alert alert-danger mt-15" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                <strong>Warning ! </strong>
                                <span>{{ session('warning') }}</span>
                            </div>
                        @endif

                        @if (!session('success'))
                            <div class="row text-center px-20">
                                <div class="col-md-12 mt-20 mb-20">
                                    <a href="{{ url('/login/google') }}" class="btn_login_social d-flex justify-content-start align-items-center">
                                        <img src="{{ asset('public/img/google-icon.svg') }}" class="mr-10">
                                        <span class="socail_text text-center">Continue With Google</span>
                                    </a>
                                </div>

                                <div class="col-md-12">
                                    <div class="social_login_or">
                                        <span>OR</span>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-body">

                                @if ($errors->has('email'))
                                    <p class="red-span-error">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </p>
                                @endif
                                @if ($errors->has('password'))
                                    <p class="red-span-error">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </p>
                                @endif

                                <form method="POST" action="{{ route('login') }}" id="signin-form">
                                    @csrf
                                    <div class="form-group">
                                        <div class="log-form">
                                            <div class="form-group">
                                                <input type="hidden" name="user_loginID" value="{{app('request')->input('id')}}">
                                                <label class="em" for="login-email">Email</label>
                                                <input type="email" name="email" class="form-c" placeholder="" id="login-email" value="{{ session('email') }}">
                                                {{-- <a href="{{ url('/forgot') }}" id="forget-password" class="af frm-a">Forgot Email?</a> --}}
                                                
                                                <span class="red-span-error" id="email_error"></span>
                                            </div>
                                            <div class="form-group">
                                                <label class="em" for="login-password">Password</label>
                                                <input type="password" name="password" class="form-c" placeholder="" id="login-password">
                                                <span class="red-span-error" id="pass_error"></span>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <a href="{{ url('/forgot') }}" id="forget-password" class="af frm-a">Forgot Password?</a>
                                                    <a href="{{ url('/provinces-list') }}" class="af frm-a">Create an Account</a>
                                                </div>
                                                
                                                <div class="col-md-4 form-group text-center">
                                                    <input type="submit" name="" value="Next" id="sign-in-btn log-bt" class="inp">   
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
