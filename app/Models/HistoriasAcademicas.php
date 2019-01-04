<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoriasAcademicas extends Model
{
   protected $table = 'historias_academicas';
   protected $fillable = [
      'num_cta',
      'plantel',
      'carrera',
      'clv_plan',
      'csa_ingreso',
      'clv_asignatura',
      'axo_sem',
      'calif',
      'grupo',
      'folio',
      'tipo_exa',
   ];
   protected $hidden = [
      'plantel',
      'created_at',
      'updated_at',
   ];
}
