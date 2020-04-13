@extends('layouts.app')
@section('content')
<div class="container-fluid" style="background-color: #ece8e8;">
  <div class="card mt-4 mb-4" style="width:90%;margin:auto;background-color: white;">
    <div class="card-body">
      <h5 class="card-title" style="font-weight: bold;border-bottom: 1px solid #5aaf70; padding-bottom: 5px;">Tablas</h5>
      <div class="col-12" style="display:inline-flex;">
        <div class="col-4" id="tablas" role="tablist" aria-orientation="vertical">
          <div class="col-9 mt-2 mb-2 botonVerTabla" data-id="select * from clientes">Clientes</div>
          <div class="col-9 mt-2 mb-2 botonVerTabla" data-id="select * from articulos">Artículos</div>
          <div class="col-9 mt-2 mb-2 botonVerTabla" data-id="select * from pesos">Pesos</div>
          <div class="col-9 mt-2 mb-2 botonVerTabla" data-id="select * from proveedores">Proveedores</div>
          <div class="col-9 mt-2 mb-2 botonVerTabla" data-id="select * from suministro">Suministro</div>
          <div class="col-9 mt-2 mb-2 botonVerTabla" data-id="select * from tblUsuarios">TblUsuarios</div>
          <div class="col-9 mt-2 mb-2 botonVerTabla" data-id="select * from tiendas">Tiendas</div>
          <div class="col-9 mt-2 mb-2 botonVerTabla" data-id="select * from ventas">Ventas</div>
        </div>
        <div class="col-8" id="bloqueTablaRespuesta" style="max-height:400px;overflow-y:scroll;">

        </div>
      </div>
    </div>
  </div>
  <div class="card mt-4 mb-4" style="width:90%;margin:auto;background-color: white;">
    <div class="card-body">
      <h5 class="card-title" style="font-weight: bold;border-bottom: 1px solid #5aaf70; padding-bottom: 5px;">Formulario</h5>
      <form action="{{action('editarEjercicioController@crearJsonEjercicio')}}" method="get" class="mt-3 mb-3">
        <div class="col-12 " style="display: inline-flex;padding-bottom: 2rem;">
          <div class="col-5" style="background-color: #f3f3f3;
    border-radius: 5px;">
              <div class="col-12 mb-4 form__group field">
                <input type="input" class="form__field" placeholder="enunciado" name="enunciado" id='enunciado' required />
                {!!$errors->first('enunciado','<small class="errores">:message</small>')!!}
                <label for="enunciado" class="form__label">Enunciado del ejercicio</label>
              </div>
            <div class="form-group">
              <label class="mb-1"style="font-weight:bold;">Query de la solución</label>
              <input type="hidden" name="query" id="query" value="">
              <textarea name="queryForm" class="form-control" id="formularioQuery"></textarea>
              <div class="col-12 mt-3 px-0 text-right">
                <button type="button" style="    background-color: #5aaf70;
        border-color: white;
        border-radius: 7%;font-weight: bold;" class="btn-outline-secondary text-white" name="button" value="query" id="botonQuery" onclick="formularioQueryCrear();"><i class="fas fa-code"></i> EJECUTAR</button>
              </div>
            </div>
          </div>
          <div class="col-7" id="container" style="max-height:400px;overflow-y:scroll;">
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
        <div class="row d-none" id="cuerpoEnvio"style="padding-top: 2rem;">
          <div class="col-sm-6">
            <div class="col-12 mb-4 form__group field d-none" id="showEnun">
              <input type="input" class="form__field" placeholder="showEnunciado" name="showEnunciado" id='showEnunciado'  />
              {!!$errors->first('showEnunciado','<small class="errores">:message</small>')!!}
              <label for="showEnunciado" class="form__label">Enunciado de la cláusula show</label>
            </div>
            <div class="col-12 mb-4 form__group field d-none" id="describeEnun">
              <input type="input" class="form__field" placeholder="describeEnunciado" name="describeEnunciado" id='describeEnunciado'  />
              {!!$errors->first('describeEnunciado','<small class="errores">:message</small>')!!}
              <label for="describeEnunciado" class="form__label">Enunciado de la cláusula desribe</label>
            </div>
            <div class="col-12 mb-4 form__group field d-none" id="selectEnun">
              <input type="input" class="form__field" placeholder="selectEnunciado" name="selectEnunciado" id='selectEnunciado'  />
              {!!$errors->first('describeEnunciado','<small class="errores">:message</small>')!!}
              <label for="selectEnunciado" class="form__label">Enunciado de la cláusula select</label>
            </div>
            <div class="col-12 mb-4 form__group field d-none" id="whereEnun">
              <input type="input" class="form__field" placeholder="whereEnunciado" name="whereEnunciado" id='whereEnunciado'  />
              {!!$errors->first('whereEnunciado','<small class="errores">:message</small>')!!}
              <label for="whereEnunciado" class="form__label">Enunciado de la cláusula where</label>
            </div>
            <div class="col-12 mb-4 form__group field d-none" id="groupEnun">
              <input type="input" class="form__field" placeholder="groupEnunciado" name="groupEnunciado" id='groupEnunciado' />
              {!!$errors->first('groupEnunciado','<small class="errores">:message</small>')!!}
              <label for="groupEnunciado" class="form__label">Enunciado de la cláusula group</label>
            </div>
            <div class="col-12 mb-4 form__group field d-none" id="havingEnun">
              <input type="input" class="form__field" placeholder="havingEnunciado" name="havingEnunciado" id='havingEnunciado' />
              {!!$errors->first('havingEnunciado','<small class="errores">:message</small>')!!}
              <label for="havingEnunciado" class="form__label">Enunciado de la cláusula having</label>
            </div>
            <div class="col-12 mb-4 form__group field d-none" id="orderEnun">
              <input type="input" class="form__field" placeholder="orderEnunciado" name="orderEnunciado" id='orderEnunciado' />
              {!!$errors->first('orderEnunciado','<small class="errores">:message</small>')!!}
              <label for="orderEnunciado" class="form__label">Enunciado de la cláusula order by</label>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="col-12 mb-4 form__group field d-none" id="showPistas">
              <input type="input" class="form__field" placeholder="showPista" name="showPista" id='showPista' />
              {!!$errors->first('showPista','<small class="errores">:message</small>')!!}
              <label for="showPista" class="form__label">Pista de la cláusula show</label>
            </div>
            <div class="col-12 mb-4 form__group field d-none" id="describePistas">
              <input type="input" class="form__field" placeholder="describePista" name="describePista" id='describePista' />
              {!!$errors->first('describePista','<small class="errores">:message</small>')!!}
              <label for="describePista" class="form__label">Pista de la cláusula show</label>
            </div>
            <div class="col-12 mb-4 form__group field d-none" id="selectPistas">
              <input type="input" class="form__field" placeholder="selectPista" name="selectPista" id='selectPista' />
              {!!$errors->first('selectPista','<small class="errores">:message</small>')!!}
              <label for="selectPista" class="form__label">Pista de la cláusula select</label>
            </div>
            <div class="col-12 mb-4 form__group field d-none" id="wherePistas">
              <input type="input" class="form__field" placeholder="wherePista" name="wherePista" id='wherePista' />
              {!!$errors->first('wherePista','<small class="errores">:message</small>')!!}
              <label for="wherePista" class="form__label">Pista de la cláusula where</label>
            </div>
            <div class="col-12 mb-4 form__group field d-none" id="groupPistas">
              <input type="input" class="form__field" placeholder="groupPista" name="groupPista" id='groupPista' />
              {!!$errors->first('groupPista','<small class="errores">:message</small>')!!}
              <label for="groupPista" class="form__label">Pista de la cláusula group by</label>
            </div>
            <div class="col-12 mb-4 form__group field d-none" id="havingPistas">
              <input type="input" class="form__field" placeholder="havingPista" name="havingPista" id='havingPista' />
              {!!$errors->first('havingPista','<small class="errores">:message</small>')!!}
              <label for="havingPista" class="form__label">Pista de la cláusula having</label>
            </div>
            <div class="col-12 mb-4 form__group field d-none" id="orderPistas">
              <input type="input" class="form__field" placeholder="orderPista" name="orderPista" id='orderPista' />
              {!!$errors->first('orderPista','<small class="errores">:message</small>')!!}
              <label for="orderPista" class="form__label">Pista de la cláusula order by</label>
            </div>
          </div>
        </div>
        <div class="row d-none" id="formEnvio">
          <div class="col-12">
            <div class="form-group">
              <input type="submit" class="btn btn-dark col-2 mt-3">
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
  <div class="col-12">

  </div>
</div>
@section('scripts')
<script>

var myCodeMirror = CodeMirror.fromTextArea(document.getElementById('formularioQuery'),{
    mode: "text/x-mysql",
		indentWithTabs: true,
		smartIndent: true,
		lineNumbers: true,
    tabSize:2,
		matchBrackets : true,
		autofocus: true
});

$.ajaxSetup({
  headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

$('.botonVerTabla').click(function(e) {
  $( ".botonVerTablaSelected" ).each(function( i ) {
    $(this).removeClass("botonVerTablaSelected");
  });
  $(this).addClass("botonVerTablaSelected");
  var consulta = $(this).data('id');
  $.ajax({
    type:'get',
    url:"{{ env('APP_URLP') }}/ajaxVerTabla",
    data:{consulta:consulta},
    dataType: 'json',
    success:function(data){
      var keys = Object.keys(data[0]);
      $("#bloqueTablaRespuesta").html("");
      string ="<table class='table table-sm table-striped table-principal'style='text-align:center; color:black;'<thead><tr>"
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
      $("#bloqueTablaRespuesta").append(string + "</tbody></table>");

    }
  });
});


function formularioQueryCrear(){
  var query = myCodeMirror.getValue();
  $("#query").val(query);
  $.ajax({
      type:'POST',
      url:'./ajaxValidaQuery',
      data:{query:query},
      dataType: 'json',
      success:function(data){
        $("#queryContainer").html("");
        $("#elementos").html("");

        $('#formEnvio').addClass("d-none");
        $('#cuerpoEnvio').addClass("d-none");

        $('#showEnun').addClass("d-none");
        $('#showEnunciado').val("");
        $('#showEnunciado').prop('required',false);
        $('#showPistas').addClass("d-none");
        $('#showPista').val("");
        $('#showPista').prop('required',false);

        $('#describeEnun').addClass("d-none");
        $('#describeEnunciado').val("");
        $('#describeEnunciado').prop('required',false);
        $('#describePistas').addClass("d-none");
        $('#describePista').val("");
        $('#describePista').prop('required',false);

        $('#selectEnun').addClass("d-none");
        $('#selectEnunciado').val("");
        $('#selectEnunciado').prop('required',false);
        $('#selectPistas').addClass("d-none");
        $('#selectPista').val("");
        $('#selectPista').prop('required',false);


        $('#whereEnun').addClass("d-none");
        $('#whereEnunciado').val("");
        $('#whereEnunciado').prop('required',false);
        $('#wherePistas').addClass("d-none");
        $('#wherePista').val("");
        $('#wherePista').prop('required',false);

        $('#groupEnun').addClass("d-none");
        $('#groupEnunciado').val("");
        $('#groupEnunciado').prop('required',false);
        $('#groupPistas').addClass("d-none");
        $('#groupPista').val("");
        $('#groupPista').prop('required',false);

        $('#havingEnun').addClass("d-none");
        $('#havingEnunciado').val("");
        $('#havingEnunciado').prop('required',false);
        $('#havingPistas').addClass("d-none");
        $('#havingPista').val("");
        $('#havingPista').prop('required',false);

        $('#orderEnun').addClass("d-none");
        $('#orderEnunciado').val("");
        $('#orderEnunciado').prop('required',false);
        $('#orderPistas').addClass("d-none");
        $('#orderPista').val("");
        $('#orderPista').prop('required',false);

        console.log(data)
        if(typeof data[0]['query'] === 'string'){
          $("#queryContainer").append(data[0]['query']);
        }
        else{
          console.log(data[0]);
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

          $('#formEnvio').removeClass("d-none");
          $('#cuerpoEnvio').removeClass("d-none");

          var existeShow = false;
          var existeDescribe = false;

          //show siempre se muestra
          $('#showEnun').removeClass("d-none");
          $('#showEnunciado').val("Escribe la consulta necesaria para mostrar las diferentes tablas en nuestra base dato, e identificar la que estamos buscando");
          $('#showEnunciado').prop('required',true);
          $('#showPistas').removeClass("d-none");
          $('#showPista').prop('required',true);
          $('#showPista').val("Debes escribir la consulta show seguido de tables para ver todas las tablas de la base de datos");
          $.each(data[0]['clausula'], function (index, value) {
            switch (value) {
              case "show":
              existeShow = true;
              break;
              case "describe":
              existeDescribe = true;
              $('#describeEnun').removeClass("d-none");
              $('#describeEnunciado').val("Ahora que sabemos las tablas de las que se componen nuestra base datos, tienes que ver como esta compuesta la tabla que buscamos");
              $('#describeEnunciado').prop('required',true);
              $('#describePistas').removeClass("d-none");
              $('#describePista').prop('required',true);
              $('#describePista').val("debes usar la clausula describe para conocer los campos de la tabla que buscas");
              break;
              case "select":
              $('#selectEnun').removeClass("d-none");
              $('#selectEnunciado').val("Ahora que conocemos los campos de los que se componen nuestra tabla tenemos que escoger aquellos que necesitamos");
              $('#selectEnunciado').prop('required',true);
              $('#selectPistas').removeClass("d-none");
              $('#selectPista').prop('required',true);
              $('#selectPista').val("con la consulta select busca solo aquellos campos que necesites");
              break;
              case "where":
              $('#whereEnun').removeClass("d-none");
              $('#whereEnunciado').val("Ahora que conocemos los campos de los que se componen nuestra tabla tenemos que escoger aquellos que necesitamos");
              $('#whereEnunciado').prop('required',true);
              $('#wherePistas').removeClass("d-none");
              $('#wherePista').prop('required',true);
              $('#wherePista').val("con la consulta select busca solo aquellos campos que necesites");
              break;
              case "group by":
              $('#groupEnun').removeClass("d-none");
              $('#groupEnunciado').val("group by");
              $('#groupEnunciado').prop('required',true);
              $('#groupPistas').removeClass("d-none");
              $('#groupPista').prop('required',true);
              $('#groupPista').val("pista group by");
              break;
              case "having":
              $('#havingEnun').removeClass("d-none");
              $('#havingEnunciado').val("having");
              $('#havingEnunciado').prop('required',true);
              $('#havingPistas').removeClass("d-none");
              $('#havingPista').prop('required',true);
              $('#havingPista').val("pista having");
              break;
              case "order by":
              $('#orderEnun').removeClass("d-none");
              $('#orderEnunciado').val("order by");
              $('#orderEnunciado').prop('required',true);
              $('#orderPistas').removeClass("d-none");
              $('#orderPista').prop('required',true);
              $('#orderPista').val("pista order by");
              break;
              default:
              console.log('Lo lamentamos, por el momento no disponemos de ' + expr + '.');
            }
          });

          if(!existeShow  && !existeDescribe){
            $('#describeEnun').removeClass("d-none");
            $('#describeEnunciado').val("Ahora que sabemos las tablas de las que se componen nuestra base datos, tienes que ver como esta compuesta la tabla que buscamos");
            $('#describeEnunciado').prop('required',true);
            $('#describePistas').removeClass("d-none");
            $('#describePista').prop('required',true);
            $('#describePista').val("debes usar la clausula describe para conocer los campos de la tabla que buscas");
          }
        }
      }
  });
}
</script>
@endsection
@endsection