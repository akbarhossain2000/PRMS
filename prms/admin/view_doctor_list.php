<?php
include_once("DataModel.php");
include_once("ini.php");

if (isset($_GET['dd_id'])){
	    $doctid = $_GET['dd_id'];
		$sql = "UPDATE doctor_info SET duid='', pass='', repass='' WHERE duid = '$doctid'";
		mysql_query($sql);	
	}

//$base = new Dmodel();

echo "<table class='table'>";
echo "<tr>";
echo "<th>SL</th>";
echo "<th>Name & Designation</th>";
echo "<th>Phone</th>";
echo "<th>Email</th>";
echo "<th>Department</th>";
echo "<th>Delete</th>";
echo "</tr>";

$sql = "SELECT * FROM doctor_info";
$result = mysql_query($sql);
$i=0;
while($row = mysql_fetch_array($result)){
	$i++;
	$doct_id = $row['duid'];
	$name = $row['dname'];
	$phone=$row['phone'];
	$email=$row['email'];
	$dept = $row['depid'];
	$desig = $row['desig'];
	$hdegree=$row['hdegree'];
	if($doct_id != ""){
			echo "<tr>";
			echo "<td>$i</td>";
			echo "<td><b>$name</b></br>$desig</td>";
			echo "<td>0$phone</td>";
			echo "<td>$email</td>";
			echo "<td>".depData($dept)."</td>";
			echo "<td><a href='view_doctor_list.php?dd_id=$doct_id' target='_blank' onClick=\"return confirm('Are You Sure Delete This Doctor From List!');\" class='btn btn-danger'>Delete</a></td>";
			echo "</tr>";
	}
}
echo "</table>";



 function depData($depname){
			$sql = "SELECT department FROM department WHERE depid = '".$depname."'";
			$result = mysql_query($sql);
			if($row = mysql_fetch_array($result)){
				$depname = $row['department'];
			}
			return $depname;
		}

?>