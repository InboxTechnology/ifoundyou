<?php

namespace App\Http\Controllers\Auth;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Session;

use App\User;
use Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/user/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function authenticated($request, $user)
    {
        if( $user->type == 'admin' )
        {
            return redirect('admin/');
        }

        if( !empty($request->user_loginID) )
        {
            $userlogin_ID = decrypt($request->user_loginID);
            return redirect('user/user-profile/'.$userrlogin_ID.'');
        }
        else
        {
            if( $user->delete_account==0 )
            {
                if( $user->status == 'activate' )
                {
                    return redirect('/user/dashboard');
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
                return redirect('/')->with('warning','Your account has deleted.');
            }
        }
    }


    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSocialRedirect($account)
    {
        try
        {
            return Socialite::with($account)->redirect();
            // return Socialite::driver($account)->redirect();
        }
        catch ( \InvalidArgumentException $e )
        {
            return redirect('/login');
        }
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSocialCallback($account)
    {
        /*
        Grabs the user who authenticated via social account.
        */
        $socialUser = Socialite::driver($account)->user();
        
        if( !empty($socialUser->token) )
        {
            /*
                Gets the user in our database where the eamil ID
                returned matches a user we have stored.
            */
            $userExits = User::where( 'email', $socialUser->getEmail() )->count();
                   
            if( $userExits==0 )
            {
                /*
                    Gets the user in our database where the provider ID
                    returned matches a user we have stored.
                */
                $user = User::where( 'provider_id', '=', $socialUser->id )
                                ->where( 'provider_name', '=', $account )
                                ->first();

                /*
                    Checks to see if a user exists. If not we need to create the
                    user in the database before logging them in.
                  */
                if( $user==null )
                {
                    $newUser = new User();

                    $newUser->name          = $socialUser->getName();
                    $newUser->email         = $socialUser->getEmail()=='' ? '' : $socialUser->getEmail();
                    // $newUser->avatar        = $socialUser->getAvatar();
                    $newUser->password      = '';
                    $newUser->provider_name = $account;
                    $newUser->provider_id   = $socialUser->getId();

                    $newUser->save();
                    $user = $newUser;
                }
            }
            else
            {
                $updateUser = User::where( 'email', $socialUser->getEmail() )->first();
                $updateUser->provider_name = $account;
                $updateUser->provider_id   = $socialUser->getId();

                $updateUser->save();
                $user = $updateUser;
                // return redirect('/')->with('warning', 'The email has been already taken');;
            }

            /*
            Log in the user
            */
            Auth::login( $user );
        }

        /*
        Redirect to the app
        */
        return redirect('/');
    }
}
