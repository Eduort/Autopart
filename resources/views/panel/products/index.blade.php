@extends('layouts.panel')

@section('pageTitle', 'Catalogo de Productos Generales')

@section('content')

    @if(session()->has('status'))
        <div class="alert alert-success alert-dismissible fade show"  role="alert" >
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>{{session('status')}}</strong>
        </div>
    @endif

    <h3>Esperando Aprobación</h3>

    <div class="row">
        <div class="col-lg-12">
            @if(count($products))
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Tipo</th>
                        <th>Vendedor</th>
                        <th>Descripcion</th>
                        <th>Publicado</th>
                        <th>Aprobar</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>
                                @if($product->productable_type=='App\Car')
                                    Auto
                                @else
                                    Autoparte
                                @endif
                            </td>
                            <td class="align-middle">{{$product->seller}}</td>
                            <td class="align-middle">{{$product->description}}</td>
                            <td class="align-middle">{{$product->created_at}}</td>
                            <td class="align-middle" style="width: 110px"><a role="button" href="{{route('products.approve', $product->id)}}" style="width: 90px" class="btn btn-primary btn-sm">Aprobar</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <h4>No hay productos pendientes de aprobación.</h4>
            @endif
        </div>
    </div>
@stop