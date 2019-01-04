@extends('layouts.app')
@section('title', config('app.name', 'Laravel').' | '.$title)
@section('content')
<div class="container">
   <h2 id="titulo">{{$title." '".$user->pseudonombre."'"}}</h2>
   <div class="card-body">
      <div class="form-group">
         <label for="pseudonombre">Alias</label>
         <input type="text" name="pseudonombre" class="form-control" value="{{ $user->pseudonombre }}" readonly>
      </div>
      <div class="form-group">
         <label for="nombres">Nombre(S): </label>
         <input type="text" name="nombres" class="form-control" value="{{ $user->nombres }}" readonly>
      </div>
      <div class="form-group">
         <label for="app">Apellido Paterno: </label>
         <input type="text" name="app" class="form-control" value="{{ $user->app }}" readonly>
      </div>
      <div class="form-group">
         <label for="app">Apellido Materno: </label>
         <input type="text" name="apm" class="form-control" value="{{ $user->apm }}" readonly>
      </div>
      <div class="form-group">
         <label for="activo">Usuario Activo: </label>
         <input type="checkbox" {{ $user->activo ? 'checked' : ''   }} name="activo" OnClick="return false;" readonly>
      </div>
      <div class="form-group">
         <label for="email">Correo: </label>
         <input type="text" name="email" class="form-control" value="{{ $user->email }}" readonly>
      </div>
      <div class="form-group">
         <label for="fechaNac">Fecha de Nacimiento: </label>
         <input type="text" name="fechaNac" class="form-control" value="{{ $user->fecha_nac->format('d/m/Y') }}" readonly>
      </div>
      <div class="form-group">
         <label for="telFijo">Telefóno Fijo: </label>
         <input type="text" name="telFijo" class="form-control" value="{{ $user->telefono_fijo }}" readonly>
      </div>
      <div class="form-group">
         <label for="telCelular">Telefóno Celular: </label>
         <input type="text" name="telCelular" class="form-control" value="{{ $user->telefono_celular }}" readonly>
      </div>
      <div class="form-group">
         <label for="licencia">Licencia: </label>
         <input type="text" name="licencia" class="form-control" value="{{ $user->rol->nombre }}" readonly>
      </div>
      <div class="form-group">
         <label for="puesto">Puesto: </label>
         <input type="text" name="puesto" class="form-control" value="{{ $user->puesto->nombre }}" readonly>
      </div>
      <div class="form-group">
         <label for="area">Área: </label>
         <input type="text" name="area" class="form-control" value="{{ $user->area->nombre }}" readonly>
      </div>
      <div class="form-group">
         <p class="button">
            <a href="{{ route('admin.usuarios') }}" class="btn btn-primary waves-effect waves-light">Regresar a la lista de usuarios</a>
         </p>
      </div>
   </div>
</div>
@endsection
