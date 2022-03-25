<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\UserRepository;
use App\Repositories\CityRepository;
use App\Repositories\ContactMemberRepository;

use App\User;
use App\UserProfileImage;
use Auth;
use DB, Session;
use App\Admin;
use Illuminate\Support\Facades\Hash;
use App\PaymentSetting;

class AdminController extends Controller
{
	private $userRepository;
	private $cityRepository;
	private $contactMemberRepository;

	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->userRepository = new UserRepository;
        $this->cityRepository = new CityRepository;
        $this->contactMemberRepository = new contactMemberRepository;
    }

	public function login()
	{
		if( Auth::check() && Auth::user()->type == "admin" )
		{
			return redirect('/admin/dashboard');
		}
		else
		{
			return view('admin.admin-login');
		}
	}

	public function dashboard()
	{
		if( Auth::check() && Auth::user()->type == "admin" )
		{
			return view('admin.dashboard');
		}
		else
		{
			return redirect('/admin/login');
		}
	}

	public function checkUser(Request $request)
	{
		$this->validate($request, [
			'email'   => 'required|email',
			'password' => 'required'
		]);

		if( Auth::attempt(['email' => $request->email, 'password' => $request->password, 'type' => 'admin']) )
		{
			return redirect('/admin/dashboard');
		} 
		return redirect()->back()->with('failure', 'These credentials do not match our records.');
	}

	public function logout()
	{
		Auth::logout();
		return redirect('/admin/');
	}

	public function getUsers()
	{
		if( Auth::check() && Auth::user()->type == "admin" )
		{
			$allUsers = $this->userRepository->all('', 'user');
			return view('admin.users')->with('users', $allUsers);
		}
		else
		{
			return redirect('/admin/login');
		}
	}

	public function usersProfilePicture()
	{
		if( Auth::check() && Auth::user()->type == "admin" )
		{
			$usersProfilePicture = User::select(['id', 'name', 'email', 'image', 'profile_picture_status'])
						->where('type', 'user')
						->get();
			return view('admin.users-profile-picture', compact('usersProfilePicture'));
		}
		else
		{
			return redirect('/admin/login');
		}
	}

	public function changeStatus(Request $request)
	{
		$status = $request->status;
		if( $status == 1 )
		{
			User::where('id', $request->userId)->update(['status' => 'activate']);
		}
		else
		{
			User::where('id', $request->userId)->update(['status' => 'pending']);
		}
	}

	public function changeProfilePictureStatus(Request $request)
	{
		if( $request->profile_picture_status == 1 )
		{
			User::where('id', $request->userId)
					->update(['profile_picture_status' => 'Unapproved']);
		}
		else
		{
			User::where('id', $request->userId)
					->update(['profile_picture_status' => 'Approve']);
		}
	}

	public function deleteProfilePicture($id)
	{
		if( Auth::check() && Auth::user()->type == "admin" )
		{
			User::where('id', $id)
					->update(['image' => '']);

        	return redirect('/admin/users-profile-picture');
        }
        else
		{
			return redirect('/admin/login');
		}
	}

	public function viewProfile($id)
	{
		if( Auth::check() && Auth::user()->type == "admin")
		{
			$userDetail = User::where('id', $id)
					->with('UserCafe','UserState')
					->first();

			return view('admin.view-profile')
					->with('userDetail', $userDetail);
		}
		else
		{
			return redirect('/admin/login');
		}
	}

	public function viewmatchProfile($id)
	{
		if( Auth::check() && Auth::user()->type == "admin" )
		{
			$userDetail = User::where('id', $id)
					->with('UserCafe', 'UserCity', 'UserState')
					->first();
					
			return view('admin.view-matchprofile')->with('userDetail', $userDetail);
		}
		else
		{
			return redirect('/admin/login');
		}
	}

	public function deleteProfile($id)
	{
		if( Auth::check() && Auth::user()->type == "admin" )
		{
			$view = User::where('id',$id)
					// ->with('UserCafe','UserState')
					->first();
       		$view->delete(); 
        	return redirect('/admin/get-users');
        }
	}

	public function aboutSave(Request $request)
	{
		if(Auth::check() && Auth::user()->type == "admin") {
			if(isset($request->cbt) && $request->cbt !='')
			{
				$res = DB::table('cms')->where('page_name',$request->cms)->update(['content' => $request->cbt]);

				return redirect('/admin');
				
			}
		}else{
			echo "You are not admin";
		}
	}

	public function aboutus() {

			$data =  DB::table('cms')->select('*')->where('page_name','about-us')->first();
			return view('admin/aboutus')->with(['content'=>$data->content,'page_name'=>$data->page_name]);

	}

	public function adminTerms() {

			$data =  DB::table('cms')->select('*')->where('page_name','terms')->first();
			return view('admin/adminTerms')->with(['content'=>$data->content,'page_name'=>$data->page_name]);

	}


	public function adminPrivacy() {

			$data =  DB::table('cms')->select('*')->where('page_name','privacy')->first();
			return view('admin/adminPrivacy')->with(['content'=>$data->content,'page_name'=>$data->page_name]);

	}

	public function adminSafety() {

			$data =  DB::table('cms')->select('*')->where('page_name','safety')->first();
			return view('admin/adminSafety')->with(['content'=>$data->content,'page_name'=>$data->page_name]);

	}

	
	public function store(Request $request) 
	{ 
		$file=$request->file('file');
		$path= url('public/img/uploads/').'/'.$file->getClientOriginalName();
		$imgpath=$file->move(public_path('img/uploads/'),$file->getClientOriginalName());
		$fileNameToStore= $path;

		return json_encode(['location' => $fileNameToStore]); 
	}
	
	public function changepassword()
	{
		return view('admin/changepassword');
	}
	public function change(Request $request){

         $this->validate($request,[
             'password' => 'required|min:6',
             'password_confirmation' => 'required_with:password|same:password'
        ]);
			
		User::where('id',Auth::user()->id)->update([
			'password' => Hash::make($request->password),
			'original_password' => ($request->password),
		]);
		
		return redirect('/admin/dashboard');
   	}


   	public function paypalamount()
   	{
   		$data = PaymentSetting::where('id', '1')
   					->select('*')
   					->first();

   		return view('admin.paypalamount', compact('data'));
   	}

   	public function paypal(Request $request)
   	{
   		/*User::where('id',Auth::user()->id)->update([
   			'paypal_amount' => ($request->amount),
   		]);*/
   		PaymentSetting::where('id', '1')
   			->update([
   				'membership_fees' => ($request->amount),
   				'membership_status' => ($request->membership_status),
   			]);

   		return redirect('/admin/paypalamount');
   	}

   	public function mymatch(){
   		if(Auth::check() && Auth::user()->type == "admin") {
			 $alluser = User::where('type','user')->get()->toArray();
			return view('admin.mymatch')->with('users',$alluser);
		} else {
			return redirect('/admin/login');
		}
   	}

   	public function viewMatch($id){
   		if(Auth::check() && Auth::user()->type == "admin") {
			$userDetail = User::where('id',$id)->first()->toArray();
			$matchdetail = User::where('about_gender','!=',null)->where('id','!=',$id)->where('about_gender',$userDetail['about_gender'])->where([
										'type'=>'user', 
										'about_gender'=>$userDetail['about_gender'],
										'about_bodytype'=>$userDetail['about_bodytype'],
										'about_height' => $userDetail['about_height'] , 
										'about_eyecolor' => $userDetail['about_eyecolor'],
										'about_haircolor'=>$userDetail['about_haircolor'],
										'about_ethnicity'=>$userDetail['about_ethnicity'] , 
										'about_language'=>$userDetail['about_language'],
										'about_religion'=>$userDetail['about_religion'] ])
								->get()->toArray();
			// echo '<pre>';
			// print_r($matchdetail);die();
			return view('admin.viewMatchResults')->with('matchdetail',$matchdetail);
		} else {
			return redirect('/admin/login');
		}
   		// return view('admin/viewMatchResults');
   	}

   	public function englandcanada1($country)
   	{	
   		$country = $country;
   		$data =  DB::table('cities')->where('country_id',function($query) use($country){
				$query->select('id')->from('country')->where('country.country_name','=',$country);
			})->get();
   		return $data;
   	}

   	public function usacodes1($continent)
   {
   		$data = DB::table('state')->select('*')->orderBy('nstate','asc')->get();
   		return $data;
   }


   public function englandcanadalocations1($city)
   { 
	   $data =  DB::table('cafe')->select('id','city','country','store_name','address_line_1','zip_code')->where('city','=',$city)->get();
        return $data;
   }

    public function usacities1($ustate)
   {
   		$data = DB::table('cafe')->select('*')->where('state',$ustate)->where('country_code','US')->groupBy('city')->get();
   		return $data;
   }


   	public function findMatch(Request $request)
   	{
		// $userDetail = User::where('type', 'user')->first();

		$cities = $this->cityRepository->all('Active', '', 2);

   		return view('admin.findmatch')
   				->with('cities', $cities);
   	}

   	public function findMatchUsers(Request $request)
   	{
   		if( Auth::check() && Auth::user()->type == "admin")
   		{
	   		$filtered_data = User::where('id', '!=', Auth::user()->id);

            if ( $request->month != '' ) {
                $filtered_data = $filtered_data->where('month', $request->input('month'))->where('month','!=','')->whereNotNull('month');
            }

            if ( $request->day != '' ) {
                $filtered_data = $filtered_data->where('day',$request->input('day'))->where('day','!=','')->whereNotNull('day');
            }
             if ( $request->year != '' ) {
                $filtered_data = $filtered_data->where('year',$request->input('year'))->where('year','!=','')->whereNotNull('year');
            }

            // if ( $request->continent != '' ) {
            //     $filtered_data = $filtered_data->where('continent',$request->input('continent'))->where('continent','!=','')->whereNotNull('continent');
            // }

            if ( $request->country_id != '' ) {
                $filtered_data = $filtered_data->where('country_id', $request->input('country_id'))->where('country_id','!=',0)->whereNotNull('country_id');
            }
            
            if ( $request->city_id != '' ) {
                $filtered_data = $filtered_data->where('city_id',$request->input('city_id'))->where('city_id','!=',0)->whereNotNull('city_id');
            }

            if ( $request->about_gender != 'Any' ) {
                $filtered_data = $filtered_data->where('about_gender',$request->input('about_gender'))->where('about_gender','!=','')->whereNotNull('about_gender');
            }

            if ( $request->about_bodytype != 'Any' ) {
                $filtered_data = $filtered_data->where('about_bodytype',$request->input('about_bodytype'))->where('about_bodytype','!=','')->whereNotNull('about_bodytype');
            }

            if ( $request->about_height != 'Any' ) {
                $filtered_data = $filtered_data->where('about_height',$request->input('about_height'))->where('about_height','!=','')->whereNotNull('about_height');
            }

            if ( $request->about_eyecolor != 'Any' ) {
                $filtered_data = $filtered_data->where('about_eyecolor',$request->input('about_eyecolor'))->where('about_eyecolor','!=','')->whereNotNull('about_eyecolor');
            }

            if ( $request->about_haircolor != 'Any' ) {
                $filtered_data = $filtered_data->where('about_haircolor',$request->input('about_haircolor'))->where('about_haircolor','!=','')->whereNotNull('about_haircolor');
            }

            if ( $request->about_ethnicity != 'Any' ) {
                $filtered_data = $filtered_data->where('about_ethnicity',$request->input('about_ethnicity'))->where('about_ethnicity','!=','')->whereNotNull('about_ethnicity');
            }

         	if ( $request->about_religion != 'Any' ) {
                $filtered_data = $filtered_data->where('about_religion',$request->input('about_religion'))->where('about_religion','!=','')->whereNotNull('about_religion');
            }

            if ( $request->about_language != 'Any' ) {
                $filtered_data = $filtered_data->where('about_language',$request->input('about_language'))->where('about_language','!=','')->whereNotNull('about_language');
            }

            $matchdetail = $filtered_data->get()->toArray();

	   		return view('admin.matchdetail_result')->with('matchdetail', $matchdetail);
   		}
   	}

   	public function usersProfileImage()
	{
		if( Auth::check() && Auth::user()->type == "admin" )
		{
			$usersProfileImages = UserProfileImage::get();
			return view('admin.users-profile-images', compact('usersProfileImages'));
		}
		else
		{
			return redirect('/admin/login');
		}
	}

	public function usersProfileImageAdd($id = null)
	{
		if( Auth::check() && Auth::user()->type == "admin" )
		{
			$usersProfileImage = array();
			if( $id )
			{
				$usersProfileImage = UserProfileImage::findOrFail($id);
			}
			
			return view('admin.users-profile-images-add', compact('usersProfileImage'));
		}
		else
		{
			return redirect('/admin/login');
		}
	}

	public function usersProfileImageInsert(Request $request)
   	{
   		$image = $request->file('image_name');
		if( $image )
		{
			$imageName = time().'.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/img');

			$image->move($destinationPath, $imageName);

			$imagePath = $destinationPath.$request->old_image_name;
			if( file_exists($imagePath) )
			{
			    @unlink($imagePath);
			}
		}
		else
		{
			$imageName = $request->old_image_name;
		}

		if( $request->id )
		{
			UserProfileImage::where('id', $request->id)
				   			->update([
				   				'image_name' => $imageName,
				   				'image_gender' => $request->image_gender,
				   			]);

			Session::flash('messageType', 'success');
        	Session::flash('message', 'Image updated successfully.');
		}
		else
		{
			UserProfileImage::create([
							'image_name' => $imageName,
							'image_gender' => $request->image_gender,
						]);

			Session::flash('messageType', 'success');
        	Session::flash('message', 'Image added successfully.');
		}
		
		/*else
		{
			Session::flash('messageType', 'error');
            Session::flash('message', 'Can\'t add image.');
		}*/

   		return redirect('/admin/users-profile-images');
   	}

   	public function usersProfileImageDelete($id)
	{
		if( Auth::check() && Auth::user()->type == "admin" )
		{
			$image = UserProfileImage::findOrFail($id);

			if( $image )
			{
				$imagePath = public_path().'/img/'.$image->image_name;
				if( file_exists($imagePath) )
				{
					@unlink($imagePath);
				}

				$image->delete();

				Session::flash('messageType', 'success');
            	Session::flash('message', 'Image deleted successfully.');
			}
			else
			{
				Session::flash('messageType', 'error');
	            Session::flash('message', 'Some issues..., try again sometime delete record.');
			}

        	return redirect('/admin/users-profile-images');
        }
        else
		{
			return redirect('/admin/login');
		}
	}

	public function usersBiography()
	{
		if( Auth::check() && Auth::user()->type == "admin" )
		{
			$usersBiography = $this->userRepository->all('', 'user');
			// $usersBiography = User::select(['id', 'name', 'email', 'biography', 'biography_status'])
			// 			->where('type', 'user')
			// 			->get();

			return view('admin.users-biography', compact('usersBiography'));
		}
		else
		{
			return redirect('/admin/login');
		}
	}

	public function changeBiographyStatus(Request $request)
	{
		if( $request->biography_status == 1 )
		{
			User::where('id', $request->userId)
					->update(['biography_status' => 'Unapproved']);
		}
		else
		{
			User::where('id', $request->userId)
					->update(['biography_status' => 'Approve']);
		}
	}

	public function contactMembers()
	{
		if( Auth::check() && Auth::user()->type == "admin" )
		{
			$contactMembers = $this->contactMemberRepository->all();

			return view('admin.contact-members', compact('contactMembers'));
		}
		else
		{
			return redirect('/admin/login');
		}
	}
}