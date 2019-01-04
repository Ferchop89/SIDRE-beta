<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Alumno;
use Session;

class Dashboard extends Controller
{
    public function index()
    {
      // dd(request()->session()->store());
        return view('admin/dashboard');
    }
    public function buscarAlumno()
    {
      return view('admin/buscar_alumno');
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
         $ArrayAlumno =
            [
               $alumno->num_cta,
               $alumno->comentarios,
               $alumno->activo
            ];
         // dd($alumno);
         return view('admin/editarAlumno', ['alumno' => $alumno->num_cta, 'datos' => $ArrayAlumno, 'nombre' => $nombre]);
      }
      else {
         Session::flash('message', "El número de cuenta no existe");
         return redirect()->route('buscar.alumno');
      }

   }
   public function editarAlumnoSave(){
      // dd("Entre");
      $num_cta=request()->input("num_cta");
      $comentario=request()->input("comentario");
      $activo=request()->input("activo");
      if($activo == 'on')
      {
         $activo = 1;
      }
      else {
         $activo = 0;
      }
      $alumno = Alumno::where('num_cta', $num_cta)->first();
      $alumno->comentarios = $comentario;
      $alumno->activo = $activo;
      $alumno->save();
      Session::flash('message', "Los datos se han almacenado satisfactoriamente");
      return redirect()->route('admin_dashboard');
   }
}
