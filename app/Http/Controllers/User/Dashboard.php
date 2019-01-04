<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{Alumno, Adeudo};
use Session;

class Dashboard extends Controller
{
    public function index()
    {
      // dd(request()->session()->store());
        return view('user/dashboard');
    }
    public function buscarAlumno()
    {
      return view('user/buscar_alumno');
   }
   public function buscarAlumnoPost()
   {
      request()->validate([
         'num_cta' => 'required|numeric|digits:9'
         ],[
          'num_cta.required' => 'El campo es obligatorio',
          'num_cta.numeric' => 'El campo debe contener solo números',
          'num_cta.digits'  => 'El campo debe ser de 9 dígitos',
      ]);
      $alumno=Alumno::where('num_cta', request()->input('num_cta'))->first();
      // dd($alumno);

      if($alumno!=null)
      {
         $nombre = $alumno->nombre_completo($alumno->id);
         $adeudos = Adeudo::all()
         ->where('alumno_id', $alumno->id)
         ->where('entrego', 0)
         ->groupBy('departamento_id');
         // dd($adeudos);
         $adeu = array();
         $msj = '';
         if(!empty($adeudos))
         {
            foreach ($adeudos as $adeudo) {
               foreach ($adeudo as $value) {
                  if($value->departamento_id == 1)
                  {
                     $fecha=$value->fecha_incidente;
                     if($fecha != null) {
                        $fecha=Carbon::parse($value->fecha_incidente)->format('d/m/Y');
                     }
                     $dato=array(
                        $value->departamento->id => [
                           $value->departamento->nombre,
                           $value->titulo, $value->autor,
                           $fecha
                           ]
                     );
                     array_push($adeu, $dato);
                  }
                  elseif ($value->departamento_id == 2 || $value->departamento_id == 3) {
                     $fecha=$value->fecha_incidente;
                     if($fecha != null) {
                        $fecha=Carbon::parse($value->fecha_incidente)->format('d/m/Y');
                     }
                     $dato=array(
                        $value->departamento->id => [
                           $value->departamento->nombre,
                           $value->material,
                           $fecha
                           ]
                     );
                     array_push($adeu, $dato);
                  }
               }
            }
            if(empty($adeu))
               $msj = "El alumno no cuenta con adeudos";
         }
         $ArrayAlumno =
            [
               $alumno->num_cta,
               $alumno->comentarios,
               $alumno->activo,
               $adeu
            ];
         return view('user/adeudos', ['alumno' => $alumno->num_cta, 'datos' => $ArrayAlumno, 'nombre' => $nombre, 'mensaje' => $msj, 'adeudos' => $adeu]);
      }
      else {
         Session::flash('message', "El número de cuenta no existe");
         return redirect()->route('user.buscar.alumno');
      }

   }
}
