<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    protected $table = 'user_images';  
    protected $fillable = [
        'userId','image'
    ];

    
}