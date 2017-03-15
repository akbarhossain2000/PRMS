<?php
session_start();
if(!isset($_SESSION['isLogin']) || $_SESSION['isLogin']!='login')
{
	header("location: ./login.php");
}

include_once("ini.php");
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
        <link rel="stylesheet" href="css/jquery-ui.css" />
        <link rel="stylesheet" href="css/stylemain.css" />
		<link rel="stylesheet" href="css/datepicker.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/responsive.css">
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,500,700,900' rel='stylesheet' type='text/css'>
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
        
        <!-- Header -->
        <header id="top_header">
        	<div class="container-fluid">
            	<div class="row">
					<div class="col-md-12">
						<div class="pull-right"><a href="../logout.php" class=""><b style="color:#135434">LogOut</b></a></div>
						<div class="container">
							<div class="row">
								<div class="col-md-6">
									<div data-uk-scrollspy="{cls:'uk-animation-slide-top', repeat: true}" class="logo pull-left">
										<img src="img/logo.png" alt="Logo">
									</div>
								</div>
								<div class="col-md-6">
									<div data-uk-scrollspy="{cls:'uk-animation-slide-top', repeat: true}" class="social_icon pull-right">
										<a href=""><i class="fa fa-facebook"></i></a>
										<a href=""><i class="fa fa-google-plus"></i></a>
										<a href=""><i class="fa fa-twitter"></i></a>
										<a href=""><i class="fa fa-linkedin"></i></a>
									</div>
								</div>
							</div>
						</div>
					</div>
					
				</div>
            </div>
			
        </header> <!-- /Header -->
        <!-- Header Title -->
        <section id="header">
        	<div class="container">
            	<div class="col-md-12">
                	<div  class="header_title">
                    	<h2 data-uk-scrollspy="{cls:'uk-animation-slide-top', repeat: true}">Patient Relationship Management System</h2>
                    </div>
                </div>
                
            </div>
        </section> <!-- /Header Title -->
        <!-- Main Menu -->
        <section id="mainmenu">
        	<div class="container">
            	<div class="col-md-12 navigation">
                	<nav>
                    	<ul id="menu">
                        	<?php
							
							/*if($_SESSION['user_type']=='Admin'){
								if(($_SESSION['user_type']=='Admin')||($_SESSION['user_type']=='Doctor')||($_SESSION['user_type']=='Assistant Doctor')||($_SESSION['user_type']=='Patient')){
									
								echo"
									<li class='menu_box animated slideInLeft'><a href='index.php'>Home</a></li>
									<li class='menu_box animated slideInLeft'><a href='p_appointment.php'>Patient Appointment</a></li>
									<li class='menu_box animated slideInUp'><a href='assdoc_portal.php'>Assistant Doctor Portal</a></li>
									<li class='menu_box animated slideInRight'><a href='doctor_portal.php'>Doctor Portal</a></li>
									<li class='menu_box animated slideInRight'><a href='patient_portal.php'>Patient Dashboard</a></li>
									
											
									}
						
							}
							if(($_SESSION['user_type']=='Doctor')){
						
						echo "<li class='menu_box animated slideInLeft'><a href='index.php'>Home</a></li>";
						echo"<li class='menu_box animated slideInLeft'><a href='p_appointment.php'>Patient Appointment</a></li>
                            <li class='menu_box animated slideInRight'><a href='doctor_portal.php'>Doctor Portal</a></li>";
									
						
							
							}
							
							if($_SESSION['user_type'] == 'Assistant Doctor'){
								echo "<li class='menu_box animated slideInLeft'><a href='index.php'>Home</a></li>";
								echo"<li class='menu_box animated slideInLeft'><a href='p_appointment.php'>Patient Appointment</a></li>";																	
								echo "<li class='menu_box animated slideInUp'><a href='assdoc_portal.php'>Assistant Doctor Portal</a></li>";
						
							}*/
							if($_SESSION['user_type'] == 'Admin'){
								echo "<li class='menu_box animated slideInLeft'><a href='../admin/index.php'>Home</a></li>";
								echo"<li class='menu_box animated slideInLeft'><a href='p_appointment.php'>Patient Appointment</a></li>";							
								echo"<li class='menu_box animated slideInTop'><a href='patient_portal.php'>Patient Dashboard</a></li>";
								echo"<li class='menu_box animated slideInRight'><a href='view_doctor_list.php'>View Doctor</a></li>";
								echo"<li class='menu_box animated slideInRight'><a href='javascript:void(0)'>Link</a></li>";
						
							}
							
							else if($_SESSION['user_type'] == 'Patient'){
								echo "<li class='menu_box animated slideInLeft'><a href='index.php'>Home</a></li>";
								echo"<li class='menu_box animated slideInLeft'><a href='p_appointment.php'>Patient Appointment</a></li>";									
								echo"<li class='menu_box animated slideInUp'><a href='patient_portal.php'>Patient Dashboard</a></li>";
								echo"<li class='menu_box animated slideInRight'><a href='view_doctor_list.php'>View Doctor</a></li>";
								echo"<li class='menu_box animated slideInRight'><a href='javascript:void(0)'>Link</a></li>";
						
							}
							
							?>
                        </ul>
                    </nav>
                </div>
            </div>
        </section><!-- /Main Menu -->