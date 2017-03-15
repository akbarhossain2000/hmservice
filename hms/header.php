<?php
session_start();
if(!isset($_SESSION['isLogin']) || $_SESSION['isLogin']!='login')
{
	header("location: ./login.php");
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sky Tracker</title>
<link rel="stylesheet" type="text/css" href="css/style.css"/>

</head>

<body>
<div class="wrapper sadow body">
<!-------------------------------------------------------------------------------------------------------------------------------->
		<div class="hidden header_ariea">
        	<div class="hidden body header">
            	<div class="hidden logo float_left">
                	<img src="images/logo.png" alt=""/>
                </div>
                <div class="hidden logout float_right">
                	<p><a href="logout.php">Logout</a></p>
                    
                </div>
            </div>
        </div>
<!-------------------------------------------------------------------------------------------------------------------------------->
        <div class="hidden content_ariea">
        	<div class="hidden body content">
            <div class="hidden body outer_border float_left">
            	<div class="hidden mainmenu float_left">
                	<ul>
                    		<li><a href="index.php">Home</a></li>
                        	<?php
								if($_SESSION['user_type']=='Admin'){
							?>
							<li><a href="create_tanent.php">Create Tanent</a></li>
                            <li><a href="add_floor.php">Add Floor</a></li>
                            <li><a href="add_flat.php">Add Flat</a></li>
							<li><a href="create_apartment.php">Create Apartment</a></li>
                            <li><a href="tanent_list.php">Tanent List</a></li>
                            <li><a href="add_meterrent.php">Add Meter Rent</a></li>
							<li><a href="service_charge.php">Service Charge</a></li>
                           
							<li><a href="tanent_ladger.php">Tanent Ledger</a></li>
                            
							<li><a href="credit_voucher.php">Cradit Voucher</a></li>
                            <li><a href="signup.php">Sign Up For Admin</a></li>
                            <?php
								}
							?>
						</ul>
               	</div>
             </div>
                <div class="hidden continar float_left">