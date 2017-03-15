<?php
include_once("header.php");
include("ini.php");
if(isset($_POST['button'])){
	//$tid = $_POST['button'];
	
	$tid =$_POST['name'];
	@$phone  =$_POST['phone'];
	
}

	/*if(isset($_POST['name'])){
		$tid = $_POST['name'];
	}*/
		$sql = "SELECT * FROM booking_flat";
		$rec = mysql_query($sql);
		$get_tanent = array();
		while($row = mysql_fetch_array($rec)){
			$id = $row['tanent_id'];
			$name = $row['name'];
			$get_tanent[$id] = $name;
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
.title2{ background:#315D86; font-family:Arial, Helvetica, sans-serif; font-size:16; color:#FFF; text-align:center;}
.option{ font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000;}
.tbl{ border:#999 solid 1px;}
.tbl1{ border:#999 solid 1px;}
.tbl2{ border:#999 solid 1px;}
#select{ border:#315D86 solid 1px;}
#textfield{border:#315D86 solid 1px; }
#button{border:#000000 solid 1px; background:#315D86; color:#F1F1F1;}
</style>

</head>

<body>

<form id="form1" name="form1" method="post" action="">
  <table width="600" class="tbl">
    <tr>
      <td class="title">Tanet Ledger</td>
    </tr>
    <tr>
      <td align="center" class="option"><label for="select">Tanent Name
        <select name="name" id="name">
        	<option selected="selected">----------</option>
        	<?php
				foreach($get_tanent as $k=>$v){
					if($tid == $k){
						echo"<option value='$k' selected='selected'>$v</option>";
					}
					else{
						echo"<option value='$k'>$v</option>";	
					}
				}
			
			?>
        </select>
        </label>
      <label for="select">
        <input type="submit" name="button" id="button" value="Submit" />
      </label></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><table width="600" class="tbl1">
        <tr>
          <td width="307" class="title1">Tanent</td>
          <td width="307"class="title1">Paid Amount</td>
        </tr>
        <tr>
          <td>
          	<table align="center" width="300">
          	<?php
				$sql = "SELECT * FROM credit_voucher WHERE tanent_id='".@$tid."'";
				$rec = mysql_query($sql);
				$i=0;
          		while($row=mysql_fetch_array($rec)){
					$id = $row['tanent_id'];
					$month	  = $row['month'];
					$date	  = $row['date'];
					$payable_amt = $row['payable_amt'];
					
					echo "<tr>";
					echo "<td>$id</td>";
					echo "<td>$month</td>";
					echo "<td>$date</td>";
					echo "<td>$payable_amt</td>";
					echo "</tr>";
					$i++;
				}
          	?>
            </table>
          </td>
          <td>
            <table align="center" width="300">
          	<?php
				$sql = "SELECT * FROM payment_log WHERE tanent_id='".@$tid."'";
				$rec = mysql_query($sql);
				$i=0;
          		while($row=mysql_fetch_array($rec)){
					$paid_amt = $row['paid_amount'];
					$month	  = $row['month'];
					$date	  = $row['date'];
					
					echo "<tr>";
					echo "<td>$month</td>";
					echo "<td>$date</td>";
					echo "<td style='text-align:right;'>$paid_amt</td>";
					echo "</tr>";
					$i++;
				}
          	?>
            </table>
          </td>
        </tr>
      </table></td>
    </tr>
    <tr>
    	<td colspan="2">
        	<table width="610" align="center" class="tbl2">
        		<tr>
                	<?php
						$sql1 = "select sum(payable_amt) as payable_amt from credit_voucher where tanent_id ='".@$tid."'";
						$rec1  = mysql_query($sql1);
						while($row1=mysql_fetch_array($rec1)){
						$payable_amt = $row1['payable_amt'];
						@$t_payableamt = @$t_payableamt+$payable_amt;
						}
						
						$sql1 = "select sum(paid_amount) as paid_amount from payment_log where tanent_id ='".@$tid."'";
						$rec1  = mysql_query($sql1);
						while($row1=mysql_fetch_array($rec1)){
						$paid_amt = $row1['paid_amount'];
						@$t_paidamt = @$t_paidamt+$paid_amt;
						}
						@$balance =@$t_payableamt-@$t_paidamt;
						
          				echo "<td class='title2' width='305'>Total Payable Amount: $t_payableamt</td>";
          				echo "<td class='title2' width='305'>Total Paid Amount: $t_paidamt</td>";
					
					?>
       		 	</tr>
        	</table>
        </td>
    </tr>
    <tr>
      <td style="text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:18px; color:#000;">Show Balance: <?php echo @$balance;?></td>
    </tr>
  </table>
  <div>	
  	<div>
    	  <?php 
			echo"<table align='left'>
			  <tr>
				  <td><a target='_blank' href='report.php?id=".@$tid."'>Details</a></td>
			  </tr>
			</table>";
			
		  ?>
    </div>
  	<div>
    	<?php 
		  echo"<table align='right'>
			<tr>
				<td><a target='_blank' href='leger_print_view.php?id=".@$tid."'>print_view</a></td>
			</tr>
		  </table>";
		  
		?>
    </div>
  </div>

</form>
</body>
</html>
<?php
include_once("footer.php");
?>