<?php

namespace App\Repositories;

use App\Repositories\StateRepository;
use App\Repositories\CityRepository;
use App\Repositories\CafeRepository;
use App\Repositories\ActivityRepository;
use App\Repositories\LifePathNumberRepository;
use App\Repositories\HoroscopeRepository;

use Illuminate\Support\Facades\Hash;

use App\User;
use Auth;

class UserRepository
{
    private $stateRepository;
    private $cityRepository;
    private $cafeRepository;
    private $activityRepository;
    private $lifePathNumberRepository;
    private $horoscopeRepository;

	public function __construct()
    {
        $this->stateRepository = new StateRepository;
        $this->cityRepository = new CityRepository;
        $this->cafeRepository = new CafeRepository;
        $this->activityRepository = new ActivityRepository;
        $this->lifePathNumberRepository = new LifePathNumberRepository;
        $this->horoscopeRepository = new HoroscopeRepository;
    }

    public function all($status='', $userType='')
    {
        $users = User::orderBy('created_at', 'DESC');

        if( $status!='' )
        {
            $users->where('status', $status);
        }

        if( $userType!='' )
        {
            $users->where('type', $userType);
        }

        return $users->get();
    }

    public function getByID($id)
    {
    	return User::where('id', $id)->first();
    }

    public function create(array $data)
    {
        $RS_State = $this->stateRepository->getIDByName($data['state_name']);
        
        $RS_City = $this->cityRepository->getIDByName($data['city_name'], $RS_State->id, $RS_State->country_id);

        $RS_Cafe = $this->cafeRepository->getByIDs($RS_City->id, $RS_City->state_id, $RS_City->country_id);

        $activities = $this->activityRepository->all();
        $matchActivities = '';
        if( $activities )
        {
            $activitiesArr = array();
            foreach( $activities as $activity )
            {
                $activitiesArr[] = $activity->activity_name;
            }
        }
        $matchActivities = implode(',', $activitiesArr);

        $sex = '';
        $about_gender = '';
        if( $data['interested_in'] == 'I am a man seeking a women' )
        {
            $sex = "Male";
            $about_gender = "Female";
        }
        else if( $data['interested_in'] == 'I am a women seeking a man' )
        {
            $sex = "Female";
            $about_gender = "Male";
        }
        else if( $data['interested_in'] == 'I am a man seeking a man' )
        {
            $sex = "Gay Male";
            $about_gender = "Gay Male";
        }
        else if( $data['interested_in'] == 'I am a women seeking a women' )
        {
            $sex = "Gay Female";
            $about_gender = "Gay Female";
        }

    	$month = $this->lifePathNumberRepository->lifePathNumber(@$data['month']);
        $day = $this->lifePathNumberRepository->lifePathNumber(@$data['day']);
        $year = $this->lifePathNumberRepository->lifePathNumber(@$data['year']);
        $sum = $this->lifePathNumberRepository->lifePathNumber($month+$day+$year);
        
        $saveData['type'] = 'user';
        $saveData['name'] = @$data['fullname'];
        $saveData['email'] = @$data['email'];
        $saveData['password'] = Hash::make(@$data['password']);
        $saveData['original_password'] = @$data['password'];
        $saveData['sex'] = @$sex;
        $saveData['about_gender'] = @$about_gender;
        $saveData['month'] = @$data['month'];
        $saveData['day'] = @$data['day'];
        $saveData['year'] = @$data['year'];
        $saveData['datepoint'] = $sum;
        $saveData['cafe_id'] = @$RS_Cafe->id;
        $saveData['city_id'] = @$RS_Cafe->city_id;
        $saveData['state_id'] = @$RS_Cafe->state_id;
        $saveData['country_id']  = @$RS_Cafe->country_id;
        $saveData['interested_in'] = $data['interested_in'];
        $saveData['matchInterest'] = $matchActivities;
        // $saveData['status'] = 'activate';

        User::create($saveData);
    }

    public function socialCreate(array $data)
    {
        $RS_State = $this->stateRepository->getIDByName($data['state_name']);
        
        $RS_City = $this->cityRepository->getIDByName($data['city_name'], $RS_State->id, $RS_State->country_id);

        $RS_Cafe = $this->cafeRepository->getByIDs($RS_City->id, $RS_City->state_id, $RS_City->country_id);

        $activities = $this->activityRepository->all();
        $matchActivities = '';
        if( $activities )
        {
            $activitiesArr = array();
            foreach( $activities as $activity )
            {
                $activitiesArr[] = $activity->activity_name;
            }
        }
        $matchActivities = implode(',', $activitiesArr);

        $sex = '';
        $about_gender = '';
        if( $data['interested_in'] == 'I am a man seeking a women' )
        {
            $sex = "Male";
            $about_gender = "Female";
        }
        else if( $data['interested_in'] == 'I am a women seeking a man' )
        {
            $sex = "Female";
            $about_gender = "Male";
        }
        else if( $data['interested_in'] == 'I am a man seeking a man' )
        {
            $sex = "Gay Male";
            $about_gender = "Gay Male";
        }
        else if( $data['interested_in'] == 'I am a women seeking a women' )
        {
            $sex = "Gay Female";
            $about_gender = "Gay Female";
        }

        $month = $this->lifePathNumberRepository->lifePathNumber(@$data['month']);
        $day = $this->lifePathNumberRepository->lifePathNumber(@$data['day']);
        $year = $this->lifePathNumberRepository->lifePathNumber(@$data['year']);
        $sum = $this->lifePathNumberRepository->lifePathNumber($month+$day+$year);
        
        User::where('id', Auth::user()->id)
            ->update([
                'sex' => @$sex,
                'about_gender' => @$about_gender,
                'month' => @$data['month'],
                'day' => @$data['day'],
                'year' => @$data['year'],
                'datepoint' => $sum,
                'cafe_id' => @$RS_Cafe->id,
                'city_id' => @$RS_Cafe->city_id,
                'state_id' => @$RS_Cafe->state_id,
                'country_id'  => @$RS_Cafe->country_id,
                'interested_in' => $data['interested_in'],
                'matchInterest' => $matchActivities,
                'status' => 'activate',
            ]);
    }

    public function profileUpdate(array $data)
    {
        User::where('id', Auth::user()->id)
            ->update([
                'sex'       => @$data['sex'],
                'looking_for'       => @$data['looking_for_date'],
                'bodytype'    => @$data['bodytype'],
                'height' => @$data['height'],
                'eyecolor'  => @$data['eyecolor'],
                'haircolor'  => @$data['haircolor'],
                'ethnicity'  => @$data['ethnicity'],
                'language' => @$data['language'],
                'religion'  => @$data['religion'],
                'about_gender'      => @$data['about_gender'],
                'about_bodytype'    => @$data['about_bodytype'],
                'about_height'      => @$data['about_height'],
                'about_eyecolor'    => @$data['about_eyecolor'],
                'about_haircolor'   => @$data['about_haircolor'],
                'about_ethnicity'   => @$data['about_ethnicity'],
                'about_language'    => @$data['about_language'],
                'about_religion'    => @$data['about_religion'],
                'activity'  => @$data['activity'],
                'matchInterest'     => @$data['matchInterest'],
                'type_of_relationship'  => @$data['type_of_relationship'],
                'biography' => @$data['biography'],
            ]);
    }

    public function aboutMeUpdate(array $data)
    {
        User::where('id', Auth::user()->id)
            ->update([
                'sex'       => @$data['sex'],
                'height'    => @$data['height'],
                'haircolor' => @$data['haircolor'],
                'language'  => @$data['language'],
                'bodytype'  => @$data['bodytype'],
                'eyecolor'  => @$data['eyecolor'],
                'ethnicity' => @$data['ethnicity'],
                'religion'  => @$data['religion'],
                'activity'  => @$data['activity'],
                // 'biography' => @$data['biography'],
            ]);
    }

    public function aboutMyMatchUpdate(array $data)
    {
        $about_height = @$data['about_height'] ? implode(', ', $data['about_height']) : '';
        $about_haircolor = @$data['about_haircolor'] ? implode(', ', $data['about_haircolor']) : '';
        $about_language = @$data['about_language'] ? implode(', ', $data['about_language']) : '';
        $about_bodytype = @$data['about_bodytype'] ? implode(', ', $data['about_bodytype']) : '';
        $about_eyecolor = @$data['about_eyecolor'] ? implode(', ', $data['about_eyecolor']) : '';
        $about_ethnicity = @$data['about_ethnicity'] ? implode(', ', $data['about_ethnicity']) : '';
        $about_religion = @$data['about_religion'] ? implode(', ', $data['about_religion']) : '';

        User::where('id', Auth::user()->id)
            ->update([
                'about_gender'      => @$data['about_gender'],
                'about_bodytype'    => $about_bodytype,
                'about_height'      => $about_height,
                'about_eyecolor'    => $about_eyecolor,
                'about_haircolor'   => $about_haircolor,
                'about_ethnicity'   => $about_ethnicity,
                'about_language'    => $about_language,
                'about_religion'    => $about_religion,
                'matchInterest'     => @$data['matchInterest'],
            ]);
    }

    public function getUserBiography($id='')
    {
        $user = $this->getByID($id);
        
        if( empty($user) ) return null;

        $western_sign = $this->horoscopeRepository->westernSign($user->month, $user->day);
        $chinese_sign = $this->horoscopeRepository->chineseSign($user->year);

        $biography = '';
        if( $user->datepoint )
        {
            $biography .= "My life Path Number is {$user->datepoint}.";
        }

        if( $user->sex )
        {
            $biography .= " I am a {$user->sex}.";
        }

        if( $user->height )
        {
            $biography .= " My Height is {$user->height}.";
        }

        if( $user->haircolor )
        {
            $biography .= " My Hair color is {$user->haircolor}.";
        }

        if( $user->language )
        {
            $biography .= " I speak {$user->language}.";
        }

        if( $user->bodytype )
        {
            $biography .= " My Body Type is {$user->bodytype}.";
        }

        if( $user->eyecolor )
        {
            $biography .= " My Eye Color is {$user->eyecolor}.";
        }

        if( $chinese_sign && $western_sign  )
        {
            $biography .= " I am the Chinese {$chinese_sign} and my Western sign is {$western_sign}.";
        }

        if( $user->ethnicity )
        {
            $biography .= " My Ethnicity is {$user->ethnicity}.";
        }

        if( $user->religion )
        {
            $biography .= " My Religion is {$user->religion}.";
        }

        if( $user->activity )
        {
            $biography .= " My Interest include {$user->activity}.";
        }

        return $biography;
    }
}
