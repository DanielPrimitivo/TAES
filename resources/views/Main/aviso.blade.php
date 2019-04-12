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
@endsection

@section('content')
<div class="container-fluid">
  <div class="row">
 <!-- end of images box -->
  <div class="col-xs-12 col-sm-12 col-lg-12 col-md-12">
    <div class="row-lg-12">
    <div class="card mt-2 mb-2 shadow">
      <div class="card-header text-center">
        Mapa del aviso X con coordenadas: -48.468, 80.8447
      </div>
    <iframe class="" src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d4413.966512531121!2d-0.7036652467432685!3d38.530410533494475!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses!2ses!4v1554821636145!5m2!1ses!2ses" width="100%" height="370" frameborder="0" style="border:0" allowfullscreen></iframe>
</div>
</div>
<div class="row">
<div class="col-xs-12 col-sm-12 col-lg-6 col-md-12 mt-2 mb-2">
  <div class="row-lg-5">
      <div class="card shadow mb-2">
        <h5 class="card-header text-center">Previsión del tiempo      </h5>
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
          <li class="list-group-item">Humedad: <h6 class="text-muted float-right">50%</h6></li>
          <li class="list-group-item">Viento: <h6 class="text-muted float-right">24 km/h</h6></li>
          <li class="list-group-item">Temp min/max: <h6 class="text-muted float-right">15℃/28℃</h6></li>
          <li class="list-group-item">Precipitaciones: <h6 class="text-muted float-right">10%</h6></li>
        </ul>
      </div>
      <div class="card-footer">
        <small class="text-muted">ult. act el 11/04/2019 a las 12:45
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
  <a href="" class="text-dark"><i class="fas fa-sync-alt"></i></a>
</div>
</h5>
<div class="card-body scroll-box">
<div class="container">
   <div class="row">
       <div class="row">
           <div class="col-lg-4 col-md-5 col-xs-6 thumb">
             <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="Aviso 1"
                data-image="https://static.independent.co.uk/s3fs-public/thumbnails/image/2016/10/10/15/forestfire-0.jpg?w968h681"
                data-target="#image-gallery">
                  <img class="img-thumbnail"
                      src="https://static.independent.co.uk/s3fs-public/thumbnails/image/2016/10/10/15/forestfire-0.jpg?w968h681"
                      alt="Another alt text">
                    </a>
                  </div>
                  <div class="col-lg-4 col-md-5 col-xs-6 thumb">
                    <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="Aviso 1"
                    data-image="https://www.thelocal.de/userdata/images/article/1342d936cea42df5c34d1245c7d384e218740b62f430731f92b0c76a1761fdcb.jpg"
                    data-target="#image-gallery">
                    <img class="img-thumbnail"
                      src="https://www.thelocal.de/userdata/images/article/1342d936cea42df5c34d1245c7d384e218740b62f430731f92b0c76a1761fdcb.jpg"
                      alt="Another alt text">
                    </a>
                  </div>

                  <div class="col-lg-4 col-md-5 col-xs-6 thumb">
                    <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="Aviso 1"
                    data-image="https://static.independent.co.uk/s3fs-public/thumbnails/image/2016/10/10/15/forestfire-0.jpg?w968h681"
                    data-target="#image-gallery">
                    <img class="img-thumbnail"
                      src="https://static.independent.co.uk/s3fs-public/thumbnails/image/2016/10/10/15/forestfire-0.jpg?w968h681"
                      alt="Another alt text">
                    </a>
                  </div>
                  <div class="col-lg-4 col-md-5 col-xs-6 thumb">
                    <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="Aviso 1"
                    data-image="https://www.thelocal.de/userdata/images/article/1342d936cea42df5c34d1245c7d384e218740b62f430731f92b0c76a1761fdcb.jpg"
                    data-target="#image-gallery">
                    <img class="img-thumbnail"
                      src="https://www.thelocal.de/userdata/images/article/1342d936cea42df5c34d1245c7d384e218740b62f430731f92b0c76a1761fdcb.jpg"
                      alt="Another alt text">
                    </a>
                  </div>



                  <div class="col-lg-4 col-md-5 col-xs-6 thumb">
                    <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="Aviso 1"
                    data-image="https://static.independent.co.uk/s3fs-public/thumbnails/image/2016/10/10/15/forestfire-0.jpg?w968h681"
                    data-target="#image-gallery">
                    <img class="img-thumbnail"
                      src="https://static.independent.co.uk/s3fs-public/thumbnails/image/2016/10/10/15/forestfire-0.jpg?w968h681"
                      alt="Another alt text">
                    </a>
                  </div>
                  <div class="col-lg-4 col-md-5 col-xs-6 thumb">
                    <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="Aviso 1"
                    data-image="https://www.thelocal.de/userdata/images/article/1342d936cea42df5c34d1245c7d384e218740b62f430731f92b0c76a1761fdcb.jpg"
                    data-target="#image-gallery">
                    <img class="img-thumbnail"
                      src="https://www.thelocal.de/userdata/images/article/1342d936cea42df5c34d1245c7d384e218740b62f430731f92b0c76a1761fdcb.jpg"
                      alt="Another alt text">
                    </a>
                  </div>



                  <div class="col-lg-4 col-md-5 col-xs-6 thumb">
                    <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="Aviso 1"
                    data-image="https://static.independent.co.uk/s3fs-public/thumbnails/image/2016/10/10/15/forestfire-0.jpg?w968h681"
                    data-target="#image-gallery">
                    <img class="img-thumbnail"
                      src="https://static.independent.co.uk/s3fs-public/thumbnails/image/2016/10/10/15/forestfire-0.jpg?w968h681"
                      alt="Another alt text">
                    </a>
                  </div>
                  <div class="col-lg-4 col-md-5 col-xs-6 thumb">
                    <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="Aviso 1"
                    data-image="https://www.thelocal.de/userdata/images/article/1342d936cea42df5c34d1245c7d384e218740b62f430731f92b0c76a1761fdcb.jpg"
                    data-target="#image-gallery">
                    <img class="img-thumbnail"
                      src="https://www.thelocal.de/userdata/images/article/1342d936cea42df5c34d1245c7d384e218740b62f430731f92b0c76a1761fdcb.jpg"
                      alt="Another alt text">
                    </a>
                  </div>
                  <div class="col-lg-4 col-md-5 col-xs-6 thumb">
                    <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="Aviso 1"
                    data-image="https://static.independent.co.uk/s3fs-public/thumbnails/image/2016/10/10/15/forestfire-0.jpg?w968h681"
                    data-target="#image-gallery">
                    <img class="img-thumbnail"
                      src="https://static.independent.co.uk/s3fs-public/thumbnails/image/2016/10/10/15/forestfire-0.jpg?w968h681"
                      alt="Another alt text">
                    </a>
                  </div>
                </div>
              </div>
</div>


    <div class="modal fade" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="image-gallery-title"></h4>
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




@endsection

@section('js')
let modalId = $('#image-gallery');

$(document)
  .ready(function () {

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
@endsection