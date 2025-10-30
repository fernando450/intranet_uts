<nav class="sb-topnav navbar navbar-expand" style=" Z-index: 1; backgraund: #ffffff">
    <!-- Navbar Brand-->
    <a class="navbar-brand text-secondary ps-3" href="#">INTRANET UTS</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link text-secondary btn-sm order-1 order-lg-0 me-4 me-lg-0 hide-on-desktop" onclick="toggleBtn()" id="toggleBtn" href="#"><i id="icono" class="fas fa-list"></i></button> 
    <!-- Navbar-->
    <div class="ms-auto d-flex align-items-center me-3">
        <button class="btn btn-sm btn-link" type="button" title="Abrir Caja" data-bs-toggle="modal" data-bs-target="#abrirCaja"><i class="fa-solid fa-cash-register text-secondary"></i></button>

        <ul class="navbar-nav d-md-inline-block text-secondary">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-secondary" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw text-secondary"></i></a>
                <ul class="dropdown-menu dropdown-menu-end " aria-labelledby="navbarDropdown">
                    <li>
                        <a class="dropdown-item" href="#">
                            Mi empresa
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{Route('user.profile')}}">
                            Mi perfil
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="dropdown-item" type="submit">Cerrar sesión</button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>

</nav>
