<nav class="navbar navbar-expand-lg navbar-dark bg-dark" >
  @if(Route::current()->getName() != 'login' && Route::current()->getName() != 'register')
  <a class="navbar-brand" href="{{route('dashboard')}}"><img class="d-inline-block mr-2" style="border-radius: 50%" src="{{ URL::asset('/fireviewer/logo.png') }}" width="70" height="70">FireViewer</a>
  @else
  <a class="navbar-brand" href="{{route('dashboard')}}">FireViewer</a>
  @endif
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">

    <ul class="navbar-nav mr-auto push-right">

    </ul>
<div class="btn-toolbar navbar-nav" role="toolbar">

<div class="btn-group mr-2" role="group">
  @guest
        <li class="nav-item">
            <a class="btn btn-success" href="{{ route('login') }}"><i class="fas fa-sign-in-alt mr-2"></i>{{ __('Acceso al panel') }}</a>
        </li>
        @if (Route::has('register'))
            <li class="nav-item">
                <a class="btn btn-secondary ml-2" href="{{ route('register') }}"><i class="fas fa-user-plus mr-2"></i>{{ __('Darse de alta') }}</a>
            </li>
        @endif
        @else
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
  @if(Route::current()->getName() != 'dashboard' && Route::current()->getName() != 'login' && Route::current()->getName() != 'register')
    <a href="{{route('dashboard')}}" class="customButton btn btn-primary"><i class="fas fa-columns"></i></a>
    @endif
    <!-- Adding more buttons in future -->
</div>

<div class="btn-group mr-2" role="group">
                              <li class="nav-item dropdown">
                                  <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                      <i class="far fa-user-circle mr-2"></i>{{ Auth::user()->name }} <span class="caret"></span>
                                  </a>

                                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                      <a class="dropdown-item btn-danger" href="{{ route('logout') }}"
                                         onclick="event.preventDefault();
                                                       document.getElementById('logout-form').submit();">
                                          <i class="fas fa-sign-out-alt mr-2"></i>{{ __('Cerrar sesión') }}
                                      </a>

                                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                          @csrf
                                      </form>
                                  </div>
                              </li>
                          @endguest
</div>

</div>
</nav>
