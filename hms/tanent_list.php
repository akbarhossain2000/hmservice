<?php
include_once("header.php");
include_once('ini.php');

	function getFlatNo($flat_id){
		$sql = "select * from flat where flat_id = '$flat_id'";
		$rec = mysql_query($sql);
		while($row = mysql_fetch_array($rec)){
			$flat_no =$row['flat_no'];
		}
		return $flat_no;	
	}
	
	function getFloor($floor_id){
		$sql = "select * from floor where floor_id = '$floor_id'";
		$rec = mysql_query($sql);
		while($row = mysql_fetch_array($rec)){
			$floor =$row['floor'];
		}
		return $floor;	
	}

			$sql ="SELECT * FROM booking_flat";
			$rec = mysql_query($sql);
			while($row= mysql_fetch_array($rec)){
				$floor_id = $row['floor_id'];
				$flat_id  = $row['flat_id'];
				
	}
	
    if(isset($_POST['btnunbook'])){
    	$tanent_id = $_POST['tanent_id'];
		$floor = $_POST['floor_id'];
		$flat = $_POST['flat_id'];
		
		$sql = "UPDATE booking_flat SET user_id='', password='' WHERE tanent_id='$tanent_id'";
		mysql_query($sql);
		
		$sql = "UPDATE tanent_info SET status ='0' WHERE tanent_id ='$tanent_id'";
		mysql_query($sql);
		
		$sql = "UPDATE tbl_flat SET status1 ='0' WHERE floor_id ='$floor' AND flat_id = '$flat'";
		mysql_query($sql);
    }
	


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style>
.title{ background:#315D86; font-family:Arial, Helvetica, sans-serif; font-size:16; color:#FFF;}
.title1{ background:#315D86; font-family:Arial, Helvetica, sans-serif; font-size:16; color:#FFF; text-align:center;}
.option{ font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000;}
.tbl{ border:#999 solid 1px;}
.tbl1{ border:#999 solid 1px;}
#select{ border:#315D86 solid 1px;}
#textfield{border:#315D86 solid 1px; }
#button{border:#000000 solid 1px; background:#315D86; color:#F1F1F1;}
</style>

</head>

<body>
	
  <table width="650" class="tbl">
    <tr>
      <td class="title" width="20">ID</td>
      <td class="title" width="125">Name</td>
      <td class="title" width="180">Address</td>
      <td class="title" width="100">Mobile</td>
      <!--<td class="title">Email</td>-->
      <td class="title" width="125">Book Flat</td>
      <td class="title" width="100">Edit</td>
    </tr>
    
    <?php
		include("ini.php");
		
		$sql ="SELECT * FROM tanent_info";
		$rec = mysql_query($sql);
		$i=0;
		while($row=mysql_fetch_array($rec)){
			  $id=$row['tanent_id'];
			  $name=$row['name'];
			  $address=$row['address'];
			  $phone=$row['phone'];
			  $email=$row['email'];
			  $i++;
			  $ary = getFlatInfoId($id);
			
			echo"<tr height='50'>
					<td>$id</td>
					<td><a href='tanent_profile.php?t_id=$id', target='_blank'>$name</a></td>
					<td>$address</td>
					<td>$phone</td>";
					
					echo "<form method='post' action='tanent_list.php'>";
						echo "<input type='hidden' value='$id' name='tanent_id'>";
						echo "<input type='hidden' value='".@$ary[0]."' name='floor_id'>";
						echo "<input type='hidden' value='".@$ary[1]."' name='flat_id'>";
					
					if($row['status']){
						echo "<td>".getFloor($ary[0]).", ".getFlatNo($ary[1])."<input type='submit' name='btnunbook' id='btnunbook' value='UnBook_Flat' onclick=\"javascript:return confirm('Are you want to UnbookFlat ??')\"></td>";
						echo "<td><a href='#' onclick = \"window.open('change_flat.php?tid=$id','','width=500,height=500')\">Change Flat</a></td>";
					} else {
						echo "<td><a href = 'new.php?t_id=$id' target = '_blank'>Book_Flat</a></td>";
						echo "<td>N/A</td>";
				echo "</tr>";	
					}
					echo "</form>";
		}
	?>
  </table>
</body>
</html>
<?php
include_once("footer.php");

function getFlatInfoId($id){
	$sql = "SELECT * FROM booking_flat WHERE tanent_id = '$id'";
	$rec = mysql_query($sql);
	$ary = array();
	if($row = mysql_fetch_assoc($rec)){
		$floor_id = $row['floor_id'];
		$flat_id	= $row['flat_id'];
		$ary[] = $floor_id;
		$ary[] = $flat_id;
	}
	return $ary;
}