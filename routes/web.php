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

Auth::routes(['verify' => true]);

//Backoffice
Route::group(['middleware' => ['auth'], 'as' => 'backoffice.'], function(){
	// Route::get('/role', 'RoleController@index')->name('role.index');
	Route::resource('/role', 'RoleController');
	Route::resource('/permission', 'PermissionController');
});




