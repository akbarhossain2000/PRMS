<?php
include_once("admheader.php");
include_once("DataModel.php");
$base= new Dmodel();

if(isset($_POST['adedit']) && $_POST['dataupdate']=="ass_doc"){
	extract($_POST);
	$sql = "UPDATE assdoc_info SET adname='$adname', phone='$phone', email='$email', gender='$gender', depid='$depid' WHERE aduid='$aduid'";
	if($base->updateProfile($sql)){

	print"<script>alert('Data Update Successfully!')</script>";
	}else{
		print"<script>alert('Data Update Failed!')</script>";
	}
}

if(isset($_POST['dpedit']) && $_POST['dataupdate']=="doct_edit"){
	extract($_POST);
	
	$sql = "UPDATE doctor_info SET dname = '$dname', phone='$phone', email='$email', gender='$gender', depid='$depid', desig='$desig', hdegree='$hdegree', chamadd='$chamadd', available='$available' WHERE duid='$duid'";
	if($base->updateDprofile($sql)){
		print"<script>alert('Data Update Successfully!')</script>";
	}else{
		print"<script>alert('Data Update Failed!')</script>";	
	}
	
}
?>
<div class="body_area">
		<div class="container">
    		<div class="col-md-3">
            	
               		<div style="height:500px;">	
                    </div>
                
            </div>
        	
            <div class="col-md-9">
        		<div id="showPage" style="height:500px;" class="table-responsive">
            
            	</div>
        	</div>
    
    	</div>
    </div>
<?php
include_once("admfooter.php");
?>