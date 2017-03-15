<?php
session_start();
if(!isset($_SESSION['isLogin']) || $_SESSION['isLogin']!='login')
{
	header("location: ../login.php");
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title></title>

    <!-- Bootstrap -->
   		<link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->

        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/animate.css">
        <link rel="stylesheet" href="css/uikit.min.css">
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
        
        <!-- Main_menu-->
        <section id="mainmenu">
        	<div class="container">
            	<div class="col-md-12 navigation">
                	<nav>
                    	<ul id="menu">
							<?php
								if($_SESSION['user_type'] == "Admin"){
									echo "<li class='menu_box'><a href='index.php'>Home</a></li>
									<li class='menu_box'><a href='department.php'>Department</a></li>
									<li class='menu_box'><a href='ass_doctor.php'>Assistant Doctor</a></li>
									<li class='menu_box'><a href='doctor.php'>Doctor</a></li>
									<li class='menu_box'><a href='patient.php'>Patient</a></li>
									<li class='menu_box'><a href='assdoc_portal.php'>Assistant Doctor Portal</a></li>
									<li class='menu_box'><a href='doctor_portal.php'>Doctor Portal</a></li>
									<li class='menu_box'><a href='../user/index.php'>Patient Portal</a></li>";
								}else if($_SESSION['user_type'] == "Assistant Doctor"){
									echo "<li class='menu_box'><a href='index.php'>Home</a></li>
									<li class='menu_box'><a href='javascript:void(0)'>Department</a></li>
									<li class='menu_box'><a href='javascript:void(0)'>Assistant Doctor</a></li>
									<li class='menu_box'><a href='javascript:void(0)'>Doctor</a></li>
									<li class='menu_box'><a href='javascript:void(0)'>Patient</a></li>
									<li class='menu_box'><a href='assdoc_portal.php'>Assistant Doctor Portal</a></li>
									<li class='menu_box'><a href='javascript:void(0)'>Doctor Portal</a></li>
									<li class='menu_box'><a href='javascript:void(0)'>Patient Portal</a></li>";
									
								}else if($_SESSION['user_type'] == "Doctor"){
									
									echo "<li class='menu_box'><a href='index.php'>Home</a></li>
									<li class='menu_box'><a href='javascript:void(0)'>Department</a></li>
									<li class='menu_box'><a href='javascript:void(0)'>Assistant Doctor</a></li>
									<li class='menu_box'><a href='javascript:void(0)'>Doctor</a></li>
									<li class='menu_box'><a href='javascript:void(0)'>Patient</a></li>
									<li class='menu_box'><a href='javascript:void(0)'>Assistant Doctor Portal</a></li>
									<li class='menu_box'><a href='doctor_portal.php'>Doctor Portal</a></li>
									<li class='menu_box'><a href='javascript:void(0)'>Patient Portal</a></li>";
								}
                            ?>
                        </ul>
                    </nav>
            	</div>
            </div>
        </section>
        <!-- End_Main_menu-->
        <!-- Slider -->
        <section id="mainslider">
        	<div class="container">
            	<div class="row">
                	<div class="sliderbox">
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                  <!-- Indicators -->
                  <ol class="carousel-indicators">
                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="3"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="4"></li>
                  </ol>

                  <!-- Wrapper for slides -->
                  <div class="carousel-inner" role="listbox">
                    <div class="item active">
                      <img src="img/akbar1.jpg" alt="...">
                      <div class="carousel-caption">
                        <h3>This Is New Medicine</h3>
                        <p>It IS Good</p>
                      </div>
                    </div>
                    <div class="item">
                      <img src="img/akbar2.jpg" alt="...">
                      <div class="carousel-caption">
                        <h3>This Is New Medicine</h3>
                        <p>It IS Good</p>
                      </div>
                    </div>
                     <div class="item">
                      <img src="img/akbar3.jpg" alt="...">
                      <div class="carousel-caption">
                        <h3>This Is New Medicine</h3>
                        <p>It IS Good</p>
                      </div>
                    </div>
                     <div class="item">
                      <img src="img/akbar4.jpg" alt="...">
                      <div class="carousel-caption">
                        <h3>This Is New Medicine</h3>
                        <p>It IS Good</p>
                      </div>
                    </div>
                     <div class="item">
                      <img src="img/akbar5.jpg" alt="...">
                      <div class="carousel-caption">
                        <h3>This Is New Medicine</h3>
                        <p>It IS Good</p>
                      </div>
                    </div>
                  </div>

                  <!-- Controls -->
                  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>
                </div>
                    </div>
                </div>
            </div>
        </section> <!-- /Slider -->
        <!-- Main_body-->
        <!--<section id="mainbody">
        	<div class="container">
                <div class="col-md-3">
                    
                </div>
        	
                <div class="col-md-9">
                    <div>
                
                    </div>
                </div>
    
    		</div>
        </section>-->
        <!--End_main_body-->
        <!-- Footer -->
        <footer id="bottom_footer">
        	<div class="container">
            	<div data-uk-scrollspy="{cls:'uk-animation-slide-top', repeat: true}" class="col-md-12 footer">
                    	<p>&copy; 2015 PRMS</p>
                </div>
            </div>
        </footer> <!-- /Footer -->
        

    	<script src="js/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>
        <script src="js/plugins.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/uikit.min.js"></script>
		<script src="js/jquery-1.10.2.js"></script>
		<script src="js/bootstrap-datepicker.js"></script>
        <script src="js/main.js"></script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X','auto');ga('send','pageview');
        </script>
  </body>
</html> 