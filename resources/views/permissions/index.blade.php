@extends('layouts.app')

@section('title', 'Permisos')

@section('content')

    @include('layouts.partials.alert')

    <div class="container-fluid px-4">
        <div class="mig_pan">
            <h3 class="text-dark">Permisos</h3>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a class="a_active" href="#">Inicio</a></li>
                <li class="breadcrumb-item active">Permisos</li>
            </ol>
        </div>
        @include('errors')

        <div class="card">
            <div class="card-header bg-card">
                <div class="row">
                    <div class="col-md-6 col-6">
                        <i class="fas fa-table me-1"></i>
                        Listado de Permisos
                    </div>
                        <div class="col-md-6 col-6 text-end">
                            <button class="btn btn-primary btn-sm mb-0 text-white" type="button" data-bs-toggle="modal" data-bs-target="#createPermission"><i class="fa-solid fa-plus"></i> Nuevo</button>
                        </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="p-2">
                        <form action="{{route('permissions.index')}}" role="search" method="GET">

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control m-1" name="name" placeholder="Buscar" autocomplete="off" value="{{(isset($_GET['name'])? $_GET['name']:'')}}">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-outline-primary m-1 full"> <i class="fa fa-search"></i>  Buscar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th>
                                    #
                                </th>
                                <th>
                                    Permiso
                                </th>
                                <th class="text-center">
                                    Tipo
                                </th>
                                <th class="text-center">
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permissions as $permission)
                            <tr>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">{{ ++$i }}</p>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">{{ $permission->name }}</p>
                                </td>
                                <td class="text-center">
                                    <p class="text-xs font-weight-bold mb-0">{{ $permission->guard_name }}</p>
                                </td>
                                <td class="text-center">
                                        <button type="button" class="btn btn-link btn-sm" data-bs-toggle="modal" data-bs-target="#permissionEdit" data-id="{{$permission->id}}" data-bs-toggle="tooltip" data-bs-original-title="Editar permiso">
                                            <i class="fas fa-user-edit text-info"></i>
                                        </button>

                                        <form style="display: inline-block;" action="{{route('permissions.destroy', $permission->id)}}" method="post">
                                            <input type="hidden" name="_method" value="delete">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <button type="submit" class="btn btn-link btn-sm" onclick="return confirm('Estas seguro de eliminar este permiso?');" title="Eliminar permiso">
                                                <i class="cursor-pointer fas fa-trash text-danger"></i>
                                            </button>
                                        </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="pt-2">
                        {!! $permissions->appends(Request::only(['name']))->links('pagination::bootstrap-5') !!}
                    </div>

                </div>
            </div>
        </div>

    </div>
        @include('permissions.create')
        @include('permissions.edit')

@endsection

@push('js')
    <script>
        $('#permissionEdit').on('show.bs.modal', function (event) {
            var a = $(event.relatedTarget) // Button that triggered the modal
            var id = a.data('id');
            var url = '/permissions/'+id;
            var modal = $(this);

            $.get(url +'/edit'  ,null, function(data){
                modal.find('form').attr('action', url);
                modal.find('input[name=name]').val(data.permission['name']);

            });
        });
    </script>
@endpush
