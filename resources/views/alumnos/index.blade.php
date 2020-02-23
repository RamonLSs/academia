@extends('plantillas.plantilla')
@section('titulo')
Gestion de Alumnos
@endsection

@section('cabecera')
Gestion de Alumnos
@endsection

@section('contenido')
@if ($text=Session::get('mensaje'))
<p class="alert alert-danger my-3">{{$text}}</p>
@endif
<div class="container">
<a href="{{route('alumnos.create')}}" class="btn btn-info mb-3" ><i class="fa fa-plus"> Nuevos Alumnos</i></a>
<form name="search" method="GET" action="{{route('alumnos.index')}}"class="form-inline float-right">
<select name="categoria" class='form-control mr-2' onchange="this.form.submit()">
      @foreach ($modulos as $modulo)

<option>{{$modulo->nombre}}</option>

    @endforeach
</select>

<input type="submit" value="Buscar" class="btn btn-info ml-2">
</form>
</div>
<table class="table table-striped table-dark">
    <thead>
      <tr>
        <th scope="col">Detalles</th>
        <th scope="col" class="align-middle">Apellidos, Nombre</th>
        <th scope="col" class="align-middle">Email</th>
        <th scope="col" class="align-middle">Imagen</th>
        <th scope="col" class="align-middle">Acciones</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($alumnos as $alumno)
            <tr class="align-middle">
                <th scope="row" class="align-middle">
                    <a href="{{route('alumnos.show',$alumno)}}" style="text-decoration:none" class="btn btn-success fa fa-address-card fa-2x"></a>
                </th>
                <td class="align-middle">{{$alumno->apellidos.", ".$alumno->nombre}}</td>
                <td class="align-middle">{{$alumno->mail}}</td>
                <td class="align-middle">
                    <img src="{{asset($alumno->logo)}}" width="150px" height="150px" class="img-fluid rounded-circle">
                </td>

                <td class="align-middle">
                <form action="{{route('alumnos.destroy', $alumno)}}" name="del" method="POST" class="form-inline">
                @method('DELETE')
                @csrf
                <button type="submit" onclick="return confirm('¿Borrar Alumno?')" class="btn btn-danger fa fa-trash fa-2x"></button>
                <a href="{{route('alumnos.edit', $alumno)}}" class="ml-2 fa fa-edit fa-2x btn btn-warning"></a>
            </form>
                </td>
            </tr>
        @endforeach


    </tbody>
  </table>

  {{$alumnos->appends(Request::except('page'))->links()}}
@endsection
