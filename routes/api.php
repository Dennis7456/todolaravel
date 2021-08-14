<?php

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

Route::group(['middleware' => ['cors', 'json.response']], function () {

    // ...

    // public routes
    Route::post('/login', 'Auth\ApiAuthController@login')->name('login.api');
    Route::post('/register','Auth\ApiAuthController@register')->name('register.api');

    //Todos
    

    //
    // Route::post('route','Controller@method')->middleware('api.admin');
    // Route::post('route','Controller@method')->middleware('api.superAdmin');
    // Route::get('/articles', 'ArticlesController@index')->middleware('api.admin')->name('articles');

    //Test
    // Route::get('/articles', 'ArticlesController@index')->middleware('api.admin');


    // ...

});

Route::middleware('auth:api')->group(function () {
    //private routes
    //Route::get('/articles', 'ArticlesController@index')->name('articles');
    Route::post('/logout', 'Auth\ApiAuthController@logout')->name('logout.api');
    Route::get('/user', function(Request $request){
        return $request->user();
    });

    Route::get('/articles', 'ArticlesController@index')->middleware('api.admin')->name('articles');

    Route::get('/todos','TodosController@index');
    Route::post('/todos','TodosController@store');
    Route::patch('/todos/{todo}','TodosController@update');
    Route::delete('/todos/{todo}','TodosController@destroy');
    Route::patch('/todoscheckAll','TodosController@updateAll');
    Route::delete('/todosDeleteCompleted','TodosController@destroyCompleted');
    
});