<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\Mail\Welcome;
use Mail;
use DB;
use Session;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = '/membership';
    protected $redirectTo = '/user/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|',
            'month' => 'required',
            'day' => 'required',
            'year' => 'required',
            'continent' => 'required',
            'remember' => 'required'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */

    public function register(Request $request) {
        // print_r($request->all());die();
       // $request->validate([
       //      'name' => 'required|string|max:255',
       //      'email' => 'required|string|email|max:255|unique:users',
       //      'password' => 'required|string|min:6|',
       //      'month' => 'required',
       //      'day' => 'required',
       //      'year' => 'required',
       //      'continent' => 'required',
       //      'remember' => 'required',
       //      //'zip_code' => 'required|string'
       // ]);
       // print_r($request->all());die();
        $this->create($request->all());
        $msg = '<b>Dear</b><br><br>';
        $msg.= 'Please find your controls for login.<br>';
        $msg.= 'Username: '.$request->email.'<br>';
        /*$msg.= 'Password: '.$request->password.'<br>';*/
        $msg.= 'Thankyou for register with us.<br><br>';
        $msg.= '<b>Regards</b><br>';
        $msg.= 'ifoundu<br>';

        $head = 'Welcome to ifoundu';
        $data  = $request->all();

        // dd($data);
        // return redirect('user/user-profile/'.$userrlogin_ID.'');
        // print_r($data);die();
        
        $user1 = array(
            'email' => @$data['email'],
            'password' => $data['password'] ,
            // 'cafe' => $data['cafe'],
        );
        // $this->send_mail($user1['email'],$msg,$head);
        // Mail::to($user1['email'])->send(new Welcome($data));
        // $userData['email']    = $user['email'];
        // $userData['password'] = $request->password;
        // print_r($user['email']);die();
        // $email = $user['email'];
        if(\Auth::attempt($user1)) {
        // print_r($user1);die();
        // $user = DB::table('users')->where('email',$user1['email'])->first();
        $user = DB::table('users')->where('id',Auth::user()->id)->first();

        // $user = json_decode(json_encode($user),true);
        // print_r($user->delete_account);die();
        // print_r($user);die();
         if($user->delete_account==0) {
                if($user->status == 'activate') {
                    /* if page redirect from find my match */
                    if (Session::has('find_match')){
                        return redirect('/find-match');
                    }
                    if($user->account_setup == 0) {
                        // return redirect('/user/create-account');
                        // Auth::login($user);

                        return redirect('/user/edit-user-profile');
                    } else {
                        // Auth::login($user);
                        return redirect('/user/dashboard');
                        // return redirect('/user/new_user_edit_profile');

                    }  
                    //return redirect('/user/dashboard');
                } else {
                    Auth::logout();
                    return redirect('/login')->with('warning','Your account is not activated.');
                }
            } else {
                Auth::logout();
                return redirect('/login')->with('warning','Your account has deleted.');
                }
            }else{
                return redirect('/');
            }
        // print_r($user);die();



        //$this->send_mail($request->email,$msg,$head);
        // Mail::to($request->email)->send(new Welcome($data));
        // return redirect('/login?id='.$request->param)->with('success-temp','You have created an account.');

        // return redirect('/user/dashboard');

        // return redirect('/register?id='.$request->param)->with('success','Account created successfully, Please check email to activate.');
    }

    
    protected function create(array $data)
    {
        $month = $this->rec(@$data['month']);
        $day = $this->rec(@$data['day']);
        $year = $this->rec(@$data['year']);
        $sum = $this->rec($month+$day+$year);
        
        $saveData['type'] = 'user';
        $saveData['name'] = @$data['name'];
        $saveData['email'] = @$data['email'];
        $saveData['password'] = Hash::make(@$data['password']);
        $saveData['original_password'] = @$data['password'];
        $saveData['sex'] = @$data['sex'];
        $saveData['looking_for'] = @$data['lfor'];
        $saveData['month'] = @$data['month'];
        $saveData['day'] = @$data['day'];
        $saveData['year'] = @$data['year'];
        $saveData['datepoint'] = $sum;
        // $saveData['status']   = 'pending';
        $saveData['status']   = 'activate';
        $saveData['account_setup'] = 0;
        $saveData['country']  = @$data['country'];
        $saveData['continent'] = $data['continent'];
        $saveData['ustate'] = @$data['state'];
        $saveData['state'] = @$data['state'];
        // $saveData['city'] = @$data['city'];
        $saveData['city'] = @$data['cityname'];
        $saveData['cafe'] = @$data['cafe'];
        $saveData['zip_code'] = @$data['zip_code'];
        $saveData['interested_in'] = $data['interested_in'];

        $about = DB::table('user_temp_about_me')->where('email',@$data['email'])->first();
        if(isset($about) && !empty($about)){
            $saveData['bodytype'] = $about->bodytype;
            $saveData['height'] = $about->height;
            $saveData['eyecolor'] = $about->eyecolor;
            $saveData['haircolor'] = $about->haircolor;
            $saveData['ethnicity'] = $about->ethnicity;
            $saveData['language'] = $about->language;
            $saveData['religion'] = $about->religion;
            $saveData['about_me_details'] = 'fill';
        }

        //echo "<pre>";print_r($data);die;
        User::create($saveData);
        
    }
    protected function rec($num){
        if($num!=11 && $num!=22){
            $sum = array_sum(str_split($num));
            if($sum>=10 && $sum!=11 && $sum!=22){
                return $this->rec($sum);
            }else{
                return $sum;
            }
        }else{
            return $num;
        }
    }
}
