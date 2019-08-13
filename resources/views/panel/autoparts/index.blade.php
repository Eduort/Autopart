@extends('layouts.panel')

@section('pageTitle', 'Catalogo de Partes')

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
                                    Detalles de la Autoparte
                                </div>
                                <div class="card-body" style="font-size: 15px">
                                    <b>Modelo: </b><span id="dataModel"></span><br>
                                    <b>Marca: </b><span id="dataBrand"></span><br>
                                    <b>Año: </b><span id="dataYear"></span><br>
                                    <b>Precio: </b><span id="dataPrice"></span><br>
                                    <b>Cantidad: </b><span id="dataQuantity"></span><br>
                                    <b>Estado: </b><span id="dataState"></span><br>
                                    <b>Tipo: </b><span id="dataType"></span><br>
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

    <h3>Catalogo de Autopartes</h3>

    <div class="row">
        <div class="col-lg-12">
            @if(count($autoParts))
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Para</th>
                        <th>Precio</th>
                        <th>Tipo</th>
                        @if(Auth::user()->role==1)
                            <th style="width: 85px">Vendido</th>
                        @endif
                        <th style="width: 110px">Detalle</th>
                        <!-- Si el usuario es administrador se muestran opciones adicionales -->
                        @if(Auth::user()->role==1)
                            <th style="width: 110px">Editar</th>
                            <th style="width: 110px">Eliminar</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($autoParts as $autoPart)
                        <tr>
                            <td class="align-middle">{{$autoPart->product_data->brand->name. " ".$autoPart->product_data->model." ".$autoPart->product_data->year}}</td>
                            <td class="align-middle">${{number_format($autoPart->product_data->price, 2)}}</td>
                            @if($autoPart->autopart_category==0)
                                <td class="align-middle">Espejos</td>
                            @elseif($autoPart->autopart_category==1)
                                <td class="align-middle" >Motor</td>
                            @elseif($autoPart->autopart_category==2)
                                <td class="align-middle" >Parabrisas</td>
                            @elseif($autoPart->autopart_category==3)
                                <td class="align-middle" >Electrónicos</td>
                            @elseif($autoPart->autopart_category==4)
                                <td class="align-middle" >Interiores</td>
                            @elseif($autoPart->autopart_category==5)
                                <td class="align-middle" >Sistemas de Transmisión</td>
                            @endif

                            @if(Auth::user()->role==1)
                                <td class="align-middle" style="text-align: center">
                                    @if($autoPart->product_data->sold==0)
                                        <span style="font-size: 14px" class="badge badge-danger">No</span>
                                    @else
                                        <span style="font-size: 14px" class="badge badge-success">Si</span>
                                    @endif
                                </td>
                            @endif

                            <td class="align-middle"><button type="button" class="btn btn-primary btn-sm"
                                                             onclick="showData('{{$autoPart->product_data->model}}',
                                                                               '{{$autoPart->product_data->brand->name}}',
                                                                               '{{$autoPart->product_data->year}}',
                                                                               '{{number_format($autoPart->product_data->price, 2)}}',
                                                                               '{{$autoPart->quantity}}',
                                                                               '{{$autoPart->state}}',
                                                                                '{{$autoPart->product_data->seller}}',
                                                                                '{{$autoPart->product_data->phone}}',
                                                                               '{{$autoPart->product_data->description}}',
                                                                               '{{$autoPart->autopart_category}}'

                                                                     )">

                                    Ver Detalle</button></td>

                            @if(Auth::user()->role==1)
                                <td class="align-middle" style="width: 110px"><a role="button" href="{{route('autoparts.edit', $autoPart->id)}}" style="width: 90px" class="btn btn-primary btn-sm">Editar</a></td>
                                <td class="align-middle" style="width: 110px"><a role="button" href="{{route('autoparts.delete', $autoPart->id)}}" style="width: 90px" class="btn btn-primary btn-sm">Eliminar</a></td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <h4>No hay ningúna autoparte registrada. Visite la <strong><a href="{{url('panel/autoparts/create')}}">Pagina de Creación</a></strong> para agregar autopartes.</h4>
            @endif
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>

        function showData(model,brand,year,price,quantity,state,seller,phone,description, type) {

            var txtState;
            if(state==='0')
            {
                txtState = "Nuevo";
            }
            else
            {
                txtState = "Usado";
            }

            var txtType;
            if(type==='0')
            {
                txtType = "Espejos";
            }
            else if (type==='1')
            {
                txtType = "Motor";
            }
            else if (type==='2')
            {
                txtType = "Parabrisas";
            }
            else if (type==='3')
            {
                txtType = "Electrónicos";
            }
            else if (type==='4')
            {
                txtType = "Interiores";
            }
            else if (type==='5')
            {
                txtType = "Sistemas de Transmisión";
            }

            //Se cargan los datos en el modal.
            document.getElementById("dataModel").innerHTML=model;
            document.getElementById("dataBrand").innerHTML=brand;
            document.getElementById("dataYear").innerHTML=year;
            document.getElementById("dataPrice").innerHTML="$"+price;
            document.getElementById("dataQuantity").innerHTML=quantity;
            document.getElementById("dataSeller").innerHTML=seller;
            document.getElementById("dataPhone").innerHTML=phone;
            document.getElementById("dataState").innerHTML=txtState;
            document.getElementById("dataDescription").innerHTML=description;
            document.getElementById("dataType").innerHTML=txtType;


            //Se muestra el modal.
            $('#dataModal').modal();
        }
    </script>
@stop