<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';

    protected $fillable = [
        'user_from_id', 'user_to_id', 'subject', 'message', 'delete_from_id', 'delete_to_id'
    ];

    // notice that the attribute created at is in CamelCase.
    public function getCreatedAtDateAttribute()
    {
        return date('d F, Y', strtotime($this->created_at));
    }

    // notice that the attribute updated at is in CamelCase.
    public function getUpdatedAtDateAttribute()
    {
        return date('d F, Y', strtotime($this->updated_at));
    }

    public function receiveUser() {
        return $this->hasOne('App\User', 'id', 'user_to_id');
    }

    public function sendUser() {
        return $this->hasOne('App\User', 'id', 'user_from_id');
    }
    
}