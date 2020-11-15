<?php 
require_once ("./global-variables.php");
class proyecto_con
{
	protected $servername;
	protected $username;
	protected $password;
	protected $db;

	function __construct() {
	    $variables = new global_variables();
		$this->servername=$variables->get_servername();
		$this->username=$variables->get_username();
		$this->password=$variables->get_password();
		$this->db=$variables->get_db();
	}
	// Create connection
	protected function conectar(){
		$conn = new mysqli($this->servername, $this->username, $this->password, $this->db);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 
		$sql = "SELECT * FROM proyectos";
		$result = $conn->query($sql);
		
		return $conn;
	}
	function get_proyectos(){

		$conn=$this->conectar();

		$sql = "SELECT * FROM proyectos ORDER BY `proyectos`.`id` DESC";

		$result = $conn->query($sql);
		
		return $result;	
	}

	function get_by_id($id){

		$conn=$this->conectar();

		$sql = "SELECT * FROM proyectos WHERE `id`=$id";

		$result = $conn->query($sql);
		
		return $result;	
	}
	function update($id,$nombre,$imagen,$estado){
		$conn=$this->conectar();
		$sql = "UPDATE `proyectos` SET `imagen` = '$imagen', `estado` = '$estado', `nombre`='$nombre' WHERE `proyectos`.`id` = $id;";

		$result = $conn->query($sql);
		return $result;	
	}
	function add( $nombre, $imagen ){
		return $nombre.' / '.$imagen;
	}

	function subir_etapa( $id ){
		
	}
	
}
?>
