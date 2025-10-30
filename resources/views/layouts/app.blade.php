<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <link rel="icon" type="image/png" href="{{ asset('build/assets/img/icono_intranet.png') }}"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Intranet UTS - @yield('title')</title>
        <meta name="description" content="Sistema para la gestión interna de la UTS." />

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

        <!--Choice-->
        <link  rel="stylesheet"  href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css"/>  
        <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/parsleyjs@2.9.2/dist/parsley.min.js"></script>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <!-- Scripts -->
        
        <link  rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css"/>
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="{{asset('build/assets/css/mystyles.css')}}">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
        </script>
        @stack('css')
    </head>
    <body class="sb-nav-fixed">
        <div id="wrapper">
            <!-- Sidebar -->
            <x-navigation-menu />

            <!-- Contenido -->
            <div id="content" class="flex-grow-1 ">
                <x-navigation-header />
                @yield('content')
            </div>
        </div>

        <script src="{{ asset('build/assets/js/spinner.js') }}"></script>
        <script src="{{ asset('build/assets/js/alert.js') }}"></script>

        @stack('js')
        <script>
            const mainFab = document.getElementById('mainFab');
            const menuItems = document.getElementById('menuItems');
            const overlay = document.getElementById('overlay');
            const seguridadBtn = document.getElementById('seguridadBtn');
            const submenuSeguridad = document.getElementById('submenuSeguridad');

            // Abrir/cerrar menú principal
            mainFab.addEventListener('click', () => {
                const icono = document.getElementById('iconoMenu');

                // Toggle del menú
                menuItems.classList.toggle('show');
                overlay.classList.toggle('show');
                mainFab.classList.toggle('active');

                // Cambiar ícono con animación suave
                if (menuItems.classList.contains('show')) {
                    icono.classList.remove('fa-list'); // quita el icono anterior
                    icono.classList.add('fa-plus');   // añade el nuevo icono
                } else {
                    icono.classList.remove('fa-plus'); // quita el icono anterior
                    icono.classList.add('fa-list');     // añade el nuevo icono
                }
            });

            // Cerrar al hacer clic fuera
            overlay.addEventListener('click', () => {
                menuItems.classList.remove('show');
                overlay.classList.remove('show');
                mainFab.classList.remove('active');
                submenuSeguridad.classList.remove('show');

                const icono = document.getElementById('iconoMenu');
                // Restaurar ícono al cerrar
                icono.classList.remove('fa-plus'); // quita el icono anterior
                icono.classList.add('fa-list');
            });

            // Submenú seguridad
            seguridadBtn.addEventListener('click', () => {
                submenuSeguridad.classList.toggle('show');
            });
        </script>

    </body>
</html>
