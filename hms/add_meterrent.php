<?php
include_once("header.php");
include_once("ini.php");

if(isset($_POST['save'])){
	
	extract($_POST);
	if(isMeterRent()== false){
    $sql="INSERT INTO meter_rent SET id = '$mid', meter='$meter', vt='$vt'";
	mysql_query($sql);
	
	if(mysql_affected_rows()>0){
		print"<script>alert('Data Insert Successfully!')</script>";
	}
	else{
		print"<script>alert('Data Insert Failed!')</script>";	
	}
	}
	else{
		print"<script>alert('Data Already Inserted!')</script>";
	}
	
}


function isMeterRent()
{
	$qry = "SELECT * FROM meter_rent";
	$result = mysql_query($qry);
	$numRows = mysql_num_rows($result);
	if($numRows>0) {
		return true;
	} else {
		return false;
	}
}

	$id = create_meter_id();
	function create_meter_id(){
		$sql = "SELECT MAX(id) as m_id from meter_rent";
		$rec = mysql_query($sql);
		
		if($row = mysql_fetch_array($rec)){
			$id = $row['m_id'];
			
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
<form action="add_meterrent.php" method="post">
<table width="300" align="left" cellspacing="3" cellpadding="3">
		<tr>
         	<th colspan="3" style="text-align:left; color:#FFF; background-color:#315D86;">ADD Meter Rent</th>
       </tr>
        <tr>
        	<td>ID</td>
            <td>:</td>
            <td><input type="text" name="mid" id="mid" value="<?php echo $id?>"/></td>
        </tr>
        <tr>
        	<td>Meter Rent</td>
            <td>:</td>
            <td><input type="text" name="meter" id="meter" /></td>
        </tr>
        <tr>
        	<td>VAT/TAX</td>
            <td>:</td>
            <td><input type="text" name="vt" id="vt" /></td>
        </tr>
        <tr>
        	<td colspan="3" style="text-align:center">
            	<input type="submit" name="save" id="save" value="Save" />
                <?php
                	echo "<input type='button' name='change' id='change' value='Change' onclick=\"window.open('change_mterrent.php','','height=500,width=500')\"/>";
				?>
            </td>
        </tr>
    </table>
    </form>
</body>
</html>
<?php
include_once("footer.php");
?>