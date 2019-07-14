<div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Formulario de Solicitud de Trámite</h3>
    </div>
  
    <div class="box-body">

      {{--  
      <div class="form-group">
        <button type="button" class="btn btn-primary" id="btncrearArea" @click.prevent="nuevo()"><i class="fa fa-plus-square-o" aria-hidden="true" ></i> Nuevo Registro</button>
      </div>
  
  
  
      
        <div class="box-footer">
          <button type="button" class="btn btn-primary" onclick="enviarMSj();" id="btnEnviarMsj"><i class="fa fa-envelope-o" aria-hidden="true" ></i> Enviar Mensaje</button>
          <div id="divCarga0" style="display: inline-block;"><div id="dcarga0" style="display: none;"><img src="{{ asset('/img/ajax-loader.gif')}}"/></div></div>
        </div>
        --}}
  
      </div>
  
    </div>
  
    <div class="box box-success">
      <div class="box-header with-border" >
        <h3 class="box-title" id="tituloAgregar">Complete el Formulario para Inicializar un Trámite</h3>
      </div>
  
      <form v-on:submit.prevent="create">
       <div class="box-body">

          <div class="col-md-12" > <h4>DATOS DEL REGISTRO</h4> </div>
  
        <div class="col-md-12" >
  
          <div class="form-group">
            <label for="txtformarecepcion" class="col-sm-2 control-label">PRIORIDAD:*</label>
  
            <div class="col-sm-4">
                <select class="form-control" id="cbuestado" name="cbuestado" v-model="newEstado">
                  <option value="1">Activado</option>
                  <option value="0">Desactivado</option>
                </select>
              </div>
          </div>
        </div>


  
        <div class="col-md-12" > <h4>DATOS DEL REGISTRO</h4> </div>

        <div class="col-md-12" >
  
            <div class="form-group">
              <label for="txtformarecepcion" class="col-sm-2 control-label">PRIORIDAD:*</label>
    
              <div class="col-sm-8">
                <input type="text" class="form-control" id="txtformarecepcion" name="txtformarecepcion" placeholder="Descripción" maxlength="500" autofocus v-model="newforma" required>
              </div>
            </div>
          </div>
  
        <div class="col-md-12" style="padding-top: 15px;">
          <div class="form-group">
            <label for="cbuestado" class="col-sm-2 control-label">Estado:*</label>
            <div class="col-sm-4">
              <select class="form-control" id="cbuestado" name="cbuestado" v-model="newEstado">
                <option value="1">Activado</option>
                <option value="0">Desactivado</option>
              </select>
            </div>
          </div>
        </div>
  
      </div>
  
      <!-- /.box-body -->
      <div class="box-footer">
        <button type="submit" class="btn btn-info" id="btnGuardar">Guardar</button>
  
        <button type="reset" class="btn btn-warning" id="btnCancel" @click="cancelForm()">Cancelar</button>
  
        <button type="button" class="btn btn-default" id="btnClose" @click.prevent="cerrarForm()">Cerrar</button>
  
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
      <!-- /.box-footer -->
  
    </form>
  </div>
  
  
  
{{--   
  <div class="box box-info">
    <div class="box-header">
      <h3 class="box-title">Listado de Tipos de Documentos</h3>
  
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
      <table class="table table-hover table-bordered" >
        <tbody><tr>
          <th style="padding: 5px; width: 5%;">#</th>
          <th style="padding: 5px; width: 70%;">Tipo de Documentos</th>
          <th style="padding: 5px; width: 10%;">Estado</th>
          <th style="padding: 5px; width: 15%;">Gestión</th>
        </tr>
        <tr v-for="formarecepcion, key in formarecepcions">
          <td style="font-size: 12px; padding: 5px;">@{{key+pagination.from}}</td>
          <td style="font-size: 12px; padding: 5px;">@{{ formarecepcion.forma }}</td>
          <td style="font-size: 12px; padding: 5px;">
           <span class="label label-success" v-if="formarecepcion.activo=='1'">Activo</span>
           <span class="label label-warning" v-if="formarecepcion.activo=='0'">Inactivo</span>
         </td>
         <td style="font-size: 12px; padding: 5px;">
  
           <a href="#" v-if="formarecepcion.activo=='1'" class="btn bg-navy btn-sm" v-on:click.prevent="baja(formarecepcion)" data-placement="top" data-toggle="tooltip" title="Desactivar Tipo de Documento"><i class="fa fa-arrow-circle-down"></i></a>
  
           <a href="#" v-if="formarecepcion.activo=='0'" class="btn btn-success btn-sm" v-on:click.prevent="alta(formarecepcion)" data-placement="top" data-toggle="tooltip" title="Activar Tipo de Documento"><i class="fa fa-check-circle"></i></a>
  
  
           <a href="#" class="btn btn-warning btn-sm" v-on:click.prevent="editar(formarecepcion)" data-placement="top" data-toggle="tooltip" title="Editar Tipo de Documento"><i class="fa fa-edit"></i></a>
           <a href="#" class="btn btn-danger btn-sm" v-on:click.prevent="borrar(formarecepcion)" data-placement="top" data-toggle="tooltip" title="Borrar Tipo de Documento"><i class="fa fa-trash"></i></a>
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
   --}}
  
  