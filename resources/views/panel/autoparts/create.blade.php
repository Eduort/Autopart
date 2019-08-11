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

    <h3>Alta de Parte</h3>

    <!-- Formulario con campos requeridos -->
    <form method="POST" action="{{route('cars.store')}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="brand_id">Categoria:</label>
                    <input type="text" class="form-control" id="category" name="categoria" placeholder="Categoria" value="{{old('modelo')}}">
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
                    <label for="works">Funciona:</label>
                    <select id="works" name="works" class="form-control" value="{{old('works')}}">
                        <option value="0">No</option>
                        <option value="1">Si</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="sell_parts" >Venta Partes:</label>
                    <select id="sell_parts" name="sell_parts" class="form-control">
                        <option value="0">No</option>
                        <option value="1">Si</option>
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
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="parts" name="parts">
                    <label class="form-check-label" for="parts">Registrar partes al finalizar</label>
                </div>
            </div>
            <div class="col-md-8">
                <label for="description">Descripción:</label>
                <textarea class="form-control rounded-0" id="description" name="descripcion" rows="11" placeholder="En esta sección puede añadir datos adicionales como el tipo de transmisión, kilometraje, número de dueños que ha tenido, etc.">{{old('description')}}</textarea>

                <div style="margin-top: 20px">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="customFile" name="imagen" accept=".jpg,.png" >
                        <label class="custom-file-label" for="customFile">Seleccionar Imagen</label>
                    </div>
                </div>

                <div style="text-align: center;margin-top: 10px">
                    <img src="{{URL::asset('images/waiting.png')}}" id="profile-img-tag" height="320px" />
                </div>

            </div>
        </div>

        <div class="row" style="margin-top: 15px;margin-bottom: 20px">
            <button type="submit" class="btn btn-lg btn-block btn-primary">Registrar Auto</button>
        </div>
    </form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            readURL(this);
        });

        //Función para mostrar imagen seleccioanda.
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#profile-img-tag').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@stop