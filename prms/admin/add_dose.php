<?php
include_once("DataModel.php");
$base = new Dmodel();

$dose_id = $base->create_dep_id("dose", "dose_id");
?>

	<div class="msg_area"></div>
  		<form action="" name="dform" id="dform" method="post">
        	<input type="hidden" name="formcheck" value="add_dose" />          
            <table class="table">
                <tr>
                    <th colspan="3" style="background:#135434; color:#fff; text-align:center; padding:5px;">Add Dose</th>
                </tr>
                
                <tr>
                    <td>Dose ID</td>
                    <td>:</td>
                    <td><input type="text" name="dose_id" id="dose_id" value="<?php echo $dose_id; ?>" style="text-align:center" /></td>
                </tr>
                
                <tr>
                    <td>Dose</td>
                    <td>:</td>
                    <td><input type="text" name="dose" id="dose" required /></td>
                </tr>
                
                <tr>
                    <td colspan="3" style="text-align:center">
						<input type="submit" name="save" id="save" class='btn btn-default' value="ADD">
						<input type="reset" class='btn btn-default' value="Reset">
						<input type="button" id='view_dose' class='btn btn-primary' value="View">
					</td>
                </tr>
            </table>
        </form>
		
		<?php
			$dose_data = $base->getDose();
				echo"<div id='view_dose_table' style='display:none;'>";
				echo"<table width='100%'>
					<tr>
						<td><input type='button' id='close' class='pull-right btn btn-danger close' value='X'/></td>
					</tr>
				
				</table>";
				echo"<table class='table table-bordered'>";
				
					echo"<tr>
						<th>SL</th>
						<th>Dose</th>
					</tr>";
					for($i=0; $i<sizeof($dose_data); $i++){
							echo "
								<tr>
									<td>".$dose_data[$i]['dose_id']."</td>
									<td>".$dose_data[$i]['dose']."</td>
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
				var form 	= $('#dform');
				var msg 	= $('.msg_area');
				
				form.on('submit', function(e){
					e.preventDefault();
					//alert('d');
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
				
				$("#view_dose").click(function(){
					$("#dform").hide();
					$("#view_dose_table").show();
					
				});
				
				$("#close").click(function(){
					$("#view_dose_table").hide();
					$("#dform").show();
					
				});
				
            });
         
         </script>