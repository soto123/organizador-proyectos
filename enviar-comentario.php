<?php 
$cliente = $_POST['cliente'];
$proyecto = $_POST['proyecto'];
$comentario = $_POST['comentario'];
$tarea = $_POST['tarea'];
//Comentario de clientes
$to = "borja@hatchtemuco.com";
$subject = "Comentario de cliente - ".$proyecto;
$txt = "Cliente: ".$cliente."<br>Comentario: ".$comentario."<br> Proyecto: ".$proyecto."<br>Tarea: ".$tarea;
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= "From: contacto@hatchtemuco.com";

mail($to,$subject,$txt,$headers);
?>
