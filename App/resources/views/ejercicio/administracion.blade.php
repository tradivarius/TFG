@extends('layouts.appAuth')
@section('content')
<div class="overlay" style="    position: absolute;
top: 50%;
position: fixed;
left: 50%;
min-width: 100%;
min-height: 100%;
width: auto;
height: auto;
transform: translateX(-50%) translateY(-50%);
z-index: 0;
background: url('../imagenes/p2.jpg');
"></div>
<div class="adminBlock">
  <div class="col-md-5 m-auto">
    <div style="
    margin: auto;
    width: 90%;
    margin-bottom: 4rem;
    color: white;
"><h1 class="mb-3" style="font-size: 2.5rem;">¡Bienvenido @if(auth()->user()->esProfesor ==  1) profesor @endif {{auth()->user()->name}}!</h1>
           <h4 class="mb-4">Aquí encontrarás tus datos de perfil y la lista de ejercicios disponibles con los que podrás ir aprendiendo cómo resolver una consulta <strong>SQL</strong>, siempre con mi ayuda.</h4>
           @if(auth()->user()->esProfesor ==  1)
           <a href="{{ env('APP_URLP') }}/editarEjercicio/estadistica" class="enlaceIcon"data-toggle="tooltip" data-placement="top" title="Estadística"><i class="fas fa-chart-line"></i></a>
           <a href="{{ env('APP_URLP') }}/editarEjercicio" class="enlaceIcon"data-toggle="tooltip" data-placement="top" title="Menu ejercicios"><i class="fas fa-th-list"></i></a>
           @endif
           <a href="{{ env('APP_URLP') }}/admin/contacto" class="enlaceIcon"data-toggle="tooltip" data-placement="top" title="Contactos"><i class="fas fa-envelope"></i></a>
           <a href="#" class="enlaceIcon"data-toggle="tooltip" data-placement="top" title="Ir a twitter"><i style="font-size: 20px;" class="fab fa-twitter"></i></a>
           <a href="#" class="enlaceIcon"data-toggle="tooltip" data-placement="top" title="Ir a instagram"><i style="font-size: 20px;"class="fab fa-instagram"></i></a>
    </div>
    <div class="mt-4 mb-4 cardBodyEnun cardEnunciado rounded" style="width: 90%;
    margin: auto;
    background-color: #1d1d1d;
    -webkit-box-shadow: 0px 0px 12px 3px rgba(0,0,0,0.75);
    -moz-box-shadow: 0px 0px 12px 3px rgba(0,0,0,0.75);
    box-shadow: 1px 1px 9px -1px rgba(86, 84, 84, 0.7">
      <div class="card-header col-12 cabeceraAdministracion rounded" style="display:inline-flex;">
        <div class="col-6">
          <h5 class="card-header-title mb-3 text-white">Mi perfil </h5>
        </div>
        <div class="col-6 text-right">
          <a href="{{ route('logout') }}"
          onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
                   Salir <i class="fa fa-sign-out-alt"></i>
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
        </div>
      </div>
      <div class="card-body text-center mb-2">
        <form id="editarPerfil" action="{{asset('admin/editarPerfil')}}" method="post">
          @csrf
          <div class="col-12 mb-4 form__group field text-left">
            <input type="input" class="text-white form__field" value="{{$usuario->email}}"placeholder="email" name="email" id='email' required />
            {!!$errors->first('email','<small class="errores" style="color:red;">:message</small>')!!}
            <label for="email" class="form__label">Email</label>
          </div>
          <div class="col-12 mb-4 form__group field text-left">
            <input type="input" class="text-white form__field" value="{{$usuario->name}}"placeholder="nombre" name="nombre" id='nombre' required />
            {!!$errors->first('nombre','<small class="errores"  style="color:red;">:message</small>')!!}
            <label for="nombre" class="form__label">Nombre del usuario</label>
          </div>
          <div class="col-12 mt-2 px-0 text-right">
            <button type="button" onclick="
                document.getElementById('editarPerfil').submit();" data-toggle="tooltip" data-placement="top" title="Editar perfil" class="btn-outline-secondary text-white botonDegradao" name="button"><i class="fas fa-edit"></i> Editar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="col-md-7 m-auto">
    <div class="mt-4 mb-4 cardBodyEnun cardEnunciado rounded" style=" width: 90%;
    margin: auto;
    background-color: #1d1d1d;
    -webkit-box-shadow: 0px 0px 12px 3px rgba(0,0,0,0.75);
    -moz-box-shadow: 0px 0px 12px 3px rgba(0,0,0,0.75);
    box-shadow: 1px 1px 9px -1px rgba(86, 84, 84, 0.7">
      <div class="card-header cabeceraAdministracion rounded">
          <h5 class="card-header-title mb-3 text-white">Principiante</h5>
      </div>
      <div class="card-body pt-1 px-0 text-center mb-2" style="overflow-y: scroll;
max-height: 180px;">
        @foreach ($principiante as $i => $ejercicio)
        <div class="col-md-12 px-0" style="display:inline-flex;border-bottom: 2px #3a3a3a;padding-top: 4px;border-bottom-style: solid;">
          <div class="col-md-10  px-0">
            <div class="col-12  text-left">
              <span class="spanSugerencia text-white">{{json_decode($ejercicio->enunciado,true)[0]["texto"]}}</span>
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
            <a href="{{ env('APP_URLP') }}/ejercicio/{{$ejercicio->id}}" data-id="{{$ejercicio->id}}" data-toggle="tooltip" data-placement="top" title="Ejecutar Ejercicio" class="añadirSugerencia" style="color: #6ead7f;
font-size: 23px;"><i class="fas fa-laptop-code"></i></a>
          </div>
        </div>
        @endforeach
      </div>
    </div>
    <div class="mt-4 mb-4 cardBodyEnun cardEnunciado rounded" style="width: 90%;
    margin: auto;
    background-color: #1d1d1d;
    -webkit-box-shadow: 0px 0px 12px 3px rgba(0,0,0,0.75);
    -moz-box-shadow: 0px 0px 12px 3px rgba(0,0,0,0.75);
    box-shadow: 1px 1px 9px -1px rgba(86, 84, 84, 0.7">
      <div class="card-header cabeceraAdministracion rounded">
          <h5 class="card-header-title mb-3 text-white">Intermedio</h5>
      </div>
      <div class="card-body pt-1 px-0 text-center mb-2" style="overflow-y: scroll;
max-height: 180px;">
        @foreach ($intermedios as $i => $ejercicio)
        <div class="col-md-12 px-0" style="display:inline-flex;border-bottom: 2px #3a3a3a;padding-top: 4px;border-bottom-style: solid;">
          <div class="col-md-10  px-0">
            <div class="col-12  text-left">
              <span class="spanSugerencia text-white">{{json_decode($ejercicio->enunciado,true)[0]["texto"]}}</span>
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
            @if(auth()->user()->esProfesor ==  0)
              @if($esPrincipiante)
                <a href="{{ env('APP_URLP') }}/ejercicio/{{$ejercicio->id}}" data-id="{{$ejercicio->id}}" data-toggle="tooltip" data-placement="top" title="Ejecutar Ejercicio" class="añadirSugerencia" style="color: #6ead7f;
                font-size: 23px;"><i class="fas fa-laptop-code"></i></a>
              @else
                <a href="#" class="añadirSugerencia intermedioNoPermitir" style="color:grey; font-size: 23px;"><i class="fas fa-lock"></i></a>
              @endif
            @else
              <a href="{{ env('APP_URLP') }}/ejercicio/{{$ejercicio->id}}" data-id="{{$ejercicio->id}}" data-toggle="tooltip" data-placement="top" title="Ejecutar Ejercicio"  class="añadirSugerencia" style="color: #6ead7f;
              font-size: 23px;"><i class="fas fa-laptop-code"></i></a>
            @endif

          </div>
        </div>
        @endforeach
      </div>
    </div><div class="mt-4 mb-4 cardBodyEnun cardEnunciado rounded" style="width: 90%;
    margin: auto;
    background-color: #1d1d1d;
    -webkit-box-shadow: 0px 0px 12px 3px rgba(0,0,0,0.75);
    -moz-box-shadow: 0px 0px 12px 3px rgba(0,0,0,0.75);
    box-shadow: 1px 1px 9px -1px rgba(86, 84, 84, 0.7">
      <div class="card-header cabeceraAdministracion rounded">
          <h5 class="card-header-title mb-3 text-white">Avanzado</h5>
      </div>
      <div class="card-body pt-1 px-0 text-center mb-2" style="overflow-y: scroll;
max-height: 180px;">
        @foreach ($avanzao as $i => $ejercicio)
        <div class="col-md-12 px-0" style="display:inline-flex;border-bottom: 2px #3a3a3a;padding-top: 4px;border-bottom-style: solid;">
          <div class="col-md-10  px-0">
            <div class="col-12  text-left">
              <span class="spanSugerencia text-white">{{json_decode($ejercicio->enunciado,true)[0]["texto"]}}</span>
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
          @if(auth()->user()->esProfesor ==  0)
            @if($esIntermedio)
              <a href="{{ env('APP_URLP') }}/ejercicio/{{$ejercicio->id}}" data-toggle="tooltip" data-placement="top" title="Ejecutar Ejercicio" data-id="{{$ejercicio->id}}" class="añadirSugerencia" style="color: #6ead7f;
              font-size: 23px;"><i class="fas fa-laptop-code"></i></a>
            @else
              <a href="#" class="añadirSugerencia intermedioNoPermitir" style="color:grey; font-size: 23px;"><i class="fas fa-lock"></i></a>
            @endif
          @else
            <a href="{{ env('APP_URLP') }}/ejercicio/{{$ejercicio->id}}" data-id="{{$ejercicio->id}}" data-toggle="tooltip" data-placement="top" title="Ejecutar Ejercicio"  class="añadirSugerencia" style="color: #6ead7f;
            font-size: 23px;"><i class="fas fa-laptop-code"></i></a>
          @endif
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
@section('scripts')
<script>

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})


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

setTimeout(function(){
  $('.adminBlock').addClass("activeAdminBlock");
} , 1000);

</script>
@endsection
@endsection
