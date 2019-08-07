<nav class="navbar navbar-expand navbar-light bg-light">
    <div class="navbar-brand">
        <a class="navbar-item" href="{{url('/panel')}}">
            <img src="{{URL::asset('images/logosc.png')}}" alt="AutoPart"  height="45">
        </a>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown active">
                <a style="font-size: 18px" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Autos <i class="fa fa-car"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{url("panel/cars")}}">Catalogo</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{url("panel/cars/create")}}">Registrar</a>
                </div>
            </li>

            <li class="nav-item dropdown active">
                <a style="font-size: 18px" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Partes <i class="fa fa-cogs"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{url("panel/autoparts")}}">Catalogo</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{url("panel/autoparts/create")}}">Registrar</a>
                </div>
            </li>

            @if(Auth::user()->role==1)
                <li class="nav-item active">
                    <a class="nav-link" href="{{url("panel/products")}}" style="font-size: 18px">En Espera ({{\App\Product::where('approved', '=', 0)->count()}}) <i class="fa fa-clock"></i><span class="sr-only"></span></a>
                </li>
            @endif

        </ul>
        <div class="form-inline my-2 my-lg-0">
            <span class="nav-link"> <i class="fa fa-user"></i> Usuario: <b>{{Auth::user()->name}}</b></span>

            <a class="btn btn-danger my-2 my-sm-0" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Cerrar Sesión <i class="fa fa-sign-out-alt"></i>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </div>


    </div>
</nav>