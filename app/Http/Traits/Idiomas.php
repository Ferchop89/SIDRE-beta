<?php

namespace App\Http\Traits;
// use App\Models\{SolicitudSep, Web_Service, Alumno, LotesUnam, Cancela};
use Illuminate\Support\Facades\Auth;
use App\Models\{DatosAcademicos};
use Carbon\Carbon;
use DB;
use Session;

trait Idiomas {

   public function idiomaGrado($idiomaAnterior){
      $idioma = "";
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
            // code...1506
            break;
      }
      return $idioma;
   }
   public function idiomaAnterior($grado){
      $rep = DatosAcademicos::select('REP')->find(Auth::user()->id);
      if(!empty($rep)){
         if($rep->REP == 0)
         {
            $grado = $grado-1;
         }
      }
      switch ($grado) {
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
                     ->whereIn('clv_asignatura', ['1603', '1604', '1605', '1606', '1607', '1608'])
                     ->first();
               break;
         default:
            $idioma = "";
            break;
      }
      if(!empty($idioma)){
         return $idioma->clv_asignatura;
      }
      return $idioma;
   }
}
