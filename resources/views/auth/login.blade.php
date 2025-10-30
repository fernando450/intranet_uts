@extends('layouts.guest')

@section('title', 'Login')

@push('css')
    <style>
      body {
        background: #fcfcfb;
        background-size: cover;
        overflow: hidden;
        font-family: 'Poppins', sans-serif;
        position: relative;
      }

      /* Solo en pantallas grandes mantenemos fixed */
      @media (min-width: 768px) {
        body {
          background-attachment: fixed;
        }
      }


      /* Footer fijo con fondo degradado */
      .footer-waves {
        position: fixed;
        bottom: -8%;
        left: 0;
        width: 100%;
        height: 200px; /* alto total del bloque */
        overflow: hidden;
        line-height: 0;
        z-index: 1;
      }

      /* SVG de olas invertidas */
      .waves {
        position: absolute;
        bottom: 0;
        width: 100%;
        height: 100px;
        min-height: 90px;
        max-height: 120px;
      }

      /* Animación de olas */
      .parallax > use {
        animation: move-forever 55s cubic-bezier(.55,.5,.45,.5) infinite;
      }
      .parallax > use:nth-child(1) { animation-delay: -5s; animation-duration: 10s; }
      .parallax > use:nth-child(2) { animation-delay: -6s; animation-duration: 13s; }
      .parallax > use:nth-child(3) { animation-delay: -7s; animation-duration: 16s; }
      .parallax > use:nth-child(4) { animation-delay: -8s; animation-duration: 20s; }

      @keyframes move-forever {
        0%   { transform: translate3d(-90px,0,0); }
        100% { transform: translate3d(85px,0,0); }
      }

      @keyframes animate {
        0%   { background-position: 0% 50%; }
        50%  { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
      }

    .card_start {
      border: none; /* si quieres quitar el borde por defecto */
      border-radius: 12px; /* opcional, para redondear */
      box-shadow: 0 4px 15px rgba(90, 29, 111, 0.445); /* sombra morada */
      transition: all 0.3s ease-in-out;
    }
    </style>
@endpush

@section('content')
    <!-- Contenedor principal -->
    <div class="row align-items-center">
        <!-- Texto a la derecha -->
        <div style="z-index: 2;" class="col-md-6 d-none d-md-flex bg-azul flex-column justify-content-center align-items-center position-relative">
            <img src="{{ asset('build/assets/img/Logo.png') }}" class="img-fluid" alt="Logo">
            <h1><span class="badge text-bg-secondary">Bienvenidos a la Intranet</span></h1>
        </div>
        
        <!-- Caja de login -->
        <div class="col-md-6 d-flex justify-content-center align-items-center mt-mobile-15">
            @include('layouts.partials.alert')
            <div class="card card_start w-100 px-3" style="max-width: 400px; z-index: 2">
                <div class="row mt-4">
                    <img class="mx-auto mb-3 d-block" src="{{ asset('build/assets/img/logo_intranet.png') }}" style="width: 50%">
                    <h1 class="h3 fw-normal text-center" style="color: #7c2a8e">Inicio de sesión</h1>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-floating mb-2 mt-2">
                            <input autofocus autocomplete="off"
                                class="form-control" name="email" id="email" type="email"
                                placeholder="name@uts.edu.com" required/>
                            <label for="email">Correo eléctronico:</label>
                        </div>
                        <div class="form-floating mb-2 position-relative">
                            <input class="form-control" name="password"
                                id="inputPassword" type="password" placeholder="Password" required />
                            
                            <!-- Ícono del ojo -->
                            <span toggle="#password-field" onclick="passwordShow(this)" 
                                class="fa fa-fw fa-eye field-icon toggle-password position-absolute top-50 end-0 translate-middle-y me-3"
                                style="cursor: pointer;"></span>
                            
                            <label for="inputPassword">Contraseña:</label>
                        </div>
                        <div class="checkbox mb-3">
                            <label>
                            <input type="checkbox" value="remember-me"> Recuérdame
                            </label>
                        </div>
                        <button class="w-100 btn btn-lg btn-primary" onclick="spinner(event,this)" type="submit">
                            <span class="spinner-border spinner-border-sm" id="spinner" role="status" hidden aria-hidden="true"></span>
                            Iniciar Sesión
                        </button>
                        <p class="mt-1 mb-1 text-muted text-center">
                            <a id="forgot-password" style="color: #7c2a8e" href="/login/forgot-password">¿Ha olvidado su contraseña?</a>
                        </p>
                        <p class="mb-4 text-muted text-center">
                            <a href="register" style="color: #75c227">¿Nuevo por aquí?</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-waves">
      <svg class="waves" xmlns="http://www.w3.org/2000/svg"
          xmlns:xlink="http://www.w3.org/1999/xlink"
          viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
        <defs>
          <path id="gentle-wave"
                d="M-160 44c30 0 58-18 88-18s 58 18 88 18 
                  58-18 88-18 58 18 88 18 v44h-352z" />
        </defs>
        <g class="parallax">
          <use xlink:href="#gentle-wave" x="48" y="0" fill="#75c22796" />
          <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(90, 29, 111, 0.753)" />
          <use xlink:href="#gentle-wave" x="48" y="5" fill="#75c227" />
          <use xlink:href="#gentle-wave" x="48" y="7" fill="#75c22796" />
        </g>
      </svg>
    </div>
@endsection