<?php


namespace App\Http\Controllers\Alumno;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use App\Models\Alumno;
use Carbon\Carbon;
use Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username(){
        return 'num_cta';
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('alumno.login');
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        if (Auth::guard('admin')->guest()) {
            $request->session()->invalidate();
        }

        return redirect('/alumno/login');
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('web');
    }
    protected function redirectTo()
    {
      $fecha_nac = Carbon::parse(Auth::User()->fechaNac(Auth::user()->datos_personales_alumnos_id))->format('dmY');
      $password = Auth::User()->password;
      if (Auth::check())
      {
         if(Auth::user()->activo)
         {
            if(!Hash::check($fecha_nac, $password))
            {
               // return '/alumno/pasos';
               return '/alumno/pasos';
            }
            else{
               // return '/alumno/home/'.Auth::user()->id;
               return '/alumno/home/'.Auth::user()->id;
            }
         }
         else {
            Auth::logout();
            Session::flash('message', "Tú cuenta se ha bloquedo. Contacta al administrador del sistema para que te de más información.");
         }
      }
      return 'alumno/login';
   }
}
