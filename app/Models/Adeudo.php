<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adeudo extends Model
{
   protected $casts = [
      'entrego' => 'boolean'
   ];

   public function alumno(){
      return $this->belongsTo(Alumno::class);
   }
   public function departamento(){
     return $this->belongsTo(Departamentos::class);
  }
}
