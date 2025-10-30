@extends('layouts.app')

@section('title', 'Docentes')

@section('content')
    @include('layouts.partials.alert')

    <div class="container-fluid px-4">
        <div class="mig_pan">
            <h3 class="text-dark">Docentes</h3>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a class="a_active" href="#">Inicio</a></li>
                <li class="breadcrumb-item active">Docentes</li>
            </ol>
        </div>
        @include('errors')

        <div class="card">
            <div class="card-header bg-card">
                <div class="row">
                    <div class="col-md-6 col-6">
                        <i class="fas fa-table me-1"></i>
                        Listado de docentes
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="p-2">
                        <form action="{{route('teachers.index')}}" role="search" method="GET">

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" class="form-control m-1" name="data" placeholder="Nombre o Identificacion" autocomplete="off" value="{{(isset($_GET['data'])? $_GET['data']:'')}}">
                                    </div>
                                </div>

                                <div class="col-md-4">
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
                                <th>#</th>
                                <th class="ps-4">
                                    Identificacion
                                </th>
                                <th>
                                    Nombre
                                </th>
                                <th>
                                    Titulo
                                </th>
                                <th class="text-center">
                                    Correo
                                </th>
                                <th class="ps-4">
                                    Estado
                                </th>
                                <th class="text-center">
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($teachers as $key => $teacher)
                                <tr>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ ++$i }}</p>
                                    </td>
                                    <td class="ps-4">
                                        <p class="text-xs font-weight-bold mb-0">{{$teacher->document_number}}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{$teacher->name}}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{(isset($teacher->teacher))? $teacher->teacher->professional_title:'--'}}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{$teacher->email }}</p>
                                    </td>                                   
                                    <td class="text-center">
                                        <label class="badge {!! ($teacher->state == 'Activo' )? 'bg-success' : 'bg-secondary' !!}  badge-sm">{!!$teacher->state!!}</label>
                                    </td>
                                    <td class="text-center">
                                        <!--Show-->
                                        <button type="button" class="btn btn-link btn-sm" data-bs-toggle="modal" data-bs-target="#showTeacher" data-id="{{$teacher->id}}" data-bs-toggle="tooltip" title="Ver noticia">
                                            <i class="fas fa-eye text-secondary"></i>
                                        </button>
                                        <form style="display: inline-block;" action="{{route('teachers.destroy', $teacher->id)}}" method="post">
                                            <input type="hidden" name="_method" value="delete">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <button type="submit" class="btn btn-link btn-sm" onclick="return confirm('Estas seguro de eliminar este docente?');" title="Eliminar Docente">
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
                        {!! $teachers->appends(Request::only(['data','state']))->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
        @include('teachers.show')

@endsection

@push('js')
    <script type="text/javascript" src="build/assets/js/news/show.js"></script>
@endpush
