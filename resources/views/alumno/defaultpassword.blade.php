@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                  <h4>
                    Contraseña Restablecida
                  </h4>
                </div>

                <div class="mensaje">

                    <p>Tú contraseña fue restablecida por tu fecha de nacimiento ddmmaaaa</p>
                    <div class="msj-btn">
                        <a class="btn btn-primary waves-effect waves-light" id="btn" href="{{ route('login') }}">Iniciar sesión</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
