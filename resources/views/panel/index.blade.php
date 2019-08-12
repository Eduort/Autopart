@extends('layouts.panel')

@section('pageTitle', 'Indice')

@section('content')
    <div class="jumbotron">
        <h1 class="display-4">Hola, {{Auth::user()->name}}</h1>
        <p class="lead">Selecciona una opcion para acceder a un catalogo.</p>
        <hr class="my-4">


        <div class="row">
            <div class="col-sm-6">
                <div class="card" style="width:100%">
                    <div class="card-body">
                        <h5 class="card-title">Autos</h5>
                        <p class="card-text">Listado de autos disponibles.</p>
                        <a href="{{url("panel/cars")}}" class="btn btn-primary">Acceder</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card" style="width: 100%">
                    <div class="card-body">
                        <h5 class="card-title">Autopartes</h5>
                        <p class="card-text">Listado de autopartes disponibles.</p>
                        <a href="{{url("panel/autoparts")}}" class="btn btn-primary">Acceder</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop