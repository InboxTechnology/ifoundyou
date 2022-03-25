@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            <!-- header here -->
            <img src="{{ url('/public/img/logo.png') }}" width="210">
        @endcomponent
    @endslot

    {{-- Body --}}
    <b>Dear {{ $user['name'] }},</b><br><br>
    We received a request to email your password for your account:<span style="color: #0071e0; text-decoration: underline;">{{ $user['email'] }}</span>. We are here to help!<br><br> 
    Your Password is {{ $user['original_password'] }}<br><br>

    @slot('subcopy')
        If you didn't ask for your password,don't worry! Your password is still safe and you can delete this email.<br><br>
        <b>Warm Regards</b>,<br>
        ifoundyou
    @endslot
    {{-- Subcopy --}}
  

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            <!-- footer here -->
            © {{ date('Y') }} Ifoundyou. All rights reserved.
        @endcomponent
    @endslot
@endcomponent