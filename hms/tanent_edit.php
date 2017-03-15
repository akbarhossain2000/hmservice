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
//include_once("header.php");
include("ini.php");
if(isset($_POST['btnsave'])){
	extract($_POST);
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
		for($i=0; $i<count($_POST['cname']); $i++){
				$file_name = $_FILES['cphoto']['name'][$i];
				$file_path = $_FILES['cphoto']['tmp_name'][$i];
				$file_type = $_FILES['cphoto']['type'][$i];
				$ext = substr($file_name,-3);
				$file_name = $_POST['cid'][$i]."ch".".".$ext;
				move_uploaded_file($file_path, "photo/$file_name");
				
				$file_name1 = $_FILES['cfpphoto']['name'][$i];
				$file_path1 = $_FILES['cfpphoto']['tmp_name'][$i];
				$file_type1 = $_FILES['cfpphoto']['type'][$i];
				$ext = substr($file_name1,-3);
				$file_name1 = $_POST['cid'][$i]."chf".".".$ext;
				move_uploaded_file($file_path1, "photo/photo/$file_name1");

			if($_FILES['cphoto']['name'][$i]=='' && $_FILES['cfpphoto']['name'][$i]==''){
				$sql = "UPDATE child_info SET cname='".$_POST['cname'][$i]."', cnbid='".$_POST['cnbid'][$i]."' WHERE tanent_id='$id' AND id='".$_POST['cid'][$i]."'";
				mysql_query($sql);
			}
			
			else if($_FILES['cphoto']['name'][$i]==''){
					 $sql = "UPDATE child_info SET cname='".$_POST['cname'][$i]."', cnbid='".$_POST['cnbid'][$i]."', cfpphoto='".$file_name1."' WHERE tanent_id='$id' AND id='".$_POST['cid'][$i]."'";
					 mysql_query($sql);
			}
			
			else if($_FILES['cfpphoto']['name'][$i]==''){
					$sql = "UPDATE child_info SET cname='".$_POST['cname'][$i]."', cnbid='".$_POST['cnbid'][$i]."', cphoto='".$file_name."' WHERE tanent_id='$id' AND id='".$_POST['cid'][$i]."'";
					mysql_query($sql);
			}
			
			else{
				$sql = "UPDATE child_info SET cname='".$_POST['cname'][$i]."', cnbid='".$_POST['cnbid'][$i]."', 
cphoto='".$file_name."', cfpphoto='".$file_name1."' WHERE tanent_id='$id' AND id='".$_POST['cid'][$i]."'";
				mysql_query($sql);
			}
			
			if(mysql_affected_rows()>0){
				echo "Data Update Successfully!1";
			}
			else{
				echo "Data Update Failed!1";	
			}
				
		}
		
	}
	
	if($_FILES['photo']['name']=='' && $_FILES['fpphoto']['name']=='' && $_FILES['sphoto']['name']=='' && $_FILES['sfpphoto']['name']==''){
			$sql="UPDATE tanent_info SET name='$name', address='$address', occupation='$occupation', phone='$phone', email='$email', nid='$nid', 
spous_name='$spous_name', soccupation='$soccupation', sphone='$sphone', semail='$semail', snid='$snid', child='$child', date='$date' WHERE tanent_id='$id'";
	  		mysql_query($sql);
	}
	
	else if($_FILES['fpphoto']['name']=='' && $_FILES['sphoto']['name']=='' && $_FILES['sfpphoto']['name']==''){
		$sql="UPDATE tanent_info SET name='$name', address='$address', occupation='$occupation', phone='$phone', email='$email', nid='$nid', 
photo='".@$tfile_name."', spous_name='$spous_name', soccupation='$soccupation', sphone='$sphone', semail='$semail', 
snid='$nid', child='$child', date='$date' WHERE tanent_id='$id'";
		mysql_query($sql);
	}
	
	else if($_FILES['photo']['name']=='' && $_FILES['sphoto']['name']=='' && $_FILES['sfpphoto']['name']==''){
		$sql="UPDATE tanent_info SET name='$name', address='$address', occupation='$occupation', phone='$phone', email='$email', nid='$nid', 
fpphoto='".@$tfile_name1."', spous_name='$spous_name', soccupation='$soccupation', sphone='$sphone', semail='$semail', snid='$nid', 
child='$child', date='$date' WHERE tanent_id='$id'";
		mysql_query($sql);
	}
	
	else if($_FILES['photo']['name']=='' && $_FILES['fpphoto']['name']=='' && $_FILES['sfpphoto']['name']==''){
		$sql="UPDATE tanent_info SET name='$name', address='$address', occupation='$occupation', phone='$phone', email='$email', nid='$nid', 
spous_name='$spous_name', soccupation='$soccupation', sphone='$sphone', semail='$semail', snid='$nid', sphoto='".@$sfile_name."', child='$child', 
date='$date' WHERE tanent_id='$id'";
		mysql_query($sql);
	}
	
	else if($_FILES['photo']['name']=='' && $_FILES['fpphoto']['name']=='' && $_FILES['sphoto']['name']==''){
		$sql="UPDATE tanent_info SET name='$name', address='$address', occupation='$occupation', phone='$phone', email='$email', nid='$nid', 
spous_name='$spous_name', soccupation='$soccupation', sphone='$sphone', semail='$semail', snid='$nid', sfpphoto='".@$sfile_name1."', child='$child', date='$date' WHERE tanent_id='$id'";
		mysql_query($sql);
	}
	
	else if($_FILES['photo']['name']=='' && $_FILES['fpphoto']['name']==''){
		$sql="UPDATE tanent_info SET name='$name', address='$address', occupation='$occupation', phone='$phone', email='$email', nid='$nid', 
spous_name='$spous_name', soccupation='$soccupation', sphone='$sphone', semail='$semail', snid='$nid', sphoto='".@$sfile_name."', sfpphoto='".@$sfile_name1."', child='$child', date='$date' WHERE tanent_id='$id'";
		mysql_query($sql);
	}
	
	else if($_FILES['sphoto']['name']=='' && $_FILES['sfpphoto']['name']==''){
		$sql="UPDATE tanent_info SET name='$name', address='$address', occupation='$occupation', phone='$phone', email='$email', nid='$nid', 
photo='".@$tfile_name."', fpphoto='".@$tfile_name1."', spous_name='$spous_name', soccupation='$soccupation', sphone='$sphone', semail='$semail', 
snid='$nid', child='$child', date='$date' WHERE tanent_id='$id'";
		mysql_query($sql);
	}
	
	else{
		$sql="UPDATE tanent_info SET name='$name', address='$address', occupation='$occupation', phone='$phone', email='$email', nid='$nid', 
photo='".@$tfile_name."', fpphoto='".@$tfile_name1."', spous_name='$spous_name', soccupation='$soccupation', sphone='$sphone', semail='$semail', 
snid='$nid', sphoto='".@$sfile_name."', sfpphoto='".@$sfile_name1."', child='$child', date='$date' WHERE tanent_id='$id'";
		mysql_query($sql);
	}
	
	if(mysql_affected_rows()>0){
		echo "Data Update Successfully!";
	}
	else{
		echo "Data Update Failed!";	
	}
	
	$sql = "UPDATE booking_flat SET name='$name', phone='$phone' WHERE tanent_id='$id'";
	mysql_query($sql);
	
	$sql = "UPDATE payment_log SET phone='$phone' WHERE tanent_id='$id'";
	mysql_query($sql);
	
	$sql = "UPDATE service_charge SET phone='$phone' WHERE tanent_id='$id'";
	mysql_query($sql);
	
}

if(isset($_GET['e_id'])){
	@$eid = $_GET['e_id'];
}
	$sql = "SELECT * FROM tanent_info WHERE tanent_id='".@$eid."'";
	$rec = mysql_query($sql);
	if($row=mysql_fetch_array($rec));
	
	
	
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Tanent Edit</title>
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
<center>
<body>
	<div class="tewrapper">
	<div class="tedit_wrapper">
		<div class="create_body">
			<div class="creat_title">
				<h>Change Tanent Info</h>
			</div>
			<div class="creat_content">
            	<form action="tanent_edit.php" method="post" enctype="multipart/form-data" onsubmit="return formValidation(this)">
            	<table cellspacing="3" width="790">
                	<tr>
                    	<td width="120">Tanent ID</td>
                        <td width="13">:</td>
                        <td width="500" colspan="2"><input type="text" name="id" id="id" value="<?php echo $row['tanent_id']; ?>" readonly /></td>
                    </tr>
                	<tr>
                    	<td width="120">Name</td>
                        <td width="13">:</td>
                        <td width="500" colspan="2"><input type="text" name="name" id="name" value="<?php echo $row['name']; ?>" /></td>
                    </tr>
                    
                    <tr>
                    	<td width="120">Address</td>
                        <td width="13">:</td>
                        <td width="500" colspan="2"><textarea name="address" id="address"><?php echo $row['address']; ?></textarea></td>
                    </tr>
                    
                    <tr>
                    	<td width="120">Occupation</td>
                        <td width="13">:</td>
                        <td width="500" colspan="2"><input type="text" name="occupation" id="occupation" class="txt_create" value="<?php echo $row['occupation']; ?>"  /></td>
                    </tr>
                    
                    <tr>
                    	<td width="120">Mobile</td>
                        <td width="13">:</td>
                        <td width="500" colspan="2"><input type="text" name="phone" id="phone" class="txt_create" onKeyPress="return onlyNumeric(event)" value="<?php echo $row['phone']; ?>"  /></td>
                    </tr>
                    
                    <tr>
                    	<td width="120">Email</td>
                        <td width="13">:</td>
                        <td width="500" colspan="2"><input type="text" name="email" id="email" class="txt_create" value="<?php echo $row['email']; ?>" /></td>
                    </tr>
                    
                    <tr>
                    	<td width="120">National ID No</td>
                        <td width="13">:</td>
                        <td width="500" colspan="2"><input type="text" name="nid" id="nid" class="txt_create" value="<?php echo $row['nid']; ?>" /></td>
                    </tr>
                    
                    <tr>
                    	<td width="120">Photo</td>
                        <td width="13">:</td>
                        <td width="500"><input type="file" name="photo" id="photo" class="txt_create" /></td>
                        <td>
                        	<?php
                            echo"<img src='photo/".$row['photo']."' height='100' width='100'>";
							?>    
                        </td>
                    </tr>
                    
                    <tr>
                    	<td width="120">Finger Print Photo</td>
                        <td width="13">:</td>
                        <td width="500"><input type="file" name="fpphoto" id="fpphoto" class="txt_create" /></td>
                        <td>
                        	<?php
                            echo"<img src='photo/photo/".$row['fpphoto']."' height='100' width='100'>";
							?>    
                        </td>
                    </tr>
                    
                    <tr>
                    	<td width="120">Spouse Name</td>
                        <td width="13">:</td>
                        <td width="500" colspan="2"><input type="text" name="spous_name" id="spous_name" class="txt_create" value="<?php echo $row['spous_name']; ?>" /></td>
                    </tr>
                    
                     <tr>
                    	<td width="120">Occupation</td>
                        <td width="13">:</td>
                        <td width="500" colspan="2"><input type="text" name="soccupation" id="soccupation" class="txt_create" value="<?php echo $row['soccupation']; ?>" /></td>
                    </tr>
                    
                    <tr>
                    	<td width="120">Mobile</td>
                        <td width="13">:</td>
                        <td width="500" colspan="2"><input type="text" name="sphone" id="sphone" class="txt_create" onKeyPress="return onlyNumeric(event)" value="<?php echo $row['sphone']; ?>" /></td>
                    </tr>
                    
                    <tr>
                    	<td width="120">Email</td>
                        <td width="13">:</td>
                        <td width="500" colspan="2"><input type="text" name="semail" id="semail" class="txt_create" value="<?php echo $row['semail']; ?>" /></td>
                    </tr>
                    
                    <tr>
                    	<td width="120">National ID No</td>
                        <td width="13">:</td>
                        <td width="500" colspan="2"><input type="text" name="snid" id="snid" class="txt_create" value="<?php echo $row['snid']; ?>" /></td>
                    </tr>
                    
                    <tr>
                    	<td width="120">Photo</td>
                        <td width="13">:</td>
                        <td width="500">
                        	<input type="file" name="sphoto" id="sphoto" class="txt_create" />  
                        </td>
                        <td>
                        	<?php
                            echo"<img src='photo/".$row['sphoto']."' height='100' width='100'>";
							?>    
                        </td>
                    </tr>
                    
                    <tr>
                    	<td width="120">Finger Print Photo</td>
                        <td width="13">:</td>
                        <td width="500"><input type="file" name="sfpphoto" id="sfpphoto" class="txt_create" /></td>
                        <td>
                        	<?php
                            echo"<img src='photo/photo/".$row['sfpphoto']."' height='100' width='100'>";
							?>    
                        </td>
                    </tr>
                    
                    <tr>
                    	<td width="120">Child</td>
                        <td width="13">:</td>
                        <td width="500" colspan="2">
                          <input type="text" name="child" id="child" class="txt_create" readonly  value="<?php echo $row['child']; ?>" />
                        </td>
                    </tr>
                    
                    <?php
						  $sql1 = "SELECT * FROM child_info WHERE tanent_id='".@$eid."'";
						  $rec1 = mysql_query($sql1);
						  $i=0;
						  while($row1=mysql_fetch_array($rec1)){
							  	@$cid =$row1['id'];
							  $i++;
							  echo"<tr>
							  		<input type='hidden' name='cid[]' value='".@$cid."'/>
									<td colspan='4'><b>Child ".$i."</b></td>
								  </tr>";
							  echo"<tr>
									<td width='120'>Name</td>
									<td width='13'>:</td>
									<td width='500' colspan='2'>
									  <input type='text' name='cname[]' id='cname' value='".$row1['cname']."'/>
									</td>
								  </tr>"; 
							  echo"<tr>
									<td width='120'>NID/BID</td>
									<td width='13'>:</td>
									<td width='500' colspan='2'>
									  <input type='text' name='cnbid[]' id='cnbid' value='".$row1['cnbid']."'/>
									</td>
								  </tr>";
							  echo"<tr>
									<td width='120'>Photo</td>
									<td width='13'>:</td>
									<td width='500'>
									  <input type='file' name='cphoto[]' id='cphoto'/>
									</td>
									<td>
                            			<img src='photo/".$row1['cphoto']."' height='100' width='100'> 
                        			</td>
								  </tr>"; 
							  echo"<tr>
									<td width='120'>FingerPrint Photo</td>
									<td width='13'>:</td>
									<td width='500'>
									  <input type='file' name='cfpphoto[]' id='cfpphoto'/>
									</td>
									<td>
                            			<img src='photo/photo/".$row1['cfpphoto']."' height='100' width='100'> 
                        			</td>
								  </tr>";  
							  
						  }
					?>
                </table>
                <table cellspacing="3" border="0" width="790">
                	<tr>
                    	<td width="120">Date</td>
                        <td width="13">:</td>
                        <td width="653" colspan="2"><input type="text" name="date" id="date" readonly value="<?php echo $row['date']; ?>" /></td>
                    </tr>
                    
                	<tr>
                    	<td colspan="4" style="text-align:center;">
                        	<input type="submit" name="btnsave" onclick="javascript:return confirm('Are you want to update ??')" class="button" value="Update" />
							<input type="button" class="button" value="Close" onclick="window.close()" />
                        </td>
                    </tr>
                </table>
                </form>
			</div>

		</div>
	</div>
    
 </div>
</body>
</center>
</html>
<?php
//include_once("footer.php");

?>
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