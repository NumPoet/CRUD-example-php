<?php
/*
Clase dedicada al envío de mensajes de error
en caso de que la ruta solicitada no exista o no  se encuentre
*/
	class Errores extends Controller{
		function __construct(){
			parent::__construct();

		}
		function render(){
			$this->view->mensaje="Hubo un error en la solicitud";
			$this->view->render('errores/index');
		}
	}
?>
