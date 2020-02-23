@extends('plantillas.plantilla')
@section('titulo')
Gestion de Alumnos
@endsection

@section('cabecera')
Gestion de Alumnos
@endsection

@section('contenido')
@if ($text=Session::get('mensaje'))
<p class="alert alert-info my-3">{{$text}}</p>
@endif
<span class="clearfix"></span>
    <div class="card text-white bg-info mt-5 mx-auto" style="max-width: 48rem;">
        <div class="card-header text-center"><b>{{($alumno->nombre)}}</b></div>
        <div class="card-body" style="font-size: 1.1em">
            <h5 class="card-title text-center">Id del alumno: {{($alumno->id)}}</h5>
            <p class="card-text">
            <div class="float-right"><img src="{{asset($alumno->logo)}}" width="230px" heght="230px" class="rounded-circle"></div>
            <p><b>Nombre:</b> {{$alumno->nombre.", ".$alumno->apellidos}}</p>
            <p><b>Email:</b> {{$alumno->mail}}</p>
            <p><b>Modulos:</b>
            <ul>
                @foreach ($alumno->modulos as $modulo)
                    <li>{{$modulo->nombre." (".$modulo->pivot->nota.")"}}</li>
                @endforeach
            </ul>

            </p>
            <p><b>Nota media: {{$alumno->notaMedia()}}</b></p>
            </p>
            <a href="{{route('alumnos.index')}}" class="mt-3 float-right btn btn-success">Volver</a>
            <a href="{{route('alumnos.fmatricula', $alumno)}}" class="float-right btn btn-warning mr-2 mt-3 ">Matricular Alumno</a>
            <a href="{{route('alumnos.fcalificar', $alumno)}}" class="float-right btn btn-danger mr-2 mt-3 ">Calificar Alumno</a>
        </div>
    </div>

@endsection
