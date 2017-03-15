<?php
include_once("header.php");
include("ini.php");

if(isset($_POST['btnsave'])){
	echo $_POST['flat_tbl'];
	extract ($_POST);
	
	if( isFlatExists($flat_tbl)==false )
	{
		$sql="INSERT INTO tbl_flat SET road_no='$road_no', s_block='$s_block', floor='$floor', flat_no='$flat_tbl', beds='$beds', budget='$budget'";
		echo $sql;
		mysql_query($sql);
	
		if(mysql_affected_rows()>0){
			print"<script>alert('Data insert successfully!')</script>";
		}
		else{
			print"<script>alert('Data Insert Failed!')</script>";	
		}
	}
	else{
		print"<script>alert('This Flat No Already Inserted!')</script>";
	}
}

function isFlatExists($flat_no)
{
	$qry = "SELECT * FROM tbl_flat WHERE flat_id='$flat_no'";
	$result = mysql_query($qry);
	$numRows = mysql_num_rows($result);
	if($numRows>0) {
		return true;
	} else {
		return false;
	}
}
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Create Apartment</title>
<link rel="stylesheet" type="text/css" href="css/style_for_from.css" />
<link rel="" href="" />
<script type="text/javascript" src="js/script.js"></script>
<style>
.button{border:#000000 solid 1px; background:#315D86; color:#F1F1F1;}
</style>
</head>


<body>
	<div class="create_wrapper">
		<div class="create_body">
			<div class="creat_title">
				<h>Create Apartment</h>
			</div>
			<div class="creat_content">
            	
                <table cellspacing="3">
                <form action="create_apartment.php" name="frm" method="post" onsubmit="return formValidation(this)">
                    <tr>
                    	<td>Floor</td>
                        <td>:</td>
                        <td>
                    		<select id="floor" name="floor"><option>-------</option></select>    	
                        </td>
                    </tr>
                    
                    <tr>
                    	<td>Flat No</td>
                        <td>:</td>
                        <td>
                       		<select id="flat_tbl" name="flat_tbl"><option>-------</option></select>
                        </td>
                    </tr>
                    <tr>
                    	<td>Road No</td>
                        <td>:</td>
                        <td><input type="text" name="road_no" id="road_no" class="txt_create" /></td>
                    </tr>
                    
                    <tr>
                    	<td>Sector/Block</td>
                        <td>:</td>
                        <td><input type="text" name="s_block" id="s_block" class="txt_create" /></td>
                    </tr>
                    
                    <tr>
                    	<td>Beds</td>
                        <td>:</td>
                        <td><input type="text" name="beds" id="beds" class="txt_create" /></td>
                    </tr>
                    
                    <tr>
                    	<td>House Rent</td>
                        <td>:</td>
                        <td><input type="text" name="budget" id="budget" class="txt_create" /></td>
                    </tr>
                    
                    <tr>
                    	<td colspan="3" style="text-align:center;">
                        	<input type="submit" name="btnsave" class="button" value="Save" />
							<input type="reset" name="btnreset" class="button" value="Reset" />
                        </td>
                    </tr>
                    </form>
                </table>
       
			</div>

		</div>
	</div>
</body>
</html>


<?php
include_once("footer.php");
?>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(e) {
        $.ajax({
			type:"POST",
			url:"service_sql.php",
			dataType:"json",
			data:{action:'getJson'},
			success: function(resp){
				var floor_name = resp.floor_tbl;
				var text = "";
				text += "<option value = ''>-------</option>";
				for(id in floor_name){
					text += "<option value = '"+id+"'>"+floor_name[id]+"</option>";
				}
				$("#floor").html(text);
				
				$("#floor").change(function(e) {
					var flat = resp.flat_tbl;
					var floor_id = $("#floor").val();
                    var id = $(this).val();
					var text1 = "";
					text1 += "<option value = ''>-------</option>";
						for(id in flat){
							if(flat[id].floor_id == floor_id){
								text1 += "<option value = '"+flat[id].flat_id+"'>"+flat[id].flat_no+"</option>";
							}
						}
					$("#flat_tbl").html(text1);
                });
			}
		});
    });
</script>