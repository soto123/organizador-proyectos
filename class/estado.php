<?php 
require_once ("./conn/estado-con.php");

class estado
{
	protected $id;
	protected $nombre;
	protected $imagen;

	function __construct() {
	    $this->id = 0;
	    $this->nombre = '';
	    $this->imagen = '';
	}


	function set_id($id){
		$this->id = $id;
	}
	function set_nombre($nombre){
		$this->nombre = $nombre;
	}
	function set_imagen($imagen){
		$this->imagen = $imagen;
	}


	function get_id(){
		return $this->id;
	}
	function get_nombre(){
		return $this->nombre;
	}
	function get_imagen(){
		return $this->imagen;
	}

	function get_by_id( $id ){
		$conn = new estado_con();
		$results = $conn->get_by_id($id);
		foreach ($results as $estado) {
			$this->id = $id;
			$this->nombre = $estado['nombre'];
			$this->imagen = $estado['imagen'];
			return true;
		}
		return false;
	}

	function get_all(){
		
		$conn = new estado_con();
		$results = $conn->get_estados();
		$estados = [];
		foreach ($results as $result) {
			$estado = new estado();
			$estado->set_id($result['id']);
			$estado->set_nombre($result['nombre']);
			$estado->set_imagen($result['imagen']);
			$estados[] = $estado;
		}
		return $estados;
		
	}
	function add(){
		$conn = new estado_con();
		foreach ($conn->add($this->nombre, $this->imagen) as $result) {
			if($result != false){
				return $result['LAST_INSERT_ID()'];
			}
			return $result;
		}

	}
	function update(){
		$conn = new estado_con();
		return $conn->update($this->id,$this->nombre,$this->imagen);
	}

	function object_to_json(){
		$objeto = [];
		$objeto["id"] = $this->id;
		$objeto["nombre"] = $this->nombre;
		$objeto["imagen"] = $this->imagen;

		return $objeto;
	}
	function delete(){
		$conn = new estado_con();
		return $conn->delete($this->id);
	}
}

?>
