@extends('layouts.app')

@section('content')
@if (session('success')) 
   <div class="alert alert-success fade show" id=" success-message" data-bs-dismiss="alert" role="alert">
       {{ session('success') }}   
   </div>
@endif

<h1>Lista de estudiantes</h1>
<form action="{{ route('estudiantes.index') }}" method="GET">
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
            <a href="{{ route('estudiantes.create') }}" class="btn btn-secondary">Ir a crear</a>
        </div>
    </div>
</form>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Email</th>
            <th>Acción</th>
        </tr>
    </thead>
    <tbody>
        @foreach($estudiantes as $estudiante)
        <tr>
            <td>{{ $estudiante->nombre }}</td>
            <td>{{ $estudiante->apellido }}</td>
            <td>{{ $estudiante->email }}</td>
            <td>
                <a href="{{ route('estudiantes.edit', $estudiante->id) }}" class="btn btn-warning">Editar</a>
                <a href="{{ route('estudiantes.show', $estudiante->id) }}" class="btn btn-info">Ver</a>
                <a href="{{ route('estudiantes.delete', $estudiante->id) }}" class="btn btn-danger">Eliminar</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="row">
    <div class="col-sm-12">
        {{ $estudiantes->links() }}
    </div>
</div>
@endsection
