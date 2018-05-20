<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([ 'prefix' => 'investment'], function () {
    Route::get('signin', 'InvestmentController@getSignin')->name('investment-signin');
    Route::get('login', 'InvestmentController@getSignin')->name('investment-login');
    Route::post('investment-signup', 'InvestmentController@postSignup')->name('investment-signup');

        # Dashboard / Index
        Route::get('/', 'InvestmentController@showHome')->name('investor-dashboard');
});
