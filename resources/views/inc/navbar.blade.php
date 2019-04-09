<nav class="navbar navbar-expand-lg navbar-dark bg-dark" >
  <a class="navbar-brand" href="{{route('dashboard')}}"><img class="d-inline-block mr-2" style="border-radius: 50%" src="{{ URL::asset('/fireviewer/logo.png') }}" width="70" height="70">FireViewer</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">

    <ul class="navbar-nav mr-auto push-right">

    </ul>
<div class="btn-toolbar navbar-nav" role="toolbar">

<div class="btn-group mr-2" role="group">
<li class="nav-item dropdown">
        <a class="btn btn-secondary dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="far fa-bell"></i>
          <span class="badge badge-danger">5</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item btn-outline-secondary" href="{{route('aviso')}}" id="link1"><i class="fas fa-fire mr-2"></i> Aviso 1</a>
          <a class="dropdown-item btn-outline-secondary" href="#" id="link1"><i class="fas fa-fire mr-2"></i> Aviso 2</a>
          <a class="dropdown-item btn-outline-secondary" href="#" id="link1"><i class="fas fa-fire mr-2"></i> Aviso 3</a>
          <a class="dropdown-item btn-outline-secondary" href="#" id="link2"><i class="fas fa-fire mr-2"></i> Aviso 4</a>
          <a class="dropdown-item btn-outline-secondary" href="#" id="link3"><i class="fas fa-fire mr-2"></i> Aviso x...</a>
        </div>
      </li>
</div>
<div class="btn-group mr-2" role="group">
  @if(Route::current()->getName() != 'dashboard')
    <a href="{{route('dashboard')}}" class="customButton btn btn-primary"><i class="fas fa-columns"></i></a>
    @endif
    <!-- Adding more buttons in future -->
</div>
</div>
</nav>
