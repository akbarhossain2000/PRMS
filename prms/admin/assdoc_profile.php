<?php
session_start();
if(!isset($_SESSION['isLogin']) || $_SESSION['isLogin']!='login')
{
	header("location: ../login.php");
}
include_once('ini.php');
include_once('DataModel.php');
$base = new Dmodel();

  @$aduid = $_SESSION['adid'];

	$sql = "SELECT * FROM assdoc_info WHERE aduid = '".@$aduid."'";
	$rec = mysql_query($sql);
	
	if($row = mysql_fetch_array($rec)){
		$did = $row['aduid'];
		$dname = $row['adname'];
		$phone = $row['phone'];
		$email = $row['email'];
		$gender= $row['gender'];
		$dept	= $row['depid'];
		$image = $row['adimg'];
		
		if($did != ""){
			echo "<div id='profile_table_form'>";	
			echo"<table class='table' id='adprofile_table'>";
				echo"<tr>";
				echo"<td colspan='2' align='left'>
						<img src='img/assistant_doctor.jpg' class='img-thumbnail' alt='' style='height:150px; width:150px;'></br>
						<input type='file' id='upload' name='upload' style='visibility: hidden; width: 1px; height: 1px' />
						<a href='' onclick=\"document.getElementById('upload').click(); return false\">Change picture</a>
						</td>";
				echo"<td><a href='javascript:void(0)' id='adpro_edit' class='pull-right'>Edit</a></td>";
				echo"</tr>";
				
				echo"<tr>";
				echo"<td>Assistant Doctor ID</td>";
				echo"<td>:</td>";
				echo"<td>$did</td>";
				echo"</tr>";
				
				echo"<tr>";
				echo"<td>Assistant Doctor Name</td>";
				echo"<td>:</td>";
				echo"<td>$dname</td>";
				echo"</tr>";
				
				echo"<tr>";
				echo"<td>Phone</td>";
				echo"<td>:</td>";
				echo"<td>0$phone</td>";
				echo"</tr>";
				
				echo"<tr>";
				echo"<td>Email</td>";
				echo"<td>:</td>";
				echo"<td>$email</td>";
				echo"</tr>";
				
				echo"<tr>";
				echo"<td>Gender</td>";
				echo"<td>:</td>";
				echo"<td>$gender</td>";
				echo"</tr>";

				echo"<tr>";
				echo"<td>Department</td>";
				echo"<td>:</td>";
				echo"<td>".depData($dept)."</td>";
				echo"</tr>";
				
				
				
			echo"</table>";
			echo"</div>";

		}			
	}
	
	
	
 function depData($depname){
			$sql = "SELECT department FROM department WHERE depid = '".$depname."'";
			$result = mysql_query($sql);
			if($row = mysql_fetch_array($result)){
				$depname = $row['department'];
			}
			return $depname;
		}
		
		
$sql="SELECT * FROM department";
	$rec = mysql_query($sql);
	while($row = mysql_fetch_array($rec)){
		$depid = $row['depid'];
		$department = $row['department'];
		$dep_ary[$depid]= $department;
	}
		

?>

<div id="profile_edit_table_form" style="display:none">
	<form action="update_profile.php" target="_blank" name="adprofile_edit" id="adprofile_edit" method="post" enctype="multipart/form-data">
		<input type="hidden" name="dataupdate" value="ass_doc" />
    	<table class="table" id="adprofile_edit_table">
        	<input type="hidden" name="aduid" id="aduid" value="<?php echo $aduid; ?>" />
            
            <tr>
            	<td>Name</td>
                <td>:</td>
                <td><input type="text" name="adname" id="adname"  value="<?php echo $dname; ?>"/></td>
            </tr>
            
            
            <tr>
            	<td>Phone</td>
                <td>:</td>
                <td><input type="text" name="phone" id="phone" value="<?php echo '0'.$phone; ?>" /></td>
            </tr>
            
            <tr>
            	<td>Email</td>
                <td>:</td>
                <td><input type="text" name="email" id="email" value="<?php echo $email; ?>" /></td>
            </tr>
            
            <tr>
            	<td>Gender</td>
                <td>:</td>
                <td>
                	<select name="gender" id="gender" style="width:148px;">
                    	<option selected><?php echo $gender; ?></option>
                        <option>Male</option>
                        <option>Female</option>
                    </select>
                	
                </td>
            </tr>
            
            <tr>
            	<td>Department</td>
                <td>:</td>
                <td>
                	<select name='depid' id='depid'>
                    	<?php
                    		echo "<option value='$dept' selected>".depData($dept)."</option>";
							foreach($dep_ary as $k=>$v){
                                	echo "<option value='$k'>$v</option>";
							}
						?>
                    </select>
                </td>
            </tr>
            
            <tr>
            	<td colspan="3">
                	<input type="submit" name="adedit" id="adedit" value="Update" />
                    <input type="button" id="close" value="Close"/>
                </td>
            </tr>
        </table>
    
    </form>
    </div>
    
    <script src="js/jquery.min.js"></script>
    <script type="text/javascript">
    	$(document).ready(function(e) {
            
			$("#adpro_edit").click(function(e) {
                //alert('d');
				$("#profile_table_form").hide();
				$("#profile_edit_table_form").show();
            });
			
			$("#close").click(function(e) {
                //alert('d');
				$("#profile_edit_table_form").hide();
				$("#profile_table_form").show();
            });
        });
    </script>