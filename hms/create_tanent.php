<?php
include_once("header.php");
include("ini.php");
if(isset($_POST['btnsave'])){
	extract($_POST);
	//print_r($_FILE);
		$tfile_name = $_FILES['photo']['name'];
		$tfile_path = $_FILES['photo']['tmp_name'];
		$tfile_type = $_FILES['photo']['type'];
		$ext = substr($tfile_name,-3);
		$tfile_name = $_POST['id'].".".$ext;
		move_uploaded_file($tfile_path, "photo/$tfile_name");
		
		$tfile_name1 = $_FILES['fpphoto']['name'];
		$tfile_path1 = $_FILES['fpphoto']['tmp_name'];
		$tfile_type1 = $_FILES['fpphoto']['type'];
		$ext = substr($tfile_name1,-3);
		$tfile_name1 = $_POST['id'].".".$ext;
		move_uploaded_file($tfile_path1, "photo/photo/$tfile_name1");
		
		$sfile_name = $_FILES['sphoto']['name'];
		$sfile_path = $_FILES['sphoto']['tmp_name'];
		$sfile_type = $_FILES['sphoto']['type'];
		$ext = substr($sfile_name,-3);
		$sfile_name = $_POST['id']."s".".".$ext;
		move_uploaded_file($sfile_path, "photo/$sfile_name");
		
		$sfile_name1 = $_FILES['sfpphoto']['name'];
		$sfile_path1 = $_FILES['sfpphoto']['tmp_name'];
		$sfile_type1 = $_FILES['sfpphoto']['type'];
		$ext = substr($sfile_name1,-3);
		$sfile_name1 = $_POST['id']."sf".".".$ext;
		move_uploaded_file($sfile_path1, "photo/photo/$sfile_name1");
	
	if(isset($_POST['cname'])){
		for($i=1; $i<=count($_POST['cname']); $i++){
			
			$file_name = $_FILES['pic']['name'][$i];
			$file_path = $_FILES['pic']['tmp_name'][$i];
			$file_type = $_FILES['pic']['type'][$i];
			$ext = substr($file_name,-3);
			$file_name = $_POST['cid'][$i]."ch".".".$ext;
			move_uploaded_file($file_path, "photo/$file_name");
			
			$file_name1 = $_FILES['finger_print']['name'][$i];
			$file_path1 = $_FILES['finger_print']['tmp_name'][$i];
			$file_type1 = $_FILES['finger_print']['type'][$i];
			$ext = substr($file_name1,-3);
			$file_name1 = $_POST['cid'][$i]."chf".".".$ext;
			move_uploaded_file($file_path1, "photo/photo/$file_name1");
			
			$sql = "INSERT INTO child_info SET id='".$_POST['cid'][$i]."', tanent_id = '$id', cname='".$_POST['cname'][$i]."', cnbid='".$_POST['nid_or_bcn'][$i]."', cphoto='".$file_name."', cfpphoto='".$file_name1."'";
			mysql_query($sql);
			
		}
	}
	
	
	$sql="INSERT INTO tanent_info SET tanent_id='$id', name='$name', address='$address', occupation='$occupation', phone='$phone', email='$email', nid='$nid', photo='".$tfile_name."', fpphoto='".$tfile_name1."', spous_name='$spous_name', soccupation='$soccupation', sphone='$sphone', semail='$semail', snid='$nid', sphoto='".$sfile_name."', sfpphoto='".$sfile_name1."', child='$child', date='$date'";

	mysql_query($sql);
	if(mysql_affected_rows()>0){
		print"<script>alert('Data Insert Successfully!')</script>";
	}
	else{
		print"<script>alert('Data Insert Failed!')</script>";	
	}
}

	$id = create_tanent_id();
	function create_tanent_id(){
		$sql = "SELECT MAX(tanent_id) as u_id from tanent_info";
		$rec = mysql_query($sql);
		
		if($row = mysql_fetch_array($rec)){
			$id = $row['u_id'];
			
		}
		$id++;
		return $id;
		
		
	}
	
	$cid = create_child_id();
	function create_child_id(){
		$sql = "SELECT MAX(id) as c_id from child_info";
		$rec = mysql_query($sql);
		
		if($row = mysql_fetch_array($rec)){
			$id = $row['c_id'];
			
		}
		$id++;
		return $id;
		
		
	}

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Create Tanent</title>
<link rel="stylesheet" type="text/css" href="css/style_for_from.css" />
<link rel="stylesheet" type="text/css" href="css/tcal.css" />
<script type="text/javascript" src="js/tcal.js"></script>
<style>
select{ border:#315D86 solid 1px;}
textfield{border:#315D86 solid 1px; }
.button{border:#000000 solid 1px; background:#315D86; color:#F1F1F1;}
.show{display:none;}
</style>
</head>

<body>
	<div class="create_wrapper">
		<div class="create_body">
			<div class="creat_title">
				<h>Create Tanent</h>
			</div>
			<div class="creat_content">
            	<form action="create_tanent.php" method="post" enctype="multipart/form-data" onsubmit="return formValidation(this)">
            	<table cellspacing="3">
                	<tr>
                    	<td width="120">Tanent ID</td>
                        <td width="13">:</td>
                        <td width="153"><input type="text" name="id" id="id" value="<?php echo $id;?>" readonly class="txt_create" /></td>
                    </tr>
                    
                	<tr>
                    	<td width="120">Name</td>
                        <td width="13">:</td>
                        <td width="153"><input type="text" name="name" id="name" class="txt_create" /></td>
                    </tr>
                    
                    <tr>
                    	<td width="120">Address</td>
                        <td width="13">:</td>
                        <td width="153"><textarea name="address" id="address"></textarea></td>
                    </tr>
                    
                    <tr>
                    	<td width="120">Occupation</td>
                        <td width="13">:</td>
                        <td width="153"><input type="text" name="occupation" id="occupation" class="txt_create" /></td>
                    </tr>
                    
                    <tr>
                    	<td width="120">Mobile</td>
                        <td width="13">:</td>
                        <td width="153"><input type="text" name="phone" id="phone" class="txt_create" onKeyPress="return onlyNumeric(event)" /></td>
                    </tr>
                    
                    <tr>
                    	<td width="120">Email</td>
                        <td width="13">:</td>
                        <td width="153"><input type="text" name="email" id="email" class="txt_create" /></td>
                    </tr>
                    
                    <tr>
                    	<td width="120">National ID No</td>
                        <td width="13">:</td>
                        <td width="153"><input type="text" name="nid" id="nid" class="txt_create" /></td>
                    </tr>
                    
                    <tr>
                    	<td width="120">Photo</td>
                        <td width="13">:</td>
                        <td width="153"><input type="file" name="photo" id="photo" class="txt_create" /></td>
                    </tr>
                    
                    <tr>
                    	<td width="120">Finger Print Photo</td>
                        <td width="13">:</td>
                        <td width="153"><input type="file" name="fpphoto" id="fpphoto" class="txt_create" /></td>
                    </tr>
                    
                    <tr>
                    	<td width="120">Spouse Name</td>
                        <td width="13">:</td>
                        <td width="153"><input type="text" name="spous_name" id="spous_name" class="txt_create" /></td>
                    </tr>
                    
                     <tr>
                    	<td width="120">Occupation</td>
                        <td width="13">:</td>
                        <td width="153"><input type="text" name="soccupation" id="soccupation" class="txt_create" /></td>
                    </tr>
                    
                    <tr>
                    	<td width="120">Mobile</td>
                        <td width="13">:</td>
                        <td width="153"><input type="text" name="sphone" id="sphone" class="txt_create" onKeyPress="return onlyNumeric(event)" /></td>
                    </tr>
                    
                    <tr>
                    	<td width="120">Email</td>
                        <td width="13">:</td>
                        <td width="153"><input type="text" name="semail" id="semail" class="txt_create" /></td>
                    </tr>
                    
                    <tr>
                    	<td width="120">National ID No</td>
                        <td width="13">:</td>
                        <td width="153"><input type="text" name="snid" id="snid" class="txt_create" /></td>
                    </tr>
                    
                    <tr>
                    	<td width="120">Photo</td>
                        <td width="13">:</td>
                        <td width="153"><input type="file" name="sphoto" id="sphoto" class="txt_create" /></td>
                    </tr>
                    
                    <tr>
                    	<td width="120">Finger Print Photo</td>
                        <td width="13">:</td>
                        <td width="153"><input type="file" name="sfpphoto" id="sfpphoto" class="txt_create" /></td>
                    </tr>
                    
                    <tr>
                    	<td width="120">Child</td>
                        <td width="13">:</td>
                        <td width="153">
                        	<select id="child" name="child">
                            	<option>Select</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                                <option>6</option>
                                <option>7</option>
                                <option>8</option>
                                <option>9</option>
                                <option>10</option>
                            </select>
                        </td>
                    </tr>
                </table>
                <table id="childInfo"></table>
                <table cellspacing="3" border="0" style="margin-right:65px;">
                	<tr>
                    	<td width="120">Date</td>
                        <td width="13">:</td>
                        <td width="153"><input type="text" name="date" id="date" class="tcal" /></td>
                    </tr>
                    
                	<tr>
                    	<td colspan="3" style="text-align:center;">
                        	<input type="submit" name="btnsave" onclick="javascript:return confirm('Are you want to save ??')" class="button" value="Save" />
							<input type="reset" name="btnreset" class="button" value="Reset" />
                        </td>
                    </tr>
                </table>
                </form>
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
        $("#child").change(function(e) {
            var val = parseInt($(this).val());
			var j;
			var text = "";
			var t = '<?php echo $cid; ?>';
			for(j = 1; j<=val; j++){
				text += "<tr><td colspan = '3'><b>Child "+j+"</b><input type = 'hidden' name = 'cid["+j+"]' value = '"+t+"'></td></tr>";
				text += "<tr>";
					text += "<td>Name</td>";
					text += "<td>:</td>";
					text += "<td><input type = 'text' name = 'cname["+j+"]'></td>";
				text += "</tr>";
				
				text += "<tr>";
					text += "<td>NID / BCN</td>";
					text += "<td>:</td>";
					text += "<td><input type = 'text' name = 'nid_or_bcn["+j+"]'></td>";
				text += "</tr>";
				
				text += "<tr>";
					text += "<td>Photo</td>";
					text += "<td>:</td>";
					text += "<td><input type = 'file' name = 'pic["+j+"]'></td>";
				text += "</tr>";
				
				text += "<tr>";
					text += "<td>Finger Print Photo</td>";
					text += "<td>:</td>";
					text += "<td><input type = 'file' name = 'finger_print["+j+"]'></td>";
				text += "</tr>";
				t++;
			}
			//$("#chidlInfo").html(text);
			document.getElementById("childInfo").innerHTML = text;
        });
    });
</script>

<script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript">
function formValidation()
{
		//create_tanent
		var tname = document.getElementById("name").value;
			if(tname=="") {
			alert("Tanent Name is Required!");
			return false;
		}
		
		var occu = document.getElementById("occupation").value;
			if(occu=="") {
			alert("Tanent Occupation is Required!");
			return false;
		}

		
		var phone = document.getElementById("phone").value;
			if(phone=="") {
			alert("Phone Number is Required!");
			return false;
		}
		
				
		var email = document.getElementById("email").value;
			if(email=="") {
			alert("Email Id is Required!");
			return false;
		}
		
		var nid = document.getElementById("nid").value;
			if(nid=="") {
			alert("Tanent National ID is Required!");
			return false;
		}

		
		return true;
	
}

</script>