<!-- ---------- Overlay ---------- -->
<div class="overlay" id="overlay"></div>

<!-- ---------- Menú flotante ---------- -->
<div class="floating-menu">
  <!-- Botón principal -->
  <button class="fab-btn" id="mainFab">
    <i id="iconoMenu" class="fas fa-list"></i>
  </button>

  <!-- Opciones -->
  <div class="menu-items" id="menuItems">
    <!--Home-->
    <a href="#" class="menu-item">
      <i class="fa-solid fa-house"></i> Inicio
    </a>
    <!--Teachers-->
    <a href="{{ route('teachers.index') }}" class="menu-item">
      <i class="fa-solid fa-chalkboard-user"></i> Docentes
    </a>
    <!--News-->
    <a href="{{ route('news.index') }}" class="menu-item">
      <i class="fa-solid fa-newspaper"></i> Noticias
    </a>

    <a href="#" class="menu-item">
      <i class="fa-solid fa-box-archive"></i> Detalles
    </a>

    <a href="#" class="menu-item">
      <i class="fa-solid fa-tag"></i> Categorías
    </a>

    <!--Security-->
    <div class="menu-item submenu-toggle" id="seguridadBtn">
      <i class="fa-solid fa-lock"></i> Seguridad
      <i class="fas fa-angle-down ms-auto"></i>
    </div>
    <div class="submenu" id="submenuSeguridad">
      <a href="{{ route('users.index') }}"><i class="fa-solid fa-user"></i> Usuarios</a>
      <a href="{{ route('roles.index') }}"><i class="fa-solid fa-user-shield"></i> Roles</a>
      <a href="{{ route('permissions.index') }}"><i class="fa-solid fa-check"></i> Permisos</a>
    </div>
  </div>
</div>