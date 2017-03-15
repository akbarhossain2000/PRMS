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
                			<li><a href="javascript:void(0)" id="doc_add">Doctor Registration</a></li>
                    		<li><a href="javascript:void(0)" id="view_doc">View Doctor</a></li>
                		</ul>
                    </div>
                </div>
            </div>
        	
            <div class="col-md-9">
        		<div id="showPage">
            
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
		$('#doc_add').click(function () {
			
			jQuery('#showPage').load('doctor_registration.php');
		});
		
		$('#view_doc').click(function () {
			
			jQuery('#showPage').load('view_doctor_list.php');
		});
	
	});
	
</script>