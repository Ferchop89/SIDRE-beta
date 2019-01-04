<?php

namespace App\Http\Controllers\Admin;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Alumno;
use Session;
use DB;
use Carbon;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ImportController extends Controller
{
   public function alumnosImport(){
      $file =  htmlentities('C://xampp/htdocs/SIDRE beta/public/load/Alumnos.xlsx');
      if(file_exists($file))
      {
         $datos=Excel::load('public/load/Alumnos.xlsx', function($archivo){
            $result=$archivo->get();
            dd($result);
            foreach ($result as $key => $value) {
               $table = new Alumno();
               $table->id = $value->id;
               $table->num_cta = $value->num_cta;
               $table->password = bcrypt($value->password);
               $table->foto = $value->foto;
               $table->datos_personales_alumnos_id = $value->id;
               $table->datos_academicos_id = $value->id;
               $table->save();
            }
         })->get();
         Session::flash('message', "La información de los alumnos se almaceno satisfactoriamente.<br><br> Se almacenaron ".count($datos)." registros.");
      }
      else {
         Session::flash('danger', "Error al cargar información. El archivo Alumnos.xlsx no fue localizado");
      }
      return redirect()->route('admin_dashboard');
   }
   public function HistoriasAcademicasImport(){
      DB::table("historias_academicas")->truncate();
      $file =  htmlentities('C://xampp/htdocs/SIDRE beta/public/load/HistoriasAcademicas.csv');
      if(file_exists($file))
      {
         $query = "LOAD DATA INFILE '".$file."' ";
         $query .= "INTO TABLE historias_academicas ";
         $query .= "FIELDS TERMINATED BY ',' ";
         $query .= "LINES TERMINATED BY '\\n' ";
         $pdo = DB::connection()->getPdo()->exec($query);
         Session::flash('message', "Se cargaron las historias academicas");
      }
      else{
         Session::flash('danger', "Error al cargar información. El archivo HistoriasAcademicas.csv no fue localizado");
      }
      return redirect()->route('admin_dashboard');

   }

}
