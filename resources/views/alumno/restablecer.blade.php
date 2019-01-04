@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                  <h4>
                    Restablecer Contraseña
                  </h4>
                </div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" method="POST" action="{{ route('postForgot') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('num_cta') ? ' has-error' : '' }}">
                            <label for="num_cta" class="col-md-4 control-label">Número de Cuenta</label>

                            <div class="col-md-6">
                                <input id="num_cta" type="num_cta" class="form-control" name="num_cta" value="{{ old('num_cta') }}" required placeholder="Número de Cuenta">

                                @if ($errors->has('num_cta'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('num_cta') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('fecha_nac') ? ' has-error' : '' }}">
                            <label for="fecha_nac" class="col-md-4 control-label">Fecha de Nacimiento</label>

                            <div class="col-md-6">
                                <input id="fecha_nac" type="fecha_nac" class="form-control" name="fecha_nac" value="{{ old('fecha_nac') }}" required placeholder="ddmmaaaa">

                                @if ($errors->has('fecha_nac'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('fecha_nac') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Restablecer
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
