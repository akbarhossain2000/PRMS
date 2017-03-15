<?php
include_once("DataModel.php");
include_once("ini.php");

if (isset($_GET['d_id'])){
	    $did = $_GET['d_id'];
		$sql = "DELETE FROM department WHERE depid = '$did'";
		mysql_query($sql);	
	}
//$base = new Dmodel();

echo "<table class='table'>";
echo "<tr>";
echo "<th>SL</th>";
echo "<th>Department Name</th>";
echo "<th>Edit</th>";
echo "<th>Delete</th>";
echo "</tr>";

$sql = "SELECT * FROM department";
$result = mysql_query($sql);
$i=0;
while($row = mysql_fetch_array($result)){
	$i++;
	$depid = $row['depid'];
	$dept = $row['department'];
echo "<tr>";
echo "<td>$i</td>";
echo "<td>$dept</td>";
echo "<td><input type='button' onclick=\"window.open('edit_department.php?dep_id=$depid','','height=500,width=500')\" value='Edit' class='btn btn-primary'></td>";
echo "<td><a href='view_department.php?d_id=$depid' target='_blank' onClick=\"return confirm ('Are you sure delete this Department?');\" class='btn btn-danger'>Delete</td>";
echo "</tr>";
}
echo "</table>";

?>