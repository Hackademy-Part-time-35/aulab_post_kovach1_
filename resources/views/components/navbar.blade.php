<nav class="navbar navbar-expand-lg fixed-top bg-body">
  <div class="container-fluid">
      <!-- Enlace a la página de inicio -->
      <a class="navbar-brand orbitron-uniquifier" aria-current="page" href="{{ route('homepage') }}">TheAulabPost</a>
      
      <!-- Botón del menú para pantallas pequeñas -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Contenido del menú colapsable -->
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav me-auto">
              <li class="nav-item">
                  <div class="vr d-none d-lg-flex h-100 mx-lg-2 text-white"></div>
                  <hr class="d-lg-none my-2 text-white-50">
              </li>

              <!-- Enlace a la creación de un artículo (solo visible si el usuario está autenticado) -->
                @auth
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('article.create') }}">Create</a>
                </li>
                <li class="nav-item py-2 py-lg-1 col-12 col-lg-auto">
                    <div class="vr d-none d-lg-flex h-100 mx-lg-2 text-white"></div>
                    <hr class="d-lg-none my-2 text-white-50">
                </li>
                @endauth

              <!-- Enlace a la lista de artículos -->
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('article.index') }}">Tutti gli articoli</a>
                </li>
                <li class="nav-item py-2 py-lg-1 col-12 col-lg-auto">
                    <div class="vr d-none d-lg-flex h-100 mx-lg-2 text-white"></div>
                    <hr class="d-lg-none my-2 text-white-50">
                </li>

              <!-- Enlace a la página de carreras (solo visible si el usuario está autenticado) -->
                @auth
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('careers') }}">Lavora con noi</a>
                </li>
                <li class="nav-item py-2 py-lg-1 col-12 col-lg-auto">
                    <div class="vr d-none d-lg-flex h-100 mx-lg-2 text-white"></div>
                    <hr class="d-lg-none my-2 text-white-50">
                </li>
                @endauth

              <!-- Barra de búsqueda de artículos -->
              <li class="nav-item">
                  <form action="{{ route('article.search') }}" method="GET" class="d-flex" role="search">
                      <input class="form-control me-2" type="search" name="query" placeholder="Cerca tra gli articoli..." aria-label="Search">
                      <button class="btn btn-outline-secondary" type="submit">Cerca</button>
                  </form>
              </li>
          </ul>

          <ul class="navbar-nav ms-auto">
          <!-- Opciones del modo de color (Dark/Light/Auto) -->
              <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <i id="themeIcon" class="bi bi-moon-fill"></i>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                      <li>
                          <button class="dropdown-item d-flex align-items-center w-auto" data-bs-theme-value="dark" aria-pressed="false">
                              <i class="bi bi-moon-fill"></i> Dark
                          </button>
                      </li>
                      <li>
                          <button class="dropdown-item d-flex align-items-center w-auto" data-bs-theme-value="light" aria-pressed="false">
                              <i class="bi bi-sun-fill"></i> Light
                          </button>
                      </li>
                      <li>
                          <button class="dropdown-item d-flex align-items-center w-auto" data-bs-theme-value="auto" aria-pressed="true">
                              <i class="bi bi-circle-half"></i> Auto
                          </button>
                      </li>
                  </ul>
              </li>

              <!-- Divisor visual -->
              <li class="nav-item">
                  <div class="vr d-none d-lg-flex h-100 mx-lg-2 text-white"></div>
                  <hr class="d-lg-none my-2 text-white-50">
              </li>

              <!-- Menú desplegable para el usuario autenticado -->
              <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Account
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                      <!-- Opciones del dashboard según el rol del usuario -->
                      @auth
                      <form action="/logout" method="POST">
                          @csrf
                          <button type="submit" class="btn">esci</button>
                          @if (Auth::user()->is_admin)
                              <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Dashboard admin</a></li>
                          @endif
                          @if (Auth::user()->is_revisor)
                              <li><a class="dropdown-item" href="{{ route('revisor.dashboard') }}">Dashboard revisor</a></li>
                          @endif
                          @if (Auth::user()->is_writer)
                              <li><a class="dropdown-item" href="{{ route('writer.dashboard') }}">Dashboard writer</a></li>
                          @endif
                      </form>
                      @else
                      <!-- Enlaces de inicio de sesión o registro para usuarios no autenticados -->
                      <a href="/login" class="btn">accedi</a>
                      <a href="/register" class="btn btn-danger">registrati</a>
                      @endauth
                  </ul>
              </li>
          </ul>
      </div>
  </div>
</nav>
