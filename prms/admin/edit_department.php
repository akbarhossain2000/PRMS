<?php
include_once("ini.php");

if(isset($_POST['update'])){
	
	extract($_POST);	
	
	$sql = "UPDATE department SET department='$depname' WHERE depid='$depid'";
	mysql_query($sql);
	if(mysql_affected_rows()==1){
		print"<script>alert('Data Update Successfully!')</script>";
	}else{
		print"<script>alert('Data Update Failed!')</script>";
	}
}
if(isset($_GET['dep_id']))
$depid = $_GET['dep_id'];

$sql ="SELECT * FROM department WHERE depid='$depid'";
$rec = mysql_query($sql);
while($row = mysql_fetch_array($rec)){
	$depid = $row['depid'];
	$depname = $row['department'];	
	
}

echo "<form action='edit_department.php' method='post'>";
echo "<table>";
	echo "<tr>";
		echo "<th colspan='3' style='background-color:blue; color:white'>Update Department Name</th>";
	echo "</tr>";
	
	echo "<tr>";
		echo "<td>Department ID</td>";
		echo "<td>:</td>";
		echo "<td><input type='text' name='depid' id='depid' value='$depid' readonly></td>";
	echo "</tr>";
	
	echo "<tr>";
		echo "<td>Department Name</td>";
		echo "<td>:</td>";
		echo "<td><input type='text' name='depname' id='depname' value='$depname'></td>";
	echo "</tr>";
	
	echo "<tr>";
		echo "<td colspan='3'><input type='submit' name='update' id='update' value='Update'></td>";
	echo "</tr>";

echo"</table>";
echo "</form>";
?>