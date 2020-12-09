<?php 
require_once ("./conn/tarea-con.php");

class tarea
{
	protected $id;
	protected $nombre;
	protected $proyecto;
	protected $prioridad;
	protected $estado;

	function __construct() {
	    $this->id = 0;
	    $this->nombre = '';
	    $this->proyecto = 0;
	    $this->prioridad = 0;
	    $this->estado = 0;
	}


	function set_id($id){
		$this->id = $id;
	}
	function set_nombre($nombre){
		$this->nombre = $nombre;
	}
	function set_proyecto($proyecto){
		$this->proyecto = $proyecto;
	}
	function set_prioridad($prioridad){
		$this->prioridad = $prioridad;
	}
	function set_estado($estado){
		$this->estado = $estado;
	}


	function get_id(){
		return $this->id;
	}
	function get_nombre(){
		return $this->nombre;
	}
	function get_proyecto(){
		return $this->proyecto;
	}
	function get_prioridad(){
		return $this->prioridad;
	}
	function get_estado(){
		return $this->estado;
	}

	function get_by_id( $id ){
		$conn = new tarea_con();
		$results = $conn->get_by_id($id);
		foreach ($results as $publicacion) {
			$this->id = $id;
			$this->nombre = $publicacion['nombre'];
			$this->proyecto = $publicacion['proyecto'];
			$this->prioridad = $publicacion['prioridad'];
			$this->estado = $publicacion['estado'];
			return true;
		}
		return false;
	}

	function get_all(){
		
		$conn = new tarea_con();
		$results = $conn->get_tareas();
		$tareas = [];
		foreach ($results as $result) {
			$tarea = new tarea();
			$tarea->set_id($result['id']);
			$tarea->set_nombre($result['nombre']);
			$tarea->set_proyecto($result['proyecto']);
			$tarea->set_prioridad($result['prioridad']);
			$tarea->set_estado($result['estado']);
			$tareas[] = $tarea;
		}
		return $tareas;
		
	}
	function get_by_proyecto( $proyecto ){
		
		$conn = new tarea_con();
		$results = $conn->get_by_proyecto( $proyecto );
		$tareas = [];
		foreach ($results as $result) {
			$tarea = new tarea();
			$tarea->set_id($result['id']);
			$tarea->set_nombre($result['nombre']);
			$tarea->set_proyecto($result['proyecto']);
			$tarea->set_prioridad($result['prioridad']);
			$tarea->set_estado($result['estado']);
			$tareas[] = $tarea;
		}
		return $tareas;
		
	}
	function add(){
		$conn = new tarea_con();
		foreach ($conn->add($this->nombre, $this->proyecto, $this->prioridad, $this->estado) as $id_last) {
			return $id_last["LAST_INSERT_ID()"];
		}
		return false;
	}
	function update(){
		$conn = new tarea_con();
		return $conn->update($this->id,$this->nombre, $this->proyecto, $this->prioridad, $this->estado);
	}
	function delete(){
		$conn = new tarea_con();
		return $conn->delete($this->id);
	}

	function object_to_json(){
		$objeto = [];
		$objeto["id"] = $this->id;
		$objeto["nombre"] = $this->nombre;
		$objeto["proyecto"] = $this->proyecto;
		$objeto["prioridad"] = $this->prioridad;
		$objeto["estado"] = $this->estado;

		return $objeto;
	}
}

?>
