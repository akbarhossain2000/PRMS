<?php
	include_once("DataModel.php");	
	
	$base = new Dmodel();
	
	if($_POST['action'] == 'getData'){
		echo json_encode($base->getData());
	} else if($_POST['action'] == 'getName'){
		echo $base->matchData($_POST['id']);	
	} else if($_POST['action'] == 'getDname'){
		echo $base->doctorData($_POST['id']);	
	} else if($_POST['action'] == 'getDepname'){
		echo $base->depData($_POST['id']);	
	}else if($_POST['action'] == 'pDetails'){
		echo json_encode($base->pPsign_pres_rep($_POST['puid'],$_POST['date']));
	}
		

?>