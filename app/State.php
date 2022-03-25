<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = 'states';  
    protected $fillable = [
        'country_id', 'state_name','state_code', 'state_status'
    ];

    public function stateCafes()
    {
        return $this->hasMany(Cafe::class, 'state_id');
    }
}