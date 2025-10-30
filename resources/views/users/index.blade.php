@extends('layouts.app')

@section('title', 'Usuarios')

@section('content')
    @include('layouts.partials.alert')

    <div class="container-fluid px-4">
        <div class="mig_pan">
            <h3 class="text-dark">Usuarios</h3>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a class="a_active" href="#">Inicio</a></li>
                <li class="breadcrumb-item active">Usuarios</li>
            </ol>
        </div>
        @include('errors')

        <div class="card">
            <div class="card-header bg-card">
                <div class="row">
                    <div class="col-md-6 col-6">
                        <i class="fas fa-table me-1"></i>
                        Listado de Usuarios
                    </div>
                    <div class="col-md-6 col-6 text-end">
                        <button class="btn btn-primary btn-sm mb-0 text-white" type="button" data-bs-toggle="modal" data-bs-target="#createUser"><i class="fa-solid fa-plus"></i> Nuevo</button>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="p-2">
                        <form action="{{route('users.index')}}" role="search" method="GET">

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control m-1" name="data" placeholder="Buscar" autocomplete="off" value="{{(isset($_GET['data'])? $_GET['data']:'')}}">
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
                                    <div class="form-group">
                                        <select class="form-control m-1" name="rol">
                                            <option value="">Seleccione un Rol</option>
                                            @foreach($roles as $rol)

                                                @if(isset($_GET['rol']))
                                                    @if($_GET['rol'] == $rol)
                                                        <option class="text-uppercase" value="{{$rol}}" selected>{{$rol}}</option>
                                                    @else
                                                        <option class="text-uppercase" value="{{$rol}}">{{$rol}}</option>
                                                    @endif
                                                @else
                                                    <option class="text-uppercase" value="{{$rol}}">{{$rol}}</option>
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
                    <table id="usuarios" class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="ps-4">
                                    Cedula
                                </th>
                                <th>
                                    Nombre
                                </th>
                                <th>
                                    Email
                                </th>
                                <th class="text-center">
                                    Rol
                                </th>
                                <th class="ps-4">
                                    Contacto
                                </th>
                                <th>
                                    Estado
                                </th>
                                <th>
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $key => $user)
                                <tr>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ ++$i }}</p>
                                    </td>
                                    <td class="ps-4">
                                        <p class="text-xs font-weight-bold mb-0">{{$user->document_number}}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $user->name }}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $user->email }}</p>
                                    </td>
                                    <td class="text-center">
                                        @if(!empty($user->getRoleNames()))
                                            @foreach($user->getRoleNames() as $person)
                                                @if($person!='Administrador')
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        <label class="badge bg-secondary">{{ $person }}</label>
                                                    </p>
                                                @else
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        <label class="badge bg-primary">{{ $person }}</label>
                                                    </p>
                                                @endif
                                            @endforeach
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{$user->contact_number }}</p>
                                    </td>
                                    <td class="text-center">
                                        <label class="badge {!! ($user->state == 'Activo')? 'bg-success' : 'bg-secondary' !!}  badge-sm">{{ $user->state }}</label>
                                    </td>
                                    <td class="text-center">
                                            <button type="button" class="btn btn-link btn-sm" data-bs-toggle="modal" data-bs-target="#userEdit" data-id="{{$user->id}}" data-bs-toggle="tooltip" data-bs-original-title="Editar usuario">
                                                <i class="fas fa-user-edit text-info"></i>
                                            </button>
                                            <form style="display: inline-block;" action="{{route('users.destroy', $user->id)}}" method="post">
                                                <input type="hidden" name="_method" value="delete">
                                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                <button type="submit" class="btn btn-link btn-sm" onclick="return confirm('Estas seguro de eliminar este usuario?');" title="Eliminar usuario">
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
                        {!! $users->appends(Request::only(['data','rol','state']))->links() !!}
                    </div>
                </div>
            </div>
        </div>


    </div>
        @include('users.create')

        @include('users.edit')

@endsection

@push('js')
    <script type="text/javascript" src="build/assets/js/users/edit.js"></script>
@endpush
