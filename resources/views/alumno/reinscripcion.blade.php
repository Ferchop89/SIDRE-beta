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
    @if(Session::has('message'))
       <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
    @endif
    <div class="title">
        <h3>Tu turno de reinscripción es el día:</h3>
    </div>
    <div class="turno">
      {{-- {{dd($alumno->fecha_reinscripcion)}} --}}
      @if ($fecha!=null)
         <h2>{{$fecha}}</h2>
         <h3>a las</h3>
         <h2>{{$hora}}</h2>
      @else
         <h2>Ponte en contacto con asuntos escolares para que te asignen un turno de reinscripción</h2>
      @endif

        <p>Recuerda ingresar en el horario indicado, de lo contrario tu cuenta puede ser bloqueda y no podras concluir el proceso de reinscripción.</p>
        {{-- <form class="" id="formulario_consulta" name="form-data" action="{{ route('alumno.postGrupos') }}" method="POST" accept-charset="UTF-8"> --}}

        <form name="form-data" action="{{route('alumno.postReinscripcion', Auth::user()->id)}}" method="POST" accept-charset="UTF-8">
           {{ csrf_field() }}
           <div class="grado">
               <div class="row-grado">
                   <a class="btn btn-blue flex-item" href="{{route("alumno.pasos")}}" role="button">Regresar</a>
               </div>
               <div class="row-grado">
                    <button type="submit" name="btnComenzar" class="btn-blue flex-item" {{date('H:i')<=$hora ? 'disabled=disabled' : '' }} >Comenzar</button>
                    {{-- {{dd(date('H:i')>=$hora)}} --}}
               </div>
           </div>
        </form>

    </div>
  </div>
@endsection
