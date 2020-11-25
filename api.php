<?php

if(isset($_POST) && $_POST != []){
	var_dump($_POST);
}else if(isset($_GET) && $_GET != []){
	if(isset($_GET['objeto'])){
		include_once("class/".$_GET['objeto'].".php");
		${$_GET['objeto']} = new $_GET['objeto']();
		if(isset($_GET['id'])){
			${$_GET['objeto']}->get_by_id($_GET['id']);
			if(isset($_GET['att'])){
				if(isset($_GET['update'])){//isset update
					$func = 'set_'.$_GET['att'];
					${$_GET['objeto']}->{$func}($_GET['val']);
					var_dump(${$_GET['objeto']}->update());
				}else{
					$func = 'get_'.$_GET['att'];
					echo ${$_GET['objeto']}->{$func}();
				}
			}else{
				echo json_encode(${$_GET['objeto']}->object_to_json());	
			}
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