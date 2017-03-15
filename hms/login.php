<?php
if(isset($_POST['form_login'])) 
{
	
	try{
		if(empty($_POST['username'])){
			throw new Exception('Username can not be empty');
		}
		
		if(empty($_POST['password'])){
			throw new Exception('Password can not be empty');
		}
		
		if(empty($_POST['user'])){
			throw new Exception('User can not be empty');
		}
		
	
		include('ini.php');
		if($_POST['user'] == "admin"){
			$num=0;
			$result = mysql_query("select * from tbl_login where username='".$_POST['username']."' and password='".$_POST['password']."'");
			//echo $result;
			$num = mysql_num_rows($result);
			
			if($num>0){
				session_start();
				$_SESSION['isLogin'] = "login";
				$_SESSION['user_type'] = "Admin";
				header("location: index.php");
			}else{
				throw new Exception('Invalid Username and/or password');
			}
		} 
		
		if($_POST['user'] == "user") {
			$num1=0;
		  $result1 = mysql_query("select * from booking_flat where user_id='".$_POST['username']."' and password='".$_POST['password']."'");
		  $num1 = mysql_num_rows($result1);
		  
		  if($num1>0){
			  session_start();
			  $_SESSION['isLogin'] = "login";
			  $_SESSION['user_type'] = "User";
			  header("location: user_ledger.php?u_id=".$_POST['username']);
		  }else{
			  throw new Exception('Invalid Username and/or password');
		  }
		}
	}
	
	
	
	catch(Exception $e){
		$error_message = $e->getMessage();
	}
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Loging</title>
<link rel="stylesheet" type="text/css" href="css/style1.css" />
<link rel="" href="" />
</head>
<?php
if(isset($error_message)){
	echo $error_message;
}
?>
<form action="login.php" method="post">
<body>
	<div class="login-warapp">
    	<div class="logo">
        	<img src="images/logo.png" alt=""/>
        </div>
		<div class="login-content">
			<div class="username">
				Select User<select name="user" class="user"><option>-----</option><option value="user">User</option><option value="admin">Admin</option></select>
			</div>
            <div class="username">
				User Name<input type="text" name="username"  id="username"class="user" />
			</div>
			<div class="password">
				Password<input type="password" name="password" id="password" class="pass" />
			</div>
			<div class="boutton">
				<input type="submit" name="form_login" id="form_login" class="sumbit" value="Login" />
			</div>
			<div class="forgot-pass">
				<p><a href="">Forgot Passord?</a> | <a href="">Privacy</a></p>
                
                <p class="designer">Software Developedby | <a href="http://esoft.com.bd" target="_blank" style="font-size:16px;">e-Soft</a></p>
			</div>
		</div>
	</div>
    <div class="footer">
    	<p class="copyright">&copy; Copyright 2014 by <a href="#">You</a> All rights reserved.</p>
		
    </div>
</body>
</form>
</html>
