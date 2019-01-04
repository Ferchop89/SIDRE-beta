@extends('layouts.appAdmin')
@section('add_css')
  <link href="{{ asset ('css/estilo_content.css') }}" rel="stylesheet">
@section('content')
<div class="container">
   <div class="row">
      <div class="col-md-8 col-md-offset-2">
         <div class="panel panel-default">
            <div class="panel-heading">Búsqueda de Alumnos</div>

            <div class="panel-body">
               @if (Session::has('message'))
                   <div class="alert alert-info">{{ Session::get('message') }}</div>
               @endif
               <div class="form-group{{ $errors->has('num_cta') ? ' has-error' : '' }}">
                  <form class="" action="{{ url('admin/buscar/alumno') }}" method="POST">
                     {{ csrf_field() }}
                     <label for="num_cta" class="col-md-4">Número de Cuenta:</label>
                     <input type="text" name="num_cta" id="num_cta" class="form-control" placeholder="9 caracteres" autocomplete="off" maxlength="9">
                     @if ($errors->has('num_cta'))
                        <span class="help-block">
                           <strong>{{ $errors->first('num_cta') }}</strong>
                        </span>
                     @endif
                     {{-- <input type="submit" value="Buscar" class="btn-blue"> --}}
                     <div class="grado">
                         <div class="row-grado">
                             <input type="button" value="Regresar" class="btn-blue flex-item" onclick="history.back(-1)" />
                         </div>
                         <div class="row-grado">
                             <input type="submit" value="Buscar" class="btn-blue flex-item">
                         </div>
                     </div>
                  </form>
               </div>

            </div>
         </div>
      </div>
   </div>
</div>
@endsection
