<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


############################################
###### CRUD de marcas
use App\Http\Controllers\MarcaController;
Route::get('/marcas', [ MarcaController::class, 'index' ] )
            ->middleware(['auth'])->name('marcas');
Route::get('/marca/create', [ MarcaController::class, 'create' ])
            ->middleware(['auth']);


Route::get('/uri', [ controller::class, 'method' ])
    ->middleware(['auth'])
    ->name('nombre');


require __DIR__.'/auth.php';
