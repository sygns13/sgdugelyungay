@extends('adminlte::layouts.auth')

@section('htmlheader_title')
   Iniciar Sesión
@endsection





@section('content')

<style type="text/css" media="screen">

div.login-box{
    background-color: white;
    border-radius: 0.5em;
}

p.appSis{
    padding-top: 1.5em;
    font-family: "Homer Simpson", cursive;
    font-weight: bold;
    font-size: 18px;
    text-transform: uppercase;
}

img.logoImage{
    width: 100%;
    padding-top: 1.5em;
}

</style>

<body class="hold-transition login-page" style="background-image: url({{ asset('/img/csjan1.jpg')}}); background-repeat: no-repeat, repeat; opacity: 0.9" >
    <div class="row">
        <div class="col-md-8">

        </div>
        <div class="col-md-4" class="loginLeft">
         <div id="app" v-cloak >
            <div class="login-box">
                <div class="login-logo">
                    <img class="logoImage" src="{{ asset('/img/logo.jpg')}}" alt="l">

                    <p href="{{ url('/home') }}" class="appSis">Sistema Para el Registro y Difusión de la <br>Información Estadística CSJAN</a>
                    </div><!-- /.login-logo -->

                    <br>

                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Error!</strong> Tenemos algunos Algunos Problemas<br><br>
                        <ul>
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

                    <div class="login-box-body" style="background-color: white;
                    padding: 20px;
                    border-top: 0;
                    color: #020202;
                    border-radius: 5%;
                    font-weight: bold;">
                    <p class="login-box-msg"> ACCESO AL SISTEMA</p>

                    {{--   <login-form name="{{ config('auth.providers.users.field','username') }}"
                    domain="{{ config('auth.defaults.domain','') }}"></login-form>

                    @include('auth.partials.social_login') --}}

                    <form action="{{ url('/login') }}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">


                        {{--  
                            <div class="form-group has-feedback">
                                <input type="email" class="form-control" placeholder="{{ trans('adminlte_lang::message.email') }}" name="email"/>
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                            </div>--}}

                            <div class="form-group has-feedback">
                                <input type="text" name="name" class="form-control" id="name" placeholder="Usuario" style="font-weight: normal;" />
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                            </div>

                            <div class="form-group has-feedback">
                                <input type="password" class="form-control" placeholder="Contraseña" name="password" style="font-weight: normal;"/>
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                            </div>
                            <div class="row">

                                <div class="col-xs-7">
                    <div class="checkbox icheck">
                        <label style="">
                    <input style="" type="checkbox" name="remember"> {{ trans('adminlte_lang::message.remember') }} 
                        </label>
                    </div>
                </div>

                                <div class="col-xs-6">
                                    <button type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>
                                </div>
                                <div class="col-xs-6">
                                    <a href="/" class="btn btn-default btn-block">Cancelar</a>
                                </div><!-- /.col -->
                            </div>
                        </form>{{--

<br>
                        <a href="{{ url('/password/reset') }}">Olvidé mi Contraseña</a><br>


                        
                         <a href="{{ url('/register') }}" class="text-center">{{ trans('adminlte_lang::message.registermember') }}</a>--}}

                    </div>

                </div>
            </div>
        </div>
    </div>

    @include('vendor.adminlte.layouts.partials.scripts_auth')
</body>

@endsection
