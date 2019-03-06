<?php 
class ColaboradoresModel extends Model{
	public function __construct(){
		parent::__construct();

	}
	public function getPuestos(){
		$result=array();
		try{
			$consulta=$this->db->connect()->prepare("SELECT id,puesto FROM CARGOS");
			$consulta->execute();
			return $consulta->fetchAll(PDO::FETCH_OBJ);
		}catch(PDOException $e){
			$controller->mensaje=$e->getMessage();
			return $result=null;
		}
	}
	public function getAlcaldias(){
		$result=array();
		try{
			$consulta=$this->db->connect()->prepare("SELECT id,nombre FROM alcaldias");
			$consulta->execute();
			return $consulta->fetchAll(PDO::FETCH_OBJ);
		}catch(PDOException $e){
			$controller->mensaje=$e->getMessage();
			return $result=null;
		}
	}

	public function getNiveles(){
		$result=array();
		try{
			$consulta=$this->db->connect()->prepare("SELECT id,nivel FROM NIVELES_EDUCATIVOS");
			$consulta->execute();
			return $consulta->fetchAll(PDO::FETCH_OBJ);
		}catch(PDOException $e){
			$controller->mensaje=$e->getMessage();
			return $result=null;
		}
	}
	public function getDocumentos(){
		$result=array();
		try{
			$consulta=$this->db->connect()->prepare("SELECT id,documento FROM documentos");
			$consulta->execute();
			return $consulta->fetchAll(PDO::FETCH_OBJ);
		}catch(PDOException $e){
			$controller->mensaje=$e->getMessage();
			return $result=null;
		}
	}
	public function getTodo(){
		$result=array();
		try{
				$consulta=$this->db->connect()->prepare("SELECT sup.puesto as jefe, car.puesto,alc.nombre as alcaldia,col.nombre,col.apellido_paterno,col.apellido_materno,col.sexo,col.alta, col.curp,cf.especialidad,cf.porcentaje,doc.documento,niv.nivel FROM colaboradores as col 
					LEFT JOIN colaborador_formacion as cf on cf.colaborador=col.id
					INNER JOIN cargos as car on col.cargo=car.id
					LEFT JOIN cargos as sup on car.superior=sup.id
					LEFT JOIN alcaldias as alc on col.alcaldia=alc.id
					LEFT JOIN documentos as doc on doc.id=cf.documento
					LEFT JOIN niveles_educativos as niv on niv.id=cf.nivel;");
			$consulta->execute();
			return $consulta->fetchAll(PDO::FETCH_OBJ);
		}catch(PDOException $e){
			$controller->mensaje=$e->getMessage();
			return $result=null;
		}
	}
	public function getDatosTabla(){
		$result=array();
		try{$consulta =$this->db->connect()->prepare("SELECT sup.puesto as jefe, car.puesto,alc.nombre as alcaldia,col.nombre,col.apellido_paterno,col.apellido_materno,col.sexo, col.id FROM colaboradores as col LEFT JOIN cargos as car on col.cargo=car.id LEFT JOIN cargos as sup on car.superior=sup.id LEFT JOIN alcaldias as alc on col.alcaldia=alc.id;");
			$consulta->execute();
			return $consulta->fetchAll(PDO::FETCH_OBJ);
		}catch(PDOException $e){
			$controller->mensaje=$e->getMessage();
			return $result=null;
		}
	}
	public function insertarColaborador($datos){
		try{
			$consulta=$this->db->connect();
			$quer=$consulta->prepare('INSERT INTO colaboradores(
				cargo,nombre,apellido_paterno,apellido_materno,sexo,alta,curp,alcaldia,telefono,correo) VALUES(:cargo,:nombre,:apellido_paterno,:apellido_materno,:sexo,:alta,:curp,:alcaldia,:telefono,:correo)');
			$quer->bindParam(":cargo",$datos['cargo'],PDO::PARAM_INT);
			$quer->bindParam(":nombre",$datos['nombre'],PDO::PARAM_STR);
			$quer->bindParam(":apellido_paterno",$datos['apellido_paterno'],PDO::PARAM_STR);
			$quer->bindParam(":apellido_materno",$datos['apellido_materno'],PDO::PARAM_STR);
			$quer->bindParam(":sexo",$datos['sexo'],PDO::PARAM_STR);
			$quer->bindParam(":alta",$datos['alta'],PDO::PARAM_STR);
			$quer->bindParam(":curp",$datos['curp'],PDO::PARAM_STR);
			$quer->bindParam(":alcaldia",$datos['alcaldias'],PDO::PARAM_INT);
			$quer->bindParam(":telefono",$datos['telefono'],PDO::PARAM_STR);
			$quer->bindParam(":correo",$datos['correo'],PDO::PARAM_STR);
			$quer->execute();
			$id= $consulta->lastInsertId();
			$consulta2=$this->db->connect();
			$quer=$consulta2->prepare('INSERT INTO colaborador_formacion(
				nivel,colaborador,documento,especialidad,porcentaje) VALUES(:nivel,:colaborador,:documento,:especialidad,:porcentaje)');
			$quer->bindParam(":nivel",$datos['nivel'],PDO::PARAM_INT);
			$quer->bindParam(":colaborador",$id,PDO::PARAM_INT);
			$quer->bindParam(":documento",$datos['documento'],PDO::PARAM_INT);
			$quer->bindParam(":especialidad",$datos['especialidad'],PDO::PARAM_STR);
			$quer->bindParam(":porcentaje",$datos['porcentaje'],PDO::PARAM_INT);
			$quer->execute();
			return true;
		}catch(PDOException $e){
			$controller->mensaje=$e->getMessage();
			return null;
		}
	}
	public function getById($id){
		try{
			$result=array();
			$consulta =$this->db->connect()->prepare("SELECT car.id as cargo,car.puesto,alc.id as aid, alc.nombre AS alcaldia, col.nombre, col.apellido_paterno, col.apellido_materno, col.curp,col.correo,col.telefono,col.sexo,col.alta,niv.nivel,niv.id as idn,doc.id as idd,doc.documento,cf.especialidad,cf.porcentaje FROM
			colaboradores AS col LEFT JOIN cargos AS car on col.cargo =car.id
			LEFT JOIN alcaldias AS alc on alc.id                      =col.alcaldia
			LEFT JOIN colaborador_formacion AS cf on cf.colaborador   =col.id
			LEFT JOIN documentos AS doc on doc.id                     =cf.documento
			LEFT JOIN niveles_educativos AS niv on niv.id             =cf.nivel WHERE col.id=:id;");
			$consulta->execute(['id' => $id]);
			return $consulta->fetchAll(PDO::FETCH_OBJ);
		}catch(PDOException $e){
			$controller->mensaje=$e->getMessage();
			return null;
		}
	}

	public function update($datos){
		try{
			$consulta=$this->db->connect()->prepare(
				"UPDATE colaboradores SET
				cargo            =:cargo,
				nombre           =:nombre,
				apellido_paterno =:apellido_paterno,
				apellido_materno =:apellido_materno, 
				sexo             =:sexo,
				alta             =:alta,
				curp             =:curp,
				alcaldia         =:alcaldia,
				telefono         =:telefono,
				correo           =:correo
				WHERE id=:id");
			$consulta->execute([
			'cargo'            =>$datos['cargo'],
			'nombre'           =>$datos['nombre'],
			'apellido_paterno' =>$datos['apellido_paterno'],
			'apellido_materno' =>$datos['apellido_materno'],
			'sexo'             =>$datos['sexo'],
			'alta'             =>$datos['alta'],
			'curp'             =>$datos['curp'],
			'alcaldia'         =>$datos['alcaldias'],
			'telefono'         =>$datos['telefono'],
			'correo'           =>$datos['correo'],
			'id'               =>$datos['id']
		]);
			$consulta2=$this->db->connect()->prepare(
				"UPDATE colaborador_formacion SET
				nivel             =:nivel,
				colaborador       =:colaborador,
				documento         =:documento,
				especialidad      =:especialidad,
				porcentaje        =:porcentaje
				WHERE colaborador =:id");
			$consulta2->execute([
			'nivel'        =>$datos['nivel'],
			'colaborador'  =>$datos['colaborador'],
			'documento'    =>$datos['documento'],
			'especialidad' =>$datos['especialidad'],
			'porcentaje' =>$datos['porcentaje'],
			'id'         =>$datos['id']
		]);
			return true;
		}catch(PDOException $e){
			//$controller->mensaje=
			$controller->mensaje=$e->getMessage();
			return false;
		}	
	}


}

?>