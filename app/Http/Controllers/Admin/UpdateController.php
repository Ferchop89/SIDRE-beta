<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{HistoriasAcademicas, Alumno, DatosAcademicos, Asignaturas};
use Session;
use Carbon\Carbon;

use Illuminate\Support\Collection as Collection;

class UpdateController extends Controller
{
   public function materiasCursadas($asignaturas){
      $priD = $primero = 13;
      $segD = $segundo = 13;
      $terD = $tercero = 14;
      $cuaD = $cuarto = 12;
      $quiD = $quinto = 12;
      $sexD = $sexto = 9;
      foreach ($asignaturas as $key => $asignatura) {
         $grado = substr($key, 0, 2);
         switch ($grado) {
            case '11':
               $primero--;
            break;
            case '12':
               $segundo--;
            break;
            case '13':
               $tercero--;
            break;
            case '14':
               $cuarto--;
            break;
            case '15':
               $quinto--;
            break;
            case '16':
               $sexto--;
            break;
            case '17':
               $sexto--;
            break;
         }
      }
      $cambio = array();
      if($primero != $priD)
      {
         $cambio['1'] = $primero;
      }
      if($segundo != $segD)
      {
         $cambio['2'] = $segundo;
      }
      if($tercero != $terD)
      {
         $cambio['3'] = $tercero;
      }
      if($cuarto != $cuaD)
      {
         $cambio['4'] = $cuarto;
      }
      if($quinto != $quiD)
      {
         $cambio['5'] = $quinto;
      }
      if($sexto != $sexD)
      {
         $cambio['6'] = $sexto;
      }
      return $cambio;
   }
   public function gradoAcursar($materiasCursadas){
      if(!empty($materiasCursadas)){
         for ($i=6; $i >= 1; $i--) {
            if (array_key_exists($i, $materiasCursadas)) {
               if($materiasCursadas[$i] < 4 && $materiasCursadas[$i] >= 0){
                  return $i+1;
               }
               else {
                  return $i;
               }
            }
         }
      }
   }
   public function promedios(){
      ini_set('max_execution_time', '70000');
      $horaIni = Carbon::now();
      // $matriculas= Alumno::select('id', 'num_cta')->where('activo', 1)->orderBy('id', 'asc')->get();
      $matriculas= Alumno::select('id', 'num_cta')->where('activo', 1)->where('fecha_reinscripcion', '!=', null)->orderBy('id', 'asc')->get();
      // $matriculas= Alumno::select('id', 'num_cta')->where('activo', 1)->orderBy('id', 'asc')->limit(100)->get();
      // $matriculas2 = [
      //    '317287468',
      //    '317275337',
      //    '317207220',
      //    '317122626',
      //    '317078176',
      //    '115005969',
      //    '115002054',
      //    '115001538',
      //    '114006640',
      //    '114002738',
      //    '114001872',
      //    '114001315',
      //    '113003079',
      //    '112000824',
      //    '111002007',
      //    '317330595',
      //    '317270545',
      //    '317093380',
      //    '317053838',
      //    '316349859',
      //    '316051965',
      //    '316006783',
      //    '315337608',
      //    '315231551',
      //    '315167256',
      //    '316343204',
      //    '316323851',
      //    '316277644',
      //    '316272735',
      //    '316260130',
      //    '316206945',
      //    '316161783',
      //    '316158428',
      //    '316137126',
      //    '316127769',
      //    '317189252',
      //    '317184453',
      //    '317129797',
      //    '317123726',
      //    '317112609',
      //    '317242478',
      //    '317239577',
      //    '317236411',
      //    '317230505',
      //    '317186983',
      //    '317277063',
      //    '317273364',
      //    '317267077',
      //    '317247600',
      //    '317243671',
      //    '317333149',
      //    '317329753',
      //    '317327687',
      //    '317318746',
      //    '317317581',
      //    '317331138',
      //    '317330997',
      //    '317330502',
      //    '317330117',
      //    '317330038',
      //    '117000647',
      //    '117000599',
      //    '117000537',
      //    '117000506',
      //    '117000403',
      //    '316057888',
      //    '315309249',
      //    '315287857',
      //    '315285688',
      //    '315124129',
      //    '315119059',
      //    '115004632',
      //    '115003958',
      //    '115001040',
      //    '111001471',
      //    '316327354',
      //    '316274911',
      //    '316221616',
      //    '316169002',
      //    '316161989',
      //    '316117560',
      //    '316007670',
      //    '315304127',
      //    '315285781',
      //    '315282089',
      //    '316315182',
      //    '316284512',
      //    '316248491',
      //    '316228244',
      //    '316226202',
      //    '315306286',
      //    '315303584',
      //    '315285994',
      //    '315279573',
      //    '315279456',
      //    '316235600',
      //    '316230540',
      //    '316228488',
      //    '316226817',
      //    '316226240',
      //    '316329121',
      //    '316327237',
      //    '316326838',
      //    '316326120',
      //    '316325477',
      //    '316229320',
      //    '316229265',
      //    '316228732',
      //    '316228495',
      //    '316228000',
      //    '115004292',
      //    '115003800',
      //    '115003381',
      //    '115003202',
      //    '115001569',
      //    '115005770',
      //    '115005158',
      //    '115004003',
      //    '115002779',
      //    '115000634',
      //    '116008145',
      //    '116007708',
      //    '116007636',
      //    '116007485',
      //    '116007258',
      //    '116004257',
      //    '116004109',
      //    '116003676',
      //    '116003607',
      //    '116003353',
      //    '116004831',
      //    '116004635',
      //    '116004611',
      //    '116004604',
      //    '116004570',
      //    '316350141',
      //    '116007014',
      //    '116007007',
      //    '116006990',
      //    '116006983',
      //    '116006969',
      // ];
      $matriculas2 = [
         '318368098',
         '116006969',
         '317333149',
         '317330117',
         '316326838',
         '316228495',
         '116006990',
         '116006969',
         '116006983',
         '116007007',
         '118490016',
      ];
      // $matriculas = Collection::make();
      foreach ($matriculas as $key => $value) {
         $apoyo= Alumno::select('id', 'num_cta')->where('activo', 1)->where('num_cta', $value)->orderBy('id', 'asc')->get();
         foreach ($apoyo as $key => $value2) {
            $matriculas->push($value2);
         }
      }
      //
      $registros_almacenados = 0;
      $registros_no_localizados = 0;
      foreach ($matriculas as $matricula) {
         $asignaturas=HistoriasAcademicas::select('clv_asignatura', 'calif', 'tipo_exa')
               ->where('num_cta', $matricula->num_cta)
               ->orderBy('clv_asignatura', 'asc')
               ->get()
               ->groupBy('clv_asignatura');
         $reins=HistoriasAcademicas::select()
         ->where('num_cta', $matricula->num_cta)
         ->get();
         $axo_max = $reins->max('axo_sem');
         $axo_min = $reins->min('axo_sem');
         if (count($asignaturas) > 0) {
            $matAprobadas=0;
            $debe=0;
            $promedio=0.0;
            $divisor=0;
            $mat_debe = array();
            $calif=array();
            $asig = array();
            foreach ($asignaturas as $key => $value) {
               // dd($asignaturas, $key, $value);
               $CxA=array();
               foreach ($value as $dato) {
                  // dd($dato);
                  if($dato->calif=='NP')
                  {
                     $dato->calif=0;
                  }
                  array_push($CxA, $dato->calif);
               }
               if(max($CxA)=='0')
               {
                  array_push($mat_debe, $dato->clv_asignatura);
                  $debe++;
               }
               elseif (max($CxA)=='AC') {
                  $matAprobadas++;
                  $asig[$key] = max($CxA);
               }
               elseif(max($CxA)==5){
                  array_push($mat_debe, $dato->clv_asignatura);
                  $debe++;
                  array_push($calif, max($CxA));
               }
               else {
                  $matAprobadas++;
                  array_push($calif, max($CxA));
                  $asig[$key] = max($CxA);
               }
            }
            $grado = $this->grado($asig);
            $materiasCursadas = $this->materiasCursadas($asig);
            $divisor=count($calif);
            foreach ($calif as $value) {
               $promedio = $promedio+$value;
            }
            if($divisor==0)
            {
                $promedio=0;
            }
            else {
                $promedio=round($promedio/$divisor, 2);
            }
            $result=DatosAcademicos::find($matricula->id);
            $registros_almacenados++;
            if(!empty($result))
            {
                if($debe == 0)
                {
                   $result->REG = 1;
                }
                elseif ($debe < 4) {
                   $result->IRR = 1;
                }
                else {
                   $result->REP = 1;
                }
                $result->materias_aprobadas = $matAprobadas;
                $result->materias_no_aprobadas = $debe;
                $result->clvs_asignaturas_NA = serialize($mat_debe);
                $result->promedio = $promedio;
                $result->axo_inicial = $axo_min;
                $result->axo_actual = $axo_max;
                $result->grado_a_cursar = $this->gradoAcursar($materiasCursadas);
                $result->save();
                // echo "<pre>";
                // var_dump($result->grado_a_cursar);
                // echo "</pre>";
            }
            else {
                $table = new DatosAcademicos();
                if($debe == 0)
                {
                   $table->REG = 1;
                }
                elseif ($debe < 4) {
                   $table->IRR = 1;
                }
                else {
                   $table->REP = 1;
                }
                $table->id = $matricula->id;
                $table->materias_aprobadas = $matAprobadas;
                $table->materias_no_aprobadas = $debe;
                $table->clvs_asignaturas_NA = serialize($mat_debe);
                $table->promedio = $promedio;
                $table->axo_inicial = $axo_min;
                $table->axo_actual = $axo_max;
                $table->grado_a_cursar = $this->gradoAcursar($materiasCursadas);
                $table->modalidades_id = 'ESC';
                $table->save();
                \Log::debug("El número de cuenta ". $matricula." se creo en la tabla Datos academicos");
            }
         }
         else {
             $registros_no_localizados++;
            \Log::debug("El número de cuenta ". $matricula." no se encuentra en el historial academico");
         }
      }
      $horaFin = Carbon::now();
      Session::flash('message', "Se procesaron ".count($matriculas)." registros: <br><p class='sangria'>".$registros_almacenados." se almacenaron y ".$registros_no_localizados." no fueron localizados. </p><br>El proceso comenzó ".$horaIni->format('d-m-Y H:i:s')." y termino ".$horaFin->format('d-m-Y H:i:s'));
      return redirect()->route('admin_dashboard');
   }
   public function calculaTurno(){
      $horaIni = Carbon::now();
      $turno_primeros=0;
      $turno_segundos=0;
      $sin_turno = 999999;
      $sin_derecho = array();
      $derecho = array();
      for ($i=10; $i >=5 ; $i--) {
         $primeros = array();
         $segundos = array();
         $Alumnos = DatosAcademicos::select('id', 'materias_aprobadas', 'materias_no_aprobadas', 'promedio', 'REG', 'IRR', 'REP')
                        ->where('promedio', '<=', $i )
                        ->where('promedio', '>', $i-1 )
                        ->where('PAart22', '>', '20180')
                        ->orderBy('promedio', 'desc')
                        ->get();
         // dd($Alumnos);
         foreach ($Alumnos as $value) {
            // dd($value);
            if($value->promedio <= $i && $value->promedio > $i-1)
            {
               if($value->materias_no_aprobadas == 0)
               {
                  $turno_primeros++;
                  array_push($primeros, [$turno_primeros => [$value->id, $value->promedio]]);
               }
               elseif ($value->materias_no_aprobadas < 4) {
                  $turno_segundos++;
                  array_push($segundos, [$turno_segundos => [$value->id, $value->promedio]]);
               }
               elseif ($value->materias_no_aprobadas >= 4 ) {
                  $sin_turno++;
                  array_push($sin_derecho, [$sin_turno => [$value->id, $value->promedio]]);
               }
            }
         }
         // dd($primeros, $segundos, $sin_derecho);
         foreach ($primeros as $value) {
            array_push($derecho, $value);
         }
         foreach ($segundos as $value) {
            array_push($derecho, $value);
         }
      }
      // dd($derecho);
      $registros=0;
      foreach ($derecho as $turno) {
         foreach ($turno as $value) {
            $alumno=Alumno::find($value[0]);
            $alumno->num_reinscripcion = $registros+1;
            $alumno->update();
         }
         $registros++;
      }
      $sin_turno = 999999;
      foreach ($sin_derecho as $turno) {
         foreach ($turno as $value) {
            $alumno=Alumno::find($value[0]);
            $alumno->num_reinscripcion = $sin_turno+1;
            $alumno->update();
         }
         $sin_turno++;
         $registros++;
      }
      $horaFin = Carbon::now();
      Session::flash('message', "Fueron asignados turnos de reinscripción.<br><br>Se procesaron ".$registros." registros:<p class='sangria'>".count($derecho)." alumnos seleccionaran el grupo que deseen y ".count($sin_derecho)." se reinscribiran en automático.</p><br>El proceso comenzó ".$horaIni->format('d-m-Y H:i:s')." y termino ".$horaFin->format('d-m-Y H:i:s'));
      return redirect()->route('admin_dashboard');
   }
   public function asignarFechas(){
      $alumnosCD = Alumno::select('id', 'num_reinscripcion', 'fecha_reinscripcion')
                  ->where('num_reinscripcion', '>=', '1')
                  ->where('num_reinscripcion', '<=', '999999')
                  ->orderBy('num_reinscripcion', 'asc')
                  ->get();
      $fecha = Carbon::create(2018,06,20, 9, 0, 0)->format('Y-m-d H:i');
      $i=1;
      $alum_x_10 = 40;
      foreach ($alumnosCD as $value) {
            $alumno = Alumno::find($value->id);
            $alumno->fecha_reinscripcion = $fecha;
            $alumno->update();
            if($i%$alum_x_10==0){
               $i=0;
               $fecha = date('Y-m-d H:i',strtotime('+10 minutes',strtotime($fecha)));
            }
            if(Carbon::parse($fecha)->format('H:i')=='13:00')
            {
               $fecha = date('Y-m-d H:i',strtotime('+2 hour',strtotime($fecha)));
            }
            elseif(Carbon::parse($fecha)->format('H:i')=='19:00')
            {
               $fecha = date('Y-m-d H:i',strtotime('-10 hour',strtotime($fecha)));
               $fecha = date('Y-m-d H:i',strtotime('+1 day',strtotime($fecha)));

            }
            $i++;
      }
      Session::flash('message', "Fueron asignados fechas de reinscripción. Se procesaron ".count($alumnosCD)." registros.");
      return redirect()->route('admin_dashboard');
   }
   public function grado($asig){
      foreach ($asig as $key => $value) {
         $grado = substr($key, 1, 1);
      }

   }
   public function inscribeRecursadores(){

   }
}
