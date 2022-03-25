<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horoscope extends Model
{
    protected $table = 'horoscope';

    protected $fillable = [
        'horoscope_sign', 'from_date', 'to_date', 'from_month', 'from_day', 'to_month', 'to_day'
    ];
}