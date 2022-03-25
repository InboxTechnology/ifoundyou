@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            <img src="{{ url('/public/img/logo.png') }}" width="210">
        @endcomponent
    @endslot

    {{-- Body --}}
    <b>Welcome to ifoundyou canada</b><br><br>
    Welcome to you {{ $user['email'] }}, thank you for joining <a href="{{ url('/') }}">ifoundyou canada</a>!<br><br>
    You are one step away from being able to login into ifoundyou canada. Click on the button to activate your account.<br>
    <!-- Body here -->
    
    {{-- Subcopy --}}
    @slot('subcopy')
        {{-- @component('mail::button', ['url' => url('/').'/login/'])
        Login
        @endcomponent --}}

        @component('mail::button', ['url' => url('/').'/activate/'.base64_encode($user['email'])])
        Activate Your Account
        @endcomponent

        We hope you enjoy your stay at <a href="{{ url('/') }}">ifoundyou</a><br><br>
        <b>Warm Regards</b>,<br>
        ifoundyou canada
    @endslot
    

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            <!-- footer here -->
            © {{ date('Y') }} ifoundyou canada. All rights reserved.
        @endcomponent
    @endslot
@endcomponent