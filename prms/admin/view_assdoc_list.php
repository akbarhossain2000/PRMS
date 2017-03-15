<?php
include_once("DataModel.php");
include_once("ini.php");

if (isset($_GET['ad_id'])){
	    $adid = $_GET['ad_id'];
		echo $sql = "UPDATE assdoc_info SET aduid='', pass='', repass='' WHERE aduid = '$adid'";
		mysql_query($sql);	
	}

$base = new Dmodel();

echo "<table class='table'>";
echo "<tr>";
echo "<th>SL</th>";
echo "<th>Name</th>";
echo "<th>Phone</th>";
echo "<th>Email</th>";
echo "<th>Department</th>";
echo "<th>Delete</th>";
echo "</tr>";

$sql = "SELECT * FROM assdoc_info";
$result = mysql_query($sql);
$i=0;
while($row = mysql_fetch_array($result)){
	$i++;
	$assd_id =$row['aduid'];
	$name = $row['adname'];
	$phone=$row['phone'];
	$email=$row['email'];
	$dept = $row['depid'];
	if($assd_id != ""){
		echo "<tr>";
		echo "<td>$i</td>";
		echo "<td>$name</td>";
		echo "<td>0$phone</td>";
		echo "<td>$email</td>";
		echo "<td>".depData($dept)."</td>";
		echo "<td><a href='view_assdoc_list.php?ad_id=$assd_id' target='_blank' onClick=\"return confirm('Are you Sure Delete This Assistant Doctor!');\" class='btn btn-danger'>Delete</a></td>";
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