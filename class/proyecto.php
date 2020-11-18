<?php 
require_once ("./conn/proyectos-con.php");

class proyecto
{
	protected $id;
	protected $nombre;
	protected $imagen;
	protected $estado;

	function __construct() {
	    $this->id = 0;
	    $this->nombre = '';
	    $this->imagen = '';
	    $this->estado = '';
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
	function set_estado($estado){
		$this->estado = $estado;
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
	function get_estado(){
		return $this->estado;
	}

	function get_estado_text(){
		$text = '';
		if($this->estado == '0'){
			return 'Camptura de requerimientos';
		}else if($this->estado == '1'){
			return 'Diseño';
		}else if($this->estado == '2'){
			return 'Implementación';
		}else if($this->estado == '3'){
			return 'Sitio web entregado';
		}else if($this->estado == '4'){
			return 'Post Venta - Web';
		}else if($this->estado == '5'){
			return 'Marketing';
		}else if($this->estado == '6'){
			return 'Finalizado';
		}
	}

	function get_by_id( $id ){
		$conn = new proyecto_con();
		$this->id = $id;
		$results = $conn->get_by_id($this->id);
		foreach ($results as $publicacion) {
			$this->nombre = $publicacion['nombre'];
			$this->imagen = $publicacion['imagen'];
			$this->estado = $publicacion['estado'];
		}
	}

	function get_all(){
		
		$conn = new proyecto_con();
		$results = $conn->get_proyectos();
		$proyectos = [];
		foreach ($results as $result) {
			$proyecto = new proyecto();
			$proyecto->set_id($result['id']);
			$proyecto->set_nombre($result['nombre']);
			$proyecto->set_imagen($result['imagen']);
			$proyecto->set_estado($result['estado']);
			$proyectos[] = $proyecto;
		}
		return $proyectos;
		
	}
	function add(){
		$conn = new proyecto_con();
		return $conn->add($this->nombre, $this->imagen);

	}
	function update(){
		$conn = new proyecto_con();
		return $conn->update($this->id,$this->nombre,$this->imagen,$this->estado);
	}
	function subir_etapa( $id ){
		$this->get_by_id($id);
		$estado = intval($this->estado);
		if($estado < 6){
			$this->set_estado($estado+1);
			return $this->update();
		}else{
			return false;
		}
	}

	function bajar_etapa( $id ){
		$this->get_by_id($id);
		$estado = intval($this->estado);
		if($estado >= 0){
			$this->set_estado($estado-1);
			return $this->update();
		}else{
			return false;
		}
	}

	function object_to_json(){
		$objeto = [];
		$objeto["id"] = $this->id;
		$objeto["nombre"] = $this->nombre;
		$objeto["imagen"] = $this->imagen;
		$objeto["estado"] = $this->estado;

		return $objeto;
	}
}

?>
