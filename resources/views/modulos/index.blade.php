@extends('plantillas.plantilla')
@section('titulo')
Modulos
@endsection

@section('cabecera')
Modulos
@endsection

@section('contenido')
@if ($text=Session::get('mensaje'))
<p class="alert alert-danger my-3">{{$text}}</p>
@endif
<a href="{{route('modulos.create')}}" class="btn btn-info mb-3" ><i class="fa fa-plus"> Nuevos Modulos</i></a>
<table class="table table-striped table-dark">
    <thead>
      <tr>
        <th scope="col">Detalles</th>
        <th scope="col" class="align-middle">Nombre</th>
        <th scope="col" class="align-middle">Horas</th>
        <th scope="col" class="align-middle">Acciones</th>
    </tr>
</thead>
<tbody>
    @foreach ($modulos as $modulo)
        <tr class="align-middle">
            <th scope="row" class="align-middle">
                <a href="{{route('modulos.show',$modulo)}}" style="text-decoration:none" class="btn btn-success fa fa-address-book fa-2x"></a>
            </th>
            <td class="align-middle">{{$modulo->nombre}}</td>
            <td class="align-middle">{{$modulo->horas}}</td>
            <td class="align-middle">
                <form action="{{route('modulos.destroy', $modulo)}}" name="del" method="POST" class="form-inline">
                @method('DELETE')
                @csrf
                <button type="submit" onclick="return confirm('¿Borrar Modulo?')" class="btn btn-danger fa fa-trash fa-2x"></button>
                <a href="{{route('modulos.edit', $modulo)}}" class="ml-2 fa fa-edit fa-2x btn btn-warning"></a>
            </form>
        </td>
    </tr>
@endforeach
</tbody>
</table>
{{$modulos->links()}}
@endsection
