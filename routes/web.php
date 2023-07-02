<?php

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



Route::get('/', 'OutletMapController@index')->name('maps');

Auth::routes();
Route::group(['middleware' => 'auth'], function () {
    Route::resource('dpts', 'DptsController');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/buatuser', 'HomeController@buatuser')->name('buatuser');
    Route::get('/download', 'HomeController@export')->name('download');
    Route::get('/update', 'HomeController@update')->name('update');
});
/*
 * Outlets Routes
 */
Route::get('/dpt/{kecamatan?}/{kelurana?}', 'OutletMapController@index')->name('outlet_map.index');
Route::resource('outlets', 'OutletController');


