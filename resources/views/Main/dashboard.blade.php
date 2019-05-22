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

/*style the box*/
         .gm-style .gm-style-iw {
            top: 0 !important;
            left: 0 !important;
            width: 100% !important;
            padding-top: 10px;
            display: block !important;
            box-shadow: 0 1px 6px rgba(178, 178, 178, 0.6);
            border: 1px solid rgba(72, 181, 233, 0.6);
            border-radius: 10px 10px 10px 10px; // apply 10px to the bottom corners of the infowindow
         }
         .gm-style-iw {
           overflow-y: auto !important;
           overflow-x: hidden !important;
         }
         .gm-style-iw > div {
           overflow: visible !important;
         }
         @media only screen and (min-width: 1080px) {
           .gm-style-iw {
             min-height: 280px;
           }
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
      <span class="badge badge-info mt-1" id="alertUpdateImages" style="display: none;">

      </span>
      <button onclick="noticeImages('true');" class="text-dark btn btn-sm btn-link"><i class="fas fa-sync-alt"></i></button>
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
          <table class="table table-hover text-center table-wrapper-scroll-y">
            <tbody id="noticesListBody">
              @if(isset($notices))
              <th>Aviso</th>
              <th>Categoria</th>
              <th>Imagenes</th>
              <th>&nbsp;</th>
                @foreach($notices as $notice)
                  <tr id="fila{{$notice->id}}" class="table-row marker-link" onclick="noticeTimes('{{$notice->id}}', 'false')" data-markerid="{{$loop->index}}">
                    <td><span class="badge badge-info">Aviso {{ $notice->id }}</span></td>
                    <td><span class="badge badge-warning">{{ $notice->categoria }}</span></td>
                    <td><span id="filaNumImg{{$notice->id}}" class="badge badge-pill badge-secondary">{{ $notice->images()->count() }}</span></td>
                    <td><button onclick="location.href='{{route('aviso', $notice->id)}}';" class="text-dark btn btn-sm btn-link"><i class="fas fa-external-link-alt"></i></button></td>
                  </tr>
                @endforeach
              @endif
            </tbody>
          </table>
        </div>
      </div>
      <div class="card-footer">
        <small class="text-muted" id="lastUpdateInfo">Actualizado a las {{$lastCall}}
        </small>
        <small>
        <div class="float-right">
          <button onclick="updateNotices('true');" class="text-dark btn btn-sm btn-link"><i class="fas fa-sync-alt"></i></button>
        </div>
      </small>
        <span class="badge badge-info float-right mt-1" id="alertUpdateNotices" style="display: none;">

      </span>
      </div>
    </div>
    <div class="card shadow">
      <div class="card-body text-center" id="temperaturaActualBody" style="display: none;">
        <i class="" style="font-size: 80px;" id="iconoTiempo"></i>
        <h5 class="card-title">Temperatura actual</h5>
        <h4 class="text-center text-muted" id="temperaturaActual"></h4>
      </div>
      <div class="card-footer">
        <small class="text-muted" id="horAct1"></small>
      </div>
    </div>
    <div class="card shadow">
      <h5 class="card-header text-center">El tiempo para el aviso seleccionado      </h5>
      <div class="card-body" id="allTimesInfoBody" style="display: none;">
        <ul class="list-group list-group-flush">
          <li class="list-group-item">Humedad: <h6 class="text-muted float-right" id="humedadInfo"></h6></li>
          <li class="list-group-item">Viento: <h6 class="text-muted float-right" id="sVientoInfo"></h6></li>
          <li class="list-group-item">Dir. Viento: <h6 class="text-muted float-right" id="dirVientoInfo"></h6></li>
          <li class="list-group-item">Precipitaciones: <h6 class="text-muted float-right" id="lluviaInfo"></h6></li>
        </ul>
      </div>
      <div class="card-footer">
        <small class="text-muted"> <p class="d-inline" id="horAct2"></p>
        <div class="float-right">
          <button class="text-dark btn btn-sm btn-link d-inline" id="updateTimes"><i class="fas fa-sync-alt"></i></button>
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
function updateTimes(notice) {
  $.ajax({
      type: 'POST',
      url: "{{route('ajax.updateTime')}}",
      data: {notice: notice, _token: '{{csrf_token()}}' },
      success: function(data){
          if(data.times.length == 0) {
            document.getElementById("temperaturaActual").innerHTML = '<div class="col row alert alert-warning mt-2 ml-auto mr-auto" id="alertNoTimes"><i class="fas fa-exclamation-triangle mr-2"></i>¡Sin datos del tiempo para el aviso!</div>';
          }
          else {

              }
              },
              error: function(jqxhr, status, exception) {

              }
            });
            noticeTimes(notice, 'true');
}

function noticeTimes(notice, fromUpdate)
{
  console.log(notice);
    var fila = "fila" + notice;
    if(document.getElementById(fila).className != 'table-primary table-row marker-link' || fromUpdate == 'true') {
      var elems = document.querySelectorAll(".table-primary");

      [].forEach.call(elems, function(el) {
        el.className = el.className.replace(/\btable-primary\b/, "");
      });
      $("#temperaturaActualBody").fadeOut();
      $("#allTimesInfoBody").fadeOut();
      setTimeout(function(){


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
                      document.getElementById("temperaturaActual").innerHTML = data.times[i].temperatura;
                      document.getElementById("humedadInfo").innerHTML = data.times[i].humedad;
                      document.getElementById("sVientoInfo").innerHTML = data.times[i].viento;
                      document.getElementById("dirVientoInfo").innerHTML = data.times[i].dirviento;
                      document.getElementById("lluviaInfo").innerHTML = data.times[i].lluvia;
                      document.getElementById("horAct1").innerHTML = 'Actualizado el ' + data.times[i].lastActD + ' a las ' + data.times[i].lastActH;
                      document.getElementById("horAct2").innerHTML = 'Actualizado el ' + data.times[i].lastActD + ' a las ' + data.times[i].lastActH;
                      document.getElementById("updateTimes").setAttribute("onclick", 'updateTimes(' + notice + ')');
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
                        for(j = 0; j < InfoWindows.length; j++) {
                          if(InfoWindows[j].notice_id == notice) {
                            var URL = "{{url('aviso/')}}/"+notice;
                            var contentString = '<div id="content" class="col-lg-12">'+
                                '<h1 id="firstHeading" class="firstHeading">Aviso ' + notice + '<a class="btn-info btn-sm btn float-right w-50 mt-2" href="' + URL + '" id="link1"><i class="fas fa-external-link-alt mr-2"></i> Detalles</a></h1> '+
                                '<div id="bodyContent">'+
                                  '<div class="card shadow">'+
                                    '<h5 class="card-header text-center"> <span class="badge badge-warning">' + data.times[i].categoria + '</span>  El tiempo ahora   </h5>'+
                                '<div class="card-body">'+
                                  '<ul class="list-group list-group-flush">' +
                                    '<li class="list-group-item">Humedad: <h6 class="text-muted float-right">' + data.times[i].humedad + '</h6></li>' +
                                    '<li class="list-group-item">Temperatura: <h6 class="text-muted float-right">' + data.times[i].temperatura + '</h6></li>' +
                                  '</ul>' +
                                '</div>'+
                                '</div>'+
                                '</div>'+
                                '</div>';
                                InfoWindows[j].setContent(contentString);
                          }
                        }
                      }
                      $("#temperaturaActualBody").fadeIn();
                      $("#allTimesInfoBody").fadeIn();
                    }
                  },
                  error: function(jqxhr, status, exception) {

                  }
                });}, 300);
              }
              else {

              }
}

var numberImages = -1;

function noticeImages(fromButton)
{
    var contentString = "";
    var alertImgContent = "";
    $.ajax({
        type: 'POST',
        url: "{{route('ajax.Images')}}",
        data: {categoria: '{{$filtered}}' ,_token: '{{csrf_token()}}' },
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
            if(fromButton == 'true' || data.images.length != numberImages) {
              $("#alertUpdateImages").fadeIn("1000");
              setTimeout(function(){
                $("#alertUpdateImages").fadeOut();
              }, 2000);
            }
          }

            if(data.images.length == 0) {
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
                $(".thumb").fadeOut().delay(400).fadeIn("slow");
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

    noticeImages('false');

    @foreach($notices as $notice)
    @if ($loop->first)
      noticeTimes({{$notice->id}});
    @endif
    @endforeach

    setTimeout(updateNotices, 5000, 'false');
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

var markers = new Array();

var prev_infowindow=false;

function initMap() {
@foreach($notices as $notice)
var aviso{{$notice->id}} = {lat: {{$notice->lat}}, lng: {{$notice->long}}};
@if ($loop->first)
var map = new google.maps.Map(document.getElementById('map'), {
  zoom: 9,
  center: aviso{{$notice->id}}
});
mapdefault = map;
@endif
var contentString = '<div id="content" class="col-lg-12">'+
    '<h1 id="firstHeading" class="firstHeading">Aviso {{$notice->id}}<a class="btn-info btn-sm btn float-right w-50 mt-2" href="{{route('aviso', ['id' => $notice->id])}}" id="link1"><i class="fas fa-external-link-alt mr-2"></i> Detalles</a></h1> '+
    '<div id="bodyContent">'+
      '<div class="card shadow">'+
        '<h5 class="card-header text-center"> <span class="badge badge-warning">{{$notice->categoria}}</span>  El tiempo ahora   </h5>'+
    '<div class="card-body">'+
      '<ul class="list-group list-group-flush">' +
        '<li class="list-group-item">Humedad: <h6 class="text-muted float-right">{{$notice->weather()->firstOrFail()->humedad}}</h6></li>' +
        '<li class="list-group-item">Temperatura: <h6 class="text-muted float-right">{{$notice->weather()->firstOrFail()->temperatura}}</h6></li>' +
      '</ul>' +
    '</div>'+
    '</div>'+
    '</div>'+
    '</div>';

var infowindow{{$notice->id}} = new google.maps.InfoWindow({
  content: contentString,
  maxHeight: 100,
  notice_id: {{$notice->id}}
});

InfoWindows.unshift(infowindow{{$notice->id}});

var marker{{$notice->id}} = new google.maps.Marker({
  position: aviso{{$notice->id}},
  map: map,
  animation: google.maps.Animation.DROP,
  title: 'Aviso {{$notice->id}}'
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

var noticeId = null;
var fila = null;
var InfoWindows = [];

function updateNotices(fromButton)
{
  var alertContent = "";
    $.ajax({
        type: 'POST',
        url: "{{route('ajax.notices')}}",
        data: {categoria: '{{$filtered}}',_token: '{{csrf_token()}}' },
        success: function(data){
            if(data.notices.length == 0 || data.notices.length == markers.length) {
              alertContent = '<i class="fas fa-info-circle"></i> Sin nuevos avisos';
              document.getElementById("alertUpdateNotices").innerHTML = alertContent;
              if(fromButton == 'true') {
                $("#alertUpdateNotices").fadeIn("1000");
                setTimeout(function(){
                  $("#alertUpdateNotices").fadeOut();
                }, 2000);
              }
              var d = new Date();
              if(d.getMinutes() < 10) {
                var n = d.getHours() + ':0' + d.getMinutes();
              }
              else {
                var n = d.getHours() + ':' + d.getMinutes();
              }
              document.getElementById("lastUpdateInfo").innerHTML = 'Actualizado a las ' + n;
              if(data.notices.length > 0) {
                for(i = data.notices.length-1; i>=0; i--) {
                  document.getElementById('filaNumImg' + data.notices[i].id + '').innerHTML = data.notices[i].numImg;
                }
              }
            }
            else {
              var myLatlng = {lat: parseFloat(data.notices[0].lat), lng: parseFloat(data.notices[0].long)};
              var mapOptions = {
                zoom: 9,
                center: myLatlng
              }
              var map = new google.maps.Map(document.getElementById("map"), mapOptions);
              var numberNewNotices = data.notices.length-markers.length;
              markers = [];
              InfoWindows = [];
              for(i = data.notices.length-1; i >= 0; i--) {
                noticeId = data.notices[i].id;
                var fila = 'fila' + noticeId;
                var URL = "{{url('aviso/')}}/"+data.notices[i].id;
                console.log(fila);
                var contentString = '<div id="content" class="col-lg-12">'+
                    '<h1 id="firstHeading" class="firstHeading">Aviso ' + data.notices[i].id + '<a class="btn-info btn-sm btn float-right w-50 mt-2" href="' + URL + '" id="link1"><i class="fas fa-external-link-alt mr-2"></i> Detalles</a></h1> '+
                    '<div id="bodyContent">'+
                      '<div class="card shadow">'+
                        '<h5 class="card-header text-center"> <span class="badge badge-warning">' + data.notices[i].categoria + '</span>  El tiempo ahora   </h5>'+
                    '<div class="card-body">'+
                      '<ul class="list-group list-group-flush">' +
                        '<li class="list-group-item">Humedad: <h6 class="text-muted float-right">' + data.notices[i].weather.humedad + '</h6></li>' +
                        '<li class="list-group-item">Temperatura: <h6 class="text-muted float-right">' + data.notices[i].weather.temperatura + '</h6></li>' +
                      '</ul>' +
                    '</div>'+
                    '</div>'+
                    '</div>'+
                    '</div>';
                var infowindow = new google.maps.InfoWindow({
                  content: contentString,
                  maxHeight: 1000,
                  id: i
                });
                InfoWindows.unshift(infowindow);
                var marker = new google.maps.Marker({
                  position: {lat: parseFloat(data.notices[i].lat), lng: parseFloat(data.notices[i].long)},
                  animation: google.maps.Animation.DROP,
                  title: 'Aviso ' + data.notices[i].id,
                  aviso: noticeId,
                  fila: fila,
                  info: i
                });
                marker.addListener('click', function() {
                  if(prev_infowindow) {
                    prev_infowindow.close();
                  }

                  if(prev_infowindow != InfoWindows[this.info]) {
                    InfoWindows[this.info].open(map, this);
                    prev_infowindow = InfoWindows[this.info];
                  }
                  else {
                    prev_infowindow = false;
                  }
                  console.log(this.aviso);
                  noticeTimes(this.aviso);
                  var target = document.getElementById(this.fila);
                    target.scrollIntoView({
                    	behavior: 'smooth',
                      block: 'nearest',
                      inline: 'start'
                    });
                    console.log(this.fila);
                });
                markers.unshift(marker);
              }
              for(i = 0; i < markers.length; i++) {
                markers[i].setMap(map);
              }
              var newTableLine = "";
              newTableLine = '<th>Aviso</th>' +
              '<th>Categoria</th>' +
              '<th>Imagenes</th>' +
              '<th>&nbsp;</th>';
              for(i = 0; i < data.notices.length; i++) {
                var URL = "{{url('aviso/')}}/"+data.notices[i].id;
                newTableLine += '<tr id="fila' + data.notices[i].id + '" class="table-row marker-link" onclick="noticeTimes('+ data.notices[i].id +')" data-markerid="' + i + '">' +
                  '<td><span class="badge badge-info">Aviso' + data.notices[i].id +'</span></td>' +
                  '<td><span class="badge badge-warning">'+ data.notices[i].categoria +'</span></td>' +
                  '<td><span id="filaNumImg ' + data.notices[i].id + '" class="badge badge-pill badge-secondary">'+ data.notices[i].numImg +'</span></td>' +
                  '<td><button onclick="location.href=\'' + URL + '\';" class="text-dark btn btn-sm btn-link"><i class="fas fa-external-link-alt"></i></button></td>' +
                '</tr>';
              }
              $("#noticesListBody").fadeOut();
              document.getElementById("noticesListBody").innerHTML = newTableLine;
              $("#noticesListBody").fadeIn();
              if(numberNewNotices < 0) {
                var numberLessNotices = Math.abs(numberNewNotices);
                alertContent = '<i class="fas fa-info-circle"></i> ' + numberLessNotices + ' alertas menos';
              }
              else {
                show(numberNewNotices);
                alertContent = '<i class="fas fa-info-circle"></i> ' + numberNewNotices + ' nuevas alertas';
              }
              document.getElementById("alertUpdateNotices").innerHTML = alertContent;
              $("#alertUpdateNotices").fadeIn("1000");
              setTimeout(function(){
                $("#alertUpdateNotices").fadeOut();
              }, 2000);
              noticeTimes(data.notices.length);
              // Trigger a click event on each marker when the corresponding marker link is clicked
                  $('.marker-link').on('click', function () {
                      console.log(markers[$(this).data('markerid')]);
                      google.maps.event.trigger(markers[$(this).data('markerid')], 'click');
                  });

                  var d = new Date();
                  if(d.getMinutes() < 10) {
                    var n = d.getHours() + ':0' + d.getMinutes();
                  }
                  else {
                    var n = d.getHours() + ':' + d.getMinutes();
                  }
                  document.getElementById("lastUpdateInfo").innerHTML = 'Actualizado a las ' + n;
            }
        },
        error: function(jqxhr, status, exception) {

         }
    });
    if(fromButton == 'false') {
      setTimeout(updateNotices, 5000, 'false');
    }
}

@endsection
