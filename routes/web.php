<?php
use App\Http\Controllers;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



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


Route::redirect('/home', '/peliculas');
Route::redirect('/', '/peliculas');

Route::view('/contact', 'contact')->name('contact');
Route::post('contact', MessageController::class);

//Desactivamos el registro de usuarios
Auth::routes(['register' => false]);

//Estas rutas toman como controlador MovieController y acceden a las rutas por defecto de un recurso.
Route::resource('peliculas', MovieController::class)
    ->parameters(['peliculas' => 'movie'])
    ->names('movies');


