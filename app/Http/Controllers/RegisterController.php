<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests;
use App\Mail\Welcome;

use App\Repositories\StateRepository;
use App\Repositories\CityRepository;
use App\Repositories\ActivityRepository;
use App\Repositories\CafeRepository;
use App\Repositories\UserRepository;

use App\User;

use Auth;
use DB;
use Illuminate\Support\Facades\Input;
use Artisan;
use Validator;
use URL;
use Session;
use Redirect;
use Cookie;
use Mail;


class RegisterController extends Controller
{
    private $stateRepository;
    private $cityRepository;
    private $activityRepository;
    private $cafeRepository;
    private $userRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
        $this->stateRepository = new StateRepository;
        $this->cityRepository = new CityRepository;
        $this->activityRepository = new ActivityRepository;
        $this->cafeRepository = new CafeRepository;
        $this->userRepository = new UserRepository;
    }

    public function statesList(Request $request)
    {
        $states = $this->stateRepository->all();

        return view('states_list', compact('states'));
    }

    public function citiesList(Request $request)
    {
        $stateName = $request->state;
        $stateID = $this->stateRepository->getIDByName($stateName);

        $cities = array();
        if( $stateID  )
        {
            $cities = $this->cityRepository->all('Active', $stateID->id);
        }

        return view('cities_list', compact('stateName', 'cities'));
    }

    public function typeOfRelationship(Request $request)
    {
        $stateName = $request->state;
        $cityName = $request->city;

        return view('type_of_relation', compact('stateName', 'cityName'));
    }

    public function birthday(Request $request)
    {
        /*$this->validate($request, [
            'interested_in'=>'required'
        ]);*/

        $stateName = $request->state;
        $cityName = $request->city;

        $data = $request->all();

        if( !empty($data) )
        {
            $request->session()->put(['data_session'=>$data]);
        }
        $RegisterStepData = $request->session()->get('data_session');

        return view('birthday', compact('stateName', 'cityName', 'RegisterStepData'));
    }

    public function email(Request $request)
    {
        $stateName = $request->state;
        $cityName = $request->city;
        $data = $request->all();

        if( !empty($data) )
        {
            $request->session()->put(['data_session'=>$data]);
        }
        $RegisterStepData = $request->session()->get('data_session');

        return view('email_info', compact('stateName', 'cityName', 'RegisterStepData'));
    }

    public function password( Request $request )
    {
        $request->validate([ 
            'email' => 'required|email|unique:users,email'
        ]);
        
        $stateName = $request->state;
        $cityName = $request->city;
        $data = $request->all();

        if( !empty($data) )
        {
            $request->session()->put(['data_session'=>$data]);
        }
        $RegisterStepData = $request->session()->get('data_session');

        return view('password_info', compact('stateName', 'cityName', 'RegisterStepData'));
    }

    public function fullname(Request $request)
    {
        $stateName = $request->state;
        $cityName = $request->city;

        $data = $request->all();

        if( !empty($data) )
        {
            $request->session()->put(['data_session'=>$data]);
        }
        $RegisterStepData = $request->session()->get('data_session');
        
        $stateName = $request->state;
        // $RS_State = $this->stateRepository->getIDByName($stateName);

        $cityName = $request->city;
        // $RS_City = $this->cityRepository->getIDByName($cityName, $RS_State->id, $RS_State->country_id);

        // $RS_Cafe = $this->cafeRepository->getByIDs($RS_City->id, $RS_City->state_id, $RS_City->country_id);

        /*$activities = $this->activityRepository->all();
        $matchActivities = '';
        if( $activities )
        {
            $activitiesArr = array();
            foreach( $activities as $activity )
            {
                $activitiesArr[] = $activity->activity_name;
            }
        }
        $matchActivities = implode(',', $activitiesArr);*/

        // return view('fullname', compact('stateName', 'cityName', 'RegisterStepData', 'RS_Cafe', 'matchActivities'));

        return view('fullname', compact('stateName', 'cityName', 'RegisterStepData'));
    }

    public function register(Request $request)
    {
        // $request->validate([
        //     'password' => 'required|string|min:8|'
        // ]);
        
        $data  = $request->all();
        // dd($data);
        $this->userRepository->create($data);
        
        $user1 = array(
            'email' => @$data['email'],
            'password' => @$data['password'],
        );

        Mail::to($user1['email'])
            ->send(new Welcome($data));

        if( \Auth::attempt($user1) )
        {
            $user = $this->userRepository->getByID(Auth::user()->id);

            if( $user->delete_account==0 )
            {
                if( $user->status == 'activate' )
                {
                    if( $user->account_setup == 0 )
                    {
                        return redirect('/thank-you');
                    }
                    else
                    {
                        Auth::logout();
                        return redirect('/')->with('warning','Your account is not activated.');
                    }
                }
                else
                {
                    Auth::logout();
                    return redirect('/')->with('success','We have sent an email with a confirmation link to your email address. Please click on the button to activate your account.');
                }
            }
            else
            {
                Auth::logout();
                return redirect('/')->with('warning','Your account has deleted.');
            }
        }
        else
        {
            return redirect('/');
        }
    }

    public function socialRegister(Request $request)
    {
        if( Auth::check() && ( empty(Auth::user()->day) || empty(Auth::user()->month) || empty(Auth::user()->year) ) )
        {
            $data  = $request->all();
            $this->userRepository->socialCreate($data);
            
            return redirect('/user/dashboard');
        }
        else
        {
            return redirect('/');   
        }
    }

    public function activateAccount($email)
    {
        Auth::logout();
        $email = base64_decode($email);

        if( $email )
        {
            $checkUser = User::select('status')->where('email', $email)->first();
            if( $checkUser->status == 'pending' )
            {
                User::where('email', $email)->update(['status' => 'activate']);
                return redirect('/');
                // return redirect('/')->with('success', 'Account activated successfully, Please log in now.');
            }
            else
            {
                return redirect('/')->with('info','Your account is already activated.');
            }
        }
        else
        {
            return redirect('/');
        }
    }
}