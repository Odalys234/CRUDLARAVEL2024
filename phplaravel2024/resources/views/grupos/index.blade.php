@extends('layouts.app')

@section('content')
@if (session('success')) 
   <div class="alert alert-success fade show" id=" success-message" data-bs-dismiss="alert" role="alert">
       {{session('success')}}   
   </div>

@endif


<h1>Lista grupo</h1>
<form action="{{route('grupos.index') }}" method="GET">
    @csrf
    <div class="row">
        <div class="col-md-4">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        
        </div>

    </div>
    
    <br>
    <div class="row">
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary">Buscar</button>
            <a href="{{ route('grupos.create') }}" class="btn btn-secondary">Ir a crear</a>
        
        </div>

    </div>

</form>
<table class="table table-striped">
    <head>
        <tr>
        <th>Nombre</th>
        <th>Descripcion</th>
        <th>Accion</th>
        </tr>
        
    </head>

    <tbody>
        @foreach($grupos as $grupo)
        <tr>
            <td>{{ $grupo->nombre}}</td>
            <td>{{$grupo->descripcion}}</td>
            <td>
                <table>
                    <td>
                        <a href="{{route('grupos.edit', $grupo->id)}}" class="btn btn-warning">Editar</a>
                    </td>
                    <td>
                        <a href="{{route('grupos.show', $grupo->id)}}" class="btn btn-info">Ver</a>
                    </td>
                    <td>
                        <a href="{{route('grupos.delete', $grupo->id)}}" class="btn btn-danger">Eliminar</a>
                    </td>
                </table>
            </td>
        </tr>
        @endforeach
    </tbody>

</table>
<div class="row">
    <div class="col-sm-12">
        {{$grupos->links()}}

    </div>

</div>
@endsection