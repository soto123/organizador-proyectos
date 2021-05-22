<?php 
require_once ("./global-variables.php");
class usuario_con
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
		$sql = "SELECT * FROM usuarios";
		$result = $conn->query($sql);
		
		return $conn;
	}
	function get_usuarios(){

		$conn=$this->conectar();

		$sql = "SELECT * FROM usuarios ORDER BY `usuarios`.`id` DESC";

		$result = $conn->query($sql);
		
		return $result;	
	}

	function get_by_tipo( $tipo ){

		$conn=$this->conectar();

		$sql = "SELECT * FROM usuarios WHERE `tipo`=$tipo";

		$result = $conn->query($sql);
		
		return $result;	
	}

	function get_by_id($id){

		$conn=$this->conectar();

		$sql = "SELECT * FROM usuarios WHERE `id`=$id";

		$result = $conn->query($sql);

		return $result;	
	}
	function update($id,$nombre,$corre,$imagen){
		$conn=$this->conectar();
		$sql = "UPDATE `usuarios` SET `imagen` = '$imagen', `nombre`='$nombre', `correo` = '$correo' WHERE `usuarios`.`id` = $id;";

		$result = $conn->query($sql);
		return $result;	
	}
	function add($nombre,$correo,$imagen){
		$conn = $this->conectar();

		$sql = "INSERT INTO `usuarios` (`id`, `nombre`, `correo`, `imagen`) VALUES (NULL, '$nombre', '$correo', '$imagen');";
		$result = $conn->query($sql);
		return $result;
	}
}
?>
