<?php
include_once("DataModel.php");

$base = new Dmodel();
//if(isset($_GET['d_id']))
$did = $_GET['d_id'];
$pid = $_GET['puid'];

$docid = $base->getDoctordata($did);

$depid = $docid[0]['depid'];
$depname = $base->depData($depid);

$patientid = $base->getPatientData($pid);

$test_data = $base->getTestData();

$medicine_data = $base->getMedicinedata();

$dose_data = $base->getDose();

$duration_data = $base->getDuration();


$pres_id = $base->create_prescription_id("prescription", "pres_id");



?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<style>
.floatleft{float:left;}
.containner{margin:0; padding:0; height:auto; width:500px;}
.top{height:100px; width:500px; padding-top:10px;}
.top_left{width:300px;}
.middle{height:200px; width:500px;}
</style>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="css/main.css"

</head>

<body>
<div class="container">
	<div class="col-md-12">
    	<div align="center" style="background-color:#033; color:white;"><h1>Create Prescription</h1></div>
    </div>
</div>
<div class="container top">
	<div class="col-md-9">
    	<div>
        	<label>Dr.Name	: <?php echo $docid[0]['dname']; ?></label><br />
            Specialization	: <?php echo $docid[0]['desig']; ?><br />
            Department		: <?php echo $depname; ?>
        </div>
        
    </div>
    	<div class="col-md-3">
        	<div>
            	Precription ID:<input type="text" name="pres_id" id="pres_id" value="<?php echo $pres_id; ?>" readonly /><br />
            	Date: <?php echo date("Y-m-d"); ?>
            </div>
        </div>
  </div>
	<div class="container top">
    	<div class="col-md-6">
        	<div>
        		<label>Patient Name: <?php echo $patientid[0]['pfname']." ".$patientid[0]['plname']; ?></label><br />
            
        		Age: <?php echo $patientid[0]['age']." "."years"; ?><br />
                Sex: <?php echo $patientid[0]['gender'] ?>
            </div>
        </div>
        <div class="col-md-6">
        	<div></div>
    	</div>
    </div>
	<div class="container middle">
    	<div class="col-md-6">
        	<div class="table-responsive">
        	<table border="1px solid #000" class="table">
            	<tr>
                	<th colspan="2" style="text-align:center">Test Name</th>
                   
                </tr>
                <tr>
                	<td colspan="2">
                    	<select style="width:100%" id="test_name">
                        	<option value="">----Select----</option>
                            <?php
								$t=0;
								for($t=0; $t<sizeof($test_data); $t++){
									
								echo "<option value='".$test_data[$t]['test_name']."'>".$test_data[$t]['test_name']."</option>";
									
								}
								
                            ?>
                        </select>
                        
                    </td>
                    
                </tr>
                <!--
                <tr>
                	<td colspan="2" align="center"><input type="button" name="add" id="test_add" value="Add" class="btn btn-default"/></td>
                </tr>
                -->
               
            </table>
            </div>
        </div>
        <div class="col-md-6">
           <div class="table-responsive">
        	<table border="1px solid #000" class="table" id="mselect_table">
            	<tr>
                	<th colspan="4" style="text-align:center">Medicine</th>
                </tr>
                <tr>
                	<td width="25%">Name</td>
                    <td>Mg</td>
                    <td>Dose</td>
                    <td>Duration</td>
                </tr>
                <tr>
                	<td width="25%">
                    	<select style="width:100%" id="m_name">
                        	<option value="">-----</option>
                            <?php
								$m = 0;
								for($m=0; $m<sizeof($medicine_data); $m++){
									echo "<option value='".$medicine_data[$m]['medicine_id']."_".$medicine_data[$m]['category']."_".$medicine_data[$m]['medicine_name']."'>".$medicine_data[$m]['medicine_name']."</option>";
									
								}
							?>
                        </select>
                        
                    </td>
                    <td>
                    	<select style="width:100%" id="mg">
                 			<option>-----</option>
                        </select>
                    </td>
                    <td>
                    	<select style="width:100%" id="dose">
                        	<option value="">----</option>
                            <?php
								for($d=0; $d<sizeof($dose_data); $d++){
									echo"<option>".$dose_data[$d]['dose']."</option>";	
								}
							?>
                        </select>
                    </td>
                    <td>
                    	<select style="width:100%" id="duration">
                        	<option value="">----</option>
                            <?php
								for($du=0; $du<sizeof($duration_data); $du++){
									echo "<option>".$duration_data[$du]['duration']."</option>";
								}
							?>
                        </select>
                    </td>
                </tr>
                <tr>
                	<td colspan="4" style="text-align:center"><input type="button" name="add" value="Add" class="add btn btn-default" /></td>
                </tr>
            </table>
           </div>
        </div>
      </div>
      <div class="container">
      	<div class="col-md-12">
        	<div class="table-responsive">
            	<table class="table">
                 <tr>
                    <th>Next Appointment</th>
                    <td>:</td>
                    <td width="70%"><input type="text" name="lastapp" id="lastapp" style="width:100%"/></td>
                 </tr>
                </table>
            </div>
         </div>
      </div>
	<div class="container">
    	<div class="col-md-6">
        	<div class="table-responsive">
        	<table border="1px solid #000" class="table" id="test_table">
        		<tr>
                	<th width="50%">SL</th>
                    <th>Test Name</th>
                    <th class = 'delete'>Action</th>
                </tr>
                
           </table>
           </div>
        </div>
        <div class="col-md-6">
        	<div class="table-responsive">
        	<table border="1px solid #000" class="table" id ="medicine_table">
        		<tr>
                	<th>SL</th>
                    <th>Medicine Name</th>
                    <th>Mg</th>
                    <th>Dose</th>
                    <th>Duration</th>
                    <th class = 'mdelete'>X</th>
                </tr>
                
           </table>
           </div>
        </div>
    </div>
    
	<div class="container">
    	<div class="col-md-12">
        	<div class="table-responsive">
        	<table class="table">
            	<tr>
                <td style="text-align:center"><input type="submit" id="save" name="save" value="Save" class="btn btn-lg btn-primary" /></td>
                </tr>
            </table>
            </div>
        </div>
    </div>

<a href="javascript:void(0)" id="print"></a>


</body>
</html>


<script src="js/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(e) {
		
		$("#print").click(function(){
			var prs_id = $("#pres_id").val();
			var duid = '<?php echo $did; ?>';
			var puid = '<?php echo $pid ?>';
			var date = '<?php echo date("Y-m-d"); ?>';
			
			var url = "prescription_view.php?prs_id="+prs_id+"&duid="+duid+"&puid="+puid+"&date="+date;
			
			
			window.open(url,'','height=600,width=1000');

			self.close();	    
		});
		
		var i = 0;
		var x = 0;
         $("#test_name").change(function(){
			 if($(this).val() != ""){
			 	i++;
				var html = "";
				html = "<tr id = 'del_"+i+"'>";
					html += "<td class = 'no'>"+i+"</td>";
					html += "<td id = 'textVal_"+i+"'>"+$(this).val()+"</td>";
					html += "<td><a href = 'javascript:void(0)' class = 'delete' rel = "+i+">X</a></td>";
				html += "</tr>";
				
			
				$("#test_table").append(html);
				
				$(".delete").click(function(){
					 var del_id = $(this).attr('rel');
					 //alert(del_id);
					 $("#del_"+del_id).remove();
					  
					 var row_no = $('#test_table tr').length;
					 //alert(row_no);
					 var j=0;
					 for(j=0; j<=row_no; j++){
						 $('#test_table tr .no').eq(j).text(j+1);
					 }
				 });
			 }
		 });
		 
		 $("#m_name").change(function(){
			 var medicine_id = $(this).val();
			 var mseparator =  medicine_id.split("_")[0];
			 var op="";
			 var m=0;
			 $.ajax({
				url:"service_sql.php",
				type:"POST",
				dataType:"json",
				data:{action:"getMg",m_id:mseparator},
				success: function(resp){
					
					op="<option value=''>-----</option>";
					for(m=0; m<resp.length; m++){
						
						op +="<option>"+resp[m]+"</option>";
							
					}
					
					$("#mg").html(op);
					
					
				}
			 });
			 
					 
		 });
		 
		 $(".add").click(function(){
			 //alert('d');
			 var medicine = $("#m_name").val();
			 var mecine_category = medicine.split("_")[1];
			 var medi_name = medicine.split("_")[2];
			 var medicine_name = mecine_category+". "+medi_name;
			 if(($("#m_name").val() != "") & ($("#dose").val() != "")){
			 x++;
			 var html = "";
			 	
				html +="<tr id='mdel_"+x+"'>";
				html +="<td class='m_no'>"+x+"</td>";
				html +="<td id='text1Val1_"+x+"'>"+medicine_name+"</td>";
				html +="<td id='text1Val2_"+x+"'>"+$('#mg').val()+"</td>";
				html +="<td id='text1Val3_"+x+"'>"+$('#dose').val()+"</td>";
				html +="<td id='text1Val4_"+x+"'>"+$('#duration').val()+"</td>";
				html += "<td><a href = 'javascript:void(0)' class = 'mdelete' rel = "+x+">X</a></td>";
				html +="</tr>";
			 
			 $("#medicine_table").append(html);
			 
			 $(".mdelete").click(function(){
				//alert('d');
					 var mdel_id = $(this).attr('rel');
					 //alert(mdel_id);
					 $("#mdel_"+mdel_id).remove();
					  
					 var row_no1 = $('#medicine_table tr').length;
					 //alert(row_no);
					 var j=0;
					 for(j=0; j<=row_no1; j++){
						 $('#medicine_table tr .m_no').eq(j).text(j+1);
					 } 
			 
		 	 });
			 
			 }

		 });
		 
		 		 
		 
		 $("#save").click(function(){
			 var pres_id = $('#pres_id').val();
			 var duid = '<?php echo $did; ?>';
			 var depid = '<?php echo $depid; ?>';
			 var puid = '<?php echo $pid; ?>';
			 var lastapp = $("#lastapp").val();
			 var date = '<?php echo date("Y-m-d"); ?>';
		 	 var row_no = $('#test_table tr').length;
			 var row_no1 = $('#medicine_table tr').length;
			 var j;
			 var i;
			 
			 /*var url = "prescription_view.php";
							//alert(url);
							var width = 1070;
							var height = 600;
							var left = parseInt((screen.availWidth/2) - (width/2));
							var top = parseInt((screen.availHeight/2) - (height/2));
							var windowFeatures = "width=" + width + ",height=" + height +   
								",status,resizable,left=" + left + ",top=" + top + 
								"screenX=" + left + ",screenY=" + top + ",scrollbars=yes";*/

			 
			 for(j = 1; j<row_no; j++){
				 $.ajax({
					type:"POST",
					url:"service_sql.php",
					data:{action:'saveTest',testVal:$("#textVal_"+j).text(),puid:puid,date:date,pres_id:pres_id},
					success: function(resp){
						//alert(resp);	
					}	 
				 });
			 }
			 
			 for(i = 1; i<row_no1; i++){
				 $.ajax({
					 type:"POST",
					 url:"service_sql.php",
					 data:{action:'saveMedicine',test1Val1:$("#text1Val1_"+i).text(),test1Val2:$("#text1Val2_"+i).text(),test1Val3:$("#text1Val3_"+i).text(),test1Val4:$("#text1Val4_"+i).text(),puid:puid,date:date,pres_id:pres_id},
					 success: function(resp){
						//alert(resp); 
					 }
				});
			 }
			 
			 $.ajax({
			 	 type:"POST",
				 url:"service_sql.php",
				 data:{action:'savePrescription',pres_id:pres_id,duid:duid,puid:puid,depid:depid,lastapp:lastapp,date:date},
				 success: function(resp){
					$("#print").click();
				 }
				 
				 
			 });
			 
		 }); 
    });

</script>