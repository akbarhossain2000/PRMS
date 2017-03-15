<?php
session_start();
if(!isset($_SESSION['isLogin']) || $_SESSION['isLogin']!='login')
{
	header("location: ../login.php");
}
include_once("DataModel.php");
$base = new Dmodel();

@$puid = $_SESSION['pid'];

$ppres = $base->getpPrescription($puid);

$p_id = $base->getPatientData($puid);

$pres = $base->getpatientPrescription($puid);


@$dep_id = $pres[0]['depid'];


$depid = $base->depData($dep_id);
		
		echo "<table class='table'>";
		echo "<tr>";
		echo "<th>SL</th>";
		echo "<th>Pres ID</th>";
		echo "<th>Patient Name</th>";
		echo "<th>Doctor Name</th>";
		echo "<th>Department</th>";
		echo "<th>Date</th>";
		echo "</tr>";
		$j = 0;
		$i = 0;
		for($i=0; $i<sizeof($pres); $i++){
			@$did = $pres[$i]['duid'];
			$duid = $base->doctorName($did);
			$j++;
			echo "<tr>";
			echo "<td>".$j."</td>";
			echo "<td><a onClick =\"window.open('prescription_view.php?prs_id=".$pres[$i]['pres_id']." & puid=$puid & duid=".$pres[$i]['duid']." & date=".$pres[$i]['date']."', 'height=1000, width=500')\">".$pres[$i]['pres_id']."</a></td>";
			echo "<td>".$p_id[0]['pfname']." ".$p_id[0]['plname']."</td>";
			echo "<td>".$duid."</td>";
			echo "<td>".$depid."</td>";
			echo "<td>".$pres[$i]['date']."</td>";
			echo "</tr>";
			
		}
		echo "</table>";
		
		echo "<div>";
		echo "<div><p style='font-weight:bold; text-decoration:underline;'>Patient Image Prescription</p></div>";	
		for($x=0; $x<sizeof($ppres); $x++){
			echo"<div class='pull-left' style='margin:5px;'><a><img src='../admin/img/".$ppres[$x]['pres_name']."' class='img-thumbnail' alt='' style='height:250px; width:250px;' /></a></div>";
		}
		echo "</div>";
			

?>