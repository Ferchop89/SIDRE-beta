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
                <h1>ACTUALIZACIÓN DE INFORMACIÓN PERSONAL</h1>
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
                    <div class="ex3">
                        <div class="ex2 tag">
                            CURP:
                        </div>
                        <div class="ex2 info">
                            {!!$datos['Datos Alumno'][2]!!}
                        </div>
                    </div>
                    <div class="ex3">
                        <div class="ex2 tag">
                            Escuela de Procedencia:
                        </div>
                        <div class="ex2 info">
                            {!!$datos['Datos Alumno'][3]!!}
                        </div>
                    </div>
                    <div class="ex3">
                        <div class="ex2 tag">
                            Dirección:
                        </div>
                        <div class="ex2 info">
                            {!!$datos['Datos Alumno'][4]!!}
                        </div>
                    </div>
                    <div class="ex3">
                        <div class="ex2 tag">
                            Contacto:
                        </div>
                        <div class="ex2 info">
                            Casa: {!!$datos['Datos Alumno'][5]!!}
                            <br>
                            Celular: {!!$datos['Datos Alumno'][6]!!}
                            <br>
                            Correo Electrónico: {!!$datos['Datos Alumno'][7]!!}
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

            <div class="datos-alumno">
               <div class="emergencia columna3">
                   <h2>En caso de emergencia comunicarse con:</h2>
                   <div class="ex3">
                       <div class="ex2 tag">
                           Nombre:
                       </div>
                       <div class="ex2 info">
                           {!!$datos['Contacto de Emergencia'][0]!!}
                       </div>
                   </div>
                   <div class="ex3">
                       <div class="ex2 tag">
                           Parentesco:
                       </div>
                       <div class="ex2 info">
                           {!!$datos['Contacto de Emergencia'][1]!!}
                       </div>
                   </div>
                   <div class="ex3">
                       <div class="ex2 tag">
                           Teléfono de Casa:
                       </div>
                       <div class="ex2 info">
                           {!!$datos['Contacto de Emergencia'][2]!!}
                       </div>
                   </div>
                   <div class="ex3">
                       <div class="ex2 tag">
                           Teléfono de Celular:
                       </div>
                       <div class="ex2 info">
                           {!!$datos['Contacto de Emergencia'][3]!!}
                       </div>
                   </div>
                   <div class="ex3">
                       <div class="ex2 tag">
                           Datos Adicionales:
                       </div>
                       <div class="ex2 info">
                           {!!$datos['Contacto de Emergencia'][4]!!}
                       </div>
                   </div>
               </div>
         </div>
                 <div class="datos-alumno">
                     <div class="adicional-alumno columna3">
                         <h2>Información Adicional:</h2>
                         <div class="ex3">
                             <div class="ex2 tag">
                                 Tipo de Sangre:
                             </div>
                             <div class="ex2 info">
                                 {!!$datos['Datos Adicionales'][0]!!}
                             </div>
                         </div>
                         <div class="ex3">
                             <div class="ex2 tag">
                                 Tipo de Seguro:
                             </div>
                             <div class="ex2 info">
                                 {!!$datos['Datos Adicionales'][1]!!}
                             </div>
                         </div>
                         <div class="ex3">
                             <div class="ex2 tag">
                                 Alergia(s):
                             </div>
                             <div class="ex2 info">
                                 {!!$datos['Datos Adicionales'][2]!!}
                             </div>
                         </div>
                         <div class="ex3">
                             <div class="ex2 tag">
                                 Tratamientos Especiales:
                             </div>
                             <div class="ex2 info">
                                 {!!$datos['Datos Adicionales'][3]!!}
                             </div>
                         </div>
                         <div class="ex3">
                             <div class="ex2 tag">
                                 Padecimiento(s):
                             </div>
                             <div class="ex2 info">
                                 {!!$datos['Datos Adicionales'][4]!!}
                             </div>
                         </div>
                       </div>
                 </div>
                 <div class="datos-alumno">
                    <div class="columna3 tutor">
                          <h2>Información del Tutor:</h2>
                          <div class="ex3">
                              <div class="ex2 tag">
                                  CURP:
                              </div>
                              <div class="ex2 info">
                                  {!!$datos['Datos Tutor'][0]!!}
                              </div>
                          </div>
                          <div class="ex3">
                              <div class="ex2 tag">
                                  Nombre:
                              </div>
                              <div class="ex2 info">
                                  {!!$datos['Datos Tutor'][1]!!}
                              </div>
                          </div>
                          <div class="ex3">
                              <div class="ex2 tag">
                                  Ocupación:
                              </div>
                              <div class="ex2 info">
                                  {!!$datos['Datos Tutor'][2]!!}
                              </div>
                          </div>
                          <div class="ex3">
                              <div class="ex2 tag">
                                  Lugar de trabajo:
                              </div>
                              <div class="ex2 info">
                                  {!!$datos['Datos Tutor'][3]!!}
                              </div>
                          </div>
                      </div>
                 </div>


             <div class="ex1">
                <p><strong>AVISO:</strong> Se hace constar que todos los datos proporcionados en este formulario fueron revisados y validados por mi persona.</p>
                <div class="firma">
                   <p class="firma-p">Firma de Tutor</p>
                   <p>{!!$datos['Datos Tutor'][1]!!}</p>
                </div>
             </div>


       </main>
       <footer>
          <div class="">

             <div class="requisitos">
                <p>En caso de que este documento no tenga fotografia, coloca una fotografía de 3.5 x 4.5 en el lugar correspondiente y acude a servicios escolares para actualizar tus datos.</p>
                <p>Entregar 2 impresiones de este documento en la fecha en que se soliciten.</p>
             </div>

          </div>
       </footer>
   </body>

</html>
