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
    <title>Autopart | Login</title>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">
                <div class="card-body">
                    <div class="text-center">
                        <img src="{{URL::asset('images/logosc.png')}}" alt="AutoPart" width="240">
                    </div>
                    <br>
                    <h5 class="card-title text-center"><b>Iniciar Sesión</b></h5>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-label-group">
                            <!-- Se usa PHP para mantener el usuario ingresado despues de enviar el formulario -->
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Escriba Email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            <label for="email">Escriba Email</label>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-label-group">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"  placeholder="Escriba Contraseña">
                            <label for="password">Escriba Contraseña</label>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <?php
                        //Muestra los errores generados
                        if(isset($errorMessages))
                        {
                            echo '<div class="alert alert-danger" role="alert"><b>Error: </b>'. $errorMessages . '</div>';
                        }
                        ?>
                        <button class="btn btn-lg btn-primary btn-block" type="submit">Ingresar</button>

                        <div style="text-align: center;margin-top: 10px">
                            <p>¿Nuevo Usuario? <a href="{{ route('register') }}">Crear nueva cuenta</a></p>
                        </div>

                    </form>
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