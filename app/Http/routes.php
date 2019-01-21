<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

     
    

    Route::get('home', 'HomeController@index');
    
    Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect' ]], function()
    {
        
        /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
         
        Route::controllers([
            'coaches'   => 'CoachController',
            'customer' => 'CustomerController',
        ]);
        
        
        Route::controllers([
        'auth' => 'Auth\AuthController',
        'password' => 'Auth\PasswordController',
		]);

        
        Route::get('/', 'WelcomeController@index');
        Route::auth();
         
        Route::get('/states/{id}', 'WelcomeController@getStates');
        Route::get('/cntname/{sortname}', 'WelcomeController@getCountryName');
        Route::post('/find-services', 'WelcomeController@findServices');
        Route::get('/services/{zip_code?}', 'WelcomeController@getServices');



        Route::get('/users/register', 'UsersController@register');
        Route::post('/users/storeuser', 'UsersController@storeuser');
        Route::get('/users/success', 'UsersController@success');
        Route::get('users/account-information', 'UsersController@accountInformation');
        Route::get('users/password', 'UsersController@password');
        Route::post('users/change', 'UsersController@change');
        Route::get('users/editprofile', 'UsersController@editprofile'); 
        Route::post('users/updateprofile', 'UsersController@updateprofile');
        Route::get('users/detail', 'UsersController@detail');
        Route::post('users/coachdetail', 'UsersController@coachdetail');
        Route::get('users/editcoachprofile', 'UsersController@editcoachprofile');
        Route::post('users/updatecoachprofile/{id}', 'UsersController@updatecoachprofile');
        Route::get('users/success', 'UsersController@success');
        Route::post('users/update-profile-image', 'UsersController@updateProfileImage');
        
        


        Route::get('users/profile', 'UsersController@coachProfile');
        Route::get('users/deletephoto', 'UsersController@deletephoto');

        

         //.........messages..................
		Route::get('messages/', 'MessagesController@index');
		Route::get('outbox/', 'MessagesController@outbox');
		Route::get('add_message/', 'MessagesController@add');
		Route::post('send_message/', 'MessagesController@send_message');
		Route::get('edit_message/{id}', 'MessagesController@edit');
		Route::post('edit_post/', 'MessagesController@edit_post');
		Route::get('reply_message/{id}', 'MessagesController@reply_message');
		Route::post('postReply_message', 'MessagesController@postReply_message');
		
        Route::get('message-coach/{name}/{id}', 'MessagesController@message_coach');
        Route::get('show/{id}', 'MessagesController@show');
		Route::get('delete/{id}', 'MessagesController@delete');
        
      
		 
		Route::get('/contactus', 'ContactusController@index');
		Route::post('/contactus/store', 'ContactusController@store');
		
		
        Route::get('checkout/payment-response', 'CheckoutController@payment_response');
		Route::get('checkout/payment/{id}', 'CheckoutController@payment');
		Route::post('checkout/do-payment/{id}', 'CheckoutController@doPayment');
		
        Route::get('checkout/{id}', 'CheckoutController@index');
        Route::post('checkout/doDirectPayment', 'CheckoutController@doDirectPayment');
        
        Route::get('/faqs', 'PageController@faqs');
         Route::get('/book-appointment/{name}/{id}', 'PageController@bookappointment');
		
		
		
		Route::get('/how-it-work', 'PageController@howItWork');
		Route::get('/play-with-pro', 'PageController@playWithPro');
		Route::get('/tennis-lessons', 'PageController@tennislessons');
       
	});
    
 
    Route::get('/coach-thumb/{img}/{w?}/{h?}', function($n,$w=150,$h=150)
    {
        
        ob_end_clean();
        return Image::make('images/coaches/'.$n)->fit($w,$h)->response('jpg');
    });

    

     
    Route::group(['namespace' => 'admin', 'prefix' => 'admin','middleware' => 'App\Http\Middleware\AdminMiddleware'], function()
    {   
         
        Route::get('/', 'AuthController@getLogin');
        Route::post('auth/dologin', 'AuthController@dologin');
        Route::get('auth/logout', 'AuthController@Logout');
        Route::get('home', 'HomeController@index');
        Route::resource('users','UsersController');
        Route::controller('coaches','CoachController');
        Route::controller('customers','CustomerController');
        Route::get('pages/','PagesController@index');
        Route::get('pages/create','PagesController@create');
        Route::post('pages/store','PagesController@store');
        Route::get('pages/{id}/view','PagesController@viewPage');
        Route::get('pages/{id}/edit','PagesController@edit');
        Route::put('pages/{id}/update','PagesController@update');
        Route::delete('pages/{id}','PagesController@destroy');
        Route::controller('bookings','BookingController');
        Route::resource('play-with-pro','PlaywithproController');
         
        
                //.........messages..................
        Route::get('messages/{role}', 'MessagesController@index');
        Route::get('outbox/{role}', 'MessagesController@outbox');
        Route::get('add_message/{role}', 'MessagesController@add');
        Route::post('send_message/', 'MessagesController@send_message');
        Route::get('edit_message/{id}', 'MessagesController@edit');
        Route::post('edit_post/', 'MessagesController@edit_post');
        Route::get('reply_message/{id}/{role}', 'MessagesController@reply_message');
        Route::post('postReply_message/{role}', 'MessagesController@postReply_message');
    //.........messages..................       
    });

     
    
    
    //...........clients........................
    Route::get('clients/','CoachController@show_clients');
        
    //...........test........................
    //Route::get('test/','TestController@index');
    
    //...........static page ........................
    
    
    Route::get('/{slug}', 'PageController@index');
    
