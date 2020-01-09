<?php

use Illuminate\Http\Request;

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

// attachCity
Route::put('city/{city_id}/{del_date_id}/exclude', 'DeliveryTimeController@excludeDeliveryDate');
Route::post('city/{city_id}/delivery-times', 'DeliveryTimeController@attachCity');
Route::put('city/{city_id}/exclude', 'DeliveryTimeController@excludeDeliveryTimes');
Route::get('city/{city_id}/{days_to_get}/list', 'DeliveryDateController@list');


Route::resource('city', 'CityController');
Route::resource('delivery-times', 'DeliveryTimeController');
Route::resource('delivery-dates', 'DeliveryDateController');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
