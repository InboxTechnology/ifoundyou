@extends('layouts.full_dashboard')

@section('content')



<ul class="nav-inner">

  <li><a href="{{ url('/user/dashboard')}}">Home</a></li>

  <li class="active"><a href="{{ url('/') }}/join-today/{{ $userDetail->id }}">Membership</a></li>

</ul>



<style>

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

 </style>



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





                 <!--  <div class="annually_text">         

                     <a class="member-link" href="{{ url('/paypal-example-master') }}">Begin</a>

                  </div>  -->





          <!DOCTYPE html>

          <html>

          <head>

              <meta charset="utf-8">

              <meta http-equiv="X-UA-Compatible" content="IE=edge">

              <meta name="viewport" content="width=device-width, initial-scale=1">

              <title>Paypal Integration Test</title>

          </head>

          <body>


           <!--    <form class="paypal" action="/paypal-example-master/payments.php" method="post" id="paypal_form">


                  <input type="hidden" name="cmd" value="_xclick" />

                  <input type="hidden" name="no_note" value="1" />

                   <input type="hidden" name="business" value="ifoundyouinc@gmail.com">

                  <input type="hidden" name="lc" value="UK" />

                  <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" />

                  <input type="hidden" name="first_name" value="Customer's First Name" />

                  <input type="hidden" name="last_name" value="Customer's Last Name" />

                  <input type="hidden" name="payer_email" value="customer@example.com" />

                  <input type="hidden" name="item_number" value="IFYAM1901" / >

                  <input type="hidden" name="custom" value="{{Auth::user()->id}}">

                  <input type="hidden" name="user_id" value="{{ $userDetail->id }}">

                  <input type="hidden" name="itemAmount" value="{{ number_format($paypal_amount,2) }}">

                  <input type="hidden" name="return_url" value="" id="return_url">

           

                  <input type="submit" name="submit" class="pay" value="Submit Payment"/>
              </form> -->
          
            <a class="pay" value="Submit Payment" href="{{url('/select-payment-method')}}"></a>



          </body>

          </html>



            </div>

         </div>

      </div>

   </div>

</div>

</div>

<script type="text/javascript">

  jQuery(document).ready(function(){

    if(localStorage.getItem('return_url')!=''){

      jQuery('#return_url').val(localStorage.getItem('return_url'));

      localStorage.removeItem('return_url');

    }

  })

</script>









@endsection