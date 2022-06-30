<?php

use Illuminate\Support\Facades\Route;

// Route::metodo('uri', acción )
Route::get('/', function () {
    return view('welcome');
});

Route::get('/saludo', function ()
{
    return view('hola');
});

Route::get('/form', function ()
{
    return view('form');
});
Route::post('/procesa', function()
{
    //capturamos dato enviado por el form
    //$nombre = $_POST['nombre'];
    //$nombre = request()->input('nombre');
    $nombre = request('nombre');

    /* array para el forElse */
    $users = ['Admin', 'Supervisor', 'Operador', 'Invitado' ];
    //$users = [];

    return view('procesa',
                            [
                                'nombre' => $nombre,
                                'users' => $users
                            ]);
});
// pasar parámetro por URL
Route::get('/param/{nombre}/{numero}', function ( $nombre, $numero )
{
    return 'Nombre:'.$nombre.' n:'.$numero;
});

## desde la plantilla
Route::get('/inicio', function ()
{
    return view('inicio');
});

###### CRUD de regiones ########
Route::get('/regiones', function ()
{
    //obtenemos listado de regiones
    $regiones = DB::select('SELECT idRegion, regNombre
                                FROM regiones');

    //pasamos listado a la vista
    return view('regiones', [ 'regiones'=>$regiones ]);
});