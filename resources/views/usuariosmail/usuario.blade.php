<div class="box box-primary" v-if="mostrarPalenIni">
  <div class="box-header with-border"> 
    <h3 class="box-title">Enviar Mensajes a los Correos</h3>
    <a style="float: right;" type="button" class="btn btn-default" href="{{URL::to('home')}}"><i class="fa fa-reply-all" aria-hidden="true"></i> 
    Volver</a>
  </div>
  

  <form v-on:submit.prevent="enviarMail" enctype="multipart/form-data" id="formulario">

  <div class="box-body">
   <div class="col-md-12">
     <div class="form-group">
      <label for="descripcion">Asunto *</label>
      <input type="text" name="txtasunto" id="txtasunto" class="form-control" placeholder="Ingrese Asunto" v-model="newAsunto" autofocus>
    </div>
  </div>
  
  <div class="col-md-12" v-if="div1">
   <div class="form-group">
    <label for="descripcion">Email de Destino *</label>
    <input type="text" name="txtemaildestino" id="txtemaildestino" class="form-control" v-model="newEmail">
  </div>
</div>

<div class="col-md-12" v-if="div2">
 <div class="form-group">
  <label for="descripcion">Email de Destino *</label>
  <br>
  <div class="col-md-2" v-for="user, key in usuarios">
    <input style="background-color:#f0f0f0;" class="vT" v-bind:value=" user.email " readonly="">
  </div>
</div>
</div>

<div class="col-md-12" v-if="div3">
  <div class="form-group">
    <label for="descripcion">Email de Destino *</label>
    <br>
    <div class="col-md-2" v-for="(item, index) in users">
      <input style="background-color:#f0f0f0; cursor: pointer;" class="vT" v-bind:value="item.email" readonly="" v-on:click="users.splice(index, 1)" v-bind:id="item.email">
    </div>
  </div>
</div>


<div class="col-md-12">

                <div class="form-group">
                  <label for="txtArchivoAdjunto">Archivo Adjunto: (Opcional: pdf, docx, xlsx, pptx) Peso Máximo 5 MB</label>
                  </div>
      
                     <input v-if="uploadReady" name="archivo2" type="file" id="archivo2" class="archivo form-control" @change="getArchivo" 
          accept=".pdf, .doc, .docx, .xls, .xlsx, ppt, .pptx, .PDF, .DOC, .DOCX, .XLS, .XLSX, .PPT, .PTTX"/>

   
</div>



<div class="col-md-12">
  <div class="form-group">
    <label for="txtdescripcion">Descripción:*</label>
    <ckeditora v-model="content"></ckeditora>
  </div>
</div>

</div>
<!-- /.box-body -->
<div class="box-footer">
  <button type="submit" class="btn btn-info" id="btnGuardar">Enviar</button>

  <button type="reset" class="btn btn-warning" id="btnCancel" @click="cancelFormUsuario()">Cancelar</button>

  <button class="btn btn-success btn-sm pull-right" id="btnCargarMail" v-on:click.prevent="cargarEmail()" data-placement="top" data-toggle="tooltip" title="Cargar Emails"><i class="fa fa-arrow-circle-up"></i> <b> Cargar Emails</b></button>

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
        <th style="font-size: 12px; padding: 5px; width: 4%;">#</th>
        <th style="font-size: 12px; padding: 5px; width: 15%;">Tipo de Usuario</th>
        <th style="font-size: 12px; padding: 5px; width: 22%;">Apellidos y Nombres</th>
        <th style="font-size: 12px; padding: 5px; width: 8%;">DNI</th>
        <th style="font-size: 12px; padding: 5px; width: 15%;">Usuario</th>
        <th style="font-size: 12px; padding: 5px; width: 22%;">Email</th>
        <th style="font-size: 12px; padding: 5px; width: 9%;">Estado</th>
                  <th style="font-size: 12px; padding: 5px; width: 5%;">Seleccione</th>
                </tr>
                <tr v-for="usuario, key in usuarios">
                  <td style="font-size: 12px; padding: 5px;">@{{key+pagination.from}}</td>
                  <td style="font-size: 12px; padding: 5px;">@{{ usuario.tipouser }}</td>
                  <td style="font-size: 12px; padding: 5px;">@{{ usuario.apePer }}, @{{ usuario.nombresPer }}</td>
                  <td style="font-size: 12px; padding: 5px;">@{{ usuario.dni }}</td>
                  <td style="font-size: 12px; padding: 5px;">@{{ usuario.username }}</td>
                  <td style="font-size: 12px; padding: 5px;">@{{ usuario.email }}</td>
                  <td style="font-size: 12px; padding: 5px;">
                  	<span class="label label-success" v-if="usuario.activo=='1'">Activo</span>
                  	<span class="label label-warning" v-if="usuario.activo=='0'">Inactivo</span>
                  </td>

       <td style="font-size: 12px; padding: 5px;">
        <center>
          <a href="#" class="btn btn-info btn-sm" v-on:click.prevent="seleccionarUser(usuario.email)" data-placement="top" data-toggle="tooltip" title="Seleccionar Usuario"><i class="fa fa-check-circle"></i></a>

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

