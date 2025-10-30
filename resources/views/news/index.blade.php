@extends('layouts.app')

@section('title', 'Noticias')

@push('css')
<style>
    .preview-img {
      width: 100px;
      height: 100px;
      object-fit: cover;
      border-radius: 8px;
      margin: 5px;
      position: relative;
    }
    .preview-wrapper {
      position: relative;
      display: inline-block;
    }
    .remove-btn {
      position: absolute;
      top: 2px;
      right: 2px;
      background: rgba(0,0,0,0.6);
      color: white;
      border: none;
      border-radius: 50%;
      font-size: 14px;
      width: 20px;
      height: 20px;
      cursor: pointer;
      line-height: 15px;
    }
</style>
@endpush
@section('content')
    @include('layouts.partials.alert')

    <div class="container-fluid px-4">
        <div class="mig_pan">
            <h3 class="text-dark">Noticias</h3>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a class="a_active" href="#">Inicio</a></li>
                <li class="breadcrumb-item active">Noticias</li>
            </ol>
        </div>
        @include('errors')

        <div class="card">
            <div class="card-header bg-card">
                <div class="row">
                    <div class="col-md-6 col-6">
                        <i class="fas fa-table me-1"></i>
                        Listado de noticias
                    </div>
                    <div class="col-md-6 col-6 text-end">
                        <button class="btn btn-primary btn-sm mb-0 text-white" type="button" data-bs-toggle="modal" data-bs-target="#createNews"><i class="fa-solid fa-plus"></i> Nuevo</button>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="p-2">
                        <form action="{{route('news.index')}}" role="search" method="GET">

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
                                        <select class="form-control m-1" name="profile">
                                            <option value="">Seleccione un perfil</option>
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
                                    Titulo
                                </th>
                                <th>
                                    Subtitulo
                                </th>
                                <th>
                                    Perfil
                                </th>
                                <th class="text-center">
                                    Estado
                                </th>
                                <th class="ps-4">
                                    Vencimiento
                                </th>
                                <th>
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($news as $key => $new)
                                <tr>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ ++$i }}</p>
                                    </td>
                                    <td class="ps-4">
                                        <p class="text-xs font-weight-bold mb-0">{{$new->title}}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $new->subtitle }}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $new->profile }}</p>
                                    </td>                                   
                                    <td class="text-center">
                                        <label class="badge {!! ($new->state == 1 )? 'bg-success' : 'bg-secondary' !!}  badge-sm">{!! ($new->state == 1 )? 'Activa' : 'Inactiva' !!}</label>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{$new->expiration_date }}</p>
                                    </td>
                                    <td class="text-center">
                                        <!--Show-->
                                        <button type="button" class="btn btn-link btn-sm" data-bs-toggle="modal" data-bs-target="#showNews" data-id="{{$new->id}}" data-bs-toggle="tooltip" title="Ver noticia">
                                            <i class="fas fa-eye text-secondary"></i>
                                        </button>
                                        <button type="button" class="btn btn-link btn-sm" data-bs-toggle="modal" data-bs-target="#newsEdit" data-id="{{$new->id}}" data-bs-toggle="tooltip" data-bs-original-title="Editar usuario">
                                            <i class="fas fa-user-edit text-info"></i>
                                        </button>
                                        <form style="display: inline-block;" action="{{route('news.destroy', $new->id)}}" method="post">
                                            <input type="hidden" name="_method" value="delete">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <button type="submit" class="btn btn-link btn-sm" onclick="return confirm('Estas seguro de eliminar esta noticia?');" title="Eliminar noticia">
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
                        {!! $news->appends(Request::only(['data','profile','state']))->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
        @include('news.create')
        @include('news.show')
        @include('news.edit')

@endsection

@push('js')
    <script type="text/javascript" src="build/assets/js/news/show.js"></script>
    <script type="text/javascript" src="build/assets/js/news/edit.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            document.querySelectorAll(".modal").forEach(modal => {
                const inputImagenes = modal.querySelector(".imagenes");
                const inputFinal = modal.querySelector(".imagenesFinales");
                const preview = modal.querySelector(".preview");

                //Si el modal no tiene estos elementos, lo saltamos
                if (!inputImagenes || !inputFinal || !preview) return;

                let selectedFiles = [];

                inputImagenes.addEventListener("change", () => {
                    const newFiles = Array.from(inputImagenes.files);

                    if (selectedFiles.length + newFiles.length > 4) {
                        alertT("Solo puedes subir hasta 4 imágenes.", 'info');
                        inputImagenes.value = "";
                        return;
                    }

                    selectedFiles = [...selectedFiles, ...newFiles];
                    mostrarPreview();
                    actualizarInputFinal();
                    inputImagenes.value = ""; // limpiar input
                });

                function mostrarPreview() {
                    preview.innerHTML = "";
                    selectedFiles.forEach((file, index) => {
                        const reader = new FileReader();
                        reader.onload = e => {
                            const wrapper = document.createElement("div");
                            wrapper.classList.add("preview-wrapper");

                            const img = document.createElement("img");
                            img.src = e.target.result;
                            img.classList.add("preview-img");

                            const btn = document.createElement("button");
                            btn.innerHTML = "×";
                            btn.classList.add("remove-btn");
                            btn.onclick = () => {
                                selectedFiles.splice(index, 1);
                                mostrarPreview();
                                actualizarInputFinal();
                            };

                            wrapper.appendChild(img);
                            wrapper.appendChild(btn);
                            preview.appendChild(wrapper);
                        };
                        reader.readAsDataURL(file);
                    });
                }

                function actualizarInputFinal() {
                    const dataTransfer = new DataTransfer();
                    selectedFiles.forEach(file => dataTransfer.items.add(file));
                    inputFinal.files = dataTransfer.files;
                }
            });
        });
    </script>

@endpush
