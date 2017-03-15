<?php
include_once("DataModel.php");
$base = new Dmodel();

$test_id = $base->create_dep_id("test", "test_id");



?>

	<div class="msg_area"></div>
		<form action="" name="tform" id="tform" method="post">
        	<input type="hidden" name="formcheck" value="add_test_name" />
            <table class="table">
                <tr>
                    <th colspan="3" style="background:#135434; color:#fff; text-align:center; padding:5px;">Add Test Name</th>
                </tr>
                <tr>
                    <td>Test ID</td>
                    <td>:</td>
                    <td><input type="text" name="test_id" id="test_id" value="<?php echo $test_id; ?>" style="text-align:center" /></td>
                </tr>
                
                <tr>
                    <td>Test Name</td>
                    <td>:</td>
                    <td><input type="text" name="test_name" id="test_name" required></td>
                </tr>
                
                <tr>
                    <td colspan="3" style="text-align:center">
						<input type="submit" name="save" id="save" class='btn btn-default' value="ADD">
						<input type="reset" class='btn btn-default' value="Reset">
						<input type="button" id='view_test' class='btn btn-primary' value="View">
					</td>
                </tr>
                
            </table>
         </form>
		 
		 <?php
			$test_data = $base->getTestData();
				echo"<div id='view_test_table' style='display:none;'>";
				echo"<table width='100%'>
					<tr>
						<td><input type='button' id='close' class='pull-right btn btn-danger close' value='X'/></td>
					</tr>
				
				</table>";
				echo"<table class='table table-bordered'>";
				
					echo"<tr>
						<th>SL</th>
						<th>Test Name</th>
					</tr>";
					for($i=0; $i<sizeof($test_data); $i++){
							echo "
								<tr>
									<td>".$test_data[$i]['test_id']."</td>
									<td>".$test_data[$i]['test_name']."</td>
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
				var form 	= $('#tform');
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
				
				$("#view_test").click(function(){
					$("#tform").hide();
					$("#view_test_table").show();
					
				});
				
				$("#close").click(function(){
					$("#view_test_table").hide();
					$("#tform").show();
					
				});
				
            });
         
         </script>