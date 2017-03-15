<?php
session_start();
if(!isset($_SESSION['isLogin']) || $_SESSION['isLogin']!='login')
{
	header("location: ./login.php");
}

include_once("ini.php");

if(isset($_POST['update'])){
	
	extract($_POST);
	
	echo $sql="UPDATE meter_rent SET meter = '$meter', vt ='$vt' WHERE id ='$mid'";
	mysql_query($sql);
	
	if(mysql_affected_rows()>0){
		print"<script>alert('Data Update Successfully!')</script>";
	}
	else{
		print"<script>alert('Data Update Failed!')</script>";	
	}
}

		$sql = "SELECT * FROM meter_rent";
		$rec = mysql_query($sql);
		while($row = mysql_fetch_array($rec)){
			$id = $row['id'];
			$meter = $row['meter'];
			$vt	= $row['vt'];
		}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form action="change_mterrent.php" method="post">
<table width="300" align="left" cellspacing="3" cellpadding="3">
    	<tr>
         	<th colspan="3" style="text-align:left; color:#FFF; background-color:#315D86;">Change Meter Rent</th>
       </tr>
        <tr>
        	<td>ID</td>
            <td>:</td>
            <td><input type="text" name="mid" id="mid" value="<?php echo @$id; ?>" readonly /></td>
        </tr>
        <tr>
        	<td>Meter Rent</td>
            <td>:</td>
            <td><input type="text" name="meter" id="meter" value="<?php echo @$meter; ?>"/></td>
        </tr>
        <tr>
        	<td>VAT/TAX</td>
            <td>:</td>
            <td><input type="text" name="vt" id="vt" value="<?php echo @$vt; ?>"/></td>
        </tr>
        <tr>
        	<td colspan="3" style="text-align:center">
            	<input type="submit" name="update" id="update" value="Update" />
               
            </td>
        </tr>
    </table>
    </form>
</body>
</html>
