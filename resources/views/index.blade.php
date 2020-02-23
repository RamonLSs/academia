@extends('plantillas.plantilla')
@section('titulo')


@section('cabecera')
Academia S.A.
@endsection

@section('contenido')
<div class="txt-center mt-3"><a href="{{route('alumnos.index')}}" class="btn btn-primary mr-4">Gestionar Alumnos</a></div>
<div class="txt-center mt-3"><a href="{{route('modulos.index')}}" class="btn btn-primary mr-4">Gestionar Modulos</a></div>
@endsection
