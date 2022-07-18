<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::view('/inicio', 'inicio');
#Route::metodo('peticion', 'accion');

#Route::metodo('petcion', [ Controller,'método' ]);

use App\Http\Controllers\MarcaController;
Route::get('/marcas', [ MarcaController::class, 'index' ]);

