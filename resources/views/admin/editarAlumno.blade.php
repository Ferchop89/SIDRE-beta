@extends('layouts.appAdmin')
@section('add_css')
  <link href="{{ asset ('css/estilo_content.css') }}" rel="stylesheet">
@section('content')
<div class="container">
   <div>
      <h2>Editar Alumno:</h2>
   </div>
   <div class="editar-alumno">
      <form class="" action="{{ url('admin/editar/alumno') }}" method="POST">
         {{ csrf_field() }}
         <table class="table table-dark encabezado">
            <tr>
               <th scope="col">Número de Cuenta</th>
               <th scope="col">Nombre</th>
               <th scope="col">Comentarios</th>
               <th scope="col">Habilitar</th>
            </tr>
            <tr>
               <td class="num_cta">{{$datos[0]}}</td>
               <td class="nombre">{{$nombre}}</td>
               <td class="comentario">
                  <input type="text" name="comentario" value="{{ old('comentario', $datos[1]) }}" placeholder="Puedes escribir un comentario, sobre este alumno">
               </td>
               <td class="activo">
                  <input type="checkbox" {{ $datos[2] ? 'Checked' : '' }} name="activo" >
                  <input type="hidden" value="{{ $datos[0]}}" name="num_cta" >
                  {{-- {{ Form::checkbox('is_active', null, $datos[2]) }} --}}
                  {{-- <input type="checkbox" name="activo" value="{{$datos[2]}}}"> --}}
               </td>
           </tr>
         </table>
         <div class="grado">
             <div class="row-grado">
                 <input type="button" value="Regresar" class="btn-blue flex-item" onclick="history.back(-1)" />
             </div>
             <div class="row-grado">
                 <input type="submit" value="Guardar" class="btn-blue flex-item">
             </div>
         </div>
      </form>
   </div>
</div>
@endsection
