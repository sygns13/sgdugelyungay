
  
    <div class="box box-success">
      <div class="box-header with-border" >
        <h3 class="box-title" id="tituloAgregar">Complete el Formulario para Inicializar un Trámite</h3>
      </div>
  
      <form v-on:submit.prevent="create">
       <div class="box-body">

          <div class="col-md-12" style="padding-bottom: 15px; "> <h4 style="font-weight:bold; font-size:16px;">DATOS DEL REGISTRO</h4> </div>
  
        <div class="col-md-12" >
  
          <div class="form-group">
            <label for="cbuprioridad" class="col-sm-2 control-label">PRIORIDAD:*</label>
  
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


        <div class="col-md-12" >
  
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
        </div>


        <div class="col-md-12" style="padding-top: 15px;" >
  
            <div class="form-group">
              <label for="checktipo" class="col-sm-2 control-label">TIPO:</label>
    
              <div class="col-sm-8">
                 <label for="checktipo" style="display:inline-block;">Documento Personal:</label>  <input type="checkbox" id="checktipo" v-model="newTipo" style="display:inline-block;">
              </div>
            </div>
          </div>


          <div class="col-md-12" style="padding-top: 15px;">
              <div class="form-group">
                <label for="txtUnidadDestino" class="col-sm-2 control-label">UNIDAD ORGÁNICA:*</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="txtUnidadDestino" name="txtUnidadDestino" placeholder="" maxlength="500" v-model="newUnidadDestino" required>
                  </div>
                </div>
              </div>
           

        <div class="col-md-12" style="padding-top: 15px;">
  
            <div class="form-group">
              <label for="txtfirma" class="col-sm-2 control-label">FIRMA:*</label>
    
              <div class="col-sm-8">
                <input type="text" class="form-control" id="txtfirma" name="txtfirma" placeholder="" maxlength="500" v-model="newfirma" required>
              </div>
            </div>
          </div>

          <div class="col-md-12" style="padding-top: 15px;">
  
              <div class="form-group">
                <label for="txtcargo" class="col-sm-2 control-label">CARGO:*</label>
      
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="txtcargo" name="txtcargo" placeholder="" maxlength="500" v-model="newcargo" required>
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
                        <label for="cbuFormaRecep" class="col-sm-2 control-label">FORMA DE RECEPCIÓN:*</label>
                        <div class="col-sm-4">
                          <select class="form-control" id="cbuFormaRecep" name="cbuFormaRecep" v-model="newForma">
                            <option value="0" disabled>Seleccione Forma de Recepción</option>
                            <option v-for="formarep, key in formarecepcions"  v-bind:value="formarep.id">{{formarep.forma}}</option>
                          </select>
                        </div>
                      </div>
                    </div>


                    <div class="col-md-12" style="padding-top: 15px;">
  
                        <div class="form-group">
                          <label for="archivo" class="col-sm-2 control-label">ARCHIVO:*</label>
                
                          <div class="col-sm-4">
                              <input v-if="uploadReady" name="archivo2" type="file" id="archivo" class="archivo form-control" required @change="getArchivo" 
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

                                <textarea name="txtasunto" id="txtasunto" rows="4" class="form-control" v-model="newAsunto" required></textarea>
                              </div>
                            </div>
                          </div>
    
  
                          <div class="col-md-12" >
                              <hr>
                            </div>

       <div class="col-md-12" style="padding-bottom: 15px; "> <h4 style="font-weight:bold; font-size:16px;">CLASIFICACIÓN TUPA</h4> </div>


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
                  <div class="col-sm-4">
                    <select class="form-control" id="cbuUnidadOrganica" name="cbuUnidadOrganica" v-model="newUnidadOrganica">
                      <option value="0" disabled>Seleccione Unidad Orgánica</option>
                      <option v-for="unidadorg, key in unidadorganicas"  v-bind:value="unidadorg.id">{{unidadorg.nombre}}</option>
                    </select>
                  </div>
                </div>
              </div>



              <div class="col-md-12" style="padding-top: 15px;">
  
                  <div class="form-group">
                    <label for="txtDetalle" class="col-sm-2 control-label">DETALLE:*</label>
          
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="txtDetalle" name="txtDetalle" placeholder="" maxlength="500" v-model="newDetalle" >
                    </div>
                  </div>
                </div>


                <div class="col-md-12" style="padding-top: 15px;">
  
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
  
  
  

  
  