<?php

namespace App\Models;

use App\Models\DatosPersonalesAlumnos;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class Alumno extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    protected $table = 'alumnos';

    protected $fillable = [
      'num_cta',
    ];

    protected $hidden = [
      'password',
      'remember_token',
    ];

    protected $casts = [
      'activo' => 'boolean'
    ];

    public function isAdmin()
    {
        return false;
    }
    public static function fechaNac($id){
      return DatosPersonalesAlumnos::where('id', $id)->value('fecha_nac');
    }
    public function nombre_completo($id){
      $alumno_id = Alumno::where('id', $id)->value('datos_personales_alumnos_id');
      $nombre = DatosPersonalesAlumnos::where('id', $alumno_id)->get();
      return $nombre[0]->nombre.' '.$nombre[0]->app.' '.$nombre[0]->apm;
    }
    public function datos_personales_alumnos(){
      return $this->belongsTo(DatosPersonalesAlumnos::class);
    }
    public function domicilio_alumnos(){
      return $this->belongsTo(DomicilioAlumnos::class);
    }
    public function tutores(){
      return $this->belongsTo(Tutores::class);
    }
    public function datos_medicos(){
      return $this->belongsTo(DatosMedicos::class);
    }
    public function datos_emergencias(){
      return $this->belongsTo(DatosEmergencia::class);
    }
    public function datos_academicos(){
      return $this->belongsTo(DatosAcademicos::class);
   }
   public function grupo(){
      return $this->belongsTo(Grupos::class);
   }

}
