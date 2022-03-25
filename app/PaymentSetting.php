<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentSetting extends Model
{
    protected $table = 'payment_settings';  
    protected $fillable = [
        'membership_fees', 'membership_status'
    ];

    
}