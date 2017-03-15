<?php
include_once("admheader.php");

?>
<link rel="stylesheet" type="text/css" href="css/stylemain.css">
	<div class="body_area">
		<div class="container">
    		<div class="col-md-3">
            	<div class="content outer_border">
        			<div class="container_sidemenu">
               			<ul id="menu">
                			<li><a href="javascript:void(0)" id="add_dep">Add Department</a></li>
                    		<li><a href="javascript:void(0)" id="view_dep">View Department</a></li>
                    		<li><a href="javascript:void(0)" id="add_medicine">Add Medicine</a></li>
                            <li><a href="javascript:void(0)" id="add_medicine_mg">Add Medicine Mg</a></li>
                            <li><a href="javascript:void(0)" id="ädd_test_name">Add Test Name</a></li>
                            <li><a href="javascript:void(0)" id="add_dose">Add Dose</a></li>
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

<?php
include_once("admfooter.php");
?>

<script src="js/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(e) {
		
		$('#add_medicine').click(function(){
			jQuery('#showPage').load('add_medicine.php');
		});
		
		$('#add_medicine_mg').click(function(){
			jQuery('#showPage').load('add_medicine_mg.php');
		});
		
		$('#ädd_test_name').click(function(){
			jQuery('#showPage').load('add_test_name.php');
		});
		
		$('#add_dose').click(function(){
			jQuery('#showPage').load('add_dose.php');
		});
		
		$('#add_dep').click(function () {
			
			jQuery('#showPage').load('add_department.php');
		});
		
		$('#view_dep').click(function () {
			
			jQuery('#showPage').load('view_department.php');
		});
	
	
	});
	
</script>