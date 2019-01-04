@extends('layouts.app')
@section('add_css')
  <link href="{{ asset ('css/estilo_content.css') }}" rel="stylesheet">
  <script src="{{ asset ('js/acordeon.js') }}" type="text/javascript"></script>
  <script src="{{ asset ('js/extranjeros.js') }}" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
@endsection
@section('content')
  <div class="name_user">
    <h2>Bienvenid@: {{Auth::User()->nombre_completo(Auth::id())}}</h2>
    <h3>{{Auth::User()->num_cta}}</h3>
  </div>
  <div class="title">
    <h3>Actualización de datos personales</h3>
  </div>
  <div class="sixteen columns top-1 bottom-3 bordeado">
    <p> Completa el formulario para iniciar el proceso de reinscripción.</p>
    <form class="" id="formulario_uno" name="form-data" action="{{ url("alumno/".Auth::id()) }}" method="POST" accept-charset="UTF-8">
      {{ csrf_field() }}
      <div id="accordion">
         <h3 class="help-block">
            @if ( $errors->has('apellido_pat_alumno') ||
            $errors->has('apellido_mat_alumno') ||
            $errors->has('nombre_alumno') ||
            $errors->has('fecha_nac') ||
            $errors->has('curp_alumno') ||
            $errors->has('genero') ||
            $errors->has('peso') ||
            $errors->has('estatura') ||
            $errors->has('nacionalidad') ||
            $errors->has('lugar_nac') ||
            $errors->has('escuela_proce'))
                Datos Personales: <strong>{{ " Existen errores en este apartado"}}</strong>
           @else
              Datos Personales
            @endif
         </h3>
        <div class="caja">
         <div class="info" id="datosPersonales">

            <div class="form-group{{ $errors->has('apellido_pat_alumno') ? ' has-error' : '' }}">
              <label for="apellido_pat_alumno" class="col-md-4">Apellido Paterno:</label>
			      <input type="text" name="apellido_pat_alumno" id="apellido_pat_alumno" class="form-control" value="{{ old('apellido_pat_alumno', $alumno->datos_personales_alumnos->app) }}" placeholder="Apellido Paterno" autocomplete="off" maxlength="40" readonly="readonly" onKeyUp="this.value=this.value.toUpperCase();">
				   @if ($errors->has('apellido_pat_alumno'))
               <span class="help-block">
                  <strong>{{ $errors->first('apellido_pat_alumno') }}</strong>
				   </span>
				   @endif
			   </div>

            <div class="form-group{{ $errors->has('apellido_mat_alumno') ? ' has-error' : '' }}">
              <label for="apellido_mat_alumno" class="col-md-4">Apellido Materno:</label>
              <input type="text" name="apellido_mat_alumno" id="apellido_mat_alumno" class="form-control" value="{{ old('apellido_mat_alumno', $alumno->datos_personales_alumnos->apm) }}" placeholder="Apellido Materno" autocomplete="off" maxlength="40" readonly="readonly" onKeyUp="this.value=this.value.toUpperCase();">
              @if ($errors->has('apellido_mat_alumno'))
                <span class="help-block">
                  <strong>{{ $errors->first('apellido_mat_alumno') }}</strong>
                </span>
              @endif
            </div>

            <div class="form-group{{ $errors->has('nombre_alumno') ? ' has-error' : '' }}">
              <label for="nombre_alumno" class="col-md-4">Nombre(s):</label>
              <input type="text" name="nombre_alumno" id="nombre_alumno" class="form-control" value="{{ old('nombre_alumno', $alumno->datos_personales_alumnos->nombre) }}" placeholder="Nombre(s)" autocomplete="off" maxlength="60" readonly="readonly" onKeyUp="this.value=this.value.toUpperCase();">
              @if ($errors->has('nombre_alumno'))
                <span class="help-block">
                  <strong>{{ $errors->first('nombre_alumno') }}</strong>
                </span>
              @endif
            </div>

            <div class="form-group{{ $errors->has('fecha_nac') ? ' has-error' : '' }}">
              <label for="fecha_nac" class="col-md-4">Fecha de Nacimiento:<p class="obligatorio">*</p></label></label>
              <input type="date" name="fecha_nac" id="fecha_nac" class="form-control" value="{{ old('fecha_nac', $alumno->datos_personales_alumnos->fecha_nac->format('Y-m-d')) }}" autocomplete="off" @if ($errors->has('fecha_nac')) autofocus @endif>
              @if ($errors->has('fecha_nac'))
                <span class="help-block">
                  <strong>{{ $errors->first('fecha_nac') }}</strong>
                </span>
              @endif
            </div>

            <div class="form-group{{ $errors->has('genero') ? ' has-error' : '' }}">
               <label for="genero" class="col-md-4">Género:<p class="obligatorio">*</p></label>
               <select name="genero" id="genero" class="form-control" autocomplete="off" @if ($errors->has('genero')) autofocus @endif>
                  <option value="" selected>Selecciona una opción</option>
                  <option value="F" {{ old('genero') == 'F' ? 'selected':'' }} @if ($alumno->datos_personales_alumnos->sexo == 'F') selected @endif>FEMENINO</option>
                  <option value="M" {{ old('genero') == 'M' ? 'selected':'' }} @if ($alumno->datos_personales_alumnos->sexo == 'M') selected @endif>MASCULINO</option>
               </select>
               @if ($errors->has('genero'))
                  <span class="help-block">
                     <strong>{{ $errors->first('genero') }}</strong>
                  </span>
               @endif
            </div>

            <div class="form-group{{ $errors->has('peso') ? ' has-error' : '' }}">
              <label for="peso" class="col-md-4">Peso:<p class="obligatorio">*</p></label>
              <input type="text" name="peso" id="peso" class="form-control" placeholder="Peso en Kg. (Ej. 75.8)" value="{{ old('peso', $alumno->datos_personales_alumnos->peso) }}" autocomplete="off" maxlength="6" @if ($errors->has('peso')) autofocus @endif>
              @if ($errors->has('peso'))
                <span class="help-block">
                  <strong>{{ $errors->first('peso') }}</strong>
                </span>
              @endif
            </div>

            <div class="form-group{{ $errors->has('estatura') ? ' has-error' : '' }}">
              <label for="estatura" class="col-md-4">Estatura:<p class="obligatorio">*</p></label>
              <input type="text" name="estatura" id="estatura" class="form-control" placeholder="Estatura en m. (Ej. 1.64)" value="{{ old('estatura', $alumno->datos_personales_alumnos->estatura) }}" autocomplete="off" maxlength="5" @if ($errors->has('estatura')) autofocus @endif>
              @if ($errors->has('estatura'))
                <span class="help-block">
                  <strong>{{ $errors->first('estatura') }}</strong>
                </span>
              @endif
            </div>

            <div class="form-group{{ $errors->has('nacionalidad') ? ' has-error' : '' }}">
              <label for="nacionalidad" class="col-md-4">Nacionalidad:<p class="obligatorio">*</p></label>
              <select name="nacionalidad" id="nacionalidad" class="form-control" autocomplete="off" @if ($errors->has('nacionalidad')) autofocus @endif>
                  <option value="">Selecciona una opción</option>
                  <option value="M" {{ old('nacionalidad') == 'M' ? 'selected':'' }} @if ($alumno->datos_personales_alumnos->nacionalidad == 'M') selected @endif>MEXICANA</option>
                  <option value="E" {{ old('nacionalidad') == 'E' ? 'selected':'' }} @if ($alumno->datos_personales_alumnos->nacionalidad == 'E') selected @endif>EXTRANJERA</option>
              </select>
              {{-- <select name="nacionalidad" id="nacionalidad" class="form-control" @if ($errors->has('nacionalidad')) autofocus @endif>
                  <option value="">Selecciona una opción</option>
                  <option value="M" @if (old('nacionalidad', $alumno->datos_personales_alumnos->nacionalidad) == 'M') {{ 'selected' }} @endif>MEXICANA</option>
                  <option value="E" @if (old('nacionalidad', $alumno->datos_personales_alumnos->nacionalidad) == 'E') {{ 'selected' }} @endif>EXTRANJERA</option>
                  <option value="M" @if(old('nacionalidad', $alumno->datos_personales_alumnos->nacionalidad) == 'M')selected @endif>MEXICANA</option>
                  <option value="E" @if(old('nacionalidad', $alumno->datos_personales_alumnos->nacionalidad) == 'E')selected @endif>EXTRANJERA</option>
              </select> --}}


              {{-- <select name="gender" class="form-control" id="gender">
                 <option value="">Select Gender</option>
                 <option value="M" @if (old('gender') == "M") {{ 'selected' }} @endif>Male</option>
                 <option value="F" @if (old('gender') == "F") {{ 'selected' }} @endif>Female</option>
             </select> --}}


               @if ($errors->has('nacionalidad'))
                  <span class="help-block">
                     <strong>{{ $errors->first('nacionalidad') }}</strong>
                  </span>
               @endif
            </div>

            <div class="form-group{{ $errors->has('lugar_nac') ? ' has-error' : '' }}">
               <label for="lugar_nac" class="col-md-4">Lugar de Nacimiento:</label>
               {{-- <input type="text" name="estado" id="estado" class="form-control" placeholder="Entidad Federativa" value="" autocomplete="off" maxlength="70"> --}}
               <select name="lugar_nac" id="lugar_nac" class="form-control" autocomplete="off" @if ($errors->has('lugar_nac')) autofocus @endif>
                  <option value="" selected>Selecciona una opción</option>}
                  <option value="AGUASCALIENTES" {{ old('lugar_nac') == 'AGUASCALIENTES' ? 'selected':'' }} @if ($alumno->datos_personales_alumnos->lugar_nac == 'AGUASCALIENTES') selected @endif>AGUASCALIENTES</option>
                  <option value="BAJA CALIFORNIA" {{ old('lugar_nac') == 'BAJA CALIFORNIA' ? 'selected':'' }} @if ($alumno->datos_personales_alumnos->lugar_nac == 'BAJA CALIFORNIA') selected @endif>BAJA CALIFORNIA</option>
                  <option value="BAJA CALIFORNIA SUR" {{ old('lugar_nac') == 'BAJA CALIFORNIA SUR' ? 'selected':'' }} @if ($alumno->datos_personales_alumnos->lugar_nac == 'BAJA CALIFORNIA SUR') selected @endif>BAJA CALIFORNIA SUR</option>
                  <option value="CAMPECHE" {{ old('lugar_nac') == 'CAMPECHE' ? 'selected':'' }} @if ($alumno->datos_personales_alumnos->lugar_nac == 'CAMPECHE') selected @endif>CAMPECHE</option>
                  <option value="CHIAPAS" {{ old('lugar_nac') == 'CHIAPAS' ? 'selected':'' }} @if ($alumno->datos_personales_alumnos->lugar_nac == 'CHIAPAS') selected @endif>CHIAPAS</option>
                  <option value="CHIHUAHUA" {{ old('lugar_nac') == 'CHIHUAHUA' ? 'selected':'' }} @if ($alumno->datos_personales_alumnos->lugar_nac == 'CHIHUAHUA') selected @endif>CHIHUAHUA</option>
                  <option value="COAHUILA DE ZARAGOZA" {{ old('lugar_nac') == 'COAHUILA DE ZARAGOZA' ? 'selected':'' }} @if ($alumno->datos_personales_alumnos->lugar_nac == 'COAHUILA DE ZARAGOZA') selected @endif>COAHUILA DE ZARAGOZA</option>
                  <option value="COLIMA" {{ old('lugar_nac') == 'COLIMA' ? 'selected':'' }} @if ($alumno->datos_personales_alumnos->lugar_nac == 'COLIMA') selected @endif>COLIMA</option>
                  <option value="DISTRITO FEDERAL" {{ old('lugar_nac') == 'DISTRITO FEDERAL' ? 'selected':'' }} @if ($alumno->datos_personales_alumnos->lugar_nac == 'DISTRITO FEDERAL') selected @endif>DISTRITO FEDERAL</option>
                  <option value="DURANGO" {{ old('lugar_nac') == 'DURANGO' ? 'selected':'' }} @if ($alumno->datos_personales_alumnos->lugar_nac == 'DURANGO') selected @endif>DURANGO</option>
                  <option value="GUANAJUATO" {{ old('lugar_nac') == 'GUANAJUATO' ? 'selected':'' }} @if ($alumno->datos_personales_alumnos->lugar_nac == 'GUANAJUATO') selected @endif>GUANAJUATO</option>
                  <option value="GUERRERO" {{ old('lugar_nac') == 'GUERRERO' ? 'selected':'' }} @if ($alumno->datos_personales_alumnos->lugar_nac == 'GUERRERO') selected @endif>GUERRERO</option>
                  <option value="HIDALGO" {{ old('lugar_nac') == 'HIDALGO' ? 'selected':'' }} @if ($alumno->datos_personales_alumnos->lugar_nac == 'HIDALGO') selected @endif>HIDALGO</option>
                  <option value="JALISCO" {{ old('lugar_nac') == 'JALISCO' ? 'selected':'' }} @if ($alumno->datos_personales_alumnos->lugar_nac == 'JALISCO') selected @endif>JALISCO</option>
                  <option value="ESTADO DE MEXICO" {{ old('lugar_nac') == 'ESTADO DE MEXICO' ? 'selected':'' }} @if ($alumno->datos_personales_alumnos->lugar_nac == 'ESTADO DE MEXICO') selected @endif>ESTADO DE MEXICO</option>
                  <option value="MICHOACAN DE OCAMPO" {{ old('lugar_nac') == 'MICHOACAN DE OCAMPO' ? 'selected':'' }} @if ($alumno->datos_personales_alumnos->lugar_nac == 'MICHOACAN DE OCAMPO') selected @endif>MICHOACAN DE OCAMPO</option>
                  <option value="MORELOS" {{ old('lugar_nac') == 'MORELOS' ? 'selected':'' }} @if ($alumno->datos_personales_alumnos->lugar_nac == 'MORELOS') selected @endif>MORELOS</option>
                  <option value="NAYARIT" {{ old('lugar_nac') == 'NAYARIT' ? 'selected':'' }} @if ($alumno->datos_personales_alumnos->lugar_nac == 'NAYARIT') selected @endif>NAYARIT</option>
                  <option value="NUEVO LEON" {{ old('lugar_nac') == 'NUEVO LEON' ? 'selected':'' }} @if ($alumno->datos_personales_alumnos->lugar_nac == 'NUEVO LEON') selected @endif>NUEVO LEON</option>
                  <option value="OAXACA" {{ old('lugar_nac') == 'OAXACA' ? 'selected':'' }} @if ($alumno->datos_personales_alumnos->lugar_nac == 'OAXACA') selected @endif>OAXACA</option>
                  <option value="PUEBLA" {{ old('lugar_nac') == 'PUEBLA' ? 'selected':'' }} @if ($alumno->datos_personales_alumnos->lugar_nac == 'PUEBLA') selected @endif>PUEBLA</option>
                  <option value="QUERETARO" {{ old('lugar_nac') == 'QUERETARO' ? 'selected':'' }} @if ($alumno->datos_personales_alumnos->lugar_nac == 'QUERETARO') selected @endif>QUERETARO</option>
                  <option value="QUINTANA ROO" {{ old('lugar_nac') == 'QUINTANA ROO' ? 'selected':'' }} @if ($alumno->datos_personales_alumnos->lugar_nac == 'QUINTANA ROO') selected @endif>QUINTANA ROO</option>
                  <option value="SAN LUIS POTOSI" {{ old('lugar_nac') == 'SAN LUIS POTOSI' ? 'selected':'' }} @if ($alumno->datos_personales_alumnos->lugar_nac == 'SAN LUIS POTOSI') selected @endif>SAN LUIS POTOSI</option>
                  <option value="SINALOA" {{ old('lugar_nac') == 'SINALOA' ? 'selected':'' }} @if ($alumno->datos_personales_alumnos->lugar_nac == 'SINALOA') selected @endif>SINALOA</option>
                  <option value="SONORA" {{ old('lugar_nac') == 'SONORA' ? 'selected':'' }} @if ($alumno->datos_personales_alumnos->lugar_nac == 'SONORA') selected @endif>SONORA</option>
                  <option value="TABASCO" {{ old('lugar_nac') == 'TABASCO' ? 'selected':'' }} @if ($alumno->datos_personales_alumnos->lugar_nac == 'TABASCO') selected @endif>TABASCO</option>
                  <option value="TAMAULIPAS" {{ old('lugar_nac') == 'TAMAULIPAS' ? 'selected':'' }} @if ($alumno->datos_personales_alumnos->lugar_nac == 'TAMAULIPAS') selected @endif>TAMAULIPAS</option>
                  <option value="TLAXCALA" {{ old('lugar_nac') == 'TLAXCALA' ? 'selected':'' }} @if ($alumno->datos_personales_alumnos->lugar_nac == 'TLAXCALA') selected @endif>TLAXCALA</option>
                  <option value="VERACRUZ DE IGNACIO DE LA LLAVE" {{ old('lugar_nac') == 'VERACRUZ DE IGNACIO DE LA LLAVE' ? 'selected':'' }} @if ($alumno->datos_personales_alumnos->lugar_nac == 'VERACRUZ DE IGNACIO DE LA LLAVE') selected @endif>VERACRUZ DE IGNACIO DE LA LLAVE</option>
                  <option value="YUCATAN" {{ old('lugar_nac') == 'YUCATAN' ? 'selected':'' }} @if ($alumno->datos_personales_alumnos->lugar_nac == 'YUCATAN') selected @endif>YUCATAN</option>
                  <option value="ZACATECAS" {{ old('lugar_nac') == 'ZACATECAS' ? 'selected':'' }} @if ($alumno->datos_personales_alumnos->lugar_nac == 'ZACATECAS') selected @endif>ZACATECAS</option>
              </select>
               @if ($errors->has('lugar_nac'))
                  <span class="help-block">
                    <strong>{{ $errors->first('lugar_nac') }}</strong>
                  </span>
               @endif
               <input name="nacionalidadExt" class="typeahead form-control" type="text" placeholder="País extranjero." value="{{ old('nacionalidadExt', $alumno->datos_personales_alumnos->lugar_nac) }}" autocomplete="off" maxlength="100" onKeyUp="this.value=this.value.toUpperCase();">
            </div>

            <div class="CURP form-group{{ $errors->has('curp_alumno') ? ' has-error' : '' }}">
             <label for="curp_alumno" class="col-md-4">CURP:
                 {{-- <p class="obligatorio">*</p> --}}
             </label>
             <input type="text" name="curp_alumno" id="curp_alumno" class="form-control" placeholder="CURP 18 caracteres" value="{{ old('curp_alumno', $alumno->datos_personales_alumnos->curp) }}" autocomplete="off" maxlength="18" onKeyUp="this.value=this.value.toUpperCase();"  @if ($errors->has('curp_alumno')) autofocus @endif>
             @if ($errors->has('curp_alumno'))
                <span class="help-block">
                  <strong>{{ $errors->first('curp_alumno') }}</strong>
                </span>
             @endif
            </div>

            <div class="form-group{{ $errors->has('escuela_proce') ? ' has-error' : '' }}">
              <label for="escuela_proce" class="col-md-4">Escuela de Procedencia:<p class="obligatorio">*</p></label>
              <input type="text" name="escuela_proce" id="escuela_proce" class="form-control" placeholder="Escuela de procedencia." value="{{ old('escuela_proce', $alumno->datos_academicos->esc_procedencia) }}" autocomplete="off" maxlength="100" onKeyUp="this.value=this.value.toUpperCase();" @if ($errors->has('escuela_proce')) autofocus @endif>
              @if ($errors->has('escuela_proce'))
                <span class="help-block">
                  <strong>{{ $errors->first('escuela_proce') }}</strong>
                </span>
              @endif
            </div>
         </div>
        </div>
        <h3 class="help-block">
           @if ( $errors->has('cp') ||
           $errors->has('calle_numero') ||
           $errors->has('colonia') ||
           $errors->has('del_mun') ||
           $errors->has('estado') ||
           $errors->has('tel_casa_alumno') ||
           $errors->has('tel_celular_alumno') ||
           $errors->has('correo'))
               Domicilio: <strong>{{ " Existen errores en este apartado"}}</strong>
          @else
             Domicilio
           @endif
        </h3>
        <div class="caja">
            <div class="info" id="datosDomicilio">

               <div class="form-group{{ $errors->has('cp') ? ' has-error' : '' }}">
                  <label for="cp" class="col-md-4">Código Postal:<p class="obligatorio">*</p></label>
                  <input type="text" name="cp" id="cp" class="form-control" placeholder="Código Postal" value="{{ old('cp', $alumno->domicilio_alumnos->cp) }}" @if ($errors->has('cp')) autofocus @endif autocomplete="off" maxlength="5">
                  @if ($errors->has('cp'))
                     <span class="help-block">
                       <strong>{{ $errors->first('cp') }}</strong>
                     </span>
                  @endif
               </div>

               <div class="form-group{{ $errors->has('calle_numero') ? ' has-error' : '' }}">
                  <label for="calle_numero" class="col-md-4">Calle y Número:<p class="obligatorio">*</p></label>
                  <input type="text" name="calle_numero" id="calle_numero" class="form-control" placeholder="Calle y Número" value="{{ old('calle_numero', $alumno->domicilio_alumnos->calle_cnum) }}" maxlength="100" onKeyUp="this.value=this.value.toUpperCase();" @if ($errors->has('calle_numero')) autofocus @endif autocomplete="off">
                  @if ($errors->has('calle_numero'))
                  <span class="help-block">
                    <strong>{{ $errors->first('calle_numero') }}</strong>
                  </span>
                  @endif
               </div>

               <div class="form-group{{ $errors->has('colonia') ? ' has-error' : '' }}">
                  <label for="colonia" class="col-md-4">Colonia:<p class="obligatorio">*</p></label>
                  <input type="text" name="colonia" id="colonia" class="form-control" placeholder="Colonia" value="{{ old('colonia', $alumno->domicilio_alumnos->colonia) }}" autocomplete="off" maxlength="60" onKeyUp="this.value=this.value.toUpperCase();" @if ($errors->has('colonia')) autofocus @endif>
                  @if ($errors->has('colonia'))
                  <span class="help-block">
                    <strong>{{ $errors->first('colonia') }}</strong>
                  </span>
                  @endif
               </div>

               <div class="form-group{{ $errors->has('del_mun') ? ' has-error' : '' }}">
                  <label for="del_mun" class="col-md-4">Delegación o Municipio:<p class="obligatorio">*</p></label>
                  <input type="text" name="del_mun" id="del_mun" class="form-control" placeholder="Delegación/Municipio" value="{{ old('del_mun', $alumno->domicilio_alumnos->del_mun) }}" autocomplete="off" maxlength="50" onKeyUp="this.value=this.value.toUpperCase();" @if ($errors->has('del_mun')) autofocus @endif>
                  @if ($errors->has('del_mun'))
                  <span class="help-block">
                    <strong>{{ $errors->first('del_mun') }}</strong>
                  </span>
                  @endif
               </div>

               <div class="form-group{{ $errors->has('estado') ? ' has-error' : '' }}">
                  <label for="estado" class="col-md-4">Estado:<p class="obligatorio">*</p></label>
                  <select name="estado" id="estado" class="form-control" autocomplete="off" @if ($errors->has('estado')) autofocus @endif>
                     <option value="" selected>Selecciona una opción</option>
                     <option value="AGUASCALIENTES" {{ old('estado') == 'AGUASCALIENTES' ? 'selected':'' }} @if ($alumno->domicilio_alumnos->estado == 'AGUASCALIENTES') selected @endif>AGUASCALIENTES</option>
                     <option value="BAJA CALIFORNIA" {{ old('estado') == 'BAJA CALIFORNIA' ? 'selected':'' }} @if ($alumno->domicilio_alumnos->estado == 'BAJA CALIFORNIA') selected @endif>BAJA CALIFORNIA</option>
                     <option value="BAJA CALIFORNIA SUR" {{ old('estado') == 'BAJA CALIFORNIA SUR' ? 'selected':'' }} @if ($alumno->domicilio_alumnos->estado == 'BAJA CALIFORNIA SUR') selected @endif>BAJA CALIFORNIA SUR</option>
                     <option value="CAMPECHE" {{ old('estado') == 'CAMPECHE' ? 'selected':'' }} @if ($alumno->domicilio_alumnos->estado == 'CAMPECHE') selected @endif>CAMPECHE</option>
                     <option value="CHIAPAS" {{ old('estado') == 'CHIAPAS' ? 'selected':'' }} @if ($alumno->domicilio_alumnos->estado == 'CHIAPAS') selected @endif>CHIAPAS</option>
                     <option value="CIUDAD DE MEXICO" {{ old('estado') == 'CIUDAD DE MEXICO' ? 'selected':'' }} @if ($alumno->domicilio_alumnos->estado == 'CIUDAD DE MEXICO') selected @endif>CIUDAD DE MEXICO</option>
                     <option value="CHIHUAHUA" {{ old('estado') == 'CHIHUAHUA' ? 'selected':'' }} @if ($alumno->domicilio_alumnos->estado == 'CHIHUAHUA') selected @endif>CHIHUAHUA</option>
                     <option value="COAHUILA DE ZARAGOZA" {{ old('estado') == 'COAHUILA DE ZARAGOZA' ? 'selected':'' }} @if ($alumno->domicilio_alumnos->estado == 'COAHUILA DE ZARAGOZA') selected @endif>COAHUILA DE ZARAGOZA</option>
                     <option value="COLIMA" {{ old('estado') == 'COLIMA' ? 'selected':'' }} @if ($alumno->domicilio_alumnos->estado == 'COLIMA') selected @endif>COLIMA</option>
                     <option value="DURANGO" {{ old('estado') == 'DURANGO' ? 'selected':'' }} @if ($alumno->domicilio_alumnos->estado == 'DURANGO') selected @endif>DURANGO</option>
                     <option value="GUANAJUATO" {{ old('estado') == 'GUANAJUATO' ? 'selected':'' }} @if ($alumno->domicilio_alumnos->estado == 'GUANAJUATO') selected @endif>GUANAJUATO</option>
                     <option value="GUERRERO" {{ old('estado') == 'GUERRERO' ? 'selected':'' }} @if ($alumno->domicilio_alumnos->estado == 'GUERRERO') selected @endif>GUERRERO</option>
                     <option value="HIDALGO" {{ old('estado') == 'HIDALGO' ? 'selected':'' }} @if ($alumno->domicilio_alumnos->estado == 'HIDALGO') selected @endif>HIDALGO</option>
                     <option value="JALISCO" {{ old('estado') == 'JALISCO' ? 'selected':'' }} @if ($alumno->domicilio_alumnos->estado == 'JALISCO') selected @endif>JALISCO</option>
                     <option value="ESTADO DE MEXICO" {{ old('estado') == 'ESTADO DE MEXICO' ? 'selected':'' }} @if ($alumno->domicilio_alumnos->estado == 'ESTADO DE MEXICO') selected @endif>ESTADO DE MEXICO</option>
                     <option value="MICHOACAN DE OCAMPO" {{ old('estado') == 'MICHOACAN DE OCAMPO' ? 'selected':'' }} @if ($alumno->domicilio_alumnos->estado == 'MICHOACAN DE OCAMPO') selected @endif>MICHOACAN DE OCAMPO</option>
                     <option value="MORELOS" {{ old('estado') == 'MORELOS' ? 'selected':'' }} @if ($alumno->domicilio_alumnos->estado == 'MORELOS') selected @endif>MORELOS</option>
                     <option value="NAYARIT" {{ old('estado') == 'NAYARIT' ? 'selected':'' }} @if ($alumno->domicilio_alumnos->estado == 'NAYARIT') selected @endif>NAYARIT</option>
                     <option value="NUEVO LEON" {{ old('estado') == 'NUEVO LEON' ? 'selected':'' }} @if ($alumno->domicilio_alumnos->estado == 'NUEVO LEON') selected @endif>NUEVO LEON</option>
                     <option value="OAXACA" {{ old('estado') == 'OAXACA' ? 'selected':'' }} @if ($alumno->domicilio_alumnos->estado == 'OAXACA') selected @endif>OAXACA</option>
                     <option value="PUEBLA" {{ old('estado') == 'PUEBLA' ? 'selected':'' }} @if ($alumno->domicilio_alumnos->estado == 'PUEBLA') selected @endif>PUEBLA</option>
                     <option value="QUERETARO" {{ old('estado') == 'QUERETARO' ? 'selected':'' }} @if ($alumno->domicilio_alumnos->estado == 'QUERETARO') selected @endif>QUERETARO</option>
                     <option value="QUINTANA ROO" {{ old('estado') == 'QUINTANA ROO' ? 'selected':'' }} @if ($alumno->domicilio_alumnos->estado == 'QUINTANA ROO') selected @endif>QUINTANA ROO</option>
                     <option value="SAN LUIS POTOSI" {{ old('estado') == 'SAN LUIS POTOSI' ? 'selected':'' }} @if ($alumno->domicilio_alumnos->estado == 'SAN LUIS POTOSI') selected @endif>SAN LUIS POTOSI</option>
                     <option value="SINALOA" {{ old('estado') == 'SINALOA' ? 'selected':'' }} @if ($alumno->domicilio_alumnos->estado == 'SINALOA') selected @endif>SINALOA</option>
                     <option value="SONORA" {{ old('estado') == 'SONORA' ? 'selected':'' }} @if ($alumno->domicilio_alumnos->estado == 'SONORA') selected @endif>SONORA</option>
                     <option value="TABASCO" {{ old('estado') == 'TABASCO' ? 'selected':'' }} @if ($alumno->domicilio_alumnos->estado == 'TABASCO') selected @endif>TABASCO</option>
                     <option value="TAMAULIPAS" {{ old('estado') == 'TAMAULIPAS' ? 'selected':'' }} @if ($alumno->domicilio_alumnos->estado == 'TAMAULIPAS') selected @endif>TAMAULIPAS</option>
                     <option value="TLAXCALA" {{ old('estado') == 'TLAXCALA' ? 'selected':'' }} @if ($alumno->domicilio_alumnos->estado == 'TLAXCALA') selected @endif>TLAXCALA</option>
                     <option value="VERACRUZ DE IGNACIO DE LA LLAVE" {{ old('estado') == 'VERACRUZ DE IGNACIO DE LA LLAVE' ? 'selected':'' }} @if ($alumno->domicilio_alumnos->estado == 'VERACRUZ DE IGNACIO DE LA LLAVE') selected @endif>VERACRUZ DE IGNACIO DE LA LLAVE</option>
                     <option value="YUCATAN" {{ old('estado') == 'YUCATAN' ? 'selected':'' }} @if ($alumno->domicilio_alumnos->estado == 'YUCATAN') selected @endif>YUCATAN</option>
                     <option value="ZACATECAS" {{ old('estado') == 'ZACATECAS' ? 'selected':'' }} @if ($alumno->domicilio_alumnos->estado == 'ZACATECAS') selected @endif>ZACATECAS</option>
                 </select>
                  @if ($errors->has('estado'))
                  <span class="help-block">
                    <strong>{{ $errors->first('estado') }}</strong>
                  </span>
                  @endif
               </div>

               <div class="form-group{{ $errors->has('tel_casa_alumno') ? ' has-error' : '' }}">
                  <label for="tel_casa_alumno" class="col-md-4">Teléfono de Casa:<p class="obligatorio">*</p></label>
                  <input type="text" name="tel_casa_alumno" id="tel_casa_alumno" class="form-control" placeholder="Incluye Lada (PE: 5556485481)" value="{{ old('tel_casa_alumno', $alumno->domicilio_alumnos->telefono_fijo) }}" @if ($errors->has('tel_casa_alumno')) autofocus @endif autocomplete="off" maxlength="10">
                  @if ($errors->has('tel_casa_alumno'))
                  <span class="help-block">
                    <strong>{{ $errors->first('tel_casa_alumno') }}</strong>
                  </span>
                  @endif
               </div>

               <div class="form-group{{ $errors->has('tel_celular_alumno') ? ' has-error' : '' }}">
                  <label for="tel_celular_alumno" class="col-md-4">Teléfono Celular: <p class="obligatorio">*</p></label>
                  <input type="text" name="tel_celular_alumno" id="tel_celular_alumno" class="form-control" placeholder="Incluye Lada (PE: 0445556485481)" value="{{ old('tel_celular_alumno', $alumno->domicilio_alumnos->telefono_celular) }}" @if ($errors->has('tel_celular_alumno')) autofocus @endif autocomplete="off" maxlength="13">
                  @if ($errors->has('tel_celular_alumno'))
                  <span class="help-block">
                    <strong>{{ $errors->first('tel_celular_alumno') }}</strong>
                  </span>
                  @endif
               </div>

               <div class="form-group{{ $errors->has('correo') ? ' has-error' : '' }}">
                  <label for="correo" class="col-md-4">Correo electrónico:<p class="obligatorio">*</p></label>
                  <input type="text" name="correo" id="correo" class="form-control" placeholder="Correo electrónico" value="{{ old('correo', $alumno->domicilio_alumnos->correo) }}" @if ($errors->has('correo')) autofocus @endif autocomplete="off" maxlength="100">
                  @if ($errors->has('correo'))
                  <span class="help-block">
                    <strong>{{ $errors->first('correo') }}</strong>
                  </span>
                  @endif
               </div>

            </div>
        </div>

         <h3 class="help-block">
            @if ( $errors->has('apellido_pat_tutor') ||
            $errors->has('apellido_mat_tutor') ||
            $errors->has('nombre_tutor') ||
            $errors->has('curp_tutor') ||
            $errors->has('tel_fijo_tutor') ||
            $errors->has('tel_celular_tutor') ||
            $errors->has('mail_tutor') ||
            $errors->has('ocupacion') ||
            $errors->has('lugar_trabajo'))
               Datos del Padre o Tutor: <strong>{{ " Existen errores en este apartado"}}</strong>
            @else
               Datos del Padre o Tutor
            @endif
         </h3>
         <div class="caja">
            <div class="info" id="datosTutor">

            <div class="form-group{{ $errors->has('apellido_pat_tutor') ? ' has-error' : '' }}">
               <label for="apellido_pat_tutor" class="col-md-4">Apellido Paterno:<p class="obligatorio">*</p></label>
               <input type="text" name="apellido_pat_tutor" id="apellido_pat_tutor" class="form-control" value="{{ old('apellido_pat_tutor', $alumno->tutores->app) }}" placeholder="Apellido Paterno" autocomplete="off" maxlength="40" onKeyUp="this.value=this.value.toUpperCase();" @if ($errors->has('apellido_pat_tutor')) autofocus @endif>
               @if ($errors->has('apellido_pat_tutor'))
                  <span class="help-block">
                     <strong>{{ $errors->first('apellido_pat_tutor') }}</strong>
                  </span>
               @endif
            </div>

            <div class="form-group{{ $errors->has('apellido_mat_tutor') ? ' has-error' : '' }}">
               <label for="apellido_mat_tutor" class="col-md-4">Apellido Materno:<p class="obligatorio">*</p></label>
               <input type="text" name="apellido_mat_tutor" id="apellido_mat_tutor" class="form-control" value="{{ old('apellido_mat_tutor', $alumno->tutores->apm) }}" placeholder="Apellido Materno" autocomplete="off" maxlength="40" onKeyUp="this.value=this.value.toUpperCase();" @if ($errors->has('apellido_mat_tutor')) autofocus @endif>
               @if ($errors->has('apellido_mat_tutor'))
                  <span class="help-block">
                     <strong>{{ $errors->first('apellido_mat_tutor') }}</strong>
                  </span>
               @endif
            </div>

            <div class="form-group{{ $errors->has('nombre_tutor') ? ' has-error' : '' }}">
               <label for="nombre_tutor" class="col-md-4">Nombre(s):<p class="obligatorio">*</p></label>
               <input type="text" name="nombre_tutor" id="nombre_tutor" class="form-control" value="{{ old('nombre_tutor', $alumno->tutores->nombre) }}" placeholder="Nombre(s)" autocomplete="off" maxlength="60" onKeyUp="this.value=this.value.toUpperCase();" @if ($errors->has('nombre_tutor')) autofocus @endif>
               @if ($errors->has('nombre_tutor'))
                  <span class="help-block">
                     <strong>{{ $errors->first('nombre_tutor') }}</strong>
                  </span>
               @endif
            </div>

            <div class="form-group{{ $errors->has('curp_tutor') ? ' has-error' : '' }}">
               <label for="curp_tutor" class="col-md-4">CURP:<p class="obligatorio">*</p></label>
               <input type="text" name="curp_tutor" id="curp_tutor" class="form-control" value="{{ old('curp_tutor', $alumno->tutores->curp) }}" placeholder="CURP" autocomplete="off" maxlength="18" onKeyUp="this.value=this.value.toUpperCase();" @if ($errors->has('curp_tutor')) autofocus @endif>
               @if ($errors->has('curp_tutor'))
                  <span class="help-block">
                     <strong>{{ $errors->first('curp_tutor') }}</strong>
                  </span>
               @endif
            </div>

            <div class="form-group{{ $errors->has('tel_fijo_tutor') ? ' has-error' : '' }}">
               <label for="tel_fijo_tutor" class="col-md-4">Teléfono Fijo:<p class="obligatorio">*</p></label>
               <input type="text" name="tel_fijo_tutor" id="tel_fijo_tutor" class="form-control" value="{{ old('tel_fijo_tutor', $alumno->tutores->telefono_fijo) }}" placeholder="Incluyendo Lada (PE: 5556485481)" autocomplete="off" maxlength="10" @if ($errors->has('tel_fijo_tutor')) autofocus @endif>
               @if ($errors->has('tel_fijo_tutor'))
                  <span class="help-block">
                     <strong>{{ $errors->first('tel_fijo_tutor') }}</strong>
                  </span>
               @endif
            </div>

            <div class="form-group{{ $errors->has('tel_celular_tutor') ? ' has-error' : '' }}">
               <label for="tel_celular_tutor" class="col-md-4">Teléfono Celular:<p class="obligatorio">*</p></label>
               <input type="text" name="tel_celular_tutor" id="tel_celular_tutor" class="form-control" value="{{ old('tel_celular_tutor', $alumno->tutores->telefono_celular) }}" placeholder="Incluyendo Lada (PE: 0445556485481)" autocomplete="off" maxlength="13" @if ($errors->has('tel_celular_tutor')) autofocus @endif>
               @if ($errors->has('tel_celular_tutor'))
                  <span class="help-block">
                     <strong>{{ $errors->first('tel_celular_tutor') }}</strong>
                  </span>
               @endif
            </div>

            <div class="form-group{{ $errors->has('mail_tutor') ? ' has-error' : '' }}">
               <label for="mail_tutor" class="col-md-4">Correo Electrónico:</label>
               <input type="email" name="mail_tutor" id="mail_tutor" class="form-control" value="{{ old('mail_tutor', $alumno->tutores->correo) }}" placeholder="Correo Electrónico" autocomplete="off" maxlength="100" @if ($errors->has('mail_tutor')) autofocus @endif>
               @if ($errors->has('mail_tutor'))
                  <span class="help-block">
                     <strong>{{ $errors->first('mail_tutor') }}</strong>
                  </span>
               @endif
            </div>

            <div class="form-group{{ $errors->has('ocupacion') ? ' has-error' : '' }}">
               <label for="ocupacion" class="col-md-4">Ocupación:<p class="obligatorio">*</p></label>
               {{-- <input type="text" name="estado" id="estado" class="form-control" placeholder="Entidad Federativa" value="" autocomplete="off" maxlength="70"> --}}
               <select name="ocupacion" id="ocupacion" class="form-control" autocomplete="off" @if ($errors->has('ocupacion')) autofocus @endif>
                  <option value="" selected>Selecciona una opción</option>
                  <option value="NO LO SE" {{ old('ocupacion') == 'NO LO SE' ? 'selected':'' }} @if ($alumno->tutores->ocupacion == 'NO LO SE') selected @endif>NO LO SE</option>
                  <option value="NO TRABAJA" {{ old('ocupacion') == 'NO TRABAJA' ? 'selected':'' }} @if ($alumno->tutores->ocupacion == 'NO TRABAJA') selected @endif>NO TRABAJA</option>
                  <option value="OBRERO" {{ old('ocupacion') == 'OBRERO' ? 'selected':'' }} @if ($alumno->tutores->ocupacion == 'OBRERO') selected @endif>OBRERO</option>
                  <option value="TECNICO" {{ old('ocupacion') == 'TECNICO' ? 'selected':'' }} @if ($alumno->tutores->ocupacion == 'TECNICO') selected @endif>TECNICO</option>
                  <option value="COMERCIANTE" {{ old('ocupacion') == 'COMERCIANTE' ? 'selected':'' }} @if ($alumno->tutores->ocupacion == 'COMERCIANTE') selected @endif>COMERCIANTE</option>
                  <option value="PROFESIONISTA" {{ old('ocupacion') == 'PROFESIONISTA' ? 'selected':'' }} @if ($alumno->tutores->ocupacion == 'PROFESIONISTA') selected @endif>PROFESIONISTA</option>
                  <option value="EMPLEADO" {{ old('ocupacion') == 'EMPLEADO' ? 'selected':'' }} @if ($alumno->tutores->ocupacion == 'EMPLEADO') selected @endif>EMPLEADO</option>
                  <option value="EMPRESARIO" {{ old('ocupacion') == 'EMPRESARIO' ? 'selected':'' }} @if ($alumno->tutores->ocupacion == 'EMPRESARIO') selected @endif>EMPRESARIO</option>
                  <option value="OCUPACIONES DEL HOGAR" {{ old('ocupacion') == 'OCUPACIONES DEL HOGAR' ? 'selected':'' }} @if ($alumno->tutores->ocupacion == 'OCUPACIONES DEL HOGAR') selected @endif>OCUPACIONES DEL HOGAR</option>
               </select>
               @if ($errors->has('ocupacion'))
               <span class="help-block">
                 <strong>{{ $errors->first('ocupacion') }}</strong>
               </span>
               @endif
            </div>

            <div class="form-group{{ $errors->has('lugar_trabajo') ? ' has-error' : '' }}">
               <label for="lugar_trabajo" class="col-md-4">Lugar de Trabajo:<p class="obligatorio">*</p></label>
               <input type="text" name="lugar_trabajo" id="lugar_trabajo" class="form-control" value="{{ old('lugar_trabajo', $alumno->tutores->lugar_trabajo) }}" placeholder="Centro de Trabajo del Tutor" autocomplete="off" maxlength="100" onKeyUp="this.value=this.value.toUpperCase();" @if ($errors->has('lugar_trabajo')) autofocus @endif>
               @if ($errors->has('lugar_trabajo'))
                  <span class="help-block">
                     <strong>{{ $errors->first('lugar_trabajo') }}</strong>
                  </span>
               @endif
            </div>
          </div>
        </div>
        <h3 class="help-block">
           @if ( $errors->has('tipo_sangre') ||
           $errors->has('seguro_medico') ||
           $errors->has('alergias') ||
           $errors->has('tratamiento_especial') ||
           $errors->has('padecimientos'))
               Datos Médicos: <strong>{{ " Existen errores en este apartado"}}</strong>
          @else
             Datos Médicos
           @endif
        </h3>
        <div class="caja">
          <div class="info" id="datosAdicionales">
            <div class="form-group{{ $errors->has('tipo_sangre') ? ' has-error' : '' }}">
               <label for="tipo_sangre" class="col-md-4">Tipo de Sangre:<p class="obligatorio">*</p></label>
               {{-- <input type="text" name="estado" id="estado" class="form-control" placeholder="Entidad Federativa" value="" autocomplete="off" maxlength="70"> --}}
               <select name="tipo_sangre" id="tipo_sangre" class="form-control" autocomplete="off" @if ($errors->has('tipo_sangre')) autofocus @endif>
                  <option value="" selected>Selecciona una opción</option>
                  <option value="O+" {{ old('tipo_sangre') == 'O+' ? 'selected':'' }} @if ($alumno->datos_medicos->tipo_sangre == 'O+') selected @endif>O+</option>
                  <option value="O-" {{ old('tipo_sangre') == 'O-' ? 'selected':'' }} @if ($alumno->datos_medicos->tipo_sangre == 'O-') selected @endif>O-</option>
                  <option value="A+" {{ old('tipo_sangre') == 'A+' ? 'selected':'' }} @if ($alumno->datos_medicos->tipo_sangre == 'A+') selected @endif>A+</option>
                  <option value="A-" {{ old('tipo_sangre') == 'A-' ? 'selected':'' }} @if ($alumno->datos_medicos->tipo_sangre == 'A-') selected @endif>A-</option>
                  <option value="B+" {{ old('tipo_sangre') == 'B+' ? 'selected':'' }} @if ($alumno->datos_medicos->tipo_sangre == 'B+') selected @endif>B+</option>
                  <option value="B-" {{ old('tipo_sangre') == 'B-' ? 'selected':'' }} @if ($alumno->datos_medicos->tipo_sangre == 'B-') selected @endif>B-</option>
                  <option value="AB+" {{ old('tipo_sangre') == 'AB+' ? 'selected':'' }} @if ($alumno->datos_medicos->tipo_sangre == 'AB+') selected @endif>AB+</option>
                  <option value="AB-" {{ old('tipo_sangre') == 'AB-' ? 'selected':'' }} @if ($alumno->datos_medicos->tipo_sangre == 'AB-') selected @endif>AB-</option>
               </select>
               @if ($errors->has('tipo_sangre'))
               <span class="help-block">
                 <strong>{{ $errors->first('tipo_sangre') }}</strong>
               </span>
               @endif
             </div>

            <div class="form-group{{ $errors->has('seguro_medico') ? ' has-error' : '' }}">
                <label for="seguro_medico" class="col-md-4">Seguro Médico:<p class="obligatorio">*</p></label>
                <select name="seguro_medico" id="seguro_medico" class="form-control" autocomplete="off" @if ($errors->has('seguro_medico')) autofocus @endif>
                     <option value="" selected>Selecciona una opción</option>
                     <option value="IMSS" {{ old('seguro_medico') == 'IMSS' ? 'selected':'' }} @if ($alumno->datos_medicos->seguro_medico == 'IMSS') selected @endif>IMSS</option>
                     <option value="ISSSTE" {{ old('seguro_medico') == 'ISSSTE' ? 'selected':'' }} @if ($alumno->datos_medicos->seguro_medico == 'ISSSTE') selected @endif>ISSSTE</option>
                     <option value="PRIVADO" {{ old('seguro_medico') == 'PRIVADO' ? 'selected':'' }} @if ($alumno->datos_medicos->seguro_medico == 'PRIVADO') selected @endif>PRIVADO</option>
                </select>
                @if ($errors->has('seguro_medico'))
                   <span class="help-block">
                      <strong>{{ $errors->first('seguro_medico') }}</strong>
                   </span>
                @endif
             </div>

            <div class="form-group{{ $errors->has('alergias') ? ' has-error' : '' }}">
               <label for="alergias" class="col-md-4">Alergias:<p class="obligatorio">*</p></label>
               <input type="text" name="alergias" id="alergias" class="form-control" value="{{ old('alergias', $alumno->datos_medicos->alergias) }}" placeholder="Alergias" autocomplete="off" maxlength="255" onKeyUp="this.value=this.value.toUpperCase();" @if ($errors->has('alergias')) autofocus @endif>
               @if ($errors->has('alergias'))
                  <span class="help-block">
                     <strong>{{ $errors->first('alergias') }}</strong>
                  </span>
               @endif
            </div>

            <div class="form-group{{ $errors->has('tratamiento_especial') ? ' has-error' : '' }}">
               <label for="tratamiento_especial" class="col-md-4">Tratamientos Especiales:<p class="obligatorio">*</p></label>
               <input type="text" name="tratamiento_especial" id="tratamiento_especial" class="form-control" value="{{ old('tratamiento_especial', $alumno->datos_medicos->tratamiento_especial) }}" placeholder="Tratamientos Especiales" autocomplete="off" maxlength="255" onKeyUp="this.value=this.value.toUpperCase();" @if ($errors->has('tratamiento_especial')) autofocus @endif>
               @if ($errors->has('tratamiento_especial'))
                  <span class="help-block">
                     <strong>{{ $errors->first('tratamiento_especial') }}</strong>
                  </span>
               @endif
            </div>

            <div class="form-group{{ $errors->has('padecimientos') ? ' has-error' : '' }}">
               <label for="padecimientos" class="col-md-4">Padecimientos:<p class="obligatorio">*</p></label>
               <input type="text" name="padecimientos" id="padecimientos" class="form-control" value="{{ old('padecimientos', $alumno->datos_medicos->padecimientos) }}" placeholder="Padecimientos" autocomplete="off" maxlength="255" onKeyUp="this.value=this.value.toUpperCase();" @if ($errors->has('padecimientos')) autofocus @endif>
               @if ($errors->has('padecimientos'))
                  <span class="help-block">
                     <strong>{{ $errors->first('padecimientos') }}</strong>
                  </span>
               @endif
            </div>

          </div>
        </div>
        <h3 class="help-block">
           @if ( $errors->has('apellido_pat_contacto') ||
           $errors->has('apellido_mat_contacto') ||
           $errors->has('nombre_contacto') ||
           $errors->has('parentesco') ||
           $errors->has('tel_fijo_contacto') ||
           $errors->has('tel_celular_contacto'))
               Datos en caso de Emergencia: <strong>{{ " Existen errores en este apartado"}}</strong>
          @else
             Datos en caso de Emergencia
           @endif
        </h3>
        <div class="caja">
          <div class="info" id="datosEmergencia">

                <div class="form-group{{ $errors->has('apellido_pat_contacto') ? ' has-error' : '' }}">
                    <label for="apellido_pat_contacto" class="col-md-4">Apellido Paterno:<p class="obligatorio">*</p></label>
                    <input type="text" name="apellido_pat_contacto" id="apellido_pat_contacto" class="form-control" value="{{ old('apellido_pat_contacto', $alumno->datos_emergencias->app) }}" placeholder="Apellido Paterno" autocomplete="off" maxlength="40" onKeyUp="this.value=this.value.toUpperCase();" @if ($errors->has('apellido_pat_contacto')) autofocus @endif>
                        @if ($errors->has('apellido_pat_contacto'))
                            <span class="help-block">
                                <strong>{{ $errors->first('apellido_pat_contacto') }}</strong>
                            </span>
                        @endif
                </div>

                <div class="form-group{{ $errors->has('apellido_mat_contacto') ? ' has-error' : '' }}">
                    <label for="apellido_mat_contacto" class="col-md-4">Apellido Materno:<p class="obligatorio">*</p></label>
                    <input type="text" name="apellido_mat_contacto" id="apellido_mat_contacto" class="form-control" value="{{ old('apellido_mat_contacto', $alumno->datos_emergencias->apm) }}" placeholder="Apellido Materno" autocomplete="off" maxlength="40" onKeyUp="this.value=this.value.toUpperCase();" @if ($errors->has('apellido_mat_contacto')) autofocus @endif>
                        @if ($errors->has('apellido_mat_contacto'))
                            <span class="help-block">
                                <strong>{{ $errors->first('apellido_mat_contacto') }}</strong>
                            </span>
                        @endif
                </div>

                <div class="form-group{{ $errors->has('nombre_contacto') ? ' has-error' : '' }}">
                    <label for="nombre_contacto" class="col-md-4">Nombre(s):<p class="obligatorio">*</p></label>
                    <input type="text" name="nombre_contacto" id="nombre_contacto" class="form-control" value="{{ old('nombre_contacto', $alumno->datos_emergencias->nombre) }}" placeholder="Nombre(s)" autocomplete="off" maxlength="60" onKeyUp="this.value=this.value.toUpperCase();" @if ($errors->has('nombre_contacto')) autofocus @endif>
                        @if ($errors->has('nombre_contacto'))
                            <span class="help-block">
                                <strong>{{ $errors->first('nombre_contacto') }}</strong>
                            </span>
                        @endif
                </div>

                <div class="form-group{{ $errors->has('parentesco') ? ' has-error' : '' }}">
                    <label for="parentesco" class="col-md-4">Parentesco:<p class="obligatorio">*</p></label>
                    <input type="text" name="parentesco" id="parentesco" class="form-control" value="{{ old('parentesco', $alumno->datos_emergencias->parentesco) }}" placeholder="Parentesco" autocomplete="off" maxlength="60" onKeyUp="this.value=this.value.toUpperCase();" @if ($errors->has('parentesco')) autofocus @endif>
                        @if ($errors->has('parentesco'))
                            <span class="help-block">
                                <strong>{{ $errors->first('parentesco') }}</strong>
                            </span>
                        @endif
                </div>

                <div class="form-group{{ $errors->has('tel_fijo_contacto') ? ' has-error' : '' }}">
                    <label for="tel_fijo_contacto" class="col-md-4">Teléfono Fijo:<p class="obligatorio">*</p></label>
                    <input type="text" name="tel_fijo_contacto" id="tel_fijo_contacto" class="form-control" value="{{ old('tel_fijo_contacto', $alumno->datos_emergencias->telefono_fijo) }}" placeholder="Incluyendo Lada (PE: 5556485481)" autocomplete="off" maxlength="10" @if ($errors->has('tel_fijo_contacto')) autofocus @endif>
                        @if ($errors->has('tel_fijo_contacto'))
                            <span class="help-block">
                                <strong>{{ $errors->first('tel_fijo_contacto') }}</strong>
                            </span>
                        @endif
                </div>

                <div class="form-group{{ $errors->has('tel_celular_contacto') ? ' has-error' : '' }}">
                    <label for="tel_celular_contacto" class="col-md-4">Teléfono Celular:<p class="obligatorio">*</p></label>
                    <input type="text" name="tel_celular_contacto" id="tel_celular_contacto" class="form-control" value="{{ old('tel_celular_contacto', $alumno->datos_emergencias->telefono_celular) }}" placeholder="Incluyendo Lada (PE: 0445556485481)" autocomplete="off" maxlength="13" @if ($errors->has('tel_celular_contacto')) autofocus @endif>
                        @if ($errors->has('tel_celular_contacto'))
                            <span class="help-block">
                                <strong>{{ $errors->first('tel_celular_contacto') }}</strong>
                            </span>
                        @endif
                </div>

          </div>
        </div>
        <h3 class="help-block">
           @if ( $errors->has('info_adicional'))
               Datos Adicionales: <strong>{{ " Existen errores en este apartado"}}</strong>
          @else
             Datos Adicionales
           @endif
        </h3>
        <div class="caja">
          <div class="info" id="datosAdicionales">
            <p>Mencionar cualquier información importante que debamos tomar en cuenta.</p>
            <textarea rows="8" placeholder="Ninguna" name="info_adicional" onKeyUp="this.value=this.value.toUpperCase();" @if ($errors->has('info_adicional')) autofocus @endif>{{ old('info_adicional', $alumno->datos_emergencias->info_adicional) }}</textarea>
               @if ($errors->has('info_adicional'))
                   <span class="help-block">
                       <strong>{{ $errors->first('info_adicional') }}</strong>
                   </span>
               @endif
          </div>
        </div>
      </div>
      <input type="submit" value="Guardar" class="btn-blue">

    </form>
  </div>
  <script type="text/javascript">
    var path = "{{ route('autocomplete') }}";
    $('input.typeahead').typeahead({
        source:  function (query, process) {
        return $.get(path, { query: query }, function (data) {
                return process(data);
            });
        }
    });
</script>
@endsection
