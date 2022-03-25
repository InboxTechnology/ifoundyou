@extends('layouts.admin_layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Admin Login</div>
                @if (session('failure'))
                <div class="red-span-error text-center">
                    {{ session('failure') }}
                </div>                     
                @endif
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/login') }}" id="admin-login-form">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Email</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email"  value="{{ old('email') }}">

                                <span class="red-span-error" id="email_error">
                                    @if ($errors->has('email'))
                                    <strong>{{ $errors->first('email') }}</strong>
                                    @endif
                                </span>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                                <span class="red-span-error" id="pass_error">
                                    @if ($errors->has('password'))
                                    <strong>{{ $errors->first('password') }}</strong>
                                    @endif
                                </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary" id="admin-login-btn">
                                    Login
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection