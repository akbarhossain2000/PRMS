<?php
include_once("ini.php");
include_once("DataModel.php");

$base = new Dmodel();

$id		= $base->create_dep_id("doctor_info", "id");		
		
	$sql="SELECT * FROM department";
	$rec = mysql_query($sql);
	while($row = mysql_fetch_array($rec)){
		$depid = $row['depid'];
		$department = $row['department'];
		$dep_ary[$depid]= $department;
	}
?>


		<div class="alert2"></div>
       	<form action="" id="form2" method="post" enctype="multipart/form-data">
      			<input type="hidden" name="formcheck" value="doc_reg" />
                    <table class="table">
                    	<tr>
                        	<th colspan="3" style="background:#135434; color:#fff; text-align:center; padding:5px;">Doctor Registration</th>
                        </tr>
                    	<tr>
                            <td>ID</td>
                            <td>:</td>
                            <td><input type="text" name="id" id="id" value="<?php echo $id; ?>" readonly style="text-align:center" /></td>
                        </tr>
                        <tr>
                            <td>User ID</td>
                            <td>:</td>
                            <td ><input type="text" name="duid" id="duid" required /></td>
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
                            <td>Doctor Name</td>
                            <td>:</td>
                            <td><input type="text" name="dname" id="dname" required /></td>
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
                            	<select name="gender" id="gender" required >
                                	<option value="">---Select---</option>
                                	<option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Department</td>
                            <td>:</td>
                            <td>
                                <select name="department" id="department" required >
                                    <option value="">---Select---</option>
                                    <?php
										foreach($dep_ary as $k=>$v){
                                    	echo"<option value='$k'>$v</option>";
										}
									?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Designation</td>
                            <td>:</td>
                            <td><input type="text" name="desig" id="desig" required /></td>
                        </tr>
                        <tr>
                            <td>Highest Degree</td>
                            <td>:</td>
                            <td><input type="text" name="hdegree" id="hdegree" required /></td>
                        </tr>
                        <tr>
                            <td>Chamber Add</td>
                            <td>:</td>
                            <td><input type="text" name="chamadd" id="chamadd" required /></td>
                        </tr>
                      
                        <tr>
                            <td>Image</td>
                            <td>:</td>
                            <td><input type="file" name="img" id="img" /></td>
                        </tr>
                        
                        <tr>
                            <td colspan="3"><input type="submit" name="save2" id="save2" value="Submit" class="btn btn-default"/></td>
                        </tr>
                    </table>
            </form>

<script src="js/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(e) {
        
		var form2 = $('#form2');
		var submit = $('#save2');
		var alert2 = $('.alert2');
		
		form2.on('submit', function(e){
			e.preventDefault();
			
			$.ajax({
				url:'form_sql.php',
				type:'POST',
				dataType:'html',
				data: form2.serialize(),
				beforeSend: function(){
					alert2.fadeOut();
					alert2.html('Data Saving...');
				},
				success: function(data){
					alert2.html(data).fadeIn();
					form2.trigger('reset');
					submit.html('Submit');
				},
				error: function(e){
					console.log(e);
				}
			});
		});
    });


</script>