@extends('layouts.app')
@section('add_css')
  <link href="{{ asset ('css/estilo_content.css') }}" rel="stylesheet">
  <link href="{{ asset ('css/style.css') }}" rel="stylesheet">
  <link href="{{ asset ('css/ihover.css') }}" rel="stylesheet">
@endsection
@section('content')
  <div class="container-steps">
    <div class="name_user">
      <h2>Bienvenid@: {{Auth::User()->nombre_completo(Auth::id())}}</h2>
      <h3>{{Auth::User()->num_cta}}</h3>
    </div>
    <div class="mensaje">
      @if (Session::has('message'))
          <div class="alert {{ Session::get('alert-class', 'alert-info') }}">{!! Session::get('message') !!}</div>
          {{-- <div class="">
             <a href="{{ route('reporte.datosAlumno', ['alumno' => Auth::User()->id]) }}">
              <div class="img"><img src="{{ asset ('images/datos_personales.png') }}" alt="img"></div>
              <div class="info">
                <h3>Actualizar Datos Personales</h3>
              </div>
            </a>
          </div> --}}
      @endif
    </div>
      <div class="row">
        <div class="grid_3">
          <div class="ih-item circle effect2 left_to_right">
            <a href="{{ url("alumno/aviso-privacidad") }}">
              <div class="img"><img src="{{ asset ('images/datos_personales.png') }}" alt="img"></div>
              <div class="info">
                <h3>Actualizar Datos Personales</h3>
              </div>
            </a>
          </div>
        </div>
        <div class="grid_3">
          <div class="ih-item circle effect2 left_to_right">
            <a href="{{ url("alumno/consulta/grado") }}">
              <div class="img"><img src="{{ asset ('images/grupos.png') }}" alt="img"></div>
              <div class="info">
                <h3>Consulta Grupos</h3>
              </div>
            </a>
          </div>
        </div>
        <div class="grid_3">
          <div class="ih-item circle effect2 left_to_right">
            <a href="{{ url("alumno/".Auth::id()."/turno-reinscripcion") }}">
              <div class="img"><img src="{{ asset ('images/turno.png') }}" alt="img"></div>
              <div class="info">
                  <h3>Consulta Turno de Reinscripción</h3>
              </div>
            </a>
          </div>
        </div>
        <div class="grid_3">
          <div class="ih-item circle effect2 left_to_right">
            <a href="{{route('alumno.showReinscripcion', ['alumno' => Auth::User()->id])}}">
              <div class="img"><img src="{{ asset ('images/reinscripcion.png') }}" alt="img"></div>
              <div class="info">
                <h3>Reinscripción</h3>
              </div>
            </a>
          </div>
        </div>
      </div>
  </div>
@endsection
