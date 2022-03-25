<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class States extends Model
{
    protected $table = 'state';  
    protected $fillable = [
        'zstate', 'nstate','state_code'
    ];

    
}