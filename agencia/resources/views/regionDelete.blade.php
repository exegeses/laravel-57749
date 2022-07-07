@extends('layouts.plantilla')
@section('contenido')

    <h1>Baja de una región</h1>


    <div class="alert text-danger bg-light p-4 col-8 mx-auto shadow">
        No se puede eliminar la región
        <span class="fs-4">{{ 'regNombre' }}</span>.
        <a href="/regiones" class="btn btn-outline-secondary">
            Volver a panel de regiones
        </a>
    </div>


    <div class="alert text-danger bg-light p-4 col-8 mx-auto shadow">
        Se eliminará la región
        <span class="fs-4">{{ 'regNombre' }}</span>.
        <form action="/region/destroy" method="post">

            <input type="hidden" name="idRegion"
                   value="{{ 'idRegion' }}">
            <input type="hidden" name="regNombre"
                   value="{{ 'regNombre' }}">
            <button class="btn btn-danger btn-block my-3">Confirmar baja</button>
            <a href="/regiones" class="btn btn-outline-secondary btn-block my-2">
                volver a panel
            </a>
        </form>

    </div>


@endsection
