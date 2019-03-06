<?php
/*Se controlan todos los controladores, se hace el mapeo*/
require_once 'controllers/errores.php';
class App{

	function __construct(){
		$url=isset($_GET['url']) ? $_GET['url']: null;
		$url=rtrim($url,'/');
		$url=explode('/',$url);
		/*cuando se ingresa sin definir controlador*/
	 if(empty($url[0])){
	 	$archivoController='controllers/principal.php';
	 	require_once $archivoController;
	 	$controller= new Principal();
	 	//$controller->loadModel(principal);
	 	$controller->render();
	 	return false;
	 }
		/*crear instancia del controlador que se le proporione*/
		$archivoController='controllers/'.$url[0].'.php';
		if(file_exists($archivoController)){
			require_once $archivoController;
			$controller= new $url[0];
			$controller->loadModel($url[0]);
			//número de elementos del arreglo
			$parametros = sizeof($url);
			/*verificar que existe el método*/
			if ($parametros>1) {
				if ($parametros>2) {
					$parametro_array = [];
					for ($i=2; $i <$parametros ; $i++) {
						array_push($parametro_array,$url[$i]);
					}
					$controller->{$url[1]}($parametro_array);
				}else{
					$controller->{$url[1]}();
				}
			}
			else{
				$controller->render();
			}
		}else{
			$controller= new Errores();
			$controller->render();
		}
	}
}
?>
