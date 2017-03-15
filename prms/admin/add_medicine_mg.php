<?php
include_once("DataModel.php");

$base = new Dmodel();

$id = $base->create_dep_id("medicine_mg", "mid");

$m_id = $base->getMedicine();

@$data = $_POST['medicine_id'];

?>
	<div class="msg_area"></div>
	<form action="" name="mmform" id="mmform" method="post">
    	<input type="hidden" name="formcheck" value="add_medicine_mg">
    	<table class="table">
        	<tr>
            	<th colspan="3" style="background:#135434; color:#fff; text-align:center; padding:5px;">Add Medicine Mg</th>
            </tr>
            <input type="hidden" name="mid" id="mid" value="<?php echo $id; ?>" />
            <tr>
                    <td>Medicine Name</td>
                    <td>:</td>
                    <td>
                    	<select name="medicine_id" id="medicine_id">
                        	<option selected="selected">------</option>
                            <?php
								foreach($m_id as $k => $v){
									if(@$data == $k){
										echo"<option value='$k' selected='selected'>$v</option>";	
									}else{
										echo"<option value='$k'>$v</option>";	
									}
								}
							?>
                            
                        </select>
                   </td>
                </tr>
                
                <tr>
                    <td>Medicine mg</td>
                    <td>:</td>
                    <td><input type="text" name="mg" id="mg" required /></td>
                </tr>
                
                <tr>
                	<td colspan="3" style="text-align:center">
						<input type="submit" name="save" id="save" class='btn btn-default' value="ADD">
						<input type="reset" class='btn btn-default' value="Reset">
					</td>
                </tr>
        </table>
    </form>
    
    <script src="js/jquery.min.js"></script>
    <script type="text/javascript">
    	$(document).ready(function(e) {
            var submit = $('#save');
			var form	= $('#mmform');
			var msg		= $('.msg_area');
			
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
        });
    
    </script>