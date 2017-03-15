<?php
include_once("header.php");
include_once("DataModel.php");
$base= new Dmodel();

if(isset($_POST['pedit']) && $_POST['dataupdate']=="patient_edit"){
	extract($_POST);
	
	$sql = "UPDATE patient_profile SET pfname = '$pfname', plname='$plname', phone='$phone', email='$email', address='$address', gender='$gender', dob='$dob', blood='$blood' WHERE puid='$puid'";
	if($base->updatePprofile($sql)){
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
include_once("footer.php");
?>