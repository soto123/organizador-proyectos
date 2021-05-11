<?php 
require_once ("./global-variables.php");
class equipo_con
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
		$sql = "SELECT * FROM equipos";
		$result = $conn->query($sql);
		$conn->set_charset("utf8");
		return $conn;
	}
	function get_equipos(){

		$conn=$this->conectar();

		$sql = "SELECT * FROM equipos ORDER BY `equipos`.`id` DESC";

		$result = $conn->query($sql);
		
		return $result;	
	}

	function get_by_id($id){

		$conn=$this->conectar();

		$sql = "SELECT * FROM equipos WHERE `id`=$id";

		$result = $conn->query($sql);
		
		return $result;	
	}
	function update($id,$nombre,$coordinador){
		$conn=$this->conectar();
		$sql = "UPDATE `equipos` SET `coordinador` = '$coordinador', `nombre`='$nombre' WHERE `equipos`.`id` = $id;";

		$result = $conn->query($sql);
		return $result;	
	}
	function add($nombre,$coordinador){
		$conn = $this->conectar();

		$sql = "INSERT INTO `equipos` (`id`, `nombre`, `coordinador`) VALUES (NULL, '$nombre', '$coordinador');";
		$result = $conn->query($sql);
		if($result){
			$sql = "SELECT LAST_INSERT_ID();";
			$result = $conn->query($sql);
		}
		return $result;
	}
	function delete( $id ){
		$conn=$this->conectar();
		$sql = "DELETE FROM `equipos` WHERE `equipos`.`id` = $id;";

		$result = $conn->query($sql);
		return $result;	
	}
}
?>
