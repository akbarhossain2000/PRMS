<?php
session_start();
if(!isset($_SESSION['isLogin']) || $_SESSION['isLogin']!='login')
{
	header("location: ../login.php");
}
include_once("DataModel.php");
$base = new Dmodel();

@$puid = $_SESSION['pid'];

$preport = $base->getpReport($puid);

		echo "<div>";
		echo "<div><p style='font-weight:bold; text-decoration:underline;'>Patient All Report</p></div>";	
		for($x=0; $x<sizeof($preport); $x++){
			
			echo"<div class='pull-left' style='margin:5px;'><a ><img src='../admin/img/".@$preport[$x]['report_name']."' class='img-thumbnail' alt='' style='height:250px; width:250px;' /></a></div>";
		}
		echo "</div>";



?>
