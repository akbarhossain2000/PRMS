<?php
include_once("DataModel.php");

if(isset($_POST['save'])){
	$data = new Dmodel();
	extract($_POST);
	if($data->_userExist(@$uname)){
		if($data->_emailExist($email)){
			$email = "$email";
			$regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/';
			
			
			if(preg_match($regex, $email)){
				$data_array['puid']				="$uname";
				$data_array['pass']				="$passwd";
				$data_array['repass']			="$re_passwd";
				$data_array['pfname']			="$firstname";
				$data_array['plname']			="$lastname";
				$data_array['phone']			="$phone";
				$data_array['email']			="$email";
				$data_array['dob']				="$dob";
				$data_array['gender']			="$gender";
		
	
			if($data->_insertData("patient_profile", $data_array)){
				print"<script>alert('Data Save Successfully!')</script>";
			}else{
				print"<script>alert('Data Save Failed!')</script>";	
			}
		}else{
			echo"Email IS Invalid! Please Try Again";	
		}
		
		}else{
		echo"Email ID Already exists!";	
		}
		
	}else{
		echo"User Already Exist!";	
	}
	
	
}


?>


