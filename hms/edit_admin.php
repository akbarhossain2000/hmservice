<?php
include_once("header.php");
include_once("ini.php");

if(isset($_POST['edit'])){
	
	extract($_POST);
	
	echo $sql="UPDATE tbl_login SET username='$username', password='$password' WHERE id = '".@$id."'";
	mysql_query($sql);
	
	if(mysql_affected_rows()>0){
		print"<script>alert('Data Insert Successfully!')</script>";
	}
	else{
		print"<script>alert('Data Insert Failed!')</script>";	
	}
}

	  if(isset($_GET['u_id'])){
		  $uid = $_GET['u_id'];
	  }
		  echo $sql = "SELECT * FROM tbl_login WHERE id = '".@$uid."'";
		  $rec = mysql_query($sql);
		  while($row = mysql_fetch_array($rec)){
			  $username = $row['username'];
			  $password = $row['password'];
		  }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form action="edit_admin.php" method="post">
<table width="300" align="left" cellspacing="3" cellpadding="3">
    	<tr>
         	<th colspan="3" style="text-align:left; color:#FFF; background-color:#315D86;">Edit Admin</th>
       </tr>
       
       <tr>
        	<td width="120">ID</td>
            <td width="13">:</td>
            <td width="153"><input type="text" readonly name="id" id="id" value="<?php echo @$uid; ?>" /></td>
        </tr>
       	
        <tr>
        	<td width="120">User Name</td>
            <td width="13">:</td>
            <td width="153"><input type="text" name="username" id="username" value="<?php echo $username; ?>" /></td>
        </tr>
        <tr>
        	<td width="120">Password</td>
            <td width="13">:</td>
            <td width="153">
            <input type="text" readonly value="<?php echo $password; ?>" />
            <input type="password" name="password" id="password" value="<?php echo $password; ?>" />
            <span></span>
            </td>
        </tr>
        <tr>
        	<td colspan="3" style="text-align:center">
            	<input type="submit" name="edit" id="edit" value="Update" />
            </td>
        </tr>
    </table>
    </form>
</body>
</html>
<?php
include_once("footer.php");
?>