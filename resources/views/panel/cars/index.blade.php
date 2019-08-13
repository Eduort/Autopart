@extends('layouts.panel')

@section('pageTitle', 'Catalogo de Autos')

@section('content')
    <!-- Modal para Mostrar Detalle -->
    <div class="modal fade" id="dataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card" style="font-size: 18px !important">
                                <div class="card-header">
                                    Datos del Auto
                                </div>
                                <div class="card-body" style="font-size: 15px">
                                    <b>Modelo: </b><span id="dataModel"></span><br>
                                    <b>Marca: </b><span id="dataBrand"></span><br>
                                    <b>Año: </b><span id="dataYear"></span><br>
                                    <b>Precio: </b><span id="dataPrice"></span><br>
                                    <b>Funciona: </b><span id="dataWorks"></span><br>
                                </div>
                            </div>
                            <br>
                            <div class="card" style="font-size: 18px !important">
                                <div class="card-header">
                                    Datos del Vendedor
                                </div>
                                <div class="card-body" style="font-size: 15px">
                                    <b>Nombre: </b><span id="dataSeller"></span><br>
                                    <b>Telefono: </b><span id="dataPhone"></span><br>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card" style="font-size: 18px !important">
                                <div class="card-header">
                                    Datos de Partes
                                </div>
                                <div class="card-body" style="font-size: 15px">
                                    <b>Venta de Partes: </b><span id="dataSellparts"></span><br>
                                </div>
                            </div>
                            <br>
                            <div class="card" style="font-size: 18px !important">
                                <div class="card-header">
                                   Descripción
                                </div>
                                <div class="card-body" style="font-size: 15px;height: 142px">
                                   <span id="dataDescription"></span>
                                </div>
                            </div>
                        </div>
                        <br>

                    </div>
                    <br>
                    <div class="card" style="font-size: 18px !important">
                        <div class="card-header">
                            Imagen
                        </div>
                        <div class="card-body" style="font-size: 15px">
                            <img id="dataImage" class="img-fluid" style="height: 240px;width: 100%" src="" alt="Chania">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <div  style="text-align: center;width: 100%">
                        <button type="button" style="width: 100%" class="btn btn-secondary" data-dismiss="modal">Vover</button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @if(session()->has('status'))
        <div class="alert alert-success alert-dismissible fade show"  role="alert" >
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>{{session('status')}}</strong>
        </div>
    @endif

    <h3>Catalogo de Autos</h3>

    <div class="row">
        <div class="col-lg-12">
            @if(count($cars))
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Modelo</th>
                        <th>Marca</th>
                        <th>Año</th>
                        <th>Precio</th>
                        @if(Auth::user()->role==1)
                            <th style="width: 85px">Vendido</th>
                        @endif
                        <th style="width: 150px">Imagen</th>
                        <th style="width: 110px">Detalle</th>
                        <!-- Si el usuario es administrador se muestran opciones adicionales -->
                        @if(Auth::user()->role==1)
                            <th style="width: 110px">Editar</th>
                            <th style="width: 110px">Eliminar</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cars as $car)
                        <tr>
                            <td class="align-middle">{{$car->product_data->model}}</td>
                            <td class="align-middle">{{$car->product_data->brand->name}}</td>
                            <td class="align-middle">{{$car->product_data->year}}</td>
                            <td class="align-middle">${{number_format($car->product_data->price, 2)}}</td>
                            @if(Auth::user()->role==1)
                                <td class="align-middle" style="text-align: center">
                                    @if($car->product_data->sold==0)
                                        <span style="font-size: 14px" class="badge badge-danger">No</span>
                                    @else
                                        <span style="font-size: 14px" class="badge badge-success">Si</span>
                                    @endif
                                </td>
                            @endif
                            <td><img class="img-fluid" style="height: 75px" src="{{str_replace("index.php", "", url(''.$car->image))}}" alt="Imagen Auto"></td>
                            <td class="align-middle"><button type="button" class="btn btn-primary btn-sm"
                                                             onclick="showData('{{$car->product_data->model}}',
                                                                               '{{$car->product_data->brand->name}}',
                                                                               '{{$car->product_data->year}}',
                                                                               '{{number_format($car->product_data->price, 2)}}',
                                                                               '{{$car->works}}',
                                                                               '{{$car->product_data->seller}}',
                                                                               '{{$car->product_data->phone}}',
                                                                               '{{$car->sell_parts}}',
                                                                               '{{$car->id}}',
                                                                               '{{$car->product_data->description}}',
                                                                               '{{$car->image}}')">
                                    Ver Detalle</button></td>

                            @if(Auth::user()->role==1)
                                <td class="align-middle" style="width: 110px"><a role="button" href="{{route('cars.edit', $car->id)}}" style="width: 90px" class="btn btn-primary btn-sm">Editar</a></td>
                                <td class="align-middle" style="width: 110px"><a role="button" href="{{route('cars.delete', $car->id)}}" style="width: 90px" class="btn btn-primary btn-sm">Eliminar</a></td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <h4>No hay ningún auto registrado. Visite la <strong><a href="{{url('panel/cars/create')}}">Pagina de Creación</a></strong> para agregar autos.</h4>
            @endif
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        //Carga la ruta de las imagenes en una variable de JS.
        var baseImageUrl =  '<?php echo str_replace("index.php", "", url(''))?>';

        function showData(model,brand,year,price,works,seller,phone,sell_parts,car_id,description, image) {

            //Se cargan los datos en el modal.
            document.getElementById("dataModel").innerHTML=model;
            document.getElementById("dataBrand").innerHTML=brand;
            document.getElementById("dataYear").innerHTML=year;
            document.getElementById("dataPrice").innerHTML="$"+price;
            document.getElementById("dataWorks").innerHTML= works ===  '0' ? 'No' : 'Si';
            document.getElementById("dataSeller").innerHTML=seller;
            document.getElementById("dataPhone").innerHTML=phone;
            document.getElementById("dataSellparts").innerHTML= sell_parts ===  '0' ? 'No' : 'Si';
            document.getElementById("dataDescription").innerHTML=description;
            document.getElementById("dataImage").src = baseImageUrl + image;

            //Se verifica si las partes del auto estan disponibles para la venta.
            if(sell_parts === '0')
            {
                document.getElementById("dataBtnParts").disabled = true;
            }

            //Se muestra el modal.
            $('#dataModal').modal();
        }
    </script>
@stop