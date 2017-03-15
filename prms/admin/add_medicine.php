<?php
include_once("DataModel.php");
$base = new Dmodel();

$mid = $base->create_dep_id("medicine", "medicine_id");
?>

	<div class="msg_area"></div>
		<form action="" name="mform" id="mform" method="post">
        	<input type="hidden" name="formcheck" value="add_medicine" />
            <table class="table">
                <tr>
					<th colspan="3" style="background:#135434; color:#fff; text-align:center; padding:5px;">Add Medicine</th>
                </tr>
                <tr>
                    <td>Medicine ID</td>
                    <td>:</td>
                    <td><input type="text" name="medicine_id" id="medicine_id" value="<?php echo $mid;?>" style="text-align:center" /></td>
                </tr>
				
				<tr>
					<td>Category</td>
					<td>:</td>
					<td>
						<select name="category" id="category" required>
							<option value="">-------</option>
							<option value="Tab">Tablet</option>
							<option value="Cap">Capsule</option>
							<option value="Inj">Injection</option>
							<option value="Oment">Ointment</option>
							<option value="Syr">Syrup</option>
						</select>
					</td>
				</tr>
                
                <tr>
                    <td>Medicine Name</td>
                    <td>:</td>
                    <td><input type="text" name="medicine_name" id="medicine_name" required /></td>
                </tr>
                
                <tr>
                    <td colspan="3" style="text-align:center">
						<input type="submit" name="save" id="save" class='btn btn-default' value="ADD">
						<input type="reset" class='btn btn-default' value="Reset">
						<input type="button" id='view_medicine' class='btn btn-primary' value="View">
						
					</td>
                </tr>
            </table>
        </form>
		
		<?php
			$medicine_data = $base->getMedicineData();
				echo"<div id='view_medicine_table' style='display:none;'>";
				echo"<table width='100%'>
					<tr>
						<td><input type='button' id='close' class='pull-right btn btn-danger close' value='X'/></td>
					</tr>
				
				</table>";
				echo"<table class='table table-bordered'>";
				
					echo"<tr>
						<th>SL</th>
						<th>Medicine Name</th>
					</tr>";
					for($i=0; $i<sizeof($medicine_data); $i++){
							echo "
								<tr>
									<td>".$medicine_data[$i]['medicine_id']."</td>
									<td>".$medicine_data[$i]['medicine_name']."</td>
								</tr>
							";
						
					}
					
				echo"</table>";
			echo "</div>";
		?>
        
        
	<script src="js/jquery.min.js"></script>
    <script type="text/javascript">
    	$(document).ready(function(e) {
            var submit = $('#save');
			var form	= $('#mform');
			var msg		= $('.msg_area');
			
			form.on('submit', function(e){
				e.preventDefault();
				
				$.ajax({
					url:"form_sql.php",
					type:'POST',
					dataType:"html",
					data:form.serialize(),
					beforeSend: function(){
						msg.fadeOut(5000);
						msg.html('Data Saving.....');	
					},
					success: function(data){
						msg.html(data).fadeIn();
						form.trigger('reset');
						submit.html('ADD');
					},
					error: function(e){
						console.log(e);
					}
					
				});
			});
			
			$("#view_medicine").click(function(){
					$("#mform").hide();
					$("#view_medicine_table").show();
					
				});
				
				$("#close").click(function(){
					$("#view_medicine_table").hide();
					$("#mform").show();
					
				});
        });
    
    </script>