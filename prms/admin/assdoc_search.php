<?php
include_once("DataModel.php");
include_once("ini.php");


?>

<p>Search</p>

<form name="form_adoc_search" method="post" action="assdoc_search.php">
	<input type="text" name="search" autocomplete="off" id = "search">
    <input type="submit" name="submit" value="Search">
</form>
<div id = "display"></div>


<p>Search Result</p>



<script type="text/javascript">
	$(document).ready(function(e) {
        $("#search").bind('keyup',function(e){
			$.ajax({
				type:'POST',
				url:'service_sql.php',
				data:{action:'searchResult',text:$(this).val()},
				success: function(resp){
					//alert(resp);
					$("#display").html(resp);
					
					$("#text").click(function(){
						$("#search").val("");
						$("#search").val($(this).attr('rel'));
					});
				}	
			});	
		});
    });
</script>