<?php
session_start();
if(!isset($_SESSION['isLogin']) || $_SESSION['isLogin']!='login')
{
	header("location: ./login.php");
}
include_once("ini.php");


if(isset($_GET['u_id'])){
	$uid = $_GET['u_id'];
	
	$sql = "SELECT * FROM booking_flat WHERE user_id = '$uid'";
	$rec = mysql_query($sql);
	while($row = mysql_fetch_array($rec)){
			$id = $row['tanent_id'];
			$name = $row['name'];
			$phone = $row['phone'];
			//$email = $row['email'];
	}
	
}

function getInfo($id){
	$sql = "SELECT * FROM tanent_info WHERE tanent_id='$id'";
	$rec = mysql_query($sql);
	while($row = mysql_fetch_array($rec)){
		$tanent_id = $row['tanent_id'];
	}
	return $tanent_id;
}
//echo getInfo($id);


	$sql = "SELECT * FROM tanent_info WHERE tanent_id='".getInfo($id)."'";
	$rec = mysql_query($sql);
	while($row = mysql_fetch_array($rec)){
		$tanent_id = $row['tanent_id'];
		$email   = $row['email'];
		$address = $row['address'];
		$photo 	= $row['photo'];
		
		if(empty($photo)) $photo = "default.jpg";
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

			$sql ="SELECT * FROM booking_flat WHERE tanent_id='".getInfo($id)."'";
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
<title>User Ledger</title>
<link rel="stylesheet" type="text/css" href="css/user_style.css" />
<!--<link rel="stylesheet" type="text/css" href="css/style.css"/>-->
<style>
.td {text-align:center;}
</style>
</head>
<center>
<body>
<div class="wrapper">
    <div class="uheader">
        <div class="hdiv1">
        	<table width="350" height="140">
            	
                <input type="hidden" name="tid" id="tid" value="<?php echo @$id; ?>" />
                <tr>
                	<td width="100">Tanent Name</td>
                    <td width="10">:</td>
                    <td width="230"><?php echo @$name; ?></td>
                </tr>
                <tr>
                	<td>Phone</td>
                    <td>:</td>
                    <td><?php echo @$phone; ?></td>
                </tr>
                <tr>
                	<td>Email</td>
                    <td>:</td>
                    <td><?php echo $email;?></td>
                </tr>
                <tr>
                	<td>Address</td>
                    <td>:</td>
                    <td><?php echo $address;?></td>
                </tr>
        	</table>
        </div>
        <div class="hdiv2">
        	<table width="300" height="140">
            	
                <tr>
                	<td width="100">Floor</td>
                    <td width="10">:</td>
                    <td width="180"><?php echo getFloor($floor_id); ?></td>
                </tr>
                <tr>
                	<td>Flat No</td>
                    <td>:</td>
                    <td><?php echo getFlatNo($flat_id); ?></td>
                </tr>
                <tr>
                	<td>Booking Date</td>
                    <td>:</td>
                    <td><?php echo $date;?></td>
                </tr>
        	</table>
        </div>
        <div class="thdiv3">
        	<table width="140" height="130">
                <tr>
                	<td colspan="3" style="text-align:center;">
						<?php 
							echo"<img src='photo/".@$photo."' height='140' width='130'>";
							echo"<a href='tanent_profile.php?t_id=".getInfo($id)."' target='_blank'>My Profile</a>";
						?>
                    </td>
                </tr>
                
        	</table>
        </div>
        
    </div>

    <div class="body">
    	<div class="bdiv1">
    		<table width="940" style="border:1px solid #333;">
            	<tr height="50">
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
				
				$sql = "SELECT * FROM service_charge WHERE tanent_id='".getInfo($id)."'";
					$rec = mysql_query($sql);
					while($row = mysql_fetch_array($rec)){
						//$flat_no	= $row['flat_id'];
						$tid		= $row['tanent_id'];
						$month		= $row['month'];
						$date		= $row['date'];
						$hrent		= $row['budget'];
						$electric 	= $row['teb'];
						$water 		= $row['water'];
						$gas 		= $row['gas'];
						$cleening 	= $row['cleening'];
						$security 	= $row['security'];
						$generator	= $row['generator'];
						$year		= $row['year'];
						
						$total_paid_amount = getTotalPaidAmount($month,$year,$tid);
						
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
							<td class='td'>$due</td>
						</tr>";
					
					}
					
				
				?>  
                <tr>
                    
                    <td colspan="13">
                    	-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
                    </td>
                    
                </tr> 
                <tr>
                    <td colspan="10"></td>
                    <td class='td'>Total= <?php echo @$gtotal;?></td>
                    <td class='td'>Total= <?php echo @$gtotal_paid;?></td>
                    <td class='td'>Total= <?php echo @$tdue;?></td>
                </tr> 
                
                <tr>
                    <td colspan="6"><a href="logout.php" style="text-decoration:none;"><input type="button" value="Logout" /></a></td>
                    <td colspan="7" style="text-align:right;"><input type="button" value="Print" onclick="window.print()"/></td>
                </tr> 
             </table>
    	</div>
        
        
    </div>
</div>
</body>
</center>
</html>

<?php
	function getTotalPaidAmount($month,$year,$tid){
		$sql = "SELECT * FROM payment_log WHERE tanent_id = '$tid' AND month = '$month' AND year = '$year'";
		$rec = mysql_query($sql);
		while($row = mysql_fetch_array($rec)){
			@$taka			= $row['paid_amount'];
			@$total_taka		+= $taka;
		}
		return @$total_taka;
	}
