<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');


Auth::routes();
Auth::routes(['verify'=>true]);

Route::get('/login', 'BasicAuthController@login')->name('login');
// Route::get('/verify', 'BasicAuthController@verify')->name('verify');
// Route::post('/verify', 'BasicAuthController@verifyPost')->name('verify');
// Route::post('/register', 'BasicAuthController@registerpost')->name('register');   
Route::post('/login', 'BasicAuthController@loginpost')->name('login');

// Admin Routes
Route::group(['middleware' => ['admin','verified']], function () {
	Route::get('/home', 'HomeController@index')->name('admin.home');
	Route::get('/profile', 'AdminController@manageprofile')->name('profile');
	Route::post('/profile', 'AdminController@updateprofile')->name('updateprofile');

	// users
	Route::get('/users', 'AdminController@Users')->name('userslist');
	Route::get('/addUser', 'AdminController@AddUser')->name('AddUser');
	Route::post('/addUser', 'AdminController@AddUserPost')->name('AddUser');
	Route::get('/edituser/{id}', 'AdminController@EditUser')->name('edituser');
	Route::post('/edituser/{id}', 'AdminController@EditUserPost')->name('edituser');
	Route::get('/deleteuser/{id}', 'AdminController@DeleteUser')->name('deleteuser');
	// sales persons
	Route::get('/sales-persons', 'AdminController@SalesPersons')->name('SalesPersons');
	Route::get('/edit-sales-person/{id}', 'AdminController@EditSalesPerson')->name('editsalesperson');
	// License Routes
	Route::get('/licensetypes', 'LicenseTypeController@index')->name('licensetypes');
	Route::get('/licensetypes/add', 'LicenseTypeController@AddLicenseType')->name('addLicenseType');
	Route::post('/licensetypes/add', 'LicenseTypeController@AddLicenseTypePost')->name('addLicenseType');
	Route::get('/editlicensetypes/{id}', 'LicenseTypeController@EditLicenseType')->name('editlicensetype');
	Route::post('/editlicensetypes', 'LicenseTypeController@EditLicenseTypePost')->name('editlicensetypepost');
	Route::get('/deletelicensetype/{id}', 'LicenseTypeController@deleteLicenseType')->name('deletelicensetype');

	Route::get('/license', 'LicenseController@index')->name('licenselist');
	Route::get('/license/create', 'LicenseController@create')->name('createlicense');
	Route::post('/license/create', 'LicenseController@store')->name('createlicensePost');
	Route::get('/editlicense/{license}', 'LicenseController@EditLicense')->name('editlicense');
	Route::post('/editlicensetypes', 'LicenseController@EditLicensePost')->name('editlicensepost');

	Route::get('/deletelicense/{id}', 'LicenseController@DeleteLicense')->name('deletelicense');
	Route::get('/license/activated', 'LicenseController@ActivatedLicense')->name('license.activated');
	//payments routes
	Route::get('/payment/list', 'PaymentController@index')->name('paymentlist');
	Route::get('/paymentstatus/{id}', 'PaymentController@edit')->name('paymentstatus');

});
// Users Routes
Route::group(['middleware' => 'user'], function () {
	Route::get('/user/home', 'ClientController@userHome')->name('user.home');
	Route::get('/user/profile', 'ClientController@manageprofile')->name('user.profile');
	Route::post('/user/profile', 'ClientController@updateprofile')->name('user.updateprofile');

	Route::get('/user/license', 'ClientController@LicensesActivated')->name('user.activelicense');
});
// Sales Person Routes
Route::group(['middleware' => 'salesperson'], function () {
	Route::get('/salesperson/home', 'SalesPersonController@userHome')->name('salesperson.home');
	Route::get('/salesperson/profile', 'SalesPersonController@manageprofile')->name('salesperson.profile');
	Route::post('/salesperson/profile', 'SalesPersonController@updateprofile')->name('salesperson.updateprofile');
	Route::get('/salesperson/license', 'SalesPersonController@LicensesAll')->name('salesperson.license');
	Route::get('/salesPersons/license/activated', 'SalesPersonController@LicensesActivated')->name('salesperson.activelicense');
	Route::get('/salesperson/pending_commision','SalesPersonController@commision_pending')->name('salesperson.pendingcommission');
	Route::get('/salesperson/total_commision','SalesPersonController@total_commision')->name('salesperson.totalcommision');


});
	
	

//License and trial Activation Routes

Route::get('activate/license/{user_id}/{license_key}/{dev_id}/{dev_model}/{dev_name}','LicenseController@licenseActivation');
Route::get('activate/trial/{user_id}/{license_key}','LicenseController@trialActivation');

/*License Activation Routes End*/

Route::get('mail', function () {
    $user = App\User::find(1);
    $token = '321456987';
    return (new App\Notifications\VerifyAccount($user,$token))
                ->toMail($user);
});