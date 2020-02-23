@extends('plantillas.plantilla')
@section('titulo')
Academia S.A.
@endsection

@section('cabecera')
Modulos disponibles para el alumno {{$alumno->nombre." , ".$alumno->apellidos}}
@endsection

@section('contenido')
<form action="{{route('alumnos.matricular')}}" name="matricula" method="POST">
@csrf
<input type="hidden" value="{{$alumno->id}}" name="alumno_id">
    <div class="form-row">
        <select class="form-control" name="modulo_id[]" multiple>
            @foreach ($modulos2 as $modulo)
        <option value="{{$modulo->id}}">{{$modulo->nombre." ( ".$modulo->horas.")"}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-row">
        <div class="col"></div>
        <input type="submit" value="Matricula" class="btn btn-info mr-2">
        <a href="{{route('alumnos.show', $alumno)}}" class="btn btn-primary">Volver</a>
    </div>
</div>
</form>
@endsection
