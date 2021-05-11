<?php 
require_once ("./conn/equipo-con.php");

class equipo
{
	protected $id;
	protected $nombre;
	protected $coordinador;

	function __construct() {
	    $this->id = 0;
	    $this->nombre = '';
	    $this->coordinador = '';
	}


	function set_id($id){
		$this->id = $id;
	}
	function set_nombre($nombre){
		$this->nombre = $nombre;
	}
	function set_coordinador($coordinador){
		$this->coordinador = $coordinador;
	}


	function get_id(){
		return $this->id;
	}
	function get_nombre(){
		return $this->nombre;
	}
	function get_coordinador(){
		return $this->coordinador;
	}

	function get_by_id( $id ){
		$conn = new equipo_con();
		$results = $conn->get_by_id($id);
		foreach ($results as $equipo) {
			$this->id = $id;
			$this->nombre = $equipo['nombre'];
			$this->coordinador = $equipo['coordinador'];
			return true;
		}
		return false;
	}

	function get_all(){
		$conn = new equipo_con();
		$results = $conn->get_equipos();
		$equipos = [];
		foreach ($results as $result) {
			$equipo = new equipo();
			$equipo->set_id($result['id']);
			$equipo->set_nombre($result['nombre']);
			$equipo->set_coordinador($result['coordinador']);
			$equipos[] = $equipo;
		}
		return $equipos;
		
	}
	function add(){
		$conn = new equipo_con();
		foreach ($conn->add($this->nombre, $this->coordinador) as $result) {
			if($result != false){
				return $result['LAST_INSERT_ID()'];
			}
			return $result;
		}

	}
	function update(){
		$conn = new equipo_con();
		return $conn->update($this->id,$this->nombre,$this->coordinador);
	}

	function object_to_json(){
		$objeto = [];
		$objeto["id"] = $this->id;
		$objeto["nombre"] = $this->nombre;
		$objeto["coordinador"] = $this->coordinador;

		return $objeto;
	}
	function delete(){
		$conn = new equipo_con();
		return $conn->delete($this->id);
	}
}

?>
