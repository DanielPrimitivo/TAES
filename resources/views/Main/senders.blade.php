@extends('layouts.layout')
@section('css')
@endsection

@section('content')
<div class="container-fluid">
  <div class="row">
 <!-- end of images box -->
  <div class="col-xs-12 col-sm-12 col-lg-12 col-md-12">
    <div class="row-lg-12">
    <div class="card mt-2 mb-2 shadow">
      <table class="table table-hover table-striped">
  <thead>
    <tr class="bg-dark text-white">
      <th scope="col">#</th>
      <th scope="col">Teléfono</th>
      <th scope="col">Categoria</th>
      <th scope="col">&nbsp</th>
    </tr>
  </thead>
  <tbody>
    @foreach($senders as $sender)
    <tr>
      <th scope="row">{{$sender->id}}</th>
      <td>{{$sender->tlf}}</td>
      <td>{{$sender->categoria}}</td>
      <td>
        <button onclick="categoryChange('{{$sender->id}}')" class="btn btn-sm btn-success" data-toggle="modal" data-target="#categoryChange"><i class="fas fa-edit mr-2"></i> Cambiar categoria</button>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
<div class="ml-auto mr-2">
{{$senders->links()}}
</div>
</div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="categoryChange" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cambiar categoria del remitente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="container text-center mb-2 mt-3">

        <form method="POST" action="{{ action('SenderController@updateCat') }}">
            {{ csrf_field() }}
            <input type="hidden" name="senderid" id="senderid" value="">
        <div class="modal-body" id="filterBy_body">
        <div class="form-inline mt-2" id="type">
            <label for="type" class="mr-2"><h6><i class="fas fa-archive"></i> Categoria: </h6></label>
            <select name="newCat" id="newCat" style="block" class="custom-select">
                <option value="Ciudadano">Ciudadano</option>
                <option value="Cuerpos de justicia">Cuerpos de justicia</option>
                <option value="Cuerpo de bomberos">Cuerpo de bomberos</option>
                <option value="Ciudadano preferente">Ciudadano preferente</option>
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
@endsection

@section('js')
function categoryChange(senderid) {
  document.getElementById('senderid').value = senderid;
}
@endsection
