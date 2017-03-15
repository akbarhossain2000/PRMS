<?php
include_once("DataModel.php");
$base = new Dmodel();

$id = $base->create_dep_id("department", "depid");

?>



<!--<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />-->
	<div class="alert"></div>
	<form action="" id="form" method="post">
    <input type="hidden" name="formcheck" value="dep_name" />
	<table class="table">
    	<tr>
            <th colspan="3" style="background:#135434; color:#fff; text-align:center; padding:5px;">Add Department</th>
        </tr>
        <tr>
       	    <td>Department ID</td>
            <td>:</td>
            <td><input type="text" name="depid" id="depid" value="<?php echo $id; ?>" required style="text-align:center" /></td>
            <span></span>
        </tr>
        <tr>
        	<td>Department</td>
            <td>:</td>
            <td><input type="text" name="department" id="department" required /></td>
            <span></span>
        </tr>
        <tr>
        	<td colspan="3">
            	<input type="submit" name="save" id="save" value="Save" class="btn btn-default" />
            </td>
        </tr>
    </table>
	</form>

<script src="js/jquery.min.js"></script>
<script type="text/javascript">

	$(document).ready(function(e) {
        
		var form = $('#form');
		var submit = $('#save');
		var alert = $('.alert');
		//alert(submit);
		
		form.on('submit', function(e){
			e.preventDefault();
			//alert(submit);
			$.ajax({
				url: 'form_sql.php',
				type: 'POST',
				dataType:'html',
				data: form.serialize(),
				beforeSend: function(){
					alert.fadeOut(5000);
					alert.html('Data Saving...');
					
				},
				success: function(data){
					//alert(data);
					alert.html(data).fadeIn();
					form.trigger('reset');
					submit.html('Save');	
				},
				error: function(e) {
					console.log(e)
				  }
			});
			
		});
    });

</script>