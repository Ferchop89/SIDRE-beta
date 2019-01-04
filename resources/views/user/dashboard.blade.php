@extends('layouts.appUser')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Adeudos de Material</div>

                <div class="panel-body">
                  @if (session('status'))
                     <div class="alert alert-success">
                        {{ session('status') }}
                     </div>
                  @endif

                    ¡Has iniciado sesión!
                  @if (Session::has('message'))
                      <div class="alert alert-info">{{ Session::get('message') }}</div>
                  @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
