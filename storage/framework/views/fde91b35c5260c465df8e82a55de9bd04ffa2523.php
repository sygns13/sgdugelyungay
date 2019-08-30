
  
    <div class="box box-success">
      <div class="box-header with-border" >
        <h3 class="box-title" id="tituloAgregar">Complete el Formulario para Inicializar un Trámite</h3>

        <a style="float: right;    margin-left: 10px;" type="button" class="btn btn-warning" href="<?php echo e(URL::to('reghistoricos')); ?>"><i class="fa fa-archive" aria-hidden="true"></i> 
          Registros Históricos</a>

        <a style="float: right;" type="button" class="btn btn-info" href="<?php echo e(URL::to('mistramites')); ?>"><i class="fa fa-search" aria-hidden="true"></i> 
          Seguimiento de Trámites</a>

          
      </div>
  
      <form v-on:submit.prevent="create">
       <div class="box-body">


          <table width="100%" height="81%" border="0" cellpadding="0" cellspacing="10" class="backform">
              <tbody>
                <tr style="height: 30px;"><td></td></tr><tr>
  
                <td valign="top" style="border-right: 2px #006699 solid;"> 
              <table class="frmline" width="720" align="center" border="0" cellpadding="0" cellspacing="0">
          
                <tbody><tr>
                  <td colspan="7" style="    border-right: 2px #006699 solid;">
                    <table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
                    <tbody><tr>
                      <td width="100%" colspan="3">
                            <table width="100%" cellspacing="0" cellpadding="3" border="0">
                    <tbody><tr>
                                          <th bgcolor="#6600FF" width="20%" align="left">
                                  </th>
                      <th width="70%" height="26">
                      DOCUMENTOS EN PROCESO :: [Nuevo Registro]				</th>	
                          <th width="25%" align="right">
                                
                            </th>				
                      </tr>
                      </tbody></table>
                      </td>
                    </tr>
                    </tbody></table>
                    </td></tr>
  

                    <tr>
                        <td colspan="5" style="    border-right: 2px #006699 solid;"><table cellspacing="0" border="0" cellpadding="0"><tbody><tr><td width="10" background="<?php echo e(asset('/img/sisgedo/titulo1.jpg')); ?>" height="10">&nbsp;</td><td width="90%" align="left" class="marco seccion">&nbsp;DATOS DEL REGISTRO</td><td background="<?php echo e(asset('/img/sisgedo/titulo3.jpg')); ?>" height="20" align="right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr></tbody></table></td>
                    </tr>	
  

  
                    <tr valign="middle">
                        <td width="1%" class="marco">&nbsp;</td>	
                          <td width="22%" class="etiqueta" align="right">Prioridad&nbsp;&nbsp;</td>
                          <td width="1%" class="objeto">&nbsp;</td>
                          <td width="78%" class="objeto">	

                          <select class="cajatexto" id="cbuprioridad" name="cbuprioridad" v-model="newPrioridad" style="width: 160px;">
                                  <option v-for="prioridad, key in prioridads"  v-bind:value="prioridad.id">{{prioridad.prioridad}}</option>
                  
                          </select>
                        </td>
                          <td width="1%" class="objeto" style="    border-right: 2px #006699 solid;">&nbsp;</td>
                    </tr>
  
  
                    <tr><td colspan="5" style="    border-right: 2px #006699 solid;" class="marco seccionblank">&nbsp;</td></tr>
                    <tr>
                        <td colspan="5" style="    border-right: 2px #006699 solid;"><table cellspacing="0" border="0" cellpadding="0"><tbody><tr><td width="10" background="<?php echo e(asset('/img/sisgedo/titulo1.jpg')); ?>" height="10">&nbsp;</td><td width="90%" align="left" class="marco seccion">&nbsp;ORIGEN</td><td background="<?php echo e(asset('/img/sisgedo/titulo3.jpg')); ?>" height="20" align="right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr></tbody></table></td>
                    </tr>	
  
       
                    <tr valign="middle">
                        <td width="1%" class="marco" >&nbsp;</td>	
                          <td width="22%" class="etiqueta" align="right">Entidad&nbsp;&nbsp;</td>
                          <td width="1%" class="objeto">&nbsp;</td>
                          <td width="78%" class="objeto" valign="top">	
                                                     
              
                             <input type="text" class="cajatexto" id="txtcodEntidad" name="txtcodEntidad" placeholder="" maxlength="20" v-model="codEntidad" style="width: 100px; display:inline-block;" onkeypress="return soloNumeros(event);" @keyup="$event.keyCode === 13 ? buscarEntidad() : false" size="6">
  
                           <img src="<?php echo e(asset('/img/sisgedo/search.gif')); ?>" alt="Buscar" height="14" width="16" border="0" style="cursor:pointer" @click.prevent="buscarEntidad()"> 
                          &nbsp; <br>
  
                              <select class="cajatexto" id="cbuentidad" name="cbuentidad" v-model="newentidad" style="width: 470px;" @change="cambiocbu">
                                  <option value="0" disabled>------ Seleccione Opción ------</option>
                                  <template v-for="entidad, key in entidads">
                                    <option   v-bind:value="entidad.id">{{entidad.nombre}} - ({{entidad.codigo}})</option>
            
                                    <input type="hidden" class="clsentidades" v-bind:id="'ident'+entidad.id" v-bind:value="entidad.codigo">
                                    <input type="hidden" class="clssiglasentidades" v-bind:id="'idsigent'+entidad.id" v-bind:value="entidad.siglas">
            
                                  </template>
                                </select>
                        </td>
                          <td width="1%" class="objeto" style="    border-right: 2px #006699 solid;">&nbsp;</td>
                    </tr>	
  
  
                    <tr valign="middle">
                        <td width="1%" class="marco" >&nbsp;</td>	
                          <td width="22%" class="etiqueta" align="right">Detalle&nbsp;&nbsp;</td>
                          <td width="1%" class="objeto">&nbsp;</td>
                          <td width="78%" class="objeto" >	
                                                    
                          <input type="text" class="cajatexto" id="txtdetalle" name="txtdetalle" placeholder="" maxlength="500" v-model="newDetalle" size="53">
                          &nbsp;
  
                            </td>
                          <td width="1%" class="objeto" style="    border-right: 2px #006699 solid;">&nbsp;</td>
                    </tr>	
  
                    <tr valign="middle">
                        <td width="1%" class="marco" >&nbsp;</td>	
                          <td width="22%" class="etiqueta" align="right">Firma&nbsp;&nbsp;</td>
                          <td width="1%" class="objeto">&nbsp;</td>
                          <td width="78%" class="objeto" >	
  
                           <input type="text" class="cajatexto" id="txtfirma" name="txtfirma" placeholder="" maxlength="500" v-model="newfirma" size="53">
                          &nbsp;
  
                            </td>
                          <td width="1%" class="objeto" style="    border-right: 2px #006699 solid;">&nbsp;</td>
                    </tr>	
  
                    <tr valign="middle">
                        <td width="1%" class="marco" >&nbsp;</td>	
                          <td width="22%" class="etiqueta" align="right">Cargo&nbsp;&nbsp;</td>
                          <td width="1%" class="objeto">&nbsp;</td>
                          <td width="78%" class="objeto" >	
                                                     
                           <input type="text" class="cajatexto" id="txtcargo" name="txtcargo" placeholder="" maxlength="500" v-model="newcargo" size="53">
                           &nbsp;
  
                            </td>
                          <td width="1%" class="objeto" style="    border-right: 2px #006699 solid;">&nbsp;</td>
                    </tr>	
  
  
                    <tr><td colspan="5" style="    border-right: 2px #006699 solid;" class="marco seccionblank">&nbsp;</td></tr>
                    <tr>
                        <td colspan="5" style="    border-right: 2px #006699 solid;"><table cellspacing="0" border="0" cellpadding="0"><tbody><tr><td width="10" background="<?php echo e(asset('/img/sisgedo/titulo1.jpg')); ?>" height="10">&nbsp;</td><td width="90%" align="left" class="marco seccion">&nbsp;DATOS DEL DOCUMENTO</td><td background="<?php echo e(asset('/img/sisgedo/titulo3.jpg')); ?>" height="20" align="right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr></tbody></table></td>
                    </tr>	
  
                    <tr valign="middle">
                        <td width="1%" class="marco" >&nbsp;</td>	
                          <td width="22%" class="etiqueta" align="right">Fecha de Documento&nbsp;&nbsp;</td>
                          <td width="1%" class="objeto">&nbsp;</td>
                          <td width="78%" class="objeto" >	    									
  
                           <input type="date"  id="txtfecha" name="txtfecha" placeholder="dd/mm/aaaa" maxlength="10" v-model="newfecha" required size="10" style="line-height: 1;">
                            </td>
                          <td width="1%" class="objeto" style="    border-right: 2px #006699 solid;">&nbsp;</td>
                    </tr>	
  
  
                    <tr valign="middle">
                        <td width="1%" class="marco">&nbsp;</td>	
                          <td width="22%" class="etiqueta" align="right">Tipo de Documento&nbsp;&nbsp;</td>
                          <td width="1%" class="objeto">&nbsp;</td>
                          <td width="78%" class="objeto">	
                                           
                        <select class="cajatexto" id="cbuTipoDoc" name="cbuTipoDoc" v-model="newtipodoc" style="width: 300px;">
                            <option value="0" disabled>Seleccione Tipo de Documento</option>
                            <option v-for="tipodoc, key in tipodocumentos"  v-bind:value="tipodoc.id">{{tipodoc.tipo}}</option>
                          </select>

                        </td>
                          <td width="1%" class="objeto" style="    border-right: 2px #006699 solid;">&nbsp;</td>
                    </tr>
  
  
  
                    <tr valign="middle">
                        <td width="1%" class="marco" >&nbsp;</td>	
                          <td width="22%" class="etiqueta" align="right">Número y Siglas&nbsp;&nbsp;</td>
                          <td width="1%" class="objeto">&nbsp;</td>
                          <td width="78%" class="objeto" valign="top">	
                                                     
                        <input type="text" class="cajatexto" id="txtnumero" name="txtnumero" placeholder="" maxlength="20" v-model="newNumero" required size="10">

                        <input type="text" class="cajatexto" id="txtsiglas" name="txtsiglas" placeholder="" maxlength="500" v-model="newSiglas" required size="53">


  
                        </td>
                          <td width="1%" class="objeto" style="    border-right: 2px #006699 solid;">&nbsp;</td>
                    </tr>	
   
                    <tr valign="middle">
                        <td width="1%" class="marco" >&nbsp;</td>	
                          <td width="22%" class="etiqueta" align="right">Archivo&nbsp;&nbsp;</td>
                          <td width="1%" class="objeto">&nbsp;</td>
                          <td width="78%" class="objeto" >
                              <input v-if="uploadReady" name="archivo2" type="file" id="archivo" class="archivo" @change="getArchivo" 
                              accept=".pdf, .doc, .docx, .xls, .xlsx, ppt, .pptx, .PDF, .DOC, .DOCX, .XLS, .XLSX, .PPT, .PTTX"/>

  
                            </td>
                          <td width="1%" class="objeto" style="    border-right: 2px #006699 solid;">&nbsp;</td>
                    </tr>	

  
  
  
                    <tr valign="middle">
                        <td width="1%" class="marco" >&nbsp;</td>	
                          <td width="22%" class="etiqueta" align="right">Folios&nbsp;&nbsp;</td>
                          <td width="1%" class="objeto">&nbsp;</td>
                          <td width="78%" class="objeto" valign="top">	
  
                        <input type="text" class="cajatexto" id="txtfolios" name="txtfolios" placeholder="" maxlength="20" v-model="newFolios" required size="10">

                        </td>
                          <td width="1%" class="objeto" style="    border-right: 2px #006699 solid;">&nbsp;</td>
                    </tr>	
  
  
  
                    <tr valign="middle">
                        <td width="1%" class="marco">&nbsp;</td>	
                          <td width="22%" class="etiqueta" align="right">Asunto&nbsp;&nbsp;</td>
                          <td width="1%" class="objeto">&nbsp;</td>
                          <td width="78%" class="objeto">	
                            <textarea name="txtasunto" id="txtasunto" cols="60" rows="4" class="cajatexto" v-model="newAsunto"></textarea>
                          </td>
                          <td width="1%" class="objeto" style="    border-right: 2px #006699 solid;">&nbsp;</td>
                    </tr>
  


  
  
  
                    <tr><td colspan="5" style="    border-right: 2px #006699 solid;" class="marco seccionblank">&nbsp;</td></tr>
                    <tr>
                        <td colspan="5" style="    border-right: 2px #006699 solid;"><table cellspacing="0" border="0" cellpadding="0"><tbody><tr><td width="10" background="<?php echo e(asset('/img/sisgedo/titulo1.jpg')); ?>" height="10">&nbsp;</td><td width="90%" align="left" class="marco seccion">&nbsp;DESTINO(S) - DERIVACION DEL DOCUMENTO</td><td background="<?php echo e(asset('/img/sisgedo/titulo3.jpg')); ?>" height="20" align="right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr></tbody></table></td>
                    </tr>	
  
  
                    <tr valign="middle">
                        <td width="1%" class="marco" >&nbsp;</td>	
                          <td width="22%" class="etiqueta" align="right">Forma&nbsp;&nbsp;</td>
                          <td width="1%" class="objeto">&nbsp;</td>
                          <td width="78%" class="objeto" valign="top">	
  
  
                              <label for="radioInterno" style="color: #006699!important;">Copia</label>
                                                     
                              <input type="checkbox" id="CHECKFORMA" v-model="newForma" style="display:inline-block;">

  
  
                        </td>
                          <td width="1%" class="objeto" style="    border-right: 2px #006699 solid;">&nbsp;</td>
                    </tr>	
  
  
  
                    <tr valign="middle">
                        <td width="1%" class="marco" >&nbsp;</td>	
                          <td width="22%" class="etiqueta" align="right">Unidad Orgánica&nbsp;&nbsp;</td>
                          <td width="1%" class="objeto">&nbsp;</td>
                          <td width="78%" class="objeto" valign="top">	
                                                                         
                             <input type="text" class="cajatexto" id="txtUnidadOrganica" name="txtUnidadOrganica" placeholder="" maxlength="20" v-model="codUndOrg"  style="width: 100px; display:inline-block;" onkeypress="return soloNumeros(event);" @keyup="$event.keyCode === 13 ? buscarUnidadOrganica() : false" size="6">


  
                           <img src="<?php echo e(asset('/img/sisgedo/search.gif')); ?>" alt="Buscar" height="14" width="16" border="0" style="cursor:pointer" @click.prevent="buscarUnidadOrganica()"> 
                       
                    <select class="cajatexto" id="cbuUnidadOrganica" name="cbuUnidadOrganica" v-model="newUnidadOrganica" style="width:450px;">
                      <option value="0" disabled>Seleccione Unidad Orgánica</option>
                      <template v-for="unidadorg, key in unidadorganicas">
                          <option   v-bind:value="unidadorg.id">{{unidadorg.nombre}} - ({{unidadorg.codigo}})</option>
                          <input type="hidden" class="clsunidadorges" v-bind:id="'idorg'+unidadorg.id" v-bind:value="unidadorg.codigo">
                        </template>
                    </select>


  
                        </td>
                          <td width="1%" class="objeto" style="    border-right: 2px #006699 solid;">&nbsp;</td>
                    </tr>	
  
  
  
  
                    <tr valign="middle">
                        <td width="1%" class="marco" >&nbsp;</td>	
                          <td width="22%" class="etiqueta" align="right">Detalle&nbsp;&nbsp;</td>
                          <td width="1%" class="objeto">&nbsp;</td>
                          <td width="78%" class="objeto" valign="top">	
                             <input type="text" class="cajatexto" id="txtDetalleUO" name="txtDetalleUO" placeholder="" maxlength="500" v-model="newDetalleDestino" size="60"> 
                        </td>
                          <td width="1%" class="objeto" style="    border-right: 2px #006699 solid;">&nbsp;</td>
                    </tr>	
  
                    <tr><td colspan="5" style="    border-right: 2px #006699 solid;" class="marco seccionblank">&nbsp;</td></tr>
  
  
                    
  
  
  
  
  
  
  
  
  
  
             
                    
  
  
  
                    
              
              </tbody></table>
              </td></tr>
              <tr style="height: 30px;"><td></td></tr><tr>
              </tbody></table>










































      </div>
  
      <!-- /.box-body -->
      <div class="box-footer">
        <button type="submit" class="btn btn-primary" id="btnGuardar"><i class="fa fa-save" aria-hidden="true"></i>  Registrar</button>
  
        <button type="reset" class="btn btn-warning" id="btnCancel" @click.prevent="cancelForm()"><i class="fa fa-times" aria-hidden="true"></i>  Cancelar</button>
  
        
  
        <template v-if="divloaderNuevo">
            <h3>Cargando Datos, Por favor espere hasta que la carga concluya ...</h3>
        <div class="sk-circle" >
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

      </template>
  
      </div>
      <!-- /.box-footer -->
  
    </form>
  </div>
  
  
  