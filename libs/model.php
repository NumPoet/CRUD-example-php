<?php
/*clases base que heredarán las siguientes clases*/
	class Model{
		function __construct(){
			$this->db = new Database();
		}
	}
?>