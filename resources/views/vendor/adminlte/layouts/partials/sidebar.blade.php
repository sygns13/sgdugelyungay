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
            


            @if(accesoUser([1]))

            
            <li class="header">MENÚ ADMINISTRADOR</li>

            <li v-bind:class="classMenu0"><a href="{{ url('home') }}"><i class='fa fa-home'></i> <span>Inicio</span></a></li>

            <li class="treeview" v-bind:class="classMenu1">
                <a href="#"><i class='fa fa-list-alt'></i> <span>Tablas Maestras</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ URL::to('tipodocumento')}}"><i class='fa fa-gg'></i> <span>Tipo de Documentos</span></a></li>
                    <li><a href="{{ URL::to('formarecepcion')}}"><i class='fa fa-gg'></i> <span>Forma de Recepción</span></a></li>
                    <li><a href="{{ URL::to('unidadorganica')}}"><i class='fa fa-gg'></i> <span>Unidad Orgánica</span></a></li>
                </ul>
            </li>



@endif


@if(accesoUser([1]))
        <li class="treeview" v-bind:class="classMenu2">
            <a href="{{ URL::to('#')}}"><i class='fa fa-file-text'></i> <span>Procesar Trámites</span> </a>
        </li>


        <li class="treeview" v-bind:class="classMenu3">
            <a href="{{ URL::to('#')}}"><i class='fa fa-archive'></i> <span>Reporte Histórico</span> </a>
        </li>

@endif



@if(accesoUser([1]))
            <li class="treeview" v-bind:class="classMenu4">
                <a href="#"><i class='fa fa-user-secret'></i> <span>Administrar Usuarios</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                  <li><a href="{{URL::to('#')}}"><i class='fa fa-gg'></i> <span>Gestión de Usuarios</span></a></li>
                  <li><a href="{{ URL::to('#')}}"><i class='fa fa-gg'></i> <span>Envío de Email</span></a></li>
                </ul>
            </li>
@endif














@if(accesoUser([3]))

            
<li class="header">MENÚ USUARIO</li>

<li v-bind:class="classMenu0"><a href="{{ url('home') }}"><i class='fa fa-home'></i> <span>Inicio</span></a></li>

<li class="treeview" v-bind:class="classMenu1">
    <a href="#"><i class='fa fa-list-alt'></i> <span>Gestión de Trámites</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
        <li><a href="{{ URL::to('#')}}"><i class='fa fa-gg'></i> <span>Seguimiento de Trámites</span></a></li>
        <li><a href="{{ URL::to('#')}}"><i class='fa fa-gg'></i> <span>Histórico de Trámites</span></a></li>
    </ul>
</li>



@endif


        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
