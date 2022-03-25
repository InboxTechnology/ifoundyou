<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friends extends Model
{
    protected $table = 'friends';  
    protected $fillable = [
        'from', 'to','status',
    ];

    public function friendsDetail() {
        return $this->hasOne('App\User','id','from');
    }


    public function friendsDetail2() {
        return $this->hasOne('App\User','id','to');
    }

}