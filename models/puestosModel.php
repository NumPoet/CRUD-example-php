<?php
class PuestosModel extends Model{
	public function __construct(){
		parent::__construct();
	}

	public function borrar($id){
		try{
			$consulta=$this->db->connect()->prepare(
				"DELETE FROM cargos WHERE id=:id");
			$consulta->execute([
				'id'  =>$id]);
			return true;
		}catch(PDOException $e){
			//die();

			$controller->mensaje=$e->getMessage();

			return false;
		}

	}

	public function get(){
		try{
			$result=array();
			$consulta=$this->db->connect()->prepare("SELECT SUPERIOR.PUESTO AS JEFE, CARGO.PUESTO, CARGO.NIVEL, CARGO.TIPO, CARGO.ID FROM CARGOS AS CARGO LEFT JOIN CARGOS AS SUPERIOR ON SUPERIOR.ID=CARGO.SUPERIOR;");
			$consulta->execute();
			return $consulta->fetchAll(PDO::FETCH_OBJ);
		}catch(PDOException $e){
			$controller->mensaje=$e->getMessage();
			return false;
		}

	}

	public function getById($id){
		try{
			$result=array();
			$consulta=$this->db->connect()->prepare("SELECT SUPERIOR.PUESTO AS JEFE, CARGO.PUESTO, CARGO.NIVEL, CARGO.TIPO, SUPERIOR.ID AS SUPID FROM CARGOS AS CARGO LEFT JOIN CARGOS AS SUPERIOR ON SUPERIOR.ID=CARGO.SUPERIOR WHERE CARGO.ID=:ID;");
			$consulta->execute(['ID' => $id]);
			return $consulta->fetchAll(PDO::FETCH_OBJ);
		}catch(PDOException $e){
			$controller->mensaje=$e->getMessage();
			return false;
		}
	}
	public function validaPuesto($puesto){
			
		try{
			$result=array();
			$consulta=$this->db->connect()->prepare("SELECT id FROM CARGOS WHERE puesto=:puesto");
			$consulta->execute(['puesto' => $puesto]);
			return $consulta->fetchAll(PDO::FETCH_ASSOC);
		}catch(PDOException $e){
			$controller->mensaje=$e->getMessage();
			return false;
		}
	}

	public function listarSuperior(){
			
		try{
			$result=array();
			$consulta=$this->db->connect()->prepare("SELECT ID,PUESTO FROM CARGOS");
			$consulta->execute();
			return $consulta->fetchAll(PDO::FETCH_OBJ);
		}catch(PDOException $e){
			$controller->mensaje=$e->getMessage();
			return false;
		}
	}
	public function insert($datos){
		try{
			$consulta=$this->db->connect()->prepare('INSERT INTO CARGOS(SUPERIOR,PUESTO,NIVEL,TIPO) VALUES(:superior, :puesto, :nivel, :tipo)');
			$consulta->execute([
			'superior'=>$datos['superior'],
			'puesto'=>$datos['puesto'],
			'nivel' =>$datos['nivel'],
			'tipo'  =>$datos['tipo']]);
			return true;
		}catch(PDOException $e){
			$controller->mensaje=$e->getMessage();
			return false;
		}	
	}
	
		public function update($datos){
		try{
			$consulta=$this->db->connect()->prepare(
				"UPDATE cargos SET
				superior =:superior,
				puesto   =:puesto,
				nivel    =:nivel,
				tipo     =:tipo WHERE id=:id");
			$consulta->execute([
			'superior' =>$datos['superior'],
			'puesto'   =>$datos['puesto'],
			'nivel'    =>$datos['nivel'],
			'tipo'     =>$datos['tipo'],
			'id'       =>$datos['id']]);
			return true;
		}catch(PDOException $e){
			$controller->mensaje=$e->getMessage();
			return false;
		}	
	}
}
?>