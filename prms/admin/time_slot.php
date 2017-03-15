<?php
include_once("DataModel.php");

$base = new Dmodel();

$id = $base->create_dep_id("time_slot", "slot_id");
?>	
	<div class="msg"></div>
	<form action="" method="post" name="form" id="form">
    	<input type="hidden" name="formcheck" value="time_slot" />
	<table class="table">
    	<tr>
        	<th colspan="3" style="background-color:#0F9">Time Slot Setup</th>
        </tr>
        
        <tr>
        	<td>Time Slot ID</td>
            <td>:</td>
            <td><input type="text" name="slot_id" id="slot_id" value="<?php echo $id;?>" style="text-align:center;" readonly="readonly"/></td>
        </tr>
        
        <tr>
        	<td>Time Slot Name</td>
            <td>:</td>
            <td>
            	<select name="slot_name" id="slot_name" required style="width:182px;">
            		<option value="">-----</option>
                    <option>Morning</option>
                    <option>Evening</option>
                </select>
            </td>
        </tr>
        
        <tr>
        	<td>Start Time</td>
            <td>:</td>
            <td>
            	<select name="start_time_hour" id="start_time_hour" required style="width:50px" >
                	<option value="">-----</option>
                    <?php
						for($i=0; $i<=1; $i++){
							if($i == 1){
								for($j = 0; $j<=2; $j++){
									echo "<option>".$i."".$j."</option>";
								}
								
								}else{
									for($j=1; $j<=9; $j++){
										echo "<option>".$i."".$j."</option>";		
									}
								}
						}
					?>
                </select>
                
                <select name="start_time_minute" id="start_time_minute" required style="width:50px" >
                	<option value="">-----</option>
                    <?php
						for($i=0; $i<=6; $i++){
							if($i == 6){
								$j = 0;
									echo "<option>".$i."".$j."</option>";
								
								}else{
									for($j=0; $j<=9; $j++){
										echo "<option>".$i."".$j."</option>";		
									}
								}
						}
					?>
                    
                </select>
                
                <select name="st_am_pm" id="st_am_pm" required style="width:50px" >
                	<option value="">---</option>
                    <option>AM</option>
                    <option>PM</option>
                </select>
         	</td>
        </tr>
        
        <tr>
        	<td>End Time</td>
            <td>:</td>
            <td>
            	<select name="end_time_hour" id="end_time_hour" required style="width:50px" >
                	<option value="">-----</option>
                    <?php
						for($i=0; $i<=1; $i++){
							if($i == 1){
								for($j = 0; $j<=2; $j++){
									echo "<option>".$i."".$j."</option>";
								}
								
								}else{
									for($j=1; $j<=9; $j++){
										echo "<option>".$i."".$j."</option>";		
									}
								}
						}
					?>
                </select>
                
                <select name="end_time_minute" id="end_time_minute" required style="width:50px" >
                	<option value="">-----</option>
                    <?php
						for($i=0; $i<=6; $i++){
							if($i == 6){
								$j = 0;
									echo "<option>".$i."".$j."</option>";
								
								}else{
									for($j=0; $j<=9; $j++){
										echo "<option>".$i."".$j."</option>";		
									}
								}
						}
					?>
                    
                </select>
                
                <select name="et_am_pm" id="et_am_pm" required style="width:50px" >
                	<option value="">---</option>
                    <option>AM</option>
                    <option>PM</option>
                </select>
         	</td>
        </tr>
        
        <tr>
        	<td colspan="3" style="text-align:center;"><input type="submit" name="save" id="save" value="Save" class="btn btn-primary" /></td>
        </tr>
    </table>
    
    </form>
    
    <script src="js/jquery.min.js"></script>
    <script type="text/javascript">
		$(document).ready(function(e) {
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
						msg.html('Data Saving....');	
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