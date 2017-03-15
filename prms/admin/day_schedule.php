<?php
include_once("DataModel.php");

$base = new Dmodel();

$id = $base->create_dep_id("month_schedule", "id");

?>
	
    <div class="msg"></div>
    <form action="" method="post" name="form" id="form">
    <input type="hidden" name="formcheck" value="day_schedule" />
	<table class="table">
    	<tr>
        	<th colspan="3" style="background-color:#0F9">Day Schedule Setup</th>
        </tr>
        
        <tr>
        	<td>ID</td>
            <td>:</td>
            <td><input type="text" name="id" id="id" value="<?php echo $id;?>" style="text-align:center" readonly /></td>
        </tr>
        
        <tr>
        	<td>Doctor Name</td>
            <td>:</td>
            <td>
            	<select name="duid" id="duid"><option>-------</option></select>
            </td>
        </tr>
        
        <tr>
        	<td>Department</td>
            <td>:</td>
            <td>
            	<input type="hidden" name="depidpass" id="depidpass" readonly />
            	<input type="text" name="depid" id="depid" readonly /> 
            </td>
        </tr>
        
        <!--<tr>
        	<td>Month</td>
            <td>:</td>
            <td>
            	<select>
                	<option></option>
                    <option></option>
                    <option></option>
                    <option></option>
                    <option></option>
                    <option></option>
                    <option></option>
                    <option></option>
                    <option></option>
                    <option></option>
                    <option></option>
                    <option></option>
                </select>
            </td>
        </tr>-->
        
        <tr>
        	<td>Day</td>
            <td>:</td>
            <td><input type="text" name="day" id="day" /></td>
        </tr>
        
        <tr>
        	<td colspan="3" style="text-align:center;">
            	<input type="submit" name="save" id="save" value="Save" class="btn btn-primary" />
            </td>
        </tr>
    </table>
    </form>
    
    <script src="js/jquery.min.js"></script>
    <script type="text/javascript">
		$(document).ready(function(e) {
            
			$.ajax({
				type:'POST',
				url:'select_sql.php',
				data:{action:'getDoctor_data'},
				dataType:'json',
				success: function(data){
					
					var text = "";
					text += "<option value=''>-------</option>";
					for(id in data){
						text +="<option value='"+data[id].duid+"'>"+data[id].dname+"</option>";
						//alert(text);
					}
					$('#duid').html(text);
					
					$('#duid').bind('change', function(e){
						var d_id = $(this).val();
						for(id in data){
							if(d_id == data[id].duid){
								
								$("#depidpass").val(data[id].depid);
								$("#depid").val(getDepname(data[id].depid));
						
								break;
							}
						}
						
					});
					
						function getDepname(id){
						$.ajax({
							type:'POST',
							async:false,
							url:"select_sql.php",
							data:{action:'getDepname', id:id},
							success: function(data){
								
								resp = data;
							}
						});
						return resp;
						}
						
				}
				
			});
			
			var form = $('#form');
			var submit = $('#save');
			var msg = $('.msg');
			
			form.on('submit', function(e){
				e.preventDefault();
				
				$.ajax({
					type:'POST',
					url:'form_sql.php',
					dataType:'html',
					data: form.serialize(),
					beforeSend: function(){
						msg.fadeOut(5000);
						msg.html('Data Saving.....');
					},
					success: function(data){
						msg.html(data).fadeIn();
						form.trigger('reset');
						submit.html('Save');
					},
					error: function(e){
						console.log(e);
					}
					
				});
				
			});
			
        });
	
	</script>