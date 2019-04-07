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
            height: 700px;
            padding: 1rem;
        }
@endsection

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-xs-12 col-sm-6 col-lg-4">
<div class="shadow card mt-2 mb-2">
  <div class="card-header">
    Últimas imágenes
    <div class="float-right">
      <a href="" class="text-dark"><i class="fas fa-sync-alt"></i></a>
    </div>
</div>
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
                        <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="Aviso 2"
                        data-image="http://mediad.publicbroadcasting.net/p/nhpr/files/styles/medium/public/201710/dilly_fire_1.jpg"
                        data-target="#image-gallery">
                        <img class="img-thumbnail"
                          src="http://mediad.publicbroadcasting.net/p/nhpr/files/styles/medium/public/201710/dilly_fire_1.jpg"
                          alt="Another alt text">
                        </a>
                      </div>
                      <div class="col-lg-4 col-md-5 col-xs-6 thumb">
                        <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="Aviso 3"
                        data-image="https://www.thelocal.de/userdata/images/article/1342d936cea42df5c34d1245c7d384e218740b62f430731f92b0c76a1761fdcb.jpg"
                        data-target="#image-gallery">
                        <img class="img-thumbnail"
                          src="https://www.thelocal.de/userdata/images/article/1342d936cea42df5c34d1245c7d384e218740b62f430731f92b0c76a1761fdcb.jpg"
                          alt="Another alt text">
                        </a>
                      </div>

                      <div class="col-lg-4 col-md-5 col-xs-6 thumb">
                        <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="Aviso 4"
                        data-image="https://static.independent.co.uk/s3fs-public/thumbnails/image/2016/10/10/15/forestfire-0.jpg?w968h681"
                        data-target="#image-gallery">
                        <img class="img-thumbnail"
                          src="https://static.independent.co.uk/s3fs-public/thumbnails/image/2016/10/10/15/forestfire-0.jpg?w968h681"
                          alt="Another alt text">
                        </a>
                      </div>
                      <div class="col-lg-4 col-md-5 col-xs-6 thumb">
                        <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="Aviso 5"
                        data-image="http://mediad.publicbroadcasting.net/p/nhpr/files/styles/medium/public/201710/dilly_fire_1.jpg"
                        data-target="#image-gallery">
                        <img class="img-thumbnail"
                          src="http://mediad.publicbroadcasting.net/p/nhpr/files/styles/medium/public/201710/dilly_fire_1.jpg"
                          alt="Another alt text">
                        </a>
                      </div>
                      <div class="col-lg-4 col-md-5 col-xs-6 thumb">
                        <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="Aviso 6"
                        data-image="https://www.thelocal.de/userdata/images/article/1342d936cea42df5c34d1245c7d384e218740b62f430731f92b0c76a1761fdcb.jpg"
                        data-target="#image-gallery">
                        <img class="img-thumbnail"
                          src="https://www.thelocal.de/userdata/images/article/1342d936cea42df5c34d1245c7d384e218740b62f430731f92b0c76a1761fdcb.jpg"
                          alt="Another alt text">
                        </a>
                      </div>



                      <div class="col-lg-4 col-md-5 col-xs-6 thumb">
                        <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="Aviso 7"
                        data-image="https://static.independent.co.uk/s3fs-public/thumbnails/image/2016/10/10/15/forestfire-0.jpg?w968h681"
                        data-target="#image-gallery">
                        <img class="img-thumbnail"
                          src="https://static.independent.co.uk/s3fs-public/thumbnails/image/2016/10/10/15/forestfire-0.jpg?w968h681"
                          alt="Another alt text">
                        </a>
                      </div>
                      <div class="col-lg-4 col-md-5 col-xs-6 thumb">
                        <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="Aviso 8"
                        data-image="http://mediad.publicbroadcasting.net/p/nhpr/files/styles/medium/public/201710/dilly_fire_1.jpg"
                        data-target="#image-gallery">
                        <img class="img-thumbnail"
                          src="http://mediad.publicbroadcasting.net/p/nhpr/files/styles/medium/public/201710/dilly_fire_1.jpg"
                          alt="Another alt text">
                        </a>
                      </div>
                      <div class="col-lg-4 col-md-5 col-xs-6 thumb">
                        <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="Aviso 9"
                        data-image="https://www.thelocal.de/userdata/images/article/1342d936cea42df5c34d1245c7d384e218740b62f430731f92b0c76a1761fdcb.jpg"
                        data-target="#image-gallery">
                        <img class="img-thumbnail"
                          src="https://www.thelocal.de/userdata/images/article/1342d936cea42df5c34d1245c7d384e218740b62f430731f92b0c76a1761fdcb.jpg"
                          alt="Another alt text">
                        </a>
                      </div>



                      <div class="col-lg-4 col-md-5 col-xs-6 thumb">
                        <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="Aviso 10"
                        data-image="https://static.independent.co.uk/s3fs-public/thumbnails/image/2016/10/10/15/forestfire-0.jpg?w968h681"
                        data-target="#image-gallery">
                        <img class="img-thumbnail"
                          src="https://static.independent.co.uk/s3fs-public/thumbnails/image/2016/10/10/15/forestfire-0.jpg?w968h681"
                          alt="Another alt text">
                        </a>
                      </div>
                      <div class="col-lg-4 col-md-5 col-xs-6 thumb">
                        <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="Aviso 11"
                        data-image="http://mediad.publicbroadcasting.net/p/nhpr/files/styles/medium/public/201710/dilly_fire_1.jpg"
                        data-target="#image-gallery">
                        <img class="img-thumbnail"
                          src="http://mediad.publicbroadcasting.net/p/nhpr/files/styles/medium/public/201710/dilly_fire_1.jpg"
                          alt="Another alt text">
                        </a>
                      </div>
                      <div class="col-lg-4 col-md-5 col-xs-6 thumb">
                        <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="Aviso 12"
                        data-image="https://www.thelocal.de/userdata/images/article/1342d936cea42df5c34d1245c7d384e218740b62f430731f92b0c76a1761fdcb.jpg"
                        data-target="#image-gallery">
                        <img class="img-thumbnail"
                          src="https://www.thelocal.de/userdata/images/article/1342d936cea42df5c34d1245c7d384e218740b62f430731f92b0c76a1761fdcb.jpg"
                          alt="Another alt text">
                        </a>
                      </div>
                      <div class="col-lg-4 col-md-5 col-xs-6 thumb">
                        <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="Aviso 13"
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
</div> <!-- end of images box -->
  <div class="col-xs-12 col-sm-6 col-lg-8">
    <div class="row-lg-9">
    <div class="card mt-2 mb-2 shadow">
      <div class="card-header text-center">
        Mapa de avisos
      </div>
    <iframe class="" src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d35311.22684530311!2d-0.6951584730487351!3d38.5306879710471!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses!2ses!4v1554661517100!5m2!1ses!2ses" width="100%" height="370" frameborder="0" style="border:0" allowfullscreen></iframe>
</div>
</div>
<div class="row-lg-9">
  <div class="card-deck mt-2 mb-4">
    <div class="card shadow">
      <h5 class="card-header text-center">Últimos avisos</h5>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped">
            <tbody>
              <tr>
                <td>LAT</td>
                <td>LONG</td>
                <td><a href="#" class="text-dark"><i class="fas fa-check"></i></a></td>
                <td><a href="#" class="text-dark"><i class="fas fa-external-link-alt"></i></a></td>
              </tr>
              <tr>
                <td>LAT</td>
                <td>LONG</td>
                <td><a href="#" class="text-dark"><i class="fas fa-check"></i></a></td>
                <td><a href="#" class="text-dark"><i class="fas fa-external-link-alt"></i></a></td>
              </tr>
              <tr>
                <td>LAT</td>
                <td>LONG</td>
                <td><a href="#" class="text-dark"><i class="fas fa-check"></i></a></td>
                <td><a href="#" class="text-dark"><i class="fas fa-external-link-alt"></i></a></td>
              </tr>
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
      <i class="card-img-top fas fa-cloud-sun text-center mt-5" style="font-size: 80px;"></i>
      <div class="card-body text-center">
        <h5 class="card-title">Temperatura actual</h5>
        <h4 class="text-center text-muted">26℃</h4>
      </div>
      <div class="card-footer">
        <small class="text-muted">Actualizado hace 3 minutos</small>
      </div>
    </div>
    <div class="card shadow">
      <h5 class="card-header text-center">El tiempo para el aviso seleccionado      </h5>
      <div class="card-body">
        <ul class="list-group list-group-flush">
          <li class="list-group-item">Humedad: <h6 class="text-muted float-right">50%</h6></li>
          <li class="list-group-item">Viento: <h6 class="text-muted float-right">24 km/h</h6></li>
          <li class="list-group-item">Temp min/max: <h6 class="text-muted float-right">15℃/28℃</h6></li>
          <li class="list-group-item">Precipitaciones: <h6 class="text-muted float-right">10%</h6></li>
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
