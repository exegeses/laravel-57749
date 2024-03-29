@extends('layouts.plantilla')
@section('contenido')

    <h1>Panel de administración de regiones</h1>

    @if( session('mensaje') )
        <div class="row alert alert-success">
            {{ session('mensaje') }}
        </div>
    @endif

    <div class="row my-3 d-flex justify-content-between">
        <div class="col">
            <a href="/admin" class="btn btn-outline-secondary">
                Dashboard
            </a>
        </div>
        <div class="col text-end">
            <a href="/region/create" class="btn btn-outline-secondary">
                <i class="bi bi-plus-square"></i>
                Agregar
            </a>
        </div>
    </div>


    <ul class="list-group">

    @foreach( $regiones as $region )
        <li class="col-md-6 list-group-item list-group-item-action d-flex justify-content-between">
            <div class="col">
                <span class="fs-4">{{ $region->regNombre }}</span>
            </div>
            <div class="col text-end btn-group">
                <a href="/region/edit/{{ $region->idRegion }}" class="btn btn-outline-secondary me-1">
                    <i class="bi bi-pencil-square"></i>
                    Modificar
                </a>
                <a href="/region/delete/{{ $region->idRegion }}" class="btn btn-outline-secondary me-1">
                    <i class="bi bi-trash"></i>
                    &nbsp;Eliminar&nbsp;
                </a>
            </div>
        </li>
    @endforeach
    </ul>
    <div class="my-3 d-flex justify-content-end">
        {{ $regiones->links() }}
    </div>

@endsection
