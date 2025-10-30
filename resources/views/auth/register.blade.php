@extends('layouts.guest')

@section('title', 'Registrarse')

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
      height: 480px; /* altura fija, ajusta según tu diseño */
      overflow-y: auto; /* activa scroll vertical */
    }

    .card-option {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      border: 2px solid #dee2e6;
      border-radius: 1rem;
      padding: 10px;
      cursor: pointer;
      transition: all 0.25s ease-in-out;
      background-color: #fff;
      box-shadow: 0 2px 6px rgba(0,0,0,0.05);
      text-align: center;
    }

    .card-option:hover {
      border-color: #6f42c1;
      transform: translateY(-3px);
    }

    .card-option .icon {
      font-size: 2rem;
      color: #6c757d;
      margin-bottom: 0.5rem;
    }

    .btn-check:checked + .card-option {
      border-color: #6f42c1;
      background-color: #f3e8ff;
      box-shadow: 0 4px 12px rgba(111, 66, 193, 0.3);
    }

    .btn-check:checked + .card-option .icon {
      color: #6f42c1;
    }

    .btn-check:checked + .card-option h6 {
      color: #6f42c1;
    }

    </style>
@endpush

@section('content')
    <!-- Contenedor principal -->
    <div class="row align-items-center">
      <!-- Texto a la derecha -->
      <div style="z-index: 2;" class="col-md-6 d-none d-md-flex flex-column justify-content-center align-items-center">
        <img src="{{ asset('build/assets/img/Logo.png') }}" class="img-fluid" alt="Logo">
        <h1><span class="badge text-bg-secondary">Bienvenidos a la Intranet</span></h1>
      </div>        
      <!-- Caja de login -->
      <div class="col-md-6 d-flex justify-content-center align-items-center mt-mobile-15">
        <div class="card card_start w-100 px-3" style="max-width: 400px; z-index: 2">
          <div class="row mt-4">
            <img class="mx-auto mb-3 d-block" src="{{ asset('build/assets/img/logo_intranet.png') }}" style="width: 50%">
            <h1 class="h3 fw-normal text-center" style="color: #7c2a8e">Regístrate Ahora</h1>
            <form role="form text-left" method="POST" action="/register">
              @csrf
              <div class="mb-2">
                  <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : ''}}" placeholder="Nombre Completo" name="name" id="name" aria-label="nombres" aria-describedby="nombre completo" value="{{ old('name') }}" required>
                  @error('name')
                      <p class="text-danger text-xs mt-2">{{ $message }}</p>
                  @enderror
              </div>
              <div class="mb-2">
                  <input type="number" class="form-control {{ $errors->has('document_number') ? 'is-invalid' : ''}}" placeholder="Número de Identificación" name="document_number" id="document_number" aria-label="document_number" aria-describedby="document_number" value="{{ old('document_number') }}" required>
                  @error('document_number')
                      <p class="text-danger text-xs mt-2">{{ $message }}</p>
                  @enderror
              </div>
              <div class="mb-2">
                  <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : ''}}" placeholder="Correo electrónico" name="email" id="email" aria-label="Email" aria-describedby="email-addon" value="{{ old('email') }}" required>
                  @error('email')
                      <p class="text-danger text-xs mt-2">{{ $message }}</p>
                  @enderror
              </div>
              <div class="mb-2">
                  <input type="number" class="form-control" placeholder="Numero Celular" name="contact_number" id="contact_number" aria-label="contact_number" aria-describedby="contact_number" value="{{ old('contact_number') }}" required>
                  @error('contact_number')
                      <p class="text-danger text-xs mt-2">{{ $message }}</p>
                  @enderror
              </div>
              <div class="mb-3">
                  <input type="password" id="inputPassword" 
                        class="form-control {{ $errors->has('password') ? 'is-invalid' : ''}}" 
                        placeholder="Contraseña" name="password" required>
                  @error('password')
                      <p class="text-danger text-xs mt-2">{{ $message }}</p>
                  @enderror
              </div>    
              <div class="mb-2">
                  <input type="password" class="form-control" placeholder="Confirma tu contraseña" name="confirm-password" required>
              </div>
              <div class="row g-3">
                <div class="col-md-4">
                  <input type="radio" class="btn-check" name="type_profile" id="estudiante" value="Estudiante" checked>
                  <label class="card-option" for="estudiante">
                    <div class="icon">
                      <i class="fa-solid fa-school"></i>
                    </div>
                    <h6>Estudiante</h6>
                  </label>
                </div>

                <div class="col-md-4">
                  <input type="radio" class="btn-check" name="type_profile" id="docente" value="Docente">
                  <label class="card-option" for="docente">
                    <div class="icon">
                      <i class="fa-solid fa-person-chalkboard"></i>
                    </div>
                    <h6>Docente</h6>
                  </label>
                </div>

                <div class="col-md-4">
                  <input type="radio" class="btn-check" name="type_profile" id="egresado" value="Egresado">
                  <label class="card-option" for="egresado">
                    <div class="icon">
                      <i class="fa-solid fa-graduation-cap"></i>
                    </div>
                    <h6>Egresado</h6>
                  </label>
                </div>
              </div>
              <div class="checkbox mt-2">
                  <input class="form-check-input" type="checkbox" name="agreement" id="flexCheckDefault" checked>
                  <label class="form-check-label" for="flexCheckDefault">
                      Acepta nuestros <a href="" class="text-dark font-weight-bolder" target="a_blank">términos y condiciones</a>
                  </label>
                  @error('agreement')
                      <p class="text-danger text-xs mt-2">Acepta nuestros términos , condiciones y política de privacidad.</p>
                  @enderror
              </div>
              <div class="text-center">
                  <button type="submit" class="btn btn-primary text-white w-100 my-3 mb-2" onclick="spinner(event, this)">
                      <span class="spinner-border spinner-border-sm" id="spinner" role="status" hidden aria-hidden="true"></span>
                      Registrarse
                  </button>
              </div>
              <div class="text-center">
                  <p class="text-sm my-1 mb-4 mb-0">¿Ya te registraste? <a href="login" style="color: #7c2a8e">Inicia sesión</a></p>
              </div>
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