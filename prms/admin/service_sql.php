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
	} else if($_POST['action'] == 'updatePstatus'){
		echo $base->updateBooking_data();	
	}else if($_POST['action'] == 'deletePatient'){
		echo $base->deleteBooking_data();	
	}else if($_POST['action'] == 'getPdata'){
		$id = $_POST['id'];
		echo json_encode($base->getPatientdata($id));
	} else if($_POST['action'] == 'searchResult'){
		$base->getSearchResult($_POST['text']);
	}
		

?>