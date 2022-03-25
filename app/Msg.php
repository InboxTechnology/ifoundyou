<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Msg extends Model
{
    protected $table = 'messages';  
    protected $fillable = [
        'from', 'to','subject','message','mid','del_from','del_to'
    ];

    public function rec_user() {
        return $this->hasOne('App\User','id','to');
    }

    public function send_user() {
        return $this->hasOne('App\User','id','from');
    }
    
}