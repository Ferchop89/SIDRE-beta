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
                           <div class="row-grado">
                              <input type="submit" id="grupo" name="btnGrupo" value="Consultar Grupo" class="btn-blue flex-item">
                           </div>
                           @if ($errors->has('grupo'))
                             <span class="help-block">
                               <strong>{{ $errors->first('grupo') }}</strong>
                             </span>
                           @endif
                        </div>
                     </form>
                     <form class="" id="formulario_consulta_optativa" name="form-data_optativa" action="{{ route('alumno.postOptativas') }}" method="POST" accept-charset="UTF-8">
                        {{ csrf_field() }}
                        {{-- @if(isset($optativas)) --}}
                           <div class="grado form-group{{ $errors->has('optativa') ? ' has-error' : '' }}">
                              <div class="row-grado">
                                 <label for="optativa" class="col-md-4 flex-item">Materias optativas:
                              </div>
                              <div class="row-grado">
                                 <p class="obligatorio flex-item">*</p></label>
                              </div>
                              <div class="row-grado">
                                 {{-- @foreach ($optativas as $key => $optativa)
                                    @foreach ($optativa as $nameAsignatura => $grupos)
                                       {{$nameAsignatura}}
                                       @foreach ($grupos as $value)
                                             {{dd($value)}}
                                       @endforeach
                                    @endforeach
                                 @endforeach --}}
                                 <select class="form-control flex-item" name="optativa" @if ($errors->has('optativa')) autofocus @endif>
                                     <option value="" selected>Selecciona una materia optativa</option>
                                     @foreach ($optativas as $key => $optativa)
                                        @foreach ($optativa as $nameAsignatura => $grupos)
                                           <option class='sinSeleccion' value="">
                                               {{$nameAsignatura}}
                                           </option>
                                           @foreach ($grupos as $value)
                                             <option value="{{$key.$value}}">
                                                 {{ $value }}
                                             </option>
                                           @endforeach
                                        @endforeach
                                     @endforeach
                                     {{-- @foreach ($optativas as $key => $value)
                                         <option value="{{$key}}">
                                             {{ $value }}
                                         </option>
                                     @endforeach --}}
                                 </select>
                                 <input type="hidden" id="area" name="area" value="{{$area}}" class="btn-blue flex-item">
                              </div>
                              <div class="row-grado">
                                 <input type="submit" id="optativa" name="btnOptativa" value="Consultar Optativa" class="btn-blue flex-item">
                              </div>
                              @if ($errors->has('optativa'))
                                <span class="help-block">
                                  <strong>{{ $errors->first('optativa') }}</strong>
                                </span>
                              @endif
                           </div>
                        {{-- @endif --}}
                     </form>
                     <div class="grado">
                         <div class="row-grado">
                             <a class="btn btn-blue flex-item" href="{{route("alumno.areas", 6)}}" role="button">Regresar</a>
                         </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
@endsection
