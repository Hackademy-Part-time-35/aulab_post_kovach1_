<nav class="navbar navbar-expand-lg fixed-top bg-body ">
  <div class="container-fluid">
      <a class="navbar-brand"aria-current="page" href="{{route('homepage')}}">Home</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav me-auto">
              <li class="nav-item">
                @auth
              <li class="nav-item">
                  <a class="nav-link" href="{{route('article.create')}}">create</a>
              </li>
              @endauth

              <li class="nav-item">
                  <a class="nav-link" aria-current="page" href="{{route('article.index')}}">tutti gli articoli</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" aria-current="page" href="{{route('careers')}}">Lavora con noi</a>
              </li>


                <ul class="navbar-nav ms-auto " >
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            
                        </a>
                        <ul class="dropdown-menu w-auto">
                                      
                            <li class="nav-item">
                                <button class="dropdown-item d-flex align-items-center w-auto" data-bs-theme-value="light" aria-pressed="false"><i class="bi bi-moon-fill"></i></button>
                            </li>
                            <li class="nav-item">
                                <button class="dropdown-item d-flex align-items-center w-auto" data-bs-theme-value="dark" aria-pressed="false"><i class="bi bi-sun-fill"></i></button>
                            </li>
                        </ul>
                    </li>
                </ul>
                    



              <li class="nav-item">
                <form action="{{ route('article.search') }}" method="GET" class="d-flex" role="search">
                    <input class="form-control me-2" type="search" name="query" placeholder="Cerca tra gli articoli..." aria-label="Search">
                    <button class="btn btn-outline-secondary" type="submit">Cerca</button>
                </form>
            
              </li>
          </ul>
          <!-- Dropdown menu moved to the end -->
          <ul class="navbar-nav ms-auto">
              <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Dropdown link
                  </a>
                  <ul class="dropdown-menu">
                    
                    @auth
                    <form action="/logout" method="POST">
                        @csrf
                        <button type="submit" class="btn"> esci</button>
                        @if (Auth::user()->is_admin)
                            <li><a class="dropdown-item" href="{{route('admin.dashboard')}}">Dashboar admin</a></li>
                        @endif
                        @if (Auth::user()->is_revisor)
                            <li><a class="dropdown-item" href="{{route('revisor.dashboard')}}">Dashboar revisor</a></li>
                        @endif
                        @if (Auth::user()->is_writer)
                            <li><a class="dropdown-item" href="{{route('writer.dashboard')}}">Dashboar writer</a></li>
                        @endif

                    </form>
                    @else
                        <a href="/login" class="btn">accedi</a>
                        <a href="/register" class="btn btn-danger">registrati</a>
                    @endif
                  </ul>
              </li>
          </ul>
      </div>
  </div>
</nav>
