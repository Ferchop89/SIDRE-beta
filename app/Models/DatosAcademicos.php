<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DatosAcademicos extends Model
{
    protected $fillable = [
      'id',
    ];

   public function modalidades(){
      return $this->belongsTo(Modalidades::class);
   }
}
