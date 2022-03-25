<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';

    protected $fillable = [
        'country_name', 'country_code', 'continent', 'country_status'
    ];

    public function countryCafes()
    {
        return $this->hasMany(Cafe::class, 'country_id');
    }
}