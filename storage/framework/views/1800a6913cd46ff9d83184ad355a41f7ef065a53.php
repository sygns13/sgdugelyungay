<div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Gestión de Unidades Orgánicas</h3>
      <a style="float: right;" type="button" class="btn btn-default" href="<?php echo e(URL::to('home')); ?>"><i class="fa fa-reply-all" aria-hidden="true"></i> 
      Volver</a>
    </div>
  
    <div class="box-body">
      <div class="form-group">
        <button type="button" class="btn btn-primary" id="btncrearArea" @click.prevent="nuevo()"><i class="fa fa-plus-square-o" aria-hidden="true" ></i> Nuevo Registro</button>
      </div>
  
  
  
      
  
      </div>
  
    </div>
  
    <div class="box box-success" v-if="divNuevo">
        <div class="box-header with-border" >
          <h3 class="box-title" id="tituloAgregar">Nueva Unidad Orgánica</h3>
        </div>
    
        <form v-on:submit.prevent="create">
         <div class="box-body">
    
          <div class="col-md-12" >
    
            <div class="form-group">
              <label for="txtunidaorg" class="col-sm-2 control-label">Unidad Orgánica:*</label>
    
              <div class="col-sm-8">
                <input type="text" class="form-control" id="txtunidaorg" name="txtunidaorg" placeholder="Descripción" maxlength="500" autofocus v-model="newnombre" required>
              </div>
            </div>
          </div>
  
  
          <div class="col-md-12" style="padding-top: 15px;">
    
              <div class="form-group">
                <label for="txtsiglas" class="col-sm-2 control-label">SIGLAS de la Unidad:*</label>
      
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="txtsiglas" name="txtsiglas" placeholder="SIGLAS" maxlength="45"  v-model="newsiglas">
                </div>
              </div>
            </div>
  
            <div class="col-md-12" style="padding-top: 15px;">
    
                <div class="form-group">
                  <label for="txtcodigo" class="col-sm-2 control-label">Código:*</label>
        
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="txtcodigo" name="txtcodigo" placeholder="Código" maxlength="45"  v-model="newcodigo">
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
  
  
  
  
  <div class="box box-info">
    <div class="box-header">
      <h3 class="box-title">Listado de Unidades Orgánicas</h3>
  
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
          <th style="padding: 5px; width: 45%;">Unidad Orgánica</th>
          <th style="padding: 5px; width: 10%;">SIGLAS</th>
          <th style="padding: 5px; width: 15%;">Código</th>
          <th style="padding: 5px; width: 10%;">Estado</th>
          <th style="padding: 5px; width: 15%;">Gestión</th>
        </tr>
        <tr v-for="unidadorganica, key in unidadorganicas">
          <td style="font-size: 12px; padding: 5px;">{{key+pagination.from}}</td>
          <td style="font-size: 12px; padding: 5px;">{{ unidadorganica.nombre }}</td>
          <td style="font-size: 12px; padding: 5px;">{{ unidadorganica.siglas }}</td>
          <td style="font-size: 12px; padding: 5px;">{{ unidadorganica.codigo }}</td>
          <td style="font-size: 12px; padding: 5px;">
           <span class="label label-success" v-if="unidadorganica.activo=='1'">Activo</span>
           <span class="label label-warning" v-if="unidadorganica.activo=='0'">Inactivo</span>
         </td>
         <td style="font-size: 12px; padding: 5px;">
  
           <a href="#" v-if="unidadorganica.activo=='1'" class="btn bg-navy btn-sm" v-on:click.prevent="baja(unidadorganica)" data-placement="top" data-toggle="tooltip" title="Desactivar Tipo de Documento"><i class="fa fa-arrow-circle-down"></i></a>
  
           <a href="#" v-if="unidadorganica.activo=='0'" class="btn btn-success btn-sm" v-on:click.prevent="alta(unidadorganica)" data-placement="top" data-toggle="tooltip" title="Activar Tipo de Documento"><i class="fa fa-check-circle"></i></a>
  
  
           <a href="#" class="btn btn-warning btn-sm" v-on:click.prevent="editar(unidadorganica)" data-placement="top" data-toggle="tooltip" title="Editar Tipo de Documento"><i class="fa fa-edit"></i></a>
           <a href="#" class="btn btn-danger btn-sm" v-on:click.prevent="borrar(unidadorganica)" data-placement="top" data-toggle="tooltip" title="Borrar Tipo de Documento"><i class="fa fa-trash"></i></a>
         </td>
       </tr>
  
     </tbody></table>
  
   </div>
   <!-- /.box-body -->
   <div style="padding: 15px;">
     <div><h5>Registros por Página: {{ pagination.per_page }}</h5></div>
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
      <span>{{ page }}</span>
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
  <div><h5>Registros Totales: {{ pagination.total }}</h5></div>
  </div>
  </div>
  
  <form method="post" v-on:submit.prevent="update(fillunidadorganica.id)">
    <div class="modal  bs-example-modal-lg" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
      <div class="modal-dialog modal-lg" role="document" id="modaltamanio">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="desEditarTitulo" style="font-weight: bold;text-decoration: underline;">EDITAR FORMA DE RECEPCIÓN</h4>
  
          </div> 
          <div class="modal-body">
            <input type="hidden" id="idServicio" value="0">
  
            <div class="row">
  
              <div class="box" id="o" style="border:0px; box-shadow:none;" >
                <div class="box-header with-border">
                  <h3 class="box-title" id="boxTitulo">Forma de Recepción:</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
  
                <div class="box-body">


                    <div class="col-md-12" >
    
                        <div class="form-group">
                          <label for="txtunidaorgE" class="col-sm-2 control-label">Unidad Orgánica:*</label>
                
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="txtunidaorgE" name="txtunidaorgE" placeholder="Descripción" maxlength="500" autofocus v-model="fillunidadorganica.nombre" required>
                          </div>
                        </div>
                      </div>
              
              
                      <div class="col-md-12" style="padding-top: 15px;">
                
                          <div class="form-group">
                            <label for="txtsiglasE" class="col-sm-2 control-label">SIGLAS de la Unidad:*</label>
                  
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="txtsiglasE" name="txtsiglasE" placeholder="SIGLAS" maxlength="45"  v-model="fillunidadorganica.siglas">
                            </div>
                          </div>
                        </div>
              
                        <div class="col-md-12" style="padding-top: 15px;">
                
                            <div class="form-group">
                              <label for="txtcodigoE" class="col-sm-2 control-label">Código:*</label>
                    
                              <div class="col-sm-8">
                                <input type="text" class="form-control" id="txtcodigoE" name="txtcodigoE" placeholder="Código" maxlength="45"  v-model="fillunidadorganica.codigo">
                              </div>
                            </div>
                          
                          </div>
              
                
                
                      <div class="col-md-12" style="padding-top: 15px;">
                        <div class="form-group">
                          <label for="cbuestadoE" class="col-sm-2 control-label">Estado:*</label>
                          <div class="col-sm-4">
                            <select class="form-control" id="cbuestadoE" name="cbuestadoE" v-model="fillunidadorganica.activo">
                              <option value="1">Activado</option>
                              <option value="0">Desactivado</option>
                            </select>
                          </div>
                        </div>
                      </div>
  

  
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" id="btnSaveE"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
  
              <button type="button" id="btnCancelE" class="btn btn-default" data-dismiss="modal"><i class="fa fa-sign-out" aria-hidden="true"></i> Cerrar</button>
  
              <div class="sk-circle" v-show="divloaderEdit">
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
          </div>
        </div>
      </div>
    </div>
  </div>
  </form>
  