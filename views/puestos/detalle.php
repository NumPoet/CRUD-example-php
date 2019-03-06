<?php require 'views/header.php';?>
   <div class="card border-primary mb-3 mx-auto" style="max-width: 80rem;">
  <section class="wrapper">
    <div class="p-2 mb-2 bg-info text-white shadow rounded"><h4 id="" class="text-center">Editar Registro</h4></div>

    <form action="<?php echo constant('URL');?>puestos/editarPuesto" method="POST">
      <div class="form-group">
          <div class="form-row">
            <div class="form-group col">
              <label for="puesto">Cargo</label>
              <input type="text" class="form-control "id="puesto" name="puesto" required="required" value="<?php echo $this->valores->PUESTO ?>">
            </div>
            <div class="form-group col">
              <label for="tipo">Clasificación:</label>
              <select class="form-control selecciones" id="tipo" name="tipo">
                <option value="Estructura">Estructura</option>
                <option value="Honorario">Honorario</option>
              </select>
            </div>
           </div>
      </div>
      <div class="form-group">
        <div class="form-row">
          <div class="col-9">
          <label for="superior">Superior Inmediato:</label>
          <select class="form-control selecciones" id="superior" name="superior">
             <?php  
            foreach ($this->datos as $k)
                {
                       echo '<option value="'.$k->ID.'">'.$k->PUESTO.'</option>';
                 
                }?>
          </select>
          </div>
          <div class="col-3">
            <label for="nivel">Nivel:</label>
           
          <select class="form-control selecciones" id="nivel" name="nivel">
            <option value=0>0-Honorario</option>
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
      <div class="form-group row">
        <input type="text" hidden value="<?php echo $this->id; ?>" name="id">
         <div class="col-sm-4"></div>
        <div class="col-sm-6 mx-auto">
           <button type="button" id="cancelarColaborador" class="btn btn-danger" onclick="cancelaVentana()">Cancelar</button>
          <button type="submit" class="btn btn-primary">Editar</button>
        </div>
      </div>
    </form>
  </section>
</div>
<?php if(is_null($this->valores->SUPID)){$this->valores->SUPID=1;}  ?>
<script>
  function cancelaVentana() {
  window.location.replace("http://localhost/sistema/puestos");
}
  $(document).ready(function() {
     var nivel=document.getElementById("nivel");
     var tipo=document.getElementById("tipo");
     var superior=document.getElementById("superior");
     var nivel_comp=<?php echo $this->valores->NIVEL;?>;
     var tipo_comp="<?php echo $this->valores->TIPO;?>";
     var superior_comp=<?php echo $this->valores->SUPID;?>;
     nivel.selectedIndex=asignacion(nivel,nivel_comp);
     tipo.selectedIndex=asignacion(tipo,tipo_comp);
     superior.selectedIndex=asignacion(superior,superior_comp);
  });

 function asignacion(dd,evaluado) {
   var aryOptions=dd.getElementsByTagName('option');
     var cpt=0;
     var indexValue=false;
    for(cpt=0;cpt<aryOptions.length;cpt++){
      if (aryOptions[cpt].value==evaluado) {
        indexValue=cpt;  }
      }
    return indexValue;
 }
</script>
<?php require 'views/footer.php';?>