@extends('layouts.app')
@section('add_css')
  <link href="{{ asset ('css/estilo_content.css') }}" rel="stylesheet">
@endsection
@section('content')
  <div class="container">
    <div class="name_user">
      <h2>Bienvenid@: {{Auth::User()->nombre_completo(Auth::id())}}</h2>
      <h3>{{Auth::User()->num_cta}}</h3>
    </div>
    <div class="title">
        <h3>Fin de reinscripción</h3>
    </div>
    <div class="reinscripcion center">
      <span>
         <p>¡Felicidades! Te haz inscrito en el grupo {{$grupo}}</p>
         @if ($seccion != null)
            <p> en la sección {{$seccion->clv_grupo}}</p>
         @endif
      </span>
    </div>
    <div class="grado">
        <div class="row-grado">
           <a class="btn btn-blue flex-item" href="{{ route('logout') }} "onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">Terminar</a>
        </div>
        <div class="row-grado">
           <a class="btn btn-blue flex-item" href="{{route('reporte.comprobanteReinscripcion', ['alumno' => Auth::User()->id])}}" >Imprimir Comprobante</a>
        </div>
   </div>
  </div>
@endsection
