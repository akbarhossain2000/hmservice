<?php
session_start();
if(!isset($_SESSION['isLogin']) || $_SESSION['isLogin']!='login')
{
	header("location: ./login.php");
}
if($_SESSION['user_type']!='Admin'){
	header("location: ./login.php");
}
else if($_SESSION['user_type']=='Admin'){
	
include_once("ini.php");

	if(isset($_REQUEST['user']));
	$uid=$_REQUEST['id'];
	
	//echo "$uid";
	
	$sql = "SELECT * FROM tanent_info WHERE tanent_id='".@$uid."'";
	$rec = mysql_query($sql);
	while($row = mysql_fetch_array($rec)){
			$id = $row['tanent_id'];
			$name = $row['name'];

			$phone = $row['phone'];
			$email = $row['email'];
			$photo = $row['photo'];
	}
	
	function getFlatNo($flat_id){
		$sql = "select * from flat where flat_id = '$flat_id'";
		$rec = mysql_query($sql);
		while($row = mysql_fetch_array($rec)){
			$flat_no =$row['flat_no'];
		}
		return @$flat_no;	
	}
	
	function getFloor($floor_id){
		$sql = "select * from floor where floor_id = '$floor_id'";
		$rec = mysql_query($sql);
		while($row = mysql_fetch_array($rec)){
			$floor =$row['floor'];
		}
		return @$floor;	
	}
	
	$sql ="SELECT * FROM booking_flat WHERE tanent_id='".@$uid."'";
			$rec = mysql_query($sql);
			while($row= mysql_fetch_array($rec)){
				$floor_id = $row['floor_id'];
				$flat_id  = $row['flat_id'];
				$date = $row['date'];
				
	}
	

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="css/user_style.css" />
<style>
th {text-align:center; border:1px solid #333;}
.td {text-align:center;}
.title{ background:#315D86; font-family:Arial, Helvetica, sans-serif; font-size:16; color:#FFF;}
.title1{ background:#315D86; font-family:Arial, Helvetica, sans-serif; font-size:16; color:#FFF; text-align:center;}
.title2{ background:#315D86; font-family:Arial, Helvetica, sans-serif; font-size:16; color:#FFF; text-align:center;}
.tbl{ border:#999 solid 1px; padding-top:10px;}
.tbl1{ border:#999 solid 1px;}
.tbl2{ border:#999 solid 1px;}
#select{ border:#315D86 solid 1px;}
#textfield{border:#315D86 solid 1px; }
#button{border:#000000 solid 1px; background:#315D86; color:#F1F1F1;}
</style>
</head>
<center>
<body>
<div class="wrapper">
    <div class="header">
        <div class="hdiv1">
        	<table height="150">
            	<tr>
                	<td width="100">Tanent ID</td>
                    <td width="10">:</td>
                    <td width="270"><?php echo @$id; ?></td>
                </tr>
                <tr>
                	<td>Tanent Name</td>
                    <td>:</td>
                    <td><?php echo @$name; ?></td>
                </tr>
                <tr>
                	<td>Phone</td>
                    <td>:</td>
                    <td><?php echo @$phone; ?></td>
                </tr>
                <tr>
                	<td>Email</td>
                    <td>:</td>
                    <td><?php echo @$email; ?></td>
                </tr>
        	</table>
        </div>
        <div class="hdiv2">
        	<table width="300" height="140">
            	
                <tr>
                	<td width="100">Floor</td>
                    <td width="10">:</td>
                    <td width="180"><?php echo getFloor(@$floor_id); ?></td>
                </tr>
                <tr>
                	<td>Flat No</td>
                    <td>:</td>
                    <td><?php echo getFlatNo(@$flat_id); ?></td>
                </tr>
                <tr>
                	<td>Booking Date</td>
                    <td>:</td>
                    <td><?php echo @$date;?></td>
                </tr>
        	</table>
        </div>
        <div class="hdiv3">
        	<table width="140" height="140">
                <tr>
                	<td colspan="3" style="text-align:center;"><?php echo"<img src='photo/".@$photo."' height='140' width='130'>";?></td>
                </tr>
                
        	</table>
        </div>
    </div>

    <div class="body">
    	<div class="bdiv1">
		<table width="930">
            	<tr>
                	<th>Month</th>
                    <th>Date</th>
                    <th>Year</th>
                    <th>House Rent</th>
                    <th>Electric Bill</th>
                    <th>Water</th>
                    <th>GAS</th>
                    <th>Cleening</th>
                    <th>Security</th>
                    <th>Generator</th>
                    <th>Total Taka</th>
                    <th>Paid Amount</th>
                    <th>Due</th>
                </tr>
                <?php
					$sql = "SELECT * FROM service_charge WHERE tanent_id='".@$uid."'";
					$rec = mysql_query($sql);
					while($row = mysql_fetch_array($rec)){
						$date		= $row['date'];
						$month		= $row['month'];
						$hrent		= $row['budget'];
						$electric 	= $row['teb'];
						$water 		= $row['water'];
						$gas 		= $row['gas'];
						$cleening 	= $row['cleening'];
						$security 	= $row['security'];
						$generator	= $row['generator'];
						$year		= $row['year'];
						
						$total_paid_amount = getTotalPaidAmount($month,$year,$uid);
						
						$total = $hrent+$electric+$water+$gas+$cleening+$security+$generator;
						$due = $total-$total_paid_amount;
						@$gtotal += $total;
						@$gtotal_paid += $total_paid_amount;
						@$tdue += $due;
						
						
						echo"<tr>
						  <td class='td'>$month</td>
						  <td class='td'>$date</td>
						  <td class='td'>$year</td>
						  <td class='td'>$hrent</td>
						  <td class='td'>$electric</td>
						  <td class='td'>$water</td>
						  <td class='td'>$gas</td>
						  <td class='td'>$cleening</td>
						  <td class='td'>$security</td>
						  <td class='td'>$generator</td>
						  <td class='td'>$total</td>";
						  echo"<td class='td'>"; 
							if($total_paid_amount != '')
								echo $total_paid_amount;
							else 
								echo "N/A";
							echo "</td>
							<td class='td'>$due</td>";
                		echo"</tr>";
					}
				
				?>
                 <tr>
                    
                    <td colspan="13">
                    	-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
                    </td>
                    
                </tr> 
                <tr>
                    <td colspan="10"></td>
                    <th class='td'>Total= <?php echo @$gtotal;?></th >
                    <th class='td'>Total= <?php echo @$gtotal_paid;?></th >
                    <th class='td'>Total= <?php echo @$tdue;?></th >
                </tr> 
            </table>
            
  		<?php
			echo"<table align='center' width='910'>
					<tr>
						<td style='text-align:left;'><input type='button' value='Close' onclick='window.close()'/></td>
						<td style='text-align:right;'><input type='button' value='Print' onclick='window.print()'/></td>
					</tr>
			
				</table>";
		?>
    	</div>
    </div>

</div>
</body>
</center>
</html>
<?php
}
?>

<?php

	function getTotalPaidAmount($month,$year,$uid){
		$sql = "SELECT * FROM payment_log WHERE tanent_id = '".$uid."' AND month = '$month' AND year = '$year'";
		$rec = mysql_query($sql);
		while($row = mysql_fetch_array($rec)){
			@$taka			= $row['paid_amount'];
			@$total_taka		+= $taka;
		}
		return @$total_taka;
	}
	

?>

