<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Models\Producto;
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
            [ 'mkNombre'=>'required|unique:marcas,mkNombre|min:2|max:30' ],
            [
              'mkNombre.required'=>'El campo "Nombre de la marca" es obligatorio.',
              'mkNombre.min'=>'El campo "Nombre de la marca" debe tener al menos 2 caractéres.',
              'mkNombre.max'=>'El campo "Nombre de la marca" debe tener 30 caractéres como máximo.',
              'mkNombre.unique'=>'No puede haber dos marcas con el mismo nombre.'
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
        //$marca = DB::table('marcas')->where('idMarca', $id)->first();
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
    public function update(Request $request)
    {
        //validación
        $this->validarForm($request);
        try {
            //obtenemos datos de marca a modificar
            $Marca = Marca::find( $request->idMarca );
            //asignamos atributos
            $Marca->mkNombre = $mkNombre = $request->mkNombre;
            //guardamos cambios
            $Marca->save();
            //redirección con mensaje ok
            return redirect('/marcas')
                ->with(['mensaje' => 'Marca: '.$mkNombre.' modificada correctamente']);
        } catch (\Throwable $th)
        {
            //throw $th;
            return redirect('/marcas')->with(['mensaje' => 'No se pudo modificar la marca.']);
        }
    }

    private function checkProducto( $idMarca )
    {
        //$check = Producto::where('idMarca', $idMarca)->first();
        //$check = Producto::firstWhere('idMarca', $idMarca);
        $check = Producto::where('idMarca', $idMarca)->count();
        return $check;
    }

    public function confirm( $id )
    {
        //Obtenemos datos de la marca filtrados por su id
        $Marca = Marca::find($id);

        //si NO hay productos  relacionado a esa marca
        if ( $this->checkProducto($id) == 0 ){
            return view('marcaDelete', [ 'Marca'=>$Marca ]);
        }
        //redirección con mensaje que no se puede borrar
            return redirect('/marcas')
                ->with(
                    [
                        'clase'=>'warning',
                        'mensaje'=>'No se puede eliminar la marca '.$Marca->mkNombre.' ya que tiene productos relacionados.'
                    ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( Request $request )
    {
        try {
            /*$Marca = Marca::find( $request->idMarca );
            $Marca->delete();*/
            $Marca = Marca::destroy($request->idMarca);
            //redirección con mensaje ok
            return redirect('/marcas')
            ->with(['mensaje' => 'Marca: '.$request->mkNombre.' eliminada correctamente']);
        } catch (\Throwable $th)
        {
            //throw $th;
            return redirect('/marcas')->with(['mensaje' => 'No se pudo eliminar la marca.']);
        }
    }
}
