<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
      <a class="navbar-brand" href="#">Navbar</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav me-auto">
              <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="{{route('homepage')}}">Home</a>
              </li>
              @auth
              <li class="nav-item">
                  <a class="nav-link" href="{{route('article.create')}}">create</a>
              </li>
              @else
              @endauth
              <li class="nav-item">
                  <a class="nav-link" href="#">Features</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="#">Pricing</a>
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