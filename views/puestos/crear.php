<?php require 'views/header.php';?>
<div class="card border-primary mb-3 mx-auto" style="max-width: 80rem;">
<section class="wrapper">
  <div class="p-2 mb-2 bg-info text-white shadow rounded"><h4 id="" class="text-center">Formulario de Registro</h4></div>
    <form action="<?php echo constant('URL');?>puestos/registrarPuesto" method="POST">
      <div class="form-group">
          <div class="form-row">
            <div class="form-group col-xs-12 col-md-6">
              <label for="puesto">Cargo</label>
              <input type="text" class="form-control " placeholder="Nombre del Cargo Institucional" id="puesto" name="puesto" required="required">
            </div>
            <div class="form-group col-xs-12 col-md-6">
              <label for="tipo">Clasificación:</label>
              <select class="form-control selecciones" id="select" name="tipo">
                <option value="Estructura">Estructura</option>
                <option value="Honorario">Honorario</option>
              </select>
            </div>
           </div>
      </div>
      <div class="form-group">
        <div class="form-row">
          <div class="col-xs-12 col-md-9">
          <label for="superior">Superior Inmediato:</label>
          <select class="form-control selecciones" id="superior" name="superior">
             <?php  
            foreach ($this->datos as $k)
                {
                    echo '<option value="'.$k->ID.'">'.$k->PUESTO.'</option>';
             }?>
          </select>
          </div>
          <div class="col-xs-12 col-md-3">
            <label for="nivel">Nivel:</label>
           
          <select class="form-control selecciones" id="nivel" name="nivel">
            <option value=0 selected="true">0-Honorario</option>
            <option value=20>20-Enlace</option>
            <option value=24>24-LCP</option>
            <option value=25>25-JUD</option>
            <option value=29>29-Subdirector</option>
            <option value=39>39-Director</option>
            <option value=46>46-Coordinador</option>
          </select>
          </div>
          </div>
      </div>
      <div class="form-group row ">
            <div class="col-sm-4"></div>
            <div class="col-sm-6 mx-auto">
              <button type="button" id="cancelarColaborador" class="btn btn-danger" onclick="cancelaVentana()">Cancelar</button>
              <button type="submit" class="btn btn-success">Registrar</button>
            </div>
          </div>
    </form>
</section>
</div>  
<script><?php echo $this->alerta; ?>
  function cancelaVentana() {
  window.location.replace("http://localhost/sistema/puestos/nuevo");
}
</script>
<?php require 'views/footer.php';?>


