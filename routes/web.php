<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index'); // use
Route::get('/find-a-match', 'HomeController@findaMatch'); // use
Route::any('/advance-search-result', 'HomeController@advanceSearchResult'); // use
Route::get('/about', 'HomeController@about'); // use
Route::get('/privacy', 'HomeController@privacy'); // use
Route::get('/safety', 'HomeController@safety'); // use
Route::get('/terms', 'HomeController@terms'); // use
Route::get('/join-today/{id}', 'HomeController@joinToday'); // use

Route::get('/contactUs/{id?}','HomeController@contact_us');
Route::post('/sendcontactmail','HomeController@contact_save');

Route::get('/login', 'HomeController@login');

Route::get('/forgot', 'HomeController@forgot');
Route::get('/register', 'HomeController@membership');
Route::get('/check-unique-user','HomeController@checkUniqueUser');

Auth::routes(); // use

Route::get('/logout', 'HomeController@logout');


Route::get('/membership', 'HomeController@membership');
Route::get('/cities','HomeController@cities');
Route::get('/location','HomeController@location');
Route::get('/selectedloc','HomeController@selectedloc');
Route::get('/showcountries','HomeController@showcountries');
Route::get('/zipcodes','HomeController@zipcodes');
Route::get('/registercountries','HomeController@registercountries');
Route::get('/registercountries_signin','HomeController@registercountries_signin');
Route::get('/europecountries','HomeController@europecountries');
Route::get('/getcities','HomeController@getcities');
Route::get('/getlocations','HomeController@getlocations');
Route::get('/usastates','HomeController@usastates');
Route::get('/usacities','HomeController@usacities');
Route::get('/usacodes','HomeController@usacodes');
Route::get('/dashboard_wlogin', 'HomeController@dashboard_wlogin');
Route::get('/get_europe_cities', 'HomeController@getEuropeCities');
Route::any('/user_logout','HomeController@user_logout');
Route::post('/forget-password', 'HomeController@forget');
Route::any('/search-result', 'HomeController@search_result');
Route::get('/profile/{id}', 'HomeController@user_profile');
Route::get('/count-friend-request', 'UserController@count_request');


Route::get('/terms_app','HomeController@termsapp');
Route::get('/about_app','HomeController@aboutapp');
Route::get('/privacy_app','HomeController@privacyapp');
Route::get('/safety_app','HomeController@safetyapp');


// Route for stripe post request.
Route::post('/pay-with-stripe-payment', array('as' => 'stripe.stripePost','uses' => 'HomeController@postPaymentWithStripe'));

Route::get('/find-match','HomeController@findMatch');
Route::get('/about-me','HomeController@aboutMe');
Route::any('/search-matching-result','HomeController@getMatchResult');
Route::any('/checkEmailExist','HomeController@checkEmailExist');
Route::any('/findmatch','HomeController@find_match');
Route::any('/aboutme_mymatch','HomeController@aboutme_mymatch');
Route::any('/Mymatch','HomeController@Mymatch');
Route::any('/custom-search','HomeController@customSearch');
Route::any('/custom','HomeController@custom');
Route::get('/user-profile/{id?}','HomeController@my_profile');


/*Route::get('/advance-search', function () {
    return view('advance_search');
});*/


Route::get('/getCafes/{id}','UserController@getCafes');
Route::get('/getFriends/{to}','UserController@getFriends');
Route::post('/search-cafe','UserController@search_cafe_by_loc');



/* 25-nov kk */
Route::match(['get', 'post'],'/save-about-me','HomeController@saveAboutme');
/*Route::get('/account-info', function () {
    return view('account_info');
});*/
/*Route::get('/profile', function () {
    return view('profile');
});*/
// Route::get('/cafelocation_map211', function () {
//     return view('cafelocation_map211');
// });



Route::group(array('prefix' => 'admin'), function()
{
    Route::get('/', 'AdminController@login');
    Route::get('/login', 'AdminController@login');
    Route::post('/login', 'AdminController@checkUser');
    Route::get('/dashboard', 'AdminController@dashboard');
    Route::get('/logout', 'AdminController@logout');
    Route::get('/get-users', 'AdminController@getUsers');
    Route::post('/change-status','AdminController@changeStatus');
    Route::get('/view-profile/{id}','AdminController@viewProfile');
    Route::get('/view-matchprofile/{id}','AdminController@viewmatchProfile');
    Route::get('/viewMatchResults/{id}','AdminController@viewMatch');
    Route::get('/aboutus','AdminController@aboutus');
    Route::get('/adminTerms','AdminController@adminTerms');
    Route::get('/adminPrivacy','AdminController@adminPrivacy');
    Route::get('/adminSafety','AdminController@adminSafety');
    Route::post('/aboutSave','AdminController@aboutSave');
    Route::post('/uploadaboutimage','AdminController@store');
    Route::get('/changepassword','AdminController@changepassword');
    Route::post('/changepassword','AdminController@change');
    Route::get('/delete-profile/{id}','AdminController@deleteProfile');
    Route::get('/paypalamount','AdminController@paypalamount');
    Route::get('/Findmatch','AdminController@findMatch');
    Route::any('/findmatchusers','AdminController@findmatchusers');
    Route::any('/matchdetail_result','AdminController@matchdetail_result');
    Route::post('/paypalamount','AdminController@paypal');
    Route::any('/mymatch','AdminController@mymatch');

    Route::any('/users-profile-picture','AdminController@usersProfilePicture')->name('admin.usersprofilepicture');
    Route::post('/change-profile-picture-status','AdminController@changeProfilePictureStatus');
    Route::get('/delete-profile-picture/{id}','AdminController@deleteProfilePicture');

    Route::get('/users-profile-images','AdminController@usersProfileImage')->name('admin.usersprofileimage');
    Route::any('/users-profile-images-add/{id?}','AdminController@usersProfileImageAdd')->name('admin.usersprofileimageadd');
    Route::post('/users-profile-images-add/{id?}','AdminController@usersProfileImageInsert');
    Route::get('/users-profile-images-delete/{id}','AdminController@usersProfileImageDelete');

    Route::any('/users-biography','AdminController@usersBiography')->name('admin.biography');
    Route::post('/change-biography-status','AdminController@changeBiographyStatus');

    Route::get('/contact-members','AdminController@contactMembers')->name('admin.contactmembers');
});

Route::group(array('prefix' => 'user'), function()
{
    Route::get('/', 'UserController@dashboard');
	Route::get('/dashboard', 'UserController@dashboard');
    Route::any('/cafe-members', 'UserController@cafeMembers');
    Route::get('/search-cafes', 'UserController@searchCafes');

    Route::get('/cities', 'UserController@getcities');
    Route::get('/cafes', 'UserController@getCafeLocations');

    Route::get('/edit-profile-dashboard', 'UserController@editProfileDashborad');

    Route::get('/about-me', "UserController@aboutMe");
    Route::post('/about-me', "UserController@aboutMeUpdate");
    Route::get('/about-my-match', "UserController@aboutMyMatch");
    Route::post('/about-my-match',"UserController@aboutMyMatchUpdate");
    Route::get('/horoscope', 'UserController@horoscope');
    Route::get('/mycafe','UserController@myCafe');
    Route::get('/user-profile/{id?}','UserController@userProfile');
    Route::get('/change-photo', 'UserController@changePhoto');
    Route::post('/change-photo', 'UserController@changePhotoSave');
    Route::get('/account-info','UserController@accountInfo');
    Route::get('/cafe-detail/{id}', 'UserController@cafeDetail');
    Route::get('/edit-user-profile', "UserController@editUserProfile");
    Route::post('/edit-user-profile', 'UserController@editUserProfileUpdate');
    Route::post('/send-message','UserController@sendMessage');
    Route::get('/read-mail', 'UserController@readMail');
    Route::get('/contact-member/{id?}', 'UserController@contactMember');
    Route::post('/contact-member', 'UserController@sendContactMember');

    // old
    Route::get('/profile','UserController@profile');
    
    Route::post('/new_about_profile_update','UserController@new_about_profile_update');
    Route::get('/advance-search','UserController@advance_search');
    Route::post('/advance-search','UserController@advance_search_results');
    
    Route::get('/cafelocation_map','UserController@cafeLocation_map');
    Route::get('/view-profile/{id?}','UserController@view_profile');
    
    Route::any('/all_user','UserController@all_user');

    Route::any('/custom','UserController@custom');
    Route::any('/customSearch','UserController@customSearch');

    Route::get('/terms', 'UserController@terms');
    
    Route::get('/match','UserController@insta_match');
    Route::get('/search-member','UserController@search_member');
    Route::any('/search-result', 'UserController@search_result');
    Route::any('/all_search', 'UserController@all_search');
    
    Route::get('/mailbox', 'UserController@mailbox');
    Route::get('/photos', 'UserController@photos');
    Route::post('/photos', 'UserController@photos_upload');
    
    Route::get('/friend-request','UserController@friend_request');
    Route::post('/add-friend','UserController@add_friend');
    Route::post('/cancel-request','UserController@cancel_request');
    Route::post('/confirm-request','UserController@confirm_request');
    
    Route::get('/chat/{mid}','UserController@getChat');
    Route::post('/send-chat-msg','UserController@chat_message');
    Route::post('/delete-chat','UserController@delete_chat');
    Route::post('/delete-image','UserController@delete_image');
    Route::get('/create-account',"UserController@account_setup");
    
    Route::any('/new_aboutme_profile_update',"UserController@new_aboutme_profile_update");

    Route::get('/register-aboutmymatch',"UserController@register_aboutmymatch");

    Route::get('/user-match-info',"UserController@match_info");
    Route::any('/horoscope_update',"UserController@horoscope_update");
    Route::any('/new_reg_profile_update',"UserController@new_reg_profile_update");

    Route::any('/new_user_edit_profile',"UserController@new_user_edit_profile");

    Route::any('/new_user_aboutme',"UserController@new_user_aboutme");

    Route::any('/new_user_aboutmymatch',"UserController@new_user_aboutmymatch");

    
    Route::any('/horoscope_login_update',"UserController@horoscope_login_update");

    Route::any('/deleteimage',"UserController@deleteimage");


    Route::get('/delete-account',"UserController@delete_account");
    Route::get('/cafe-location',"UserController@cafe_location");
    Route::post('/update-cafe-location',"UserController@update_cafe_location");
    Route::get('/numerology',"UserController@Calculator");
    Route::get('/ThankYou',"UserController@ThankYou");
    Route::post('/update-image',"UserController@UpdateImage");
    Route::post('/change-user-image',"UserController@changeUserImage");
    Route::get('/showlocations',"UserController@showlocations");
    Route::get('/selectedlocation',"UserController@selectedlocation");
    
    Route::get('/leaving','UserController@leaving');
    Route::get('/englandcanada','UserController@englandcanada');
    Route::get('/englandcanadalocations','UserController@englandcanadalocations');
    Route::get('/usacodes','UserController@usacodes');
    Route::get('/euro','UserController@euro');
    
    
    Route::get('/usazipcode','UserController@usazipcode');
    Route::get('/usacities123','UserController@usacities123');
    Route::get('/englandcanadalocations2','UserController@englandcanadalocations2');
    

    Route::any('/user_advance_search','UserController@user_advance_search');
    // Route::any('/search-member','UserController@user_advance_search');

    Route::get('/membership', 'UserController@membership');
    Route::any('/my-account','UserController@myAccount');
    
});


Route::any('/cafe','HomeController@cafe');

// Register step route start
Route::get('login/{social}', 'Auth\LoginController@getSocialRedirect');
Route::get('login/{social}/callback', 'Auth\LoginController@getSocialCallback');
Route::any('social-register','RegisterController@socialRegister');

Route::get('/activate/{id}', 'RegisterController@activateAccount'); // use

Route::get('/provinces-list', 'RegisterController@statesList'); // use
Route::get('/{state}/cities-list', 'RegisterController@citiesList'); // use
Route::get('/{state}/{city}','RegisterController@typeOfRelationship'); // use
Route::any('/{state}/{city}/birthday','RegisterController@birthday'); // use
Route::any('/{state}/{city}/fullname','RegisterController@fullname'); // use
Route::any('/{state}/{city}/email','RegisterController@email'); // use
Route::any('/{state}/{city}/password','RegisterController@password'); // use
Route::any('register1','RegisterController@register');

Route::get('/thank-you', 'HomeController@thankYou');
// Register step route end

Route::any('/project','HomeController@project');