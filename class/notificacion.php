<?php 
require_once ("./conn/notificacion-con.php");

class notificacion
{
	protected $id;
	protected $usuario;
	protected $tarea;

	function __construct() {
	    $this->id = 0;
	    $this->usuario = '';
	    $this->tarea = '';
	}


	function set_id($id){
		$this->id = $id;
	}
	function set_usuario($usuario){
		$this->usuario = $usuario;
	}
	function set_tarea($tarea){
		$this->tarea = $tarea;
	}


	function get_id(){
		return $this->id;
	}
	function get_usuario(){
		return $this->usuario;
	}
	function get_tarea(){
		return $this->tarea;
	}

	function get_by_id( $id ){
		$conn = new notificacion_con();
		$results = $conn->get_by_id($id);
		foreach ($results as $notificacion) {
			$this->id = $id;
			$this->usuario = $notificacion['usuario'];
			$this->tarea = $notificacion['tarea'];
			return true;
		}
		return false;
	}
	function get_by_tarea( $tarea ){
		$conn = new notificacion_con();
		$results = $conn->get_by_tarea( $tarea );
		$notificaciones = [];
		foreach ($results as $result) {

			$notificacion = new notificacion();
			$notificacion->set_id($result['id']);
			$notificacion->set_usuario($result['usuario']);
			$notificacion->set_tarea($result['tarea']);
			$notificaciones[] = $notificacion;
		}
		return $notificaciones;
	}
	function get_all(){
		
		$conn = new notificacion_con();
		$results = $conn->get_notificaciones();
		$notificaciones = [];
		foreach ($results as $result) {
			$notificacion = new notificacion();
			$notificacion->set_id($result['id']);
			$notificacion->set_usuario($result['usuario']);
			$notificacion->set_tarea($result['tarea']);
			$notificaciones[] = $notificacion;
		}
		return $notificaciones;
		
	}
	function add(){
		$conn = new notificacion_con();
		foreach ($conn->add($this->usuario, $this->tarea) as $result) {
			if($result != false){
				return $result['LAST_INSERT_ID()'];
			}
			return $result;
		}

	}
	function update(){
		$conn = new notificacion_con();
		return $conn->update($this->id,$this->usuario,$this->tarea);
	}

	function object_to_json(){
		$objeto = [];
		$objeto["id"] = $this->id;
		$objeto["usuario"] = $this->usuario;
		$objeto["tarea"] = $this->tarea;

		return $objeto;
	}
	function delete(){
		$conn = new notificacion_con();
		return $conn->delete($this->id);
	}
}

?>
