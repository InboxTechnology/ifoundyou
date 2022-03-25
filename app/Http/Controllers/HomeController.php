<?php

namespace App\Http\Controllers;

use App\Repositories\LifePathNumberRepository;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests;
use App\User;
use App\Cafe;
use Auth;
use App\Friends;
use App\Mail\Forgot;
use Mail;
use DB;
use App\Mail\Welcome;
use App\Mail\AboutMeResult;
use Illuminate\Support\Facades\Input;
use Artisan;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Stripe\Error\Card;
use Validator;
use URL;
use Session;
use Redirect;
use Cookie;
// use Input;
use Cache;
use App\Payment;
use App\PaymentSetting;
use App\Activites;


class HomeController extends Controller
{
    private $lifePathNumberRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
        $this->lifePathNumberRepository = new LifePathNumberRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if( Auth::check() )
        {
            return redirect('/user/dashboard');
        }
        else
        {
            return view('home_front');
        }
    }

    public function findaMatch()
    {
        $month = $this->lifePathNumberRepository->lifePathNumber(@$data['month']);
        $day = $this->lifePathNumberRepository->lifePathNumber(@$data['day']);
        $year = $this->lifePathNumberRepository->lifePathNumber(@$data['year']);
        $sum = $this->lifePathNumberRepository->lifePathNumber($month+$day+$year);

        $userDatePoint = Auth::user()->datepoint;
        $datePoint = $sum>0 ? $sum : $userDatePoint;
        
        $getUserData = User::where('status', 'activate')
                        ->where('delete_account', 0)
                        ->whereNotNull('delete_account');

        $getUserData = $getUserData->where('datepoint', $datePoint)
                            ->where('datepoint', '!=' ,'')
                            ->whereNotNull('datepoint');

        // city start
        $cistyWiseUserCount = User::where('id', '!=', Auth::user()->id)
                                ->where('datepoint', $datePoint)
                                ->where('city_id', Auth::user()->city_id)
                                ->count();

        if( $cistyWiseUserCount>0 )
        {
            $getUserData = $getUserData->where('city_id', Auth::user()->city_id);
        }
        // city end

        // state start
        if( $cistyWiseUserCount<=0 )
        {
            $stateWiseUserCount = User::where('id', '!=', Auth::user()->id)
                                    ->where('datepoint', $datePoint)
                                    ->where('state_id', Auth::user()->state_id)
                                    ->count();
            // dd($cistyWiseUserCount);

            if( $stateWiseUserCount>0 )
            {
                $getUserData = $getUserData->where('state_id', Auth::user()->state_id);
            }
        }
        // state end

        $getUser = $getUserData
                    ->with(['UserCity'])
                    ->where('id', '!=', Auth::user()->id)
                    ->get();
        
        return view('find-a-match')
                ->with('users', $getUser);
    }

    // advance search
    public function advanceSearchResult(Request $request)
    {
        $month = $this->lifePathNumberRepository->lifePathNumber(@$data['month']);
        $day = $this->lifePathNumberRepository->lifePathNumber(@$data['day']);
        $year = $this->lifePathNumberRepository->lifePathNumber(@$data['year']);
        $sum = $this->lifePathNumberRepository->lifePathNumber($month+$day+$year);

        $userDatePoint = Auth::user()->datepoint;
        $datePoint = $sum>0 ? $sum : $userDatePoint;
        
        $getUserData = User::where('status', 'activate')
                        ->where('delete_account', 0)
                        ->whereNotNull('delete_account');

        $getUserData = $getUserData->where('datepoint', $datePoint)
                            ->where('datepoint', '!=' ,'')
                            ->whereNotNull('datepoint');

        // city start
        $cistyWiseUserCount = User::where('id', '!=', Auth::user()->id)
                                ->where('datepoint', $datePoint)
                                ->where('city_id', Auth::user()->city_id)
                                ->count();

        if( $cistyWiseUserCount>0 )
        {
            $getUserData = $getUserData->where('city_id', Auth::user()->city_id);
        }
        // city end

        // state start
        if( $cistyWiseUserCount<=0 )
        {
            $stateWiseUserCount = User::where('id', '!=', Auth::user()->id)
                                    ->where('datepoint', $datePoint)
                                    ->where('state_id', Auth::user()->state_id)
                                    ->count();
            // dd($cistyWiseUserCount);

            if( $stateWiseUserCount>0 )
            {
                $getUserData = $getUserData->where('state_id', Auth::user()->state_id);
            }
        }
        // state end

        $getUser = $getUserData
                    ->with(['UserCity'])
                    ->where('id', '!=', Auth::user()->id)
                    ->get();

        return view('search_result')
                ->with('users', $getUser);
    }

    public function about()
    {
        $data =  DB::table('cms')->select('*')->where('page_name','about-us')->first();
        return view('about')
                ->with(['content'=>$data->content, 'page_name'=>$data->page_name]);
    }

    public function privacy()
    {
        $data =  DB::table('cms')->select('*')->where('page_name','privacy')->first();
        return view('privacy')
                ->with(['content'=>$data->content, 'page_name'=>$data->page_name]);
    }

    public function safety()
    {
        $data =  DB::table('cms')->select('*')->where('page_name','safety')->first();
        return view('safety')
                ->with(['content'=>$data->content, 'page_name'=>$data->page_name]);
    }

    public function terms()
    {
        $data =  DB::table('cms')->select('*')->where('page_name','terms')->first();
        return view('terms')
                ->with(['content'=>$data->content, 'page_name'=>$data->page_name]);
    }

    public function joinToday($id = null)
    {
        if( Auth::check() && Auth::user()->type == "user" ) 
        {
            if( $id=='' )
            {
                $id = Auth::user()->id();
            }

            $data = PaymentSetting::where('id', '1')
                    ->select('*')
                    ->first();

            $userDetail = User::where('id', $id)
                        ->with('UserCafe', 'UserState')
                        ->first();

            $payments = DB::table('payments')
                        ->where('user_id', Auth::user()->id)
                        ->where('status', 'Current')
                        ->first();

            if( $data->membership_status == 'Enable' )
            {
                if( $payments == '' )
                {
                    return view('join_today')
                        ->with('userDetail', $userDetail)
                        ->with(['paypal_amount' => $data->membership_fees])
                        ->with(['membership_fees' => $data->membership_fees]);
                }
                else
                {    
                    return redirect('/');
                }
            }
            else
            {
                return redirect::to('user/user-profile/'.$id);
            }
        }
        else
        {
            return redirect('/');
        }
    }


    // old

    public function login()
    {   
        $_SESSION['ses'] = 'ses';
        // Auth::logout();
        // echo "string";
        if(Auth::check()) {
            $_SESSION['ses'] = 'ses';
            // return redirect('/');
            // Auth::logout();
            return view('auth.login');

        } else {
            $_SESSION['ses'] = 'ses';
            return view('auth.login');
        }
    }

    public function log(){
        Auth::logout();
        $_SESSION['ses'] = 'ses';
        return view('auth.login');
    }

    public function new_homepage(){
        Auth::logout();
        return view('new_homepage');
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
        if( $request->first_Name != '' )
        {
            $firstName = $request->first_Name;
            $lastName = $request->last_Name;
            $name =  $firstName; 
            //$sex = "All";
            $sex = $request->gender == 'All' ? '' : $request->gender;
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

            //$getUser = User::where(['name' => $name, 'about_gender' => $sex, 'delete_account'=>0])->paginate(10);

            $getUserData = User::where('name', $name);
            $getUserData = $getUserData->where('delete_account', 0)->whereNotNull('delete_account');

            if( $request->gender != 'All' ) {
                $getUserData = $getUserData->where('about_gender', $request->input('gender'))->where('about_gender', '!=', '')->whereNotNull('about_gender');
            }

            if ( $request->adv_search_month != '' ) {
                $getUserData = $getUserData->where('month',$request->input('adv_search_month'))->where('month','!=','')->whereNotNull('month');
            }

            if ( $request->adv_search_day != '' ) {
                $getUserData = $getUserData->where('day',$request->input('adv_search_day'))->where('day','!=','')->whereNotNull('day');
            }

            if ( $request->adv_search_year != '' ) {
                $getUserData = $getUserData->where('year',$request->input('adv_search_year'))->where('year','!=','')->whereNotNull('year');
            }

            if ( $request->adv_search_country != '' ) {
                $getUserData = $getUserData->where('continent',$request->input('adv_search_country'))->where('continent','!=','')->whereNotNull('continent');
            }

            /*if ( $request->adv_search_state != '' ) {
                $getUserData = $getUserData->where('ustate',$request->input('adv_search_state'))->where('ustate','!=','')->whereNotNull('ustate');
            }

            if ( $request->adv_search_city != '' ) {
                $getUserData = $getUserData->where('city',$request->input('adv_search_city'))->where('city','!=','')->whereNotNull('city');
            }*/

            if( $request->adv_search_about_gender != '' ) {
                $getUserData = $getUserData->where('about_gender', $request->input('adv_search_about_gender'))->where('about_gender', '!=', '')->whereNotNull('about_gender');
            }

            $getUser = $getUserData->get();

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
        $html ='<option value="">Select Country</option>';
         foreach ($data as $key => $value) {
            $html .= '<option value="'.$value->country_name.'">'.$value->country_name.'</option>';
        }
       echo $html;
   }

   public function registercountries_signin(Request $request)
   {
        $data = DB::table('country')->select('*')->where('continent',null)->where('country_name','USA')->get();
        $html ='<option value="">Select Country</option>';
         foreach ($data as $key => $value) {
            $html .= '<option value="'.$value->country_name.'">'.$value->country_name.'</option>';
        }
       echo $html;
   }

   public function europecountries(Request $request)
   {
        $countryname = $request->country_name;
       $data =  DB::table('country')->select('id','country_name')->where('continent','europe')->get();
       $html ='<option value="">Select Country</option>';
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

        $cities =  DB::table('canada_cities')
                        ->orderBy('city', 'ASC')
                        ->get();

        $html ='<option value="">Select Province</option>';
        foreach( $cities as $key => $value ) {
            $html .= '<option value="'.$value->city.'">'.$value->city.'</option>';
        }
        echo $html;
    }

    // get Europe city
    public function getEuropeCities(Request $request)
    {
        $country = $request->continent;

        $cities =  DB::table('cities')->whereIn('country_id',function($query) use($country){
            $query->select('id')->from('country')->where('country.continent','=',$country);
        })->get();

        $html ='<option value="">Select City</option>';
        foreach ($cities as $key => $value) {
            
            $html .= '<option value="'.$value->city_name.'">'.$value->city_name.'</option>';
           
        }
        echo $html;
    }

    public function getlocations(Request $request)
    {
        
        $country = $request->continent;

        $data = DB::table('cafe')->select('id','store_name','address_line_1','zip_code','city','country')->where('country',$country)->where('city','=',$request->city)->get();
        
        $html ='<option value="">Choose Cafe Location</option>';
        foreach( $data as $key => $value ) {
            $html .= '<option value="'.$value->zip_code.'">'.$value->address_line_1.', '.$value->store_name.', '.$value->city.', '.$value->country.', '.$value->zip_code.'</option>';
        } // foreach end

        if( $data->count() <= 0 )
        {
            echo $data->count().':::'.$html;
        }
        else
        {
            echo $html;
        }
   }

   public function usastates(Request $request)
   {
        //print_r($request->zip_code); exit;

        if( isset($request->zip_code) )
        {
            $cafeState = DB::table('cafe')
                ->select('state')
                ->where('zip_code', 'like', $request->zip_code.'%')
                ->groupBy('state')
                ->get();

            if( $cafeState->count() > 0 )
            {
                $states = DB::table('state')
                            ->select('*')
                            ->where('state_code', $cafeState[0]->state)
                            ->orderBy('nstate','ASC')
                            ->get();

                $html = '';
            }
            else
            {
                $states = DB::table('state')->select('*')->orderBy('nstate','ASC')->get();

                $html = '<option value="">Choose One</option>';
            }
        }
        else
        {
            $states = DB::table('state')->select('*')->orderBy('nstate','ASC')->get();

            $html = '<option value="">Choose One</option>';
        }

        foreach ($states as $key => $value) {
            $html .= '<option value="'.$value->state_code.'">'.$value->nstate.'</option>';
        }

        echo $html;
   }

   public function usacities(Request $request)
   {    
        // $getstatecode = DB::table('state')->select('state_code')->where('nstate',$request->nstate)->get();
        // $sc = $getstatecode[0]->state_code;
        if( isset($request->zip_code) )
        {
            $data = DB::table('cafe')
                    ->select('city')
                    ->where('zip_code', 'like', $request->zip_code.'%')
                    ->where('country_code', 'US')
                    ->groupBy('city')
                    ->get();
        }
        else
        {
            $data = DB::table('cafe')->select('city')->where('state',$request->state_code)->where('country_code','US')->groupBy('city')->get();
        }

        $html = '<option value="">Choose One</option>';
        foreach ($data as $key => $value) {
            $html .= '<option value="'.$value->city.'">'.$value->city.'</option>';
        }
        echo $html;
   }


    public function usacodes(Request $request)
   {    
        // $getstatecode = DB::table('state')->select('state_code')->where('nstate',$request->nstate)->get();
        // $sc = $getstatecode[0]->state_code;
        if( isset($request->zip_code) )
        {
            $data = DB::table('cafe')
                    ->select('city')
                    ->where('zip_code', 'like', $request->zip_code.'%')
                    ->where('country_code', 'US')
                    ->groupBy('city')
                    ->get();
        }
        else
        {
            $data = DB::table('cafe')->select('zip_code')->where('city',$request->city)->where('state',$request->state)->where('country_code','US')->get()->toArray();
            // print_r($data);die();
        }

        $html = '<option value="">Choose One</option>';
        foreach ($data as $key => $value) {
            echo "<pre>";
            print_r($key);
            print_r($value->zip_code);
            $html .= '<option value="'.$value->zip_code.'">'.$value->zip_code.'</option>';
        }
        echo $html;
   }


    public function findMatch() {
        
        if(Auth::check()) {
            // if(Auth::user()->about_me_details == "fill"){
            if(Auth::user()){

                session(['find_match' => 'find_match_login','user' => 'dashboard']);
                Session::forget('custom');
                return view('dashboard_wlogin');
                // return view('/find-match');
            }else{
                Session::forget('custom');
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

    public function Mymatch(Request $request){
        $data = $request->all();
         // dd($data);
        Session::put(['data_session'=>$data]);
        $ses = Session::get('data_session');
       
        return view('/aboutme_mymatch')->with('ses',$ses);
        // print_r(Session::get($ses));die();
    }

    public function getMatchResult(Request $request){
        $data = $request->all();
        // print_r($data);die();
        if($data['about_gender'] == 'Straight Male'){
            $data['about_gender'] = 'Male';
        }
        if($data['about_gender'] == 'Straight Female'){
            $data['about_gender'] = 'Female';
        }

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
            return json_encode(array(
            "statusCode"=>200
        ));
            // return redirect('/aboutme_mymatch');
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


            return view('customSearch')->with('cafes',$getCafes)->with('cities',$cities)->with('city',$city)->with('cafe_location',$cafe_location)->with('states',$states)->with('ustate',$ustate)->with('usacities',$usacities)->with('cafeee',$cafeee)->with('usalocations',$usalocations)->with('locations',$locations);
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
            return view('customSearch')->with('cities',$cities)->with('city',$city)->with('states',$states)->with('ustate',$ustate)->with('usacities',$usacities)->with('locations',$locations)->with('filtered_data',$filtered_data);
        } else{
            return redirect('/');
        }

    }

    public function find_cafes_with_extra($cafe,$d,$m,$y,$continent,$country) {
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
        $data = 'null';
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
                        $query->where('delete_account','0'); 
                        $query->get();
                    }])
                    ->get();

        }else{

            if(is_numeric($cafe)){
                if($sum > 0) {
                    $data = Cafe::where('zip_code','like','%'.$cafe.'%')->with('cafeUsers')->with(['cafeUsers' => function($query) use($sum){
                        $query->where('datepoint',$sum); 
                        $query->where('delete_account','0'); 
                        $query->get();
                    }])
                    ->get();
                } else {
                    $data = Cafe::where('zip_code','like','%'.$cafe.'%')->with('cafeUsers')->get();
                }
            } else{
                if($sum > 0) {
                    if(strlen($cafe)<=2){

                        $data = Cafe::where('state',$cafe)->with('cafeUsers')->with(['cafeUsers' => function($query) use($sum){
                            $query->where('datepoint',$sum); 
                            $query->where('delete_account','0'); 
                            $query->get();
                        }])
                        ->get();
                    } else{
                        $state = States::select('state_code')->where('nstate',$cafe)->first();
                        if(!empty($state->state_code)){
                            $data = Cafe::where('state',$state->state_code)->with('cafeUsers')->with(['cafeUsers' => function($query) use($sum){
                                $query->where('datepoint',$sum); 
                                $query->where('delete_account','0'); 
                                $query->get();
                            }])
                            ->get();
                        }
                    }
                } else {
                    if(strlen($cafe)<=2){
                        $data = Cafe::where('state',$cafe)->with('cafeUsers')->with(['cafeUsers' => function($query){
                                $query->where('delete_account','0'); 
                                $query->get();
                            }])
                        ->get();

                    } else{
                        $state = States::select('state_code')->where('nstate',$cafe)->first();
                        if(!empty($state->state_code)){
                            $data = Cafe::where('state',$state->state_code)->with('cafeUsers')->with(['cafeUsers' => function($query){
                                $query->where('delete_account','0'); 
                                $query->get();
                            }])->get();
                        }
                    }
                }
            }
        }

        return $data;
    }




    public function my_profile($id = null){
        if(Auth::check() && Auth::user()->type == "user" or Auth::user()->type == "admin") {

            if($id==''){
                $id = Auth::user()->id;
            }
            Session::forget('parameters'); 
            $userDetail = User::where('id',$id)->with(['UserLoc','UserState','payment_status'])->first();

            // $pay = Payment::get();
        

            // $payments =  DB::table('payments')->select('*')->where('user_id',Auth::user()->id)->where('status','Current')->first();
            $payments =  DB::table('payments')->select('*')->where('user_id',Auth::user()->id)->first();


            // $paymentsUser =  DB::table('payments')->select('*')->where('user_id',Auth::user()->id)->first();

            $today = date('Y-m-d H:i:s');
            if($payments!='')
            {
                if($today > $payments->expiry_date)
                {
                    $pay = DB::table('payments')->where('user_id',Auth::user()->id)->update(['status' => 'Previous']);
                    
                    // $payments =  DB::table('payments')->select('*')->where('user_id',Auth::user()->id)->where('status','Current')->first();
                    $payments =  DB::table('payments')->select('*')->where('user_id',Auth::user()->id)->first();

                }
            }
            
            $friends = array();
            $previous = array();
            $next = array();

            return view('myprofile')->with('userDetail',$userDetail)->with('friends',$friends)->with('previous',$previous)->with('next',$next)->with('payments',$payments);
        } else {
            $user_loginID = encrypt($id);
            return redirect('/login/?id='.$user_loginID.'');
        }
    }

    public function next_search(){
        return view('next_search');
    }
    
    public function checkUniqueUser(Request $request)
    {
        $userID = User::where('email', $request['email'])->count();

        echo $userID;
    }

    

    public function account(Request $request){
        // dd($request);
        session_start();
    	$country = $request->country;
    	$seeking = $request->seeking;
        $data = $request->all();
            if(empty($request->session()->get('data_session'))){
                // echo "1";
                $request->session()->put(['data_session'=>$data]);
                // $request->fill($data);
                $sesion = $request->session()->get('data_session');
            }else{
                // echo "2";
                $sesion = $request->session()->get('data_session');
                $request->session()->put(['data_session'=>$data]);

            }

        $cafe = DB::table('cafe')
                ->select('*')
                ->where('city', $request['city'])
                ->where('country_code','CA')
                ->get();
        
        $cafe_loc = $cafe[0]->zip_code;
        
        $data0 = DB::table('cafe')
                ->select('city','state','country')
                ->where('city',$request['city'])
                ->where('country_code','CA')
                ->groupBy('city')
                ->get();

        $state1 = DB::table('canada_provinces')
                    ->select('canada_province','state_code')
                    ->where('state_code', $data0[0]->state)
                    ->get()
                    ->toArray();
        $statename = $state1[0]->canada_province;
        
        return view('country_search')
                ->with('country', $country)
                ->with('seeking', $seeking)
                ->with('sesion',$sesion)
                ->with('statename',$statename)
                ->with('cafe_loc',$cafe_loc);
    }
    
    public function date_of_birth(Request $request){
        session_start();
    	$country = $request->country;
    	$seeking = $request->seeking;
        $data = $request->all();
        // print_r($data);die();
        $day = $request->input('day');
        $month = $request->input('month');
        $year = $request->input('year');
        $cafe = $request->input('cafe');

        $request->session()->put(['day'=>$day]);
        $day = $request->session()->get('day');

        $request->session()->put(['month'=>$month]);
        $month = $request->session()->get('month');

        $request->session()->put(['year'=>$year]);
        $year = $request->session()->get('year');

         $request->session()->put(['cafe'=>$cafe]);
        $cafe = $request->session()->get('cafe');

        if(empty($request->session()->get('data_session'))){
                // echo "1";
                $request->session()->put(['data_session'=>$data]);
                // $request->fill($data);
                $sesion = $request->session()->get('data_session');
            }else if(!empty($request->session()->get('data_session'))){
                // echo "2";
                $sesion = $request->session()->get('data_session');
                $request->session()->put(['data_session'=>$data]);

            }else{
                // echo "3";
                $request->session()->put(['data_session'=>$data]);
                $sesion = $request->session()->get('data_session');
            }

            // $request->session()->put(['data_session'=>$data]);
            //     $sesion = $request->session()->get('data_session');
        $cafe = DB::table('cafe')->select('*')->where('city',$request['city'])->where('country_code','US')->get();
        
        @$cafe_loc = $cafe[0]->zip_code;
        // print_r($cafe_loc);die();
        @$data0 = DB::table('cafe')->select('city','state','country')->where('city',$request['city'])->where('country_code','US')->groupBy('city')->get();
        @$state1 = DB::table('state')->select('nstate','state_code')->where('state_code',@$data0[0]->state)->get()->toArray();
        @$statename = @$state1[0]->nstate;
        // print_r($sesion);die();
        // echo "<pre>";
        return view('registration')->with('country',$country)->with('seeking',$seeking)->with('sesion',$sesion)->with('statename',$statename)->with('cafe_loc',$cafe_loc)->with('day',$day)->with('month',$month)->with('year',$year)->with('cafe',$cafe);
    }


    public function registeration(Request $request){
        session_start();
        $country = $request->country;
        $seeking = $request->seeking;
        $data = $request->all();
            if(empty($request->session()->get('data_session'))){
                // echo "1";
                $request->session()->put(['data_session'=>$data]);
                // $request->fill($data);
                $sesion = $request->session()->get('data_session');
            }else if(!empty($request->session()->get('data_session'))){
                // echo "2";
                $request->session()->put(['data_session'=>$data]);
                $sesion = $request->session()->get('data_session');

            }else{
                // echo "3";
                $request->session()->put(['data_session'=>$data]);
                $sesion = $request->session()->get('data_session');
            }



        $cafe = DB::table('cafe')->select('*')->where('city',$request['city'])->where('country_code','US')->get();
        
        $cafe_loc = $cafe[0]->zip_code;
        // print_r($cafe_loc);die();
        $data0 = DB::table('cafe')->select('city','state','country')->where('city',$request['city'])->where('country_code','US')->groupBy('city')->get();
        $state1 = DB::table('state')->select('nstate','state_code')->where('state_code',$data0[0]->state)->get()->toArray();
        $statename = $state1[0]->nstate;
        // print_r($sesion);die();
        // echo "<pre>";
        return view('registration')->with('country',$country)->with('seeking',$seeking)->with('sesion',$sesion)->with('statename',$statename)->with('cafe_loc',$cafe_loc);
    }

    public function account_countries(){
        return view('account_countries');
    }

    public function homeStates(Request $request)
    {
        Auth::logout();
        $states = DB::table('canada_provinces')
                ->select('*')
                ->orderBy('canada_province', 'ASC')
                ->get();

        $canada = 'Canada';
        $ses = session()->put('Canada', $canada);

        return view('home_states')
                ->with('states', $states);
                // ->with('ses', $ses);
    }

    public function getStateCites($state)
    {
        $state1 = DB::table('canada_provinces')
                    ->select('canada_province', 'state_code')
                    ->where('canada_province', $state)
                    ->first();
        $state1 = json_decode(json_encode($state1), true);

        /*$cities = DB::table('cafe')
                    ->select('city','state','country')
                    ->where('state', $state1['state_code'])
                    ->where('country_code','CA')
                    ->groupBy('city')
                    ->get();*/
        $cities = DB::table('canada_cities')
                    ->select('*')
                    ->where('state', $state1['state_code'])
                    ->where('status','Active')
                    ->orderBy('city', 'ASC')
                    ->get();
        
        $cities = json_decode(json_encode($cities), true);

        $city = DB::table('canada_provinces')
                    ->select('canada_province','state_code')
                    ->where('canada_province', $state)
                    ->first();
        $city = json_decode(json_encode($city), true);

        if( !empty($cities) && !empty($city) )
        {
            foreach ($cities as $key => $value)
            {
               if($city['state_code'] == $value['state'])
               {
                    $cities[$key]['state_name'] = $city['canada_province'];
               }
            }
        }

        $statename = $city['canada_province'];
        return view('state_cites')
                ->with('cities', $cities)
                ->with('statename', $statename);
    }

    
    public function custom_basic_info( Request $request ) {
        session_start();
        // dd($request->session()->get('data_session'));

        $data = $request->all();
        if( empty($request->session()->get('data_session')) )
        {
            if( !empty($data) ) {
                $request->session()->put(['data_session'=>$data]);
            }
            $sesion = $request->session()->get('data_session');
        }
        else if( !empty($request->session()->get('data_session')) )
        {
            if( !empty($data) ) {
                $request->session()->put(['data_session'=>$data]);
            }
            $sesion = $request->session()->get('data_session');
        }
        else
        {
            if( !empty($data) ) {
                $request->session()->put(['data_session'=>$data]);
            }
            $sesion = $request->session()->get('data_session');
        }
        // dd($sesion);

        return view('custom_basic_info')->with('email_step_session', $sesion);
    }

    public function custom_password_info( Request $request ){
        session_start();
        $request->validate([ 
            'email' => 'required|email|unique:users,email'
        ]);
        // echo $request->input('city');
        // dd($request);
        
        $data = $request->all();
        if( empty($request->session()->get('data_session')) )
        {
            $request->session()->put(['data_session'=>$data]);
            $sesion = $request->session()->get('data_session');
        }
        else if( !empty($request->session()->get('data_session')) )
        {
            $request->session()->put(['data_session'=>$data]);
            $sesion = $request->session()->get('data_session');

        }
        else
        {
            $request->session()->put(['data_session'=>$data]);
            $sesion = $request->session()->get('data_session');
        }
        // dd($sesion);

        $activities = Activites::orderBy('activity_name','ASC')->get();
        
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

        return view('custom_password_info')
                ->with('password_step_session', $sesion)
                ->with('matchActivities', $matchActivities);
    }

    public function thankYou()
    {
        return view('thank-you');
    }

    public function zip(Request $request){
        // print_r($request->all());die();
        $rel = $request['interested_in'];
        $data = DB::table('cafe')->select('city','state','country')->where('city',$request['city'])->where('country_code','US')->groupBy('city')->get();
        $state1 = DB::table('state')->select('nstate','state_code')->where('state_code',$data[0]->state)->get()->toArray();
        $zip_code = DB::table('cafe')->select('*')->where('city',$request['city'])->where('state',$request['state_code'])->where('country_code','US')->get();
        $statename = $state1[0]->nstate;
        return view('zip_codes')->with('zip_code',$zip_code)->with('state1',$state1)->with('statename',$statename)->with('all',$request->all())->with('rel',$rel);
    }

    public function cafe(Request $request){
        // print_r($request->all());die();
        $rel = $request['interested_in'];
        $data = DB::table('cafe')->select('city','state','country')->where('city',$request['city'])->where('country_code','US')->groupBy('city')->get();
        $state1 = DB::table('state')->select('nstate','state_code')->where('state_code',$data[0]->state)->get()->toArray();
        $cafe = DB::table('cafe')->select('*')->where('zip_code',$request['zip_code'])->where('country_code','US')->get();
        $statename = $state1[0]->nstate;
        return view('cafes')->with('cafe',$cafe)->with('state1',$state1)->with('statename',$statename)->with('all',$request->all())->with('rel',$rel);
    }


    public function register1(Request $request) {
        // dd($request->all());
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
       
        $this->create($request->all());
        $data  = $request->all();
        
        $user1 = array(
            'email' => @$data['email'],
            'password' => @$data['password'],
        );

        Mail::to($user1['email'])
            ->send(new Welcome($data));

        if( \Auth::attempt($user1) )
        {
            $user = DB::table('users')->where('id', Auth::user()->id)->first();

            if($user->delete_account==0) {
                if($user->status == 'activate') {
                    /* if page redirect from find my match */
                    if (Session::has('find_match')){
                        return redirect('/find-match');
                    }
                    if($user->account_setup == 0) {
                        // return redirect('/user/create-account');
                        // Auth::login($user);

                        return redirect('/thank-you');
                        // return redirect('/user/new_user_edit_profile');
                    } else {
                        // Auth::login($user);
                        // return redirect('/user/dashboard');

                        return redirect('/thank-you');
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
        }
        else
        {
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
        $month = $this->rect(@$data['month']);
        $day = $this->rect(@$data['day']);
        $year = $this->rect(@$data['year']);
        $sum = $this->rect($month+$day+$year);
        
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
        $saveData['ustate'] = @$data['state_code'];
        $saveData['state'] = @$data['state'];
        $saveData['city'] = @$data['city'];
        // $saveData['city'] = @$data['cityname'];
        $saveData['cafe'] = @$data['cafe'];
        $saveData['zip_code'] = @$data['zip_code'];
        $saveData['interested_in'] = $data['interested_in'];
        $saveData['about_gender'] = @$data['about_gender'];
        $saveData['matchInterest'] = @$data['matchInterest'];

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
    protected function rect($num){
        if($num!=11 && $num!=22){
            $sum = array_sum(str_split($num));
            if($sum>=10 && $sum!=11 && $sum!=22){
                return $this->rect($sum);
            }else{
                return $sum;
            }
        }else{
            return $num;
        }
    }

    public function project()
    {
        return view('project');
    }

}

