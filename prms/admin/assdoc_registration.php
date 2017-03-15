<?php
include_once("DataModel.php");
$base = new Dmodel();

include_once("ini.php");
	$sql="SELECT * FROM department";
	$rec = mysql_query($sql);
	while($row = mysql_fetch_array($rec)){
		$depid = $row['depid'];
		$department = $row['department'];
		$dep_ary[$depid]= $department;
	}
	
	$id = $base->create_dep_id("assdoc_info", "id");
	
?>

		
        
        
        <div class="alert1"></div>
        <form action="" id="form1" method="post" enctype="multipart/form-data">
		
        	<input type="hidden" name="formcheck" value="ass_doc" />
                     <table class="table">
                     	<tr>
                        	<th colspan="3" style="background:#135434; color:#fff; text-align:center; padding:5px;">Assistant Doctor Registration</th>
                        </tr>
                     	<tr>
                            <td>ID</td>
                            <td>:</td>
                            <td><input type="text" name="id" id="id" value="<?php echo $id; ?>" style="text-align:center" /></td>
                        </tr>
                        <tr>
                            <td>User Name</td>
                            <td>:</td>
                            <td><input type="text" name="aduid" id="adiud" required /></td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td>:</td>
                            <td><input type="password" name="pass" id="pass" required /></td>
                        </tr>
                        <tr>
                            <td>Re-type Password</td>
                            <td>:</td>
                            <td><input type="password" name="repass" id="repass" required /></td>
                        </tr>
                        <tr>
                            <td>Assistant Doctor Name</td>
                            <td>:</td>
                            <td><input type="text" name="adname" id="adname" required /></td>
                        </tr>
                        <tr>
                            <td>Mobile No</td>
                            <td>:</td>
                            <td><input type="text" name="phone" id="phone" required /></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td><input type="text" name="email" id="name" required /></td>
                        </tr>
                        
                        <tr>
                            <td>Gender</td>
                            <td>:</td>
                            <td>
                            	<select name="gender" id="gender" required>
                                	<option value="">-----</option>
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                            </td>
                        </tr>
                        
                        <tr>
                            <td>Department</td>
                            <td>:</td>
                            <td>
                                <select name="depid" id="depid" required >
                                    <option value="">---Select---</option>
                                    <?php
										foreach($dep_ary as $k=>$v){
                                    	echo "<option value='$k'>$v</option>";
										}
									?>
                                </select>
                            </td>
                        </tr>
                       
                        <tr>
                            <td>Image</td>
                            <td>:</td>
                            <td><input type="file" name="img" id="img" /></td>
                        </tr>
                        <tr>
                            <td colspan="3"><input type="submit" name="save1" id="save1" value="Submit" class="btn btn-default"/></td>
                        </tr>
                    </table>
            </form>
			
			
<script type="text/javascript" src="js/jquery.min.js"></script>	
<script type="text/javascript">
				$(document).ready(function(e) {
                    
                	var form1 = $('#form1');
					var submit = $('#save1');
					var alert1 = $('.alert1');
					form1.on('submit', function(e){
						e.preventDefault();
						$.ajax({
							url:'form_sql.php',
							type:'POST',
							dataType:'html',
							enctype: 'multipart/form-data',
							data:form1.serialize(),
							async: false,
							beforeSend: function(){
								alert1.fadeOut(5000);
								alert1.html('Data Saving...');
							},
							success: function(data){
								alert1.html(data).fadeIn(2000);
								form1.trigger('reset');
								submit.html('Submit');	
							},
							error: function(e){
								console.log(e);
							}
							
						});
						
					});
					
				});
</script>
