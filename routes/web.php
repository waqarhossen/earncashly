<?php

use Illuminate\Support\Facades\Route;

//-----------------------------Clear Cache--------------------
Route::get('/csm/cache/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    return redirect()->route('admin.dashboard')->with('status-success', 'The system cache has been successfully cleared.');
})->name('admin.cache.clear');
//-----------------------------Clear cache end----------------

//web data
Route::get('list', 'HomeController@csm_offers');
Route::get('show-offers/{id}', 'HomeController@csm_offers_show');

//apis
Route::get('/get-red-data', 'HomeController@csm_redeem_api');
Route::get('/get-api-data', 'HomeController@csm_offers_api');
Route::get('show-api-offers/{id}', 'HomeController@csm_api_offers_show');
////////////////////////////////////////////////////////////////////////////

Route::get('/', 'HomeController@index')->name('home')->middleware(['verification_check']);

Route::get('/dashboard', function () {return redirect()->to('/');})->middleware(['auth'])->name('dashboard');

Route::get('/offers/c/{cat}', 'HomeController@offer_csm_cat')->name('csm_of_cat');

Route::get('/cashout', 'AppController@rewards')->name('cashout')->middleware(['verification_check']);

Route::get('/profile', 'BasicController@profile')->middleware(['auth'])->name('profile')->middleware(['verification_check']);
Route::post('/profile', 'BasicController@up_profile')->middleware(['auth']);

Route::get('/cashout/{txn_id}', 'AppController@rewardrequests')->middleware(['auth'])->name('cashout_');
Route::post('/cashout/{txn_id}', 'AppController@send_rewardRequests')->middleware(['auth']);

Route::get('/missions', 'HomeController@mission')->name('missions')->middleware(['auth'])->middleware(['verification_check']);
Route::post('/missions', 'HomeController@missionup')->name('game_missons')->middleware(['auth']);

Route::get('/offers/{id_name}', 'BasicController@offers_tab')->name('tab_offer')->middleware(['auth']);

Route::get('/invite', 'HomeController@referinvite')->name('refer_missons')->middleware(['auth'])->middleware(['verification_check']);
Route::post('/invite', 'HomeController@refer_missionup')->middleware(['auth']);
Route::get('/r/{slug}', 'AppController@referjoin')->name('referjoinweb');

//pages routes
Route::get('/page/{slug}', 'HomeController@web_pages')->name('web_pages');

Route::get('/leaderboard', 'HomeController@leaderboard')->name('leaderboard');

Route::get('/faqs', 'HomeController@faqs')->name('faqs');

// Google login Routes
Route::get('/google/login', 'SocialController@redirectToGoogle')->name('google.login');
Route::get('/login/google/callback', 'SocialController@handleGoogleCallback');
// Facebook login Routes
Route::get('facebook/login', 'SocialController@fbprovider')->name('facebook.login');
Route::get('facebook/callback', 'SocialController@FbCallbackHandel')->name('facebook.login.callback');
//logout
Route::get('/logout', 'SocialController@web_logout')->name('web_logout');

Route::get('/transactions', 'HomeController@user_transaction')->name('transaction')->middleware(['auth'])->middleware(['verification_check']);

// login route
Route::get('admin/login', 'Admin\Auth\AuthenticatedSessionController@create')->name('admin.login');
Route::post('admin/login', 'Admin\Auth\AuthenticatedSessionController@store')->name('admin.adminlogin');

//----------------------------Admin routes-------------------------------------//
Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function () {

    Route::middleware('admin')->group(function () {
        Route::get('dashboard', 'HomeController@index')->name('dashboard');

        Route::get('postbacks', 'HomeController@postbacks')->name('postbacks');

        //user routes
        Route::get('/users', 'HomeController@users')->name('users');
        Route::get('/edit/user/{id}', 'HomeController@edit_user')->name('useredit');
        Route::put('/edit/user/{id}', 'HomeController@update_user');

        //Offerwalls routes
        Route::get('/offers', 'HomeController@offerwalls')->name('offerwalls');
        Route::get('/edit-offers/{id}', 'HomeController@edit_offerwalls')->name('edit_offerwalls');
        Route::put('/edit-offers/{id}', 'HomeController@update_offerwalls');
        Route::get('status-offers/{id}', 'HomeController@status_offers');

        //Missions routes
        Route::get('/missions', 'HomeController@missions')->name('missions');
        Route::get('/edit-missions/{id}', 'HomeController@edit_missions')->name('edit_missions');
        Route::put('/edit-missions/{id}', 'HomeController@update_missions');
        Route::get('/add-missions', 'HomeController@add_missions')->name('add_missions');
        Route::post('/add-missions', 'HomeController@create_missions');
        Route::get('delete-missions/{id}', 'HomeController@delete_missions');

        //withdraw routes
        Route::get('/withdrawals', 'HomeController@withdrawals')->name('withdrawals');
        Route::get('/edit-withdrawals/{id}', 'HomeController@edit_withdrawals')->name('edit_withdrawals');
        Route::put('/edit-withdrawals/{id}', 'HomeController@update_withdrawals');
        Route::get('/add-withdrawals', 'HomeController@add_withdrawals')->name('add_withdrawals');
        Route::post('/add-withdrawals', 'HomeController@create_withdrawals');
        Route::get('delete-withdrawals/{id}', 'HomeController@delete_withdrawals');

        //withdraw requests routes
        Route::get('/withdrawal-requests', 'HomeController@withdrawal_requests')->name('with_reqs');
        Route::get('/withdrawal/request-view/{id}', 'HomeController@request_view')->name('with_reqs_up');
        Route::put('/withdrawal/request-view/{id}', 'HomeController@update_request_view');

        //pages routes
        Route::get('/pages', 'HomeController@pages')->name('pages');
        Route::get('/edit/page/{id}', 'HomeController@edit_page')->name('pageedit');
        Route::put('/edit/page/{id}', 'HomeController@update_page');
        Route::get('/add-page', 'HomeController@add_page')->name('addpage');
        Route::post('/add-page', 'HomeController@create_page');
        Route::get('delete-page/{id}', 'HomeController@delete_page');

        //settings routes
        Route::get('/options', 'HomeController@settings')->name('settings');
        Route::post('/update-settings', 'HomeController@update_settings')->name('update_settings');
        Route::post('/update-admin-settings', 'HomeController@ad_update_settings')->name('ad_update_settings');
        Route::post('/update-social', 'HomeController@social_up')->name('social_up');
        Route::post('/smtp/settings/update', 'HomeController@smtp_settings_update')->name('smtp_settings_update');
        Route::post('/config/settings/update', 'HomeController@config_settings_update')->name('config_settings_update');
        Route::post('/financial/settings/update', 'HomeController@financial_settings_update')->name('financial_settings_update');

        //tracker routes
        Route::get('/tracker/{id}', 'HomeController@tracker')->name('tracker');

        Route::get('/tracker', 'HomeController@tracker_glob')->name('tracker_glob');

        //referrals routes
        Route::get('/referrals/{id}', 'HomeController@referral')->name('referrals');

        Route::get('license', 'HomeController@license')->name('license');
        Route::post('license', 'HomeController@activate')->name('license_post');

        Route::prefix('offers')->name('csm.')->group(function () {

            Route::get('all', 'Addons\ReportController@all_offers')->name('all_offers');
            Route::get('completed', 'Addons\ReportController@completed_offers')->name('completed_offers');

        });

        Route::name('addons.')->prefix('addons')->group(function () {
            Route::get('/', 'AddonController@index')->name('index');
            Route::post('/', 'AddonController@upload')->name('upload');
            Route::post('{addon}/update', 'AddonController@update')->name('update');
            Route::post('/addon/status-update', 'AddonController@updateStatus')->name('status.update');
        });

    });

    Route::post('logout', 'Auth\AuthenticatedSessionController@destroy')->name('logout');

});

require __DIR__ . '/auth.php';