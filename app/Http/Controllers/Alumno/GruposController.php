<?php
namespace App\Http\Controllers\Alumno;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\AsignaturaGrupo;
use App\Models\{Alumno, Grupos, Asignaturas, DatosAcademicos};
use Illuminate\Support\Facades\DB;

use Validator;

use App\Http\Traits\Idiomas;
// use Barryvdh\DomPDF\Facade\PDF;

class GruposController extends Controller
{
   use Idiomas;
   public function showGrados()
   {
      if (Auth::check())
      {
         if(Auth::user()->activo)
         {
            return view('alumno.ConsultaGrado');
         }
         else {
            Auth::logout();
         }
      }
      return redirect()->intended('alumno/login');
      // return view('alumno.ConsultaGrado');
   }
   public function postGrado(Request $request, Grupos $grupos)
   {
      $data = request()->validate([
          'grado' => ['required'],
      ],[
          'grado.required' => 'Selecciona una opción en el campo Grado',
      ]);
      $grado = $data['grado'];
      // dd($grado);
      if($grado==6)
      {
         return redirect()->route('alumno.areas', $grado);
      }
      // elseif ($grado == 5) {
      //    return redirect()->route('alumno.idiomas', $grado);
      // }
      else {
         return redirect()->route('alumno.grupos', $grado);
      }
   }
   public function showAreas($grado){
      if (Auth::check())
      {
         if(Auth::user()->activo)
         {
            $areas = [
                        '1' => 'Área 1 (FÍSICO-MATEMÁTICAS E INGENIERÍAS)',
                        '2' => 'Área 2 (BIOLÓGICAS Y DE LA SALUD)',
                        '3' => 'Área 3 (SOCIALES)',
                        '4' => 'Área 4 (HUMANIDADES Y LAS ARTES)'
                     ];
            return view('alumno.ConsultaArea')->with(['grado' => $grado, 'areas' => $areas]);
         }
         else {
            Auth::logout();
         }
      }
      return redirect()->intended('alumno/login');
   }
   public function showAreasRe($grado){
      if (Auth::check())
      {
         if(Auth::user()->activo)
         {
            $areas = [
                        '1' => 'Área 1 (FÍSICO-MATEMÁTICAS E INGENIERÍAS)',
                        '2' => 'Área 2 (BIOLÓGICAS Y DE LA SALUD)',
                        '3' => 'Área 3 (SOCIALES)',
                        '4' => 'Área 4 (HUMANIDADES Y LAS ARTES)'
                     ];
            return view('alumno.ConsultaAreaRe')->with(['grado' => $grado, 'areas' => $areas]);
         }
         else {
            Auth::logout();
         }
      }
      return redirect()->intended('alumno/login');
   }
   public function postAreas(Request $request)
   {
      if (Auth::check())
      {
         if(Auth::user()->activo)
         {
            $data = request()->validate([
                'area' => ['required'],
            ],[
                'area.required' => 'Selecciona una opción en el campo Área',
            ]);
            return redirect()->route('alumno.formArea', ['area' => $data['area']]);
         }
         else {
            Auth::logout();
         }
      }
      return redirect()->intended('alumno/login');
   }
   public function postAreasRe(Request $request)
   {
      if (Auth::check())
      {
         if(Auth::user()->activo)
         {
            $data = request()->validate([
                'area' => ['required'],
            ],[
                'area.required' => 'Selecciona una opción en el campo Área',
            ]);
            return redirect()->route('alumno.formAreaRe', ['area' => $data['area']]);
         }
         else {
            Auth::logout();
         }
      }
      return redirect()->intended('alumno/login');
   }
   public function showFormArea(){
      $area = request()->area;
      $grupos_area = DB::table('grupos')
      ->join('asignatura_grupo', 'grupos.id', '=', 'asignatura_grupo.grupo_id')
      ->join('asignaturas', 'asignatura_grupo.asignatura_id', '=', 'asignaturas.id')
      ->select('grupos.id', 'grupos.clv_grupo', 'grupos.activo', 'asignatura_grupo.asignatura_id', 'asignaturas.area')
      ->where('grupos.clv_grupo', 'LIKE', '06%')
      ->where('grupos.activo', '1')
      ->where('asignaturas.area', $area)
      ->orderBy('clv_grupo')
      ->get()
      ->groupBy('id');
      $grupos = array();
      foreach ($grupos_area as $key =>$value) {
         $grupo = Grupos::find($key);
         // dd($key, $grupo->clv_grupo);
         // dd($grupo->clv_grupo != "0600");
         if($grupo->clv_grupo != "0600" && $grupo->clv_grupo != "0650")
         {
            array_push($grupos, $grupo->clv_grupo);
         }
      }
      $optativas_area = Asignaturas::where('clv_asignatura', 'LIKE', '17%')
               ->where('area', $area)
               ->get();
      $optativas = $optativas_area->pluck('nombre', 'clv_asignatura');
      foreach ($optativas as $key => $value) {
         $secciones = Asignaturas::where('clv_asignatura', $key)->first();
         $optativas[$key] =  [$value => $secciones->grupos->pluck('clv_grupo')->toArray()];
         // dd();
      }
      // $optativas = $optativas->toArray()
      return view('alumno.ConsultaGrupoOptativas')->with(['grupos' => $grupos, 'optativas' => $optativas->toArray(), 'area' => $area]);
   }
   public function showFormAreaRe(){
      $area = request()->area;
      $alumno = Alumno::where('id',Auth::id())->first();
      $turno = $alumno->datos_academicos->turno;
      $gradoXcursar = $alumno->datos_academicos->grado_a_cursar;

      // $grupos = DB::table('grupos')
      //   ->where('activo', '=', 1)
      //   ->where('turno', '=',$turno)
      //   ->where('cupo', '>', 0)
      //   ->where('clv_grupo', 'like', '0'.$gradoXcursar.'%')
      //   ->orderBy('clv_grupo')
      //   ->pluck('clv_grupo');

      $grupos_area = DB::table('grupos')
      ->join('asignatura_grupo', 'grupos.id', '=', 'asignatura_grupo.grupo_id')
      ->join('asignaturas', 'asignatura_grupo.asignatura_id', '=', 'asignaturas.id')
      ->select('grupos.id', 'grupos.clv_grupo', 'grupos.activo', 'asignatura_grupo.asignatura_id', 'asignaturas.area')
      ->where('grupos.clv_grupo', 'LIKE', '06%')
      ->where('grupos.activo', '1')
      ->where('grupos.turno', $turno)
      ->where('asignaturas.area', $area)
      ->orderBy('clv_grupo')
      ->get()
      ->groupBy('id');
      $grupos = array();
      /*Busqueda de idioma seleccionado en grado anterior*/
      $gradoXcursar = DatosAcademicos::select('grado_a_cursar')->find(Auth::user()->id)->grado_a_cursar;
      $idiomaAnterior = $this->idiomaAnterior($gradoXcursar);
      $clvIdioma = $this->idiomaGrado($idiomaAnterior);
      $asignatura = Asignaturas::where('clv_asignatura', $clvIdioma)->get();
      foreach ($grupos_area as $key =>$value) {
         $grupo = Grupos::find($key);
         if($grupo->clv_grupo != "0600" && $grupo->clv_grupo != "0650")
         {
            array_push($grupos, $grupo->clv_grupo);
         }
      }

      return view('alumno.ConsultaGrupoArea')->with(['grupos' => $grupos, 'area' => $area]);
   }
   // public function postFormArea(){
   //    dd($_POST);
   // }
    public function showGrupos($grado, Grupos $grupos)
    {
        if (Auth::check())
        {
           if(Auth::user()->activo)
           {
               $grupos = DB::table('grupos')
                     ->where('clv_grupo', 'like', '0'.$grado.'%')
                     ->where('activo', '1')
                     ->orderBy('clv_grupo')
                     ->pluck('clv_grupo');
               // dd($grupos);
               // $optativas_area = Asignaturas::where('clv_asignatura', 'LIKE', '17%')
               //          ->where('area', $area)
               //          ->get();
               // $optativas = $optativas_area->pluck('nombre', 'clv_asignatura');
            return view('alumno.ConsultaGrupo')->with(['grupos' => $grupos, /*'optativas' => $optativas*/]);
           }
           else {
              Auth::logout();
           }
        }
        return redirect()->intended('alumno/login');
    }
   public function postGrupos(Request $request)
   {
      $data = request()->validate([
          'grupo' => ['required'],
      ],[
          'grupo.required' => 'Selecciona una opción en el campo Grupo',
      ]);
      $grupo = $data['grupo'];
      return redirect()->route('reporte.grupo', $request->grupo);
   }
   public function postOptativas(Request $request)
   {
      $data = request()->validate([
          'optativa' => ['required'],
      ],[
          'optativa.required' => 'Selecciona una opción en el campo Optativa',
      ]);
      return redirect()->route('reporte.optativa', ['optativa' => $request->optativa, 'area' =>$request->area]);
   }
   public function showIdiomas($grado){
      if (Auth::check())
      {
         if(Auth::user()->activo)
         {
            $idiomas = [
                        '1506' => 'INGLES V',
                        '1507' => 'FRANCES V',
                        '1508' => 'ITALIANO I',
                        '1509' => 'ALEMAN I',
                        '1510' => 'INGLES I',
                        '1511' => 'FRANCES I',
                     ];
            return view('alumno.ConsultaIdioma')->with(['grado' => $grado, 'idiomas' => $idiomas]);
         }
         else {
            Auth::logout();
         }
      }
      return redirect()->intended('alumno/login');
   }
   public function postIdiomas(Request $request)
   {
      if (Auth::check())
      {
         if(Auth::user()->activo)
         {
            $data = request()->validate([
                'idioma' => ['required'],
            ],[
                'idioma.required' => 'Selecciona una opción en el campo Idioma',
            ]);
            $idioma = $data['idioma'];
            $alumno = Alumno::where('id',Auth::id())->first();
            $turno = $alumno->datos_academicos->turno;
            $gradoXcursar = $alumno->datos_academicos->grado_a_cursar;

            $grupos_idioma = DB::table('grupos')
              ->where('activo', '=', 1)
              ->where('turno', '=',$turno)
              ->where('cupo', '>', 0)
              ->where('clv_grupo', 'like', '0'.$gradoXcursar.'%')
              ->orderBy('clv_grupo')
              ->pluck('clv_grupo');
              // dd($idioma);
              //
            return redirect()->route('alumno.reinscripcion', ['grupos' => $grupos_idioma, 'idioma' => $idioma]);
         }
         else {
            Auth::logout();
         }
      }
      return redirect()->intended('alumno/login');
   }
}
