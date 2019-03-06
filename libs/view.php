<?php
/*clases base que heredarán las siguientes clases*/
	class View{
		function __construct(){
			
		}
		/*la vista que se cargará*/
		function render($nombre){
			require 'views/'.$nombre.'.php';
		}
	}
?>