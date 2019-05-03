@guest
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" >
@else
<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark" ><a href="#menu-toggle" id="menu-toggle" onClick="changeLayerButton" class="navbar-brand"><i id="iconLayer" class="fas fa-layer-group"></i></a>
@endguest
  @if(Route::current()->getName() != 'login' && Route::current()->getName() != 'register')
  <a class="navbar-brand" href="{{route('dashboard')}}"><img class="d-inline-block mr-2" style="border-radius: 50%" src="{{ URL::asset('/fireviewer/logo.png') }}" width="70" height="70">AlertViewer</a>
  @else
  <a class="navbar-brand" href="{{route('dashboard')}}">AlertViewer</a>
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
        @else
<li class="nav-item dropdown">
        <a class="btn btn-secondary dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="far fa-bell"></i>
          <span class="badge badge-danger" id="numberOfPendingNotices">5</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" id="pendingNoticesDropdown" aria-labelledby="navbarDropdownMenuLink">
          
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
