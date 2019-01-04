<?php

namespace App\Http\Controllers\Alumno;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

use Carbon\Carbon;

use App\Models\Alumno;
use App\Models\DatosPersonalesAlumnos;

class ForgotPasswordController extends Controller
{
  // protected $redirectTo = '/alumno/password/reset';
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    // use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function username(){
        return 'num_cta';
    }

    public function showViewForgot(){
        return view('alumno.restablecer');
    }

    public function forgot(){
      //dd(request());
      // dd(request()->input('num_cta'));
        $data = request()->validate([
            'num_cta' => ['required','min:9', 'max:9'],
            'fecha_nac' => ['required','min:8', 'max:8'],
         ],[
            'num_cta.required' => 'El campo Número de Cuenta es obligatorio',
            'num_cta.min' => 'El Número de Cuenta es de 9 caracteres',
            'num_cta.max' => 'El Número de Cuenta no puede superar los 9 caracteres',
            'fecha_nac.required' => 'El campo Fecha de Nacimiento es obligatorio',
            'fecha_nac.min' => 'La Fecha de Nacimiento es de 8 caracteres',
            'fecha_nac.max' => 'La Fecha de Nacimiento no puede superar los 8 caracteres',
        ]);
        $num_cta = $data['num_cta'];
        $fecha = $data['fecha_nac'];

        $id = Alumno::where('num_cta', $num_cta)->value('datos_personales_alumnos_id');
        if(!empty($id)){
            $dato = DatosPersonalesAlumnos::where('id', $id)->value('fecha_nac');
            $dato = Carbon::parse($dato)->format('dmY');

            if($dato == $fecha)
            {
                $update = Alumno::find($id);
                $update->password = bcrypt($fecha);
                $update->save();

                Auth::attempt(['num_cta' => $num_cta, 'password' => $fecha], false);
            }
        }
        return redirect()->route('alumno.forgot');
    }

    // protected function guard()
    // {
    //     return Auth::guard('alumno');
    // }
}
