<?php 
require_once ("./global-variables.php");
class notificacion_con
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
		$sql = "SELECT * FROM notificaciones";
		$result = $conn->query($sql);
		$conn->set_charset("utf8");
		return $conn;
	}
	function get_notificaciones(){

		$conn=$this->conectar();

		$sql = "SELECT * FROM notificaciones ORDER BY `notificaciones`.`id` DESC";

		$result = $conn->query($sql);
		
		return $result;	
	}

	function get_by_id($id){

		$conn=$this->conectar();

		$sql = "SELECT * FROM notificaciones WHERE `id`=$id";

		$result = $conn->query($sql);
		
		return $result;	
	}
	function get_by_tarea($tarea){

		$conn=$this->conectar();

		$sql = "SELECT * FROM notificaciones WHERE `tarea`=$tarea";

		$result = $conn->query($sql);
		
		return $result;	
	}
	function update($id,$usuario,$tarea){
		$conn=$this->conectar();
		$sql = "UPDATE `notificaciones` SET `tarea` = '$tarea', `usuario`='$usuario' WHERE `notificaciones`.`id` = $id;";

		$result = $conn->query($sql);
		return $result;	
	}
	function add($usuario,$tarea){
		$conn = $this->conectar();

		$sql = "INSERT INTO `notificaciones` (`id`, `usuario`, `tarea`) VALUES (NULL, '$usuario', '$tarea');";
		$result = $conn->query($sql);
		if($result){
			$sql = "SELECT LAST_INSERT_ID();";
			$result = $conn->query($sql);
		}
		return $result;
	}
	function delete( $id ){
		$conn=$this->conectar();
		$sql = "DELETE FROM `notificaciones` WHERE `notificaciones`.`id` = $id;";

		$result = $conn->query($sql);
		return $result;	
	}
}
?>
