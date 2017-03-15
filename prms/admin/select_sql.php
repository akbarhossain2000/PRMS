<?php
include_once("DataModel.php");

$base = new Dmodel();
	
	if($_POST['action'] == 'getDoctor_data'){
		echo json_encode($base->getDoctor_data());	
	}else if($_POST['action'] == 'getDepname'){
		echo $base->depData($_POST['id']);	
	}else if($_POST['action'] == '_getSlotdata'){
		echo json_encode($base->_getSlotdata());
	}
	
?>