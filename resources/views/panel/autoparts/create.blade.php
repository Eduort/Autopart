@extends('layouts.panel')

@section('pageTitle', 'Registrar Parte')

@section('content')

    @if(count($errors))
        <div class="alert alert-danger alert-dismissible fade show"  role="alert" >
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            Ocurrieron los Siguientes Errores:
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </div>
    @endif

    @if(session()->has('status'))
        <div class="alert alert-success alert-dismissible fade show"  role="alert" >
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>{{session('status')}}</strong>
        </div>
    @endif

    <h3>Alta de Autoparte</h3>

    <!-- Formulario con campos requeridos -->
    <form method="POST" action="{{route('autoparts.store')}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="brand_id">Marca:</label>
                    <select id="brand_id" class="form-control" name="brand">
                        @foreach($brands as $brand)
                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="model">Modelo:</label>
                    <input type="text" class="form-control" id="model" name="modelo" placeholder="Modelo" value="{{old('modelo')}}">
                </div>
                <div class="form-group">
                    <label for="year">Año:</label>
                    <input type="text" class="form-control" id="year" name="año" placeholder="Año" value="{{old('año')}}">
                </div>
                <div class="form-group">
                    <label for="price">Precio:</label>
                    <input type="text" class="form-control" id="price" name="precio" placeholder="Precio" value="{{old('precio')}}">
                </div>

                <div class="form-group">
                    <label for="cantidad">Cantidad:</label>
                    <select class="form-control" name="quantity" id="cantidad">
                        @for ($i = 1; $i <= 99; $i++)
                            <option value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                </div>
                <div class="form-group">
                    <label for="estado">Estado:</label>
                    <select id="estado" name="state" class="form-control" value="{{old('state')}}">
                        <option value="0">Nuevo</option>
                        <option value="1">Usado</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="autopart_category" >Venta Partes:</label>
                    <select id="autopart_category" name="autopart_category" class="form-control">
                        <option value="0">Espejos</option>
                        <option value="1">Motor</option>
                        <option value="2">Parabrisas</option>
                        <option value="3">Electrónicos</option>
                        <option value="4">Interiores</option>
                        <option value="5">Sistemas de Transmisión</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="seller">Vendedor:</label>
                    <input type="text" class="form-control" id="seller" name="vendedor" placeholder="Vendedor" value="{{old('vendedor')}}">
                </div>
                <div class="form-group">
                    <label for="phone">Telefono:</label>
                    <input type="text" class="form-control" id="phone" name="telefono" placeholder="Telefono" value="{{old('telefono')}}">
                </div>
            </div>
            <div class="col-md-8">
                <label for="description">Descripción:</label>
                <textarea class="form-control rounded-0" id="description" name="descripcion" rows="11" placeholder="En esta seccion puede añadir cualquier dato adicional acerca de la autoparte.">{{old('description')}}</textarea>
            </div>
        </div>

        <div class="row" style="margin-top: 15px;margin-bottom: 20px">
            <button type="submit" class="btn btn-lg btn-block btn-primary">Registrar Autoparte</button>
        </div>
    </form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
@stop