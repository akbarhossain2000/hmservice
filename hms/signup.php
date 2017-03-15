<?php
include_once("header.php");
include_once("ini.php");

if(isset($_POST['save'])){
	
	extract($_POST);
	
	echo $sql="INSERT INTO tbl_login SET id = '$id', username='$username', password='$password'";
	mysql_query($sql);
	
	if(mysql_affected_rows()>0){
		print"<script>alert('Data Insert Successfully!')</script>";
	}
	else{
		print"<script>alert('Data Insert Failed!')</script>";	
	}
}

	$id = create_admin_id();
	function create_admin_id(){
		$sql = "SELECT MAX(id) as u_id from tbl_login";
		$rec = mysql_query($sql);
		
		if($row = mysql_fetch_array($rec)){
			$id = $row['u_id'];
			
		}
		$id++;
		return $id;
		
		
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script type="text/javascript" src="js/script.js"></script>

</head>

<body>
<form action="signup.php" method="post" onsubmit="return formValidation(this)">
<table width="400" align="left" cellspacing="3" cellpadding="3">
    	<tr>
         	<th colspan="3" style="text-align:left; color:#FFF; background-color:#315D86;">Create Admin</th>
       </tr>
       
       <tr>
        	<td>ID</td>
            <td>:</td>
            <td><input type="text" name="id" id="id" value="<?php echo $id; ?>" /></td>
        </tr>
       	
        <tr>
        	<td>User Name</td>
            <td>:</td>
            <td><input type="text" name="username" id="username" /></td>
        </tr>
        
        <tr>
        	<td>Password</td>
            <td>:</td>
            <td><input type="password" name="password" id="password" maxlength="15" onkeyup="checkPassword()"/>
            	<span id="pass_note"></span>
            </td>
            
        </tr>
        
        <tr>
        	<td colspan="3" style="text-align:center">
            	<input type="submit" name="save" id="save" value="Save" />
                <input type="reset" name="reset" id="reset" value="Reset" />
                <a href="admin_view.php"><input type="button" value="View" /></a>
            </td>
        </tr>
    </table>
    </form>
</body>
</html>
<?php
include_once("footer.php");
?>


<script type="text/javascript">
	function formValidation()
	  {
		  var uid = document.getElementById("username").value;
		  if(uid.length==0) {
			  alert("Please Enter User ID");
			  return false;
		  }
		  
		  var pass = document.getElementById("password").value;
		  if(pass=="") {
			  alert("Please Enter Password");
			  return false;
		  }
		  return true;
	  }
</script>