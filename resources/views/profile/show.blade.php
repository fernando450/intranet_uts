@extends('layouts.app')

@section('title', 'Docentes')

@section('content')
    @include('layouts.partials.alert')
    <div class="container-fluid px-4">
        <div class="row">      
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body bg-card" style="border-radius: 5px;">
                        <div class="image-container">
                            <div class="row">                               
                                <div class="col-md-6">                             
                                    @if (!empty(auth()->user()->avatar_route))
                                        <img src="{{Storage::url(auth()->user()->avatar_route)}}" alt="..." class="img-thumbnail border-gray">
                                    @else
                                        <img class="img-thumbnail border-gray" src="{{ asset('build/assets/img/user.png') }}" alt="...">
                                    @endif
                                </div>
                                <div class="col-md-6">                                 
                                    @foreach(auth()->user()->getRoleNames() as $rol)
                                        <h5 class="text-center"><span class="badge text-bg-primary text-white"> {{$rol}}</span></h5>
                                    @endforeach
                                    <p class="text-center m-1">{{auth()->user()->name}}</p>
                                    <p class="text-center" style="font-size: 10px;">{{auth()->user()->document_number}}</p>
                                    <hr>
                                    <div class="list-group">
                                        <button for="file-input" class="btn btn-sm btn-outline-secondary edit-button" title="Editar Avatar" data-bs-toggle="modal" data-bs-target="#editarAvatar" data-bs-toggle="tooltip">
                                            <i class="fa-solid fa-circle-user"></i>
                                        </button>

                                        <button for="file-input" class="btn btn-sm btn-outline-primary password-button" title="Actualizar contraseña" onclick="WindowsProfile('cambio_contraseña')" id="cambio_contraseña_btn">
                                            <i class="fa-solid fa-lock-open"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <!--Lista de acciones-->
                        <div class="list-group">
                            <button type="button" class="list-group-item list-group-item-action" onclick="WindowsProfile('ver_perfil')" id="ver_perfil_btn">
                                <i class="fa-solid fa-eye"></i> Perfil
                            </button> 
                            <button type="button" class="list-group-item list-group-item-action" onclick="WindowsProfile('editar_perfil')" id="editar_perfil_btn">
                                <i class="fa-solid fa-user-pen"></i> Actualizar Perfil
                            </button>                          
                            <button type="button" class="list-group-item list-group-item-action" onclick="WindowsProfile('perfil_profesional')" id="perfil_profesional_btn">
                                <i class="fa-solid fa-address-card"></i> Perfil Profesional
                            </button>
                            <button type="button" class="list-group-item list-group-item-action" onclick="WindowsProfile('informacion_academica')" id="informacion_academica_btn">
                                <i class="fa-solid fa-graduation-cap"></i> Información Academica
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8 text-center">
                @include('errors')
                <div class="card" id="editar_perfil" hidden>
                    <form class="col-md-12" action="{{ route('profile.update',Auth()->user()->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-header bg-card">
                            <h5 class="title">
                                <i class="fa-solid fa-user-pen"></i> Actualizar Perfil
                            </h5>
                        </div>
                        <div class="card-body">

                            <div class="row">
                                <label class="col-md-3 col-form-label">
                                    Nombre :
                                    <strong class="text-danger">*</strong>
                                </label>
                                <div class="col-md-9">
                                    <div class="form-group py-2">
                                        <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : ''}}" placeholder="Nombre completo" value="{{ auth()->user()->name }}" required>
                                    </div>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <label class="col-md-3 col-form-label">
                                    Celular : <strong class="text-danger">*</strong>
                                </label>
                                <div class="col-md-9">
                                    <div class="form-group py-2">
                                        <input type="text" name="contact_number" class="form-control {{ $errors->has('contact_number') ? 'is-invalid' : ''}}" placeholder="Numero de contacto" value="{{ auth()->user()->contact_number }}" required>
                                    </div>
                                    @if ($errors->has('contact_number'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('contact_number') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <label class="col-md-3 col-form-label">
                                    Correo : <strong class="text-danger">*</strong>
                                </label>
                                <div class="col-md-9">
                                    <div class="form-group py-2">
                                        <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : ''}}" placeholder="Correo" value="{{ auth()->user()->email }}" required>
                                    </div>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <hr>
                                <!-- second_phone -->
                                <label class="col-md-3 col-form-label">Numero de contacto :</label>
                                <div class="col-md-9">
                                    <div class="form-group py-2">
                                        <input type="number" name="second_phone" class="form-control {{ $errors->has('second_phone') ? 'is-invalid' : ''}}" placeholder="Segundo numero de contacto" value="{{ (isset(auth()->user()->teacher) ? auth()->user()->teacher->second_phone : '') }}" id="second_phone">
                                    </div>
                                </div>
                                 <!-- second_email -->
                                <label class="col-md-3 col-form-label">Correo electrónica :</label>
                                <div class="col-md-9">
                                    <div class="form-group py-2">
                                        <input type="email" id="second_email" name="second_email" class="form-control {{ $errors->has('second_email') ? 'is-invalid' : ''}}" placeholder="Segundo correo electrónica" value="{{ (isset(auth()->user()->teacher) ? auth()->user()->teacher->second_email : '') }}"  required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-outline-secondary" onclick="spinner(event,this)">
                                        <span class="spinner-border spinner-border-sm" id="spinner" role="status" hidden aria-hidden="true"></span>
                                        Guardar cambios
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card" id="cambio_contraseña" hidden>
                    <form action="{{ route('profile.password',Auth()->user()->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-header bg-card">
                            <h5 class="title">
                                <i class="fa-solid fa-lock"></i>
                                Cambiar Contraseña
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <label class="col-md-3 col-form-label">Contraseña anterior : <strong class="text-danger">* </strong></label>
                                <div class="col-md-9">
                                    <div class="form-group py-2">
                                        <input type="password" name="old_password" class="form-control {{ $errors->has('old_password') ? 'is-invalid' : ''}}" placeholder="Contraseña anterior" required>
                                    </div>
                                    @if ($errors->has('old_password'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('old_password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label">Nueva contraseña : <strong class="text-danger">* </strong></label>
                                <div class="col-md-9">
                                    <div class="form-group py-2">
                                        <input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : ''}}" placeholder="Nueva Contraseña" required>
                                    </div>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label">Confirma contraseña : <strong class="text-danger">* </strong></label>
                                <div class="col-md-9">
                                    <div class="form-group py-2">
                                        <input type="password" name="confirm-password" class="form-control {{ $errors->has('password') ? 'is-invalid' : ''}}" placeholder="Confirmar contraseña" required>
                                    </div>
                                    @if ($errors->has('confirm-password'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('confirm-password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-outline-primary" onclick="spinnerM(event,this,1)">
                                        <span class="spinner-border spinner-border-sm" id="spinner1" role="status" hidden aria-hidden="true"></span>
                                        Guardar cambios
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card" id="perfil_profesional" hidden>
                    <form>
                        @csrf
                        @method('PUT')
                        <div class="card-header bg-card">
                            <h5 class="title">
                                <i class="fa-solid fa-address-card"></i>
                                Perfil Profesional
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!-- Titulo profesional -->
                                <label class="col-md-3 col-form-label">Titulo profesional : <strong class="text-danger">* </strong></label>
                                <div class="col-md-9">
                                    <div class="form-group py-2">
                                        <input type="text" id="professional_title" name="professional_title" class="form-control {{ $errors->has('professional_title') ? 'is-invalid' : ''}}" placeholder="Titulo profesional" value="{{ (isset(auth()->user()->teacher) ? auth()->user()->teacher->professional_title : '') }}"  required>
                                    </div>
                                </div>
                                <!-- link linkedin -->
                                <label class="col-md-3 col-form-label">Linkedin : </label>
                                <div class="col-md-9">
                                    <div class="form-group py-2">
                                        <input type="url" name="linkedin" class="form-control {{ $errors->has('linkedin') ? 'is-invalid' : ''}}" placeholder="Enlace linkedin" value="{{ (isset(auth()->user()->teacher) ? auth()->user()->teacher->linkedin : '') }}" id="linkedin">
                                    </div>
                                </div>
                                <!-- Titulos adicionales -->
                                <hr>
                                <div class="card p-0">
                                    <div class="card-header" style="background-color: #5b1d6f21">
                                        <h5 class="title m-0" style="font-size: 15px;">
                                            <i class="fa-solid fa-graduation-cap"></i>
                                            Titulos adicionales
                                        </h5>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Titulo profesional</th>
                                                    <th scope="col">Institución</th>
                                                    <th scope="col">Año de graduación</th>
                                                    <th scope="col">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tr>
                                                <td>
                                                    <input type="text" class="form-control" placeholder="Titulo profesional" id="add_title">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" placeholder="Institución" id="add_institution">
                                                </td>
                                                <td>
                                                    <input type="date" class="form-control" id="add_graduation_year">
                                                </td>
                                                <td>
                                                    <button type="button" title="Agregar Titulo" class="btn btn-outline-success btn-sm" onclick="addTitle({{auth()->user()->id}})">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tbody id="table_titles">
                                            
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="button" id="BtnPeprofesional" onclick="Datosprofesionales({{auth()->user()->id}})" class="btn btn-outline-primary">
                                        <span class="spinner-border spinner-border-sm" id="spinner2" role="status" hidden aria-hidden="true"></span>
                                        Guardar cambios
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card" id="informacion_academica" hidden>
                    <form>
                        @csrf
                        <div class="card-header bg-card">
                            <h5 class="title">
                                <i class="fa-solid fa-graduation-cap"></i>
                                Información academica
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!-- linking_type -->
                                <label class="col-md-3 col-form-label">Tipo de enlace : <strong class="text-danger">* </strong></label>
                                <div class="col-md-9">
                                    <div class="form-group py-2">
                                        <select name="linking_type" id="linking_type" class="form-control {{ $errors->has('linking_type') ? 'is-invalid' : ''}}" required>
                                            <option value="">Seleccione</option>
                                            <option value="1" {{ (isset(auth()->user()->teacher) ? (auth()->user()->teacher->linking_type == 1 ? 'selected' : '') : '') }}>Exclusivo</option>
                                            <option value="2" {{ (isset(auth()->user()->teacher) ? (auth()->user()->teacher->linking_type == 2 ? 'selected' : '') : '') }}>Tiempo completo</option>
                                            <option value="3" {{ (isset(auth()->user()->teacher) ? (auth()->user()->teacher->linking_type == 3 ? 'selected' : '') : '') }}>Medio tiempo</option>
                                            <option value="4" {{ (isset(auth()->user()->teacher) ? (auth()->user()->teacher->linking_type == 4 ? 'selected' : '') : '') }}>Catedra</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- líneas de investigación -->
                            <hr>
                            <div class="card p-0">
                                <div class="card-header" style="background-color: #5b1d6f21">
                                    <h5 class="title m-0" style="font-size: 15px;">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                        Líneas de investigación
                                    </h5>
                                </div>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Nombre (Linea)</th>
                                                <th scope="col">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tr>
                                            <td>
                                                <input type="text" class="form-control" placeholder="Ingrese el nombre de la linea" id="add_line">
                                            </td>
                                            <td>
                                                <button type="button" title="Agregar Linea" class="btn btn-outline-success btn-sm" onclick="addLine({{auth()->user()->id}})">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tbody id="table_lines">
                                        
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <hr>
                            <div class="card p-0">
                                <div class="card-header" style="background-color: #5b1d6f21">
                                    <h5 class="title m-0" style="font-size: 15px;">
                                        <i class="fa-solid fa-book"></i>
                                        Asignaturas asignadas
                                    </h5>
                                </div>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Nombre (Materia)</th>
                                                <th scope="col">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tr>
                                            <td>
                                                <input type="text" class="form-control" placeholder="Ingrese el nombre de la materia" id="add_asignatura">
                                            </td>
                                            <td>
                                                <button type="button" title="Agregar materia" class="btn btn-outline-success btn-sm" onclick="addAsignatura({{auth()->user()->id}})">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tbody id="table_asignaturas">
                                        
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="button" id="Btn_informacion_academica" onclick="DatosAcademicos({{auth()->user()->id}})" class="btn btn-outline-primary">
                                        <span class="spinner-border spinner-border-sm" id="spinner3" role="status" hidden aria-hidden="true"></span>
                                        Guardar cambios
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        const cambio_contrasena = $('#cambio_contraseña');
        const editar_perfil = $('#editar_perfil');
        const informacion_academica = $('#informacion_academica');
        const perfil_profesional = $('#perfil_profesional');

        function WindowsProfile($window) {
            cambio_contrasena.attr('hidden', true);
            editar_perfil.attr('hidden', true);
            informacion_academica.attr('hidden', true);
            perfil_profesional.attr('hidden', true);

            $(`#${$window}`).removeAttr('hidden');
           
        }

        let titles = @json($titles ?? []);
        let lines = @json($lines ?? []);
        let asignaturas = @json($asignaturas ?? []);

        $(document).ready(function() {
            mostrarTitle(titles);
            mostrarLine(lines);
            mostrarAsignaturas(asignaturas);
        });

        //AddTitle
        function addTitle(teacher_id) {
            const title = document.getElementById('add_title').value;
            const institution = document.getElementById('add_institution').value;
            const graduation_year = document.getElementById('add_graduation_year').value;

            if (title === '' || institution === '' || graduation_year === '') {
                alertT('Todos los campos son obligatorios', 'warning');
                return;
            }

            //Validar que el titulo no exista
            if (titles.some(t => t.title === title)) {
                alertT('El título ya existe', 'warning');
                return;
            }

            //Validamos la fecha de graduacion
            const date = new Date(graduation_year);
            const today = new Date();
            if (date > today) {
                alertT('La fecha de graduación no puede ser mayor a la fecha actual', 'warning');
                return;
            }

            //Limpiar campos
            document.getElementById('add_title').value = '';
            document.getElementById('add_institution').value = '';
            document.getElementById('add_graduation_year').value = '';

            //Agregar al arreglo de titles
            titles.push({
                title: title,
                institution: institution,
                graduation_year: graduation_year
            });

            mostrarTitle(titles);
        }

        //AddLine
        function addLine(teacher_id) {
            const line = document.getElementById('add_line').value;

            if (line === '') {
                alertT('El nombre de la linea es obligatorio', 'warning');
                //is-invalid
                $('#add_line').addClass('is-invalid');
                $('#add_line').focus();
                return;
            }else{
                $('#add_line').removeClass('is-invalid');
            }

            //Limpiar campos
            document.getElementById('add_line').value = '';

            //Agregar al arreglo de lines
            lines.push({
                line: line
            });

            mostrarLine(lines);
        }

        //AddAsignatura
        function addAsignatura(teacher_id) {
            const asignatura = document.getElementById('add_asignatura').value;

            if (asignatura === '') {
                alertT('El nombre de la asignatura es obligatorio', 'warning');
                //is-invalid
                $('#add_asignatura').addClass('is-invalid');
                $('#add_asignatura').focus();
                return;
            }else{
                $('#add_asignatura').removeClass('is-invalid');
            }

            //Limpiar campos
            document.getElementById('add_asignatura').value = '';

            //Agregar al arreglo de lines
            asignaturas.push({
                asignatura: asignatura
            });

            mostrarAsignaturas(asignaturas);
        }

        function mostrarAsignaturas(asignaturas) {
            const tbody = document.getElementById('table_asignaturas');
            let html = '';

            if (asignaturas.length === 0) {
                html = `
                    <tr>
                        <td colspan="2">No hay asignaturas</td>
                    </tr>
                `;
            } else {
                asignaturas.forEach((asignatura, index) => {
                    html += `
                        <tr>
                            <td>${asignatura.asignatura}</td>
                            <td>
                                <button type="button" class="btn btn-outline-danger btn-sm" onclick="deleteAsignatura(this)">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    `;
                });
            }

            tbody.innerHTML = html;
        }

        function deleteAsignatura(button) {
            // Encuentra la fila (tr) más cercana
            const row = button.closest('tr');

            // Obtiene el índice de la fila dentro del tbody
            const index = Array.from(row.parentNode.children).indexOf(row);

            // Elimina el elemento del array
            asignaturas.splice(index, 1);

            // Vuelve a renderizar la tabla
            mostrarAsignaturas(asignaturas);
        }

        //DeleteTitle
        function deleteTitle(button) {
            // Encuentra la fila (tr) más cercana
            const row = button.closest('tr');

            // Obtiene el índice de la fila dentro del tbody
            const index = Array.from(row.parentNode.children).indexOf(row);

            // Elimina el elemento del array
            titles.splice(index, 1);

            // Vuelve a renderizar la tabla
            mostrarTitle(titles);
        }

        //DeleteLine
        function deleteLine(button) {
            // Encuentra la fila (tr) más cercana
            const row = button.closest('tr');

            // Obtiene el índice de la fila dentro del tbody
            const index = Array.from(row.parentNode.children).indexOf(row);

            // Elimina el elemento del array
            lines.splice(index, 1);

            // Vuelve a renderizar la tabla
            mostrarLine(lines);
        }

        function mostrarTitle(titles) {
            const tbody = document.getElementById('table_titles');
            let html = '';

            if (titles.length === 0) {
                html = `
                    <tr>
                        <td colspan="4" class="text-center text-muted">No hay títulos registrados</td>
                    </tr>
                `;
            } else {
                for (let i = 0; i < titles.length; i++) {
                    html += `
                        <tr>
                            <td>
                                <p class="text-xs font-weight-bold mb-0">${titles[i].title}</p>
                            </td>
                            <td>
                                <p class="text-xs font-weight-bold mb-0">${titles[i].institution}</p>
                            </td>
                            <td>
                                <p class="text-xs font-weight-bold mb-0">${titles[i].graduation_year}</p>
                            </td>
                            <td>
                                <button type="button" class="btn btn-outline-danger btn-sm" onclick="deleteTitle(this)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    `;
                }
            }

            tbody.innerHTML = html;
        }

        //mostrarLine
        function mostrarLine(lines) {
            const tbody = document.getElementById('table_lines');
            let html = '';

            if (lines.length === 0) {
                html = `
                    <tr>
                        <td colspan="4" class="text-center text-muted">No hay lineas registradas</td>
                    </tr>
                `;
            } else {
                for (let i = 0; i < lines.length; i++) {
                    html += `
                        <tr>
                            <td>
                                <p class="text-xs font-weight-bold mb-0">${lines[i].line}</p>
                            </td>
                            <td>
                                <button type="button" class="btn btn-outline-danger btn-sm" onclick="deleteLine(this)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    `;
                }
            }

            tbody.innerHTML = html;
        }

        function Datosprofesionales(user_id) {
            const spinner = document.getElementById('spinner2');
            const BtnPeprofesional = document.getElementById('BtnPeprofesional');
            BtnPeprofesional.setAttribute('disabled', true);
            spinner.removeAttribute('hidden');

            //CApturar los datos
            const professional_title = document.getElementById('professional_title').value;
            const linkedin = document.getElementById('linkedin').value;

            if(professional_title === ''){
                alertT('El titulo profesional es obligatorio', 'warning');
                $('#professional_title').addClass('is-invalid');
                $('#professional_title').focus();
                spinner.setAttribute('hidden', true);
                BtnPeprofesional.removeAttribute('disabled');
                return;
            }else{
                $('#professional_title').removeClass('is-invalid');
            }

            const data = {
                professional_title: professional_title,
                linkedin: linkedin,
                titles: titles,
                user_id: user_id
            };

            //Envio ajax
            $.ajax({
                url: '{{ route('teachers.store') }}',
                type: 'POST',
                data: data,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    spinner.setAttribute('hidden', true);
                    BtnPeprofesional.removeAttribute('disabled');
                    alertT(response.message, response.type);
                },
                error: function() {
                    spinner.setAttribute('hidden', true);
                    BtnPeprofesional.removeAttribute('disabled');
                    alertT('Ocurrió un error en el servidor.', 'danger');
                }
            });

        }

        //function DatosAcademicos
        function DatosAcademicos(user_id) {
            const spinner = document.getElementById('spinner3');
            const BtnPeAcademicos = document.getElementById('Btn_informacion_academica');
            BtnPeAcademicos.setAttribute('disabled', true);
            spinner.removeAttribute('hidden');

            //Capturar los datos
            const linking_type = document.getElementById('linking_type').value;

            //Validar
            if (linking_type === '') {
                alertT('El tipo de enlace es obligatorio', 'warning');
                $('#linking_type').addClass('is-invalid');
                $('#linking_type').focus();
                spinner.setAttribute('hidden', true);
                BtnPeAcademicos.removeAttribute('disabled');
                return;
            } else {
                $('#linking_type').removeClass('is-invalid');
            }

            const data = {
                linking_type: linking_type,
                asignaturas: asignaturas,
                lines: lines,
                user_id: user_id
            };

            //Envio ajax
            $.ajax({
                url: '{{ route('teachers.store') }}',
                type: 'POST',
                data: data,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    spinner.setAttribute('hidden', true);
                    BtnPeAcademicos.removeAttribute('disabled');
                    alertT(response.message, response.type);
                },
                error: function() {
                    spinner.setAttribute('hidden', true);
                    BtnPeAcademicos.removeAttribute('disabled');
                    alertT('Ocurrio un error en el servidor.', 'danger');
                }
            });
        }

        function validateEmail(email) {
            const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(String(email).toLowerCase());
        }

    </script>
@endpush
