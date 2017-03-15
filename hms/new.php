<?php
session_start();
if(!isset($_SESSION['isLogin']) || $_SESSION['isLogin']!='login')
{
	header("location: ./login.php");
}
/*if($_SESSION['user_type']!='Admin'){
	header("location: ./login.php");
}
else if($_SESSION['user_type']=='Admin'){*/
include('ini.php');

	if(isset($_POST['btnsave'])){
		extract($_POST);
		
	   if(isUserExists($user_id)==false){
		if(getId($tanent_id)== false){
			$sql = "INSERT INTO booking_flat SET user_id='$user_id', password='$password', tanent_id='$tanent_id', name='$name', phone='$phone', month='$month', 
			year='$year', floor_id='$floor', flat_id='$flat_no', budget='$budget', date='$date'";
			//echo $sql;
			mysql_query($sql);
			if(mysql_affected_rows()>0){
				print"<script>alert('Data Insert Successfully!')</script>";
			}
			else{
				print"<script>alert('Data Insert Failed!')</script>";
			}
			
			$sql1="UPDATE tanent_info SET status='1' where tanent_id='$tanent_id'";
			mysql_query($sql1);
			
			$sql2="UPDATE tbl_flat SET status1='1' where flat_id='$flat_no'";
			mysql_query($sql2);
	
		}
		else{
				$sql = "UPDATE booking_flat SET user_id='$user_id', password='$password', month='$month', 
				year='$year', floor_id='$floor', flat_id='$flat_no', date='$date' WHERE tanent_id='$tanent_id'";
				//echo $sql;
				mysql_query($sql);
				if(mysql_affected_rows()>0){
					print"<script>alert('Data Insert Successfully!')</script>";
				}
				else{
					print"<script>alert('Data Insert Failed!')</script>";
				}
				
				$sql1="UPDATE tanent_info SET status='1' where tanent_id='$tanent_id'";
				mysql_query($sql1);
				
				$sql2="UPDATE tbl_flat SET status1='1' where flat_id='$flat_no'";
				mysql_query($sql2);
	
		}
	   }
	   else{
			print"<script>alert('This User Already Exists!')</script>";   
	   }
	
	}
		function getId($tanent_id){
			$sql="SELECT * FROM booking_flat WHERE tanent_id='$tanent_id'";
			$rec=mysql_query($sql);
			$numRows = mysql_num_rows($rec);
			if($numRows>0) {
				return true;
			} else {
				return false;
			}
		}
		
		function isUserExists($user_id){
			$sql="SELECT * FROM booking_flat WHERE user_id='$user_id'";
			$rec=mysql_query($sql);
			$numRows = mysql_num_rows($rec);
			if($numRows>0) {
				return true;
			} else {
				return false;
			}
		}
	
		if(isset($_GET['t_id'])){
			$tid = $_GET['t_id'];
			$sql = "SELECT * FROM tanent_info where tanent_id='$tid'";
			$rec = mysql_query($sql);
			while($row = mysql_fetch_array($rec)){
				extract($row);
			}
		}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Booking Flat</title>
<link rel="stylesheet" type="text/css" href="css/style_for_from.css" />
<link rel="stylesheet" type="text/css" href="css/tcal.css" />
<script type="text/javascript" src="js/script.js"></script>

<script>
function gethouserent(str) {
  if (str.length==0) {
    document.getElementById("txtHint").innerHTML="";
    return;
  }
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
  xmlhttp.open("GET","ajax.php?hrent="+str,true);
  xmlhttp.send();
}
</script>



</head>

<form action="new.php" method="post" name="frm" onsubmit="return formValidation(this)">
<center>
<body background="images/grey_wash_wall_@2X.png">
	<div class="create_wrapper">
		<div class="create_body">
			<div class="creat_title">
				<h>Booking Flat</h>
			</div>
			<div class="creat_content">
            	<table cellspacing="3">
                	<tr>
                    	<td>User ID</td>
                        <td>:</td>
                        <td><input type="text" name="user_id" id="user_id" /></td>
                    </tr>
                    <tr>
                    	<td>Password</td>
                        <td>:</td>
                        <td><input type="password" name="password" id="password" maxlength="15" onkeyup="checkPassword()"/>
                        	<span id="pass_note"></span>
                        </td>
                    </tr>
                    <tr>
                    	<td>Tanent_id</td>
                        <td>:</td>
                        <td><input type="text" name="tanent_id" id="tanent_id" value="<?php echo @$tid;?>" readonly /></td>
                    </tr>
                    <tr>
                    	<td>Tanent Name</td>
                        <td>:</td>
                        <td><input type="text" name="name" id="name" value="<?php echo @$name;?>" readonly /></td>
                    </tr>
                    <tr>
                    	<td>Mobile</td>
                        <td>:</td>
                        <td><input type="text" name="phone" id="phone" value="<?php echo @$phone;?>" readonly /></td>
                    </tr>
                    <tr>
                    	<td>Month</td>
                        <td>:</td>
                        <td><input type="text" name="month" id="month" value="<?php echo date("M");?>" readonly /></td>
                    </tr>
                    <tr>
                    	<td>Year</td>
                        <td>:</td>
                        <td><input type="text" name="year" id="year" value="<?php echo date("Y");?>" readonly /></td>
                    </tr>
                    <tr>
                    	<td>Floor</td>
                        <td>:</td>
                        <td>
                        	<select name="floor" id="floor">
                            	<option selected="selected">Select</option>
                            </select>
                        </td>
                    </tr>
                    
                    <tr>
                    	<td>Flat No</td>
                        <td>:</td>
                        <td>
                        	<select name="flat_no" id="flat_no" onchange="gethouserent(this.value)">
                            	<option selected="selected">Select</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                    	<td>House Rent</td>
                        <td>:</td>
                        <td> <div id="txtHint"></div></td>
                    </tr>

                    <tr>
                    	<td>Date</td>
                        <td>:</td>
                        <td><input type="text" name="date" id="date" class="tcal" /></td>
                    </tr>
                    
                    <tr>
                    	<td colspan="3" class="creat_bouton" align="center">
                        	<input type="submit" name="btnsave" class="btn_create" value="Save" onclick="javascript:return confirm('Are you want to save ??')" />
                            <input type="button" class="button" value="Close" onclick="window.close()" />
                        </td>
                    </tr>
                </table>
                
			</div>

		</div>
	</div>
</body>
</center>
</form>
</html>


<script type="text/javascript" src="js/tcal.js"></script>
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
					var unbook_flat = resp.unbook_flat;
					var floor_id = $("#floor").val();
                    var id = $(this).val();
					var text1 = "";
					
					text1 += "<option value = ''>-------</option>";
					
					for(id in flat){
						if(flat[id].floor_id == floor_id){
							for(fid in unbook_flat){
								if(unbook_flat[fid] == flat[id].flat_id){
									text1 += "<option value = '"+flat[id].flat_id+"'>"+flat[id].flat_no+"</option>";
								}
							}
						}
					}
					$("#flat_no").html(text1);
                });
			}
		});
    });
</script>