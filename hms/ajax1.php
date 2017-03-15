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

if(isset($_GET['name'])):
	$info=$_GET['name'];
	
	$data=mysql_fetch_array(mysql_query("select * from booking_flat where tanent_id='$info'"));
	echo"<table>
			<tr>
				<td width='150'> Tanent ID</td>";
		echo	"<td width='13'>:</td>";
	 	echo	"<td width='153'><input type='text' name='tanent_id' id='tanent_id' value=".$data['tanent_id']."></td>";
 	echo	"</tr>";
		echo"<tr>
				<td width='150'>Mobile No</td>";
		echo	"<td width='13'>:</td>";
	 	echo	"<td width='153'><input type='text' name='phone' id='phone' value=".$data['phone']."></td>";
 		echo"</tr>";
		echo"<tr>
				<td width='150'>Flat No</td>";
		echo	"<td width='13'>:</td>";
	 	echo	"<td width='153'><input type='text' name='flat_no' id='flat_no' value=".flatId($data['flat_id'])."></td>";
		echo  "<input type='hidden' name='flat_id' id='flat_id' value=".$data['flat_id'].">";
 		echo"</tr>";
		
		echo"<tr>
				<td width='150'>House Rent</td>";
		echo	"<td width='13'>:</td>";
	 	echo	"<td width='153'><input type='text' name='budget' id='budget' value=".$data['budget']."></td>";
 	echo	"</tr>";
	
  	echo"</table>";
	
endif;

		echo"<table>";
	       echo "<tr>
                        <td width='150'>Month Of Rent</td>
                        <td width='13'>:</td>";
                        echo"<td width='153'><input type='text' name='month' id='month' value=".date("M")."></td>";
                     echo"</tr>
                     <tr>
                     	   <td width='150'>Year</td>
                           <td width='13'>:</td>";
                           echo "<td width='153'><input type='text' name='year' id='year' value=".date('Y')."></td>";
                     echo"</tr>";
                echo"</table>
                
					<table>
                    	<tr>
                        	<th colspan='3' style='text-align:left;'>Electricity :</th>
                        </tr>";
						
		echo"<tr>
				<td width='150'>Previous Unit</td>";
		echo	"<td width='13'>:</td>";
	 	echo	"<td width='153'><input type='text' name='punit' id='punit' value=".ldvm($data['flat_id'])."></td>";
 	echo	"</tr>";
	echo"</table";

function ldvm($flat_no){
	
	$sql="SELECT * FROM electricity WHERE flat_id='$flat_no'";
	$rec = mysql_query($sql);
	while($row=mysql_fetch_array($rec)){
			@$punit = $row['punit'];
	}
	return @$punit;
}

function flatId($flat_no){
	
	$sql="SELECT * FROM flat WHERE flat_id='$flat_no'";
	$rec = mysql_query($sql);
	while($row=mysql_fetch_array($rec)){
		@$flat_id = $row['flat_no'];
	}
	return @$flat_id;
}


?>


