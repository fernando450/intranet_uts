@extends('layouts.app')

@section('title', 'Documentos uts')

@section('content')
    @include('layouts.partials.alert')

    <div class="container-fluid px-4">
        <div class="mig_pan">
            <h3 class="text-dark">Repositorio documental</h3>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a class="a_active" href="#">Inicio</a></li>
                <li class="breadcrumb-item active">Documentos</li>
            </ol>
        </div>
        @include('errors')

        <div class="card">
            <div class="card-header bg-card">
                <div class="row">
                    <div class="col-md-6 col-6">
                        <i class="fas fa-table me-1"></i>
                        Listado de documentos
                    </div>
                    <div class="col-md-6 col-6 text-end">
                        <button class="btn btn-primary btn-sm mb-0 text-white" type="button" data-bs-toggle="modal" data-bs-target="#createDocument"><i class="fa-solid fa-plus"></i> Nuevo</button>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="p-2">
                        <form action="{{route('documents.index')}}" role="search" method="GET">

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control m-1" name="title" placeholder="Titulo del Documento" autocomplete="off" value="{{(isset($_GET['title'])? $_GET['title']:'')}}">
                                    </div>
                                </div>

                                <!--profile-->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <select class="form-control m-1" name="profile">
                                            <option value="">Seleccione un Perfil</option>
                                            @foreach($profiles as $profile)
                                                @if(isset($_GET['profile']))
                                                    @if($_GET['profile'] == $profile)
                                                        <option value="{{$profile}}" selected>{{$profile}}</option>
                                                    @else
                                                        <option value="{{$profile}}">{{$profile}}</option>
                                                    @endif
                                                @else
                                                    <option value="{{$profile}}">{{$profile}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <select class="form-control m-1" name="state">
                                            <option value="">Seleccione un Estado</option>
                                            @foreach($states as $state)
                                                @if(isset($_GET['state']))
                                                    @if($_GET['state'] == $state)
                                                        <option value="{{$state}}" selected>{{$state}}</option>
                                                    @else
                                                        <option value="{{$state}}">{{$state}}</option>
                                                    @endif
                                                @else
                                                    <option value="{{$state}}">{{$state}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-outline-primary m-1 full"> <i class="fa fa-search"></i>  Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="table-responsive p-0">
                    <table id="news" class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Título</th>
                                <th>Versión</th>
                                <th>Perfil</th>
                                <th>Fecha Emisión</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($documents as $doc)
                                <tr>
                                    <td>{{ $doc->code }}</td>
                                    <td>{{ $doc->title }}</td>
                                    <td>{{ $doc->version }}</td>
                                    <td>
                                        @if($doc->profile != null)
                                            <label class="badge bg-secondary">{{ $doc->profile }}</label>
                                        @else
                                            <label class="badge bg-success">Todos</label>
                                        @endif
                                    </td>
                                    <td>{{ $doc->issue_date }}</td>
                                    <td>{{ $doc->state }}</td>
                                    <td class="text-center">
                                        <!--show-->
                                        <button type="button" class="btn btn-link btn-sm showDocument" data-url="{{Storage::url($doc->file_route)}}" title="Ver documento">
                                            <i class="fas fa-eye text-secondary"></i>
                                        </button>
                                        <button type="button" class="btn btn-link btn-sm" data-bs-toggle="modal" data-bs-target="#documentEdit" data-id="{{$doc->id}}" data-bs-toggle="tooltip" data-bs-original-title="Editar usuario">
                                            <i class="fas fa-user-edit text-info"></i>
                                        </button>
                                        <form style="display: inline-block;" action="{{route('documents.destroy', $doc->id)}}" method="post">
                                            <input type="hidden" name="_method" value="delete">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <button type="submit" class="btn btn-link btn-sm" onclick="return confirm('Estas seguro de eliminar este documento?');" title="Eliminar documento">
                                                <i class="cursor-pointer fas fa-trash text-danger"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="pt-2">
                        <!-- paginacion aquí -->
                        {!! $documents->appends(Request::only(['title','profile','state']))->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@include('documents.create')
@include('documents.edit')
@include('documents.partials.show')

@push('js')
    <script type="text/javascript" src="build/assets/js/documents/edit.js"></script>

    <script>
        $(document).on('click', '.showDocument', function () {
            let url = $(this).data('url');
            let extension = url.split('.').pop().toLowerCase();

            // Tipos que sí se pueden mostrar
            let visualizables = ['pdf', 'png', 'jpg', 'jpeg'];

            // Si es visualizable → IFRAME
            if (visualizables.includes(extension)) {

                $('#showDoc').html(`
                    <iframe src="${url}" width="100%" height="500px" style="border:none;"></iframe>
                `);

            } else {
                // Si NO se puede visualizar (DOC/DOCX) → Mostrar imagen de descarga
                $('#showDoc').html(`
                    <div class="text-center p-4">
                        <img src="build/assets/img/Download.png" width="120" class="mb-3" alt="Descargar documento">
                        <p>Este tipo de archivo no se puede visualizar.</p>
                        <a href="${url}" class="btn btn-primary" download>
                            Descargar archivo
                        </a>
                    </div>
                `);
            }

            // Mostrar modal
            let modal = new bootstrap.Modal(document.getElementById('showDocument'));
            modal.show();
        });

        // Limpiar contenido al cerrar modal
        $('#showDocument').on('hidden.bs.modal', function () {
            $('#showDoc').empty();
        });


    </script>
@endpush
