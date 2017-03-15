<?php
include_once("header.php");
include_once("DataModel.php");
$booking_list = array();
$base = new Dmodel();
if(isset($_POST['save'])){
	extract($_POST);
	
	
	
	
	$booking_list['puid']       = $_SESSION['pid'];
	$booking_list['id']			= $bid;
	$booking_list['duid']       = $doct_tbl;
	$booking_list['depid']      = $dept;
	$booking_list['datetime']   = $datetime;
	$booking_list['time_slot']	= $t_schedule_tbl;
	$booking_list['time']		= $attend_time;
	$booking_list['status']		= "0";
	
	if(@$appointment == 'checked'){	
		if($base->_insertData("booking_list", $booking_list)){
				print"<script>alert('Appointment is Completed!')</script>";
		}else{
			print"<script>alert('Appointment is Failed!')</script>";	
		}
	}else{
		echo "<script>alert('Please Checked Appointment CheckBox!')</script>";	
	}
		
}

$id = $base->create_dep_id("booking_list", "id");
?>






<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
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
<script src="js/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>
<script src="js/bootstrap-datepicker.js"></script>
<script>
	$(function(){
		$('.datepicker').datepicker();
		var checkout = $('#datetime').datepicker({
  			onRender: function(date) {
    		return date.valueOf() < now.valueOf() ? 'disabled' : '';
  			}
		}).on('changeDate', function(ev) {
  			checkout.hide();
		}).data('datepicker');
	});
</script>


</head>

<body>
	<div class="select_area">
		<div class="container">
    		<div class="col-md-12">
				<div class="selecttbl table-responsive">
                	<form action="p_appointment.php" method="post" enctype="multipart/form-data">
                    	
                        <input type="hidden" name="bid" id="bid" value="<?php echo $id; ?>" readonly /> 
					<table class="tbl table">
                 
                        <tr>
                            <td width="200">Department</td>
                            <td width="13">:</td>
                            <td width="287">
                                <select id="dept" name="dept">
                                    <option>------</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td width="200">Doctor Name</td>
                            <td width="13">:</td>
                            <td width="287">
                                <select id="doct_tbl" name="doct_tbl">
                                    <option>------</option>
                                </select>            	
                            </td>
                        </tr>
                        <tr>
                            <td width="200">Doctor Available Day</td>
                            <td width="13">:</td>
                            <td width="287" id="d_schedule_tbl">
                                           	
                            </td>
                        </tr>
                        	
                        <tr>
                            <td width="200">Date</td>
                            <td width="13">:</td>
                            <td width="287">
                            	<input type="text" class="datepicker" name="datetime" id="datetime" placeholder="yyyy-mm-dd"/></br>
                            	<span id="s_msg"></span>
                            </td>
                        </tr>
                        <tr>
                            <td width="200">Select Time Slot</td>
                            <td width="13">:</td>
                            <td width="287">
                                <select id="t_schedule_tbl" name="t_schedule_tbl">
                                    <option>------</option>
                                </select>            	
                            </td>
                        </tr>
                        
                        <tr>
                        	<td>Appointment Time</td>
                            <td>:</td>
                            <td> 
                            	<input type="time" name="attend_time" id="attend_time" readonly />                            </td>
                        </tr>
                    </table>
        		</div>
 			</div>
 		</div>
 	</div>
        
	<div class="message_area">
    	<div class="container">
        	<div class="col-md-12">
                <div class="messagebox" id="msg_box">
                    
                </div>
            </div>
        </div>
    </div>
        
    <div class="tab_area">
        <div class="container">
            <div class="col-md-12">
            	<div id="tabs" class="form_tab">
                	<ul>
                        <li><a href="#tabs-2">Online Patient</a></li>
                    </ul>
                    
                    
                    <div id="tabs-2" class="table-responsive">
                          <table cellspacing="3" id="tbl" class="tbl table">
                              <tr>
                                  <td width="200">Appointment</td>
                                  <td width="287" colspan="2">
                                  	<input type="checkbox" name="appointment" id="appointment" value="checked" />
            					  </td>
                              </tr>
                            
                              <tr>
                                  <td colspan="3" align="center"><input type="submit" name="save" value="Confirm" />
                                  </td>
                                  
                              </tr>
                        </table>
					</div>
				</div>
			</div>
		</div>
	</div>
    </form>

</body>
</html>



<?php
include_once("footer.php");
?>


		<script type="text/javascript">
            $(document).ready(function(e) {
				var str = "";
				//$("#dept").attr("disabled","disabled");	
				//$("#doct_tbl").attr("disabled","disabled");
				$("#d_schedule_tbl").attr("disabled","disabled");
				$("#datetime").attr("disabled","disabled");
				$("#t_schedule_tbl").attr("disabled","disabled");
				$("#tbl").css('display','none');
                $.ajax({
                    type:"POST",
                    url:"appointment_sql.php",
                    dataType:"json",
                    data:{action:'getJson'},
                    success: function(resp){
                        var dept_name = resp.dept_tbl;
                        var text = "";
                        text += "<option value = ''>-------</option>";
                        for(id in dept_name){
                            text += "<option value = '"+id+"'>"+dept_name[id]+"</option>";
							//alert(text);
                        }
                        $("#dept").html(text);
                        
                        $("#dept").change(function(e) {
							
                            var doctor = resp.doct_tbl;
                            var dept_id = $("#dept").val();
                            var id = $(this).val();
                            var text1 = "";
                            text1 += "<option value = ''>-------</option>";
                                for(id in doctor){
									
                                    if(doctor[id].depid == dept_id){
                                        text1 += "<option value = '"+doctor[id].duid+"'>"+doctor[id].dname+"</option>";
                                    }
                                }
								//alert(text1);
                            $("#doct_tbl").html(text1);
                        });
						
						$("#doct_tbl").change(function(e){
							var day = resp.d_schedule_tbl;
							var tim = resp.t_schedule_tbl;
							
							var slot_name = resp.slot_name;
							var doctor_id = $("#doct_tbl").val();
							var id = $(this).val();
							//var data = "";
							//alert(id);
							var show = "";
								for(id in day){
									if(day[id].duid == doctor_id){
										show += day[id].day;
										//break;
									}
								}
								
								str = show.split(",");
								
								$("#d_schedule_tbl").text(show);
								
								var show1 = "";
									show1 +="<option value=''>-------</option>";	
									for(id in tim){
										//alert(tim[id].duid);
										if(tim[id].duid == doctor_id){
											show1 +="<option value='"+tim[id].time_slot+"'>"+slot_name[tim[id].time_slot]+"</option>";
										}
									}
									$("#t_schedule_tbl").html(show1);
									
						});
                    }
                });
				
				
				
					$("#doct_tbl").on('change',function(){
					var status = $(this).val();
					
					if(status){
						$("#d_schedule_tbl").removeAttr("disabled");	
						$("#datetime").removeAttr("disabled");
								
					} else {
						$("#d_schedule_tbl").attr("disabled");	
						$("#datetime").attr("disabled");
							
					}
				});
				
				
				$("#datetime").on('changeDate',function(){
					var myRe = new RegExp("([0-9]{4}[-](0[1-9]|1[0-2])[-]([0-2]{1}[0-9]{1}|3[0-1]{1})|([0-2]{1}[0-9]{1}|3[0-1]{1})[-](0[1-9]|1[0-2])[-][0-9]{4})");
					var status = myRe.test($(this).val());
					var val = $(this).val().split("-")[2];
					//alert(val);
					
					
					for(id in str){
						//alert(str[id]);
						//alert(str[id] == val);
						if(str[id] == val){
							$("#s_msg").text("");
							$("#t_schedule_tbl").removeAttr("disabled");
							break;
						}else{
							$("#s_msg").css("color", "red").text("This Doctor not available in this Day.");
							$("#t_schedule_tbl").attr("disabled","disabled");
						}
						
					}
					
				});
				
				$("#t_schedule_tbl").on('change',function(){
					$.ajax({
						type:"POST",
						url:"appointment_sql.php",
						dataType:"json",
						data:{action:'getStatus',slot_id:$(this).val(),date:$("#datetime").val(),doctor:$("#doct_tbl").val(),dept:$("#dept").val()},
						success: function(resp){
							//alert(resp.tm);
							//alert(resp.num);
							var count = parseInt(resp.num);
							var green = "";
							var red   = "";
							if(count < 3){
									$("#attend_time").val(resp.tm);
									green += $("#msg_box").css("color", "green").text("Appointment is available");
									$("#tbl").css("display", "block");
								}else{
									$("#attend_time").val("");
									red += $("#msg_box").css("color", "red").text("Appointment is not available");
									$("#tbl").css("display", "none");
								}
							
						}	
					});					
					
				});
				
            });
			
			
        </script>
