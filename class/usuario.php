<?php 
require_once ("./conn/usuario-con.php");

class usuario
{
	protected $id;
	protected $nombre;
	protected $correo;
	protected $imagen;

	function __construct() {
	    $this->id = 0;
	    $this->nombre = '';
	    $this->correo = '';
	    $this->imagen = '';
	}


	function set_id($id){
		$this->id = $id;
	}
	function set_nombre($nombre){
		$this->nombre = $nombre;
	}
	function set_correo($correo){
		$this->correo = $correo;
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
	function get_correo(){
		return $this->correo;
	}
	function get_imagen(){
		return $this->imagen;
	}

	function get_by_id( $id ){
		$conn = new usuario_con();
		$this->id = $id;
		$results = $conn->get_by_id($this->id);
		foreach ($results as $publicacion) {
			$this->nombre = $publicacion['nombre'];
			$this->imagen = $publicacion['imagen'];
			$this->correo = $publicacion['correo'];
		}
	}

	function get_all(){
		
		$conn = new usuario_con();
		$results = $conn->get_usuarios();
		$usuarios = [];
		foreach ($results as $result) {
			$usuario = new usuario();
			$usuario->set_id($result['id']);
			$usuario->set_nombre($result['nombre']);
			$usuario->set_imagen($result['imagen']);
			$usuario->set_correo($result['correo']);
			$usuarios[] = $usuario;
		}
		return $usuarios;
		
	}
	function add(){
		$conn = new usuario_con();
		return $conn->add($this->nombre, $this->imagen, $this->correo);

	}
	function update(){
		$conn = new usuario_con();
		return $conn->update($this->id,$this->nombre,$this->imagen, $this->correo);
	}

	function object_to_json(){
		$objeto = [];
		$objeto["id"] = $this->id;
		$objeto["nombre"] = $this->nombre;
		$objeto["imagen"] = $this->imagen;
		$objeto["correo"] = $this->correo;

		return $objeto;
	}
}

?>
