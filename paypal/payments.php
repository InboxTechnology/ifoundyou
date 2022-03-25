<?php
include 'functions.php';

$enableSandbox = true;

$dbConfig = [
  'host' => '127.0.0.1',
  'username' => 'ifoundyoucanada_user',
  'password' => '$;cuCRy~aS(y',
  'name' => 'ifoundyoucanada_development'
];

$con = mysqli_connect('localhost', 'ifoundyoucanada_user', '$;cuCRy~aS(y', 'ifoundyoucanada_development');

$paypalConfig = [
  // 'email' => 'sb-7qdsl2962212@business.example.com',
  'email' => 'ifoundyouinc@gmail.com',
  'return_url' => $_POST['return_url'],
  'cancel_url' => $_POST['cancel_url'],
  'notify_url' => 'https://develop.ifoundyoucanada.com/paypal/payments.php'
];
// echo "<pre>"; print_r($paypalConfig); exit;

$paypalUrl = $enableSandbox ? 'https://www.sandbox.paypal.com/cgi-bin/webscr' : 'https://www.paypal.com/cgi-bin/webscr';

$itemName = 'Annual Membership Fees';
// $itemAmount = 10.00;
$itemAmount = $_POST['itemAmount'];


if( !isset($_POST["txn_id"]) && !isset($_POST["txn_type"]) )
{
  $data = [];
  foreach( $_POST as $key => $value ) {
    $data[$key] = stripslashes($value);
  }

  $data['business'] = $paypalConfig['email'];
  $data['return'] = stripslashes($_POST['return_url']);
  $data['cancel_return'] = stripslashes($paypalConfig['cancel_url']);
  $data['notify_url'] = stripslashes($paypalConfig['notify_url']);
  $data['item_name'] = $itemName;
  $data['amount'] = $itemAmount;
  $data['currency_code'] = 'USD';

  $queryString = http_build_query($data);

  header('location:' . $paypalUrl . '?' . $queryString);
  //exit();
}
else
{
    mysqli_query($con, "INSERT INTO payments
        (`txnid`,`payment_amount`,`payment_status`,`payment_currency`,`receiver_email`,`payer_email`,`user_id`,`status`,`created_at`,`expiry_date`) 
        VALUES 
        ('".$_POST['txn_id']."','".$_POST['mc_gross']."','".$_POST['payment_status']."','".$_POST['mc_currency']."','".$_POST['receiver_email']."','".$_POST['payer_email']."','".$_POST['custom']."','Current','".date("Y-m-d H:i:s")."','".date('Y-m-d H:i:s', strtotime('+1 years'))."')");
    mysqli_close($con);

  // if (verifyTransaction($_POST) && checkTxnid($data['txn_id'])) {
  //   addPayment($data);
  // }
}