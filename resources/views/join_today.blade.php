@extends('layouts.full_dashboard')

@section('content')
<style type="text/css">
  	.nav-inner{margin: 0 2px;}
  	.pay
	{
		display: block;
		padding: 10px 30px;
		text-transform: capitalize;
		letter-spacing: 1px;
		background-color: #0071e0;
		border: 1px solid #0071e0;
		color: #fff;
		text-align: center;
		margin: auto;
		margin-bottom: 16px;
	  border-radius:3px;
	}

	/*.stripe-button-el{
	  color:red !important;
	}*/
  .nav-inner li a {
    color: #000 !important;
  }
	.middle {margin-top: 40px;}
</style>

<div class="col-md-12 col-sm-12 col-xs-12">

  <ul class="nav-inner">
    <li><a href="{{ url('/user/dashboard/')}}">Home</a></li>
    <li><a href="{{ url('/user/user-profile/'.$userDetail->id)}}">MyProfile</a></li>
    <li class="active"><a href="javascript:;">Membership</a></li>
  </ul>

  <div class="wrapper-cl">

     <div class="container">

        <div class="row mg-toptwo">

            <div class="middle">

              <div class="pricing-div">

                 <div class="annually_box">

                    <h1>For Membership Annually</h1>

                    <div class="annually_text">

                       <div class="dolr">${{number_format($paypal_amount,2)}}</div>     

                       <p>Meet the right one the right way.</p>

                    </div><!-- annually_text -->

                    <!-- <div style="margin-bottom:25px;">&nbsp;</div> -->

                    <div class="annually_links">

                       <div><img src="{{ asset('public/img/chek.png') }}" alt=""> <span><a href="#">Admin Panel</a></span></div>

                       <div><img src="{{ asset('public/img/chek.png') }}" alt=""> <span><a href="#">Advertising Strategies</a></span></div>

                       <div><img src="{{ asset('public/img/chek.png') }}" alt=""> <span><a href="#">Cafe Assignment</a></span></div>

                       <div><img src="{{ asset('public/img/chek.png') }}" alt=""> <span><a href="#">Cafe Meeting</a></span></div>

                       <div><img src="{{ asset('public/img/chek.png') }}" alt=""> <span><a href="#">Friends Feature</a></span></div>

                       <div><img src="{{ asset('public/img/chek.png') }}" alt=""> <span><a href="#">Iphone Application</a></span></div>

                       <div><img src="{{ asset('public/img/chek.png') }}" alt=""> <span><a href="#">My own Mailbox</a></span></div>

                       <div><img src="{{ asset('public/img/chek.png') }}" alt=""> <span><a href="#">My own Profile</a></span></div>

                       <div><img src="{{ asset('public/img/chek.png') }}" alt=""> <span><a href="#">Ifoundyou Website</a></span></div>

                       <div><img src="{{ asset('public/img/chek.png') }}" alt=""> <span><a href="#">Search Engine</a></span></div>

                       <div><img src="{{ asset('public/img/chek.png') }}" alt=""> <span><a href="#">Tips and Strategies on Dating</a></span></div>

                       <div><img src="{{ asset('public/img/chek.png') }}" alt=""> <span><a href="#">Unique Matching</a></span></div>

                    </div>

                    <form action="/paypal/payments.php" method="post" id="paypal_form">
	                    <input type="hidden" name="cmd" value="_xclick" />
	                    <input type="hidden" name="no_note" value="1" />
	                    <input type="hidden" name="business" value="sb-7qdsl2962212@business.example.com">
	                    <input type="hidden" name="lc" value="UK" />
	                    <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" />
	                    <input type="hidden" name="first_name" value="{{ Auth::user()->name }}" />
	                    <input type="hidden" name="last_name" value="{{ Auth::user()->name }}" />
	                    <input type="hidden" name="payer_email" value="{{ Auth::user()->email }}" />
	                    <input type="hidden" name="item_number" value="IFYAM1901" / >
	                    <input type="hidden" name="custom" value="{{ Auth::user()->id }}">
	                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
	                    <input type="hidden" name="itemAmount" value="{{ number_format($paypal_amount,2) }}">
	                    <input type="hidden" name="return_url" value="{{ url('/user/user-profile/'.$userDetail->id) }}" id="return_url">
	                    <input type="hidden" id="cancel_url" name="cancel_url" value="{{ url('/join-today/'.$userDetail->id) }}">
	                    <input type="hidden" id="notify_url" name="notify_url" value="{{ url('/') }}">

	                    <input type="submit" class="pay" value="Submit Payment">
	                </form>
                    <!-- <button data-toggle="modal" data-target="#selectPaymentMethodModal" class="pay"style="width:75%;">Submit Payment</button> -->
  				
                </div>

              </div>

            </div>

        </div>

      </div>
  </div>

</div>

<!-- Modal Starts -->
  
<div id="selectPaymentMethodModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Select Payment Method</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          {{--<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
              <div class="card" style="width: 18rem; margin: 0 auto;">
                <img class="img-responsive card-img-top" src="{{asset('public/img/paypal.png')}}" alt="Paypal">
                <div class="card-body">
                  <!-- <p class="card-text">Paypal</p> -->
                  <form action="/paypal/payments.php" method="post" id="paypal_form">
                    <input type="hidden" name="cmd" value="_xclick" />
                    <input type="hidden" name="no_note" value="1" />
                    <input type="hidden" name="business" value="sb-7qdsl2962212@business.example.com">
                    <input type="hidden" name="lc" value="UK" />
                    <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" />
                    <input type="hidden" name="first_name" value="{{ Auth::user()->name }}" />
                    <input type="hidden" name="last_name" value="{{ Auth::user()->name }}" />
                    <input type="hidden" name="payer_email" value="{{ Auth::user()->email }}" />
                    <input type="hidden" name="item_number" value="IFYAM1901" / >
                    <input type="hidden" name="custom" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="itemAmount" value="{{ number_format($paypal_amount,2) }}">
                    <input type="hidden" name="return_url" value="{{ url('/user/user-profile/'.$userDetail->id) }}" id="return_url">
                    <input type="hidden" id="cancel_url" name="cancel_url" value="{{ url('/join-today/'.$userDetail->id) }}">
                    <input type="hidden" id="notify_url" name="notify_url" value="{{ url('/join-today/'.$userDetail->id) }}">

                    <input type="submit" class="pay" value="Paypal" style="margin-top: 20%;">
                  </form>
                </div>
              </div> 
          </div>--}}

          {{-- <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
              <div class="card" style="width: 18rem;">
                <img class="img-responsive card-img-top" src="{{asset('public/img/stripe.png')}}" alt="Strip" style="width:60%; margin-left: 33%;">
                <div class="card-body">
                  <!-- <p class="card-text">Strip</p> -->
                    <!-- <a class="pay" value="Strip" style="margin-top: 20%;" href="{{url('/pay-with-stripe/'.$userDetail->id)}}">Strip</a> -->

                    <form action="{{url('/pay-with-stripe-payment')}}" class="stripButton" method="POST" style="margin-top: 16%; margin-left: 22%;">
                      {{ csrf_field() }}
                      <input type="hidden" value="{{$userDetail->id}}" name="user_id">
                      <script
                          src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                          data-key="{{ config('services.stripe.key') }}"
                          data-amount="1000"
                          data-name="Stripe Payment"
                          data-description="For Membership Annually."
                          data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                          data-locale="auto" data-allow-remember-me="false" >
                      </script>
                       <script>
                          // Hide default stripe button, be careful there if you
                          // have more than 1 button of that class
                          document.getElementsByClassName("stripe-button-el")[0].style.display = 'none';
                      </script>
                       <input type="submit" class="pay" value="Stripe" style="margin-top: 20%;">
                    </form>

                </div>
              </div> 
          </div> --}}

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="pay" data-dismiss="modal" style="float:right;">Close</button>
      </div>
    </div>

  </div>
</div>


<!-- Modal Ends -->

<script type="text/javascript">
/*jQuery(document).ready(function() {
	if(localStorage.getItem('return_url')!='') {
	  jQuery('#return_url').val(localStorage.getItem('return_url'));
	  localStorage.removeItem('return_url');
	}
});/*
</script>

@endsection