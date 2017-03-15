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
	
	include_once("ini.php");
	if(isset($_POST['change'])){
		$id 			= $_POST['tid'];
	} else {
		$id 			= isset($_GET['tid'])?$_GET['tid']:"";
	}
	$ary 			= getFlatInfoId($id);
	$floor_name 	= getFloor($ary[0]);
	$flat_name 		= getFlatNo($ary[1]);
	if(isset($_POST['change'])){
		$id 			= $_POST['tid'];
		$flat_id		= $_POST['flat_no'];
		$floor_id		= $_POST['floor'];
		$sql = "UPDATE tbl_flat SET status1='0' WHERE flat_id='$ary[1]' AND floor_id = '$ary[0]'";
		mysql_query($sql);
		$sql = "UPDATE tbl_flat SET status1='1' WHERE flat_id='$flat_id' AND floor_id = '$floor_id'";
		mysql_query($sql);
		$sql = "UPDATE booking_flat SET flat_id = '$flat_id', floor_id = '$floor_id' WHERE tanent_id = '$id'";
		mysql_query($sql);
		if(mysql_affected_rows() > 0){
			?>
            	<script type="text/javascript">
                	alert('Alter successfully....');
					self.close();
					top.window.opener.location.reload();
                </script>
            <?php
		} else {
			?>
            	<script type="text/javascript">
                	alert('Alter failed....');
					self.close();
					top.window.opener.location.reload();
                </script>
            <?php
		}
	}
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
?>
<form action="change_flat.php" method="post">
<table>
	<tr>
    	<td>Existing Flat</td>
        <td>:</td>
        <td><input type="text" name="" id="" value="<?php echo $floor_name.", ".$flat_name; ?>" readonly></td>
    </tr>
	<tr>
    	<td>Tanent ID</td>
        <td>:</td>
        <td><input type="text" readonly name="tid" id="tid" value="<?php echo $id; ?>"></td>
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
    <tr><td colspan="3"><input type="submit" name="change" id="change" value="ChangeFlat"></td></tr>
</table>
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