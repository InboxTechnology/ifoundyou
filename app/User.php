<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','type', 'email', 'password','original_password','sex','looking_for','month','day','year','datepoint','phone','bodytype','height','eyecolor','haircolor','ethnicity','language','religion','about_gender','about_bodytype','about_height','about_eyecolor','about_haircolor','about_ethnicity','about_language','about_religion','state','live_in','activity','type_of_relationship','chinese_sign','western_sign','cafe','account_setup','status','country','continent','about_me_details', 'city', 'ustate', 'zip_code', 'interested_in', 'profile_picture_status', 'matchInterest', 'cafe_id', 'city_id', 'state_id', 'country_id', 'biography', 'biography_status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function UserImages()
    {
        return $this->hasOne('App\Images','userId','id');
    }

    /*public function UserLoc()
    {
        return $this->hasOne('App\Cafe', 'city_id', 'city_id');
    }*/

    public function UserCafe()
    {
        return $this->hasOne('App\Cafe', 'id', 'cafe_id');
    }

    public function UserCity()
    {
        return $this->hasOne('App\City', 'id', 'city_id');
    }

    public function UserState()
    {
        return $this->hasOne('App\State', 'id', 'state_id');
    }

    public function UserCountry()
    {
        return $this->hasOne('App\Country', 'id', 'country_id');
    }

    public function PaymentCurrent()
    {
        return $this->hasOne('App\Payment', 'user_id', 'id')
                    // ->where('payment_status', 'Success')
                    ->where('status', 'Current');
    }

    public function matchresult()
    {
        return $this->hasMany('App\User', 'id', 'id');
    }


    public function UserCityCafe()
    {
        return $this->hasOne('App\Cafe', 'city_id', 'id');
    }

    public function ContactMembers() {
        return $this->hasMany(ContactMember::class, 'user_from_id');
    }

}
