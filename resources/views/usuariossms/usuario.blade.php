<div class="box box-primary" v-if="mostrarPalenIni">
  <div class="box-header with-border"> 
    <h3 class="box-title">Enviar SMS Movil</h3>
    <a style="float: right;" type="button" class="btn btn-default" href="{{URL::to('home')}}"><i class="fa fa-reply-all" aria-hidden="true"></i> 
    Volver</a>
  </div>
  

  <form v-on:submit.prevent="enviarSMS" enctype="multipart/form-data" id="formulario">

      <div class="box-body">

  


<div class="col-md-12" v-if="div3">
  <div class="form-group">
    <label for="descripcion">Teléfonos de Destino *</label>
    <br>
    <div class="col-md-2" v-for="(item, index) in users">
      <input style="background-color:#f0f0f0; cursor: pointer;" class="vT" v-bind:value="item.telefono" readonly="" v-on:click="users.splice(index, 1)" v-bind:id="item.telefono">
    </div>
  </div>
</div>


<div class="col-md-12">
  <div class="form-group">
    <label for="txtdescripcion">Descripción: (Máx 160 Caracteres por SMS)</label>
    <textarea class="form-control" id="txtsms" name="txtsms" placeholder="Ingrese el SMS a Enviar." rows="4" maxlength="160" v-model="newSms"></textarea>  
  </div>
</div>






</div>

<div class="box-footer">
  <button type="submit" class="btn btn-info" id="btnGuardar">Enviar</button>

  <button type="reset" class="btn btn-warning" id="btnCancel" @click="cancelFormUsuario()">Cancelar</button>

  <button class="btn btn-success btn-sm pull-right" id="btnCargarMail" v-on:click.prevent="cargarTelefonos()" data-placement="top" data-toggle="tooltip" title="Cargar Teléfonos"><i class="fa fa-arrow-circle-up"></i> <b> Cargar Teléfonos</b></button>

  <div class="sk-circle" v-show="divloaderNuevo">
    <div class="sk-circle1 sk-child"></div>
    <div class="sk-circle2 sk-child"></div>
    <div class="sk-circle3 sk-child"></div>
    <div class="sk-circle4 sk-child"></div>
    <div class="sk-circle5 sk-child"></div>
    <div class="sk-circle6 sk-child"></div>
    <div class="sk-circle7 sk-child"></div>
    <div class="sk-circle8 sk-child"></div>
    <div class="sk-circle9 sk-child"></div>
    <div class="sk-circle10 sk-child"></div>
    <div class="sk-circle11 sk-child"></div>
    <div class="sk-circle12 sk-child"></div>
  </div>

</div>

</form>
<!-- /.box-footer -->
</div>



<div class="box box-info" >
  <div class="box-header">
    <h3 class="box-title">Listado de Usuarios del Sistema
    </h3>
    <div class="box-tools">
      <div class="input-group input-group-sm" style="width: 300px;">
        <input type="text" name="table_search" class="form-control pull-right" placeholder="Buscar" v-model="buscar" @keyup.enter="buscarBtn()">
        <div class="input-group-btn">
          <button type="submit" class="btn btn-default" @click.prevent="buscarBtn()"><i class="fa fa-search"></i></button>
        </div>
      </div>

    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body table-responsive">
    <table class="table table-hover table-bordered" id="tabla">
      <tbody><tr>
         <th style="font-size: 12px; padding: 5px; width: 3%;">#</th>
                  <th style="font-size: 12px; padding: 5px; width: 9%;">Tipo de Usuario</th>
                  <th style="font-size: 12px; padding: 5px; width: 8%;">Provincia</th>
                  <th style="font-size: 12px; padding: 5px; width: 8%;">Distrito</th>
                  <th style="font-size: 12px; padding: 5px; width: 16%;">Dependencia</th>
                  <th style="font-size: 12px; padding: 5px; width: 14%;">Apellidos y Nombres</th>
                  <th style="font-size: 12px; padding: 5px; width: 6%;">DNI</th>
                  <th style="font-size: 12px; padding: 5px; width: 6%;">Teléfono</th>
                  <th style="font-size: 12px; padding: 5px; width: 7%;">Usuario</th>
                  <th style="font-size: 12px; padding: 5px; width: 13%;">Email</th>
                  <th style="font-size: 12px; padding: 5px; width: 5%;">Estado</th>
                  <th style="font-size: 12px; padding: 5px; width: 5%;">Seleccione</th>
                </tr>
                <tr v-for="usuario, key in usuarios">
                  <td style="font-size: 12px; padding: 5px;">@{{key+pagination.from}}</td>
                  <td style="font-size: 12px; padding: 5px;">@{{ usuario.tipouser }}</td>
                  <td style="font-size: 12px; padding: 5px;">@{{ usuario.provincia }}</td>
                  <td style="font-size: 12px; padding: 5px;">@{{ usuario.distrito }}</td>
                  <td style="font-size: 12px; padding: 5px;">@{{ usuario.dependencia }}</td>
                  <td style="font-size: 12px; padding: 5px;">@{{ usuario.apePer }}, @{{ usuario.nombresPer }}</td>
                  <td style="font-size: 12px; padding: 5px;">@{{ usuario.doc }}</td>
                  <td style="font-size: 12px; padding: 5px;">@{{ usuario.telefono }}</td>
                  <td style="font-size: 12px; padding: 5px;">@{{ usuario.username }}</td>
                  <td style="font-size: 12px; padding: 5px;">@{{ usuario.email }}</td>
                  <td style="font-size: 12px; padding: 5px;">
                    <span class="label label-success" v-if="usuario.activo=='1'">Activo</span>
                    <span class="label label-warning" v-if="usuario.activo=='0'">Inactivo</span>
                  </td>
       <td style="font-size: 12px; padding: 5px;">
        <center>
          <a href="#" id="btnCargarFono" class="btn btn-info btn-sm" v-on:click.prevent="seleccionarUser(usuario.telefono)" data-placement="top" data-toggle="tooltip" title="Seleccionar Usuario"><i class="glyphicon glyphicon-phone"></i></a>

        </center>
      </td>
    </tr>

  </tbody></table>

</div>
<!-- /.box-body -->
<div style="padding: 15px;">
 <div><h5>Registros por Página: @{{ pagination.per_page }}</h5></div>
 <nav aria-label="Page navigation example">
   <ul class="pagination">
    <li class="page-item" v-if="pagination.current_page>1">
     <a class="page-link" href="#" @click.prevent="changePage(1)">
      <span><b>Inicio</b></span>
    </a>
  </li>

  <li class="page-item" v-if="pagination.current_page>1">
   <a class="page-link" href="#" @click.prevent="changePage(pagination.current_page-1)">
    <span>Atras</span>
  </a>
</li>
<li class="page-item" v-for="page in pagesNumber" v-bind:class="[page=== isActived ? 'active' : '']">
 <a class="page-link" href="#" @click.prevent="changePage(page)">
  <span>@{{ page }}</span>
</a>
</li>
<li class="page-item" v-if="pagination.current_page< pagination.last_page">
 <a class="page-link" href="#" @click.prevent="changePage(pagination.current_page+1)">
  <span>Siguiente</span>
</a>
</li>
<li class="page-item" v-if="pagination.current_page< pagination.last_page">
 <a class="page-link" href="#" @click.prevent="changePage(pagination.last_page)">
  <span><b>Ultima</b></span>
</a>
</li>
</ul>
</nav>
<div><h5>Registros Totales: @{{ pagination.total }}</h5></div>
</div>
</div>

