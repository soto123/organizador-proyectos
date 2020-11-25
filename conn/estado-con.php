<?php 
require_once ("./global-variables.php");
class estado_con
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
		$sql = "SELECT * FROM estados";
		$result = $conn->query($sql);
		$conn->set_charset("utf8");
		return $conn;
	}
	function get_estados(){

		$conn=$this->conectar();

		$sql = "SELECT * FROM estados ORDER BY `estados`.`id` DESC";

		$result = $conn->query($sql);
		
		return $result;	
	}

	function get_by_id($id){

		$conn=$this->conectar();

		$sql = "SELECT * FROM estados WHERE `id`=$id";

		$result = $conn->query($sql);
		
		return $result;	
	}
	function update($id,$nombre,$imagen){
		$conn=$this->conectar();
		$sql = "UPDATE `estados` SET `imagen` = '$imagen', `nombre`='$nombre' WHERE `estados`.`id` = $id;";

		$result = $conn->query($sql);
		return $result;	
	}
	function add($nombre,$imagen){
		$conn = $this->conectar();

		$sql = "INSERT INTO `estados` (`id`, `nombre`, `imagen`) VALUES (NULL, '$nombre', '$imagen');";
		$result = $conn->query($sql);
		return $result;
	}
}
?>
