<div class="box box-info" id="divparte1">
  <div class="box-header with-border">
    <h3 class="box-title">Procesamiento de Trámites</h3>
    <a style="float: right;margin-left: 10px;" type="button" class="btn btn-default" href="{{URL::to('home')}}"><i class="fa fa-reply-all" aria-hidden="true"></i> 
    Volver</a>

{{--     <a style="float: right;    " type="button" class="btn btn-warning" href="{{URL::to('reghistoricos')}}"><i class="fa fa-archive" aria-hidden="true"></i> 
      Registros Históricos</a> --}}
  </div>

  <div class="box-body">
 {{--    <div class="form-group">
      <button type="button" class="btn btn-primary" id="btncrearArea" @click.prevent="nuevo()"><i class="fa fa-plus-square-o" aria-hidden="true" ></i> Nuevo Registro</button>
   
   
   
    </div>
 --}}


 <div class="col-md-12" style="padding-top: 15px;">
  <div class="form-group">
    <label for="cbuestado" class="col-sm-3 control-label">Filtro de Estado de los Trámites:</label>
    <div class="col-sm-5">
      <select class="form-control" id="cbuestado" name="cbuestado" v-model="newEstado" @change="cambiarestado">
        <option value="1">SOLICITADO Y RECEPCIONADO</option>
        <option value="3">INGRESADO AL SISGEDO</option>
        <option value="4">ATENDIDO</option>
        <option value="0">ANULADOS</option>
        <option value="5">TODOS</option>
      </select>
    </div>
  </div>
</div>



<div class="col-md-12" style="padding-top: 15px;">
  <div class="form-group">
    <label for="cbuestado" class="col-sm-3 control-label" style="   font-weight: normal; text-align: justify;"><b>Búsqueda por:</b> N° de Expediente, Número, Siglas, Asunto, Entidad, Detalle, Firma, Cargo, Unidad Orgánica, Tipo de Documento o Prioridad:</label>
    <div class="col-sm-5">


        <div class="box-tools">
            <div class="input-group input-group-sm">
              <input type="text" name="table_search" class="form-control pull-right" placeholder="Buscar" v-model="buscar" @keyup.enter="buscarBtn()">
          
              <div class="input-group-btn">
                <button type="submit" class="btn btn-primary" @click.prevent="buscarBtn()"><i class="fa fa-search"></i> Buscar</button>
              </div>

              <div class="input-group-btn">
                <button type="submit" class="btn btn-warning" @click.prevent="LimpiarBtn()"><i class="fa fa-times"></i> Limpiar</button>
              </div>  
          
          
            </div>
          </div>



    </div>
  </div>
</div>







 

    </div>




  </div>



<div class="box box-info" id="divparte2">
  <div class="box-header">
    <h3 class="box-title">Listado de Trámites en Proceso</h3>


  </div>
  <!-- /.box-header -->
  <div class="box-body table-responsive">
    <table class="table table-hover table-bordered" >
      <tbody><tr>
        <th style="font-size: 11px; padding: 5px; width: 3%;">#</th>
        <th style="font-size: 11px; padding: 5px; width: 4%;">N° de Expediente</th>
        <th style="font-size: 11px; padding: 5px; width: 8%;">Tipo de Documento</th>
        <th style="font-size: 11px; padding: 5px; width: 12%;">N° y Siglas del Doc</th>
        <th style="font-size: 11px; padding: 5px; width: 15%;">Asunto</th>
        <th style="font-size: 11px; padding: 5px; width: 8%;">Fecha Registro</th>
        <th style="font-size: 11px; padding: 5px; width: 12%;">Origen</th>
        <th style="font-size: 11px; padding: 5px; width: 12%;">Destino</th>
        <th style="font-size: 11px; padding: 5px; width: 8%;">Estado</th>
        <th style="font-size: 11px; padding: 5px; width: 8%;">Usuario Web</th>
        <th style="font-size: 11px; padding: 5px; width: 10%;">Gestión</th>
      </tr>
      <tr v-for="tramite, key in tramites">
        <td style="font-size: 11px; padding: 5px;">@{{key+pagination.from}}</td>
        <td style="font-size: 11px; padding: 5px;" v-if="tramite.expediente=='' || tramite.expediente==null">Pendiente</td>
        <td style="font-size: 11px; padding: 5px; font-weight: bold; color:#0600ff;;" v-else>@{{ tramite.expediente }}</td>
        <td style="font-size: 11px; padding: 5px;">@{{ tramite.tipodocumento }}</td>
        <td style="font-size: 11px; padding: 5px;">@{{ tramite.numero }} - @{{ tramite.siglas }}</td>
        <td style="font-size: 11px; padding: 5px;">@{{ tramite.asunto }}</td>
        <td style="font-size: 11px; padding: 5px;">@{{ tramite.fecha | fecha }}</td>
        <td style="font-size: 11px; padding: 5px;">@{{ tramite.entidad }}</td>
        <td style="font-size: 11px; padding: 5px;">@{{ tramite.unidadorganica }}</td>

        <td style="font-size: 13    px; padding: 5px;">

          <template v-if="tramite.activo=='0'">
            <span class="label label-danger" v-if="tramite.activo=='0'">Anulado</span>
          </template>
          <template v-else>
            <span class="label label-info" v-if="tramite.estado=='1'">Solicitado</span>
            <span class="label label-warning" v-if="tramite.estado=='2'">Recepcionado</span>
            <span class="label label-primary" v-if="tramite.estado=='3'">Ingresado al SISGEDO</span>
            <span class="label label-success" v-if="tramite.estado=='4'">Atendido</span>
          </template>
          </td>

        <td style="font-size: 11px; padding: 5px;">@{{ tramite.nombres }} @{{tramite.apellidos}}</td>


       <td style="font-size: 11px; padding: 5px;">


          <a href="#" class="btn btn-info btn-sm" v-on:click.prevent="verTramite(tramite)" data-placement="top" data-toggle="tooltip" title="Ver Detalles del Trámite"><i class="fa fa-search"></i></a>

         <a href="http://181.65.149.146/sisgedonew/app/main.php" v-if="tramite.estado>2" class="btn btn-primary btn-sm" target="_blank" data-placement="top" data-toggle="tooltip" title="Realizar Seguimiento en el SISGEDO ingresando el N° de Expediente"><i class="fa fa-external-link"></i></a>

         <template v-if="tramite.activo!='0'">
         <a href="#" v-if="tramite.estado=='3'" class="btn btn-success btn-sm" v-on:click.prevent="atender(tramite.id,tramite.persona_id)" data-placement="top" data-toggle="tooltip" title="Procesar Como Trámite Atendido" id="btnatent"><i class="fa fa-check-square-o"></i></a>
        </template>
         
         <a v-if="tramite.estado<3" href="#" class="btn btn-danger btn-sm" v-on:click.prevent="anular(tramite)" data-placement="top" data-toggle="tooltip" title="Anular Trámite"><i class="fa fa-times"></i></a>

{{-- 

<a href="#" v-if="tramite.estado=='4'" class="btn btn-success btn-sm" v-on:click.prevent="archivar(tramite)" data-placement="top" data-toggle="tooltip" title="Archivar Trámite"><i class="fa fa-archive"></i></a>
         <a href="#" class="btn btn-warning btn-sm" v-on:click.prevent="editar(tramite)" data-placement="top" data-toggle="tooltip" title="Editar Tipo de Documento"><i class="fa fa-edit"></i></a>
         <a href="#" class="btn btn-danger btn-sm" v-on:click.prevent="borrar(tramite)" data-placement="top" data-toggle="tooltip" title="Borrar Tipo de Documento"><i class="fa fa-trash"></i></a> --}}
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





















    


<div class="box box-success" id="divparte3" style="display:none">
    <div class="box-header with-border" >
      <h3 class="box-title" id="tituloAgregar">Detalles del Trámite:  @{{tipodocumento}} @{{numero}} - @{{siglas}}

        <br><br>
          Estado:  

          <template v-if="activo=='0'">
              <span class="label label-danger" v-if="activo=='0'">Anulado</span>
            </template>
            <template v-else>
          <span style="font-size:100%;" class="label label-info" v-if="estado=='1'">Solicitado</span>
          <span style="font-size:100%;" class="label label-warning" v-if="estado=='2'">Recepcionado</span>
          <span style="font-size:100%;" class="label label-primary" v-if="estado=='3'">Ingresado al SISGEDO</span>
          <span style="font-size:100%;" class="label label-success" v-if="estado=='4'">Atendido</span>
          <button class="btn btn-primary" @click.prevent="notificar"><i class="fa fa-envelope-o" aria-hidden="true" ></i> Notificar Estado del trámite al Usuario vía Correo Electrónico</button>
            </template>
          <button class="btn btn-success" @click.prevent="imprimir"><i class="fa fa-print" aria-hidden="true" ></i> Imprimir</button>
     </h3>


      <button style="float: right;margin-left: 10px;" type="button" class="btn btn-default" @click.prevent="volverAtras"><i class="fa fa-reply-all" aria-hidden="true"></i> 
        Volver Atrás</button>

        <h5>Usuario Tramitador:
          @{{nombresusu}} @{{apellidosusu}} DNI: @{{dniusu}}
        </h5>

        <h5>
          Username: @{{usernameusu}}
        </h5>
        
    </div>

    
     <div class="box-body">

        <div class="col-md-12" v-if="activo=='0'">
            <p style="text-align:justify;"><b>Motivo de la Anulación: </b> @{{motivoAnul}}
            </p>
            </div>

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
                    <td colspan="5" style="    border-right: 2px #006699 solid;"><table cellspacing="0" border="0" cellpadding="0"><tbody><tr><td width="10" background="{{ asset('/img/sisgedo/titulo1.jpg') }}" height="10">&nbsp;</td><td width="90%" align="left" class="marco seccion">&nbsp;EXPEDIENTE</td><td background="{{ asset('/img/sisgedo/titulo3.jpg') }}" height="20" align="right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr></tbody></table></td>
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
                      <td colspan="5" style="    border-right: 2px #006699 solid;"><table cellspacing="0" border="0" cellpadding="0"><tbody><tr><td width="10" background="{{ asset('/img/sisgedo/titulo1.jpg') }}" height="10">&nbsp;</td><td width="90%" align="left" class="marco seccion">&nbsp;DATOS DEL REGISTRO</td><td background="{{ asset('/img/sisgedo/titulo3.jpg') }}" height="20" align="right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr></tbody></table></td>
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
                            <option value="1">@{{prioridad}}</option>
                            </select>
                      </td>
                        <td width="1%" class="objeto" style="    border-right: 2px #006699 solid;">&nbsp;</td>
                  </tr>


                  <tr><td colspan="5" style="    border-right: 2px #006699 solid;" class="marco seccionblank">&nbsp;</td></tr>
                  <tr>
                      <td colspan="5" style="    border-right: 2px #006699 solid;"><table cellspacing="0" border="0" cellpadding="0"><tbody><tr><td width="10" background="{{ asset('/img/sisgedo/titulo1.jpg') }}" height="10">&nbsp;</td><td width="90%" align="left" class="marco seccion">&nbsp;ORIGEN</td><td background="{{ asset('/img/sisgedo/titulo3.jpg') }}" height="20" align="right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr></tbody></table></td>
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

                         <img src="{{ asset('/img/sisgedo/search.gif') }}" alt="Buscar" height="14" width="16" border="0" style="cursor:pointer"> 
                        &nbsp; <br>

        
                            <select class="cajatexto" id="cbuentidad" name="cbuentidad" v-model="modelEntidad" style="width: 470px;">
                                <option value="1">@{{entidad}}</option>
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
                      <td colspan="5" style="    border-right: 2px #006699 solid;"><table cellspacing="0" border="0" cellpadding="0"><tbody><tr><td width="10" background="{{ asset('/img/sisgedo/titulo1.jpg') }}" height="10">&nbsp;</td><td width="90%" align="left" class="marco seccion">&nbsp;DATOS DEL DOCUMENTO</td><td background="{{ asset('/img/sisgedo/titulo3.jpg') }}" height="20" align="right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr></tbody></table></td>
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
                        <option value="1">@{{tipodocumento}}</option>
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
  
                          <option value="1">@{{formarecep}}</option>
                          </select>

                      </td>
                        <td width="1%" class="objeto" style="    border-right: 2px #006699 solid;">&nbsp;</td>
                  </tr>



                  <tr valign="middle" v-if="archivoExsite || archivoExsite2">
                    <td width="1%" class="marco" >&nbsp;</td>	
                      <td width="22%" class="etiqueta" align="right">Archivo&nbsp;&nbsp;</td>
                      <td width="1%" class="objeto">&nbsp;</td>
                      <td width="78%" class="objeto" >
                            <label for="radioInterno" style="color: #006699!important;padding-right: 15px;">Descargar:</label>
                            <a  v-if="archivoExsite" v-bind:href="'archivosadjuntos/'+urlAdjunto" download data-placement="top" data-toggle="tooltip" title="Descargar Archivo Adjunto">
                              <img class="image image-responsive" style="width:40px;" id="divarchivo" src="{{ asset('/img/pdf.png') }}"/>
                            
                          </a>
                      &nbsp;

                      <a  v-if="archivoExsite2" v-bind:href="'archivosadjuntos/'+urlAdjunto2" download data-placement="top" data-toggle="tooltip" title="Descargar Archivo Adjunto">
                        <img class="image image-responsive" style="width:40px;" id="divarchivo" src="{{ asset('/img/pdf.png') }}"/>
                      
                    </a>

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
                      <td colspan="5" style="    border-right: 2px #006699 solid;"><table cellspacing="0" border="0" cellpadding="0"><tbody><tr><td width="10" background="{{ asset('/img/sisgedo/titulo1.jpg') }}" height="10">&nbsp;</td><td width="90%" align="left" class="marco seccion">&nbsp;CLASIFICACION TUPA</td><td background="{{ asset('/img/sisgedo/titulo3.jpg') }}" height="20" align="right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr></tbody></table></td>
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
                      <td colspan="5" style="    border-right: 2px #006699 solid;"><table cellspacing="0" border="0" cellpadding="0"><tbody><tr><td width="10" background="{{ asset('/img/sisgedo/titulo1.jpg') }}" height="10">&nbsp;</td><td width="90%" align="left" class="marco seccion">&nbsp;DESTINO(S) - DERIVACION DEL DOCUMENTO</td><td background="{{ asset('/img/sisgedo/titulo3.jpg') }}" height="20" align="right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr></tbody></table></td>
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

                         <img src="{{ asset('/img/sisgedo/search.gif') }}" alt="Buscar" height="14" width="16" border="0" style="cursor:pointer"> 
                     

                        <select class="cajatexto" id="cbuUnidadOrganica" name="cbuUnidadOrganica" v-model="modelUnidadOrg" style="width:450px;">
                            <option  value="1">@{{unidadOrganica}}</option>
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

<center>
        <button type="button" class="btn btn-primary" id="btnSave" @click="registrarSISGEDO()" v-if="parseInt(estado)<3"><i class="fa fa-save" aria-hidden="true"></i>  Confirmar Ingreso al SISGEDO</button>


        <button type="button" class="btn btn-success" id="btnSaveA" @click="atender(tramiteid,tramipersona_id)" v-if="parseInt(estado)==3"><i class="fa fa-check-square-o" aria-hidden="true"></i>  Confirmar Trámite Atendido</button>

        <a href="http://181.65.149.146/sisgedonew/app/main.php" target="_blank" v-if="parseInt(estado)>=3"><h4 style="color: blue;">Click Aquí para Realizar el Seguimiento de este Trámite en el SISGEDO: Debe de Ingresar el N° de Expediente</h4></a>
</center>


<div class="sk-circle" v-show="divloaderEdit2">
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

   {{--   <button type="submit" class="btn btn-primary" id="btnGuardar"><i class="fa fa-save" aria-hidden="true"></i>  Registrar</button>

      <button type="reset" class="btn btn-warning" id="btnCancel" @click="cancelForm()"><i class="fa fa-times" aria-hidden="true"></i>  Cancelar</button>

       <button type="button" class="btn btn-default" id="btnClose" @click.prevent="cerrarForm()">Cerrar</button> --}}


    </div>
    <!-- /.box-footer -->

  
</div>











<form method="post" v-on:submit.prevent="ingresoSisgedo(tramiteid)">
    <div class="modal  bs-example-modal-lg" id="modalProcesar" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
      <div class="modal-dialog modal-lg" role="document" id="modaltamanio">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="desEditarTitulo" style="font-weight: bold;text-decoration: underline;">CONFIRMAR INGRESO DEL TRÁMITE AL SISGEDO</h4>
  
          </div> 
          <div class="modal-body">
            <input type="hidden" id="idServicio" value="0">
  
            <div class="row">
  
              <div class="box" id="o" style="border:0px; box-shadow:none;" >
                <div class="box-header with-border">
                  <h3 class="box-title" id="boxTitulo"></h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
  
                <div class="box-body">


                    <div class="col-md-12" >
    
                        <div class="form-group">
                          <label for="txtexpediente" class="col-sm-2 control-label">N° de Expediente:*</label>
                
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="txtexpediente" name="txtexpediente" placeholder="N° Exp" maxlength="50" autofocus v-model="numExpediente" required>
                          </div>
                        </div>
                      </div>

  

  
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" id="btnSaveE"><i class="fa fa-floppy-o" aria-hidden="true"></i> Confirmar INGRESO al SISGEDO</button>
  
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
  



















  <form method="post" v-on:submit.prevent="anularTramite(tramiteid)">
    <div class="modal  bs-example-modal-lg" id="modalAnular" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
      <div class="modal-dialog modal-lg" role="document" id="modaltamanio">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="desAnularTitulo" style="font-weight: bold;text-decoration: underline;">CONFIRMAR ANULACIÓN DEL TRÁMITE</h4>
  
          </div> 
          <div class="modal-body">
            <input type="hidden" id="idServicio" value="0">
  
            <div class="row">
  
              <div class="box" id="o" style="border:0px; box-shadow:none;" >
                <div class="box-header with-border">
                  <h3 class="box-title" id="boxTituloAnular"></h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
  
                <div class="box-body">


                    <div class="col-md-12" >
    
                        <div class="form-group">
                          <label for="txtexpediente" class="col-sm-12 control-label">Ingrese el Motivo de Anulación:</label>
                
                          <div class="col-sm-12">
                            <textarea name="txtmotivoAnul" id="txtmotivoAnul" rows="6" autofocus v-model="motivoAnul" required style="width: 100%;"></textarea>
                          </div>
                        </div>
                      </div>

  

  
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" id="btnSaveAnul"><i class="fa fa-floppy-o" aria-hidden="true"></i> Confirmar Anulación</button>
  
              <button type="button" id="btnCancelAnul" class="btn btn-default" data-dismiss="modal"><i class="fa fa-sign-out" aria-hidden="true"></i> Cerrar</button>
  
              <div class="sk-circle" v-show="divloaderAnul">
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















































  <div class="box box-success" style="display:none;">
   

    
      <div class="box-body" id="divparteImp">


         
 
         <table width="100%">
             <tbody>
               <tr style="height: 30px;"><td></td></tr><tr>
 
               <td valign="top" style=""> 
             <table class="frmline" width="720" align="center" border="0" cellpadding="0" cellspacing="0">
         
               <tbody><tr>
                 <td colspan="7" style="    ">
                   <table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
                   <tbody><tr>
                     <td width="100%" colspan="3">
                           <table width="100%" cellspacing="0" cellpadding="3" border="0">
                   <tbody><tr>
                                         <th  width="20%" align="left">
                                 </th>
                     <th width="70%" height="26">
                     DOCUMENTO EN PROCESO :: Estado	
                      
                     <template v-if="activo=='0'">
                        <span style="font-size:100%;"v-if="activo=='0'">Anulado</span>
                      </template>
                      <template v-else>
                     <span style="font-size:100%;"  v-if="estado=='1'">Solicitado</span>
                     <span style="font-size:100%;"  v-if="estado=='2'">Recepcionado</span>
                     <span style="font-size:100%;"  v-if="estado=='3'">Ingresado al SISGEDO</span>
                     <span style="font-size:100%;"  v-if="estado=='4'">Atendido</span>
                      </template>

                   </th>	
                         <th width="25%" align="right">
                               
                           </th>				
                     </tr>
                     </tbody></table>
                     </td>
                   </tr>
                   </tbody></table>
                   </td></tr>
 
                   <tr>
                     <td colspan="5" style="    "><table cellspacing="0" border="0" cellpadding="0"><tbody><tr><td width="10" background="{{ asset('/img/sisgedo/titulo1.jpg') }}" height="10">&nbsp;</td><td width="90%" align="left" class="marco seccion">&nbsp;EXPEDIENTE</td><td background="{{ asset('/img/sisgedo/titulo3.jpg') }}" height="20" align="right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr></tbody></table></td>
                   </tr>	
 
                   <tr valign="middle">
                       <td width="1%" class="marco" >&nbsp;</td>	
                         <td width="22%" class="etiqueta" align="right">Expediente&nbsp;&nbsp;</td>
                         <td width="1%" class="objeto">&nbsp;</td>
                         <td width="78%" class="objeto" >	
                                                    
                          <input type="text" class="cajatexto txtmuestra" id="txtexpediente" name="txtexpediente" placeholder="" maxlength="500" v-model="expediente" readonly size="10">
                         &nbsp;
 
                           </td>
                         <td width="1%" class="objeto" style="    ">&nbsp;</td>
                   </tr>	
 
                   <tr><td colspan="5" style="    " class="marco seccionblank">&nbsp;</td></tr>
 
 
 
                   <tr>
                       <td colspan="5" style="    "><table cellspacing="0" border="0" cellpadding="0"><tbody><tr><td width="10" background="{{ asset('/img/sisgedo/titulo1.jpg') }}" height="10">&nbsp;</td><td width="90%" align="left" class="marco seccion">&nbsp;DATOS DEL REGISTRO</td><td background="{{ asset('/img/sisgedo/titulo3.jpg') }}" height="20" align="right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr></tbody></table></td>
                   </tr>	
 
 
                   <tr valign="middle">
                       <td width="1%" class="marco" >&nbsp;</td>	
                         <td width="22%" class="etiqueta" align="right">Fecha de Registro&nbsp;&nbsp;</td>
                         <td width="1%" class="objeto">&nbsp;</td>
                         <td width="78%" class="objeto" >	
                                                    
 
                          <input type="text" class="cajatexto txtmuestra" id="txtfecha" name="txtfecha" placeholder="" maxlength="10" v-model="fecha" readonly size="10">
 
 
                         &nbsp;
 
                           </td>
                         <td width="1%" class="objeto" style="    ">&nbsp;</td>
                   </tr>	
 
 
                   <tr valign="middle">
                       <td width="1%" class="marco">&nbsp;</td>	
                         <td width="22%" class="etiqueta" align="right">Prioridad&nbsp;&nbsp;</td>
                         <td width="1%" class="objeto">&nbsp;</td>
                         <td width="78%" class="objeto">	
                         <select class="cajatexto" id="cbuprioridad" name="cbuprioridad" v-model="modelPrioridad" style="width: 160px;">
                             <option value="1">@{{prioridad}}</option>
                             </select>
                       </td>
                         <td width="1%" class="objeto" style="    ">&nbsp;</td>
                   </tr>
 
 
                   <tr><td colspan="5" style="    " class="marco seccionblank">&nbsp;</td></tr>
                   <tr>
                       <td colspan="5" style="    "><table cellspacing="0" border="0" cellpadding="0"><tbody><tr><td width="10" background="{{ asset('/img/sisgedo/titulo1.jpg') }}" height="10">&nbsp;</td><td width="90%" align="left" class="marco seccion">&nbsp;ORIGEN</td><td background="{{ asset('/img/sisgedo/titulo3.jpg') }}" height="20" align="right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr></tbody></table></td>
                   </tr>	
 
                   <tr valign="middle">
                       <td width="1%" class="marco" >&nbsp;</td>	
                         <td width="22%" class="etiqueta" align="right">Origen&nbsp;&nbsp;</td>
                         <td width="1%" class="objeto">&nbsp;</td>
                         <td width="78%" class="objeto" >
                           
                                 <label for="radioInterno" style="">Interno</label>
                                 <input type="radio" id="radioInterno" value="1" v-model="origen" disabled class="radiomuestra">
                                                 
                                 <label for="radioExterno" style="margin-left: 10px;">Externo</label>
                                 <input type="radio" id="radioExterno" value="2" v-model="origen" disabled class="radiomuestra">
                         &nbsp;
 
                           </td>
                         <td width="1%" class="objeto" style="    ">&nbsp;</td>
                   </tr>	
 
                   <tr valign="middle">
                       <td width="1%" class="marco" >&nbsp;</td>	
                         <td width="22%" class="etiqueta" align="right">Entidad&nbsp;&nbsp;</td>
                         <td width="1%" class="objeto">&nbsp;</td>
                         <td width="78%" class="objeto" valign="top">	
                                                    
                            <input type="text" class="cajatexto txtmuestra" id="txtcodEntidad" name="txtcodEntidad" placeholder="" maxlength="20" v-model="codigoEntidad" readonly  size="6">
 
                          <img src="{{ asset('/img/sisgedo/search.gif') }}" alt="Buscar" height="14" width="16" border="0" style="cursor:pointer"> 
                         &nbsp; <br>
 
         
                             <select class="cajatexto" id="cbuentidad" name="cbuentidad" v-model="modelEntidad" style="width: 470px;">
                                 <option value="1">@{{entidad}}</option>
                             </select>
                       </td>
                         <td width="1%" class="objeto" style="    ">&nbsp;</td>
                   </tr>	
 
 
                   <tr valign="middle">
                       <td width="1%" class="marco" >&nbsp;</td>	
                         <td width="22%" class="etiqueta" align="right">Detalle&nbsp;&nbsp;</td>
                         <td width="1%" class="objeto">&nbsp;</td>
                         <td width="78%" class="objeto" >	
                                                    
         
 
                          <input type="text" class="cajatexto txtmuestra" id="txtdetalle" name="txtdetalle" placeholder="" maxlength="500" v-model="detalle" readonly size="53">
                         &nbsp;
 
                           </td>
                         <td width="1%" class="objeto" style="    ">&nbsp;</td>
                   </tr>	
 
                   <tr valign="middle">
                       <td width="1%" class="marco" >&nbsp;</td>	
                         <td width="22%" class="etiqueta" align="right">Firma&nbsp;&nbsp;</td>
                         <td width="1%" class="objeto">&nbsp;</td>
                         <td width="78%" class="objeto" >	
 
                          <input type="text" class="cajatexto txtmuestra" id="txtfirma" name="txtfirma" placeholder="" maxlength="500" v-model="firma" readonly size="53">
                         &nbsp;
 
                           </td>
                         <td width="1%" class="objeto" style="    ">&nbsp;</td>
                   </tr>	
 
                   <tr valign="middle">
                       <td width="1%" class="marco" >&nbsp;</td>	
                         <td width="22%" class="etiqueta" align="right">Cargo&nbsp;&nbsp;</td>
                         <td width="1%" class="objeto">&nbsp;</td>
                         <td width="78%" class="objeto" >	
                                                    
                          <input type="text" class="cajatexto txtmuestra" id="txtcargo" name="txtcargo" placeholder="" maxlength="500" v-model="cargo" readonly size="53">
                         &nbsp;
 
                           </td>
                         <td width="1%" class="objeto" style="    ">&nbsp;</td>
                   </tr>	
 
 
                   <tr><td colspan="5" style="    " class="marco seccionblank">&nbsp;</td></tr>
                   <tr>
                       <td colspan="5" style="    "><table cellspacing="0" border="0" cellpadding="0"><tbody><tr><td width="10" background="{{ asset('/img/sisgedo/titulo1.jpg') }}" height="10">&nbsp;</td><td width="90%" align="left" class="marco seccion">&nbsp;DATOS DEL DOCUMENTO</td><td background="{{ asset('/img/sisgedo/titulo3.jpg') }}" height="20" align="right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr></tbody></table></td>
                   </tr>	
 
                   <tr valign="middle">
                       <td width="1%" class="marco" >&nbsp;</td>	
                         <td width="22%" class="etiqueta" align="right">Fecha de Documento&nbsp;&nbsp;</td>
                         <td width="1%" class="objeto">&nbsp;</td>
                         <td width="78%" class="objeto" >	    									
 
                          <input type="text" class="cajatexto txtmuestra" id="txtfechadoc" name="txtfechadoc" placeholder="" maxlength="10" v-model="fechadoc" readonly size="10">
                          &nbsp;
                           </td>
                         <td width="1%" class="objeto" style="    ">&nbsp;</td>
                   </tr>	
 
 
                   <tr valign="middle">
                       <td width="1%" class="marco">&nbsp;</td>	
                         <td width="22%" class="etiqueta" align="right">Tipo de Documento&nbsp;&nbsp;</td>
                         <td width="1%" class="objeto">&nbsp;</td>
                         <td width="78%" class="objeto">	
                      
                     <select class="cajatexto" id="cbuTipoDoc" name="cbuTipoDoc" v-model="modelTipo" style="width: 300px;">
                         <option value="1">@{{tipodocumento}}</option>
                       </select>
                       </td>
                         <td width="1%" class="objeto" style="    ">&nbsp;</td>
                   </tr>
 
 
 
                   <tr valign="middle">
                       <td width="1%" class="marco" >&nbsp;</td>	
                         <td width="22%" class="etiqueta" align="right">Número y Siglas&nbsp;&nbsp;</td>
                         <td width="1%" class="objeto">&nbsp;</td>
                         <td width="78%" class="objeto" valign="top">	
                                                    
                       <input type="text" class="cajatexto txtmuestra" id="txtnumero" name="txtnumero" placeholder="" maxlength="20" v-model="numero" readonly size="10">
 
                       <input type="text" class="cajatexto txtmuestra" id="txtsiglas" name="txtsiglas" placeholder="" maxlength="500" v-model="siglas" readonly size="53">
 
                       </td>
                         <td width="1%" class="objeto" style="    ">&nbsp;</td>
                   </tr>	
 
 
                   <tr valign="middle">
                       <td width="1%" class="marco">&nbsp;</td>	
                         <td width="22%" class="etiqueta" align="right">Forma de Recepción&nbsp;&nbsp;</td>
                         <td width="1%" class="objeto">&nbsp;</td>
                         <td width="78%" class="objeto">	
                      
 
                     
                       <select class="cajatexto" id="cbuFormaRecep" name="cbuFormaRecep" v-model="modelForma" style="width: 250px;">
   
                           <option value="1">@{{formarecep}}</option>
                           </select>
 
                       </td>
                         <td width="1%" class="objeto" style="    ">&nbsp;</td>
                   </tr>
 
 
 
                   <tr valign="middle" v-if="archivoExsite || archivoExsite2">
                       <td width="1%" class="marco" >&nbsp;</td>	
                         <td width="22%" class="etiqueta" align="right">Archivo&nbsp;&nbsp;</td>
                         <td width="1%" class="objeto">&nbsp;</td>
                         <td width="78%" class="objeto" >
                             
                               <a v-if="archivoExsite" v-bind:href="urlAdjunto" download data-placement="top" data-toggle="tooltip" title="Descargar Archivo Adjunto">

                                <a v-if="archivoExsite2" v-bind:href="urlAdjunto2" download data-placement="top" data-toggle="tooltip" title="Descargar Archivo Adjunto">
                                
                               
                             </a>
                         &nbsp;
 
                           </td>
                         <td width="1%" class="objeto" style="    ">&nbsp;</td>
                   </tr>	


    
 
 
                   <tr valign="middle" v-else>
                       <td width="1%" class="marco" >&nbsp;</td>	
                         <td width="22%" class="etiqueta" align="right">Archivo&nbsp;&nbsp;</td>
                         <td width="1%" class="objeto">&nbsp;</td>
                         <td width="78%" class="objeto" >
                           
                                 <label for="radioInterno" style="padding-right: 15px;">No se adjuntó archivo</label>
 
                         &nbsp;
 
                           </td>
                         <td width="1%" class="objeto" style="    ">&nbsp;</td>
                   </tr>	
 
 
 
                   <tr valign="middle">
                       <td width="1%" class="marco" >&nbsp;</td>	
                         <td width="22%" class="etiqueta" align="right">Folios&nbsp;&nbsp;</td>
                         <td width="1%" class="objeto">&nbsp;</td>
                         <td width="78%" class="objeto" valign="top">	
 
                       <input type="text" class="cajatexto txtmuestra" id="txtfolios" name="txtfolios" placeholder="" maxlength="20" v-model="folios" readonly size="10">
                       </td>
                         <td width="1%" class="objeto" style="    ">&nbsp;</td>
                   </tr>	
 
 
 
                   <tr valign="middle">
                       <td width="1%" class="marco">&nbsp;</td>	
                         <td width="22%" class="etiqueta" align="right">Asunto&nbsp;&nbsp;</td>
                         <td width="1%" class="objeto">&nbsp;</td>
                         <td width="78%" class="objeto">	
  
 
 
                         <textarea name="txtasunto" id="txtasunto" cols="60" rows="4" class="cajatexto txtmuestra" v-model="asunto" readonly></textarea>  
                         </td>
                         <td width="1%" class="objeto" style="    ">&nbsp;</td>
                   </tr>
 
 
                   <tr><td colspan="5" style="    " class="marco seccionblank">&nbsp;</td></tr>
                   <tr>
                       <td colspan="5" style="    "><table cellspacing="0" border="0" cellpadding="0"><tbody><tr><td width="10" background="{{ asset('/img/sisgedo/titulo1.jpg') }}" height="10">&nbsp;</td><td width="90%" align="left" class="marco seccion">&nbsp;CLASIFICACION TUPA</td><td background="{{ asset('/img/sisgedo/titulo3.jpg') }}" height="20" align="right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr></tbody></table></td>
                   </tr>	
 
                   <tr valign="middle">
                       <td width="1%" class="marco" >&nbsp;</td>	
                         <td width="22%" class="etiqueta" align="right">Clasificación&nbsp;&nbsp;</td>
                         <td width="1%" class="objeto">&nbsp;</td>
                         <td width="78%" class="objeto" >
                           
                                 <label for="radioInterno" style="">Silencio Positivo</label>
                                 <input type="radio" id="radioSilencioPositivo" value="1" v-model="clasificacion" disabled class="radiomuestra">
                                                 
                                 <label for="radioExterno" style="margin-left: 10px;">Silencio Negativo</label>
                                 <input type="radio" id="radioSilencioNegativo" value="2" v-model="clasificacion" disabled class="radiomuestra">
 
                                 <label for="radioExterno" style="margin-left: 10px;">Automático</label>
                                 <input type="radio" id="radioAutomatico" value="3" v-model="clasificacion" disabled class="radiomuestra">
 
 
                                 <label for="radioExterno" style="margin-left: 10px;">Ninguna</label>
                                 <input type="radio" id="radioNinguna" value="4" v-model="clasificacion" disabled class="radiomuestra">
 
                         &nbsp;
 
                           </td>
                         <td width="1%" class="objeto" style="    ">&nbsp;</td>
                   </tr>	
 
                   <tr valign="middle">
                       <td width="1%" class="marco" >&nbsp;</td>	
                         <td width="22%" class="etiqueta" align="right"># de Días de atención&nbsp;&nbsp;</td>
                         <td width="1%" class="objeto">&nbsp;</td>
                         <td width="78%" class="objeto" valign="top">	
                                                    
                            <input type="text" class="cajatexto txtmuestra" id="txtnumdias" name="txtnumdias" placeholder="" maxlength="20" v-model="diasAtencion" readonly size="6">
 
 
                       </td>
                         <td width="1%" class="objeto" style="    ">&nbsp;</td>
                   </tr>	
 
 
 
                   <tr><td colspan="5" style="    " class="marco seccionblank">&nbsp;</td></tr>
                   <tr>
                       <td colspan="5" style="    "><table cellspacing="0" border="0" cellpadding="0"><tbody><tr><td width="10" background="{{ asset('/img/sisgedo/titulo1.jpg') }}" height="10">&nbsp;</td><td width="90%" align="left" class="marco seccion">&nbsp;DESTINO(S) - DERIVACION DEL DOCUMENTO</td><td background="{{ asset('/img/sisgedo/titulo3.jpg') }}" height="20" align="right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr></tbody></table></td>
                   </tr>	
 
 
                   <tr valign="middle">
                       <td width="1%" class="marco" >&nbsp;</td>	
                         <td width="22%" class="etiqueta" align="right">Forma&nbsp;&nbsp;</td>
                         <td width="1%" class="objeto">&nbsp;</td>
                         <td width="78%" class="objeto" valign="top">	
 
 
                             <label for="radioInterno" style="">Copia</label>
                                                    
                             <input type="checkbox" id="CHECKFORMA" v-model="forma" style="display:inline-block;" disabled class="radiomuestra">
 
 
                       </td>
                         <td width="1%" class="objeto" style="    ">&nbsp;</td>
                   </tr>	
 
 
 
                   <tr valign="middle">
                       <td width="1%" class="marco" >&nbsp;</td>	
                         <td width="22%" class="etiqueta" align="right">Unidad Orgánica&nbsp;&nbsp;</td>
                         <td width="1%" class="objeto">&nbsp;</td>
                         <td width="78%" class="objeto" valign="top">	
                                                                        
                            <input type="text" class="cajatexto txtmuestra" id="txtUnidadOrganica" name="txtUnidadOrganica" placeholder="" maxlength="20" v-model="codUndOrg"  readonly size="6">
 
                          <img src="{{ asset('/img/sisgedo/search.gif') }}" alt="Buscar" height="14" width="16" border="0" style="cursor:pointer"> 
                      
 
                         <select class="cajatexto" id="cbuUnidadOrganica" name="cbuUnidadOrganica" v-model="modelUnidadOrg" style="width:450px;">
                             <option  value="1">@{{unidadOrganica}}</option>
                       </select>
 
                       </td>
                         <td width="1%" class="objeto" style="    ">&nbsp;</td>
                   </tr>	
 
 
 
 
                   <tr valign="middle">
                       <td width="1%" class="marco" >&nbsp;</td>	
                         <td width="22%" class="etiqueta" align="right">Detalle&nbsp;&nbsp;</td>
                         <td width="1%" class="objeto">&nbsp;</td>
                         <td width="78%" class="objeto" valign="top">	
                                                    
 
                            <input type="text" class="cajatexto txtmuestra" id="txtDetalleUO" name="txtDetalleUO" placeholder="" maxlength="500" v-model="detalleUnidadOrg" readonly size="60">
 
 
                       </td>
                         <td width="1%" class="objeto" style="    ">&nbsp;</td>
                   </tr>	
 
                   <tr><td colspan="5" style="    " class="marco seccionblank">&nbsp;</td></tr>
 
 
                   
 
 
 
 
 
 
 
 
 
 
            
                   
 
 
 
                   
             
             </tbody></table>
             </td></tr>
             
             </tbody></table>
         
    
           
 
     </div>
 
 
 
   
 </div>
 
 


























{{-- <div class="box box-success" id="divparte3" style="display:block;">
    <div class="box-header with-border" >
      <h3 class="box-title" id="tituloAgregar">Detalles del Trámite:  @{{tipodocumento}} @{{numero}} - @{{siglas}}

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


        <div class="col-md-2" style="padding-bottom: 15px;">
          

          
          
          
          
          
          
          <h4 style="font-weight:bold; font-size:16px;">EXPEDIENTE</h4> </div>



        <div class="col-md-12">

            <div class="form-group">
              <label for="txtexpediente" class="col-sm-2 control-label">Expediente:</label>
    
              <div class="col-sm-1">
                <input type="text" class="form-control txtmuestra" id="txtexpediente" name="txtexpediente" placeholder="" maxlength="500" v-model="expediente" readonly>
              </div>
            </div>
          </div>


          <div class="col-md-12" >
              <hr>
            </div>


            <div class="col-md-12" style="padding-bottom: 15px; "> <h4 style="font-weight:bold; font-size:16px;">DATOS DEL REGISTRO</h4> </div>

        <div class="col-md-12" style="padding-bottom: 15px;">

            <div class="form-group">
              <label for="txtfecha" class="col-sm-2 control-label">Fecha de Registro:</label>
    
              <div class="col-sm-2">
                <input type="text" class="form-control txtmuestra" id="txtfecha" name="txtfecha" placeholder="" maxlength="10" v-model="fecha" readonly>
              </div>
            </div>
          </div>

          



        



      <div class="col-md-12" >

          <div class="form-group">
            <label for="cbuprioridad" class="col-sm-2 control-label">PRIORIDAD:</label>
  
            <div class="col-sm-2">
                <select class="form-control" id="cbuprioridad" name="cbuprioridad" v-model="modelPrioridad">
                <option value="1">@{{prioridad}}</option>
  
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
            <label for="radioOrigen" class="col-sm-2 control-label">ORIGEN:</label>
  
            <div class="col-sm-1">
                <input type="radio" id="radioInterno" value="1" v-model="origen" disabled class="radiomuestra">
                <label for="radioInterno">Interno</label>
             
            </div>
  
            <div class="col-sm-1">
                <input type="radio" id="radioExterno" value="2" v-model="origen" disabled class="radiomuestra">
                <label for="radioExterno">Externo</label>
             
            </div>
          </div>
        </div> 
  
  
  
  
          <div class="col-md-12" style="padding-top: 15px;">
              <div class="form-group">
                <label for="txtcodEntidad" class="col-sm-2 control-label">ENTIDAD:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control txtmuestra" id="txtcodEntidad" name="txtcodEntidad" placeholder="" maxlength="20" v-model="codigoEntidad" style="width: 100px; display:inline-block;" onkeypress="return soloNumeros(event);" readonly>
  
                    <button type="button" class="btn btn-warning" id="btnBuscarEntidad" style="display:inline-block;margin-bottom: 5px;"><i class="fa fa-search"></i></button>
  
                    <select class="form-control" id="cbuentidad" name="cbuentidad" v-model="modelEntidad">
                        <option value="1">@{{entidad}}</option>
                    </select>
  
                  </div>
                </div>
              </div>
  
  
  
  
              <div class="col-md-12" style="padding-top: 15px;">
  
                <div class="form-group">
                  <label for="txtdetalle" class="col-sm-2 control-label">DETALLE:</label>
        
                  <div class="col-sm-8">
                    <input type="text" class="form-control txtmuestra" id="txtdetalle" name="txtdetalle" placeholder="" maxlength="500" v-model="detalle" readonly>
                  </div>
                </div>
              </div>
           
  
        <div class="col-md-12" style="padding-top: 15px;">
  
            <div class="form-group">
              <label for="txtfirma" class="col-sm-2 control-label">FIRMA:</label>
    
              <div class="col-sm-8">
                <input type="text" class="form-control txtmuestra" id="txtfirma" name="txtfirma" placeholder="" maxlength="500" v-model="firma" readonly>
              </div>
            </div>
          </div>
  
          <div class="col-md-12" style="padding-top: 15px;">
  
              <div class="form-group">
                <label for="txtcargo" class="col-sm-2 control-label">CARGO:</label>
      
                <div class="col-sm-8">
                  <input type="text" class="form-control txtmuestra" id="txtcargo" name="txtcargo" placeholder="" maxlength="500" v-model="cargo" readonly>
                </div>
              </div>
            </div>
  
  
            <div class="col-md-12" >
                <hr>
              </div>
  
            <div class="col-md-12" style="padding-bottom: 15px; "> <h4 style="font-weight:bold; font-size:16px;">DATOS DEL DOCUMENTO</h4> </div>
  
  
            <div class="col-md-12" >
  
                <div class="form-group">
                  <label for="txtfecha" class="col-sm-2 control-label">FECHA:</label>
        
                  <div class="col-sm-2">
                    <input type="text" class="form-control txtmuestra" id="txtfecha" name="txtfecha" placeholder="" maxlength="10" v-model="fechadoc" readonly>
                  </div>
                </div>
              </div>
  
  
              <div class="col-md-12" style="padding-top: 15px;">
                  <div class="form-group">
                    <label for="cbuTipoDoc" class="col-sm-2 control-label">TIPO DE DOCUMENTO:</label>
                    <div class="col-sm-4">
                      <select class="form-control" id="cbuTipoDoc" name="cbuTipoDoc" v-model="modelTipo">
  
                        <option value="1">@{{tipodocumento}}</option>
                      </select>
                    </div>
                  </div>
                </div>
  
  
                <div class="col-md-12" style="padding-top: 15px;">
  
                    <div class="form-group">
                      <label for="txtnumero" class="col-sm-2 control-label">NÚMERO Y SIGLAS:</label>
            
                      <div class="col-sm-1">
                        <input type="text" class="form-control txtmuestra" id="txtnumero" name="txtnumero" placeholder="" maxlength="20" v-model="numero" readonly>
  
  
                      </div>
  
                      <div class="col-sm-7">
                          <input type="text" class="form-control txtmuestra" id="txtsiglas" name="txtsiglas" placeholder="" maxlength="500" v-model="siglas" readonly>
                        </div>
                    </div>
                  </div>
  
                   <div class="col-md-12" style="padding-top: 15px;">
                      <div class="form-group">
                        <label for="cbuFormaRecep" class="col-sm-2 control-label">FORMA DE RECEPCIÓN:</label>
                        <div class="col-sm-4">
                          <select class="form-control" id="cbuFormaRecep" name="cbuFormaRecep" v-model="modelForma">
  
                          <option value="1">@{{formarecep}}</option>
                          </select>
                        </div>
                      </div>
                    </div>
  
  
                    <div class="col-md-12" style="padding-top: 15px;" v-if="archivoExsite">
  
                        <div class="form-group">
                          <label for="archivo" class="col-sm-2 control-label">ARCHIVO:</label>
                
                          <div class="col-sm-4">
  
                            <label style="padding-right: 15px;">Descargar:</label><a v-bind:href="urlAdjunto" download data-placement="top" data-toggle="tooltip" title="Descargar Archivo Adjunto"><img class="image image-responsive" style="width:50px;" id="divarchivo" src="{{ asset('/img/pdf.png') }}"/></a>
                          </div>
                        </div>
                      </div>
  
  
                      <div class="col-md-12" style="padding-top: 15px;" v-else>
  
                          <div class="form-group">
                            <label for="archivo" class="col-sm-2 control-label">ARCHIVO:</label>
                  
                            <div class="col-sm-4">
                                No se adjuntó archivo
                            </div>
                          </div>
                        </div>
  
  
                      <div class="col-md-12" style="padding-top: 15px;">
  
                          <div class="form-group">
                            <label for="txtfolios" class="col-sm-2 control-label">FOLIOS:</label>
                  
                            <div class="col-sm-2">
                              <input type="text" class="form-control txtmuestra" id="txtfolios" name="txtfolios" placeholder="" maxlength="20" v-model="folios" readonly>
                            </div>
                          </div>
                        </div>
  
  
                        <div class="col-md-12" style="padding-top: 15px;">
  
                            <div class="form-group">
                              <label for="txtasunto" class="col-sm-2 control-label">ASUNTO:</label>
                    
                              <div class="col-sm-8">
  
                                <textarea name="txtasunto" id="txtasunto" rows="4" class="form-control txtmuestra" v-model="asunto" readonly></textarea>
                              </div>
                            </div>
                          </div>
    
  
                          <div class="col-md-12" >
                              <hr>
                            </div>
  
        <div class="col-md-12" style="padding-bottom: 15px; "> <h4 style="font-weight:bold; font-size:16px;">CLASIFICACIÓN TUPA</h4> </div>
  
  
       <div class="col-md-12" style="padding-top: 15px;">
  
          <div class="form-group">
            <label for="radioOrigen" class="col-sm-2 control-label">CLASIFICACIÓN:</label>
  
            <div class="col-sm-2">
                <input type="radio" id="radioSilencioPositivo" value="1" v-model="clasificacion" disabled class="radiomuestra">
                <label for="radioSilencioPositivo">Silencio Positivo</label>
             
            </div>
  
            <div class="col-sm-2">
                <input type="radio" id="radioSilencioNegativo" value="2" v-model="clasificacion" disabled class="radiomuestra">
                <label for="radioSilencioNegativo">Silencio Negativo</label>
             
            </div>
  
            <div class="col-sm-2">
                <input type="radio" id="radioAutomatico" value="3" v-model="clasificacion" disabled class="radiomuestra">
                <label for="radioAutomatico">Automático</label>
             
            </div>
  
            <div class="col-sm-2">
                <input type="radio" id="radioNinguna" value="4" v-model="clasificacion" disabled class="radiomuestra">
                <label for="radioNinguna">Ninguna</label>
             
            </div>
          </div>
        </div>
  
  
  
        <div class="col-md-12" style="padding-top: 15px;">
  
            <div class="form-group">
              <label for="txtnumdias" class="col-sm-2 control-label"># de Días de Atención:</label>
    
              <div class="col-sm-2">
                <input type="text" class="form-control txtmuestra" id="txtnumdias" name="txtnumdias" placeholder="" maxlength="20" v-model="diasAtencion" readonly>
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
                   <label for="checkforma" style="display:inline-block;">Copia:</label>  
                   <input type="checkbox" id="CHECKFORMA" v-model="forma" style="display:inline-block;" disabled class="radiomuestra">
                </div>
              </div>
            </div>
  
  
            <div class="col-md-12" style="padding-top: 15px;">
                <div class="form-group">
                  <label for="cbuUnidadOrganica" class="col-sm-2 control-label">UNIDAD ORGÁNICA:</label>
                  <div class="col-sm-8">
  
                      <input type="text" class="form-control txtmuestra" id="txtUnidadOrganica" name="txtUnidadOrganica" placeholder="" maxlength="20" v-model="codUndOrg"  style="width: 100px; display:inline-block;" onkeypress="return soloNumeros(event);" readonly >
  
  
                      <button type="button" class="btn btn-warning" id="btnBuscarUnidOrg" style="display:inline-block;margin-bottom: 5px;"><i class="fa fa-search"></i></button>
  
  
                    <select class="form-control" id="cbuUnidadOrganica" name="cbuUnidadOrganica" v-model="modelUnidadOrg" style="display:inline-block; width: 80%;">
                          <option  value="1">@{{unidadOrganica}}</option>
                    </select>
                  </div>
                </div>
              </div>
  
  
  
              <div class="col-md-12" style="padding-top: 15px;">
  
                  <div class="form-group">
                    <label for="txtDetalleUO" class="col-sm-2 control-label">DETALLE:</label>
          
                    <div class="col-sm-8">
                      <input type="text" class="form-control txtmuestra" id="txtDetalleUO" name="txtDetalleUO" placeholder="" maxlength="500" v-model="detalleUnidadOrg" readonly>
                    </div>
                  </div>
                </div>
  
  



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

  
</div> --}}