<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grupos extends Model
{
   protected $table = 'grupos';
   protected $casts = [
     'activo' => 'boolean'
   ];

   // relationship
   public function asignaturas(){
     return $this->belongsToMany('App\Models\Asignaturas', 'asignatura_grupo', 'grupo_id', 'asignatura_id')->withTimestamps();
   }
   public function profesores(){
     return $this->belongsToMany('App\Models\DatosGeneralesProfesores', 'grupo_profesor', 'grupo_id', 'datos_generales_profesores_id')->withTimestamps();
   }
   // public function cambio(){
   //   return $this->belongsToMany('App\Models\DatosGeneralesProfesores', 'grupo_profesor', 'datos_generales_profesores_cambio_id', 'grupo_id')->withTimestamps();
   // }
}
