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


Route::get('/login', 'BasicAuthController@login')->middleware('guest')->name('login');
Route::post('/login', 'BasicAuthController@loginpost')->name('login');
										// Admin Routes
Route::group(['middleware' => ['admin','verified']], function () {
	Route::get('/home', 'HomeController@index')->name('admin.home');
	Route::get('/profile', 'AdminController@manageprofile')->name('profile');
	Route::post('/profile', 'AdminController@updateprofile')->name('updateprofile');
	// users
	Route::get('/users', 'AdminController@Users')->name('userslist');
	Route::get('/users-search-results', 'AdminController@searchUsers')->name('usersSearchedlist');
	Route::get('/addUser', 'AdminController@AddUser')->name('AddUser');
	Route::get('/addSalesPerson', 'AdminController@addSalesPerson')->name('AddSalesPerson');
	Route::post('/addUser', 'AdminController@AddUserPost')->name('AddUser');
	Route::get('/edituser/{id}', 'AdminController@EditUser')->name('edituser');
	Route::post('/edituser/{id}', 'AdminController@EditUserPost')->name('edituser');
	Route::get('/deleteuser/{id}', 'AdminController@DeleteUser')->name('deleteuser');
	// sales persons
	Route::get('/sales-persons', 'AdminController@SalesPersons')->name('SalesPersons');
	Route::get('/sales-persons-search', 'AdminController@salesPersonsSearch')->name('SalesPersonsSearch');
	Route::get('/edit-sales-person/{id}', 'AdminController@EditSalesPerson')->name('editsalesperson');
	// License Routes
	Route::get('/licensetypes', 'LicenseTypeController@index')->name('licensetypes');
	Route::get('/license-types-search', 'LicenseTypeController@searchLicenseType')->name('licensetypessearch');
	Route::get('/licensetypes/add', 'LicenseTypeController@AddLicenseType')->name('addLicenseType');
	Route::post('/licensetypes/add', 'LicenseTypeController@AddLicenseTypePost')->name('addLicenseType');
	Route::get('/editlicensetypes/{id}', 'LicenseTypeController@EditLicenseType')->name('editlicensetype');
	Route::post('/editlicensetypes', 'LicenseTypeController@EditLicenseTypePost')->name('updateLicenseTypePost');
	Route::get('/deletelicensetype/{id}', 'LicenseTypeController@deleteLicenseType')->name('deletelicensetype');
 	Route::get('/license', 'LicenseController@index')->name('licenselist');
 	Route::get('/license-search-results', 'LicenseController@licenseSearchResults')->name('searchedlicenselist');
	Route::get('/license/create', 'LicenseController@create')->name('createlicense');
	Route::post('/license/create', 'LicenseController@store')->name('createlicensePost');
	Route::get('/editlicense/{license}', 'LicenseController@EditLicense')->name('editlicense');
	Route::post('/editlicensetypesLicense', 'LicenseController@EditLicensePost')->name('editlicensepost');
 	Route::get('/deletelicense/{id}', 'LicenseController@DeleteLicense')->name('deletelicense');
	Route::get('/license/activated', 'LicenseController@ActivatedLicense')->name('license.activated');
	//payments routes
	Route::get('/payment/list', 'PaymentController@index')->name('paymentlist');
	Route::get('/payment-search', 'PaymentController@paymentSearch')->name('paymentlistsearch');
	Route::get('/payment/pendinglist', 'PaymentController@pendingCommision')->name('paymentlistpending');
	Route::get('/commission-pending-search', 'PaymentController@pendingCommisionSearchResults')->name('paymentlistpendingsearchresults');
	Route::get('/paymentstatus/{id}/{status}', 'PaymentController@edit')->name('paymentstatus');
	Route::get('/paymentstatus', 'PaymentController@editSearched')->name('paymentstatussearched');
	Route::get('/licenseactivation','LicenseController@licenseActivation')->name('licenseactivation');
	Route::get('/license/multiple','LicenseController@multipleLicenses')->name('license.multiple');
	Route::post('/license/multiple/create','LicenseController@store')->name('license.multiple.add');
	Route::get('/user/getuseranddevices', 'ClientController@alluseranddevs')->name('a');
	Route::get('/getuseranddevices-search-results', 'ClientController@alluseranddevssearch')->name('getusersearchedresults');
		/*Settings Routes*/
	Route::get('setting','SettingController@index')->name('settings');
	Route::get('edit/setting/{id}','SettingController@edit')->name('editsettings');
	Route::post('editappsettings','SettingController@update')->name('editappsettings');

});
											// Users Routes
Route::group(['middleware' => ['user','auth'], 'prefix'=>'user'], function () {
	Route::get('/home', 'ClientController@userHome')->name('user.home');
	Route::get('/profile', 'ClientController@manageprofile')->name('user.profile');
	Route::post('/profile', 'ClientController@updateprofile')->name('user.updateprofile');
 	Route::get('/license', 'ClientController@LicenseListLessDetails')->name('user.activelicense');
 	Route::get('', 'ClientController@searchResults')->name('user.searchresults');
 	Route::get('/deletelicense/{id}', 'ClientController@deleteLicense')->name('user.deleteuserlicense');
 	Route::get('/deactivatedevice/{id}', 'ClientController@deactivateDevice')->name('user.deactivateuserdevice');
 	Route::get('/activatedevice/{id}', 'ClientController@activateDevice')->name('user.activateuserdevice');
 	Route::get('/getuserdetails/{id}', 'ClientController@LicensesActivated')->name('user.licenselistcomplete');
 	Route::post('/purchase/license', 'ClientController@purchaseLicense')->name('user.purchase'); 
	
});

											// Sales Person Routes
Route::group(['middleware' => ['salesperson', 'auth']], function () {
	Route::get('/salesperson/home', 'SalesPersonController@userHome')->name('salesperson.home');
	Route::get('/salesperson/profile', 'SalesPersonController@manageprofile')->name('salesperson.profile');
	Route::post('/salesperson/profile', 'SalesPersonController@updateprofile')->name('salesperson.updateprofile');
	Route::get('/salesperson/license', 'SalesPersonController@LicensesAll')->name('salesperson.license');
	Route::get('/salesperson', 'SalesPersonController@searchResultsLicensesAll')->name('salesperson.searchresultslicensesall');
	Route::get('/salesPersons/license/activated', 'SalesPersonController@LicensesActivated')->name('salesperson.activelicense');
	Route::get('/salesperson-active-license-search-result', 'SalesPersonController@searchResultsLicensesActivated')->name('salesperson.searchresultsactivelicense');
	Route::get('/salesperson/pending_commision','SalesPersonController@commision_pending')->name('salesperson.pendingcommission');
	Route::get('/salesperson/total_commision','SalesPersonController@total_commision')->name('salesperson.totalcommision');


});
//License and trial Activation Routes

Route::post('api/license/activate','API\LicenseController@licenseActivation');
Route::post('api/license/trial','API\LicenseController@trialActivation')->name('trialactivated');
Route::get('api/license/check/{code}','API\LicenseController@checkLicenseExists')->name('is_LicenseExists');
/*License Activation Routes End*/
Route::get('mail', function () {
    $user = App\User::find(1);
    $token = '321456987';
    return (new App\Notifications\VerifyAccount($user,$token))
                ->toMail($user);
});


