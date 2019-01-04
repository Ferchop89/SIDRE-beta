@extends('layouts.app')
@section('title', config('app.name', 'Laravel').' | '.$title)
@section('estilos')

@endsection
{{-- @section('title', $title) --}}
@section('content')
<div class="container">
   <div class="d-flex justify-content-between align-items-end mb-3">
      <h2 id="titulo">{{$title}}</h2>
      <p class="button">
         <a href="{{ route('admin.crearUsuario') }}" class="btn btn-primary">Nuevo Usuario</a>
      </p>
   </div>
   <div class="card-body">
      @if($users->isNotEmpty())
         <table class="table table-hover">
            <thead class="thead-dark">
               <tr>
                  <th scope="col">#</th>
                  <th scope="col">Alias</th>
                  <th scope="col">Nombre Completo</th>
                  <th scope="col">Activo</th>
                  <th scope="col">Correo</th>
                  <th scope="col">Rol</th>
                  <th scope="col">Puesto</th>
                  <th scope="col">Área</th>
                  <th scope="col">Acción</th>
               </tr>
            </thead>
            <tbody>
               @foreach($users as $key => $user)
                  <tr>
                     <th scope="row">{{$key+1}}</th>
                     <td>{{ $user->pseudonombre }}</td>
                     <td>{{ $user->nombres.' '.$user->app.' '.$user->apm }}</td>
                     <td><input type="checkbox" {{ $user->is_active ? 'checked' : ''   }} name="activo" OnClick="return false;" ></td>
                     <td>{{ $user->email }}</td>
                     <td>{{ $user->rol->nombre }}</td>
                     <td>{{ $user->puesto->nombre }}</td>
                     <td>{{ $user->area->nombre }}</td>
                     <td>
                        <form action="{{ route('admin.eliminarUsuario',[ $user ]) }}" method="POST">
                           {{ csrf_field() }}
                           {{ method_field('DELETE')}}
                           <a href="{{ route('admin.verUsuario',[ $user ]) }}"><i class="fa fa-eye fa-2x" aria-hidden="true"></i></a>
                           <a href="{{ route('admin.editarUsuario',[ $user ]) }}"><i class="fa fa-edit fa-2x"></i></a>
                           <button type="submit"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></button>
                        </form>
                     </td>
                  </tr>
               @endforeach
            </tbody>
         </table>
      @else
         <p>No hay usuarios registrados.</p>
      @endif
   </div>
   <div class="paginador">
      {{ $users->links()}}
   </div>
</div>
@endsection
