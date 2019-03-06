<?php
	class Principal extends Controller{
		function __construct(){
			parent::__construct();
			
		}
		function render(){
		$this->view->render('principal/index');
	}
	}
?>