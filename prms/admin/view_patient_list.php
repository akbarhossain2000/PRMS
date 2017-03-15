<?php
include_once("DataModel.php");
include_once("ini.php");

if (isset($_GET['pd_id'])){
	    $pdid = $_GET['pd_id'];
		$sql = "UPDATE patient_profile SET puid='', pass='', repass='' WHERE puid = '$pdid'";
		mysql_query($sql);	
	}

//$base = new Dmodel();

echo "<table class='table'>";
echo "<tr>";
echo "<th>SL</th>";
echo "<th>Patient Name</th>";
echo "<th>Phone</th>";
echo "<th>Email</th>";
echo "<th>Delete</th>";
echo "</tr>";

$sql = "SELECT * FROM patient_profile";
$result = mysql_query($sql);
$i=0;
while($row = mysql_fetch_array($result)){
	$i++;
	
	$puid = $row['puid'];
	$fname = $row['pfname'];
	$lname = $row['plname'];
	$phone=$row['phone'];
	$email=$row['email'];
	if($puid != ""){
			echo "<tr>";
			echo "<td>$i</td>";
			echo "<td><b>".$fname." ".$lname."</b></td>";
			echo "<td>0$phone</td>";
			echo "<td>$email</td>";
			echo "<td><a href='view_patient_list.php?pd_id=$puid' target='_blank' onClick=\"return confirm('Are you sure delete this patient from patient list!')\" class='btn btn-danger'>Delete</a></td>";
			echo "</tr>";
	}
}
echo "</table>";



?>