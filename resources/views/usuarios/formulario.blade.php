 <form v-on:submit.prevent="createUsuario">
             <div class="box-body" style="font-size: 12px;">

             	<div class="col-md-12" >

             	<div class="form-group">
                  <label for="txtDNI" class="col-sm-1 control-label">DNI:*</label>

                  <div class="col-sm-2">
                    <input type="text" class="form-control" id="txtDNI" name="txtDNI" placeholder="N° de DNI" maxlength="8" autofocus v-model="newDNI" @keyup.enter="pressNuevoDNI(newDNI)" required @keydown="$event.keyCode === 13 ? $event.preventDefault() : false" :disabled="validated == 1" onkeypress="return soloNumeros(event);">
                  </div>
                  <div  class="col-sm-8">
                    <a href="#" class="btn btn-info btn-sm" v-on:click.prevent="pressNuevoDNI(newDNI)">Validar</a>
                  </div>
                </div>



                </div>

                <template v-if="formularioCrear">


                  <div class="col-md-12">
                    <hr style="border-top: 3px solid #1b5f43;">
                  </div>

                  <center><h4>Datos Personales del Usuario</h4></center>

              <div class="col-md-12" style="padding-top: 15px;">
                  <div class="form-group">
                  <label for="txtnombres" class="col-sm-1 control-label">Nombres:*</label>

                  <div class="col-sm-5">
                    <input type="text" class="form-control" id="txtnombres" name="txtnombres" placeholder="Nombres" maxlength="225" @keydown="$event.keyCode === 13 ? $event.preventDefault() : false" v-model="newNombres">
                  </div>

                  <label for="txtapellidos" class="col-sm-1 control-label">Apellidos:*</label>

                  <div class="col-sm-5">
                    <input type="text" class="form-control" id="txtapellidos" name="txtapellidos" placeholder="Apellidos" maxlength="225" @keydown="$event.keyCode === 13 ? $event.preventDefault() : false" v-model="newApellidos">
                  </div>
                </div>
              </div>


              <div class="col-md-12" style="padding-top: 15px;">

                <div class="form-group">
                  <label for="cbuGenero" class="col-sm-1 control-label">Género:*</label>

                  <div class="col-sm-2">
                  <select class="form-control" id="cbuGenero" name="cbuGenero" v-model="newGenero">
                    <option value="1">Masculino</option>
                    <option value="0">Femenino</option>
                  </select>
                   </div>

                     <label for="txtfono" class="col-sm-1 control-label">Teléfono/Cell:</label>

                  <div class="col-sm-2">
                    <input type="text" class="form-control" id="txtfono" name="txtfono" placeholder="N°" maxlength="25" @keydown="$event.keyCode === 13 ? $event.preventDefault() : false" v-model="newTelefono">
                  </div>

                  <label for="txtDir" class="col-sm-1 control-label">Dirección:</label>

                  <div class="col-sm-5">
                    <input type="text" class="form-control" id="txtDir" name="txtDir" placeholder="Av. Jr. Psje." maxlength="500" @keydown="$event.keyCode === 13 ? $event.preventDefault() : false" v-model="newDireccion">
                  </div>

                </div>

            </div>





             <div class="col-md-12">
                    <hr>
                  </div>

                  <center><h4>Datos de Usuario</h4></center>


                  <div class="col-md-12" style="padding-top: 15px;">

                <div class="form-group">
                  <label for="cbuTipoUser" class="col-sm-1 control-label">Tipo de Usuario:*</label>
                    <div class="col-sm-4">
                  <select class="form-control" id="cbuTipoUser" name="cbuTipoUser" v-model="newTipoUser" @change="tipouser()">
                    <option disabled value="">Seleccione un Tipo de Usuario</option>

                    <option v-for="tipouser, key in tipousers" v-bind:value="tipouser.id">@{{ tipouser.nombre }} </option>
 
                  </select>
                   </div>
                  
                </div>

            </div>


            <div class="col-md-12" style="padding-top: 15px;" v-if="parseInt(newTipoUser)==2">
                <div class="form-group">
                  <label for="cbuProv" class="col-sm-1 control-label">Provincia:*</label>

                  <div class="col-sm-8">
                  <select class="form-control" id="cbuProv" name="cbuProv" v-model="idProv1" @change="changeDis">
                    <template v-for="provincia, key in provincias">
                        <option v-bind:value="provincia.id">@{{ provincia.nombre }}</option>
                    </template>
                    
                  </select>
                   </div>
                </div>

</div>
                       <div class="col-md-12" style="padding-top: 10px;" v-if="parseInt(newTipoUser)==2">
        <div class="form-group">
          <label for="cbuDistrito" class="col-sm-1 control-label">Distrtito:*</label>
          <div class="col-sm-8">
            <select class="form-control" id="cbuDistrito" name="cbuDistrito" v-model="idDis1" @change="changeDep">
             <template v-for="distrito in distritos">
                <option  v-bind:value="distrito.id">@{{distrito.nombre}}</option>
             </template>
             
           </select>
         </div>
       </div>
     </div>



           <div class="col-md-12" style="padding-top: 10px;" v-if="parseInt(newTipoUser)==2">
        <div class="form-group">
          <label for="cbuDependencia" class="col-sm-1 control-label">Dependencia:*</label>
          <div class="col-sm-8">
            <select class="form-control" id="cbuDependencia" name="cbuDependencia" v-model="newDependencia">
             <option value="" disabled="">Seleccione una Dependencia</option>
             <template v-for="dependencia in dependencias">
                <option  v-bind:value="dependencia.id">@{{dependencia.cod_sis}} - @{{dependencia.nombre}}</option>
             </template>
             
           </select>
         </div>
       </div>
     </div>


            



                  <div class="col-md-12" style="padding-top: 15px;">
                  <div class="form-group">
                  <label for="txtuser" class="col-sm-1 control-label">Username:*</label>

                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="txtuser" name="txtuser" placeholder="Username" maxlength="255" @keydown="$event.keyCode === 13 ? $event.preventDefault() : false" v-model="newUsername">
                  </div>

                </div>
              </div>

              <div class="col-md-12" style="padding-top: 15px;">
                  <div class="form-group">
                  <label for="txtmail" class="col-sm-1 control-label">Correo:*</label>

                  <div class="col-sm-4">
                    <input type="email"  class="form-control" id="txtmail" name="txtmail" placeholder="example@mail.com" maxlength="500" @keydown="$event.keyCode === 13 ? $event.preventDefault() : false" v-model="newEmail">
                  </div>

                </div>
              </div>

              <div class="col-md-12" style="padding-top: 15px;">
                  <div class="form-group">
                  <label for="txtclave" class="col-sm-1 control-label">Password:*</label>

                  <div class="col-sm-4">
                    <input type="password" class="form-control" id="txtclave" name="txtclave" placeholder="********" maxlength="500"  v-model="newPassword">
                  </div>

                </div>
              </div>


                <div class="col-md-12" style="padding-top: 15px;">

                <div class="form-group">
                  <label for="cbuestado" class="col-sm-1 control-label">Estado:*</label>

                  <div class="col-sm-4">
                  <select class="form-control" id="cbuestado" name="cbuestado" v-model="newEstado">
                    <option value="1">Activado</option>
                    <option value="0">Desactivado</option>
                  </select>
                   </div>
                </div>

            </div>



            </template>

            </div>

              <!-- /.box-body -->
              <div class="box-footer" >
                <button v-if="formularioCrear" type="submit" class="btn btn-info" id="btnGuardar">Guardar</button>

                <button v-if="formularioCrear" type="reset" class="btn btn-warning" id="btnCancel" @click="cancelFormUsuario()">Cancelar</button>

                <button type="button" class="btn btn-default" id="btnClose" @click.prevent="cerrarFormUsuario()">Cerrar</button>

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