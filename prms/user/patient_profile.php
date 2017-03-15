<?php
session_start();
if(!isset($_SESSION['isLogin']) || $_SESSION['isLogin']!='login')
{
	header("location: ../login.php");
}
include_once('ini.php');
include_once('DataModel.php');
$base = new Dmodel();

 @$puid = $_SESSION['pid'];

	$sql = "SELECT * FROM patient_profile WHERE puid = '".@$puid."'";
	$rec = mysql_query($sql);
	
	if($row = mysql_fetch_array($rec)){
		$pid = $row['puid'];
		$fname = $row['pfname'];
		$lname = $row['plname'];
		$phone = $row['phone'];
		$email = $row['email'];
		$dob	= $row['dob'];
		$age	= $row['age'];
		$gender	= $row['gender'];
		$blood	= $row['blood'];
		$address= $row['address'];
		$image = $row['pimg'];
	echo "<div id='profile_table_form'>";	
	echo"<table class='table' id='profile_table'>";
		echo"<tr>";
		echo"<td colspan='2' align='left'>
						<img src='img/patient.jpg' class='img-thumbnail' alt='profile pic' style='height:150px; width:150px;'></br>
						<input type='file' id='upload' name='upload' style='visibility: hidden; width: 1px; height: 1px' />
						<a href='' onclick=\"document.getElementById('upload').click(); return false\">Change picture</a>
			</td>";
		echo "<td style='text-align:right'><a href='javascript:void(0)' id='pro_edit' style='text-align:right'>Edit</a></td>";
		echo"</tr>";
		
		echo"<tr>";
		echo"<td>Patient ID</td>";
		echo"<td>:</td>";
		echo"<td>$pid</td>";
		echo"</tr>";
		
		echo"<tr>";
		echo"<td>Patient Name</td>";
		echo"<td>:</td>";
		echo"<td>".$fname." ".$lname."</td>";
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
		echo"<td>Address</td>";
		echo"<td>:</td>";
		echo"<td><address>$address</address></td>";
		echo"</tr>";
		
		echo"<tr>";
		echo"<td>Gender</td>";
		echo"<td>:</td>";
		echo"<td>$gender</td>";
		echo"</tr>";
		
		echo"<tr>";
		echo"<td>Date Of Birth</td>";
		echo"<td>:</td>";
		echo"<td>$dob</td>";
		echo"</tr>";
		
		echo"<tr>";
		echo"<td>Age</td>";
		echo"<td>:</td>";
		echo"<td>$age</td>";
		echo"</tr>";
		
		echo"<tr>";
		echo"<td>Blood Group</td>";
		echo"<td>:</td>";
		echo"<td>$blood</td>";
		echo"</tr>";
		
		
		
	echo"</table>";
	echo"</div>";	
	}
?>
	<div id="profile_edit_table_form" style="display:none">
	<form action="pupdate_profile.php" target="_blank" name="pprofile_edit" id="pprofile_edit" method="post" enctype="multipart/form-data">
		<input type="hidden" name="dataupdate" value="patient_edit" />
    	<table class="table" id="profile_edit_table">
        	<input type="hidden" name="puid" id="puid" value="<?php echo $pid; ?>" />
            
            <tr>
            	<td>First Name</td>
                <td>:</td>
                <td><input type="text" name="pfname" id="pfname"  value="<?php echo $fname; ?>"/></td>
            </tr>
            
            <tr>
            	<td>Last Name</td>
                <td>:</td>
                <td><input type="text" name="plname" id="plname" value="<?php echo $lname; ?>" /></td>
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
            	<td>Address</td>
                <td>:</td>
                <td>
                	<textarea name="address" id="address"><?php echo $address; ?></textarea>
                </td>
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
            	<td>Date of Birth</td>
                <td>:</td>
                <td><input type="text" name="dob" id="dob" value="<?php echo $dob; ?>" /></td>
            </tr>
            
            <tr>
            	<td>Age</td>
                <td>:</td>
                <td><input type="text" name="age" id="age" value="<?php echo $age; ?>" /></td>
            </tr>
            
            <tr>
            	<td>Blood Group</td>
                <td>:</td>
                <td><input type="text" name="blood" id="blood" value="<?php echo $blood; ?>" /></td>
            </tr>
            
            <tr>
            	<td colspan="3">
                	<input type="submit" name="pedit" id="pedit" value="Update" />
                    <input type="button" id="close" value="Close"/>
                </td>
            </tr>
        </table>
    
    </form>
    </div>
    
    <script src="js/jquery.min.js"></script>
    <script type="text/javascript">
    	$(document).ready(function(e) {
            
			$("#pro_edit").click(function(e) {
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