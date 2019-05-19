@extends('layouts.layout')

@section('css')
.btn:focus, .btn:active, button:focus, button:active {
  outline: none !important;
  box-shadow: none !important;
}

#image-gallery .modal-footer{
  display: block;
}

.thumb{
  margin-top: 15px;
  margin-bottom: 15px;
}

.scroll-box {
  overflow-y: scroll;
  height: 650px;
  padding: 1rem;
}

.nav-tabs li a{
  color: grey !important;
}

.share {
    position:fixed;
    bottom:30px;
    right:40px;
    transform:translate(-50%,-50%) rotate(45deg);
    width:80px;
    height:80px;
}
.share ul {
    position:relative;
    margin:0;
    padding:0;
    width:100%;
    height:100%;
}
.share ul li {
    position:absolute;
    top:0;
    left:0;
    list-style:none;
    width:100%;
    height:100%;
    border-radius:10px;
    background:#fff;
    transition:0.5s;
    overflow:hidden;
    -webkit-box-shadow: 0px 0px 45px -8px rgba(0,0,0,0.75);
    -moz-box-shadow: 0px 0px 45px -8px rgba(0,0,0,0.75);
    box-shadow: 0px 0px 45px -8px rgba(0,0,0,0.75);
}
.share ul.active li {
    transform:scale(0.95);
}
.share ul li a {
    position:absolute;
    top:0;
    left:0;
    width:100%;
    height:100%;
    line-height:80px;
    text-align:center;
    font-size:30px;
    color:#2196f3;
    transition:.5s;
}
.share ul li a .fas {
    transform:rotate(-45deg);
}
.share ul li a:hover {
    color:#fff;
    background:#2196f3;
}
.share ul.active li:nth-child(1){
  top:0;
  left:-100%;
  transition-delay:0s;
}
.share ul.active li:nth-child(2){
    top:-100%;
    left:0;
    transition-delay:0.2s;
}
.share ul.active li:nth-child(3){
    top:0;
    left:100%;
    transition-delay:0.4s;
}
.share ul.active li:nth-child(4){
    top:100%;
    left:0;
    transition-delay:0.6s;
}
.toggle {
    position:absolute;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background:#2196f3;
    transform:scale(0.95);
    overflow:hidden;
    border-radius:10px;
    z-index:1;
    cursor:pointer;
}
.toggle:before {
    content: "\f067";
    font-family: 'Font Awesome\ 5 Free';
    font-weight: 900; /* Fix version 5.0.9 */
    position:absolute;
    top:0;
    left:0;
    width:100%;
    height:100%;
    text-align:center;
    line-height:80px;
    color:#fff;
    font-size:30px;
    transform:rotate(-45deg);
}

.toggle.active:before {
    content:'\f068';
}

* {box-sizing: border-box}

/* Make the image to responsive */
.img-responsive {
 display: block;
 width: 100%;
 height: auto;
}

/* The overlay effect - lays on top of the container and over the image */
.overlay {
 position: absolute;
 bottom: 0;
 background: rgb(0, 0, 0);
 background: rgba(0, 0, 0, 0.5); /* Black see-through */
 color: #f1f1f1;
 width: 96%;
 transition: .5s ease;
 opacity:0;
 color: white;
 font-size: 18px;
 padding: 30px;
 text-align: center;
 margin-bottom: 15px;
}

/* When you mouse over the container, fade in the overlay title */
.image-container:hover .overlay {
 opacity: 1;
}

@endsection

@section('content')
<div class="container-fluid">
  <div class="row">
 <!-- end of images box -->
  <div class="col-xs-12 col-sm-12 col-lg-12 col-md-12">
    <div class="row-lg-12">
    <div class="card mt-2 mb-2 shadow">
      <div class="card-header text-center">
        Mapa del aviso {{$notice->id}} con coordenadas: {{$notice->lat}}, {{$notice->long}}
        <span class="badge badge-warning">
          {{$notice->categoria}}
      </span>
      @if($notice->visto == 1)
      <span class="badge badge-info float-right">
        <i class="fas fa-eye-slash mr-2"></i> Visto
      </span>
      @endif
      </div>
    <div id="map" style="width: 100%; height: 370px"></div>
</div>
</div>
<div class="row">
<div class="col-xs-12 col-sm-12 col-lg-6 col-md-12 mt-2 mb-2">
  <div class="row-lg-5">
      <div class="card shadow mb-2">
        <div class="card-header">
          <h5 class="text-center">Previsión del tiempo</h5>
    <!--<ul class="nav nav-tabs card-header-tabs">
      <li class="nav-item ml-auto">
        <a class="nav-link" href="#">3H</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">6H</a>
      </li>
      <li class="nav-item mr-auto">
        <a class="nav-link" href="#">9H</a>
      </li>
    </ul>-->
    <ul class="nav nav-pills card-header-tabs" id="pills-tab" role="tablist">
  <li class="nav-item ml-auto">
    <a class="nav-link active" id="3" data-toggle="pill" href="#prev3h" role="tab" aria-controls="pills-3h" aria-selected="true">3H</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="6" data-toggle="pill" href="#prev6h" role="tab" aria-controls="pills-6h" aria-selected="false">6H</a>
  </li>
  <li class="nav-item mr-auto">
    <a class="nav-link" id="9" data-toggle="pill" href="#prev9h" role="tab" aria-controls="pills-9h" aria-selected="false">9H</a>
  </li>
</ul>
    </div>
        <div class="card-body">
          <div class="tab-content" id="pills-tabContent">
          <ul class="tab-pane fade show active list-group list-group-flush" id="prev3h" role="tabpanel" aria-labelledby="pills-3h-tab">
            <li class="list-group-item">Humedad: <h6 class="text-muted float-right" id="humedadPrev3"></h6></li>
            <li class="list-group-item">Viento: <h6 class="text-muted float-right" id="vientoPrev3"></h6></li>
            <li class="list-group-item">Dirección viento: <h6 class="text-muted float-right" id="dirVientoPrev3"></h6></li>
            <li class="list-group-item">Temperatura: <h6 class="text-muted float-right" id="temperaturaPrev3"></h6></li>
            <li class="list-group-item">Precipitaciones: <h6 class="text-muted float-right" id="precipitacionesPrev3"></h6></li>
          </ul>
          <ul class="tab-pane fade list-group list-group-flush" id="prev6h" role="tabpanel" aria-labelledby="pills-6h-tab">
            <li class="list-group-item">Humedad: <h6 class="text-muted float-right" id="humedadPrev6"></h6></li>
            <li class="list-group-item">Viento: <h6 class="text-muted float-right" id="vientoPrev6"></h6></li>
            <li class="list-group-item">Dirección viento: <h6 class="text-muted float-right" id="dirVientoPrev6"></h6></li>
            <li class="list-group-item">Temperatura: <h6 class="text-muted float-right" id="temperaturaPrev6"></h6></li>
            <li class="list-group-item">Precipitaciones: <h6 class="text-muted float-right" id="precipitacionesPrev6"></h6></li>
          </ul>
          <ul class="tab-pane fade list-group list-group-flush" id="prev9h" role="tabpanel" aria-labelledby="pills-9h-tab">
            <li class="list-group-item">Humedad: <h6 class="text-muted float-right" id="humedadPrev9"></h6></li>
            <li class="list-group-item">Viento: <h6 class="text-muted float-right" id="vientoPrev9"></h6></li>
            <li class="list-group-item">Dirección viento: <h6 class="text-muted float-right" id="dirVientoPrev9"></h6></li>
            <li class="list-group-item">Temperatura: <h6 class="text-muted float-right" id="temperaturaPrev9"></h6></li>
            <li class="list-group-item">Precipitaciones: <h6 class="text-muted float-right" id="precipitacionesPrev9"></h6></li>
          </ul>
        </div>
        </div>
        <div class="card-footer">
          <small class="text-muted" id="horaAct2">
        </small>
        <div class="float-right">
          <button class="text-dark btn btn-sm btn-link d-inline" id="updatePrevisions"><i class="fas fa-sync-alt"></i></button>
        </div>
        </div>
      </div> <!-- End of card previsiones -->
    </div>

<div class="row-lg-5">
    <div class="card shadow">
      <h5 class="card-header text-center">El tiempo ahora</h5>
      <div class="card-body" id="timeInfoBody" style="display: none;">
        <ul class="list-group list-group-flush">
          <li class="list-group-item">Humedad: <h6 class="text-muted float-right" id="humedadInfo"></h6></li>
          <li class="list-group-item">Viento: <h6 class="text-muted float-right" id="sVientoInfo"></h6></li>
          <li class="list-group-item">Dirección viento: <h6 class="text-muted float-right" id="dirVientoInfo"></h6></li>
          <li class="list-group-item">Temperatura: <h6 class="text-muted float-right" id="temperaturaInfo"></h6></li>
          <li class="list-group-item">Precipitaciones: <h6 class="text-muted float-right" id="lluviaInfo"></h6></li>
        </ul>
      </div>
      <div class="card-footer">
        <small class="text-muted" id="horAct1">
      </small>
      <div class="float-right">
        <button onclick="updateTimes({{$notice->id}});" class="text-dark btn btn-sm btn-link d-inline" id="updateTimes"><i class="fas fa-sync-alt"></i></button>
      </div>
      </div>
    </div> <!-- End of card tiempoActual -->
  </div>
</div> <!-- End of previsiones card lists -->
<div class="col-xs-12 col-sm-12 col-lg-6 col-md-12 mb-2 mt-2">
<div class="shadow card">
<h5 class="card-header text-center">
<div class="float-left">
  <button  class="text-dark btn btn-sm btn-link" data-toggle="modal" data-target="#modalSender"><i class="fas fa-filter"></i></button>
  <span class="badge badge-info float-right mt-1" id="filterInfo" style="display: none;">

  </span>
</div>
Últimas imágenes del aviso
<div class="float-right">
  <span class="badge badge-info mt-1" id="alertUpdateImages" style="display: none;">

  </span>
  <button onclick="noticeImages('true');" class="text-dark btn btn-sm btn-link"><i class="fas fa-sync-alt"></i></button>
</div>
</h5>
<div class="card-body scroll-box">
<div class="container">
   <div class="row">
       <div class="row" id="imagesHolder">

                </div>
              </div>
</div>


    <div class="modal fade" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="image-gallery-title"></h4>
                    <span class="badge badge-info mx-auto">
                      <h5 class="modal-title" id="image-gallery-sender"></h5>
                    </span>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span>
                    </button>
                </div>
                <div class="modal-body image-container">
                    <img id="image-gallery-image" class="img-responsive" src="">
                    <div class="overlay"><h6 id="image-gallery-timestamp"></h6><p id="image-gallery-comment"></p></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary float-left" id="show-previous-image"><i class="fa fa-arrow-left"></i>
                    </button>

                    <button type="button" id="show-next-image" class="btn btn-secondary float-right"><i class="fa fa-arrow-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div> <!-- end of map column -->
</div>
</div>
<div class="share">
    <div class="toggle"></div>
    <ul>
        <li><a href="#" data-toggle="modal" data-target="#modalCategory" title="Categorizar aviso"><i class="fas fa-archive" aria-hidden="true"></i></a></li>
        @if($notice->visto == 1)
        <li><a href="{{route('visto', $notice->id)}}" title="Marcar no visto"><i class="fas fa-eye"></i></a></li>
        @else
        <li><a href="{{route('visto', $notice->id)}}" title="Marcar visto"><i class="fas fa-eye-slash"></i></a></li>
        @endif
        <li><a href="{{route('archivarAviso', $notice->id)}}" title="Archivar aviso"><i class="fas fa-box" aria-hidden="true"></i></a></li>
        <li><a href="#" data-toggle="modal" data-target="#modalDelete" title="Borrar aviso"><i class="fas fa-trash" aria-hidden="true"></i></a></li>
    </ul>
</div>

<!-- Modal -->
<div class="modal fade" id="modalCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Categoria del aviso {{$notice->id}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="container text-center mb-2 mt-3">

        <form method="POST" action="{{ action('NoticeController@cambiarCategoria') }}">
            {{ csrf_field() }}
            <input type="hidden" name="id" id="id" value="{{$notice->id}}">
        <div class="modal-body" id="filterBy_body">
        <div class="form-inline mt-2" id="type">
            <label for="type" class="mr-2"><h6><i class="fas fa-archive"></i> Categoria: </h6></label>
            <select name="newCat" id="newCat" style="block" class="custom-select">
                <option value="incendio">incendio</option>
                <option value="inundacion">inundacion</option>
                <option value="terremoto">terremoto</option>
                <option value="otro">otro</option>
            </select>
            </div>
        </div>

      </div>
      <div class="modal-footer">
              <button type="submit" class="btn btn-success"><i class="fas fa-edit mr-2"></i> Cambiar categoria</button>
            </form>
          </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">¿Seguro que deseas borrar el Aviso {{$notice->id}}?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="container text-center mb-2 mt-3">
        <div class="modal-body" id="delete_body">
          <div class="alert alert-danger" role="alert">
              <h4 class="alert-heading"><i class="fas fa-exclamation-triangle"></i> ¡Cuidado!</h4>
              <p>Si borras una alerta, se borrarán todas las imagenes asociadas a la misma así como los datos del tiempo que hayan sido almacenados</p>
              <hr>
              <p class="mb-0">Ásegurate de querer borrar este aviso</p>
          </div>
        </div>

      </div>
      <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              <a href="{{route('eliminar', $notice->id)}}" class="btn btn-danger" title="Marcar no visto"><i class="fas fa-trash"></i> Confirmar</a>
          </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalSender" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Categoria del remitente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="container text-center mb-2 mt-3">
        <div class="modal-body" id="filterBy_body">
        <div class="form-inline mt-2" id="type">
            <label for="type" class="mr-2"><h6><i class="fas fa-archive"></i> Categoria del remitente: </h6></label>
            <select name="senderCat" id="senderCat" style="block" class="custom-select">
                <option value="false">Sin filtrar</option>
                <option value="Ciudadano">Ciudadano</option>
                <option value="Autorizado">Autorizado</option>
                <option value="Oficial">Oficial</option>
            </select>
            </div>
        </div>

      </div>
      <div class="modal-footer">
              <button onclick="noticeImages('filter');" data-dismiss="modal" class="btn btn-success"><i class="fas fa-filter mr-2"></i> Aplicar filtrado</button>
          </div>
    </div>
  </div>
</div>



@endsection

@section('js')
$('.nav-item a').click(function(e){
  getPrevisions(e.target.id, 'false');
})

function getPrevisions(hourSpan, fromButton) {
  console.log(hourSpan);
  $.ajax({
      type: 'POST',
      url: "{{route('ajax.getPrevisions')}}",
      data: {notice: {{$notice->id}}, hourSpan: hourSpan, _token: '{{csrf_token()}}' },
      success: function(data){
          if(data.previsions.length == 0) {

          }
          else {
            for (i = 0; i < data.previsions.length; i++) {
                document.getElementById('temperaturaPrev' + hourSpan).innerHTML = data.previsions[i].temperatura;
                document.getElementById('humedadPrev' + hourSpan).innerHTML = data.previsions[i].humedad;
                document.getElementById('vientoPrev' + hourSpan).innerHTML = data.previsions[i].viento;
                document.getElementById('dirVientoPrev' + hourSpan).innerHTML = data.previsions[i].dirviento;
                document.getElementById('precipitacionesPrev' + hourSpan).innerHTML = data.previsions[i].lluvia;
                document.getElementById("horaAct2").innerHTML = 'Actualizado el ' + data.previsions[i].lastActD + ' a las ' + data.previsions[i].lastActH;
                document.getElementById("updatePrevisions").setAttribute("onclick", 'updatePrevisions(' + hourSpan + ')');
              }
            }
            },
              error: function(jqxhr, status, exception) {

              }
            });
            if(fromButton == 'true') {
              $('.tab-pane > .list-group-item').fadeOut().fadeIn("slow");
            }
}

function updatePrevisions(hourSpan) {
  $.ajax({
      type: 'POST',
      url: "{{route('ajax.updatePrevisions')}}",
      data: {notice: {{$notice->id}}, hourSpan: hourSpan, _token: '{{csrf_token()}}' },
      success: function(data){
          if(data.previsions.length == 0) {

          }
          else {

              }
              },
              error: function(jqxhr, status, exception) {

              }
            });
            getPrevisions(hourSpan, 'true');
}


function updateTimes(notice) {
  $.ajax({
      type: 'POST',
      url: "{{route('ajax.updateTime')}}",
      data: {notice: notice, _token: '{{csrf_token()}}' },
      success: function(data){
          if(data.times.length == 0) {

          }
          else {
            for (i = 0; i < data.times.length; i++) {
                document.getElementById("temperaturaInfo").innerHTML = data.times[i].temperatura;
                document.getElementById("humedadInfo").innerHTML = data.times[i].humedad;
                document.getElementById("sVientoInfo").innerHTML = data.times[i].viento;
                document.getElementById("dirVientoInfo").innerHTML = data.times[i].dirviento;
                document.getElementById("lluviaInfo").innerHTML = data.times[i].lluvia;
                document.getElementById("horAct1").innerHTML = 'Actualizado el ' + data.times[i].lastActD + ' a las ' + data.times[i].lastActH;
              }
              $('#timeInfoBody').fadeOut().fadeIn("slow");
            }
            },
              error: function(jqxhr, status, exception) {

              }
            });
}


function deleteFilterImg()
{
  document.getElementById("senderCat").selectedIndex = 0;
  noticeImages('filter');
}

var numberImages = -1;

function noticeImages(fromButton)
{
    var selector = document.getElementById("senderCat");
    var selectedValue = selector.options[selector.selectedIndex].value;
    if(selectedValue != "false") {
      var contentfilter = "";
      contentFilter = 'De ' + selectedValue + '<button onclick="deleteFilterImg();" class="btn btn-sm btn-link text-light"><i class="fas fa-times-circle"></i></button>';
      document.getElementById("filterInfo").innerHTML = contentFilter;
      $("#filterInfo").fadeIn("slow");
    }
    else {
      $("#filterInfo").fadeOut();
    }
    var contentString = "";
    $.ajax({
        type: 'POST',
        url: "{{route('ajax.noticeImages')}}",
        data: {notice: {{$notice->id}}, categoria: selectedValue, _token: '{{csrf_token()}}' },
        success: function(data){
          if(numberImages > -1) {
            if(data.images.length > numberImages) {
              var numberNewImages = data.images.length - numberImages;
              alertImgContent = '<i class="fas fa-info-circle"></i> ' + numberNewImages + ' nuevas imágenes';
            }
            else if(data.images.length == numberImages) {
              alertImgContent = '<i class="fas fa-info-circle"></i> Sin nuevas imágenes';
            }
            else if(data.images.length < numberImages) {
              var numberNewImages = Math.abs(data.images.length - numberImages);
              alertImgContent = '<i class="fas fa-info-circle"></i> ' + numberNewImages + ' imágenes menos';
            }
            document.getElementById("alertUpdateImages").innerHTML = alertImgContent;
            if(fromButton == 'true' || data.images.length != numberImages && fromButton != 'filter') {
              $("#alertUpdateImages").fadeIn("1000");
              setTimeout(function(){
                $("#alertUpdateImages").fadeOut();
              }, 2000);
            }
          }
            if(data.images.length == 0) {
              document.getElementById("imagesHolder").innerHTML = '<div class="alert alert-warning mx-auto" id="alertNoImages"><i class="fas fa-exclamation-triangle mr-2"></i>¡Sin Imagenes almacenadas!</div>';
              numberImages = -1;
              contentString = "";
            }
            else if(data.images.length != numberImages) {
                for (i = 0; i < data.images.length; i++) {
                  var id = i+1;
                  var URL = "{{url('imagenes/')}}/"+data.images[i].url;
                  contentString +=
                  '<div class="col-lg-4 col-md-5 col-xs-6 thumb" style="display:none;">' +
                    '<a class="thumbnail" href="#" data-image-id="' + id + '" data-toggle="modal" data-title="Aviso ' + data.images[i].notice_id + '"' +
                      'data-image="' + URL + '"' +
                       'data-target="#image-gallery"' +
                       'data-sender="' + data.images[i].sender_id.categoria + ', Tlf: ' + data.images[i].sender_id.tlf + '"' +
                       'data-timestamp="' + data.images[i].fecha + '"' +
                       'data-comment="' + data.images[i].comentarios + '">' +
                         '<img class="img-thumbnail" src="' + URL + '" alt="Another alt text">' +
                           '</a>' +
                         '</div>';
                }
                document.getElementById("imagesHolder").innerHTML = contentString;
                $(".thumb").fadeIn("slow");
                numberImages = data.images.length;
            }
        },
        error: function(jqxhr, status, exception) {
             
         }
    });
    setTimeout(function(){
      loadGallery(true, 'a.thumbnail');
    }, 1000);
    if(fromButton == 'false') {
        setTimeout(noticeImages, 5000, 'false');
    }
}

//This function disables buttons when needed
function disableButtons(counter_max, counter_current) {
  $('#show-previous-image, #show-next-image')
    .show();
  if (counter_max === counter_current) {
    $('#show-next-image')
      .hide();
  } else if (counter_current === 1) {
    $('#show-previous-image')
      .hide();
  }
}

/**
 *
 * @param setIDs        Sets IDs when DOM is loaded. If using a PHP counter, set to false.
 * @param setClickAttr  Sets the attribute for the click handler.
 */

function loadGallery(setIDs, setClickAttr) {
  let current_image,
    selector,
    counter = 0;

  $('#show-next-image, #show-previous-image')
    .click(function () {
      if ($(this)
        .attr('id') === 'show-previous-image') {
        current_image--;
      } else {
        current_image++;
      }

      selector = $('[data-image-id="' + current_image + '"]');

      updateGallery(selector);
    });

  function updateGallery(selector) {
    console.log(selector);
    let $sel = selector;
    current_image = $sel.data('image-id');
    $('#image-gallery-title')
      .text($sel.data('title'));
    $('#image-gallery-sender')
      .text($sel.data('sender'));
    $('#image-gallery-comment')
      .text($sel.data('comment'));
    $('#image-gallery-timestamp')
      .text($sel.data('timestamp'));
    $('#image-gallery-image')
      .attr('src', $sel.data('image'));
    disableButtons(counter, $sel.data('image-id'));
  }

  if (setIDs == true) {
    $('[data-image-id]')
      .each(function () {
        counter++;
        $(this)
          .attr('data-image-id', counter);
      });
  }
  $('a.thumbnail')
    .on('click', function () {
      updateGallery($(this));
    });
}

let modalId = $('#image-gallery');


$(document)
  .ready(function () {
    updateTimes({{$notice->id}});

    getPrevisions(3);

    $('.toggle').click(function(){
        $('.toggle').toggleClass('active');
        $('div.share > ul').toggleClass('active');
    });

    loadGallery(true, 'a.thumbnail');

    //This function disables buttons when needed
    function disableButtons(counter_max, counter_current) {
      $('#show-previous-image, #show-next-image')
        .show();
      if (counter_max === counter_current) {
        $('#show-next-image')
          .hide();
      } else if (counter_current === 1) {
        $('#show-previous-image')
          .hide();
      }
    }

    /**
     *
     * @param setIDs        Sets IDs when DOM is loaded. If using a PHP counter, set to false.
     * @param setClickAttr  Sets the attribute for the click handler.
     */

    function loadGallery(setIDs, setClickAttr) {
      let current_image,
        selector,
        counter = 0;

      $('#show-next-image, #show-previous-image')
        .click(function () {
          if ($(this)
            .attr('id') === 'show-previous-image') {
            current_image--;
          } else {
            current_image++;
          }

          selector = $('[data-image-id="' + current_image + '"]');
          updateGallery(selector);
        });

      function updateGallery(selector) {
        let $sel = selector;
        current_image = $sel.data('image-id');
        $('#image-gallery-title')
          .text($sel.data('title'));
        $('#image-gallery-image')
          .attr('src', $sel.data('image'));
        disableButtons(counter, $sel.data('image-id'));
      }

      if (setIDs == true) {
        $('[data-image-id]')
          .each(function () {
            counter++;
            $(this)
              .attr('data-image-id', counter);
          });
      }
      $(setClickAttr)
        .on('click', function () {
          updateGallery($(this));
        });
    }
  });

$(document)
  .ready(function () {
    noticeImages('false');
  });

// build key actions
$(document)
  .keydown(function (e) {
    switch (e.which) {
      case 37: // left
        if ((modalId.data('bs.modal') || {})._isShown && $('#show-previous-image').is(":visible")) {
          $('#show-previous-image')
            .click();
        }
        break;

      case 39: // right
        if ((modalId.data('bs.modal') || {})._isShown && $('#show-next-image').is(":visible")) {
          $('#show-next-image')
            .click();
        }
        break;

      default:
        return; // exit this handler for other keys
    }
    e.preventDefault(); // prevent the default action (scroll / move caret)
  });
  function initMap() {
  var aviso{{$notice->id}} = {lat: {{$notice->lat}}, lng: {{$notice->long}}};
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 12,
    center: aviso{{$notice->id}}
  });

  var marker{{$notice->id}} = new google.maps.Marker({
    position: aviso{{$notice->id}},
    map: map,
    title: 'Aviso{{$notice->id}}'
  });
  }
@endsection
