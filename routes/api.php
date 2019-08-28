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

Route::prefix('v1')->group(function () {

	Route::prefix('auth')->group(function () {

		// Below mention routes are public, user can access those without any restriction.
		// Create New User
		Route::post('register', 'AuthController@register');

		// Login User
		Route::post('login', 'AuthController@login');

		// Refresh the JWT Token
		Route::get('refresh', 'AuthController@refresh');

		// Send reset password mail
		Route::post('reset-password', 'AuthController@sendPasswordResetLink');

		// handle reset password form process
		Route::post('reset/password', 'AuthController@callResetPassword');

		// Below mention routes are available only for the authenticated users.
		Route::resource('users', 'UserController');
		Route::resource('banks', 'BankController');
		Route::resource('packages', 'PackageController');
		Route::resource('bankdetails', 'BankDetailController');
		Route::resource('packageusers', 'PackageUserController');
		Route::resource('portfolios', 'PortfolioController');
		Route::resource('transactions', 'TransactionController');
		Route::resource('withdrawals', 'WithdrawalController');
		Route::get('subscribe/{transaction}', 'PackageUserController@confirmSubscription');
		Route::get('confirm-withdrawal/{withdrawal}', 'WithdrawalController@confirmWithdrawal');
		Route::middleware('auth:api')->group(function () {
			// Get user info
			Route::get('user', 'AuthController@user');

			// Logout user from application
			Route::post('logout', 'AuthController@logout');

			//Route::resource('users', 'UserController');

		});
	});
});
