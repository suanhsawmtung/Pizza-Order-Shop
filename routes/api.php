<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RouteController;

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

Route::get('releaseApi',[RouteController::class,'releaseApi']);

// read //
Route::post('categoryList',[RouteController::class,'categoryList']);
Route::get('contactList/{id}',[RouteController::class,'contactList']);

// create //
Route::post('createCategory',[RouteController::class,'createCategory']);

// update //
Route::post('updateCategory',[RouteController::class,'updateCategory']);

// delete //
Route::get('deleteCategory/{id}',[RouteController::class,'deleteCategory']);
Route::post('deleteUser',[RouteController::class,'deleteUser']);



// 'get all data  with post method' => http://127.0.0.1:8000/api/releaseApi //
// 'get category list  with post method' => http://127.0.0.1:8000/api/categoryList //
// 'get contact list  with post method' => http://127.0.0.1:8000/api/contactList/{id} //
// 'create category  with post method' => http://127.0.0.1:8000/api/createCategory //
// 'update category  with post method' => http://127.0.0.1:8000/api/updateCategory //
// 'delete category  with post method' => http://127.0.0.1:8000/api/deleteCategory/{id} //
// 'delete user account  with post method' => http://127.0.0.1:8000/api/deleteUser //

// {id} => id number //
// Key = category_id , user_id are used to take unique data. //

