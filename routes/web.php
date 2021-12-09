<?php
use App\Http\Controllers;
use App\Http\Controllers\CatalogController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
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

Auth::routes();
Route::get('/', [HomeController::class, 'getHome'] );

Route::group(['middleware' => 'auth'], function() { 
    Route::get('/catalog', [CatalogController::class, 'getIndex'] );
    Route::get('/catalog/show/{id}', [CatalogController::class, 'getShow'] );
    Route::get('/catalog/create', [CatalogController::class, 'getCreate']);
    Route::post('/catalog/create', [CatalogController::class, 'store'])->name('crear');
    Route::get('/catalog/edit/{id}', [CatalogController::class, 'getEdit']);
    Route::put('/catalog/edit/{id}', [CatalogController::class, 'update'])->name('edit');
    Route::get('/catalog/rent/{id}', [CatalogController::class, 'rented'])->name('rent');
});