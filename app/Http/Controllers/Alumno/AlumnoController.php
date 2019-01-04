<?php
namespace App\Http\Controllers\Alumno;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\{Alumno, Adeudo, AsignaturaGrupo, DatosPersonalesAlumnos, DatosAcademicos, Departamentos, DomicilioAlumnos, Tutores, DatosMedicos, DatosEmergencia, Grupos, Asignaturas};
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Traits\Idiomas;
use Session;

class AlumnoController extends Controller
{
   use Idiomas;
    public function index()
    {
      $alumno = Alumno::where('id',Auth::id())->first();
      // $user=Alumno::find(Auth::user()->id);
      $fecha_nac=Carbon::parse($alumno->fechaNac(Auth::user()->datos_personales_alumnos_id))->format('dmY');
      // // dd($fecha_nac);
      if(Hash::check($fecha_nac, $alumno->password))
      {
         return view('alumno.changePassword')->with('alumno', $alumno);
      }
      else {
        return view('alumno/dashboard');
      }
    }
    public function showChangePassword(){
      $alumno = Alumno::where('id',Auth::id())->first();
      return view('alumno.changePassword', ['alumno'=> $alumno]);
   }

    public function update(Alumno $alumno, Request $request){
      $user = request()->validate([
          'password' => ['required','min:8', 'max:8', 'confirmed'],
       ],[
          'password.required' => 'El campo Contraseña es obligatorio',
          'password.min' => 'Tú contraseña debe contener 8 caracteres',
          'password.max' => 'Tú contraseña no debe sobrepasar los 8 caracteres',
      ]);

      $alumno->password = bcrypt($request->input('password'));
      $alumno->save();
      return view('alumno/steps');
    }

   public function steps(){
      if (Auth::check())
      {
         if(Auth::user()->activo)
         {
            return view('alumno.steps');
         }
         else {
            Auth::logout();
         }
      }
      else {
         return redirect()->intended('alumno/login');
      }
	}
   public function stepsMsj(){
      if((redirect()->getUrlGenerator()->previous() == route('alumno.adeudo', ['alumno' => Auth::user()->id])))
      {
         Session::flash('message', "Tus datos fueron almacenados satisfactoriamente.<br><br>No olvides mantenerte al pendiente de tu(s) adeudo(s).");
      }
      else {
         Session::flash('message', "Tus datos fueron almacenados satisfactoriamente.");
      }
      return redirect()->route('alumno.pasos');
      // return redirect()->route('reporte.datosAlumno', ['alumno' => Auth::User()->id]);
   }
   public function avisoPrivacidad(){
      return view('alumno.avisoPrivacidad');
   }
   public function showAdeudos(){
      // dd($alumno);
      $alumno = Alumno::where('id',Auth::id())->first();
      $adeudos = Adeudo::all()
      ->where('alumno_id', $alumno->id)
      ->where('entrego', 0)
      ->groupBy('departamento_id');
      // dd($adeudos);
      if(!empty($adeudos))
      {
         $adeu=array();
         foreach ($adeudos as $adeudo) {
            foreach ($adeudo as $value) {
               if($value->departamento_id == 1)
               {
                  $fecha=$value->fecha_incidente;
                  if($fecha != null) {
                     $fecha=Carbon::parse($value->fecha_incidente)->format('d/m/Y');
                  }
                  $dato=array(
                     $value->departamento->id => [
                        $value->departamento->nombre,
                        $value->titulo, $value->autor,
                        $fecha
                        ]
                  );
                  array_push($adeu, $dato);
                  // echo "<pre>";
                  // var_dump($value->departamento->id, $value->titulo, $value->autor, Carbon::parse($value->fecha_incidente)->format('d/m/Y'));
                  // echo "</pre>";
               }
               elseif ($value->departamento_id == 2 || $value->departamento_id == 3) {
                  $fecha=$value->fecha_incidente;
                  if($fecha != null) {
                     $fecha=Carbon::parse($value->fecha_incidente)->format('d/m/Y');
                  }
                  $dato=array(
                     $value->departamento->id => [
                        $value->departamento->nombre,
                        $value->material,
                        $fecha
                        ]
                  );
                  // dd($value->fecha_incidente);
                  array_push($adeu, $dato);
                  // echo "<pre>";
                  // var_dump($value->departamento->id, $value->material, Carbon::parse($value->fecha_incidente)->format('d/m/Y'));
                  // echo "</pre>";
               }
            }
         }
      }
      return view('alumno.adeudos', ['alumno'=> $alumno, 'adeudos' => $adeu]);
   }
   public function showDataUpdate(){
      $alumno = Alumno::where('id',Auth::id())->first();
      if ($alumno->datos_academicos_id == null) {
         DatosAcademicos::create([
            'id' => $alumno->id,
         ]);
         $alumno->datos_academicos_id = $alumno->id;
         $alumno->save();
      }
      if($alumno->domicilio_alumnos_id == null)
      {
         DomicilioAlumnos::create([
            'id' => $alumno->id,
         ]);
         $alumno->domicilio_alumnos_id = $alumno->id;
         $alumno->save();
      }
      if ($alumno->tutores_id == null) {
         Tutores::create([
            'id' => $alumno->id,
         ]);
         $alumno->tutores_id = $alumno->id;
         $alumno->save();
      }
      if ($alumno->datos_medicos_id == null) {
         DatosMedicos::create([
            'id' => $alumno->id,
         ]);
         $alumno->datos_medicos_id = $alumno->id;
         $alumno->save();
      }
      if ($alumno->datos_emergencias_id == null) {
         DatosEmergencia::create([
            'id' => $alumno->id,
         ]);
         $alumno->datos_emergencias_id = $alumno->id;
         $alumno->save();
      }
      if ($alumno->datos_academicos_id == null) {
         DatosAcademicos::create([
            'id' => $alumno->id,
         ]);
         $alumno->datos_academicos_id = $alumno->id;
         $alumno->save();
      }
      // $adeudos = Adeudo::all()
      // ->where('alumno_id', $alumno->id)
      // ->where('entrego', 0)
      // ->groupBy('departamento_id');
      // $extranjeros = ItemExtranjero()::all()

		return view('alumno.DataUpdate', ['alumno'=> $alumno]);
	}
    public function DataUpdate(Alumno $alumno, Request $request){
      $data = request()->validate([
         // 'apellido_pat_alumno' => ['required','max:40', 'regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ.\s]/'],
         'apellido_pat_alumno' => [],
         'apellido_mat_alumno' => [],
         'nombre_alumno' => ['required','max:60', 'regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ.\s]/'],
         'fecha_nac' => ['required', 'date'],
         'curp_alumno' => ['required', 'regex:/^[A-Z][A,E,I,O,U,X][A-Z]{2}[0-9]{2}[0-1][0-9][0-3][0-9][M,H][A-Z]{2}[B,C,D,F,G,H,J,K,L,M,N,Ñ,P,Q,R,S,T,V,W,X,Y,Z]{3}[0-9,A-Z][0-9]/'],
         'genero' => ['required'],
         'peso' => ['required', 'numeric'],
         'estatura' => ['required', 'numeric'],
         'nacionalidad' => ['required'],
         'lugar_nac' => [],
         'nacionalidadExt' => [],
         'escuela_proce' => ['required', 'string'],

         'cp' => ['required', 'regex:/^[0-9]{5}/'],
         'calle_numero' => ['required', 'string'],
         'colonia' => ['required', 'string'],
         'del_mun' => ['required', 'regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ.\s]/'],
         'estado' => ['required'],
         'tel_casa_alumno' => ['required', 'min:10'],
         'tel_celular_alumno' => ['required', 'min:13'],
         'correo' => ['required', 'email'],

         'apellido_pat_tutor' => ['required','max:40', 'regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ.\s]/'],
         'apellido_mat_tutor' => ['required','max:40', 'regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ.\s]/'],
         'nombre_tutor' => ['required','max:60', 'regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ.\s]/'],
         'curp_tutor' => ['required', 'regex:/^[A-Z][A,E,I,O,U,X][A-Z]{2}[0-9]{2}[0-1][0-9][0-3][0-9][M,H][A-Z]{2}[B,C,D,F,G,H,J,K,L,M,N,Ñ,P,Q,R,S,T,V,W,X,Y,Z]{3}[0-9,A-Z][0-9]/'],
         'tel_fijo_tutor' => ['required', 'min:10'],
         'tel_celular_tutor' => ['required', 'min:13'],
         'mail_tutor' => ['required', 'email'],
         'lugar_trabajo' => ['required'],
         'ocupacion' => ['required'],

         'tipo_sangre' => ['required'],
         'seguro_medico' => ['required'],
         'alergias' => ['string'],
         'tratamiento_especial' => ['required', 'regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ.\s]/'],
         'padecimientos' => ['required', 'regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ.\s]/'],

         'apellido_pat_contacto' => ['required','max:40', 'regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ.\s]/'],
         'apellido_mat_contacto' => ['required','max:40', 'regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ.\s]/'],
         'nombre_contacto' => ['required','max:60', 'regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ.\s]/'],
         'parentesco' => ['required','min:4', 'regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ.\s]/'],
         'tel_fijo_contacto' => ['required', 'min:10'],
         'tel_celular_contacto' => ['required', 'min:13'],
         'info_adicional' => [],
      ],[
         // 'apellido_pat_alumno.required' => 'El campo Apellido Paterno es obligatorio',
         // 'apellido_pat_alumno.max' => 'El campo Apellido Paterno no puede superar los 40 caracteres',
         // 'apellido_pat_alumno.regex' => 'El campo Apellido Paterno solo debe contener letras',
         // 'apellido_mat_alumno.required' => 'El campo Apellido Materno es obligatorio',
         // 'apellido_mat_alumno.max' => 'El campo Apellido Materno no puede superar los 40 caracteres',
         // 'apellido_mat_alumno.regex' => 'El campo Apellido Materno solo debe contener letras',
         'nombre_alumno.required' => 'El campo Nombre es obligatorio',
         'nombre_alumno.max' => 'El campo Nombre no puede superar los 60 caracteres',
         'nombre_alumno.regex' => 'El campo Nombre solo debe contener letras',
         'fecha_nac.required' => 'El campo Fecha de Nacimiento es obligatorio',
         'fecha_nac.date' => 'No es una fecha valida',
         'curp_alumno.required' => 'El campo CURP es obligatorio',
         'curp_alumno.regex' => 'El CURP tiene un error',
         'genero.required' => 'Selecciona una opción en el campo género',
         'peso.required' => 'El campo Peso es obligatorio',
         'peso.numeric' => 'El campo Peso solo acepta números con punto decimal',
         'estatura.required' => 'El campo Estatura es obligatorio',
         'estatura.numeric' => 'El campo Estatura solo acepta números con punto decimal',
         'nacionalidad.required' => 'Selecciona una opción en el campo nacionalidad',
         'escuela_proce.required' => 'El campo Escuela de Procedencia es obligatorio',
         'escuela_proce.string' => 'El campo Escuela de Procedencia solo debe contener letras, números y caracteres especiales',

         'cp.required' => 'El campo Código Postal es obligatorio',
         'cp.regex' => 'El campo Código Postal solo debe contener números',
         'calle_numero.required' => 'El campo Calle y Número es obligatorio',
         'calle_numero.string' => 'El campo Calle y Número solo debe contener letras, números y caracteres especiales',
         'colonia.required' => 'El campo Colonia es obligatorio',
         'colonia.string' => 'El campo Colonia solo debe contener letras, números y caracteres especiales',
         'del_mun.required' => 'El campo Delegación o Municipio es obligatorio',
         'del_mun.regex' => 'El campo Delegación o Municipio solo debe contener letras',
         'estado.required' => 'El campo Estado es obligatorio',
         'tel_casa_alumno.required' => 'El campo Teléfono de Casa es obligatorio',
         'tel_casa_alumno.min' => 'El campo Teléfono de Casa debe contener 10 caracteres. Verifica que estes incluyendo la clave Lada de tu localidad',
         'tel_celular_alumno.required' => 'El campo Teléfono Celular es obligatorio',
         'tel_celular_alumno.min' => 'El campo Teléfono Celular debe contener 13 caracteres. Verifica que estes incluyendo la clave Lada de tu localidad, así como el 044 ó 045',
         'correo.required' => 'El campo Correo Electrónico es obligatorio',
         'correo.email' => 'El campo Correo Electrónico no es válido',

         'apellido_pat_tutor.required' => 'El campo Apellido Paterno es obligatorio',
         'apellido_pat_tutor.max' => 'El campo Apellido Paterno no puede superar los 40 caracteres',
         'apellido_pat_tutor.regex' => 'El campo Apellido Paterno solo debe contener letras',
         'apellido_mat_tutor.required' => 'El campo Apellido Materno es obligatorio',
         'apellido_mat_tutor.max' => 'El campo Apellido Materno no puede superar los 40 caracteres',
         'apellido_mat_tutor.regex' => 'El campo Apellido Materno solo debe contener letras',
         'nombre_tutor.required' => 'El campo Nombre es obligatorio',
         'nombre_tutor.max' => 'El campo Nombre no puede superar los 60 caracteres',
         'nombre_tutor.regex' => 'El campo Nombre solo debe contener letras',
         'curp_tutor.required' => 'El campo CURP es obligatorio',
         'curp_tutor.regex' => 'El CURP tiene un error',
         'tel_fijo_tutor.required' => 'El campo Teléfono fijo es obligatorio',
         'tel_fijo_tutor.min' => 'El campo Teléfono fijo debe contener 10 caracteres. Verifica que estes incluyendo la clave Lada de tu localidad',
         'tel_celular_tutor.required' => 'El campo Teléfono Celular es obligatorio',
         'tel_celular_tutor.min' => 'El campo Teléfono Celular debe contener 13 caracteres. Verifica que estes incluyendo la clave Lada de tu localidad, así como el 044 ó 045',
         'mail_tutor.required' => 'El campo Correo Electrónico es obligatorio',
         'mail_tutor.email' => 'El campo Correo Electrónico no es correcto',
         'lugar_trabajo.required' => 'Selecciona una opción en el campo Lugar de trabajo',
         'ocupacion.required' => 'Selecciona una opción en el campo ocupación',

         'tipo_sangre.required' => 'Selecciona una opción en el campo Tipo de Sangre',
         'seguro_medico.required' => 'Selecciona una opción en el campo Seguro Médico',
         'alergias.string' => 'El campo Alergias debe contener letras y números',
         'tratamiento_especial.required' => 'El campo Tratamientos Especiales es obligatorio',
         'tratamiento_especial.regex' => 'El campo Tratamientos Especiales debe contener letras y números',
         'padecimientos.required' => 'El campo Padecimientos es obligatorio',
         'padecimientos.regex' => 'El campo Padecimientos debe contener letras y números',

         'apellido_pat_contacto.required' => 'El campo Apellido Paterno es obligatorio',
         'apellido_pat_contacto.max' => 'El campo Apellido Paterno no puede superar los 40 caracteres',
         'apellido_pat_contacto.regex' => 'El campo Apellido Paterno solo debe contener letras',
         'apellido_mat_contacto.required' => 'El campo Apellido Materno es obligatorio',
         'apellido_mat_contacto.max' => 'El campo Apellido Materno no puede superar los 40 caracteres',
         'apellido_mat_contacto.regex' => 'El campo Apellido Materno solo debe contener letras',
         'nombre_contacto.required' => 'El campo Nombre es obligatorio',
         'nombre_contacto.max' => 'El campo Nombre no puede superar los 60 caracteres',
         'nombre_contacto.regex' => 'El campo Nombre solo debe contener letras',
         'parentesco.required' => 'El campo Parentesco es obligatorio',
         'parentesco.min' => 'El campo Parentesco debe contener al menos 4 caracteres',
         'parentesco.regex' => 'El campo Parentesco debe contener unicamente letras',
         'tel_fijo_contacto.required' => 'El campo Teléfono fijo es obligatorio',
         'tel_fijo_contacto.min' => 'El campo Teléfono fijo debe contener 10 caracteres. Verifica que estes incluyendo la clave Lada de tu localidad',
         'tel_celular_contacto.required' => 'El campo Teléfono Celular es obligatorio',
         'tel_celular_contacto.min' => 'El campo Teléfono Celular debe contener 13 caracteres. Verifica que estes incluyendo la clave Lada de tu localidad, así como el 044 ó 045',
         // 'info_adicional.required' => 'El campo Datos Adicionales es obligatorio',
     ]);
     $datPerAlum=DatosPersonalesAlumnos::find($alumno->datos_personales_alumnos_id);
     $datPerAlum->fecha_nac=$data['fecha_nac'];

     $datPerAlum->sexo=$data['genero'];
     $datPerAlum->peso=$data['peso'];
     $datPerAlum->estatura=$data['estatura'];
     $datPerAlum->nacionalidad=$data['nacionalidad'];
     if($data['nacionalidad'] == "E"){
        $datPerAlum->lugar_nac=$data['nacionalidadExt'];
        //CURP generico para extranjeros
        $datPerAlum->curp="XAXX010101XXXXXX01";
     }
     else {
        $datPerAlum->curp=$data['curp_alumno'];
        $datPerAlum->lugar_nac=$data['lugar_nac'];
     }

     $datPerAlum->save();
     // $alumno->update($data);

     $datAcademicos = DatosAcademicos::find($alumno->datos_personales_alumnos_id);
     $datAcademicos->esc_procedencia = $data['escuela_proce'];
     $datAcademicos->save();

     $domicilioAlumnos = DomicilioAlumnos::find($alumno->domicilio_alumnos_id);
     $domicilioAlumnos->cp = $data['cp'];
     $domicilioAlumnos->calle_cnum = $data['calle_numero'];
     $domicilioAlumnos->colonia = $data['colonia'];
     $domicilioAlumnos->del_mun = $data ['del_mun'];
     $domicilioAlumnos->estado = $data ['estado'];
     $domicilioAlumnos->telefono_fijo = $data['tel_casa_alumno'];
     $domicilioAlumnos->telefono_celular = $data['tel_celular_alumno'];
     $domicilioAlumnos->correo = $data['correo'];
     $domicilioAlumnos->save();
     // $alumno->email = $data['correo'];
     // $alumno->save();

     $datTutores = Tutores::find($alumno->datos_personales_alumnos_id);
     $datTutores->app = $data['apellido_pat_tutor'];
     $datTutores->apm = $data['apellido_mat_tutor'];
     $datTutores->nombre = $data['nombre_tutor'];
     $datTutores->curp = $data['curp_tutor'];
     $datTutores->telefono_fijo = $data['tel_fijo_tutor'];
     $datTutores->telefono_celular = $data['tel_celular_tutor'];
     $datTutores->correo = $data['mail_tutor'];
     $datTutores->lugar_trabajo = $data['lugar_trabajo'];
     $datTutores->ocupacion = $data['ocupacion'];
     $datTutores->save();

     $datMedicos = DatosMedicos::find($alumno->datos_personales_alumnos_id);
     $datMedicos->tipo_sangre = $data['tipo_sangre'];
     $datMedicos->seguro_medico = $data['seguro_medico'];
     $datMedicos->alergias = $data['alergias'];
     $datMedicos->tratamiento_especial = $data['tratamiento_especial'];
     $datMedicos->padecimientos = $data['padecimientos'];
     $datMedicos->save();
     //
     $datEmergencia = DatosEmergencia::find($alumno->datos_personales_alumnos_id);
     $datEmergencia->app = $data['apellido_pat_contacto'];
     $datEmergencia->apm = $data['apellido_mat_contacto'];
     $datEmergencia->nombre = $data['nombre_contacto'];
     $datEmergencia->parentesco = $data ['parentesco'];
     $datEmergencia->telefono_fijo = $data ['tel_fijo_contacto'];
     $datEmergencia->telefono_celular = $data ['tel_celular_contacto'];
     $datEmergencia->info_adicional = $data ['info_adicional'];
     // dd($datEmergencia->info_adicional = $data ['info_adicional']);
     $datEmergencia->save();
      // $alumno->update($data);
      $adeudos = Adeudo::all()
      ->where('alumno_id', $alumno->id)
      ->where('entrego', 0)
      ->groupBy('departamento_id');
      // if($adeudos->isNotEmpty())
      // {
      //    return redirect()->route('alumno.adeudo', ['alumno' => $alumno->id]);
      // }
      // else
      // {
      //    return redirect()->route('alumno.pasos.msj');
      // }
      return redirect()->route('alumno.adeudo', ['alumno' => $alumno->id]);
	}
      public function turnoReinscripcion(){
         // dd($alumno->fecha_reinscripcion);
         $alumno = Alumno::where('id',Auth::id())->first();
         if($alumno->fecha_reinscripcion != null)
         {
            $fecha = Carbon::parse($alumno->fecha_reinscripcion)->format('d/m/Y');
            $hora = Carbon::parse($alumno->fecha_reinscripcion)->format('H:i');
         }
         else {
            $fecha = null;
            $hora = null;
            \Log::debug("El número de cuenta ". $alumno->num_cta." no cuenta con turno de reinscripción");
         }
         return view('alumno.turnoReinscripcion', ['alumno' => $alumno, 'fecha' => $fecha, 'hora' => $hora]);
      }
      public function showReinscripcion(){
         $alumno = Alumno::where('id',Auth::id())->first();
         if($alumno->fecha_reinscripcion != null)
         {
            $fecha = Carbon::parse($alumno->fecha_reinscripcion)->format('d/m/Y');
            $hora = Carbon::parse($alumno->fecha_reinscripcion)->format('H:i');
         }
         else {
            $fecha = null;
            $hora = null;
            \Log::debug("El número de cuenta ". $alumno->num_cta." no cuenta con turno de reinscripción");
            return view('alumno.reinscripcion', ['alumno' => $alumno, 'fecha' => $fecha, 'hora' => $hora]);
         }
         return view('alumno.reinscripcion', ['alumno' => $alumno, 'fecha' => $fecha, 'hora' => $hora]);
      }
      public function postReinscripcion(){
         $alumno = Alumno::where('id',Auth::id())->first();
         if($alumno->grupo_id == null)
         {
            $gradoXcursar = $alumno->datos_academicos->grado_a_cursar;
            if (Auth::check())
            {
               if(Auth::user()->activo)
               {
                  if(Auth::user()->datos_emergencias_id == null)
                  {
                     Session::flash('message', "Para poder realizar este proceso, es necesario que actualices tú información");
                     Session::flash('alert-class', 'alert-danger');
                     return redirect()->route('alumno.showReinscripcion', Auth::user()->num_cta);
                  }
                  if(Auth::user()->fecha_reinscripcion == null){
                     Session::flash('message', "No tienes derecho a elegir grupo. Serás reinscrito en tú grupo anterior.");
                     Session::flash('alert-class', 'alert-danger');
                     return redirect()->route('alumno.pasos');
                  }
                  if($gradoXcursar == 5)
                  {
                     return redirect()->route("alumno.idiomas", $gradoXcursar);
                  }
                  elseif ($gradoXcursar == 6) {
                     return redirect()->route("alumno.areas_re", $gradoXcursar);
                  }
                  else {
                     return redirect()->route("alumno.reinscripcion");
                  }
               }
               else {
                  Auth::logout();
               }
            }
            return redirect()->intended('alumno/login');
         }
         else{
            return redirect()->route('alumno.reinscripcion.fin');
         }
      }
      public function reinscripcion(){
         $alumno = Alumno::where('id',Auth::id())->first();
         if($alumno->grupo_id == null)
         {
            $gradoXcursar = $alumno->datos_academicos->grado_a_cursar;
            $turno = $alumno->datos_academicos->turno;
            if (Auth::check())
            {
               if(Auth::user()->activo)
               {
                   $grupos = DB::table('grupos')
                     ->where('activo', '=', 1)
                     ->where('turno', '=',$turno)
                     ->where('cupo', '>', 0)
                     // ->where('clv_grupo', '<>', '0600')
                     // ->where('clv_grupo', '<>', '0650')
                     ->where('clv_grupo', 'like', '0'.$gradoXcursar.'%')
                     ->orderBy('clv_grupo')
                     ->pluck('clv_grupo');
                  if(isset($_GET['idioma']))
                  {
                     return view('alumno.reinscripcionGrupo')->with(['grupos' => $grupos, 'idioma' => $_GET['idioma']]);
                  }
                  else{
                     return view('alumno.reinscripcionGrupo')->with('grupos', $grupos);
                  }
               }
               else {
                  Auth::logout();
               }
            }
            return redirect()->intended('alumno/login');
         }
         else{
            return redirect()->route('alumno.reinscripcion.fin');
         }

      }
      public function reinscripcionGrupos(){
         $user = request()->validate([
            'grupo' => ['required'],
           ],[
               'grupo.required' => 'Selecciona una opción en el campo Grupo',
         ]);
         $grupo = Grupos::where('clv_grupo', request()->input('grupo'))
            ->where('cupo', '>', '0')
            ->where('activo', '1')
            ->first();
         // dd($grupo->asignaturas);

         $gradoXcursar = DatosAcademicos::select('grado_a_cursar')->find(Auth::user()->id)->grado_a_cursar;

         $clv_secciones = array();
         if($grupo != null)
         {
            // $asignaturas = $grupo->asignaturas;
            $asignaturas = array();
            $asignaturasGrupo = AsignaturaGrupo::where('grupo_id', $grupo->id)->get();
            foreach ($asignaturasGrupo as $key => $asignaturaGrupo) {
               $asignatura = Asignaturas::where('colegio', "!=", 'LENGUAS VIVAS')->find($asignaturaGrupo->asignatura_id);
               if($asignatura != null)
               {
                  array_push($asignaturas, $asignatura);
               }
            }
            $idiomaAnterior = $this->idiomaAnterior($gradoXcursar);
            $clvIdioma = $this->idiomaGrado($idiomaAnterior);
            $asignatura = Asignaturas::where('clv_asignatura', $clvIdioma)->get();
            foreach ($asignatura as $key => $value) {
                  array_push($asignaturas, $value);
            }


            // $asignaturas = $this->unIdioma($asignaturas, $idiomaAnterior);
            // dd($asignaturas);
               // if($vale)
            if(isset($_GET['idioma']))
            {
               $asignaturas = $grupo->asignaturas;
               foreach ($asignaturas as $key => $asignatura) {
                  if($asignatura->clv_asignatura >= "1506" && $asignatura->clv_asignatura <= "1511"){
                     if($asignatura->clv_asignatura != $_GET['idioma']){
                        // dd($key);
                        unset($asignaturas[$key]);
                     }
                  }
               }

               $asignaturasSinIdiomas = array();
               foreach ($asignaturas as $key => $asignatura) {
                  array_push($asignaturasSinIdiomas, $asignatura);
               }
               $asignaturas = $asignaturasSinIdiomas;
            }
            $profesores = $grupo->profesores;

            $clv_grupo = substr($grupo->clv_grupo, 1);
            $secciones = Grupos::where('clv_grupo', 'LIKE', $clv_grupo.'%')
                     ->where('activo', 1)
                     ->where('cupo', '>', 0)
                     ->get();
            foreach ($secciones as $value) {
               array_push($clv_secciones, $value->clv_grupo);
            }
            $sec_asignaturas = array();
            $sec_profesores = array();

            for ($i=0; $i < count($clv_secciones) ; $i++) {
               $dato = Grupos::where('clv_grupo', $clv_secciones[$i])
                        ->where('activo', 1)
                        ->where('cupo', '>', 0)
                        ->first();
               if ($dato->asignaturas->isNotEmpty()) {
                  $query_salon = AsignaturaGrupo::where('grupo_id', $dato->id)
                           ->where('asignatura_id', $dato->asignaturas[0]->id)
                           ->first();
                           array_push($sec_asignaturas, $dato->asignaturas);
                           array_push($sec_profesores, $dato->profesores[0]->nombre." ".$dato->profesores[0]->app." ".$dato->profesores[0]->apm);
               }
            }
         }

         else {
            Session::flash('message', "El grupo que seleccionaste ya no cuenta con vacantes disponibles. Selecciona otro grupo");
            return redirect()->route('alumno.reinscripcion');
         }
         // dd($grupo, $clv_grupo, $asignaturas, $secciones);
         return view('alumno.reinscripcion-seccion', ['clv_grupo' => $clv_grupo, 'asignaturas' => $asignaturas, 'clv_secciones' => $clv_secciones, 'sec_asignaturas' => $sec_asignaturas, 'profesores' => $profesores, 'sec_profesores' => $sec_profesores]);
      }
      // public function idiomaGrado($idiomaAnterior){
      //    $idioma = "";
      //    switch ($idiomaAnterior) {
      //       /*Ingles*/
      //       case '1108':
      //          $idioma = '1208';
      //          break;
      //       case '1208':
      //          $idioma = '1306';
      //          break;
      //       // case '1306':
      //       //    $idioma = '1407';
      //       //    break;
      //       case '1407':
      //          $idioma = '1506';
      //          break;
      //       case '1506':
      //          $idioma = '1603';
      //          break;
      //       case '1510':
      //          $idioma = '1607';
      //          break;
      //       /*FRANCES*/
      //       case '1114':
      //          $idioma = '1214';
      //          break;
      //       case '1214':
      //          $idioma = '1314';
      //          break;
      //       case '1408':
      //          $idioma = '1507';
      //          break;
      //       case '1507':
      //          $idioma = '1604';
      //          break;
      //       case '1511':
      //          $idioma = '1608';
      //          break;
      //       /*ALEMAN*/
      //       case '1509':
      //          $idioma = '1605';
      //          break;
      //       /*ITALIANO*/
      //       case '1508':
      //          $idioma = '1606';
      //          break;
      //       default:
      //          // code...1506
      //          break;
      //    }
      //    return $idioma;
      // }
      // public function idiomaAnterior($grado){
      //    $rep = DatosAcademicos::select('REP')->find(Auth::user()->id);
      //    if(!empty($rep)){
      //       if($rep->REP == 0)
      //       {
      //          $grado = $grado-1;
      //       }
      //    }
      //    switch ($grado) {
      //       case '1':
      //          $idioma = DB::table('historias_academicas')
      //                      ->where('num_cta', Auth::user()->num_cta)
      //                      ->whereIn('clv_asignatura', ['1108', '1114'])
      //                      ->first();
      //          break;
      //       case '2':
      //       $idioma = DB::table('historias_academicas')
      //                   ->where('num_cta', Auth::user()->num_cta)
      //                   ->whereIn('clv_asignatura', ['1208', '1214'])
      //                   ->first();
      //          break;
      //       case '3':
      //       $idioma = DB::table('historias_academicas')
      //                   ->where('num_cta', Auth::user()->num_cta)
      //                   ->whereIn('clv_asignatura', ['1306', '1314'])
      //                   ->first();
      //          break;
      //       case '4':
      //       $idioma = DB::table('historias_academicas')
      //                   ->where('num_cta', Auth::user()->num_cta)
      //                   ->whereIn('clv_asignatura', ['1407', '1408'])
      //                   ->first();
      //             break;
      //       default:
      //          $idioma = "";
      //          break;
      //    }
      //    if(!empty($idioma)){
      //       return $idioma->clv_asignatura;
      //    }
      //    return $idioma;
      // }
      public function reinscripcionGruposPost(){
         $grupo = request()->input('grup');
         $cupo = Grupos::select('id','cupo')
            ->where('clv_grupo', 'LIKE', '%'.$grupo)
            ->where('activo', 1)
            ->first();
         $check = $cupo->cupo;
         if($check > 0)
         {
            $reincripcion = Grupos::find($cupo->id);
            $reincripcion->cupo = $check-1;
            $reincripcion->save();

            $Alumno = Alumno::find(Auth::user()->id);
            $Alumno->grupo_id = $cupo->id;
            $Alumno->clv_seccion = null;
            $Alumno->save();
         }
         else {
            Session::flash('message', "El grupo que seleccionaste ya no cuenta con vacantes disponibles. Selecciona otro grupo");
            return redirect()->route('alumno.reinscripcion');
         }
         return redirect()->route('alumno.reinscripcion.fin');

      }
      public function reinscripcionSeccion(){
         if(isset($_POST['grup']))
         {
            if(!empty($_POST['sec'])){
               foreach($_POST['sec'] as $dato){
                  $seccion = $dato;
               }
            }
         }
         if(isset($_POST['idioma']))
         {
            $idioma = $_POST['idioma'];
         }
         if(isset($_POST['area']))
         {
            $area = $_POST['area'];
            if(isset($_POST['optativas'])){
               if($area == 1 || $area == 2)
               {
                  if(count($_POST['optativas']) == 1)
                  {
                     $optativa = $_POST['optativas'];
                  }
                  else {
                     Session::flash('message', "Debes seleccionar una optativa");
                     Session::flash('alert-class', 'alert-danger');
                     return redirect()->route('alumno.formAreaRe', ['area'=>$area]);
                  }
               }
               elseif ($area == 3 || $area == 4) {
                  if(count($_POST['optativas']) == 2)
                  {
                     $optativa = $_POST['optativas'];
                  }
                  else {
                     Session::flash('alert-class', 'alert-danger');
                     Session::flash('message', "Debes seleccionar dos optativas");
                     return redirect()->route('alumno.formAreaRe', ['area'=>$area]);
                  }
               }
            }
            else {
               if($area == 1 || $area == 2)
               {
                     Session::flash('message', "Debes seleccionar una optativa");
                     Session::flash('alert-class', 'alert-danger');
                     return redirect()->route('alumno.formAreaRe', ['area'=>$area]);
               }
               elseif ($area == 3 || $area == 4) {
                     Session::flash('alert-class', 'alert-danger');
                     Session::flash('message', "Debes seleccionar dos optativas");
                     return redirect()->route('alumno.formAreaRe', ['area'=>$area]);
               }
            }
         }
         $grupo = request()->input('grup');
         $cupo_sec = Grupos::select('id','cupo')
            ->where('clv_grupo', 'LIKE', $seccion.'%')
            ->where('activo', 1)
            ->first();
         $check_sec = $cupo_sec->cupo;
         if($check_sec > 0)
         {
            $reincripcion = Grupos::find($cupo_sec->id);
            $reincripcion->cupo = $check_sec-1;
            $reincripcion->save();

            $Alumno = Alumno::find(Auth::user()->id);
            $Alumno->clv_seccion = $cupo_sec->id;

            if(isset($optativa[0]))
            {
               $Alumno->optativa1 = $optativa[0];
               if(isset($optativa[1]))
               {
                  $Alumno->optativa2 = $optativa[1];
               }
            }
            $Alumno->save();

            $cupo = Grupos::select('id','cupo')
               ->where('clv_grupo', 'LIKE', '%'.$grupo)
               ->where('activo', 1)
               ->first();
            $check = $cupo->cupo;
            if($check > 0)
            {
               $reincripcion = Grupos::find($cupo->id);
               $reincripcion->cupo = $check-1;
               $reincripcion->save();

               $Alumno = Alumno::find(Auth::user()->id);
               $Alumno->grupo_id = $cupo->id;
               if(isset($idioma)){
                  $Alumno->clv_idioma = $idioma;

               }
               if(isset($optativa[0]))
               {
                  $Alumno->optativa1 = $optativa[0];
               }
               if(isset($optativa[1]))
               {
                  $Alumno->optativa2 = $opativa[1];
               }
               $Alumno->save();
            }
         }
         else {
            Session::flash('message', "La sección que seleccionaste ya no cuenta con vacantes disponibles. Selecciona otra seccion o grupo");
            return redirect()->route('alumno.reinscripcion');
         }
         return redirect()->route('alumno.reinscripcion.fin');
      }
      public function showReinscripcionFin()
      {
         $grupo = Grupos::find(Auth::User()->grupo_id);
         $seccion = Grupos::find(Auth::User()->clv_seccion);
         return view('alumno.reinscripcionFin', ['grupo' => $grupo->clv_grupo, 'seccion' => $seccion]);
      }

      public function reinscripcionGruposArea(){
         $user = request()->validate([
            'grupo' => ['required'],
           ],[
               'grupo.required' => 'Selecciona una opción en el campo Grupo',
         ]);
         $grupo = Grupos::where('clv_grupo', request()->input('grupo'))
            ->where('cupo', '>', '0')
            ->where('activo', '1')
            ->first();
         // dd($grupo->asignaturas);

         $gradoXcursar = DatosAcademicos::select('grado_a_cursar')->find(Auth::user()->id)->grado_a_cursar;

         $clv_secciones = array();
         if($grupo != null)
         {
            // $asignaturas = $grupo->asignaturas;
            $asignaturas = array();
            $asignaturasGrupo = AsignaturaGrupo::where('grupo_id', $grupo->id)->get();
            foreach ($asignaturasGrupo as $key => $asignaturaGrupo) {
               $asignatura = Asignaturas::where('colegio', "!=", 'LENGUAS VIVAS')->find($asignaturaGrupo->asignatura_id);
               if($asignatura != null)
               {
                  array_push($asignaturas, $asignatura);
               }
            }
            $idiomaAnterior = $this->idiomaAnterior($gradoXcursar);
            $clvIdioma = $this->idiomaGrado($idiomaAnterior);
            $asignatura = Asignaturas::where('clv_asignatura', $clvIdioma)->get();
            foreach ($asignatura as $key => $value) {
                  array_push($asignaturas, $value);
            }


            // $asignaturas = $this->unIdioma($asignaturas, $idiomaAnterior);
            // dd($asignaturas);
               // if($vale)
            if(isset($_GET['idioma']))
            {
               $asignaturas = $grupo->asignaturas;
               foreach ($asignaturas as $key => $asignatura) {
                  if($asignatura->clv_asignatura >= "1506" && $asignatura->clv_asignatura <= "1511"){
                     if($asignatura->clv_asignatura != $_GET['idioma']){
                        // dd($key);
                        unset($asignaturas[$key]);
                     }
                  }
               }

               $asignaturasSinIdiomas = array();
               foreach ($asignaturas as $key => $asignatura) {
                  array_push($asignaturasSinIdiomas, $asignatura);
               }
               $asignaturas = $asignaturasSinIdiomas;
            }
            $profesores = $grupo->profesores;

            $clv_grupo = substr($grupo->clv_grupo, 1);
            $secciones = Grupos::where('clv_grupo', 'LIKE', $clv_grupo.'%')
                     ->where('activo', 1)
                     ->where('cupo', '>', 0)
                     ->get();
            foreach ($secciones as $value) {
               array_push($clv_secciones, $value->clv_grupo);
            }
            $sec_asignaturas = array();
            $sec_profesores = array();

            for ($i=0; $i < count($clv_secciones) ; $i++) {
               $dato = Grupos::where('clv_grupo', $clv_secciones[$i])
                        ->where('activo', 1)
                        ->where('cupo', '>', 0)
                        ->first();
               if ($dato->asignaturas->isNotEmpty()) {
                  $query_salon = AsignaturaGrupo::where('grupo_id', $dato->id)
                           ->where('asignatura_id', $dato->asignaturas[0]->id)
                           ->first();
                           array_push($sec_asignaturas, $dato->asignaturas);
                           array_push($sec_profesores, $dato->profesores[0]->nombre." ".$dato->profesores[0]->app." ".$dato->profesores[0]->apm);
               }
            }
            $optativas = $this->optativas($grupo->id, request()->input('area'));
         }
         else {
            Session::flash('message', "El grupo que seleccionaste ya no cuenta con vacantes disponibles. Selecciona otro grupo");
            return redirect()->route('alumno.reinscripcion');
         }
         // dd($grupo, $clv_grupo, $asignaturas, $secciones);
         return view('alumno.reinscripcion-seccion', ['clv_grupo' => $clv_grupo, 'asignaturas' => $asignaturas, 'clv_secciones' => $clv_secciones, 'sec_asignaturas' => $sec_asignaturas, 'profesores' => $profesores, 'sec_profesores' => $sec_profesores, 'optativas' => $optativas, 'area' => request()->input('area')]);
      }
      public function optativas($idGrupo, $area){
         $asignaturas = Asignaturas::where('tipo', 'OPT')->where('area', $area)->get();
         $optativas = array();
         foreach ($asignaturas as $key => $asignatura) {
            $optativas[$asignatura->id] = ['clv' => $asignatura->clv_asignatura, 'nombre' => $asignatura->nombre];
         }
         return $optativas;
      }
      public function test(){
         $optativas_area = Asignaturas::where('clv_asignatura', 'LIKE', '17%')
                  ->where('area', $area)
                  ->where('vigente', 'S')
                  ->get();
         $optativas = $optativas_area->pluck('nombre', 'clv_asignatura');
         foreach ($optativas as $key => $value) {
            $secciones = Asignaturas::where('clv_asignatura', $key)
               ->where('area', $area)
               ->where('vigente', 'S')
               ->first();

            // $optativas[$key] =  [$value => $secciones->grupos->pluck('clv_grupo')->toArray()];
            $optativa = Grupos::where('clv_grupo', 'LIKE', '6%0%')
                     ->where('turno', $turno)
                     ->where('activo', 1)
                     ->get();
            $grupoOptativa = array();
            $horarios = array();
            for ($i=0; $i < $optativa->count(); $i++) {
               $horario = AsignaturaGrupo::where('grupo_id', $optativa[$i]->id)->get();
               array_push($horarios, [$horario[$i]->HR_1, $horario[$i]->HR_2, $horario[$i]->HR_3, $horario[$i]->HR_4, $horario[$i]->HR_5]);
               dd($horario, $asignatura);
               array_push($grupoOptativa, $optativa[$i]->clv_grupo);
               // dd, $grupoOptativa);
            }
            $optativas[$key] =  [$value => $grupoOptativa];

         }
         dd($optativas, $grupos);
      }
}
