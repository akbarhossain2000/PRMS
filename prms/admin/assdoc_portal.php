<?php
include_once("admheader.php");
include_once("DataModel.php");
$base = new Dmodel();

if(isset($_POST['psave'])){
	
	$time_stamp = strtotime(date("m/d/Y h:i:s A T"));
	$errors= array();
	extract($_POST);
	$puid = "$puid";
	$date = "$date";
	
	$sql = "UPDATE patient_profile SET blood='$blood' WHERE puid='$puid'";
	//echo $base->updatePprofile($sql);
	
	if(empty($errors) | $base->updatePprofile($sql)){
				
				
					if(($_POST['bp'] != "") && ($_POST['bs'] != "") ){
						if($base->physicalSignExist($puid,$date)){
						 @$data_array['puid'] = "$puid";
						 @$data_array['bp'] = "$bp";
						 @$data_array['bs'] = "$bs";
						 @$data_array['date'] = "$date";
						 $base->_insertData("patient_physical_sign", @$data_array);
						 }else{
							echo "Already Added B.P and B.S this Date!";	
						 }
					}
				
	
			if($_FILES['presimg']['name'][0] != NULL){
				foreach($_FILES['presimg']['tmp_name'] as $key => $tmp_name ){
					$file_name = $_FILES['presimg']['name'][$key];
					$ext = substr($file_name,-3);
					$file_name = $key.$time_stamp."pres.".$ext;
					$file_size =$_FILES['presimg']['size'][$key];
					$file_tmp =$_FILES['presimg']['tmp_name'][$key];
					$file_type=$_FILES['presimg']['type'][$key];	
					if($file_size > 2097152){
						$errors[]='File size must be less than 2 MB';
					}		
						@$data_array1['puid'] = "$puid";
						@$data_array1['pres_name'] = "$file_name";
						@$data_array1['date'] = "$date";
					$desired_dir="img";
					if(empty($errors)==true){
						if(is_dir($desired_dir)==false){
							mkdir("$desired_dir", 0700);		// Create directory if it does not exist
						}
						if(is_dir("$desired_dir/".$file_name)==false){
							move_uploaded_file($file_tmp,"img/".$file_name);
						}else{									//rename the file if another one exist
							$new_dir="img/".$file_name.time();
							 rename($file_tmp,$new_dir) ;				
						}
						
						$base->_insertData("patient_prescription", @$data_array1);
					
					}else{
							print_r($errors);
					}
				}
			
			}

			if($_FILES['reportimg']['name'][0] != NULL){	
				foreach($_FILES['reportimg']['tmp_name'] as $key => $tmp_name ){
					$file_name = $_FILES['reportimg']['name'][$key];
					$ext = substr($file_name,-3);
					$file_name = $key.$time_stamp."report.".$ext;
					$file_size =$_FILES['reportimg']['size'][$key];
					$file_tmp =$_FILES['reportimg']['tmp_name'][$key];
					$file_type=$_FILES['reportimg']['type'][$key];	
					if($file_size > 2097152){
						$errors[]='File size must be less than 2 MB';
					}		
					//$query="INSERT into patient_report ('puid','report_name', 'date') VALUES('$puid','$file_name','$date'); ";
						@$data_array2['puid'] = "$puid";
						@$data_array2['report_name'] = "$file_name";
						@$data_array2['date'] = "$date";
					$desired_dir="img";
					if(empty($errors)==true){
						if(is_dir($desired_dir)==false){
							mkdir("$desired_dir", 0700);		// Create directory if it does not exist
						}
						if(is_dir("$desired_dir/".$file_name)==false){
							move_uploaded_file($file_tmp,"img/".$file_name);
						}else{									//rename the file if another one exist
							$new_dir="img/".$file_name.time();
							 rename($file_tmp,$new_dir) ;				
						}
						if($_FILES['reportimg'] != ""){
						$base->_insertData("patient_report", @$data_array2);
						}
					}else{
							print_r($errors);
					}
				}
			}
		echo "Data Save Successfully!";
	}else{
		echo "Data Save Failed!";	
	}
}

?>
<link rel="stylesheet" type="text/css" href="css/stylemain.css">
	<div class="body_area">
		<div class="container">
    		<div class="col-md-3">
            	<div class="content outer_border">
        			<div class="container_sidemenu">
               			<ul id="menu">
						<?php
							if($_SESSION['user_type'] == "Assistant Doctor"){
                			echo"<li><a href='javascript:void(0)' id='c_patient'>Current Patient</a></li>";
							}
						?>
                    		<li><a href="javascript:void(0)" id="t_patient">Total Registered Patient</a></li>
                            <li><a href="javascript:void(0)" id="t_slot">Create Time Slot</a></li>
                            <li><a href="javascript:void(0)" id="d_schedule">Day Schedule For Doctor</a></li>
                            <li><a href="javascript:void(0)" id="t_schedule">Time Schedule For Doctor</a></li>
                    		<li><a href="javascript:void(0)" id="my_profile">My Profile</a></li>
                		</ul>
                    </div>
                </div>
            </div>
        	
            <div class="col-md-9">
        		<div id="showPage" class="table-responsive">
            
            	</div>
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
		var grid = "";
				
        $.ajax({
			type:'POST',
			url:'service_sql.php',
			data:{action:'getData'},
			dataType:"json",
			success: function(resp){
				$("#c_patient").bind('click',function(){
					var date = new Date();
					var dd = date.getDate();
					var mm = date.getMonth() + 1;
					var yy = date.getFullYear();
					
					dd = '0'+dd;
					mm = ('0'+mm).slice(-2);
						table = "<table class='table'>";
							table += "<tr>";
								table += "<th>SL</th>";
								table += "<th>Patient Name</th>";
								table += "<th>Doctor Name</th>";
								table += "<th>Department</th>";
								table += "<th>Date</th>";
								table += "<th>Confirm</th>";
								table += "<th>Submit</th>";
								table += "<th>Edit</th>";
							table += "</tr>";
						table += "</table>";
					var today = yy+"-"+mm+"-"+dd.slice(-2);
					var i = 0;
					
					for(id in resp){
						
						if(resp[id].datetime == today){
							i++;
							table += "<div class = 'row col-md-12'>";
							table += "<div class = 'item table-responsive'>";
							table += "<table class='table tbl1'>";
								table += "<tr class='getpdata'>";
								table += "<td>"+i+"</td>";
								table += "<td class='patient_id_"+i+"' rel='"+resp[id].puid+"'>"+getName(resp[id].puid)+"</td>";
								table += "<td class='doct_id_"+i+"' rel='"+resp[id].duid+"'>"+getDname(resp[id].duid)+"</td>";
								table += "<td class='dept_id_"+i+"' rel='"+resp[id].depid+"'>"+getDepname(resp[id].depid)+"</td>";
								table += "<td class='date_"+i+"' rel='"+resp[id].datetime+"'>"+resp[id].datetime+"</td>";
								table += "<td class='check_box'><input type='checkbox' class='check1' value='yes'> Yes<input type='checkbox' class ='check2' value='no'> No</td>";
								table += "<td class='sbtn'><a href='javascript://' class='save' rel='"+i+"'>Confirm</a></td>";
								
								table += "<td class='sbtn'><a href = 'javascript://' class = 'edit'>Edit</a></td>";
								table += "</tr>";
							table += "</table>";
							table += "</div>"
							
							table += "<div style='display:none'>"+showPdata(resp[id].puid)+"</div>";
							table += "</div>";
							
							
						}
					
					}
					
					
					
				function showPdata(id){
					
					var edit = "";
					
					$.ajax({
						type:"POST",
						async:false,
						url:"service_sql.php",
						dataType:"json",
						data:{action:'getPdata', id:id},
						success: function(resp){
							grid = resp;
						}
						
					});
					
					edit += "<form action='' class='pform' method='post' enctype='multipart/form-data'>";
					edit += "<input type='hidden' name='formcheck' value='patient_data'>";
					edit += "<table class='table'>";
						edit += "<input type='hidden' name='puid' value='"+grid[0].puid+"'>";
						edit += "<tr>";
						edit += "<td colspan='3'><input type='button' value='X' class='btn btn-danger close'></td>";
						edit += "</tr>";
						edit += "<tr>";
						
						edit += "<td>Patient Name</td>";
						edit += "<td>:</td>";
						edit += "<td>";
						edit +="<input type='text' value='"+grid[0].pfname+" "+grid[0].plname+"' readonly>";
						edit +="</td>";
						edit += "</tr>";
						
						edit += "<tr>";
						edit += "<td>Email</td>";
						edit += "<td>:</td>";
						edit += "<td><input type='text' value='"+grid[0].email+"' readonly></td>";
						edit += "</tr>";
						
						edit += "<tr>";
						edit += "<td>Phone</td>";
						edit += "<td>:</td>";
						edit += "<td><input type='text' value='0"+grid[0].phone+"' readonly></td>";
						edit += "</tr>";
						
						edit += "<tr>";
						edit += "<td>Age</td>";
						edit += "<td>:</td>";
						edit += "<td><input type='text' value='"+grid[0].age+"' readonly></td>";
						edit += "</tr>";
						
						edit += "<tr>";
						edit += "<td>Gender</td>";
						edit += "<td>:</td>";
						edit += "<td><input type='text' value='"+grid[0].gender+"' readonly></td>";
						edit += "</tr>";
						
						edit += "<tr>";
						edit += "<td>Blood Group</td>";
						edit += "<td>:</td>";
						edit += "<td><input type='text' name='blood' value='"+grid[0].blood+"'></td>";
						edit += "</tr>";
						
						edit += "<tr>";
						edit += "<td>Blood Presure</td>";
						edit += "<td>:</td>";
						edit += "<td><input type='text' name='bp'></td>";
						edit += "</tr>";
						
						edit += "<tr>";
						edit += "<td>Blood Sugar</td>";
						edit += "<td>:</td>";
						edit += "<td><input type='text' name='bs'></td>";
						edit += "</tr>";
						
						edit += "<tr>";
						edit += "<td>Previous Prescription</td>";
						edit += "<td>:</td>";
						edit += "<td><input type='file' name='presimg[]' multiple='multiple' accept='image/*'></td>";
						edit += "</tr>";
						
						edit += "<tr>";
						edit += "<td>Previous Report</td>";
						edit += "<td>:</td>";
						edit += "<td><input type='file' name='reportimg[]' multiple='multiple' accept='image/*'></td>";
						edit += "</tr>";
						
						edit += "<tr>";
						edit += "<td>Date</td>";
						edit += "<td>:</td>";
						edit += "<td><input type='text' name='date' value='<?php echo date("Y-m-d"); ?>'></td>";
						edit += "</tr>";
						
						edit += "<tr>";
						edit += "<td colspan='3' style='text-align:center'>";
						edit += "<input type='submit' name='psave' value='OK' class='psave btn btn-primary' style='width:15%'>";
						edit += "</td>";
						edit += "</tr>";
					edit += "</table>";
					edit += "</form>";	
					return edit;
				}
					
					$("#showPage").html(table);
					
					
					$(".edit").unbind('click').bind('click',function(){
						$('.tbl1').hide();
						$('.item').hide();
						$(this).parents('.row').find('div:first').hide();
						$(this).parents('.row').find('div:last').show();
						
					});
					
					$(".close").unbind('click').bind('click',function(){
						$(this).parents('.row').find('div:last').hide();
						$('.tbl1').show();
						$('.item').show();
						$(this).parents('.row').find('div:first').show();
						
						
					});
					
					$(".psave").unbind('click').bind('click',function(){
						$(this).parents('.row').find('div:last').hide();
						$('.tbl1').show();
						$('.item').show();
						$(this).parents('.row').find('div:first').show();
						
						
					});
					
					$('.save').unbind('click').bind('click',function(){
							var id = $(this).attr('rel');
							var Y = $('.check1').val();
							//alert(Y);
							if($('.check1').is(':checked',true)){
								//alert($('.check1').is(':checked',true));
								$.ajax({
									type:"POST",
									url:"service_sql.php",
									data:{action:'updatePstatus',p_id:$('.patient_id_'+id).attr('rel'),doct_id:$('.doct_id_'+id).attr('rel'),dept_id:$('.dept_id_'+id).attr('rel'),date:$('.date_'+id).attr('rel')},
									success: function(data){
										alert('This Patient Appointment is Confirmed');
									}
										
								});	
							}else if($('.check2').is(':checked',true)){
									$.ajax({
										type:"POST",
										url:"service_sql.php",
										data:{action:'deletePatient',dp_id:$('.patient_id_'+id).attr('rel'),ddoct_id:$('.doct_id_'+id).attr('rel'),ddept_id:$('.dept_id_'+id).attr('rel'),ddate:$('.date_'+id).attr('rel')},
										success: function(data){
											alert('This Patient Appointment is cancel.');	
										}
										
										
									});
								
							}else{
								alert('Please Checked Confirm CheckBox!');	
							}
							
					});
									
				});
				
				
				
				$("#t_patient").bind('click', function(){
					
					var date = new Date();
					var dd = date.getDate();
					var mm = date.getMonth() + 1;
					var yy = date.getFullYear();
					
					dd = '0'+dd;
					mm = ('0'+mm).slice(-2);
					var today = yy+"-"+mm+"-"+dd.slice(-2);
					
					var lasDayOfCurrentMonth = yy+"-"+mm+"-"+30;
					var lasDayOfCurrentMonth = new Date(lasDayOfCurrentMonth);
					var today = new Date(today);
					table = "<table class='table'>";
						table += "<tr>";
							table += "<th>SL</th>";
							table += "<th>Patient Name</th>";
							table += "<th>Doctor Name</th>";
							table += "<th>Department</th>";
							table += "<th>Date</th>";
						table += "</tr>";
					var i = 0;
					//alert(today);
					for(id in resp){
						//i++;
						
						var date = new Date(resp[id].datetime);
						if(( date >= today) && (date <= lasDayOfCurrentMonth)){
							i++;
							table += "<tr>";
								table += "<td>"+i+"</td>";
								table += "<td><b>"+getName(resp[id].puid)+"</b></td>";
								table += "<td>"+getDname(resp[id].duid)+"</td>";
								table += "<td>"+getDepname(resp[id].depid)+"</td>";
								table += "<td>"+resp[id].datetime+"</td>";
								
							table += "</tr>";	
						
						}
					}

					table += "</table>";
					$("#showPage").html(table);
				});
				
				
				function getName(id){
					$.ajax({
						type:'POST',
						async:false,
						url:"service_sql.php",
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
						url:"service_sql.php",
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
						url:"service_sql.php",
						data:{action:'getDepname', id:id},
						success: function(resp){
							
							data = resp;
						}
					});
					return data;
				}
			}
			
		});
		
		
		$('#t_slot').click(function () {
			
			jQuery('#showPage').load('time_slot.php');
		});
		$('#d_schedule').click(function () {
			
			jQuery('#showPage').load('day_schedule.php');
		});
		$('#t_schedule').click(function () {
			
			jQuery('#showPage').load('time_schedule.php');
		});
		$('#my_profile').click(function () {
			
			jQuery('#showPage').load('assdoc_profile.php');
		});
		
		
    });

</script>