<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cafe extends Model
{
    protected $table = 'cafes';

    protected $fillable = [
        'city_id', 'zip_code', 'store_name','address_line_1'
    ];


    public function cafeUsers()
    {
        return $this->hasMany('App\User', 'city_id', 'city_id');
    }

    public function getCafeCity()
    {
        return $this->hasOne(City::class, 'id', 'city_id');
    }

    public function getCafeState()
    {
        return $this->hasOne(State::class, 'id', 'state_id');
    }

    public function getCafeCountry()
    {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }

    public function city()
    {
        return $this->belongsTo(city::class, 'city_id', 'id');
    }
}