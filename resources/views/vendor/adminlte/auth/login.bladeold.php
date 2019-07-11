@extends('adminlte::layouts.auth')

@section('htmlheader_title')
   Iniciar Sesión
@endsection

@section('content')

<body id="headerwrap" class="withAnimation">

    <div class="parallax-viewport" id="parallax">
        <div class="parallax-layer cloud1" style="top: 15%; margin-top: -15.9437px; left: 3%; margin-left: -24.4265px;">
            <img src="{{ asset('/login/images/cloud3.png') }}" alt="">
        </div>
        <div class="parallax-layer cloud2" style="top: 8%; margin-top: -11.6293px; left: 90%; margin-left: -145.756px;">
            <img src="{{ asset('/login/images/cloud2.png') }}" alt="">
        </div>
        <div class="parallax-layer cloud3" style="top: 70%; margin-top: -11.9391px; left: 0%; margin-left: -42.0027px;">
            <img src="{{ asset('/login/images/cloud2.png') }}" alt="">
        </div>
        <div class="parallax-layer cloud4" style="top: 0%; margin-top: -11.9391px; left: 90%; margin-left: -402.003px;">
            <img src="{{ asset('/login/images/cloud1.png') }}" alt="">
        </div>
        <div class="parallax-layer cloud5" style="top: 0%; margin-top: -2.14886px; left: 26%; margin-left: -155.697px;">
            <img src="{{ asset('/login/images/cloud1.png') }}" alt="">
        </div>
        <div class="parallax-layer cloud6" style="top: 52%; margin-top: -10.7443px; left: 95%; margin-left: -497.969px;">
            <img src="{{ asset('/login/images/cloud1.png') }}" alt="">
        </div>
    </div>

    <div class="container">
    <div class="d-flex justify-content-center h-100">
        <div class="col-md-12">
            <div class="col-md-6" style="width: 400px;padding-left: 0px;padding-right: 0px;font-size: 13px;">
                
                @if (count($errors) > 0)

                    <div class="alert alert-danger" style="margin-bottom: 0px;margin-top: 30px;">
                        <div style="text-align: center;">
                            <p style="margin-bottom: 6px;">
                                
                            <strong>Error!</strong> Tenemos algunos Algunos Problemas<br>
                            </p>
                        </div>
                        <ul style="margin-bottom: 0px;">
                            @foreach ($errors->all() as $error)
                            {{-- <li>{{ $error }}</li>  --}}
                            @if($error=="The name field is required.")
                            <li>El campo Usuario es necesario.</li>
                            @endif

                            @if($error=="The password field is required.")
                            <li>El campo Contraseña es necesario.</li>
                            @endif

                            @if($error=="These credentials do not match our records.")
                            <li>Estas credenciales no coinciden con nuestros registros.</li>
                            @endif

                            @if($error=="usuarioActiv")
                            <li>El usuario del sistema se encuentra desactivado, comuncarse con el administrador del sistema.</li>
                            @endif

                            @if($error=="alumnoSemestre")
                            <li>El semestre al que pertenece el alumno se encuentra cerrado, comuniquese con el administrador del sistema.</li>
                            @endif

                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>



            <div class="card2" style="text-align: center;margin-top: 50px;border-radius: 3px">
                <img class="" src="{{ asset('/login/images/logoPJ4.png') }}" style="padding-top: 7px;">
            </div>
            <hr style="border-top: 1px solid rgba(0, 0, 0, 0);">
            <!-- <br> -->
        <div class="card">

            <div class="card-header" style="padding-left: 25px;padding-right: 25px;border-bottom: 1px solid rgba(255, 195, 18, 0.54);">
                <h3 style="margin-top: 15px;"><font face="Arial">REDIES</font></h3>
                <div class="d-flex justify-content-end social_icon">
                    <!-- <span><i class="glyphicon glyphicon-stats"></i></span> -->
                    <img style="margin-top: 15px;" src="{{ asset('/login/images/logoSinF.png') }}">
                    <!-- <span><i class="glyphicon glyphicon-equalizer"></i></span> -->
                </div>
            </div>
            <div class="card-body" style="padding-left: 25px;padding-right: 25px;">
                <form action="{{ url('/loginn') }}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Usuario">
                        
                    </div>
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="password" class="form-control" name="password" placeholder="password">
                    </div>
                    <div class="row align-items-center remember">
                        <input type="checkbox" name="remember">Recuérdame
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Ingresar" class="btn float-right login_btn">
                    </div>
                </form>
            </div>
            <div class="card-footer" style="border-top: 1px solid rgba(255, 195, 18, 0.54);">
                <div class="d-flex center-content-center links" style="text-align: center;font-style: oblique;">
                    <font size="5" face="Monotype Corsiva" style="color: #eee">"Sistema Para el Registro y Difusión de la Información Estadística - CSJAN"</font>
                </div>
                
            </div>
        </div>
        
        </div>

    </div>

    @include('vendor.adminlte.layouts.partials.scripts_auth2')
</body>

@endsection
