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

if(isset($_GET['m_id'])){
	$mid = $_GET['m_id'];
	
	$sql = "SELECT * FROM payment_log WHERE id=$mid";
	$rec = mysql_query($sql);
	while($row = mysql_fetch_array($rec)){
		$id = $row['id'];
		$tid= $row['tanent_id'];
		$amount = $row['amount'];
		$check_amount=$row['check_amount'];
		$date=$row['date'];
		$month= $row['month'];
		$bank_name= $row['bank_name'];
		$checkNo= $row['check_no'];
		$owner_date = $row['own_date'];
		
		
		$total_amount= $amount + $check_amount;
	}
}

$sqlT="SELECT * FROM tanent_info WHERE tanent_id='$tid'";
$recT=mysql_query($sqlT);
if($rowT=mysql_fetch_array($recT)){

$name = $rowT['name'];
//echo $name;
}


$sql1 = "select sum(payable_amt) as payable_amt from credit_voucher where tanent_id ='$tid'";
		$rec1  = mysql_query($sql1);
		while($row1=mysql_fetch_array($rec1)){
			$payable_amt = $row1['payable_amt'];
			@$t_payableamt = @$t_payableamt+$payable_amt;
		}
		
$sql1 = "select sum(paid_amount) as paid_amount from payment_log where tanent_id ='$tid'";
		$rec1  = mysql_query($sql1);
		while($row1=mysql_fetch_array($rec1)){
			$paid_amt = $row1['paid_amount'];
			$t_paidamt = @$t_paidamt+$paid_amt;
		}
		
		 $balance = $t_payableamt-$t_paidamt;
	

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<center>
<body>
	<table height="359" width="770" bgcolor="#e6e3d4" align="center" style="border:2px solid #0F3;">
    <tr>
        <td height="48" valign="top" style="text-align:center;"><img src="images/logo.png" width="600" height="46" /></td> 
    </tr>
	<tr>
        <td height="38" valign="top"><h2 align="center" style="font-family:Tahoma, Geneva, sans-serif; font-size:26px;">House Rent Receipt</h2></td> 
    </tr>
    
    <tr>
      <td height="106" align="center" valign="top" style="margin-right:30px; text-align:justify; font-family:Verdana, Geneva, sans-serif; font-size:14px;">
      						Date:&nbsp; <strong> <?php echo "$date"; ?> </strong>
                            
    					  &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
                          
      					  Money Receipt No:&nbsp; <strong>
                            
						  <?php echo "HRR_NO-"."$id"; ?></strong> <br /><br />
                            
      					  <p style="font-family:Tahoma, Geneva, sans-serif; font-size:16px;">Received From &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          
        				  <font size="+1"><u> <?PHP echo "$name";?></u></font>
                          
       					  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          
         				  The Amount&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            
          				  <strong><u><?php echo "$total_amount"."&nbsp; &nbsp;"."TAKA";?><u></strong><br /><br />
                            
         				  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;For Pay To &nbsp;&nbsp;&nbsp;&nbsp;
                         
         				  <strong> <?php echo "$month";?> </strong> 	&nbsp;&nbsp;&nbsp;&nbsp;Month House Rant . </p>                
    	</td>
    
    </tr>
    <tr>
    	<td height="130" valign="top" style="padding-right:40px;">
         <table width="729"><tr><td width="343">
        
            <table align="left" width="286" style="border:1px solid #FFF; font-weight:bold; font-size:15px">
              <tr bgcolor="#fefefe"><td height="27" colspan="2"> Payment Type:</td></tr>
              <?php 
			  if($amount == 0){
			  ?>
              <tr bgcolor="#fefefe"><td width="113" height="24"> Bank Name:</td>  <td width="161"><?php echo "$bank_name"; ?></td> </tr>
              <tr bgcolor="#fefefe"><td height="23"> Check No:</td>   <td><?php echo "$checkNo"; ?></td> </tr>
              <tr bgcolor="#fefefe"><td height="23"> Check Amount:</td>   <td><?php echo "$check_amount"; ?></td> </tr>
              <tr bgcolor="#fefefe"><td height="23"> Owner Date:</td>   <td><?php echo "$owner_date"; ?></td> </tr>
             <?php
			  }
			  else{
			 ?>
             <tr bgcolor="#fefefe"><td align="left" height="23">Cash Amount:</td><td><?php echo "$amount"; ?></td> </tr>
             
             <?php
			  }
			 ?>
            </table>
            
        </td>
        <td width="374" valign="top">
        
            <table align="right" width="280" style="border:1px solid #FFF; font-weight:bold; font-size:15px">
              <tr bgcolor="#fefefe"><td width="175" height="27"> Total Payable Amount:</td>  <td width="93"><?php echo "$t_payableamt"; ?></td> </tr>
              <tr bgcolor="#fefefe">
                <td height="24"> Total Paid Amount:</td>  <td><?php echo "$t_paidamt"; ?></td> </tr>
              <tr bgcolor="#fefefe">
                <td height="23"> Total Due Amount:</td>  <td><?php echo "$balance"; ?></td> </tr>
            </table>
            </td>
        </tr></table> 
      </td>
    </tr>
    
    <tr>
    <td>
    <p> Received By: <?php echo "Accounts"; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Develope By: <a href="www.esoft.com.bd" target="b"> E-soft</a></h3>
    </p>
    </td>
    </tr>
    
    </table>
    <p align="center" style="font-size:14px;">For print<strong> <a href = '#' onclick='window.print();'>click</a> </strong> here</p>
</body>
</center>
</html>

<?php
}
?>