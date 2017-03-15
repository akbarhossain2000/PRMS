<?php

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
	<table>
    	<tr>
            <td width="200">ID</td>
            <td width="13">:</td>
            <td width="287"><input type="text" name="id" id="id" /></td>
        </tr>
        <tr>
            <td width="200">User ID</td>
            <td width="13">:</td>
            <td width="287"><input type="text" name="puid" id="puid" /></td>
        </tr>
        <tr>
            <td>Password</td>
            <td>:</td>
            <td><input type="password" name="pass" id="pass" /></td>
        </tr>
        <tr>
            <td>Re-type Password</td>
            <td>:</td>
            <td><input type="password" name="repass" id="repass" /></td>
        </tr>
    	<tr>
        	<td>Patient Name</td>
            <td>:</td>
            <td colspan="2"><input type="text" name="pname" id="pname" /></td>
        </tr>
        <tr>
        	<td>Mobile No</td>
            <td>:</td>
            <td colspan="2"><input type="text" name="phone" id="phone" /></td>
        </tr>
        <tr>
        	<td>Email</td>
            <td>:</td>
            <td colspan="2"><input type="text" name="email" id="email" /></td>
        </tr>
        <tr>
        	<td>Date of Birth</td>
            <td>:</td>
            <td><input type="text" name="dob" id="dob" /></td>
            <td><input type="button" name="calculate" id="calculate" value="Calculate" /></td>
        </tr>
        <tr>
        	<td>Age</td>
            <td>:</td>
            <td colspan="2"><input type="text" name="age" /></td>
        </tr>
        <tr>
        	<td>Gender</td>
            <td>:</td>
            <td colspan="2">
            	<select>
                	<option>---Select---</option>
                	<option>Male</option>
                    <option>Female</option>
                </select>
            </td>
        </tr>
        <tr>
        	<td>Blood Group</td>
            <td>:</td>
            <td colspan="2">
            	<select>
                	<option>---Select---</option>
                	<option>AB+</option>
                    <option>AB-</option>
                    <option>A+</option>
                    <option>A-</option>
                    <option>B+</option>
                    <option>B-</option>
                    <option>O+</option>
                    <option>O-</option>
               </select>
            </td>
        </tr>
        <tr>
        	<td>Patient Address</td>
            <td>:</td>
            <td colspan="2">
            	<textarea name="address" id="address">Address</textarea>
            </td>
        </tr>
        <tr>
        	<td>Claim</td>
            <td>:</td>
            <td colspan="2">
            	<textarea name="pclaim" id="pclaim">Claim</textarea>
            </td>
        </tr>
        
        <tr>
        	<td>If any Previous Prescription</td>
            <td>:</td>
            <td colspan="2"><input type="file" name="pimg" id="pimg" /></td>
        </tr>
        <tr>
        	<td><input type="submit" name="save" value="Submit" /></td>
        </tr>
    </table>

</body>
</html>