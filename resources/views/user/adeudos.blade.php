@extends('layouts.appUser')
@section('add_css')
  <link href="{{ asset ('css/estilo_content.css') }}" rel="stylesheet">
@endsection
@section('content')
  <div class="content_turn">
    <div class="name_user">
      <h3>Adeudo(s) de Material</h3>
    </div>
    <div class="title">
        <h3>Adeudo(s) de Material</h3>
    </div>
    {{-- {{dd($adeudos)}} --}}
    @if (!empty($adeudos))
      <div class="adeudo">
          <table>
            <tr class="encabezado">
              <th>Área</th>
              <th>Tipo de material</th>
              <th>Fecha de incidente</th>
            </tr>
            @foreach ($adeudos as $value)

                 @if (key($value) == 1)
                    <tr class="">
                        <td class="area">{!!$value[1][0]!!}</td>
                        <td>LIBRO <br>TÍTULO: {!!$value[1][1]!!} <br>AUTOR: {!!$value[1][2]!!}</td>
                        <td class="fecha-incidente">{!!$value[1][3]!!}</td>
                    </tr>
                 @elseif (key($value) == 2)
                    <tr class="">
                      <td class="area">{!!$value[2][0]!!}</td>
                      <td>{!!$value[2][1]!!}</td>
                      <td class="fecha-incidente">{!!$value[2][2]!!}</td>
                    </tr>
                 @elseif (key($value) == 3)
                    <tr class="">
                      <td class="area">{!!$value[3][0]!!}</td>
                      <td>{!!$value[3][1]!!}</td>
                      <td class="fecha-incidente">{!!$value[3][2]!!}</td>
                    </tr>
                 @endif
            @endforeach
          </table>

      </div>
   @else
      <div class="msj-adeudo">
          <span>{{$mensaje}}</span>
      </div>
   @endif

  </div>

@endsection
