{{--  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Formulario de Solicitud de Trámite</h3>
    </div>
  
    <div class="box-body">

      
      <div class="form-group">
        <button type="button" class="btn btn-primary" id="btncrearArea" @click.prevent="nuevo()"><i class="fa fa-plus-square-o" aria-hidden="true" ></i> Nuevo Registro</button>
      </div>
  
  
  
      
        <div class="box-footer">
          <button type="button" class="btn btn-primary" onclick="enviarMSj();" id="btnEnviarMsj"><i class="fa fa-envelope-o" aria-hidden="true" ></i> Enviar Mensaje</button>
          <div id="divCarga0" style="display: inline-block;"><div id="dcarga0" style="display: none;"><img src="{{ asset('/img/ajax-loader.gif')}}"/></div></div>
        </div>
        
  
      </div>
  
    </div>--}}
  
    <div class="box box-success">
      <div class="box-header with-border" >
        <h3 class="box-title" id="tituloAgregar">Complete el Formulario para Inicializar un Trámite</h3>
      </div>
  
      <form v-on:submit.prevent="create">
       <div class="box-body">

          <div class="col-md-12" style="padding-bottom: 15px; "> <h4 style="font-weight:bold; font-size:16px;">DATOS DEL REGISTRO</h4> </div>
  
        <div class="col-md-12" >
  
          <div class="form-group">
            <label for="cbuprioridad" class="col-sm-2 control-label">PRIORIDAD:</label>
  
            <div class="col-sm-2">
                <select class="form-control" id="cbuprioridad" name="cbuprioridad" v-model="newPrioridad">
                <option v-for="prioridad, key in prioridads"  v-bind:value="prioridad.id">@{{prioridad.prioridad}}</option>

                </select>
              </div>
          </div>
        </div>

        <div class="col-md-12" >
          <hr>
        </div>
        <div class="col-md-12" style="padding-bottom: 15px; "> <h4 style="font-weight:bold; font-size:16px;">ORIGEN</h4> </div>


       {{--  <div class="col-md-12" >
  
          <div class="form-group">
            <label for="radioOrigen" class="col-sm-2 control-label">ORIGEN:*</label>
  
            <div class="col-sm-1">
                <input type="radio" id="radioInterno" value="1" v-model="newOrigen">
                <label for="radioInterno">Interno</label>
             
            </div>

            <div class="col-sm-1">
                <input type="radio" id="radioExterno" value="2" v-model="newOrigen">
                <label for="radioExterno">Externo</label>
             
            </div>
          </div>
        </div> --}}


      {{--   <div class="col-md-12" style="padding-top: 15px;" >
  
            <div class="form-group">
              <label for="checktipo" class="col-sm-2 control-label">TIPO:</label>
    
              <div class="col-sm-8">
                 <label for="checktipo" style="display:inline-block;">Documento Personal:</label>  <input type="checkbox" id="checktipo" v-model="newTipo" style="display:inline-block;">
              </div>
            </div>
          </div>
 --}}

          <div class="col-md-12" style="padding-top: 15px;">
              <div class="form-group">
                <label for="txtcodEntidad" class="col-sm-2 control-label">ENTIDAD:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="txtcodEntidad" name="txtcodEntidad" placeholder="" maxlength="20" v-model="codEntidad" style="width: 100px; display:inline-block;" onkeypress="return soloNumeros(event);" @keyup="$event.keyCode === 13 ? buscarEntidad() : false">

                    <button type="button" class="btn btn-warning" id="btnBuscarEntidad" style="display:inline-block;margin-bottom: 5px;" @click.prevent="buscarEntidad()"><i class="fa fa-search"></i></button>

                    <select class="form-control" id="cbuentidad" name="cbuentidad" v-model="newentidad">
                      <option value="0" disabled>------ Seleccione Opción ------</option>
                      <template v-for="entidad, key in entidads">
                        <option   v-bind:value="entidad.id">@{{entidad.nombre}} - (@{{entidad.codigo}})</option>

                        <input type="hidden" class="clsentidades" v-bind:id="'ident'+entidad.id" v-bind:value="entidad.codigo">

                      </template>
                    </select>

                  </div>
                </div>
              </div>




              <div class="col-md-12" style="padding-top: 15px;">
  
                <div class="form-group">
                  <label for="txtdetalle" class="col-sm-2 control-label">DETALLE:</label>
        
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="txtdetalle" name="txtdetalle" placeholder="" maxlength="500" v-model="newDetalle" >
                  </div>
                </div>
              </div>
           

        <div class="col-md-12" style="padding-top: 15px;">
  
            <div class="form-group">
              <label for="txtfirma" class="col-sm-2 control-label">FIRMA:</label>
    
              <div class="col-sm-8">
                <input type="text" class="form-control" id="txtfirma" name="txtfirma" placeholder="" maxlength="500" v-model="newfirma" >
              </div>
            </div>
          </div>

          <div class="col-md-12" style="padding-top: 15px;">
  
              <div class="form-group">
                <label for="txtcargo" class="col-sm-2 control-label">CARGO:</label>
      
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="txtcargo" name="txtcargo" placeholder="" maxlength="500" v-model="newcargo" >
                </div>
              </div>
            </div>


            <div class="col-md-12" >
                <hr>
              </div>

            <div class="col-md-12" style="padding-bottom: 15px; "> <h4 style="font-weight:bold; font-size:16px;">DATOS DEL DOCUMENTO</h4> </div>


            <div class="col-md-12" >
  
                <div class="form-group">
                  <label for="txtfecha" class="col-sm-2 control-label">FECHA:*</label>
        
                  <div class="col-sm-2">
                    <input type="date" class="form-control" id="txtfecha" name="txtfecha" placeholder="dd/mm/aaaa" maxlength="10" v-model="newfecha" required>
                  </div>
                </div>
              </div>


              <div class="col-md-12" style="padding-top: 15px;">
                  <div class="form-group">
                    <label for="cbuTipoDoc" class="col-sm-2 control-label">TIPO DE DOCUMENTO:*</label>
                    <div class="col-sm-4">
                      <select class="form-control" id="cbuTipoDoc" name="cbuTipoDoc" v-model="newtipodoc">
                        <option value="0" disabled>Seleccione Tipo de Documento</option>
                        <option v-for="tipodoc, key in tipodocumentos"  v-bind:value="tipodoc.id">@{{tipodoc.tipo}}</option>
                      </select>
                    </div>
                  </div>
                </div>


                <div class="col-md-12" style="padding-top: 15px;">
  
                    <div class="form-group">
                      <label for="txtnumero" class="col-sm-2 control-label">NÚMERO Y SIGLAS:*</label>
            
                      <div class="col-sm-1">
                        <input type="text" class="form-control" id="txtnumero" name="txtnumero" placeholder="" maxlength="20" v-model="newNumero" required>
                      </div>

                      <div class="col-sm-7">
                          <input type="text" class="form-control" id="txtsiglas" name="txtsiglas" placeholder="" maxlength="500" v-model="newSiglas" required>
                        </div>
                    </div>
                  </div>

                {{--   <div class="col-md-12" style="padding-top: 15px;">
                      <div class="form-group">
                        <label for="cbuFormaRecep" class="col-sm-2 control-label">FORMA DE RECEPCIÓN:*</label>
                        <div class="col-sm-4">
                          <select class="form-control" id="cbuFormaRecep" name="cbuFormaRecep" v-model="newForma">
                            <option value="0" disabled>Seleccione Forma de Recepción</option>
                            <option v-for="formarep, key in formarecepcions"  v-bind:value="formarep.id">@{{formarep.forma}}</option>
                          </select>
                        </div>
                      </div>
                    </div> --}}


                    <div class="col-md-12" style="padding-top: 15px;">
  
                        <div class="form-group">
                          <label for="archivo" class="col-sm-2 control-label">ARCHIVO:*</label>
                
                          <div class="col-sm-4">
                              <input v-if="uploadReady" name="archivo2" type="file" id="archivo" class="archivo form-control" @change="getArchivo" 
                              accept=".pdf, .doc, .docx, .xls, .xlsx, ppt, .pptx, .PDF, .DOC, .DOCX, .XLS, .XLSX, .PPT, .PTTX"/>
                          </div>
                        </div>
                      </div>


                      <div class="col-md-12" style="padding-top: 15px;">
  
                          <div class="form-group">
                            <label for="txtfolios" class="col-sm-2 control-label">FOLIOS:*</label>
                  
                            <div class="col-sm-2">
                              <input type="text" class="form-control" id="txtfolios" name="txtfolios" placeholder="" maxlength="20" v-model="newFolios" required>
                            </div>
                          </div>
                        </div>


                        <div class="col-md-12" style="padding-top: 15px;">
  
                            <div class="form-group">
                              <label for="txtasunto" class="col-sm-2 control-label">ASUNTO:*</label>
                    
                              <div class="col-sm-8">

                                <textarea name="txtasunto" id="txtasunto" rows="4" class="form-control" v-model="newAsunto"></textarea>
                              </div>
                            </div>
                          </div>
    
  
                          <div class="col-md-12" >
                              <hr>
                            </div>

     {{--   <div class="col-md-12" style="padding-bottom: 15px; "> <h4 style="font-weight:bold; font-size:16px;">CLASIFICACIÓN TUPA</h4> </div>


       <div class="col-md-12" style="padding-top: 15px;">
  
          <div class="form-group">
            <label for="radioOrigen" class="col-sm-2 control-label">CLASIFICACIÓN:*</label>
  
            <div class="col-sm-2">
                <input type="radio" id="radioSilencioPositivo" value="1" v-model="newClasificacion">
                <label for="radioSilencioPositivo">Silencio Positivo</label>
             
            </div>

            <div class="col-sm-2">
                <input type="radio" id="radioSilencioNegativo" value="2" v-model="newClasificacion">
                <label for="radioSilencioNegativo">Silencio Negativo</label>
             
            </div>

            <div class="col-sm-2">
                <input type="radio" id="radioAutomatico" value="3" v-model="newClasificacion">
                <label for="radioAutomatico">Automático</label>
             
            </div>

            <div class="col-sm-2">
                <input type="radio" id="radioNinguna" value="4" v-model="newClasificacion">
                <label for="radioNinguna">Ninguna</label>
             
            </div>
          </div>
        </div>



        <div class="col-md-12" style="padding-top: 15px;">
  
            <div class="form-group">
              <label for="txtnumdias" class="col-sm-2 control-label"># de Días de Atención:*</label>
    
              <div class="col-sm-2">
                <input type="text" class="form-control" id="txtnumdias" name="txtnumdias" placeholder="" maxlength="20" v-model="newDias" required>
              </div>
            </div>
          </div> 

          <div class="col-md-12" >
              <hr>
            </div>--}}

          <div class="col-md-12" style="padding-bottom: 15px; "> <h4 style="font-weight:bold; font-size:16px;">DESTINO(S) - DERIVACIÓN DEL DOCUMENTO</h4> </div>


          <div class="col-md-12" >
  
              <div class="form-group">
                <label for="checkforma" class="col-sm-2 control-label">FORMA:</label>
      
                <div class="col-sm-8">
                   <label for="checkforma" style="display:inline-block;">Copia:</label>  <input type="checkbox" id="CHECKFORMA" v-model="newForma" style="display:inline-block;">
                </div>
              </div>
            </div>


            <div class="col-md-12" style="padding-top: 15px;">
                <div class="form-group">
                  <label for="cbuUnidadOrganica" class="col-sm-2 control-label">UNIDAD ORGÁNICA:*</label>
                  <div class="col-sm-8">

                      <input type="text" class="form-control" id="cbuUnidadOrganica" name="cbuUnidadOrganica" placeholder="" maxlength="20" v-model="codUndOrg" required style="width: 100px; display:inline-block;" onkeypress="return soloNumeros(event);" @keyup="$event.keyCode === 13 ? buscarUnidadOrganica() : false">


                      <button type="button" class="btn btn-warning" id="btnBuscarUnidOrg" style="display:inline-block;margin-bottom: 5px;" @click.prevent="buscarUnidadOrganica()"><i class="fa fa-search"></i></button>


                    <select class="form-control" id="cbuUnidadOrganica" name="cbuUnidadOrganica" v-model="newUnidadOrganica" style="display:inline-block; width: 80%;">
                      <option value="0" disabled>Seleccione Unidad Orgánica</option>
                      <template v-for="unidadorg, key in unidadorganicas">
                          <option   v-bind:value="unidadorg.id">@{{unidadorg.nombre}} - (@{{unidadorg.codigo}})</option>
  
                          <input type="hidden" class="clsunidadorges" v-bind:id="'idorg'+unidadorg.id" v-bind:value="unidadorg.codigo">
  
                        </template>



                    </select>
                  </div>
                </div>
              </div>



              <div class="col-md-12" style="padding-top: 15px;">
  
                  <div class="form-group">
                    <label for="txtDetalleUO" class="col-sm-2 control-label">DETALLE:*</label>
          
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="txtDetalleUO" name="txtDetalleUO" placeholder="" maxlength="500" v-model="newDetalleDestino" >
                    </div>
                  </div>
                </div>


{{--                 <div class="col-md-12" style="padding-top: 15px;">
  
                    <div class="form-group">
                      <label for="txtusuario" class="col-sm-2 control-label">USUARIO:*</label>
            
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="txtusuario" name="txtusuario" placeholder="" maxlength="500" v-model="newUsuario" >
                      </div>
                    </div>
                  </div>



                <div class="col-md-12" style="padding-top: 15px;">
  
                    <div class="form-group">
                      <label for="txtproveido" class="col-sm-2 control-label">PROVEIDO DE ATENCIÓN:*</label>
            
                      <div class="col-sm-8">

                        <textarea name="txtproveido" id="txtproveido" rows="4" class="form-control" v-model="newProveido" ></textarea>
                      </div>
                    </div>
                  </div> --}}



      </div>
  
      <!-- /.box-body -->
      <div class="box-footer">
        <button type="submit" class="btn btn-info" id="btnGuardar">Registrar</button>
  
        <button type="reset" class="btn btn-warning" id="btnCancel" @click="cancelForm()">Cancelar</button>
  
        {{-- <button type="button" class="btn btn-default" id="btnClose" @click.prevent="cerrarForm()">Cerrar</button> --}}
  
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
  
  