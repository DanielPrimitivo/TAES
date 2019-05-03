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
    bottom:0px;
    right:30px;
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
    left:-100%;
    transition-delay:0.2s;
}
.share ul.active li:nth-child(3){
    top:-100%;
    left:0;
    transition-delay:0.4s;
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
        Visto
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
          <ul class="nav nav-tabs card-header-tabs">
      <li class="nav-item ml-auto">
        <a class="nav-link" href="#">1H</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">2H</a>
      </li>
      <li class="nav-item mr-auto">
        <a class="nav-link" href="#">3H</a>
      </li>
    </ul>
    </div>
        <div class="card-body">
          <ul class="list-group list-group-flush">
            <li class="list-group-item">Humedad: <h6 class="text-muted float-right">90%</h6></li>
            <li class="list-group-item">Viento: <h6 class="text-muted float-right">10 km/h</h6></li>
            <li class="list-group-item">Temp min/max: <h6 class="text-muted float-right">10℃/24℃</h6></li>
            <li class="list-group-item">Precipitaciones: <h6 class="text-muted float-right">60%</h6></li>
          </ul>
        </div>
        <div class="card-footer">
          <small class="text-muted">ult. act el 10/04/2019 a las 22:31
          <div class="float-right">
          <a href="" class="text-dark"><i class="fas fa-sync-alt"></i></a>
          </div>
        </small>
        </div>
      </div> <!-- End of card tiempoActual -->
    </div>

<div class="row-lg-5">
    <div class="card shadow">
      <h5 class="card-header text-center">El tiempo ahora      </h5>
      <div class="card-body">
        <ul class="list-group list-group-flush">
          <li class="list-group-item">Humedad: <h6 class="text-muted float-right">{{$weather->humedad}}%</h6></li>
          <li class="list-group-item">Viento: <h6 class="text-muted float-right">{{$weather->viento}} km/h</h6></li>
          <li class="list-group-item">Dirección viento: <h6 class="text-muted float-right">{{$weather->dirviento}}</h6></li>
          <li class="list-group-item">Temp min/max: <h6 class="text-muted float-right">{{$weather->temperatura}}℃</h6></li>
          <li class="list-group-item">Precipitaciones: <h6 class="text-muted float-right">{{$weather->lluvia}}</h6></li>
        </ul>
      </div>
      <div class="card-footer">
        <small class="text-muted">ult. act {{$weather->updated_at->format('d-m-Y')}} a las {{$weather->updated_at->format('H:i:s')}}
        <div class="float-right">
        <a href="" class="text-dark"><i class="fas fa-sync-alt"></i></a>
        </div>
      </small>
      </div>
    </div> <!-- End of card tiempoActual -->
  </div>
</div> <!-- End of previsiones card lists -->
<div class="col-xs-12 col-sm-12 col-lg-6 col-md-12 mb-2 mt-2">
<div class="shadow card">
<h5 class="card-header text-center">
Últimas imágenes del aviso
<div class="float-right">
  <button onclick="noticeImages();" class="text-dark btn btn-sm btn-link"><i class="fas fa-sync-alt"></i></button>
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
</div>
</div>
</div> <!-- end of map column -->
</div>
</div>
<div class="share">
    <div class="toggle"></div>
    <ul>
        <li><a href="#"><i class="fas fa-archive" aria-hidden="true"></i></a></li>
        @if($notice->visto == 1)
        <li><a href="{{route('visto', $notice->id)}}"><i class="fas fa-eye" aria-label="Marcar no visto"></i></a></li>
        @else
        <li><a href="{{route('visto', $notice->id)}}"><i class="fas fa-eye-slash" aria-label="Marcar no visto"></i></a></li>
        @endif
        <li><a href="#"><i class="fas fa-trash-alt" aria-hidden="true"></i></a></li>
    </ul>
</div>




@endsection

@section('js')
function noticeImages()
{
    var contentString = "";
    $.ajax({
        type: 'POST',
        url: "{{route('ajax.noticeImages')}}",
        data: {notice: {{$notice->id}}, _token: '{{csrf_token()}}' },
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

    $('.toggle').click(function(){
        $('.toggle').toggleClass('active');
        $('ul').toggleClass('active');
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
    noticeImages();
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
