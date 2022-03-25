<?php

namespace App\Repositories;

use App\Payment;

class PaymentRepository
{
    public function all($status='')
    {
    	$payments = Payment::orderBy('expiry_date', 'ASC');

    	if( $status!='' )
    	{
    		$payments->where('status', $status);
    	}

    	return $payments->get();
    }

    public function getByUserID($userID='', $status='')
    {
    	$payment = Payment::orderBy('expiry_date', 'ASC');

    	if( $userID!='' )
    	{
    		$payment->where('user_id', $userID);
    	}

    	if( $status!='' )
    	{
    		$payment->where('status', $status);
    	}

    	return $payment->first();
    }
}
