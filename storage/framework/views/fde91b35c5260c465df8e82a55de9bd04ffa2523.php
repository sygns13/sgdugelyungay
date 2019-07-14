<div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Formulario de Solicitud de Trámite</h3>
    </div>
  
    <div class="box-body">

      
  
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
  
  
  

  
  