<?php
	define("DB_HOST","localhost");
	define("DB_USER","root");
	define("DB_PASSWORD","");
	define("DB_NAME","akbarprm");
	$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	
	class Dmodel{
		private $_mysql_system = array();
		private $_mysql_resource = "";
		
		function __construct(){
			$this->_mysql_system["host"]	= DB_HOST;
			$this->_mysql_system["user"]	= DB_USER;
			$this->_mysql_system["pass"]	= DB_PASSWORD;
			$this->_mysql_system["db_name"]	= DB_NAME;
			$this->_mysql_resource = new MySQLi($this->_mysql_system['host'], $this->_mysql_system['user'], $this->_mysql_system['pass'], $this->_mysql_system['db_name']);
			if($this->_mysql_resource->connect_error){
				echo "Database Couldn't Connect!";	
			}
			
		}
		
		public function _insertData($table_name, $data = array()){
			$sql = "";
			foreach($data as $k=>$v){
				if($sql != ''){
					$sql .= ", ";
				}
				$sql .= sprintf("%s='%s'", $this->_mysql_resource->escape_string($k), $this->_mysql_resource->escape_string($v));
			}
			
			$sql = "INSERT INTO {$table_name} SET {$sql}";
			$result = $this->_mysql_resource->query($sql);
			if($this->_mysql_resource->affected_rows>0){
				return true;
			}
				else{
					return false;
				}
			
		}
		
		public 	function _userExist($uname){
			$sql= "SELECT puid FROM patient_profile WHERE puid = '".@$uname."'";
			$result = $this->_mysql_resource->query($sql);
			
			if($result->num_rows>0){
				//@$uid = $row['puid'];
				return false;	
			}
			return true;
		}
		public 	function _emailExist($email){
			echo $sql= "SELECT puid FROM patient_profile WHERE email = '".@$email."'";
			$result = $this->_mysql_resource->query($sql);
			
			if($result->num_rows>0){
				//@$uid = $row['puid'];
				return false;	
			}
			return true;
		}
		
		public function getData(){
			$sql = "SELECT * FROM booking_list ORDER BY datetime";
			$result = $this->_mysql_resource->query($sql);
			$data = array();
			
			while($row = $result->fetch_assoc()){
				$data[] = $row;
			}
			return $data;
		}
		
		public function matchData($pname){
			$sql = "SELECT pfname,plname FROM patient_profile WHERE puid = '".$pname."'";
			$result = $this->_mysql_resource->query($sql);
			if($row = $result->fetch_array()){
				$pname = $row['pfname']." ".$row['plname'];
			}
			return $pname;
		}
		
		public function doctorData($dname){
			$sql = "SELECT dname FROM doctor_info WHERE duid = '".$dname."'";
			$result = $this->_mysql_resource->query($sql);
			if($row = $result->fetch_array()){
				$dname = $row['dname'];
			}
			return $dname;
		}
		public function depData($depname){
			$sql = "SELECT department FROM department WHERE depid = '".$depname."'";
			$result = $this->_mysql_resource->query($sql);
			if($row = $result->fetch_array()){
				$depname = $row['department'];
			}
			return $depname;
		}
		
		public function create_dep_id($table_name, $field){
		$sql = "SELECT MAX($field) as dep_id from $table_name";
		$rec = $this->_mysql_resource->query($sql);
		
		if($row = $rec->fetch_array()){
			$id = $row['dep_id'];
			
		}
		$id++;
		return $id;
		
		}
		
		public function getDoctor_data(){
			$sql = "SELECT * FROM doctor_info";
			$rec = $this->_mysql_resource->query($sql);
			$result = array();
			
			while($row = $rec->fetch_assoc()){
				$result[] = $row;
			}
			return $result;
		}
		
		public function _getSlotdata(){
			$sql = "SELECT * FROM time_slot";	
			$rec = $this->_mysql_resource->query($sql);
			$result = array();
			
			while($row = $rec->fetch_assoc()){
				$result[] = $row;
			}
			return $result;
		}
		
		public function updateBooking_data(){
			$p_id  = $_POST['p_id'];
			$dept_id = $_POST['dept_id'];
			$doctor_id = $_POST['doct_id'];
			$date  = $_POST['date'];

			$sql = "UPDATE booking_list SET status='1' WHERE puid = '$p_id' AND depid = '$dept_id' AND duid = '$doctor_id' AND datetime = '$date'";	
			$this->_mysql_resource->query($sql);
			if($this->_mysql_resource->affected_rows > 0){
				echo "1";
			}else{
				echo "Data Update Failed";	
			}
		}
		
		public function deleteBooking_data(){
			$p_id  = $_POST['dp_id'];
			$dept_id = $_POST['ddept_id'];
			$doctor_id = $_POST['ddoct_id'];
			$date  = $_POST['ddate'];

			echo $sql = "DELETE FROM booking_list WHERE puid = '$p_id' AND depid = '$dept_id' AND duid = '$doctor_id' AND datetime = '$date'";	
			
			if($this->_mysql_resource->query($sql)){
				echo "Data Delete Successfully";
			}else{
				echo "Data Delete Failed";	
			}
		}
		
		public function getPatientdata($id){
			$sql = "SELECT * FROM patient_profile WHERE puid = '$id'";
			$rec = $this->_mysql_resource->query($sql);
			
			$result = array();
			while($row = $rec->fetch_assoc()){
				$result[] = $row;
			}
			return $result;
		}
		
		public function getMedicine(){
			$sql = "SELECT * FROM medicine";
			$rec = $this->_mysql_resource->query($sql);
			$m_name = array();
			
			while($row = $rec->fetch_object()){
				$mid = $row->medicine_id;
				$mname = $row->medicine_name;
				$m_name[$mid] = $mname;	
			}
			return $m_name;
		}
		
		public function getSearchResult($val){
			$sql = "SELECT * FROM assdoc_info WHERE adname LIKE '%".$val."%'";
			$res = $this->_mysql_resource->query($sql);
			while($row = $res->fetch_assoc()){
				echo "<div style='background-color:gray;color:red;font-family;tahoma;font-size:13px;padding:5px 5px 5px 5px; width:180px; height:30px'><a href='javascript:void(0)' id = 'text' rel = '".$row['adname']."' style = 'text-decoration:none;color:red'>".$row['adname']."</a></div><br>";
			}
		}
		
		public function updateDprofile($sql){
			
			$rec = $this->_mysql_resource->query($sql);
			if($this->_mysql_resource->affected_rows > 0){
				return true;
			}else{
				return false;	
			}
			
		}
		
		public function pPsign_pres_rep($puid, $date){
			$psign_pres_rep = array();
			$sql = "SELECT * FROM patient_profile WHERE puid = '$puid'";
			$rec = $this->_mysql_resource->query($sql);
			$result = array();
			$row = $rec->fetch_assoc();
			$result = $row;
			
			$sql3 = "SELECT bp, bs FROM patient_physical_sign WHERE puid='$puid' AND date='$date'"; 
			$rec3 = $this->_mysql_resource->query($sql3);
			$ph_sign = array();
			$row3 = $rec3->fetch_assoc();
			$ph_sign = $row3;
			
			$sql1 = "SELECT pres_name FROM patient_prescription WHERE puid='$puid' AND date='$date'";
			$rec1 = $this->_mysql_resource->query($sql1);
			$p_pres = array();
			while($row1 = $rec1->fetch_assoc()){
				$p_pres[] = $row1;
			}
			$sql2 = "SELECT report_name FROM patient_report WHERE puid='$puid' AND date='$date'";
			$rec2 = $this->_mysql_resource->query($sql2);
			$p_report = array();
			
			while($row2 = $rec2->fetch_assoc()){
				$p_report[] = $row2;
				
			}
			
			
			$psign_pres_rep[0] = $result;
			$psign_pres_rep[1] = $ph_sign;
			$psign_pres_rep[2] = $p_pres;
			$psign_pres_rep[3] = $p_report;
			
			
			return $psign_pres_rep;
		}
		
		public function updatePprofile($sql){
				$rec = $this->_mysql_resource->query($sql);
				if($this->_mysql_resource->affected_rows > 0){
					return true;
				}else{
					return false;
				}
		}
		
		public function updateProfile($sql){
				$rec = $this->_mysql_resource->query($sql);
				if($this->_mysql_resource->affected_rows > 0){
					return true;
				}else{
					return false;
				}
		}
		
		public function physicalSignExist($puid,$date){
			$sql = "SELECT puid, date FROM patient_physical_sign WHERE puid='$puid' AND date='$date'";
			$result =$this->_mysql_resource->query($sql);
			
			if($result->num_rows>0){
				return false;
			}else{
				return true;	
			}
		}
		
		public function getTestData(){
			$sql = "SELECT * FROM test";
			$rec = $this->_mysql_resource->query($sql);
			$test_id = array();
			while($row = $rec->fetch_assoc()){
				$test_id[] = $row;
			}
			return $test_id;
		}
		
		public function getMedicinedata(){
			$sql = "SELECT * FROM medicine";
			$rec = $this->_mysql_resource->query($sql);
			$medicine_id = array();
			while($row = $rec->fetch_assoc()){
				$medicine_id[] = $row;
			}
			return $medicine_id;
		}
		
		public function getMedicineMg($medicine_id){
			$sql = "SELECT * FROM medicine_mg WHERE medicine_id='".$medicine_id."'";
			$rec = $this->_mysql_resource->query($sql);
			$mg	= array();
			$i = 0;
			while($row = $rec->fetch_assoc()){
				
				$mg[$i] = $row['mg'];
				$i++;
			}
			return $mg;
		}
		
		public function getDose(){
			$sql = "SELECT * FROM dose";
			$rec = $this->_mysql_resource->query($sql);
			$dose = array();
			while($row = $rec->fetch_assoc()){
				$dose[] = $row;
			}
			return $dose;
		}

	}
	
	
	

?>