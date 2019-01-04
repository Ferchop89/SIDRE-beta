<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DatosGeneralesProfesores extends Model
{
   // relationship
   public function grupos(){
     return $this->belongsToMany('App\Models\Grupos', 'grupo_profesor', 'grupo_id', 'datos_generales_profesores_id')->withTimestamps();
   }
   public function cambio(){
     return $this->belongsToMany('App\Models\Grupos', 'grupo_profesor', 'grupo_id', 'datos_generales_profesores_cambio_id')->withTimestamps();
   }
   public function nombramientos(){
      return $this->belongsTo(Nombramientos::class);
   }
   public function departamento(){
      return $this->belongsTo(Departamentos::class);
   }
   public function grado_estudios(){
      return $this->belongsTo(GradoEstudios::class);
  }

}
