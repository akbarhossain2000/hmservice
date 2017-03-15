<?php
session_start();
if(!isset($_SESSION['isLogin']) || $_SESSION['isLogin']!='login')
{
	header("location: ./login.php");
}

include_once("ini.php");


if(isset($_GET['t_id']));
	$uid = $_GET['t_id'];
	
	$sql = "SELECT * FROM tanent_info WHERE tanent_id='$uid'";
	$rec = mysql_query($sql);
	if($row = mysql_fetch_array($rec));

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Tanent_Profile</title>
<link rel="stylesheet" type="text/css" href="css/user_style.css" />
</head>
<center>
<body>
<div class="wrapper">
    <div class="header">
        <div class="thdiv1">
        	<table width="580" height="155">
                <tr>
                	<td width="150">Tanent Name</td>
                    <td width="10">:</td>
                    <td width="400"><?php echo $row['name']; ?></td>
                </tr>
                <tr>
                	<td width="150">Phone</td>
                    <td>:</td>
                    <td><?php echo $row['phone']; ?></td>
                </tr>
                <tr>
                	<td width="150">Email</td>
                    <td>:</td>
                    <td><?php echo $row['email']; ?></td>
                </tr>
                <tr>
                	<td width="150">Address</td>
                    <td>:</td>
                    <td><?php echo $row['address']; ?> </td>
                </tr>
        	</table>
        </div>
        
        <div class="thdiv3">
        	<table height="155" width="150" align="center">
            	<tr>
                    <td><?php echo"<img src='photo/".@$row['photo']."' height='155' width='145'>";?></td>                   
                </tr>
            </table>
        </div>
        <div class="thdiv4">
        	<table height="155" width="150" align="center">
            	<tr>
                	<td><?php echo"<img src='photo/photo/".@$row['fpphoto']."' height='155' width='145'>";?></td>                  
                </tr>
            </table>
        </div>
    </div>

    <div class="body">
    	<div class="bdiv2">
    		<table width="930" height="auto" align="center" border="1">
            	<tr>
                	<td width="300">Occupation</td>
                    <td width="10">:</td>
                    <td width="300" colspan="3"><?php echo $row['occupation']; ?></td>
                </tr>
                <tr>
                	<td width="300">National Id NO</td>
                    <td>:</td>
                    <td colspan="3"><?php echo $row['nid']; ?></td>
                </tr>
                <tr>
                	<td width="300">Spouse Name</td>
                    <td>:</td>
                    <td width="300"><?php echo $row['spous_name']; ?></td>
                    <td width="150" height="140" align="center"><?php echo"<img src='photo/".@$row['sphoto']."' height='140' width='130'>";?></td>
                    <td width="150" height="140" align="center"><?php echo"<img src='photo/photo/".@$row['sfpphoto']."' height='140' width='130'>";?></td>
                </tr>
                <tr>
                	<td width="300">Spouse Occupation</td>
                    <td>:</td>
                    <td colspan="3" width="300"><?php echo $row['soccupation']; ?></td>
                </tr>
                <tr>
                	<td width="300">Spouse Mobile</td>
                    <td>:</td>
                    <td colspan="3" width="300"><?php echo $row['sphone']; ?></td>
                </tr>
                <tr>
                	<td width="300">Spouse Email</td>
                    <td>:</td>
                    <td colspan="3" width="300"><?php echo $row['semail']; ?></td>
                </tr>
                <tr>
                	<td width="300">Spouse National Id NO</td>
                    <td>:</td>
                    <td colspan="3" width="300"><?php echo $row['snid']; ?></td>
                </tr>
                <tr>
                	<td width="300">Child</td>
                    <td>:</td>
                    <td colspan="3" width="300"><?php echo $row['child']; ?></td>
                </tr>
                <?php
				$sql = "SELECT * FROM child_info WHERE tanent_id='".@$uid."'";
				$rec = mysql_query($sql);
				$i=0;
				while($row=mysql_fetch_array($rec)){
					$i++;
					echo"<tr>
							<td colspan='5'><b>Child ".$i."</b></td>
						</tr>";
					echo"<tr>
						<td width='300'>Name</td>
						<td>:</td>
						<td width='300'>".$row['cname']."</td>
						<td><img src='photo/".@$row['cphoto']."' height='140' width='130'></td>
						<td><img src='photo/photo/".@$row['cfpphoto']."' height='140' width='130'></td>
					</tr>
					<tr>
						<td width='300'>NID/BCN</td>
						<td>:</td>
						<td colspan='3' width='300'>".$row['cnbid']."</td>
					</tr>";
				}
				?>
                <?php
                echo "<tr>
                	<td colspan='5' style='text-align:center'>";
						if($_SESSION['user_type']=='Admin'){
                    	echo "<a href='tanent_edit.php?e_id=$uid' style='text-decoration:none;'><input type='button' value='Edit' /></a>";
						}
                        echo"<input type='button' value='Close' onclick='window.close()' />
                    </td>
                </tr>";
				?>
            </table>
    	</div>

</div>
</body>
</center>
</html>