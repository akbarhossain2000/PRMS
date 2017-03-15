<?php
include_once("ini.php");

if(isset($_POST['login'])){
	
	try{
		if(empty($_POST['uid'])){
			throw new Exception('Username can not be empty');
		}
		
		if(empty($_POST['pass'])){
			throw new Exception('Password can not be empty');
		}
		
		if(empty($_POST['user'])){
			throw new Exception('Please Select User!');
		}
		
		if($_POST['user'] == "admin"){
			$num=0;
			$result = mysql_query("select * from login_info where uid='".$_POST['uid']."' and pass='".$_POST['pass']."'");
			//echo $result;
			$num = mysql_num_rows($result);
			
			if($num>0){
				session_start();
				$_SESSION['isLogin'] = "login";
				$_SESSION['user_type'] = "Admin";
				header("location: admin/index.php");
			}else{
				throw new Exception('Invalid Username and/or password');
			}
		} 
		
		if($_POST['user'] == "doctor") {
			$num1=0;
		  $result1 = mysql_query("select * from doctor_info where duid='".$_POST['uid']."' and pass='".$_POST['pass']."'");
		  $num1 = mysql_num_rows($result1);
		  $row	= mysql_fetch_array($result1);
		  
		  if($num1>0){
			  session_start();
			  $_SESSION['isLogin'] = "login";
			  $_SESSION['user_type'] = "Doctor";
			  $_SESSION['did']		= $row['duid'];
			  header("location: admin/doctor_portal.php");
		  }else{
			  throw new Exception('Invalid Username and/or password');
		  }
		}
		
		if($_POST['user'] == "asst_doctor"){
			$num2=0;
			$result2 = mysql_query("select * from assdoc_info where aduid='".$_POST['uid']."' and pass='".$_POST['pass']."'");
			//echo $result;
			$num2 = mysql_num_rows($result2);
			$row  = mysql_fetch_array($result2);
			
			if($num2>0){
				session_start();
				$_SESSION['isLogin'] = "login";
				$_SESSION['user_type'] = "Assistant Doctor";
				$_SESSION['adid']		= $row['aduid'];
				header("location: admin/assdoc_portal.php");
			}else{
				throw new Exception('Invalid Username and/or password');
			}
		} 
		
		if($_POST['user'] == "patient") {
			$num3=0;
		  $result3 = mysql_query("select * from patient_profile where puid='".$_POST['uid']."' and pass='".$_POST['pass']."'");
		  $num3 = mysql_num_rows($result3);
		  $row = mysql_fetch_array($result3);
		  
		  if($num3>0){
			  session_start();
			  $_SESSION['isLogin'] = "login";
			  $_SESSION['user_type'] = "Patient";
			  $_SESSION['pid']=$row['puid'];
			  header("location: user/patient_portal.php");
		  }else{
			  throw new Exception('Invalid Username and/or password');
		  }
		}
	}
	
	
	
	catch(Exception $e){
		$error_message = $e->getMessage();
	}
	
}

?>

<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->

        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/animate.css">
        <link rel="stylesheet" href="css/uikit.min.css">
        <link rel="stylesheet" href="css/datepicker.css">
        <link rel="stylesheet" href="css/main.css">
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,500,700,900' rel='stylesheet' type='text/css'>
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    </head>


<center>
<body class="bodybg">
	
	<header class="ltop_header">
        	<div class="container-fluid">
            	<div class="row">
					<div class="col-md-12">
						<div class="pull-left home"><a href="index.php" class="btn btn"><b>Home</b></a></div>
					</div>
					
				</div>
            </div>
	</header>
  
	<div class="container">    
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title"><p style="font-weight:bold;">Patient Relationship Management System</p>Sign In</div>
                        <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#">Forgot password?</a></div>
                    </div>     

                <div style="padding-top:30px" class="panel-body" >

				<div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
					
				<form id="loginform" class="form-horizontal" role="form" action="login.php" method="post">
							
					 <div style="margin-bottom: 25px" class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-check"></i></span>
								<select class="form-control" name="user" id="user">
								  <option value="">----Select----</option>
								  <option value="admin">Admin</option>
								  <option value="doctor">Doctor</option>
								  <option value="asst_doctor">Assistant Doctor</option>
								  <option value="patient">Patient</option>
								</select>                                       
					</div>
					
					<div style="margin-bottom: 25px" class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
								<input id="login-username" type="text" class="form-control" name="uid" placeholder="username or email">                                        
					</div>
						
					<div style="margin-bottom: 25px" class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
								<input id="login-password" type="password" class="form-control" name="pass" placeholder="password">
							</div>
							

						
					<div class="input-group">
							  <div class="checkbox">
								<label>
								  <input id="login-remember" type="checkbox" name="remember" value="1"> Remember me
								</label>
							  </div>
							</div>


						<div style="margin-top:10px" class="form-group">
							<!-- Button -->
							<div>
								<?php
								if(isset($error_message)){
									echo "<p style='color:red'>$error_message</p>";
								}
								?>
							</div>
							<div class="col-sm-12 controls marginbutton">
							  <input type="submit" id="btn-login" class="btn btn-success" name="login" value="Login">
							  <a id="btn-fblogin" href="#" class="btn btn-primary">Login with Facebook</a>

							</div>
						</div>


						<div class="form-group">
							<div class="col-md-12 control">
								<div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
									Don't have an account! 
								<a onClick="$('#loginbox').hide(); $('#signupbox').show()">
									Sign Up Here
								</a>
								</div>
							</div>
						</div>    
					</form>     
                </div>                     
            </div>  
        </div>
		
		
		
		
        <div id="signupbox" style="display:none; margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="panel-title">Sign Up</div>
                            <div style="float:right; font-size: 85%; position: relative; top:-10px"><a id="signinlink" onclick="$('#signupbox').hide(); $('#loginbox').show()">Sign In</a></div>
                        </div>  
                        <div class="panel-body" >
                            <form id="signupform" class="form-horizontal" role="form" action="signup_proccess.php" method="post" onSubmit="return formValidation(this)">
                                
                                <div id="signupalert" style="display:none" class="alert alert-danger">
                                    <p>Error:</p>
                                    <span></span>
                                </div>
                                    
                                
                                    
                                <div class="form-group">
                                    <label for="firstname" class="col-md-3 control-label">First Name</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="firstname" id="firstname" placeholder="First Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="lastname" class="col-md-3 control-label">Last Name</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Last Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="username" class="col-md-3 control-label">User Name</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="uname" id="uname" placeholder="User Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="col-md-3 control-label">Password</label>
                                    <div class="col-md-9">
                                        <input type="password" class="form-control" name="passwd" id="passwd" placeholder="Password">
                                    </div>
                                </div>
                                    
                                <div class="form-group">
                                    <label for="re_password" class="col-md-3 control-label">Retype Password</label>
                                    <div class="col-md-9">
                                        <input type="password" class="form-control" name="re_passwd" id="re_passwd" placeholder="Retype Password">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="email" class="col-md-3 control-label">Email</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="email" id="email" placeholder="Email Address">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="phone" class="col-md-3 control-label">Phone</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="phone" id="phone" onKeyPress="return onlyNumeric(event)" placeholder="Phone">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="dateofbirth" class="col-md-3 control-label">Date of Birth</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control datepicker" name="dob" id="dob" placeholder="Date of Birth">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="gender" class="col-md-3 control-label">Gender</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="gender" id="gender">
                                        	<option value="">----Select----</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <!-- Button -->                                        
                                    <div class="col-md-offset-3 col-md-9">
                                        <button id="btn-signup" type="submit" class="btn btn-info" name="save"><i class="icon-hand-right"></i> &nbsp Sign Up</button>
                                        <span style="margin-left:8px;">or</span>  
                                    </div>
                                </div>
                                
                                <div style="border-top: 1px solid #999; padding-top:20px"  class="form-group">
                                    
                                    <div class="col-md-offset-3 col-md-9">
                                        <button id="btn-fbsignup" type="button" class="btn btn-primary"><i class="icon-facebook"></i>   Sign Up with Facebook</button>
                                    </div>                                           
                                        
                                </div>
                                
                                
                                
                            </form>
                         </div>
                    </div>

               
               
                
         </div> 
    </div>
    <script src="js/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>
        <script src="js/plugins.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/uikit.min.js"></script>
        <script src="js/bootstrap-datepicker.js"></script>
		<script src="js/jquery.sticky.js"></script>
        <script src="js/main.js"></script>
        <script src="js/script.js"></script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X','auto');ga('send','pageview');
        </script>
        <script type="text/javascript">
			$(function(){
				$('.datepicker').datepicker();
				var checkout = $('#dob').datepicker({
					onRender: function(date) {
					return date.valueOf() < now.valueOf() ? 'disabled' : '';
					}
				}).on('changeDate', function(ev) {
					checkout.hide();
				}).data('datepicker');	
				
			});
			
			$(document).ready(function(){
				$(".ltop_header").sticky({topSpacing:0});
			  });
			
		
		</script>
        
        <script type="text/javascript">

			function formValidation(){
				
				var fname = document.getElementById("firstname").value;
					if(fname==""){
						alert("First Name is required!");
						return false;
					}
				var lname = document.getElementById("lastname").value;
					if(lname==""){
						alert("last Name is required!");
						return false;
					}
				var uname = document.getElementById("uname").value;
					if(uname==""){
						alert("Username is required!");
						return false;
					}
				var pass = document.getElementById("passwd").value;
					if(pass==""){
						alert("Password is required!");
						return false;
					}
				var re_pass = document.getElementById("re_passwd").value;
					if(re_pass==""){
						alert("Retype Password is required!");
						return false;
					}
				var email = document.getElementById("email").value;
					if(email==""){
						alert("Email ID is required!");
						return false;
					}
				var phone = document.getElementById("phone").value;
					if(phone==""){
						alert("Phone Number is required!");
						return false;
					}
				
				var dob = document.getElementById("dob").value;
					if(dob==""){
						alert("Date of Birth is required!");
						return false;
					}
				var gender = document.getElementById("gender").value;
					if(gender==""){
						alert("Gender is required!");
						return false;
					}
				return true;
			}

		</script>
</body>
</center>
</html>
