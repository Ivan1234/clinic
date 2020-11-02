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

Route::get('/test', function(){
	return 'Permiso concedido';
})->middleware('Role:administrador-paciente');

Route::get('/', function(){
	return view('welcome');
});

Route::get('/home', function(){
	return view('home');
})->middleware('auth');

Auth::routes(['verify' => true]);

//Backoffice
Route::group(['middleware' => ['auth'], 'as' => 'backoffice.'], function(){
	Route::get('/admin', 'AdminController@show')->name('admin.show');

	Route::resource('/user', 'UserController');	

	
	
	Route::get('user_import', 'UserController@import')->name('user.import');
	Route::post('user_make_import', 'UserController@make_import')->name('user.make_import');

	Route::get('patient/{user}/schedule', 'PatientController@back_schedule')->name('patient.schedule');	
	Route::get('patient/{user}/appointments', 'PatientController@back_appointments')->name('patient.appointments');
	Route::get('patient/{user}/invoices', 'PatientController@back_invoices')->name('patient.invoices');

	Route::resource('/role', 'RoleController');
	Route::get('user/{user}/assign_role', 'UserController@assign_role')->name('user.assign_role');
	Route::post('user/{user}/role_assignment', 'UserController@role_assignment')->name('user.role_assignment');

	Route::resource('/permission', 'PermissionController');
	Route::get('user/{user}/assign_permission', 'UserController@assign_permission')->name('user.assign_permission');
	Route::post('user/{user}/permission_assignment}', 'UserController@permission_assignment')->name('user.permission_assignment');

	Route::resource('speciality', 'SpecialityController');
});

Route::group(['as' => 'frontoffice.'], function(){
	Route::get('profile', 'UserController@profile')->name('user.profile');
	Route::get('profile/{user}/edit', 'UserController@edit')->name('user.edit');
	Route::put('profile/{user}/update', 'UserController@update')->name('user.update');
	Route::get('profile/edit_password', 'UserController@edit_password')->name('user.edit_password');
	Route::put('profile/change_password', 'UserController@change_password')->name('user.change_password');

	Route::get('patient/schedule', 'PatientController@schedule')->name('patient.schedule');
	Route::get('patient/appointments', 'PatientController@appointments')->name('patient.appointments');
	Route::get('patient/prescriptions', 'PatientController@prescriptions')->name('patient.prescriptions');
	Route::get('patient/invoices', 'PatientController@invoices')->name('patient.invoices');
});



