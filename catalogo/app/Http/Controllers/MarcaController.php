<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //obtenemos listado de marcas  DB::table('marcas')->get()
        //$marcas = Marca::all();
        $marcas = Marca::paginate(10);
        return view('marcas', ['marcas'=>$marcas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('marcaCreate');
    }

    private function validarForm( Request $request )
    {
        // [ 'campo'=>'reglas' ], [ 'campo.regla'=>'mensaje' ]
        $request->validate(
            [ 'mkNombre'=>'required|min:2|max:30' ],
            [
              'mkNombre.required'=>'El campo "Nombre de la marca" es obligatorio.',
              'mkNombre.min'=>'El campo "Nombre de la marca" debe tener al menos 2 caractéres.',
              'mkNombre.max'=>'El campo "Nombre de la marca" debe tener 30 caractéres como máximo.'
            ]
        );
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request )
    {

        //validar
        $this->validarForm( $request );
        /*si no valida a: se genera una variable $errors
                      b: redirección al form*/
        try{
            // instanciamos
            $Marca = new Marca;
            // asignamos atributos
            $Marca->mkNombre = $mkNombre = $request->mkNombre;
            //guardamos en table
            $Marca->save();

            //redirección con mensaje ok
            return redirect('/marcas')
                    ->with(['mensaje' => 'Marca: '.$mkNombre.' agregada correctamente']);
        } catch (\Throwable $th)
        {
            //throw $th;
            return redirect('/marcas')->with(['mensaje' => 'No se pudo agregar la marca.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //obtenemos datos de la marca filtrada por su id
        //$marca = DB::table('marcas')->first($id);
        $Marca = Marca::find($id);
        return  view('marcaEdit', [ 'Marca'=>$Marca ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
