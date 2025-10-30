<nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color:#d6e2ef00;">
  <div class="container-fluid">

    <!-- Botón hamburguesa -->
    <button class="navbar-toggler border-0" type="button"
            data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Menú colapsable -->
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav mx-auto text-center">
        
      </ul>
      <ul class="navbar-nav ms-lg-3 text-center my-1">
        <li class="nav-item">
          <a href="{{ route('register') }}" class="btn btn-sm btn-secondary px-3 shadow">
            Regístrate
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ms-lg-3 text-center">
        <li class="nav-item">
          <a href="{{ route('login') }}" class="btn btn-sm btn-primary px-3 shadow">
            Iniciar Sesión
          </a>
        </li>
      </ul>
      <ul class="navbar-nav mx-auto text-center">
        
      </ul>
    </div>
  </div>
</nav>