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

include_once('ini.php');


if(isset($_GET['hrent'])):
	$hrent=$_GET['hrent'];
	
	$data=mysql_fetch_array(mysql_query("select * from tbl_flat where flat_id='$hrent'"));
	echo '<input type="text" name="budget" id="budget" value="'.$data['budget'].'" readonly />';

endif;


}
?>
	
