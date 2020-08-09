<?php


Route::group(['prefix' => 'auth'], function () {
  Route::post('login', 'Auth\LoginController@login');
  Route::post('logout', 'Auth\LoginController@logout');
});

Route::post('users', 'UserController@store');
Route::get('/travels/published', 'TravelController@published');

Route::group(['middleware' => 'auth:users'], function () {
  Route::get('me', 'UserController@me');
  Route::apiResource('users', 'UserController')->except('store');

  //agencies
  Route::apiResource('agencies', 'AgencyController');

  //agency networks
  Route::apiResource('networks', 'NetworkController');

  //agency comments
  Route::group(['prefix' => 'comments'], function () {
    Route::get('agencies/{agency}', 'CommentController@index');
    Route::post('agencies/{agency}', 'CommentController@store');
    Route::get('/{comment}', 'CommentController@show');
    Route::put('/{comment}', 'CommentController@update');
    Route::delete('/{comment}', 'CommentController@destroy');
  });

  //agency ratings
  Route::group(['prefix' => 'ratings'], function () {
    Route::get('agencies/{agency}', 'RatingController@index');
    Route::post('agencies/{agency}', 'RatingController@store');
    Route::get('/{rating}', 'RatingController@show');
    Route::put('/{rating}', 'RatingController@update');
    Route::delete('/{rating}', 'RatingController@destroy');
  });

  //agency ratings
  Route::group(['prefix' => 'favorites'], function () {
    Route::get('travels/{travel}', 'UserController@storeFavoriteAgency');
    Route::get('travels', 'UserController@indexFavoriteAgency');
  });

  //agency travels
  Route::apiResource('travels', 'TravelController');
  Route::get('/travels/{travel}/reservations', 'TravelController@reservations');


  //travel dates
  Route::group(['prefix' => 'dates'], function () {
    Route::get('travels/{travel}', 'TravelDateController@index');
    Route::post('travels/{travel}', 'TravelDateController@store');
    Route::get('/{travelDate}', 'TravelDateController@show');
    Route::put('/{travelDate}', 'TravelDateController@update');
    Route::delete('/{travelDate}', 'TravelDateController@destroy');
  });

  //reservations
  Route::group(['prefix' => 'reservations'], function () {
    Route::get('/', 'ReservationController@index');
    Route::post('/dates/{travelDate}', 'ReservationController@store');
    Route::get('/{reservation}', 'ReservationController@show');
    Route::put('/{reservation}', 'ReservationController@update');
    Route::delete('/{reservation}', 'ReservationController@destroy');
  });

});

