@extends('layouts.full_dashboard_user')

@section('content')

<style>
    .row_flex{
        display: flex;
        flex-wrap: wrap;
        border: 1px solid rgba(0,0,0,.2);
        background-color: #deeff5;
    }
    .nav-inner {
        margin: 0px 15px;
    }
    .custom_col{
        background-color: #fff;
        border: 1px solid rgba(0,0,0,.2);
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 px-0">
            <ul class="nav-inner">
                <li class="active">
                    <a href="{{ url('/user/login_match_info') }}">Home</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="row justify-content-center row_flex mt-35 ml-0 mr-0 pt-10 pb-10">        
        <div class="col-md-6 custom_col">
            <form method="POST" action="{{ route('login') }}" id="signin-form">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="mt-35">Basic Details</h4>
                        <hr class="mt-0">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-3">
                        <label>Name <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-md-9">
                        <input type="text" id="name" name="name" class="form-control" value="" required>
                        
                        @if( $errors->has('name') )
                            <span class="red-span-error" id="name_error">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-3">
                        <label>Address <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-md-9">
                        <input type="text" id="address" name="address" class="form-control" value="" required>
                        
                        @if( $errors->has('address') )
                            <span class="red-span-error" id="address_error">{{ $errors->first('address') }}</span>
                        @endif
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-3">
                        <label>Location <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-md-9">
                        <input type="text" id="location" name="location" class="form-control" value="" required>
                        <span>start typing your location and use the autocomplete box.</span>
                        
                        @if( $errors->has('location') )
                            <span class="red-span-error" id="location_error">{{ $errors->first('location') }}</span>
                        @endif
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-3">
                        <label>Email Address <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-md-9">
                        <input type="email" id="email_address" name="email_address" class="form-control" value="" required>
                        <span>You will receive an email from us as soon as you singup to confirm your account.</span>
                        
                        @if( $errors->has('email_address') )
                            <span class="red-span-error" id="email_address_error">{{ $errors->first('email_address') }}</span>
                        @endif
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-3">
                        <label>Password <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-md-9">
                        <input type="password" id="password" name="password" class="form-control" value="" required>
                        <input type="checkbox" id="hide_password" name="hide_password">
                        <span>Hide password while typing it in the input above?</span>
                        
                        @if( $errors->has('password') )
                            <span class="red-span-error" id="password_error">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <h4 class="mt-45">Billing Information</h4>
                        <hr class="mt-0">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-3">
                        <label>Plan <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-md-9">
                        <select id="plan" name="plan" class="form-control">
                            <option> Standard - $24.95 (Monthly - Recurring )</option>
                        </select>
                        
                        @if( $errors->has('plan') )
                            <span class="red-span-error" id="plan_error">{{ $errors->first('plan') }}</span>
                        @endif
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-3">
                        <label>Payment Method <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-md-9">
                        <input type="radio" id="payment_method" name="payment_method">
                        
                        @if( $errors->has('payment_method') )
                            <span class="red-span-error" id="payment_method_error">{{ $errors->first('payment_method') }}</span>
                        @endif
                    </div>
                </div>

                <div class="row form-group text-right">
                    <input type="submit" id="btnFinish" name="btnFinish" value="Finish" class="btn btn-primary">   
                </div>
            </form>
        </div>
    </div>
</div>

@endsection