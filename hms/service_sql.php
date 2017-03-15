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

$action 				= isset($_POST['action'])? $_POST['action']:"";
$floor 					= getFloor();
$flat 					= getFlat();
$unbook_flat 			= getUbookedFlatNo();

$result = array(
	'floor_tbl'=>$floor,
	'flat_tbl'=>$flat,
	'unbook_flat'=>$unbook_flat
);
if($action == 'getJson'){
	echo json_encode($result);
}

function getFloor(){
	$sql = "SELECT * FROM floor";	
	$rec = mysql_query($sql);
	$floor = array();
	while($row = mysql_fetch_array($rec)){
		$floor_id			= $row['floor_id'];
		$floor_name			= $row['floor'];
		
		$floor[$floor_id]	= $floor_name;
	}
	return $floor;
}

function getFlat(){
	$sql = "SELECT * FROM flat";	
	$rec = mysql_query($sql);
	$flat = array();
	while($row = mysql_fetch_assoc($rec)){
		$flat[] = $row;
	}
	return $flat;
}

function getUbookedFlatNo(){
	$sql = "SELECT * FROM tbl_flat WHERE status1 = '0'";
	$rec = mysql_query($sql);
	$i = 0;
	$ubooked_flat = array();
	while($row = mysql_fetch_array($rec)){
		$flat_id		= $row['flat_id'];
		$ubooked_flat[] = $flat_id;
	}
	return $ubooked_flat;	
}
?>
