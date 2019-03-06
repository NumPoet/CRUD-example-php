<?php
class Puestos extends Controller{
	function __construct(){

		parent::__construct();
		$this->view->datos="";
		$this->view->valores=null;
		$this->view->alerta=null;
		$this->view->id=0;
	}

	function render(){
		session_start();
		if (isset($_SESSION['mensaje'])){
		$this->mensajeAlerta();
		$this->view->lista = $this->model->get();
		$this->view->render('puestos/index');
		session_destroy();
		}else{
			$this->view->lista = $this->model->get();
			$this->view->render('puestos/index');
		}
		
	}

	function editar($param = null){
		$id = $param[0];
		$valores = $this->model->getById($id);
		$this->view->valores =$valores[0];
		$this->view->id=$id;
		$this->view->datos=$this->listarSuperior();
		$this->view->render('puestos/detalle');
	}
	
	function listarSuperior(){
		$cargos=$this->model->listarSuperior();
		return $cargos;
	}


	function eliminar($param = null){
		session_start();
		$id = $param[0];
		$mensaje = "";
		if($this->model->borrar($id)){
			$mensaje ="Dato Eliminado Correctamente";
		}else{
			$mensaje .="Fue imposible eliminar el registro";
		}
		$_SESSION['mensaje'] = $mensaje;
		header('Location:'.constant('URL').'puestos');
	}
	

	function ver(){
		$id = $_GET['id'];
		$puesto = $this->model->getById($id);
		$data=$puesto[0];
		echo json_encode($data);

	}

	function nuevo(){
		session_start();
		if (isset($_SESSION['mensaje'])){
		$this->view->datos=$this->listarSuperior();
		$this->mensajeAlerta();;
		$this->view->render('puestos/crear');
		session_destroy();
		}else{
			$this->view->datos=$this->listarSuperior();
			$this->view->render('puestos/crear');
		}
		
	}

	function registrarPuesto(){
		session_start();
		$superior =$_POST['superior'];
		$puesto   =$_POST['puesto'];
		$nivel    =$_POST['nivel'];
		$tipo     =$_POST['tipo'];
		$mensaje = "";
		if($this->model->insert(['superior'=>$superior,'puesto'=>$puesto,'nivel' =>$nivel,'tipo'  =>$tipo])){
			$mensaje ="Dato Insertado Correctamente";
		}else{
			$mensaje ="Fue imposible insertar el registro";
		}
		
		$_SESSION['mensaje'] = $mensaje;
		header('Location:'.constant('URL').'puestos/nuevo');
	}

	

	function editarPuesto(){
		session_start();
		$superior =$_POST['superior'];
		$puesto   =$_POST['puesto'];
		$nivel    =$_POST['nivel'];
		$tipo     =$_POST['tipo'];
		$id 	  =$_POST['id'];
		$id_puesto=$this->model->validaPuesto($puesto);		
		if($id_puesto[0]['id']==$superior)
				$superior=NULL;
		$mensaje = "";
		if($this->model->update(['superior'=>$superior,'puesto'=>$puesto,'nivel' =>$nivel,'tipo'  =>$tipo,'id' =>$id])){
			$mensaje ="Dato Actualizado Correctamente";
		}else{
			$mensaje .="Fue imposible actualizar el registro";
		}
		
		$_SESSION['mensaje'] = $mensaje;
		$this->mensajeAlerta();
		header('Location:'.constant('URL').'puestos');

	}
	function mensajeAlerta(){
		$this->view->alerta = " $(document).ready(function() {
    	toastr.info('".$_SESSION['mensaje']."', 'Alerta') });";
	}

}
?>