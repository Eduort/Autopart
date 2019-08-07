<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ URL::asset('css/login.css') }}" />
    <link rel="icon"
          type="image/png"
          href="{{URL::asset('favicon.ico')}}" />
    <title>Autopart</title>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-sm-10 col-md-10 col-lg-10 mx-auto">
            <div class="card card-signin my-5">
                <div class="card-body">
                    <div class="text-center">
                        <img src="{{URL::asset('images/logosc.png')}}" alt="AutoPart" width="450">
                    </div>
                    <br>


                    <div style="text-align: center">
                        <h4>Catalogo dedicado a listar Autos y Autopartes</h4>
                    </div>


                    <br>

                    <div class="row">
                        <div class="col-md-6">
                            <a role="button" href="{{route('login')}}"  class="btn btn-primary btn-block btn-lg">Ingresar<br><i class="fa fa-sign-in-alt"></i></a>
                        </div>
                        <div class="col-md-6">
                            <a role="button" href="{{route('register')}}"  class="btn btn-primary btn-block btn-lg" >Registrarse<br><i class="fa fa-user-plus"></i></a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>