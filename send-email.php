<?php 
$id_tarea = 0;
if(isset($_GET['tarea'])){
	$id_tarea = $_GET['tarea'];
}else{
	http_response_code(404);
	return 'Tarea no encontrada';
}

include_once("class/tarea.php");
$tarea = new tarea();
$tarea->get_by_id($id_tarea);

include_once("class/proyecto.php");
$proyecto = new proyecto();

$proyecto->get_by_id($tarea->get_proyecto());

include_once ("class/usuario.php");
$usuario = new usuario();


include_once ("class/notificacion.php");
$notificacion = new notificacion();

$notificaciones = $notificacion->get_by_tarea($id_tarea);

foreach ($notificaciones as $item) {
	$usuario->get_by_id($item->get_usuario());
	$to = $usuario->get_correo();
	$subject = "Tarea completada - ".$proyecto->get_nombre();
	$txt = "Se ha completado: ".$tarea->get_nombre()."<br> Proyecto: ".$proyecto->get_nombre();
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .= "From: contacto@hatchtemuco.com";

	mail($to,$subject,$txt,$headers);
}

?>
