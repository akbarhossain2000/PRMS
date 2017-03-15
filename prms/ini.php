<?php
	$host	= "localhost";
	$user 	= "root";
	$pass	= "";
	$db 	= "akbarprm";
	
	$connect = mysql_connect($host, $user, $pass) or die("Database Connection Failed!");
	mysql_select_db($db, $connect) or die("Database Couldn't Select!");

?>