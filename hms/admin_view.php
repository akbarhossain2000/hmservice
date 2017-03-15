<?php
include_once("header.php");
include_once("ini.php");

if (isset($_GET['d_id'])){
	    $did = $_GET['d_id'];
		$sql = "delete from tbl_login where id = '$did'";
		mysql_query($sql);	
	}

?>
<style>
 .td {height:20px; font-family:Arial, Helvetica, sans-serif; color:white; text-align:center;}
 .td1 {height:20px; font-family:Arial, Helvetica, sans-serif; color:black; text-align:center;}
</style>
<table width="500" align="left" cellspacing="3" cellpadding="3">
       
       <tr style="background-color:#315D86;">
        	<td class="td">ID</td>
            <td class="td">User Name</td>
            <td class="td">Password</td>
            <td class="td">Edit</td>
            <td class="td">Delete</td>
        </tr>
        <?php
			$sql= "SELECT * FROM tbl_login";
			$rec= mysql_query($sql);
			
			$i=0;
			while($row=mysql_fetch_array($rec)){
				$id = $row['id'];
				$i++;
				echo"<tr>";
				echo"
					<td class='td1'>$row[id]</td>
					<td class='td1'>$row[username]</td>
					<td class='td1'>$row[password]</td>
					<td class='td1'><a href='edit_admin.php?u_id=$id'>Edit</a></td>
					<td class='td1'><a href='admin_view.php?d_id=$id' onClick=\"return confirm ('Are you sure Delete this login info?');\">Delete</a></td>
				";
				echo"</tr>";
				
				
			}
		
		?>




</table>
<?php
include_once("footer.php");
?>