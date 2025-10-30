@extends('layouts.app')

@section('title', 'Roles')

@section('content')
    @include('errors')

    @include('layouts.partials.alert')

    <div class="container-fluid px-4">
        <div class="mig_pan">
            <h3 class="text-dark">Roles</h3>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a class="a_active" href="#">Inicio</a></li>
                <li class="breadcrumb-item active">Roles</li>
            </ol>
        </div>

        <div class="card">
            <div class="card-header bg-card">
                <div class="row">
                    <div class="col-md-6 col-6">
                        <i class="fas fa-table me-1"></i>
                        Listado de Roles
                    </div>
                    <div class="col-md-6 col-6 text-end">
                        <button class="btn btn-primary btn-sm mb-0 text-white" type="button" data-bs-toggle="modal" data-bs-target="#createRole"><i class="fa-solid fa-plus"></i> Nuevo</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th>
                                    #
                                </th>
                                <th>
                                    Nombre
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
                            @foreach ($roles as $rol)
                                <tr>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ ++$i }}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $rol->name }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $rol->guard_name }}</p>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-link btn-sm" data-bs-toggle="modal" data-bs-target="#EditRole" data-id="{{$rol->id}}"  data-bs-toggle="tooltip" data-bs-original-title="Edit Role">
                                            <i class="fas fa-edit text-info"></i>
                                        </button>
                                        <form style="display: inline-block;" action="{{route('roles.destroy', $rol->id)}}" method="post">
                                            <input type="hidden" name="_method" value="delete">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <button type="submit" class="btn btn-link btn-sm" onclick="return confirm('Estas seguro de eliminar este rol?');" title="Eliminar rol">
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
                        {!! $roles->appends(Request::only(['name']))->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('roles.create')
    @include('roles.edit')
@endsection

@push('js')

    <script type="text/javascript" src="build/assets/js/roles/edit.js"></script>
    <script>
        const defaultSelect = () => {
            const element = document.querySelector('.js-choice');
            const choices = new Choices(element, {
                searchEnabled: false,
                removeItemButton: true,
            });
        }

        defaultSelect();

    </script>
@endpush
