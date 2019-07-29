<div class="box box-warning" id="divparte1">
  <div class="box-header with-border">
    <h3 class="box-title">Registros Históricos de Trámites</h3>
    <a style="float: right; margin-left:10px;" type="button" class="btn btn-default" href="<?php echo e(URL::to('home')); ?>"><i class="fa fa-reply-all" aria-hidden="true"></i> 
    Volver a Nuevo Trámite</a>

    <a style="float: right;" type="button" class="btn btn-info" href="<?php echo e(URL::to('mistramites')); ?>"><i class="fa fa-search" aria-hidden="true"></i> 
      Ver Trámites en Proceso</a>


  </div>

  <div class="box-body">
 

 <div class="box-tools">
  <div class="input-group input-group-sm" style="width: 700px;">
    <input type="text" name="table_search" class="form-control pull-right" placeholder="Buscar" v-model="buscar" @keyup.enter="buscarBtn()">

    <div class="input-group-btn">
      <button type="submit" class="btn btn-warning" @click.prevent="buscarBtn()"><i class="fa fa-search"></i> Buscar</button>
    </div>


  </div>
</div>


 

    </div>




  </div>



<div class="box box-warning" id="divparte2">
  <div class="box-header">
    <h3 class="box-title">Listado de Trámites Archivados</h3>


  </div>
  <!-- /.box-header -->
  <div class="box-body table-responsive">
    <table class="table table-hover table-bordered" >
      <tbody><tr>
        <th style="font-size: 11px; padding: 5px; width: 3%;">#</th>
        <th style="font-size: 11px; padding: 5px; width: 5%;">N° de Expediente</th>
        <th style="font-size: 11px; padding: 5px; width: 10%;">Tipo de Documento</th>
        <th style="font-size: 11px; padding: 5px; width: 13%;">N° y Siglas del Doc</th>
        <th style="font-size: 11px; padding: 5px; width: 17%;">Asunto</th>
        <th style="font-size: 11px; padding: 5px; width: 8%;">Fecha Registro</th>
        <th style="font-size: 11px; padding: 5px; width: 13%;">Origen</th>
        <th style="font-size: 11px; padding: 5px; width: 13%;">Destino</th>
        <th style="font-size: 11px; padding: 5px; width: 8%;">Estado</th>
        <th style="font-size: 11px; padding: 5px; width: 10%;">Gestión</th>
      </tr>
      <tr v-for="tramite, key in tramites">
        <td style="font-size: 11px; padding: 5px;">{{key+pagination.from}}</td>
        <td style="font-size: 11px; padding: 5px;" v-if="tramite.expediente=='' || tramite.expediente==null">Pendiente</td>
        <td style="font-size: 11px; padding: 5px; font-weight: bold; color:#0600ff;;" v-else>{{ tramite.expediente }}</td>
        <td style="font-size: 11px; padding: 5px;">{{ tramite.tipodocumento }}</td>
        <td style="font-size: 11px; padding: 5px;">{{ tramite.numero }} - {{ tramite.siglas }}</td>
        <td style="font-size: 11px; padding: 5px;">{{ tramite.asunto }}</td>
        <td style="font-size: 11px; padding: 5px;">{{ tramite.fecha | fecha }}</td>
        <td style="font-size: 11px; padding: 5px;">{{ tramite.entidad }}</td>
        <td style="font-size: 11px; padding: 5px;">{{ tramite.unidadorganica }}</td>

        <td style="font-size: 13    px; padding: 5px;">
            <span class="label label-info" v-if="tramite.estado=='1'">Solicitado</span>
            <span class="label label-warning" v-if="tramite.estado=='2'">Recepcionado</span>
            <span class="label label-primary" v-if="tramite.estado=='3'">Ingresado al SISGEDO</span>
            <span class="label label-success" v-if="tramite.estado=='4'">Atendido</span>
          </td>




       <td style="font-size: 11px; padding: 5px;">


          <a href="#" class="btn btn-info btn-sm" v-on:click.prevent="verTramite(tramite)" data-placement="top" data-toggle="tooltip" title="Ver Detalles del Trámite"><i class="fa fa-search"></i></a>
          
         <a href="http://181.65.149.146/sisgedonew/app/main.php" v-if="tramite.estado>1" class="btn btn-primary btn-sm" target="_blank" data-placement="top" data-toggle="tooltip" title="Realizar Seguimiento en el SISGEDO"><i class="fa fa-external-link"></i></a>

     
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
























 <div class="box box-success" id="divparte3" style="display:none">
    <div class="box-header with-border" >
      <h3 class="box-title" id="tituloAgregar">Detalles del Trámite:  {{tipodocumento}} {{numero}} - {{siglas}}

        <br><br>
          Estado:  
          <span style="font-size:100%;" class="label label-info" v-if="estado=='1'">Solicitado</span>
          <span style="font-size:100%;" class="label label-warning" v-if="estado=='2'">Recepcionado</span>
          <span style="font-size:100%;" class="label label-primary" v-if="estado=='3'">Ingresado al SISGEDO</span>
          <span style="font-size:100%;" class="label label-success" v-if="estado=='4'">Atendido</span>


     </h3>


      <button style="float: right;margin-left: 10px;" type="button" class="btn btn-default" @click.prevent="volverAtras"><i class="fa fa-reply-all" aria-hidden="true"></i> 
        Volver Atrás</button>

        
    </div>

    
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
                    DOCUMENTOS EN PROCESO :: [Detalles del Trámite]				</th>	
                        <th width="25%" align="right">
                              
                          </th>				
                    </tr>
                    </tbody></table>
                    </td>
                  </tr>
                  </tbody></table>
                  </td></tr>

                  <tr>
                    <td colspan="5" style="    border-right: 2px #006699 solid;"><table cellspacing="0" border="0" cellpadding="0"><tbody><tr><td width="10" background="<?php echo e(asset('/img/sisgedo/titulo1.jpg')); ?>" height="10">&nbsp;</td><td width="90%" align="left" class="marco seccion">&nbsp;EXPEDIENTE</td><td background="<?php echo e(asset('/img/sisgedo/titulo3.jpg')); ?>" height="20" align="right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr></tbody></table></td>
                  </tr>	

                  <tr valign="middle">
                      <td width="1%" class="marco" >&nbsp;</td>	
                        <td width="22%" class="etiqueta" align="right">Expediente&nbsp;&nbsp;</td>
                        <td width="1%" class="objeto">&nbsp;</td>
                        <td width="78%" class="objeto" >	
                               										
                         <input type="text" class="cajatexto txtmuestra" id="txtexpediente" name="txtexpediente" placeholder="" maxlength="500" v-model="expediente" readonly size="10">
                        &nbsp;

                          </td>
                        <td width="1%" class="objeto" style="    border-right: 2px #006699 solid;">&nbsp;</td>
                  </tr>	

                  <tr><td colspan="5" style="    border-right: 2px #006699 solid;" class="marco seccionblank">&nbsp;</td></tr>



                  <tr>
                      <td colspan="5" style="    border-right: 2px #006699 solid;"><table cellspacing="0" border="0" cellpadding="0"><tbody><tr><td width="10" background="<?php echo e(asset('/img/sisgedo/titulo1.jpg')); ?>" height="10">&nbsp;</td><td width="90%" align="left" class="marco seccion">&nbsp;DATOS DEL REGISTRO</td><td background="<?php echo e(asset('/img/sisgedo/titulo3.jpg')); ?>" height="20" align="right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr></tbody></table></td>
                  </tr>	


                  <tr valign="middle">
                      <td width="1%" class="marco" >&nbsp;</td>	
                        <td width="22%" class="etiqueta" align="right">Fecha de Registro&nbsp;&nbsp;</td>
                        <td width="1%" class="objeto">&nbsp;</td>
                        <td width="78%" class="objeto" >	
                               										

                         <input type="text" class="cajatexto txtmuestra" id="txtfecha" name="txtfecha" placeholder="" maxlength="10" v-model="fecha" readonly size="10">


                        &nbsp;

                          </td>
                        <td width="1%" class="objeto" style="    border-right: 2px #006699 solid;">&nbsp;</td>
                  </tr>	


                  <tr valign="middle">
                      <td width="1%" class="marco">&nbsp;</td>	
                        <td width="22%" class="etiqueta" align="right">Prioridad&nbsp;&nbsp;</td>
                        <td width="1%" class="objeto">&nbsp;</td>
                        <td width="78%" class="objeto">	
                        <select class="cajatexto" id="cbuprioridad" name="cbuprioridad" v-model="modelPrioridad" style="width: 160px;">
                            <option value="1">{{prioridad}}</option>
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
                        <td width="22%" class="etiqueta" align="right">Origen&nbsp;&nbsp;</td>
                        <td width="1%" class="objeto">&nbsp;</td>
                        <td width="78%" class="objeto" >
                          
                                <label for="radioInterno" style="color: #006699!important;">Interno</label>
                                <input type="radio" id="radioInterno" value="1" v-model="origen" disabled class="radiomuestra">
                                                
                                <label for="radioExterno" style="color: #006699!important;margin-left: 10px;">Externo</label>
                                <input type="radio" id="radioExterno" value="2" v-model="origen" disabled class="radiomuestra">
                        &nbsp;

                          </td>
                        <td width="1%" class="objeto" style="    border-right: 2px #006699 solid;">&nbsp;</td>
                  </tr>	

                  <tr valign="middle">
                      <td width="1%" class="marco" >&nbsp;</td>	
                        <td width="22%" class="etiqueta" align="right">Entidad&nbsp;&nbsp;</td>
                        <td width="1%" class="objeto">&nbsp;</td>
                        <td width="78%" class="objeto" valign="top">	
                               										
                           <input type="text" class="cajatexto txtmuestra" id="txtcodEntidad" name="txtcodEntidad" placeholder="" maxlength="20" v-model="codigoEntidad" readonly  size="6">

                         <img src="<?php echo e(asset('/img/sisgedo/search.gif')); ?>" alt="Buscar" height="14" width="16" border="0" style="cursor:pointer"> 
                        &nbsp; <br>

        
                            <select class="cajatexto" id="cbuentidad" name="cbuentidad" v-model="modelEntidad" style="width: 470px;">
                                <option value="1">{{entidad}}</option>
                            </select>
                      </td>
                        <td width="1%" class="objeto" style="    border-right: 2px #006699 solid;">&nbsp;</td>
                  </tr>	


                  <tr valign="middle">
                      <td width="1%" class="marco" >&nbsp;</td>	
                        <td width="22%" class="etiqueta" align="right">Detalle&nbsp;&nbsp;</td>
                        <td width="1%" class="objeto">&nbsp;</td>
                        <td width="78%" class="objeto" >	
                               										
        

                         <input type="text" class="cajatexto txtmuestra" id="txtdetalle" name="txtdetalle" placeholder="" maxlength="500" v-model="detalle" readonly size="53">
                        &nbsp;

                          </td>
                        <td width="1%" class="objeto" style="    border-right: 2px #006699 solid;">&nbsp;</td>
                  </tr>	

                  <tr valign="middle">
                      <td width="1%" class="marco" >&nbsp;</td>	
                        <td width="22%" class="etiqueta" align="right">Firma&nbsp;&nbsp;</td>
                        <td width="1%" class="objeto">&nbsp;</td>
                        <td width="78%" class="objeto" >	

                         <input type="text" class="cajatexto txtmuestra" id="txtfirma" name="txtfirma" placeholder="" maxlength="500" v-model="firma" readonly size="53">
                        &nbsp;

                          </td>
                        <td width="1%" class="objeto" style="    border-right: 2px #006699 solid;">&nbsp;</td>
                  </tr>	

                  <tr valign="middle">
                      <td width="1%" class="marco" >&nbsp;</td>	
                        <td width="22%" class="etiqueta" align="right">Cargo&nbsp;&nbsp;</td>
                        <td width="1%" class="objeto">&nbsp;</td>
                        <td width="78%" class="objeto" >	
                               										
                         <input type="text" class="cajatexto txtmuestra" id="txtcargo" name="txtcargo" placeholder="" maxlength="500" v-model="cargo" readonly size="53">
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

                         <input type="text" class="cajatexto txtmuestra" id="txtfechadoc" name="txtfechadoc" placeholder="" maxlength="10" v-model="fechadoc" readonly size="10">
                         &nbsp;
                          </td>
                        <td width="1%" class="objeto" style="    border-right: 2px #006699 solid;">&nbsp;</td>
                  </tr>	


                  <tr valign="middle">
                      <td width="1%" class="marco">&nbsp;</td>	
                        <td width="22%" class="etiqueta" align="right">Tipo de Documento&nbsp;&nbsp;</td>
                        <td width="1%" class="objeto">&nbsp;</td>
                        <td width="78%" class="objeto">	
                     
                    <select class="cajatexto" id="cbuTipoDoc" name="cbuTipoDoc" v-model="modelTipo" style="width: 300px;">
                        <option value="1">{{tipodocumento}}</option>
                      </select>
                      </td>
                        <td width="1%" class="objeto" style="    border-right: 2px #006699 solid;">&nbsp;</td>
                  </tr>



                  <tr valign="middle">
                      <td width="1%" class="marco" >&nbsp;</td>	
                        <td width="22%" class="etiqueta" align="right">Número y Siglas&nbsp;&nbsp;</td>
                        <td width="1%" class="objeto">&nbsp;</td>
                        <td width="78%" class="objeto" valign="top">	
                               										
                      <input type="text" class="cajatexto txtmuestra" id="txtnumero" name="txtnumero" placeholder="" maxlength="20" v-model="numero" readonly size="10">

                      <input type="text" class="cajatexto txtmuestra" id="txtsiglas" name="txtsiglas" placeholder="" maxlength="500" v-model="siglas" readonly size="53">

                      </td>
                        <td width="1%" class="objeto" style="    border-right: 2px #006699 solid;">&nbsp;</td>
                  </tr>	


                  <tr valign="middle">
                      <td width="1%" class="marco">&nbsp;</td>	
                        <td width="22%" class="etiqueta" align="right">Forma de Recepción&nbsp;&nbsp;</td>
                        <td width="1%" class="objeto">&nbsp;</td>
                        <td width="78%" class="objeto">	
                     

                    
                      <select class="cajatexto" id="cbuFormaRecep" name="cbuFormaRecep" v-model="modelForma" style="width: 250px;">
  
                          <option value="1">{{formarecep}}</option>
                          </select>

                      </td>
                        <td width="1%" class="objeto" style="    border-right: 2px #006699 solid;">&nbsp;</td>
                  </tr>



                  <tr valign="middle" v-if="archivoExsite">
                      <td width="1%" class="marco" >&nbsp;</td>	
                        <td width="22%" class="etiqueta" align="right">Archivo&nbsp;&nbsp;</td>
                        <td width="1%" class="objeto">&nbsp;</td>
                        <td width="78%" class="objeto" >
                              <label for="radioInterno" style="color: #006699!important;padding-right: 15px;">Descargar:</label>
                              <a v-bind:href="urlAdjunto" download data-placement="top" data-toggle="tooltip" title="Descargar Archivo Adjunto">
                                <img class="image image-responsive" style="width:40px;" id="divarchivo" src="<?php echo e(asset('/img/pdf.png')); ?>"/>
                              
                            </a>
                        &nbsp;

                          </td>
                        <td width="1%" class="objeto" style="    border-right: 2px #006699 solid;">&nbsp;</td>
                  </tr>	



                  <tr valign="middle" v-else>
                      <td width="1%" class="marco" >&nbsp;</td>	
                        <td width="22%" class="etiqueta" align="right">Archivo&nbsp;&nbsp;</td>
                        <td width="1%" class="objeto">&nbsp;</td>
                        <td width="78%" class="objeto" >
                          
                                <label for="radioInterno" style="color: #006699!important;padding-right: 15px;">No se adjuntó archivo</label>

                        &nbsp;

                          </td>
                        <td width="1%" class="objeto" style="    border-right: 2px #006699 solid;">&nbsp;</td>
                  </tr>	



                  <tr valign="middle">
                      <td width="1%" class="marco" >&nbsp;</td>	
                        <td width="22%" class="etiqueta" align="right">Folios&nbsp;&nbsp;</td>
                        <td width="1%" class="objeto">&nbsp;</td>
                        <td width="78%" class="objeto" valign="top">	

                      <input type="text" class="cajatexto txtmuestra" id="txtfolios" name="txtfolios" placeholder="" maxlength="20" v-model="folios" readonly size="10">
                      </td>
                        <td width="1%" class="objeto" style="    border-right: 2px #006699 solid;">&nbsp;</td>
                  </tr>	



                  <tr valign="middle">
                      <td width="1%" class="marco">&nbsp;</td>	
                        <td width="22%" class="etiqueta" align="right">Asunto&nbsp;&nbsp;</td>
                        <td width="1%" class="objeto">&nbsp;</td>
                        <td width="78%" class="objeto">	
 


                        <textarea name="txtasunto" id="txtasunto" cols="60" rows="4" class="cajatexto txtmuestra" v-model="asunto" readonly></textarea>  
                        </td>
                        <td width="1%" class="objeto" style="    border-right: 2px #006699 solid;">&nbsp;</td>
                  </tr>


                  <tr><td colspan="5" style="    border-right: 2px #006699 solid;" class="marco seccionblank">&nbsp;</td></tr>
                  <tr>
                      <td colspan="5" style="    border-right: 2px #006699 solid;"><table cellspacing="0" border="0" cellpadding="0"><tbody><tr><td width="10" background="<?php echo e(asset('/img/sisgedo/titulo1.jpg')); ?>" height="10">&nbsp;</td><td width="90%" align="left" class="marco seccion">&nbsp;CLASIFICACION TUPA</td><td background="<?php echo e(asset('/img/sisgedo/titulo3.jpg')); ?>" height="20" align="right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr></tbody></table></td>
                  </tr>	

                  <tr valign="middle">
                      <td width="1%" class="marco" >&nbsp;</td>	
                        <td width="22%" class="etiqueta" align="right">Clasificación&nbsp;&nbsp;</td>
                        <td width="1%" class="objeto">&nbsp;</td>
                        <td width="78%" class="objeto" >
                          
                                <label for="radioInterno" style="color: #006699!important;">Silencio Positivo</label>
                                <input type="radio" id="radioSilencioPositivo" value="1" v-model="clasificacion" disabled class="radiomuestra">
                                                
                                <label for="radioExterno" style="color: #006699!important;margin-left: 10px;">Silencio Negativo</label>
                                <input type="radio" id="radioSilencioNegativo" value="2" v-model="clasificacion" disabled class="radiomuestra">

                                <label for="radioExterno" style="color: #006699!important;margin-left: 10px;">Automático</label>
                                <input type="radio" id="radioAutomatico" value="3" v-model="clasificacion" disabled class="radiomuestra">


                                <label for="radioExterno" style="color: #006699!important;margin-left: 10px;">Ninguna</label>
                                <input type="radio" id="radioNinguna" value="4" v-model="clasificacion" disabled class="radiomuestra">

                        &nbsp;

                          </td>
                        <td width="1%" class="objeto" style="    border-right: 2px #006699 solid;">&nbsp;</td>
                  </tr>	

                  <tr valign="middle">
                      <td width="1%" class="marco" >&nbsp;</td>	
                        <td width="22%" class="etiqueta" align="right"># de Días de atención&nbsp;&nbsp;</td>
                        <td width="1%" class="objeto">&nbsp;</td>
                        <td width="78%" class="objeto" valign="top">	
                               										
                           <input type="text" class="cajatexto txtmuestra" id="txtnumdias" name="txtnumdias" placeholder="" maxlength="20" v-model="diasAtencion" readonly size="6">


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
                               										
                            <input type="checkbox" id="CHECKFORMA" v-model="forma" style="display:inline-block;" disabled class="radiomuestra">


                      </td>
                        <td width="1%" class="objeto" style="    border-right: 2px #006699 solid;">&nbsp;</td>
                  </tr>	



                  <tr valign="middle">
                      <td width="1%" class="marco" >&nbsp;</td>	
                        <td width="22%" class="etiqueta" align="right">Unidad Orgánica&nbsp;&nbsp;</td>
                        <td width="1%" class="objeto">&nbsp;</td>
                        <td width="78%" class="objeto" valign="top">	
                               										                    
                           <input type="text" class="cajatexto txtmuestra" id="txtUnidadOrganica" name="txtUnidadOrganica" placeholder="" maxlength="20" v-model="codUndOrg"  readonly size="6">

                         <img src="<?php echo e(asset('/img/sisgedo/search.gif')); ?>" alt="Buscar" height="14" width="16" border="0" style="cursor:pointer"> 
                     

                        <select class="cajatexto" id="cbuUnidadOrganica" name="cbuUnidadOrganica" v-model="modelUnidadOrg" style="width:450px;">
                            <option  value="1">{{unidadOrganica}}</option>
                      </select>

                      </td>
                        <td width="1%" class="objeto" style="    border-right: 2px #006699 solid;">&nbsp;</td>
                  </tr>	




                  <tr valign="middle">
                      <td width="1%" class="marco" >&nbsp;</td>	
                        <td width="22%" class="etiqueta" align="right">Detalle&nbsp;&nbsp;</td>
                        <td width="1%" class="objeto">&nbsp;</td>
                        <td width="78%" class="objeto" valign="top">	
                               										

                           <input type="text" class="cajatexto txtmuestra" id="txtDetalleUO" name="txtDetalleUO" placeholder="" maxlength="500" v-model="detalleUnidadOrg" readonly size="60">


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


      <a href="http://181.65.149.146/sisgedonew/app/main.php" target="_blank"><h4 style="color: blue;">Click Aquí para Realizar el Seguimiento de este Trámite en el SISGEDO: Debe de Ingresar el N° de Expediente</h4></a>
   

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

        <h3>Cargando Datos, Por favor espere hasta que la carga concluya ...</h3>
      </div>

    </div>
    <!-- /.box-footer -->

  
</div>