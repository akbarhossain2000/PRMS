<?php
include_once("header.php");
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

</head>

<body>

	<div class="body_area">
		<div class="container">
    		<div class="col-md-3">
   				<div class="content outer_border">
        			<div class="container_sidemenu">
                    	
            			<ul id="menu">
                			<li><a href="javascript:void(0)" id="my_profile">My Profile</a></li>
                    		<li><a href="javascript:void(0)" id="list_prescription">Prescription</a></li>
                    		<li><a href="javascript:void(0)" id="list_report">Report</a></li>
                		</ul>
                        
            		</div>
        		</div> 
    		</div>
        	
            <div class="col-md-9">
        		<div id="showPage" class="table-responsive">
            
            	</div>
        	</div>
    
    	</div>
    </div>
	
</body>
</html>


<?php
include_once("footer.php");
?>

<script src="js/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(e) {
        $('#my_profile').click(function(){
			
			jQuery('#showPage').load('patient_profile.php');
		});
		
		$('#list_prescription').click(function(){
			
			jQuery('#showPage').load('list_patient_prescription.php');
		});
		
		$('#list_report').click(function(){
			
			jQuery('#showPage').load('list_patient_report.php');
		});
    });


</script>