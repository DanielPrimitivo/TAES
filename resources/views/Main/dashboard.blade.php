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
            height: 750px;
            padding: 1rem;
        }
.vertical-center {
  min-height: 70%;  /* Fallback for browsers do NOT support vh unit */
  min-height: 70vh; /* These two lines are counted as one :-)       */

  display: flex;
  align-items: center;
}
.table-row{
cursor:pointer !important;
}
#sailorTableArea{
    max-height: 220px;
    overflow-x: auto;
    overflow-y: auto;
}
@endsection

@section('content')
<div class="container-fluid">
  <div class="row">
    @if($notices->isEmpty())
    <div class="vertical-center mx-auto">
    <div class="alert alert-warning" role="alert">
      No se ha encontrado ningún aviso para la categoría:<strong> {{$filtered}} </strong>
    </div>
  </div>
    @else
    <div class="col-xs-12 col-sm-12 col-lg-4 col-md-12 order-lg-1 order-12">
<div class="shadow card mt-2 mb-2">
  <div class="card-header">
    Últimas imágenes
    <div class="float-right">
      <button onclick="noticeImages();" class="text-dark btn btn-sm btn-link"><i class="fas fa-sync-alt"></i></button>
    </div>
</div>
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
                    <div class="modal-body">
                        <img id="image-gallery-image" class="img-responsive col-md-12" src="">
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
</div> <!-- end of images box -->
  <div class="col-xs-12 col-sm-12 col-lg-8 col-md-12 order-lg-12 order-1">
    <div class="row-lg-9">
    <div class="card mt-2 mb-2 shadow">
      <div class="card-header text-center">
        <div class="d-inline">Mapa de avisos</div>
        <div class="float-right d-inline">
          @if($filtered != 'false' && !$notices->isEmpty())
        <a href="{{ route('dashboard') }}" class="btn btn-sm btn-info">
          {{$filtered}} <i class="fas fa-times-circle text-light"></i>
      </a>
      @else
      <span class="badge badge-info">
        Todos los avisos
    </span>
      @endif
    </div>
      </div>
    <div id="map" style="width: 100%; height: 370px"></div>
</div>
</div>
<div class="row-lg-9">
  <div class="card-deck mt-4 mb-4">
    <div class="card shadow">
      <h5 class="card-header text-center">Últimos avisos</h5>
      <div class="card-body">
        <div class="table-responsive" id="sailorTableArea">
          <table class="table table-hover table-wrapper-scroll-y">
            <tbody>
              @if(isset($notices))
                @foreach($notices as $notice)
                  <tr id="fila{{$notice->id}}" class="table-row marker-link" onclick="noticeTimes('{{$notice->id}}')" data-markerid="{{$loop->index}}">
                    <td>{{ $notice->lat }}</td>
                    <td>{{ $notice->long }}</td>
                    <td><button onclick="location.href='{{route('aviso', $notice->id)}}';" class="text-dark btn btn-sm btn-link"><i class="fas fa-external-link-alt"></i></button></td>
                  </tr>
                @endforeach
              @endif
            </tbody>
          </table>
        </div>
      </div>
      <div class="card-footer">
        <small class="text-muted">Actualizado hace 3 minutos
          <div class="float-right">
          <a href="" class="text-dark"><i class="fas fa-sync-alt"></i></a>
          </div>
        </small>
      </div>
    </div>
    <div class="card shadow">
      <div class="card-body text-center" id="temperaturaActualBody">
        <i class="" style="font-size: 80px;" id="iconoTiempo"></i>
        <h5 class="card-title">Temperatura actual</h5>
        <h4 class="text-center text-muted" id="temperaturaActual"></h4>
      </div>
      <div class="card-footer">
        <small class="text-muted">Actualizado hace 3 minutos</small>
      </div>
    </div>
    <div class="card shadow">
      <h5 class="card-header text-center">El tiempo para el aviso seleccionado      </h5>
      <div class="card-body">
        <ul class="list-group list-group-flush">
          <li class="list-group-item">Humedad: <h6 class="text-muted float-right" id="humedadInfo"></h6></li>
          <li class="list-group-item">Viento: <h6 class="text-muted float-right" id="sVientoInfo"></h6></li>
          <li class="list-group-item">Dir. Viento: <h6 class="text-muted float-right" id="dirVientoInfo"></h6></li>
          <li class="list-group-item">Precipitaciones: <h6 class="text-muted float-right" id="lluviaInfo"></h6></li>
        </ul>
      </div>
      <div class="card-footer">
        <small class="text-muted">Actualizado hace 3 minutos
        <div class="float-right">
        <a href="" class="text-dark"><i class="fas fa-sync-alt"></i></a>
        </div>
      </small>
      </div>
    </div>
  </div>
</div>
</div> <!-- end of map box -->
</div>
</div>
@endif



@endsection

@section('js')
function noticeTimes(notice)
{
    var fila = "fila" + notice;

    var elems = document.querySelectorAll(".table-primary");

    [].forEach.call(elems, function(el) {
      el.className = el.className.replace(/\btable-primary\b/, "");
    });

    $.ajax({
        type: 'POST',
        url: "{{route('ajax.noticeTimes')}}",
        data: {notice: notice, _token: '{{csrf_token()}}' },
        success: function(data){
            if(data.times.length == 0) {
              document.getElementById("temperaturaActual").innerHTML = '<div class="col row alert alert-warning mt-2 ml-auto mr-auto" id="alertNoTimes"><i class="fas fa-exclamation-triangle mr-2"></i>¡Sin datos del tiempo para el aviso!</div>';
            }
            else {
                for (i = 0; i < data.times.length; i++) {
                    document.getElementById(fila).className = 'table-primary table-row marker-link';
                    document.getElementById("temperaturaActual").innerHTML = data.times[i].temperatura + '℃';
                    document.getElementById("humedadInfo").innerHTML = data.times[i].humedad + '%';
                    document.getElementById("sVientoInfo").innerHTML = data.times[i].viento + 'km/h';
                    document.getElementById("dirVientoInfo").innerHTML = data.times[i].dirviento;
                    document.getElementById("lluviaInfo").innerHTML = data.times[i].lluvia;
                    switch(data.times[i].lluvia) {
                      case "fuerte":
                        document.getElementById("iconoTiempo").className = 'fas fa-cloud-showers-heavy text-center mt-5';
                        break;
                      case "leve":
                        document.getElementById("iconoTiempo").className = 'fas fa-cloud-rain text-center mt-5';
                        break;
                      default:
                        document.getElementById("iconoTiempo").className = 'fas fa-sun text-center mt-5';
                    }
                }
            }
        },
        error: function(jqxhr, status, exception) {
             alert('Exception:' + exception,);
         }
    });
}

function noticeImages()
{
    var contentString = "";
    $.ajax({
        type: 'POST',
        url: "{{route('ajax.Images')}}",
        data: {_token: '{{csrf_token()}}' },
        success: function(data){
            if(data.images.length == 0) {
              document.getElementById("temperaturaActual").innerHTML = '<div class="col row alert alert-warning mt-2 ml-auto mr-auto" id="alertNoImages"><i class="fas fa-exclamation-triangle mr-2"></i>¡Sin Imagenes almacenadas!</div>';
              contentString = "";
            }
            else {
                for (i = 0; i < data.images.length; i++) {
                  var id = i+1;
                  var URL = "{{url('imagenes/')}}/"+data.images[i].url;
                  contentString +=
                  '<div class="col-lg-4 col-md-5 col-xs-6 thumb" style="display:none;">' +
                    '<a class="thumbnail" href="#" data-image-id="' + id + '" data-toggle="modal" data-title="Aviso' + data.images[i].notice_id + '"' +
                      'data-image="' + URL + '"' +
                       'data-target="#image-gallery"' +
                       'data-sender="' + data.images[i].sender_id.categoria + ', Tlf: ' + data.images[i].sender_id.tlf + '">' +
                         '<img class="img-thumbnail" src="' + URL + '" alt="Another alt text">' +
                           '</a>' +
                         '</div>';
                }
                document.getElementById("imagesHolder").innerHTML = contentString;
                $(".thumb").fadeIn("slow");
            }
        },
        error: function(jqxhr, status, exception) {
             alert('Exception:' + exception,);
         }
    });
    setTimeout(function(){
      loadGallery(true, 'a.thumbnail');
    }, 1000);
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

    noticeImages();

    @foreach($notices as $notice)
    @if ($loop->first)
      noticeTimes({{$notice->id}});
    @endif
    @endforeach
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

var mapdefault = null;

function initMap() {
  var markers = new Array();
@foreach($notices as $notice)
var aviso{{$notice->id}} = {lat: {{$notice->lat}}, lng: {{$notice->long}}};
@if ($loop->first)
var map = new google.maps.Map(document.getElementById('map'), {
  zoom: 9,
  center: aviso{{$notice->id}}
});
mapdefault = map;
@endif
var contentString = '<div id="content" class="col-md-12" style="width:500px;">'+
    '<h1 id="firstHeading" class="firstHeading">Aviso {{$notice->id}}<a class="btn-info btn-sm btn float-right w-50 mt-2" href="{{route('aviso', ['id' => $notice->id])}}" id="link1"><i class="fas fa-external-link-alt mr-2"></i> Detalles</a></h1> '+
    '<div id="bodyContent">'+
      '<div class="card shadow">'+
        '<h5 class="card-header text-center"> <span class="badge badge-warning">{{$notice->categoria}}</span>  El tiempo ahora   </h5>'+
    '<div class="card-body">'+
      '<ul class="list-group list-group-flush">' +
        '<li class="list-group-item">Humedad: <h6 class="text-muted float-right">{{$notice->weather()->firstOrFail()->humedad}}%</h6></li>' +
        '<li class="list-group-item">Temperatura: <h6 class="text-muted float-right">{{$notice->weather()->firstOrFail()->temperatura}}℃</h6></li>' +
      '</ul>' +
    '</div>'+
    '</div>'+
    '</div>'+
    '</div>';

var prev_infowindow=false;

var infowindow{{$notice->id}} = new google.maps.InfoWindow({
  content: contentString,
  maxHeight: 1000
});

var marker{{$notice->id}} = new google.maps.Marker({
  position: aviso{{$notice->id}},
  map: map,
  title: 'Aviso{{$notice->id}}'
});

marker{{$notice->id}}.addListener('click', function() {
  if(prev_infowindow) {
    prev_infowindow.close();
  }

  if(prev_infowindow != infowindow{{$notice->id}}) {
    infowindow{{$notice->id}}.open(map, marker{{$notice->id}});
    prev_infowindow = infowindow{{$notice->id}};
  }
  else {
    prev_infowindow = false;
  }
  noticeTimes('{{$notice->id}}');

var target = document.getElementById('fila{{$notice->id}}');
    target.scrollIntoView({
    	behavior: 'smooth',
      block: 'nearest',
      inline: 'start'
    });
});

markers.push(marker{{$notice->id}});
@endforeach
// Trigger a click event on each marker when the corresponding marker link is clicked
    $('.marker-link').on('click', function () {
        console.log(markers[$(this).data('markerid')]);
        google.maps.event.trigger(markers[$(this).data('markerid')], 'click');
    });
}
@endsection
