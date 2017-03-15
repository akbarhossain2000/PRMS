 <?php
include_once("DataModel.php");

if(isset( $_SERVER['HTTP_X_REQUESTED_WITH'])){
	
	extract($_POST);
	$base = new Dmodel();
	
	if(($_POST['formcheck']=="dep_name")){
	@$data_array['depid']			= filter_var($depid, FILTER_SANITIZE_STRING);
	@$data_array['department']		= "$department";

	if($base->_insertData("department", @$data_array)){
		//header("location:department.php");
		echo "Data save successfully";
	}
	else{
		echo "Data save failed";	
	}
	}

	
	if(($_POST['formcheck']=="ass_doc")){
		//echo $_POST['id'];
		/*echo"<pre>";
		print_r($_POST);
		print_r($_FILES);
		
				@$file_name = $_FILES['img']['name'];
				@$file_type = $_FILES['img']['type'];
				@$file_path = $_FILES['img']['tmp_name'];
				@$file_size = $_FILES['img']['size'];
				@$ext	   = substr($file_name,-3);
				@$file_name = $_POST['aduid'].".".@$ext;
				move_uploaded_file(@$file_path,"img/".@$file_name);*/
		
	@$data_array['id']		= "$id";
	@$data_array['aduid']		= "$aduid";
	@$data_array['pass']		= "$pass";
	@$data_array['repass']		= "$repass";
	@$data_array['adname']		= "$adname";
	@$data_array['phone']		= "$phone";
	@$data_array['email']		= "$email";
	@$data_array['gender']		= "$gender";
	@$data_array['depid']		= "$depid";
	//@$data_array['adimg']		= "$file_name";

	if($base->_insertData("assdoc_info", @$data_array)){
		echo "Data Save Successfully";
	}
	else{
		echo "Data Save Failed";	
	}
  }
  
  	if(($_POST['formcheck']=="doc_reg")){

		@$data_array['id']				= "$id";
		@$data_array['duid']			= "$duid";
		@$data_array['pass']			= "$pass";
		@$data_array['repass']			= "$repass";
		@$data_array['dname']			= "$dname";
		@$data_array['phone']			= "$phone";
		@$data_array['email']			= "$email";
		@$data_array['gender']			= "$gender";
		@$data_array['depid']			= "$department";
		@$data_array['desig']			= "$desig";
		@$data_array['hdegree']			= "$hdegree";
		@$data_array['chamadd']			= "$chamadd";
		@$data_array['available']		= "$available";
		//@$data_array['img']				= "$file_name";
		
		if($base->_insertData("doctor_info", @$data_array)){
			echo "Data Save Successfully";
		}
		else{
			echo "Data Save Failed!";	
		}
		
	}
	
	if($_POST['formcheck']=="time_slot"){
		
		@$data_array['slot_id']		= "$slot_id";
		@$data_array['slot_name']	= "$slot_name";
		@$data_array['start_time']	= $start_time_hour.":".$start_time_minute." ".$st_am_pm;
		@$data_array['end_time']   = $end_time_hour.":".$end_time_minute." ".$et_am_pm;
		
		if($base->_insertData("time_slot", @$data_array)){
			echo "Data Save Successfully";
		}else{
			echo "Data Save Failed!";	
		}
	}
	
	if($_POST['formcheck']=="day_schedule"){
		
		@$data_array['id']		= "$id";
		@$data_array['duid']	= "$duid";
		@$data_array['depid']	= "$depidpass";
		@$data_array['day']		= "$day";
		
		if($base->_insertData("month_schedule", @$data_array)){
			echo "Data Save Successfully!";
		}else{
			echo "Data Save Failed!";	
		}	
	}
	
	if($_POST['formcheck']=="time_schedule"){
		
		@$data_array['id']		= "$id";
		@$data_array['duid']	= "$duid";
		@$data_array['depid']	= "$depidpass";
		@$data_array['time_slot']	= "$time_slot";
		
		if($base->_insertData("time_schedule", @$data_array)){
			echo "Data Save Successfully!";
		}else{
			echo "Data Save Failed!";	
		}	
	}
	
	if($_POST['formcheck']=="add_medicine"){
		@$data_array['medicine_id']		= "$medicine_id";
		@$data_array['category']		= "$category";
		@$data_array['medicine_name']	= "$medicine_name";
		
		if($base->_insertData("medicine", @$data_array)){
			echo "Data Save Successfully!";
		}else{
			echo "Data Save Failed!";	
		}
	}
	
	if($_POST['formcheck']=="add_medicine_mg"){
		@$data_array['mid']				= "$mid";
		@$data_array['medicine_id']		= "$medicine_id";
		@$data_array['mg']				= "$mg";
		if($base->_insertData("medicine_mg", @$data_array)){
			echo "Data Save Successfully!";
		}else{
			echo "Data Save Failed!";	
		}
	}
	
	if($_POST['formcheck']=="add_test_name"){
		
		@$data_array['test_id']			= "$test_id";
		@$data_array['test_name']		= "$test_name";
		
		if($base->_insertData("test", @$data_array)){
			echo "Data Save Successfully!";
		}else{
			echo "Data Save Failed!";	
		}
	}
	
	if($_POST['formcheck']=="add_dose"){
		
		@$data_array['dose_id']			= "$dose_id";
		@$data_array['dose']			= "$dose";
		
		if($base->_insertData("dose", @$data_array)){
			echo "Data Save Successfully!";
		}else{
			echo "Data Save Failed!";	
		}
	}

}


?>