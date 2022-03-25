<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactMember extends Model
{
    protected $fillable = [
        'user_from_id', 'user_to_id_number', 'choose_message', 'description'
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

    public function user() {
        return $this->belongsTo(User::class, 'user_from_id');
    }
}
