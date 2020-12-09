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
});


Auth::routes();
Auth::routes(['verify'=>true]);

Route::get('/login', 'BasicAuthController@login')->name('login');
// Route::get('/verify', 'BasicAuthController@verify')->name('verify');
// Route::post('/verify', 'BasicAuthController@verifyPost')->name('verify');
// Route::post('/register', 'BasicAuthController@registerpost')->name('register');   
Route::post('/login', 'BasicAuthController@loginpost')->name('login');

Route::group(['middleware' => ['admin','verified']], function () {
	// Admin Routes
	Route::get('/home', 'HomeController@index')->name('home');
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
	Route::get('/deletelicense/{id}', 'LicenseController@DeleteLicense')->name('deletelicense');
	Route::get('/license/activated', 'LicenseController@ActivatedLicense')->name('license.activated');

});

Route::group(['middleware' => 'user'], function () {
	// Other Users Routes
	Route::get('/user/home', 'ClientController@userHome')->name('user.home');
	Route::get('/user/profile', 'ClientController@manageprofile')->name('user.profile');
	Route::post('/user/profile', 'ClientController@updateprofile')->name('user.updateprofile');
});
//License Activation Routes

Route::get('activate/license/{user_id}/{sales_person_id}/{license_key}/{license_id}','LicenseController@licenseActivation');


Route::get('mail', function () {
    $user = App\User::find(1);
    $token = '321456987';
    return (new App\Notifications\VerifyAccount($user,$token))
                ->toMail($user);
});