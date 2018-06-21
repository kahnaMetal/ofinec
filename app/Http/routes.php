<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');
Route::get('/formulario-producto-prueba', 'ProductosPruebaController@getGuardarProducto');
Route::get('/formulario-producto', 'MisProductosController@getGuardarProducto');
Route::get('/img-producto/{archivo}', 'ProductosPruebaController@getImgage');

Route::controller('productos-prueba', 'ProductosPruebaController');
Route::controller('mis-productos', 'MisProductosController');
Route::controller('comprar-productos', 'ComprarProductosController');
