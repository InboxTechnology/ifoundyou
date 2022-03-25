<?php

namespace App\Http\Controllers;

use App\Repositories\StateRepository;
use App\Repositories\CityRepository;
use App\Repositories\CafeRepository;
use App\Repositories\LifePathNumberRepository;
use App\Repositories\ActivityRepository;
use App\Repositories\UserRepository;
use App\Repositories\HoroscopeRepository;
use App\Repositories\PaymentRepository;
use App\Repositories\MessageRepository;
use App\Repositories\ContactMemberRepository;


use Session, Redirect;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\Cafe;
use App\States;
use Illuminate\Support\Facades\Input;
use App\Images;
use App\Friends;
use App\Msg;
use App\Activites;
use DB;
use DateTime;
use Artisan;
use App\Http\Controllers\Crypt;
use App\Payment;
use App\PaymentSetting;
use App\UserProfileImage;

@ini_set("memory_limit", "2048M");

class UserController extends Controller
{
	private $stateRepository;
    private $cityRepository;
    private $cafeRepository;
    private $lifePathNumberRepository;
    private $activityRepository;
    private $userRepository;
    private $horoscopeRepository;
    private $paymentRepository;
    private $messageRepository;
    private $contactMemberRepository;

	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->stateRepository = new StateRepository;
        $this->cityRepository = new CityRepository;
        $this->cafeRepository = new CafeRepository;
        $this->lifePathNumberRepository = new LifePathNumberRepository;
        $this->activityRepository = new ActivityRepository;
        $this->userRepository = new UserRepository;
        $this->horoscopeRepository = new HoroscopeRepository;
        $this->paymentRepository = new PaymentRepository;
        $this->messageRepository = new MessageRepository;
        $this->contactMemberRepository = new contactMemberRepository;
    }

    public function socialEmptyDOB()
    {
    	if( Auth::check() && ( empty(Auth::user()->day) || empty(Auth::user()->month) || empty(Auth::user()->year) ) )
        {
            return '/provinces-list';
        }
    }
    
	public function dashboard()
	{
		$redirectURL = $this->socialEmptyDOB();
		if( !empty($redirectURL) )
		{
			return redirect($redirectURL);
		}

		Session::forget('parameters');

		if( Auth::check() && Auth::user()->type == "user" )
		{
			return view('user.dashboard');
		}
		else if( Auth::check() && Auth::user()->type == "admin" )
		{
			return redirect('admin/dashboard');
		}
		else
		{
			return redirect('/');
		}
	}

	public function cafeMembers()
	{
		$redirectURL = $this->socialEmptyDOB();
		if( !empty($redirectURL) )
		{
			return redirect($redirectURL);
		}

		Session::forget('parameters');

		if( Auth::check() && Auth::user()->type == "user" )
		{
			$cafe_location = Input::get('cafe_location');

			$search['country_id'] = Input::get('country_id') ?? Auth::user()->country_id;
			$search['state_id'] = Input::get('state_id') ?? Auth::user()->state_id;
			$search['city_id'] = Input::get('city_id') ?? Auth::user()->city_id;
			$search['cafe_id'] = Input::get('cafe_id') ?? Auth::user()->cafe_id;
			$search['day'] = Input::get('day');
			$search['month'] = Input::get('month');
			$search['year'] = Input::get('year');

			$states = $this->stateRepository->all();

			$cities = $this->cityRepository->all('Active', $search['state_id']);

			$cafes = $this->cafeRepository->all($search['city_id'], $search['state_id'], $search['country_id']);
			
			if( Input::get('day') )
			{
				$getCafes = $this->find_cafes_with_extra($search['cafe_id'], $search['city_id'], $search['state_id'], $search['country_id'], $search['day'], $search['month'], $search['year']);
			}
			else
			{
				if( Auth::user()->city_id )
				{
					$getCafes = $this->find_cafes_with_city($search['city_id'], $search['state_id'], $search['country_id']);
				}
				else if( Input::get('search-cafe-members') )
				{
					$getCafes = 0;				
				}
				else
				{
					$getCafes = 'null';
				}
			}

			return view('user.cafe_members')
					->with('states', $states)
					->with('cities', $cities)
					->with('cafes', $getCafes)
					->with('search', $search)
					->with('cafe_location', $cafe_location);
		}
		else
		{
			return redirect('/');
		}
	}

	public function searchCafes(Request $request)
	{
		$redirectURL = $this->socialEmptyDOB();
		if( !empty($redirectURL) )
		{
			return redirect($redirectURL);
		}

		Session::forget('parameters');
		if( Auth::check() && Auth::user()->type == "user" )
		{
			$search['country_id'] = Input::get('country_id') ?? Auth::user()->country_id;
			$search['state_id'] = Input::get('state_id') ?? Auth::user()->state_id;
			$search['city_id'] = Input::get('city_id') ?? Auth::user()->city_id;
			$search['cafe_id'] = Input::get('cafe_id') ?? Auth::user()->cafe_id;

			$states = $this->stateRepository->all();

			$cities = $this->cityRepository->all('Active', $search['state_id']);

			$cafes = $this->cafeRepository->all($search['city_id'], $search['state_id'], $search['country_id']);
			
			if( Input::get('cafe_id') )
			{
				$getCafes = $this->find_cafes_with_extra($search['cafe_id'], $search['city_id'], $search['state_id'], $search['country_id']);
				
			}
			else
			{
				if( Auth::user()->city_id )
				{
					$getCafes = $this->find_cafes_with_city($search['city_id'], $search['state_id'], $search['country_id']);
				}
				else if( Input::get('search-cafes') )
				{
					$getCafes = 0;				
				}
				else
				{
					$getCafes = array();
				}
			}
			
			return view('user.search_cafes')
					->with('states', $states)
					->with('cities', $cities)
					->with('cafes', $getCafes)
					->with('script_cafes', json_encode($getCafes))
					->with('search', $search);
		}
		else
		{
			return redirect('/');
		}
	}

	public function find_cafes_with_extra($cafe_id, $city_id, $state_id, $country_id, $d='', $m='', $y='')
	{
		$redirectURL = $this->socialEmptyDOB();
		if( !empty($redirectURL) )
		{
			return redirect($redirectURL);
		}

		$sum = 0;
		if( $d!='' )
		{
			$month = $this->lifePathNumberRepository->lifePathNumber($m);
			$day = $this->lifePathNumberRepository->lifePathNumber($d);
			$year = $this->lifePathNumberRepository->lifePathNumber($y);
			$sum = $this->lifePathNumberRepository->lifePathNumber($month+$day+$year);
		}

		$data = 'null';

		if( $sum > 0 )
		{
			$cafe = Cafe::findOrFail($cafe_id);

			$data = Cafe::where('zip_code', 'like', '%'.$cafe->zip_code.'%')
					->where('city_id', $city_id)
					->where('state_id', $state_id)
					->where('country_id', $country_id)
					->with('cafeUsers')
					->with(['cafeUsers' => function($query) use($sum) {
						$query->where('datepoint', $sum); 
						$query->where('delete_account','0'); 
						$query->get();
					}])
					->get();
		}
		else
		{
			$cafe = Cafe::findOrFail($cafe_id);
			$data = Cafe::where('zip_code', 'like', '%'.$cafe->zip_code.'%')
					->where('city_id', $city_id)
					->where('state_id', $state_id)
					->where('country_id', $country_id)
					->with('cafeUsers')
					->with(['cafeUsers' => function($query) use($sum) {
						$query->where('delete_account','0'); 
						$query->get();
					}])
					->get();
		}

		return $data;
	}

	public function find_cafes_with_city($city_id, $state_id, $country_id)
	{
		$redirectURL = $this->socialEmptyDOB();
		if( !empty($redirectURL) )
		{
			return redirect($redirectURL);
		}

		$sum = 0;
		$data = 'null';

		$data = Cafe::where('city_id', $city_id)
				->where('state_id', $state_id)
				->where('country_id', $country_id)
				->with('cafeUsers')
				->with(['cafeUsers' => function($query) use($sum) {
					$query->where('delete_account', '0'); 
					$query->get();
				}])
				->get();
		
		return $data;
	}

	public function getcities(Request $request)
   	{
   		$redirectURL = $this->socialEmptyDOB();
		if( !empty($redirectURL) )
		{
			return redirect($redirectURL);
		}

   		$html = '<option value="">Select Cities</option>';

   		if( $request->stateID || $request->countryID )
   		{
	   		$cities = $this->cityRepository->all('Active', '', $request->countryID);

	   		foreach( $cities as $key=>$value )
	   		{
	   			$citySelected = ( (Auth::user()->city_id == $value->id) ? 'selected' : '' );
	   			$html .= '<option value="'.$value->id.'" '.$citySelected.'>'.$value->city_name.'</option>';
	   		}
	   	}
   		echo $html;
    }

    public function getCafeLocations(Request $request)
   	{
   		$redirectURL = $this->socialEmptyDOB();
		if( !empty($redirectURL) )
		{
			return redirect($redirectURL);
		}

		$html ='<option value="">Choose Cafe Location</option>';

		if( $request->cityID )
   		{
   			$RS_Cafes = $this->cafeRepository->all($request->cityID);

			foreach( $RS_Cafes as $key=>$value )
			{
				$cafeSelected = ( (Auth::user()->cafe_id == $value->id) ? 'selected' : '' );
				$html .= '<option value="'.$value->id.'" '.$cafeSelected.'>'.$value->store_name.', '.$value->getCafeCity->city_name.', '.$value->getCafeCountry->country_name.', '.$value->zip_code.'</option>';
			}
		}
		echo $html;
   	}

   	public function editProfileDashborad()
   	{
   		$redirectURL = $this->socialEmptyDOB();
		if( !empty($redirectURL) )
		{
			return redirect($redirectURL);
		}

		if( !Auth::check() )
		{
			return redirect('/');
		}
		
		return view('user.edit_profile_dashboard');
	}

	public function aboutMe(Request $request)
	{
		$redirectURL = $this->socialEmptyDOB();
		if( !empty($redirectURL) )
		{
			return redirect($redirectURL);
		}

		if( !Auth::check() )
		{
			return redirect('/');
		}

		if( Auth::check() && Auth::user()->type == "user" or Auth::user()->type == "admin" )
		{
			$activities = $this->activityRepository->all();
			$profileImages = $this->usersProfileImages();

			return view('user.about_me')
				->with('activities', $activities)
				->with('profileImages', $profileImages);
		} 
		else
		{
			return redirect('/');
		}
	}

	public function aboutMeUpdate(Request $request)
	{
		$redirectURL = $this->socialEmptyDOB();
		if( !empty($redirectURL) )
		{
			return redirect($redirectURL);
		}

		if( !Auth::check() )
		{
			return redirect('/');
		}

		$data  = $request->all();
        $this->userRepository->aboutMeUpdate($data);

		/*User::where('id', Auth::user()->id)
					->update(['image' => $request->profile_image]);*/

		/*if( $request->create_account )
		{
			User::where('id',Auth::user()->id)->update([
				'account_setup' => 1
			]);

			return redirect('/user/dashboard');
		}*/

		return redirect('user/edit-profile-dashboard');
	}

	public function aboutMyMatch(Request $request)
	{
		$redirectURL = $this->socialEmptyDOB();
		if( !empty($redirectURL) )
		{
			return redirect($redirectURL);
		}

		if( !Auth::check() )
		{
			return redirect('/');
		}

		if( Auth::check() && Auth::user()->type == "user" or Auth::user()->type == "admin")
		{
			$activities = $this->activityRepository->all();
			
			return view('user.about_my_match')
				->with('activities', $activities);
		} 
		else
		{
			return redirect('/');
		}
	}

	public function aboutMyMatchUpdate(Request $request)
	{
		$redirectURL = $this->socialEmptyDOB();
		if( !empty($redirectURL) )
		{
			return redirect($redirectURL);
		}

		if( !Auth::check() )
		{
			return redirect('/');
		}

		$data  = $request->all();
        $this->userRepository->aboutMyMatchUpdate($data);
		
		return redirect('user/edit-profile-dashboard');
	}

	public function usersProfileImages($gender='')
	{
		$userProfileImg = UserProfileImage::select('*');

		if( $gender=='' )
		{
			$userProfileImg->whereIn('image_gender', ['Men', 'Women']);
		}
		else
		{
			$userProfileImg->where('image_gender', $gender);
		}

		return $userProfileImg->get();
	}


	public function horoscope(Request $request)
	{
		$redirectURL = $this->socialEmptyDOB();
		if( !empty($redirectURL) )
		{
			return redirect($redirectURL);
		}

		if( !Auth::check() )
		{
			return redirect('/');
		}

		if( Auth::check() && Auth::user()->type == "user" or Auth::user()->type == "admin" )
		{
			$day = Auth::user()->day;
			$month = Auth::user()->month;
			$year = Auth::user()->year;

			$western_sign = $this->horoscopeRepository->westernSign($month, $day);
			$chinese_sign = $this->horoscopeRepository->chineseSign($year);
			
			return view('user.horoscope')
				->with('western_sign', $western_sign)
				->with('chinese_sign', $chinese_sign);
		}
		else
		{
			return redirect('/');
		}
	}

	public function myCafe(Request $request)
   	{
   		$redirectURL = $this->socialEmptyDOB();
		if( !empty($redirectURL) )
		{
			return redirect($redirectURL);
		}

   		if( !Auth::check() )
		{
			return redirect('/');
		}

   		if( Auth::check() && Auth::user()->type == "user" ) 
   		{
   			$cafes = Cafe::where('id', Auth::user()->cafe_id)
   							->with('cafeUsers')
   							->with('getCafeCity')
   							->with('getCafeState')
   							->with('getCafeCountry')
   							->get();

   			return view('user.mycafe')
   					->with('cafes', $cafes);
   		}
   		else
   		{
   			return redirect('/');
   		}
   	}

   	public function userProfile($id = null)
   	{
   		$redirectURL = $this->socialEmptyDOB();
		if( !empty($redirectURL) )
		{
			return redirect($redirectURL);
		}

		if( !Auth::check() )
		{
			return redirect('/');
		}
		
		if( $id=='' )
		{
			$id = Auth::user()->id;
		}

		if( Auth::check() && Auth::user()->type == "user" )
		{
			$userDetail = User::where('id', $id)
						->with(['UserCafe','UserCity', 'UserState'])
						->first();

			if( empty($userDetail) )
			{
				return redirect('/user/dashboard');
			}

			$userPaymentDetail = $this->paymentRepository->getByUserID(Auth::user()->id, 'Current');

			$loggedinUserBiography = $this->userRepository->getUserBiography(Auth::user()->id);
			$userBiography = $this->userRepository->getUserBiography($id);
			$western_sign = $this->horoscopeRepository->westernSign($userDetail->month, $userDetail->day);
			$chinese_sign = $this->horoscopeRepository->chineseSign($userDetail->year);

			$paymentSettings = PaymentSetting::where('id', '1')
		                    ->select('*')
		                    ->first();

            return view('user.user_profile')
					->with('userDetail', $userDetail)
					->with('userBiography', $userBiography)
					->with('userPaymentDetail', $userPaymentDetail)
					->with('western_sign', $western_sign)
					->with('chinese_sign', $chinese_sign)
					->with('payment_settings', $paymentSettings)
					->with('loggedinUserBiography', $loggedinUserBiography);
		}
		else
		{
			return redirect('/');
		}
	}

	public function changePhoto()
	{
		$redirectURL = $this->socialEmptyDOB();
		if( !empty($redirectURL) )
		{
			return redirect($redirectURL);
		}
		
		if( !Auth::check() )
		{
			return redirect('/');
		}

		if( Auth::check() && Auth::user()->type == "user" or Auth::user()->type == "admin" )
		{
			$profileMenImages = $this->usersProfileImages('Men');
			$profileWomenImages = $this->usersProfileImages('Women');
			return view('user.change_photo', compact('profileMenImages', 'profileWomenImages'));
		}
		else
		{
			return redirect('/');
		}
	}


	public function changePhotoSave(Request $request)
	{
		if( Auth::check() )
		{
			User::where('id', Auth::user()->id)
					->update(['image' => $request->profile_image]);

			return redirect('/user/change-photo');
		}
		else
		{
			return redirect('/');
		}
	}

	public function accountInfo()
	{
		$redirectURL = $this->socialEmptyDOB();
		if( !empty($redirectURL) )
		{
			return redirect($redirectURL);
		}

		if( Auth::check() )
		{
			// $userDetail = User::where('id', $id)
			// 			->with(['UserCafe', 'UserState', 'PaymentCurrent'])
			// 			->first();

			$month = $this->lifePathNumberRepository->lifePathNumber(Auth::user()->month);
			$day = $this->lifePathNumberRepository->lifePathNumber(Auth::user()->day);
			$year = $this->lifePathNumberRepository->lifePathNumber(Auth::user()->year);
			$life_path_number = $this->lifePathNumberRepository->lifePathNumber($month+$day+$year);

			$western_sign = $this->horoscopeRepository->westernSign(Auth::user()->month, Auth::user()->day);
			$chinese_sign = $this->horoscopeRepository->chineseSign(Auth::user()->year);

			return view('user.account_info')
				->with('life_path_number', $life_path_number)
				->with('western_sign', $western_sign)
				->with('chinese_sign', $chinese_sign);
		}
		else
		{
			return redirect('/');
		}
	}

	public function cafeDetail($id)
	{
		$redirectURL = $this->socialEmptyDOB();
		if( !empty($redirectURL) )
		{
			return redirect($redirectURL);
		}

		if( Auth::check() && Auth::user()->type == "user" )
		{
			$cafeDetail = Cafe::where('id', $id)
   							->with('cafeUsers')
   							->with('getCafeCity')
   							->with('getCafeState')
   							->with('getCafeCountry')
   							->first();

			return view('user.cafe_detail')
				->with('cafeDetail', $cafeDetail);
		}
		else
		{
			return redirect('/');
		}
	}

	public function editUserProfile(Request $request)
	{
		$redirectURL = $this->socialEmptyDOB();
		if( !empty($redirectURL) )
		{
			return redirect($redirectURL);
		}

		if( !Auth::check() )
		{
			return redirect('/');
		}
		
		if( Auth::check() && Auth::user()->type == "user" or Auth::user()->type == "admin" )
		{
			$profileImages = $this->usersProfileImages();
			$activities = $this->activityRepository->all();

			$western_sign = $this->horoscopeRepository->westernSign(Auth::user()->month, Auth::user()->day);
			$chinese_sign = $this->horoscopeRepository->chineseSign(Auth::user()->year);
			
			return view('user.edit_user_profile')
				->with('activities', $activities)
				->with('profileImages', $profileImages)
				->with('western_sign', $western_sign)
				->with('chinese_sign', $chinese_sign);
		}
		else
		{
			return redirect('/');
		}
	}

	public function editUserProfileUpdate(Request $request)
	{
		$redirectURL = $this->socialEmptyDOB();
		if( !empty($redirectURL) )
		{
			return redirect($redirectURL);
		}

		if( !Auth::check() )
		{
			return redirect('/');
		}

		$data  = $request->all();
        $this->userRepository->profileUpdate($data);
		
		return redirect('user/edit-profile-dashboard');
	}

	public function sendMessage(Request $request)
	{
		if( !Auth::check() )
		{
			return redirect('/');
		}

		if( Auth::user()->id != $request->id )
		{
			$userBiography = $this->userRepository->getUserBiography(Auth::user()->id);
			$data = array(
						'user_from_id' => Auth::user()->id,
						'user_to_id' => $request->id,
						'subject' => Auth::user()->name,
						'message' => $userBiography,
					);

			$messageID = $this->messageRepository->getByFromToID(Auth::user()->id, $request->id, 'id');
			$messageID = empty($messageID) ? 0 : $messageID->id;

			$message = $this->messageRepository->StoreUpdate($data, $messageID);
		}
	}

	public function readMail()
	{
		if( !Auth::check() )
		{
			return redirect('/');
		}
		
		$messages = $this->messageRepository->all();

		return view('user.read_mail', compact('messages'));
	}

	public function contactMember($id = null)
   	{
   		$redirectURL = $this->socialEmptyDOB();
		if( !empty($redirectURL) )
		{
			return redirect($redirectURL);
		}

		if( !Auth::check() )
		{
			return redirect('/');
		}
		
		if( $id=='' )
		{
			$id = Auth::user()->id;
		}

		if( Auth::check() && Auth::user()->type == "user" )
		{
			$userDetail = User::where('id', $id)->first();

			if( empty($userDetail) )
			{
				return redirect('/user/dashboard');
			}

            return view('user.contact_member')
					->with('userDetail', $userDetail);
		}
		else
		{
			return redirect('/');
		}
	}

	public function sendContactMember(Request $request)
	{
		if( !Auth::check() )
		{
			return redirect('/');
		}

		$data = array(
					'user_from_id' => Auth::user()->id,
					'user_to_id_number' => $request->ify_id,
					'choose_message' => $request->choose_message,
					'description' => $request->description,
				);

		$contactMember = $this->contactMemberRepository->StoreUpdate($data);

		Session::flash('messageType', 'success');
        Session::flash('message', 'Message sent successfully.');

        return redirect::back();
	}


	// old code start

	public function profile() {
		if(Auth::check() && Auth::user()->type == "user") {
			$states = States::orderBy('nstate','ASC')->get();
			$activities = Activites::orderBy('activity_name','ASC')->get();
			return view('user.profile')->with('states',$states)->with('activities',$activities);
		} else {
			return redirect('/');
		}
	}


    public function terms() {
          
        $data =  DB::table('cms')->select('*')->where('page_name','terms')->first();
            
        return view('user.terms')->with(['content'=>$data->content,'page_name'=>$data->page_name]);
    }

	public function chinese($year)
	{
		$che = '';
		$remeinder = $year%12;
		switch($remeinder){
		case 2:
			$che = 'Dog';
			break;
		case 8:
			$che = 'Dragon';
			break;
		case 11:
			$che = 'Goat';
			break;
		case 10:
			$che = 'Horse';
			break;
		case 0:
			$che = 'Monkey';
			break;
		case 5:
			$che = 'Ox';
			break;
		case 3:
			$che = 'Pig';
			break;
		case 7:
			$che = 'Rabbit';
			break;
		case 4:
			$che = 'Rat';
			break;
		case 1:
			$che = 'Rooster';
			break;
		case 9:
			$che = 'Snake';
			break;
		case 6:
			$che = 'Tiger';
			break;

		default:
			# code...
			break;
		}
		return $che;

	}

	

	public function new_about_profile_update(Request $request) {
		// print_r($request->all());die();
		//echo "<pre>";print_r($request->all());die;

		$month = $this->rec($request->month);
		$day = $this->rec($request->day);
		 $year = $this->rec($request->year);
		$datepoint = $this->rec($month+$day+$year);
		 $cafe = explode(',', $request->cafe);

		 // if($request->cccity)
		 // {
			// $cit = $request->cccity;
		 // }
		 // else
		 // {
		 // 	$cit = $request->cityname;
		 // }
		 

		if(isset($request->firstname) && isset($request->lastname)){
			$name = $request->firstname.' '.$request->lastname;
		}else{
			$name = $request->name;
		}
		User::where('id',Auth::user()->id)->update([
			'name'                  => $name,
			// 'month'   				=> $request->month,
			// 'day'					=> $request->day,
			// 'year'					=> $request->year,
			// 'datepoint'				=> $datepoint,
			'sex'					=> $request->sex,
			'bodytype'				=> $request->bodytype,
			'height'				=> $request->height,									
			'eyecolor'				=> $request->eyecolor,				
			'haircolor'				=> $request->haircolor,			
			'ethnicity'				=> $request->ethnicity,				
			'language'				=> $request->language,				
			'religion'				=> $request->religion,				
			// 'about_gender'			=> $request->about_gender,				
			// 'about_bodytype'		=> $request->about_bodytype,				
			// 'about_height'			=> $request->about_height,				
			// 'about_eyecolor'		=> $request->about_eyecolor	,			
			// 'about_haircolor'		=> $request->about_haircolor,
			// 'about_ethnicity'		=> $request->about_ethnicity,				
			// 'about_language'		=> $request->about_language,
			// 'about_religion'		=> $request->about_religion,				
			// 'state'					=> $request->state,
			// 'live_in'				=> $request->live_in,				
			'activity'				=> $request->activity,
			'matchInterest'			=> $request->matchInterest,
			// 'type_of_relationship'	=> $request->type_of_relationship,				
			// 'chinese_sign'			=> $request->chinese_sign,				
			// 'western_sign'			=> $request->western_sign,				
			// 'cafe'					=> $cafe[0],
			// 'looking_for'			=> $request->looking_for,
			// 'city'                  => $request->cccity,
			// 'ustate'                => $request->states,
			'about_me_details'      => 'fill',
		]);

		if( $request->create_account ) {
			$image = $request->file('profile_image');
			if( $image ) {
				$img = time().'.'.$image->getClientOriginalExtension();
				$destinationPath = public_path('/img');
				$image->move($destinationPath, $img);
				User::where('id',Auth::user()->id)->update([
					'image' => $img
				]);
			}
			User::where('id',Auth::user()->id)->update([
				'account_setup' => 1
			]);
			//$cafe = $this->find_cafes_with_zipCode($request->cafe);
			//return redirect('/user/ThankYou')->with('cafe',$request->cafe);
			return redirect('/user/dashboard');
			// return back()->with('success','Thank you for completing the form.');
		}
		// return back()->with('success','Thank you for completing the form.');
		return redirect('user/register-aboutmymatch');

	}


	public function new_reg_profile_update(Request $request) {
		// dd($request->all());
		// dd($request->sex);

		$month = $this->rec($request->month);
		$day = $this->rec($request->day);
		$year = $this->rec($request->year);
		$datepoint = $this->rec($month+$day+$year);
		$cafe = explode(',', $request->cafe);
		 

		if(isset($request->firstname) && isset($request->lastname)){
			$name = $request->firstname.' '.$request->lastname;
		}else{
			$name = $request->name;
		}
		
		User::where('id',Auth::user()->id)->update([
			'name'                  => $name,
			// 'month'   				=> $request->month,
			// 'day'					=> $request->day,
			// 'year'					=> $request->year,
			// 'datepoint'				=> $datepoint,
			'sex'					=> $request->sex,
			'bodytype'				=> $request->bodytype,
			'height'				=> $request->height,									
			'eyecolor'				=> $request->eyecolor,				
			'haircolor'				=> $request->haircolor,			
			'ethnicity'				=> $request->ethnicity,				
			'language'				=> $request->language,				
			'religion'				=> $request->religion,				
			// 'about_gender'			=> $request->about_gender,				
			// 'about_bodytype'		=> $request->about_bodytype,				
			// 'about_height'			=> $request->about_height,				
			// 'about_eyecolor'		=> $request->about_eyecolor	,			
			// 'about_haircolor'		=> $request->about_haircolor,
			// 'about_ethnicity'		=> $request->about_ethnicity,				
			// 'about_language'		=> $request->about_language,
			// 'about_religion'		=> $request->about_religion,				
			// 'state'					=> $request->state,
			// 'live_in'				=> $request->live_in,				
			'activity'				=> $request->activity,
			'matchInterest'			=> $request->activity,
			// 'type_of_relationship'	=> $request->type_of_relationship,				
			// 'chinese_sign'			=> $request->chinese_sign,				
			// 'western_sign'			=> $request->western_sign,				
			// 'cafe'					=> $cafe[0],
			// 'looking_for'			=> $request->looking_for,
			// 'city'                  => $request->cccity,
			// 'ustate'                => $request->states,
			'about_me_details'      => 'fill',
			'biography'			=> $request->biography,
		]);

		User::where('id', Auth::user()->id)
					->update(['image' => $request->profile_image]);

		if( $request->create_account ) {
			/*$image = $request->file('profile_image');
			if( $image ) {
				$img = time().'.'.$image->getClientOriginalExtension();
				$destinationPath = public_path('/img');
				$image->move($destinationPath, $img);
				User::where('id',Auth::user()->id)->update([
					'image' => $img
				]);
			}*/
			User::where('id',Auth::user()->id)->update([
				'account_setup' => 1
			]);
			//$cafe = $this->find_cafes_with_zipCode($request->cafe);
			//return redirect('/user/ThankYou')->with('cafe',$request->cafe);
			return redirect('/user/dashboard');
			// return back()->with('success','Thank you for completing the form.');
		}
		// return back()->with('success','Thank you for completing the form.');
		// return redirect('user/new_user_aboutmymatch');
		return redirect('user/user-match-info');
	}


	

	public function horoscope_login_update(Request $request) {
		// print_r($request->all());die();
		//echo "<pre>";print_r($request->all());die;

		$month = $this->rec($request->month);
		$day = $this->rec($request->day);
		 $year = $this->rec($request->year);
		$datepoint = $this->rec($month+$day+$year);
		 $cafe = explode(',', $request->cafe);
		if(isset($request->firstname) && isset($request->lastname)){
			$name = $request->firstname.' '.$request->lastname;
		}else{
			$name = $request->name;
		}
		User::where('id',Auth::user()->id)->update([
			'name'                  => $name,
							
			'activity'				=> @$request->activity,
			'matchInterest'			=> @$request->matchInterest,				
			'chinese_sign'			=> $request->chinese_sign,				
			'western_sign'			=> $request->western_sign,				
			'about_me_details'      => 'fill',
		]);
		return redirect('user/login_match_info');

	}


	public function horoscope_update(Request $request) {
		// print_r($request->all());die();
		//echo "<pre>";print_r($request->all());die;

		$month = $this->rec($request->month);
		$day = $this->rec($request->day);
		 $year = $this->rec($request->year);
		$datepoint = $this->rec($month+$day+$year);
		 $cafe = explode(',', $request->cafe);
		if(isset($request->firstname) && isset($request->lastname)){
			$name = $request->firstname.' '.$request->lastname;
		}else{
			$name = $request->name;
		}
		User::where('id',Auth::user()->id)->update([
			'name'                  => $name,
							
			'activity'				=> @$request->activity,
			'matchInterest'			=> @$request->matchInterest,				
			'chinese_sign'			=> $request->chinese_sign,				
			'western_sign'			=> $request->western_sign,				
			'about_me_details'      => 'fill',
		]);
		return redirect('user/user-match-info');

	}


	public function new_aboutme_profile_update(Request $request) {
		// dd($request->all());

		$about_height = '';
		if( $request->about_height )
		{
			$about_height = implode(', ', $request->about_height);
		}
		// echo $about_height.'<br>';

		$about_haircolor = '';
		if( $request->about_haircolor )
		{
			$about_haircolor = implode(', ', $request->about_haircolor);
		}
		// echo $about_haircolor.'<br>';

		$about_language = '';
		if( $request->about_language )
		{
			$about_language = implode(', ', $request->about_language);
		}
		// echo $about_language.'<br>';

		$about_bodytype = '';
		if( $request->about_bodytype )
		{
			$about_bodytype = implode(', ', $request->about_bodytype);
		}
		// echo $about_bodytype.'<br>';

		$about_eyecolor = '';
		if( $request->about_eyecolor )
		{
			$about_eyecolor = implode(', ', $request->about_eyecolor);
		}
		// echo $about_eyecolor.'<br>';

		$about_ethnicity = '';
		if( $request->about_ethnicity )
		{
			$about_ethnicity = implode(', ', $request->about_ethnicity);
		}
		// echo $about_ethnicity.'<br>';

		$about_religion = '';
		if( $request->about_religion )
		{
			$about_religion = implode(', ', $request->about_religion);
		}
		// echo $about_religion.'<br>';

		$month = $this->rec($request->month);
		$day = $this->rec($request->day);
		$year = $this->rec($request->year);
		$datepoint = $this->rec($month+$day+$year);
		$cafe = explode(',', $request->cafe);

		if(isset($request->firstname) && isset($request->lastname)){
			$name = $request->firstname.' '.$request->lastname;
		}else{
			$name = $request->name;
		}
		User::where('id',Auth::user()->id)->update([
			'name'                  => $name,
			// 'month'   				=> $request->month,
			// 'day'					=> $request->day,
			// 'year'					=> $request->year,
			// 'datepoint'				=> $datepoint,
			// 'sex'					=> $request->sex,
			// 'bodytype'				=> $request->bodytype,
			// 'height'				=> $request->height,			
			// 'eyecolor'				=> $request->eyecolor,
			// 'haircolor'				=> $request->haircolor,			
			// 'ethnicity'				=> $request->ethnicity,
			// 'language'				=> $request->language,
			// 'religion'				=> $request->religion,

			'about_gender'			=> $request->about_gender,
			'about_bodytype'		=> $about_bodytype,
			'about_height'			=> $about_height,
			'about_eyecolor'		=> $about_eyecolor,
			'about_haircolor'		=> $about_haircolor,
			'about_ethnicity'		=> $about_ethnicity,
			'about_language'		=> $about_language,
			'about_religion'		=> $about_religion,
			'matchInterest'			=> $request->matchInterest,

			// 'state'					=> $request->state,
			// 'live_in'				=> $request->live_in,
			// 'activity'				=> $request->activity,
			// 'type_of_relationship'	=> $request->type_of_relationship,
			// 'chinese_sign'			=> $request->chinese_sign,
			// 'western_sign'			=> $request->western_sign,
			// 'cafe'					=> $cafe[0],
			// 'looking_for'			=> $request->looking_for,
			// 'city'                  => $request->cccity,
			// 'ustate'                => $request->states,
			// 'about_me_details'      => 'fill',
		]);

		if( $request->create_account ) {
			$image = $request->file('profile_image');
			if( $image ) {
				$img = time().'.'.$image->getClientOriginalExtension();
				$destinationPath = public_path('/img');
				$image->move($destinationPath, $img);
				User::where('id',Auth::user()->id)->update([
					'image' => $img
				]);
			}
			User::where('id',Auth::user()->id)->update([
				'account_setup' => 1
			]);
			//$cafe = $this->find_cafes_with_zipCode($request->cafe);
			//return redirect('/user/ThankYou')->with('cafe',$request->cafe);
			return redirect('/user/dashboard');
			// return back()->with('success','Thank you for completing the form.');
		}

		$_SESSION['user'] = "user";
		// return back()->with('success','Thank you for completing the form.');
		return redirect('user/user-match-info');

	}


	


	public function ThankYou(){
		if(Auth::check() && Auth::user()->type == "user") {
			$user = User::where('id',Auth::user()->id)->first();
			$cafe = $user->cafe;
			$cafe = Cafe::where('zip_code',$cafe)->first();
			return view('user/ThankYou')->with('cafe',$cafe);
		} else {
			return redirect('/');
		}
	}

	public function find_cafes_with_zipCode($cafe){
		if(!empty($cafe)){
			$data = Cafe::where('zip_code',$cafe)->get();
		}else{
			$data = 'null';
		}
		return $data;
	}

	

	public function view_profile($id = null){
		if(Auth::check() && Auth::user()->type == "user") {
			if($id) {
				$userDetail = User::where('id',$id)->with('UserLoc','UserState','payment_status')->first();
				$friends = Friends::where('from',Auth::id())->where('to',$id)->orWhere('from',$id)->where('to',Auth::id())->first();
				$parameters = Session::get('parameters');

				if($parameters) {

					$month = $this->rec($parameters['month']);
					$day = $this->rec($parameters['day']);
					$year = $this->rec($parameters['year']);
					$sum = $this->rec($month+$day+$year);
					$menu_name = $parameters['menu_name'];
					unset($parameters['_token']);
					unset($parameters['menu_name']);
					if(empty($parameters['birthday_match'])) {
						unset($parameters['month']);
						unset($parameters['day']);
						unset($parameters['year']);
					}

					unset($parameters['birthday_match']);
					$parameters = array_filter($parameters);
					$previous = User::select('id')->where('datepoint',$sum)->where($parameters)->where('id','<',$userDetail->id)->where('delete_account','0')->orderBy('id','desc')->first();
					$next = User::select('id')->where('datepoint',$sum)->where('delete_account','0')->where($parameters)->where('id','>',$userDetail->id)->first();
				} else {
					$previous = array();
					$next = array();
					$menu_name = '';
				}
			} else {
				Session::forget('parameters'); 
				$userDetail = User::where('id',Auth::user()->id)->with('UserLoc','UserState')->first();	
				$friends = array();
				$previous = array();
				$next = array();
				$menu_name = '';
			}
			return view('user.view_profile')->with('userDetail',$userDetail)->with('friends',$friends)->with('previous',$previous)->with('next',$next)->with('menu_name',$menu_name);
		} else {
			return redirect('/');
		}
	}

	/*public function search_view_profile($id = null){
		if(Auth::check() && Auth::user()->type == "user") {
			if($id) {
				$userDetail = User::where('id',$id)->with('UserLoc','UserState')->first();
				$friends = Friends::where('from',Auth::id())->where('to',$id)->orWhere('from',$id)->where('to',Auth::id())->first();

				$previous = User::select('id')->where('datepoint',$userDetail->datepoint)->where('sex',$userDetail->sex)->where('id','<',$userDetail->id)->orderBy('id','desc')->first();
        		$next = User::select('id')->where('datepoint',$userDetail->datepoint)->where('sex',$userDetail->sex)->where('id','>',$userDetail->id)->first();

			} else {
				$userDetail = User::where('id',Auth::user()->id)->with('UserLoc','UserState')->first();	
				$friends = array();
				$previous = array();
				$next = array();
			}
			return view('user.view_profile')->with('userDetail',$userDetail)->with('friends',$friends)->with('previous',$previous)->with('next',$next);
		} else {
			return redirect('/');
		}
	}*/


	public function getCafes($loc) {
		$getCafes = Cafe::where('zip_code','like',$loc.'%')->orderBy('store_name')->limit(16)->get();
		$cafeResult = '<ul id="country-list">';
		foreach ($getCafes as $cafe) {
			$cafeResult.= "<li data-location='".$cafe->store_name." #".$cafe->zip_code."' data-zip-code='".$cafe->zip_code."'>".$cafe->store_name.", #".$cafe->zip_code." (".$cafe->address_line_1.")</li>";
		}
		$cafeResult.= '</ul>';
		return $cafeResult;
	}


	public function advance_search() {
		Session::forget('parameters');
		if(Auth::check() && Auth::user()->type == "user") {
			return view('user.advance_search');
		} else {
			return redirect('/');
		}
	}

	public function advance_search_results(Request $request) {
		$month = $this->rec($request->month);
		$day = $this->rec($request->day);
		$year = $this->rec($request->year);
		$sum = $this->rec($month+$day+$year);
		$data = $request->all();
		unset($data['_token']);
		unset($data['birthday_match']);
		unset($data['menu_name']);
		if(empty($request->birthday_match)) {
			unset($data['month']);
			unset($data['day']);
			unset($data['year']);
		}
		$data = array_filter($data);
		Session::put('parameters',$request->all());
		$getUser = User::where(['datepoint' => $sum])->where('delete_account','0')->where($data)->paginate(10);
		return view('user.advance_search')->with('users',$getUser)->with('parameters',$request->all());
	}

	

	public function search_cafe_by_loc(Request $request){
		$data =array();
		if($request->keyword) {
			$getCafes = Cafe::where('zip_code','like','%'.$request->keyword.'%')->orderBy('store_name')->limit(15)->get();
			foreach($getCafes as $cafe) {
				$bdf=explode("-",$cafe->zip_code);
				$data[$cafe->zip_code]=$cafe->zip_code."-".$cafe->store_name;
			}
			return implode("::",$data);
		}else if($request->get_address){
				if($request->country != '')
				{
					$conditions  = [

						['country','=',$request->country]

					];
				}
				else
				{
					$conditions = [

						['country','=',$request->continent]
					];
				}
			$getCafes = Cafe::where($conditions)->where('address_line_1','like','%'.$request->get_address.'%')->orderBy('store_name')->limit(15)->get();

			//echo "<pre>";print_r($getCafes);die;

			foreach($getCafes as $cafe) {
				$bdf=explode("-",$cafe->zip_code);
				$data[$cafe->zip_code]=$cafe->address_line_1;
			}
			return implode("::",$data);
		} else {
			if(strlen($request->get_state) < 2) {
				$states = States::where('state_code','like','%'.$request->get_state.'%')->orderBy('state_code')->limit(15)->get();
			} else {
				$states = States::where('nstate','like','%'.$request->get_state.'%')->orderBy('nstate')->limit(15)->get();
			}
			foreach($states as $state) {
				$bdf=explode("-",$state->state_code);
				$data[]=$state->state_code;
				$data[]=$state->nstate;
			}
			return implode("::",$data);
		}
	}

	public function find_cafes($cafe, $continent, $country)
	{
		if( strpos($cafe,'-')!=false )
		{
			$new_zip = explode("-", $cafe);
			$new_zip = $new_zip[0];
			$cafe = $new_zip;
		}

		$data = array();
		if( $continent == 'Europe' || $continent == 'Canada' || $continent == 'England' )
		{
			if($country != '')
			{
				$conditions  = [
					['country','=',$country]
				];
			}
			else
			{
				$conditions = [
					['country','=',$continent]
				];
			}

			$data = Cafe::where($conditions)
						->where('zip_code', 'like', '%'.$cafe.'%')
						->get();
		}
		else
		{
			// if(is_numeric($cafe)){
			// 	$data = Cafe::where('zip_code','like','%'.$cafe.'%')->get();

			// } else{
				//dd($cafe);
				$search = explode(",", $cafe);
				
				$count = count($search);

				//$cond = [];
				//$search = array('store_name' => '', 'city' => '', 'country' => '', 'zip_code' => '');
				//dd($search);
				//$search = array('','','','');
				switch($count){
					case 1 :
					$cond = ['store_name' => $search[0]];
					break;
					case 2 :
					$cond = ['store_name' => $search[0], 'city' => $search[1]];
					break;
					case 3 :
					$cond = ['store_name' => $search[0], 'city' => $search[1], 'country' => $search[2]];
					break;
					case 4 :
					$cond = ['store_name' => $search[0], 'city' => $search[1], 'country' => $search[2], 'zip_code' => $search[3] ];
					break;
					default:
					$cond = [];
				}

				
				// if($count == 1){
					// $data = Cafe::orWhere('store_name','LIKE','%'.$cond['store_name'].'%')->get();
					// $data = Cafe::where('zip_code','like','%'.$cafe.'%')->with('cafeUsers')->get();
				// }else{
					$data = Cafe::orWhere($cond)->get();

				// }
				

				//dd($data);
				// dd($data);
				// if(strlen($cafe)<=2){
				// 	$data = Cafe::where('state',$cafe)->get();
				// } else{
				// 	$state = States::select('state_code')->where('nstate',$cafe)->first();
				// 	if(!empty($state->state_code)){
				// 	$data = Cafe::where('state',$state->state_code)->get();
				// 	}
				// }
			// }
		}
		return $data;
	}

	

	

	


	public function search_member(){
		if(Auth::check() && Auth::user()->type == "user") {
			return view('user.search_member');
		} else {
			return redirect('/');
		}
	}
	
	

	public function mailbox() {
		if(Auth::check() && Auth::user()->type == "user") {

			$payments =  DB::table('payments')->select('*')->where('user_id',Auth::user()->id)->where('status','Current')->first();
			$today = date('Y-m-d H:i:s');
			if($payments != '')
			{
				if($today > $payments->expiry_date)
				{
					$pay = DB::table('payments')->where('user_id',Auth::user()->id)->update(['status' => 'Previous']);

					$payments = DB::table('payments')->select('*')->where('user_id',Auth::user()->id)->where('status','Current')->first();
				}
			}

			$allMails = array();
			$msg = Msg::where('del_to',Auth::id())->orWhere('del_from',Auth::id())->groupBy('mid')->get();
			foreach ($msg as $key => $value) {
				$data = Msg::where('del_to',Auth::id())->where('mid',$value->mid)->orderBy('id','desc')->limit(1)->first();
				if($data) {
					$data->subject = $value->subject;
					$allMails[$key] = $data;
				}
			}
			$allMails2 = array();
			$msg2 = Msg::where('del_from',Auth::id())->orWhere('del_to',Auth::id())->groupBy('mid')->get();
			foreach ($msg2 as $value) {
				$data = Msg::where('del_from',Auth::id())->where('mid',$value->mid)->orderBy('id','desc')->limit(1)->first();
				if($data) {
					$data->subject = $value->subject;
					$allMails2[] = $data;
				}
			}
			return view('user.mailbox')->with('allMails',$allMails)->with('allMails2',$allMails2)->with('payments',$payments);
		} else {
			return redirect('/');
		}
	}

	public function getChat($mid) {
		if(Auth::check() && Auth::user()->type == "user") {
			$msg = Msg::where('mid',$mid)->with('send_user')->get();
			return view('user.chat')->with('msg',$msg);
		} else {
			return redirect('/');
		}	
	}

	public function chat_message(Request $request) {
		Msg::create([
			'from' => Auth::id(),
			'to'   => $request->to,
			'message' => $request->message,
			'mid'	  => $request->mid,
			'del_from' => Auth::id(),
			'del_to'  => $request->to
		]);

		return back();
	}

	

	public function delete_chat(Request $request) {
		if($request->delmail) {
			foreach ($request->delmail as $value) {
				Msg::where('from',Auth::id())->where('id',$value)->update([
					'del_from' => 0
				]);

				Msg::where('to',Auth::id())->where('id',$value)->update([
					'del_to' => 0
				]);
			}
		}
		return back();
	}

	public function photos() {
		if(Auth::check() && Auth::user()->type == "user" or Auth()::user()->type == "admin") {
			$getImages = Images::where('userId',Auth::user()->id)->get();
			return view('user.photos')->with('getImages',$getImages);
		} else {
			return redirect('/');
		}
	}
	
	

	public function photos_upload(Request $request){

		foreach ($request->photos as $photos) {
			$img = uniqid().'.'.$photos->getClientOriginalExtension();
			$destinationPath = public_path('/img');
			$photos->move($destinationPath, $img);
			Images::create([
				'userId' => Auth::user()->id,
				'image'  => $img
			]);
		}

		return redirect('/user/photos');
	}


	public function friend_request() {
		if(Auth::check() && Auth::user()->type == "user") {
			$friends = Friends::where('to',Auth::id())->where('status',0)->with('friendsDetail')->get();
			return view('user.friend_request')->with('friends',$friends);
		} else {
			return redirect('/');
		}
	}

	public function add_friend(Request $request) {
		$check = Friends::where('from',Auth::id())->where('to',$request->to)->count();
		if($check  < 1) {
			Friends::create([
				'from' => Auth::user()->id,
				'to'   => $request->to	
			]);
		}

		return back();
	}

	public function cancel_request(Request $request) {
		if($request->to) {
			Friends::where(['from' => Auth::user()->id, 'to' => $request->to ])->delete();
		} else {
			Friends::where(['from' => $request->from ,'to' => Auth::id()])->delete();	
		}
		return back();
	}

	public function confirm_request(Request $request) {
		Friends::where(['from' => $request->from ,'to' => Auth::id()])->update(['status' => 1]);
		return back();
	}

	public function count_request() {
		return $get = Friends::where('to',Auth::id())->where('status',0)->count();
	}


	public function getFriends($to) {
		//$getFriends = Friends::where('from',Auth::id())->orWhere('to',Auth::id())->get();
		$getFriends = User::where('name','like','%'.$to.'%')->orWhere('email','like','%'.$to.'%')->where('type','user')->get();
		$allUsers = '<ul id="search-cafe-result">';
		foreach ($getFriends as $value) {
			//$getUser = User::where('id',$value->from)->where('name','like','%'.$to.'%')->orWhere('id',$value->to)->where('name','like','%'.$to.'%')->first();
			if($value && $value->id != Auth::id()) {
				if($value->name) {
					$allUsers.= '<li data-id="'.$value->id.'" data-email="'.$value->email.'">'.$value->name.', '.$value->email.'</li>'; 
				} else {
					$allUsers.= '<li data-id="'.$value->id.'" data-email="'.$value->email.'">'.$value->email.'</li>'; 
				}
			}
		}
		$allUsers.= '</ul>';

		return $allUsers;
	}

	/*public function getFriends($to) {
		$getFriends = Friends::where('from',Auth::id())->orWhere('to',Auth::id())->get();
		$allUsers = '<ul id="search-cafe-result">';
		foreach ($getFriends as $value) {
			$getUser = User::where('id',$value->from)->where('name','like','%'.$to.'%')->orWhere('id',$value->to)->where('name','like','%'.$to.'%')->first();
			if($getUser && $getUser['id'] != Auth::id()) {
				$allUsers.= '<li data-id="'.$getUser['id'].'" data-email="'.$getUser['email'].'">'.$getUser['name'].', '.$getUser['email'].'</li>'; 
			}
		}
		$allUsers.= '</ul>';

		return $allUsers;
	}*/

	public function delete_image(Request $request) {
		$file_path = public_path('/img/').$request->image;
		if(file_exists($file_path))
		{
		 	unlink($file_path);
		}
		Images::where('id',$request->photoId)->delete();
		User::where('id',Auth::user()->id)->update(['image'=>'']);
		return back();
	}

	public function account_setup() {
		if(Auth::check()) {
			if(Auth::user()->continent!='' && Auth::user()->continent=='Europe'){
				$country = Auth::user()->country;
			}else{
				$country = Auth::user()->continent;
			}

			$states = States::orderBy('nstate','ASC')->get();
			$activities = Activites::orderBy('activity_name','ASC')->get();

			$cities =  DB::table('cities')->where('country_id',function($query) use($country){
				$query->select('id')->from('country')->where('country.country_name','=',$country);
			})->get();

			// echo "<pre>";print_r($cities);die;

			$h = DB::table('horoscope')
	            ->get()->toArray();

			$day = Auth::user()->day;
			$month = Auth::user()->month;
			$zod_sign = $this->zodic_sign($month,$day);

			return view('user.account_setup')->with('states',$states)->with('activities',$activities)->with('zodic',$zod_sign)
			->with('cities',$cities);
		} else {
			return redirect('/');
		}
	}

	

	public function register_aboutmymatch(Request $request){
		if(Auth::check() && Auth::user()->type == "user" or Auth::user()->type == "admin") {
			$cafe = array();
			$cafe_zipcode = explode(',',Auth::user()->cafe);
			if(Auth::user()->cafe!=''){
				$cafe = Cafe::where('zip_code',$cafe_zipcode[0])->first();
			}

			$cafe_modify = DB::table('cafe')->select('address_line_1','store_name','city','country','zip_code')->where('zip_code','=',Auth::user()->cafe)->first();

			$dd = DB::table('state')->select('nstate')->where('state_code',Auth::user()->ustate)->get();
			$ee = DB::table('cafe')->select('city')->where('country_code','US')->where('city',Auth::user()->city)->get();

			$states = States::orderBy('nstate','ASC')->get();

			$liveincity = DB::table('cafe')->select('city')->where('country_code','US')->get();


			$activities = Activites::orderBy('activity_name','ASC')->get();

			if(Auth::user()->continent!='' && Auth::user()->continent=='Europe'){
				$country = Auth::user()->country;
			}else{
				$country = Auth::user()->continent;
			}

			$cities =  DB::table('cities')->where('country_id',function($query) use($country){
				$query->select('id')->from('country')->where('country.country_name','=',$country);
			})->get();

			$day = Auth::user()->day;
			$month = Auth::user()->month;
			$zod_sign = $this->zodic_sign($month,$day);
			
			return view('user.register-aboutmymatch')->with('states',$states)->with('activities',$activities)->with('cafe',$cafe)->with('cities',$cities)->with('zodic',$zod_sign)->with('cafe_modify',$cafe_modify)->with('liveincity',$liveincity)->with('dd',$dd)->with('ee',$ee);
		 } 
		// 	else {
			return redirect('/');
		// }
		// return view('user.edit_user_profile');
	}

	public function new_user_edit_profile(Request $request){

		if( !Auth::check() ) {
			return redirect('/login');
		}

		if(Auth::check() && Auth::user()->type == "user" or Auth::user()->type == "admin") {
			$cafe = array();
			$cafe_zipcode = explode(',',Auth::user()->cafe);
			if(Auth::user()->cafe!=''){
				$cafe = Cafe::where('zip_code',$cafe_zipcode[0])->first();
			}

			$cafe_modify = DB::table('cafe')->select('address_line_1','store_name','city','country','zip_code')->where('zip_code','=',Auth::user()->cafe)->first();

			$dd = DB::table('state')->select('nstate')->where('state_code',Auth::user()->ustate)->get();
			$ee = DB::table('cafe')->select('city')->where('country_code','US')->where('city',Auth::user()->city)->get();

			$states = States::orderBy('nstate','ASC')->get();

			$liveincity = DB::table('cafe')->select('city')->where('country_code','US')->get();


			$activities = Activites::orderBy('activity_name','ASC')->get();

			if(Auth::user()->continent!='' && Auth::user()->continent=='Europe'){
				$country = Auth::user()->country;
			}else{
				$country = Auth::user()->continent;
			}

			$cities =  DB::table('cities')->where('country_id',function($query) use($country){
				$query->select('id')->from('country')->where('country.country_name','=',$country);
			})->get();

			$day = Auth::user()->day;
			$month = Auth::user()->month;
			$zod_sign = $this->zodic_sign($month,$day);
			$_SESSION['user'] = "user";
			// print_r($_SESSION['user']);
			return view('user.new_user_edit_profile')->with('states',$states)->with('activities',$activities)->with('cafe',$cafe)->with('cities',$cities)->with('zodic',$zod_sign)->with('cafe_modify',$cafe_modify)->with('liveincity',$liveincity)->with('dd',$dd)->with('ee',$ee);
		 } 
		// 	else {
		// 	return redirect('/');
		// }
		return view('user.new_user_edit_profile');
	}

	

	

	public function new_user_aboutme(Request $request){

		if( !Auth::check() ) {
			return redirect('/login');
		}

		if(Auth::check() && Auth::user()->type == "user" or Auth::user()->type == "admin") {
			$cafe = array();
			$cafe_zipcode = explode(',',Auth::user()->cafe);
			if(Auth::user()->cafe!=''){
				$cafe = Cafe::where('zip_code',$cafe_zipcode[0])->first();
			}

			$cafe_modify = DB::table('cafe')->select('address_line_1','store_name','city','country','zip_code')->where('zip_code','=',Auth::user()->cafe)->first();

			$dd = DB::table('state')->select('nstate')->where('state_code',Auth::user()->ustate)->get();
			$ee = DB::table('cafe')->select('city')->where('country_code','US')->where('city',Auth::user()->city)->get();

			$states = States::orderBy('nstate','ASC')->get();

			$liveincity = DB::table('cafe')->select('city')->where('country_code','US')->get();


			$activities = Activites::orderBy('activity_name','ASC')->get();

			if(Auth::user()->continent!='' && Auth::user()->continent=='Europe'){
				$country = Auth::user()->country;
			}else{
				$country = Auth::user()->continent;
			}

			$cities =  DB::table('cities')->where('country_id',function($query) use($country){
				$query->select('id')->from('country')->where('country.country_name','=',$country);
			})->get();

			$day = Auth::user()->day;
			$month = Auth::user()->month;
			$zod_sign = $this->zodic_sign($month,$day);
			$profileImages = $this->usersProfileImages();
			
			return view('user.new_user_aboutme')->with('states',$states)->with('activities',$activities)->with('cafe',$cafe)->with('cities',$cities)->with('zodic',$zod_sign)->with('cafe_modify',$cafe_modify)->with('liveincity',$liveincity)->with('dd',$dd)->with('ee',$ee)->with('profileImages', $profileImages);
		 } 
		// 	else {
		// 	return redirect('/');
		// }
		return view('user.new_user_aboutme');
	}


	


	public function new_user_aboutmymatch(Request $request){
		if( !Auth::check() ) {
			return redirect('/login');
		}
		
		if(Auth::check() && Auth::user()->type == "user" or Auth::user()->type == "admin") {
			$cafe = array();
			$cafe_zipcode = explode(',',Auth::user()->cafe);
			if(Auth::user()->cafe!=''){
				$cafe = Cafe::where('zip_code',$cafe_zipcode[0])->first();
			}

			$cafe_modify = DB::table('cafe')->select('address_line_1','store_name','city','country','zip_code')->where('zip_code','=',Auth::user()->cafe)->first();

			$dd = DB::table('state')->select('nstate')->where('state_code',Auth::user()->ustate)->get();
			$ee = DB::table('cafe')->select('city')->where('country_code','US')->where('city',Auth::user()->city)->get();

			$states = States::orderBy('nstate','ASC')->get();

			$liveincity = DB::table('cafe')->select('city')->where('country_code','US')->get();


			$activities = Activites::orderBy('activity_name','ASC')->get();

			if(Auth::user()->continent!='' && Auth::user()->continent=='Europe'){
				$country = Auth::user()->country;
			}else{
				$country = Auth::user()->continent;
			}

			$cities =  DB::table('cities')->where('country_id',function($query) use($country){
				$query->select('id')->from('country')->where('country.country_name','=',$country);
			})->get();

			$day = Auth::user()->day;
			$month = Auth::user()->month;
			$zod_sign = $this->zodic_sign($month,$day);
			
			return view('user.new_user_aboutmymatch')->with('states',$states)->with('activities',$activities)->with('cafe',$cafe)->with('cities',$cities)->with('zodic',$zod_sign)->with('cafe_modify',$cafe_modify)->with('liveincity',$liveincity)->with('dd',$dd)->with('ee',$ee);
		 } 
		// 	else {
		// 	return redirect('/');
		// }
		return view('user.new_user_aboutmymatch');
	}

	

	public function match_info(Request $request){

		if( !Auth::check() ) {
			return redirect('/login');
		}

		if(Auth::check() && Auth::user()->type == "user" or Auth::user()->type == "admin") {
			$cafe = array();
			$cafe_zipcode = explode(',',Auth::user()->cafe);
			if(Auth::user()->cafe!=''){
				$cafe = Cafe::where('zip_code',$cafe_zipcode[0])->first();
			}

			$cafe_modify = DB::table('cafe')->select('address_line_1','store_name','city','country','zip_code')->where('zip_code','=',Auth::user()->cafe)->first();

			$dd = DB::table('state')->select('nstate')->where('state_code',Auth::user()->ustate)->get();
			$ee = DB::table('cafe')->select('city')->where('country_code','US')->where('city',Auth::user()->city)->get();

			$states = States::orderBy('nstate','ASC')->get();

			$liveincity = DB::table('cafe')->select('city')->where('country_code','US')->get();


			$activities = Activites::orderBy('activity_name','ASC')->get();

			if(Auth::user()->continent!='' && Auth::user()->continent=='Europe'){
				$country = Auth::user()->country;
			}else{
				$country = Auth::user()->continent;
			}

			$cities =  DB::table('cities')->where('country_id',function($query) use($country){
				$query->select('id')->from('country')->where('country.country_name','=',$country);
			})->get();

			$day = Auth::user()->day;
			$month = Auth::user()->month;
			$zod_sign = $this->zodic_sign($month,$day);
			
			return view('user.new-edit-profile')->with('states',$states)->with('activities',$activities)->with('cafe',$cafe)->with('cities',$cities)->with('zodic',$zod_sign)->with('cafe_modify',$cafe_modify)->with('liveincity',$liveincity)->with('dd',$dd)->with('ee',$ee);
		 } 
			else {
			return redirect('/');
		}
		return view('user.new-edit-profile');
	}



	
	

	
	public function insta_match() {
		Session::forget('parameters');
		if(Auth::check() && Auth::user()->type == "user"){
			$cafe_location = Input::get('cafe_location');
			$create_account = Input::get('create_account');
			$day = Auth::user()->day;
			$month = Auth::user()->month;
			$year = Auth::user()->year;
			$cafe = Auth::user()->cafe;
			$continent = Input::get('continent');
			$country = Input::get('country');
			$city = Input::get('city');
			$loc = Input::get('loc');
			$ustate = Input::get('ustate');
			$lop = Input::get('lop');

			$states = DB::table('state')->select('*')->orderBy('nstate','asc')->get();
			$cafee = DB::table('cafe')->select('address_line_1')->where('zip_code',$loc)->get();

			$cafeee = DB::table('cafe')->select('store_name','city','country','zip_code')->where('zip_code','=',$lop)->get();
			if(Auth::user()->continent!='' && Auth::user()->continent=='Europe'){
				$country = Auth::user()->country;
			}else{
				$country = Auth::user()->continent;
			}

			$cities =  DB::table('cities')->where('country_id',function($query) use($country){
				$query->select('id')->from('country')->where('country.country_name','=',$country);
			})->get();




			if($cafe_location) {
				$getCafes = $this->find_cafes_with_location($cafe_location,$day,$month,$year,$continent,$country);
			} else {
				$getCafes = $this->find_cafes_with_location($cafe,$day,$month,$year,$continent,$country);
				
			}

			if($create_account) {
				return $getCafes;
			}	
			
			return view('user.insta_match')->with('cafes',$getCafes)->with('cities',$cities)->with('city',$city)->with('loc',$loc)->with('cafee',$cafee)->with('states',$states)->with('ustate',$ustate)->with('cafeee',$cafeee)->with('cafe_location',$cafe_location)->with('lop',$lop);
		} else{
			return redirect('/');
		}

	}
	public function find_cafes_with_location($cafe,$d,$m,$y,$continent,$country) {
		if(strpos($cafe,'-')!=false){
			$new_zip = explode("-", $cafe);
			$new_zip = $new_zip[0];
			$cafe = $new_zip;
		}
		$sum = 0;
		if($d) {
			$month = $this->rec($m);
			$day = $this->rec($d);
			$year = $this->rec($y);
			$sum = $this->rec($month+$day+$year);
		}
		$data = array();

		if($continent == 'Canada' || $continent == 'Europe' || $continent == 'England')
		{
			if($country != '')
			{
				$conditions  = [

					['country','=',$country]

				];
			}
			else
			{
				$conditions = [

					['country','=',$continent]
				];
			}
			
			$data = Cafe::where($conditions)->where('address_line_1','like','%'.$cafe.'%')->with('cafeUsers')->with(['cafeUsers' => function($query) use($sum){
						$query->where('datepoint',$sum); 
						$query->where('id','!=',Auth::user()->id);
						$query->where('delete_account','0');
						$query->get();
					}])
					->get();

					
		}else{

			if(is_numeric($cafe)){
					$data = Cafe::where('city_id','like','%'.$cafe.'%')->with('cafeUsers')->with(['cafeUsers' => function($query) use($sum){
						$query->where('datepoint',$sum); 
						$query->where('id','!=',Auth::user()->id);
						$query->where('delete_account','0');
						$query->get();
					}])
					->get();
			} else{
				if(strlen($cafe)<=2){
					$data = Cafe::where('state',$cafe)->with('cafeUsers')->with(['cafeUsers' => function($query) use($sum){
						$query->where('datepoint',$sum); 
						$query->where('id','!=',Auth::user()->id); 
						$query->where('delete_account','0');
						$query->get();
					}])
					->get();
				} else{
					$state = States::select('state_code')->where('nstate',$cafe)->first();
					if(!empty($state->state_code)){
						$data = Cafe::where('state',$state->state_code)->with('cafeUsers')->with(['cafeUsers' => function($query) use($sum){
							$query->where('datepoint',$sum); 
							$query->where('id','!=',Auth::user()->id);
							$query->where('delete_account','0');
							$query->get();
						}])
						->get();
					}
				}
			}
		}

		return $data;
	}
	public function cafe_location(){

		if( !Auth::check() ) {
			return redirect('/login');
		}
	
		if( Auth::user()->continent!='' && Auth::user()->continent=='Europe' )
		{
			$country = Auth::user()->country;
		}
		else
		{
			$country = Auth::user()->continent;
		}

		$cafe_modify = DB::table('cafe')
						->select('address_line_1','store_name','country','city','zip_code')
						->where('zip_code','=',Auth::user()->cafe)
						->first();

		$cities =  DB::table('canada_cities')
                        ->orderBy('city', 'ASC')
                        ->get();

		$data = DB::table('canada_provinces')
					->select('*')
					->orderBy('canada_province','asc')
					->get();

		return view('/user/cafe_location')
					->with('cities', $cities)
					->with('cafe_modify', $cafe_modify)
					->with('data', $data);
	}

	public function delete_account(Request $request){
		User::where('id',Auth::user()->id)->update(['delete_account'=>'1']);
		// return redirect('/logout');
        Auth::logout();
	}

	public function deleteimage(Request $request){
        // print_r($request->all());die();
        $res = User::where('id',Auth::user()->id)->update(['image'=> null]);
        echo $res;
    }
	public function update_cafe_location(Request $request){
		//echo "<pre>";print_r($request->all());die;
		if($request->cafe!=''){
			$data = DB::table('state')->select('*')->orderBy('nstate','asc')->get();
			User::where('id',Auth::user()->id)->update(['cafe'=>$request->cafe]);
			User::where('id',Auth::user()->id)->update(['city'=>$request->city]);
			if(Auth::user()->continent == 'USA')
			{
				User::where('id',Auth::user()->id)->update(['ustate'=>$request->ustate]);
			}
			else
			{
				User::where('id',Auth::user()->id)->update(['ustate'=> NULL ]);
			}
			// print_r($data);die();
			Session::flash('success','Cafe location has been updated successfully.');
			return redirect('/user/cafe-location')->with('data',$data);	
		}else{
			$data = DB::table('state')->select('*')->orderBy('nstate','asc')->get();
			return redirect('/user/cafe-location')->with('success','Please Enter a zip code to choose a new cafe location')->with('data',$data);	
		}
	}
	public function Calculator(){
		if(Auth::check() && Auth::user()->type == "user") {
			return view('user.calculator');
		} else {
			return redirect('/');
		}

	}
	
	public function UpdateImage(Request $request) {
		User::where('id',Auth::user()->id)->update(['image'=>$request->image]);
		return redirect('/user/change-photo');
	}

	public function changeUserImage(Request $request) {
		
		 if(Auth::check() && Auth::user()->type == "user" or Auth::user()->type == "admin")
		 {
			$image = $request->file('file');
			$img = time().'.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/img/');
			$image->move($destinationPath, $img);

			if(Auth::user()->image!=null)
			{
				$file_path =public_path('/img/').Auth::user()->image;
				if(file_exists($file_path))
				{
					unlink($file_path);
				}
			}
			User::where('id',Auth::user()->id)->update(['image' => $img]);
		}
		else
		{
			echo "";
		} 
		echo $img;
	}

	public function showlocations(Request $request)
   	{ 

   		if(Auth::user()->continent == 'Europe')
   		{
   			$country = Auth::user()->country;
   		}
   		else
   		{
   			$country = Auth::user()->continent;
   		}

        $data =  DB::table('cafe')->select('id','store_name','address_line_1','zip_code')->where('country',$country)->where('city','=',$request->city)->get();

        $html ='<option value="">Select Cafe Location</option>';
         foreach ($data as $key => $value) {
           // $html .= '<option value="'.$value->zip_code.'">'.$value->store_name.', '.$value->address_line_1.'</option>';
         	$html .= '<option value="'.$value->zip_code.'">'.$value->address_line_1.'</option>';
         	

         }
         echo $html;
   }

   public function selectedlocation(Request $request)
   {
        $data = DB::table('cafe')
        		->select('id','country','city','address_line_1','store_name','zip_code')
        		->where('zip_code','=',$request->zip_code)
        		->get();

        echo $data;
   }

   public function leaving(Request $request)
   {
   		if(Auth::check() && Auth::user()->type == "user") 
   		{
   			return view('user.leaving');
   		}
   		else
   		{
   			return redirect('/');
   		}
   }

   function usersData($sex,$continent,$country,$sum,$request){
   		$getUser = '';
   		if($sex == 'All'){
   			if($continent == 'Canada' || $continent == 'Europe' || $continent == 'England'){
   				if($country != ''){
   					$conditions  = [ 
   						['country','=',$country]
					];
				} else {
					$conditions = [
						['continent','=',$continent]
					];
				}

				$getUser = User::where(['datepoint' => $sum,'delete_account'=>0])->where($conditions)->paginate(10);
			} else {
				$conditions = [
					['continent','=','USA']
				];

				$getUser = User::where(['datepoint' => $sum,'delete_account'=>0])->where($conditions)->paginate(10);
			}
		}else{
			if($continent == 'Canada' || $continent == 'Europe' || $continent == 'England'){
				if($country != ''){
					$conditions  = [
						['country','=',$country]
					];
				} else {
					$conditions = [
						['continent','=',$continent]
					];
				}
				$getUser = User::where(['datepoint' => $sum, 'sex' => $request->sex,'delete_account'=>0])->where($conditions)->paginate(10);
			}else{
				$conditions = [
					['continent','=','USA']
				];
				$getUser = User::where(['datepoint' => $sum, 'sex' => $request->sex,'delete_account'=>0])->where($conditions)->paginate(10);
			}
		}
		return $getUser;
   }

   public function search_result(Request $request) 
   {
   // 		if($request->month!='' && $request->day!='' && $request->year!='' && $request->sex!='')
   // 		{
   // 			$month = $this->rec($request->month);
			// $day = $this->rec($request->day);
			// $year = $this->rec($request->year);
			// $sum = $this->rec($month+$day+$year);
			// $sex = $request->sex;
			// $getUser = $this->usersData($sex,$continent,$country,$sum,$request);
			// $request->session()->put('parameters',$request->all());
			// return view('user.search_result')->with('users',$getUser)->with('sum',$sum)->with('sex', $sex)->with('cities',$cities)->with('parameters',$request->all());

        if ($request->first_Name != '' ) {
            $firstName = $request->first_Name;
            $lastName = $request->last_Name;
            $name =  $firstName; 
            $sex = "All";
            // $continent = $request->continent;
            // $location = $request->country;
			$country = Auth::user()->country;
			$continent = Auth::user()->continent;
			$cities =  DB::table('cities')->where('country_id',function($query) use($country){
			$query->select('id')->from('country')->where('country.country_name','=',$country);
			})->get();

            $getUser = User::where(['name' => $name,'delete_account'=>0])->paginate(10);
            $request->session()->put('parameters',$request->all());
            // return view('user.search_result')->with('users',$getUser)->with('sex',$sex)->with('parameters',$request->all());
            
            return view('user.search_result')->with('users',$getUser)->with('sex', $sex)->with('cities',$cities)->with('parameters',$request->all());
   		}
   		else
   		{
   			if(isset($_GET['page']) && isset($_GET['sum']) && isset($_GET['sex']))
   			{
   				$sum =  $_GET['sum'];
				$sex = $_GET['sex'];
				$country = Auth::user()->country;
				$continent = Auth::user()->continent;

				$cities =  DB::table('cities')->where('country_id',function($query) use($country){
					$query->select('id')->from('country')->where('country.country_name','=',$country);
				})->get();

				$getUser = $this->usersData($sex,$continent,$country,$sum,$request);
				
				return view('user.search_result')->with('users',$getUser)->with('parameters',$request->session()->get('parameters'))->with('sum',$sum)->with('sex', $sex)->with('cities',$cities);

   			}
   			else
   			{
   				return redirect('/user/search-member');  
   			}
   		}
   }

   public function all_search(Request $request){
   	if ($request->search_result != '' ) {
   		$name = $request->search_result;
   		$users=DB::table('users')->where('name','LIKE','%'.$name."%")->orWhere('email','LIKE','%'.$name."%")->paginate(4);
   		
   		// return response()->json($users);
   		// return json_encode(array('users'=>$users));
   		return view('searchResultsRender')->with(['allusers'=>$users,'search_result'=>$request->search_result]);
   	}else{
   		// return json_encode(array('users'=> ''));
   	}

   }

   public function all_user(Request $request){
		if ($request->search_result != '' ) {
	   		$name = $request->search_result;
	   		$users=DB::table('users')->where('name','LIKE','%'.$name."%")->orWhere('email','LIKE','%'.$name."%")->get();
	   		// echo '<pre>';
	   		// print_r($users);
	   		// die;
	   		// return response()->json($users);
	   		// return json_encode(array('users'=>$users));
	   		return view('user.all_search')->with('users',$users);
	   	}else{
	   		// return json_encode(array('users'=> ''));
	   	}
   }

 	public function englandcanada(Request $request)
   	{	
   		$country = $request->country;
   		$data =  DB::table('cities')->where('country_id',function($query) use($country){
				$query->select('id')->from('country')->where('country.country_name','=',$country);
			})->get();
         
        $html ='<option value="">Select City</option>';
         foreach ($data as $key => $value) {
         	if($value->city_name == Auth::user()->city)
         	{
           		$html .= '<option value="'.$value->city_name.'" selected>'.$value->city_name.'</option>';
         	}
         	else
         	{
         		$html .= '<option value="'.$value->city_name.'">'.$value->city_name.'</option>';
         	}
         }
         
         echo $html;
   	}

   	public function englandcanada1($country)
   	{	
   		$country = $country;
   		$data =  DB::table('cities')
   					->where('country_id', function($query) use($country)
   					{
						$query->select('id')->from('country')->where('country.country_name','=',$country);
					})
   				->get();
   		return $data;
   	}

   	public function getCanadaCity($country)
   	{	
   		$country = $country;
   		$data =  DB::table('canada_cities')
   				->orderBy('city', 'ASC')
   				->get();
   		return $data;
   	}

   public function englandcanadalocations(Request $request)
   { 

   		if($request->continent == 'Europe')
   		{
   			$country = $request->country;
   		}
   		else
   		{
   			$country = $request->continent;
   		}
   		if($request->continent == 'USA')
   		{
   			$country = 'United States';
   		}

        $data =  DB::table('cafe')->select('id','store_name','address_line_1','zip_code','city','country')->where('country','=',$country)->where('city','=',$request->city)->get();

        $html ='<option value="">Select Cafe Location</option>';
         foreach ($data as $key => $value) {
         		
         	//$html .= '<option value="'.$value->zip_code.'">'.$value->address_line_1.' </option>';

         	$html .= '<option value = "'.$value->zip_code.'">'.$value->address_line_1.', '.$value->store_name.', '.$value->city.', '
			.$value->country.', '.$value->zip_code.'</option>';

         }
         
         echo $html;
   }

   public function englandcanadalocations1($city)
   { 
	   $data =  DB::table('cafe')->select('id','city','country','store_name','address_line_1','zip_code')->where('city','=',$city)->get();
        return $data;
   }



   public function euro(Request $request)
   {
   		$data = DB::table('country')->select('*')->where('continent','Europe')->get();

   		$html = '<option value="">Select Country</option>';
   		foreach ($data as $key => $value) {
   			if($value->country_name == Auth::user()->country)
   			{
   				$html .= '<option value="'.$value->country_name.'" selected>'.$value->country_name.'</option>';	
   			}
   			else
   			{
   				$html .= '<option value="'.$value->country_name.'">'.$value->country_name.'</option>';
   			}
   		
   		}
   		echo $html;
   }

   public function usacodes(Request $request)
   {
   		$data = DB::table('state')->select('*')->orderBy('nstate','asc')->get();
   		$html = '<option value="">Select State</option>';
   		foreach ($data as $key => $value) {
   			
   			$html .= '<option value = "'.$value->state_code.'">'.$value->nstate.'</option>';
   		}
   		echo $html;
   }

   public function usacodes1($continent)
   {
   		$data = DB::table('state')->select('*')->orderBy('nstate','asc')->get();
   		return $data;
   }

   

    

   public function usacities1($ustate)
   {
   		$data = DB::table('cafe')->select('*')->where('state',$ustate)->where('country_code','US')->groupBy('city')->get();
   		return $data;
   }

   

   public function usazipcode(Request $request)
   {
   		$data = DB::table('cafe')->select('zip_code')->where('zip_code','=',$request->zip_code)->first();
   		return $data->zip_code;
   }

   public function usacities123(Request $request)
   {
		$statecode = DB::table('state')->select('state_code')->where('nstate',$request->nstate)->get();
		$ss = $statecode[0]->state_code;
   		$data = DB::table('cafe')->select('*')->where('state',$ss)->where('country_code','US')->groupBy('city')->get();
   		$html = '<option value="">Select City</option>';
   		foreach ($data as $key => $value) {
   			$html .= '<option value = "'.$value->city.'">'.$value->city.'</option>';
   		}
   		echo $html;
   }
   public function englandcanadalocations2(Request $request)
   { 

   		if($request->continent == 'Europe')
   		{
   			$country = $request->country;
   		}
   		else
   		{
   			$country = $request->continent;
   		}

        $data =  DB::table('cafe')->select('id','store_name','address_line_1','zip_code','city','country')->where('country','=',$country)->where('city','=',$request->city)->get();

        $html ='<option value="">Select Cafe Location</option>';
         foreach ($data as $key => $value) {
         		
         	$html .= '<option value="'.$value->zip_code.'">'.$value->address_line_1.' </option>';

         }
         
         echo $html;
   }

  

   public function custom(){
        Session::forget('parameters');
        if(Auth::check() && Auth::user()->type == "user" or Auth::user()->type == "admin"){
            $cafe_location = Input::get('cafe_location');
            $create_account = Input::get('create_account');
            $continent = Input::get('continent');
            $country = Input::get('country');
            $day = (Input::get('day') ? Input::get('day') : Auth::user()->day );
            $month = (Input::get('month') ? Input::get('month') : Auth::user()->month);
            $year = (Input::get('year') ? Input::get('year') : Auth::user()->year);
            $city = Input::get('city');
            $ustate = Input::get('ustate');


            $states = DB::table('state')->select('*')->orderBy('nstate','asc')->get();

            if(Auth::user()->continent!='' && Auth::user()->continent=='Europe'){
                $country = Auth::user()->country;
            }else{
                $country = Auth::user()->continent;
            }

            $usalocations = DB::table('cafe')->select('store_name','city','country','zip_code')->where('country_code','US')->where('city',$city)->where('state',$ustate)->get();

            $usacities = DB::table('cafe')->select('city')->where('state',$ustate)->where('country_code','US')->groupBy('city')->get();

            
            $locations = DB::table('cafe')->select('address_line_1','zip_code')->where('city',$city)->where('country',$country)->get();

             $cafeee = DB::table('cafe')->select('store_name','city','country','zip_code')->where('zip_code','=',$cafe_location)->get();


            $cities =  DB::table('cities')->where('country_id',function($query) use($country){
                $query->select('id')->from('country')->where('country.country_name','=',$country);
            })->get();
            // print_r($cities);

            
            if($cafe_location) {
                $getCafes = $this->find_cafes_with_extra($cafe_location,$day,$month,$year,$continent,$country);
            }
             else {
                if(Input::get('search-cafe-members')) {
                    $getCafes = 0;              
                } else {
                    $getCafes = 'null';
                }
            }

            if($create_account) {
                return $getCafes;
            }

            session(['custom' => 'cutom_search']);
            return view('user.customSearch')->with('cafes',$getCafes)->with('cities',$cities)->with('city',$city)->with('cafe_location',$cafe_location)->with('states',$states)->with('ustate',$ustate)->with('usacities',$usacities)->with('cafeee',$cafeee)->with('usalocations',$usalocations)->with('locations',$locations);
        } else{
            return redirect('/');
        }
        // return view('customSearch');
    }

    public function customSearch(Request $request) {

        Session::forget('parameters');
        if(Auth::check() && Auth::user()->type == "user" or Auth::user()->type == "admin"){
            // echo '<pre>';
            // print_r($request->all());die();
            // $validatedData = $request->validate([
            //                 'ustate' => 'required',
            //                 'city' => 'required',]); 
           
            $cafe_location = Input::get('cafe_location');
            $create_account = Input::get('create_account');
            $continent = Input::get('continent');
            $country = Input::get('country');
            $day = (Input::get('day') ? Input::get('day') : Auth::user()->day );
            $month = (Input::get('month') ? Input::get('month') : Auth::user()->month);
            $year = (Input::get('year') ? Input::get('year') : Auth::user()->year);
            $city = Input::get('city');

            
            $ustate = Input::get('ustate');
            // print_r($ustate);die();
            $states = DB::table('state')->select('*')->orderBy('nstate','asc')->get();
            if(!empty($ustate)){
                $matched_states = DB::table('state')->select('id','nstate','state_code')->where('state_code',$ustate)->first();
                $state_name = $matched_states->nstate;
            }
           
            

            if(Auth::user()->continent!='' && Auth::user()->continent=='Europe'){
                $country = Auth::user()->country;
            }else{
                $country = Auth::user()->continent;
            }

            $usalocations = DB::table('cafe')->select('store_name','city','country','zip_code')->where('country_code','US')->where('city',$city)->where('state',$ustate)->get();

            $usacities = DB::table('cafe')->select('city')->where('state',$ustate)->where('country_code','US')->groupBy('city')->get();

            
            $locations = DB::table('cafe')->select('address_line_1','zip_code')->where('city',$city)->where('country',$country)->get();

            $cafeee = DB::table('cafe')->select('store_name','city','country','zip_code')->where('zip_code','=',$cafe_location)->get();
            $user = DB::table('users')->where('ustate',$ustate)->where('city',$city)->get()->toArray();
            // print_r($user);die;

            $cities =  DB::table('cities')->where('country_id',function($query) use($country){
                $query->select('id')->from('country')->where('country.country_name','=',$country);
            })->get();

            //changes
            $data_filter['user_id'] = Auth::user()->id;
            if(!empty($state_name)){
                $filtered_data = User::where('id','!=',Auth::user()->id)->where('state',$state_name)->where('live_in',$city);
            }
            if(!empty($city)){
               $filtered_data = User::where('id','!=',Auth::user()->id)->where('live_in',$city);

            }
            if (!empty($_GET['year'])) {
                $filtered_data = $filtered_data->where('year',$year)->where('year','!=','')->whereNotNull('year');
            }
            if (!empty($_GET['month'])) {
                $filtered_data = $filtered_data->where('month',$month)->where('month','!=','')->whereNotNull('month');
            }
            if (!empty($_GET['day'])) {
                $filtered_data = $filtered_data->where('day',$day)->where('day','!=','')->whereNotNull('day');
            }


            $filtered_data = $filtered_data->get()->toArray();


            if($cafe_location) {
                $getCafes = $this->find_cafes_with_extra($cafe_location,$day,$month,$year,$continent,$country);
            }
             else {
                if(Input::get('search-cafe-members')) {
                    $getCafes = 0;              
                } else {
                    $getCafes = 'null';
                }
            }

            if($create_account) {
                return $getCafes;
            }

            $user = User::where('city', $city)->where('ustate', $ustate)->get()->toArray();
            // print_r($user);die();
            return view('user.customSearch')->with('cities',$cities)->with('city',$city)->with('states',$states)->with('ustate',$ustate)->with('usacities',$usacities)->with('locations',$locations)->with('filtered_data',$filtered_data);
        } else{
            return redirect('/');
        }

    }


    public function user_advance_search(Request $request){
    	if(Auth::check() && Auth::user()->type == 'user'){
    		$filter_data = User::where('id','!=',Auth::user()->id);
    		if($request->month != ''){
    			$filter_data = $filter_data->where('month',$request->input('month'))->where('month','!=','')->whereNotNull('month');
    		}
    		if($request->day != ''){
    			$filter_data = $filter_data->where('day',$request->input('day'))->where('day','!=','')->whereNotNull('day');
    		}
    		if($request->year != ''){
    			$filter_data = $filter_data->where('year',$request->input('year'))->where('year','!=','')->whereNotNull('year');
    		}
    		if ( $request->continent != '' ) {
                $filter_data = $filter_data->where('continent',$request->input('continent'))->where('continent','!=','')->whereNotNull('continent');
            }
            if($request->country != ''){
            	$filter_data = $filter_data->where('country',$request->input('country'))->where('continent','!=','')->whereNotNull('continent');
            }
            if ( $request->ustate != '' ) {
                $filter_data = $filter_data->where('ustate',$request->input('ustate'))->where('ustate','!=','')->whereNotNull('ustate');
            }
            if ( $request->city != '' ) {
                $filter_data = $filter_data->where('city',$request->input('city'))->where('city','!=','')->whereNotNull('city');
            }
            
    		$matchdetail = $filter_data->get();;
    		// print_r($matchdetail);die();
    		return view('user.user_advance_search')->with('matchdetail',$matchdetail);
    		// return view('user.search_member')->with('matchdetail',$matchdetail);
    	}
    }
    
    public function membership()
    {
        return view('user.membership');
    }

	public function myAccount()
    {
        return view('user.my_account');
    }

    
}
?>

			


