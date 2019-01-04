@extends('layouts.app')
@section('add_css')
  <link href="{{ asset ('css/estilo_content.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="container table-grupo">
        <div class="name_user">
           <h2>Bienvenid@: {{Auth::User()->nombre_completo(Auth::id())}}</h2>
           <h3>{{Auth::User()->num_cta}}</h3>
        </div>
        <h3>Grupo:
            @if (isset($dato->clv_grupo))
               {{$dato->clv_grupo}}
            @else
               {{$dato}}
            @endif
        </h3>

        <div class="msj">
           <div><p class="obligatorio">*</p><p>Los horarios se encuentran sujetos a cambios sin previo aviso.</p></div>
        </div>
        <div class="colores">
           @foreach ($infografia as $value)
              {!!$value!!}
           @endforeach
        </div>
        <table class="table">
            <thead class="">
                <tr class="">
                    <th scope="col">HORA</th>
                    <th scope="col">LUNES</th>
                    <th scope="col">MARTES</th>
                    <th scope="col">MIERCOLES</th>
                    <th scope="col">JUEVES</th>
                    <th scope="col">VIERNES</th>
                </tr>
            </thead>
            <tbody>
              @for ($i=0; $i < count($horario); $i++)
                 <tr class="">
                    @for ($j=0; $j < 6; $j++)
                        @if ($j==0)
                            <th>
                                {!!$horario[$i][$j]!!}
                            </th>
                        @else
                            <td>
                                {!!$horario[$i][$j]!!}
                            </td>
                        @endif

                    @endfor
                 </tr>
              @endfor
              {{-- @foreach ($horario as $value)
                  {{-- {!!$horario[$i][$j]!!} --}}
                  {{-- {!!$value!!} --}}
              {{-- @endforeach --}}
            </tbody>
        </table>
        <div class="">

        </div>
        <div class="grado">
            <div class="row-grado">
                <a class="btn btn-blue flex-item" href="{{route("alumno.grados")}}" role="button">Regresar</a>
            </div>
        </div>
    </div>
@endsection
