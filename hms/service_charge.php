<?php
include_once("header.php");
include_once("ini.php");
if(isset($_POST['btnsave'])){
	extract($_POST);
	
		
	if(isMyExists($name, $month, $year)==false){	
		if(isFlatExists($flat_id)==false){
			echo $sql2="INSERT INTO electricity SET flat_id='$flat_id', punit='$cunit', cunit='$cunit', uunit='$uunit'";
			mysql_query($sql2);	
		
			echo $sql = "INSERT INTO service_charge SET tanent_id='$name', phone='$phone', flat_id='$flat_no', budget='$budget', month='$month', year='$year', 
			punit='$cunit', cunit='$cunit', uunit='$uunit', pur='$pur', mrent='$mrent', vt='$vt', teb='$teb', water='$water', gas='$gas', cleening='$cleening', 
			security='$security', generator='$generator', date='$date'";
			mysql_query($sql);

			echo $sql1 ="INSERT INTO credit_voucher SET tanent_id='$name', payable_amt='$gt', month='$month', year='$year', date='$date'";
			mysql_query($sql1);
	
		}else{
			echo $sql="UPDATE electricity SET punit='$cunit', cunit='$cunit', uunit='$uunit' WHERE flat_id='$flat_id'";
			mysql_query($sql);
			
			echo $sql = "INSERT INTO service_charge SET tanent_id='$name', phone='$phone', flat_id='$flat_no', budget='$budget', month='$month', year='$year', 
			punit='$cunit', cunit='$cunit', uunit='$uunit', pur='$pur', mrent='$mrent', vt='$vt', teb='$teb', water='$water', gas='$gas', cleening='$cleening', 
			security='$security', generator='$generator', date='$date'";
			mysql_query($sql);

			echo $sql1 ="INSERT INTO credit_voucher SET tanent_id='$name', payable_amt='$gt', month='$month', year='$year', date='$date'";
			mysql_query($sql1);	
		}
		
	}else{
		echo"This Tanent Month of Rent of The Year Already Exists!";	
	}
	
}

	function isFlatExists($flat_id)
	{
	$qry = "SELECT * FROM electricity WHERE flat_id='$flat_id'";
	$result = mysql_query($qry);
	$numRows = mysql_num_rows($result);
		if($numRows>0) {
			return true;
		} else {
			return false;
		}
	}

	function isMyExists($name, $month, $year)
	{
	$qry = "SELECT * FROM service_charge WHERE tanent_id='$name' AND month='$month' AND year='$year'";
	$result = mysql_query($qry);
	$numRows = mysql_num_rows($result);
		if($numRows>0) {
			return true;
		} else {
			return false;
		}
	}
	
	if(isset($_POST['name'])){
		echo $tid =$_POST['name'];
		
//	$sql3 = "SELECT * FROM credit_voucher WHERE tanent_id='$tid'";

	}
	

	
	$sql="SELECT * FROM booking_flat";
	$rec = mysql_query($sql);
	$name_ary = array();
	while($row=mysql_fetch_object($rec)){
		$id = $row->tanent_id;	
		$name = $row->name;
		$name_ary[$id]=$name;
	}
	
	$sql = "SELECT * FROM meter_rent";
	$rec = mysql_query($sql);
	while($row = mysql_fetch_array($rec)){
		$id = $row['id'];
		$m_rent = $row['meter'];
		$vt = $row['vt'];
	}

	
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Service Charge</title>
<link rel="stylesheet" type="text/css" href="css/service.css" />
<link rel="stylesheet" type="text/css" href="css/tcal.css"/>

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/tcal.js"></script>

<script type="text/javascript">
function gethouserent(str) {
  if (str.length==0) {
    document.getElementById("txtHint").innerHTML="";
    return;
  }
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
  
  xmlhttp.open("GET","ajax1.php?name="+str,true);
  xmlhttp.send();
}
</script>

<style>
.btn_create{border:#000000 solid 1px; background:#315D86; color:#F1F1F1;}
</style>
</head>

<body>
	<div class="service_wrapper">
		<div class="create_body">
			<div class="creat_title">
				<h>Service Charge</h>
			</div>
			<div class="creat_content">
            <form action="service_charge.php" name="frm" method="post">
            	<table cellspacing="3">
                	<tr>
                    	<td width="150">Tanent Name</td>
                        <td width="13">:</td>
                        <td width="153">
                        	<select name="name" id="name" class="selectbox" onchange="gethouserent(this.value)">
                            	<option>------</option>
                                <?php
								foreach($name_ary as $n=>$s){
									if($tid==$n){
										echo"<option value='$n' selected='selected'>$s</option>";
									}
									else{
										echo"<option value='$n'>$s</option>";
									}
								}
								?>
                            </select>
                        </td>
                    </tr>
                	<tr>
                        <td colspan="3"><div id="txtHint"></div></td>
                    </tr>
                     <table>
                        <tr>
                        	<!--<td width="120">Previous Unit</td>
                            <td width="13">:</td>
                            <td width="153"><input type="text" name="punit" id="punit" /></td>-->
                            <td colspan="3"><div id="txtHint"></div></td>
                        </tr>
                        
                        <tr>
                        	<td width="150">Current Unit</td>
                            <td width="13">:</td>
                            <td width="153"><input type="text" name="cunit" id="cunit"/></td>
                        </tr>
                        <tr>
                        	<td width="150">Uses Unit</td>
                            <td width="13">:</td>
                            <td width="153"><input type="text" name="uunit" id="uunit" /></td>
                        </tr>
                        <tr>
                        	<td width="150">Per Unit Rate</td>
                            <td width="13">:</td>
                            <td width="153"><input type="text" name="pur" id="pur" /></td>
                        </tr>
                        <tr>
                        	<td width="150">Meter Rent</td>
                            <td width="13">:</td>
                            <td width="153"><input type="text" readonly name="mrent" id="mrent"  value="<?php echo $m_rent;?>"/></td>
                        </tr>
                        <tr>
                        	<td width="150">VAT/TAX</td>
                            <td width="13">:</td>
                            <td width="153"><input type="text" readonly name="vt" id="vt" value="<?php echo $vt; ?>"/></td>
                        </tr>
                        
                        <tr>
                        	<td width="150">Total Electricity Bill</td>
                            <td width="13">:</td>
                            <td width="153"><input type="text" name="teb" id="teb" /></td>
                        </tr>
                    </table>
                  
                   
                <table>
                	<tr>
                    	<th style="text-align:left;">Others :</th>
                    </tr> 
                       
                    <tr>
                    	<td width="150">Water</td>
                        <td width="13">:</td>
                        <td width="153"><input type="text" class="cls" name="water" id="water" /></td>
                    </tr>
                    
                    <tr>
                    	<td width="150">GAS</td>
                        <td width="13">:</td>
                        <td width="153"><input type="text" name="gas" class="cls" id="gas" class="txt_create" /></td>
                    </tr>
                    
                    <tr>
                    	<td width="150">Cleening</td>
                        <td width="13">:</td>
                        <td width="153"><input type="text" name="cleening" class="cls" id="cleening" class="txt_create" /></td>
                    </tr>
                    
                    <tr>
                    	<td width="150">Security</td>
                        <td width="13">:</td>
                        <td width="153"><input type="text" name="security" class="cls" id="security" class="txt_create" /></td>
                    </tr>
                    
                    <tr>
                    	<td width="150">Generator</td>
                        <td width="13">:</td>
                        <td width="153"><input type="text" name="generator" class="cls" id="generator" class="txt_create" /></td>
                    </tr>
                    <tr>
                    	<td width="150">Grand Total</td>
                        <td width="13">:</td>
                        <td width="153"><input type="text" name="gt" id="gt" readonly /></td>
                    </tr>
                     <tr>
                    	<td width="150">Date</td>
                        <td width="13">:</td>
                        <td width="153"><input type="date" name="date" id="date" class="tcal" /></td>
                    </tr>
                    
                    <tr>
                    	<td colspan="3" class="creat_bouton" align="center">
                        	<input type="submit" name="btnsave" class="btn_create" value="Save" />
							<input type="submit" name="btnview" class="btn_create" value="View" />
                        </td>
                    </tr>
                </table>
              </form>  
			</div>

		</div>
	</div>
</body>
</html>
<?php
include_once("footer.php");
?>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(e) {
        $("#cunit").keyup(function(e) {
            var val = $(this).val();
			var prev_val = $("#punit").val();
			if(prev_val != ''){
				prev_val = prev_val;
			} else {
				prev_val = 0;	
			}
			var subtraction = parseFloat(val) - parseFloat(prev_val);
			if(val != ''){
				$("#uunit").val(subtraction);	
			} else {
				$("#uunit").val(0.00);	
			}
		});
			$("#pur").keyup(function(e) {
				var val = $(this).val();
				var uunit = $("#uunit").val();
				var mrent  = $("#mrent").val();
				var vt	   = $("#vt").val();

				var multiply = parseInt(uunit) * parseFloat(val);
				var percent = (parseInt(multiply) * parseInt(vt)) / 100;
				var sum = parseInt(multiply) + parseInt(mrent) + parseInt(percent);
				//var percent = parseInt(sum) * parseInt(vt);
				//var multiply = substr(multiply, -2);
				
				var total = parseInt(sum);
				if(val != ''){
					$("#teb").val(total);
				} else {
					$("#teb").val(0);	
				}
        });
		//var sum = 0;
		$(".cls").each(function(){
			$(this).keyup(function(e) {
            	calculateSum();
            });
		});
		
	});
	
	function calculateSum(){
	  var sum = 0;
	  $(".cls").each(function(index, element) {
		  if(!isNaN(this.value) && this.value.length != 0){
			  sum += parseFloat(this.value);
		  }
	  });
	  var hrent = $("#budget").val();
	  var ebill	= $("#teb").val();
	  $("#gt").val(sum+parseFloat(ebill)+parseFloat(hrent));
	}
	</script>