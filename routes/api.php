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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

#debuger("llego_api");
Route::get('empleados','api\EmpleadoApiController@index')->name('listar');
Route::get('empleados/{?}','api\EmpleadoApiController@index')->name('listar_empleado');
Route::post('empleados','api\EmpleadoApiController@index')->name('guardar');
Route::put('empleados','api\EmpleadoApiController@index')->name('actualizar');
Route::delete('empleados','api\EmpleadoApiController@index')->name('borrar');




