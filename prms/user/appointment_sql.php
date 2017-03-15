<?php
include_once("ini.php");


$action 				= isset($_POST['action'])? $_POST['action']:"";
$dept 					= getDepartment();
$doctor 				= getDoctor();
$day					= getDay();
$tim					= getTimeslot();
$slot_name				= getSlotname();

$result = array(
	'dept_tbl'=>$dept,
	'doct_tbl'=>$doctor,
	'd_schedule_tbl'=>$day,
	't_schedule_tbl'=>$tim,
	'slot_name'=>$slot_name
	);
if($action == 'getJson'){
	echo json_encode($result);
} else if($action == 'getStatus'){
	 echo json_encode(getCount());
}
function getDepartment(){
	$sql = "SELECT * FROM department";	
	$rec = mysql_query($sql);
	$dept = array();
	while($row = mysql_fetch_array($rec)){
		$dept_id			= $row['depid'];
		$dept_name			= $row['department'];
		
		$dept[$dept_id]	= $dept_name;
	}
	return $dept;
}

function getDoctor(){
	$sql = "SELECT * FROM doctor_info";	
	$rec = mysql_query($sql);
	$doctor = array();
	while($row = mysql_fetch_assoc($rec)){
		$doctor[] = $row;
	}
	return $doctor;
}

function getDay(){
	$sql = "SELECT * FROM month_schedule";
	$rec =	mysql_query($sql);
	$day = array();
	while($row = mysql_fetch_array($rec)){
		$day[]	= $row;
	}
	return $day;
}

function getTimeslot(){
	$sql = "SELECT * FROM time_schedule";
	$rec = mysql_query($sql);
	$tim = array();
	while($row = mysql_fetch_array($rec)){
		$tim[] = $row;
	}
	return $tim;
}

function getCount(){
	$dept = $_POST['dept'];
	$doctor = $_POST['doctor'];
	$date = $_POST['date'];
	$slot_id = $_POST['slot_id'];
	
	
	$rec = mysql_query("SELECT * FROM booking_list WHERE depid = '$dept' AND duid = '$doctor' AND datetime = '$date' AND time_slot = '$slot_id'");
	$numRows = mysql_num_rows($rec);
	
	if($numRows > 0){
		$sql = "SELECT MAX(time) as t FROM booking_list WHERE  depid = '$dept' AND duid = '$doctor' AND datetime = '$date' AND time_slot = '$slot_id'";
		$res = mysql_query($sql);
		if($row = mysql_fetch_assoc($res)){
			$time = $row['t'];
		}
		
		$date1 = date("Y-m-d");
		$time_to = date("h:i A",strtotime($date1." ".$time." + 30 minutes"));
	}
	 else {
		$sql = "SELECT start_time FROM time_slot WHERE slot_id = '$slot_id'";
		$rec = mysql_query($sql);
		if($row = mysql_fetch_assoc($rec)){
			$time_to = $row['start_time'];
		}
		$date2	= date("Y-m-d");
		$time_to = date("h:i A",strtotime($date2." ".$time_to));
	} 
	
	$sql = "SELECT * FROM booking_list WHERE  depid = '$dept' AND duid = '$doctor' AND datetime = '$date' AND time_slot = '$slot_id'";
	$rec = mysql_query($sql);
	$numRows = mysql_num_rows($rec);
	$time_ary = array("tm"=>$time_to,"num"=>$numRows);
	
	return $time_ary;
}


function getSlotname(){
	$sql = "SELECT * FROM time_slot";
	$rec = mysql_query($sql);
	//$slot = array(); 
	while($row = mysql_fetch_array($rec)){
		$slot[$row['slot_id']] = $row['slot_name']." (".$row['start_time']." to ".$row['end_time'].")";
	}
	return $slot;
}


?>