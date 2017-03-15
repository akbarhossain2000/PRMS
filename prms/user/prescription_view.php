<?php
include_once("DataModel.php");
$base = new Dmodel();

$pres_id = $_GET['prs_id'];
$puid	= $_GET['puid'];
$duid  = $_GET['duid'];
$date = $_GET['date'];

$pres_data = $base->getPrescription($pres_id,$puid,$duid,$date);
$dep_id = $pres_data[0]['depid'];
$doctor_data = $base->getDoctordata($pres_data[0]['duid']);

$department_name = $base->depData($dep_id);

$patientdata = $base->getPatientData($pres_data[0]['puid']);

$test_id  = $base->getTestid($pres_id,$puid,$date);

$medicine_id = $base->getMedicineid($pres_id,$puid,$date);

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
        <link rel="stylesheet" href="css/responsive.css">
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,500,700,900' rel='stylesheet' type='text/css'>
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    <body style="margin-top:10px;">
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
        
        <!-- Header -->
        	<section id="pres_header">
            	<div class="container pres_header">
                	<div class="col-md-12">
                    	<div>
                        	<table width="100%">
                            	<tr>
                            		<td width="80%">
										<table>
											<tr>
												<td colspan="3"><b><h3><?php echo $doctor_data[0]['dname']; ?></h3></b></td>
											</tr>
											<tr>
												<td colspan="3"><?php echo $doctor_data[0]['desig']; ?></td>
											</tr>
											<tr>
												<td colspan="3"><?php echo $department_name; ?></td>
											</tr>
											<tr>
												<td colspan="3"><?php echo $doctor_data[0]['chamadd']; ?></td>
											</tr>
										</table>
									</td>
                            		<td valign="top">
										<table width="100%">
											<tr>
												<td>Prescription ID</td>
												<td>:</td>
												<td><span style="font-weight:bold"><?php echo $pres_data[0]['pres_id']; ?></span></td>
											</tr>
											<tr>
												<td>Date</td>
												<td>:</td>
												<td><?php echo $pres_data[0]['date']; ?></td>
											</tr>
											
										</table>
									</td>
                            	</tr>
                            </table>
                        </div>
                    </div>
                    
                </div>
            </section>
            
            <section id="patient_header">
            	<div class="container table-bordered pres_title">
                	<div class="col-md-4">
                    	<div><label>Patient Name: </label> <?php echo $patientdata[0]['pfname']." ".$patientdata[0]['plname']; ?></div>
                    </div>
                    <div class="col-md-4">
                    	<div><label>Age:</label> <?php echo $patientdata[0]['age']."years"; ?></div>
                    </div>
                    <div class="col-md-4">
                    	<div><label>Gender:</label> <?php echo $patientdata[0]['gender']; ?></div>
                    </div>
                </div>
            </section>
        <!-- End Header -->
        
			<!-- Main Body -->
        	<section id="pres_main_body" class="pres_main_body">
            	<div class="container">
                	<div class="row">
                		<div class="col-md-12">
							<div class="all_medicine">
								<div class="row">
									<div class="col-md-3"><h1>R<span style='font-size:36px'>x</span></h1>
									
										<div class="test_name">
											<ul>
											<?php
												$i = 0;
												$j = 0;
												for($i=0; $i<sizeof($test_id); $i++){
													$j++;
													echo "<li><b>".$test_id[$i]['test_id']."</b></li>";
												}
											?>
											</ul>
										</div>
									
									</div>
									<div class="col-md-9">
										<div class="row">
											<div class="col-md-12">
											<?php
												$i = 0;
												$j = 0;
												for($i=0; $i<sizeof($medicine_id); $i++){
													$j++;
													echo "<div class='medicine_list_div'>";
													echo "<table width='100%' height='50' class='medicine_list'>
														<tr>
															<td style='padding-top:10px; padding-left:10px; width:70%'>
																<table>
																	<tr>
																		<td>Medicine Name</td>
																		<td>:</td>
																		<td><span style='font-weight:bold'>".$medicine_id[$i]['medicine_id']."</span></td>
																	</tr>
																</table>
															</td>
															<td style='width:30%'>
																<table>
																	<tr>
																		<td>MG</td>
																		<td>:</td>
																		<td><span style='font-weight:bold'>".$medicine_id[$i]['mg']."</span></td>
																	</tr>
																</table>
															</td>
														</tr>
														
														<tr>
															<td style='padding-top:5px; padding-left:10px; padding-bottom:10px; width:70% '>
																<table>
																	<tr>
																		<td>Dosage</td>
																		<td>:</td>
																		<td><span style='font-weight:bold'>".$medicine_id[$i]['dose_id']."</span></td>
																	</tr>
																</table>
															</td>
															
															
															
															<td style='width:30%'>
																<table>
																	<tr>
																		<td>Duration</td>
																		<td>:</td>
																		<td><span style='font-weight:bold'>".$medicine_id[$i]['duration_id']."</span></td>
																	</tr>
																</table>
															</td>
														</tr>
													</table>";
													echo"</div>";
												
												}
											?>
												
												
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
                	</div>
                </div>
            </section>
        <!-- End Main Body -->
        
        
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