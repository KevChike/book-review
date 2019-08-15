<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => '/v1', 'namespace' => 'Auth'], function () {
	Route::group(['prefix' => '/auth'], function () {
		Route::post('/register', 'RegisterController@apiRegister')->name('api.register');
		Route::post('/login', 'LoginController@apiLogin')->name('api.login');
		Route::get('/logout', 'LoginController@apiLogout')->name('api.logout')->middleware('auth:api');
		Route::get('/user', 'LoginController@loggedInUser')->name('api.loggedin.user')->middleware('auth:api');
	});
});

Route::group(['prefix' => '/v1', 'namespace' => 'Api'], function () {
	Route::group(['prefix' => '/books'], function () {
		Route::get('/', 'BookController@index')->name('api.books.index');
		Route::post('/', 'BookController@store')->name('api.books.store');
		Route::put('/{id}', 'BookController@update')->name('api.books.update');
		Route::delete('/{id}', 'BookController@destroy')->name('api.books.destroy');
	});

	Route::group(['prefix' => '/reviews'], function () {
		Route::post('/', 'ReviewController@store')->name('api.reviews.store');
	});
});
