@extends('layouts.panel')

@section('pageTitle', 'Editar Autoparte')

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

    <h3>Editar Autoparte</h3>

    <!-- Formulario con campos requeridos -->
    <form method="POST" action="{{route('autoparts.update',$autopart->id)}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <input type="hidden" name="_method" value="PUT" />
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="brand_id">Marca:</label>
                    <select id="brand_id" class="form-control" name="brand">
                        @foreach($brands as $brand)
                            <option {{$brand->id==$autopart->product_data->brand->id ? "Selected" : ""}} value="{{$brand->id}}">{{$brand->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="model">Modelo:</label>
                    <input type="text" class="form-control" id="model" name="modelo" placeholder="Modelo" value="{{$autopart->product_data->model}}">
                </div>
                <div class="form-group">
                    <label for="year">Año:</label>
                    <input type="text" class="form-control" id="year" name="año" placeholder="Año" value="{{$autopart->product_data->year}}">
                </div>
                <div class="form-group">
                    <label for="price">Precio:</label>
                    <input type="text" class="form-control" id="price" name="precio" placeholder="Precio" value="{{$autopart->product_data->price}}">
                </div>

                <div class="form-group">
                    <label for="cantidad">Cantidad:</label>
                    <select class="form-control" name="quantity" id="cantidad">
                        @for ($i = 1; $i <= 99; $i++)
                            <option {{$i==$autopart->quantity ? "Selected" : ""}} value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                </div>
                <div class="form-group">
                    <label for="estado">Estado:</label>
                    <select id="estado" name="state" class="form-control" value="{{old('state')}}">
                        <option value="0" {{$autopart->state == 0 ? "Selected" : ""}}>Nuevo</option>
                        <option value="1" {{$autopart->state == 1 ? "Selected" : ""}}>Usado</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="autopart_category" >Venta Partes:</label>
                    <select id="autopart_category" name="autopart_category" class="form-control">
                        <option value="0" {{$autopart->autopart_category == 0 ? "Selected" : ""}}>Espejos</option>
                        <option value="1" {{$autopart->autopart_category == 1 ? "Selected" : ""}}>Motor</option>
                        <option value="2" {{$autopart->autopart_category == 2 ? "Selected" : ""}}>Parabrisas</option>
                        <option value="3" {{$autopart->autopart_category == 3 ? "Selected" : ""}}>Electrónicos</option>
                        <option value="4" {{$autopart->autopart_category == 4 ? "Selected" : ""}}>Interiores</option>
                        <option value="5" {{$autopart->autopart_category == 5 ? "Selected" : ""}}>Sistemas de Transmisión</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="seller">Vendedor:</label>
                    <input type="text" class="form-control" id="seller" name="vendedor" placeholder="Vendedor" value="{{$autopart->product_data->seller}}">
                </div>
                <div class="form-group">
                    <label for="phone">Telefono:</label>
                    <input type="text" class="form-control" id="phone" name="telefono" placeholder="Telefono" value="{{$autopart->product_data->phone}}">
                </div>
            </div>
            <div class="col-md-8">
                <label for="description">Descripción:</label>
                <textarea class="form-control rounded-0" id="description" name="descripcion" rows="11" placeholder="En esta seccion puede añadir cualquier dato adicional acerca de la autoparte.">{{$autopart->product_data->description}}</textarea>
            </div>
        </div>

        <div class="row" style="margin-top: 15px;margin-bottom: 20px">
            <a href="{{url('/panel/autoparts/sold/'.$autopart->id)}}" role="button" class="btn btn-lg btn-block btn-success">Marcar Como Vendida</a>
        </div>

        <div class="row" style="margin-top: 15px;margin-bottom: 20px">
            <button type="submit" class="btn btn-lg btn-block btn-primary">Guardar Cambios</button>
        </div>
    </form>
@stop