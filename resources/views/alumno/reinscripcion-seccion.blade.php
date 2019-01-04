@extends('layouts.app')
@section('add_css')
  {{-- <link href="{{ asset ('css/estilo_content.css') }}" rel="stylesheet"> --}}
  <link href="{{ asset ('css/botones.css') }}" rel="stylesheet">
@endsection
@section('content')
   <div class="container">
   {{-- <div class="content_turn"> --}}
      <div class="row">
         <div class="col-md-8 col-md-offset-2">
            <div class="name_user">
               <h2 class="center">Bienvenid@: {{Auth::User()->nombre_completo(Auth::id())}}</h2>
               <h3 class="center">{{Auth::User()->num_cta}}</h3>
            </div>
            <div class="panel panel-default">
               <div class="panel-heading">
                  <div class="center title">
                     <h3>Grupo base</h3>
                  </div>
               </div>
               <div class="body">
                  @if (Session::has('message'))
                      <div class="alert alert-info center">{{ Session::get('message') }}</div>
                  @endif
                  <div class="tira-materias">
                     <table class="table">
                        <thead class="">
                            <tr class="">
                                <th scope="col">GRUPO</th>
                                <th scope="col">CLAVE ASIGNATURA</th>
                                <th scope="col">ASIGNATURA</th>
                                <th scope="col">PROFESOR</th>
                            </tr>
                        </thead>
                        <tbody>
                           @for ($i=0; $i < count($asignaturas); $i++)
                              <tr class="">
                                    <td>
                                       {{$clv_grupo}}
                                    </td>
                                    <td>
                                       {{$asignaturas[$i]->clv_asignatura}}
                                    </td>
                                    <td>
                                       {{$asignaturas[$i]->nombre}}
                                    </td>
                                    <td>
                                       {{$profesores[$i]->nombre." ".$profesores[$i]->app." ".$profesores[$i]->apm}}
                                    </td>
                              </tr>
                           @endfor
                        </tbody>
                     </table>
                     @if(!empty($clv_secciones))
                     <div class="panel panel-default">
                        <div class="panel-heading">
                           <div class="center title">
                              <h3>Grupo por secciones</h3>
                           </div>
                        </div>
                     </div>
                           <table class="table">
                              <thead class="">
                                  <tr class="">
                                      <th scope="col">SECCION</th>
                                      <th scope="col">CLAVE ASIGNATURA</th>
                                      <th scope="col">ASIGNATURA</th>
                                      <th scope="col">PROFESOR</th>
                                  </tr>
                              </thead>
                              <tbody>
                                 @foreach ($sec_asignaturas as $clave => $value)
                                    @foreach ($value as $info)
                                       <tr>
                                       <td>
                                          {{$clv_secciones[$clave]}}
                                       </td>
                                       <td>
                                          {{-- {{dd($info)}} --}}
                                          {{$info->clv_asignatura}}
                                       </td>
                                       <td>
                                          {{$info->nombre}}
                                       </td>
                                       <td>
                                          {{$sec_profesores[$clave]}}
                                       </td>
                                       </tr>
                                    @endforeach

                                 @endforeach
                              </tbody>
                           </table>
                        </div>
                        <form class="" id="formulario_consulta" name="form-data" action="{{ route('alumno.reinscripcion-seccion') }}" method="POST" accept-charset="UTF-8">
                           {{ csrf_field() }}
                           <div class="seccion center">
                              <p>Elige una sección:</p>
                              @for ($i=0; $i < count($clv_secciones); $i++)
                                 <input type="radio" name="sec[]" value="{{$clv_secciones[$i]}}" checked> {{$clv_secciones[$i]}}<br>
                              @endfor
                              @if (isset($_GET['idioma']))
                                 <input type="hidden" name="idioma" value="{{$_GET['idioma']}}">
                              @endif
                              <input type="hidden" name="grup" value="{{$clv_grupo}}">
                              @if(!isset($optativas))
                              <div class="grado">
                                  <div class="row-grado">
                                     <a class="btn btn-blue flex-item" href="{{route("alumno.reinscripcion")}}" role="button">Regresar</a>
                                  </div>
                                  <div class="row-grado">
                                     <input type="submit" name="grupo" class="btn-blue flex-item" value="Inscribe grupo y sección">
                                  </div>
                              </div>
                              @endif
                           </div>
                           @if(isset($optativas))
                              <div class="panel panel-default">
                                 <div class="panel-heading">
                                    <div class="center title">
                                       <h3>Optativas</h3>
                                       <h4>
                                          @if ($area == 1 || $area == 2)
                                             Elige una opción:
                                          @elseif ($area == 3 || $area == 4)
                                             Elige dos opciones:
                                          @endif
                                       </h4>
                                    </div>
                                 </div>
                              </div>
                              <div class="optativas">
                                 @foreach ($optativas as $key => $optativa)
                                    <div class="row">
                                       <input type="checkbox" id="optativas" name="optativas[]" value={{$optativa['clv']}}> {!!$optativa['nombre']!!}
                                    </div>
                                 @endforeach
                              </div>
                              @if(isset($optativas))
                              <div class="grado">
                                 <input type="hidden" name="area" value="{{$area}}">
                                  <div class="row-grado">
                                     <a class="btn btn-blue flex-item" href="{{route("alumno.reinscripcion")}}" role="button">Regresar</a>
                                  </div>
                                  <div class="row-grado">
                                     <input type="submit" name="grupo" class="btn-blue flex-item" value="Inscribe grupo, sección y optativa(s)">
                                  </div>
                              </div>
                              @endif
                           @endif
                        </form>
                        @else
                           <form class="" id="formulario_consulta" name="form-data" action="{{ route('alumno.reinscripcion-grupoPost') }}" method="POST" accept-charset="UTF-8">
                              {{ csrf_field() }}
                              @if(isset($optativas))
                                 <div class="panel panel-default">
                                    <div class="panel-heading">
                                       <div class="center title">
                                          <h3>Optativas</h3>
                                          <h4>
                                             @if ($area == 1 || $area == 2)
                                                Elige una opción:
                                             @elseif ($area == 3 || $area == 4)
                                                Elige dos opciones:
                                             @endif
                                          </h4>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="optativas">
                                    @foreach ($optativas as $key => $optativa)
                                       <div class="row">
                                          <input type="checkbox" id="optativas" name="optativas[]" value={{$optativa['clv']}}> {!!$optativa['nombre']!!}
                                       </div>
                                    @endforeach
                                 </div>
                                 @endif
                                 @if(!isset($optativas))
                                    @if(isset($area))
                                       <input type="hidden" name="area" value="{{$area}}">
                                    @endif
                                 <div class="grado">
                                     <div class="row-grado">
                                        <a class="btn btn-blue flex-item" href="{{route("alumno.reinscripcion")}}" role="button">Regresar</a>
                                     </div>
                                     <div class="row-grado">
                                        <input type="hidden" name="grup" value="{{$clv_grupo}}">
                                        <input type="submit" name="grupo" class="btn-blue flex-item" value="Inscribe grupo y optativas">
                                     </div>
                                 </div>
                                 @endif

                           </form>
                        @endif
               </div>
            </div>
         </div>
      </div>

   </div>
@endsection
