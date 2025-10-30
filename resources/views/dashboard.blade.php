@extends('layouts.app')

@section('title', 'Panel')

@section('content')
 <div class="p-4">
    <h1>Bienvenido</h1>
    <p>Aquí va el contenido de la aplicación.</p>
    <div class="row ">
        <div class="col-md-3 p-2">
            <div class="card bg-primary">
                <div class="card-header">Panel</div>
                <div class="card-body">
                    <h1>Panel de control</h1>
                </div>
            </div>
        </div>

        <div class="col-md-3 p-2">
            <div class="card bg-success">
                <div class="card-header">Panel</div>
                <div class="card-body">
                    <h1>Panel de control</h1>
                </div>
            </div>
        </div>

        <div class="col-md-3 p-2">
            <div class="card bg-primary">
                <div class="card-header">Panel</div>
                <div class="card-body">
                    <h1>Panel de control</h1>
                </div>
            </div>
        </div>

        <div class="col-md-3 p-2">
            <div class="card bg-success">
                <div class="card-header">Panel</div>
                <div class="card-body">
                    <h1>Panel de control</h1>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection