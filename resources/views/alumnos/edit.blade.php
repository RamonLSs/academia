@extends('plantillas.plantilla')
@section('titulo')
Academia S.A.
@endsection

@section('cabecera')
Editar Alumno
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

    <div class="card-header text-center text-white">
        <div>
            <img src="{{asset($alumno->logo)}}" width="90px" height="90px" class="rounded-circle" alt="">
            </div>
    </div>

    <div class="card-body">

        <form action="{{route('alumnos.update', $alumno)}}" name="g" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-row">
                <div class="col">
                    <label for="nom" class="col-form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" placeholder="Nombre" value="{{$alumno->nombre}}" id="nom" required>
                </div>

                <div class="col">
                    <label for="ape" class="col-form-label">Apellidos</label>
                    <input type="text" name="apellidos" class="form-control" placeholder="Apellidos" id="ape" value="{{$alumno->apellidos}}" required>
                </div>
            </div>

            <div class="form-row">
                <div class="col">
                    <label for="mail" class="col-form-label">E-mail</label>
                    <input type="mail" name="mail" class="form-control" placeholder="e-mail" id="mail" value="{{$alumno->mail}}" required>
                </div>

                <div class="col">
                    <label for="logo" class="col-form-label">Logo</label>
                    <input type="file" name="logo" class="form-control" class="form-control" accept="image/*">
                </div>
            </div>

            <div class="form-row mt-3">
                <div class="col">
                    <input type="submit" value="Editar" class="btn btn-success mr-3">
                    <input type="reset" value="Limpiar" class="btn btn-warning mr-3">
                    <a href="{{route('alumnos.index')}}"class="btn btn-info">Volver</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
