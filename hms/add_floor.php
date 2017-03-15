<?php
include_once("header.php");
include_once("ini.php");

if(isset($_POST['save'])){
	
	extract($_POST);
	
	$sql="INSERT INTO floor SET floor_id = '$floor_id', floor='$floor'";
	mysql_query($sql);
	
	if(mysql_affected_rows()>0){
		print"<script>alert('Data Insert Successfully!')</script>";
	}
	else{
		print"<script>alert('Data Insert Failed!')</script>";	
	}
}

	$id = create_floor_id();
	function create_floor_id(){
		$sql = "SELECT MAX(floor_id) as f_id from floor";
		$rec = mysql_query($sql);
		
		if($row = mysql_fetch_array($rec)){
			$id = $row['f_id'];
			
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
</head>

<body>
	<form action="add_floor.php" method="post">
	<table width="300" align="left" cellspacing="3" cellpadding="3">
    	<tr>
        	<th colspan="3" style="text-align:left; color:#FFF; background-color:#315D86;">Floor ADD</th>
        </tr>
        <tr>
        	<td>Floor ID</td>
            <td>:</td>
            <td><input type="text" name="floor_id" id="floor_id"  value="<?php echo $id; ?>" readonly /></td>
        </tr>
        <tr>
        	<td>Floor</td>
            <td>:</td>
            <td><input type="text" name="floor" id="floor" /></td>
        </tr>
        <tr>
        	<td colspan="3" style="text-align:center">
            	<input type="submit" name="save" id="save" value="Save" />
            </td>
        </tr>
    </table>
    </form>
</body>
</html>
<?php
include_once("footer.php");
?>