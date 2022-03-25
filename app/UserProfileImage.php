<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfileImage extends Model
{
    protected $table = 'user_profile_images';  
    protected $fillable = [
        'image_name', 'image_status', 'image_gender'
    ];

    
}