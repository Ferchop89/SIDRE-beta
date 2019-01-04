<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AsignaturaGrupo extends Model
{
    //
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
   protected $table = "asignatura_grupo";

   public function asignatura(){
      return $this->belongsTo(Asignaturas::class);
   }
   public function grupo(){
      return $this->belongsTo(Grupos::class);
   }
}
