<?php
include_once("admheader.php");

?>
<!--<link rel="stylesheet" type="text/css" href="css/stylemain.css">-->
	<div class="body_area">
		<div class="container">
    		<div class="col-md-3">
            	<div class="content outer_border">
        			<div class="container_sidemenu">
               			<ul id="menu">
                			<li><a href="javascript:void(0)" id="view_patient">View Patient</a></li>
                    		<li><a href="#">Search Patient</a></li>
                    		
                		</ul>
                    </div>
                </div>
            </div>
        	
            <div class="col-md-9">
        		<div id="showPage" class="showdata table-responsive">
            
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
		$('#view_patient').click(function () {
			
			jQuery('#showPage').load('view_patient_list.php');
		});
		
		
	
	});
	
</script>