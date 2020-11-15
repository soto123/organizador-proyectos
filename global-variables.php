<?php 
/*
En este archivo se configuraran las variables globales para el proyecto
se agregaran nuevas varaibles a medida que cresca elproyecto
*/
class global_variables{
	protected $servername="localhost";
	protected $username="hatchtem_YcIbY1Ud";
	protected $password="YcIbY1Ud";
	protected $db="hatchtem_YcIbY1Ud";

	function get_servername(){
		return $this->servername;
	}
	function get_username(){
		return $this->username;
	}
	function get_password(){
		return $this->password;
	}
	function get_db(){
		return $this->db;
	}

}
 ?>