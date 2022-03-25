<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use Auth;
use App\Friends;
use App\Mail\Forgot;
use Mail;
use DB;
use App\Mail\Welcome;
use App\Mail\AboutMeResult;
use Artisan;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Stripe\Error\Card;
use Validator;
use URL;
use Session;
use Redirect;
use Input;
use App\Payment;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // start EDIT-CODE-PAB
        Session::forget('find_match');
        //end code
        if(Auth::check()) {
                return view('user.dashboard');
        } else {
          return view('welcome');
        }
    }

    public function login()
    {   
        if(Auth::check()) {
            return redirect('/');
        } else {
            return view('auth.login');
        }
    }

     public function forgot()
    {   
        return view('auth.forgot');
    }

    public function membership()
    {
        // Auth::logout();
        // return view('create_account');
        return redirect('/create_account');
    }

    public function dashboard_wlogin() {
 
            return view('dashboard_wlogin');
    }

    public function user_logout() {
        Auth::logout();
        return redirect('/dashboard_wlogin');
    }
    
    public function forget(Request $request)
    {
        $getUser = User::where('email',$request->email)->first();
        if($getUser) {
            Mail::to($request->email)->send(new Forgot($getUser));
            return redirect('/forgot')->with('success','Password has been sent to your registered email');
        } else {
            return redirect('/forgot')->with('failure','These credentails are not exits in our system');
        }
    }

    public function search_result(Request $request)
    {

        if ($request->first_Name != '' ) {
            $firstName = $request->first_Name;
            $lastName = $request->last_Name;
            $name =  $firstName; 
            $sex = "All";
            $continent = $request->continent;
            $location = $request->country;
            
           // print_r("continent = ". $continent."<br>"."Location = ".$location );
            
        // if($request->month !='' && $request->day != '' && $request->year != '' && $request->sex != '') {
        //    $month = $this->rec($request->month);
        //    $day = $this->rec($request->day);
        //    $year = $this->rec($request->year);
        //    $sum = $this->rec($month+$day+$year);
        //    $sex = $request->sex;
           
        //     $conditions = [

        //             ['continent','=','USA']
        //         ];

            // if($sex == 'All')
            // {
            // }
            // else
            // {
            //    $getUser = User::where(['datepoint' => $sum, 'sex' => $request->sex,'delete_account'=>0])->where($conditions)->paginate(10);
            // }
            // if ($continent == "USA") {
            //     $getUser = User::where(['name' => $name,'continent' => $continent,'ustate'=> $location,'delete_account'=>0])->paginate(10);
            //     //echo "this is usa if ";
            // }
            // if ($continent == "Canada") {
            //     $getUser = User::where(['name' => $name,'continent'=>$continent,'city'=>$location,'delete_account'=>0])->paginate(10);
            //     //echo "this is Canada if ";
            // }
            // if ($continent == "England") {
            //     $getUser = User::where(['name' => $name,'continent'=>$continent,'city'=>$location,'delete_account'=>0])->paginate(10);
            //     //echo "this is England if ";
            // }                           
            // if ($continent == "Europe") {
            //     $getUser = User::where(['name' => $name,'continent'=>$continent,'country'=>$location,'delete_account'=>0])->paginate(10);
            //     //echo "this is europe if ";
            // }
            $getUser = User::where(['name' => $name,'delete_account'=>0])->paginate(10);
            $request->session()->put('parameters',$request->all());
            return view('search_result')->with('users',$getUser)->with('sex',$sex)->with('parameters',$request->all()); 
        // } else {

        //      $conditions = [

        //             ['continent','=','USA']
        //         ];
        //     if(isset($_GET['page']) && isset($_GET['sum']) && isset($_GET['sex'])){
        //         $sum =  $_GET['sum'];
        //         $sex = $_GET['sex'];

        //         if($sex == 'All')
        //         {
        //             $getUser = User::where(['datepoint' => $sum,'delete_account'=>0])->where($conditions)->paginate(10);
        //         }
        //         else
        //         {
        //             $getUser = User::where(['datepoint' => $sum, 'sex' => $sex,'delete_account'=>0])->where($conditions)->paginate(10);
        //         }
        //         return view('search_result')->with('users',$getUser)->with('parameters',$request->session()->get('parameters'))->with('sum',$sum)->with('sex', $sex);
        //     }else{
        //         return redirect('/');   
        //     }
            
        // }
    }
  }

    public function user_profile($id)
    {
    	$userDetail = User::where('id',$id)->with('UserLoc','UserState')->first();
        $previous = User::select('id')->where('datepoint',$userDetail->datepoint)->where('sex',$userDetail->sex)->where('id','<',$userDetail->id)->orderBy('id','desc')->first();
        $next = User::select('id')->where('datepoint',$userDetail->datepoint)->where('sex',$userDetail->sex)->where('id','>',$userDetail->id)->first();

        if(Auth::check()) {
            $friends = Friends::where('from', Auth::user()->id)->where('to', $id)->orWhere('from', $id)->where('to', Auth::user()->id)->first();
        } else {
            $friends = array();
            return redirect('/');
        }
    	return view('profile_view')->with('userDetail',$userDetail)->with('friends',$friends)->with('previous',$previous)->with('next',$next);

    }

    public function logout() {
        Auth::logout();
        return redirect('/');
    }

    public function activate_account($email) {
        $email = base64_decode($email);
        if($email) {
            $checkUser = User::where('email',$email)->first();
            if($checkUser->status == 'pending') {
                User::where('email',$email)->update(['status' => 'activate']);
                return redirect('/login')->with('success','Account activated successfully, Please log in now.');
            } else {
                return redirect('/login')->with('info','Your account is already activated.');
            }
        } else {
            return redirect('/');
        }
    }
    function rec($num){
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
    public function about() {

        $data =  DB::table('cms')->select('*')->where('page_name','about-us')->first();
            
        return view('about')->with(['content'=>$data->content,'page_name'=>$data->page_name]);
    }

    public function terms() {
          
        $data =  DB::table('cms')->select('*')->where('page_name','terms')->first();
            
        return view('terms')->with(['content'=>$data->content,'page_name'=>$data->page_name]);
    }

    public function privacy() {

        $data =  DB::table('cms')->select('*')->where('page_name','privacy')->first();
            
        return view('privacy')->with(['content'=>$data->content,'page_name'=>$data->page_name]);
    }

    public function safety() {

        $data =  DB::table('cms')->select('*')->where('page_name','safety')->first();
            
        return view('safety')->with(['content'=>$data->content,'page_name'=>$data->page_name]);
    }

    public function termsapp() {

        $data =  DB::table('cms')->select('*')->where('page_name','terms')->first();
            
        return view('termservice')->with(['content'=>$data->content,'page_name'=>$data->page_name]);
    }

    public function aboutapp() {

        $data =  DB::table('cms')->select('*')->where('page_name','about-us')->first();
            
        return view('termservice')->with(['content'=>$data->content,'page_name'=>$data->page_name]);
    }

    public function privacyapp() {

        $data =  DB::table('cms')->select('*')->where('page_name','privacy')->first();
            
        return view('termservice')->with(['content'=>$data->content,'page_name'=>$data->page_name]);
    }

    public function safetyapp() {

        $data =  DB::table('cms')->select('*')->where('page_name','safety')->first();
            
        return view('termservice')->with(['content'=>$data->content,'page_name'=>$data->page_name]);
    }

    public function countryname() {

        // $data = DB::select('select * from country');
         $data =  DB::table('country')->select('*')->where('continent',null)->get();
         return view('coming',['data'=>$data]);
    }

    public function contact_us($id='') {

        if($id != '')
        {   
            $data =  DB::table('country')->select('*')->where('id',$id)->first();
            $country_name = $data->country_name;
        }else{
            $country_name = '';            
        }   
            return view('contact_us')->with('country_name',$country_name)->with('id',$id);
       

    }

    public function contact_save(Request $request){
        
    $request->validate([
            'email' => 'required|string|email|max:255',
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);
            
        $msg = '<b>Dear</b><br><br>';
        $msg.= 'Username: '.$request->email.'<br>';
        $msg.= 'Thankyou for contacting with us.<br><br>';
        $msg.= '<b>Regards</b><br>';
        $msg.= 'ifoundu<br>';

        $head = 'Thanks for contacting us';
        $this->send_mail($request->email,$msg,$head);

        $msg1 ='Country: '.$request->name.'<br>';
        $msg1.='Email: ' .$request->email.'<br>';
        $msg1.='Subject: '.$request->subject.'<br>';
        $msg1.='Message: '.$request->message.'<br>';
        $head1 = 'Contact Us';
        $this->send_mail('test.myvirtualteams@gmail.com',$msg1,$head1);

        return redirect('/');

   } 

   public function cities(Request $request)
   {
         $data =  DB::table('country')->select('*')->join('cities','country.id', '=','cities.country_id')->where('continent','europe')->get();
         $html ='<option value="">Cities:</option>';
         foreach ($data as $key => $value) {
           $html .= '<option value='.$value->city_name.'>'.$value->city_name.'</option>';
         }
         echo "<pre>";print_r($html);die;
   }
   public function countries(Request $request)
   {
        $data =  DB::table('country')->select('*')->where('continent','europe')->get();
        return view('countries',['data'=>$data]);
   }

   public function location(Request $request)
   { 
        $data =  DB::table('cafe')->select('id','address_line_1','latitude','longitude')->where('city','=',$request->city)->where('country_code','UK')->get();
        $html ='<option value="">Locations:</option>';
         foreach ($data as $key => $value) {
           $html .= '<option value="'.$value->id.'">'.$value->address_line_1.'</option>';
         }
         echo "<pre>";print_r($html);die;
        // return view('location',['data'=>$data]); 
   }

   public function selectedloc(Request $request)
   {
        $data = DB::table('cafe')->select('id','address_line_1','store_name')->where('id','=',$request->id)->where('country_code','UK')->get();
            return $data;
          echo "<pre>";print_r($data);
   }

   public function showcountries(Request $request)
   {
       $data =  DB::table('country')->select('id','country_name')->where('continent','europe')->get();
       $html ='<option value="">Select Country</option>';
         foreach ($data as $key => $value) {
           $html .= '<option value="'.$value->country_name.'">'.$value->country_name.'</option>';
         }
       echo $html;
        

   }

   public function registercountries(Request $request)
   {
        $data = DB::table('country')->select('*')->where('continent',null)->get();
        $html ='<option value="">Choose a country to find a match</option>';
         foreach ($data as $key => $value) {
            $html .= '<option value="'.$value->country_name.'">'.$value->country_name.'</option>';
        }
         
       echo $html;
   }

   public function europecountries(Request $request)
   {
        $countryname = $request->country_name;
       $data =  DB::table('country')->select('id','country_name')->where('continent','europe')->get();
       $html ='<option value="">Select Country:</option>';
         foreach ($data as $key => $value) {
            if($countryname == $value->country_name)
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

   public function zipcodes(Request $request)
   {
        $data = DB::table('cafe')->select('address_line_1','id')->where('country_code','UK')->where('id','>=','15182')->get();
        foreach ($data as $key => $value) {
            $zipcode = $this->getZipcode($value->address_line_1);

            //echo $zipcode;echo "<br />";
            if($zipcode){

            DB::table('cafe')->where('id',$value->id)->update(['zip_code' => $zipcode]);
            }
             //DB::table('cafe')->where('id',$value->id)->where('country_code','UK')->update(['country' => 'England']);
        }
        
   }

   function getZipcode($address){
        if(!empty($address)){
            //Formatted address
            $formattedAddr = str_replace(' ','+',$address);
            //Send request and receive json data by address
            $geocodeFromAddr = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.$formattedAddr.'&sensor=true_or_false&key=AIzaSyCgy7EGnKxaHmvGwfHRgdsjtPXUmM0uCMc'); 
            $output1 = json_decode($geocodeFromAddr);

            if(!empty($output1->results)){
                //Get latitude and longitute from json data
                $latitude  = $output1->results[0]->geometry->location->lat; 
                $longitude = $output1->results[0]->geometry->location->lng;

                //Send request and receive json data by latitude longitute

                $geocodeFromLatlon = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?latlng='.$latitude.','.$longitude.'&sensor=true_or_false&key=AIzaSyCgy7EGnKxaHmvGwfHRgdsjtPXUmM0uCMc');
                $output2 = json_decode($geocodeFromLatlon);
                if(!empty($output2)){
                    $addressComponents = $output2->results[0]->address_components;
                    foreach($addressComponents as $addrComp){
                        if($addrComp->types[0] == 'postal_code'){
                            //Return the zipcode
                            return $addrComp->long_name;
                        }
                    }
                    return false;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }else{
            return false;   
        }
    }

    public function joins($id = null)
    {

        if(Auth::check() && Auth::user()->type == "user") 
        {
            if($id=='')
            {
                $id = Auth::user()->id();
            }

            $data = User::select('*')->where('type','admin')->first();
            

            $userDetail = User::where('id',$id)->with('UserLoc','UserState')->first();

            $payments =DB::table('payments')->select('*')->where('user_id',Auth::user()->id)->where('status','Current')->first();

            if($payments == '')
            {
                return view('join_today')->with('userDetail',$userDetail)->with(['paypal_amount' => $data->paypal_amount]);
            }else{    
                return redirect('/');
            }
            
        }else{
            return redirect('/');
        }
      
           
    }


    public function payWithStripe($id)
    {
       return view('pay_with_strip',compact('id'));
    }


    public function postPaymentWithStripe(Request $request)
    {
        $stripe = Stripe::setApiKey(config('services.stripe.secret'));
        $token = request('stripeToken');
        $charge = $stripe->charges()->create([
                'amount' => 10,
                'currency' => 'usd',
                'description' => 'Membership Annually',
                'source' => $token,
        ]);

        if(empty($charge['failure_code']) && !empty($charge['payment_method'])){
            Payment::create([
                'payment_method'            => 'strip',
                'txnid'                     => $charge['payment_method'],
                'balance_transaction_id'    => $charge['balance_transaction'],
                'fingerprint'               => $charge['payment_method_details']['card']['fingerprint'],
                'payment_amount'            => 10,
                'payment_currency'          => 'USD',
                'payment_status'            => 'Completed',
                'user_id'                   => Auth::user()->id,
            ]);
        }

        return redirect::to('user/user-profile/'.$request->user_id);
    } 



    public function getcities(Request $request)
    {
        if($request->continent!='' && $request->continent =='Europe')
        {
            $country = $request->country;
        }
        else
        {
            $country = $request->continent;
        }

        $cities =  DB::table('cities')->where('country_id',function($query) use($country){
            $query->select('id')->from('country')->where('country.country_name','=',$country);
        })->get();

        $html ='<option value="">Select City:</option>';
         foreach ($cities as $key => $value) {
            
            $html .= '<option value="'.$value->city_name.'">'.$value->city_name.'</option>';
           
         }
       echo $html;


    }
    public function getlocations(Request $request)
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

        $data =  DB::table('cafe')->select('id','store_name','address_line_1','zip_code','city','country')->where('country',$country)->where('city','=',$request->city)->get();

        $html ='<option value="">Choose Cafe Location:</option>';
         foreach ($data as $key => $value) {
            $html .= '<option value="'.$value->zip_code.'">'.$value->address_line_1.', '.$value->store_name.', '.$value->city.', '.$value->country.', '.$value->zip_code.'</option>';
            

         }
         echo $html;
   }

   public function usastates(Request $request)
   {
        $states = DB::table('state')->select('*')->orderBy('nstate','ASC')->get();
        $html = '<option value="">Select State:</option>';
        foreach ($states as $key => $value) {
            $html .= '<option value="'.$value->state_code.'">'.$value->nstate.'</option>';
        }
        echo $html;
   }

   public function usacities(Request $request)
   {    
        // $getstatecode = DB::table('state')->select('state_code')->where('nstate',$request->nstate)->get();
        // $sc = $getstatecode[0]->state_code;
        $data = DB::table('cafe')->select('city')->where('state',$request->state_code)->where('country_code','US')->groupBy('city')->get();
        $html = '<option value="">Select City:</option>';
        foreach ($data as $key => $value) {
            $html .= '<option value="'.$value->city.'">'.$value->city.'</option>';
        }
        echo $html;
   }
    public function findMatch() {
        
        if(Auth::check()) {
            // if(Auth::user()->about_me_details == "fill"){
            if(Auth::user()){

                return view('dashboard_wlogin');
                // return view('/find-match');
            }else{
                // return redirect('dashboard_wlogin');
                return redirect('/dashboard_wlogin');
            }
        } else {
            // start EDIT-CODE-PAV - 15oct
            session(['find_match' => 'find_match_login']);
            // end
            return view('auth.login');
        }
    }
    public function aboutMe() {
        return view('about_me');
    }

    public function find_match(){
        return view('/find_match');
    }

    public function saveAboutme(Request $request)
    {
        $data = $request->all();
        if(!empty($data)){
            $saveData['sex'] = $data['about_gender'];
            $saveData['bodytype'] = $data['about_bodytype'];
            $saveData['height'] = $data['about_height'];
            $saveData['eyecolor'] = $data['about_eyecolor'];
            $saveData['haircolor'] = $data['about_haircolor'];
            $saveData['ethnicity'] = $data['about_ethnicity'];
            $saveData['language'] = $data['about_language'];
            $saveData['religion'] = $data['about_religion'];
            if(isset($data['user_id']) && !empty($data['user_id'])){
                $saveData['about_me_details'] = 'fill';
                User::where('id',$data['user_id'])->update($saveData);
                // return redirect('/find-match');
                return redirect('/findmatch');
            }else{

                $email = $data['email'];
                $date = $data['day'].'/'.$data['month'].'/'.$data['year'];
                $con_time = strtotime($date);
                $dob = date('Y-m-d',$con_time);
                $month = $this->rec($data['month']);
                $day = $this->rec($data['day']);
                $year = $this->rec($data['year']);
                $sum = $this->rec($month+$day+$year);
                $data['datepoint'] = $sum;
                $data['dob'] = $dob;
            
                unset($data['_token']);
                $already = DB::table('user_temp_about_me')->where('email',$email)->first();
                $saveData['email'] = $data['email'];
                $saveData['month'] = $data['month'];
                $saveData['year'] = $data['year'];
                $saveData['day'] = $data['day'];
                $saveData['datepoint'] = $sum;
                
                if(isset($already) && !empty($already)){
                    DB::table('user_temp_about_me')->where('email',$email)->update($saveData);  
                    $user_id = $already->id;
                }else{
                    $user_id = DB::table('user_temp_about_me')->insertGetId($saveData);
                } 
                $request->session()->put('email', $data['email']);
                //unset($data['email']);
                //unset($data['dob']);
                //$sex = "All";
                // $getUser = User::where($data)->where('delete_account','0')->paginate(10);
                // $data['url'] = url('/user/user-profile');
                // $data['user_url'] = url('/user');
                // $send = Mail::send('emails.AboutMeResult', ['data' => $data, 'users' => $getUser], function ($m) use ($email) {
                //     $m->from('noreply@ifoundyou.com');
                //     $m->to($email)->subject('Ifoundyou match results');
                // });

                return redirect('/register?id=&page=about&user='.$user_id)->with('success','Details saved successfully, Please Sign up.');
            }
            // return redirect('/login')->with('success','Details saved successfully, Please log in now.');
            // return view('search_result')->with('users',$getUser)->with('sex',$sex)->with('parameters',$request->all());
        }else{
            return redirect('/');            
        }
    }

    /*public function getMatchResult(Request $request){
        $data = $request->all();
        $email = $data['email'];
        $date = $data['day'].'/'.$data['month'].'/'.$data['year'];
        $con_time = strtotime($date);
        $dob = date('Y-m-d',$con_time);
        $month = $this->rec($data['month']);
        $day = $this->rec($data['day']);
        $year = $this->rec($data['year']);
        $sum = $this->rec($month+$day+$year);
        $data['datepoint'] = $sum;
        $data['dob'] = $dob;
        unset($data['day']);
        unset($data['month']);
        unset($data['year']);


        if(!empty($data)){
            unset($data['_token']);
            $already = DB::table('matching')->where('email',$email)->first();
            if(isset($already) && !empty($already)){
                DB::table('matching')->where('email',$email)->update($data);  
            }else{
                DB::table('matching')->insert($data);
            } 
            $request->session()->put('email', $data['email']);
            unset($data['email']);
            unset($data['dob']);
            $sex = "All";
            $getUser = User::where($data)->where('delete_account','0')->paginate(10);
            $data['url'] = url('/user/user-profile');
            $data['user_url'] = url('/user');
            $send = Mail::send('emails.AboutMeResult', ['data' => $data, 'users' => $getUser], function ($m) use ($email) {
                $m->from('noreply@ifoundyou.com');
                $m->to($email)->subject('Ifoundyou match results');
            });
            return view('search_result')->with('users',$getUser)->with('sex',$sex)->with('parameters',$request->all());
        }else{
            return redirect('/');            
        }
    }*/

    public function getMatchResult(Request $request){
        $data = $request->all();

        $email = $data['email'];
        $date = $data['day'].'/'.$data['month'].'/'.$data['year'];
        $con_time = strtotime($date);
        $dob = date('Y-m-d',$con_time);
        $month = $this->rec($data['month']);
        $day = $this->rec($data['day']);
        $year = $this->rec($data['year']);
        $sum = $this->rec($month+$day+$year);
        $data['datepoint'] = $sum;
        //$data['dob'] = $dob;
        unset($data['email']);
        unset($data['_token']);
        unset($data['day']);
        unset($data['month']);
        unset($data['year']);

        $user = User::where('email',$email)->first();
        // echo '<pre>';
        // print_r($data);die();
        if(isset($user) && !empty($user)){
            User::where('email',$email)->update($data);
            // return redirect()->back()->with('success','Thank you for submit your Details');
            return redirect('/aboutme_mymatch');
            //return view('search_result')->with('users',$getUser)->with('sex',$sex)->with('parameters',$request->all());
        }else{
            return redirect('/');            
        }
    }

    public function aboutme_mymatch(){
        return view('aboutme_mymatch');
    }

    public function checkEmailExist(Request $request){
        $email = $request->userEmail;
        if(!empty($email)){
            $already = DB::table('user_temp_about_me')->where('email',$email)->first();
            if(isset($already) && !empty($already)){
                return 'false';
            }else{
                $reg_already = DB::table('users')->where('email',$email)->first();
                if(isset($reg_already) && !empty($reg_already)){
                    return 'false';
                }else{
                    return 'true';
                }
            }
        }
    }     

    public function getSum($num){
        $sum=0; $rem=0;  
        for ($i =0; $i<=strlen($num);$i++)  
        {  
            $rem=$num%10;  
            $sum = $sum + $rem;  
            $num=$num/10;  
        }
        return $sum; 
    }
    
    
}

