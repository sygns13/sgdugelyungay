
  
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
                <option v-for="prioridad, key in prioridads"  v-bind:value="prioridad.id">{{prioridad.prioridad}}</option>

                </select>
              </div>
          </div>
        </div>

        <div class="col-md-12" >
          <hr>
        </div>
        <div class="col-md-12" style="padding-bottom: 15px; "> <h4 style="font-weight:bold; font-size:16px;">ORIGEN</h4> </div>


       


      

          <div class="col-md-12" style="padding-top: 15px;">
              <div class="form-group">
                <label for="txtcodEntidad" class="col-sm-2 control-label">ENTIDAD:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="txtcodEntidad" name="txtcodEntidad" placeholder="" maxlength="20" v-model="codEntidad" style="width: 100px; display:inline-block;" onkeypress="return soloNumeros(event);" @keyup="$event.keyCode === 13 ? buscarEntidad() : false">

                    <button type="button" class="btn btn-warning" id="btnBuscarEntidad" style="display:inline-block;margin-bottom: 5px;" @click.prevent="buscarEntidad()"><i class="fa fa-search"></i></button>

                    <select class="form-control" id="cbuentidad" name="cbuentidad" v-model="newentidad">
                      <option value="0" disabled>------ Seleccione Opción ------</option>
                      <template v-for="entidad, key in entidads">
                        <option   v-bind:value="entidad.id">{{entidad.nombre}} - ({{entidad.codigo}})</option>

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
                        <option v-for="tipodoc, key in tipodocumentos"  v-bind:value="tipodoc.id">{{tipodoc.tipo}}</option>
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

                


                    <div class="col-md-12" style="padding-top: 15px;">
  
                        <div class="form-group">
                          <label for="archivo" class="col-sm-2 control-label">ARCHIVO:*</label>
                
                          <div class="col-sm-4">
                              <input v-if="uploadReady" name="archivo2" type="file" id="archivo" class="archivo form-control" @change="getArchivo" 
                              accept=".csv, .CSV "/>
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
                          <option   v-bind:value="unidadorg.id">{{unidadorg.nombre}} - ({{unidadorg.codigo}})</option>
  
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






      </div>
  
      <!-- /.box-body -->
      <div class="box-footer">
        <button type="submit" class="btn btn-info" id="btnGuardar">Registrar</button>
  
        <button type="reset" class="btn btn-warning" id="btnCancel" @click="cancelForm()">Cancelar</button>
  
        
  
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
  
  
  

  
  