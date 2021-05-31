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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('colores/index', 'ColorController@index')->name('index');

Route::get('colores/show/{id}', 'ColorController@show')->name('show');

Route::put('colores/changes/{id}', 'ColorController@saveChanges')->name('changes');

Route::post('colores/save', 'ColorController@save')->name('store');

Route::delete('colores/delete/{id}', 'ColorController@delete')->name('delete');

Route::get('colores/externa', 'ColorController@listExterna')->name('externa');