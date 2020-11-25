<?php

if(isset($_POST) && $_POST != []){
	var_dump($_POST);
}else if(isset($_GET) && $_GET != []){
	if(isset($_GET['objeto'])){
		include_once("class/".$_GET['objeto'].".php");
		${$_GET['objeto']} = new $_GET['objeto']();
		if(isset($_GET['id'])){
			${$_GET['objeto']}->get_by_id($_GET['id']);
			var_dump(${$_GET['objeto']});
			echo json_encode(${$_GET['objeto']}->object_to_json());
		}else{
			$array = [];
			foreach (${$_GET['objeto']}->get_all() as $objeto) {
				$array[] = $objeto->object_to_json();
			}
			echo json_encode($array);
		}
	}
}else{
	echo 'No hay consultas';
}


?>