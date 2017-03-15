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
		
		
		public function create_dep_id($table_name, $field){
		$sql = "SELECT MAX($field) as dep_id from $table_name";
		$rec = $this->_mysql_resource->query($sql);
		
		if($row = $rec->fetch_array()){
			$id = $row['dep_id'];
			
		}
		$id++;
		return $id;
		
		}
		
		public function create_prescription_id($table_name, $field){
		$sql = "SELECT MAX($field) as p_id from $table_name";
		$rec = $this->_mysql_resource->query($sql);
		
		if($row = $rec->fetch_array()){
			if($row['p_id']==""){
				$pres_id = "P00_0";
			}else{
				$pres_id = $row['p_id'];	
			}
		}
		$pres_id++;
		return $pres_id;
		
		}
		
		public function getDoctordata($did){
			//$did = $_GET['d_id'];
			
			$sql = "SELECT * FROM doctor_info WHERE duid = '".@$did."'";
			$rec = $this->_mysql_resource->query($sql);
			
			$data = array();
			while($row = $rec->fetch_assoc()){
				$data[]		= $row;
			}
			return $data;
			
		}
		
		public function doctorName($did){
			$sql = "SELECT dname FROM doctor_info WHERE duid = '".$did."'";
			$result = $this->_mysql_resource->query($sql);
			if($row = $result->fetch_array()){
				 $dname = $row['dname'];
			}
			return $dname;
		}
		
		public function getPatientData($pid){
			//$pid = $_GET['puid'];
			
			$sql = "SELECT * FROM patient_profile WHERE puid = '".@$pid."'";
			$rec = $this->_mysql_resource->query($sql);
			
			$pdata = array();
			while($row = $rec->fetch_assoc()){
				$pdata[] = $row;
			}
			return $pdata;
		}
		
		public function depData($depname){
			$sql = "SELECT department FROM department WHERE depid = '".$depname."'";
			$result = $this->_mysql_resource->query($sql);
			if($row = $result->fetch_array()){
				 $depname = $row['department'];
			}
			return $depname;
		}
		
		public function saveTestVal($testVal,$puid,$date,$pres_id){
			$sql = "INSERT INTO ppres_test_id SET test_id = '$testVal', puid = '$puid', date='$date', pres_id = '$pres_id'";
			$result = $this->_mysql_resource->query($sql);
			if($this->_mysql_resource->affected_rows > 0){
				return true;
			} else {
				return false;	
			}
		}
		
		public function saveMedicineVal($test1Val1,$test1Val2,$test1Val3,$test1Val4,$puid,$date,$pres_id){
			$sql = "INSERT INTO ppres_medicine_id SET medicine_id = '$test1Val1', mg = '$test1Val2', dose_id = '$test1Val3', duration_id = '$test1Val4', puid = '$puid', date='$date', pres_id = '$pres_id'";
			$result = $this->_mysql_resource->query($sql);
			if($this->_mysql_resource->affected_rows > 0){
				return true;
			}else{
				return false;	
			}
		}
		
		public function savePresVal($pres_id,$puid,$duid,$depid,$lastapp,$date){
			$sql = "INSERT INTO prescription SET pres_id = '$pres_id', puid = '$puid', duid = '$duid', depid = '$depid', n_appointment = '$lastapp', date = '$date'";
			$result = $this->_mysql_resource->query($sql);
			if($this->_mysql_resource->affected_rows > 0){
				return true;
			}else{
				return false;	
			}
		}
		
		public function getPrescription($pres_id,$puid,$duid,$date){
			$sql = "SELECT * FROM prescription WHERE pres_id = '$pres_id' AND puid = '$puid' AND duid = '$duid' AND date = '$date'";	
			$rec = $this->_mysql_resource->query($sql);
			$pdata = array();
			if($row = $rec->fetch_assoc()){
				$pdata[] = $row;
			}
			return $pdata;
		}
		
		public function getTestid($pres_id,$puid,$date){
			$sql = "SELECT * FROM ppres_test_id WHERE pres_id = '$pres_id' AND puid = '$puid' AND date = '$date'";
			$rec = $this->_mysql_resource->query($sql);
			$test_id = array();
			while($row = $rec->fetch_assoc()){
				$test_id[] = $row;
			}
			return $test_id;
			
		}
		
		public function getMedicineid($pres_id,$puid,$date){
			$sql = "SELECT * FROM ppres_medicine_id WHERE pres_id = '$pres_id' AND puid = '$puid' AND date = '$date'";	
			$rec = $this->_mysql_resource->query($sql);
			$medicine_id = array();
			while($row = $rec->fetch_assoc()){
				$medicine_id[] = $row;
			}
			return $medicine_id;
		}
		
		public function getpatientPrescription($puid){
			$sql = "SELECT * FROM prescription WHERE puid = '$puid'";	
			$rec = $this->_mysql_resource->query($sql);
			$pdata = array();
			while($row = $rec->fetch_assoc()){
				$pdata[] = $row;
			}
			return $pdata;
		}
		
		public function getpPrescription($puid){
			$sql = "SELECT * FROM patient_prescription WHERE puid = '$puid'";	
			$rec = $this->_mysql_resource->query($sql);
			$pdata = array();
			while($row = $rec->fetch_assoc()){
				$pdata[] = $row;
			}
			return $pdata;
		}
		
		public function getpReport($puid){
			$sql = "SELECT * FROM patient_report WHERE puid = '$puid'";	
			$rec = $this->_mysql_resource->query($sql);
			$pdata = array();
			while($row = $rec->fetch_assoc()){
				$pdata[] = $row;
			}
			return $pdata;
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
		
		public function getDuration(){
			$sql = "SELECT * FROM duration";
			$rec = $this->_mysql_resource->query($sql);
			$duration = array();
			while($row = $rec->fetch_assoc()){
				$duration[] = $row;
			}
			return $duration;
		}
		
		public function updatePprofile($sql){
				$rec = $this->_mysql_resource->query($sql);
				if($this->_mysql_resource->affected_rows > 0){
					return true;
				}else{
					return false;
				}
		}
		
	}
	
	
	

?>