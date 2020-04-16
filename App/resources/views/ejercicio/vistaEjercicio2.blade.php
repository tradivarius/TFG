@extends('layouts.app')
@section('content')
    <div class="navigation-wrapper">
      <div class="navigation-menu navSide" id="navSide">
          <ul class="listaNav">
            <li class="liNav"><a href="{{ url('admin/administracion')}}">Menu Principal</a></li>
            <li class="liNav"><a href="{{ url('admin/contacto')}}">Contacto</a></li>
        </ul>
      </div>
    </div>
    <div class="col-md-3 p-0" id="bloqueSideBar" style="       background: #232323;webkit-box-shadow: 10px 0px 15px -9px rgba(0,0,0,0.75);-moz-box-shadow: 10px 0px 15px -9px rgba(0,0,0,0.75);box-shadow: 4px 0px 15px -9px rgba(0,0,0,0.75);z-index: 4;">
        <div class="mt-4 mb-4 cardBodyEnun cardEnunciado rounded" style="width:90%;margin:auto;background-color: #5a5a5a;    -webkit-box-shadow: 0px 0px 12px 3px rgba(0,0,0,0.75);
    -moz-box-shadow: 0px 0px 12px 3px rgba(0,0,0,0.75);
    box-shadow: 1px 1px 9px -1px rgba(0,0,0,0.75);
    border-radius: 4px;">
          <div class="card-header cabeceraAdministracion rounded">
            	<h5 class="card-header-title mb-3 text-white">Enunciado</h5>
          </div>
          <div class="card-body text-center mb-2">
             <p class="card-text text-white">{{$enunciado}}</p>
          </div>
      	</div>
        <ul class="nav nav-pills mt-2 mb-3" id="pills-tab" style="justify-content: center;"role="tablist">
          <li class="nav-item">
            <a class="nav-link active" style="font-weight: bold; "id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Ejercicios</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-profile-tab" style="font-weight: bold;" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Tablas</a>
          </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
          <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" style="width: 100%;">

          <div class="mt-2 mb-4 cardBodyEnun cardEnunciado rounded" style="width:90%;margin:auto;background-color: #5a5a5a;    -webkit-box-shadow: 0px 0px 12px 3px rgba(0,0,0,0.75);
      -moz-box-shadow: 0px 0px 12px 3px rgba(0,0,0,0.75);
      box-shadow: 1px 1px 9px -1px rgba(0,0,0,0.75);
      border-radius: 4px;
      color: white;
      max-height: 450px;
      font-weight: bold;
      ">
            <div class="card-header cabeceraAdministracion rounded">
                <h5 class="card-header-title mb-3 text-white">Ejercicios</h5>
            </div>
            <div class="card-body pt-1 px-0 text-center mb-2" style="overflow-y: scroll;
    max-height: 379px;">
              @foreach ($ejercicios as $i => $ejercicio)
              <div class="col-md-12 px-0 {{json_decode($ejercicio->enunciado,true)[0]['texto'] === $enunciado ? ' selectedEjercicio' : ''}}" style="display:inline-flex;border-bottom: 2px #3a3a3a;padding-top: 4px;border-bottom-style: solid;">
                <div class="col-md-10  px-0">
                  <div class="col-12  text-left">
                    <span class="spanSugerencia">
                      {{json_decode($ejercicio->enunciado,true)[0]["texto"]}}
                    </span>
                  </div>
                  @if($ejerciciosResuelto != null)
                    @if (in_array($ejercicio->id, $ejerciciosResuelto))
                    <div class="col-12  text-left">
                      <span style="font-size: 12px;color: #13c100;">Completado - {{$ejercicio->solucionQuery}}</span>
                    </div>
                    @else
                    <div class="col-12  text-left">
                        <span style="font-size: 12px;color: #928888;">Sin completar</span>
                    </div>
                    @endif
                  @else
                  <div class="col-12  text-left">
                      <span style="font-size: 12px;color: #928888;">Sin completar</span>
                  </div>
                  @endif
                  <div class="col-12 text-left">
                    @switch($ejercicio->dificultad)
                        @case(1)
                        <span style="color:#00b900;">●</span>
                        <span style="font-size: 12px;color: #928888;"> Principiante</span>
                            @break

                        @case(2)
                        <span style="color:#ff9816;">●</span>
                        <span style="font-size: 12px;color: #928888;"> Intermedio</span>
                            @break

                        @case(3)
                        <span style="color:red;">●</span>
                        <span style="font-size: 12px;color: #928888;"> Avanzado</span>
                            @break

                        @default
                            No tiene dificultad
                    @endswitch
                   </div>
                </div>
                <div class="col-md-2 m-auto">
                  @switch($ejercicio->dificultad)
                      @case(1)
                        <a href="{{ env('APP_URLP') }}/ejercicio/{{$ejercicio->id}}" data-id="{{$ejercicio->id}}" data-toggle="tooltip" data-placement="top" title="Ejecutar Ejercicio"  class="añadirSugerencia" style="color: #6ead7f;
                        font-size: 23px;"><i class="fas fa-laptop-code"></i></a>
                        @break

                      @case(2)
                          @if($esPrincipiante)
                            <a href="{{ env('APP_URLP') }}/ejercicio/{{$ejercicio->id}}" data-toggle="tooltip" data-placement="top" title="Ejecutar Ejercicio"  data-id="{{$ejercicio->id}}" class="añadirSugerencia" style="color: #6ead7f;
                            font-size: 23px;"><i class="fas fa-laptop-code"></i></a>
                          @else
                            <a href="#" class="añadirSugerencia intermedioNoPermitir" style="color:grey; font-size: 23px;"><i class="fas fa-lock"></i></a>
                          @endif
                          @break

                      @case(3)
                          @if($esIntermedio)
                            <a href="{{ env('APP_URLP') }}/ejercicio/{{$ejercicio->id}}" data-toggle="tooltip" data-placement="top" title="Ejecutar Ejercicio" data-id="{{$ejercicio->id}}" class="añadirSugerencia" style="color: #6ead7f;
                            font-size: 23px;"><i class="fas fa-laptop-code"></i></a>
                          @else
                            <a href="#" class="añadirSugerencia avanzadoNoPermitir" style="color:grey; font-size: 23px;"><i class="fas fa-lock"></i></a>
                          @endif
                          @break

                      @default
                          No tiene dificultad
                  @endswitch



                </div>
              </div>
              @endforeach
            </div>
          </div>

          </div>
          <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" style="width: 90%;
    margin: auto;   background-color: #5a5a5a;
    -webkit-box-shadow: 0px 0px 12px 3px rgba(0,0,0,0.75);
        -moz-box-shadow: 0px 0px 12px 3px rgba(0,0,0,0.75);
        box-shadow: 1px 1px 9px -1px rgba(0,0,0,0.75);
        border-radius: 4px;
color: white;
max-height: 450px;
font-weight: bold;
margin-top: 1.6rem;
overflow-y: scroll;">
            <div  id="bloqueTablas" style="padding-top: 12px;">
              <div class="col-md-12 filaTabla">
                <div class="row">
                  <div class="col-8">
                    <span class="spanSugerencia" style="padding-left: 7px;">Artículos</span>
                  </div>
                  <div class="col-4 text-center">
                    <a href="#" data-id="select * from articulos" class="verTabla" style="color: #6ead7f;font-size: 17px;"><i class="fas fa-code"></i></a>
                  </div>
                </div>
              </div>
              <div class="col-md-12 filaTabla">
                <div class="row">
                  <div class="col-8">
                    <span class="spanSugerencia" style="padding-left: 7px;">Clientes</span>
                  </div>
                  <div class="col-4 text-center">
                    <a href="#" data-id="select * from clientes" class="verTabla" style="color: #6ead7f;font-size: 17px;"><i class="fas fa-code"></i></a>
                  </div>
                </div>
              </div>
              <div class="col-md-12 filaTabla">
                <div class="row">
                  <div class="col-8">
                    <span class="spanSugerencia" style="padding-left: 7px;">Pesos</span>
                  </div>
                  <div class="col-4 text-center">
                    <a href="#" data-id="select * from pesos" class="verTabla" style="color: #6ead7f;font-size: 17px;"><i class="fas fa-code"></i></a>
                  </div>
                </div>
              </div>
              <div class="col-md-12 filaTabla">
                <div class="row">
                  <div class="col-8">
                    <span class="spanSugerencia" style="padding-left: 7px;">Proveedores</span>
                  </div>
                  <div class="col-4 text-center">
                    <a href="#" data-id="select * from proveedores" class="verTabla" style="color: #6ead7f;font-size: 17px;"><i class="fas fa-code"></i></a>
                  </div>
                </div>
              </div>
              <div class="col-md-12 filaTabla">
                <div class="row">
                  <div class="col-8">
                    <span class="spanSugerencia" style="padding-left: 7px;">Suministro</span>
                  </div>
                  <div class="col-4 text-center">
                    <a href="#" data-id="select * from suministros" class="verTabla" style="color: #6ead7f;font-size: 17px;"><i class="fas fa-code"></i></a>
                  </div>
                </div>
              </div>
              <div class="col-md-12 filaTabla">
                <div class="row">
                  <div class="col-8">
                    <span class="spanSugerencia" style="padding-left: 7px;">TblUsuarios</span>
                  </div>
                  <div class="col-4 text-center">
                    <a href="#" data-id="select * from tblUsuarios" class="verTabla" style="color: #6ead7f;font-size: 17px;"><i class="fas fa-code"></i></a>
                  </div>
                </div>
              </div>
              <div class="col-md-12 filaTabla">
                <div class="row">
                  <div class="col-8">
                    <span class="spanSugerencia" style="padding-left: 7px;">Tiendas</span>
                  </div>
                  <div class="col-4 text-center">
                    <a href="#" data-id="select * from tiendas" class="verTabla" style="color: #6ead7f;font-size: 17px;"><i class="fas fa-code"></i></a>
                  </div>
                </div>
              </div>
              <div class="col-md-12 filaTabla">
                <div class="row">
                  <div class="col-8">
                    <span class="spanSugerencia" style="padding-left: 7px;">Ventas</span>
                  </div>
                  <div class="col-4 text-center">
                    <a href="#" data-id="select * from ventas" class="verTabla" style="color: #6ead7f;font-size: 17px;"><i class="fas fa-code"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    <div class="col-md-6 h-100 p-0" id="bloqueEjercicio"style="background-color: #ece8e8;">
      <span class="fa-stack fa-2x" id="sideBar"style="
      position: absolute;
      top: 0;
      left: -25px;
      height: 36px;
      cursor: pointer;
      z-index: 500;
">
        <i class="fas fa-circle fa-stack-2x"style="
    font-size: 30px;
    top: 14px;
        color: #0d6127;
"></i>
        <i class="fas fa-bars fa-stack-1x"style="
    font-size: 13px;
    color: white;
    height: 30px;
"></i>
      </span>
      <div class=" mt-4" style="height:35%;">
        <div class="card" style="width:90%;margin:auto;-webkit-box-shadow: 0px 0px 12px 3px rgba(0,0,0,0.75);
    -moz-box-shadow: 0px 0px 12px 3px rgba(0,0,0,0.75);
    box-shadow: 1px 1px 9px -1px rgba(0,0,0,0.75);
    border-radius: 4px;">
          <div class="card-body">
            <div class="col-12 mb-2 px-0" ><textarea name="queryForm" class="form-control" id="formularioQuery"></textarea></div>
            <div class="col-12 mt-2 px-0 text-right">
              <button type="button" class="btn-outline-secondary botonDegradao text-white" name="button" value="query" id="botonQuery" onclick="formularioQuery();"><i class="fas fa-code"></i> EJECUTAR</button>
            </div>
          </div>
        </div>
      </div>
      <div class="mt-3" style="height:50%;">
        <div class="card" style="width:90%;max-height: 400px;margin:auto;overflow-y: scroll;-webkit-box-shadow: 0px 0px 12px 3px rgba(0,0,0,0.75);
    -moz-box-shadow: 0px 0px 12px 3px rgba(0,0,0,0.75);
    box-shadow: 1px 1px 9px -1px rgba(0,0,0,0.75);
    border-radius: 4px;">
          <div class="card-body">
            <h5 class="card-title" style="    border-bottom: 1px solid #e9ecef !important;    padding-bottom: 5px;">Resultado Query</h5>
            <div class="table-responsive mt-4" style="min-height:86%;" id="container">
              <table class="table table-sm table-striped table-principal"style="text-align:center; color:black;">
                <thead>
                  <tr id="queryContainer">
                  </tr>
                </thead>
                <tbody id="elementos">
                </tbody>
              </table>
            </div>
               </div>
        </div>
      </div>
    </div>
    <div class="col-md-3 p-0" id="bloqueIframe" style="-webkit-box-shadow: 0px 9px 18px -5px rgba(0,0,0,0.75);
    -moz-box-shadow: 0px 9px 18px -5px rgba(0,0,0,0.75);
    box-shadow: 0px 9px 18px -5px rgba(0,0,0,0.75);">
        <div class="cotainer-fluid  w-100" style="padding-top: 0.3rem;
        padding-top: 0.3rem;
        background-color: white;
        -webkit-box-shadow: 0px 9px 18px -5px rgba(0,0,0,0.75);
        -moz-box-shadow: 0px 9px 18px -5px rgba(0,0,0,0.75);
        box-shadow: 0px 9px 18px -5px rgba(0,0,0,0.75);
        height: 8%;

">
       <div class="fotoIframe" style="width: 25%;
       height: 44.5px;
       justify-content: center;
       float: left;
       display: inline-block;">
           <img  id="fotoAvatar" src="{{ env('APP_URLP') }}/imagenes/botTfg.png" alt="" style="width: 49px;
    height: 47px;
           display: block;
           margin-left: auto;
           margin-top: 0.3rem;
           margin-right: auto;
           border-radius: 50%;">
       </div>
       <div class="nombreIframe" style="text-align: left;
       width: 60%;
       float: left;
       height: 43.4px;
       display: inline-block;
       font-family: sans-serif !important;">
         <label class="labelNombreBot" style="text-align: left;
         display: inline-block;
         color: black;
         line-height: 1.2;
         font-size: 12px !important;
         margin: 0px;
         font-weight: bold !important;
         padding-top: 13.5px;
         letter-spacing: 0;"><span id="nombreAsistente" style="font-size: 13px;
    font-weight: bold;">Bot Ayuda</span><br>
         <span class="labelDisponibilidadBot" style="font-size: 10px !important;
         margin: 0px;
         margin-bottom: 0px;
         font-weight: normal;">Disponible ahora </span><span class="fuentePunto" style="font-size: 11px;
         color: #12c112;">●</span></label>
       </div>
       <div class="cerrarIframe" style="padding-top: 11px;
       padding-right: 8px;
       width: 10%;
       float: right;
       display: inline-block;">
                   <img id="imgCerrar" style="height: 24px !important;
                   display: block;
                   float: right;
                   cursor: pointer;
                   margin: auto;"   src="http://dev.almaintelligence.com:8888/stylesAndScripts/version2/img/cruz.png">
                 </div>
        </div>
        <div class="cotainer-fluid  w-100" style=" height: 92%;
        background: linear-gradient(45deg, rgb(78, 78, 78) 0%, #abaaaa 50%, rgb(255, 255, 255) 100%);
    ">
          <iframe style="border: none;"class="botEjercicio"id="iframe" src="{{ env('APP_BOT') }}"></iframe>
        </div>
    </div>

@section('scripts')
<script>

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})


ComprobarTutorial();

function ComprobarTutorial() {
  $.ajax({
    type:'get',
    url:"../comprobarTutorial",
    dataType: 'json',
    success:function(data){
      if(data == true){
        $("#bloqueIframe").addClass("opacityTutorial");
        $("#bloqueEjercicio").addClass("opacityTutorial");
        var bloqueTutorial = document.createElement("div");
        bloqueTutorial.className = "cardBodyEnun cardEnunciado rounded bloqueSideTutorial"
        bloqueTutorial.setAttribute("id", "bloqueTutorial");
        document.getElementById("main").appendChild(bloqueTutorial);

        var headerBloqueTutorial = document.createElement("div");
        headerBloqueTutorial.className = "card-header cabeceraAdministracion rounded"
        headerBloqueTutorial.innerHTML = '<h5 class="card-header-title mb-3 text-white">Tutorial - Toma de contacto</h5>';
        document.getElementById("bloqueTutorial").appendChild(headerBloqueTutorial);

        var bodybloqueTutorial = document.createElement("div");
        bodybloqueTutorial.setAttribute("id", "bodybloqueTutorial");
        bodybloqueTutorial.className = "card-body text-center mb-2"
        bodybloqueTutorial.innerHTML = '<p class="card-text text-white" id="parrafoTutorial">Bienvenido a esta herramienta de iniciación al maravilloso mundo de MYSQL. Voy a proceder a explicarte de forma rápida el funcionamiento de la plataforma aunque para cualquier duda que te surja, siempre puedes recurrir a nuestro bot de seguimiento disponible. En el panel alojado en la parte izquierda de la pantalla, podrás encontrar el enunciado del ejercicio que estés haciendo y te aportará de igual forma una visión global, tanto de las tablas de las que disponemos como de los ejercicios disponibles en la plataforma.<div class="col-12 mt-2 px-0 text-right"><button type="button" class="btn-outline-secondary botonDegradao text-white" id="tutorialEjercicio">Avanzar</button></div></p>';
        document.getElementById("bloqueTutorial").appendChild(bodybloqueTutorial);

        $('#tutorialEjercicio').click(function(e) {
          $("#bloqueIframe").addClass("opacityTutorial");
          $("#bloqueEjercicio").removeClass("opacityTutorial");
          $("#bloqueSideBar").addClass("opacityTutorial");
          $("#bloqueTutorial").addClass("bloqueCenterTutorial");
          $("#bodybloqueTutorial").html('<p class="card-text text-white" id="parrafoTutorial">Esta parte central de la herramienta es la más importante: en ella escribiremos las soluciones de nuestros ejercicios y comprobaremos las soluciones. Gran parte de las consultas MYSQL siguen un orden para formarse. Para todos los pasos de los ejercicios, nuestro amigo el Bot nos acompañará para formar la consulta. Si ves innecesarias todas estas aclaraciones, podrás saltarte los pasos que desees y pasar directamente a resolverlo.</p><div class="col-12 mt-2 px-0"><img src="{{ env("APP_URLP") }}/imagenes/fucionamiento.png" alt="" style="width: 450px;"></div><div class="col-12 mt-4 px-0 text-right"><button type="button" class="btn-outline-secondary botonDegradao text-white" onclick="tutorialIframe();">Avanzar</button></div>');
        });
      }
    }
  });
}

function tutorialIframe(){
 $("#bloqueIframe").removeClass("opacityTutorial");
 $("#bloqueEjercicio").addClass("opacityTutorial");
 $("#bloqueSideBar").addClass("opacityTutorial");
 $("#bloqueTutorial").removeClass("bloqueCenterTutorial");
 $("#bloqueTutorial").addClass("bloqueIframeTutorial");
 $("#bodybloqueTutorial").html('<p class="card-text text-white" id="parrafoTutorial">Os presento a vuestro compañero, que estará pendiente de cada movimiento para poder así ayudaros con los ejercicios. No dudes en preguntarle en lo que respecta al lenguaje. Si no puede ayudarte, no seas muy duro con él, ¡él también está en constante aprendizaje! Puedes empezar por preguntar a nuestro compañero:¿qué hago para empezar?.<div class="col-12 mt-2 px-0 text-right"><button type="button" class="btn-outline-secondary botonDegradao text-white" onclick="cerrarIframeTutorial();">Avanzar</button></div></p>');
};

function cerrarIframeTutorial(){
 $("#bloqueIframe").removeClass("opacityTutorial");
 $("#bloqueEjercicio").removeClass("opacityTutorial");
 $("#bloqueSideBar").removeClass("opacityTutorial");
 $("#bloqueTutorial").addClass("d-none");
};

$('.intermedioNoPermitir').click(function(e) {
  Swal.fire({
  icon: 'warning',
  text: 'Para realizar los ejercicios de nivel intermedio deberás realizar todos los ejercicios de nivel principiante',
  heightAuto: false
})
});

$('.avanzadoNoPermitir').click(function(e) {
  Swal.fire({
  icon: 'warning',
  text: 'Para realizar los ejercicios de nivel avanzado deberás realizar todos los ejercicios de nivel intermedio',
  heightAuto: false
})
});


window.addEventListener('click',cerrarMenu, false);
function cerrarMenu(){
  if($("#navSide").hasClass("activeNav")){
    $("#navSide").addClass("removeActiveNav");
  }
}


$('#sideBar').click(function(e) {
  if($("#bloqueSideBar").hasClass("d-none")){
    $("#bloqueEjercicio").removeClass("col-md-9");
    $("#bloqueEjercicio").addClass("col-md-6");
    $("#bloqueSideBar").removeClass("d-none");
  }else{
    $("#bloqueSideBar").addClass("d-none");
    $("#bloqueEjercicio").removeClass("col-md-6");
    $("#bloqueEjercicio").addClass("col-md-9");
  }
});

$('#imgCerrar').click(function(e) {
    $("#navSide").removeClass("removeActiveNav");
    $("#navSide").removeClass("activeNav");
    $("#navSide").addClass("activeNav");
    event.preventDefault();
    event.stopImmediatePropagation();
});


var myCodeMirror = CodeMirror.fromTextArea(document.getElementById('formularioQuery'),{
    mode: "text/x-mysql",
		indentWithTabs: true,
		smartIndent: true,
		lineNumbers: true,
    tabSize:2,
		matchBrackets : true,
		autofocus: true
});

$('#pills-profile').on('click', '#volverATabla',function() {
  $("#bloqueTablas").removeClass("d-none");
  $("#bloqueTablaRespuesta").remove();
});

$('.verTabla').click(function(e) {
  var consulta = $(this).data('id');
  console.log(consulta);
  $.ajax({
    type:'get',
    url:"../ajaxVerTabla",
    data:{consulta:consulta},
    dataType: 'json',
    success:function(data){
      console.log(data);
      var keys = Object.keys(data[0]);
      $("#bloqueTablas").addClass("d-none");
      $("#bloqueTablaRespuesta").html("");
      string ="<div id='bloqueTablaRespuesta'><div style='position: absolute;right: 5%;text-align: center;background-color: #5aaf70;color: white;z-index: 10;width: 30px;'><i id='volverATabla' style='cursor:pointer;'class='fas fa-undo'></i></div><table class='table table-sm table-striped table-principal'style='text-align:center; color:white;'<thead><tr>"
      //$("#pills-profile").append()
      $.each(keys, function (index, value) {
      string = string +"<th>"+value+"</th>" ;
      });
      string = string + "</tr></thead><tbody>";
      $.each(data, function (i, fila) {
        string = string + "<tr>";
        $.each(fila, function (j, campo) {
          string = string + "<td>"+campo+"</td>";
        });
      });
      $("#pills-profile").append(string + "</tbody></table></div>");

    }
  });
});


    window.onload=function() {
      var arrayInicio = new Array();
      arrayInicio[0] = "ejercicio basico laravel";
      arrayInicio[1] = <?php echo $id;?>;
      var EjercicioBot = document.getElementById("iframe").contentWindow;
      EjercicioBot.postMessage(arrayInicio , "{{ env('APP_BOT') }}");
    }

    function vueltaMenu() {
      window.location.href = "{{ env('APP_URLP') }}/admin/administracion";
    }

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    function ejercicioTerminado(){
      var id =  <?php echo $id ?>;
      $.ajax({
          type:'get',
          url:"{{ env('APP_URLP') }}/ejercicioTerminado",
          data:{id:id},
          dataType: 'json',
          success:function(data){
            $("#bloqueIframe").addClass("opacityTutorial");
            $("#bloqueSideBar").addClass("opacityTutorial");
            var BloqueSolucion = document.createElement("div");
            BloqueSolucion.className = "cardBodyEnun cardEnunciado rounded BloqueSolucion"
            BloqueSolucion.setAttribute("id", "BloqueSolucion");
            document.getElementById("main").appendChild(BloqueSolucion);

            var headerBloqueSolucion = document.createElement("div");
            headerBloqueSolucion.className = "card-header cabeceraAdministracion rounded"
            headerBloqueSolucion.innerHTML = '<h5 class="card-header-title mb-3 text-white">Has resuelto el ejercicio</h5>';
            document.getElementById("BloqueSolucion").appendChild(headerBloqueSolucion);

            var bodyBloqueSolucion = document.createElement("div");
            bodyBloqueSolucion.setAttribute("id", "bodyBloqueSolucion");
            bodyBloqueSolucion.className = "card-body pb-0 text-center mb-2"
            bodyBloqueSolucion.innerHTML = '<h5 class="card-text text-white" id="parrafoTutorial">Enhorabuena has resuelto el ejercicio, vas por buen camino!!</h5><div class="col-12 mt-4 px-0 text-right"><button type="button" class="btn-outline-secondary botonDegradao text-white" onclick="vueltaMenu()" style="width: 125px;">Volver al menu</button></div>';
            document.getElementById("BloqueSolucion").appendChild(bodyBloqueSolucion);

          }
      });
    }

    function formularioQuery(){
      var query = myCodeMirror.getValue();
      query = query.split("\n").join(" ");
      query = query.split("\t").join(" ");
      query = query.trim()
      query = query.replace(/\s+/g, " ");
      console.log(query)
      var id =  <?php echo $id ?>;
      $.ajax({
          type:'POST',
          url:'./ajaxFormularioQuery',
          data:{query:query,id:id},
          dataType: 'json',
          success:function(data){
            $("#queryContainer").html("");
            $("#elementos").html("");
            console.log(data)
            if(typeof data[0]['query'] === 'string'){
              console.log(data[0]['conversacionBot']);
              var EjercicioBot = document.getElementById("iframe").contentWindow;
              EjercicioBot.postMessage(data[0]['conversacionBot'], "{{ env('APP_BOT') }}");
              $("#queryContainer").append(data[0]['query']);
            }
            else{
              console.log(data[0]);
              if(Object.entries(data[0]['query']).length !== 0){
              var keys = Object.keys(data[0]['query'][0]);
              $.each(keys, function (index, value) {
                $("#queryContainer").append("<th>"+value+"</th>");
              });
              $.each(data[0]['query'], function (i, fila) {
                $("#elementos").append("<tr>");
                $.each(fila, function (j, campo) {
                  $("#elementos").append("<td>"+campo+"</td>");
                });
              });
            }else{
              $("#queryContainer").append("No se ha encontrado ningun registro con estas condiciones");
            }

            if(data[0]['conversacionBot'] == "finalConversacionCorrectolaravel"){
              ejercicioTerminado();
              var EjercicioBot = document.getElementById("iframe").contentWindow;
              EjercicioBot.postMessage(data[0]['conversacionBot'], "{{ env('APP_BOT') }}");
            }else{
              var arrayBot = new Array();
              arrayBot[0] = data[0]['lugarConversacion'];
              arrayBot[1] = data[0]['conversacionBot'];
              arrayBot[2] = data[1];
              arrayBot[3] = <?php echo $id;?>;
              console.log(arrayBot)
              var EjercicioBot = document.getElementById("iframe").contentWindow;
              EjercicioBot.postMessage(arrayBot, "{{ env('APP_BOT') }}");
            }
            }
          }
      });
    }
</script>
@endsection
@endsection
