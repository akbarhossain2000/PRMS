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
                			<li><a href="javascript:void(0)" id="ass_doc">Assistant Doctor Registration</a></li>
                    		<li><a href="javascript:void(0)" id="view_ass_doc">View Assistant Doctor</a></li>
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
		$('#ass_doc').click(function () {
			
			jQuery('#showPage').load('assdoc_registration.php');
		});
		
		$('#view_ass_doc').click(function () {
			
			jQuery('#showPage').load('view_assdoc_list.php');
		});
	
	});
	
</script>