<?php
use App\Models\{Alumno, DatosPersonalesAlumnos, DatosAcademicos, DomicilioAlumnos, Tutores, DatosMedicos, DatosEmergencia, Grupos, AsignaturaGrupo, Asignaturas, DatosGeneralesProfesores, Adeudo};
use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/alumno/login');
});

Auth::routes();

Route::get('home', 'HomeController@index')->name('home')->middleware('auth:web,admin, user');

// Admin Login
Route::get('admin/login', 'Admin\LoginController@showLoginForm')->name('admin.login');
Route::post('admin/login', 'Admin\LoginController@login');
Route::post('admin/logout', 'Admin\LoginController@logout')->name('admin.logout');

// User Login
Route::get('user/login', 'User\LoginController@showLoginForm')->name('user.login');
Route::post('user/login', 'User\LoginController@login');
Route::post('user/logout', 'User\LoginController@logout')->name('user.logout');

Route::get('user/', 'User\Dashboard@index')->name('user.logout');

Route::get('user/alumnos', 'User\Dashboard@buscarAlumno')->name('user.buscar.alumno');
Route::post('user/buscar/alumno', 'User\Dashboard@buscarAlumnoPost')->name('user.buscar.alumnoPost');

//Alumnos Login
Route::get('alumno/login', 'Alumno\LoginController@showLoginForm')->name('alumno.login');
Route::post('alumno/login', 'Alumno\LoginController@login');
Route::post('alumno/logout', 'Alumno\LoginController@logout')->name('alumno.logout');

Route::get('alumno/password/forgot', 'Alumno\ForgotPasswordController@showViewForgot')->name('alumno.forgot');
Route::post('alumno/password/forgot', 'Alumno\ForgotPasswordController@forgot')->name('postForgot');

Route::get('alumno/home/{alumno}', 'Alumno\AlumnoController@index')
      ->where('alumno','[0-9]+')
      ->name('alumno.home')
      ->middleware('auth:web,admin');

Route::post('alumno/home/{alumno}', 'Alumno\AlumnoController@update')
      ->where('alumno','[0-9]+')
      ->name('alumno.changePassword');

Route::get('alumno/change-password/{alumno}', 'Alumno\AlumnoController@showChangePassword')
   ->where('alumno','[0-9]+')
   ->name('alumno.cambioPass');

Route::get('alumno/pasos', 'Alumno\AlumnoController@steps')->name('alumno.pasos');
Route::get('alumno/pasos/msj', 'Alumno\AlumnoController@stepsMsj')->name('alumno.pasos.msj');

Route::get('alumno/aviso-privacidad', 'Alumno\AlumnoController@avisoPrivacidad');

Route::get('alumno/{alumno}/actualizacion', 'Alumno\AlumnoController@showDataUpdate')->name('alumno.actualizacion');
Route::post('alumno/{alumno}', 'Alumno\AlumnoController@DataUpdate')->where('alumno', '[0-9]+');

Route::get('alumno/{alumno}/adeudos', 'Alumno\AlumnoController@showAdeudos')->name('alumno.adeudo');

Route::get('alumno/reporte/comprobante/{alumno}', function (){
    $datAlumno=Alumno::find(Auth::id());
    $datPerAlum=DatosPersonalesAlumnos::find($datAlumno->datos_personales_alumnos_id);
    $datAcademicos = DatosAcademicos::find($datAlumno->datos_personales_alumnos_id);
    $domicilioAlumnos = DomicilioAlumnos::find($datAlumno->domicilio_alumnos_id);
    $datTutores = Tutores::find($datAlumno->datos_personales_alumnos_id);
    $datMedicos = DatosMedicos::find($datAlumno->datos_personales_alumnos_id);
    $datEmergencia = DatosEmergencia::find($datAlumno->datos_personales_alumnos_id);

    // dd($datAlumno,$datPerAlum,$datAcademicos,$domicilioAlumnos,$datTutores,$datMedicos,$datEmergencia);
    $datos=[
        'Datos Alumno' => [
            $datAlumno->num_cta,
            $datAlumno->nombre_completo($datAlumno->id),
            $domicilioAlumnos->correo,
        ],
    ];
    $grupo = Grupos::where('id', Auth::User()->grupo_id)->first();

    $clv_grupo = 0;
    $profesores = 0;
    $clv_secciones = array();
    $sec_asignaturas = array();
    $sec_profesores = array();
    $asignaturas = $grupo->asignaturas;
   if($datAlumno->clv_idioma != null)
   {
      foreach ($asignaturas as $key => $asignatura) {
          if($asignatura->clv_asignatura >= "1506" && $asignatura->clv_asignatura <= "1511"){
             if($asignatura->clv_asignatura != $datAlumno->clv_idioma){
                // dd($key);
                unset($asignaturas[$key]);
             }
          }
      }
      $asignaturasSinIdiomas = array();
      foreach ($asignaturas as $key => $asignatura) {
          array_push($asignaturasSinIdiomas, $asignatura);
      }
      $asignaturas = $asignaturasSinIdiomas;
   }
   else {
      $asignaturas = array();
      $asignaturasGrupo = AsignaturaGrupo::where('grupo_id', $grupo->id)->get();
      foreach ($asignaturasGrupo as $key => $asignaturaGrupo) {
         $asignatura = Asignaturas::where('colegio', "!=", 'LENGUAS VIVAS')->find($asignaturaGrupo->asignatura_id);
         if($asignatura != null)
         {
            array_push($asignaturas, $asignatura);
         }
      }
      $gradoXcursar = DatosAcademicos::select('grado_a_cursar')->find(Auth::user()->id)->grado_a_cursar;
      $rep = DatosAcademicos::select('REP')->find(Auth::user()->id);
      if(!empty($rep)){
         if($rep->REP == 0)
         {
            $gradoXcursar = $gradoXcursar-1;
         }
      }
      switch ($gradoXcursar) {
         case '1':
            $idioma = DB::table('historias_academicas')
                        ->where('num_cta', Auth::user()->num_cta)
                        ->whereIn('clv_asignatura', ['1108', '1114'])
                        ->first();
            break;
         case '2':
         $idioma = DB::table('historias_academicas')
                     ->where('num_cta', Auth::user()->num_cta)
                     ->whereIn('clv_asignatura', ['1208', '1214'])
                     ->first();
            break;
         case '3':
         $idioma = DB::table('historias_academicas')
                     ->where('num_cta', Auth::user()->num_cta)
                     ->whereIn('clv_asignatura', ['1306', '1314'])
                     ->first();
            break;
         case '4':
         $idioma = DB::table('historias_academicas')
                     ->where('num_cta', Auth::user()->num_cta)
                     ->whereIn('clv_asignatura', ['1407', '1408'])
                     ->first();
               break;
         case '5':
         $idioma = DB::table('historias_academicas')
                     ->where('num_cta', Auth::user()->num_cta)
                     ->whereIn('clv_asignatura', ['1506', '1507', '1508', '1509', '1510', '1511'])
                     ->first();
               break;
         case '6':
         $idioma = DB::table('historias_academicas')
                     ->where('num_cta', Auth::user()->num_cta)
                     ->whereIn('clv_asignatura', ['1506', '1507', '1508', '1509', '1510', '1511'])
                     ->first();
               break;
         default:
            $idioma = "";
            break;
      }
      if(!empty($idioma)){
         $idiomaAnterior = $idioma->clv_asignatura;
      }
      else {
         $idiomaAnterior = null;
      }
      switch ($idiomaAnterior) {
         /*Ingles*/
         case '1108':
            $idioma = '1208';
            break;
         case '1208':
            $idioma = '1306';
            break;
         // case '1306':
         //    $idioma = '1407';
         //    break;
         case '1407':
            $idioma = '1506';
            break;
         case '1506':
            $idioma = '1603';
            break;
         case '1510':
            $idioma = '1607';
            break;
         /*FRANCES*/
         case '1114':
            $idioma = '1214';
            break;
         case '1214':
            $idioma = '1314';
            break;
         case '1408':
            $idioma = '1507';
            break;
         case '1507':
            $idioma = '1604';
            break;
         case '1511':
            $idioma = '1608';
            break;
         /*ALEMAN*/
         case '1509':
            $idioma = '1605';
            break;
         /*ITALIANO*/
         case '1508':
            $idioma = '1606';
            break;
         default:
            $idioma = "";
            break;
      }
      $clvIdioma = $idioma;
      $asignatura = Asignaturas::where('clv_asignatura', $clvIdioma)->get();
      foreach ($asignatura as $key => $value) {
            array_push($asignaturas, $value);
      }
   }
    $profesores = $grupo->profesores;
    $clv_secciones = 1;
    if($grupo != null)
    {
      // $asignaturas = $grupo->asignaturas;
      $profesores = $grupo->profesores;

      $clv_grupo = substr($grupo->clv_grupo, 1);
      $secciones = Auth::User()->clv_seccion;

      for ($i=0; $i < $clv_secciones ; $i++) {

          $dato = Grupos::where('id', Auth::User()->clv_seccion)
                   ->first();
          if($dato != null)
          {
            array_push($sec_asignaturas, $dato->asignaturas);
            array_push($sec_profesores, $dato->profesores[0]->nombre." ".$dato->profesores[0]->app." ".$dato->profesores[0]->apm);
          }
      }
      $clv_secciones = Grupos::find(Auth::User()->clv_seccion);
   }
    PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
   $pdf = PDF::loadView('alumno.comprobanteReinscripcion', ['datos' => $datos, 'clv_grupo' => $clv_grupo, 'asignaturas' => $asignaturas, 'clv_secciones' => $clv_secciones, 'sec_asignaturas' => $sec_asignaturas, 'profesores' => $profesores, 'sec_profesores' => $sec_profesores])
   // $pdf = PDF::loadView('alumno.datos', ['datos' => $datos])
    ->setPaper('letter', 'portrait');
   return $pdf->download('comprobante_enp2_actualizacion.pdf');
   // return view('alumno.datos', ['datos' => $datos, 'clv_grupo' => $clv_grupo, 'asignaturas' => $asignaturas, 'clv_secciones' => $clv_secciones, 'sec_asignaturas' => $sec_asignaturas, 'profesores' => $profesores, 'sec_profesores' => $sec_profesores]);
})->name('reporte.comprobanteReinscripcion');

Route::get('alumno/consulta/grado', 'Alumno\GruposController@showGrados')->name('alumno.grados');
Route::post('alumno/consulta/grado', 'Alumno\GruposController@postGrado')->name('alumno.postGrados');

Route::get('alumno/consulta/grupos/{grado}', 'Alumno\GruposController@showGrupos')->name('alumno.grupos');
Route::post('alumno/consulta/grupos', 'Alumno\GruposController@postGrupos')->name('alumno.postGrupos');

Route::get('alumno/consulta/grupos/{grado}/areas', 'Alumno\GruposController@showAreas')->name('alumno.areas');
Route::post('alumno/consulta/grupos/area/', 'Alumno\GruposController@postAreas')->name('alumno.postArea');

Route::get('alumno/consulta/grupos/{grado}/areas-re', 'Alumno\GruposController@showAreasRe')->name('alumno.areas_re');
Route::post('alumno/consulta/grupos/area-re', 'Alumno\GruposController@postAreasRe')->name('alumno.postAreaRe');

Route::get('alumno/consulta/grupos/area/{area}', 'Alumno\GruposController@showFormArea')->name('alumno.formArea');
Route::post('alumno/consulta/grupos/optativa', 'Alumno\GruposController@postOptativas')->name('alumno.postOptativas');

Route::get('alumno/consulta/grupos/area-re/{area}', 'Alumno\GruposController@showFormAreaRe')->name('alumno.formAreaRe');



Route::get('alumno/consulta/grupos/{grado}/idiomas', 'Alumno\GruposController@showIdiomas')->name('alumno.idiomas');
Route::post('alumno/consulta/grupos/idiomas', 'Alumno\GruposController@postIdiomas')->name('alumno.postIdiomas');

Route::get('alumno/reporte/grupo/{grupo}', 'Alumno\HorariosController@showGrupo')->name('reporte.grupo');

Route::get('alumno/reporte/grupo/optativa/{optativa}', 'Alumno\HorariosController@showOptativa')->name('reporte.optativa');
// Route::get('alumno/reporte/grupo/optativa/{optativa}', function(){
//    // dd("hola");
//    echo "hola";
// })->name('reporte.optativa');



Route::get('alumno/{alumno}/turno-reinscripcion', 'Alumno\AlumnoController@turnoReinscripcion');

// Route::get('texto', 'Admin\UpdateController@up')->name('update.historico');

Route::get('alumno/{alumno}/reinscripcion', 'Alumno\AlumnoController@showReinscripcion')->name('alumno.showReinscripcion');
Route::post('alumno/{alumno}/reinscripcion', 'Alumno\AlumnoController@postReinscripcion')->name('alumno.postReinscripcion');
Route::get('alumno/reinscripcion', 'Alumno\AlumnoController@reinscripcion')->name('alumno.reinscripcion');
Route::get('alumno/reinscripcion-grupos', 'Alumno\AlumnoController@reinscripcionGrupos')->name('alumno.reinscripcion-grupo');
Route::post('alumno/reinscripcion-grupos/sin-seccion', 'Alumno\AlumnoController@reinscripcionGruposPost')->name('alumno.reinscripcion-grupoPost');
Route::post('alumno/reinscripcion-grupos/seccion', 'Alumno\AlumnoController@reinscripcionSeccion')->name('alumno.reinscripcion-seccion');
Route::get('alumno/fin-reinscripcion', 'Alumno\AlumnoController@showReinscripcionFin')->name('alumno.reinscripcion.fin');

Route::get('alumno/extranjero/busqueda', 'Alumno\SearchController@busquedaExtranjeros')->name('autocomplete');

Route::post('alumno/reinscripcion-grupos/area/{area}', 'Alumno\AlumnoController@reinscripcionGruposArea')->name('alumno.reinscripcion-grupo.area');


Route::get('alumno/reporte/datos/{alumno}', function (){
    $datAlumno=Alumno::find(Auth::id());
    $datPerAlum=DatosPersonalesAlumnos::find($datAlumno->datos_personales_alumnos_id);
    $datAcademicos = DatosAcademicos::find($datAlumno->datos_personales_alumnos_id);
    $domicilioAlumnos = DomicilioAlumnos::find($datAlumno->domicilio_alumnos_id);
    $datTutores = Tutores::find($datAlumno->datos_personales_alumnos_id);
    $datMedicos = DatosMedicos::find($datAlumno->datos_personales_alumnos_id);
    $datEmergencia = DatosEmergencia::find($datAlumno->datos_personales_alumnos_id);

    // dd($datAlumno,$datPerAlum,$datAcademicos,$domicilioAlumnos,$datTutores,$datMedicos,$datEmergencia);
    $datos=[
        'Datos Alumno' => [
            $datAlumno->num_cta,
            $datAlumno->nombre_completo($datAlumno->id),
            $datPerAlum->curp,
            $datAcademicos->esc_procedencia,
            'Calle: '.$domicilioAlumnos->calle_cnum.", Colonia: ".$domicilioAlumnos->colonia.", CP. ".$domicilioAlumnos->cp.", Estado: ".$domicilioAlumnos->estado.", Delegación: ".$domicilioAlumnos->del_mun,
            $domicilioAlumnos->telefono_fijo,
            $domicilioAlumnos->telefono_celular,
            $domicilioAlumnos->correo,
        ],
        'Datos Tutor' => [
            $datTutores->curp,
            $datTutores->nombre." ".$datTutores->app." ".$datTutores->apm,
            $datTutores->ocupacion,
            $datTutores->lugar_trabajo,
        ],
        'Contacto de Emergencia' => [
            $datEmergencia->nombre." ".$datEmergencia->app." ".$datEmergencia->apm,
            $datEmergencia->parentesco,
            $datEmergencia->telefono_fijo,
            $datEmergencia->telefono_celular,
            $datEmergencia->info_adicional,
        ],
        'Datos Adicionales' => [
            $datMedicos->tipo_sangre,
            $datMedicos->seguro_medico,
            $datMedicos->alergias,
            $datMedicos->tratamiento_especial,
            $datMedicos->padecimientos,
        ]
    ];
    $grupo = Grupos::where('id', Auth::User()->grupo_id)->first();

    $clv_grupo = 0;
    $profesores = 0;
    $clv_secciones = array();
    $sec_asignaturas = array();
    $sec_profesores = array();
    $asignaturas = $grupo->asignaturas;
   if($datAlumno->clv_idioma != null)
   {
      foreach ($asignaturas as $key => $asignatura) {
          if($asignatura->clv_asignatura >= "1506" && $asignatura->clv_asignatura <= "1511"){
             if($asignatura->clv_asignatura != $datAlumno->clv_idioma){
                // dd($key);
                unset($asignaturas[$key]);
             }
          }
      }
      $asignaturasSinIdiomas = array();
      foreach ($asignaturas as $key => $asignatura) {
          array_push($asignaturasSinIdiomas, $asignatura);
      }
      $asignaturas = $asignaturasSinIdiomas;
   }
   else {
      $asignaturas = array();
      $asignaturasGrupo = AsignaturaGrupo::where('grupo_id', $grupo->id)->get();
      foreach ($asignaturasGrupo as $key => $asignaturaGrupo) {
         $asignatura = Asignaturas::where('colegio', "!=", 'LENGUAS VIVAS')->find($asignaturaGrupo->asignatura_id);
         if($asignatura != null)
         {
            array_push($asignaturas, $asignatura);
         }
      }
      $gradoXcursar = DatosAcademicos::select('grado_a_cursar')->find(Auth::user()->id)->grado_a_cursar;
      $rep = DatosAcademicos::select('REP')->find(Auth::user()->id);
      if(!empty($rep)){
         if($rep->REP == 0)
         {
            $gradoXcursar = $gradoXcursar-1;
         }
      }
      switch ($gradoXcursar) {
         case '1':
            $idioma = DB::table('historias_academicas')
                        ->where('num_cta', Auth::user()->num_cta)
                        ->whereIn('clv_asignatura', ['1108', '1114'])
                        ->first();
            break;
         case '2':
         $idioma = DB::table('historias_academicas')
                     ->where('num_cta', Auth::user()->num_cta)
                     ->whereIn('clv_asignatura', ['1208', '1214'])
                     ->first();
            break;
         case '3':
         $idioma = DB::table('historias_academicas')
                     ->where('num_cta', Auth::user()->num_cta)
                     ->whereIn('clv_asignatura', ['1306', '1314'])
                     ->first();
            break;
         case '4':
         $idioma = DB::table('historias_academicas')
                     ->where('num_cta', Auth::user()->num_cta)
                     ->whereIn('clv_asignatura', ['1407', '1408'])
                     ->first();
               break;
         case '5':
         $idioma = DB::table('historias_academicas')
                     ->where('num_cta', Auth::user()->num_cta)
                     ->whereIn('clv_asignatura', ['1506', '1507', '1508', '1509', '1510', '1511'])
                     ->first();
               break;
         case '6':
         $idioma = DB::table('historias_academicas')
                     ->where('num_cta', Auth::user()->num_cta)
                     ->whereIn('clv_asignatura', ['1506', '1507', '1508', '1509', '1510', '1511'])
                     ->first();
               break;
         default:
            $idioma = "";
            break;
      }
      if(!empty($idioma)){
         $idiomaAnterior = $idioma->clv_asignatura;
      }
      else {
         $idiomaAnterior = null;
      }
      switch ($idiomaAnterior) {
         /*Ingles*/
         case '1108':
            $idioma = '1208';
            break;
         case '1208':
            $idioma = '1306';
            break;
         // case '1306':
         //    $idioma = '1407';
         //    break;
         case '1407':
            $idioma = '1506';
            break;
         case '1506':
            $idioma = '1603';
            break;
         case '1510':
            $idioma = '1607';
            break;
         /*FRANCES*/
         case '1114':
            $idioma = '1214';
            break;
         case '1214':
            $idioma = '1314';
            break;
         case '1408':
            $idioma = '1507';
            break;
         case '1507':
            $idioma = '1604';
            break;
         case '1511':
            $idioma = '1608';
            break;
         /*ALEMAN*/
         case '1509':
            $idioma = '1605';
            break;
         /*ITALIANO*/
         case '1508':
            $idioma = '1606';
            break;
         default:
            $idioma = "";
            break;
      }
      $clvIdioma = $idioma;
      $asignatura = Asignaturas::where('clv_asignatura', $clvIdioma)->get();
      foreach ($asignatura as $key => $value) {
            array_push($asignaturas, $value);
      }
   }
    $profesores = $grupo->profesores;
    $clv_secciones = 1;
    if($grupo != null)
    {
      // $asignaturas = $grupo->asignaturas;
      $profesores = $grupo->profesores;

      $clv_grupo = substr($grupo->clv_grupo, 1);
      $secciones = Auth::User()->clv_seccion;

      for ($i=0; $i < $clv_secciones ; $i++) {

          $dato = Grupos::where('id', Auth::User()->clv_seccion)
                   ->first();
          if($dato != null)
          {
            array_push($sec_asignaturas, $dato->asignaturas);
            array_push($sec_profesores, $dato->profesores[0]->nombre." ".$dato->profesores[0]->app." ".$dato->profesores[0]->apm);
          }
      }
      $clv_secciones = Grupos::find(Auth::User()->clv_seccion);
   }
    PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
   $pdf = PDF::loadView('alumno.datos', ['datos' => $datos, 'clv_grupo' => $clv_grupo, 'asignaturas' => $asignaturas, 'clv_secciones' => $clv_secciones, 'sec_asignaturas' => $sec_asignaturas, 'profesores' => $profesores, 'sec_profesores' => $sec_profesores])
   // $pdf = PDF::loadView('alumno.datos', ['datos' => $datos])
    ->setPaper('letter', 'portrait');
   return $pdf->download('enp2_actualizacion_datos.pdf');
   // return redirect()->route('alumno.pasos');
   // return view('alumno.datos', ['datos' => $datos, 'clv_grupo' => $clv_grupo, 'asignaturas' => $asignaturas, 'clv_secciones' => $clv_secciones, 'sec_asignaturas' => $sec_asignaturas, 'profesores' => $profesores, 'sec_profesores' => $sec_profesores]);
})->name('reporte.datosAlumno');
