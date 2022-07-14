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
    /* Raw SQL
     * $regiones = DB::select('SELECT idRegion, regNombre
                                FROM regiones');*/
    $regiones = DB::table('regiones')->paginate(6);

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
    /*
     * raw sql
     DB::insert(
                "INSERT INTO regiones
                        ( regNombre )
                    VALUE
                        ( :regNombre )",
                    [ $regNombre ]
              );*/
    DB::table('regiones')->insert( [ 'regNombre'=>$regNombre ] );
    //reporte de alta ok
    return redirect('/regiones')
                    ->with(['mensaje'=>'Región: '.$regNombre.' agregada correctamente.']);
});
Route::get('/region/edit/{id}', function ($id)
{
    //obtener dato de la región
    /*$region = DB::select('select idRegion, regNombre
                            from regiones
                            where idRegion = :idRegion',
                                    [ $id ]
                            );*/
    $region = DB::table('regiones')
                        ->where('idRegion', $id)
                        ->first();
    return view('regionEdit', [ 'region'=>$region ]);
});
Route::post('/region/update', function()
{
    $regNombre = request()->regNombre;
    $idRegion = request()->idRegion;
    /*DB::update('UPDATE regiones
                    SET regNombre = :regNombre
                    WHERE idRegion = :idRegion,
                    [ $regNombre, $idRegion ]');*/
    /*DB::table('regiones')
            ->where('idRegion', $idRegion)
            ->update(['regNombre' => $regNombre]);*/
    try {
        DB::table('regiones')->where('idRegion',$idRegion)->update( [ 'regNombre' => $regNombre ] );
        return redirect('/regiones')->with(['mensaje' => 'Región:'.$regNombre.'modificada correctamente']);
    } catch (\Throwable $th) {
        //throw $th;
        return redirect('/regiones')->with(['mensaje' => 'No se pudo modificar la región']);
    }
});
Route::get('/region/delete/{id}', function($id)
{
    $region = DB::table('regiones')
                    ->where('idRegion',$id)
                    ->first();
    $cantidad = DB::table('destinos')
                    ->where('idRegion', $id)
                    ->count();
    return view('regionDelete',
                        [
                            'region'=>$region,
                            'cantidad'=>$cantidad
                        ]
                );
});
Route::post('/region/destroy', function ()
{
    $regNombre = request()->regNombre;
    $idRegion = request()->idRegion;
    try {
        DB::table('regiones')
            ->where('idRegion',$idRegion)
            ->delete();
        return redirect('/regiones')
            ->with(['mensaje' => 'Región: '.$regNombre.' eliminada correctamente']);
    } catch (\Throwable $th)
    {
        //throw $th;
        return redirect('/regiones')->with(['mensaje' => 'No se pudo eliminar la región']);
    }
});
###### CRUD de destinos ########
Route::get('/destinos', function () {
    //obtenemos listado de destinos
    /*
     $destinos = DB::select(

                        'SELECT idDestino, destNombre,
                                regNombre, destPrecio,
                                destAsientos, destDisponibles
                            FROM destinos d
                                JOIN regiones r
                                ON r.idRegion = d.idRegion
                            ');*/
    $destinos = DB::table('destinos as d')
                    ->join('regiones as r', 'r.idRegion', '=', 'd.idRegion')
                    ->paginate(6);
    //Pasamos datos a la vista
    return view('destinos', ['destinos' => $destinos]);
});
Route::get('/destino/create', function(){
    $regiones = DB::table('regiones')
                    ->get();
    return view('destinoCreate', ['regiones'=> $regiones]);
});
Route::post('/destino/store', function ()
{
    $destNombre = request()->destNombre;
    $idRegion = request()->idRegion;
    $destPrecio = request()->destPrecio;
    $destAsientos = request()->destAsientos;
    $destDisponibles = request()->destDisponibles;
    /* RAW SQL
     *
    DB::insert('INSERT INTO destinos
                (destNombre, idRegion, destPrecio, destAsientos, destDisponibles)
                VALUE
                (:destNombre, :idRegion, :destPrecio, :destAsientos, :destDisponibles)'
               ,[$destNombre, $idRegion, $destPrecio, $destAsientos, $destDisponibles]
                );*/
    try {
        DB::table('destinos')
            ->insert(
                [
                    'destNombre'=> $destNombre,
                    'idRegion'=> $idRegion,
                    'destPrecio'=> $destPrecio,
                    'destAsientos'=> $destAsientos,
                    'destDisponibles'=> $destDisponibles
                ]
            );
        return redirect('/destinos')
                    ->with(['mensaje' => 'Destino: '.$destNombre.' agregado correctamente']);
    } catch (\Throwable $th)
    {
        //throw $th;
        return redirect('/destinos')->with(['mensaje' => 'No se pudo agregar el destino.']);
    }
});
Route::get('/destino/edit/{id}', function ($id) {
    $destino = DB::table('destinos')
        ->where('idDestino', $id)
        ->first();

    $regiones = DB::table('regiones')
        ->get();

    return view(
        'destinoEdit',
        [
            'regiones' => $regiones,
            'destino' => $destino
        ]
    );
});
Route::post('/destino/update', function ()
{
    $request = [
        "destNombre" => request()->destNombre,
        "idRegion" => request()->idRegion,
        "destPrecio" => request()->destPrecio,
        "destAsientos" => request()->destAsientos,
        "destDisponibles" => request()->destDisponibles
    ];

    try {
        DB::table('destinos')
            ->where('idDestino', request()->idDestino)
            ->update($request);
        return redirect('/destinos')
            ->with(['mensaje' => 'Destino: '.request()->destNombre.' modificado correctamente']);
    } catch (\Throwable $th)
    {
        //throw $th;
        return redirect('/destinos')->with(['mensaje' => 'No se pudo modificar el destino.']);
    }
});
Route::get('/destino/delete/{id}', function($id)
{
    //obtenemos detos del destino
    $destino = DB::table('destinos')
                    ->where('idDestino', $id)
                    ->first();
    return view(
        'destinoDelete',
        [
            'destino' => $destino
        ]
    );
});
