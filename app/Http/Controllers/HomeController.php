<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Alumno;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $user=Alumno::find(Auth::user()->id);
        // $fecha_nac=Carbon::parse($user->fechaNac(Auth::user()->datos_personales_alumnos_id))->format('dmY');
        // // dd($fecha_nac);
        // if(Hash::check($fecha_nac, Auth::user()->password))
        // {
        //   // dd('Cambiar contrasena');
        //   return view('alumno.reset');
        // }
        // else {
        //   dd('pasos');
        // }
        return view('home');
    }
}
