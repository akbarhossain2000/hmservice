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


//if(isset($_GET['t_id'])){
	//$uid = $_GET['t_id'];
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
	}
	

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="css/user_style.css" />
<style>
.title{ background:#315D86; font-family:Arial, Helvetica, sans-serif; font-size:16; color:#FFF;}
.title1{ background:#315D86; font-family:Arial, Helvetica, sans-serif; font-size:16; color:#FFF; text-align:center;}
.title2{ background:#315D86; font-family:Arial, Helvetica, sans-serif; font-size:16; color:#FFF; text-align:center;}
.tbl{ border:#999 solid 1px; padding:10px 0px 10px 0px; }
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
        	<table align="center" width="380" height="150">
            	<tr>
                	<td width="100">Tanent ID</td>
                    <td width="10">:</td>
                    <td width="260"><?php echo @$id; ?></td>
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
        <div></div>
    </div>

    <div class="body">
    	<div>
    		<form id="form1" name="form1" method="post" action="">
              <table width="900" class="tbl">
                <tr>
                  <td class="title">Tanent Ledger</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td><table width="890" class="tbl1">
                    <tr>
                      <td width="307" class="title1">Payable Amount</td>
                      <td width="307"class="title1">Paid Amount</td>
                    </tr>
                    <tr>
                      <td>
                        <table align="center" width="440">
                        <?php
                            $sql = "SELECT * FROM credit_voucher WHERE tanent_id='".@$uid."'";
                            $rec = mysql_query($sql);
                            $i=0;
                            while($row=mysql_fetch_array($rec)){
                                //$id = $row['tanent_id'];
                                $month	  = $row['month'];
                                $date	  = $row['date'];
                                $payable_amt = $row['payable_amt'];
                                
                                echo "<tr>";
                                //echo "<td>$id</td>";
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
                        <table align="center" width="440">
                        <?php
                            $sql = "SELECT * FROM payment_log WHERE tanent_id='".@$uid."'";
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
                        <table width="890" align="center" class="tbl2">
                            <tr>
                                <?php
                                    $sql1 = "select sum(payable_amt) as payable_amt from credit_voucher where tanent_id ='".@$uid."'";
                                    $rec1  = mysql_query($sql1);
                                    while($row1=mysql_fetch_array($rec1)){
                                    $payable_amt = $row1['payable_amt'];
                                    @$t_payableamt = @$t_payableamt+$payable_amt;
                                    }
                                    
                                    $sql1 = "select sum(paid_amount) as paid_amount from payment_log where tanent_id ='".@$uid."'";
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
  		<?php
			echo"<table align='center' width='910'>
					<tr>
						<td style='text-align:left;'><input type='button' value='Close' onclick='window.close()'/></td>
						<td style='text-align:right;'><input type='button' value='Print' onclick='window.print()'/></td>
					</tr>";
			echo "</table>";
		?>
        </form>
    	</div>
    </div>

</div>
</body>
</center>
</html>

<?php
}
?>