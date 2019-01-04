<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asignaturas extends Model
{
   protected $hidden = [
      'hrs_teori',
      'hrs_pract',
      'total_hrs',
      'created_at',
      'updated_at',
   ];
    // relationship
   public function grupos(){
      return $this->belongsToMany('App\Models\Grupos', 'asignatura_grupo', 'asignatura_id', 'grupo_id')->withTimestamps();
   }
}
