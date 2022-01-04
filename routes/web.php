<?php

use App\Http\Controllers\Admin\PizzaController;
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
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    // Route::get('/', 'CategoryController@index')->name('admin#index');

    Route::get('profile', 'CategoryController@profile')->name('admin#profile');

    Route::get('category', 'CategoryController@category')->name('admin#category'); // list
    Route::get('addCategory', 'CategoryController@addCategory')->name('admin#addCategory');
    Route::post('addCategory', 'CategoryController@createCategory')->name('admin#createCategory');
    Route::get('deleteCategory{id}', 'CategoryController@deleteCategory')->name('admin#deleteCategory');
    Route::get('editCategory/{id}', 'CategoryController@editCategory')->name('admin#editCategory');
    Route::post('editCategory', 'CategoryController@updateCategory')->name('admin#updateCategory');
    Route::post('category', 'CategoryController@searchCategory')->name('admin#searchCategory');

    Route::get('pizza', 'PizzaController@pizza')->name('admin#pizza');
    Route::get('createPizza', 'PizzaController@addPizza')->name('admin#addPizza');
    Route::post('createPizza', 'PizzaController@createPizza')->name('admin#createPizza');
    Route::get('deletePizza/{id}', 'PizzaController@deletePizza')->name('admin#deletePizza');
    Route::get('pizzaInfo/{id}', 'PizzaController@pizzaInfo')->name('admin#pizzaInfo');
    Route::get('edit/{id}', 'PizzaController@editPizza')->name('admin#editPizza');
});

// user
Route::group(['prefix' => 'user'], function () {
    Route::get('', 'UserController@index')->name('user#index');
});