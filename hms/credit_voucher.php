<?php
include_once("header.php");
include("ini.php");
if(isset($_POST['button'])){
	extract($_POST);
	if($amount!=0){
		$value = $amount;
	}
	else{
		$value = $check_amount;	
	}
	$sql ="INSERT INTO payment_log SET id='$id', tanent_id='$tanent_id', phone='$phone', paid_amount='$value', amount='$amount', bank_name='$bank_name', 
	check_no='$check_no', check_amount='$check_amount', month='$month', year='$year', own_date='$own_date', date='$date'";
	mysql_query($sql);

	
		if(mysql_affected_rows()>0){
				print"<script>window.open('money_reciept.php?m_id=$id','','height=600,width=800')</script>";
		}
		else{
		print"<script>alert('Data Insert Failed!')</script>";	
		}
	
}

	$mid = money_reciept_id();
	function money_reciept_id(){
		$sql = "SELECT MAX(id) as inv_id from payment_log";
		$rec = mysql_query($sql);
		
		if($row = mysql_fetch_array($rec)){
			$mid = $row['inv_id'];
			
		}
		$mid++;
		return $mid;
	}

	$sql = "SELECT * FROM booking_flat";
	$rec = mysql_query($sql);
	
	$tanent_ary = array();
	while($row = mysql_fetch_object($rec)){
		$id = $row->tanent_id;
		$name = $row->name;
		$tanent_ary[$id]=$name; 
	}
	
	if(isset($_POST['select'])){
	 	@$tid = $_POST['select'];
		$sql = "SELECT * FROM booking_flat WHERE tanent_id='$tid'";
		$rec = mysql_query($sql);
		while($row=mysql_fetch_array($rec)){
			$phone = $row['phone'];
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
		
	}
	
		


	
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="css/tcal.css" />
<script type="text/javascript" src="js/tcal.js"></script>
<style>
.title{ background:#315D86; font-family:Arial, Helvetica, sans-serif; font-size:16; color:#FFF;}
.title1{ background:#315D86; font-family:Arial, Helvetica, sans-serif; font-size:16; color:#FFF; text-align:center;}
.option{ font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000;}
.tbl{ border:#999 solid 1px;}
.tbl1{ border:#999 solid 1px;}
#select{ border:#315D86 solid 1px;}
#textfield{border:#315D86 solid 1px; }
#button{border:#000000 solid 1px; background:#315D86; color:#F1F1F1;}
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
}
</style>
</head>

<body>
  <table width="526" class="tbl">
    <tr>
      <td colspan="3" class="title">Credit Voucher</td>
    </tr>
    <tr>
      <td width="138">Tanent Select</td>
      <td width="3">:</td>
      <td width="363">
      <form id="form1" name="form1" method="post" action="credit_voucher.php">

      	<select name="select" id="select" onchange="javascript:form1.submit()">
      		<option selected="selected">---Select---</option>
        	<?php
				foreach($tanent_ary as $k=>$v){
					if($tid==$k){
						echo"<option value='$k' selected='selected'>$v</option>";
					}
					else{
						echo"<option value='$k'>$v</option>";	
					}
				}
			
			?>
      	</select>
        </form>
      </td>
    </tr>
	<form action="#" method="post">
    <tr>
    	<input  type="hidden" name="id" id="id" value="<?php echo $mid;?>" />
      <td width="120">Month Of Rent</td>
      <td width="13">:</td>
      <td width="153"><input type="text" readonly name="month" id="month" value="<?php echo date("M");?>"</td>
   </tr>
    <tr>
         <td width="120">Year</td>
         <td width="13">:</td>
         <td width="153"><input type="text" readonly name="year" id="year" value="<?php echo date("Y"); ?>" readonly="readonly" /></td>
   </tr>
   <tr>                  
      <td>Mobile</td>
      <td>:</td><input  type="hidden" name="tanent_id" id="tanent_id" value="<?php echo @$tid; ?>" /> 
      <td><label for="textfield"></label>
      <input type="text" name="phone" id="phone" value="<?php echo @$phone; ?>"/></td>
    </tr>
    <tr>
      <td>Payable Amount</td>
      <td>:</td>
      <td><label for="textfield"></label>
      <input type="text" name="payable_amt" id="payable_amt" value="<?php echo @$t_payableamt;?>"/></td>
    </tr>
    <tr>
      <td>Paid Amount</td>
      <td>:</td>
      <td><label for="textfield"></label>
      <input type="text" name="paid_amnt" id="paid_amnt"  value="<?php echo @$t_paidamt; ?>"/></td>
    </tr>
    <tr>
      <td>Due</td>
      <td>:</td>
      <td><label for="textfield"></label>
      <input type="text" readonly name="due_amt" id="due_amt" value="<?php echo @$balance; ?>"/></td>
    </tr>
    <tr>
      <td>Date</td>
      <td>:</td>
      <td><input type="date" name="date" id="date" class="tcal" /></td>
    </tr>
    <tr>
      <td>Payment</td>
      <td>:</td>
      <td><label for="select2">
        <input type="checkbox" name="checkbox" id="checkbox" />
        Cash
  <input type="checkbox" name="checkbox2" id="checkbox2" />
      </label>
Check</td>
    </tr>
    <tr class="show">
    	<td>Amount</td>
        <td>:</td>
        <td><input type="text" name="amount" id="amount" /></td>
    </tr>
    <tr class="show1">
        <td>Bank Name</td>
        <td>:</td>
        <td><input type="text" name="bank_name" id="bank_name" /></td>
    </tr>
    <tr class="show1">
    	<td>Check No</td>
        <td>:</td>
        <td><input type="text" name="check_no" id="check_no" /></td>
    </tr>
    <tr class="show1">
    	<td>Check Amount</td>
        <td>:</td>
        <td><input type="text" name="check_amount" id="check_amount" /></td>
    </tr>
    <tr class="show1">
    	<td>Owner Date</td>
        <td>:</td>
        <td><input type="text" name="own_date" id="own_date" class="tcal" /></td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3"><input type="submit" name="button" id="button" value="Submit" onclick="javascript:return confirm('Are you want to save ??')" /></td>
    </tr>
  </table>
</form>
</body>
</html>
<?php
include_once("footer.php");
?>
<input type="hidden" name="due" id="due" value="<?php echo @$balance; ?>"/>
<input type="hidden" name="paid" id="paid"  value="<?php echo @$t_paidamt; ?>"/>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(e) {
        $("#checkbox").click(function(e) {
            if($(this).is(':checked')){
				$(".show").fadeIn(600);
			} else {
				$(".show").fadeOut(600);
			}
        });
		
		$("#checkbox2").click(function(e){
			if($(this).is(':checked')){
				$(".show1").fadeIn(600);	
			}
			else{
				$(".show1").fadeOut(600);
			}
		});
		
	 $("#amount").bind('keyup',function(e) {
     	var val = $(this).val();
		var due = $("#due").val();
		var paid_amt = $("#paid_amnt").val();
		
		var payable = $("#paid").val();
		var paid = parseInt(payable) + parseInt(val);
		if(val == 0){
			$("#paid_amnt").val(payable);
		} else {
			$("#paid_amnt").val(paid);
		}
		var new_due = due - val;
		$("#due_amt").val(new_due);
			
      });
	  
	  $("#check_amount").bind('keyup',function(e) {
     	var val = $(this).val();
		var due = $("#due").val();
		var paid_amt = $("#paid_amnt").val();
		
		var payable = $("#paid").val();
		var paid = parseInt(payable) + parseInt(val);
		if(val == 0){
			$("#paid_amnt").val(payable);
		} else {
			$("#paid_amnt").val(paid);
		}
		var new_due = due - val;
		$("#due_amt").val(new_due);
			
      });
		
    });	

</script>

<style type="text/css">
.show{display:none}
.show1{display:none}
</style>