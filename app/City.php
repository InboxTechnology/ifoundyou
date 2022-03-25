<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'cities';

    protected $fillable = [
        'city_id', 'country_id', 'state_id', 'city_name', 'city_status'
    ];

    public function cityCafes()
    {
        return $this->hasMany(Cafe::class, 'city_id', 'id');
    }
}