<?php 
class Colaboradores extends Controller{
	function __construct(){
		parent::__construct();
		$this->id=0;
	}
	function render(){
		session_start();
		if (isset($_SESSION['mensaje'])){
		$this->alerta();
		$this->view->lista = $this->model->getDatosTabla();
		$this->view->render('colaboradores/index');
		session_destroy();
		}
		else{
		$this->view->lista = $this->model->getDatosTabla();
		$this->view->render('colaboradores/index');
		}
	}
	function nuevo(){
		session_start();
		$this->obtenerDatos();
		if(isset($_SESSION['mensaje'])){
		$this->alerta();
		$this->view->render('colaboradores/nuevo');
		session_destroy();
		}else{
			$this->view->render('colaboradores/nuevo');
		}
	}
	function editar($param = null){
		$id = $param[0];
		$this->obtenerDatos();
		$valores = $this->model->getById($id);
		$this->view->valores =$valores[0];
		$this->view->id=$id;
		$this->view->render('colaboradores/editar');

	}
	function editarColaborador(){
		session_start();
		$arrayColaboradores=$_POST;
		$mensaje = "";
			if($this->model->update($arrayColaboradores)){
			$mensaje ="Dato Actualizado Correctamente";
			}else{
			$mensaje .="Fue imposible actualizar el registro";
			}
		$_SESSION['mensaje'] = $mensaje;
		header('Location:'.constant('URL').'colaboradores');
	}
	function registrarColaborador(){
		session_start();
		$arrayColaboradores=$_POST;
		$mensaje = "";
		if(!is_null($this->model->insertarColaborador($arrayColaboradores))){
			echo $mensaje ="Dato Insertado Correctamente";
		} else{
			$mensaje ="Fue imposible insertar el registro";
		}
		$_SESSION['mensaje'] = $mensaje;
		header('Location:'.constant('URL').'colaboradores/nuevo');
		
	}
	function obtenerDatos(){
		$this->view->puestos =$this->model->getPuestos();
		$this->view->niveles =$this->model->getNiveles();
		$this->view->documentos =$this->model->getDocumentos();
		$this->view->alcaldias =$this->model->getAlcaldias();
	}
	function alerta(){
		$this->view->alerta = " $(document).ready(function() {
    	toastr.info('".$_SESSION['mensaje']."', 'Alerta') });";
	}
}
?>