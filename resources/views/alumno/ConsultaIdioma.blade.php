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
                     <h3>Consulta de idiomas</h3>
                  </div>
               </div>
               <div class="panel-body">
                  <div class="consulta">
                    <p>Selecciona el idioma que deseas consultar:</p>
                     <form class="" id="formulario_consulta" name="form-data" action="{{ route('alumno.postIdiomas') }}" method="POST" accept-charset="UTF-8">
                        {{ csrf_field() }}
                        <div class="grado form-group{{ $errors->has('idioma') ? ' has-error' : '' }}">
                           <div class="row-grado">
                              <label for="idioma" class="col-md-4 flex-item">Idioma:
                           </div>
                           <div class="row-grado">
                              <p class="obligatorio flex-item">*</p></label>
                           </div>
                           <div class="row-grado">

                              <select class="form-control flex-item" name="idioma" @if ($errors->has('idioma')) autofocus @endif>
                                  <option value="" selected>Selecciona una opción</option>
                                  @foreach ($idiomas as $key =>$value)
                                      <option value="{{$key}}">
                                          {{ $value }}
                                      </option>
                                  @endforeach
                              </select>
                           </div>
                        </div>
                        @if ($errors->has('idioma'))
                          <span class="help-block">
                            <strong>{{ $errors->first('idioma') }}</strong>
                          </span>
                        @endif
                        <div class="grado">
                            <div class="row-grado">
                                <a class="btn btn-blue flex-item" href="{{route("alumno.showReinscripcion", Auth::user()->id)}}" role="button">Regresar</a>
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
