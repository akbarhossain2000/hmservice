<?php
include_once("header.php");
include_once("ini.php");

if(isset($_POST['save'])){
	
	extract($_POST);
	
	echo $sql="INSERT INTO flat SET flat_id = '$flat_id', floor_id='$floor', flat_no='$flat_no'";
	mysql_query($sql);
	
	if(mysql_affected_rows()>0){
		print"<script>alert('Data Insert Successfully!')</script>";
	}
	else{
		print"<script>alert('Data Insert Failed!')</script>";	
	}
}

	$id = create_flat_id();
	function create_flat_id(){
		$sql = "SELECT MAX(flat_id) as f_id from flat";
		$rec = mysql_query($sql);
		
		if($row = mysql_fetch_array($rec)){
			$id = $row['f_id'];
			
		}
		$id++;
		return $id;
		
		
	}
	
	
	$sql="SELECT * FROM floor";
	$rec = mysql_query($sql);
	while($row = mysql_fetch_array($rec)){
		$floor_id = $row['floor_id'];
		$floor = $row['floor'];
		$floor_ary[$floor_id]= $floor;
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form action="add_flat.php" method="post">
<table width="300" align="left" cellspacing="3" cellpadding="3">
    	<tr>
         	<th colspan="3" style="text-align:left; color:#FFF; background-color:#315D86;">Flat ADD</th>
       </tr>
       	<tr>
        	<td>Floor</td>
            <td>:</td>
            <td>
            	<select name="floor" id="floor">
                	<option>-------</option>
                    <?php
						foreach($floor_ary as $k=>$v){
							echo"<option value='$k'>$v</option>";
						}
					?>
                </select>
            </td>
        </tr>
        <tr>
        	<td>Flat ID</td>
            <td>:</td>
            <td><input type="text" name="flat_id" id="flat_id" value="<?php echo $id; ?>" /></td>
        </tr>
        <tr>
        	<td>Flat No</td>
            <td>:</td>
            <td><input type="text" name="flat_no" id="flat_no" /></td>
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