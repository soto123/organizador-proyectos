<?php 
require_once ("./global-variables.php");
class tarea_con
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
		$sql = "SELECT * FROM tareas";
		$result = $conn->query($sql);
		
		return $conn;
	}
	function get_tareas(){

		$conn=$this->conectar();

		$sql = "SELECT * FROM tareas ORDER BY `tareas`.`id` DESC";

		$result = $conn->query($sql);
		
		return $result;	
	}

	function get_by_id($id){

		$conn=$this->conectar();

		$sql = "SELECT * FROM tareas WHERE `id`=$id";

		$result = $conn->query($sql);
		
		return $result;	
	}
	function get_by_proyecto( $proyecto ){
		$conn=$this->conectar();

		$sql = "SELECT * FROM tareas WHERE `proyecto`=$proyecto";

		$result = $conn->query($sql);
		
		return $result;	
	}
	function update($id,$nombre,$proyecto,$prioridad,$estado){
		$conn=$this->conectar();
		$sql = "UPDATE `tareas` SET `proyecto` = '$proyecto', `prioridad` = '$prioridad', `nombre`='$nombre', `estado`='$estado' WHERE `tareas`.`id` = $id;";

		$result = $conn->query($sql);
		return $result;
	}
	function add( $nombre,$proyecto,$prioridad,$estado ){
		$conn = $this->conectar();

		$sql = "INSERT INTO `tareas` (`id`, `nombre`, `proyecto`, `prioridad`, `estado`) VALUES (NULL, '$nombre', $proyecto,$prioridad,$estado);";
		$result = $conn->query($sql);
		if($result){
			$sql = "SELECT LAST_INSERT_ID();";
			$result = $conn->query($sql);
		}
		return $result;
	}
	function delete( $id ){
		$conn=$this->conectar();
		$sql = "DELETE FROM `tareas` WHERE `tareas`.`id` = $id;";
		$result = $conn->query($sql);
		return $result;	
	}
	function cambiar_estado( $id ){
		$conn=$this->conectar();
		$sql = "UPDATE `tareas` SET `estado`='$estado' WHERE `tareas`.`id` = $id;";

		$result = $conn->query($sql);
		return $result;
	}
	
}
?>
