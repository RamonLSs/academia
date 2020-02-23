@extends('plantillas.plantilla')
@section('titulo')
Academia S.A.
@endsection

@section('cabecera')
Editar Modulo
@endsection

@section('contenido')
@if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $miError)
                    <li>{{$miError}}</li>
                @endforeach
            </ul>
        </div>
@endif
<div class="card bg-secondary">
    <div class="card-body">
        <form action="{{route('modulos.update', $modulo)}}" name="g" method="POST">
            @csrf
            @method('PUT')
            <div class="form-row">
                <div class="col">
                    <label for="nom" class="col-form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" placeholder="Nombre" value="{{$modulo->nombre}}" id="nom" required>
                </div>

                <div class="col">
                    <label for="hor" class="col-form-label">Horas</label>
                    <input type="text" name="horas" class="form-control" placeholder="Horas" id="hor" value="{{$modulo->horas}}" required>
                </div>
            </div>

            <div class="form-row mt-3">
                <div class="col">
                    <input type="submit" value="Editar" class="btn btn-success mr-3">
                    <input type="reset" value="Limpiar" class="btn btn-warning mr-3">
                    <a href="{{route('modulos.index')}}"class="btn btn-info">Volver</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
