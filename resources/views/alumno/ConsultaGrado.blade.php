@extends('layouts.app')
@section('add_css')
  <link href="{{ asset ('css/estilo_content.css') }}" rel="stylesheet">
@endsection
@section('content')
   <div class="container">
   {{-- <div class="content_turn"> --}}
      <div class="row">
         <div class="col-md-8 col-md-offset-2">
            <div class="name_user">
               <h2>Bienvenid@: {{Auth::User()->nombre_completo(Auth::id())}}</h2>
               <h3>{{Auth::User()->num_cta}}</h3>
            </div>
            <div class="panel panel-default">
               <div class="panel-heading">
                  <div class="title">
                     <h3>Consulta de grupos</h3>
                  </div>
               </div>
               <div class="panel-body">
                  <div class="consulta">
                    <p>Selecciona el grado escolar del que deseas consultar un grupo:</p>
                     <form class="" id="formulario_consulta" name="form-data" action="{{ route('alumno.postGrados') }}" method="POST" accept-charset="UTF-8">
                        {{ csrf_field() }}
                        <div class="grado form-group{{ $errors->has('grado') ? ' has-error' : '' }}">
                           <div class="row-grado">
                              <label for="grado" class="col-md-4 flex-item">Grado:
                           </div>
                           <div class="row-grado">
                              <p class="obligatorio flex-item">*</p></label>
                           </div>
                           <div class="row-grado">
                              <select class="form-control flex-item" name="grado" @if ($errors->has('grado')) autofocus @endif>
                                 <option value="" selected>Selecciona una opción</option>
                                 <option value="2">Segundo</option>
                                 <option value="3">Tercero</option>
                                 <option value="4">Cuarto</option>
                                 <option value="5">Quinto</option>
                                 <option value="6">Sexto</option>
                              </select>
                           </div>
                           @if ($errors->has('grado'))
                             <span class="help-block">
                               <strong>{{ $errors->first('grado') }}</strong>
                             </span>
                           @endif
                        </div>
                        <div class="grado">
                            <div class="row-grado">
                               <a class="btn btn-blue flex-item" href="{{route("alumno.pasos")}}" role="button">Regresar</a>
                            </div>
                            <div class="row-grado">
                                <input type="submit" value="Consultar Grupo" class="btn-blue flex-item">
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
