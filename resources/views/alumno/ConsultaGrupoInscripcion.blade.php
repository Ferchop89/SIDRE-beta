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
                    <p>Selecciona el grupo que deseas consultar:</p>
                     <form class="" id="formulario_consulta" name="form-data" action="{{ route('alumno.postGrupos') }}" method="POST" accept-charset="UTF-8">
                        {{ csrf_field() }}
                        <div class="grado form-group{{ $errors->has('grupo') ? ' has-error' : '' }}">
                           <div class="row-grado">
                              <label for="grupo" class="col-md-4 flex-item">Grupo:
                           </div>
                           <div class="row-grado">
                              <p class="obligatorio flex-item">*</p></label>
                           </div>
                           <div class="row-grado">

                              <select class="form-control flex-item" name="grupo" @if ($errors->has('grupo')) autofocus @endif>
                                  <option value="" selected>Selecciona un grupo</option>
                                  @foreach ($grupos as $value)
                                      <option value="{{$value}}">
                                          {{ $value }}
                                      </option>
                                  @endforeach
                              </select>
                           </div>
                           @if ($errors->has('grupo'))
                             <span class="help-block">
                               <strong>{{ $errors->first('grupo') }}</strong>
                             </span>
                           @endif
                        </div>
                        <div class="grado">
                            <div class="row-grado">
                                <input type="button" value="Regresar" class="btn-blue flex-item" onclick="history.back(-1)" />
                                <a class="btn btn-primary" href="{{route("")}}" role="button">Regresar</a>
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
