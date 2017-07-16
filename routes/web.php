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

Route::get('/', 'MainController@clientsPage');

Route::get('/clients', 'MainController@listClients');
Route::post('/clients', 'MainController@addClient');
Route::post('/clients/{id}', 'MainController@updateClient');
Route::delete('/clients/{id}', 'MainController@deleteClient');
