<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>Document</title>
      <link href="css/pdf.css" rel="stylesheet">
      <style>
      body {

    margin: 0;
    padding: 0;
    width: 100%;
    font-size: 0.9em;

}
        header{
            display: block;
            margin: 0;
             padding: 0;
             width: 100%;
             height: 110px;
        }
        main{
            display: block;
            width: 100%;
        }
        .logo {
            display: inline;
            width: 25%;
        }
        .logo.izq {
            float: left;
        }
        .logo.der {
            float: right;
            text-align: end;
        }
        .logo img {
            display: inline;
            height: 100px;
            width: 200px;
            margin-top:-10px
        }

.ex2 {
    display: inline-block;
    vertical-align: top;
}
.ex3 {
    display: block;
    margin: 2px 10px 2px 12px;
    width: 92%;
    border-top: solid 1px;
}
.columna {
    display: inline-block;
    margin: 2px 10px 2px 12px;
    width: 60%;
   vertical-align: top;
}
.columna3 {
    display: inline-block;
    margin: 2px 10px 2px 12px;
    width: 30%;
   vertical-align: top;
   float: left;
}
.foto.columna2 {
    display: inline-block;
    width: auto;
    padding-left: 60px;
}
.foto.columna2 img{
    width: 140px;
    height: 180px;
    vertical-align: top;
    border: solid 2px black;
}
.columna h2 {
    margin-top: 0;
}
.ex2.tag {

    width: 140px;
    font-weight: bold;

}
.ex2.info {
    width: auto;
    max-width: 270px;
}
.columna3 .ex2.info {
    width: auto;
    margin-left: 10px;
}
.columna3 .ex2.tag {
   display: block;
   width: auto;
}
.ex4 {display: inline-block;}
.ex1 {
    clear: both;
}
.ex1 h1 {
    display: block;
    height: auto;
    margin: 0;
}
h1{
    font-size: 1.8em;
    text-align: center;
    borde-button: 1px solid back;
    font-weight: bold;
    color:black;
}
.firma {
    margin-top:90px;
    text-align: center;

}
.firma-p{
    border-top: solid 2px black;
    margin:auto;
    width: 30%;
}
/* .grupo{
   width: 10px;
} */
      </style>
   </head>
    <body>
        <header>
               <div class="logo izq">
                   {{-- <img src="{!!asset('images/UNAM.png')!!}" > --}}
                   <img src="images/logo_1.png" >
               </div>
               <div class="logo der">
                   {{-- <img src="{!!asset('images/escudo_enp2_completo_original_negro.png')!!}"> --}}
                   <img src="images/ENP2_formatos.png">
               </div>
            </div>
        </header>
        <main>
            <div class="ex5">
                <h1>COMPROBANTE DE INSCRIPCIÓN</h1>
            </div>
           <div class="datos-alumno">
              <div class="columna">
                    <h2>Información del Alumno:</h2>
                    <div class="ex3">
                        <div class="ex2 tag">
                            Número de Cuenta:
                        </div>
                        <div class="ex2 info">
                            {!!$datos['Datos Alumno'][0]!!}
                        </div>
                    </div>
                    <div class="ex3">
                        <div class="ex2 tag">
                            Nombre del Alumno:
                        </div>
                        <div class="ex2 info">
                            {!!$datos['Datos Alumno'][1]!!}
                        </div>
                    </div>
                </div>
                <div class="foto columna2">
                  @if(file_exists("images/fotos/".$datos['Datos Alumno'][0].".jpg"))
                     <img src="images/fotos/{!!$datos['Datos Alumno'][0]!!}.jpg">
                  @else
                     <img src="images/fotos/plantilla.png">
                  @endif
                </div>
            </div>
            <div class="tira-materias">
               <table class="table">
                  <thead class="">
                     <tr class="">
                        <th scope="col" class="grupo"><strong>GRUPO</strong></th>
                        <th scope="col" class="clv_grupo"><strong>CLAVE ASIGNATURA</strong></th>
                        <th scope="col" class="asignatura"><strong>ASIGNATURA</strong></th>
                        <th scope="col" class="profesor"><strong>PROFESOR</strong></th>
                     </tr>
                  </thead>
                  <tbody>
                     @for ($i=0; $i < count($asignaturas); $i++)
                        <tr class="">
                              <td class="center">
                                 {!!$clv_grupo!!}
                              </td>
                              <td class="center">
                                 {!!$asignaturas[$i]->clv_asignatura!!}
                              </td>
                              <td>
                                 {!!$asignaturas[$i]->nombre!!}
                              </td>
                              <td>
                                 {!!$profesores[$i]->nombre." ".$profesores[$i]->app." ".$profesores[$i]->apm!!}
                              </td>
                        </tr>
                     @endfor
                  </tbody>
               </table>
            @if(!empty($clv_secciones))
            <div class="panel panel-default">
               <div class="panel-heading">
                  <div class="center title">
                     <h3>Grupo por secciones</h3>
                  </div>
               </div>
            </div>
               <table class="table">
                  <thead class="">
                     <tr class="">
                        <th scope="col" class="grupo"><strong>SECCIÓN</strong></th>
                        <th scope="col" class="clv_grupo"><strong>CLAVE ASIGNATURA</strong></th>
                        <th scope="col" class="asignatura"><strong>ASIGNATURA</strong></th>
                        <th scope="col" class="profesor"><strong>PROFESOR</strong></th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($sec_asignaturas as $clave => $value)
                           @foreach ($value as $info)
                              <tr>
                                 <td class="center">
                                    {!!$clv_secciones->clv_grupo!!}
                                 </td>
                                 <td class="center">
                                    {!!$info->clv_asignatura!!}
                                 </td>
                                 <td>
                                    {!!$info->nombre!!}
                                 </td>
                                 <td>
                                    {!!$sec_profesores[$clave]!!}
                                 </td>
                              </tr>
                           @endforeach
                        @endforeach
                     </tbody>
                  </table>
               </div>
               @endif
         </main>
       <footer>
          <div class="">

             {{-- <div class="requisitos">
                <p>En caso de que este documento no tenga fotografia, coloca una fotografía de 3.5 x 4.5 en el lugar correspondiente y acude a servicios escolares para actualizar tus datos.</p>
                <p>Entregar 2 impresiones de este documento en la fecha en que se soliciten.</p>
             </div> --}}

          </div>
       </footer>
   </body>

</html>
