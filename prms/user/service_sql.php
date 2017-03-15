<?php
	include_once("DataModel.php");
	$base = new Dmodel();
	
	$action = $_POST['action'];
	
	if($action == "saveTest"){
		$val = $_POST['testVal'];
		$puid = $_POST['puid'];
		$date = $_POST['date'];
		$pres_id = $_POST['pres_id'];
		echo $base->saveTestVal($val,$puid,$date,$pres_id);
	}
	else if($action == "saveMedicine"){
		$val1 = $_POST['test1Val1'];
		$val2 = $_POST['test1Val2'];
		$val3 = $_POST['test1Val3'];
		$val4 = $_POST['test1Val4'];
		$puid = $_POST['puid'];
		$date = $_POST['date'];
		$pres_id = $_POST['pres_id'];
		echo $base->saveMedicineVal($val1,$val2,$val3,$val4,$puid,$date,$pres_id);
		
	}
	else if($action == "savePrescription"){
		$pres_id = $_POST['pres_id'];
		$puid = $_POST['puid'];
		$duid = $_POST['duid'];
		$depid = $_POST['depid'];
		$lastapp = $_POST['lastapp'];
		$date = $_POST['date'];
		
		echo $base->savePresVal($pres_id,$puid,$duid,$depid,$lastapp,$date);
		
	}
	else if($action == "getMg"){
		$m_id = $_POST['m_id'];
		echo json_encode($base->getMedicineMg($m_id));
	}
