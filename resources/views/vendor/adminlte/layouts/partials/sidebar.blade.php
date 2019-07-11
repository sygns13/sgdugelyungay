<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{ asset('/img/perfil/noPerfil.png')}}" class="img-circle imgPerfil" alt="User Image" style="height: 45px;"/>
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('adminlte_lang::message.online') }}</a>
                </div>
            </div>
        @endif

        <!-- search form (Optional)
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Buscar..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form> -->
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            
            

            <!-- Optionally, you can add icons to the links -->
            <li v-bind:class="classMenu0"><a href="{{ url('home') }}"><i class='fa fa-home'></i> <span>Inicio</span></a></li>


            @if(accesoUser([3]))

            <li class="header">ADMINISTRADOR VERIFICADOR</li>
             <li class="treeview" v-bind:class="classMenu4">
                <a href="#"><i class='fa fa-bar-chart-o'></i> <span>Análisis Estadístico</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{URL::to('analisisgeneral')}}"><i class='fa fa-gg'></i> <span>Análisis General</span></a></li>
                    <li><a href="{{URL::to('analisisgeneral2')}}"><i class='fa fa-gg'></i> <span>Avance del Cumplimiento</span></a></li>
                    <li><a href="{{URL::to('analisisgeneral3')}}"><i class='fa fa-gg'></i> <span>Avance de Metas</span></a></li>
                    <li><a href="{{ URL::to('analisisdetallado')}}"><i class='fa fa-gg'></i> <span>Análisis Detallado</span></a></li>
                    <li><a href="{{ URL::to('analisisanual')}}"><i class='fa fa-gg'></i> <span>Análisis Anual</span></a></li>

                    <li><a href="{{ URL::to('ingresados')}}"><i class='fa fa-gg'></i> <span>Pendientes e ingresados</span></a></li>
                    <li><a href="{{ URL::to('resueltos')}}"><i class='fa fa-gg'></i> <span>Resueltos</span></a></li>

                </ul>
            </li>

            <li class="treeview" v-bind:class="classMenu9">
                <a href="{{ URL::to('reporteprocesos')}}"><i class='fa fa-archive'></i> <span>Rep. Violencia Familiar</span> <i class="fa fa-angle-left pull-right"></i></a>
            </li>


             <li class="treeview" v-bind:class="classMenu5">
                <a href="{{ URL::to('userreporte')}}"><i class='fa fa-user-secret'></i> <span>Reporte Inicio de Sesión</span> <i class="fa fa-angle-left pull-right"></i></a>
            </li>

            <li class="treeview" v-bind:class="classMenu6">
                <a href="{{ URL::to('magistradoreporte')}}"><i class='fa fa-graduation-cap'></i> <span>Reporte de Magistrados</span> <i class="fa fa-angle-left pull-right"></i></a>
            </li>

            <li class="treeview">
                    <a href="{{ URL::to('home')}}"><i class='fa fa-eye'></i> <span><b>Ir a Vista Usuario</b></span> </a>
                </li>


            @endif


            @if(accesoUser([1]))

            
            <li class="header">MENÚ ADMINISTRADOR</li>
            <li class="treeview" v-bind:class="classMenu1">
                <a href="#"><i class='fa fa-list-alt'></i> <span>Tablas Maestras</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{URL::to('especialidad')}}"><i class='fa fa-gg'></i> <span>Especialidades</span></a></li>
                    <li><a href="{{ URL::to('subespecialidad')}}"><i class='fa fa-gg'></i> <span>Subespecialidades</span></a></li>
                    <li><a href="{{ URL::to('funcion')}}"><i class='fa fa-gg'></i> <span>Funciones</span></a></li>
                    <li><a href="{{ URL::to('asignarprovincia')}}"><i class='fa fa-gg'></i> <span>Gestionar Provincias</span></a></li>
                </ul>
            </li>



            <li v-bind:class="classMenu2"><a href="{{ URL::to('dependencias')}}" ><i class='fa fa-university'></i> <span>Gestión de Dependencias</span></a></li>
            <li v-bind:class="classMenu8"><a href="{{ URL::to('organojudicial')}}" ><i class='fa fa-legal'></i> <span>Gestión de Órganos Jud</span></a></li>
            <li v-bind:class="classMenu12"><a href="{{ URL::to('porcentajes')}}" ><i class='fa fa-fax'></i> <span>Porcentajes de Avance</span></a></li>





            <li class="treeview" v-bind:class="classMenu3">
                <a href="#"><i class='fa fa-database'></i> <span>Importar Data Mensual</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{URL::to('expedientes')}}"><i class='fa fa-gg'></i> <span>Importar Expedientes</span></a></li>
                    <li><a href="{{ URL::to('procesosviolencia')}}"><i class='fa fa-gg'></i> <span>Importar Data Violencia F.</span></a></li>
                </ul>
            </li>


            
            {{--  <li><a href="#" id="arequeU"><i class='fa fa-file-excel-o '></i> prueba excel</a></li>--}}

            <li class="treeview" v-bind:class="classMenu4">
                <a href="#"><i class='fa fa-bar-chart-o'></i> <span>Análisis Estadístico</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{URL::to('analisisgeneral')}}"><i class='fa fa-gg'></i> <span>Análisis General</span></a></li>
                    <li><a href="{{URL::to('analisisgeneral2')}}"><i class='fa fa-gg'></i> <span>Avance del Cumplimiento</span></a></li>
                    <li><a href="{{URL::to('analisisgeneral3')}}"><i class='fa fa-gg'></i> <span>Avance de Metas</span></a></li>
                    <li><a href="{{ URL::to('analisisdetallado')}}"><i class='fa fa-gg'></i> <span>Análisis Detallado</span></a></li>
                    <li><a href="{{ URL::to('analisisanual')}}"><i class='fa fa-gg'></i> <span>Análisis Anual</span></a></li>
                    <li><a href="{{ URL::to('ingresados')}}"><i class='fa fa-gg'></i> <span>Pendientes e ingresados</span></a></li>
                    <li><a href="{{ URL::to('resueltos')}}"><i class='fa fa-gg'></i> <span>Resueltos</span></a></li>
                </ul>
            </li>

@endif


@if(accesoUser([1,2]))


<li class="treeview" v-bind:class="classMenu9">
                <a href="#"><i class='fa fa-archive'></i> <span>Proc. Violencia Familiar</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{URL::to('ingresoprocesos')}}"><i class='fa fa-gg'></i> <span>Ingreso de Procesos</span></a></li>
                  @if(accesoUser([1]))  <li><a href="{{ URL::to('reporteprocesos')}}"><i class='fa fa-gg'></i> <span>Reportes de Procesos</span></a></li>@endif
                </ul>
            </li>


@endif

@if(accesoUser([1]))
            <li class="treeview" v-bind:class="classMenu5">
                <a href="#"><i class='fa fa-user-secret'></i> <span>Administrar Usuarios</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{URL::to('usuarios')}}"><i class='fa fa-gg'></i> <span>Gestión de Usuarios</span></a></li>
                  <li><a href="{{ URL::to('usuariosmail')}}"><i class='fa fa-gg'></i> <span>Envío de Email</span></a></li>
                    <li><a href="{{ URL::to('usuariossms')}}"><i class='fa fa-gg'></i> <span>Envío de SMS Móvil</span></a></li>
                    <li><a href="{{ URL::to('usuariosalert')}}"><i class='fa fa-gg'></i> <span>Envío de Alertas</span></a></li>
                    <li><a href="{{ URL::to('userreporte')}}"><i class='fa fa-gg'></i> <span>Reporte Inicio de Sesión</span></a></li>
                </ul>
            </li>

            <li class="treeview" v-bind:class="classMenu6">
                <a href="#"><i class='fa fa-graduation-cap'></i> <span>Administrar Magistrados</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{URL::to('magistrados')}}"><i class='fa fa-gg'></i> <span>Gestión de Magistrados</span></a></li>
                    <li><a href="{{ URL::to('magistradosmail')}}"><i class='fa fa-gg'></i> <span>Envío de Email</span></a></li>
                    <li><a href="{{ URL::to('magistradossms')}}"><i class='fa fa-gg'></i> <span>Envío de SMS Móvil</span></a></li>
                    <li><a href="{{ URL::to('magistradoreporte')}}"><i class='fa fa-gg'></i> <span>Reporte Procesos Resueltos</span></a></li>
                </ul>
            </li>

@endif


            

           
            
            @if(accesoUser([1]))

             <li class="header">MENÚ WEB</li>
            
                <li class="treeview">
                <a href="#"><i class='fa fa-chrome'></i> <span>Gestión de Contenido</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="#" id="msjeInicial"><i class='fa fa-gg'></i> Presentación</a></li>
                    <li><a href="#" id="funciones"><i class='fa fa-gg'></i> Funciones</a></li>
                    <li><a href="#" id="calendarioGo"><i class='fa fa-gg'></i> Calendario</a></li>
                    <li><a href="#" id="galeria"><i class='fa fa-gg'></i> Galería</a></li>
                    <li><a href="#" id="album"><i class='fa fa-gg'></i> Álbunes de Galería</a></li>
                    <li><a href="#" id="dgestion"><i class='fa fa-gg'></i> Documentos de Gestión</a></li>
                  {{--    <li><a href="#" id="videoInicial"><i class='fa fa-gg'></i> Video de Presentación</a></li>--}}
                </ul>
            </li>

            @endif
            @if(accesoUser([1,2]))
            <li v-bind:class="classMenu7"><a href="{{ URL::to('foro') }}"><i class='fa fa-users'></i> <span>Ingresar a Foro</span></a></li>
            @endif
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
