<?php

use Illuminate\Http\Request;
use App\Http\Middleware\JwtMiddelware;
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

Route::group(['prefix' => '/', 'as' => 'api.', 'middleware' => 'TokenMiddleware'], function(){
	Route::get('/', function(){
		return response()->json(['status' => 'sukses', 'msg' => 'Root Api']);
	});

	Route::get('/siswas', 'Api\SiswaController@index');
});