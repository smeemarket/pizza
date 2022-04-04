<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::group(['middleware' => 'auth:sanctum'], function () {
//     Route::get('user', function (Request $request) {
//         return User::all();
//     });
// });


//Route::get('latest', function () {
//    dd('hello this is testing');
//});

//Route::get('category/list',function(){
//    $category = Category::get();
//
//    $response = [
//        'status'=>'success',
//        'data'=>$category
//    ];
//    return Response::json($response);
//});

Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');

Route::group(['prefix' => 'category', 'namespace' => 'API', 'middleware' => 'auth:sanctum'], function () {
    Route::get('list', 'ApiController@categoryList'); // list
    Route::post('create', 'ApiController@createCategory'); // create
    Route::get('details/{id}', 'ApiController@categoryDetails'); // details
    Route::get('delete/{id}', 'ApiController@categoryDelete'); // delete
    Route::post('update', 'ApiController@categoryUpdate'); // update
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('logout', 'AuthController@logout');
});

