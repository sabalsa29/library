<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="/">Library</a>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/book">Libros</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/categorias">Categorias</a>
        </li>

      </ul>
      <div class="btn-group" role="group">
    <button id="btnGroupDrop1" type="button" class="btn btn-muted dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
      Arturo Sabalsa Espino
    </button>
    <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
      <li>

      <a class="dropdown-item" href="javascript:void();" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="uil uil-sign-out-alt font-size-18 align-middle mr-1 text-muted"></i> <span class="align-middle">Salir</span></a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>

      </li>
      <li><a class="dropdown-item" href="#">Nuevo Usuario</a></li>
    </ul>
  </div>
    </div>
  </div>
</nav>
