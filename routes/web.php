<?php

use Illuminate\Support\Facades\Auth;
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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    // return view('dashboard');
    if (Auth::check()) {
        if (Auth::user()->role == 'admin') {
            return redirect()->route('admin#profile');
        } elseif (Auth::user()->role == 'user') {
            return redirect()->route('user#index');
        }
    }
})->name('dashboard');

// admin
Route::group(['prefix' => 'admin'], function () {
    // Route::get('/', 'AdminController@index')->name('admin#index');

    Route::get('profile', 'AdminController@profile')->name('admin#profile');

    Route::get('category', 'AdminController@category')->name('admin#category'); // list
    Route::get('addCategory', 'AdminController@addCategory')->name('admin#addCategory');
    Route::post('addCategory', 'AdminController@createCategory')->name('admin#addCategory');
    Route::get('deleteCategory{id}', 'AdminController@deleteCategory')->name('admin#deleteCategory');

    Route::get('pizza', 'AdminController@pizza')->name('admin#pizza');
});

// user
Route::group(['prefix' => 'user'], function () {
    Route::get('', 'UserController@index')->name('user#index');
});