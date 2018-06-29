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

Route::pattern('slug', '[a-z0-9- _]+');

//Route::group([ 'namespace'=>'Admin'], function () {

    # Lock screen
    Route::get('{id}/lockscreen', 'UsersController@lockscreen')->name('lockscreen');
    Route::post('{id}/lockscreen', 'UsersController@postLockscreen')->name('lockscreen');
    # All basic routes defined here
    Route::get('chose-status', 'AuthController@choseStatus')->name('chose-status');
    Route::get('login', 'AuthController@getSignin')->name('login');
    Route::get('signin', 'AuthController@getSignin')->name('signin');
    Route::post('signin', 'AuthController@postSignin')->name('postSignin');
    Route::post('signup', 'AuthController@postSignup')->name('signup');
    Route::post('forgot-password', 'AuthController@postForgotPassword')->name('signup');




    //  INVESTMENTS-ADMIN
    Route::group([ 'prefix' => 'investments-admin'], function () {
        // MIDDLEWARE
        Route::group(['middleware' => ['admin-investments']], function () {
            Route::get('/', 'InvestmentsAdminController@showHome')
                ->name('investments-admin-dashboard');
            Route::get('/all-investments', 'InvestmentsAdminController@getAllInvestments')
                ->name('investments-admin-all-investments');
            Route::get('/create-investments', 'InvestmentsAdminController@create')
                ->name('investments-admin-create-investments');
            Route::post('/store-investments', 'InvestmentsAdminController@store')
                ->name('investments-admin-store-investments');
            Route::get('/before-confirm-investment/{id}', 'InvestmentsAdminController@beforeConfirm')
                ->name('before-confirm');
            Route::post('/confirm-investment/{id}', 'InvestmentsAdminController@confirm')
                ->name('confirm');
            Route::get('/all-and-selected-investments/{id}', 'InvestmentsAdminController@getAllInvestmentsAndSelected');
            Route::get('/approve-or-un-approve-investment/{id}', 'InvestmentsAdminController@approveOrUnApproveInvestment');
            Route::get('/rejected-or-delete-investment/{id}', 'InvestmentsAdminController@rejectOrDelete');
            Route::get('/edit-investments/{id}', 'InvestmentsAdminController@edit');
            Route::post('/update-investments/{id}', 'InvestmentsAdminController@update');
        });

        // WITHOUT MIDDLEWARE
        Route::get('login', 'InvestmentsAdminController@getSignIn')
            ->name('investments-admin-login');
        Route::get('logout', 'InvestmentsAdminController@getLogout')
            ->name('investments-admin-logout');
        Route::post('signin', 'InvestmentsAdminController@postSignIn')
            ->name('investments-admin-sign-in');
        Route::post('investment-signup', 'InvestmentsAdminController@postSignup')
            ->name('investments-admin-sign-up');
    });



    //  INVESTMENT
    Route::group([ 'prefix' => 'investment'], function () {

        // MIDDLEWARE
        Route::group(['middleware' => ['check-investitor']], function () {
            Route::get('/', 'InvestmentController@showHome')->name('investor-dashboard');
            Route::get('/get-all-serbia', 'InvestmentController@indexSerbia')->name('investor-index-serbia');
            Route::get('/get-all-and-selected/{id}', 'InvestmentController@show')->name('investor-index-selected');
            Route::post('/invest/{id}', 'InvestmentController@invest')->name('invest-in-investion');

            Route::get('/get-user-investments', 'InvestmentController@getUserInvestments')->name('user-all-investments');
            Route::get('/selected-investments/{id}', 'InvestmentController@getAllAndSelected')->name('selected-investments');
        });

        // WITHOUT MIDDLEWARE
        Route::get('login', 'InvestmentController@getSignIn')->name('investment-login');
        Route::post('signin', 'InvestmentController@postSignIn')->name('investment-signin');
        Route::post('investment-signup', 'InvestmentController@postSignup')->name('investment-signup');
    });





    # Forgot Password Confirmation
    Route::get('forgot-password/{userId}/{passwordResetCode}', 'AuthController@getForgotPasswordConfirm')->name('forgot-password-confirm');
    Route::post('forgot-password/{userId}/{passwordResetCode}', 'AuthController@getForgotPasswordConfirm');

    # Logout
    Route::get('logout', 'AuthController@getLogout')->name('logout');

    # Account Activation
    Route::get('activate/{userId}/{activationCode}', 'AuthController@getActivate')->name('activate');
//});


Route::group([ 'middleware' => 'admin'], function () {
    # GUI Crud Generator
    Route::get('generator_builder', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@builder');
    Route::get('field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@fieldTemplate');
    Route::post('generator_builder/generate', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generate')->name('generate');
    Route::post('modelCheck', 'ModelcheckController@modelCheck');
    # Dashboard / Index
    Route::get('/', 'JoshController@showHome')->name('dashboard');
    # crop demo
    Route::post('crop_demo', 'JoshController@crop_demo')->name('crop_demo');
    # Activity log
    Route::get('activity_log', 'JoshController@ActivityLog')->name('activity_log');

    # User Management
    Route::group([ 'prefix' => 'users'], function () {
        Route::get('data', 'UsersController@data')->name('users.data');
        Route::get('{user}/delete', 'UsersController@destroy')->name('users.delete');
        Route::get('{user}/confirm-delete', 'UsersController@getModalDelete')->name('users.confirm-delete');
        Route::get('{user}/restore', 'UsersController@getRestore')->name('restore.user');
        Route::post('{user}/passwordreset', 'UsersController@passwordreset')->name('passwordreset');
    });
    Route::resource('users', 'UsersController');

    Route::get('deleted_users',['before' => 'Sentinel', 'uses' => 'UsersController@getDeletedUsers'])->name('deleted_users');

    # Group Management
    Route::group(['prefix' => 'groups'], function () {
        Route::get('{group}/delete', 'GroupsController@destroy')->name('groups.delete');
        Route::get('{group}/confirm-delete', 'GroupsController@getModalDelete')->name('groups.confirm-delete');
        Route::get('{group}/restore', 'GroupsController@getRestore')->name('groups.restore');
    });
    Route::resource('groups', 'GroupsController');

    Route::get('{name?}', 'JoshController@showView');
});

# Remaining pages will be called from below controller method
# in real world scenario, you may be required to define all routes manually

Route::get('activate/{userId}/{activationCode}','FrontEndController@getActivate')->name('activate');
Route::get('forgot-password','FrontEndController@getForgotPassword')->name('forgot-password');
Route::post('forgot-password', 'FrontEndController@postForgotPassword');

# Forgot Password Confirmation
Route::post('forgot-password/{userId}/{passwordResetCode}', 'FrontEndController@postForgotPasswordConfirm');
Route::get('forgot-password/{userId}/{passwordResetCode}', 'FrontEndController@getForgotPasswordConfirm')->name('forgot-password-confirm');



