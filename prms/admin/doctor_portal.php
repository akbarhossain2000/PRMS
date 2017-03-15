<?php
include_once("admheader.php");
include_once("DataModel.php");
//$data = array();
$base = new Dmodel();
@$data = $_SESSION['did'];




?>


<link rel="stylesheet" type="text/css" href="css/stylemain.css" />
	<div class="body_area">
		<div class="container">
    		<div class="col-md-3">
   				<div class="content outer_border">
        			<div class="container_sidemenu">
                    	
            			<ul id="menu">
                			<li><a href="javascript:void(0)" id="cu_patient">Current Patient</a></li>
                    		<!--<li><a href="javascript:void(0)">Patient Search</a></li>-->
                    		<li><a href="javascript:void(0)" id="my_profile">My Profile</a></li>
                		</ul>
                        
            		</div>
        		</div> 
    		</div>
        	
            <div class="col-md-9">
            	<form method="post">
                <div id="pdetails_show" class="table_responsive" style="border:1px solid #030; display:none;">
                    
                    
                </div>
        		<div id="showData">
            		<?php
						echo @$pid	= $_POST['puid'];
					?>
                    
            	</div>
                </form>
        	</div>
    
    	</div>
    </div>


<?php
include_once("admfooter.php");
?>


<script src="js/jquery.min.js"></script>
<script type="text/javascript">

	$(document).ready(function(e) {
		var data = "";
		
        $.ajax({
			type:'POST',
			url:'doctor_sql.php',
			data:{action:'getData'},
			dataType:"json",
			success: function(resp){
								
				$("#cu_patient").bind('click', function(){
					
					var date = new Date();
					var dd = date.getDate();
					var mm = date.getMonth() + 1;
					var yy = date.getFullYear();
					
					dd = '0'+dd;
					mm = ('0'+mm).slice(-2);
					var today = yy+"-"+mm+"-"+dd.slice(-2);
					
					var duid = <?php echo json_encode($data) ?>;
					//alert(duid);
					
					table = "<table class='table'>";
						table += "<tr>";
							table += "<th>SL</th>";
							table += "<th>Patient Name</th>";
							table += "<th>Doctor Name</th>";
							table += "<th>Department</th>";
							table += "<th>Date</th>";
							table += "<th>Prescription</th>";
							table += "<th>Services</th>";
						table += "</tr>";
					var i = 0;
					//alert(today);
					for(id in resp){
						//i++;
						
					 
						//var date = new Date(resp[id].datetime);
						//if(( date >= today) && (date <= lasDayOfCurrentMonth)){
						if((resp[id].datetime == today)&&(resp[id].duid == duid)&&(resp[id].status == 1)){
							i++;
							table += "<tr>";
								table += "<input type='hidden' name='puid' id='puid' value='"+resp[id].puid+"'>";
								table += "<td>"+i+"</td>";
								table += "<td><a href='javascript:void(0)' rel="+resp[id].puid+" rel_date="+resp[id].datetime+" class='pdetails'>"+getName(resp[id].puid)+"</a></td>";
								table += "<td>"+getDname(resp[id].duid)+"</td>";
								table += "<td>"+getDepname(resp[id].depid)+"</td>";
								table += "<td>"+resp[id].datetime+"</td>";
								table += "<td>"+"<a href='javascript:void(0)' rel = "+resp[id].puid+" class='pres'><input type='button' value='Prescription' class='btn btn-primary'></a>"+"</td>";
								table += "<td><a href='callto://+***********'><input type='button' value='Services' class='btn btn-primary'></a></td>";
							table += "</tr>";	
						
						}
					}

					table += "</table>";
					$("#showData").html(table);
					
					$(".pdetails").bind('click', function(){
						var puid = $(this).attr('rel');
						var date = $(this).attr('rel_date');
						var table= "";
						var i=0;
						var j=0;
						$.ajax({
							url:"doctor_sql.php",
							type:"POST",
							data:{action:"pDetails",puid:puid, date:date},
							dataType:"json",
							success: function(resp){
								
								table +="<table class='table'>";
									table += "<tr>";
									table += "<td colspan='3'><input type='button' value='X' class='close btn btn-danger'></td>";
									table += "</tr>";
								if(resp[1] != null & resp[2] != null & resp[3] != null){
									table +="<tr>";
									table +="<td>Patient Name</td>";
									table +="<td>:</td>";
									table +="<td>"+resp[0].pfname+" "+resp[0].plname+"</td>";
									table +="</tr>";
									
									table +="<tr>";
									table +="<td>Age</td>";
									table +="<td>:</td>";
									table +="<td>"+resp[0].age+" "+'years'+"</td>";
									table +="</tr>";
									
									table +="<tr>";
									table +="<td>Blood Group</td>";
									table +="<td>:</td>";
									table +="<td>"+resp[0].blood+"</td>";
									table +="</tr>";
									if(resp[1] != null){
									table +="<tr>";
									table +="<td>Blood Presure</td>";
									table +="<td>:</td>";
									table +="<td>"+resp[1].bp+"</td>";
									table +="</tr>";
									
									table +="<tr>";
									table +="<td>Blood Sugar</td>";
									table +="<td>:</td>";
									table +="<td>"+resp[1].bs+"</td>";
									table +="</tr>";
									}else{
										table +="<tr>";
									table +="<td>Blood Presure</td>";
									table +="<td>:</td>";
									table +="<td>Data is not available!</td>";
									table +="</tr>";
									
									table +="<tr>";
									table +="<td>Blood Sugar</td>";
									table +="<td>:</td>";
									table +="<td><p style='color:red'>Data is not available!</p></td>";
									table +="</tr>";
									}
									
									
								table +="</table>";
								
								if(resp[2] != null){
								table +="<div>";
									table +="<p style='font-weight:bold; text-decoration:underline;'>Patient Previous Prescription</p>";
									table +="<div>";
									for(j=0; j<resp[2].length; j++){
										table +="<img src = 'img/"+resp[2][j].pres_name+"' class='img-thumbnail' style='margin-top:5px; 0px;'/>";
									}
									table +="</div>";
								table +="</div>";
								}else{
									table +="<div>";
									table +="<p style='font-weight:bold; text-decoration:underline;'>Patient Previous Prescription</p>";
									table +="<div>";
										table +="<p style='color:red'>Prescription is Not Available!</p>";
									table +="</div>";
								table +="</div>";
								}
								if(resp[3] != null){
								table +="<div>";
									table +="<p style='font-weight:bold; text-decoration:underline;'>Patient Previous report</p>";
									for(i=0; i<resp[3].length; i++){
									table +="<div>";
										table +="<img src='img/"+resp[3][i].report_name+"' class='img-thumbnail' style='margin-top:5px 0px;' />";
									table +="</div>";
									}
								table +="</div>";
								}else{
									table +="<div>";
									table +="<p style='font-weight:bold; text-decoration:underline;'>Patient Previous report</p>";
										table +="<div>";
											table +="<p style='color:red'>Patient Previous Report Not Available!</p>";
										table +="</div>";
									table +="</div>";
								}
							}else{
								table += "<tr>";
									table += "<td colspan='3'><p  style='color:red'>Patient Physical Sign,Previous Prescription, Previous Report Not Available</p></td>";
								table += "</tr>";
								table +="</table>";	
							}
								
								//$("#pdetails_show");
								$("#pdetails_show").html(table).show();
								//alert(table);
								$(".close").bind('click', function(){
									//alert('d');
									$("#pdetails_show").hide();
								});
							}
							
							
						});
					});
					
					$(".pres").bind('click', function(){
							var url = "../user/prescription.php?d_id=<?php echo $data; ?>&puid="+$(this).attr('rel');
							//alert(url);
							var width = 1070;
							var height = 600;
							var left = parseInt((screen.availWidth/2) - (width/2));
							var top = parseInt((screen.availHeight/2) - (height/2));
							var windowFeatures = "width=" + width + ",height=" + height +   
								",status,resizable,left=" + left + ",top=" + top + 
								"screenX=" + left + ",screenY=" + top + ",scrollbars=yes";
						
							window.open(url, "subWind", windowFeatures, "POS");
					});
					
				});
				
				
				
				function getName(id){
					$.ajax({
						type:'POST',
						async:false,
						url:"doctor_sql.php",
						data:{action:'getName',id:id},
						success: function(resp){
							data = resp;
							
						}	
					});
					return data;
				}
				
				function getDname(id){
					$.ajax({
						type:'POST',
						async:false,
						url:"doctor_sql.php",
						data:{action:'getDname', id:id},
						success: function(resp){
							
							data = resp;
						}
					});
					return data;
				}
				function getDepname(id){
					$.ajax({
						type:'POST',
						async:false,
						url:"doctor_sql.php",
						data:{action:'getDepname', id:id},
						success: function(resp){
							
							data = resp;
						}
					});
					return data;
				}
			}
		});
		
		$('#my_profile').click(function () {
			
			jQuery('#showData').load('doctor_profile.php');
		});
    });

</script>