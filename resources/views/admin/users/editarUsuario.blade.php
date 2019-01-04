@extends('layouts.app')
@section('title', config('app.name', 'Laravel').' | '.$title)
@section('content')
<div class="container">
   <h2 id="titulo">{{$title." '".$user->pseudonombre."'"}}</h2>
   <div class="card-body">
      <form method="POST" action="{{ url("admin/usuarios/{$user->id}/guardar") }}">
         {{-- {{ method_field('PUT') }} --}}
         {!! csrf_field() !!}
         <div class="form-group{{ $errors->has('pseudonombre') ? ' has-error' : '' }}">
            <label for="pseudonombre">Alias</label>
            <input type="text" name="pseudonombre" class="form-control" placeholder="Pseudonombre" value="{{ old('pseudonombre', $user->pseudonombre) }}">
            @if ($errors->has('pseudonombre'))
             <span class="help-block">
               <strong>{{ $errors->first('pseudonombre') }}</strong>
             </span>
           @endif
         </div>
         <div class="form-group{{ $errors->has('nombres') ? ' has-error' : '' }}">
            <label for="nombres">Nombre(s): </label>
            <input type="text" name="nombres" class="form-control" placeholder="Nombre(s)" value="{{ old('nombres', $user->nombres) }}">
            @if ($errors->has('nombres'))
             <span class="help-block">
               <strong>{{ $errors->first('nombres') }}</strong>
             </span>
           @endif
         </div>
         <div class="form-group{{ $errors->has('app') ? ' has-error' : '' }}">
            <label for="app">Apellido Paterno: </label>
            <input type="text" name="app" class="form-control" placeholder="Apellido Paterno" value="{{ old('app', $user->app) }}">
            @if ($errors->has('app'))
             <span class="help-block">
               <strong>{{ $errors->first('app') }}</strong>
             </span>
           @endif
         </div>
         <div class="form-group{{ $errors->has('apm') ? ' has-error' : '' }}">
            <label for="apm">Apellido Materno: </label>
            <input type="text" name="apm" class="form-control" placeholder="Apellido Materno" value="{{ old('apm', $user->apm) }}">
            @if ($errors->has('apm'))
             <span class="help-block">
               <strong>{{ $errors->first('apm') }}</strong>
             </span>
           @endif
         </div>
         <div class="form-group">
            <label for="activo">Usuario activo: </label>
            {{-- {{ Form::checkbox('activo', null, $user->activo) }} --}}
            {{-- {{dd($user->activo)}} --}}
            {{-- {{ dd(old('activo', $user->activo)) }} --}}
            <input type="checkbox" name="activo" id="activo" value="{{ old('activo') }}" @if($user->activo) checked @endif>
         </div>
         <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password">Contraseña: </label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña">
            @if ($errors->has('password'))
               <span class="help-block">
                  <strong>{{ $errors->first('password') }}</strong>
               </span>
            @endif
         </div>
         <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email">Correo: </label>
            <input type="email" name="email" class="form-control" placeholder="Correo Electrónico" value="{{ old('email', $user->email) }}">
            @if ($errors->has('email'))
             <span class="help-block">
               <strong>{{ $errors->first('email') }}</strong>
             </span>
           @endif
         </div>
         <div class="form-group{{ $errors->has('fechaNac') ? ' has-error' : '' }}">
            <label for="fechaNac">Fecha de Nacimiento: </label>
            <input type="date" name="fechaNac" id="fechaNac" class="form-control" value="{{ old('fechaNac', $user->fecha_nac->format('Y-m-d')) }}" autocomplete="off" @if ($errors->has('fechaNac')) autofocus @endif>
               @if ($errors->has('fechaNac'))
                <span class="help-block">
                  <strong>{{ $errors->first('fechaNac') }}</strong>
                </span>
              @endif
         </div>
         <div class="form-group{{ $errors->has('telFijo') ? ' has-error' : '' }}">
            <label for="telFijo">Telefóno Fijo: </label>
            <input type="text" name="telFijo" id="telFijo" class="form-control" placeholder="Incluye Lada" value="{{ old('telFijo', $user->telefono_fijo) }}" @if ($errors->has('telFijo')) autofocus @endif autocomplete="off" maxlength="10">
            @if ($errors->has('telFijo'))
             <span class="help-block">
               <strong>{{ $errors->first('telFijo') }}</strong>
             </span>
           @endif
         </div>
         <div class="form-group{{ $errors->has('telCelular') ? ' has-error' : '' }}">
            <label for="telCelular">Telefóno Celular: </label>
            <input type="text" name="telCelular" id="telCelular" class="form-control" placeholder="Incluye Lada" value="{{ old('telCelular', $user->telefono_celular) }}" @if ($errors->has('telCelular')) autofocus @endif autocomplete="off" maxlength="13">
               @if ($errors->has('telCelular'))
                  <span class="help-block">
                     <strong>{{ $errors->first('telCelular') }}</strong>
                  </span>
              @endif
         </div>
         <div class="form-group{{ $errors->has('rol') ? ' has-error' : '' }}">
            <label for="rol">Licencia: </label>
            <select name="rol" id="rol" class="form-control" autocomplete="off" @if ($errors->has('rol')) autofocus @endif>
               @foreach ($roles as $rol)
                  <option title="rol" value="{{ $rol->id }}" {{ old('rol') ? 'selected':'' }} {{($user->rol_id == $rol->id) ? 'selected':''}}>{{ $rol->nombre }}</option>
               @endforeach
            </select>
         </div>
         <div class="form-group{{ $errors->has('puesto') ? ' has-error' : '' }}">
            <label for="puesto">Puesto: </label>
            <select name="puesto" id="puesto" class="form-control" @if ($errors->has('puesto')) autofocus @endif>
               @foreach ($puestos as $puesto)
                  {{-- <option title="puesto" value="{{ $puesto->id }}" {{ old('puesto', $user->puesto_id) }} @if($user->puesto_id == $puesto->id) {{'selected'}} @else {{''}} @endif >
                  {{ $puesto->nombre }} --}}
                  <option title="puesto" value="{{ $puesto->id }}" {{ old('puesto') ? 'selected':'' }} {{($user->puesto_id == $puesto->id) ? 'selected':''}}>
                     {{ $puesto->nombre }}
                  </option>
               @endforeach
            </select>
         </div>
         <div class="form-group{{ $errors->has('area') ? ' has-error' : '' }}">
            <label for="area">Área: </label>
            <select name="area" id="area" class="form-control" @if ($errors->has('area')) autofocus @endif>
               @foreach ($areas as $area)
                  <option title="area" value="{{ $area->id }}" {{ old('area') ? 'selected':'' }} {{($user->area_id == $area->id) ? 'selected':''}}>
                     {{ $area->nombre }}
                  </option>
               @endforeach
            </select>
         </div>
         <div class="form-group">
            <p class="button">
               <a href="{{ route('admin.usuarios') }}" class="btn btn-primary waves-effect waves-light">Regresar a la lista de usuarios</a>
            </p>
            <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
         </div>
      </form>
   </div>
</div>
@endsection
