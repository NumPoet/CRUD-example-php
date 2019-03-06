<?php require 'views/header.php';?>
<section>
	 <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-9">
						<h2 >Listado de Colaboradores</b></h2>
					</div>
	
					<div class="col-sm-3">
						<div class="input-group">
						  <input type="text" class="form-control border border-primary" id="buscador">
						  <div class="input-group-prepend">
						    <span class="input-group-text rounded border border-info" ><i class="fab fa-searchengin"></i></span>
						  </div>
						</div>						
					</div>
                </div>
            </div>
				
				<table class="table table-striped table-bordered"id="table_id_colaboradores">
				  <thead class="thead-secondary">
				    <tr>
				      <th scope="col">Área</th>
				      <th scope="col">Puesto</th>
				      <th scope="col">Alcaldía</th>
				      <th scope="col">Nombre</th>
				      <th scope="col">Apellido Paterno</th>
					  <th scope="col">Apellido Materno</th>
				      <th scope="col">Sexo</th>
				      <th scope="col">Acciones</th>
				    </tr>
				  </thead>
				  <tbody>
				         <?php  
				            foreach ($this->lista as $k )
				                {
				                echo '<tr>';
				                   echo '<td>' .$k->jefe.' </td>';
				                   echo '<td>' .$k->puesto.' </td>';
				                   echo '<td>' .$k->alcaldia.' </td>';
				                   echo '<td>' .$k->nombre.' </td>';
				                   echo '<td>' .$k->apellido_paterno.' </td>';
				                   echo '<td>' .$k->apellido_materno.' </td>';
				                   echo '<td>' .$k->sexo.' </td>';
				                   $this->id=$k->id;?>
				                   <td> <a class="btn btn-warning  btn-sm" href="<?php constant('URL')?>colaboradores/editar/<?php echo $this->id?>" role="button"><i class="fas fa-edit"></i></a>
				                   <a class="btn btn-danger  btn-sm" href="<?php constant('URL')?>colaboradores/eliminar/<?php echo $this->id?>"  role="button"><i class="fas fa-trash-alt"></i></a>
				                   <!--data-toggle="modal" data-target="#verModal"-->
				                   <button type="button" class="btn btn-primary btn-sm" onclick="datoColaborador(<?php echo $this->id ?>)"><i class="far fa-eye"></i></button>
				                   </td>
				                </tr>
				          <?php   }?>
				      
				  </tbody>
				</table>

				<!-- Modal -->
				<div class="modal fade" id="verModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				      	
				        <h5 class="modal-title" id="exampleModalLabel">Datos Completos</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body">
				       
				        	<form class="border border-default">
					          <div class="form-group">
					            <label for="modal_jefe" class="col-form-label">Superior Inmediato:</label>
					            <input type="text" class="form-control" id="modal_jefe" disabled="disabled">
					          </div>
					          <div class="form-group">
					            <label for="modal_puesto" class="col-form-label">Puesto:</label>
					            <input class="form-control" id="modal_puesto" disabled="disabled">
					          </div>
					          <div class="form-group">
					            <label for="modal_nivel" class="col-form-label">Nivel:</label>
					            <input class="form-control" id="modal_nivel" disabled="disabled">
					          </div>
					          <div class="form-group">
					            <label for="modal_tipo" class="col-form-label">Tipo:</label>
					            <input class="form-control" id="modal_tipo" disabled="disabled">
					          </div>
					        </form>				        
				      </div>
				    </div>
				  </div>
				</div>
</div>
</section>
<script> <?php echo $this->alerta; ?></script>	
<?php require 'views/footer.php';?>