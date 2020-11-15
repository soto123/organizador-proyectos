<?php 
include_once("global-variables.php");

$varibles = new global_variables();
var_dump($varibles);

include_once("class/proyecto.php");
$proyecto = new proyecto();
var_dump($proyecto->get_all());
 ?>