<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matching extends Model
{
    protected $table = 'matching';

    protected $fillable = [
        'email', 'dob', 'datepoint', 'about_gender', 'about_bodytype', 'about_height', 'about_eyecolor'
    ];
}