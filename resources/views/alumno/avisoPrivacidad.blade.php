@extends('layouts.app')
@section('add_css')
  <link href="{{ asset ('css/estilo_content.css') }}" rel="stylesheet">
@endsection
@section('content')
   <div class="container">
   {{-- <div class="content_turn"> --}}
      <div class="name_user">
         <h2>Bienvenid@: {{Auth::User()->nombre_completo(Auth::id())}}</h2>
         <h3>{{Auth::User()->num_cta}}</h3>
      </div>
      <div class="title">
         <h3>Actualización de datos personales</h3>
      </div>
      <div class="aviso-privacidad">
         <p>La siguiente información es de suma importancia, por lo que te solicitamos que llenes el siguiente formulario con franqueza. Algún día podríamos necesitar esta información. </p>
         <p>Puedes consultar nuestro aviso de privacidad en nuestra página de internet.</p>
      </div>
      <div class="aviso btn-a">
         <div class="btn-izq row-grado">
            <a class="btn btn-blue flex-item" href="{{route("alumno.pasos")}}" role="button">Regresar</a>
         </div>
         <div class="btn-der">
            <a class="btn btn-blue flex-item" href="{{ url("alumno/".Auth::id()."/actualizacion") }}">Continuar</a>
         </div>
      </div>
   </div>
@endsection
