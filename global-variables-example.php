<?php 
/*
En este archivo se configuraran las variables globales para el proyecto
se agregaran nuevas varaibles a medida que cresca elproyecto
Estas son de ejemplo en un servidor local, igualmente se dejara a futuro un SQL con una base de datos tipo
*/
class global_variables{

	//BASE DATOS LOCAL
	
	protected $servername="localhost";
	protected $username="root";
	protected $password="";
	protected $db="organizador_proyectos";
	
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