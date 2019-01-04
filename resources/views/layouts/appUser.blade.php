
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="keywords" content="UNAM, Direccion, General, Administracion, Escolar, Servicios, Escolares, Concursos, Ingreso, estudiantes, académicos, egresados, alumnos, publicacion, resultados, dgae, admisión, licenciatura,posgrado, maestría,bachillerato,educación,a,distancia,abierta">
        <meta name="description" content="UNAM, Direccion General de Administracion Escolar, Servicios Escolares, Concursos de Ingreso a la UNAM, Administracion Escolar">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#1C3D6C">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
        <!-- Sección: Title del Sitio -->
        <title>@yield('title')</title>
        <!-- Sección: Links -->
        <link href="{{ asset ('images/favunam.ico') }}" rel="shortcut icon" type="image/x-icon">
        <link href="{{ asset('images/custom_icon.png') }}" rel="apple-touch-icon">
        <link href="{{ asset('images/custom_icon.png') }}" sizes="150x150" rel="icon">
        <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
        <link href="{{ asset('css/responsive_parallax_navbar.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        {{-- <link href="{{ asset('icss/mdb.css') }}" rel="stylesheet"> --}}
        <link href="{{ asset ('css/estilo_simapp_enp2.css') }}" rel="stylesheet">
        <script src="{{ asset ('js/jquery.js') }}" type="text/javascript"></script>

        @yield('add_css')
        <!-- /Sección: Links -->
    </head id="inicio">
    <body id="inicio">
        <header>
            {{-- <div id="skiptocontent"><a href="#maincontent">Saltarse al contenido</a></div> --}}
            <!-- Navegacion -->
            <nav role="navigation">
            <!-- Fixed navbar -->
            <div class="navbar navbar-fixed-top" role="navigation">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse" aria-expanded="false">
                            <i class="fa fa-bars" style="color: white;"></i>
                        </button>
                        <div class="small-logo-container">
                          <a class="small-logo waves-effect waves-light" tabindex="-1">
                            UNAM - ENP 2
                          </a>
                        </div>
                    </div>

                    <!-- Sección: Navegación -->
                    <div class="collapse navbar-collapse">
                        <!-- Left Side Of Navbar -->
                        <ul class="nav navbar-nav navbar-left">
                           <li class="dropdown">
                              <a id="btn" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" href="">Alumnos
                                 <span class="caret"></span>
                              </a>
                              <ul class="dropdown-menu">
                                 <li>
                                    <a href="{{asset(route('user.buscar.alumno'))}}">Generar Adeudo</a>
                                 </li>
                                 <li>
                                    <a href="{{asset(route('user.buscar.alumno'))}}">Finalizar Adeudo</a>
                                 </li>
                              </ul>
                           </li>
                        </ul>
                        <!-- Right Side Of Navbar -->
                        <ul class="nav navbar-nav navbar-right">
                            <!-- Authentication Links -->
                            @guest
                                <li><a id="btn" href="{{ route('login') }}">Iniciar sesión</a></li>
                            @else
                                <li class="dropdown">
                                    <a id="btn" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                        {{-- {{ Auth::user()->name }} <span class="caret"></span> --}}
                                        <img src="{{ asset('images/profileSmall.png')}}" alt="sesión">
                                    </a>

                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                                Cerrar sesión
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: block; color: black;">
                                                {{ csrf_field() }}
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            @endguest
                        </ul>
                    </div>
                    <!-- /Sección: Navegación -->
                </div>
            </div>
            <div class=" big-logo-row">
            <div class="container">
                <div class="col-lg-12 col-md-12 big-logo-container">
                    <div class="big-logo">
                        <div class="pull-left logo_grande logo_der">
                            <a href="https://www.unam.mx/" title="UNAM" tabindex="-1">
                                <img src="{{ asset ('images/escudo_unam_completo.svg') }}">
                            </a>
                        </div>
                        <div class="pull-left logo_chico logo_der">
                            <a href="https://www.unam.mx/" title="UNAM" tabindex="-1">
                                <img src="{{ asset ('images/escudo_unam_solo.svg') }}">
                            </a>
                        </div>
                        <div class="pull-right logo_grande logo_izq">
                            <a href="" title="ENP2" tabindex="-1">
                                <img src="{{ asset ('images/escudo_enp2_completo.png') }}">
                            </a>
                        </div>
                        <div class="pull-right logo_chico logo_izq">
                            <a href="" title="ENP2" tabindex="-1">
                                <img src="{{ asset ('images/escudo_enp2_solo.png') }}">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            </nav>
        </header>
        <main role="main" class="container" id="maincontent">

            @yield('content')

        </main>
        <!--Principio del Footer -->
        <footer class="main-footer">
        <div class="list-info">
            <div class="container">
                <div class="col-sm-3">
                    <h5 tabindex="0">Contacto</h5>
                    <p class="pmenor" tabindex="0"><i class="fa fa-phone"></i> &nbsp;Atención por Teléfono
                        <br> <a href="tel:56221524" class="link_footer_tel">56485481 ext 101</a>
                     </p>
                        <p class="pmenor" tabindex="0"><i class="fa fa-clock-o"></i> &nbsp; De 9:00 a 14:00 hrs.<br>y de 15:30 a 19:00 hrs.</p>
                </div>
                <div class="col-sm-6">
                    <p class="pmenor" tabindex="0">Se brinda información de:
                        </p><ul tabindex="0">
                            <li>Ingreso a Licenciatura por Pase Reglamentado</li>
                            <li>Trámites y Servicios Escolares en general</li>
                            <li>Ubicación de dependencias de la UNAM</li>
                        </ul>
                    <p></p>
                </div>
            </div>
        </div>
        <div class="row" id="fondo">
            <div class="col-sm-12">
                <p class="pmenor" tabindex="0">
                    Hecho en México, Preparatoria 2 Erasmo Castellanos Quinto, todos los derechos reservados 2018.
                    <br>Esta página puede ser reproducida con fines no lucrativos, siempre y cuando no se mutile, se cite la fuente completa y su dirección electrónica. De otra forma, requiere permiso previo por escrito de la institución
                    <br>
                    </p><div style="float: center;">
                        <img src="{{ asset ('images/logo_responsivo.png') }}" alt="Sitio Responsivo" height="42" width="42" style="margin-top:-24px;"> &nbsp;
                        <span class="fa fa-universal-access" style="font-size:42px;"></span>
                    </div>
                    <br>Sitio web administrado por: Escuela Nacional Preparatoria Plantel 2</br>
                    Correo de Contacto: inscripciones@prepa2.unam.mx</br>
            </div>
        </div>
    </footer>

    <!-- Sección: Scripts -->
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    {{-- <script src="https://code.jquery.com/ui/1.9.2/jquery-ui.min.js" integrity="sha256-eEa1kEtgK9ZL6h60VXwDsJ2rxYCwfxi40VZ9E0XwoEA=" crossorigin="anonymous"></script> --}}
    <!-- Bootstrap Core JavaScript -->
    <script type="text/javascript" src="{{ asset('js/bootstrap.js') }}"></script>
    <!-- Material Design Bootstrap -->
    {{-- <script type="text/javascript" src="{{ asset('js/mdb.js') }}"></script> --}}
    <!-- Analytics -->
    {{-- <script type="text/javascript" src="{{ asset('js/analytics.js') }}"></script> --}}
    <!-- barra de navegación-->
    <script type="text/javascript" src="{{ asset('js/navbar.js') }}"></script>
    <!-- /Sección: Scripts -->
    @yield('animaciones')
    </body>
</html>
