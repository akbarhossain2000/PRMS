<?php
include_once("header.php");
include_once("DataModel.php");
include_once("ini.php");
?>
<div class="container">
	<div class="col-md-12">
		<div class="table-responsive">

<?php
//$base = new Dmodel();

echo "<table class='table'>";
echo "<tr>";
echo "<th>SL</th>";
echo "<th>Name & Designation</th>";
//echo "<th>Phone</th>";
echo "<th>Email</th>";
echo "<th>Department</th>";

echo "</tr>";

$sql = "SELECT * FROM doctor_info";
$result = mysql_query($sql);
$i=0;
while($row = mysql_fetch_array($result)){
	$i++;
	$name = $row['dname'];
	$phone=$row['phone'];
	$email=$row['email'];
	$dept = $row['depid'];
	$desig = $row['desig'];
	$hdegree=$row['hdegree'];
echo "<tr>";
echo "<td>$i</td>";
echo "<td><b>$name</b></br>$desig</td>";
//echo "<td>0$phone</td>";
echo "<td>$email</td>";
echo "<td>".depData($dept)."</td>";
echo "</tr>";
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
		</div>
	</div>
</div>

<?php
include_once("footer.php");
?>