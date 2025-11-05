@extends('layouts.app')

@section('title', 'Docente'.$teacher->user->name)

@section('content')
    <div class="container-fluid px-4">
        <div class="row">      
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body bg-card" style="border-radius: 5px;">
                        <div class="image-container">
                            <div class="row">                               
                                <div class="col-md-6">                             
                                    @if (!$teacher->avatar_route)
                                        <img src="{{Storage::url($teacher->user->avatar_route)}}" alt="..." class="img-thumbnail border-gray">
                                    @else
                                        <img class="img-thumbnail border-gray" src="{{ asset('build/assets/img/user.png') }}" alt="...">
                                    @endif
                                </div>
                                <div class="col-md-6">                                 
                                    @foreach($teacher->user->getRoleNames() as $rol)
                                        <h5 class="text-center"><span class="badge text-bg-primary text-white"> {{$rol}}</span></h5>
                                    @endforeach
                                    <p class="text-center m-1">{{$teacher->user->name}}</p>
                                    <p class="text-center" style="font-size: 10px;">{{$teacher->user->document_number}}</p>
                                    <hr>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <!--Lista de acciones-->
                        <div class="list-group">
                            <button type="button" class="list-group-item list-group-item-action" onclick="WindowsProfile('editar_perfil')" id="editar_perfil_btn">
                                <i class="fa-solid fa-user"></i>Perfil
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
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body bg-card" style="border-radius: 5px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
