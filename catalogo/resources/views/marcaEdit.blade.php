@extends('layouts.plantilla')
@section('contenido')

    <h1>Modificación de una marca</h1>

    <div class="alert bg-light p-4 col-8 mx-auto shadow">
        <form action="/marca/update" method="post">
        @method('put')
        @csrf
            <div class="form-group">
                <label for="mkNombre">Nombre de la marca</label>
                <input type="text" name="mkNombre"
                       value="{{ old('mkNombre', $Marca->mkNombre) }}"
                       class="form-control" id="mkNombre">
            </div>
            <input type="hidden" name="idMarca"
                   value="{{ $Marca->idMarca }}">

            <button class="btn btn-dark my-3 px-4">Modificar marca</button>
            <a href="/marcas" class="btn btn-outline-secondary">
                Volver a panel de marcas
            </a>
        </form>
    </div>

    @include( 'layouts.msgValidacion' )


@endsection
