<?php
//echo $_SERVER['REQUEST_METHOD'];
if($_SERVER['REQUEST_METHOD'] == 'DELETE'){
	include_once("class/".$_GET['objeto'].".php");
	${$_GET['objeto']} = new $_GET['objeto']();
	
	if(${$_GET['objeto']}->get_by_id($_GET['id'])){
		var_dump(${$_GET['objeto']}->delete());
	}else{
		http_response_code(404);
		echo 'No existe ';
	}
	
}else if($_SERVER['REQUEST_METHOD'] == 'PUT'){

}else if($_SERVER['REQUEST_METHOD'] == 'PATCH'){

}else if(isset($_POST) && $_POST != []){
	include_once("class/".$_GET['objeto'].".php");
	${$_GET['objeto']} = new $_GET['objeto']();
	foreach (array_keys($_POST) as $field)
	{
		$func = 'set_'.$field;
		${$_GET['objeto']}->{$func}($_POST[$field]);
	}
	var_dump(${$_GET['objeto']}->add());
	http_response_code(201);	
}else if(isset($_GET) && $_GET != []){
	if(isset($_GET['objeto'])){
		include_once("class/".$_GET['objeto'].".php");
		${$_GET['objeto']} = new $_GET['objeto']();
		if(isset($_GET['id'])){
			if(${$_GET['objeto']}->get_by_id($_GET['id'])){
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
					//var_dump(${$_GET['objeto']});
					echo json_encode(${$_GET['objeto']}->object_to_json());	
				}
			}else{
				http_response_code(404);
				echo 'No  existe';
				die();
			}
		}else{
			if(isset($_GET['add'])){
				echo 'agregar';
			}else{
				$array = [];
				foreach (${$_GET['objeto']}->get_all() as $objeto) {
					$array[] = $objeto->object_to_json();
				}
				echo json_encode($array);	
			}
		}
	}
}else{
	http_response_code(404);
	echo 'No hay consultas';
	die();
}


?>