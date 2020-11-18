<?php 

include_once("class/proyecto.php");
$proyecto = new proyecto();
var_dump($proyecto->get_all());

include_once("class/estado.php");
$estado = new estado();
var_dump($estado->get_all());

include_once("class/usuario.php");
$usuario = new usuario();
var_dump($usuario->get_all());

 ?>