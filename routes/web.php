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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/about', function () {
  //     return view('pages.about');
  // });


Route::get('/', 'PagesController@index');
Route::get('/cards', 'PagesController@cards');
Route::post('/cards', 'PagesController@cards');
// Route::get('/TmpDecks', 'PagesController@TmpDecks');
Route::get('/about', 'PagesController@about');
Route::get('/about', 'PagesController@about');
Route::get('/deck/{deck}', 'PagesController@showDeck')->name('deck.show');


