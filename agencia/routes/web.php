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
Route::get('/region/create', function ()
{
    return view('regionCreate');
});
Route::post('/region/store', function ()
{
    //capturamos deto enviado por el form
    //$regNombre = request()->input('regNombre');
    //$regNombre = request('regNombre');
    $regNombre = request()->regNombre;
    //insertamos dato en tabla regiones
    DB::insert(
                "INSERT INTO regiones
                        ( regNombre )
                    VALUE
                        ( :regNombre )",
                    [ $regNombre ]
              );
    //reporte de alta ok
    return redirect('/regiones')
                    ->with(['mensaje'=>'Región: '.$regNombre.' agregada correctamente.']);
});

