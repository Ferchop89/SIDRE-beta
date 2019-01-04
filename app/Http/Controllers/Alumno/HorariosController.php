<?php

namespace App\Http\Controllers\Alumno;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{Grupos, AsignaturaGrupo, Asignaturas};

use DB;
use Carbon;

class HorariosController extends Controller
{
   public function showGrupo(){

      $grupo = request()->grupo;
      $info = DB::table('grupos')->where('clv_grupo', 'like', '%'.substr($grupo,1,4).'%')->get();
      // $secciones = DB::table('grupos')->where('clv_grupo', '201A')->orderBy('clv_grupo')->get();
      $secciones=array();
      foreach ($info as  $value) {
          array_push($secciones, $value->clv_grupo);
      }

      $datos=array();
      foreach ($secciones as $value) {
          $dato = Grupos::where('clv_grupo', $value)->first();
          array_push($datos, $dato);
      }

      // $dato = Grupos::where('clv_grupo', $grupo)->first();
      // $asignaturas = $dato->asignaturas()->get();
      $informacion=array();
      $hora=Carbon::createFromTime(6, 10, 0, 'America/Mexico_City')->format('H:i');
      foreach ($datos as $value) {
          $horario=AsignaturaGrupo::where('grupo_id', $value->id)->get()->groupBy('grupo_id')->toArray();
          array_push($informacion, $horario);
      }
      // dd($informacion);
      // dd($horario, $informacion);
      // $horario=AsignaturaGrupo::where('grupo_id', $dato->id)->get()->groupBy('grupo_id')->toArray();
      // dd($datos, $dato, $horario, $informacion);
      // dd($horario);
      $dias = array(
          'LU' => '1',
          'MA' => '2',
          'MI' => '3',
          'JU' => '4',
          'VI' => '5',
      );
      $horarios = array(array());
      $horariosF = array(array());
      for ($i=0; $i <= 18; $i++) {

          for ($j=0; $j < 6; $j++) {
              if($j==0)
              {
                  $horarios[$i][$j]=$hora."<br/> a <br/>".date('H:i',strtotime('+50 minutes',strtotime($hora)));
              }
              else {
                  $horarios[$i][$j] = "";
              }
          }
          $hora=date('H:i',strtotime('+50 minutes',strtotime($hora)));
          // code...
      }
      $infografia = array();
      for ($j=0; $j < count($informacion); $j++) {
         foreach ($informacion[$j] as $value) {
            foreach ($value as $clave => $valor){
               for($i=1; $i < 6; $i++){
                  $diahora = $valor['HR_'.$i];
                  if ($diahora!=null) {
                     $asignatura=$valor['asignatura_id'];
                     $salon=$valor['SALON_'.$i];
                     if($salon=="")
                     {
                        $salon = "Por definir";
                     }
                     $columna=$dias[substr($diahora,0,2)];
                     $renglon=substr($diahora,2,2);
                     $cero=substr($renglon,0,1);
                     if ($cero==0) {
                        $renglon=substr($diahora,3,1);
                     }
                     // dd($diahora, $asignatura, $salon, $columna, $renglon, $cero);
                     $k=0;
                     if($j==0){
                        if($horarios[$renglon][$columna]!=""){
                           $horarios[$renglon][$columna] .= "<div class='base'><strong>".Asignaturas::find($asignatura)->nombre."</strong><br/><br/>SALÓN: ".$salon."</div>";
                           // var_dump($horarios[$renglon][$columna]);
                        }
                        else {
                           $horarios[$renglon][$columna] = "<div class='base'><strong>".Asignaturas::find($asignatura)->nombre."</strong><br/><br/>SALÓN: ".$salon."</div>";
                           $infografia[$j] = "<div class='cube_base'></div><div class='seccion'>Grupo fijo</div>";
                        }
                         // $horarios[$renglon][$columna] = "<div class='base'>".Asignaturas::find($asignatura)->nombre."<br/><br/>SALÓN: ".$salon."<br /><br />".DatosGeneralesProfesores::find($asignatura)->nombre."</div>";
                     }
                     elseif ($j==1) {
                         // dd($infografia[$j]);
                         // dd($valor);
                         //var_dump($horarios[$renglon][$columna]);
                        $infografia[$j] = "<div class='cube_A'></div><div class='seccion'>Sección A</div>";
                        $horarios[$renglon][$columna].= "<div class='A'><strong>".Asignaturas::find($asignatura)->nombre."</strong><br/><br/>SALÓN: ".$salon."<br/>SECCIÓN A</div>";
                     }
                     elseif ($j==2) {
                        $infografia[$j] = "<div class='cube_B'></div><div class='seccion'>Sección B</div>";
                        $horarios[$renglon][$columna].= "<div class='B'><strong>".Asignaturas::find($asignatura)->nombre."</strong><br/><br/>SALÓN: ".$salon."<br/>SECCIÓN B</div>";

                     }
                     elseif ($j==3) {
                        $infografia[$j] = "<div class='cube_C'></div><div class='seccion'>Sección C</div>";
                        $horarios[$renglon][$columna].= "<div class='C'><strong>".Asignaturas::find($asignatura)->nombre."</strong><br/><br/>SALÓN: ".$salon."<br/>SECCIÓN C</div>";
                     }
                     elseif ($j==4) {
                        $infografia[$j] = "<div class='cube_D'></div><div class='seccion'>Sección D</div>";
                        $horarios[$renglon][$columna].= "<div class='D'><strong>".Asignaturas::find($asignatura)->nombre."</strong><br/><br/>SALÓN: ".$salon."<br/>SECCIÓN D</div>";
                     }
                     elseif ($j==5) {
                        $infografia[$j] = "<div class='cube_E'></div><div class='seccion'>Sección E</div>";
                        $horarios[$renglon][$columna].= "<div class='E'><strong>".Asignaturas::find($asignatura)->nombre."</strong><br/><br/>SALÓN: ".$salon."<br/>SECCIÓN E</div>";
                     }
                  }
               }
            }
         }
      }
      for ($i=0; $i <= 18; $i++)
      {
          $info = "";
          for ($j=1; $j < 6; $j++)
          {
              // var_dump(substr_count($horarios[$i][$j], "class"));
              // dd("hola");
              if(substr_count($horarios[$i][$j], "class") == 2)
              {
                 // var_dump($i, $horarios[$i][$j]);
                 // var_dump(substr_count($horarios[$i][$j], "class"));
                 $info.= $horarios[$i][$j];
                 $horarios[$i][$j] = "<div class='ambas'>".$horarios[$i][$j]."</div>";
                 // dd($info);
              }
              elseif (substr_count($horarios[$i][$j], "class") >= 3) {
                 // code...
                 $info.= $horarios[$i][$j];
                 $horarios[$i][$j] = "<div class='tres'>".$horarios[$i][$j]."</div>";
              }
              else {

                 $info.= $horarios[$i][$j];
                 // dd($info);
              }
           }
           // var_dump($info);
           if(empty($info))
           {
              // var_dump($i);
              unset($horarios[$i]);
           }
     }
     // dd($horarios);
      $horarios = array_values($horarios);


      $asignaturas=array();
      $dato = Grupos::where('clv_grupo', 'like', '%'.substr($grupo,1,4).'%')->get();
      foreach ($dato as $value) {
          // dd($value->asignaturas());
          array_push($asignaturas, $value->asignaturas()->get());
      }
      // dd($asignaturas);
      // dd($horarios);
      // dd($datos);
      if(!empty($datos))
      {
         return View('alumno.grupo', ['dato'=>$datos[0], 'hora' => $hora, 'horario' =>$horarios, 'infografia' => $infografia]);
      }

   }
   public function showOptativa()
   {
      $optativa = request()->optativa;
      $materia = substr($optativa, 0, 4);
      $grupo = substr($optativa, 4, 8);
      $area = request()->area;
      // dd($optativa, $materia, $grupo,$area);
      // dd($area, $optativa);
      // $datos = Asignaturas::where('clv_asignatura', $materia)->where('area', $area)->first();
      // dd($datos);
      // $idAsig = $datos->id;
      $info = Grupos::select('id')->where('clv_grupo', $grupo)->first()->toArray();
      $idGrupo = $info['id'];

      $info = Asignaturas::select('id')->where('clv_asignatura', $materia)->first()->toArray();
      $idAsig = $info['id'];
      // dd($info, $datos->id);
      // $grupos = array();
      // foreach ($datos as $key => $value) {
      //    dd($value->id);
      // }
      // dd($datos);
      //
      //
      // $info = DB::table('grupos')->where('clv_grupo', 'like', '%'.substr($grupo,1,4).'%')->get();
      // $secciones = DB::table('grupos')->where('clv_grupo', '201A')->orderBy('clv_grupo')->get();

      // $secciones=array();
      // foreach ($info as  $value) {
      //     array_push($secciones, $value->clv_grupo);
      // }

      // $datos=array();
      // foreach ($secciones as $value) {
      //     $dato = Grupos::where('clv_grupo', $value)->first();
      //     array_push($datos, $dato);
      // }

      // $dato = Grupos::where('clv_grupo', $grupo)->first();
      // $asignaturas = $dato->asignaturas()->get();

      $informacion=array();
      $hora=Carbon::createFromTime(6, 10, 0, 'America/Mexico_City')->format('H:i');
      // foreach ($datos as $value) {
      $informacion[0]=AsignaturaGrupo::where('grupo_id', $idGrupo)->where('asignatura_id', $idAsig)->get()->groupBy('grupo_id')->toArray();
      // dd($informacion);
      // dd($horario);
      // array_push($informacion, $horario);
      // }
      // dd($informacion);
      // dd($horario, $informacion);
      // $horario=AsignaturaGrupo::where('grupo_id', $dato->id)->get()->groupBy('grupo_id')->toArray();
      // dd($datos, $dato, $horario, $informacion);
      // dd($horario);
      $dias = array(
          'LU' => '1',
          'MA' => '2',
          'MI' => '3',
          'JU' => '4',
          'VI' => '5',
      );
      $horarios = array(array());
      $horariosF = array(array());
      for ($i=0; $i <= 18; $i++) {

          for ($j=0; $j < 6; $j++) {
              if($j==0)
              {
                  $horarios[$i][$j]=$hora."<br/> a <br/>".date('H:i',strtotime('+50 minutes',strtotime($hora)));
              }
              else {
                  $horarios[$i][$j] = "";
              }
          }
          $hora=date('H:i',strtotime('+50 minutes',strtotime($hora)));
          // code...
      }
      $infografia = array();
      for ($j=0; $j < count($informacion); $j++) {
         foreach ($informacion[$j] as $value) {
            foreach ($value as $clave => $valor){
               for($i=1; $i < 6; $i++){
                  $diahora = $valor['HR_'.$i];
                  if ($diahora!=null) {
                     $asignatura=$valor['asignatura_id'];
                     $salon=$valor['SALON_'.$i];
                     if($salon=="")
                     {
                        $salon = "Por definir";
                     }
                     $columna=$dias[substr($diahora,0,2)];
                     $renglon=substr($diahora,2,2);
                     $cero=substr($renglon,0,1);
                     if ($cero==0) {
                        $renglon=substr($diahora,3,1);
                     }
                     // dd($diahora, $asignatura, $salon, $columna, $renglon, $cero);
                     $k=0;
                     if($j==0){
                        if($horarios[$renglon][$columna]!=""){
                           $horarios[$renglon][$columna] .= "<div class='base'><strong>".Asignaturas::find($asignatura)->nombre."</strong><br/><br/>SALÓN: ".$salon."</div>";
                           // var_dump($horarios[$renglon][$columna]);
                        }
                        else {
                           $horarios[$renglon][$columna] = "<div class='base'><strong>".Asignaturas::find($asignatura)->nombre."</strong><br/><br/>SALÓN: ".$salon."</div>";
                           $infografia[$j] = "<div class='cube_base'></div><div class='seccion'>Grupo fijo</div>";
                        }
                         // $horarios[$renglon][$columna] = "<div class='base'>".Asignaturas::find($asignatura)->nombre."<br/><br/>SALÓN: ".$salon."<br /><br />".DatosGeneralesProfesores::find($asignatura)->nombre."</div>";
                     }
                     elseif ($j==1) {
                         // dd($infografia[$j]);
                         // dd($valor);
                         //var_dump($horarios[$renglon][$columna]);
                        $infografia[$j] = "<div class='cube_A'></div><div class='seccion'>Sección A</div>";
                        $horarios[$renglon][$columna].= "<div class='A'><strong>".Asignaturas::find($asignatura)->nombre."</strong><br/><br/>SALÓN: ".$salon."<br/>SECCIÓN A</div>";
                     }
                     elseif ($j==2) {
                        $infografia[$j] = "<div class='cube_B'></div><div class='seccion'>Sección B</div>";
                        $horarios[$renglon][$columna].= "<div class='B'><strong>".Asignaturas::find($asignatura)->nombre."</strong><br/><br/>SALÓN: ".$salon."<br/>SECCIÓN B</div>";

                     }
                     elseif ($j==3) {
                        $infografia[$j] = "<div class='cube_C'></div><div class='seccion'>Sección C</div>";
                        $horarios[$renglon][$columna].= "<div class='C'><strong>".Asignaturas::find($asignatura)->nombre."</strong><br/><br/>SALÓN: ".$salon."<br/>SECCIÓN C</div>";
                     }
                     elseif ($j==4) {
                        $infografia[$j] = "<div class='cube_D'></div><div class='seccion'>Sección D</div>";
                        $horarios[$renglon][$columna].= "<div class='D'><strong>".Asignaturas::find($asignatura)->nombre."</strong><br/><br/>SALÓN: ".$salon."<br/>SECCIÓN D</div>";
                     }
                     elseif ($j==5) {
                        $infografia[$j] = "<div class='cube_E'></div><div class='seccion'>Sección E</div>";
                        $horarios[$renglon][$columna].= "<div class='E'><strong>".Asignaturas::find($asignatura)->nombre."</strong><br/><br/>SALÓN: ".$salon."<br/>SECCIÓN E</div>";
                     }
                  }
               }
            }
         }
      }
      // dd($infografia, $informacion);
      // dd($infografia, $informacion);
      for ($i=0; $i <= 18; $i++)
      {
          $info = "";
          for ($j=1; $j < 6; $j++)
          {
              // var_dump(substr_count($horarios[$i][$j], "class"));
              // dd("hola");
              if(substr_count($horarios[$i][$j], "class") == 2)
              {
                 // var_dump($i, $horarios[$i][$j]);
                 // var_dump(substr_count($horarios[$i][$j], "class"));
                 $info.= $horarios[$i][$j];
                 $horarios[$i][$j] = "<div class='ambas'>".$horarios[$i][$j]."</div>";
                 // dd($info);
              }
              elseif (substr_count($horarios[$i][$j], "class") >= 3) {
                 // code...
                 $info.= $horarios[$i][$j];
                 $horarios[$i][$j] = "<div class='tres'>".$horarios[$i][$j]."</div>";
              }
              else {

                 $info.= $horarios[$i][$j];
                 // dd($info);
              }
           }
           // var_dump($info);
           if(empty($info))
           {
              // var_dump($i);
              unset($horarios[$i]);
           }
     }
     // dd($horarios);
      $horarios = array_values($horarios);


      // $asignaturas=array();
      // $dato = Grupos::where('clv_grupo', 'like', '%'.substr($grupo,1,4).'%')->get();
      // foreach ($dato as $value) {
      //     // dd($value->asignaturas());
      //     array_push($asignaturas, $value->asignaturas()->get());
      // }
      // dd($asignaturas);
      // dd($horarios);
      // dd($datos);
      // if(!empty($datos))
      // {
      // dd($hora, $horarios, $infografia);
         return View('alumno.grupo', ['dato'=>$grupo,'hora' => $hora, 'horario' =>$horarios, 'infografia' => $infografia]);
      // }

   }
}
